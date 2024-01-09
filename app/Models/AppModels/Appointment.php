<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\AppModels\Product;
use App\Models\Core\Products as Coreproduct;
use DB;
use Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon;
use Hash;

class Appointment extends Model
{

  

 public static function appointmentOutlet($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){
    $outlet = DB::table('appointment_outlet')->where('status',1)->get();
    if (!$outlet->isEmpty()) {
      $responseData = array('success'=>'1', 'data'=>$outlet, 'message'=>"Returned all Outlet.");
    }else{
      $responseData = array('success'=>'0','message'=>"No data found.");
    }

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function appointmentOutletSelect($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){
    $outlet_id = $request->outlet_id;
    if($outlet_id != '')
    {
      $outlet = DB::table('appointment_outlet')->where('id',$outlet_id)->where('status',1)->get();
      if (!$outlet->isEmpty()) {
        $holiday = DB::table('appointment_holiday')->where('outlet_id',$outlet_id)->where('status',1)->get();
        $slot = DB::table('appointment_slot')->where('outlet_id',$outlet_id)->where('status','1')->get();
        if (!$holiday->isEmpty() || !$slot->isEmpty()) {
          $responseData = array('success'=>'1', 'holiday'=>$holiday, 'slot'=>$slot, 'message'=>"Returned all Outlet.");
        }else{
          $responseData = array('success'=>'0','data'=>array(),'message'=>"No data found.");
        }
      }
      else
      {
        $responseData = array('success'=>'0','data'=>array(),'message'=>"Invalid Outlet ID.");
      }
    }
    else
    {
      $responseData = array('success'=>'0','data'=>array(),'message'=>"Required outlet ID.");
    }
    

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function appointmentDateSelect($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

 

  if($authenticate==1){
    $outlet_id = $request->outlet_id;
    $date = $request->date;
    $slots = [];
   
    $succ = '';

    $index = '0';

    if($outlet_id != '' || $date != '')
    {
      $outlet = DB::table('appointment_outlet')->where('id',$outlet_id)->where('status',1)->get();
     
      if (!$outlet->isEmpty()) {
        $appointmentCheck = DB::table('appointment')->where('app_date','=',$date)->where('outlet_id',$outlet_id)->where('status','1')->count();
        
        if($appointmentCheck != 0){
          

          $slot = DB::table('appointment_slot')->where('outlet_id',$outlet_id)->where('status','1')->get();

          foreach($slot as $resdata){
              $index++;
              
              $appointment = DB::table('appointment')->where('app_date','=',$date)->where('outlet_id',$outlet_id)->where('app_time',$resdata->start_end)->where('status','1')->first();

              $appointmentCount = DB::table('appointment')->where('app_date','=',$date)->where('outlet_id',$outlet_id)->where('app_time',$resdata->start_end)->where('status','1')->count();

              if($appointment){

                  $app_setting = DB::table('appointment_setting')->where('outlet_id',$outlet_id)->where('status','1')->first();

                  if($app_setting->no_of_booking >= $appointmentCount){

                      $slotID[] = $resdata->id;
                      $starthour[] = $resdata->start_hour;
                      $endhour[]= $resdata->end_hour;
                      $hour[] = $resdata->start_hour.' - '.$resdata->end_hour;
                      $succ = 1;
                  } else {
                      $succ = 0;
                      $slotID = 0;
                      $starthour = 0;
                      $endhour= 0;
                   
                  }
              }
              
  
          }
          $slots["slotID"] = $slotID;
          $slots["starthour"] = $starthour;
          $slots["endhour"] = $endhour;
          $slots["hour"] = $hour;
          
          
          
        }
        else
        {
          $slot = DB::table('appointment_slot')->where('outlet_id',$outlet_id)->where('status','1')->get();

          foreach($slot as $resdata){
            $index++;
              $slotID[] = $resdata->id;
              $starthour[] = $resdata->start_hour;
              $endhour[] = $resdata->end_hour;
              $hour[] = $resdata->start_hour.' - '.$resdata->end_hour;
            }
            $succ = 1;
            $slots["slotID"] = $slotID;
            $slots["starthour"] = $starthour;
            $slots["endhour"] = $endhour;
            $slots["hour"] = $hour;
        }
        
        if($succ == 1)
        {
        $responseData = array('success'=>'1', 'data'=>$slots, 'message'=>"Returned all value.");
        }
        else
        {
          $responseData = array('success'=>'0','data'=>array(),'message'=>"Slot not avaialble in this date");
        }

      }
      else
      {
        $responseData = array('success'=>'0','data'=>array(),'message'=>"Invalid Outlet ID.");
      }
    }
    else
    {
      $responseData = array('success'=>'0','data'=>array(),'message'=>"Required outlet ID.");
    }
    

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function addtoAppointment($request)
{
  
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){

    $outlet_id = $request->outlet_id;
    $customer_id = $request->customer_id;
    $products_id = $request->products_id;
    $product_name = $request->product_name;
    $name = $request->name;
    $phone = $request->phone;
    $appDate = $request->appDate;
    $appTime = $request->appTime;
    $message = $request->message;
    $address = $request->address;
    $products_price = $request->products_price;
    $date = date('Y-m-d H:i:s');
    $booking_status = 1;
    $status = 1;

    if($outlet_id != '' || $customer_id != '' || $products_id != '' || $name != '' || $phone != '' || $appDate != '' || $appTime != '' || $message != '' || $address != '' || $products_price != '' || $product_name != '' )
    {

        $appointment_id = DB::table('appointment')->insertGetId([
          'user_id' => $customer_id,
          'outlet_id' => $outlet_id,
          'product_id' => $products_id,
          'name' => $name,
          'phone' => $phone,
          'app_date' => $appDate,
          'app_time' => $appTime,
          'message' => $message,
          'amount'=> $products_price,
          'address' => $address,
          'booking_status' => $booking_status,
          'status' => $status,
          'created_at' => $date,
      ]);

      $appointment_track = DB::table('appointment_track')->insertGetId([   
        'appointment_id' => $appointment_id,
        'booking_id' => $booking_status,
        'status' => $status,
        'comments' => $message,
        'created_at' => $date,
      ]);

      $userdata = DB::table('users')->where('id', $customer_id)->where('status', '1')->first();


     
      $order_email = DB::table('settings')->where('id', '=','71')->first();
      $app_name = DB::table('settings')->where('id', '=','19')->first();
      $website_link = DB::table('settings')->where('id', '=','103')->first();
      $api_key = DB::table('settings')->where('id', '=','123')->first();
      $domain = DB::table('settings')->where('id', '=','124')->first();
      $order_no = DB::table('settings')->where('id', '=','150')->first();
      $aws_urlv = DB::table('settings')->where('id', '=','170')->first();

        $output = '';
        $outputs = '';
        $name = "Grocery platinum24 online store";
        $app_name =$app_name->value;
        $order_email =$order_email->value;
        $from = $app_name. "<".$order_email.">";
        $to =  $userdata->email;
        $website_link = $website_link->value;
        $aws_url = $aws_urlv->value;


        $result = $request->products_id;
        $product=$result;
        $orderno = $order_no->value.$products_id;
        $domain = $domain->value;
        $api_key = $api_key->value;
        $subject = 'Hooray! Your order '.$orderno.' is being processed!';
        $bcc  = '';

        $h = "Here's your tracking details";
        $p = "Please note that it may take up to 1 - 2 days for the tracking status to be updated by the logistics team";
        $url = $website_link."orders";

        $output             .= '<div><h1 style="color: #fd5397;">'.$app_name.'<span style="font-size: 12px; float: right; color: #212529; padding-top:10px;">'.$orderno.'</span></h1></div>
        <div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
        <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div>
        <div style="border-bottom: 1px solid #dee2e6; padding: 15px 0; "></div>
        <div><h2 style="color: #212529; font-weight: 400;">Items in this shippment</h2></div><div>';
           
            $productname=$request->product_name;
           

            $appointment_setting = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->where('appointment_setting.outlet_id',$request->outlet_id)->first();

            $qty=$appointment_setting->no_of_pax;

            $iamgepath = DB::table('products')->join('image_categories','image_categories.image_id','=','products.products_image')->where('products.products_id',$request->products_id)->first();

            $imgpath=$iamgepath->path;

            

            if($iamgepath->path_type == 'aws')
            {
                $imgurl = $aws_url.$imgpath;
            }
            else
            {
                $imgurl = $website_link.$imgpath;
            }

               
           
           

              $output             .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;vertical-align: middle;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
                      <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';

              $output             .= '</div><div><p style="color: #212529;"> If you have any questions, reply to this email or contact us at <span style="color:#fd5397">orders@grocery.platinum24.net</span></p></div>';

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



             

              // admin mail

              $outputs  .= '<div><h1 style="color: #fd5397;">'.$name.'<span style="font-size: 12px; float: right; color: #212529; padding-top:10px;">'.$orderno.'</span></h1></div>
              <div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
              <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div>
              <div style="border-bottom: 1px solid #dee2e6; padding: 15px 0; "></div>
              <div><h2 style="color: #212529; font-weight: 400;">Items in this shippment</h2></div><div>';

              $productname=$request->product_name;

              $appointment_setting = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->where('appointment_setting.outlet_id',$request->outlet_id)->first();

              $qty=$appointment_setting->no_of_pax;

              $iamgepath = DB::table('products')->join('image_categories','image_categories.image_id','=','products.products_image')->where('products.products_id',$request->products_id)->first();

              $imgpath=$iamgepath->path;
              $website_links = DB::table('settings')->where('id', '=','103')->first();

              $website_link =  $website_links->value;

              if($iamgepath->path_type == 'aws')
              {
              $imgurl = $aws_url.$imgpath;
              }
              else
              {
              $imgurl = $website_link.$imgpath;
              }


              $outputs .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
              <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';

              $outputs .= '</div><div><p style="color: #212529;"> If you have any questions, reply to this email or contact us at <span style="color:#fd5397">orders@platinum24.net</span></p></div>';

              $to = $order_email;
              $subject = $subject;

              $message = $outputs;
              $charset = "GB2312";

              $header = "From:orders@platinum24.net \r\n";
              $header .= "MIME-Version: 1.0\r\n";
              $header .= "X-Accept-Language: cn\n";
              $header .= "Content-type: text/html; charset={$charset}\n";

              $retval = mail ($to,$subject,$message,$header); 


              $responseData = array('success'=>'1', 'appointment_id'=>$appointment_id,  'message'=>"Appointment successfully Added.");

    }

    else{
      $responseData = array('success'=>'0','data'=>array(),'message'=>"Required All Fields.");
      }

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function viewAppointment($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){
   
    $result = array();
    $customer_id = $request->customer_id;
    if($customer_id != '')
    {
    $result['appointment_count'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',$customer_id)
        ->orderby('appointment.id','DESC')->get();


		$result['appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',$customer_id)
        ->orderby('appointment.id','DESC')
        ->get();

        if(!$result['appointment']->isEmpty())
        {
          $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Returned all data.");
        }else{
          $responseData = array('success'=>'0','data'=>array(),'message'=>"No data found.");
        }

      }
      else
      {
        $responseData = array('success'=>'0','data'=>array(),'message'=>"Required Customer ID.");
      }
  

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function viewAppointmentByID($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){
   
    $result = array();
    $id = $request->appointment_id;
    if($id != '')
    {
    $result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','image_categories.path_type','image_categories.path','appointment.created_at as createdDate')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('products_description','products_description.products_id','=','appointment.product_id')->join('image_categories','image_categories.image_id','=','products.products_image')->where('appointment.id',$id)->first();
		
		$result['appstatus'] = DB::table('appointment_status')->select('appointment_status.*')->join('appointment','appointment.booking_status','=','appointment_status.id')->where('appointment.id',$id)->get();

		$result['outlet'] = DB::table('appointment_outlet')->select('appointment_outlet.name','appointment_outlet.phone','appointment_outlet.address','appointment_outlet.postal_code')->join('appointment','appointment.outlet_id','=','appointment_outlet.id')->where('appointment.id',$id)->first();

		$result['appointment_setting'] = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->first();

		$result['orderTrack'] = DB::table('appointment_track')->join('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.appointment_id',$id)->get();
		
        if($result['appointment'] != '')
        {
          $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Returned all data.");
        }
        else{
          $responseData = array('success'=>'0','data'=>array(),'message'=>"No data found.");
        }

      }
      else
      {
        $responseData = array('success'=>'0','data'=>array(),'message'=>"Required Appointment ID.");
      }
  

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}

public static function cancelAppointment($request)
{
  $consumer_data 		 				  =  array();
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){
   
    $result = array();
    $customer_id = $request->customer_id;
    $appointment_id = $request->appointment_id;
    if($customer_id != '' || $appointment_id)
    {
      $date_added = date('Y-m-d h:i:s');
      $comments = 'user cancel this order';
      $appointmentCheck = DB::table('appointment')->where(['user_id' => $customer_id], ['id' => $appointment_id])->get();
        if (count($appointmentCheck) > 0) {
          $appointment_track = DB::table('appointment_track')->insertGetId(
            [
                'appointment_id' => $appointment_id,
                'booking_id' => 3,
                'comments' => $comments,
                'status' => '1',
                'created_at' => $date_added,
            ]
        );

        $appointment = DB::table('appointment')->where('id',$request->appointment_id)->update([
        
            'booking_status' => 3,

        ]);

        $order_user= DB::table('appointment')->where('id', '=', $request->appointment_id)->first();

        $user= DB::table('users')->where('id', '=', $order_user->user_id)->first();


        $order_email = DB::table('settings')->where('id', '=','71')->first();
        $app_name = DB::table('settings')->where('id', '=','19')->first();
        $website_logo = DB::table('settings')->where('id', '=','16')->first();
        $api_key = DB::table('settings')->where('id', '=','123')->first();
        $domain = DB::table('settings')->where('id', '=','124')->first();
        $website_link = DB::table('settings')->where('id', '=','103')->first();

        $imagepath = DB::table('image_categories')->where('path', '=', $website_logo->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
        if($imagepath->path_type == 'aws')
        {
            $imgurl = $website_logo->value;
        }
        else
        {
            $imgurl = $website_link.$website_logo->value;
        }


        $title = 'Congratulation '.$user->first_name. ' !';

        $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;"><img src="'.$imgurl .'" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"><p style="text-align:center;">Your Appointment was Cancelled Successfully....!</p></div></div>';



        $subject = $title;
        $MailData            = array();
        $api_key             = $api_key->value;
        $domain              = $domain->value;
        $MailData['from']    = $app_name->value. "<".$order_email->value.">";
        $MailData['to']      = $user->email;
        //$MailData['to']      = 'sakthi@platinumcode.com.my';
        $MailData['subject'] = $title;
        $MailData['html'] =  $html;

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
        $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Your Appointment cancelled");

        }
        else{
          $responseData = array('success'=>'0','data'=>array(),'message'=>"No data found.");
        }

      
      }
      else
      {
        $responseData = array('success'=>'0','data'=>array(),'message'=>"Required All Fields.");
      }
  

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $appointmentResponse = json_encode($responseData);

  return $appointmentResponse;
}




}