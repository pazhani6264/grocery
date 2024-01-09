<?php
namespace App\Models\AppModels;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Core\Setting;

use DB;
class Wallet extends Model{

	public static function viewWalletPayment($request){

		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
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

          'method' => 'directbank',
          'public_key' => $payments_setting['account_name']->value,
          'auth_token' => '',
          'client_id' => '',
          'client_secret' => '',
          'environment' => $enviroment,
          'name' => $payments_setting['account_name']->name,
          'active' => $payments_setting['account_name']->status,
          'payment_method'=> 'directbank',
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


	    //$result[] = $braintree_card;
	    //$result[] = $braintree_paypal;
	    //$result[] = $stripe;
	    //$result[] = $cod;
	    //$result[] = $instamojo;
	    //$result[] = $hyperpay;
	    //$result[] = $razorpay;
	    $result[] = $paytm;
	    $result[] = $ipay88;
	    //$result[] = $paynet_fpx;
	    //$result[] = $premierpay;
	   $result[] = $banktransfer;
    //$result[10] = $paystack;

    $responseData = array('success'=>'1', 'data'=>$result, 'message'=>"Payment methods are returned.");
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}

		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function viewWalletHistory($request){

		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' ){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('users')->where('id', '=',$request->customer_id)->where('role_id', '=','2')->first();
				if($result){
					$wallet=DB::table('wallet')->where('user_id', $request->customer_id)->orderBy('created_at', 'DESC')->get();
					if (!$wallet->isEmpty()){
						$responseData = array('success'=>'1','wallet_amount'=>$result->wallet_amount,'data'=>$wallet,'message'=>"Returned wallet data");
					}else{
						$responseData = array('success'=>'0','message'=>"No data found");	
					}
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid customer id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}

	public static function addWallet($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->amount == '' || $request->type == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('users')->where('id', '=',$request->customer_id)->where('role_id', '=','2')->first();
				if($result){
					$refno = uniqid();
					if($request->type == 'banktransfer'){
						$status='3';
					}else{
						$status='1';
					}
					$wallet = DB::table('wallet')->insertGetId([
	                    'user_id' => $request->customer_id,
	                    'payment_method' => $request->type,
	                    'payment_id' => $refno,
	                    'amount' => $request->amount,
	                    'pay_status' => 'TXN_FAILURE',
	                    'status' => $status,
	                    'payment_response' =>$request->type,
	                    'transaction_id' =>$refno,
	                    'wallet_type'   => 'deposit',
	                    'description'   => 'Add Money to Wallet',
	                    'created_at'=>date('Y-m-d H:i:s'),
	                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
					$responseData = array('success'=>'1','payment_id'=>$refno,'message'=>"Add wallet successfully");	
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid customer id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}
	public static function getWalletStatus($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->payment_id == '' ){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('wallet')->where('user_id', '=',$request->customer_id)->where('payment_id', '=',$request->payment_id)->first();
				if($result){
					$responseData = array('success'=>'1','data'=>$result,'message'=>"Returned wallet data");
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid payment id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}

	public static function uploadBankbill($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('wallet')->where('id', '=',$request->id)->where('payment_method', '=','banktransfer')->first();
				if($result){
					$fileName = time() . '.' . $request->bankimage->getclientoriginalextension();
			        $request->bankimage->getclientoriginalextension();
			        $request->bankimage->move(base_path('public/images/banktransfer'),$fileName);

			        $bank_image = 'images/banktransfer/'.$fileName;
			         DB::table('wallet')->where('id',$request->id)->update([
			            'payment_response' => $bank_image,
			            'status' =>'4',
			        ]);
			         $responseData = array('success'=>'1','message'=>"Image uploaded successfully");
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid payment id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
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
}
?>