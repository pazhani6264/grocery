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
Use \Carbon\Carbon;
use Hash;

class Orders extends Model
{

  public static function convertprice($current_price, $requested_currency)
  {
    $required_currency = DB::table('currencies')->where('code', $requested_currency)->first();
    $products_price = $current_price * $required_currency->value;

    return $products_price;
  }

  public static function converttodefaultprice($current_price, $requested_currency)
  {
    $required_currency = DB::table('currencies')->where('is_current',1)->where('code', $requested_currency)->first();
    $products_price = $current_price * $required_currency->value;
    return $products_price;
  }

  public static function currencies($currency_code){
   $currencies = DB::table('currencies')->where('is_current',1)->where('code', $currency_code)->first();
   return $currency_code;
  }

 public static function hyperpaytoken($request)
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
    $payments_setting = Orders::payments_setting_for_hyperpay($request);

    //check envinment
    if($payments_setting[0]->hyperpay_enviroment == '0'){
      $env_url = "https://test.oppwa.com/v1/checkouts";
    }else{
      $env_url = "https://oppwa.com/v1/checkouts";
    }

    //use currency account currency only e:g. 'SAR'
    $url = $env_url;
    $data = "authentication.userId=" .$payments_setting['userid']->value.
			"&authentication.password=" .$payments_setting['password']->value.
			"&authentication.entityId=" .$payments_setting['entityid']->value.
      "&amount=" . $request->amount.
      "&currency=SAR" .
      "&paymentType=DB".
      "&customer.email=".$request->email.
      "&testMode=INTERNAL".
      "&merchantTransactionId=". uniqid();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
      return curl_error($ch);
    }
    curl_close($ch);

    $data = json_decode($responseData);

    if($data->result->code=='000.200.100'){
      $responseData = array('success'=>'1', 'token'=>$data->id, 'message'=>"Token generated.");
    }else{
      $responseData = array('success'=>'2', 'token'=>array(), 'message'=>$data->result->description);
    }

  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function generatebraintreetoken($request)
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
    $payments_setting = Orders::payments_setting_for_brain_tree($request);

    //braintree transaction get nonce
    $is_transaction  = '0'; 			# For payment through braintree

    if($payments_setting['merchant_id']->environment == '0'){
			$braintree_environment = 'sandbox';
		}else{
			$environment = 'production';
    }

    $braintree_merchant_id = $payments_setting['merchant_id']->value;
    $braintree_public_key  = $payments_setting['public_key']->value;
    $braintree_private_key = $payments_setting['private_key']->value;

    //for token please check index.php file
    require_once app_path('braintree/index.php');

    $responseData = array('success'=>'1', 'token'=>$clientToken, 'message'=>"Token generated.");
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function ipay88_Callback($request)
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

    $transaction_id = $request->transaction_id;
    $order = DB::table('orders')->where('transaction_id',$transaction_id)->first();
      if($order !='')
      {
        $payment_status = $order->payment_status;
        if($payment_status == 2)
        {
          $responseData = array('success'=>'1', 'data'=>'', 'message'=>"Online Payment Success.");
        }
        else
        {
          $responseData = array('success'=>'0', 'data'=>'', 'message'=>"Online Payment failed.");
        }
      }
      else
      {
        $responseData = array('success'=>'0', 'data'=>'', 'message'=>"Transaction id invalid.");
      }
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function getpaymentmethods($request)
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
    $payments_setting = Orders::payments_setting_for_brain_tree($request);

		if($payments_setting['merchant_id']->environment=='0'){
			$braintree_enviroment = 'Test';
		}else{
			$braintree_enviroment = 'Live';
		}

    $braintree_card = array(
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'environment' => $braintree_enviroment,
			'name' => $payments_setting['merchant_id']->name,
			'public_key' => $payments_setting['public_key']->value,
			'active' => $payments_setting['merchant_id']->status,
			'payment_method'=>$payments_setting['merchant_id']->payment_method,
			'method'=>'braintree_card',
      'payment_methods_id'=>$payments_setting['merchant_id']->payment_methods_id,
    );

    $braintree_paypal = array(
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'environment' => $braintree_enviroment,
			'name' => $payments_setting['merchant_id']->sub_name_2,
			'public_key' => $payments_setting['public_key']->value,
			'active' => $payments_setting['merchant_id']->status,
			'payment_method'=>$payments_setting['merchant_id']->payment_method,
			'method' => 'braintree_paypal',
      'payment_methods_id'=>$payments_setting['merchant_id']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_stripe($request);

    if($payments_setting['publishable_key']->environment=='0'){
      $stripe_enviroment = 'Test';
    }else{
      $stripe_enviroment = 'Live';
    }

    $stripe = array(
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'environment' => $stripe_enviroment,
      'name' => $payments_setting['publishable_key']->name,
      'public_key' => $payments_setting['publishable_key']->value,
      'active' => $payments_setting['publishable_key']->status,
			'payment_method'=>$payments_setting['publishable_key']->payment_method,
			'method' => 'stripe',
      'payment_methods_id'=>$payments_setting['publishable_key']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_cod($request);

    //print_r($payments_setting);die();

    $cod = array(
      'environment' => '',
      'method' => 'cod',
      'public_key' => '',
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'name' => $payments_setting->name,
      'active' => $payments_setting->status,
			'payment_method'=>'cod',
      'payment_methods_id'=> $payments_setting->payment_methods_id,
    );

  


    $payments_setting = Orders::payments_setting_for_instamojo($request);

    if($payments_setting['auth_token']->environment=='0'){
			$instamojo_enviroment = 'Test';
		}else{
			$instamojo_enviroment = 'Live';
		}

    $instamojo = array(
      'environment' => $instamojo_enviroment,
      'name' => $payments_setting['auth_token']->name,
      'method' => 'instamojo',
      'public_key' => $payments_setting['api_key']->value,
      'auth_token' => $payments_setting['auth_token']->value,
      'client_id' => $payments_setting['client_id']->value,
      'client_secret' => $payments_setting['client_secret']->value,
      'active' => $payments_setting['api_key']->status,
			'payment_method'=>'instamojo',
      'payment_methods_id'=>$payments_setting['auth_token']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_hyperpay($request);

    if($payments_setting['userid']->environment=='0'){
			$hyperpay_enviroment = 'Test';
		}else{
			$hyperpay_enviroment = 'Live';
		}

    $hyperpay = array(
      'method' => 'hyperpay',
      'public_key' => '',
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'environment' => $hyperpay_enviroment,
      'name' => $payments_setting['userid']->name,
      'active' => $payments_setting['userid']->status,
			'payment_method'=>'hyperpay',
      'payment_methods_id'=>$payments_setting['userid']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_razorpay($request);
        
    if ($payments_setting['RAZORPAY_SECRET']->environment == '0') {
        $razorpay_enviroment = 'Test';
    } else {
        $razorpay_enviroment = 'Live';
    }

    $razorpay = array(
      'method' => 'razorpay',
      'public_key' => $payments_setting['RAZORPAY_KEY']->value,
      'auth_token' => '',
      'client_id' => $payments_setting['RAZORPAY_KEY']->value,
      'client_secret' => $payments_setting['RAZORPAY_SECRET']->value,
      'environment' => $razorpay_enviroment,
      'name' => $payments_setting['RAZORPAY_KEY']->name,
      'active' => $payments_setting['RAZORPAY_SECRET']->status,
      'payment_method'=> 'razorpay',
      'payment_methods_id'=>$payments_setting['RAZORPAY_SECRET']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_paytm($request);
        
    if ($payments_setting['paytm_mid']->environment == '0') {
      $paytm_enviroment = 'Test';
    } else {
        $paytm_enviroment = 'Live';
    }
    
    $paytm = array(
      'method' => 'paytm',
      'public_key' => $payments_setting['paytm_mid']->value,
      'paytm_id' => $payments_setting['paytm_mid']->value,
      'paytm_key' => $payments_setting['paytm_key']->value,
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => '',
      'environment' => $paytm_enviroment,
      'name' => $payments_setting['paytm_mid']->name,
      'active' => $payments_setting['paytm_mid']->status,
      'payment_method'=> 'paytm',
      'payment_methods_id'=>$payments_setting['paytm_mid']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_directbank($request);     

        if ($payments_setting['account_name']->environment == '0') {
            $enviroment = 'Live';
        } else {
            $enviroment = 'Live';
        }

        $banktransfer = array(

          'account_name' => $payments_setting['account_name']->value,
          'account_number' => $payments_setting['account_number']->value,
          'payment_method' => $payments_setting['account_name']->payment_method,
          'bank_name' => $payments_setting['bank_name']->value,
          'short_code' => $payments_setting['short_code']->value,
          'iban' => $payments_setting['iban']->value,
          'swift' => $payments_setting['swift']->value,
          'environment' => $enviroment,
          'method' => 'directbank',
          'payment_method'=> 'directbank',
          'public_key' => $payments_setting['account_name']->value,
          'auth_token' => '',
          'client_id' => '',
          'client_secret' => '',
          'name' => $payments_setting['account_name']->name,
          'active' => $payments_setting['account_name']->status,
          'payment_methods_id'=>$payments_setting['account_name']->payment_methods_id,
        );

    $payments_setting = Orders::payments_setting_for_paystack($request);
    
    if ($payments_setting['public_key']->environment == '0') {
      $enviroment = 'Test';
    } else {
        $enviroment = 'Live';
    }
    
    $paystack = array(
      'method' => 'paystack',
      'public_key' => $payments_setting['public_key']->value,
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => $payments_setting['secret_key']->value,
      'environment' => $enviroment,
      'name' => $payments_setting['secret_key']->name,
      'active' => $payments_setting['secret_key']->status,
      'payment_method'=> 'paystack',
      'payment_methods_id'=>$payments_setting['public_key']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_IPay88($request);
        
    if ($payments_setting['merchant_code']->environment == '0') {
      $enviroment = 'Test';
    } else {
        $enviroment = 'Live';
    }

    $ipay88 = array(
      'method' => 'ipay88',
      'public_key' => $payments_setting['merchant_code']->value,
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => $payments_setting['merchant_key']->value,
      'environment' => $enviroment,
      'name' => $payments_setting['merchant_code']->name,
      'active' => $payments_setting['merchant_code']->status,
      'payment_method'=> 'ipay88',
      'payment_methods_id'=>$payments_setting['merchant_code']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_paynet_fpx($request);

    if ($payments_setting['seller_ex_id']->environment == '0') {
       $enviroment = 'Test';
    } else {
       $enviroment = 'Live';
    }

    $paynet_fpx = array(
      'method' => 'paynet_fpx',
      'public_key' => $payments_setting['seller_ex_id']->value,
      'auth_token' => '',
      'client_id' => '',
      'client_secret' => $payments_setting['seller_id']->value,
      'environment' => $enviroment,
      'name' => $payments_setting['seller_ex_id']->name,
      'active' => $payments_setting['seller_ex_id']->status,
      'payment_method'=> 'paynet_fpx',
      'payment_methods_id'=>$payments_setting['seller_ex_id']->payment_methods_id,
    );

    $payments_setting = Orders::payments_setting_for_Premium_Pay($request);  

        if ($payments_setting['store_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $premierpay = array(
            'environment' => $enviroment,
            'method' => 'premium_pay',
            'public_key' => $payments_setting['store_id']->value,
            'merchant_code'=> $payments_setting['store_key']->value,
            'name' => $payments_setting['store_id']->name,
            'active' => $payments_setting['store_id']->status,
            'payment_method' => 'premium_pay',
            'redirect_url' => $payments_setting['store_id']->value,
            'callback_url' => $payments_setting['store_id']->value,
            'store_key' => $payments_setting['store_key']->value,
            'store_id'=> $payments_setting['store_id']->value,
            'payment_methods_id'=>$payments_setting['store_id']->payment_methods_id,
        );

    $payments_setting = Orders::payments_setting_for_wallet($request);

    if ($payments_setting['wallet_code']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

     $wallet = array(
            'environment' => $enviroment,
            'method' => 'wallet',
            'public_key' => $payments_setting['wallet_code']->value,
            'wallet_code' => $payments_setting['wallet_code']->value,
            'name' => $payments_setting['wallet_code']->name,
            'active' => $payments_setting['wallet_code']->status,
            'payment_method' => $payments_setting['wallet_code']->payment_method,
            'payment_methods_id'=>$payments_setting['wallet_code']->payment_methods_id,
        );


    $result[] = $braintree_card;
    $result[] = $braintree_paypal;
    $result[] = $stripe;
    $result[] = $cod;
    $result[] = $instamojo;
    $result[] = $hyperpay;
    $result[] = $razorpay;
    $result[] = $paytm;
    $result[] = $ipay88;
    $result[] = $paynet_fpx;
    $result[] = $premierpay;
    $result[] = $banktransfer;
    $result[] = $wallet;
    //$result[10] = $paystack;

    $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Payment methods are returned.");
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}


public static function getdirectbank($request)
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

    $payments_setting = Orders::payments_setting_for_directbank($request);     

        if ($payments_setting['account_name']->environment == '0') {
            $enviroment = 'Live';
        } else {
            $enviroment = 'Live';
        }

        $banktransfer = array(

          'account_name' => $payments_setting['account_name']->value,
          'account_number' => $payments_setting['account_number']->value,
          'payment_method' => $payments_setting['account_name']->payment_method,
          'bank_name' => $payments_setting['bank_name']->value,
          'short_code' => $payments_setting['short_code']->value,
          'iban' => $payments_setting['iban']->value,
          'swift' => $payments_setting['swift']->value,
          'environment' => $enviroment,
          'method' => 'directbank',
          'payment_method'=> 'directbank',
          'public_key' => $payments_setting['account_name']->value,
          'auth_token' => '',
          'client_id' => '',
          'client_secret' => '',
          'name' => $payments_setting['account_name']->name,
          'active' => $payments_setting['account_name']->status,
          'payment_methods_id'=>$payments_setting['account_name']->payment_methods_id,
        );

    $result[] = $banktransfer;
   

    $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Direct bank transfer detail are returned.");
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}


public static function payments_setting_for_brain_tree($request){
  $payments_setting = DB::table('payment_methods_detail')
  ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->select('payment_methods_detail.*','payment_description.sub_name_1','payment_description.sub_name_2','payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
  ->where('language_id', $request->language_id)
  ->where('payment_description.payment_methods_id',1)->get()->keyBy('key');

  if(empty($payment_method) or count($payment_method)==0){
    $payments_setting = DB::table('payment_methods_detail')
    ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->select('payment_methods_detail.*','payment_description.sub_name_1','payment_description.sub_name_2','payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
    ->where('language_id', 1)
    ->where('payment_description.payment_methods_id',1)->get()->keyBy('key');
  }

  return $payments_setting;
}

public static function payments_setting_for_stripe($request){
  $payments_setting = DB::table('payment_methods_detail')
    ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
    ->where('language_id', $request->language_id)
    ->where('payment_description.payment_methods_id',2)->get()->keyBy('key');

  if(empty($payment_method) or count($payment_method)==0){
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', 1)
      ->where('payment_description.payment_methods_id',2)->get()->keyBy('key');
  }

  return $payments_setting;
}

public static function payments_setting_for_cod($request){
  $payments_setting = DB::table('payment_description')
    ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_description.payment_methods_id')
    ->select('payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
    ->where('language_id', $request->language_id)
    ->where('payment_description.payment_methods_id',4)->first();

  if(empty($payment_method) or count($payment_method)==0){
    $payments_setting = DB::table('payment_description')
    ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_description.payment_methods_id')
    ->select('payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
    ->where('language_id', 1)
    ->where('payment_description.payment_methods_id',4)->first();
  }
  return $payments_setting;
}


public static function payments_setting_for_instamojo($request){
  $payments_setting = DB::table('payment_methods_detail')
  ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
  ->where('language_id', $request->language_id)
  ->where('payment_description.payment_methods_id',5)->get()->keyBy('key');

  if(empty($payment_method) or count($payment_method)==0){
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', 1)
      ->where('payment_description.payment_methods_id',5)->get()->keyBy('key');
  }

  return $payments_setting;
}

public static function payments_setting_for_directbank($request)
  {
      $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 
        'payment_methods.payment_method', 'payment_description.sub_name_1','payment_methods.payment_methods_id')
        ->where('language_id', $request->language_id)
        ->where('payment_description.payment_methods_id', 9)
        ->get()->keyBy('key');

          if(empty($payment_method) or count($payment_method)==0){
            $payments_setting = DB::table('payment_methods_detail')
              ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
              ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
              ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 
              'payment_methods.payment_method', 'payment_description.sub_name_1','payment_methods.payment_methods_id')
              ->where('language_id', 1)
              ->where('payment_description.payment_methods_id', 9)
              ->get()->keyBy('key');
          }

      return $payments_setting;
}

public static function payments_setting_for_paystack($request){
  $payments_setting = DB::table('payment_methods_detail')
  ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
  ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
  ->where('language_id', $request->language_id)
  ->where('payment_description.payment_methods_id',10)->get()->keyBy('key');

  if(empty($payment_method) or count($payment_method)==0){
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', 1)
      ->where('payment_description.payment_methods_id',10)->get()->keyBy('key');
  }

  return $payments_setting;
}

public static function payments_setting_for_hyperpay($request){
  $payments_setting = DB::table('payment_methods_detail')
    ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
    ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status','payment_methods.payment_method','payment_methods.payment_methods_id')
    ->where('language_id', $request->language_id)
    ->where('payment_description.payment_methods_id',6)->get()->keyBy('key');
    
    if(empty($payment_method) or count($payment_method)==0){
      $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', 1)
      ->where('payment_description.payment_methods_id',6)->get()->keyBy('key');
    }
    return $payments_setting;
}

public static function payments_setting_for_razorpay($request){
    $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', $request->language_id)
        ->where('payment_description.payment_methods_id', 7)
        ->get()->keyBy('key');

        if(empty($payment_method) or count($payment_method)==0){
          $payments_setting = DB::table('payment_methods_detail')
          ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
          ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
          ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
          ->where('language_id', 1)
          ->where('payment_description.payment_methods_id', 7)
          ->get()->keyBy('key');
        }
    return $payments_setting;
}

public static function payments_setting_for_paytm($request){
  $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', $request->language_id)
      ->where('payment_description.payment_methods_id', 8)
      ->get()->keyBy('key');

      if(empty($payment_method) or count($payment_method)==0){
        $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', 1)
        ->where('payment_description.payment_methods_id', 8)
        ->get()->keyBy('key');
      }
      
  return $payments_setting;
}

public static function payments_setting_for_IPay88($request)
{
   $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', $request->language_id)
      ->where('payment_description.payment_methods_id', 12)
      ->get()->keyBy('key');

       if(empty($payment_method) or count($payment_method)==0){
        $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', 1)
        ->where('payment_description.payment_methods_id', 12)
        ->get()->keyBy('key');
      }
    return $payments_setting;
}

public static function payments_setting_for_paynet_fpx($request)
{
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', $request->language_id)
      ->where('payment_description.payment_methods_id', 13)
      ->get()->keyBy('key');
      if(empty($payment_method) or count($payment_method)==0){
        $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', 1)
        ->where('payment_description.payment_methods_id', 13)
        ->get()->keyBy('key');
      }
    return $payments_setting;
}

public static function payments_setting_for_Premium_Pay($request)
{
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', $request->language_id)
      ->where('payment_description.payment_methods_id', 14)
      ->get()->keyBy('key');
      if(empty($payment_method) or count($payment_method)==0){
        $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', 1)
        ->where('payment_description.payment_methods_id', 14)
        ->get()->keyBy('key');
      }
    return $payments_setting;
}

public static function payments_setting_for_wallet($request)
{
    $payments_setting = DB::table('payment_methods_detail')
      ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
      ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
      ->where('language_id', $request->language_id)
      ->where('payment_description.payment_methods_id', 15)
      ->get()->keyBy('key');
      if(empty($payment_method) or count($payment_method)==0){
        $payments_setting = DB::table('payment_methods_detail')
        ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
        ->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method','payment_methods.payment_methods_id')
        ->where('language_id', 1)
        ->where('payment_description.payment_methods_id', 15)
        ->get()->keyBy('key');
      }
    return $payments_setting;
}

public static function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {
  $theta = $longitude1 - $longitude2; 
  $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
  $distance = acos($distance); 
  $distance = rad2deg($distance); 
  $distance = $distance * 60 * 1.1515; 
  switch($unit) { 
    case 'miles': 
      break; 
    case 'kilometers' : 
      $distance = $distance * 1.609344; 
  } 
  return (round($distance,2)); 
}

public static function getrate($request)
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

    //tax rate
    $tax_zone_id   			=   $request->tax_zone_id;
    $requested_currency =   $request->currency_code;
  
   
    $index = '0';
    $total_tax = '0';
    $is_number = true;
    $total_price = 0;
    foreach($request->products as $products_data){
      $final_price = $request->products[$index]['final_price'];
      $customers_basket_quantity = $request->products[$index]['customers_basket_quantity'];
      $total_price += $final_price;
      $products = DB::table('products')
        ->LeftJoin('tax_rates', 'tax_rates.tax_class_id','=','products.products_tax_class_id')
        ->where('tax_rates.tax_zone_id', $tax_zone_id)
        ->where('products_id', $products_data['products_id'])->get();
      if(count($products) > 0){
        $tax_value = $products[0]->tax_rate/100*$final_price*$customers_basket_quantity;
        $total_tax = $total_tax+$tax_value;
        
      }
      $index++;
    }

    if($total_tax>0){
      $total_tax = $total_tax;
      $data['tax'] = $total_tax;
    }else{
      $data['tax'] = '0';
    }


    $countries = DB::table('countries')->where('countries_id','=',$request->country_id)->get();

    //website path
    $websiteURL =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $replaceURL = str_replace('getRate','', $websiteURL);
    $requiredURL = $replaceURL.'app/ups/ups.php';


    //default shipping method
    //$shippings = DB::table('shipping_methods')->get();
    $shippings = DB::table('shipping_methods')
        ->leftJoin('shipping_description','shipping_description.table_name','=','shipping_methods.table_name')
        ->get();
    
		$settings = DB::table('settings')->get();
    
    $result = array();

    foreach($shippings as $shipping_methods){

      if($settings[82]->value <= $total_price){

       
          $description = DB::table('shipping_description')->where('table_name','free_shipping')->where('language_id',$request->language_id)->get();
  
          if(!empty($description[0]->name)){
            $methodName = $description[0]->name;
          }else{
            $methodName = 'Free Shipping';
          }
  
          if($description[0]->isDefault == 0){
            $default = false;
          }else{
            $default = true;
          }
  
          $data2 =  array('name'=>$methodName,'rate'=>'0','currencyCode'=>$requested_currency,'is_default' => $default,'shipping_method'=>'freeShipping');
          $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
          $success['services'][0] = $data2;
          $result['freeShipping'] = $success;
  
        

      }

      else
      {
      //ups shipping rate
      if($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1' and $shipping_methods->id == '7'){
            
        
        $description = DB::table('shipping_description')->where('table_name','flate_rate')->where('language_id',1)->where('id',7)->get();
  
        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Flate Rate';
        }
        if($description[0]->isDefault == 0){
          $default = false;
        }else{
          $default = true;
        }

        $data['shippingmethod'] = 'others';
  
        $ups_shipping = DB::table('flate_rate')->where('id', '=', '1')->get();
        
        if($settings[82]->value <= $total_price){
          $rate = 0;
        }else{
          $rate = Orders::convertprice($description[0]->flate_rate, $requested_currency);
        }
        
        $data2 =  array('name'=>$methodName,'rate'=>$rate,'currencyCode'=>$requested_currency,'is_default' => $default,'shipping_method'=>'flateRate');
        if(count($description)>0){
          $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
          $success['services'][0] = $data2;
          $result['flateRate1'] = $success;
        }
  
  
      }
      
      
      if($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1' and $shipping_methods->id == '8'){
                           
     
        $description = DB::table('shipping_description')->where('table_name','flate_rate')->where('language_id',1)->where('id',8)->get();
  
        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Flate Rate';
        }
        if($description[0]->isDefault == 0){
          $default = false;
        }else{
          $default = true;
        }
        $data['shippingmethod'] = 'others';
  
        $ups_shipping = DB::table('flate_rate')->where('id', '=', '1')->get();
        
        if($settings[82]->value <= $total_price){
          $rate = 0;
        }else{
          $rate = Orders::convertprice($description[0]->flate_rate, $requested_currency);
        }
        
        $data2 =  array('name'=>$methodName,'rate'=>$rate,'currencyCode'=>$requested_currency,'is_default' => $default,'shipping_method'=>'flateRate');
        if(count($description)>0){
          $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
          $success['services'][0] = $data2;
          $result['flateRate'] = $success;
        }
  
  
      }
      
      if($shipping_methods->methods_type_link == 'upsShipping' and $shipping_methods->status == '1'){
        $result2= array();
        $is_transaction = '0';

        $ups_shipping = DB::table('ups_shipping')->where('ups_id', '=', '1')->get();

        //shipp from and all credentials
        $accessKey  = $ups_shipping[0]->access_key;
        $userId 	= $ups_shipping[0]->user_name;
        $password 	= $ups_shipping[0]->password;

        //ship from address
        $fromAddress  = $ups_shipping[0]->address_line_1;
        $fromPostalCode  = $ups_shipping[0]->post_code;
        $fromCity  = $ups_shipping[0]->city;
        $fromState  = $ups_shipping[0]->state;
        $fromCountry  = $ups_shipping[0]->country;

        //ship to address
        $toPostalCode = $request->postcode;
        $toCity = $request->city;
        $toState = $request->state;
        $toCountry = $countries[0]->countries_iso_code_2;
        $toAddress = $request->street_address;

        //product detail
        $products_weight = $request->products_weight;
        $products_weight_unit = $request->products_weight_unit;
        $productsWeight = 0;
        //change G or KG to LBS
        if($products_weight_unit=='g'){
          $productsWeight = $products_weight/453.59237;
        }else if($products_weight_unit=='kg'){
          $productsWeight = $products_weight/0.45359237;
        }

        //production or test mode
        if($ups_shipping[0]->shippingEnvironment == 1){ 			#production mode
          $useIntegration = true;
        }else{
          $useIntegration = false;								#test mode
        }

        $serviceData = explode(',',$ups_shipping[0]->serviceType);


        $index = 0;
        $description = DB::table('shipping_description')->where([
                  ['language_id', '=', $request->language_id],
                  ['table_name', '=',  'ups_shipping'],
                ])->get();

        $sub_labels = json_decode($description[0]->sub_labels);

        foreach($serviceData as $value){
          if($value == "US_01")
          {
            $name = $sub_labels->nextDayAir;
            $serviceTtype = "1DA";
          }
          else if ($value == "US_02")
          {
            $name = $sub_labels->secondDayAir;
            $serviceTtype = "2DA";
          }
            else if ($value == "US_03")
          {
            $name = $sub_labels->ground;
            $serviceTtype = "GND";
          }
          else if ($value == "US_12")
          {
            $name = $sub_labels->threeDaySelect;
            $serviceTtype = "3DS";
          }
          else if ($value == "US_13")
          {
            $name = $sub_labels->nextDayAirSaver;
            $serviceTtype = "1DP";
          }
          else if ($value == "US_14")
          {
            $name = $sub_labels->nextDayAirEarlyAM;
            $serviceTtype = "1DM";
          }
          else if ($value == "US_59")
          {
            $name = $sub_labels->secondndDayAirAM;
            $serviceTtype = "2DM";
          }
          else if($value == "IN_07")
          {
            $name = Lang::get("labels.Worldwide Express");
            $serviceTtype = "UPSWWE";
          }
          else if ($value == "IN_08")
          {
            $name = Lang::get("labels.Worldwide Expedited");
            $serviceTtype = "UPSWWX";
          }
          else if ($value == "IN_11")
          {
            $name = Lang::get("labels.Standard");
            $serviceTtype = "UPSSTD";
          }
          else if ($value == "IN_54")
          {
            $name = Lang::get("labels.Worldwide Express Plus");
            $serviceTtype = "UPSWWEXPP";
          }

        $some_data = array(
          'access_key' => $accessKey,  						# UPS License Number
          'user_name' => $userId,								# UPS Username
          'password' => $password, 							# UPS Password
          'pickUpType' => '03',								# Drop Off Location
          'shipToPostalCode' => $toPostalCode, 				# Destination  Postal Code
          'shipToCountryCode' => $toCountry,					# Destination  Country
          'shipFromPostalCode' => $fromPostalCode, 			# Origin Postal Code
          'shipFromCountryCode' => $fromCountry,				# Origin Country
          'residentialIndicator' => 'IN', 					# Residence Shipping and for commercial shipping "COM"
          'cServiceCodes' => $serviceTtype, 					# Sipping rate for UPS Ground
          'packagingType' => '02',
          'packageWeight' => $productsWeight
          );

          $curl = curl_init();
          // You can also set the URL you want to communicate with by doing this:
          // $curl = curl_init('http://localhost/echoservice');

          // We POST the data
          curl_setopt($curl, CURLOPT_POST, 1);
          // Set the url path we want to call
          curl_setopt($curl, CURLOPT_URL, $requiredURL);
          // Make it so the data coming back is put into a string
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          // Insert the data
          curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

          // You can also bunch the above commands into an array if you choose using: curl_setopt_array

          // Send the request
          $rate = curl_exec($curl);
          // Free up the resources $curl is using
          curl_close($curl);
         $ups_description = DB::table('shipping_description')->where('table_name','ups_shipping')->where('language_id',$request->language_id)->get();
         if(!empty($ups_description[0]->name)){
          $methodName = $ups_description[0]->name;
         }else{
          $methodName = 'UPS Shipping';
         }
         if (is_numeric($rate)){
          $rate = Orders::convertprice($rate, $requested_currency);
          $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
          $result2[$index] = array('name'=>$name,'rate'=>$rate,'currencyCode'=>$requested_currency,'shipping_method'=>'upsShipping');
          $index++;
         }
         else{
          $success = array('success'=>'0','message'=>"Selected regions are not supported for UPS shipping", 'name'=>$ups_description[0]->name);
         }

          $success['services'] = $result2;
          $result['upsShipping'] = $success;

        }


      }


      else if ($shipping_methods->methods_type_link == 'shippingByKM' and $shipping_methods->status == '1') {

        $description = DB::table('shipping_description')->where('table_name','shippingByKM')->where('language_id',$request->language_id)->get();
       
        $delivery_latitude = $request->latitude;
        $delivery_longitude = $request->longitude;
        if($delivery_latitude !='' && $delivery_longitude !='')
        {
          $location_lat = DB::table('settings')->where('id', '=','10')->first();
          $location_long = DB::table('settings')->where('id', '=','11')->first();
          $contact_latitude =$location_lat->value;
          $contact_longitude =$location_long->value;



          $range = self::getDistanceBetweenPointsNew($delivery_latitude,$delivery_longitude,$contact_latitude,$contact_longitude,'kilometers');
              
          $kilometer = round($range);
         
          $pricebykm = DB::table('products_shipping_rates_km')->where('km_from', '<=', $kilometer)->where('km_to', '>=', $kilometer)->where('km_status', 1)->get();
          if (count($pricebykm) > 0) {
              $price = $pricebykm[0]->km_price;
              $success = 1;
              $msg = 'You can able to  order this product';
          }
          else
          {
              $price = 0;
              $success = 0;
              $msg = 'Your location does not support Shipping By KM';
          }
        }
        else
        {
            $price = 0;
            $success = 0;
            $msg = 'Your location does not support Shipping By KM';
        }

        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Shipping By KM';
        }
        $data['shippingmethod'] = 'Shipping By KM';

        $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();

         $data2 = array('name' => $methodName,'rate'=>$price, 'currencyCode' => $requested_currency,  'is_default' => true, 'shipping_method' => 'shippingByKM','getallkm' => $getallkm);
         $success = array('success' => $success, 'message' => $msg, 'name' => $methodName);
         $success['services'][0] = $data2;
         $result['shippingByKM'] = $success;


       
        
 
     }



      
     else if($shipping_methods->methods_type_link == 'localPickup' and $shipping_methods->status == '1') {
        $description = DB::table('shipping_description')->where('table_name','local_pickup')->where('language_id',$request->language_id)->get();

        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Local Pickup';
        }

        if($description[0]->isDefault == 0){
          $default = false;
        }else{
          $default = true;
        }
        $data['shippingmethod'] = 'others';

        $data2 =  array('name'=>$methodName, 'rate'=>'0', 'currencyCode'=>$requested_currency,'is_default' => $default, 'shipping_method'=>'localPickup');
        $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
        $success['services'][0] = $data2;
        $result['localPickup'] = $success;

      }else if($shipping_methods->methods_type_link == 'freeShipping'  and $shipping_methods->status == '1'){
        $description = DB::table('shipping_description')->where('table_name','free_shipping')->where('language_id',$request->language_id)->get();

        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Free Shipping';
        }

        if($description[0]->isDefault == 0){
          $default = false;
        }else{
          $default = true;
        }

        $data2 =  array('name'=>$methodName,'rate'=>'0','currencyCode'=>$requested_currency,'is_default' => $default,'shipping_method'=>'freeShipping');
        $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
        $success['services'][0] = $data2;
        $result['freeShipping'] = $success;

      }else if($shipping_methods->methods_type_link == 'shippingByWeight'  and $shipping_methods->status == '1'){
        $description = DB::table('shipping_description')->where('table_name','shipping_by_weight')->where('language_id',$request->language_id)->get();
        if(!empty($description[0]->name)){
          $methodName = $description[0]->name;
        }else{
          $methodName = 'Shipping Price';
        }

        if($description[0]->isDefault == 0){
          $default = false;
        }else{
          $default = true;
        }

        $weight = $request->products_weight;

        //check price by weight
        $priceByWeight = DB::table('products_shipping_rates')->where('weight_from','<=',$weight)->where('weight_to','>=',$weight)->where('products_shipping_status', 1)->get();

        if(!empty($priceByWeight) and count($priceByWeight)>0 ){
          if($settings[82]->value <= $total_price){
            $rate = 0;
          }else{
            $price = $priceByWeight[0]->weight_price;
            $rate = Orders::convertprice($price, $requested_currency);
          }
        }else{
          $rate = 0;
        }
        $data['shippingmethod'] = 'others';

        $data2 =  array('name'=>$methodName,'rate'=>$rate,'currencyCode'=>$requested_currency,'is_default' => $default,'shipping_method'=>'Shipping Price');
        $success = array('success'=>'1', 'message'=>"Rate is returned.", 'name'=>$methodName);
        $success['services'][0] = $data2;
        $result['shippingprice'] = $success;
      }
    }

  }

   
    $data['shippingMethods'] = $result;

    $responseData = array('success'=>'1', 'data'=>$data, 'message'=>"Data is returned.");
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}


public static function getcoupon($request)
{

  		$result = array();
  		$consumer_data 		 				  =  array();
  		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  		$consumer_data['consumer_url']  	  =  __FUNCTION__;
  		$authController = new AppSettingController();
  		$authenticate = $authController->apiAuthenticate($consumer_data);
      $currentDate = date('Y-m-d');
      $settings = $authController->getSetting();
  		if($authenticate==1){
        $pointss=DB::table('redeem_points_voucher')->where('code', $request->code)->where('status', 0)->first();
        if($pointss !='')
        {
          $redeemid = $pointss->id;
          $customers_id = $pointss->user_id;
          $voucher_redeem =$settings['voucher_redeem'];
          $trans_id=DB::table('transaction_points')->where('user_id', $customers_id)->where('loyalty_id', $redeemid)->first();
          $transaction_id = $trans_id->id;
          $total = $request->total;
          //$total = 200;
          if($customers_id == ''|| $redeemid == ''|| $total == '' || $transaction_id == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
           


            $gettype=DB::table('transaction_points')->where('user_id', $customers_id)->where('id', $transaction_id)->first();
            $getname=DB::table('redeem_points_description')->where('redeem_points_id', $pointss->redeem_id)->where('language_id', 1)->first();
            
          
            if($gettype){
            
              if($gettype->type == 'Active')
              {
                $check=DB::table('redeem_points_voucher')->where('id', $redeemid)->where('status', '0')->first();
                $point=DB::table('redeem_points_settings')->where('id',$check->redeem_id)->first();
              }
              else
              {
                $point=DB::table('redeem_points_settings')->where('id', $redeemid)->first();
              }
            }
            else
              {
                $point=DB::table('redeem_points_settings')->where('id', $redeemid)->first();
              }
            
          
               if($point->no_rm < $total){
                 $date_added = date('Y-m-d H:i:s');
    
                 if($transaction_id !='0'){
    
                   $old=DB::table('transaction_points')->where('user_id', $customers_id)->where('id', $transaction_id)->where('status', '0')->first();
                   if($old){
                      $cdata = DB::table('users')->where('id', $customers_id)->first();
                      $new=$cdata->loyalty_points+$old->points;
                       // update user table
                                    DB::table('users')->where('id', $customers_id)->update([
                                        'loyalty_points' => $new,
                                    ]);
                                   // detete old trancation date
                                DB::table('transaction_points')->where('id', $transaction_id)->delete();
                                DB::table('temp_point_transaction')->where('trans_id', $transaction_id)->delete();
                   }	
                 }
    
                 $userdata = DB::table('users')->where('id', $customers_id)->first();
                 $oldbalnce=$userdata->loyalty_points;
                         $newbalnce=$userdata->loyalty_points-$point->points;
    
                         if ($point->discount_type == 'fixed_cart') {
                           $discount_amount = $point->no_rm;
                         }elseif ($point->discount_type == 'percent') {
                           $dis_amount = $point->no_rm / 100 *  $request->total;
                           if(!empty($point->cap_amount)){
                             if($dis_amount < $point->cap_amount){
                               $discount_amount=$dis_amount;
                             }else{
                               $discount_amount= $point->cap_amount;
                             }
                           }else{
                             $discount_amount=$dis_amount;
                           }
                         }
                 if($voucher_redeem =='1'){
                       //insert point details
                       $trns_id=DB::table('transaction_points')->insertGetId([
                             'user_id' => $customers_id,
                             'order_id'=> '0',
                             'loyalty_id'=>$point->id,
                             'points' => $point->points,
                             'balance_points' => $newbalnce,
                             'points_status' => 'out',
                             'description'=>'Apply point coupon',
                 'type'=>'Direct',
                             'created_at' => $date_added,
                             'updated_at' => $date_added
                        ]);
                        // update user table
                            DB::table('users')->where('id', $customers_id)->update([
                                 'loyalty_points' => $newbalnce,
                            ]);
    
                         DB::table('temp_point_transaction')->insert([
                             'trans_id' => $trns_id,
                             'loyalty_id'=>$point->id,
                             'user_id'=> $customers_id,
                             'created_at' => $date_added
                         ]);
              }
    
              else
              {
                
                $trns_id = $transaction_id;
              }
    
                         $responseData = array('success'=>'1','transaction_id'=>$trns_id,'data'=>'','type'=>'reedem coupon','discount_amount'=>$discount_amount,'code'=>$getname->redeem_points_title,'discount_type'=>$point->discount_type,'message'=>"Redeem successful.");
    
               }else{
                 $responseData = array('success'=>'0','message'=>"Redeem amount is greater than total price");
               }
               
          }
        
        }
        else
        {
            $coupons = DB::table('coupons')->where('code', '=', $request->code)->get();
            

            if(count($coupons)>0){

              if(!empty($coupons[0]->product_ids)){
                $product_ids = explode(',', $coupons[0]->product_ids);
                $coupons[0]->product_ids =  $product_ids;
              }
              else{
                $coupons[0]->product_ids = array();
              }

              if(!empty($coupons[0]->exclude_product_ids)){
                $exclude_product_ids = explode(',', $coupons[0]->exclude_product_ids);
                $coupons[0]->exclude_product_ids =  $exclude_product_ids;
              }else{
                $coupons[0]->exclude_product_ids =  array();
              }

              if(!empty($coupons[0]->product_categories)){
                $product_categories = explode(',', $coupons[0]->product_categories);
                $coupons[0]->product_categories =  $product_categories;
              }else{
                $coupons[0]->product_categories =  array();
              }

              if(!empty($coupons[0]->excluded_product_categories)){
                $excluded_product_categories = explode(',', $coupons[0]->excluded_product_categories);
                $coupons[0]->excluded_product_categories =  $excluded_product_categories;
              }else{
                $coupons[0]->excluded_product_categories = array();
              }

              if(!empty($coupons[0]->email_restrictions)){
                $email_restrictions = explode(',', $coupons[0]->email_restrictions);
                $coupons[0]->email_restrictions =  $email_restrictions;
              }else{
                $coupons[0]->email_restrictions =  array();
              }

              if(!empty($coupons[0]->used_by)){
                $used_by = explode(',', $coupons[0]->used_by);
                $coupons[0]->used_by =  $used_by;
              }else{
                $coupons[0]->used_by =  array();
              }

              $responseData = array('success'=>'1','type'=>'voucher', 'data'=>$coupons, 'message'=>"Coupon info is returned.");
            }else{
              $responseData = array('success'=>'0', 'data'=>$coupons, 'message'=>"Coupon doesn't exist.");
            }
        
        }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }

  		$orderResponse = json_encode($responseData);

      return $orderResponse;
}

public static function addtoorder($request)
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
  $ipAddress = Orders::get_client_ip_env();
  $price = 0;

  $inventory = DB::table('settings')->where('name' , 'Inventory')->first();
  $is_inventory = $inventory ? $inventory->value : 1;

          
  if($authenticate==1){
      $productid = array();
      $i = 0;

      foreach($request->cart_id as $cartid){
          //print_r($cartid);die();
          $cartdata=DB::table('customers_basket')->where('customers_basket_id', $cartid)->first();
          $productid[$i]['products_id']=$cartdata->products_id;
          $productid[$i]['customers_basket_quantity']=$cartdata->customers_basket_quantity;
          $productid[$i]['total_basket_quantity']=$cartdata->total_basket_quantity;
          $productid[$i]['final_price']=$cartdata->original_price;
          $productid[$i]['customers_basket_id']=$cartdata->customers_basket_id;
          $i++;
        }

      foreach($productid as $products){
        
        $req = array();
        $req['products_id'] = $products['products_id'];
        $attr = array();
        $attrdata=DB::table('customers_basket_attributes')->where('customers_basket_id', $products['customers_basket_id'])->get();
        if (!$attrdata->isEmpty()) {
           foreach ($attrdata as $key => $value) {
               $attresult=DB::table('products_attributes')->where(['products_id'=>$value->products_id,'options_id'=>$value->products_options_id,'options_values_id'=>$value->products_options_values_id])->first(); 
               $attr[$key] = $attresult->products_attributes_id;
            }
            $req['attributes'] = $attr;

        }

        //print_r($req);
        
        $check = Product::getquantity($req);
        
        $check = json_decode($check);
        // dd($check);
        $currentStock = Coreproduct::select('products.*','products_description.products_name as name')->leftjoin('products_description','products_description.products_id','=','products.products_id')->where('products.products_id',$products['products_id'])->first();
      if($is_inventory == 1 && $currentStock->stock_status == 1){
          if($products['customers_basket_quantity'] > $check->stock){
            $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'This Product is out of stock'." '".$currentStock->name."' ");
            $orderResponse = json_encode($responseData);
            return $orderResponse;
          }elseif($products['customers_basket_quantity'] < $currentStock->products_min_order){
              $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The minimum order quantity allowed for this product is'." ".$currentStock->products_min_order);
              $orderResponse = json_encode($responseData);
              return $orderResponse;
          }
          elseif($products['customers_basket_quantity'] > $currentStock->products_max_stock && $currentStock->products_max_stock != 0){
            $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The maximum order quantity allowed for this product is'." ".$currentStock->products_max_stock);
            $orderResponse = json_encode($responseData);
            return $orderResponse;
          }
      }
      
      $price += $products['final_price'] * $products['customers_basket_quantity'];
    }

    $setting = DB::table('settings')->where('name','min_order_price')->first();
    if($price  < $setting->value){
        $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'Your order price is less then min order price');
        $orderResponse = json_encode($responseData);
        return $orderResponse;
    }

      $guest_status             = $request->guest_status;
      if($guest_status == 1){
        $check = DB::table('users')->where('role_id',2)->where('email',$request->email)->first();
        if($check == null){
          $customers_id = DB::table('users')
                            ->insertGetId([
                              'role_id' => 2,
                              'email' => $request->email,
                              'password' => Hash::make('123456dfdfdf'),
                              'first_name' => $request->delivery_firstname,
                              'last_name' => $request->delivery_lastname,
                              'phone' => $request->customers_telephone
                            ]);
        }
        else{
          $customers_id = $check->id;
        }
      }
      else{
        $customers_id            				=   $request->customers_id;
      }

			$date_added								=	date('Y-m-d H:i:s');
      $ordered_source           =   $request->ordered_source;
			$customers_telephone      =   $request->customers_telephone;
			$email            				=   $request->email;
			$delivery_firstname  	    =   $request->delivery_firstname;
			$delivery_lastname        =   $request->delivery_lastname;
			$delivery_street_address  =   $request->delivery_street_address;
			$delivery_suburb          =   $request->delivery_suburb;
			$delivery_city            =   $request->delivery_city;
			$delivery_postcode        =   $request->delivery_postcode;
			$delivery_latitude        =   $request->delivery_latitude;
			$delivery_longitude       =  $request->delivery_longitude;


			$delivery = DB::table('zones')->where('zone_name', '=', $request->delivery_zone)->first();

			if($delivery){
				$delivery_state            				=   $delivery->zone_code;
			}else{
				$delivery_state            				=   'other';
			}

			$delivery_country            			=   $request->delivery_country;
			$billing_firstname            			=   $request->billing_firstname;
			$billing_lastname            			=   $request->billing_lastname;
			$billing_street_address            		=   $request->billing_street_address;
			$billing_suburb	            			=   $request->billing_suburb;
			$billing_city            				=   $request->billing_city;
			$billing_postcode            			=   $request->billing_postcode;

			$billing = DB::table('zones')->where('zone_name', '=', $request->billing_zone)->first();

			if($billing){
				$billing_state            				=   $billing->zone_code;
			}else{
				$billing_state            				=   'other';
			}

			$billing_country            			=   $request->billing_country;
			$payment_method            				=   $request->payment_method;
			$order_information 						=	array();

			$cc_type            				=   $request->cc_type;
			$cc_owner            				=   $request->cc_owner;
			$cc_number            				=   $request->cc_number;
			$cc_expires            				=   $request->cc_expires;
			$last_modified            			=   date('Y-m-d H:i:s');
			$date_purchased            			=   date('Y-m-d H:i:s');
      $order_price						        =   $request->totalPrice;
			$currency_code           				=   $request->currency_code;
      $order_price                    =  $request->totalPrice;
      $shipping_cost            			=   $request->shipping_cost;
      $shipping_cost                  =   $request->shipping_cost;
			$shipping_method            		=   $request->shipping_method;
			$order_weight            		    =   $request->total_weight;
			$order_km            		        =   $request->order_km;
			$orders_status            			=   '1';
			$orders_date_finished            	=   $request->orders_date_finished;
			$comments            				=   $request->comments;

			//additional fields
			$delivery_phone						=	$request->delivery_phone;
			$billing_phone						=	$request->billing_phone;
			$point_transaction_id				=   $request->point_transaction_id;
			$coupon_code_id						=   $request->coupon_code_id;
			$points_amount						=   $request->points_amount;
      $cashier_id               =   $request->cashier_id;
      $discount_amount          =   $request->discount_amount;

			$settings = DB::table('settings')->get();
			$currency_value            			=   $request->currency_value;

			//tax info
      $total_tax							=	$request->total_tax;
      // $total_tax              = Orders::converttodefaultprice($request->total_tax, $currency_code);

			$products_tax 						= 	1;
			//coupon info
			$is_coupon_applied            		=   $request->is_coupon_applied;

			if($is_coupon_applied==1){

				$code = array();
				$coupon_amount = 0;
				$exclude_product_ids = array();
				$product_categories = array();
				$excluded_product_categories = array();
				$exclude_product_ids = array();

        $coupon_amount    =		$request->coupon_amount;

        //convert price to default currency price
        // $coupon_amount = Orders::converttodefaultprice($coupon_amount, $currency_code);

				foreach($request->coupons as $coupons_data){

					//update coupans
					$coupon_id = DB::statement("UPDATE `coupons` SET `used_by`= CONCAT(used_by,',$customers_id') WHERE `code` = '".$coupons_data['code']."'");

				}
				$code = json_encode($request->coupons);

			}else{
				$code            					=   '';
				$coupon_amount            			=   0;
			}

			//payment methods
			$payments_setting = Orders::payments_setting_for_brain_tree($request);

			if($payment_method == 'braintree_card' or $payment_method == 'braintree_paypal'){
				if($payment_method == 'braintree_card'){
          $fieldName = 'sub_name_1';
          $paymentMethodName = 'Braintree Card';
				}else{
          $fieldName = 'sub_name_2';
          $paymentMethodName = 'Braintree Paypal';
        }
        
        // $paymentMethodName = $payments_setting->$fieldName;

				//braintree transaction with nonce
				$is_transaction  = '1'; 			# For payment through braintree
				$nonce    		 =   $request->nonce;

        if($payments_setting['merchant_id']->environment=='0'){
    			$braintree_enviroment = 'Test';
    		}else{
    			$braintree_enviroment = 'Live';
    		}

        $braintree_merchant_id = $payments_setting['merchant_id']->value;
        $braintree_public_key  = $payments_setting['public_key']->value;
        $braintree_private_key = $payments_setting['private_key']->value;

				//brain tree credential
				require_once app_path('braintree/index.php');

        

				if ($result->success)
				{
				if($result->transaction->id)
					{
						$order_information = array(
							'braintree_id'=>$result->transaction->id,
							'status'=>$result->transaction->status,
							'type'=>$result->transaction->type,
							'currencyIsoCode'=>$result->transaction->currencyIsoCode,
							'amount'=>$result->transaction->amount,
							'merchantAccountId'=>$result->transaction->merchantAccountId,
							'subMerchantAccountId'=>$result->transaction->subMerchantAccountId,
							'masterMerchantAccountId'=>$result->transaction->masterMerchantAccountId,
							//'orderId'=>$result->transaction->orderId,
							'createdAt'=>time(),
	//						'updatedAt'=>$result->transaction->updatedAt->date,
							'token'=>$result->transaction->creditCard['token'],
							'bin'=>$result->transaction->creditCard['bin'],
							'last4'=>$result->transaction->creditCard['last4'],
							'cardType'=>$result->transaction->creditCard['cardType'],
							'expirationMonth'=>$result->transaction->creditCard['expirationMonth'],
							'expirationYear'=>$result->transaction->creditCard['expirationYear'],
							'customerLocation'=>$result->transaction->creditCard['customerLocation'],
							'cardholderName'=>$result->transaction->creditCard['cardholderName']
						);
						$payment_status = "success";
					}
				}
				else
					{
						$payment_status = "failed";
					}

			}else if($payment_method == 'stripe'){				#### stipe payment

        $payments_setting = Orders::payments_setting_for_stripe($request);
				$paymentMethodName = $payments_setting['publishable_key']->name;

				//require file
				require_once app_path('stripe/config.php');

				//get token from app
				$token  = $request->nonce;

				$customer = \Stripe\Customer::create(array(
				  'email' => $email,
				  'source'  => $token
				));

				$charge = \Stripe\Charge::create(array(
				  'customer' => $customer->id,
				  'amount'   => 100*$order_price,
				  'currency' => 'usd'
				));

				 if($charge->paid == true){
					 $order_information = array(
							'paid'=>'true',
							'transaction_id'=>$charge->id,
							'type'=>$charge->outcome->type,
							'balance_transaction'=>$charge->balance_transaction,
							'status'=>$charge->status,
							'currency'=>$charge->currency,
							'amount'=>$charge->amount,
							'created'=>date('d M,Y', $charge->created),
							'dispute'=>$charge->dispute,
							'customer'=>$charge->customer,
							'address_zip'=>$charge->source->address_zip,
							'seller_message'=>$charge->outcome->seller_message,
							'network_status'=>$charge->outcome->network_status,
							'expirationMonth'=>$charge->outcome->type
						);

						$payment_status = "success";

				 }else{
						$payment_status = "failed";
				 }

			}else if($payment_method == 'cod'){

        $payments_setting = Orders::payments_setting_for_cod($request);
				$paymentMethodName =  $payments_setting->name;
				$payment_method = 'Cash on Delivery';
				$payment_status='success';
        $pay_status='2';

			}else if($payment_method == 'instamojo'){

        $payments_setting = Orders::payments_setting_for_instamojo($request);
				$paymentMethodName = $payments_setting['auth_token']->name;
				$payment_method = 'Instamojo';
				$payment_status='success';
        $pay_status='1';
				$order_information = array('payment_id'=>$request->nonce, 'transaction_id'=>$request->transaction_id);

			}else if($payment_method == 'hyperpay'){
        $payments_setting = Orders::payments_setting_for_hyperpay($request);
				$paymentMethodName = $payments_setting['userid']->name;
				$payment_method = 'Hyperpay';
				$payment_status='success';
        $pay_status='1';
			}else if($payment_method == 'razorpay'){
        $payments_setting = Orders::payments_setting_for_razorpay($request);
				$paymentMethodName = $payments_setting['RAZORPAY_KEY']->name;
				$payment_method = 'Razorpay';
				$payment_status='success';
        $pay_status='1';
			}else if($payment_method == 'paytm'){
        $payments_setting = Orders::payments_setting_for_paytm($request);
				$paymentMethodName = $payments_setting['paytm_mid']->name;
				$payment_method = 'Paytm';
				$payment_status='success';
        $pay_status='1';
			}else if($payment_method == 'directbank'){
        $payments_setting = Orders::payments_setting_for_directbank($request);
				$paymentMethodName = 'banktransfer';
				$payment_method = 'directbank';
        $payment_status='success';
        $pay_status='1';
        $order_information = array(
          'account_name' => $payments_setting['account_name']->value,
          'account_number' => $payments_setting['account_number']->value,
          'payment_method' => $payments_setting['account_name']->payment_method,
          'bank_name' => $payments_setting['bank_name']->value,
          'short_code' => $payments_setting['short_code']->value,
          'iban' => $payments_setting['iban']->value,
          'swift' => $payments_setting['swift']->value,
        );
			}else if($payment_method == 'paystack'){
        $payments_setting = Orders::payments_setting_for_paystack($request);
				$paymentMethodName = $payments_setting['secret_key']->name;
				$payment_method = 'paystack';
        $payment_status='success';
        $pay_status='1';
        $order_information = '';
			} else if($payment_method == 'ipay88'){
        $payments_setting = Orders::payments_setting_for_IPay88($request);
        $paymentMethodName = $payments_setting['merchant_code']->name;
        $payment_method = 'ipay88';
        $pay_status='2';
        $payment_status='success';
        $order_information = '';
      }else if($payment_method == 'premium_pay'){
        $payments_setting = Orders::payments_setting_for_Premium_Pay($request);
        $paymentMethodName = $payments_setting['store_id']->name;
        $payment_method = 'premium_pay';
        $pay_status='2';
        $payment_status='success';
        $order_information = '';
      }else if($payment_method == 'Cash on Delivery'){
        $payments_setting = Orders::payments_setting_for_Premium_Pay($request);
        $paymentMethodName = 'Cash on Delivery';
        $payment_method = 'Cash on Delivery';
        $payment_status='success';
        $pay_status='2';
        $order_information = '';
      }else if($payment_method == 'Cash'){
        $payments_setting = '';
        $paymentMethodName = 'Cash on Pos';
        $payment_method = 'Cash on Pos';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      }else if($payment_method == 'wallet'){
        $payments_setting = Orders::payments_setting_for_wallet($request);
        $paymentMethodName = 'wallet';
        $payment_method = 'wallet';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      }else if($payment_method == 'Credit'){
        $payments_setting = '';
        $paymentMethodName = 'Credit/Debit Card';
        $payment_method = 'Credit/Debit Card';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      } else if($payment_method == 'PromptPay'){
        $payments_setting = '';
        $paymentMethodName = 'Prompt Pay';
        $payment_method = 'Prompt Pay';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      } else if($payment_method == 'Delivery'){
        $payments_setting = '';
        $paymentMethodName = 'Delivery';
        $payment_method = 'Delivery';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      }else if($payment_method == 'Coupon'){
        $payments_setting = '';
        $paymentMethodName = 'Coupon';
        $payment_method = 'Coupon';
        $payment_status='success';
        $order_information = '';
        $pay_status='2';
      }


			//check if order is verified
			if($payment_status=='success'){
        $currency_value = DB::table('currencies')->where('code',$currency_code)->first();
				if($payment_method == 'hyperpay'){
				$cyb_orders = DB::table('orders')->where('transaction_id','=',$request->transaction_id)->get();
				$orders_id = $cyb_orders[0]->orders_id;

				//update database
				DB::table('orders')->where('transaction_id','=',$request->transaction_id)->update(
					[	 'customers_id' => $customers_id,
						 'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
						 'customers_street_address' => $delivery_street_address,
						 'customers_suburb'  =>  $delivery_suburb,
						 'customers_city' => $delivery_city,
						 'customers_postcode'  => $delivery_postcode,
						 'customers_state' => $delivery_state,
						 'customers_country'  =>  $delivery_country,
						 'customers_telephone' => $customers_telephone,
						 'email'  => $email,

						 'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
						 'delivery_street_address' => $delivery_street_address,
						 'delivery_suburb'  => $delivery_suburb,
						 'delivery_city' => $delivery_city,
						 'delivery_postcode'  =>  $delivery_postcode,
						 'delivery_latitude'  =>  $delivery_latitude,
						 'delivery_longitude'  =>  $delivery_longitude,
						 'delivery_state' => $delivery_state,
						 'delivery_country'  => $delivery_country,
						 'billing_name'  => $billing_firstname.' '.$billing_lastname,
						 'billing_street_address' => $billing_street_address,
						 'billing_suburb'  =>  $billing_suburb,
						 'billing_city' => $billing_city,
						 'billing_postcode'  => $billing_postcode,
						 'billing_state' => $billing_state,
						 'billing_country'  =>  $billing_country,

						 'payment_method'  =>  $paymentMethodName,
						 'cc_type' => $cc_type,
						 'cc_owner'  => $cc_owner,
						 'cc_number' =>$cc_number,
						 'cc_expires'  =>  $cc_expires,
						 'last_modified' => $last_modified,
						 'date_purchased'  => $date_purchased,
						 'order_price'  => $order_price / $currency_value->value,
						 'shipping_cost' =>$shipping_cost / $currency_value->value,
						 'shipping_method'  =>  $shipping_method,
						 'currency'  =>  $currency_value ? $currency_value->symbol_left ? $currency_value->symbol_left : $currency_value->symbol_right : '$',
						 'currency_value' => $currency_value ? $currency_value->value : 1 ,
						 'coupon_code'		 =>		$code,
						 'coupon_amount' 	 =>		$coupon_amount / $currency_value->value,
						 'total_tax'		 =>		$total_tax / $currency_value->value,
						 'ordered_source' 	 => 	$ordered_source,
						 'delivery_phone'	 =>		$delivery_phone,
						 'billing_phone'	 =>		$billing_phone,
						 'coupon_code_id'	 =>     $coupon_code_id,
						 'points_amount'	 =>     $points_amount,
             'cashier_id'      =>    $cashier_id,
             'discount_amount' =>    $discount_amount,
             'order_type'      =>    'normal',
					]);

				}else{

				//insert order
        $RefNo = md5(uniqid(rand(), true));
				$orders_id = DB::table('orders')->insertGetId(
					[	 'customers_id' => $customers_id,
						 'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
						 'customers_street_address' => $delivery_street_address,
						 'customers_suburb'  =>  $delivery_suburb,
						 'customers_city' => $delivery_city,
						 'customers_postcode'  => $delivery_postcode,
						 'customers_state' => $delivery_state,
						 'customers_country'  =>  $delivery_country,
						 'customers_telephone' => $customers_telephone,
						 'email'  => $email,

						 'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
						 'delivery_street_address' => $delivery_street_address,
						 'delivery_suburb'  => $delivery_suburb,
						 'delivery_city' => $delivery_city,
						 'delivery_postcode'  =>  $delivery_postcode,
						 'delivery_state' => $delivery_state,
						 'delivery_country'  => $delivery_country,
             'delivery_latitude'  =>  $delivery_latitude,
						 'delivery_longitude'  =>  $delivery_longitude,

						 'billing_name'  => $billing_firstname.' '.$billing_lastname,
						 'billing_street_address' => $billing_street_address,
						 'billing_suburb'  =>  $billing_suburb,
						 'billing_city' => $billing_city,
						 'billing_postcode'  => $billing_postcode,
						 'billing_state' => $billing_state,
						 'billing_country'  =>  $billing_country,

						 'payment_method'  =>  $paymentMethodName,
						 'cc_type' => $cc_type,
						 'cc_owner'  => $cc_owner,
						 'cc_number' =>$cc_number,
						 'cc_expires'  =>  $cc_expires,
						 'last_modified' => $last_modified,
						 'date_purchased'  => $date_purchased,
						 'order_price'  => $order_price / $currency_value->value,
						 'order_weight'  => $order_weight,
						 'order_km'  => $order_km,
						 'shipping_cost' =>$shipping_cost / $currency_value->value,
						 'shipping_method'  =>  $shipping_method,
						 'currency'  =>  $currency_value ? $currency_value->symbol_left ? $currency_value->symbol_left : $currency_value->symbol_right : '$',
						 'currency_value' => $currency_value ? $currency_value->value : 1 ,
						 'order_information' => json_encode($order_information),
						 'coupon_code'		 =>		$code,
						 'coupon_amount' 	 =>		$coupon_amount / $currency_value->value,
						 'total_tax'		 =>		$total_tax / $currency_value->value,
						 'ordered_source' 	 => $ordered_source,
						 'delivery_phone'	 =>		$delivery_phone,
						 'billing_phone'	 =>		$billing_phone,
             'transaction_id'  =>  $RefNo,
             'payment_status'  => $pay_status,
             'coupon_code_id'	 =>     $coupon_code_id,
						 'points_amount'	 =>     $points_amount,
             'cashier_id'      =>    $cashier_id,
             'discount_amount' =>    $discount_amount,
             'order_type'      =>    'normal',
					]);

				}

        if(!empty($request->pres_image))
          {
            foreach($request->pres_image as $image)
                {
                    $name = 'pres_'.rand(11111, 99999).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/prescription');
                    $imagePath = $destinationPath. "/".  $name;
                    $image->move('uploads/prescription/' , $name);
                    $new_image = 'uploads/prescription/'.$name ;
                    $image_name[] = $new_image; 
                }
                $imagename=implode(",",$image_name);
            }
          else{
            $imagename=NULL;
          }

          DB::table('orders')->where('orders_id', $orders_id)->update(['prescription_image' => $imagename]);
       
        if($point_transaction_id != '0' && $ordered_source=='2') {
                // update transaction_points table
            DB::table('transaction_points')->where('id', $point_transaction_id)->update([
                    'order_id' => $orders_id,
                    'status'=>'1'
                     ]);

  $loyalty_id = DB::table('transaction_points')->where('id', $point_transaction_id)->first();
  
             if($loyalty_id)
            {
              $lid = $loyalty_id->loyalty_id;

              DB::table('redeem_points_voucher')->where('id',$lid)->update([
                'status' => '1',
            ]);
            } 

            

            // delete temp_point_transaction table
            DB::table('temp_point_transaction')->where('trans_id', $point_transaction_id)->delete();
          }
         
				 //orders status history
				 $orders_history_id = DB::table('orders_status_history')->insertGetId(
					[	 'orders_id'  => $orders_id,
						 'orders_status_id' => $orders_status,
						 'date_added'  => $date_added,
						 'customer_notified' =>'1',
						 'comments'  =>  $comments
					]);

          //orders update
          $orders_update = DB::table('orders')->where('orders_id',$orders_id)->update(['order_status_id' => 1]);

				foreach($request->cart_id as $cartid){
                  $cartdata=DB::table('customers_basket')->where('customers_basket_id', $cartid)->first();
                  $product=DB::table('products_description')->where('products_id', $cartdata->products_id)->first();
                  $prodata=DB::table('products')->where('products_id', $cartdata->products_id)->first();
                  $c_price = str_replace(',','',$cartdata->final_price);
                  $c_final_price = str_replace(',','',$cartdata->final_price);
                  $price =$c_price;
                  $final_price = $c_final_price*$cartdata->customers_basket_quantity/$currency_value->value;

                  $orders_products_id = DB::table('orders_products')->insertGetId(
                    [
                       'orders_id'       =>   $orders_id,
                       'products_id'     =>   $cartdata->products_id,
                       'products_name'   =>   $product->products_name,
                       'products_model'  =>   $prodata->products_model,
                       'products_price'  =>   $price/$currency_value->value,
                       'final_price'     =>   $final_price,
                       'products_tax'    =>   $products_tax,
                       'products_quantity' =>   $cartdata->customers_basket_quantity,
                       'discount_price'    => $cartdata->discount_price,
                       'total_quantity'   => $cartdata->total_basket_quantity,
                    ]);

                  if($is_inventory == 1){
                      $inventory_ref_id = DB::table('inventory')->insertGetId([
                        'products_id'        =>   $cartdata->products_id,
                        'reference_code'     =>   $orders_id,
                        'orders_products_id' => $orders_products_id,
                        'stock'          =>   $cartdata->total_basket_quantity,
                        'admin_id'        =>  0,
                        'added_date'        => time(),
                        'created_at' => date('Y-m-d h:i:s'),
                        'purchase_price'      =>  0,
                        'stock_type'        =>  'out',
                      ]);
                      // insert product_combo and Buy X and Get X stock
                      if($prodata->products_type == 3){
                        $comboPro = DB::table('product_combo')->where('pro_id', $prodata->products_id)->get();
                          if(!$comboPro->isEmpty()){
                              foreach($comboPro as $key=>$comboProd){

                                  $inventory_combo_id = DB::table('inventory')->insertGetId([
                                    'products_id'        =>   $comboProd->product_id,
                                    'reference_code'     =>   $orders_id,
                                    'orders_products_id' => $orders_products_id,
                                    'stock'          =>   $comboProd->qty,
                                    'admin_id'        =>  0,
                                    'added_date'        => time(),
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'purchase_price'      =>  0,
                                    'stock_type'        =>  'out',
                                  ]);
                                  // insert product_combo attributes stock
                                  if($comboProd->attractive_id != '0'){
                                      DB::table('inventory_detail')->insert([
                                          'inventory_ref_id'  =>  $inventory_combo_id,
                                          'products_id'     =>   $comboProd->product_id,
                                          'attribute_id'    =>   $comboProd->attractive_id,
                                      ]);
                                  }

                              }
                          }
                      }elseif($prodata->products_type == 4){
                          $comboProgetx = DB::table('product_get_x')
                           ->join('product_buy_x', 'product_buy_x.pro_id', '=', 'product_get_x.pro_id')
                           ->where('product_get_x.pro_id', $prodata->products_id)
                           ->where('product_buy_x.pro_id', $prodata->products_id)
                           ->get();

                           if(!$comboProgetx->isEmpty()){
                              foreach($comboProgetx as $key=>$comboProdgetx){

                                $inventory_buyx_id = DB::table('inventory')->insertGetId([
                                    'products_id'        =>   $comboProdgetx->product_id,
                                    'reference_code'     =>   $orders_id,
                                    'orders_products_id' => $orders_products_id,
                                    'stock'          =>   $comboProdgetx->qty,
                                    'admin_id'        =>  0,
                                    'added_date'        => time(),
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'purchase_price'      =>  0,
                                    'stock_type'        =>  'out',
                                  ]);
                                // insert Buy X and Get X attributes stock
                                if($comboProdgetx->attractive_id != '0'){
                                    DB::table('inventory_detail')->insert([
                                          'inventory_ref_id'  =>  $inventory_buyx_id,
                                          'products_id'     =>   $comboProdgetx->product_id,
                                          'attribute_id'    =>   $comboProdgetx->attractive_id,
                                    ]);
                                }
                              }
                           }
                      }
                    }

                    $attrdata=DB::table('customers_basket_attributes')->where('customers_basket_id', $cartid)->get();
                    if (!$attrdata->isEmpty()) {
                         foreach ($attrdata as $key => $value) {
                            $attresult=DB::table('products_attributes')->where(['products_id'=>$value->products_id,'options_id'=>$value->products_options_id,'options_values_id'=>$value->products_options_values_id])->first();
                            $option_name=DB::table('products_options_descriptions')->where(['products_options_id'=>$value->products_options_id])->first();
                            $option_val_name=DB::table('products_options_values_descriptions')->where(['products_options_values_id'=>$value->products_options_values_id])->first();

                            DB::table('orders_products_attributes')->insert(
                              [
                                 'orders_id' => $orders_id,
                                 'products_id'  => $value->products_id,
                                 'orders_products_id'  => $orders_products_id,
                                 'products_options' =>$option_name->options_name,
                                 'products_options_values'  =>  $option_val_name->options_values_name,
                                 'options_values_price'  =>  $attresult->options_values_price,
                                 'price_prefix'  =>  $attresult->price_prefix
                              ]);
                          if($is_inventory == 1){
                              DB::table('inventory_detail')->insert([
                                  'inventory_ref_id'  =>   $inventory_ref_id,
                                  'products_id'     =>   $value->products_id,
                                  'attribute_id'    =>   $attresult->products_attributes_id,
                              ]);
                          }
                          // delete customers_basket_attributes data
                          DB::table('customers_basket_attributes')->where('customers_basket_attributes_id', '=', $value->customers_basket_attributes_id)->delete();
                        } 
                    }

                    // delete customers_basket data
                    DB::table('customers_basket')->where('customers_basket_id', '=', $cartid)->delete();
                }

         // check_table_pos
         if($request->order_type=='table'){
            $table = DB::table('booking_table')->where('qrcode', '=', $request->session_id)->first();
            if($table){
                // update booking_table table
                DB::table('booking_table')->where('id', $table->id)->update([
                    'status' => 'checkout',
                    'checkout_date' => date('Y-m-d h:i:s'),
                ]);
            }
         }

         // delete temp_pos_coupons data
         if(!empty($request->session_id)){
            $pos_coupons = DB::table('temp_pos_coupons')->where('session_id', '=', $request->session_id)->first();
            if($pos_coupons){
               // delete temp_pos_coupons data
                DB::table('temp_pos_coupons')->where('session_id', '=', $request->session_id)->delete();
            }

            // delete pos hold data
                  $hold_data = DB::table('hold')->where('session_id', '=', $request->session_id)->first();
                  if($hold_data){
                    // delete hold data
                      DB::table('hold')->where('session_id', '=', $request->session_id)->delete();
                  }
         }
			

				//send order email to user
				$order = DB::table('orders')
					->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
					->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
					->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

			//foreach
			foreach($order as $data){
				$orders_id	 = $data->orders_id;

        $orders_products = DB::table('orders_products')
        ->join('products', 'products.products_id', '=', 'orders_products.products_id')
        ->join('image_categories', 'products.products_image', '=', 'image_categories.image_id')
        ->select('image_categories.path as image', 'image_categories.path_type as image_path_type', 'orders_products.*')
        ->where('orders_products.orders_id', '=', $orders_id)
        ->groupBy('products.products_id')
        ->get();
        
					$i = 0;
					$total_price  = 0;
					$product = array();
					$subtotal = 0;
					foreach($orders_products as $orders_products_data){
						$product_attribute = DB::table('orders_products_attributes')
							->where([
								['orders_products_id', '=', $orders_products_data->orders_products_id],
								['orders_id', '=', $orders_products_data->orders_id],
							])
							->get();

						$orders_products_data->attribute = $product_attribute;
						$product[$i] = $orders_products_data;
						//$total_tax	 = $total_tax+$orders_products_data->products_tax;
						$total_price = $total_price+$orders_products[$i]->final_price;

						$subtotal += $orders_products[$i]->final_price;

						$i++;
					}

				$data->data = $product;
				$orders_data[] = $data;
			}

				$orders_status_history = DB::table('orders_status_history')
					->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
					->orderBy('orders_status_history.date_added', 'desc')
					->where('orders_id', '=', $orders_id)->get();

				$orders_status = DB::table('orders_status')->get();

				$ordersData['orders_data']		 	 	=	$orders_data;
				$ordersData['total_price']  			=	$total_price;
				$ordersData['orders_status']			=	$orders_status;
				$ordersData['orders_status_history']    =	$orders_status_history;
				$ordersData['subtotal']    				=	$subtotal;

        // add pos Loyalty point
        if($ordered_source=='3'){
          $exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->get();
          $settings = DB::table('settings')->where('id', '=','148')->first();
           //print_r(count($exist));die();
          if(count($exist)=='0' && $settings->value == '1'){

            $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();

            if($point){
                $cdata = DB::table('users')->where('id', $customers_id)->first();
                $no_rm = $point->no_rm;
                $no_point = $point->points;
                $amount = $order_user->order_price-$order_user->shipping_cost;
                $count_rm = round($amount/$no_rm);
                $give_point = $count_rm*$no_point;

                //print_r($give_point);die();
                $oldbalnce=$cdata->loyalty_points;
                $newbalnce=$cdata->loyalty_points+$give_point;

                 //insert point details
                    DB::table('transaction_points')->insert([
                        'user_id' => $order_user->customers_id,
                        'order_id'=> $orders_id,
                        'points' => $give_point,
                        'balance_points' => $newbalnce,
                        'points_status' => 'in',
                        'description'=>'Make Purchase',
                        'created_at' => $date_added,
                        'updated_at' => $date_added
                    ]);
              // update user table
                DB::table('users')->where('id', $order_user->customers_id)->update([
                    'loyalty_points' => $newbalnce,
                ]);
            }
          }
        }
				//notification/email
				$myVar = new AlertController();
     
        if($payment_method != 'Paytm')
        {
				  $alertSetting = $myVar->orderAlert($ordersData);
        }
        if($payment_method == 'directbank')
        {
          $responseData = array('success'=>'1', 'data'=>array(), 'customer_id' => $customers_id,'transaction_id'=>$RefNo,'order_id'=>$orders_id,'bank_information'=>$order_information, 'message'=>"Order has been placed successfully.");
          // send push notification cashier
          $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id')
          ->where('users.role_id', '=', '14')->where('users.status', '=', '1')->get();
          if(!$cashier->isEmpty()){
            foreach ($cashier as $jescashier) {
                $token=$jescashier->device_id;
                $title='New Order';
                $message='New order has been placed';
                $myVar->sendNotificationsCashier($token,$title,$message);
            }
          }

        }
        else
        {

        $responseData = array('success'=>'1', 'data'=>array(), 'customer_id' => $customers_id,'transaction_id'=>$RefNo,'order_id'=>$orders_id,'message'=>"Order has been placed successfully.");
        // send push notification cashier
          $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id')
          ->where('users.role_id', '=', '14')->where('users.status', '=', '1')->get();
          if(!$cashier->isEmpty()){
            foreach ($cashier as $jescashier) {
                $token=$jescashier->device_id;
                $title='New Order';
                $message='New order has been placed';
                $myVar->sendNotificationsCashier($token,$title,$message);
            }
          }
        }

			}else if($payment_status == "failed"){
				if(!empty($error_cybersource)){
					$return_error = $error_cybersource;
				}else{
					$return_error = 'Error while placing order.';
				}
				$responseData = array('success'=>'0', 'data'=>array(), 'message'=>$error_cybersource);
			}
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function getorders($request)
{
  $consumer_data 		 				  =  array();
  $customers_id						  =  $request->customers_id;
  $language_id						  =  $request->language_id;
  $requested_currency       =  $request->currency_code;
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){

    $order = DB::table('orders')->orderBy('orders_id', 'desc')
        ->where([
          ['customers_id', '=', $customers_id],
        ])->get();


    if(count($order) > 0){
      //foreach
      $index = '0';
      foreach($order as $data){
        // deliveryboy 
        $current_boy = DB::table('orders_to_delivery_boy')
                ->leftjoin('users', 'users.id', '=', 'orders_to_delivery_boy.deliveryboy_id')
                ->LeftJoin('deliveryboy_info', 'deliveryboy_info.users_id', '=', 'users.id')
                 ->select('orders_to_delivery_boy.*',
                  'users.*',
                  'deliveryboy_info.*',
                  'deliveryboy_info.users_id as deliveryboy_id'                 
                )
                ->where('orders_to_delivery_boy.orders_id', '=', $data->orders_id)
                ->where('orders_to_delivery_boy.is_current', '=', '1')
                ->orderby('orders_to_delivery_boy.created_at', 'DESC')
                ->get();
        
        if(count($current_boy)>0){
          $data->deliveryboy_info = $current_boy; 
        }else{
          $data->deliveryboy_info = array(); 
        }
        $data->total_tax =  $data->total_tax*$data->currency_value;
        $data->order_price =  $data->order_price*$data->currency_value;
        $data->shipping_cost =  $data->shipping_cost*$data->currency_value;
        $data->coupon_amount =  $data->coupon_amount*$data->currency_value;

        if(!empty($data->product_discount_percentage)){
          $product_ids = explode(',', $coupons[0]->product_ids);
          $data->product_ids =  $product_ids;
        }
        else{
          $data->product_ids = array();
        }

        if(!empty($data->discount_type)){
          $exclude_product_ids = explode(',', $data->discount_type);
          $data->discount_type =  $exclude_product_ids;
        }else{
          $data->discount_type =  array();
        }

        if(!empty($data->amount)){
          $product_categories = explode(',', $data[0]->amount);
          $data->amount =  $product_categories;
        }else{
          $data->amount =  array();
        }

        if(!empty($data->product_ids)){
          $excluded_product_categories = explode(',', $data->product_ids);
          $data->product_ids =  $excluded_product_categories;
        }else{
          $data->product_ids = array();
        }

        if(!empty($data->exclude_product_ids)){
          $email_restrictions = explode(',', $data->exclude_product_ids);
          $data->exclude_product_ids =  $email_restrictions;
        }else{
          $data->exclude_product_ids =  array();
        }

        if(!empty($data->usage_limit)){
          $used_by = explode(',', $data->usage_limit);
          $data->usage_limit =  $used_by;
        }else{
          $data->usage_limit =  array();
        }

        if(!empty($data->product_categories)){
          $used_by = explode(',', $data->product_categories);
          $data->product_categories =  $used_by;
        }else{
          $data->product_categories =  array();
        }

        if(!empty($data->excluded_product_categories)){
          $used_by = explode(',', $data->excluded_product_categories);
          $data->excluded_product_categories =  $used_by;
        }else{
          $data->excluded_product_categories =  array();
        }

        if(!empty($data->coupon_code)){

          $coupon_code =  $data->coupon_code;

          $coupon_datas = array();
          $index_c = 0;
          foreach(json_decode($coupon_code) as $coupon_codes){

            if(!empty($coupon_codes->code)){
              $code = explode(',', $coupon_codes->code);
              $coupon_datas[$index_c]['code'] =  $code[0];
            }else{
              $coupon_datas[$index_c]['code'] =  '';
            }

            if(!empty($coupon_codes->amount)){
              $amount = explode(',', $coupon_codes->amount);
              $amount =  Orders::convertprice($amount[0], $requested_currency);
              //$coupon_datas[$index_c]['amount'] =  $amount;

              $coupon_datas[$index_c]['amount'] = $coupon_codes->amount;
            }else{
              $coupon_datas[$index_c]['amount'] =  '';
            }


            if(!empty($coupon_codes->discount_type)){
              $discount_type = explode(',', $coupon_codes->discount_type);
              $coupon_datas[$index_c]['discount_type'] =  $discount_type[0];
            }else{
              $coupon_datas[$index_c]['discount_type'] =  '';
            }

            $index_c++;
          }
          $order[$index]->coupons = $coupon_datas;
        }
        else{
          $coupon_code =  array();
          $order[$index]->coupons = $coupon_code;
        }

        unset($data->coupon_code);

        $orders_id	 = $data->orders_id;

        $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->select('orders_status_history.orders_status_history_id','orders_status_description.orders_status_name', 'orders_status.orders_status_id', 'orders_status_history.comments', 'orders_status_history.date_added')
            ->where('orders_id', '=', $orders_id)
            ->where('orders_status.role_id','=',2)->where('orders_status_description.language_id','=',$language_id)->orderby('orders_status_history.orders_status_history_id', 'ASC')->get();

        $order[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
        $order[$index]->orders_status = $orders_status_history[0]->orders_status_name;
        $order[$index]->orders_status_date_added = $orders_status_history[0]->date_added;
        $order[$index]->customer_comments = $orders_status_history[0]->comments;

        $total_comments = count($orders_status_history);
        $i = 1;

        $order[$index]->orders_status_history = $orders_status_history;

        foreach($orders_status_history as $orders_status_history_data){

          if($total_comments == $i && $i != 1){
            $order[$index]->orders_status_id = $orders_status_history_data->orders_status_id;
            $order[$index]->orders_status = $orders_status_history_data->orders_status_name;
            $order[$index]->orders_status_date_added = $orders_status_history_data->date_added;
            $order[$index]->admin_comments = $orders_status_history_data->comments;
          }else{
            $order[$index]->admin_comments = '';
          }

          $i++;
        }

        $orders_products = DB::table('orders_products')
        ->join('products', 'products.products_id','=', 'orders_products.products_id')
        ->LeftJoin('image_categories', function ($join) {
          $join->on('image_categories.image_id', '=', 'products.products_image')
              ->where(function ($query) {
                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
              });
        })
        ->select('orders_products.*', 'image_categories.path as image')
        ->where('orders_products.orders_id', '=', $orders_id)->get();
        $k = 0;
        $product = array();
        foreach($orders_products as $orders_products_data){
          // $orders_products_data->products_price =  Orders::convertprice($orders_products_data->products_price, $requested_currency);
          // $orders_products_data->final_price =  Orders::convertprice($orders_products_data->final_price, $requested_currency);
          //categories
          $categories = DB::table('products_to_categories')
                  ->leftjoin('categories','categories.categories_id','products_to_categories.categories_id')
                  ->leftjoin('categories_description','categories_description.categories_id','products_to_categories.categories_id')
                  ->select('categories.categories_id','categories_description.categories_name',
                  'categories.categories_image','categories.categories_icon', 'categories.parent_id')
                  ->where('products_id','=', $orders_products_data->products_id)
                  ->where('categories_description.language_id','=',$language_id)->get();

          $orders_products_data->categories =  $categories;

          $product_attribute = DB::table('orders_products_attributes')
            ->where([
              ['orders_products_id', '=', $orders_products_data->orders_products_id],
              ['orders_id', '=', $orders_products_data->orders_id],
            ])
            ->get();

          $orders_products_data->attributes = $product_attribute;
          $orders_products_data->final_price = number_format($orders_products_data->final_price * $data->currency_value,2,'.','');
          $orders_products_data->products_price = number_format($orders_products_data->products_price * $data->currency_value,2,'.','');
         
          $product[$k] = $orders_products_data;
          $k++;
        }
        $data->data = $product;
        $orders_data[] = $data;
      $index++;
      }
        $responseData = array('success'=>'1', 'data'=>$orders_data, 'message'=>"Returned all orders.");
    }else{
        $orders_data = array();
        $responseData = array('success'=>'0', 'data'=>$orders_data, 'message'=>"Order is not placed yet.");
    }
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}


public static function getordersbyid($request)
{
  $consumer_data 		 				  =  array();
  $order_id						  =  $request->order_id;
  $customers_id						  =  $request->customers_id;
  $language_id						  =  $request->language_id;
  $requested_currency       =  $request->currency_code;
  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  $consumer_data['consumer_url']  	  =  __FUNCTION__;
  $authController = new AppSettingController();
  $authenticate = $authController->apiAuthenticate($consumer_data);

  if($authenticate==1){

    $order = DB::table('orders')->orderBy('orders_id', 'desc')
    ->where('orders_id','=', $order_id)
    ->where('customers_id','=', $customers_id)
    ->get();


    if(count($order) > 0){
      //foreach
      $index = '0';
      foreach($order as $data){
        // deliveryboy 
        $current_boy = DB::table('orders_to_delivery_boy')
                ->leftjoin('users', 'users.id', '=', 'orders_to_delivery_boy.deliveryboy_id')
                ->LeftJoin('deliveryboy_info', 'deliveryboy_info.users_id', '=', 'users.id')
                 ->select('orders_to_delivery_boy.*',
                  'users.*',
                  'deliveryboy_info.*',
                  'deliveryboy_info.users_id as deliveryboy_id'                 
                )
                ->where('orders_to_delivery_boy.orders_id', '=', $data->orders_id)
                ->where('orders_to_delivery_boy.is_current', '=', '1')
                ->orderby('orders_to_delivery_boy.created_at', 'DESC')
                ->get();
        
        if(count($current_boy)>0){
          $data->deliveryboy_info = $current_boy; 
        }else{
          $data->deliveryboy_info = array(); 
        }
        $data->total_tax =  $data->total_tax*$data->currency_value;
        $data->order_price =  $data->order_price*$data->currency_value;
        $data->shipping_cost =  $data->shipping_cost*$data->currency_value;
        $data->coupon_amount =  $data->coupon_amount*$data->currency_value;

        if(!empty($data->product_discount_percentage)){
          $product_ids = explode(',', $coupons[0]->product_ids);
          $data->product_ids =  $product_ids;
        }
        else{
          $data->product_ids = array();
        }

        if(!empty($data->discount_type)){
          $exclude_product_ids = explode(',', $data->discount_type);
          $data->discount_type =  $exclude_product_ids;
        }else{
          $data->discount_type =  array();
        }

        if(!empty($data->amount)){
          $product_categories = explode(',', $data[0]->amount);
          $data->amount =  $product_categories;
        }else{
          $data->amount =  array();
        }

        if(!empty($data->product_ids)){
          $excluded_product_categories = explode(',', $data->product_ids);
          $data->product_ids =  $excluded_product_categories;
        }else{
          $data->product_ids = array();
        }

        if(!empty($data->exclude_product_ids)){
          $email_restrictions = explode(',', $data->exclude_product_ids);
          $data->exclude_product_ids =  $email_restrictions;
        }else{
          $data->exclude_product_ids =  array();
        }

        if(!empty($data->usage_limit)){
          $used_by = explode(',', $data->usage_limit);
          $data->usage_limit =  $used_by;
        }else{
          $data->usage_limit =  array();
        }

        if(!empty($data->product_categories)){
          $used_by = explode(',', $data->product_categories);
          $data->product_categories =  $used_by;
        }else{
          $data->product_categories =  array();
        }

        if(!empty($data->excluded_product_categories)){
          $used_by = explode(',', $data->excluded_product_categories);
          $data->excluded_product_categories =  $used_by;
        }else{
          $data->excluded_product_categories =  array();
        }

        if(!empty($data->coupon_code)){

          $coupon_code =  $data->coupon_code;

          $coupon_datas = array();
          $index_c = 0;
          foreach(json_decode($coupon_code) as $coupon_codes){

            if(!empty($coupon_codes->code)){
              $code = explode(',', $coupon_codes->code);
              $coupon_datas[$index_c]['code'] =  $code[0];
            }else{
              $coupon_datas[$index_c]['code'] =  '';
            }

            if(!empty($coupon_codes->amount)){
              $amount = explode(',', $coupon_codes->amount);
              $amount =  Orders::convertprice($amount[0], $requested_currency);
              //$coupon_datas[$index_c]['amount'] =  $amount;

              $coupon_datas[$index_c]['amount'] = $coupon_codes->amount;
            }else{
              $coupon_datas[$index_c]['amount'] =  '';
            }


            if(!empty($coupon_codes->discount_type)){
              $discount_type = explode(',', $coupon_codes->discount_type);
              $coupon_datas[$index_c]['discount_type'] =  $discount_type[0];
            }else{
              $coupon_datas[$index_c]['discount_type'] =  '';
            }

            $index_c++;
          }
          $order[$index]->coupons = $coupon_datas;
        }
        else{
          $coupon_code =  array();
          $order[$index]->coupons = $coupon_code;
        }

        unset($data->coupon_code);

        $orders_id	 = $data->orders_id;

        $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->select('orders_status_history.orders_status_history_id','orders_status_description.orders_status_name', 'orders_status.orders_status_id', 'orders_status_history.comments', 'orders_status_history.date_added')
            ->where('orders_id', '=', $orders_id)
            ->where('orders_status.role_id','=',2)->where('orders_status_description.language_id','=',$language_id)->orderby('orders_status_history.orders_status_history_id', 'ASC')->get();

        $order[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
        $order[$index]->orders_status = $orders_status_history[0]->orders_status_name;
        $order[$index]->orders_status_date_added = $orders_status_history[0]->date_added;
        $order[$index]->customer_comments = $orders_status_history[0]->comments;

        $total_comments = count($orders_status_history);
        $i = 1;

        $order[$index]->orders_status_history = $orders_status_history;

        foreach($orders_status_history as $orders_status_history_data){

          if($total_comments == $i && $i != 1){
            $order[$index]->orders_status_id = $orders_status_history_data->orders_status_id;
            $order[$index]->orders_status = $orders_status_history_data->orders_status_name;
            $order[$index]->admin_comments = $orders_status_history_data->comments;
          }else{
            $order[$index]->admin_comments = '';
          }

          $i++;
        }

        $orders_products = DB::table('orders_products')
        ->join('products', 'products.products_id','=', 'orders_products.products_id')
        ->LeftJoin('image_categories', function ($join) {
          $join->on('image_categories.image_id', '=', 'products.products_image')
              ->where(function ($query) {
                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
              });
        })
        ->select('orders_products.*', 'image_categories.path as image')
        ->where('orders_products.orders_id', '=', $orders_id)->get();
        $k = 0;
        $product = array();
        foreach($orders_products as $orders_products_data){
          // $orders_products_data->products_price =  Orders::convertprice($orders_products_data->products_price, $requested_currency);
          // $orders_products_data->final_price =  Orders::convertprice($orders_products_data->final_price, $requested_currency);
          //categories
          $categories = DB::table('products_to_categories')
                  ->leftjoin('categories','categories.categories_id','products_to_categories.categories_id')
                  ->leftjoin('categories_description','categories_description.categories_id','products_to_categories.categories_id')
                  ->select('categories.categories_id','categories_description.categories_name',
                  'categories.categories_image','categories.categories_icon', 'categories.parent_id')
                  ->where('products_id','=', $orders_products_data->products_id)
                  ->where('categories_description.language_id','=',$language_id)->get();

          $orders_products_data->categories =  $categories;

          $product_attribute = DB::table('orders_products_attributes')
            ->where([
              ['orders_products_id', '=', $orders_products_data->orders_products_id],
              ['orders_id', '=', $orders_products_data->orders_id],
            ])
            ->get();

          $orders_products_data->attributes = $product_attribute;
          $orders_products_data->final_price = $orders_products_data->final_price * $data->currency_value;
          $orders_products_data->products_price = $orders_products_data->products_price * $data->currency_value;
         
          $product[$k] = $orders_products_data;
          $k++;
        }
        $data->data = $product;
        $orders_data[] = $data;
      $index++;
      }
        $responseData = array('success'=>'1', 'data'=>$orders_data, 'message'=>"Returned all orders.");
    }else{
        $orders_data = array();
        $responseData = array('success'=>'0', 'data'=>$orders_data, 'message'=>"Order is not placed yet.");
    }
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function updatestatus($request)
{

  		$consumer_data 		 				  =  array();
  		$orders_id							  =  $request->orders_id;
  		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
  		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
  		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
  		$consumer_data['consumer_url']  	  =  __FUNCTION__;
  		$authController = new AppSettingController();
  		$authenticate = $authController->apiAuthenticate($consumer_data);

  		if($authenticate==1){

  			$date_added			=    date('Y-m-d h:i:s');
  			$comments			=	 '';
  			$orders_history_id = DB::table('orders_status_history')->insertGetId(
  				[	 'orders_id'  => $orders_id,
  					 'orders_status_id' => '3',
  					 'date_added'  => $date_added,
  					 'customer_notified' =>'1',
  					 'comments'  =>  $comments
  				]);

  			$responseData = array('success'=>'1', 'data'=>array(), 'message'=>"Status has been changed succefully.");

  		}else{
  			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  		}
  		$orderResponse = json_encode($responseData);

      return $orderResponse;
}

public static function get_client_ip_env(){
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

  public static function getpaymentstatus($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate==1){
         if($request->transaction_id == ''){
            $responseData = array('success'=>'0', 'message'=>"Required all Fields");
         }else{
            $order = DB::table('orders')->select('orders_id','customers_name','payment_method','payment_status','transaction_id')->where([['transaction_id', '=', $request->transaction_id],])->first();
            if($order){
                $responseData = array('success'=>'1', 'data'=>$order, 'message'=>"Returned  orders.");
            }else{
               $responseData = array('success'=>'0', 'message'=>"No data found");
            }
         }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);

      return $orderResponse;
  }

  public static function geofencing($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate==1){
         if($request->country_id =='' || $request->state_id =='' ||  $request->pincode ==''){
             $responseData = array('success'=>'0', 'message'=>"Required all Fields");
         }else{

          $geofencingCountry = DB::table('geo_fencing')->where('status', '1')->where('country_id', $request->country_id)->first();
          $geocheck = 0;
          if($geofencingCountry !='')
          { 
             if($geofencingCountry->state_id !='')
             { 
             $geofencingCountryState = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->state_id)->where('country_id', $geofencingCountry->country_id)->first();
                  if($geofencingCountryState !='')
                  { 
                      if($geofencingCountryState->pincode !='')
                      { 
                          $geofencingCountryStatepostcode = DB::table('geo_fencing')->where('status', '1')->where('state_id', $geofencingCountryState->state_id)->where('country_id', $geofencingCountryState->country_id)->WhereRaw('FIND_IN_SET(' .$request->pincode. ',pincode)')->first();
                          if($geofencingCountryStatepostcode !='')
                          { 
                              $geocheck = 1;
                          }
                          else
                          {
                              $geocheck = 0;
                          }
                      }
                      else
                      {
                          $geocheck = 1;
                      }
                  }
                  else
                  {
                      $geocheck = 0;
                  }
             }
             else
             {
                 $geocheck = 1; 
             }
          }
          else
          {
             $geocheck = 0;
          }
      
          
           
           if($geocheck == 1){
              $responseData = array('success'=>'1',   'message'=>"Delivery available.");
           }else{
            $responseData = array('success'=>'0', 'message'=>"Unable to deliver under this address.");
           }
         }  
      }else{
         $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
       $orderResponse = json_encode($responseData);
       return $orderResponse;
  }

  public static function cancelorder($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate==1){
        if($request->orders_id =='' || $request->customers_id == '' || $request->old_orders_status ==''){
             $responseData = array('success'=>'0', 'message'=>"Required all Fields");
         }else{

            $date_added = date('Y-m-d H:i:s');
            $orders_id = $request->orders_id;
            $old_orders_status = $request->old_orders_status;
            $customers_id = $request->customers_id;


             //orders status history
        $orders_history_id = DB::table('orders_status_history')->insertGetId(
            ['orders_id' => $orders_id,
                'orders_status_id' => '3',
                'date_added' => $date_added,
                'customer_notified' => '1',
                'comments' => $request->comments,
            ]);

            $current_boy = DB::table('orders_to_delivery_boy')
            ->leftjoin('deliveryboy_info','deliveryboy_info.users_id','=','orders_to_delivery_boy.deliveryboy_id')
            ->where('orders_to_delivery_boy.orders_id', '=', $orders_id)
            ->where('orders_to_delivery_boy.is_current', '=', '1')
            ->orderby('orders_to_delivery_boy.created_at', 'DESC')
            ->first();

            if (!empty($current_boy->deliveryboy_id) and $old_orders_status != '2') {

                    DB::table('users_balance')
                    ->where('products_id', 0)
                    ->where('users_id', $current_boy->deliveryboy_id)
                    ->where('orders_id', $orders_id)
                    ->update([
                        'status' => 'Recharge Back',
                        'admin_id' => $customers_id,
                    ]);

                    //update balance table
                    DB::table('users_balance')->insertGetId(
                    ['orders_id' => $orders_id,
                        'users_id' => $current_boy->deliveryboy_id,
                        'products_id' => 0,
                        'created_at' => $date_added,
                        'updated_at' => $date_added,
                        'transaction_type' => 'out',
                        'amount' => $current_boy->commission,
                        'status' => 'Cancelled By User',
                        'admin_id' => $customers_id,
                    ]
                    );
              }

           $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_id)->get();
           foreach ($orders_products as $products_data) {
               $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
               $date_added = date('Y-m-d H:i:s');

               $inventory_ref_id = DB::table('inventory')->insertGetId([
                    'products_id' => $products_data->products_id,
                    'stock' => $products_data->products_quantity,
                    'reference_code' => $products_data->orders_id,
                    'admin_id' => $customers_id,
                    'added_date' => time(),
                    'created_at' => $date_added,
                    'stock_type' => 'in',

                ]);

                if ($product_detail->products_type == 1) {
                  $product_attribute = DB::table('orders_products_attributes')
                        ->where([
                            ['orders_products_id', '=', $products_data->orders_products_id],
                            ['orders_id', '=', $products_data->orders_id],
                        ])
                        ->get();
                   foreach ($product_attribute as $attribute) {
                      $prodocuts_attributes = DB::table('products_attributes')
                            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                            ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'options_values_id')
                            ->where('products_options_values_descriptions.options_values_name', $attribute->products_options_values)
                            ->where('products_options_descriptions.options_name', $attribute->products_options)
                            ->select('products_attributes.products_attributes_id')
                            ->first();

                        DB::table('inventory_detail')->insert([
                            'inventory_ref_id' => $inventory_ref_id,
                            'products_id' => $products_data->products_id,
                            'attribute_id' => $prodocuts_attributes->products_attributes_id,
                        ]);
                   }
                }
           }

           // update point
            $settings = DB::table('settings')->where('id', '=','148')->first();
            if($settings->value == '1'){
              $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();

              $outpoint = DB::table('transaction_points')->where('user_id', '=', $order_user->customers_id)->where('points_status', '=', 'out')->where('order_id', '=', $orders_id)->get();

                if(!empty($outpoint)){
                   foreach ($outpoint as $jesoutpoint) {
                      $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
                       $oldbalnce=$cdata->loyalty_points;
                       $newbalnce=$oldbalnce+$jesoutpoint->points;
                        $date_added = date('Y-m-d H:i:s');

                        //insert point details
                      DB::table('transaction_points')->insert([
                          'user_id' => $order_user->customers_id,
                          'order_id'=> $orders_id,
                          'points' => $jesoutpoint->points,
                          'balance_points' => $newbalnce,
                          'points_status' => 'in',
                          'description'=>'Cancelled coupon purchase',
                          'created_at' => $date_added,
                          'updated_at' => $date_added
                      ]);

                        // update user table
                        DB::table('users')->where('id', $order_user->customers_id)->update([
                            'loyalty_points' => $newbalnce,
                        ]);

                   }
                }
            }

            $responseData = array('success' => '1', 'message' => "Order successfully cancelled");
         }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);
       return $orderResponse;
  }

  public static function checkstock($request)
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
  $ipAddress = Orders::get_client_ip_env();
  $price = 0;

  $inventory = DB::table('settings')->where('name' , 'Inventory')->first();
  $is_inventory = $inventory ? $inventory->value : 1;

          
  if($authenticate==1){
      
      foreach($request->products as $products){
        
        $req = array();
        $req['products_id'] = $products['products_id'];
        $attr = array();
        if (isset($products['attributes'])) {
          foreach ($products['attributes'] as $key => $value) {
              $attr[$key] = $value['attribute_id'];
          }
            $req['attributes'] = $attr;

        }
        
        $check = Product::getquantity($req);
        
        $check = json_decode($check);
        // dd($check);
        $currentStock = Coreproduct::select('products.*','products_description.products_name as name')->leftjoin('products_description','products_description.products_id','=','products.products_id')->where('products.products_id',$products['products_id'])->first();
      if($is_inventory == 1){
          if($products['customers_basket_quantity'] > $check->stock){
            $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'This Product is out of stock'." '".$currentStock->name."' ");
            $orderResponse = json_encode($responseData);
            return $orderResponse;
          }elseif($products['customers_basket_quantity'] < $currentStock->products_min_order){
              $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The minimum order quantity allowed for this product is'." ".$currentStock->products_min_order);
              $orderResponse = json_encode($responseData);
              return $orderResponse;
          }
          elseif($products['customers_basket_quantity'] > $currentStock->products_max_stock && $currentStock->products_max_stock != 0){
            $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The maximum order quantity allowed for this product is'." ".$currentStock->products_max_stock);
            $orderResponse = json_encode($responseData);
            return $orderResponse;
          }
      }
      
      $price += $products['final_price'] * $products['customers_basket_quantity'];
    }

    

    $setting = DB::table('settings')->where('name','min_order_price')->first();
   
    if($price  < $setting->value){
     
        $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'Your order price is less then min order price');
        $orderResponse = json_encode($responseData);
        return $orderResponse;
    }

        $responseData = array('success'=>'1', 'data'=>array(), 'products_id' => $products['products_id'], 'message'=>"Order Can be Procced.");

			
  }else{
    $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
  }
  $orderResponse = json_encode($responseData);

  return $orderResponse;
}

