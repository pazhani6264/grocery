<?php

namespace App\Http\Controllers\Web;


use Validator;
use Mail;
use DB;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\Web\Alert;

class AlertController extends Controller
{

	public function userDevice($customers_id){
		$alert = new Alert();
		$device = $alert->getUserDevices($customers_id);
		if(count($device)>0){
			return $device[0]->device_id;
		}
		else{
			return '';
		}
	}

	//alert Setting
	public function getAlertSetting(){
		$alert = new Alert();
		$setting = $alert->getAlertSetting();
		return $setting;
	}

	//alert Setting
	public function setting(){
		$alert = new Alert();
		$setting = $alert->setting();
		return $setting;
	}

	//listingDevices
	public function createUserAlert($existUser){

		//alert setting
		$alertSetting = $this->getAlertSetting();
		//setting
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;

		if($alertSetting[0]->create_customer_email==1 and !empty($existUser[0]->email)){
			Mail::send('/mail/createAccount', ['userData' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.WelcometoEcommerce"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}

		if($alertSetting[0]->create_customer_notification==1){

			$title = Lang::get("labels.userThankYou");
			$message = Lang::get("labels.welcomeemailtext").$setting[18]->value;

			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',/*Default Icon*/
							'sound' => 'mySound',/*Default sound*/
							'image' => '',
				  );

			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($existUser[0]->customers_id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}


	}

	//orderAlert
	public function orderAlert($ordersData){

		//alert setting
		$alertSetting = $this->getAlertSetting();

		//setting
		$setting = $this->setting();
		$ordersData['app_name'] = $setting[18]->value;
		$ordersData['orders_data'][0]->admin_email = $setting[70]->value;

		if($alertSetting[0]->order_email==1){
			$output='';

			$setting = $this->getSetting();
	
		$app_name = $setting['app_name'];
		$order_email =$setting['order_email'];
		$from = $app_name. "<".$order_email.">";
		$to = $ordersData['orders_data'][0]->email;
		$website_link = $setting['external_website_link'];
		$aws_url = $setting['aws_url'];
		$inv = $setting['invoice_prefix'];


	
	$orderno = $inv.$ordersData['orders_data'][0]->orders_id;

	$api_key = $setting['mail_chimp_api'];
		$domain = $setting['mail_chimp_list_id'];
	$subject = 'Hooray! Your order '.$orderno.' is being processed!';
	$bcc  = '';
	$tos  = $order_email;

	$h = "Here's your tracking details";
	$p = "Please note that it may take up to 1 - 2 days for the tracking status to be updated by the logistics team";
	$url = $website_link."orders";

	

	$output .='<div style="padding: 5px;"><div style="width: 100%; display: block">
    <h2 style="font-size: 20px;border-bottom: 1px solid #eee;padding-bottom: 20px;">Order ID# '.$ordersData['orders_data'][0]->orders_id.' <span style="background-color: #3c8dbc;display: inline;padding: .2em .6em .3em;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size:14px !important;position:relative;top: -2px;margin: 0 5px;display: none;"> Pending</span> <small style="font-size: 14px;float: right;padding-right: 12px;margin-top: 6px;">Ordered Date: '.date('m/d/Y', strtotime($ordersData['orders_data'][0]->date_purchased)).'</small>
	</h2></div><div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
                                    <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div><br><br><div style="display: display: block;width: 100%;padding: 0 0 20px;"><div style="display: inline-block; width:32%"> <strong>Customer Info:<strong><address><span style="text-transform: capitalize;">'.$ordersData['orders_data'][0]->customers_name .'</span>
	<br>'.$ordersData['orders_data'][0]->customers_street_address.' <br>'.$ordersData['orders_data'][0]->customers_city.', '.$ordersData['orders_data'][0]->customers_state.' '.$ordersData['orders_data'][0]->customers_postcode.', '. $ordersData['orders_data'][0]->customers_country.'<br>Phone: '.$ordersData['orders_data'][0]->customers_telephone.'<br>Email: '.$ordersData['orders_data'][0]->email.'</address></div><div style="display: inline-block; width:32%"> 

	<strong>Shipping Info:</strong><address><span style="text-transform: capitalize;">'.$ordersData['orders_data'][0]->delivery_name .'</span>
	<br>'.$ordersData['orders_data'][0]->delivery_street_address .' <br>
	'.$ordersData['orders_data'][0]->delivery_city.' ,
	 '.$ordersData['orders_data'][0]->delivery_state.'
	  '. $ordersData['orders_data'][0]->delivery_postcode.' , '.$ordersData['orders_data'][0]->delivery_country .'
	</address>
	</div><div style="display: inline-block; width:32%"> <strong>Billing Info:</strong><address><span style="text-transform: capitalize;">'.$ordersData['orders_data'][0]->billing_name.'</span><br>'. $ordersData['orders_data'][0]->billing_street_address .' <br>
       '. $ordersData['orders_data'][0]->billing_city.' , 
	   '.$ordersData['orders_data'][0]->billing_state.'
	   '. $ordersData['orders_data'][0]->billing_postcode.' ,
	    '.$ordersData['orders_data'][0]->billing_country .'</address>
	   </div></div><table class="table table-striped" style="width: 100%;background-color: transparent;margin: 15px 0 15px;"><thead><tr><th align="center">Qty</th><th align="center" >Image</th><th align="center">Product Name</th><th align="center">Additional Attributes</th><th align="center">Price</th></tr></thead><tbody style="text-transform: capitalize;font-size: 12px;">';

	   foreach($ordersData['orders_data'][0]->data as $key=>$products){

		$imgpath=$products->image;
		if($products->image_path_type == 'aws')
			{
				$imgurl = $products->image;
			}
			else
			{
				$imgurl = asset('').$products->image;
			}

	   $output .='<tr><td align="center" style="padding: 8px;">'.$products->products_quantity .'
	   </td><td align="center" style="padding: 8px;"> <img src="'.$imgurl.'" width="60px"> </td><td align="center" style="padding: 8px;"> '.  $products->products_name .'<br>
		</td>
       <td align="center" style="padding: 8px;">';

            foreach($products->attribute as $attributes){
                $output .='<b>Name:</b> '.$attributes->products_options .'<br>
                <b>Value:</b> '. $attributes->products_options_values .'<br>
                <b>Price:</b> '. $attributes->price_prefix .' '.$attributes->options_values_price .'<br>';
			}
			$output .='</td><td align="center" style="padding: 8px;"> '. $ordersData['orders_data'][0]->currency.' '.  $products->final_price * $ordersData['orders_data'][0]->currency_value .'</td>
      </tr>';
	   }
	   $output .='</tbody></table><div style="display: block;"><div style="float:left;width: 64%;padding-right: 4%;"><p class="lead" style="margin-bottom: 0;font-size: 18px;font-weight: bold;">Payment Methods:</p>
      <p style="text-transform:capitalize; border: 1px solid #e3e3e3; padding: 10px;border-radius: 4px;background-color: #f5f5f5;margin-top: 5px;"> '.str_replace('_',' ', $ordersData['orders_data'][0]->payment_method).' </p>';
      
      if(!empty($ordersData['orders_data'][0]->coupon_code)){	  
		$output .='.<p style="margin-bottom: 5px;font-size: 18px;font-weight: bold;">Coupons:</p><table style="text-align: center; width: 80%;border-radius: 3px; margin-bottom: 20px; background-color: #f5f5f5; border: 1px solid #e3e3e3;"><tr><th style="text-align: center; border-top: 1px solid #f4f4f4;     padding: 8px;
    line-height: 1.42857143;vertical-align: top;">Code</th>
          <th style="text-align: center; border-top: 1px solid #f4f4f4;     padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;">Amount</th>
        </tr>';
    
     foreach( json_decode($ordersData['orders_data'][0]->coupon_code) as $couponData){
	 $output .='
        <tr>
          <td style="text-align: center; border-top: 1px solid #e3e3e3;     padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;">'. $couponData->code.'</td>
    
          <td style="text-align: center; border-top: 1px solid #e3e3e3;     padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;">'. $couponData->amount.' '; 
            
            if($couponData->discount_type=='percent_product'){
				$output .='Percent';
			}
            elseif($couponData->discount_type=='percent')
			{
				$output .='Percent';
			}
            elseif($couponData->discount_type=='fixed_cart'){
				$output .='Fixed';
			}
            elseif($couponData->discount_type=='fixed_product')
			{
                $output .='Fixed';
			}
            
			$output .='</td>
        </tr>';
		}
        
		$output .='</table>';
      
	  }
      
	  $output .='</div>
    
    <div style=" float: right; width:30%"> 
      
        <table style="width: 100%;padding: 38px 0;">
          <tr>
            <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Subtotal:</th>
            <td align="right" style="border-top: 1px solid #f4f4f4;">'. $ordersData['orders_data'][0]->currency .''. $ordersData['subtotal'] * $ordersData['orders_data'][0]->currency_value.'</td>
          </tr>
          <tr>
            <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Tax:</th>
            <td align="right" style="border-top: 1px solid #f4f4f4;">'. $ordersData['orders_data'][0]->currency .' '.$ordersData['orders_data'][0]->total_tax * $ordersData['orders_data'][0]->currency_value.'</td>
          </tr>
          <tr>
            <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Shipping Cost:</th>
            <td align="right" style="border-top: 1px solid #f4f4f4;">'.$ordersData['orders_data'][0]->currency .' '. $ordersData['orders_data'][0]->shipping_cost * $ordersData['orders_data'][0]->currency_value.'</td>
          </tr>';
		  
          if(!empty($ordersData['orders_data'][0]->coupon_code)){
          $output .='<tr>
            <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Discount(Promo Code):</th>
            <td align="right" style="border-top: 1px solid #f4f4f4;">'. $ordersData['orders_data'][0]->currency.' '. $ordersData['orders_data'][0]->coupon_amount * $ordersData['orders_data'][0]->currency_value .'</td>
          </tr>';
		  }
		  if($ordersData['orders_data'][0]->points_amount !='0'){
			$output .='<tr>
			  <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Discount(Voucher):</th>
			  <td align="right" style="border-top: 1px solid #f4f4f4;">'. $ordersData['orders_data'][0]->currency.' '. $ordersData['orders_data'][0]->points_amount * $ordersData['orders_data'][0]->currency_value .'</td>
			</tr>';
			}
          $output .='<tr>
            <th style="width:50%;padding: 10px 0; border-top: 1px solid #f4f4f4;" align="left">Total:</th>
            <td align="right" style="border-top: 1px solid #f4f4f4;">'.$ordersData['orders_data'][0]->currency .''. $ordersData['orders_data'][0]->order_price * $ordersData['orders_data'][0]->currency_value .'</td>
          </tr>
        </table>
        
    </div></div></div>';


	
	$html = $output;

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


	$html = $output;

	$subject = $subject;
	$MailDatas            = array();
	$api_key             = $api_key;
	$domain              = $domain;
	$MailDatas['from']    = $from;
	$MailDatas['to']      = $tos;
	$MailDatas['bcc']     = $bcc;
	$MailDatas['subject'] = $subject;
	$MailDatas['html'] = $html;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
	//curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
	curl_setopt($ch, CURLOPT_POSTFIELDS, $MailDatas);
	$resultss = curl_exec($ch);
	curl_close($ch); 
	
	
	
			

			
		} 
		if($alertSetting[0]->order_notification==1){
			 
			$lang_data = DB::table('languages')
			->where('is_default', 1)->first();

			$device_id = $this->userDevice($ordersData['orders_data'][0]->customers_id);

			$merchant = DB::table('users')->where('role_id','=', 21)->get();

			if(count($merchant) > 0)
			{
				foreach($merchant as $user){
					$merchantdevice_id = $this->userDevice($user->id);
				

					if(!empty($merchantdevice_id)){
				

						$lang_id = $lang_data->languages_id;
						$message = 'Your Ordered Placed Successfully.';
						$title = 'Placed order';
						$pageResponse = 1;
						$websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/images/logo.png';
				
						$sendData = array
							(
							'body' => $message,
							'title' => $title,
							'icon' => 'myicon', /*Default Icon*/
							'sound' => 'mySound', /*Default sound*/
							'key' => 'order_id', 
							'value' => $ordersData['orders_data'][0]->orders_id, 
							'key1' => 'customers_id', 
							'value1' => $ordersData['orders_data'][0]->customers_id, 
							'key2' => 'language_id', 
							'value2' => $lang_id, 
							'key3' => 'currency_code', 
							'value3' => 'MYR', 
							'key4' => 'type', 
							'value4' => 'orders', 
							'image' => $websiteURL,
						);
		
						$this->onesignalNotificationmerchant($merchantdevice_id, $sendData, $pageResponse);
					}

				}
			}

			if(!empty($device_id)){

				$lang_id = $lang_data->languages_id;
				$message = 'Your Ordered Placed Successfully.';
				$title = 'Placed order';
				$pageResponse = 1;
				$websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/images/logo.png';
		
				$sendData = array
					(
					'body' => $message,
					'title' => $title,
					'icon' => 'myicon', /*Default Icon*/
					'sound' => 'mySound', /*Default sound*/
					'key' => 'order_id', 
					'value' => $ordersData['orders_data'][0]->orders_id, 
					'key1' => 'customers_id', 
					'value1' => $ordersData['orders_data'][0]->customers_id, 
					'key2' => 'language_id', 
					'value2' => $lang_id, 
					'key3' => 'currency_code', 
					'value3' => 'MYR', 
					'key4' => 'type', 
					'value4' => 'orders', 
					'image' => $websiteURL,
				);

				$this->onesignalNotifications($device_id, $sendData, $pageResponse);
			}
        }
	}


	//listingDevices
	public function forgotPasswordAlert($existUser){

		//alert setting
		$alertSetting = $this->getAlertSetting();

		//setting
		$setting = $this->setting();
		$existUser[0]->app_name = $setting[18]->value;

		if($alertSetting[0]->forgot_email==1 and !empty($existUser[0]->email)){
			Mail::send('/mail/recoverPassword', ['existUser' => $existUser], function($m) use ($existUser){
				$m->to($existUser[0]->email)->subject(Lang::get("labels.fogotPasswordEmailTitle"))->getSwiftMessage()
				->getHeaders()
				->addTextHeader('x-mailgun-native-send', 'true');
			});
		}

		if($alertSetting[0]->forgot_notification==1){

			$title = Lang::get("labels.forgotNotificationTitle");
			$message = Lang::get("labels.forgotNotificationMessage");
			$sendData = array
				  (
					'body' 	=> $message,
					'title'	=> $title ,
							'icon'	=> 'myicon',/*Default Icon*/
							'sound' => 'mySound',/*Default sound*/
							'image' => '',
				  );
			if($setting[54]->value=='fcm'){
				$functionName = 'fcmNotification';
			}elseif($setting[54]->value=='onesignal'){
				$functionName = 'onesignalNotification';
			}

			//get device id
			$device_id = $this->userDevice($existUser[0]->customers_id);
			if(!empty($device_id)){
				$response = $this->$functionName($device_id, $sendData);
			}
		}


	}



	/**
     * Notifcation section
     *
     * @return void
     */


	public function fcmNotification($device_id, $sendData){

		//get function from other controller
		$setting = $this->setting();

		#API access key from Google API's Console
		if (!defined('API_ACCESS_KEY')){
			define('API_ACCESS_KEY', $setting[12]->value);
		}
		$fields = array
				(
					'to'    => $device_id,
					'data'	=> $sendData
				);
		$headers = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
		#Send Reponse To FireBase Server
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		$data = json_decode($result);
		if($result === false)
		die('Curl failed ' . curl_error());

		curl_close($ch);

		if(!empty($data->success) and $data->success >= 1){
			$response = '1';
		}else{
			$response = '0';
		}
		//print $response;
	}

	
	public function onesignalNotificationmerchant($device_id, $sendData){
		
        //get function from other controller        
		$settings = $this->setting();
        
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
		   'app_id' => $settings[197]->value,
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
				   'Authorization: Basic NDkzZGNjNjktYTQwMi00YjEzLWFkNTctNzBiNTExNjcxMzNm'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		$result = curl_exec($ch);
		//$data = json_decode($result);
		curl_close($ch);
		
    }


	public function onesignalNotifications($device_id, $sendData){
		
        //get function from other controller        
		$settings = $this->setting();
        
        
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


	public function onesignalNotification($device_id, $sendData){

		//get function from other controller
		$setting = $this->setting();


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
		   'app_id' => $setting[55]->value,
		   'include_player_ids' => array($device_id),
		   'contents' => $content,
		   'headings'=>$headings,
		   'big_picture'=>$sendData['image']
		);

		$fields = json_encode($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic ZTJhZTcwNzItODQ4Ni00Y2FiLWFjZjEtMGY4ODZhZGZlMGZl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$result = curl_exec($ch);
		$data = json_decode($result);
		curl_close($ch);

		if(!empty($data->recipients) and $data->recipients >= 1){
			$response = '1';
		}else{
			$response = '0';
		}

		//print $response;

	}

	public function getSetting()
    {
        $setting = DB::table('settings')->get();
        $result = array();
        foreach ($setting as $settings) {
            $name = $settings->name;
            $value = $settings->value;
            $result[$name] = $value;
        }

        $language = DB::table('languages')->where('is_default',1)->first();
        $result['langId'] = $language ? $language->languages_id : 1;
        $result['languageCode'] = $language ? $language->code :"en"; //default language code
        $result['direction'] = $language ? $language->direction : "ltr"; //default language direction of app
        
        $currency = DB::table('currencies')->where('is_default',1)->first();
        // Please visit this link to get your html code https://html-css-js.com/html/character-codes/currency/
        $result['currency'] = $currency ? $currency->symbol_left ? $currency->symbol_left : $currency->symbol_right : "$"; //default currecny html code to show in app.
        $result['currencyCode'] = $currency ? $currency->code :"USD"; //default currency code
        $result['currencyPos'] = $currency ? $currency->symbol_left ? "left" :"right" : "left"; //default currency position
        $result['decimals'] = $currency ? $currency->decimal_places : 2; //default currecny decimal
        return $result;
    }


}
