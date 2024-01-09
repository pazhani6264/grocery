<?php

namespace App\Models\AppModels;

use App\Http\Controllers\App\AlertController;
use App\Http\Controllers\App\AppSettingController;
use Auth;
use DB;
use File;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Str;

class Customer extends Model
{

    public static function processlogin($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        //print_r($consumer_data);die();

        if ($authenticate == 1) {

            $email = $request->email;
            $password = $request->password;

            $customerInfo = array("email" => $email, "password" => $password, 'role_id' => 2);
            if (Auth::attempt($customerInfo)) {

                $existUser = DB::table('users')
                    ->where('email', $email)->where('status', '1')->get();

                if (count($existUser) > 0) {

                    $customers_id = $existUser[0]->id;

                    //update record of customers_info
                    $existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
                    $customers_info_id = $customers_id;
                    $customers_info_date_of_last_logon = date('Y-m-d H:i:s');
                    $customers_info_number_of_logons = '1';
                    $customers_info_date_account_created = date('Y-m-d H:i:s');
                    $global_product_notifications = '1';

                    if (count($existUserInfo) > 0) {
                        //update customers_info table
                        DB::table('customers_info')->where('customers_info_id', $customers_info_id)->update([
                            'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                            'global_product_notifications' => $global_product_notifications,
                            'customers_info_number_of_logons' => DB::raw('customers_info_number_of_logons + 1'),
                        ]);

                    } else {
                        //insert customers_info table
                        $customers_default_address_id = DB::table('customers_info')->insertGetId(
                            ['customers_info_id' => $customers_info_id,
                                'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                                'customers_info_number_of_logons' => $customers_info_number_of_logons,
                                'customers_info_date_account_created' => $customers_info_date_account_created,
                                'global_product_notifications' => $global_product_notifications,
                            ]
                        );

                        DB::table('users')->where('id', $customers_id)->update([
                            'default_address_id' => $customers_default_address_id,
                        ]);
                    }

                    //check if already login or not
                    $already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();

                    if (count($already_login) > 0) {
                        DB::table('whos_online')
                            ->where('customer_id', $customers_id)
                            ->update([
                                'full_name' => $existUser[0]->first_name . ' ' . $existUser[0]->last_name,
                                'time_entry' => date('Y-m-d H:i:s'),
                            ]);
                    } else {
                        DB::table('whos_online')
                            ->insert([
                                'full_name' => $existUser[0]->first_name . ' ' . $existUser[0]->last_name,
                                'time_entry' => date('Y-m-d H:i:s'),
                                'customer_id' => $customers_id,
                            ]);
                    }

                    //get liked products id
                    $products = DB::table('liked_products')->select('liked_products_id as products_id')
                        ->where('liked_customers_id', '=', $customers_id)
                        ->get();

                    if (count($products) > 0) {
                        $liked_products = $products;
                    } else {
                        $liked_products = array();
                    }

                    $existUser[0]->liked_products = $products;

                    $responseData = array('success' => '1', 'data' => $existUser, 'message' => 'Data has been returned successfully!');

                } else {
                    $responseData = array('success' => '0', 'data' => array(), 'message' => "Your account has been deactivated.");
                }
            } else {
                $existUser = array();
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Invalid email or password.");

            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }


    public static function processlogout($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        //print_r($consumer_data);die();

        if ($authenticate == 1) {

            $customers_id = $request->customers_id;

            DB::table('devices')->where('user_id',$customers_id)->delete();


            $responseData = array('success' => '1', 'data' => '', 'message' => 'logged out successfully!');
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }


    public static function processregistration($request)
    {
        $customers_firstname = $request->customers_firstname;
        $customers_lastname = $request->customers_lastname;
        $email = $request->email;
        $password = $request->password;
        $customers_telephone = $request->customers_telephone;
        $customers_gender = $request->customers_gender; 
        $customers_dob =   $request->customers_dob;     
        $customers_info_date_account_created = date('y-m-d h:i:s');

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $validator = Validator::make($request->all(), [
                'customers_firstname' => 'required',
                'customers_lastname' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                'customers_telephone' => 'required',
                'customers_telephone' => 'required',
            ]);
            $errors = array();
            if ($validator->fails()){
                $e_index = 0;
                foreach($validator->errors()->messages() as $key=>$errorsmsges){
                    $errors[$e_index++] = $errorsmsges[0];                    
                }
            }
            
            if(count($errors)>0){
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Some paramters are missing.");
            }else{

            //check email existance
            $existUser = DB::table('users')->where('email', $email)->where('phone_verified','1')->get();

            if (count($existUser) > 0) {
                //response if email already exit
                $postData = array();
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address is already exist");
            } else {
                // delete unverified user
                DB::table('users')->where('email', $email)->where('phone_verified','1')->delete();
                //insert data into customer
                $customers_id = DB::table('users')->insertGetId([
                    'role_id' => 2,
                    'first_name' => $customers_firstname,
                    'last_name' => $customers_lastname,
                    'phone' => $customers_telephone,
                    'gender'=>  $customers_gender,
                    'email' => $email,
                    'dob'=> $request->customers_dob,
                    'loyalty_points'=>'0',
                    'api_token' => Str::random(80),
                    'password' => Hash::make($password),
                    'status' => '1',
                    'created_at' => date('y-m-d h:i:s'),
                ]);

                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $authController->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customers_id.$str;

                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

                $userData = DB::table('users')
                    ->where('users.id', '=', $customers_id)->where('status', '1')->get();
                $responseData = array('success' => '1', 'data' => $userData, 'message' => "Sign Up successfully!");
            }
        }

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function notify_me($request)
    {
        $device_id = $request->device_id;
        $is_notify = $request->is_notify;
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $devices = DB::table('devices')->where('device_id', $device_id)->get();
            if (!empty($devices[0]->customers_id)) {
                $customers = DB::table('users')->where('id', $devices[0]->customers_id)->get();

                if (count($customers) > 0) {

                    foreach ($customers as $customers_data) {

                        DB::table('devices')->where('user_id', $customers_data->customers_id)->update([
                            'is_notify' => $is_notify,
                        ]);
                    }

                }
            } else {

                DB::table('devices')->where('device_id', $device_id)->update([
                    'is_notify' => $is_notify,
                ]);
            }

            $responseData = array('success' => '1', 'data' => '', 'message' => "Notification setting has been changed successfully!");
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);

        return $categoryResponse;
    }

    public static function updatecustomerinfo($request)
    {
        $customers_id            			=   $request->customers_id;
        $customers_firstname            	=   $request->customers_firstname;
        $customers_lastname           		=   $request->customers_lastname;
        $customers_telephone          		=   $request->customers_telephone;
        $customers_gender          		   	=   $request->customers_gender;
        $customers_dob          		   	=   $request->customers_dob;
        $customers_info_date_account_last_modified 	=   date('y-m-d h:i:s');
        $consumer_data 		 				  =  array();
        $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
        $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  	  = request()->header('consumer-ip');
        $consumer_data['consumer_url']  	  =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if($authenticate==1){
        $cehckexist = DB::table('users')->where('id', $customers_id)->where('role_id', 2)->first();

        

            if($cehckexist){

                $customers_dob = $request->customers_dob;
                if( $customers_dob != '')
                {
                    if($cehckexist->dob == '')
                    {
                        $customers_dob=$request->customers_dob;
                        $dob_created_date = date('Y-m-d');
                    }
                    else
                    {
                        $customers_dob=$request->customers_dob;
                        $dob_created_date = $cehckexist->dob_created_date;
                    }

                }
                else
                {
                    $dob_created_date = "";
                }

                $customer_data = array(
                    'role_id' => 2,
                    'first_name'			 =>  $customers_firstname,
                    'last_name'			 =>  $customers_lastname,
                    'phone'			 =>  $customers_telephone,
                    'dob_created_date' => $dob_created_date,
                    'gender'				 =>  $customers_gender,
                    'dob'					 =>  $customers_dob,
                );


            //update into customer
            DB::table('users')->where('id', $customers_id)->update($customer_data);

            DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified'   =>   $customers_info_date_account_last_modified]);

            $userData = DB::table('users')
                ->select('users.*')->where('users.id', '=', $customers_id)->where('status', '1')->get();

            $responseData = array('success'=>'1', 'data'=>$userData, 'message'=>"Customer information has been Updated successfully");


            }else{
            $responseData = array('success'=>'3', 'data'=>array(),  'message'=>"Record not found.");
            }

        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

    public static function updateMyEmail($request)
    {
        $customers_id            			=   $request->customers_id;
        $customers_email          		   	=   $request->email;
        
        $consumer_data 		 				  =  array();
        $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
        $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  	  = request()->header('consumer-ip');
        $consumer_data['consumer_url']  	  =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if($authenticate==1){
            $check = DB::table('users')
          ->where('email','=', $customers_email)
          ->where('role_id','=', '2')
          ->where('phone_verified','=', '1')
          ->first(); 
          if(empty($check)){
           
            DB::table('users')->where('id', $customers_id)->update([
                'email' => $customers_email ]);
            $responseData = array('success'=>'1', 'data'=>$customers_email, 'message'=>"Your Email Address Successfully Updated");
          }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Email Address Already taken");
            
          } 

        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }


    public static function updatepassword($request)
    {
    $customers_id            					=   $request->customers_id;
    $customers_info_date_account_last_modified 	=   date('y-m-d h:i:s');
    $consumer_data 		 				  =  array();
    $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
    $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
    $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
    $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
    $consumer_data['consumer_ip']  	  = request()->header('consumer-ip');
    $consumer_data['consumer_url']  	  =  __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);


    if($authenticate==1){
        $cehckexist = DB::table('users')->where('id', $customers_id)->where('role_id', 2)->first();
            if($cehckexist){
                $oldpassword    = $request->oldpassword;
                $newPassword    = $request->newpassword;

                $content = DB::table('users')->where('id', $customers_id)->first();

                $customerInfo = array("email" => $cehckexist->email, "password" => $oldpassword);

                if (Auth::attempt($customerInfo)) {

                    DB::table('users')->where('id', $customers_id)->update([
                    'password'			 =>  Hash::make($newPassword)
                    ]);

                    //get user data
                    $userData = DB::table('users')
                        ->select('users.*')
                        ->where('users.id', '=', $customers_id)->where('status', '1')->get();
                    $responseData = array('success'=>'1', 'data'=>$userData, 'message'=>"Information has been Updated successfully");
                }else{
                    $responseData = array('success'=>'2', 'data'=>array(),  'message'=>"current password does not match.");
                }
        }else{
            $responseData = array('success'=>'3', 'data'=>array(),  'message'=>"Record not found.");
        }

        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }

        $userResponse = json_encode($responseData);
        return $userResponse;
    }

    public static function processforgotpassword($request)
    {

        $email = $request->email;
        $postData = array();

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) 
        {

            //check email exist
            $existUser = DB::table('users')->where('email', $email)->get();

            $exitsociallogin = DB::table('customers')->where('user_id', $existUser[0]->id)->first();
            if($exitsociallogin == '')
            {
                if (count($existUser) > 0) 
                {
                    $cdate = date('Y-m-d');

                    
                  
                    $ipaddress = $request->ipaddress;
                    if($ipaddress =='')
                    {
                        $user_ip = static::get_client_ip();
                    }
                    else
                    {
                        $user_ip = $ipaddress;
                    }
                    
                    $user_id = DB::table('user_ip_email')->where('ip', $user_ip)->where('email', $existUser[0]->email)->whereDate('created_at',$cdate)->get();
                    $count = count($user_id);
                
                    if($count < 5)
                    {
                        $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);

                        DB::table('users')->where('email', $email)->update([
                            'password' => Hash::make($password),
                        ]);

                        $existUser[0]->password = $password;

                        $myVar = new AlertController();
                        //$alertSetting = $myVar->forgotPasswordAlert($existUser);

                        $setting = $authController->getSetting();
                        $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();

                        if($forgot_email != '')
                        {
            
                            $app_name =$setting['app_name'];
                            $order_email =$setting['order_email'];
                            $from = $app_name. "<".$order_email.">";
                
                        
                            $to = $email;
                        
                            $bcc = '';
                            $api_key = $setting['mail_chimp_api'];
                            $domain = $setting['mail_chimp_list_id'];
                            $subject = 'Forget Password';
                
                            $date = date('Y-m-d H:i:s');
                            DB::table('user_ip_email')->insert([
                                'ip' => $user_ip,
                                'email' => $existUser[0]->email,
                                'created_at' => $date,
                            ]);
                
                            $html =  '<div style="width: 100%; display:block;"><h2>'.$app_name.' Password Recovery</h2><p><strong>Hi '.$existUser[0]->first_name.' '.$existUser[0]->last_name.' !</strong><br>You have recently requested to recover your password.<br>Your password is: <strong>'.$password.'</strong><br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>'
                            ;
                
                    
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
                
                        }
                            $responseData = array('success' => '1', 'data' => $postData, 'message' => "Your password has been sent to your email address.");
                    }
                    else 
                    {
                        $responseData = array('success' => '0', 'data' => $postData, 'message' => "Tried more than Five times  please try again later"); 
                        
                    }
                } 
                else {
                    $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address doesn't exist!"); 
                }
            } 
            else {
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Social login password not able to change");
            }
        }
        else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function facebookregistration($request)
    {
        require_once app_path('vendor/autoload.php');
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            //get function from other controller
            $myVar = new AppSettingController();
            $setting = $myVar->getSetting();

            $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            $access_token = $request->access_token;

            $fb = new \Facebook\Facebook([
                'app_id' => $setting['facebook_app_id'],
                'app_secret' => $setting['facebook_secret_id'],
                'default_graph_version' => 'v2.2',
            ]);

            try {
                $response = $fb->get('/me?fields=id,name,email,first_name,last_name,gender,public_key', $access_token);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
            }

            $user = $response->getGraphUser();

           

            $fb_id = $user['id'];
            $customers_firstname = $user['first_name'];
            $customers_lastname = $user['last_name'];
            $name = $user['name'];
            if (empty($user['gender']) or $user['gender'] == 'male') {
                $customers_gender = '0';
            } else {
                $customers_gender = '1';
            }
        
            if (!empty($user['email'])) {
                $email = $user['email'];
            } else {
                $email = '';
            }
           
            //user information
            $fb_data = array(
                'fb_id' => $fb_id,
            );
       
            $customer_data = array(
                'role_id' => 2,
                'first_name' => $customers_firstname,
                'last_name' => $customers_lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'status' => '1',
                'api_token' => Str::random(80),
                'created_at' => date('Y-m-d H:i:s'),
            );

          

           $existUser = DB::table('customers')->where('fb_id', '=', $fb_id)->get();
          
           //$existUser = DB::table('users')->where('email', '=', $email)->get();
            if (count($existUser) > 0) {

                $customers_id = $existUser[0]->user_id;
                $success = "2";
                $message = "Customer record has been updated.";
                //update data of customer
                DB::table('customers')->where('user_id', '=', $customers_id)->update($fb_data);
               
            } else {
                $success = "1";
                $message = "Customer account has been created.";
                //insert data of customer
                $customers_id = DB::table('users')->insertGetId($customer_data);

                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $authController->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customers_id.$str;
                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

                DB::table('customers')->insertGetId([
                    'fb_id' => $fb_id,
                    'user_id' => $customers_id,

                ]);

            }

            $userData = DB::table('users')->where('id', '=', $customers_id)->get();
            //print_r($customers_id);die();
            //update record of customers_info
            $existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
            $customers_info_id = $customers_id;
            $customers_info_date_of_last_logon = date('Y-m-d H:i:s');
            $customers_info_number_of_logons = '1';
            $customers_info_date_account_created = date('Y-m-d H:i:s');
            $global_product_notifications = '1';

            if (count($existUserInfo) > 0) {
                //update customers_info table
                DB::table('customers_info')->where('customers_info_id', $customers_info_id)->update([
                    'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                    'global_product_notifications' => $global_product_notifications,
                    'customers_info_number_of_logons' => DB::raw('customers_info_number_of_logons + 1'),
                ]);

            } else {
                //insert customers_info table
                $customers_default_address_id = DB::table('customers_info')->insertGetId([
                    'customers_info_id' => $customers_info_id,
                    'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                    'customers_info_number_of_logons' => $customers_info_number_of_logons,
                    'customers_info_date_account_created' => $customers_info_date_account_created,
                    'global_product_notifications' => $global_product_notifications,
                ]);

            }

            //check if already login or not
            $already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();
            if (count($already_login) > 0) {
                DB::table('whos_online')
                    ->where('customer_id', $customers_id)
                    ->update([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                DB::table('whos_online')
                    ->insert([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                        'customer_id' => $customers_id,
                    ]);
            }

            $responseData = array('success' => $success, 'data' => $userData, 'message' => $message);
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }



    public static function googleregistration($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            //gmail user information
            $access_token = $request->idToken;
            $google_id = $request->userId;
            $customers_firstname = $request->givenName;
            $customers_lastname = $request->familyName;
            $email = $request->email;

            //user information
            $google_data = array(
                'google_id' => $google_id,
            );

            $customer_datas = array(
                'role_id' => 2,
                'first_name' => $customers_firstname,
                'last_name' => $customers_lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'status' => '1',
                'api_token' => Str::random(80),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $customer_data = array(
                'role_id' => 2,
                'first_name' => $customers_firstname,
                'last_name' => $customers_lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            );

            $existUser = DB::table('users')->where('email', '=', $email)->get();
            if (count($existUser) > 0) {
                $customers_id = $existUser[0]->id;
                DB::table('users')->where('id', $customers_id)->update($customer_data);
            } else {
                //insert data into customer
                $customers_id = DB::table('users')->insertGetId($customer_datas);

                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $authController->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customers_id.$str;

                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

                DB::table('customers')->insertGetId([
                    'google_id' => $google_id,
                    'user_id' => $customers_id,
                ]);

            }

            $userData = DB::table('users')->where('id', '=', $customers_id)->get();

            //update record of customers_info
            $existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
            $customers_info_id = $customers_id;
            $customers_info_date_of_last_logon = date('Y-m-d H:i:s');
            $customers_info_number_of_logons = '1';
            $customers_info_date_account_created = date('Y-m-d H:i:s');
            $customers_info_date_account_last_modified = date('Y-m-d H:i:s');
            $global_product_notifications = '1';

            if (count($existUserInfo) > 0) {
                $success = '2';
            } else {
                //insert customers_info table
                $customers_default_address_id = DB::table('customers_info')->insertGetId(
                    [
                        'customers_info_id' => $customers_info_id,
                        'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                        'customers_info_number_of_logons' => $customers_info_number_of_logons,
                        'customers_info_date_account_created' => $customers_info_date_account_created,
                        'global_product_notifications' => $global_product_notifications,
                    ]
                );
                $success = '1';
            }

            //check if already login or not
            $already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();

            if (count($already_login) > 0) {
                DB::table('whos_online')
                    ->where('customer_id', $customers_id)
                    ->update([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                    ]);
            } else {

                DB::table('whos_online')
                    ->insert([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                        'customer_id' => $customers_id,
                    ]);
            }

            //$userData = $request->all();
            $responseData = array('success' => $success, 'data' => $userData, 'message' => "Login successfully");
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }

    public static function appleregistration($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
             $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
              //apple user information
             $apple_id = $request->userId;
             $customers_firstname = $request->firstname;
             $customers_lastname = $request->lastname;
             $email = $request->email;

             //user information
            $apple_data = array(
                'apple_id' => $apple_id,
            );

            $customer_data = array(
                'role_id' => 2,
                'first_name' => $customers_firstname,
                'last_name' => $customers_lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'check_password'=>$password,
                'api_token' => Str::random(80),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            );
            $customer_datas = array(
                'role_id' => 2,
                'first_name' => $customers_firstname,
                'last_name' => $customers_lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'check_password'=>$password,
                'api_token' => Str::random(80),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            );
            $existUser = DB::table('customers')->where('apple_id', '=', $apple_id)->get();
            
             if (count($existUser) > 0) {
                //$existUser = DB::table('users')->where('email', '=', $email)->get();
                $customers_id = $existUser[0]->user_id;
                //DB::table('users')->where('id', $customers_id)->update($customer_data);
             }else{
                //insert data into customer
                $customers_id = DB::table('users')->insertGetId($customer_datas);

                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $authController->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customers_id.$str;

                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);
                
                DB::table('customers')->insertGetId([
                    'apple_id' => $apple_id,
                    'user_id' => $customers_id,
                ]);
             }
             $userData = DB::table('users')->where('id', '=', $customers_id)->get();
             //update record of customers_info
              $existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
              $customers_info_id = $customers_id;
              $customers_info_date_of_last_logon = date('Y-m-d H:i:s');
              $customers_info_number_of_logons = '1';
              $customers_info_date_account_created = date('Y-m-d H:i:s');
              $customers_info_date_account_last_modified = date('Y-m-d H:i:s');
              $global_product_notifications = '1';

              if (count($existUserInfo) > 0) {
                $success = '2';
              }else{
                 //insert customers_info table
                $customers_default_address_id = DB::table('customers_info')->insertGetId(
                    [
                        'customers_info_id' => $customers_info_id,
                        'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                        'customers_info_number_of_logons' => $customers_info_number_of_logons,
                        'customers_info_date_account_created' => $customers_info_date_account_created,
                        'global_product_notifications' => $global_product_notifications,
                    ]
                );
                $success = '1';
              }

              //check if already login or not
              $already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();
               if (count($already_login) > 0) {
                    DB::table('whos_online')
                    ->where('customer_id', $customers_id)
                    ->update([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                    ]);
               }else{
                 DB::table('whos_online')
                    ->insert([
                        'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                        'time_entry' => date('Y-m-d H:i:s'),
                        'customer_id' => $customers_id,
                    ]);
               }
            //$userData = $request->all();
            $responseData = array('success' => $success, 'data' => $userData, 'message' => "Login successfully");
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }

    public static function registerdevices($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $myVar = new AppSettingController();
            $setting = $myVar->getSetting();

            $device_type = $request->device_type;

            if ($device_type == 'iOS') { /* iphone */
                $type = 1;
            } elseif ($device_type == 'Android') { /* android */
                $type = 2;
            } elseif ($device_type == 'Desktop') { /* other */
                $type = 3;
            }

            if (!empty($request->customers_id)) {

                $device_data = array(
                    'device_id' => $request->device_id,
                    'device_type' => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'ram' => $request->ram,
                    'status' => '1',
                    'processor' => $request->processor,
                    'device_os' => $request->device_os,
                    'location' => $request->location,
                    'device_model' => $request->device_model,
                    'user_id' => $request->customers_id,
                    'manufacturer' => $request->manufacturer,
                );

            } else {

                $device_data = array(
                    'device_id' => $request->device_id,
                    'device_type' => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => '1',
                    'ram' => $request->ram,
                    'processor' => $request->processor,
                    'device_os' => $request->device_os,
                    'location' => $request->location,
                    'device_model' => $request->device_model,
                    'manufacturer' => $request->manufacturer,
                );

            }

        //check device exist
        $device_id = DB::table('devices')->where('device_id', '=', $request->device_id)->get();

            if (count($device_id) > 0) {

                $dataexist = DB::table('devices')->where('device_id', '=', $request->device_id)->where('user_id', '==', '0')->get();

                DB::table('devices')
                    ->where('device_id', $request->device_id)
                    ->update($device_data);

                if (count($dataexist) >= 0) {
                    $userData = DB::table('users')->where('id', '=', $request->customers_id)->get();
                    //notification
                    $myVar = new AlertController();
                    //$alertSetting = $myVar->createUserAlert($userData);
                }
            } else {
                $device_id = DB::table('devices')->insertGetId($device_data);
            }

            $responseData = array('success' => '1', 'data' => array(), 'message' => "Device is registered.");
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }



    public static function registerdevicesnew($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $myVar = new AppSettingController();
            $setting = $myVar->getSetting();

            $device_type = $request->device_type;

            if ($device_type == 'iOS') { /* iphone */
                $type = 1;
            } elseif ($device_type == 'Android') { /* android */
                $type = 2;
            } elseif ($device_type == 'Desktop') { /* other */
                $type = 3;
            }

            $customers_id = $request->customers_id;
            $existUserDevice = DB::table('devices')
                    ->where('user_id', $customers_id)->get();

                    if (count($existUserDevice)>0) {

                        DB::table('devices')
                        ->where('user_id', $customers_id)->update([
                            'device_id'  	=> $request->device_id,
                           ]);
                      

                    }
                    else
                    {
                                       
                        DB::table('devices')->insertGetId(
                            [	'device_id' => $request->device_id,
                                'device_type' => $type,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'status' => '1',
                                'user_id'  		=>  $customers_id,
                                'ram' => $request->ram,
                                'processor' => $request->processor,
                                'device_os' => $request->device_os,
                                'location' => $request->location,
                                'device_model' => $request->device_model,
                                'manufacturer' => $request->manufacturer,
                            ]
                        );
                    }

            $responseData = array('success' => '1', 'data' => array(), 'message' => "Device is registered.");
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);

        return $userResponse;
    }
    
    public static function sendotp($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->customers_id == ''|| $request->phone == ''|| $request->country_code == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $check=DB::table('otp')->where('phone', '=', $request->phone)->where('otp_status', '=', '1')->first();
                if($check){
                    $responseData = array('success'=>'0','message'=>"Phone number already exist");
                }else{
                    $digits = 4;
                    $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                    $date = date('y-m-d h:i:s');
                     // insert otp
                      DB::table('otp')->insert([
                        'user_id' => $request->customers_id,
                        'ccode' => $request->country_code,
                        'phone' => $request->phone,
                        'otp_no' => $otpresult,
                        'otp_status' => 0,
                        'created_at' => $date,
                    ]);
                     
                    $sdata=[
                        'customers_id' => $request->customers_id,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'otp_no' => $otpresult 
                    ];
                    $phone = $request->phone;
                    $ipaddress = $request->ipaddress;
                    if($ipaddress =='')
                    {
                        $user_ip = static::get_client_ip();
                    }
                    else
                    {
                        $user_ip = $ipaddress;
                    }
                    $cdate = date('Y-m-d');
                    $exit_user = DB::table('otp')->where('phone', $phone)->first();
                    
                    
                    if($exit_user != '')
                    {
                    $user_id = DB::table('user_ip')->where('user_ip', $user_ip)->where('user_id', $exit_user->user_id)->whereDate('created_at','=',$cdate)->get();
                    $count = count($user_id);
                    }
                    else
                    {
                        $count = 1;
                    }
                  
                   
                  if($count < 5)
                  {
                    
                    $date = date('Y-m-d H:i:s');
                    DB::table('user_ip')->insert([
                        'user_id' => $exit_user->user_id,
                        'user_ip' => $user_ip,
                        'type' => 'otp',
                        'created_at' => $date,
                    ]);
            
            
                    // send otp
                    $otpresult=$authController->otp($request->phone,$otpresult,$request->country_code);
                    $responseData = array('success'=>'1','message'=>"Otp sent successfully","data"=>$sdata); 
                }
                else
                {
                    $responseData = array('success'=>'0','message'=>"“Tried many times “ please try again later.","data"=>array()); 
                }
                    //$otpresult=$this->otp('9789715849',$otpresult,'91');
                   
                }
            }
        }else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;

    }

    public static function resendotp($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
         if ($authenticate == 1) {
            if($request->customers_id == ''|| $request->phone == ''|| $request->country_code == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $check=DB::table('otp')->where('phone', '=', $request->phone)->where('otp_status', '=', '1')->first();
                if($check){
                    $responseData = array('success'=>'0','message'=>"Phone number already exist");
                }else{
                    $digits = 4;
                    $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                    $date = date('y-m-d h:i:s');
                    // delete old otp
                    DB::table('otp')->where('user_id', '=', $request->customers_id)->where('phone', '=', $request->phone)->delete();
                    // insert otp
                      DB::table('otp')->insert([
                        'user_id' => $request->customers_id,
                        'ccode' => $request->country_code,
                        'phone' => $request->phone,
                        'otp_no' => $otpresult,
                        'otp_status' => 0,
                        'created_at' => $date,
                    ]);
                     $sdata=[
                        'customers_id' => $request->customers_id,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'otp_no' => $otpresult 
                    ];

                    $phone = $request->phone;
                    $ipaddress = $request->ipaddress;
                    if($ipaddress =='')
                    {
                        $user_ip = static::get_client_ip();
                    }
                    else
                    {
                        $user_ip = $ipaddress;
                    }

                    $cdate = date('Y-m-d');
                    $exit_user = DB::table('otp')->where('phone', $phone)->first();
                    
                   
                    if($exit_user != '')
                    {
                    $user_id = DB::table('user_ip')->where('user_ip', $user_ip)->where('user_id', $exit_user->user_id)->whereDate('created_at','=',$cdate)->get();
                    $count = count($user_id);
                    }
                    else
                    {
                        $count = 1;
                    }
                  
                   
                  if($count < 5)
                  {
                    
                    $date = date('Y-m-d H:i:s');
                    DB::table('user_ip')->insert([
                        'user_id' => $exit_user->user_id,
                        'user_ip' => $user_ip,
                        'type' => 'otp',
                        'created_at' => $date,
                    ]);
            
            
                    // send otp
                    $otpresult=$authController->otp($request->phone,$otpresult,$request->country_code);
                    $responseData = array('success'=>'1','message'=>"Otp send successfully","data"=>$sdata); 
                }
                else
                {
                    $responseData = array('success'=>'0','message'=>"“Tried many times “ please try again later.","data"=>array()); 
                }


                }
            }
         }else{
           $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call."); 
         }

         $userResponse = json_encode($responseData);
         return $userResponse;
    }
    public static function otpverification($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->customers_id == ''|| $request->phone == ''|| $request->country_code == '' || $request->otp==''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $check=DB::table('otp')->where('user_id', '=', $request->customers_id)->where('phone', '=', $request->phone)->where('otp_no', '=', $request->otp)->where('otp_status', '=', '0')->first();
              if($check){
                $date = date('y-m-d h:i:s');
                 $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '2')->first();
                 $level = DB::table('member_type')->where('id', '1')->first();
                    // update otp table
                    DB::table('otp')->where('id', $check->id)->update([
                            'otp_status' => '1'
                    ]);
                    // // update user table
                    DB::table('users')->where('id', $request->customers_id)->update([
                            'phone_verified' => '1',
                            'country_code'=>$request->country_code,
                            'phone'=>$request->phone
                    ]);
                
                $setting = $authController->getSetting();


                $create_customer_email = DB::table('alert_settings')->where('create_customer_email', 1)->first();

                if($create_customer_email != '')
                {
                    $existUser = DB::table('users')->where('id', $request->customers_id)->first();
                    $app_name =$setting['app_name'];
                    $order_email =$setting['order_email'];
                    $from = $app_name. "<".$order_email.">";
                    $to = $setting['contact_us_email'];
                    $bcc = $existUser->email;
                    $api_key = $setting['mail_chimp_api'];
                    $domain = $setting['mail_chimp_list_id'];
                    $subject = $setting['newuser_subject'];
                    $body = $setting['newuser_template_body'];
                    
                    $website_link = $setting['external_website_link'];

                    $imagepath = DB::table('image_categories')->where('path', '=', $setting['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                    if($imagepath->path_type == 'aws')
                    {
                        $imgurl = $setting['website_logo'];
                    }
                    else
                    {
                        $imgurl = $website_link.$setting['website_logo'];
                    }

                    $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center"><img src="'.$imgurl .'" alt="'.$app_name.'"></div><div style="background: white;padding: 15px;margin-top: 35px;"><p>'.stripslashes($body).'</p></div></div>';
        
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
                }
                $userData = DB::table('users')->where('id', $request->customers_id)->get();

                $myVar = new AlertController();
                $alertSetting = $myVar->createUserAlert($userData);



               //update user create point
                if($setting['Loyalty']=='1'){
                    if($point){
                       $authController->insert_point($request->customers_id,$point->points,$date);
                    }
                }
                // update user level
                if($setting['Membertype']=='1' && $setting['Loyalty']=='1'){
                    if($level){
                       $authController->update_level($request->customers_id,$level->id,$date);  
                    }
                }
                $sdata=[
                        'customers_id' => $request->customers_id,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone
                    ];
                $responseData = array('success'=>'1','message'=>"Otp updated successfully","data"=>$sdata);
     
              }else{
                $responseData = array('success'=>'0','message'=>"Invalid otp code");
              }  
            } 
        }else{
          $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");   
        }
        $userResponse = json_encode($responseData);
         return $userResponse; 
    }

    public static function pointshistory($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->customers_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $user = DB::table('users')->where('id', $request->customers_id)->where('phone_verified', '1')->first();
               if($user){
                    $result = DB::table('transaction_points')->where('user_id', $request->customers_id)->orderBy('id', 'DESC' )->get();
                    if(!empty($result)){
                         $responseData = array('success'=>'1','message'=>"Returned all transaction.","data"=>$result);
                    }else{
                       $responseData = array('success'=>'0','message'=>"No data found"); 
                    }
               }else{
                $responseData = array('success'=>'0','message'=>"Invalid customers id");
               } 
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
         return $userResponse; 
    }

    public static function getprofile($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->customers_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user = DB::table('users')->where('id', $request->customers_id)->where('phone_verified', '1')->first();
                if($user != '')
                {
                    $level_id = $user->users_level;

                    $user_level = DB::table('member_type')->where('id', $level_id)->where('status', '1')->first();
                        if($user_level != '')
                        {
                            $user_name = $user_level->member_type_name;
                        }
                        else
                        {
                            $user_name = 'Normal';
                        }
                }


                if($user){
                    $responseData = array('success'=>'1','message'=>"Returned user data.","data"=>$user,"user_level"=>$user_name);
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid customers id");
                }
            }
        }else{
           $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call."); 
        }
        $userResponse = json_encode($responseData);
         return $userResponse; 
    }
    public static function addcustomer($request)
    {
        $customers_firstname = $request->customers_firstname;
        $customers_lastname = $request->customers_lastname;
        $email = $request->email;
        $password = $request->password;
        $customers_telephone = $request->customers_telephone;
        $country_code=$request->country_code;
        $customers_gender = $request->customers_gender; 
        $customers_dob =   $request->customers_dob;
        $customers_address =   $request->customers_address;
        $country =   $request->country;
        $state =   $request->state;
        $city =   $request->city;
        $postal_code =   $request->postal_code;     
        $customers_info_date_account_created = date('y-m-d h:i:s');

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {

            $validator = Validator::make($request->all(), [
                'customers_firstname' => 'required',
                'customers_lastname' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                'customers_telephone' => 'required',
                'country_code' => 'required',
                'customers_address' => 'required',
                'postal_code' => 'required',
            ]);
            $errors = array();
            if ($validator->fails()){
                $e_index = 0;
                foreach($validator->errors()->messages() as $key=>$errorsmsges){
                    $errors[$e_index++] = $errorsmsges[0];                    
                }
            }
            
            if(count($errors)>0){
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Some paramters are missing.");
            }else{

            //check email existance
            $existUser = DB::table('users')->where('email', $email)->get();

            if (count($existUser) > 0) {
                //response if email already exit
                $postData = array();
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address is already exist");
            } else {

                //check phone existance
                $existPhone = DB::table('users')->where('phone', $customers_telephone)->get();
                if(count($existPhone) > 0){
                    $postData = array();
                    $responseData = array('success' => '0', 'data' => $postData, 'message' => "Phone number is already exist"); 
                }else{
                    //insert data into customer
                    $customers_id = DB::table('users')->insertGetId([
                        'role_id' => 2,
                        'first_name' => $customers_firstname,
                        'last_name' => $customers_lastname,
                        'phone' => $customers_telephone,
                         'country_code'=>$country_code,
                        'gender'=>  $customers_gender,
                        'email' => $email,
                        'api_token' => Str::random(80),
                        'dob'=> $request->customers_dob,
                        'loyalty_points'=>'0',
                        'password' => Hash::make($password),
                        'status' => '1',
                        'phone_verified'=>'1',
                        'created_at' => date('y-m-d h:i:s'),
                    ]);

                    // add address
                     $address_book_data = array(
                    'entry_firstname' => $customers_firstname,
                    'entry_lastname' => $customers_lastname,
                    'entry_street_address' => $customers_address,
                    'entry_postcode' => $postal_code,
                    'entry_city' => $city,
                    'entry_country_id' => $country,
                    'entry_phone'=> $customers_telephone,
                    'entry_zone_id' => $state,
                    'user_id' => $customers_id,
                 );
                    $address_book_id = DB::table('address_book')->insertGetId($address_book_data);

                     DB::table('user_to_address')->insertGetId(['user_id' => $customers_id, 'address_book_id' => $address_book_id, 'is_default' => '1']);

                    $userData = DB::table('users')
                        ->where('users.id', '=', $customers_id)->where('status', '1')->get();
                    $responseData = array('success' => '1', 'data' => $userData, 'message' => "Sign Up successfully!");
                }
            }
        }

        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }
    
    public static function editcustomer($request)
    {
        $customers_firstname = $request->customers_firstname;
        $customers_lastname = $request->customers_lastname;
        $email_new = $request->email;
        $customers_telephone = $request->customers_telephone;
        $country_code = $request->country_code;
        $customers_gender = $request->customers_gender; 
        $customers_dob =   $request->customers_dob;     
        $customers_info_date_account_created = date('y-m-d h:i:s');
        $customers_id = $request->customers_id;
        $address_book_id = $request->address_book_id;
        $customers_address =  $request->customers_address;
        $country =   $request->country;
        $state =   $request->state;
        $city =   $request->city;
        $postal_code = $request->postal_code;

        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

         if ($authenticate == 1) {

            $validator = Validator::make($request->all(), [
                'customers_firstname' => 'required',
                'customers_lastname' => 'required',
                'email_new' => 'required | email',
                'customers_telephone' => 'required',
                'customers_id' => 'required',
                'country_code' => 'required',
                'customers_address' => 'required',
                'postal_code' => 'required',
                'address_book_id'=> 'required',
            ]);
             $errors = array();
              if ($validator->fails()){
                $e_index = 0;
                foreach($validator->errors()->messages() as $key=>$errorsmsges){
                    $errors[$e_index++] = $errorsmsges[0];                    
                }
            }
            if(count($errors)>0){
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Some paramters are missing.");
            }else{
              $user=DB::table('users')->where('id', $customers_id)->first();      
              if($user){
                $email=DB::table('users')->where('email','=', $email)
                    ->where('id','!=', $customers_id)
                    ->select('email')
                    ->first();

                $phone=DB::table('users')->where('phone','=', $customers_telephone)
                    ->where('id','!=', $customers_id)
                    ->select('phone')
                    ->first();
                if(empty($email)) {
                     if(empty($phone)){
                        // update user
                         DB::table('users')->where('id', $customers_id)->update([
                            'first_name' => $customers_firstname,
                            'last_name' => $customers_lastname,
                            'phone' => $customers_telephone,
                            'country_code'=>$country_code,
                            'gender'=>  $customers_gender,
                            'email' => $email_new,
                            'dob'=> $request->customers_dob,
                        ]);
                         // update address
                         DB::table('address_book')->where('address_book_id', $address_book_id)->update([
                            'entry_firstname' => $customers_firstname,
                            'entry_lastname' => $customers_lastname,
                            'entry_street_address' => $customers_address,
                            'entry_postcode' => $postal_code,
                            'entry_city' => $city,
                            'entry_country_id' => $country,
                            'entry_phone'=> $customers_telephone,
                            'entry_zone_id' => $state,
                            'user_id' => $customers_id,
                        ]);
                         $responseData = array('success' => '1', 'message' => "Customer updated successfully...");
                     }else{
                        $responseData = array('success' => '0', 'message' => "This phone is already taken");
                     }
                }else{
                     $responseData = array('success' => '0', 'message' => "This Email is already taken");
                }
              }else{
                 $responseData = array('success' => '0', 'message' => "Invalid customers id.");
              }

            }

         }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
         }

         $userResponse = json_encode($responseData);
         print $userResponse;
    }
    public static function deletecustomer($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->customers_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
            $user = DB::table('users')->where('id', $request->customers_id)->where('phone_verified', '1')->first();
            if($user){
               DB::table('users')->where('id', $request->customers_id)->delete();
               DB::table('user_to_address')->where('user_id', $request->customers_id)->delete();
               DB::table('address_book')->where('user_id', $request->customers_id)->delete();
                $responseData = array('success'=>'1','message'=>"Customer deleted successfully");
            }else{
               $responseData = array('success'=>'0','message'=>"Invalid customers id"); 
            }
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
         print $userResponse;
    }

    public static function customerlist($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
         if($authenticate == 1) {
              $getsetting=$authController->getSetting();
              $address=DB::table('address_book')->where('entry_company', $getsetting['app_name'])->get();
              if(count($address)=='0'){
                 // add address
                    $address_book_data = array(
                    'entry_firstname' => $getsetting['app_name'],
                    'entry_lastname' => $getsetting['app_name'],
                    'entry_company'=> $getsetting['app_name'],
                    'entry_street_address' => $getsetting['address'],
                    'entry_postcode' => $getsetting['zip'],
                    'entry_city' => $getsetting['city'],
                    'entry_country_id' => $getsetting['country'],
                    'entry_phone'=> $getsetting['phone_no'],
                    'entry_state' => $getsetting['state'],
                    'user_id' => '0',
                    'entry_latitude'=> $getsetting['latitude'],
                    'entry_longitude'=> $getsetting['longitude'],
                    );
                $address_book_id = DB::table('address_book')->insertGetId($address_book_data);
              }

              $user = DB::table('users')->where('role_id', '2')->where('phone_verified', '=', '1')->get();
              
              foreach ($user as $jesuser) {
                 $uaddress=DB::table('address_book')->where('user_id',$jesuser->id)->first();
                 if($uaddress){
                    $daddress=$uaddress;
                 }else{
                    $daddress=DB::table('address_book')->where('entry_company', $getsetting['app_name'])->first();
                 }
                 $country=DB::table('countries')->where('countries_id',$daddress->entry_country_id)->first();
                 $zone=DB::table('zones')->where('zone_id', $daddress->entry_zone_id)->first();
                 if($country){
                    $cname=$country->countries_name;
                 }else{
                    $cname='';
                 }
                 if($zone){
                    $zname=$zone->zone_name;
                 }else{
                    $zname='';
                 }
                 $dataall[]=array(
                     "id"=>$jesuser->id,
                     "first_name"=>$jesuser->first_name,
                     "last_name"=>$jesuser->last_name,
                     "gender"=>$jesuser->gender,
                     "country_code"=>$jesuser->country_code,
                     "phone"=>$jesuser->phone,
                     "email"=>$jesuser->email,
                     "status"=>$jesuser->status,
                     "phone_verified"=>$jesuser->phone_verified,
                     "loyalty_points"=>$jesuser->loyalty_points,
                     "users_level"=>$jesuser->users_level,
                     "member_id"=>$jesuser->member_id,
                     "wallet_amount"=>$jesuser->wallet_amount,
                     "dob"=>$jesuser->dob,
                     "address_book_id"=>$daddress->address_book_id,
                     "entry_firstname"=>$daddress->entry_firstname,
                     "entry_lastname"=>$daddress->entry_lastname,
                     "entry_street_address"=>$daddress->entry_street_address,
                     "entry_suburb"=>$daddress->entry_suburb,
                     "entry_postcode"=>$daddress->entry_postcode,
                     "entry_cc_code"=>$daddress->entry_cc_code,
                     "entry_phone"=>$daddress->entry_phone,
                     "entry_city"=>$daddress->entry_city,
                     "entry_state"=>$daddress->entry_state,
                     "entry_country_id"=>$daddress->entry_country_id,
                     "entry_zone_id"=>$daddress->entry_zone_id,
                     "entry_latitude"=>$daddress->entry_latitude,
                     "entry_longitude"=>$daddress->entry_longitude,
                     "country_name"=>$cname,
                     "zone_name"=>$zname
                    );
              }

            if (!$user->isEmpty()) {
                 $responseData = array('success'=>'1','message'=>"Returned all user list.","data"=>$dataall);
            }else{
               $responseData = array('success'=>'0','message'=>"No data found"); 
            }
         }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
         }
         $userResponse = json_encode($responseData);
         print $userResponse;
    }
    public static function adduseragent($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
            if($request->customers_id == '' || $request->device_type == '' || $request->device_version == '' || $request->device_ip == '' || $request->network_address == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $user = DB::table('users')->where('id', $request->customers_id)->where('phone_verified', '1')->first();
              if($user){
                  //insert data into customer
                    $id = DB::table('user_agent')->insertGetId([
                        'user_id' => $request->customers_id,
                        'device_type' => $request->device_type,
                        'device_version' => $request->device_version,
                        'device_ip' => $request->device_ip,
                        'network_address'=>$request->network_address,
                        'create_date' => date('y-m-d h:i:s'),
                    ]);
                    $responseData = array('success' => '1', 'message' => "User log added successfully...");
              }else{
                $responseData = array('success'=>'0','message'=>"You're not a customer.");
              }  
            }
        }else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
         print $userResponse;
    }

    public static function addGuest($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);


        if ($authenticate == 1) {
             $user = DB::table('users')->where('user_name','guest_user')->where('role_id', '2')->first();
             if($user){
                $userData = DB::table('users')
                     ->join('address_book','address_book.user_id','=','users.id')
                     ->where('users.id', '=', $user->id)->where('status', '1')->get();
             }else{
               //insert data into customer
                    $customers_id = DB::table('users')->insertGetId([
                        'user_name'=>'guest_user',
                        'role_id' => 2,
                        'first_name' =>'Guest',
                        'last_name' => 'User',
                        'phone' => '9876543210',
                        'country_code'=>'91',
                        'gender'=>  'Male',
                        'api_token' => Str::random(80),
                        'email' => 'guest@gmail.com',
                        'dob'=> date('y-m-d'),
                        'loyalty_points'=>'0',
                        'password' => Hash::make('guest_user'),
                        'check_password'=>'guest_user',
                        'status' => '1',
                        'phone_verified'=>'1',
                        'created_at' => date('y-m-d h:i:s'),
                    ]);
                    $getsetting=$authController->getSetting();
                     // add address
                     $address_book_data = array(
                    'entry_firstname' => 'Guest',
                    'entry_lastname' => 'User',
                    'entry_street_address' => $getsetting['address'],
                    'entry_postcode' => $getsetting['zip'],
                    'entry_city' => $getsetting['city'],
                    'entry_country_id' => $getsetting['country_id'],
                    'entry_phone'=> $getsetting['phone_no'],
                    'entry_state' => $getsetting['state'],
                    'user_id' => $customers_id,
                    'entry_latitude'=> $getsetting['latitude'],
                    'entry_longitude'=> $getsetting['longitude'],
                    );
                $address_book_id = DB::table('address_book')->insertGetId($address_book_data);
                DB::table('user_to_address')->insertGetId(['user_id' => $customers_id, 'address_book_id' => $address_book_id, 'is_default' => '1']);
                $userData = DB::table('users')
                     ->join('address_book','address_book.user_id','=','users.id')
                     ->where('users.id', '=', $customers_id)->where('status', '1')->get(); 
             }
             $responseData = array('success' => '1', 'data' => $userData, 'message' => "Sign Up successfully!");
        }else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
         print $userResponse;

    }

    public static function getPromotionalVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
            if($request->api_token == '' || $request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                    $check_date=date('Y-m-d');
                    $coupons = DB::table('coupons')
                     ->LeftJoin('image_categories', function ($join) {
                          $join->on('image_categories.image_id', '=', 'coupons.image')
                              ->where(function ($query) {
                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                              });
                        })
                    ->select('coupons.*', 'image_categories.path as coupons_image','image_categories.path_type')
                    ->where('discount_type','product')
                    ->where('coupans_type', 'external')
                    ->whereDate('expiry_date', '>', $check_date)
                    ->get();

                    if(!$coupons->isEmpty()){
                        foreach($coupons as $jescoupons){
                           $favourite = DB::table('tb_favourite')->where('voucherID',$jescoupons->coupans_id)->where('userID',$user->id)->where('status',1)->where('type','coupons')->first(); 
                           if($favourite){
                              $coupon_fav='active';
                           }else{
                              $coupon_fav='';
                           }

                           $couponsall[]=array(
                                "coupans_id"=> $jescoupons->coupans_id,
                                "code"=> $jescoupons->code,
                                "date_created"=> $jescoupons->date_created,
                                "date_modified"=> $jescoupons->date_modified,
                                "description"=> $jescoupons->description,
                                "discount_type"=> $jescoupons->discount_type,
                                "coupans_type"=> $jescoupons->coupans_type,
                                "amount"=> $jescoupons->amount,
                                "cap_amount"=> $jescoupons->cap_amount,
                                "expiry_date"=> $jescoupons->expiry_date,
                                "usage_count"=> $jescoupons->usage_count,
                                "individual_use"=> $jescoupons->individual_use,
                                "product_ids"=> $jescoupons->product_ids,
                                "exclude_product_ids"=> $jescoupons->exclude_product_ids,
                                "usage_limit"=> $jescoupons->usage_limit,
                                "usage_limit_per_user"=> $jescoupons->usage_limit_per_user,
                                "limit_usage_to_x_items"=> $jescoupons->limit_usage_to_x_items,
                                "free_shipping"=> $jescoupons->free_shipping,
                                "product_categories"=> $jescoupons->product_categories,
                                "excluded_product_categories"=> $jescoupons->excluded_product_categories,
                                "exclude_sale_items"=> $jescoupons->exclude_sale_items,
                                "minimum_amount"=> $jescoupons->minimum_amount,
                                "maximum_amount"=> $jescoupons->maximum_amount,
                                "email_restrictions"=> $jescoupons->email_restrictions,
                                "used_by"=> $jescoupons->used_by,
                                "image"=> $jescoupons->image,
                                "points"=> $jescoupons->points,
                                "products_id"=> $jescoupons->products_id,
                                "qrcode"=> $jescoupons->qrcode,
                                "created_at"=> $jescoupons->created_at,
                                "updated_at"=> $jescoupons->updated_at,
                                "coupons_image"=>$jescoupons->coupons_image,
                                "path_type"=>$jescoupons->path_type,
                                "favourite" => $coupon_fav
                           );
                        }
                    }
                    $point = DB::table('redeem_points_settings')
                            ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                            ->LeftJoin('image_categories', function ($join) {
                              $join->on('image_categories.image_id', '=', 'redeem_points_settings.image')
                                  ->where(function ($query) {
                                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                  });
                            })
                            ->select('redeem_points_settings.*', 'image_categories.path as coupons_image','image_categories.path_type','redeem_points_description.redeem_points_title','redeem_points_description.redeem_points_description')
                             ->where('redeem_points_settings.discount_type','product')
                             ->where('redeem_points_description.language_id',$request->language_id)
                             ->where('redeem_points_settings.status', 1)
                            ->groupBy('redeem_points_settings.id')
                             ->get();

                    if(!$point->isEmpty()){
                         foreach($point as $jespoint){
                           $favpoint = DB::table('tb_favourite')->where('voucherID',$jespoint->id)->where('userID',$user->id)->where('status',1)->where('type','points')->first(); 
                           if($favpoint){
                              $point_fav='active';
                           }else{
                              $point_fav='';
                           }
                           $pointall[]=array(
                                "id"=> $jespoint->id,
                                "discount_type"=> $jespoint->discount_type,
                                "cap_amount"=> $jespoint->cap_amount,
                                "points"=> $jespoint->points,
                                "no_rm"=> $jespoint->no_rm,
                                "products_id"=> $jespoint->products_id,
                                "qrcode"=> $jespoint->qrcode,
                                "status"=> $jespoint->status,
                                "created_at"=> $jespoint->created_at,
                                "updated_at"=> $jespoint->updated_at,
                                "coupons_image"=> $jespoint->coupons_image,
                                "path_type"=> $jespoint->path_type,
                                "redeem_points_title"=> $jespoint->redeem_points_title,
                                "redeem_points_description"=> $jespoint->redeem_points_description,
                                "favourite" => $point_fav
                           );

                         }
                    }

                    if(count($point)>0){
                        $vpoint=$pointall;
                    }else{
                        $vpoint=[];
                    }

                    if(count($coupons)>0){
                        $vcoupons=$couponsall;
                    }else{
                        $vcoupons=[];
                    }
                    $responseData = array('success' => '1', 'coupons' => $vcoupons, 'coupons_point'=> $vpoint, 'message' => "Returned all data");
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid api token"); 
                }
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getRewardsVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if ($authenticate == 1) {
           if($request->api_token == '' || $request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                        $point = DB::table('redeem_points_settings')
                                    ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                    ->LeftJoin('image_categories', function ($join) {
                                      $join->on('image_categories.image_id', '=', 'redeem_points_settings.image')
                                          ->where(function ($query) {
                                              $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                                  ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                                  ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                          });
                                    })
                                    ->select('redeem_points_settings.*', 'image_categories.path as coupons_image','image_categories.path_type','redeem_points_description.redeem_points_title','redeem_points_description.redeem_points_description')
                                     ->whereIn('redeem_points_settings.discount_type', ['percent', 'fixed_cart'])
                                     ->where('redeem_points_description.language_id',$request->language_id)
                                      ->where('redeem_points_settings.status', 1)
                                      ->groupBy('redeem_points_settings.id')
                                     ->get();

                        if(!$point->isEmpty()){
                         foreach($point as $jespoint){
                           $favpoint = DB::table('tb_favourite')->where('voucherID',$jespoint->id)->where('userID',$user->id)->where('status',1)->where('type','points')->first(); 
                           if($favpoint){
                              $point_fav='active';
                           }else{
                              $point_fav='';
                           }
                           $pointall[]=array(
                                "id"=> $jespoint->id,
                                "discount_type"=> $jespoint->discount_type,
                                "cap_amount"=> $jespoint->cap_amount,
                                "points"=> $jespoint->points,
                                "no_rm"=> $jespoint->no_rm,
                                "products_id"=> $jespoint->products_id,
                                "qrcode"=> $jespoint->qrcode,
                                "status"=> $jespoint->status,
                                "created_at"=> $jespoint->created_at,
                                "updated_at"=> $jespoint->updated_at,
                                "coupons_image"=> $jespoint->coupons_image,
                                "path_type"=> $jespoint->path_type,
                                "redeem_points_title"=> $jespoint->redeem_points_title,
                                "redeem_points_description"=> $jespoint->redeem_points_description,
                                "favourite" => $point_fav
                           );

                         }
                    }


                        if(count($point)>0){
                            $responseData = array('success' => '1', 'data' => $pointall, 'message' => "Returned all data");
                        }else{
                            $responseData = array('success'=>'0','message'=>"No data found");
                        }
                    }else{
                       $responseData = array('success'=>'0','message'=>"Invalid api token"); 
                    }
           } 
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }
    public static function getDiscountsVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $currentDate = date('Y-m-d');
        if($authenticate == 1){
            if($request->api_token == '' || $request->language_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                     $items=DB::table('coupons')
                        ->leftJoin('image_categories', 'coupons.image', '=', 'image_categories.image_id')
                         ->select('coupons.*', 'image_categories.path as image_path','image_categories.path_type as path_type')
                         ->whereIn('coupons.discount_type', ['percent', 'fixed_cart'])
                         ->whereDate('expiry_date','>',$currentDate)
                         ->where('coupans_type', 'internal')
                         ->groupBy('coupons.coupans_id')
                         ->get();

                         if(!$items->isEmpty()){
                        foreach($items as $jescoupons){
                           $favourite = DB::table('tb_favourite')->where('voucherID',$jescoupons->coupans_id)->where('userID',$user->id)->where('status',1)->where('type','coupons')->first(); 
                           if($favourite){
                              $coupon_fav='active';
                           }else{
                              $coupon_fav='';
                           }

                           $couponsall[]=array(
                                "coupans_id"=> $jescoupons->coupans_id,
                                "code"=> $jescoupons->code,
                                "date_created"=> $jescoupons->date_created,
                                "date_modified"=> $jescoupons->date_modified,
                                "description"=> $jescoupons->description,
                                "discount_type"=> $jescoupons->discount_type,
                                "coupans_type"=> $jescoupons->coupans_type,
                                "amount"=> $jescoupons->amount,
                                "cap_amount"=> $jescoupons->cap_amount,
                                "expiry_date"=> $jescoupons->expiry_date,
                                "usage_count"=> $jescoupons->usage_count,
                                "individual_use"=> $jescoupons->individual_use,
                                "product_ids"=> $jescoupons->product_ids,
                                "exclude_product_ids"=> $jescoupons->exclude_product_ids,
                                "usage_limit"=> $jescoupons->usage_limit,
                                "usage_limit_per_user"=> $jescoupons->usage_limit_per_user,
                                "limit_usage_to_x_items"=> $jescoupons->limit_usage_to_x_items,
                                "free_shipping"=> $jescoupons->free_shipping,
                                "product_categories"=> $jescoupons->product_categories,
                                "excluded_product_categories"=> $jescoupons->excluded_product_categories,
                                "exclude_sale_items"=> $jescoupons->exclude_sale_items,
                                "minimum_amount"=> $jescoupons->minimum_amount,
                                "maximum_amount"=> $jescoupons->maximum_amount,
                                "email_restrictions"=> $jescoupons->email_restrictions,
                                "used_by"=> $jescoupons->used_by,
                                "image"=> $jescoupons->image,
                                "points"=> $jescoupons->points,
                                "products_id"=> $jescoupons->products_id,
                                "qrcode"=> $jescoupons->qrcode,
                                "created_at"=> $jescoupons->created_at,
                                "updated_at"=> $jescoupons->updated_at,
                                "coupons_image"=>$jescoupons->image_path,
                                "path_type"=>$jescoupons->path_type,
                                "favourite" => $coupon_fav
                           );
                        }
                    }

                     if(!empty($items)){
                        $responseData = array('success' => '1', 'data' => $couponsall, 'message' => "Returned all data");
                      }else{
                        $responseData = array('success'=>'0','message'=>"No data found");
                      }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid api token");  
                }
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getActiveVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $check_date = date('Y-m-d');
        if($authenticate == 1){
            if($request->api_token == '' || $request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                   $coupons = DB::table('coupons')
                     ->LeftJoin('image_categories', function ($join) {
                          $join->on('image_categories.image_id', '=', 'coupons.image')
                              ->where(function ($query) {
                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                              });
                        })
                    ->select('coupons.*', 'image_categories.path as coupons_image','image_categories.path_type')
                    //->where('discount_type','product')
                    //->where('coupans_type', 'external')
                    ->whereDate('expiry_date', '>', $check_date)
                    ->get();
                    if(!$coupons->isEmpty()){
                        foreach($coupons as $jescoupons){
                           $favourite = DB::table('tb_favourite')->where('voucherID',$jescoupons->coupans_id)->where('userID',$user->id)->where('status',1)->where('type','coupons')->first(); 
                           if($favourite){
                              $coupon_fav='active';
                           }else{
                              $coupon_fav='';
                           }

                           $couponsall[]=array(
                                "coupans_id"=> $jescoupons->coupans_id,
                                "code"=> $jescoupons->code,
                                "date_created"=> $jescoupons->date_created,
                                "date_modified"=> $jescoupons->date_modified,
                                "description"=> $jescoupons->description,
                                "discount_type"=> $jescoupons->discount_type,
                                "coupans_type"=> $jescoupons->coupans_type,
                                "amount"=> $jescoupons->amount,
                                "cap_amount"=> $jescoupons->cap_amount,
                                "expiry_date"=> $jescoupons->expiry_date,
                                "usage_count"=> $jescoupons->usage_count,
                                "individual_use"=> $jescoupons->individual_use,
                                "product_ids"=> $jescoupons->product_ids,
                                "exclude_product_ids"=> $jescoupons->exclude_product_ids,
                                "usage_limit"=> $jescoupons->usage_limit,
                                "usage_limit_per_user"=> $jescoupons->usage_limit_per_user,
                                "limit_usage_to_x_items"=> $jescoupons->limit_usage_to_x_items,
                                "free_shipping"=> $jescoupons->free_shipping,
                                "product_categories"=> $jescoupons->product_categories,
                                "excluded_product_categories"=> $jescoupons->excluded_product_categories,
                                "exclude_sale_items"=> $jescoupons->exclude_sale_items,
                                "minimum_amount"=> $jescoupons->minimum_amount,
                                "maximum_amount"=> $jescoupons->maximum_amount,
                                "email_restrictions"=> $jescoupons->email_restrictions,
                                "used_by"=> $jescoupons->used_by,
                                "image"=> $jescoupons->image,
                                "points"=> $jescoupons->points,
                                "products_id"=> $jescoupons->products_id,
                                "qrcode"=> $jescoupons->qrcode,
                                "created_at"=> $jescoupons->created_at,
                                "updated_at"=> $jescoupons->updated_at,
                                "coupons_image"=>$jescoupons->coupons_image,
                                "path_type"=>$jescoupons->path_type,
                                "favourite" => $coupon_fav
                           );
                        }
                    }

                    $point = DB::table('redeem_points_settings')
                            ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                            ->LeftJoin('image_categories', function ($join) {
                              $join->on('image_categories.image_id', '=', 'redeem_points_settings.image')
                                  ->where(function ($query) {
                                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                  });
                            })
                            ->select('redeem_points_settings.*', 'image_categories.path as coupons_image','image_categories.path_type','redeem_points_description.redeem_points_title','redeem_points_description.redeem_points_description')
                             //->where('redeem_points_settings.discount_type','product')
                             ->where('redeem_points_description.language_id',$request->language_id)
                             ->where('redeem_points_settings.status', 1)
                             ->groupBy('redeem_points_settings.id')
                             ->get();

                         if(!$point->isEmpty()){
                         foreach($point as $jespoint){
                           $favpoint = DB::table('tb_favourite')->where('voucherID',$jespoint->id)->where('userID',$user->id)->where('status',1)->where('type','points')->first(); 
                           if($favpoint){
                              $point_fav='active';
                           }else{
                              $point_fav='';
                           }
                           $pointall[]=array(
                                "id"=> $jespoint->id,
                                "discount_type"=> $jespoint->discount_type,
                                "cap_amount"=> $jespoint->cap_amount,
                                "points"=> $jespoint->points,
                                "no_rm"=> $jespoint->no_rm,
                                "products_id"=> $jespoint->products_id,
                                "qrcode"=> $jespoint->qrcode,
                                "status"=> $jespoint->status,
                                "created_at"=> $jespoint->created_at,
                                "updated_at"=> $jespoint->updated_at,
                                "coupons_image"=> $jespoint->coupons_image,
                                "path_type"=> $jespoint->path_type,
                                "redeem_points_title"=> $jespoint->redeem_points_title,
                                "redeem_points_description"=> $jespoint->redeem_points_description,
                                "favourite" => $point_fav
                           );

                         }
                    }

                    if(count($point)>0){
                        $vpoint=$pointall;
                    }else{
                        $vpoint=[];
                    }

                    if(count($coupons)>0){
                        $vcoupons=$couponsall;
                    }else{
                        $vcoupons=[];
                    }
                    $responseData = array('success' => '1', 'coupons' => $vcoupons, 'coupons_point'=> $vpoint, 'message' => "Returned all data");

                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid api token"); 
                }
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }

    public static function getUseExpiredVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $check_date = date('Y-m-d');
        if($authenticate == 1){
            if($request->api_token == '' || $request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                    $coupons = DB::table('tb_usage_voucher_list')
                    ->leftJoin('coupons', 'coupons.coupans_id', '=', 'tb_usage_voucher_list.voucherID')
                     ->LeftJoin('image_categories', function ($join) {
                          $join->on('image_categories.image_id', '=', 'coupons.image')
                              ->where(function ($query) {
                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                              });
                        })
                    ->select('coupons.*', 'image_categories.path as coupons_image','image_categories.path_type')
                    ->where('tb_usage_voucher_list.userID', $user->id)
                    ->where('tb_usage_voucher_list.type', 'coupons')
                    ->get();

                    // get point

                    $point = DB::table('tb_usage_voucher_list')
                            ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'tb_usage_voucher_list.voucherID')
                            ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                            ->LeftJoin('image_categories', function ($join) {
                              $join->on('image_categories.image_id', '=', 'redeem_points_settings.image')
                                  ->where(function ($query) {
                                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                  });
                            })
                            ->select('redeem_points_settings.*', 'image_categories.path as coupons_image','image_categories.path_type','redeem_points_description.redeem_points_title','redeem_points_description.redeem_points_description')
                             //->where('redeem_points_settings.discount_type','product')
                             ->where('tb_usage_voucher_list.userID', $user->id)
                             ->where('tb_usage_voucher_list.type', 'points')
                             ->where('redeem_points_description.language_id',$request->language_id)
                             ->where('redeem_points_settings.status', 1)
                             ->groupBy('redeem_points_settings.id')
                             ->get();

                    //Expired
                       $expired=DB::table('coupons')
                             ->LeftJoin('image_categories', function ($join) {
                                  $join->on('image_categories.image_id', '=', 'coupons.image')
                                      ->where(function ($query) {
                                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                      });
                                })
                            ->select('coupons.*', 'image_categories.path as coupons_image','image_categories.path_type')
                            //->where('discount_type','product')
                            //->where('coupans_type', 'external')
                            ->whereDate('expiry_date', '<', $check_date)
                            ->get();
                    //print_r($expired);die();     

                    if(count($point)>0){
                        $vpoint=$point;
                    }else{
                        $vpoint=[];
                    }

                    if(count($coupons)>0){
                        $vcoupons=$point;
                    }else{
                        $vcoupons=[];
                    }

                    if(count($expired)>0){
                        $vexpired=$expired;
                    }else{
                        $vexpired=[];
                    }

                    $responseData = array('success' => '1', 'coupons' => $vpoint, 'coupons_point'=> $vcoupons, 'expired' =>$vexpired,'message' => "Returned all data");

                }else{
                  $responseData = array('success'=>'0','message'=>"Invalid api token");  
                }
            }
        }else{
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }
    public static function getFavouriteVoucher($request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1){
           if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
                $user = DB::table('users')->where('api_token',$request->api_token)->where('role_id', '2')->first();
                if($user){
                    $coupons=DB::table('tb_favourite')
                            ->leftJoin('coupons', 'coupons.coupans_id', '=', 'tb_favourite.voucherID')
                            ->LeftJoin('image_categories', function ($join) {
                                  $join->on('image_categories.image_id', '=', 'coupons.image')
                                      ->where(function ($query) {
                                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                      });
                                })
                            ->select('coupons.*', 'image_categories.path as coupons_image','image_categories.path_type')
                            ->where('tb_favourite.userID', $user->id)
                            ->where('tb_favourite.type', 'coupons')
                            ->get();

                     $point = DB::table('tb_favourite')
                              ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'tb_favourite.voucherID')
                              ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                              ->LeftJoin('image_categories', function ($join) {
                              $join->on('image_categories.image_id', '=', 'redeem_points_settings.image')
                                  ->where(function ($query) {
                                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                  });
                            })
                            ->select('redeem_points_settings.*', 'image_categories.path as coupons_image','image_categories.path_type','redeem_points_description.redeem_points_title','redeem_points_description.redeem_points_description')
                            ->where('tb_favourite.userID', $user->id)
                            ->where('tb_favourite.type', 'points')
                            ->groupBy('redeem_points_settings.id')
                            ->get();


                    if(count($coupons)>0){
                        $vcoupons=$coupons;
                    }else{
                        $vcoupons=[];
                    }

                    if(count($point)>0){
                        $vpoint=$point;
                    }else{
                        $vpoint=[];
                    }

                    $responseData = array('success' => '1', 'coupons' => $vcoupons, 'coupons_point'=> $vpoint,'message' => "Returned all data");
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid api token");
                }
           } 
        }else{
           $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call."); 
        }
        $userResponse = json_encode($responseData);
        print $userResponse;
    }
}
