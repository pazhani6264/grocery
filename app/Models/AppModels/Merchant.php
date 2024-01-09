<?php
namespace App\Models\AppModels;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Products;

use DB;
use Lang;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon\Carbon;
use Session;
class Merchant extends Model{

	public static function merchantLogin($request)
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
            if($request->email == '' || $request->password == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $adminInfo = array("email" => $request->email, "password" => $request->password);
                if(auth()->attempt($adminInfo)) {
                    $admin = auth()->user()->id;
                    $administrators = DB::table('users')->where('id', $admin)->first();
                    //print_r($admin);die();
                    if(auth()->user()->role_id == '21'){
                    	if(auth()->user()->status == '1'){
                    		$responseData = array('success'=>'1','data'=>$administrators,'message'=>"Login successful.");
                    	}else{
                    		$responseData = array('success'=>'0','message'=>"Your account is disabled. please contact your system administrator");
                    	}    
                    }else{
                        $responseData = array('success'=>'0','message'=>"You're not a cashier..");
                    }  
                }else{
                  $responseData = array('success'=>'0','message'=>"Invalid email or password.");  
                }
            }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}

	public static function convertprice($current_price, $requested_currency)
  {
    $required_currency = DB::table('currencies')->where('code', $requested_currency)->first();
    $products_price = $current_price * $required_currency->value;

    return $products_price;
  }

	public static function getMerchantOrders($request)
	{
		  $consumer_data 		 				  =  array();
		  //$customers_id						  =  $request->customers_id;
		  $language_id						  =  $request->language_id;
		  $requested_currency       =  $request->currency_code;
      $skip = $request->page_number . '0';
		  $consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
		  $consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		  $consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		  $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		  $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		  $consumer_data['consumer_url']  	  =  __FUNCTION__;
		  $authController = new AppSettingController();
		  $authenticate = $authController->apiAuthenticate($consumer_data);
		  if($authenticate==1){
		  	 $order = DB::table('orders')->orderBy('orders_id', 'desc')->skip($skip)->take(10)->get();
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
              $amount =  Merchant::convertprice($amount[0], $requested_currency);
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
       //print_r($orders_status_history);die();

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
        ->select('orders_products.*', 'image_categories.path as image','image_categories.path_type as path_type')
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
        $total_order = DB::table('orders')->count();
        $responseData = array('success'=>'1', 'data'=>$orders_data,'total_order'=>$total_order, 'message'=>"Returned all orders.");
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

	public static function viewStatus($request)
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
			if($request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
            	 $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $request->language_id)->where('role_id', '<=', 2)->get();
               if (!$status->isEmpty()) {
               		$responseData = array('success'=>'1', 'data'=>$status, 'message'=>"Returned all status.");
               }else{
               	$responseData = array('success'=>'0','message'=>"No data found.");
               }
            }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
    	return $mediaResponse;
	}

	public static function updateOrder($request)
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
			if($request->orders_status == '' || $request->old_orders_status == '' || $request->orders_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
            	if ($request->old_orders_status == $request->orders_status) {
            		$responseData = array('success'=>'0','message'=>"Nothing to change. The order was not updated!");
            	}else{
            		$date_added = date('Y-m-d H:i:s');
			        $orders_status = $request->orders_status;
			        $old_orders_status = $request->old_orders_status;
     				$comments = $request->comments;
        			$orders_id = $request->orders_id;

        $status = DB::table('orders_status')->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', 1)->where('role_id', '<=', 2)->where('orders_status_description.orders_status_id', '=', $orders_status)->get();

        $current_boy = DB::table('orders_to_delivery_boy')
            ->leftjoin('deliveryboy_info','deliveryboy_info.users_id','=','orders_to_delivery_boy.deliveryboy_id')
            ->where('orders_to_delivery_boy.orders_id', '=', $orders_id)
            ->where('orders_to_delivery_boy.is_current', '=', '1')
            ->orderby('orders_to_delivery_boy.created_at', 'DESC')
            ->first();
        //orders status history
        $orders_history_id = DB::table('orders_status_history')->insertGetId(
            ['orders_id' => $orders_id,
                'orders_status_id' => $orders_status,
                'date_added' => $date_added,
                'customer_notified' => '1',
                'comments' => $comments,
            ]);

        	if($orders_status == '2') {

             if(!empty($current_boy->deliveryboy_id) and $old_orders_status != '2') {

                

                $order_data = DB::table('orders')->where('orders_id', '=', $orders_id)->first();

                if($order_data->shipping_method == 'shippingByKM') {
                $kilometer = round($order_data->order_km);
                $commissionbykm = DB::table('products_shipping_rates_km')->where('km_from', '<=', $kilometer)->where('km_to', '>=', $kilometer)->where('km_status', 1)->get();

                if(count($commissionbykm) > 0) {
                    $commission = $commissionbykm[0]->km_commission;
                }
                else
                {
                    $commission = 0;
                }

                    DB::table('users_balance')->insertGetId(
                        ['orders_id' => $orders_id,
                            'users_id' => $current_boy->deliveryboy_id,
                            'products_id' => 0,
                            'created_at' => $date_added,
                            'updated_at' => $date_added,
                            'transaction_type' => 'in',
                            'amount' => $commission,
                            'status' => 'Completed',
                            'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                        ]
                        );
    
                        DB::table('payment_withdraw')->insertGetId(
                            [   'orders_id' => $orders_id,
                                'user_id' => $current_boy->deliveryboy_id,
                                'amount' => $commission,
                                'created_at' => $date_added,
                                'status'=>0,
                                'method'=>'Bank',
                            ]
                        );
                }
                elseif($order_data->shipping_method == 'shippingByWeight') {
                    $weight = $order_data->order_weight;

                    $commissionbyweight = DB::table('products_shipping_rates')->where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->where('products_shipping_status', 1)->get();

                    if (count($commissionbyweight) > 0) {
                        $commission = $commissionbyweight[0]->weight_commission;
                    }
                    else
                    {
                        $commission = 0;
                    }
    
                        DB::table('users_balance')->insertGetId(
                            ['orders_id' => $orders_id,
                                'users_id' => $current_boy->deliveryboy_id,
                                'products_id' => 0,
                                'created_at' => $date_added,
                                'updated_at' => $date_added,
                                'transaction_type' => 'in',
                                'amount' => $commission,
                                'status' => 'Completed',
                                'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                            ]
                            );
        
                            DB::table('payment_withdraw')->insertGetId(
                                [   'orders_id' => $orders_id,
                                    'user_id' => $current_boy->deliveryboy_id,
                                    'amount' => $commission,
                                    'created_at' => $date_added,
                                    'status'=>0,
                                    'method'=>'Bank',
                                ]
                            );
                    }
                else
                {

                    DB::table('users_balance')->insertGetId(
                    ['orders_id' => $orders_id,
                        'users_id' => $current_boy->deliveryboy_id,
                        'products_id' => 0,
                        'created_at' => $date_added,
                        'updated_at' => $date_added,
                        'transaction_type' => 'in',
                        'amount' => $current_boy->commission,
                        'status' => 'Completed',
                        'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                    ]
                    );

                    DB::table('payment_withdraw')->insertGetId(
                        [   'orders_id' => $orders_id,
                            'user_id' => $current_boy->deliveryboy_id,
                            'amount' => $current_boy->commission,
                            'created_at' => $date_added,
                            'status'=>0,
                            'method'=>'Bank',
                        ]
                    );
                }
            }

            $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_id)->get();

            foreach ($orders_products as $products_data) {
                DB::table('products')->where('products_id', $products_data->products_id)->update([
                    'products_quantity' => DB::raw('products_quantity - "' . $products_data->products_quantity . '"'),
                    'products_ordered' => DB::raw('products_ordered + 1'),
                ]);
            }
            //add point to user
            $exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->get();
            $settings = DB::table('settings')->where('id', '=','148')->first();

            if(count($exist)=='0' && $settings->value == '1'){
            $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();

            $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();
            if($point){
                $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
                $no_rm = $point->no_rm;
                $no_point = $point->points;
                $amount = $order_user->order_price-$order_user->shipping_cost;
                $count_rm = round($amount/$no_rm);
                $give_point = $count_rm*$no_point;

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


                    $user= DB::table('users')->where('id', '=', $order_user->customers_id)->first();

                    $order_email = DB::table('settings')->where('id', '=','71')->first();
                    $app_name = DB::table('settings')->where('id', '=','19')->first();
                    $website_logo = DB::table('settings')->where('id', '=','16')->first();
                    $api_key = DB::table('settings')->where('id', '=','123')->first();
                    $domain = DB::table('settings')->where('id', '=','124')->first();
                    $website_link = DB::table('settings')->where('id', '=','103')->first();
                    $imgurl = $website_link->value.$website_logo->value;

                    $title = 'Congratulation '.$user->first_name. ' !';

                    $html = '<div style="padding: 50px;background: #f4f4f3;"><div style="text-align:center;"><img src="'.$imgurl .'" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"><p style="text-align:center;">Congratulations ! You got '.$give_point.' points for your previous purchase.</p></div></div>';


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



            // update user table
                DB::table('users')->where('id', $order_user->customers_id)->update([
                    'loyalty_points' => $newbalnce,
                ]);
            }
        }
        }

        if ($orders_status == '3') {


            if (!empty($current_boy->deliveryboy_id) and $old_orders_status != '2') {

                    DB::table('users_balance')
                    ->where('products_id', 0)
                    ->where('users_id', $current_boy->deliveryboy_id)
                    ->where('orders_id', $orders_id)
                    ->update([
                        'status' => 'Recharge Back',
                        'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
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
                        'status' => 'Cancelled By Admin',
                        'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
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
                    'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                    'added_date' => time(),
                    'created_at' => $date_added,
                    'stock_type' => 'in',

                ]);
                //dd($product_detail);
                if ($product_detail->products_type == 1) {
                    $product_attribute = DB::table('orders_products_attributes')
                        ->where([
                            ['orders_products_id', '=', $products_data->orders_products_id],
                            ['orders_id', '=', $products_data->orders_id],
                        ])
                        ->get();

                    foreach ($product_attribute as $attribute) {
                        //dd($attribute->products_options,$attribute->products_options_values);
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
        }

        $orders = DB::table('orders')->where('orders_id', '=', $orders_id)
            ->where('customers_id', '!=', '')->get();

        $data = array();
        $data['customers_id'] = $orders[0]->customers_id;
        $data['orders_id'] = $orders_id;
        $data['status'] = $status[0]->orders_status_name;

        //point upadete
        //$inpoint = DB::table('transaction_points')->where('user_id', '=', $orders[0]->customers_id)->where('points_status', '=', 'in')->where('order_id', '=', $orders_id)->first();

        // if($inpoint){
        //     $cdata = DB::table('users')->where('id', $orders[0]->customers_id)->first();
        //     $oldbalnce=$cdata->loyalty_points;
        //     $newbalnce=$oldbalnce-$inpoint->points;

        //     //insert point details
        //             DB::table('transaction_points')->insert([
        //                 'user_id' => $orders[0]->customers_id,
        //                 'order_id'=> $orders_id,
        //                 'points' => $inpoint->points,
        //                 'balance_points' => $newbalnce,
        //                 'points_status' => 'out',
        //                 'description'=>'Cancelled purchase',
        //                 'created_at' => $date_added,
        //                 'updated_at' => $date_added
        //             ]);
        //     // update user table
        //             DB::table('users')->where('id', $orders[0]->customers_id)->update([
        //                 'loyalty_points' => $newbalnce,
        //             ]);
        // }
        // get order status details
            $ustatus = DB::table('orders_status')
            ->leftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->select('orders_status.orders_status_id','orders_status_description.orders_status_name')
            ->where('orders_status.orders_status_id', $orders_status)
            ->where('orders_status_description.language_id', '1')
            ->first();

        		$responseData = array('success'=>'1','data'=>$ustatus,'message'=>"Orders has been updated successfully!");
            	}
            }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
    	return $mediaResponse;
	}

	public static function deliveryBoys($request)
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
			$delivery_boys = DB::table('users')
            ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
            ->leftjoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'deliveryboy_info.availability_status')
            ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status', 'orders_status_description.orders_status_name as deliveryboy_status')
            ->where('status', 1)
            ->where('users.role_id', 4)
            ->where('language_id', 1)
            ->get();

            if(!$delivery_boys->isEmpty()) {
               	$responseData = array('success'=>'1', 'data'=>$delivery_boys, 'message'=>"Returned all delivery boys.");
            }else{
               $responseData = array('success'=>'0','message'=>"No data found.");
            }

		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
    	return $mediaResponse;
	}

	public static function currentBoy($request)
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
			if($request->orders_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
            	$current_boy = DB::table('orders_to_delivery_boy')
	            ->select('orders_to_delivery_boy.*')
	            ->where('orders_to_delivery_boy.orders_id', '=', $request->orders_id)
	            ->where('orders_to_delivery_boy.is_current', '=', '1')
	            ->orderby('orders_to_delivery_boy.created_at', 'DESC')
	            ->first();
	           if($current_boy){
	           		$responseData = array('success'=>'1', 'data'=>$current_boy, 'message'=>"Returned current delivery boy.");
	           }else{
	           		$responseData = array('success'=>'0','message'=>"No data found.");
	           }
            }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
    	return $mediaResponse;
	}
	public static function assignOrders($request)
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
			if($request->orders_id == '' || $request->deliveryboy_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
            	$comments = $request->delivery_comments;
		        $orders_id = $request->orders_id;
		        $old_deliveryboy_id = $request->old_deliveryboy_id;
		        $deliveryboy_id = $request->deliveryboy_id;
		        $created_at = date('Y-m-d H:i:s');

		        $orders_history_id = DB::table('orders_status_history')->insertGetId(
		            ['orders_id' => $orders_id,
		                'orders_status_id' => 10,
		                'date_added' => $created_at,
		                'customer_notified' => '1',
		                'comments' => addslashes($comments),
		                'role_id' => 1,
		            ]);

		        DB::table('orders_to_delivery_boy')->where(['orders_id' => $orders_id])->update(['is_current' => 0]);

		        if ($deliveryboy_id != $old_deliveryboy_id) {
		           DB::table('deliveryboy_info')->where('users_id', $old_deliveryboy_id)->update(['availability_status' => 8]);

		           DB::table('deliveryboy_info')->where('users_id', $deliveryboy_id)->update([
		                'availability_status' => 10]);
		        }

		        $orders_to_deliveryboy_id = DB::table('orders_to_delivery_boy')->insertGetId([
			            'deliveryboy_id' => $deliveryboy_id,
			            'orders_id' => $orders_id,
			            'is_current' => '1',
			    ]);

			  $devices_data = DB::table('devices')->where('user_id', $deliveryboy_id)->first();
        if($devices_data){
			      $device_id = $devices_data->device_id;
		        $message = 'New order assigned';
		        $title = 'order assigned';
		        $pageResponse = 1;
		        $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/images/logo.png';

		         $sendData = array(
		            'body' => $message,
		            'title' => $title,
		            'title' => $title,
		            'icon' => 'myicon', /*Default Icon*/
		            'sound' => 'mySound', /*Default sound*/
		            'key' => 'order_id', 
		            'value' => $orders_id, 
		            'key1' => 'deliveryboy_id', 
		            'value1' => $deliveryboy_id, 
		            'key2' => 'language_id', 
		            'value2' => '1', 
		            'image' => $websiteURL,
        		);
		         if($devices_data != ''){
            		$response[] = $authController->onesignalNotification($device_id, $sendData, $pageResponse);
        		}else {
            		$response[] = '2';
            	}
            }
            $responseData = array('success'=>'1','message'=>"Orders successfully assigned to the delivery boy");
            }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
    	return $mediaResponse;
	}

  public static function getOrderStatus($request)
  {
    $consumer_data               =  array();
    $consumer_data['consumer_key']      =  request()->header('consumer-key');
    $consumer_data['consumer_secret']   =  request()->header('consumer-secret');
    $consumer_data['consumer_nonce']    =  request()->header('consumer-nonce');
    $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
    $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
    $consumer_data['consumer_url']      =  __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    if($authenticate==1){
       if($request->orders_id == '' || $request->language_id == ''){
          $responseData = array('success'=>'0','message'=>"Required all Fields.");
       }else{
          $language_id=$request->language_id;
          $orders_id=$request->orders_id;

          $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->select('orders_status_history.orders_status_history_id','orders_status_description.orders_status_name', 'orders_status.orders_status_id', 'orders_status_history.comments', 'orders_status_history.date_added')
            ->where('orders_id', '=', $orders_id)
            ->where('orders_status.role_id','=',2)->where('orders_status_description.language_id','=',$language_id)->orderby('orders_status_history.orders_status_history_id', 'ASC')->get();
           if (!$orders_status_history->isEmpty()) {
              $responseData = array('success'=>'1', 'data'=>$orders_status_history, 'message'=>"Returned all status.");
           }else{
              $responseData = array('success'=>'0','message'=>"No data found.");
           }
       }
       
    }else{
      $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
    }
    $mediaResponse = json_encode($responseData);
    return $mediaResponse;
  }
}
?>