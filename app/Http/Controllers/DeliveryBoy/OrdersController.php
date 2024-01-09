<?php
namespace App\Http\Controllers\DeliveryBoy;

//validator is builtin class in laravel
use Validator;

use Mail;
use DB;
//for password encryption or hash protected
use Hash;
use DateTime;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Setting;
use App\Models\DeliveryBoyModel\Orders;

//for Carbon a value 
use Carbon;

class OrdersController extends Controller
{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct( Setting $setting)
    {
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
    }

		 	
	public function getStatuses(Request $request){		
		$response = Orders::getStatuses($request);
		return($response) ;
	}

	public function orders(Request $request){
		$response = Orders::orders($request);
		return($response) ;
	}


	public function ordersByID(Request $request){
		$response = Orders::ordersByID($request);
		return($response) ;
	}

	public function changeOrderStatus(Request $request){
		
		$response = Orders::changeOrderStatus($request);
	
	
		$orders_id = $request->orders_id;
        $orders_status_id = $request->orders_status_id;

		$orders_data = DB::table('orders')
        ->where('orders_id', $orders_id)->first();

        $devices_data = DB::table('devices')
        ->where('user_id', $orders_data->customers_id)->first();

		$lang_data = DB::table('languages')
        ->where('is_default', 1)->first();

		$existUser = DB::table('users')
        ->where('id', $orders_data->customers_id)->first();

		
		$order_status_email = DB::table('alert_settings')->where('order_status_email', 1)->first();
		$order_status_notification = DB::table('alert_settings')->where('order_status_notification', 1)->first();

		if($orders_status_id == 12)
		{
			$message = 'Your Ordered Product On the way.';
			$title = 'Order On The Way';
		}
		elseif($orders_status_id == 6)
		{
			$message = 'Your Ordered Product Delivered.';
			$title = 'Order Delivered';
		}
		elseif($orders_status_id == 3)
		{
			$message = 'Your Ordered Product Cancelled.';
			$title = 'Order Cancelled';
		}
		else
		{
			$message = 'Your Ordered Product Delivered.';
			$title = 'order delivered';
		}

	


		if($order_status_email != '')
		{
			
		
			$setting = $this->myVarsetting->getSetting();
		$app_name =$setting[18]->value;
		$order_email =$setting[70]->value;
		$from = $app_name. "<".$order_email.">";
		$to = $existUser->email;
		$bcc = '';
		$api_key = $setting[122]->value;
		$domain = $setting[123]->value;
		$subject = 'Order Status';


		$html =  '<div style="width: 100%; display:block;"><h2>'.$app_name.' Order Status</h2><p><strong>Hi '.$existUser->first_name.' '.$existUser->last_name.' !</strong><br>'.$message.'</strong><br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>'
		;


		$this->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);



		// Insert main count in Superadmin

		$resuluser = DB::table('users')->where('role_id', 1)->first();
		$shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
		$p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
			'email' => $bcc,
			'comments' => $title,
			'user_id' => $resuluser->id,
			'shop_name' => $resuluser->user_name,
			'shop_id' => $shopmail->id,
			'created_at' => date('Y-m-d H:i:s')
			]);
		

		}
       
       
        if($devices_data != '')
        {

		
	
		

    

        $device_id = $devices_data->device_id;
        $lang_id = $lang_data->languages_id;

		
			$pageResponse = 1;
			$websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/images/logo.png';
	
			$sendData = array
				(
				'body' => $message,
				'title' => $title,
				'title' => $title,
				'icon' => 'myicon', /*Default Icon*/
				'sound' => 'mySound', /*Default sound*/
				'key' => 'order_id', 
				'value' => $orders_id, 
				'key1' => 'customers_id', 
				'value1' => $orders_data->customers_id, 
				'key2' => 'language_id', 
				'value2' => $lang_id, 
				'key3' => 'currency_code', 
				'value3' => 'MYR', 
				'key4' => 'type', 
				'value4' => 'orders', 
				'image' => $websiteURL,
			);

			if($order_status_email != '')
		{

          $this->onesignalNotification($device_id, $sendData, $pageResponse);
		}
        }
		return($response) ;


	}


	public function mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html)
	{
		
		   $subject = $subject;
		   $MailData            = array();
		   $api_key             = $api_key;
		   $domain              = $domain;
		   $MailData['from']    = $from;
		   $MailData['to']      = $to;
		   $MailData['bcc']     = $bcc;
		   $MailData['subject'] = $subject;
		   $MailData['html'] = $html;
   
		   $ch = curl_init();
		   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		   curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
		   //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
		   curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
		   $resultss = curl_exec($ch);
		   curl_close($ch);  
		   //echo $resultss;
		   //return $result;
	}


	



	public function onesignalNotification($device_id, $sendData){
		
        //get function from other controller        
     
        $setting = $this->myVarsetting->getSetting();
        
        $settings = $setting->unique('id')->keyBy('id');
        
		$content = array(
		   "en" => $sendData['body']
		   );
		
		$headings = array(
		   "en" => $sendData['title']
		   );
		$big_picture = array(
		   "id1" => $sendData['image']
		   );
		
		$fields = array(
		   'app_id' => $settings[56]->value,
		   'include_player_ids' => array($device_id),		   
		   'contents' => $content,
		   'headings'=>$headings,
		   'chrome_web_image'=>$sendData['image'],
		   'big_picture'=>$sendData['image'],
		   'ios_attachments'=>$sendData['image'],
		   'firefox_icon'=>$sendData['image'],
		   'data' => array($sendData['key'] => $sendData['value'],$sendData['key1'] => $sendData['value1'],$sendData['key2'] => $sendData['value2'],$sendData['key3'] => $sendData['value3'],$sendData['key4'] => $sendData['value4'])
          
		);


       
	
		$fields = json_encode($fields);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic ZTJhZTcwNzItODQ4Ni00Y2FiLWFjZjEtMGY4ODZhZGZlMGZl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		$result = curl_exec($ch);
       
		
		
		//$data = json_decode($result);
		curl_close($ch);
		
    }


	
	
	//changeStatus
	public function qrCode(Request $request){
		
		$is_available 			=  $request->is_available;
		$delivery_boy_pincode 	=  $request->delivery_boy_pincode;
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');	
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');	
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		$authenticate=1;
		if($authenticate==1){		
			
			$data = DB::table('qr_codes')->where('status', 1)->get();
			if(count($data)>0){			
				$responseData = array('success'=>'1', 'data'=>$data,  'message'=>"QR Codes are returned successfully!");
			}else{
				$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"There is no qr code.");
			}
			
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$categoryResponse = json_encode($responseData);
		print $categoryResponse;
	}
	
	//deliverypages
	public function deliverypages(Request $request){
		
		$language_id            				=   $request->language_id;	
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');	
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');	
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		$authenticate=1;
		if($authenticate==1){
			
			$data = DB::table('pages')
				->LeftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
				->where('pages_description.language_id', '=', $language_id)->where('pages.type', '=', 3)->get();
	
			$result = array();
			$index = 0;
			foreach($data as $pages_data){
				array_push($result, $pages_data);
				
				$description =  $pages_data->description;
				$result[$index]->description = stripslashes($description);
				$index++;
				
			}
			
			//check if record exist
			if(count($data)>0){
					$responseData = array('success'=>'1', 'pages_data'=>$result,  'message'=>"Returned all products.");
				}else{
					$responseData = array('success'=>'0', 'pages_data'=>array(),  'message'=>"Empty record.");
				}		
		}else{			
			$responseData = array('success'=>'0', 'pages_data'=>array(),  'message'=>"Unauthenticated call.");
		}			
		$categoryResponse = json_encode($responseData);
		print $categoryResponse;
	}

	
	
	
	
}