public static function invoiceImageInsert($request)
{
    $consumer_data              =  array();
    $consumer_data['consumer_key']      =  request()->header('consumer-key');
    $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
    $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
    $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
    $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
    $consumer_data['consumer_url']      =  __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    if($authenticate==1){
   
          $fileName = time() . '.' . $request->image->getclientoriginalextension();
          $request->image->getclientoriginalextension();
          $request->image->move('images/banktransfer/' , $fileName);
          $bank_image = 'images/banktransfer/'.$fileName ;
          DB::table('orders')->where('orders_id',$request->order_id)->update([
              'banktransfer_image' => $bank_image,
          ]);
          $responseData = array('success' => '1', 'message' => "Invoice image successfully uploaded");
      }
    else{
      $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
    }
    $orderResponse = json_encode($responseData);
     return $orderResponse;
}

  public static function redeemCoupon($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      $notice = 5;
      $maxTime = Carbon::now()->addMinutes($notice);
      $currentDateTimes = Carbon::now();
      if($authenticate==1){
        if($request->api_token == '' || $request->qrcode == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
          $user = DB::table('users')->where('api_token', $request->api_token)->first();
          if($user){
              $coupons = DB::table('coupons')->where('qrcode', $request->qrcode)->first();
              if($coupons){
                  $check_coupon = $authController->checkCoupons($user->id,$request->qrcode);
                  if($check_coupon=='ok'){
                  $unique = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->first();
                    if($unique){
                      if($unique->max_time <= $currentDateTimes){
                        $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->delete();

                            $redeem_id = DB::table('tb_redeem')->insertGetId([
                                'vouID' => $coupons->coupans_id,
                                'user_id' => $user->id,
                                'qr_code' => '0',
                                'max_time' => $maxTime,
                                'reStatus' => '1',
                                'vTime' => '5',
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s'),
                              ]);
                            if($coupons->discount_type=='product'){
                                $timestamp=date('YmdHis');
                                $code=$redeem_id.'|'.$timestamp.'|004';
                                $qrcode = $authController->getResEncryption($code);
                            }else{
                                $timestamp=date('YmdHis');
                                $code=$redeem_id.'|'.$timestamp.'|003';
                                $qrcode = $authController->getResEncryption($code);
                            }
                            DB::table('tb_redeem')->where('id', '=', $redeem_id)->update(['qr_code'=>$qrcode]);

                            $addRedeem=DB::table('tb_redeem')->where("id",$redeem_id)->first();

                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($addRedeem->created_at);
                            $interval = $datetime1->diff($datetime2);
                            $minutes = $interval->days * 24 * 60;
                            $minutes += $interval->h * 60;
                            $minutes += $interval->i;

                            $responseData =array("success"=>'1',"message"=>'Redeem insert successfully',"data"=>$addRedeem,"checkTime"=>$minutes,"DateTime"=>date('Y-m-d H:i:s'),'coupon'=>$coupons);
                      }else{

                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($unique->created_at);
                            $interval = $datetime1->diff($datetime2);
                            $minutes = $interval->days * 24 * 60;
                            $minutes += $interval->h * 60;
                            $minutes += $interval->i;

                          $responseData = array('success'=>'1', 'message'=>"Redeem insert successfully","data"=>$unique,"checkTime"=>$minutes,"DateTime"=>date('Y-m-d H:i:s'),'coupon'=>$coupons);
                      }
                    }else{
                       $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->delete();
                       $redeem_id = DB::table('tb_redeem')->insertGetId([
                                'vouID' => $coupons->coupans_id,
                                'user_id' => $user->id,
                                'qr_code' => '0',
                                'max_time' => $maxTime,
                                'reStatus' => '1',
                                'vTime' => '5',
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s'),
                          ]);
                       if($coupons->discount_type=='product'){
                                $timestamp=date('YmdHis');
                                $code=$redeem_id.'|'.$timestamp.'|004';
                                $qrcode = $authController->getResEncryption($code);
                            }else{
                                $timestamp=date('YmdHis');
                                $code=$redeem_id.'|'.$timestamp.'|003';
                                $qrcode = $authController->getResEncryption($code);
                            }
                        DB::table('tb_redeem')->where('id', '=', $redeem_id)->update(['qr_code'=>$qrcode]);

                       $addRedeem=DB::table('tb_redeem')->where("id",$redeem_id)->first();
                       $responseData =array("success"=>'1','message'=>'Redeem insert successfully',"data"=>$addRedeem);
                    }
              }else{
                $responseData = array('success'=>'0', 'message'=>$check_coupon);
              }
              }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");
              }    
          }else{
            $responseData = array('success'=>'0', 'message'=>"Invalid api token");
          }
        }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);
      return $orderResponse;
  }

  public static function redeemPointCoupon($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      $notice = 5;
      $maxTime = Carbon::now()->addMinutes($notice);
      $currentDateTimes = Carbon::now();
      if($authenticate==1){
        if($request->api_token == '' || $request->qrcode == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
          $user = DB::table('users')->where('api_token', $request->api_token)->first();
          if($user){
              $coupons = DB::table('redeem_points_settings')->where('qrcode', $request->qrcode)->first();
              if($coupons){
                  $unique = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->first();
                    if($unique){
                      if($unique->max_time <= $currentDateTimes){
                         //if($coupons->points <= $user->loyalty_points){
                            $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->delete();

                                $redeem_id = DB::table('tb_redeem')->insertGetId([
                                    'vouID' => $coupons->id,
                                    'user_id' => $user->id,
                                    'qr_code' => '0',
                                    'max_time' => $maxTime,
                                    'reStatus' => '1',
                                    'vTime' => '5',
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                  ]);
                                if($coupons->discount_type=='product'){
                                    $timestamp=date('YmdHis');
                                    $code=$redeem_id.'|'.$timestamp.'|005';
                                    $qrcode = $authController->getResEncryption($code);
                                }else{
                                    $timestamp=date('YmdHis');
                                    $code=$redeem_id.'|'.$timestamp.'|006';
                                    $qrcode = $authController->getResEncryption($code);
                                }
                                DB::table('tb_redeem')->where('id', '=', $redeem_id)->update(['qr_code'=>$qrcode]);

                                $addRedeem=DB::table('tb_redeem')->where("id",$redeem_id)->first();

                                  $datetime1 = new DateTime();
                                  $datetime2 = new DateTime($addRedeem->created_at);
                                  $interval = $datetime1->diff($datetime2);
                                  $minutes = $interval->days * 24 * 60;
                                  $minutes += $interval->h * 60;
                                  $minutes += $interval->i;

                                $responseData =array("success"=>'1','message'=>'Redeem insert successfully',"data"=>$addRedeem,"checkTime"=>$minutes,"DateTime"=>date('Y-m-d H:i:s'));
                        // }else{
                        //   $responseData = array('success'=>'0', 'message'=>"You have insufficient points");
                        // }
                      }else{

                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($unique->created_at);
                            $interval = $datetime1->diff($datetime2);
                            $minutes = $interval->days * 24 * 60;
                            $minutes += $interval->h * 60;
                            $minutes += $interval->i;

                         $responseData =array("success"=>'1','message'=>'Redeem insert successfully',"data"=>$unique,"checkTime"=>$minutes,"DateTime"=>date('Y-m-d H:i:s'));
                      }
                    }else{
                      //if($coupons->points <= $user->loyalty_points){
                           $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("user_id",$user->id)->delete();
                           $redeem_id = DB::table('tb_redeem')->insertGetId([
                                    'vouID' => $coupons->id,
                                    'user_id' => $user->id,
                                    'qr_code' => '0',
                                    'max_time' => $maxTime,
                                    'reStatus' => '1',
                                    'vTime' => '5',
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                              ]);
                           if($coupons->discount_type=='product'){
                                    $timestamp=date('YmdHis');
                                    $code=$redeem_id.'|'.$timestamp.'|005';
                                    $qrcode = $authController->getResEncryption($code);
                                }else{
                                    $timestamp=date('YmdHis');
                                    $code=$redeem_id.'|'.$timestamp.'|006';
                                    $qrcode = $authController->getResEncryption($code);
                                }
                            DB::table('tb_redeem')->where('id', '=', $redeem_id)->update(['qr_code'=>$qrcode]);

                           $addRedeem=DB::table('tb_redeem')->where("id",$redeem_id)->first();
                           $responseData =array("success"=>'1','message'=>'Redeem insert successfully',"data"=>$addRedeem);
                      // }else{
                      //   $responseData = array('success'=>'0', 'message'=>"You have insufficient points");
                      // }
                    }
              }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");
              }    
          }else{
            $responseData = array('success'=>'0', 'message'=>"Invalid api token");
          }
        }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);
      return $orderResponse;
  }
  public static function addFavouriteCoupon($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate==1){
          if($request->api_token == '' || $request->qrcode == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $user = DB::table('users')->where('api_token', $request->api_token)->first();
            if($user){
              $coupons = DB::table('coupons')->where('qrcode', $request->qrcode)->first();
              if($coupons){
                $unique = DB::table('tb_favourite')->where('userID', $user->id)->where('voucherID', $coupons->coupans_id)->where('type', 'coupons')->first();
                if(empty($unique)){
                    if($coupons->usage_limit != '' && $coupons->usage_limit_per_user != ''){
                        $total=$coupons->usage_limit;
                        $remaining=$coupons->usage_limit_per_user;
                    }else if($coupons->usage_limit == '' && $coupons->usage_limit_per_user != ''){
                        $total=$coupons->usage_limit_per_user;
                        $remaining=$coupons->usage_limit_per_user;
                    }else if($coupons->usage_limit != '' && $coupons->usage_limit_per_user == ''){
                        $total=$coupons->usage_limit;
                        $remaining=$coupons->usage_limit;
                    }else{
                        $total='0';
                        $remaining='0';
                    }

                    $favourite = DB::table('tb_favourite')->insertGetId([
                                    'userID' => $user->id,
                                    'voucherID' => $coupons->coupans_id,
                                    'Total' => $total,
                                    'remaining_voucher' => $remaining,
                                    'status' => '1',
                                    'type' => 'coupons',
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                              ]);
                    $responseData = array('success'=>'1', 'message'=>"Favourite insert successfully...");
                  
                }else{
                  $responseData = array('success'=>'0', 'message'=>"Voucher already added in favourite");
                }
              }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid coupon qrcode");
              }
            }else{
              $responseData = array('success'=>'0', 'message'=>"Invalid user api token");
            }
          }
      }else{
          $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);
      return $orderResponse;
  }

  public static function addFavouritePointCoupon($request)
  {
      $consumer_data              =  array();
      $consumer_data['consumer_key']      =  request()->header('consumer-key');
      $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
      $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
      $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
      $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
      $consumer_data['consumer_url']      =  __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate==1){
        if($request->api_token == '' || $request->qrcode == ''){
          $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
          $user = DB::table('users')->where('api_token', $request->api_token)->first();
          if($user){
            $coupons = DB::table('redeem_points_settings')->where('qrcode', $request->qrcode)->first();
            if($coupons){
              $unique = DB::table('tb_favourite')->where('userID', $user->id)->where('voucherID', $coupons->id)->where('type', 'points')->first();
                if(empty($unique)){
                  if($user->loyalty_points >= $coupons->points){

                     $favourite = DB::table('tb_favourite')->insertGetId([
                                    'userID' => $user->id,
                                    'voucherID' => $coupons->id,
                                    'Total' => '1',
                                    'remaining_voucher' => '1',
                                    'status' => '1',
                                    'type' => 'points',
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                              ]);
                     // update user loyalty points
                     $newpoint=$user->loyalty_points-$coupons->points;
                     DB::table('users')->where([['id', '=', $user->id]])->update(
                        [ 'loyalty_points' => $newpoint,]);

                     // insert transaction_points
                     $transaction = DB::table('transaction_points')->insertGetId([
                                    'user_id' => $user->id,
                                    'order_id' => '0',
                                    'loyalty_id' => $coupons->id,
                                    'points' => $coupons->points,
                                    'balance_points' => $newpoint,
                                    'points_status' => 'out',
                                    'description'=> 'Favourite point coupon',
                                    'status' =>'1',
                                    'type' => 'Active',
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                            ]);

                    $responseData = array('success'=>'1', 'message'=>"Favourite insert successfully...");
                  }else{
                    $responseData = array('success'=>'0', 'message'=>"You have insufficient points");
                  }
                }else{
                  $responseData = array('success'=>'0', 'message'=>"Voucher already added in favourite");
                }
            }else{
              $responseData = array('success'=>'0', 'message'=>"Invalid coupon qrcode");
            }
          }else{
            $responseData = array('success'=>'0', 'message'=>"Invalid user api token");
          }
        }
      }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
      }
      $orderResponse = json_encode($responseData);
      return $orderResponse;
  }

  public static function newaAddtoOrder($request)
  {
    $consumer_data              =  array();
    $consumer_data['consumer_key']      =  request()->header('consumer-key');
    $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
    $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
    $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
    $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
    $consumer_data['consumer_url']      =  __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    $ipAddress = Orders::get_client_ip_env();
    $price = 0;
    $inventory = DB::table('settings')->where('name' , 'Inventory')->first();
    $is_inventory = $inventory ? $inventory->value : 1;
    $scommission = DB::table('settings')->where('name' , 'salesperson_commission')->first();
    $is_commission = $scommission ? $scommission->value : 1;

    if($authenticate==1){
      $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
      if($cashier) {
        $productid = array();
        $i = 0;
        foreach($request->cart_id as $cartid){
          $cartdata=DB::table('customers_basket')->where('customers_basket_id', $cartid)->first();
          $productid[$i]['products_id']=$cartdata->products_id;
          $productid[$i]['customers_basket_quantity']=$cartdata->customers_basket_quantity;
          $productid[$i]['total_basket_quantity']=$cartdata->total_basket_quantity;
          $productid[$i]['final_price']=$cartdata->original_price;
          $productid[$i]['customers_basket_id']=$cartdata->customers_basket_id;
          $i++;
        }

        foreach($productid as $products){
          $req = array();
          $req['products_id'] = $products['products_id'];
          $attr = array();
          $attrdata=DB::table('customers_basket_attributes')->where('customers_basket_id', $products['customers_basket_id'])->get();
          if (!$attrdata->isEmpty()) {
            foreach ($attrdata as $key => $value) {
               $attresult=DB::table('products_attributes')->where(['products_id'=>$value->products_id,'options_id'=>$value->products_options_id,'options_values_id'=>$value->products_options_values_id])->first(); 
               $attr[$key] = $attresult->products_attributes_id;
            }
            $req['attributes'] = $attr;
          }

           //print_r($req);
           $check = Product::getquantity($req);
           $check = json_decode($check);
           //print_r($check);
           $currentStock = Coreproduct::select('products.*','products_description.products_name as name')->leftjoin('products_description','products_description.products_id','=','products.products_id')->where('products.products_id',$products['products_id'])->first();
           if($is_inventory == 1 && $currentStock->stock_status == 1){
              if($products['total_basket_quantity'] > $check->stock){
                $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'This Product is out of stock'." '".$currentStock->name."' ");
                $orderResponse = json_encode($responseData);
                return $orderResponse;
              }elseif($products['total_basket_quantity'] < $currentStock->products_min_order){
                $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The minimum order quantity allowed for this product is'." ".$currentStock->products_min_order);
                $orderResponse = json_encode($responseData);
                return $orderResponse;
              }elseif($products['total_basket_quantity'] > $currentStock->products_max_stock && $currentStock->products_max_stock != 0){
                  $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'The maximum order quantity allowed for this product is'." ".$currentStock->products_max_stock);
                  $orderResponse = json_encode($responseData);
                  return $orderResponse;
              }
           }
           $price += $products['final_price'] * $products['customers_basket_quantity'];
        }

        $setting = DB::table('settings')->where('name','min_order_price')->first();
        if($price  < $setting->value){
          $responseData = array('success'=>'0', 'data'=>array(),'products_id' => $products['products_id'], 'message'=>'Your order price is less then min order price');
          $orderResponse = json_encode($responseData);
          return $orderResponse;
        }

        $guest_status             = $request->guest_status;

            if($guest_status == 1){
              $check = DB::table('users')->where('role_id',2)->where('email',$request->email)->first();
                if($check == null){
                  $customers_id = DB::table('users')->insertGetId([
                      'role_id' => 2,
                      'email' => $request->email,
                      'password' => Hash::make('123456dfdfdf'),
                      'first_name' => $request->delivery_firstname,
                      'last_name' => $request->delivery_lastname,
                      'phone' => $request->customers_telephone
                  ]);
                }else{
                  $customers_id = $check->id;
                }
            }else{
              $customers_id                   =   $request->customers_id;
            }

        $date_added               = date('Y-m-d H:i:s');
        $ordered_source           =   $request->ordered_source;
        $customers_telephone      =   $request->customers_telephone;
        $email                    =   $request->email;
        $delivery_firstname       =   $request->delivery_firstname;
        $delivery_lastname        =   $request->delivery_lastname;
        $delivery_street_address  =   $request->delivery_street_address;
        $delivery_suburb          =   $request->delivery_suburb;
        $delivery_city            =   $request->delivery_city;
        $delivery_postcode        =   $request->delivery_postcode;
        $delivery_latitude        =   $request->delivery_latitude;
        $delivery_longitude       =   $request->delivery_longitude;

        $delivery = DB::table('zones')->where('zone_name', '=', $request->delivery_zone)->first();

        if($delivery){
          $delivery_state                   =   $delivery->zone_code;
        }else{
          $delivery_state                   =   'other';
        }

        $delivery_country                 =   $request->delivery_country;
        $billing_firstname                =   $request->billing_firstname;
        $billing_lastname                 =   $request->billing_lastname;
        $billing_street_address           =   $request->billing_street_address;
        $billing_suburb                   =   $request->billing_suburb;
        $billing_city                     =   $request->billing_city;
        $billing_postcode                 =   $request->billing_postcode;

        $billing = DB::table('zones')->where('zone_name', '=', $request->billing_zone)->first();

        if($billing){
          $billing_state                    =   $billing->zone_code;
        }else{
          $billing_state                    =   'other';
        }

        $billing_country                  =   $request->billing_country;
        $payment_method                   =   $request->payment_method;
        $order_information                = array();

        $cc_type                    =   $request->cc_type;
        $cc_owner                   =   $request->cc_owner;
        $cc_number                  =   $request->cc_number;
        $cc_expires                 =   $request->cc_expires;
        $last_modified              =   date('Y-m-d H:i:s');
        $date_purchased             =   date('Y-m-d H:i:s');
        $order_price                =   $request->totalPrice;
        $currency_code              =   $request->currency_code;
        $order_price                =   $request->totalPrice;
        $shipping_cost              =   $request->shipping_cost;
        $shipping_cost              =   $request->shipping_cost;
        $shipping_method            =   $request->shipping_method;
        $order_weight               =   $request->total_weight;
        $order_km                   =   $request->order_km;
        $orders_status              =   '1';
        $orders_date_finished       =   $request->orders_date_finished;
        $comments                   =   $request->comments;

        //additional fields
        $delivery_phone           = $request->delivery_phone;
        $billing_phone            = $request->billing_phone;
        $point_transaction_id     =   $request->point_transaction_id;
        $coupon_code_id           =   $request->coupon_code_id;
        $points_amount            =   $request->points_amount;
        $cashier_id               =   $cashier->id;
        $discount_amount          =   $request->discount_amount;

        if(!empty($request->tips_amount)){
          $tip_amount=$request->tips_amount;
        }else{
          $tip_amount='0';
        }

        if(!empty($request->refund_amount)){
          $refund=$request->refund_amount;
        }else{
          $refund='0';
        }

        $settings = DB::table('settings')->get();
        $currency_value                 =   $request->currency_value;
        //tax info
        $total_tax              = $request->total_tax;
        // $total_tax              = Orders::converttodefaultprice($request->total_tax, $currency_code);
        $products_tax             =   1;
        //coupon info
        $is_coupon_applied        =   $request->is_coupon_applied;

          if($is_coupon_applied==1){
            $code = array();
            $coupon_amount = 0;
            $exclude_product_ids = array();
            $product_categories = array();
            $excluded_product_categories = array();
            $exclude_product_ids = array();
            $coupon_amount    =   $request->coupon_amount;
            //convert price to default currency price
              // $coupon_amount = Orders::converttodefaultprice($coupon_amount, $currency_code);
            foreach($request->coupons as $coupons_data){
                //update coupans
                $coupon_id = DB::statement("UPDATE `coupons` SET `used_by`= CONCAT(used_by,',$customers_id') WHERE `code` = '".$coupons_data['code']."'");
            }
            $code = json_encode($request->coupons);
          }else{
            $code =   '';
            $coupon_amount =   0;
          }

      //payment methods
          $payments_setting = Orders::payments_setting_for_brain_tree($request);
              if($payment_method == 'braintree_card' or $payment_method == 'braintree_paypal'){
                if($payment_method == 'braintree_card'){
                  $fieldName = 'sub_name_1';
                  $paymentMethodName = 'Braintree Card';
                }else{
                  $fieldName = 'sub_name_2';
                  $paymentMethodName = 'Braintree Paypal';
                }
              // $paymentMethodName = $payments_setting->$fieldName;
              //braintree transaction with nonce
                $is_transaction  = '1';       # For payment through braintree
                $nonce         =   $request->nonce;

                if($payments_setting['merchant_id']->environment=='0'){
                  $braintree_enviroment = 'Test';
                }else{
                  $braintree_enviroment = 'Live';
                }

                $braintree_merchant_id = $payments_setting['merchant_id']->value;
                $braintree_public_key  = $payments_setting['public_key']->value;
                $braintree_private_key = $payments_setting['private_key']->value;

                //brain tree credential
                require_once app_path('braintree/index.php');
                if ($result->success){
                  if($result->transaction->id){
                      $order_information = array(
                        'braintree_id'=>$result->transaction->id,
                        'status'=>$result->transaction->status,
                        'type'=>$result->transaction->type,
                        'currencyIsoCode'=>$result->transaction->currencyIsoCode,
                        'amount'=>$result->transaction->amount,
                        'merchantAccountId'=>$result->transaction->merchantAccountId,
                        'subMerchantAccountId'=>$result->transaction->subMerchantAccountId,
                        'masterMerchantAccountId'=>$result->transaction->masterMerchantAccountId,
                        //'orderId'=>$result->transaction->orderId,
                        'createdAt'=>time(),
            //            'updatedAt'=>$result->transaction->updatedAt->date,
                        'token'=>$result->transaction->creditCard['token'],
                        'bin'=>$result->transaction->creditCard['bin'],
                        'last4'=>$result->transaction->creditCard['last4'],
                        'cardType'=>$result->transaction->creditCard['cardType'],
                        'expirationMonth'=>$result->transaction->creditCard['expirationMonth'],
                        'expirationYear'=>$result->transaction->creditCard['expirationYear'],
                        'customerLocation'=>$result->transaction->creditCard['customerLocation'],
                        'cardholderName'=>$result->transaction->creditCard['cardholderName']
                      );
                      $payment_status = "success";
                  }
                }else{
                      $payment_status = "failed";
                }

          }else if($payment_method == 'stripe'){
            #### stipe payment
            $payments_setting = Orders::payments_setting_for_stripe($request);
            $paymentMethodName = $payments_setting['publishable_key']->name;

            //require file
              require_once app_path('stripe/config.php');
            //get token from app
              $token  = $request->nonce;

              $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
              ));

              $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => 100*$order_price,
                'currency' => 'usd'
              ));

              if($charge->paid == true){
                  $order_information = array(
                      'paid'=>'true',
                      'transaction_id'=>$charge->id,
                      'type'=>$charge->outcome->type,
                      'balance_transaction'=>$charge->balance_transaction,
                      'status'=>$charge->status,
                      'currency'=>$charge->currency,
                      'amount'=>$charge->amount,
                      'created'=>date('d M,Y', $charge->created),
                      'dispute'=>$charge->dispute,
                      'customer'=>$charge->customer,
                      'address_zip'=>$charge->source->address_zip,
                      'seller_message'=>$charge->outcome->seller_message,
                      'network_status'=>$charge->outcome->network_status,
                      'expirationMonth'=>$charge->outcome->type
                    );
                  $payment_status = "success";
              }else{
                  $payment_status = "failed";
              }
          }else if($payment_method == 'cod'){
              $payments_setting = Orders::payments_setting_for_cod($request);
              $paymentMethodName =  $payments_setting->name;
              $payment_method = 'Cash on Delivery';
              $payment_status='success';
              $pay_status='2';
          }else if($payment_method == 'instamojo'){
              $payments_setting = Orders::payments_setting_for_instamojo($request);
              $paymentMethodName = $payments_setting['auth_token']->name;
              $payment_method = 'Instamojo';
              $payment_status='success';
              $pay_status='1';
              $order_information = array('payment_id'=>$request->nonce, 'transaction_id'=>$request->transaction_id);
          }else if($payment_method == 'hyperpay'){
              $payments_setting = Orders::payments_setting_for_hyperpay($request);
              $paymentMethodName = $payments_setting['userid']->name;
              $payment_method = 'Hyperpay';
              $payment_status='success';
              $pay_status='1';
          }else if($payment_method == 'razorpay'){
              $payments_setting = Orders::payments_setting_for_razorpay($request);
              $paymentMethodName = $payments_setting['RAZORPAY_KEY']->name;
              $payment_method = 'Razorpay';
              $payment_status='success';
              $pay_status='1';
          }else if($payment_method == 'paytm'){
              $payments_setting = Orders::payments_setting_for_paytm($request);
              $paymentMethodName = $payments_setting['paytm_mid']->name;
              $payment_method = 'Paytm';
              $payment_status='success';
              $pay_status='1';
          }else if($payment_method == 'directbank'){
              $payments_setting = Orders::payments_setting_for_directbank($request);
              $paymentMethodName = 'banktransfer';
              $payment_method = 'directbank';
              $payment_status='success';
              $pay_status='1';
              $order_information = array(
                'account_name' => $payments_setting['account_name']->value,
                'account_number' => $payments_setting['account_number']->value,
                'payment_method' => $payments_setting['account_name']->payment_method,
                'bank_name' => $payments_setting['bank_name']->value,
                'short_code' => $payments_setting['short_code']->value,
                'iban' => $payments_setting['iban']->value,
                'swift' => $payments_setting['swift']->value,
              );
          }else if($payment_method == 'paystack'){
              $payments_setting = Orders::payments_setting_for_paystack($request);
              $paymentMethodName = $payments_setting['secret_key']->name;
              $payment_method = 'paystack';
              $payment_status='success';
              $pay_status='1';
              $order_information = '';
          }else if($payment_method == 'ipay88'){
              $payments_setting = Orders::payments_setting_for_IPay88($request);
              $paymentMethodName = $payments_setting['merchant_code']->name;
              $payment_method = 'ipay88';
              $pay_status='1';
              $payment_status='success';
              $order_information = '';
          }else if($payment_method == 'premium_pay'){
              $payments_setting = Orders::payments_setting_for_Premium_Pay($request);
              $paymentMethodName = $payments_setting['store_id']->name;
              $payment_method = 'premium_pay';
              $pay_status='1';
              $payment_status='success';
              $order_information = '';
          }else if($payment_method == 'Cash on Delivery'){
              $payments_setting = Orders::payments_setting_for_Premium_Pay($request);
              $paymentMethodName = 'Cash on Delivery';
              $payment_method = 'Cash on Delivery';
              $payment_status='success';
              $pay_status='1';
              $order_information = '';
          }else if($payment_method == 'Cash'){
              $payments_setting = '';
              $paymentMethodName = 'Cash on Pos';
              $payment_method = 'Cash on Pos';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else if($payment_method == 'wallet'){
              $payments_setting = Orders::payments_setting_for_wallet($request);
              $paymentMethodName = 'wallet';
              $payment_method = 'wallet';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else if($payment_method == 'Credit'){
              $payments_setting = '';
              $paymentMethodName = 'Credit/Debit Card';
              $payment_method = 'Credit/Debit Card';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else if($payment_method == 'PromptPay'){
              $payments_setting = '';
              $paymentMethodName = 'Prompt Pay';
              $payment_method = 'Prompt Pay';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else if($payment_method == 'Delivery'){
              $payments_setting = '';
              $paymentMethodName = 'Delivery';
              $payment_method = 'Delivery';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else if($payment_method == 'Coupon'){
              $payments_setting = '';
              $paymentMethodName = 'Coupon';
              $payment_method = 'Coupon';
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }else{
              $payments_setting = '';
              $paymentMethodName = $payment_method;
              $payment_method = $payment_method;
              $payment_status='success';
              $order_information = '';
              $pay_status='1';
          }

          //check if order is verified
          if($payment_status=='success'){
              $currency_value = DB::table('currencies')->where('code',$currency_code)->first();
              if($payment_method == 'hyperpay'){
                  $cyb_orders = DB::table('orders')->where('transaction_id','=',$request->transaction_id)->get();
                  $orders_id = $cyb_orders[0]->orders_id;

                  //update database
                  DB::table('orders')->where('transaction_id','=',$request->transaction_id)->update(
                    [  'customers_id' => $customers_id,
                       'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
                       'customers_street_address' => $delivery_street_address,
                       'customers_suburb'  =>  $delivery_suburb,
                       'customers_city' => $delivery_city,
                       'customers_postcode'  => $delivery_postcode,
                       'customers_state' => $delivery_state,
                       'customers_country'  =>  $delivery_country,
                       'customers_telephone' => $customers_telephone,
                       'email'  => $email,

                       'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
                       'delivery_street_address' => $delivery_street_address,
                       'delivery_suburb'  => $delivery_suburb,
                       'delivery_city' => $delivery_city,
                       'delivery_postcode'  =>  $delivery_postcode,
                       'delivery_latitude'  =>  $delivery_latitude,
                       'delivery_longitude'  =>  $delivery_longitude,
                       'delivery_state' => $delivery_state,
                       'delivery_country'  => $delivery_country,
                       'billing_name'  => $billing_firstname.' '.$billing_lastname,
                       'billing_street_address' => $billing_street_address,
                       'billing_suburb'  =>  $billing_suburb,
                       'billing_city' => $billing_city,
                       'billing_postcode'  => $billing_postcode,
                       'billing_state' => $billing_state,
                       'billing_country'  =>  $billing_country,

                       'payment_method'  =>  $paymentMethodName,
                       'cc_type' => $cc_type,
                       'cc_owner'  => $cc_owner,
                       'cc_number' =>$cc_number,
                       'cc_expires'  =>  $cc_expires,
                       'last_modified' => $last_modified,
                       'date_purchased'  => $date_purchased,
                       'order_price'  => $order_price / $currency_value->value,
                       'shipping_cost' =>$shipping_cost / $currency_value->value,
                       'shipping_method'  =>  $shipping_method,
                       'currency'  =>  $currency_value ? $currency_value->symbol_left ? $currency_value->symbol_left : $currency_value->symbol_right : '$',
                       'currency_value' => $currency_value ? $currency_value->value : 1 ,
                       'coupon_code'     =>   $code,
                       'coupon_amount'   =>   $coupon_amount / $currency_value->value,
                       'total_tax'     =>   $total_tax / $currency_value->value,
                       'ordered_source'    =>   $ordered_source,
                       'delivery_phone'  =>   $delivery_phone,
                       'billing_phone'   =>   $billing_phone,
                       'coupon_code_id'  =>     $coupon_code_id,
                       'points_amount'   =>     $points_amount,
                       'cashier_id'      =>    $cashier_id,
                       'discount_amount' =>    $discount_amount,
                       'order_type'      =>    $request->order_type,
                       'pos_tips_amount' =>    $tip_amount,
                       'refund_amount'   =>    $refund,
                    ]);
              }else{
                  //insert order
                  $RefNo = md5(uniqid(rand(), true));
                  $orders_id = DB::table('orders')->insertGetId(
                    [  'customers_id' => $customers_id,
                       'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
                       'customers_street_address' => $delivery_street_address,
                       'customers_suburb'  =>  $delivery_suburb,
                       'customers_city' => $delivery_city,
                       'customers_postcode'  => $delivery_postcode,
                       'customers_state' => $delivery_state,
                       'customers_country'  =>  $delivery_country,
                       'customers_telephone' => $customers_telephone,
                       'email'  => $email,

                       'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
                       'delivery_street_address' => $delivery_street_address,
                       'delivery_suburb'  => $delivery_suburb,
                       'delivery_city' => $delivery_city,
                       'delivery_postcode'  =>  $delivery_postcode,
                       'delivery_state' => $delivery_state,
                       'delivery_country'  => $delivery_country,
                       'delivery_latitude'  =>  $delivery_latitude,
                       'delivery_longitude'  =>  $delivery_longitude,

                       'billing_name'  => $billing_firstname.' '.$billing_lastname,
                       'billing_street_address' => $billing_street_address,
                       'billing_suburb'  =>  $billing_suburb,
                       'billing_city' => $billing_city,
                       'billing_postcode'  => $billing_postcode,
                       'billing_state' => $billing_state,
                       'billing_country'  =>  $billing_country,

                       'payment_method'  =>  $paymentMethodName,
                       'cc_type' => $cc_type,
                       'cc_owner'  => $cc_owner,
                       'cc_number' =>$cc_number,
                       'cc_expires'  =>  $cc_expires,
                       'last_modified' => $last_modified,
                       'date_purchased'  => $date_purchased,
                       'order_price'  => $order_price / $currency_value->value,
                       'order_weight'  => $order_weight,
                       'order_km'  => $order_km,
                       'shipping_cost' =>$shipping_cost / $currency_value->value,
                       'shipping_method'  =>  $shipping_method,
                       'currency'  =>  $currency_value ? $currency_value->symbol_left ? $currency_value->symbol_left : $currency_value->symbol_right : '$',
                       'currency_value' => $currency_value ? $currency_value->value : 1 ,
                       'order_information' => json_encode($order_information),
                       'coupon_code'     =>   $code,
                       'coupon_amount'   =>   $coupon_amount / $currency_value->value,
                       'total_tax'     =>   $total_tax / $currency_value->value,
                       'ordered_source'    => $ordered_source,
                       'delivery_phone'  =>   $delivery_phone,
                       'billing_phone'   =>   $billing_phone,
                       'transaction_id'  =>  $RefNo,
                       'payment_status'  => $pay_status,
                       'coupon_code_id'  =>     $coupon_code_id,
                       'points_amount'   =>     $points_amount,
                       'cashier_id'      =>    $cashier_id,
                       'discount_amount' =>    $discount_amount,
                       'order_type'      =>    $request->order_type,
                       'pos_tips_amount' =>    $tip_amount,
                       'refund_amount'   =>    $refund
                    ]);
              }

              // upload description image
              if(!empty($request->pres_image)){
                foreach($request->pres_image as $image){
                  $name = 'pres_'.rand(11111, 99999).'.'.$image->getClientOriginalExtension();
                  $destinationPath = public_path('/uploads/prescription');
                  $imagePath = $destinationPath. "/".  $name;
                  $image->move('uploads/prescription/' , $name);
                  $new_image = 'uploads/prescription/'.$name ;
                  $image_name[] = $new_image;
                }
              }else{
                $imagename=NULL;
              }
              DB::table('orders')->where('orders_id', $orders_id)->update(['prescription_image' => $imagename]);

             // update transaction_points table
                if($point_transaction_id != '0' && $ordered_source=='2') {
                     DB::table('transaction_points')->where('id', $point_transaction_id)->update([
                        'order_id' => $orders_id,
                        'status'=>'1'
                    ]);
                    $loyalty_id = DB::table('transaction_points')->where('id', $point_transaction_id)->first();

                    if($loyalty_id){
                      $lid = $loyalty_id->loyalty_id;
                       DB::table('redeem_points_voucher')->where('id',$lid)->update(['status' => '1',]);
                    }

                    // delete temp_point_transaction table
                   DB::table('temp_point_transaction')->where('trans_id', $point_transaction_id)->delete();
                }

                //orders status history
                $orders_history_id = DB::table('orders_status_history')->insertGetId(
                  [  'orders_id'  => $orders_id,
                     'orders_status_id' => $orders_status,
                     'date_added'  => $date_added,
                     'customer_notified' =>'1',
                     'comments'  =>  $comments
                  ]);
                //orders update
                $orders_update = DB::table('orders')->where('orders_id',$orders_id)->update(['order_status_id' => 1]);

                // insert order product
                $total_commission=0;
                foreach($request->cart_id as $cartid){
                  $cartdata=DB::table('customers_basket')->where('customers_basket_id', $cartid)->first();
                  $product=DB::table('products_description')->where('products_id', $cartdata->products_id)->first();
                  $prodata=DB::table('products')->where('products_id', $cartdata->products_id)->first();
                  $c_price = str_replace(',','',$cartdata->final_price);
                  $c_final_price = str_replace(',','',$cartdata->final_price);
                  $price =$c_price;
                  $final_price = $c_final_price*$cartdata->customers_basket_quantity/$currency_value->value;

                  $orders_products_id = DB::table('orders_products')->insertGetId(
                    [
                       'orders_id'       =>   $orders_id,
                       'products_id'     =>   $cartdata->products_id,
                       'products_name'   =>   $product->products_name,
                       'products_model'  =>   $prodata->products_model,
                       'products_price'  =>   $price/$currency_value->value,
                       'final_price'     =>   $final_price,
                       'products_tax'    =>   $products_tax,
                       'products_quantity' =>   $cartdata->customers_basket_quantity,
                       'discount_price'    => $cartdata->discount_price,
                       'total_quantity'   => $cartdata->total_basket_quantity,
                    ]);

                  if($is_inventory == 1){
                      $inventory_ref_id = DB::table('inventory')->insertGetId([
                        'products_id'        =>   $cartdata->products_id,
                        'reference_code'     =>   $orders_id,
                        'orders_products_id' => $orders_products_id,
                        'stock'          =>   $cartdata->total_basket_quantity,
                        'admin_id'        =>  0,
                        'added_date'        => time(),
                        'created_at' => date('Y-m-d h:i:s'),
                        'purchase_price'      =>  0,
                        'stock_type'        =>  'out',
                      ]);
                      // insert product_combo and Buy X and Get X stock
                      if($prodata->products_type == 3){
                        $comboPro = DB::table('product_combo')->where('pro_id', $prodata->products_id)->get();
                          if(!$comboPro->isEmpty()){
                              foreach($comboPro as $key=>$comboProd){

                                  $inventory_combo_id = DB::table('inventory')->insertGetId([
                                    'products_id'        =>   $comboProd->product_id,
                                    'reference_code'     =>   $orders_id,
                                    'orders_products_id' => $orders_products_id,
                                    'stock'          =>   $comboProd->qty,
                                    'admin_id'        =>  0,
                                    'added_date'        => time(),
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'purchase_price'      =>  0,
                                    'stock_type'        =>  'out',
                                  ]);
                                  // insert product_combo attributes stock
                                  if($comboProd->attractive_id != '0'){
                                      DB::table('inventory_detail')->insert([
                                          'inventory_ref_id'  =>  $inventory_combo_id,
                                          'products_id'     =>   $comboProd->product_id,
                                          'attribute_id'    =>   $comboProd->attractive_id,
                                      ]);
                                  }

                              }
                          }
                      }elseif($prodata->products_type == 4){
                          $comboProgetx = DB::table('product_get_x')
                           ->join('product_buy_x', 'product_buy_x.pro_id', '=', 'product_get_x.pro_id')
                           ->where('product_get_x.pro_id', $prodata->products_id)
                           ->where('product_buy_x.pro_id', $prodata->products_id)
                           ->get();

                           if(!$comboProgetx->isEmpty()){
                              foreach($comboProgetx as $key=>$comboProdgetx){

                                $inventory_buyx_id = DB::table('inventory')->insertGetId([
                                    'products_id'        =>   $comboProdgetx->product_id,
                                    'reference_code'     =>   $orders_id,
                                    'orders_products_id' => $orders_products_id,
                                    'stock'          =>   $comboProdgetx->qty,
                                    'admin_id'        =>  0,
                                    'added_date'        => time(),
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'purchase_price'      =>  0,
                                    'stock_type'        =>  'out',
                                  ]);
                                // insert Buy X and Get X attributes stock
                                if($comboProdgetx->attractive_id != '0'){
                                    DB::table('inventory_detail')->insert([
                                          'inventory_ref_id'  =>  $inventory_buyx_id,
                                          'products_id'     =>   $comboProdgetx->product_id,
                                          'attribute_id'    =>   $comboProdgetx->attractive_id,
                                    ]);
                                }
                              }
                           }
                      }
                    }

                    if($is_commission == 1){
                        $cproduct=DB::table('products')->where('products_id', $cartdata->products_id)->first();
                        if($cproduct->commission_type=='percentage'){
                          $ctotal_price = $final_price;
                          $camount=(($ctotal_price/100)*$cproduct->commission_sales);
                          $co_amount=$authController->cutNum($camount);
                        }else{
                          $camount=$cproduct->commission_sales*$cartdata->customers_basket_quantity;
                          $co_amount=$authController->cutNum($camount);
                        }
                        $total_commission=$total_commission+$co_amount;
                    }

                    $attrdata=DB::table('customers_basket_attributes')->where('customers_basket_id', $cartid)->get();
                    if (!$attrdata->isEmpty()) {
                         foreach ($attrdata as $key => $value) {
                            $attresult=DB::table('products_attributes')->where(['products_id'=>$value->products_id,'options_id'=>$value->products_options_id,'options_values_id'=>$value->products_options_values_id])->first();
                            $option_name=DB::table('products_options_descriptions')->where(['products_options_id'=>$value->products_options_id])->first();
                            $option_val_name=DB::table('products_options_values_descriptions')->where(['products_options_values_id'=>$value->products_options_values_id])->first();

                            DB::table('orders_products_attributes')->insert(
                              [
                                 'orders_id' => $orders_id,
                                 'products_id'  => $value->products_id,
                                 'orders_products_id'  => $orders_products_id,
                                 'products_options' =>$option_name->options_name,
                                 'products_options_values'  =>  $option_val_name->options_values_name,
                                 'options_values_price'  =>  $attresult->options_values_price,
                                 'price_prefix'  =>  $attresult->price_prefix
                              ]);
                          if($is_inventory == 1){
                              DB::table('inventory_detail')->insert([
                                  'inventory_ref_id'  =>   $inventory_ref_id,
                                  'products_id'     =>   $value->products_id,
                                  'attribute_id'    =>   $attresult->products_attributes_id,
                              ]);
                          }
                          // delete customers_basket_attributes data
                          DB::table('customers_basket_attributes')->where('customers_basket_attributes_id', '=', $value->customers_basket_attributes_id)->delete();
                        } 
                    }

                    // delete customers_basket data
                    DB::table('customers_basket')->where('customers_basket_id', '=', $cartid)->delete();
                }

                //add sales person commission
                  if($is_commission == 1 && $request->salesperson_id != ''){

                    // single sales person amount calucaltion
                      $new_salesid=explode(",",$request->salesperson_id);
                      $scount=count($new_salesid);
                      if($scount=='1'){
                        $one_amount=$total_commission;
                      }else{
                        $pamount=$total_commission/$scount;
                        $one_amount=$authController->cutNum($pamount);
                      }

                      DB::table('salesperson_commission')->insert([
                          'order_id'  =>  $orders_id,
                          'salesperson_id' => $request->salesperson_id,
                          'amount'    =>   $total_commission,
                          'single_amount' => $one_amount,
                          'created_at'=>  date('Y-m-d h:i:s'),
                          'updated_at'=>  date('Y-m-d h:i:s')
                      ]);
                  }
                // check_table_pos
               if($request->order_type=='table'){
                  $table = DB::table('booking_table')->where('qrcode', '=', $request->session_id)->first();
                  if($table){
                      // update booking_table table
                      DB::table('booking_table')->where('id', $table->id)->update([
                          'status' => 'checkout',
                          'checkout_date' => date('Y-m-d h:i:s'),
                      ]);
                  }
               }

               // delete temp_pos_coupons data
               if(!empty($request->session_id)){
                  $pos_coupons = DB::table('temp_pos_coupons')->where('session_id', '=', $request->session_id)->first();
                  if($pos_coupons){
                     // delete temp_pos_coupons data
                      DB::table('temp_pos_coupons')->where('session_id', '=', $request->session_id)->delete();
                  }
                  // delete pos hold data
                  $hold_data = DB::table('hold')->where('session_id', '=', $request->session_id)->first();
                  if($hold_data){
                    // delete hold data
                      DB::table('hold')->where('session_id', '=', $request->session_id)->delete();
                  }
               }

               // delete pos hold data

               //send order email to user
              $order = DB::table('orders')
                ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
                ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

              //foreach
               foreach($order as $data){
                  $orders_id   = $data->orders_id;

                  $orders_products = DB::table('orders_products')
                  ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                  ->join('image_categories', 'products.products_image', '=', 'image_categories.image_id')
                  ->select('image_categories.path as image', 'image_categories.path_type as image_path_type', 'orders_products.*')
                  ->where('orders_products.orders_id', '=', $orders_id)
                  ->groupBy('products.products_id')
                  ->get();

                  $i = 0;
                  $total_price  = 0;
                  $product = array();
                  $subtotal = 0;
                  foreach($orders_products as $orders_products_data){
                      $product_attribute = DB::table('orders_products_attributes')
                      ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                      ])->get();

                      $orders_products_data->attribute = $product_attribute;
                      $product[$i] = $orders_products_data;
                      //$total_tax   = $total_tax+$orders_products_data->products_tax;
                      $total_price = $total_price+$orders_products[$i]->final_price;

                      $subtotal += $orders_products[$i]->final_price;
                      $i++;
                  }
                  $data->data = $product;
                  $orders_data[] = $data;
               } 

               $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
                ->orderBy('orders_status_history.date_added', 'desc')
                ->where('orders_id', '=', $orders_id)->get();

                $orders_status = DB::table('orders_status')->get();

                $ordersData['orders_data']        = $orders_data;
                $ordersData['total_price']        = $total_price;
                $ordersData['orders_status']      = $orders_status;
                $ordersData['orders_status_history']    = $orders_status_history;
                $ordersData['subtotal']           = $subtotal;

                // add pos Loyalty point
                if($ordered_source=='3'){
                    $exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->get();
                    $settings = DB::table('settings')->where('id', '=','148')->first();
                    if(count($exist)=='0' && $settings->value == '1'){
                      $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
                      $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();
                      if($point){
                          $cdata = DB::table('users')->where('id', $customers_id)->first();
                          $no_rm = $point->no_rm;
                          $no_point = $point->points;
                          $amount = $order_user->order_price-$order_user->shipping_cost;
                          $count_rm = round($amount/$no_rm);
                          $give_point = $count_rm*$no_point;

                           //print_r($give_point);die();
                            $oldbalnce=$cdata->loyalty_points;
                            $newbalnce=$cdata->loyalty_points+$give_point;
                          //insert point details
                          DB::table('transaction_points')->insert([
                              'user_id' => $order_user->customers_id,
                              'order_id'=> $orders_id,
                              'points' => $give_point,
                              'balance_points' => $newbalnce,
                              'points_status' => 'in',
                              'description'=>'Make Purchase',
                              'created_at' => $date_added,
                              'updated_at' => $date_added
                          ]);
                        // update user table
                          DB::table('users')->where('id', $order_user->customers_id)->update([
                              'loyalty_points' => $newbalnce,
                          ]);
                      }
                    }
                }

            //notification/email
            $myVar = new AlertController();
             if($payment_method != 'Paytm'){
                $alertSetting = $myVar->orderAlert($ordersData);
             }
             // add to point
              $psettings = DB::table('settings')->where('id', '=','148')->first(); 
              if($psettings->value=='1'){
                $point = $authController->addLoyaltyPoints($orders_id);
              }
             if($payment_method == 'directbank'){
                $responseData = array('success'=>'1', 'data'=>array(), 'customer_id' => $customers_id,'transaction_id'=>$RefNo,'order_id'=>$orders_id,'bank_information'=>$order_information, 'message'=>"Order has been placed successfully.");
                // send push notification cashier
                $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id')->where('users.role_id', '=', '14')->where('users.status', '=', '1')->get();
                  if(!$cashier->isEmpty()){
                      foreach ($cashier as $jescashier) {
                          $token=$jescashier->device_id;
                          $title='New Order';
                          $message='New order has been placed';
                          $myVar->sendNotificationsCashier($token,$title,$message);
                      }
                    }
             }else{
                $responseData = array('success'=>'1', 'data'=>array(), 'customer_id' => $customers_id,'transaction_id'=>$RefNo,'order_id'=>$orders_id,'message'=>"Order has been placed successfully.");
                // send push notification cashier
                $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->leftJoin('cashier_info', 'cashier_info.admin_id', '=', 'users.id')->select('devices.device_id')->where('users.role_id', '=', '14')->where('users.status', '=', '1')->where('cashier_info.notification', '=', '1')->get();
                    if(!$cashier->isEmpty()){
                    foreach ($cashier as $jescashier) {
                        $token=$jescashier->device_id;
                        $title='New Order';
                        $message='New order has been placed';
                        $myVar->sendNotificationsCashier($token,$title,$message);
                    }
                  }
             }


          }else if($payment_status == "failed"){
            if(!empty($error_cybersource)){
                $return_error = $error_cybersource;
            }else{
                $return_error = 'Error while placing order.';
            }
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>$error_cybersource);
          }
      }else{
        $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
      }
    }else{
      $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
    }
    $orderResponse = json_encode($responseData);
    return $orderResponse;
  }

  public static function getordersbyType($request)
  {
     $consumer_data            =  array();
     $customers_id             =  $request->customers_id;
     $language_id              =  $request->language_id;
     $requested_currency       =  $request->currency_code;
     $type                     =  $request->type;
     $consumer_data['consumer_key']      =  request()->header('consumer-key');
     $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
     $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
     $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
     $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
     $consumer_data['consumer_url']      =  __FUNCTION__;
     $authController = new AppSettingController();
     $authenticate = $authController->apiAuthenticate($consumer_data);
     if($authenticate==1){
        if($type=='pay'){

          $order = DB::table('orders')->orderBy('orders_id', 'desc')
            ->where(['customers_id'=>$customers_id,'payment_status'=>'1'])->get(); 

        }elseif($type=='ship'){

          $order = DB::table('orders')->orderBy('orders_id', 'desc')
            ->where(['customers_id'=>$customers_id])->whereIn('order_status_id', [7, 12])->get(); 

        }elseif($type=='receive'){

           $order = DB::table('orders')->orderBy('orders_id', 'desc')
            ->where(['customers_id'=>$customers_id])->whereIn('order_status_id', [6, 2])->get();

        }elseif($type=='all'){
           $order = DB::table('orders')->orderBy('orders_id', 'desc')
            ->where(['customers_id'=>$customers_id])->get();
        }
        if(count($order) > 0){
          //foreach
          $index = '0';
          foreach($order as $data){
            // deliveryboy 
            $current_boy = DB::table('orders_to_delivery_boy')
                ->leftjoin('users', 'users.id', '=', 'orders_to_delivery_boy.deliveryboy_id')
                ->LeftJoin('deliveryboy_info', 'deliveryboy_info.users_id', '=', 'users.id')
                 ->select('orders_to_delivery_boy.*',
                  'users.*',
                  'deliveryboy_info.*',
                  'deliveryboy_info.users_id as deliveryboy_id'                 
                )
                ->where('orders_to_delivery_boy.orders_id', '=', $data->orders_id)
                ->where('orders_to_delivery_boy.is_current', '=', '1')
                ->orderby('orders_to_delivery_boy.created_at', 'DESC')
                ->get();

              if(count($current_boy)>0){
                $data->deliveryboy_info = $current_boy; 
              }else{
                $data->deliveryboy_info = array(); 
              }

              $data->total_tax =  $data->total_tax*$data->currency_value;
              $data->order_price =  $data->order_price*$data->currency_value;
              $data->shipping_cost =  $data->shipping_cost*$data->currency_value;
              $data->coupon_amount =  $data->coupon_amount*$data->currency_value;

               if(!empty($data->product_discount_percentage)){
                  $product_ids = explode(',', $coupons[0]->product_ids);
                  $data->product_ids =  $product_ids;
              }else{
                  $data->product_ids = array();
              }

              if(!empty($data->discount_type)){
                $exclude_product_ids = explode(',', $data->discount_type);
                $data->discount_type =  $exclude_product_ids;
              }else{
                $data->discount_type =  array();
              }

              if(!empty($data->amount)){
                $product_categories = explode(',', $data[0]->amount);
                $data->amount =  $product_categories;
              }else{
                $data->amount =  array();
              }

              if(!empty($data->product_ids)){
                $excluded_product_categories = explode(',', $data->product_ids);
                $data->product_ids =  $excluded_product_categories;
              }else{
                $data->product_ids = array();
              }

              if(!empty($data->exclude_product_ids)){
                $email_restrictions = explode(',', $data->exclude_product_ids);
                $data->exclude_product_ids =  $email_restrictions;
              }else{
                $data->exclude_product_ids =  array();
              }

              if(!empty($data->usage_limit)){
                $used_by = explode(',', $data->usage_limit);
                $data->usage_limit =  $used_by;
              }else{
                $data->usage_limit =  array();
              }

              if(!empty($data->product_categories)){
                $used_by = explode(',', $data->product_categories);
                $data->product_categories =  $used_by;
              }else{
                $data->product_categories =  array();
              }

              if(!empty($data->excluded_product_categories)){
                $used_by = explode(',', $data->excluded_product_categories);
                $data->excluded_product_categories =  $used_by;
              }else{
                $data->excluded_product_categories =  array();
              }

              if(!empty($data->coupon_code)){
                  $coupon_code =  $data->coupon_code;
                  $coupon_datas = array();
                  $index_c = 0;
                  foreach(json_decode($coupon_code) as $coupon_codes){
                      if(!empty($coupon_codes->code)){
                        $code = explode(',', $coupon_codes->code);
                        $coupon_datas[$index_c]['code'] =  $code[0];
                      }else{
                        $coupon_datas[$index_c]['code'] =  '';
                      }

                      if(!empty($coupon_codes->amount)){
                        $amount = explode(',', $coupon_codes->amount);
                        $amount =  Orders::convertprice($amount[0], $requested_currency);
                        //$coupon_datas[$index_c]['amount'] =  $amount;

                        $coupon_datas[$index_c]['amount'] = $coupon_codes->amount;
                      }else{
                        $coupon_datas[$index_c]['amount'] =  '';
                      }

                      if(!empty($coupon_codes->discount_type)){
                        $discount_type = explode(',', $coupon_codes->discount_type);
                        $coupon_datas[$index_c]['discount_type'] =  $discount_type[0];
                      }else{
                        $coupon_datas[$index_c]['discount_type'] =  '';
                      }

                       $index_c++;
                  }
                  $order[$index]->coupons = $coupon_datas;
              }else{
                $coupon_code =  array();
                $order[$index]->coupons = $coupon_code;
              }
              unset($data->coupon_code);
              $orders_id   = $data->orders_id;

              $orders_status_history = DB::table('orders_status_history')
              ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
              ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status_history.orders_status_id')
              ->select('orders_status_history.orders_status_history_id','orders_status_description.orders_status_name', 'orders_status.orders_status_id', 'orders_status_history.comments', 'orders_status_history.date_added')
              ->where('orders_id', '=', $orders_id)
              ->where('orders_status.role_id','=',2)->where('orders_status_description.language_id','=',$language_id)->orderby('orders_status_history.orders_status_history_id', 'ASC')->get();

                $order[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $order[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                $order[$index]->orders_status_date_added = $orders_status_history[0]->date_added;
                $order[$index]->customer_comments = $orders_status_history[0]->comments;

                $total_comments = count($orders_status_history);
                $i = 1;

                $order[$index]->orders_status_history = $orders_status_history;
                foreach($orders_status_history as $orders_status_history_data){
                    if($total_comments == $i && $i != 1){
                        $order[$index]->orders_status_id = $orders_status_history_data->orders_status_id;
                        $order[$index]->orders_status = $orders_status_history_data->orders_status_name;
                        $order[$index]->orders_status_date_added = $orders_status_history_data->date_added;
                        $order[$index]->admin_comments = $orders_status_history_data->comments;
                      }else{
                        $order[$index]->admin_comments = '';
                      }

                      $i++;
                }

                $orders_products = DB::table('orders_products')
                  ->join('products', 'products.products_id','=', 'orders_products.products_id')
                  ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                  })
                  ->select('orders_products.*', 'image_categories.path as image')
                  ->where('orders_products.orders_id', '=', $orders_id)->get();
                  $k = 0;
                  $product = array();
                  foreach($orders_products as $orders_products_data){
                      // $orders_products_data->products_price =  Orders::convertprice($orders_products_data->products_price, $requested_currency);
          // $orders_products_data->final_price =  Orders::convertprice($orders_products_data->final_price, $requested_currency);
          //categories
                    $categories = DB::table('products_to_categories')
                            ->leftjoin('categories','categories.categories_id','products_to_categories.categories_id')
                            ->leftjoin('categories_description','categories_description.categories_id','products_to_categories.categories_id')
                            ->select('categories.categories_id','categories_description.categories_name',
                            'categories.categories_image','categories.categories_icon', 'categories.parent_id')
                            ->where('products_id','=', $orders_products_data->products_id)
                            ->where('categories_description.language_id','=',$language_id)->get();

                    $orders_products_data->categories =  $categories;

                    $product_attribute = DB::table('orders_products_attributes')
                      ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                      ])
                      ->get();

                    $orders_products_data->attributes = $product_attribute;
                    $orders_products_data->final_price = number_format($orders_products_data->final_price * $data->currency_value,2,'.','');
                    $orders_products_data->products_price = number_format($orders_products_data->products_price * $data->currency_value,2,'.','');
                   
                    $product[$k] = $orders_products_data;
                    $k++;
                  }
                  $data->data = $product;
                  $orders_data[] = $data;
                  $index++;
          }
           $responseData = array('success'=>'1', 'data'=>$orders_data, 'message'=>"Returned all orders.");
        }else{
          $orders_data = array();
          $responseData = array('success'=>'0', 'data'=>$orders_data, 'message'=>"Order is not placed yet.");
        }

     }else{
        $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
     }
     $orderResponse = json_encode($responseData);
     return $orderResponse;
  }

}