<?php
namespace App\Models\AppModels;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Products;
use App\Models\Core\Setting;
use Illuminate\Support\Str;

use DB;
use Lang;
use Validator;
use Mail;
use DateTime;
use Auth;
Use \Carbon\Carbon;
use Session;

class Pos extends Model{

	public static function addposCart($request){

		$products = new Products();
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
			if($request->products_id == '' || $request->quantity == '' || $request->session_id == '' || $request->cart_offline_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
                $cid=$request->session_id;
                //$already = DB::table('customers_basket')->where('session_id',$request->session_id)->where('products_id', $request->products_id)->first();
                //print_r($result);die();
                //if($already){
                 //$responseData = array('success'=>'0','message'=>"This product is already added in cart");     
                //}else{
          			$products_id=$request->products_id;
		          	if (empty($request->customers_id)) {
		            	$customers_id = '';
		       		} else {
		            	$customers_id = $request->customers_id;
                        DB::table('customers_basket')->where([
                        ['session_id', '=', $request->session_id],
                        ['is_order', '=', '0'],
                        ['hold_status', '=', '0'],
                    ])->update(
                        [
                            'customers_id' => $customers_id,
                        ]);
		        	}

		        	$session_id = $request->session_id;
		        	$customers_basket_date_added = date('Y-m-d H:i:s');

		if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

         //discount_price
        if (!empty($request->discount_price)) {
            $discountprice = $request->discount_price;
        } else {
            $discountprice = '0.00';
        }
            $checkfresh = DB::table('products')->where('products_id', $products_id)->first();
		        	if (empty($customers_id) && $checkfresh->fresh_price=='no') {

		        		$exist = DB::table('customers_basket')->where([
			                ['session_id', '=', $session_id],
			                ['products_id', '=', $products_id],
			                ['is_order', '=', 0],
                            ['serve_status', '=', 0],
			            ])->get();

		        	}elseif($checkfresh->fresh_price=='no'){

		        		$exist = DB::table('customers_basket')->where([
                            ['session_id', '=', $session_id],
			                ['customers_id', '=', $customers_id],
			                ['products_id', '=', $products_id],
			                ['is_order', '=', 0],
                            ['serve_status', '=', 0],
			            ])->get();

		        	}else{
                       $exist=array(); 
                    }
		        	$isFlash = DB::table('flash_sale')->where('products_id', $products_id)
		            ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
		            ->get();
			           //get products detail  is not default
				        if (!empty($isFlash) and count($isFlash) > 0) {
				            $type = "flashsale";
				        } else {
				            $type = "";
				        }

				      $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
                      //print_r($data);die();
				      $detail = $products->products_pos_cart($data);
        			  $result['detail'] = $detail;
                       //print_r($detail);die();
        			  

        	if ($result['detail']['product_data'][0]->products_type == 0) {

            //check lower value to match with added stock
            if ($result['detail']['product_data'][0]->products_max_stock != null and $result['detail']['product_data'][0]->products_max_stock < $result['detail']['product_data'][0]->defaultStock) {
                $default_stock = $result['detail']['product_data'][0]->products_max_stock;
            } else {
                $default_stock = $result['detail']['product_data'][0]->defaultStock;
            }

            if (!empty($exist) and count($exist) > 0) {
                $count = $exist[0]->customers_basket_quantity + $request->quantity;
                $remain = $result['detail']['product_data'][0]->defaultStock - $exist[0]->customers_basket_quantity;

                if ($count > $default_stock){

                   // return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                }

                // if ($count >= $result['detail']['product_data'][0]->defaultStock || $count > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {

                //     return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                // }
            } else {

                //if ($request->quantity > $result['detail']['product_data'][0]->defaultStock || $request->quantity > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {
                if ($request->quantity > $default_stock) {
                    $count = $request->quantity;
                    $remain = $result['detail']['product_data'][0]->defaultStock - $count;
                   // return array('status' => 'exceed');
                }
            }
        }

        if (!empty($result['detail']['product_data'][0]->flash_price)) {
            $final_price = $result['detail']['product_data'][0]->flash_price + 0;
        } elseif (!empty($result['detail']['product_data'][0]->discount_price)) {
            $final_price = $result['detail']['product_data'][0]->discount_price + 0;
        } else {
            $final_price = $result['detail']['product_data'][0]->products_price + 0;
        }

        //$variables_prices = 0
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $attributeid = $request->attributeid;
            $attribute_price = 0;
            if (!empty($attributeid) and count($attributeid) > 0) {

                foreach ($attributeid as $attribute) {
                    $attribute = DB::table('products_attributes')->where('products_attributes_id', $attribute)->first();
                    $symbol = $attribute->price_prefix;
                    $values_price = $attribute->options_values_price;
                    if ($symbol == '+') {
                        //$final_price = intval($final_price) + intval($values_price);
                        $final_price = $final_price + $values_price;
                    }
                    if ($symbol == '-') {
                        //$final_price = intval($final_price) - intval($values_price);
                        $final_price = $final_price - $values_price;
                    }
                }
            }

        }

        //check quantity
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $qunatity['products_id'] = $request->products_id;
            $qunatity['attributes'] = $attributeid;

            $content = $products->productQuantity($qunatity);
            //dd($content);
            $stocks = $content['remainingStock'];

        } else {
            $stocks = $result['detail']['product_data'][0]->defaultStock;

        }

        if ($stocks <= $result['detail']['product_data'][0]->products_max_stock or $result['detail']['product_data'][0]->products_max_stock ==0) {
            $stocksToValid = $stocks;
        } else {
            $stocksToValid = $result['detail']['product_data'][0]->products_max_stock;
        }

        //check variable stock limit
        if (!empty($exist) and count($exist) > 0) {
            $count = $exist[0]->customers_basket_quantity + $request->quantity;
            if ($count > $stocksToValid) {
                // return array('status' => 'exceed');
            }
        }

        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($stocksToValid > $customers_basket_quantity) {
            $customers_basket_quantity = $result['detail']['product_data'][0]->products_min_order;
        }

        //quantity is not default
        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($request->customers_basket_id) {
            $basket_id = $request->customers_basket_id;
            DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                [
                    'customers_id' => $customers_id,
                    'products_id' => $products_id,
                    'session_id' => $session_id,
                    'customers_basket_quantity' => $customers_basket_quantity,
                    'final_price' => $final_price,
                    'customers_basket_date_added' => $customers_basket_date_added,
                ]);

            if (count($request->option_id) > 0) {
                foreach ($request->option_id as $key => $option_id) {

                    DB::table('customers_basket_attributes')->where([
                        ['customers_basket_id', '=', $basket_id],
                        ['products_id', '=', $products_id],
                        ['products_options_id', '=', $option_id],
                    ])->update(
                        [
                            'customers_id' => $customers_id,
                            'products_options_values_id' => $request->options_values_id[$key],
                            'session_id' => $session_id,
                        ]);
                }

            }
        } else {
            //insert into cart
            if (count($exist) == 0) {

                // get product
                $prodata = DB::table('products')->where('products_id', '=',$products_id)->first();
                $totalqnt = $customers_basket_quantity*$prodata->quantity_count;

                $customers_basket_id = DB::table('customers_basket')->insertGetId(
                    [
                        'customers_id' => $customers_id,
                        'products_id' => $products_id,
                        'session_id' => $session_id,
                        'customers_basket_quantity' => $customers_basket_quantity,
                        'total_basket_quantity'=> $totalqnt,
                        'final_price' => $final_price,
                        'original_price'=> $final_price,
                        'customers_basket_date_added' => $customers_basket_date_added,
                        'order_source' => 'normal',
                        'discount_price' => $discountprice,
                        'cart_offline_id'=>$request->cart_offline_id,
                    ]);

                if (!empty($request->option_id) && count($request->option_id) > 0) {
                    foreach ($request->option_id as $key => $option_id) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $option_id,
                                'products_options_values_id' => $request->options_values_id[$key],
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);

                    $attdata = DB::table('products_attributes')->where(['products_id'=>$products_id,'options_id'=>$option_id,'options_values_id'=>$request->options_values_id[$key]])->first();
                     // update total_basket_quantity
                        $total_att = $customers_basket_quantity*$attdata->quantity_count;
                        DB::table('customers_basket')->where('customers_basket_id', $customers_basket_id)->update([
                                'total_basket_quantity'     => $total_att,
                            ]);
                    }

                } else if (!empty($detail['product_data'][0]->attributes)) {

                    foreach ($detail['product_data'][0]->attributes as $attribute) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $attribute['option']['id'],
                                'products_options_values_id' => $attribute['values'][0]['id'],
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);
                    }
                }
            } else {

                $existAttribute = '0';
                $totalAttribute = '0';
                $basket_id = '0';

                if (!empty($request->option_id)) {
                    if (count($request->option_id) > 0) {

                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($request->option_id as $key => $option_id) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $request->options_values_id[$key]],
                                    ['session_id', '=', $session_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }

                            }

                            if ($totalAttribute == $existAttribute) {
                                $basket_id = $exists->customers_basket_id;
                            }
                        }

                    } else
                    if (!empty($detail['product_data'][0]->attributes)) {
                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($detail['product_data'][0]->attributes as $attribute) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $attribute['option']['id']],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $attribute['values'][0]['id']],
                                    ['products_options_id', '=', $option_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }
                                if ($totalAttribute == $existAttribute) {
                                    $basket_id = $exists->customers_basket_id;
                                }
                            }
                        }

                    }

                    //attribute exist
                    if ($basket_id == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => $discountprice,
                                'cart_offline_id'=>$request->cart_offline_id,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $key => $option_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $option_id,
                                        'products_options_values_id' => $request->options_values_id[$key],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    } else {

                        //update into cart
                        DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $keey => $option_id) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        //'products_options_values_id' => $request->options_values_id[$keey],
                                        'session_id' => $session_id,
                                    ]);
                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    }

                } else {
                    //update into cart
                    DB::table('customers_basket')->where('customers_basket_id', '=', $exist[0]->customers_basket_id)->update(
                        [
                            'customers_id' => $customers_id,
                            'products_id' => $products_id,
                            'session_id' => $session_id,
                            'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                            'final_price' => $final_price,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }

		        }
        }
            //update coupons amount
            $coupon = DB::table('temp_pos_coupons')->where('session_id',$session_id)->whereIn('discount_type', ['fixed_cart', 'percent'])->first();
            if($coupon){
                $coupon_data = DB::table('coupons')->where('coupans_id',$coupon->coupon_id)->first();
                // total amount
                $cart_price=0;
                $cdata = DB::table('customers_basket')->where('session_id',$session_id)->where('is_order','0')->get();
                if(!$cdata->isEmpty()){
                    foreach ($cdata as $jescdata) {
                       $cart_price=$cart_price+($jescdata->final_price*$jescdata->customers_basket_quantity); 
                    }
                }
               if($coupon->discount_type=='fixed_cart'){
                    if ($coupon->amount < $cart_price) {
                        $coupon_discount = $coupon->amount;
                    }else{
                        $coupon_discount = $cart_price;
                    }
               }elseif($coupon->discount_type == 'percent'){
                    $current_discount = $coupon->amount / 100 * $cart_price;
                    $ccart_price = $cart_price - $current_discount;
                    if ($ccart_price > 0) {
                        if(!empty($coupon_data->cap_amount)){
                            if($current_discount < $coupon_data->cap_amount){
                                $coupon_discount = $current_discount;
                            }else{
                                $coupon_discount = $coupon_data->cap_amount;
                            }
                        }else{
                            $coupon_discount = $current_discount;
                        }
                    }else{
                        $coupon_discount = $cart_price;
                    }
               }
               // update coupons
               DB::table('temp_pos_coupons')->where('session_id', '=', $session_id)->update(
                [
                    'discount' => $coupon_discount,
                ]);   
            }
            //$cartdata = $authController->viewposCartDetails($session_id);
            //$cartuser = $authController->getPosCartUser($session_id);
            //$cartcoupons = $authController->getPosCartCoupons($session_id);
            //$cartdiscount = $authController->getPosCartDiscount($session_id);
            //$gettable = $authController->getPosBookTable($session_id);
            //$gethold = $authController->getPosHold($session_id);
            //$getsaleman = $authController->getSaleMan($session_id);
            //print_r($cartdata);die();
        	//$responseData = array('success'=>'1','message'=>"Cart added successfully.",'data'=>$cartdata,'user'=>$cartuser,'coupon'=>$cartcoupons,'discount'=>$cartdiscount,'table'=>$gettable,'hold'=>$gethold,'salesman'=>$getsaleman);
            if (count($exist) == 0) {
                $basketid=$customers_basket_id;
            }else{
                $basketid =$exist[0]->customers_basket_id;
            }
            $responseData = array('success'=>'1','message'=>"Cart added successfully.",'offline_id'=>$request->cart_offline_id,'basket_id'=>$basketid);
          //}
    }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function viewposCart($request)
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
		$language_id='1';

		if($authenticate==1){
            $getsetting=$authController->getSetting();
			$cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                'products_description.products_name as products_name', 'products.products_quantity as quantity',
                'products.products_price as price', 'products.products_weight as weight',
                'products.products_weight_unit as unit','products.product_serve','products.fresh_price','products.products_tax_class_id')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', $language_id)
            ->where('customers_basket.hold_status', '=','0');
        if (empty($request->customers_id)) {
            $cart->where('customers_basket.session_id', '=',$request->session_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        } else {
            $cart->where('customers_basket.customers_id', '=',$request->customers_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        }

        $baskit = $cart->get();
        $result = array();
	        if (!$baskit->isEmpty()){
				  foreach ($baskit as $baskit_data) {
			            //products_image
			            $default_images = DB::table('image_categories')
			                ->where('image_id', '=', $baskit_data->products_image)
			                ->where('image_type', 'THUMBNAIL')
			                ->first();

			            if ($default_images) {
			                $baskit_data->image = $default_images->path;
			            } else {
			                $default_images = DB::table('image_categories')
			                    ->where('image_id', '=', $baskit_data->products_image)
			                    ->where('image_type', 'MEDIUM')
			                    ->first();

			                if ($default_images) {
			                    $baskit_data->image = $default_images->path;
			                } else {
			                    $default_images = DB::table('image_categories')
			                        ->where('image_id', '=', $baskit_data->products_image)
			                        ->where('image_type', 'ACTUAL')
			                        ->first();
			                    $baskit_data->image = $default_images->path;
			                }
			            }
                        if($baskit_data->products_tax_class_id==0){
                            $baskit_data->products_tax = '0';
                        }else{
                           $tax=DB::table('tax_rates')->where('tax_class_id', $baskit_data->products_tax_class_id)->first();
                           if($tax){
                                $baskit_data->products_tax = $tax->tax_rate;
                           }else{
                                $baskit_data->products_tax = '0';
                           }
                        }

                        $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })
                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                       ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=',  $language_id)
                       ->where('products_options_values_descriptions.language_id', '=',  $language_id);

                   if (empty($request->customers_id)) {
                       $attributes->where('customers_basket_attributes.session_id', '=',  $request->session_id);
                   } else {
                       $attributes->where('customers_basket_attributes.customers_id', '=', $request->customers_id);
                   }

                   $attributes_data = $attributes->get();
                        // $attributes = DB::table('customers_basket_attributes')
                        //     ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                        //     ->get();
                            if (!$attributes_data->isEmpty()) { 
                               $baskit_data->attributes = $attributes_data; 
                            }else{
                               $baskit_data->attributes = [];
                            }
			            array_push($result, $baskit_data);
			        }

                    $cartuser = $authController->getPosCartUser($request->session_id);
                    $cartcoupons = $authController->getPosCartCoupons($request->session_id);
                    $cartdiscount = $authController->getPosCartDiscount($request->session_id);
                    $gettable = $authController->getPosBookTable($request->session_id);
                    $gethold = $authController->getPosHold($request->session_id);
                    $getsaleman = $authController->getSaleMan($request->session_id);
                    
			       $responseData = array('success'=>'1', 'data'=>$result, 'user'=>$cartuser, 'coupon'=>$cartcoupons, 'discount'=>$cartdiscount,'table'=>$gettable,'hold'=>$gethold,'salesman'=>$getsaleman,'message'=>"Return all cart data."); 
	        }else{
                $gettable = $authController->getPosBookTable($request->session_id);
                $getguest = $authController->getGuestUser();
                $gethold = $authController->getPosHold($request->session_id);
	        	$responseData = array('success'=>'1','message'=>"No data found",'table'=>$gettable,'user'=>$getguest,'hold'=>$gethold);	
	        }	
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function deleteposCart($request)
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

			if($request->id == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{

          		$result = DB::table('customers_basket')->where('customers_basket_id', '=',$request->id)->first();

          		if($result){

          			DB::table('customers_basket')->where([
			            ['customers_basket_id', '=', $request->id],
			        ])->delete();

			        DB::table('customers_basket_attributes')->where([
			            ['customers_basket_id', '=', $request->id],
			        ])->delete();

			        $responseData = array('success'=>'1','message'=>"Cart deleted successfully");
          		}else{
          			$responseData = array('success'=>'0','message'=>"Invalid id");
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

    public static function updateposCart($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data); 
        if($authenticate==1){
            if($request->customers_basket_id == '' || $request->session_id == '' || $request->quantity == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $result = DB::table('customers_basket')->where('customers_basket_id', '=',$request->customers_basket_id)->where('session_id', '=',$request->session_id)->first(); 
               if($result){
                    $prodata = DB::table('products')->where('products_id', '=',$result->products_id)->first();
                    $totalqnt = $request->quantity*$prodata->quantity_count;

                    DB::table('customers_basket')->where('customers_basket_id', '=', $request->customers_basket_id)->update(
                        [
                            'session_id' => $request->session_id,
                            'customers_basket_quantity' => $request->quantity,
                            'total_basket_quantity'=>$totalqnt,
                        ]);
                    $responseData = array('success'=>'1', 'message'=>"Cart quantity update successfully.");
               }else{
                 $responseData = array('success'=>'0', 'message'=>"Invalid customers basket id or session id.");
               }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

	public static function clearallposCart($request)
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
			if($request->session_id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('customers_basket')->where('session_id', '=',$request->session_id)->get();

				if (!$result->isEmpty()){
					//print_r($result);die();
					foreach ($result as $jesresult) {

						DB::table('customers_basket')->where([
			            ['customers_basket_id', '=', $jesresult->customers_basket_id],
				        ])->delete();

				        DB::table('customers_basket_attributes')->where([
				            ['customers_basket_id', '=', $jesresult->customers_basket_id],
				        ])->delete();
					}
                    // delete apply coupons
                    $coupons = DB::table('temp_pos_coupons')->where('session_id', '=',$request->session_id)->first();
                    if($coupons){
                        // delete coupons tb_usage_voucher_list
                        DB::table('tb_usage_voucher_list')->where([
                            ['orderID', '=', $coupons->id],
                        ])->delete();

                        // delete apply coupons
                        DB::table('temp_pos_coupons')->where([
                            ['session_id', '=', $request->session_id],
                        ])->delete();

                    }
					$responseData = array('success'=>'1','message'=>"Cart successfully cleared");
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid session id");	
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}

	public static function cashierLogin($request)
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
                    if(auth()->user()->status == '1'){
                    $admin = auth()->user()->id;
                    $administrators = DB::table('users')->where('id', $admin)->first();
                    //print_r($admin);die();
                    if(auth()->user()->role_id == '14'){
                        // get outlet address
                        if($administrators->outlet=='0'){
                            $outaddress=[];
                        }else{
                            $address = DB::table('appointment_outlet')
                            ->leftjoin('zones', 'zones.zone_id', '=', 'appointment_outlet.zone_id')
                            ->leftjoin('countries', 'countries.countries_id', '=', 'appointment_outlet.countries_id')
                            ->select('appointment_outlet.*','zones.zone_name','countries.countries_name')
                            ->where('appointment_outlet.id', '=', $administrators->outlet)
                            ->first();
                            if($address){
                               $outaddress=$address; 
                            }else{
                               $outaddress=[]; 
                            }
                        }
                        // get plan details
                        $superadmin=DB::table('users')->where('id', '1')->first();
                        if($superadmin){
                            $result=DB::connection('mysql2')->table('tb_user')->where('id', $superadmin->super_admin_id)->first();
                            if($result){
                                $plandata=DB::connection('mysql2')->table('manage_plan')->where('plan_method', $result->plan)->first();
                                if($plandata){
                                   $plan=$plandata;
                                }else{
                                   $plan=[];  
                                }
                            }else{
                              $plan=[];  
                            }
                        }else{
                            $plan=[];
                        }
                        $info=DB::table('cashier_info')->where('admin_id', $admin)->first();
                        if($info){
                            $infodata=$info;
                        }else{
                           $infodata=[]; 
                        }
                        if($administrators->user_name=='segment'){
                            $segment = $authController->getSegment($administrators->id);
                        }else{
                           $segment=[]; 
                        }
                        $responseData = array('success'=>'1','data'=>$administrators,'outlet'=>$outaddress,'subscription'=>$plan, 'setting'=>$infodata,'segment'=>$segment,'message'=>"Login successful.");
                    }elseif(auth()->user()->role_id == '26'){
                        $responseData = array('success'=>'1','data'=>$administrators,'outlet'=>[],'subscription'=>[],'setting'=>[],'segment'=>[],'message'=>"Login successful.");
                    }elseif(auth()->user()->role_id == '27'){
                        $responseData = array('success'=>'1','data'=>$administrators,'outlet'=>[],'subscription'=>[],'setting'=>[],'segment'=>[],'message'=>"Login successful.");
                    }elseif(auth()->user()->role_id == '29'){
                         $responseData = array('success'=>'1','data'=>$administrators,'outlet'=>[],'subscription'=>[],'setting'=>[],'segment'=>[],'message'=>"Login successful.");
                    }else{
                       $responseData = array('success'=>'0','message'=>"You're not a cashier.."); 
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid email or password.");  
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

    public static function viewBill($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->language_id == '' || $request->currency_code == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{

            $date = $request->date;
            $getdate = '';
            if($request->date == '')
            {
                $startdate = date('Y-m-d');
                $enddate = date('Y-m-d');
            }
            else
            {
                $startdate = $request->date;
                $enddate = $request->date;
            }

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                
             $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
             if($cashier){

                $info=DB::table('cashier_info')->where('admin_id', $cashier->id)->first();

                $order = DB::table('orders');
                if($info){
                    if($info->notification=='0'){
                        $order=$order->leftJoin('users','users.id', '=', 'orders.cashier_id')->where('cashier_id', $cashier->id)->select('orders.*','users.first_name as cashier_first_name','users.last_name as cashier_last_name'); 
                    }else{
                      $order=$order->leftJoin('users','users.id', '=', 'orders.cashier_id')->select('orders.*','users.first_name as cashier_first_name','users.last_name as cashier_last_name');  
                    }
                }else{
                    $order=$order->leftJoin('users','users.id', '=', 'orders.cashier_id')->where('cashier_id', $cashier->id)->select('orders.*','users.first_name as cashier_first_name','users.last_name as cashier_last_name');
                }
                $order=$order->whereBetween('date_purchased', [$dateFrom, $dateTo])
                ->orderBy('orders_id', 'desc')
                ->get();
                if(count($order) > 0){
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
                //salesperson_commission
                $commission=DB::table('salesperson_commission')
                    ->leftJoin('users', function($query) {
                        $query->whereRaw("find_in_set(users.id, salesperson_commission.salesperson_id)");
                    })
                    ->where('salesperson_commission.order_id', '=', $data->orders_id)
                    ->select('users.first_name','users.last_name','salesperson_commission.amount as total_amount','salesperson_commission.single_amount')
                    ->get();
                if(count($commission)>0){
                  $data->salesperson = $commission; 
                }else{
                  $data->salesperson = array(); 
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
                      $amount =  Orders::convertprice($amount[0], $request->currency_code);
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

                $orders_id   = $data->orders_id;

                $orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id', 'orders_status_history.comments')
                    ->where('orders_id', '=', $orders_id)
                    ->where('orders_status.role_id','=',2)->orderby('orders_status_history.orders_status_history_id', 'ASC')->get();

                $order[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $order[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                $order[$index]->customer_comments = $orders_status_history[0]->comments;

                $total_comments = count($orders_status_history);
                $i = 1;

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
                ->select('orders_products.*','image_categories.path as image','image_categories.path_type as image_path_type')
                ->where('orders_products.orders_id', '=', $orders_id)->get();
                $k = 0;
                $subtotal = 0;
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
                          ->where('categories_description.language_id','=',$request->language_id)->get();

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
                  $subtotal += $orders_products_data->final_price-$orders_products_data->discount_price;
                  $k++;
                }
                $data->data = $product;
                $data->subtotal = $subtotal;
                $orders_data[] = $data;
              $index++;
              }
                $responseData = array('success'=>'1', 'data'=>$orders_data, 'message'=>"Returned all orders.");
                }else{
                    $orders_data = array();
                    $responseData = array('success'=>'0', 'data'=>$orders_data, 'message'=>"Order is not placed yet.");
                }
             }else{
                $responseData = array('success'=>'0','message'=>"Invalid cashier id.");
            }
           } 
        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function cancelBill($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->order_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{ 
            $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
            if($cashier){
                $order = DB::table('orders')->where('orders_id', $request->order_id)->first();
            if($order){
                $date_added = date('Y-m-d h:i:s');
                 $orders_history_id = DB::table('orders_status_history')->insertGetId(
                    ['orders_id' => $request->order_id,
                        'orders_status_id' => '3',
                        'date_added' => $date_added,
                        'customer_notified' => '1',
                        'comments' => 'cancel by cashier',
                    ]);
                $orders_products = DB::table('orders_products')->where('orders_id', '=', $request->order_id)->get();
                 foreach ($orders_products as $products_data) {
                    $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
                        $date_added = date('Y-m-d h:i:s');
                        $inventory_ref_id = DB::table('inventory')->insertGetId([
                            'products_id' => $products_data->products_id,
                            'stock' => $products_data->total_quantity,
                            'reference_code' => $products_data->orders_id,
                            'admin_id' => $cashier->id,
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
                    $order_user= DB::table('orders')->where('orders_id', '=', $request->order_id)->first();
                    $outpoint = DB::table('transaction_points')->where('user_id', '=', $order_user->customers_id)->where('points_status', '=', 'out')->where('order_id', '=', $request->order_id)->get();
                   if(!empty($outpoint)){
                    foreach ($outpoint as $jesoutpoint) {
                        $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
                        $oldbalnce=$cdata->loyalty_points;
                        $newbalnce=$oldbalnce+$jesoutpoint->points;

                        //insert point details
                        DB::table('transaction_points')->insert([
                            'user_id' => $order_user->customers_id,
                            'order_id'=> $request->order_id,
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
                //orders update
                $orders_update = DB::table('orders')->where('orders_id',$request->order_id)->update(['order_status_id' =>'3']);
              $responseData = array('success'=>'1','message'=>"Bill cancelled successfully.");
            }else{
              $responseData = array('success'=>'0','message'=>"Invalid order id.");  
            }   
           
            }else{
                $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
            }
           }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function openDrawer($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
         if($authenticate==1){
            if($request->api_token == '' || $request->amount == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{ 
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
             if($cashier){
                $check = DB::table('drawer')->where('shift_opened_by', $cashier->id)->where('status','open')->first();
                if($check){
                    $responseData = array('success'=>'0','message'=>"Drawer already opened.");
                }else{
                    $round = DB::table('drawer')
                    ->where('shift_opened_by', '=',$cashier->id)
                    ->where('status', '=', 'close')
                    ->whereDate('created_at', '=', DB::raw('curdate()'))->get();
                    $count = count($round);
                    if($count=='0'){
                        $insert='1';
                    }else{
                        $insert=$count+1;
                    }
                        $date_added = date('Y-m-d h:i:s');
                        //insert point details
                        DB::table('drawer')->insert([
                            'round' => $insert,
                            'shift_opened'=>$date_added,
                            'shift_opened_by' => $cashier->id,
                            'start_cash_drawer' => $request->amount,
                            'expected_in_drawer' => $request->amount,
                            'status'=>'open',
                            'created_at' => $date_added,
                            'updated_at' => $date_added
                        ]);
                    $responseData = array('success'=>'1','message'=>"Drawer opened successfully.");
                }
             }else{
               $responseData = array('success'=>'0','message'=>"Invalid cashier id."); 
             }
           } 
         }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
         }
         $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function viewDrawer($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{ 
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
                if($cashier){
                    $result = DB::table('drawer')
                    ->where('shift_opened_by', '=',$cashier->id)
                    ->where('status', '=', 'open')
                    ->first();
                    if($result){

                      // get wallet payment total
                        $total_sale=DB::table('orders')
                            ->where(['cashier_id' => $cashier->id,'drawer_status'=>'0'])->where('order_status_id', '!=', '3')->sum('order_price');
                     // get paid in history
                        $paidin= DB::table('paid_in_out')->where('type', '=','income')->where('drawer_id', '=', $result->id)->get();
                     // get paid out history
                        $paidout= DB::table('paid_in_out')->where('type', '=','expanse')->where('drawer_id', '=', $result->id)->get();

                        $sdata=[
                            'id'=>$result->id,
                            'round'=>$result->round,
                            'shift_opened'=>$result->shift_opened,
                            'shift_opened_by' => $result->shift_opened_by,
                            'shift_closed' => $result->shift_closed,
                            'shift_closed_by'=> $result->shift_closed_by,
                            'total_sale'=> $total_sale, 
                            'start_cash_drawer'=>$result->start_cash_drawer,
                            'total_paid_in'=>$result->total_paid_in,
                            'total_paid_out'=>$result->total_paid_out,
                            'actual_in_drawer'=>$result->actual_in_drawer,
                            'expected_in_drawer'=>$result->expected_in_drawer,
                            'difference'=>$result->difference
                        ];

                        $payment = $authController->getPaymentByAmount($cashier->id);

                        $responseData = array('success'=>'1','data'=>$sdata,'payment'=>$payment,'paid_in_list'=>$paidin,'paid_out_list'=>$paidout,'message'=>"Drawer opened");
                    }else{
                        $responseData = array('success'=>'0','message'=>"Drawer closed"); 
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cashier id.");  
                }
           }
        }else{
          $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function closeDrawer($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->amount == '' || $request->drawer_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{ 
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
              if($cashier){
                 $result = DB::table('drawer')->where('id', '=',$request->drawer_id)->first();
                 if($result){
                         $date_added = date('Y-m-d h:i:s');
                            // total sale
                            $total_sale=DB::table('orders')
                            ->where(['cashier_id' => $cashier->id,'drawer_status'=>'0'])->sum('order_price');
                            //cash sale
                            $cash_sale=DB::table('orders')
                            ->where(['cashier_id' => $cashier->id,'drawer_status'=>'0','payment_method'=>'Cash on Pos'])->sum('order_price');
                            //total paidIn 
                            $paidin=DB::table('paid_in_out')
                            ->where(['type' => 'income','drawer_id'=>$request->drawer_id,'cashier_id'=>$cashier->id])->sum('amount');
                            //total paidOut
                            $paidout=DB::table('paid_in_out')
                            ->where(['type' => 'expanse','drawer_id'=>$request->drawer_id,'cashier_id'=>$cashier->id])->sum('amount');
                        $expected=($result->start_cash_drawer+$cash_sale+$paidin)-$paidout;
                        $difference = $request->amount-$expected;
                     
                    DB::table('drawer')->where('id', '=',$request->drawer_id)->update(
                        [
                            'shift_closed' => $date_added,
                            'shift_closed_by' => $cashier->id,
                            'total_sale' => $total_sale,
                            'actual_in_drawer' => $request->amount,
                            'expected_in_drawer'=> $expected,
                            'status' => 'close',
                            'difference'=>$difference,
                            'updated_at' => $date_added,
                      ]);
                    // update settlement status order table
                    $getdata=DB::table('orders')
                        ->where(['cashier_id' => $cashier->id,'drawer_status'=>'0'])
                        ->get();
                    if(!empty($getdata)){
                        foreach ($getdata as $jesgetdata) {
                            // update user table
                            DB::table('orders')->where('orders_id', $jesgetdata->orders_id)->update([
                                'drawer_status' => '1',
                                'drawer_id' => $request->drawer_id
                            ]);    
                        }
                    }
                    $responseData = array('success'=>'1','message'=>"Drawer closed successfully.");
                 }else{
                   $responseData = array('success'=>'0','message'=>"Invalid drawer id."); 
                 }
              }else{
                $responseData = array('success'=>'0','message'=>"Invalid cashier id.");
              }  
           }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }

        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function drawerHistory($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->date == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{ 
             $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
             if($cashier){
                $months = DB::table('drawer')
                ->where(['shift_opened_by' => $cashier->id,'status'=>'close'])
                ->whereDate('shift_closed', '=', $request->date)
                ->select(DB::raw('DATE(shift_closed) as date'))
                ->groupBy('date')->get();
                //print_r($months);die();
                if (!$months->isEmpty()) { 
                
                    foreach ($months as $jesmonths) {

                        $getdata=$authController->getDrawerHistory($cashier->id,$jesmonths->date);
                        $dataall[]=array(
                            'date'=>$jesmonths->date,
                            'result' => $getdata
                        );
                    }
    
                    $responseData = array('success'=>'1', 'data'=>$dataall,'message'=>"View all drawer history");
                }else{
                   $responseData = array('success'=>'0','message'=>"No data found."); 
                }
             }else{
               $responseData = array('success'=>'0','message'=>"Invalid cashier id."); 
             }   
           } 
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }
    public static function getPosPayment($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->language_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{ 

             $getdata=DB::table('pos_payment_methods as m')
             ->LeftJoin('pos_payment_description as d', 'd.payment_methods_id', '=', 'm.payment_methods_id')
             ->LeftJoin('image_categories as i', 'i.image_id', '=', 'm.image')
             ->LeftJoin('image_categories as ic', 'ic.image_id', '=', 'm.icon')
             ->select('m.payment_methods_id', 'd.name','i.path as image','m.status','i.path_type','ic.path as icon','m.payment_method')
             //->where('m.status', '=', '1')
             ->where('d.language_id', '=', $request->language_id)
             ->where('i.image_type', '=', 'ACTUAL')
             ->orderBy('m.payment_methods_id', 'asc')
             ->groupBy('d.payment_methods_id')
             ->get();

             if (!$getdata->isEmpty()) {
                $responseData = array('success'=>'1', 'data'=> $getdata, 'message'=>"View all payments.");
             }else{
                $responseData = array('success'=>'0','message'=>"No data found.");
             }
        }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function viewPosCoupon($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $currentDate = date('Y-m-d');
              $items=DB::table('coupons')
            ->leftJoin('image_categories', 'coupons.image', '=', 'image_categories.image_id')
             ->select('coupons.*', 'image_categories.path_type as image_path_type','image_categories.path as image_path')
             ->whereIn('coupons.discount_type', ['percent', 'fixed_cart'])
             ->where('coupons.coupans_type', 'external')
             ->whereDate('expiry_date','>=',$currentDate)
             ->groupBy('coupons.coupans_id')
             ->get();
            if (!$items->isEmpty()) {
                $responseData = array('success'=>'1', 'data'=>$items, 'message'=>"View all coupon.");
            }else{
                $responseData = array('success'=>'0','message'=>"No data found.");
            } 
        }else{
         $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function viewshopsetting($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
                if($cashier){
                    // $settings = DB::table('settings')
                    // ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'settings.value')
                    // ->select('settings.*', 'categoryTable.path')
                    // ->orderBy('id')->get();
                    //  $result['settings'] = $settings->unique('id')->keyBy('id');

                    $settings = DB::table('settings')->whereIn('id', [80,16,112,113,12,5,6,7,8,9,10,11])->get();

                    if (!$settings->isEmpty()) {
                        $responseData = array('success'=>'1', 'data'=>$settings, 'message'=>"Return all data.");
                    }else{
                         $responseData = array('success'=>'0', 'message'=>"No data found.");
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid api token."); 
                } 
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function updateshopsetting($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->id == '' || $request->value == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
               if($cashier){
                    $idarray=array(); $idarray=explode(",",$request->id);
                    $valuearray=array();$valuearray=explode(",",$request->value);
                    if(!empty($idarray)){
                        foreach($idarray as $key=>$updateid){
                            $updateSetting = DB::table('settings')->where('id', '=', $updateid)->update([
                                'value' => $valuearray[$key],
                                'updated_at' => date('Y-m-d h:i:s'),
                            ]);
                        }
                    }
                  $responseData = array('success'=>'1','message'=>"Shop setting updated successfully.");  
               }else{
                $responseData = array('success'=>'0','message'=>"Invalid api token.");
               } 
            } 
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function viewposlanguages($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $languages = DB::table('languages')->where('status', '1')->get();
            if (!$languages->isEmpty()) { 
                 $responseData = array('success'=>'1', 'data'=>$languages, 'message'=>"Return all data."); 
            }else{
                $responseData = array('success'=>'0', 'message'=>"No data found."); 
            }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function salesreport($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
                if($cashier){
                    $report = DB::table('orders')
                    ->where('cashier_id', $cashier->id)
                    ->where('order_status_id', '!=', '3')
                    ->selectRaw("date_purchased,orders_id,order_price");
                    if (isset($request->dateRange)) {
                        $range = explode('-', $request->dateRange);
            
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);
            
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                    }elseif(isset($request->date)){

                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($request->date));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($request->date));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);

                    }else{
                        $report->whereRaw("date_purchased between (CURDATE() - INTERVAL (select count(orders_id) from orders) DAY)
                        and (CURDATE() - INTERVAL 1 DAY)");
                    }
                    $orders = $report->get();
       
                    if (!$orders->isEmpty()) { 
                      $responseData = array('success'=>'1','data'=>$orders,'message'=>"Return sales data");
                    }else{
                      $responseData = array('success'=>'0', 'message'=>"No data found.");   
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cashier api token.");  
                }
            }
            }else{
                 $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
            }
            $mediaResponse = json_encode($responseData);
            return $mediaResponse;
    }
    public static function productwisesalesreport($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->product_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                        $report = DB::table('orders')
                        ->LeftJoin('orders_products', 'orders_products.orders_id', '=', 'orders.orders_id')
                        ->where('orders.order_status_id', '!=', '3') 
                        ->select('orders_products.*','orders.date_purchased');
                    if(isset($request->dateRange)){

                        $range = explode('-', $request->dateRange);

                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);

                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($request->date));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($request->date));
                        $report->where('orders_products.products_id',$request->product_id);
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);

                    }elseif (isset($request->date)) {
                        $report->where('orders_products.products_id',$request->product_id);
                        $report->whereDate('orders.date_purchased',$request->date);
                    }else{
                        $report->where('orders_products.products_id',$request->product_id);
                    }

                    $orders = $report->get();
                    if (!$orders->isEmpty()) { 
                      $responseData = array('success'=>'1','data'=>$orders,'message'=>"Return sales data");
                    }else{
                      $responseData = array('success'=>'0', 'message'=>"No data found.");   
                    }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function posunseenOrders($request)
    {
        $language_id                          =  $request->language_id;
        $requested_currency       =  $request->currency_code;
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
                if($cashier){
                    $order = DB::table('orders')
                ->where('orders.is_seen','=', 0)
                ->where('orders.cashier_id','=', $cashier->id)
                ->orderBy('orders_id','desc')
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

        $orders_id   = $data->orders_id;

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
                    $responseData = array('success'=>'0','message'=>"Invalid cashier api token.");
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function updateposunseenOrders($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->orders_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $order = DB::table('orders')->where('orders_id', $request->orders_id)->where('is_seen','0')->first();
               if($order){
                     DB::table('orders')->where('orders_id', '=', $request->orders_id)
                    ->where('customers_id', '!=', '')->update(['is_seen' => 1]);

                  $responseData = array('success'=>'1','message'=>"Read status updated successfully..");  
               }else{
                 $responseData = array('success'=>'0', 'message'=>"Invalid order id.");
               }
            } 
        }else{
          $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function updatePosPaymentstatus($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->payment_methods_id == '' || $request->status == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $payment = DB::table('pos_payment_methods')->where('payment_methods_id', $request->payment_methods_id)->first();
                if($payment){
                    DB::table('pos_payment_methods')->where('payment_methods_id', '=', $request->payment_methods_id)
                    ->update(['status' => $request->status]);

                    $responseData = array('success'=>'1','message'=>"Pos payment status updated successfully..");
                }else{
                  $responseData = array('success'=>'0', 'message'=>"Invalid payment methods id.");  
                } 
            }
        }else{
          $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function updatedrawerstatus($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->name == '' || $request->status == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $setting = DB::table('settings')->where('name', $request->name)->first();
               if($setting){
                     DB::table('settings')->where('name', '=', $request->name)
                    ->update(['value' => $request->status]);
                    $responseData = array('success'=>'1','message'=>"Drawer status updated successfully..");
               }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid settings name.");
               } 
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function posadminrole($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
               if($cashier){
                    $role = DB::table('manage_role')->where('user_types_id', $cashier->role_id)->first();
                    if($role){
                        $responseData = array('success'=>'1','data'=>$role,'message'=>"Return all admin role");
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"No data found."); 
                    }
               }else{
                 $responseData = array('success'=>'0', 'message'=>"Invalid cashier id.");
               } 
            }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function dashboardreport($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $settings = $authController->getSetting();
        $open_time = $settings['shop_open'];
        $cktime=$settings['order_open_time'];

        if($authenticate==1){
             $saleData = array();
             $total_amount=0;
             $total_tips=0;
             $date = time();
             $reportBase = $request->reportBase;
             if ($reportBase == 'this_month') {
            

            $dateLimit = date('d', $date);

            //for current month
            for ($j = 1; $j <= $dateLimit; $j++) {


                if($open_time=='1'){
                    $dateFrom = date('Y-m-' . $j . ' 00:00:00', time());
                    $dateTo = date('Y-m-' . $j . ' 23:59:59', time());  
                }else{
                    if($cktime === NULL){
                        $dateFrom = date('Y-m-' . $j . ' 00:00:00', time());
                        $dateTo = date('Y-m-' . $j . ' 23:59:59', time());   
                    }else{
                        $newtime=explode(" - ",$cktime);
                        $start_time=$newtime[0];
                        $end_time=$newtime[1];

                        if($start_time > $end_time){
                             $dateFrom = date('Y-m-' . $j .' '.$start_time.':00', time());
                             $tomorrow = date('Y-m-' . $j);
                             $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                             $dateTo = $ntom.' '.$end_time.':59';
                        }else{
                            $dateFrom = date('Y-m-' . $j .' '.$start_time.':00', time());
                            $dateTo = date('Y-m-' . $j .' '.$end_time.':59', time());
                        }
                    }
                }

                //print_r($dateTo);die();
                
                $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 
                $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count();

                $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');

                $total_tips=$total_tips+$tips;
                $total_amount=$total_amount+$purchases;

                $customers = DB::table('users')
                    ->whereBetween('created_at', [$dateFrom, $dateTo])
                    ->count(); 
                $saleData[$j - 1]['date'] =  date('d M', strtotime($dateFrom)); 
                $saleData[$j - 1]['totalSale'] = $totalSale;
                $saleData[$j - 1]['productQuantity'] = $producQuantity;
                $saleData[$j - 1]['customers'] = $customers;
            }

        } 
        else if ($reportBase == 'last_month') {
            $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
            $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

            $dateLimit = date('d', strtotime($datePrevEnd));

            //for last month
            for ($j = 1; $j <= $dateLimit; $j++) {

                $dateFrom = date('Y-m-' . $j . ' 00:00:00', strtotime($datePrevStart));
                $dateTo = date('Y-m-' . $j . ' 23:59:59', strtotime($datePrevEnd));

                $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 
                $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 

                $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');


                $total_tips=$total_tips+$tips;    
                $total_amount=$total_amount+$purchases;
                
                //website orders

                $customers = DB::table('users')
                    ->whereBetween('created_at', [$dateFrom, $dateTo])
                    ->count(); 
                $saleData[$j - 1]['date'] = date('h a', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;
                $saleData[$j - 1]['productQuantity'] = $producQuantity;
                $saleData[$j - 1]['customers'] = $customers;
            }

        } 
        else if ($reportBase == 'last_year') {

            $dateLimit = date("Y");

            //print_r($dateLimit);die();

            $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
            $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

            //for last year
            for ($j = 1; $j <= 12; $j++) {
                $dateFrom = date($dateLimit . '-' . $j . '-1 00:00:00', strtotime($datePrevStart));
                $dateTo = date($dateLimit . '-' . $j . '-31 23:59:59', strtotime($datePrevEnd));

                if($open_time=='1'){
                    $dateFrom = date($dateLimit . '-' . $j . '-1 00:00:00', strtotime($datePrevStart));
                    $dateTo = date($dateLimit . '-' . $j . '-31 23:59:59', strtotime($datePrevEnd));  
                }else{
                    if($cktime === NULL){
                        $dateFrom = date($dateLimit . '-' . $j . '-1 00:00:00', strtotime($datePrevStart));
                        $dateTo = date($dateLimit . '-' . $j . '-31 23:59:59', strtotime($datePrevEnd));  
                    }else{
                        $newtime=explode(" - ",$cktime);
                        $start_time=$newtime[0];
                        $end_time=$newtime[1];

                        if($start_time > $end_time){
                             $dateFrom = date($dateLimit . '-' . $j . '-1 '.$start_time.':00', strtotime($datePrevStart));
                             $tomorrow = date($dateLimit . '-' . $j . '-31');
                             $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                             $dateTo = $ntom.' '.$end_time.':59';
                        }else{
                            $dateFrom = date($dateLimit . '-' . $j . '-1 '.$start_time.':00', strtotime($datePrevStart));
                            $dateTo = date($dateLimit . '-' . $j . '-31 '.$end_time.':59', strtotime($datePrevEnd));
                        }
                    }
                }

                //print_r($dateFrom);die();

                //sold products
                $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('order_status_id', '!=', '3')
                    ->where('ordered_source', 0)
                    ->count(); 
                $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('order_status_id', '!=', '3')
                    ->where('ordered_source', 0)
                    ->count(); 

                $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');

                $total_tips=$total_tips+$tips;    
                $total_amount=$total_amount+$purchases;

                $customers = DB::table('users')
                    ->whereBetween('created_at', [$dateFrom, $dateTo])
                    ->count(); 
                $saleData[$j - 1]['date'] = date('M Y', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;
                $saleData[$j - 1]['productQuantity'] = $producQuantity;
                $saleData[$j - 1]['customers'] = $customers;
            }
        } 
        else {
            $reportBase = str_replace('dateRange', '', $reportBase);
            $reportBase = str_replace('=', '', $reportBase);
            $reportBase = str_replace('-', '/', $reportBase);

            $dateFrom = substr($reportBase, 0, 10);
            $dateTo = substr($reportBase, 11, 21);



            $diff = abs(strtotime($dateFrom) - strtotime($dateTo));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $totalDays = floor($diff / (60 * 60 * 24));
            //    print ('day: '.$days.' months: '.$months.' years: '.$years.'<br>');
            $totalMonths = floor($diff / 60 / 60 / 24 / 30);

            if ($diff == 0 && $days == 0 && $years == 0 && $months == 0) {
                //print 'asdsad';

                $dateLimitFrom = date('G', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selecteddate = date('m', strtotime($dateFrom));
                $selecteddate = date('Y', strtotime($dateFrom));

                if($open_time=='1'){
                    $starttime = 1;
                    $endtime = 24; 
                }else{
                    if($cktime === NULL){
                        $starttime = 1;
                        $endtime = 24;    
                    }else{
                        $newtime=explode(" - ",$cktime);
                        $start_time=$newtime[0];
                        $end_time=$newtime[1];

                        $new_start_time=explode(":",$newtime[0]);
                        $new_end_time=explode(":",$newtime[1]);
                        
                        $starttime = $new_start_time[0];
                        $endtime = $new_end_time[0];

                        //print_r($starttime);die();
                    }
                }

                //print_r($endtime);die();

                if($starttime > $endtime){
                     $startTime = strtotime('today '.$starttime.':00');
                     $endTime = strtotime('tomorrow '.$endtime.':00');
                     $i=1;
                     for ($j = $startTime; $j <= $endTime; $j += 3600) {
                        $dateFrom = date('Y-m-d H:00:00', $j);
                        $dateTo =  date('Y-m-d H:59:59', $j); 

                        //sold products
                        $totalSale = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->where('ordered_source', 0)
                        ->where('order_status_id', '!=', '3')
                        ->count(); 
                        
                        $producQuantity = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->where('ordered_source', 0)
                        ->where('order_status_id', '!=', '3')
                        ->count();

                         $purchases = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->where('ordered_source', 0)
                        ->where('order_status_id', '!=', '3')
                        ->sum('order_price');

                        $tips = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->where('ordered_source', 0)
                        ->where('order_status_id', '!=', '3')
                        ->sum('pos_tips_amount');


                        $total_tips=$total_tips+$tips;
                        $total_amount=$total_amount+$purchases;

                        $customers = DB::table('users')
                            ->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->count(); 
                        $saleData[$i - 1]['date'] = date('h a', strtotime($dateFrom));
                        $saleData[$i - 1]['totalSale'] = $totalSale;
                        $saleData[$i - 1]['productQuantity'] = $producQuantity;
                        $saleData[$i - 1]['customers'] = $customers;
                        //print $dateLimitFrom.'<br>';
                        $i++;
                    }
                }else{
                //for current month
                for ($j = $starttime; $j <= $endtime; $j++) {

                    

                    $dateFrom = date('Y-m-d' . ' ' . $j . ':00:00', strtotime($dateFrom));
                    $dateTo = date('Y-m-d' . ' ' . $j . ':59:59', strtotime($dateFrom));

                    //sold products
                    $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 
                    $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count();

                     $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                    $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');


                    $total_tips=$total_tips+$tips;
                    $total_amount=$total_amount+$purchases;

                    $customers = DB::table('users')
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                        ->count(); 
                    $saleData[$j - $starttime]['date'] = date('h a', strtotime($dateFrom));
                    $saleData[$j - $starttime]['totalSale'] = $totalSale;
                    $saleData[$j - $starttime]['productQuantity'] = $producQuantity;
                    $saleData[$j - $starttime]['customers'] = $customers;
                    //print $dateLimitFrom.'<br>';

                }
            }

            } 
            else if ($days > 1 && $years == 0 && $months == 0) {

                //print 'daily';
                

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selectedMonth = date('m', strtotime($dateFrom));
                $selectedYear = date('Y', strtotime($dateFrom));
                //print $selectedYear;

                //for current month
                for ($j = 1; $j <= $totalDays; $j++) {

                    //print 'dateFrom: '.date('Y-m-'.$j.' 00:00:00', time()).'dateTo: '.date('Y-m-'.$j.' 23:59:59', time());
                    //print '<br>';

                     if($open_time=='1'){
                        $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom . ' 00:00:00');
                        $dateTo     = date('Y-m-'.$dateLimitFrom.' 23:59:59', time());  
                    }else{
                        if($cktime === NULL){
                            $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom . ' 00:00:00');
                            $dateTo     = date('Y-m-'.$dateLimitFrom.' 23:59:59', time());  
                        }else{
                            $newtime=explode(" - ",$cktime);
                            $start_time=$newtime[0];
                            $end_time=$newtime[1];

                            if($start_time > $end_time){
                                 $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom . ' '.$start_time.':00');
                                 $tomorrow = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom);
                                 $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                 $dateTo = $ntom.' '.$end_time.':59';
                            }else{

                                $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom . ' '.$start_time.':00');
                                $dateTo     = date('Y-m-'.$dateLimitFrom.' '.$end_time.':59', time());
                            }
                        }
                }


                    //$dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom . ' 00:00:00');
                    //$dateTo     = date('Y-m-'.$dateLimitFrom.' 23:59:59', time());
                    //print $dateFrom .'<br>';
                    $lastday = date('t', strtotime($dateFrom));
                    //print_r($dateTo);die();
                    //print 'lastday: '.$lastday .' <br>';

                     //$newDate = date("Y-m-d", strtotime($dateTo));
                     //print_r($dateFrom);die();
                     
                    //sold products
                    $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('order_status_id', '!=', '3')
                    ->where('ordered_source', 0)
                    ->count();

                    $producQuantity = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->where('ordered_source', 0)
                        ->where('order_status_id', '!=', '3')
                        ->count(); 

                    $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                    $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');


                    $total_tips=$total_tips+$tips;
                    $total_amount=$total_amount+$purchases;

                    $customers = DB::table('users')
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                        ->count(); 
                    $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                    $saleData[$j - 1]['totalSale'] = $totalSale;                    
                    $saleData[$j - 1]['productQuantity'] = $producQuantity;
                    $saleData[$j - 1]['customers'] = $customers;
                    
                    //print $dateLimitFrom.'<br>';
                    if ($dateLimitFrom == $lastday) {
                        $dateLimitFrom = '1';
                        $selectedMonth++;

                    } else {
                        $dateLimitFrom++;
                    }

                    if ($selectedMonth > 12) {
                        $selectedMonth = '1';
                        $selectedYear++;
                    }
                }
            } 
            else if ($months >= 1 && $years == 0) {

                //for check if date range enter into another month
                if ($days > 0) {
                    $months += 1;
                }

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selectedMonth = date('m', strtotime($dateFrom));
                $selectedYear = date('Y', strtotime($dateFrom));
                //print $selectedMonth;

                $i = 0;
                //for current month
                for ($j = 1; $j <= $months; $j++) {
                    if ($j == $months) {
                        $lastday = $dateLimitTo;
                    } else {
                        $lastday = date('t', strtotime($dateLimitFrom . '-' . $selectedMonth . '-' . $selectedYear));
                    }

                    $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom, strtotime($dateFrom));
                    $dateTo = date($selectedYear . '-' . $selectedMonth . '-' . $lastday, strtotime($dateTo));
                    //print $dateFrom.' '.$dateTo.'<br>';

                    //sold products
                    $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 
                    $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->count(); 

                    $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                    $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');


                    $total_tips=$total_tips+$tips;
                    $total_amount=$total_amount+$purchases;

                    $customers = DB::table('users')
                    ->whereBetween('created_at', [$dateFrom, $dateTo])
                    ->count(); 

                    $saleData[$i]['date'] = date('M Y', strtotime($dateFrom));
                    $saleData[$i]['totalSale'] = $totalSale;
                    $saleData[$i]['productQuantity'] = $producQuantity;
                    $saleData[$i]['customers'] = $customers;
                    
                    $selectedMonth++;
                    if ($selectedMonth > 12) {
                        $selectedMonth = '1';
                        $selectedYear++;
                    }
                    $i++;
                }

            } 
            else if ($years >= 1) {

                //print $years.'sadsa';
                if ($months > 0) {
                    $years += 1;
                }

                //print $years;

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));

                $selectedMonthFrom = date('m', strtotime($dateFrom));
                $selectedMonthTo = date('m', strtotime($dateTo));

                $selectedYearFrom = date('Y', strtotime($dateFrom));
                $selectedYearTo = date('Y', strtotime($dateTo));
                //print $selectedYearFrom.' '.$selectedYearTo;

                $i = 0;
                //for current month
                for ($j = $selectedYearFrom; $j <= $selectedYearTo; $j++) {

                    if ($j == $selectedYearTo) {
                        $selectedYearTo = $selectedYearTo;
                        $dateLimitTo = $dateLimitTo;
                    } else {
                        $selectedMonthTo = 12;
                        $dateLimitTo = 31;
                    }

                    if ($selectedYearFrom == $j) {
                        $selectedMonthFrom = $selectedMonthFrom;
                    } else {
                        $selectedMonthFrom = 1;
                    }

                    //    print $j.'-'.$selectedMonthFrom.'-'.$dateLimitFrom.'<br>';
                    //print $j.'-'.$selectedMonthTo.'-'.$dateLimitTo.'<br>';
                    //$lastday  =  date('t',strtotime($dateLimitFrom.'-'.$selectedMonth.'-'.$selectedYear));

                    $dateFrom = date($j . '-' . $selectedMonthFrom . '-' . $dateLimitFrom, strtotime($dateFrom));
                    $dateTo = date($j . '-' . $selectedMonthTo . '-' . $dateLimitTo, strtotime($dateTo));
                    //    print $dateFrom.' '.$dateTo.'<br>';
                    //print $dateFrom.'<br>';

                    //sold products
                    $totalSale = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('order_status_id', '!=', '3')
                    ->where('ordered_source', 0)
                    ->count(); 
                $producQuantity = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('order_status_id', '!=', '3')
                    ->where('ordered_source', 0)
                    ->count();

                $purchases = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('order_price');

                $tips = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where('ordered_source', 0)
                    ->where('order_status_id', '!=', '3')
                    ->sum('pos_tips_amount');

                        
                    $total_tips=$total_tips+$tips;
                    $total_amount=$total_amount+$purchases;
                    
                $customers = DB::table('users')
                    ->whereBetween('created_at', [$dateFrom, $dateTo])
                    ->count(); 

                    $saleData[$i]['date'] = date('Y', strtotime($dateFrom));
                    $saleData[$i]['totalSale'] = $totalSale;
                    $saleData[$i]['productQuantity'] = $producQuantity;
                    $saleData[$i]['customers'] = $customers;
                    $i++;
                }

            }
        }

            if($open_time=='1'){
                $startTime = '00:00';
                $endTime   = '23:59';  
            }else{
                if($cktime === NULL){
                    $startTime = '00:00';
                    $endTime   = '23:59';  
                }else{
                    $newtime=explode(" - ",$cktime);
                    $startTime=$newtime[0];
                    $endTime=$newtime[1];
                }
            }
         $getpayment = $authController->getPaymentByDashboard($reportBase,$startTime,$endTime);
         $responseData = array('success'=>'1','data'=>$saleData, 'amount'=>$total_amount,'tips'=>$total_tips,'payment'=>$getpayment,'message'=>"Return all report");
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function addhold($request){
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->session_id == '' || $request->note == '' ||  $request->customer_id == '' || $request->pos_order_type == '' || $request->table_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
               if($cashier){
                $hold=DB::table('customers_basket')->where('session_id', $request->session_id)->where('hold_status', '0')->get();
                    if (!$hold->isEmpty()) {
                        $total=0;
                        $holddata=DB::table('hold')->where(['session_id'=>$request->session_id,'hold_status'=>'0'])->first();
                        if($holddata){
                            //update hold
                            $hold_id=$holddata->id;
                             DB::table('hold')->where('id', $holddata->id)->update([
                                    'note' => $request->note,
                                    'hold_by' => $cashier->id,
                                    'hold_status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'table_id' => $request->table_id,
                                    'table_name' => $request->table_name,
                                    'customer_id'=> $request->customer_id,
                                    'session_id' => $request->session_id,
                                    'pos_order_type' => $request->pos_order_type,
                                ]);
                        }else{
                            //insert hold
                             $hold_id = DB::table('hold')->insertGetId(
                                [
                                    'note' => $request->note,
                                    'hold_by' => $cashier->id,
                                    'hold_status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'table_id' => $request->table_id,
                                    'table_name' => $request->table_name,
                                    'customer_id'=> $request->customer_id,
                                    'session_id' => $request->session_id,
                                    'pos_order_type' => $request->pos_order_type,
                                ]);
                        }
                        foreach ($hold as $jeshold) {
                           // update customers_basket table
                            $total = $total+($jeshold->customers_basket_quantity * $jeshold->final_price);
                            DB::table('customers_basket')->where('customers_basket_id', $jeshold->customers_basket_id)->update([
                                'hold_status' => '1',
                                'hold_id' => $hold_id,
                                'is_order' => '1',
                                'customers_id' => $request->customer_id,
                            ]);
                        }
                        //update total amount
                         DB::table('hold')->where('id', $hold_id)->update([
                                'total_amount' => $total,
                            ]);
                        $responseData = array('success'=>'1', 'message'=>"Hold added successfully.");
                    }else{
                         $holddata=DB::table('hold')->where(['session_id'=>$request->session_id,'hold_status'=>'0'])->first();
                         if($holddata){
                            //update hold
                            $hold_id=$holddata->id;
                             DB::table('hold')->where('id', $holddata->id)->update([
                                    'note' => $request->note,
                                    'hold_by' => $cashier->id,
                                    'hold_status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'table_id' => $request->table_id,
                                    'table_name' => $request->table_name,
                                    'customer_id'=> $request->customer_id,
                                    'session_id' => $request->session_id,
                                    'pos_order_type' => $request->pos_order_type,
                                ]);
                         }else{
                            //insert hold
                             $hold_id = DB::table('hold')->insertGetId(
                                [
                                    'note' => $request->note,
                                    'hold_by' => $cashier->id,
                                    'hold_status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'table_id' => $request->table_id,
                                    'table_name' => $request->table_name,
                                    'customer_id'=> $request->customer_id,
                                    'session_id' => $request->session_id,
                                    'pos_order_type' => $request->pos_order_type,
                                ]);
                         }
                      //$responseData = array('success'=>'0', 'message'=>"No data found.");
                      $responseData = array('success'=>'1', 'message'=>"Hold added successfully.");
                    }
               }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid cashier id.");
               }  
            } 
        }else{
          $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function viewhold($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
              if($cashier){
                    $hold = DB::table('hold')
                    ->join('users', 'users.id', '=', 'hold.hold_by')
                    ->select('hold.*','users.first_name', 'users.last_name')
                    //->where('hold.hold_by', '=', $cashier->id)
                    ->where('hold.pos_order_type', '=', 'normal')
                    ->where('hold.hold_status', '=', '1')
                    ->orderBy('id', 'DESC')
                    ->get();
                     if (!$hold->isEmpty()) { 
                        $responseData = array('success'=>'1', 'data'=>$hold, 'message'=>"Return all data.");
                     }else{
                        $responseData = array('success'=>'0', 'message'=>"No data found..");
                     }
              }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
              }  
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function viewholddetails($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $getsetting=$authController->getSetting();
            if($request->api_token == '' || $request->hold_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
               if($cashier){
                    //$hold = DB::table('hold')->where('id', $request->hold_id)->where('hold_by', $cashier->id)->first();
                    $hold = DB::table('hold')->where('id', $request->hold_id)->first();
                    if($hold){
                        $language_id='1';
                        $cart = DB::table('customers_basket')
                    ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
                    ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
                    ->LeftJoin('image_categories', function ($join) {
                        $join->on('image_categories.image_id', '=', 'products.products_image')
                            ->where(function ($query) {
                                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                            });
                    })
                    ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                        'products_description.products_name as products_name', 'products.products_quantity as quantity',
                        'products.products_price as price', 'products.products_weight as weight',
                        'products.products_weight_unit as unit','products.product_serve')
                    ->where('customers_basket.is_order', '=', '1')
                    ->where('customers_basket.is_order', '=', '1')
                    ->where('products_description.language_id', '=', $language_id);

                        $cart->where('customers_basket.hold_id', '=',$request->hold_id);
                        $baskit = $cart->get();
                        $result = array();
                        if (!$baskit->isEmpty()){
                            foreach ($baskit as $baskit_data) {
                                //products_image
                                $default_images = DB::table('image_categories')
                                    ->where('image_id', '=', $baskit_data->products_image)
                                    ->where('image_type', 'THUMBNAIL')
                                    ->first();

                                if ($default_images) {
                                    $baskit_data->image = $default_images->path;
                                } else {
                                    $default_images = DB::table('image_categories')
                                        ->where('image_id', '=', $baskit_data->products_image)
                                        ->where('image_type', 'MEDIUM')
                                        ->first();

                                    if ($default_images) {
                                        $baskit_data->image = $default_images->path;
                                    } else {
                                        $default_images = DB::table('image_categories')
                                            ->where('image_id', '=', $baskit_data->products_image)
                                            ->where('image_type', 'ACTUAL')
                                            ->first();
                                        $baskit_data->image = $default_images->path;
                                    }

                                }

                                 $attributes = DB::table('customers_basket_attributes')
                                   ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                                   ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                                   ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                                   ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                                   ->leftjoin('products_attributes', function ($join) {
                                       $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                                   })
                                   ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                                   ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                                   ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                                   ->where('products_options_descriptions.language_id', '=',  $language_id)
                                   ->where('products_options_values_descriptions.language_id', '=',  $language_id)
                                   ->where('customers_basket_attributes.session_id', '=',  $baskit_data->session_id)
                                   ->get();
                                   if (!$attributes->isEmpty()) { 
                                        $baskit_data->attributes = $attributes;
                                   }else{
                                       $baskit_data->attributes = []; 
                                   }

                                array_push($result, $baskit_data);
                            }

                             // get customers details
                        $cusdata=DB::table('customers_basket')->where('is_order', '=', '1')->where('hold_id', '=',$request->hold_id)->first();

                        if($cusdata){
                            $userdata = DB::table('users')->where('id', '=',$cusdata->customers_id)->first();
                            $uaddress=DB::table('address_book')->where('user_id',$cusdata->customers_id)->first();
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

                        $sdata=[
                             "id"=>$userdata->id,
                             "first_name"=>$userdata->first_name,
                             "last_name"=>$userdata->last_name,
                             "gender"=>$userdata->gender,
                             "country_code"=>$userdata->country_code,
                             "phone"=>$userdata->phone,
                             "email"=>$userdata->email,
                             "status"=>$userdata->status,
                             "phone_verified"=>$userdata->phone_verified,
                             "loyalty_points"=>$userdata->loyalty_points,
                             "users_level"=>$userdata->users_level,
                             "dob"=>$userdata->dob,
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
                        ];
                    }else {
                        $sdata=[];
                    }


                           $responseData = array('success'=>'1', 'data'=>$result, 'user'=>$sdata, 'hold'=>$hold,'message'=>"Return all cart data."); 
                        }else{
                            if($hold){
                                $hold_data=$hold;
                            }else{
                                $hold_data=[];  
                            }
                            $responseData = array('success'=>'0','data'=>$hold_data,'message'=>"No data found");
                        }
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"Invalid hold id."); 
                    }
               } else {
                $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
               } 
            }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function holdretrieve($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->hold_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
                if($cashier){
                    //$hold = DB::table('hold')->where('id', $request->hold_id)->where('hold_by', $cashier->id)->first();
                    $hold = DB::table('hold')->where('id', $request->hold_id)->first();
                    if($hold){
                            $hold_name=$hold->note;
                         $holddata=DB::table('customers_basket')->where('hold_id', $request->hold_id)->where('hold_status', '1')->get();
                          // get session id
                        $session = DB::table('customers_basket')->where('hold_id', $request->hold_id)->first();
                         if (!$holddata->isEmpty()) { 
                            foreach ($holddata as  $jesholddata) {
                               // update customers_basket table
                                DB::table('customers_basket')->where('customers_basket_id', $jesholddata->customers_basket_id)->update([
                                    'hold_status' => '0',
                                    'hold_id' => '0',
                                    'is_order' => '0',
                                ]);
                            }
                            // delete hold list
                            // DB::table('hold')->where([
                            //      ['id', '=', $request->hold_id],
                            // ])->delete();

                           // update hold
                             DB::table('hold')->where('id', $request->hold_id)->update([
                                    'hold_status' => '0',
                             ]);

                        //print_r($session);die();
                        $responseData = array('success'=>'1','data'=>$session->session_id,'user_id'=>$session->customers_id,'hold_name'=>$hold_name,'message'=>"Hold retrieve successfully.");
                         }else{
                                 // delete hold list
                                // DB::table('hold')->where([
                                //      ['id', '=', $request->hold_id],
                                // ])->delete();

                                // update hold
                             DB::table('hold')->where('id', $request->hold_id)->update([
                                    'hold_status' => '0',
                             ]);

                             $responseData = array('success'=>'1','data'=>$hold->session_id,'user_id'=>$hold->customer_id,'hold_name'=>$hold_name,'message'=>"Hold retrieve successfully.");
                         }
                    }else{
                        $responseData = array('success'=>'0', 'message'=>"Invalid hold id.");
                    }
                }else{
                  $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
                }
            }  
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;   
    }
    public static function holddelete($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->hold_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                 $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
                 if($cashier){
                    //$hold = DB::table('hold')->where('id', $request->hold_id)->where('hold_by', $cashier->id)->first();
                    $hold = DB::table('hold')->where('id', $request->hold_id)->first();
                    if($hold){
                        // delete hold list
                            DB::table('hold')->where([
                                ['id', '=', $request->hold_id],
                            ])->delete();

                            // delete customers_basket list
                            DB::table('customers_basket')->where([
                                ['hold_id', '=', $request->hold_id],
                            ])->delete();

                            $responseData = array('success'=>'1', 'message'=>"Hold delete successfully.");
                    }else{
                        $responseData = array('success'=>'0', 'message'=>"Invalid hold id.");
                    }
                 }else{
                   $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
                 }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function posGetallproducts($request)
    {
        $language_id = $request->language_id;
        $skip = $request->page_number . '0';
        $currentDate = time();
        $type = $request->type;
  
        //filter
      if(!empty($request->price)){
          $minPrice = $request->price['minPrice'];
          $maxPrices = $request->price['maxPrice'];
  
          $required_currency = DB::table('currencies')->where('is_current',1)->where('code', $request->currency_code)->first();
          $maxPrice = $maxPrices / $required_currency->value;
      }
  
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
  
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        
        $settings = $authController->getSetting();
        $setting = $authController->getSetting();
          $collection_product =$settings['collection_product'];
  
        if ($authenticate == 1) {
  
            if ($type == "a to z") {
                $sortby = "products_name";
                $order = "ASC";
            } elseif ($type == "z to a") {
                $sortby = "products_name";
                $order = "DESC";
            } elseif ($type == "high to low") {
                $sortby = "products_filter_price";
                $order = "DESC";
            } elseif ($type == "low to high") {
                $sortby = "products_filter_price";
                $order = "ASC";
            } elseif ($type == "top seller") {
                $sortby = "products_ordered";
                $order = "DESC";
            } elseif ($type == "most liked") {
                $sortby = "products_liked";
                $order = "DESC";
            }
            
            elseif ($type == "special") {
              if($collection_product == '1')
              {
              $sortby = "collections_product.product_id";
              $order = "desc";
              }
              else
              {
                  $sortby = "specials.products_id";
                  $order = "desc";
              }
          } 
          elseif ($type == "flashsale") { //flashsale products
                $sortby = "flash_sale.flash_start_date";
                $order = "asc";
            } else {
                $sortby = "products.products_id";
                $order = "desc";
            }
            $searchValue ='';
            if($request->searchValue != '')
            {
            $searchValue = $request->searchValue;
            }
  
            $filterProducts = array();
            $eliminateRecord = array();
            $videosarray = '';
            $videoslatarray = array();
            if (!empty($request->filters)) {
  
              //print_r($request->filters);die();
  
                foreach ($request->filters as $filters_attribute) {
  
                    $data = DB::table('products_to_categories')
                        ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                        ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                        ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                        ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                        ->LeftJoin('specials', function ($join) use ($currentDate) {
                            $join->on('specials.products_id', '=', 'products_to_categories.products_id')
                                ->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                        })
  
                        ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                        ->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
                        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')
  
                        ->select('products.*')
                        ->orwhere('products_description.products_name', 'LIKE', '%' . $searchValue . '%')
                        ->where('products_description.language_id', '=', $language_id)
                        ->whereBetween('products.products_filter_price', [$minPrice, $maxPrice]);
                        //->where('categories.parent_id', '!=', '0');
  
                    if (!empty($request->categories_id)) {
                        $data->where('products_to_categories.categories_id', '=', $request->categories_id)->orderBy('products.productOrder', 'ASC');
                    }
  
                    if (!empty($request->brand_id)) {
                      $data->where('products.manufacturers_id', '=', $request->brand_id);
                      
                    }
  
                  
                    $getProducts = $data->where('products_options_descriptions.options_name', '=', $filters_attribute['name'])
                        ->where('products_options_values_descriptions.options_values_name', '=', $filters_attribute['value'])
                        ->where('products.products_status', '=', '1')
                        ->whereIn('products.product_view', [0, 2])
                        //->skip($skip)->take(10)
                        ->groupBy('products.products_id')
                        ->get();
  
                    $foundRecord[] = $getProducts;
  
                   
  
                    
  
                    if (count($foundRecord) > 0) {
                        foreach ($getProducts as $getProduct) {
                         
                            if (!in_array($getProduct->products_id, $eliminateRecord)) {
                                $eliminateRecord[] = $getProduct->products_id;
                                //print_r($getProduct->products_id);die();
                                $productss = DB::table('products_to_categories')
                                    ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                                    ->leftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                                    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                                    ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                                    ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                                    ->leftJoin('specials', function ($join) use ($currentDate) {
                                        $join->on('specials.products_id', '=', 'products_to_categories.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                                    })
                                    ->LeftJoin('image_categories', function ($join) {
                                        $join->on('image_categories.image_id', '=', 'products.products_image')
                                            ->where(function ($query) {
                                                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                            });
                                    })
  
                                    ->select('products_to_categories.*', 'products.*', 'image_categories.path as products_image','image_categories.path_type as path_type',  'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'products_to_categories.categories_id', 'categories_description.*')
                                    ->where('categories_description.language_id', '=', $language_id)
                                    ->where('products_description.language_id', '=', $language_id)
                                    ->where('products.products_id', '=', $getProduct->products_id);
  
                                    if (!empty($request->categories_id)) {
                                      $productss->where('products_to_categories.categories_id', '=', $request->categories_id);
                                  }
                                    //->where('categories.parent_id', '!=', '0')
                                    $products = $productss->get();
                                $result = array();
                                $index = 0;
                                //print_r($products);die();
                                foreach ($products as $products_data) {
                                  //check currency start
                                  $requested_currency = $request->currency_code;
                                  $current_price = $products_data->products_price;
  
  
                                    $products_price = Product::convertprice($current_price, $requested_currency);
  
                                    ////////// for discount price    /////////
                                    if(!empty($products_data->discount_price)){
                                      $discount_price = Product::convertprice($products_data->discount_price, $requested_currency);
                                      $products_data->discount_price = $discount_price;
                                    }
  
  
                                  $products_data->products_price = $products_price;
                                  $products_data->currency = $requested_currency;
                                  //check currency end
                                    $products_id = $products_data->products_id;
                                    $products_description_new = stripslashes($products_data->products_description);
                                    $products_data->products_description_new = $products_description_new;
  
                                  $current_date = date("Y-m-d", strtotime("now"));
                                  $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products_data->products_id)->first();
                                  $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
                                  $date=date_create($string);
                                  date_add($date,date_interval_create_from_date_string($setting['new_product_duration']." days")); 
                                  $after_date = date_format($date,"Y-m-d");
                                  if($after_date >= $current_date){
                                      $products_data->is_new = 1;
                                  }
                                  else
                                  {
                                      $products_data->is_new = 0;
                                  }
  
                                    $products_video_link = $products_data->products_video_link;

                                    if($products_data->products_tax_class_id==0){
                                        $products_data->products_tax = '0';
                                    }else{
                                        $tax=DB::table('tax_rates')->where('tax_class_id', $products_data->products_tax_class_id)->first();
                                           if($tax){
                                                $products_data->products_tax = $tax->tax_rate;
                                           }else{
                                                $products_data->products_tax = '0';
                                           }
                                    }
                                    
  
                                    //multiple images
                                    $products_images = DB::table('products_images')
                                        ->LeftJoin('image_categories', function ($join) {
                                            $join->on('image_categories.image_id', '=', 'products_images.image')
                                                ->where(function ($query) {
                                                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                                });
                                        })
                                        ->select('products_images.*', 'image_categories.path as image','image_categories.path_type as path_type')
                                        ->where('products_id', '=', $products_id)->orderBy('sort_order', 'ASC')->get();
  
                                     $products_data->images = $products_images;
  
                                     $products_videos = DB::table('product_video')
                        ->LeftJoin('image_categories', function ($join) {
                          $join->on('image_categories.image_id', '=', 'product_video.image_id')
                              ->where(function ($query) {
                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                              });
                      })
                        ->select('product_video.*', 'image_categories.path as image','image_categories.path_type as path_type')
                        ->where('product_id', '=', $products_id)->orderBy('id', 'ASC')->get();
  
                    $products_data->videos = $products_videos;
             
  
                                    $categories = DB::table('products_to_categories')
                                        ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                                        ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                                        ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                                        ->where('products_id', '=', $products_id)
                                        ->where('categories_description.language_id', '=', $language_id)->get();
  
                                    $products_data->categories = $categories;
  
                                    $reviews = DB::table('reviews')
                                        ->join('users', 'users.id', '=', 'reviews.customers_id')
                                        ->select('reviews.*', 'users.avatar as image')
                                        ->where('products_id', $products_data->products_id)
                                        ->where('reviews_status', '1')
                                        ->get();
  
                                    $avarage_rate = 0;
                                    $total_user_rated = 0;
  
                                    if (count($reviews) > 0) {
  
                                        $five_star = 0;
                                        $five_count = 0;
  
                                        $four_star = 0;
                                        $four_count = 0;
  
                                        $three_star = 0;
                                        $three_count = 0;
  
                                        $two_star = 0;
                                        $two_count = 0;
  
                                        $one_star = 0;
                                        $one_count = 0;
  
                                        foreach ($reviews as $review) {
  
                                            //five star ratting
                                            if ($review->reviews_rating == '5') {
                                                $five_star += $review->reviews_rating;
                                                $five_count++;
                                            }
  
                                            //four star ratting
                                            if ($review->reviews_rating == '4') {
                                                $four_star += $review->reviews_rating;
                                                $four_count++;
                                            }
                                            //three star ratting
                                            if ($review->reviews_rating == '3') {
                                                $three_star += $review->reviews_rating;
                                                $three_count++;
                                            }
                                            //two star ratting
                                            if ($review->reviews_rating == '2') {
                                                $two_star += $review->reviews_rating;
                                                $two_count++;
                                            }
  
                                            //one star ratting
                                            if ($review->reviews_rating == '1') {
                                                $one_star += $review->reviews_rating;
                                                $one_count++;
                                            }
  
                                        }
  
                                        $five_ratio = round($five_count / count($reviews) * 100);
                                        $four_ratio = round($four_count / count($reviews) * 100);
                                        $three_ratio = round($three_count / count($reviews) * 100);
                                        $two_ratio = round($two_count / count($reviews) * 100);
                                        $one_ratio = round($one_count / count($reviews) * 100);
  
                                        $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
                                        $total_user_rated = count($reviews);
                                        $reviewed_customers = $reviews;
                                    } else {
                                        $reviewed_customers = array();
                                        $avarage_rate = 0;
                                        $total_user_rated = 0;
  
                                        $five_ratio = 0;
                                        $four_ratio = 0;
                                        $three_ratio = 0;
                                        $two_ratio = 0;
                                        $one_ratio = 0;
                                    }
  
                                    $products_data->rating = number_format($avarage_rate, 2);
                                    $products_data->total_user_rated = $total_user_rated;
  
                                    $products_data->five_ratio = $five_ratio;
                                    $products_data->four_ratio = $four_ratio;
                                    $products_data->three_ratio = $three_ratio;
                                    $products_data->two_ratio = $two_ratio;
                                    $products_data->one_ratio = $one_ratio;
  
                                    //review by users
                                    $products_data->reviewed_customers = $reviewed_customers;
  
                                    array_push($result, $products_data);
  
                                    $options = array();
                                    $attr = array();
  
                                    //like product
                                    if (!empty($request->customers_id)) {
                                        $liked_customers_id = $request->customers_id;
                                        $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();
                                        if (count($categories) > 0) {
                                            $result[$index]->isLiked = '1';
                                        } else {
                                            $result[$index]->isLiked = '0';
                                        }
                                    } else {
                                        $result[$index]->isLiked = '0';
                                    }
  
                                    $stocks = 0;
                                    $stockOut = 0;
                                    $defaultStock = 0;
                                    if ($products_data->products_type == '0' || $products_data->products_type == '1') {
                                        $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                                        $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                                        $defaultStock = $stocks - $stockOut;
                                    }else{
                                        //$attristock = $authController->getPosAttributesStock($products_data->products_id);
                                        $defaultStock = '0';
                                    }
  
                                    if ($products_data->products_max_stock < $defaultStock && $products_data->products_max_stock > 0) {
                                        $result[$index]->defaultStock = $products_data->products_max_stock;
                                    } else {
                                        $result[$index]->defaultStock = $defaultStock;
                                    }
  
                                    // fetch all options add join from products_options table for option name
                                    $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                                    if (count($products_attribute) > 0) {
                                        $index2 = 0;
                                        foreach ($products_attribute as $attribute_data) {
                                            $option_name = DB::table('products_options')
                                                ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                                            if (count($option_name) > 0) {
                                                $temp = array();
                                                $temp_option['id'] = $attribute_data->options_id;
                                                $temp_option['options_required'] = $option_name[0]->options_required;
                                                $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                                                $temp_option['name'] = $option_name[0]->products_options_name;
                                                $attr[$index2]['option'] = $temp_option;
  
                                                // fetch all attributes add join from products_options_values table for option value name
                                                $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                                                foreach ($attributes_value_query as $products_option_value) {
                                                    $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values_descriptions.language_id', '=', $language_id)->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();
                                                    $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
                                                    $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                                    $temp_i['id'] = $products_option_value->options_values_id;
                                                    $temp_i['value'] = $option_value[0]->products_options_values_name;
                                                    //check currency start
                                                    $current_price = $products_option_value->options_values_price;
                                                    $attr_weight = $products_option_value->weight;
                                                    $attr_weight_unit = $products_option_value->weight_unit;
  
  
                                                    $attribute_price = Product::convertprice($current_price, $requested_currency);
  
  
                                                    //check currency end
  
                                                    $temp_i['price'] = $attribute_price;
                                                    $temp_i['weight'] = $attr_weight;
                                                    $temp_i['weight_unit'] = $attr_weight_unit;
                                                    $temp_i['price_prefix'] = $products_option_value->price_prefix;
                                                    array_push($temp, $temp_i);
  
                                                }
                                                $attr[$index2]['values'] = $temp;
                                                $result[$index]->attributes = $attr;
                                                $index2++;
                                            }
                                        }
                                    } else {
                                        $result[$index]->attributes = array();
                                    }
                                    array_push($filterProducts, $result[$index]);
                                    $index++;
                                }
                            }
                        }
                        $responseData = array('success' => '1', 'product_data' => $filterProducts, 'message' => "Returned all products.", 'total_record' => count($filterProducts));
                    } else {
                        $total_record = array();
                        $responseData = array('success' => '0', 'product_data' => $filterProducts, 'message' => "Search results empty.", 'total_record' => count($total_record));
                    }
                }
            } else {
  
                $categories = DB::table('products')
                    ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                    ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id');
  
                $categories->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                });
  
                if (!empty($request->categories_id)) {
  
                    $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                        ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                        ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')->orderBy('products.productOrder', 'ASC');
                }
                else
                {
                  $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                  ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id');
                }
  
                
  
              
  
                //wishlist customer id
                if ($type == "wishlist") {
                    $categories->LeftJoin('liked_products', 'liked_products.liked_products_id', '=', 'products.products_id')
                    ->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                    ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'image_categories.path as products_image','image_categories.path_type as path_type','specials.specials_new_products_price as discount_price','image_categories.image_id as old_image_id');;
                }
  
                elseif ($type == "top seller") {
                  if($collection_product == '1')
                  {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
                  else
                  {
                      $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
              }
              elseif ($type == "most liked") {
                  if($collection_product == '1')
                  {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                        ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
                  else
                  {
                      $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
              }
               //parameter special
      
               elseif ($type == "special") {
                  if($collection_product == '1')
                  {
                          $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                          $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                          ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
                  else
                  {
                      $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                        ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                  }
              }
  
             
            
               
               elseif ($type == "flashsale") {
                    //flash sale
                    $categories->
                        LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                        ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as flash_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
  
                } else {
                    $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                        $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                    })->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
                $categories->orwhere('products_description.products_name', 'LIKE', '%' . $searchValue . '%');
  
                if ($type == "special") {
                  if($collection_product == '1')
                  {
                      $categories->where('collections_product.collection_id', 2);
                      $categories->where('collections_product.status', 1);
                  }
                  else
                  {
                      $categories->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                  }
              }
  
                if ($type == "flashsale") { //flashsale
                    $categories->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate);
                } 
                else {
                  // if (!isset($request->products_id)) {
                  //     $categories->whereNotIn('products.products_id', function ($query) {
                  //         $query->select('flash_sale.products_id')->from('flash_sale');
                  //     });
                  // }else{
                      $isFlash = DB::table('flash_sale')->where('flash_sale.products_id', '=', $request->products_id)->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate)->first();
                      //dd($isFlash);
                      if($isFlash){
                          $categories->LeftJoin('flash_sale', function ($join) use ($currentDate) {
                              $join->on('flash_sale.products_id', '=', 'products.products_id')->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate);
                          })->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_sale_products_price as flash_price', 'flash_sale.flash_start_date','flash_sale.flash_expires_date','image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
  
                        
                          
                          $type = "flashsale";
  
                      }
                      
                  //}
                    
                }
  
                //get single category products
                if (!empty($request->categories_id)) {
                    $categories->where('products_to_categories.categories_id', '=', $request->categories_id)
                        ->where('categories_description.language_id', '=', $language_id);
                }
                else
                {
                  $categories->where('categories.categories_status', '=', 1);
                  $categories->groupBy('products_to_categories.products_id');
                }
  
                if (!empty($request->brand_id)) {
                  $categories->where('products.manufacturers_id', '=', $request->brand_id);
                
                }
  
               
  
                //get single products
                if (!empty($request->products_id) && $request->products_id != "") {
                    $categories->where('products.products_id', '=', $request->products_id);
                }
                //get multiple product multiple_products_id
                if (!empty($request->multiple_products_id) && $request->multiple_products_id != "") {
  
                
                  $multiple_products_id = explode(",", $request->multiple_products_id);
                
                    $categories->whereIn('products.products_id', $multiple_products_id);
              }
  
                //for min and maximum price
                if (!empty($maxPrice)) {
                    $categories->whereBetween('products.products_filter_price', [$minPrice, $maxPrice]);
                }
  
                if ($type == "top seller") {
                  if($collection_product == '1')
                  {
                      $categories->where('collections_product.collection_id', 1);
                      $categories->where('collections_product.status', 1);
                     
                  }
                  else
                  {
                  $categories->where('products.products_ordered', '>', 0);
                  }
              }
      
              if ($type == "most liked") {
                  if($collection_product == '1')
                  {
                      $categories->where('collections_product.collection_id', 3);
                      $categories->where('collections_product.status', 1);
                     
                  }
                  else
                  {
                  $categories->where('products.products_liked', '>', 0);
                  }
              }
      
                //wishlist customer id
                if ($type == "wishlist") {
                    $categories->where('liked_customers_id', '=', $request->customers_id);
                }
  
                $categories->where('products_description.language_id', '=', $language_id)
                    ->where('products.products_status', '=', '1')
                    ->whereIn('products.product_view', [0, 2])
                    ->orderBy($sortby, $order);
  
                if ($type == "special") { //deals special products
                    $categories->groupBy('products.products_id');
                }
                //count
                $total_record = $categories->get();
  
                //$data = $categories->skip($skip)->take(10)->get();

                $data = $categories->get();
  
                $result = array();
                $result2 = array();
                //check if record exist
                if (count($data) > 0) {
                    $index = 0;
                    foreach ($data as $products_data) {
  
                          //check currency start
                          $requested_currency = $request->currency_code;
                          $current_price = $products_data->products_price;
                          //dd($current_price, $requested_currency);
  
                          $products_price = Product::convertprice($current_price, $requested_currency);
                          ////////// for discount price    /////////
                          if(!empty($products_data->discount_price)){
                              $discount_price = Product::convertprice($products_data->discount_price, $requested_currency);
                              $products_data->discount_price = $discount_price;
                          }
  
                        $products_data->products_price = $products_price;
                        $products_data->currency = $requested_currency;
                        $products_description_new = stripslashes($products_data->products_description);
                        $products_data->products_description_new = $products_description_new;
                        //check currency end
                        $current_date = date("Y-m-d", strtotime("now"));
                                  $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products_data->products_id)->first();
                                  $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
                                  $date=date_create($string);
                                  date_add($date,date_interval_create_from_date_string($setting['new_product_duration']." days")); 
                                  $after_date = date_format($date,"Y-m-d");
                                  if($after_date >= $current_date){
                                      $products_data->is_new = 1;
                                  }
                                  else
                                  {
                                      $products_data->is_new = 0;
                                  }
  
  
  
                        //for flashsale currency price start
                        if ($type == "flashsale"){
                          $current_price = $products_data->flash_price;
                          $flash_price = Product::convertprice($current_price, $requested_currency);
                          $products_data->flash_price = $flash_price;
                        }
  
                        //for flashsale currency price end
                        $products_id = $products_data->products_id;
                        $products_video_link = $products_data->products_video_link;

                        if($products_data->products_tax_class_id==0){
                            $products_data->products_tax = '0';
                        }else{
                            $tax=DB::table('tax_rates')->where('tax_class_id', $products_data->products_tax_class_id)->first();
                                if($tax){
                                    $products_data->products_tax = $tax->tax_rate;
                                }else{
                                    $products_data->products_tax = '0';
                                }
                        }
  
                        //multiple images
                        $products_images = DB::table('products_images')
                            ->LeftJoin('image_categories', function ($join) {
                                $join->on('image_categories.image_id', '=', 'products_images.image')
                                    ->where(function ($query) {
                                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                    });
                            })
                            ->select('products_images.*', 'image_categories.path as image','image_categories.path_type as path_type')
                            ->where('products_id', '=', $products_id)->orderBy('sort_order', 'ASC')->get();
                            
                        $products_data->images = $products_images;
                        
  
  
                        $products_videos = DB::table('product_video')
                        ->LeftJoin('image_categories', function ($join) {
                          $join->on('image_categories.image_id', '=', 'product_video.image_id')
                              ->where(function ($query) {
                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                              });
                      })
                        ->select('product_video.*', 'image_categories.path as image','image_categories.path_type as path_type')
                        ->where('product_id', '=', $products_id)->orderBy('id', 'ASC')->get();
  
                    $products_data->videos = $products_videos;
  
                        $categories = DB::table('products_to_categories')
                            ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                            ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                            ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                            ->where('products_id', '=', $products_id)
                            ->where('categories_description.language_id', '=', $language_id)->get();
  
                        $products_data->categories = $categories;
  
                        $reviews = DB::table('reviews')
                            ->join('users', 'users.id', '=', 'reviews.customers_id')
                            ->select('reviews.*', 'users.avatar as image')
                            ->where('products_id', $products_data->products_id)
                            ->where('reviews_status', '1')
                            ->get();
  
                        $avarage_rate = 0;
                        $total_user_rated = 0;
  
                        if (count($reviews) > 0) {
  
                            $five_star = 0;
                            $five_count = 0;
  
                            $four_star = 0;
                            $four_count = 0;
  
                            $three_star = 0;
                            $three_count = 0;
  
                            $two_star = 0;
                            $two_count = 0;
  
                            $one_star = 0;
                            $one_count = 0;
  
                            foreach ($reviews as $review) {
  
                                //five star ratting
                                if ($review->reviews_rating == '5') {
                                    $five_star += $review->reviews_rating;
                                    $five_count++;
                                }
  
                                //four star ratting
                                if ($review->reviews_rating == '4') {
                                    $four_star += $review->reviews_rating;
                                    $four_count++;
                                }
                                //three star ratting
                                if ($review->reviews_rating == '3') {
                                    $three_star += $review->reviews_rating;
                                    $three_count++;
                                }
                                //two star ratting
                                if ($review->reviews_rating == '2') {
                                    $two_star += $review->reviews_rating;
                                    $two_count++;
                                }
  
                                //one star ratting
                                if ($review->reviews_rating == '1') {
                                    $one_star += $review->reviews_rating;
                                    $one_count++;
                                }
  
                            }
  
                            $five_ratio = round($five_count / count($reviews) * 100);
                            $four_ratio = round($four_count / count($reviews) * 100);
                            $three_ratio = round($three_count / count($reviews) * 100);
                            $two_ratio = round($two_count / count($reviews) * 100);
                            $one_ratio = round($one_count / count($reviews) * 100);
                            if(($five_star + $four_star + $three_star + $two_star + $one_star) > 0){
                              $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
                            }else{
                              $avarage_rate = 0;
                            }
                            $total_user_rated = count($reviews);
                            $reviewed_customers = $reviews;
                        } else {
                            $reviewed_customers = array();
                            $avarage_rate = 0;
                            $total_user_rated = 0;
  
                            $five_ratio = 0;
                            $four_ratio = 0;
                            $three_ratio = 0;
                            $two_ratio = 0;
                            $one_ratio = 0;
                        }
  
                        $products_data->rating = number_format($avarage_rate, 2);
                        $products_data->total_user_rated = $total_user_rated;
  
                        $products_data->five_ratio = $five_ratio;
                        $products_data->four_ratio = $four_ratio;
                        $products_data->three_ratio = $three_ratio;
                        $products_data->two_ratio = $two_ratio;
                        $products_data->one_ratio = $one_ratio;
  
                        //review by users
                        $products_data->reviewed_customers = $reviewed_customers;
  
                        array_push($result, $products_data);
                        $options = array();
                        $attr = array();
  
                        $stocks = 0;
                        $stockOut = 0;
                        $defaultStock = 0;
                        if ($products_data->products_type == '0' || $products_data->products_type == '1') {
                            $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                            $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                            $defaultStock = $stocks - $stockOut;
                        }else{
                            //$attristock = $authController->getPosAttributesStock($products_data->products_id);
                            $defaultStock = '0';
                        }
  
                        if ($products_data->products_max_stock < $defaultStock && $products_data->products_max_stock > 0) {
                            $result[$index]->defaultStock = $products_data->products_max_stock;
                        } else {
                            $result[$index]->defaultStock = $defaultStock;
                        }
  
                        //like product
                        if (!empty($request->customers_id)) {
                            $liked_customers_id = $request->customers_id;
                            $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();
                            if (count($categories) > 0) {
                                $result[$index]->isLiked = '1';
                            } else {
                                $result[$index]->isLiked = '0';
                            }
                        } else {
                            $result[$index]->isLiked = '0';
                        }
  
                        // fetch all options add join from products_options table for option name
                        $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                        if (count($products_attribute) > 0) {
                            $index2 = 0;
                            foreach ($products_attribute as $attribute_data) {
                                $option_name = DB::table('products_options')
                                    ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                                if (count($option_name) > 0) {
                                    $temp = array();
                                    $temp_option['id'] = $attribute_data->options_id;
                                    $temp_option['name'] = $option_name[0]->products_options_name;
                                    $temp_option['options_required'] = $option_name[0]->options_required;
                                    $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                                    $attr[$index2]['option'] = $temp_option;
  
                                    // fetch all attributes add join from products_options_values table for option value name
                                    $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                                    foreach ($attributes_value_query as $products_option_value) {
  
                                        //$option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions','products_options_values_descriptions.products_options_values_id','=','products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name' )->where('products_options_values_descriptions.language_id','=', $language_id)->where('products_options_values.products_options_values_id','=', $products_option_value->options_values_id)->get();
                                        $option_value = DB::table('products_options_values')->where('products_options_values_id', '=', $products_option_value->options_values_id)->get();
  
                                        $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
                                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                        $temp_i['id'] = $products_option_value->options_values_id;
  
                                        if (!empty($option_value[0]->products_options_values_name)) {
                                            $temp_i['value'] = $option_value[0]->products_options_values_name;
                                        } else {
                                            $temp_i['value'] = '';
                                        }
  
                                        //check currency start
                                        $current_price = $products_option_value->options_values_price;
  
                                        $attribute_price = Product::convertprice($current_price, $requested_currency);
  
                                        $attr_weight = $products_option_value->weight;
                                          $attr_weight_unit = $products_option_value->weight_unit;
  
  
  
                                        //check currency end
  
                                        //$temp_i['price'] = $products_option_value->options_values_price;
                                        $temp_i['price'] = $attribute_price;
                                        $temp_i['weight'] = $attr_weight;
                                        $temp_i['weight_unit'] = $attr_weight_unit;
                                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                                        array_push($temp, $temp_i);
  
                                    }
                                    $attr[$index2]['values'] = $temp;
                                    $result[$index]->attributes = $attr;
                                    $index2++;
                                }
                            }
                        } else {
                            $result[$index]->attributes = array();
                        }
                        $index++;
                    }
  
                    $responseData = array('success' => '1', 'product_data' => $result, 'message' => "Returned all products.", 'total_record' => count($total_record));
                } else {
                    $responseData = array('success' => '0', 'product_data' => $result, 'message' => "Empty record.", 'total_record' => count($total_record));
                }
            }
        } else {
            $responseData = array('success' => '0', 'product_data' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
  
        return $categoryResponse;
    }

    public static function getreportproduct($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->language_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $products = DB::table('products')
                 ->join('products_description', 'products.products_id', '=', 'products_description.products_id')
                 ->select('products_description.products_name as products_name', 'products.products_id')
                 ->where('products.products_status', '=', '1')
                 ->where('products_description.language_id', '=', $request->language_id)
                 ->get();
                if (!$products->isEmpty()) { 
                    $responseData = array('success'=>'1', 'data'=>$products,'message'=>"return all product..");
                }else{
                    $responseData = array('success'=>'0', 'message'=>"no data found");
                }   
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function applyposcoupon($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $currentDate = date('Y-m-d 00:00:00', time());
          if($authenticate==1){
            if($request->coupon_code == '' || $request->customers_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $data = DB::table('coupons')->where([['code', '=', $request->coupon_code],['expiry_date', '>', $currentDate],]);
                $coupons = $data->get();
                if (!$coupons->isEmpty()) {
                    $coupon_code=$request->coupon_code;
                    $customers_id = $request->customers_id;

                    $usedcouponcount = 0 ;
                    $count_of_coupon_used = DB::table('orders')->select('coupon_code')->where('coupon_code','!=',"")->get();
                    foreach($count_of_coupon_used as $couponcount){
                        $coupon_array = json_decode($couponcount->coupon_code);
                        foreach($coupon_array as $coupon_array_item){
                            if($coupon_code === $coupon_array_item->code){
                                $usedcouponcount++;
                            }
                        }
                    }

                    // check usage_limit_per_user
                    $usedcouponcount_limit = 0 ;
                    $count_of_coupon_user_limit = DB::table('orders')->select('coupon_code')->where('coupon_code','!=',"")->where('customers_id',$customers_id)->get();
                    //print_r($count_of_coupon_user_limit);die();
                    foreach($count_of_coupon_user_limit as $couponcount_limit){
                      $coupon_limit = json_decode($couponcount_limit->coupon_code);
                        foreach($coupon_limit as $coupon_limit_item){
                          if($coupon_limit_item->code===$coupon_code){
                              $usedcouponcount_limit++;
                          }
                        }
                    }

                    if ($coupons[0]->usage_limit > 0 and $coupons[0]->usage_limit == $usedcouponcount) {
                         $responseData = array('success'=>'0','message'=>"This coupon has been reached to its maximum usage limit.");
                    }else if($coupons[0]->usage_limit_per_user == $usedcouponcount_limit and !empty($coupons[0]->usage_limit_per_user)) {
                        $responseData = array('success'=>'0','message'=>"This coupon has been reached to its maximum usage limit.");
                    }

                    $responseData = array('success' => '1', 'message' => "Coupon is applied");

                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid coupons code."); 
                }
            }
          }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
          }
          $mediaResponse = json_encode($responseData);
          return $mediaResponse; 
    }
    public static function getstockaddproduct($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->products_id == '' || $request->language_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $result = array();
                $message = array();
                $errorMessage = array();
                $language_id      =   $request->language_id;
                $products_id      =   $request->products_id;

                $setting = new Setting();
                $myVarsetting = new SiteSettingController($setting);
                //$result['currency'] = $myVarsetting->getSetting();

                $product = DB::table('products')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                ->LeftJoin('specials', function ($join) {

                    $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

                })
                ->select('products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_id', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
                ->where('products_description.language_id', '=', $language_id);

                if ($products_id != null) {
                    $product->where('products.products_id', '=', $products_id);
                } else {
                    $product->orderBy('products.products_id', 'DESC');
                }

                $product =  $product->get();
                $result['products'] = $product;
                $products = $product;
                $result['message'] = $message;
                $result['errorMessage'] = $errorMessage;
                $result2 = array();
                $index = 0;
                $stocks = 0;
                $min_level = 0;
                $max_level = 0;
                $purchase_price = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->sum('purchase_price');

                if($result['products'][0]->products_type!=1){

                  $stocksin = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'in')->sum('stock');
                  $stockOut = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'out')->sum('stock');
                  $stocks = $stocksin - $stockOut;

                    $manageLevel = DB::table('manage_min_max')->where('products_id', $result['products'][0]->products_id)->get();
                    if(count($manageLevel)>0){
                        $min_level = $manageLevel[0]->min_level;
                        $max_level = $manageLevel[0]->max_level;
                    }

                }

                $result['purchase_price'] = $purchase_price;
                $result['stocks'] = $stocks;
                $result['min_level'] = $min_level;
                $result['max_level'] = $max_level;
                $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->get();
                $products_attribute = $products_attribute->unique('options_id')->keyBy('options_id');

                if(count($products_attribute)>0){
                    $index2 = 0;
                    foreach($products_attribute as $attribute_data){
                        $option_name = DB::table('products_options')
                          ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                          ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
                          ->where('products_options_descriptions.language_id', $language_id)
                          ->where('products_options.products_options_id', $attribute_data->options_id)
                          ->get();
                        if(count($option_name)>0){
                            $temp = array();
                $temp_option['id'] = $attribute_data->options_id;
                $temp_option['name'] = $option_name[0]->products_options_name;
                $attr[$index2]['option'] = $temp_option;
                // fetch all attributes add join from products_options_values table for option value name
                $attributes_value_query = DB::table('products_attributes')
                ->where('products_id', '=', $products_id)
                ->where('options_id', '=', $attribute_data->options_id)
                ->get();
                foreach($attributes_value_query as $products_option_value){
                    $option_value = DB::table('products_options_values')
                    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                    ->where('products_options_values_descriptions.language_id', '=', $language_id)
                    ->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)
                    ->get();
                    if(count($option_value)>0){
                        $attributes = DB::table('products_attributes')
                        ->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])
                        ->get();
                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                        $temp_i['id'] = $products_option_value->options_values_id;
                        $temp_i['value'] = $option_value[0]->products_options_values_name;
                        $temp_i['price'] = $products_option_value->options_values_price;
                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                        array_push($temp,$temp_i);
                    }

                }

                $attr[$index2]['values'] = $temp;
                $result['attributes'] =     $attr;
                $index2++;
                        }
                    }
                }else{
                    $result['attributes'] =     array();
                }
                //return $result;
                $responseData = array('success'=>'1', 'data'=> $result, 'message'=>"Return product details");  
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
         $mediaResponse = json_encode($responseData);
          return $mediaResponse;
    }

 public static function currentstock($request)
 {
    $consumer_data                        =  array();
    $consumer_data['consumer_key']        =  request()->header('consumer-key');
    $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
    $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
    $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
    $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
    $consumer_data['consumer_url']        =  __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    if($authenticate==1){
       if($request->products_id == '' || $request->attributeid == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields."); 
        }else{

           $inventory_ref_id = array();
           $attributes = array_filter($request->attributeid);
           $attributeid = implode(',',$attributes);
           $postAttributes = count($attributes); 
           $products_id = $request->products_id;

           $inventory = DB::table('inventory')->where('products_id', $products_id)->get();
           $reference_ids =array();
           $stockIn = 0;
           $purchasePrice = 0;
           $stockOut = 0;

           foreach($inventory as $inventory){
                $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
                $totalAttributes = count($totalAttribute);

                if($postAttributes>$totalAttributes){
                    $count = $postAttributes;
                }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
                    $count = $totalAttributes;
                }

                $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                    ->selectRaw('inventory.*')
                    ->whereIn('inventory_detail.attribute_id', [$attributeid])
                    ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
                    ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
                    ->get();

                if(count($individualStock) > 0 ){
                    if($individualStock[0]->stock_type == 'in'){
                        $inventory_ref_id[] = $individualStock[0]->inventory_ref_id;
                        $stockIn += $individualStock[0]->stock;
                        $purchasePrice += $individualStock[0]->purchase_price;
                    }
                    if($individualStock[0]->stock_type == 'out'){
                        $stockOut += $individualStock[0]->stock;
                    }

                }
            }

            $options_names  = array();
            $options_values = array();

            foreach($attributes as $attribute){
              $productsAttributes = DB::table('products_attributes')
                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                  ->where('products_attributes_id', $attribute)->get();
                $options_names[] = $productsAttributes[0]->options_name;
                $options_values[] = $productsAttributes[0]->options_values;
            }

            $options_names_count = count($options_names);
            $options_names = implode ( "','", $options_names);
            $options_names = "'" . $options_names . "'";
            $options_values = "'" . implode ( "','", $options_values ) . "'";
            $orders_products = DB::table('orders_products')->where('products_id', $products_id)->get();

            foreach($orders_products as $orders_product){
                $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
                $totalAttributes = count($totalAttribute);
                if($postAttributes>$totalAttributes){
                    $count = $postAttributes;
                }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
                    $count = $totalAttributes;
                }
                $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and `orders_products_attributes`.`orders_products_id`= '".$orders_product->orders_products_id."') = ".$count." and `orders_products`.`orders_products_id` = '".$orders_product->orders_products_id."' group by `orders_products_attributes`.`orders_products_id`");
                if(count($products)>0){
                    $stockOut += $products[0]->products_quantity;
                }
            }

            $result = array();
            $result['purchasePrice'] = $purchasePrice;
            $result['remainingStock'] = $stockIn - $stockOut;

             if(count($inventory_ref_id) > 0){
                $inventory_ref_id = $inventory_ref_id;

                
                $minMax = DB::table('manage_min_max')->whereIn('inventory_ref_id', $inventory_ref_id)->where('products_id', $products_id)->get();
               
                if(count($minMax) > 0){
                    $lastMinMax[]= $minMax[count($minMax) - 1];
                    $minMax = $lastMinMax;
                }
                   
               
                $inventory_ref_id = $inventory_ref_id[count($inventory_ref_id)-1];
                
                
            }else{
                $minMax = '';
            }

           // return $minMax;
            $result['inventory_ref_id'] = $inventory_ref_id;
            $result['products_id'] = $products_id;
            $result['minMax'] = $minMax;
            //return $result; 
            $responseData = array('success'=>'1', 'data'=> $result, 'message'=>"Return current stock");
        } 
    }else{
        $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
    }

    $mediaResponse = json_encode($responseData);
    return $mediaResponse;
 }

     public static function addstock($request)
     {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->products_id == '' || $request->stock_type == '' || $request->current_stocks_input == '' || $request->stock == '' || $request->language_id == '' || $request->cashierid == '' || $request->purchase_price == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $products_id = $request->products_id;
                $language_id = $request->language_id;
                if($request->stock_type === "out"){
                    if(($request->current_stocks_input - $request->stock ) < 0 ){
                        $responseData = array('success'=>'0','message'=>"Invalid stock");
                    }
                }

                $product = DB::table('products')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                ->LeftJoin('specials', function ($join) {

                    $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

                })
                ->select('products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_id', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
                ->where('products_description.language_id', '=', $language_id);

                if ($products_id != null) {
                    $product->where('products.products_id', '=', $products_id);
                } else {
                    $product->orderBy('products.products_id', 'DESC');
                }

                $product =  $product->get();
                    $products = $product;
                    $date_added = date('Y-m-d h:i:s');
                    $inventory_ref_id = DB::table('inventory')->insertGetId([
                        'products_id' => $products_id,
                        'reference_code' => $request->reference_code != "" ? $request->reference_code :"no  refrence",
                        'stock' => $request->stock,
                        'admin_id' => $request->cashierid,
                        'created_at' => $date_added,
                        'purchase_price' => $request->purchase_price,
                        'stock_type'    =>  $request->stock_type

                    ]);
             $jobimgarray=array();
            if($products[0]->products_type==1){
                 $jobimgarray=explode(",",$request->attributeid);
                foreach($jobimgarray as $attribute){
                    //if(!empty($attribute)){
                    DB::table('inventory_detail')->insert([
                        'inventory_ref_id' => $inventory_ref_id,
                        'products_id' => $products_id,
                        'attribute_id' => $attribute,
                    ]);
                    //}
                }
            }
            $responseData = array('success'=>'1', 'message'=>"Stock added successfully.");
            }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function viewStockReport($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;

        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
             if($request->date == '' || $request->type == '' || $request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
             }else{
                $stock = DB::table('inventory')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'inventory.products_id')
                ->select('inventory.*', 'products_description.products_name')
                ->whereDate('inventory.created_at', '=', $request->date)
                ->where('inventory.stock_type', '=', $request->type)
                ->where('products_description.language_id', '=', $request->language_id)
                ->get();
                //print($stock);
                if (!$stock->isEmpty()) { 
                    $responseData = array('success'=>'1', 'data'=>$stock,'message'=>"return all stock..");
                }else{
                    $responseData = array('success'=>'0', 'message'=>"no data found");
                }   
             }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
            $mediaResponse = json_encode($responseData);
            return $mediaResponse;
    }
    public static function addCashManagementCate($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;

        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->category_name == '' || $request->type == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
                $already = DB::table('cash_management_category')->where('type', $request->type)->where('cate_name', $request->category_name)->first();
                if($already){
                    $responseData = array('success'=>'0', 'message'=>"Category name already exists.");
                }else{
                    //insert category name
                        $cate = DB::table('cash_management_category')->insertGetId(
                            [
                                'type' => $request->type,
                                'cate_name' => $request->category_name,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                    $responseData = array('success'=>'1', 'message'=>"Category inserted successfully."); 
                } 
           } 
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function getCashManagementCate($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;

        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
         if($authenticate==1){
            if($request->type == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $result = DB::table('cash_management_category')->where('type', $request->type)->get();
                if (!$result->isEmpty()) { 
                    $responseData = array('success'=>'1', 'data'=>$result,'message'=>"return all categories..");
                }else{
                    $responseData = array('success'=>'0', 'message'=>"no data found");
                }   
            }
         }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
         }
         $mediaResponse = json_encode($responseData);
         return $mediaResponse;
    }
    public static function addPaidInOut($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;

        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->category_name == '' || $request->type == '' || $request->amount == '' || $request->api_token == '' || $request->drawer_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'14'])->first();
              if($cashier){
                $already = DB::table('drawer')->where('id', $request->drawer_id)->where('shift_opened_by', $cashier->id)->where('status', 'open')->first();
              if($already){

                if($request->type=='income'){
                   $total_in=$already->total_paid_in+$request->amount; 
                }else{
                   $total_in=$already->total_paid_in; 
                }

                if($request->type=='expanse'){
                   $total_out=$already->total_paid_out+$request->amount;  
                }else{
                   $total_out=$already->total_paid_out; 
                }
                // insert paid_in_out
                 $paid = DB::table('paid_in_out')->insertGetId(
                            [
                                'type' => $request->type,
                                'amount'=> $request->amount,
                                'cate_name' => $request->category_name,
                                'cashier_id'=> $cashier->id,
                                'drawer_id'=> $request->drawer_id,
                                'description'=> $request->description,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                // update drawer table
                  DB::table('drawer')->where('id', '=', $request->drawer_id)->update(
                [
                    'total_paid_in' => $total_in,
                    'total_paid_out' => $total_out,
                ]);
                  $result = DB::table('drawer')
                    ->where('shift_opened_by', '=',$cashier->id)
                    ->where('status', '=', 'open')
                    ->first();
                    if($result){
                        // get wallet payment total
                        $total_sale=DB::table('orders')
                            ->where(['cashier_id' => $cashier->id,'drawer_status'=>'0'])->where('order_status_id', '!=', '3')->sum('order_price');
                     // get paid in history
                        $paidin= DB::table('paid_in_out')->where('type', '=','income')->where('drawer_id', '=', $result->id)->get();
                     // get paid out history
                        $paidout= DB::table('paid_in_out')->where('type', '=','expanse')->where('drawer_id', '=', $result->id)->get();
                         $sdata=[
                            'id'=>$result->id,
                            'round'=>$result->round,
                            'shift_opened'=>$result->shift_opened,
                            'shift_opened_by' => $result->shift_opened_by,
                            'shift_closed' => $result->shift_closed,
                            'shift_closed_by'=> $result->shift_closed_by,
                            'total_sale'=> $total_sale, 
                            'start_cash_drawer'=>$result->start_cash_drawer,
                            'total_paid_in'=>$result->total_paid_in,
                            'total_paid_out'=>$result->total_paid_out,
                            'actual_in_drawer'=>$result->actual_in_drawer,
                            'expected_in_drawer'=>$result->expected_in_drawer,
                            'difference'=>$result->difference
                        ]; 
                        $payment = $authController->getPaymentByAmount($cashier->id);
                    }else{
                        $sdata=[];
                        $payment=[];
                        $paidin=[];
                        $paidout=[];
                    }
                  $responseData = array('success'=>'1','data'=>$sdata,'payment'=>$payment,'paid_in_list'=>$paidin,'paid_out_list'=>$paidout, 'message'=>"Inserted successfully.");
              }else{
                 $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Please open the drawer..");
              }
              }else{
                $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
              }

            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function cashierRole($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
         $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
              $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
              if($cashier){
                 $roles = DB::table('cashier_manage_role')->where('cashier_id','=', $cashier->id)->get();
                 if(count($roles)>0){
                    $role = array(
                        'product_management' => $roles[0]->product_management,
                        'bill_management' => $roles[0]->bill_management,
                        'cancel_bill' => $roles[0]->cancel_bill,
                        'inventory_management' => $roles[0]->inventory_management,
                        'dashboard_report' => $roles[0]->dashboard_report,
                        'customer' => $roles[0]->customer,
                        'settings' => $roles[0]->settings,
                        'drawer' => $roles[0]->drawer,
                        'user_cashier' => $roles[0]->user_cashier,
                        'net_profit' => $roles[0]->net_profit,
                        'create_stock_in' => $roles[0]->create_stock_in,
                        'edit_stock_in' => $roles[0]->edit_stock_in,
                        'create_stock_out' => $roles[0]->create_stock_out,
                        'edit_stock_out' => $roles[0]->edit_stock_out,
                        'create_adjust_stock' => $roles[0]->create_adjust_stock,
                    );
                 }else{
                    $role = array(
                        'product_management' => '0',
                        'bill_management' => '0',
                        'cancel_bill' => '0',
                        'inventory_management' => '0',
                        'dashboard_report' => '0',
                        'customer' => '0',
                        'settings' => '0',
                        'drawer' => '0',
                        'user_cashier' => '0',
                        'net_profit' => '0',
                        'create_stock_in' => '0',
                        'edit_stock_in' => '0',
                        'create_stock_out' => '0',
                        'edit_stock_out' => '0',
                        'create_adjust_stock' => '0',
                    );
                 }
                  $responseData = array('success'=>'1', 'data'=>$role,'message'=>"return all roles..");
              }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid cashier id."); 
              }  
           }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function fastCash($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
         $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $cash = DB::table('pos_fast_cash')->get();
            if(count($cash)>0){
                $responseData = array('success'=>'1', 'data'=>$cash,'message'=>"return all fast cash..");
            }else{
               $responseData = array('success'=>'0', 'message'=>"no data found"); 
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function updateFastCash($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
          if($request->updateid == '' || $request->amount == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
               $cash=DB::table('pos_fast_cash')->where('fast_amount','=', $request->amount)
                    ->where('id','!=', $request->updateid)
                    ->select('fast_amount')
                    ->first();
                if(empty($cash)) { 
                     // update amount
                         DB::table('pos_fast_cash')->where('id', $request->updateid)->update([
                            'fast_amount' => $request->amount,
                        ]);
                    $responseData = array('success' => '1', 'message' => "Fast cash amount updated successfully...");
                }else{
                    $responseData = array('success' => '0', 'message' => "This amount is already taken");
                }
        }  
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function topProduct($request){
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $settings = $authController->getSetting();
        $open_time = $settings['shop_open'];
        $cktime=$settings['order_open_time'];
        if($authenticate==1){
            $report=DB::table('orders_products')
                    ->leftJoin('orders', 'orders.orders_id', '=', 'orders_products.orders_id')
                    ->where('orders.order_status_id', '!=', '3')
                    ->selectRaw('sum(products_quantity) as total_quantity,products_name')
                    ->groupBy('products_id')
                    ->orderBy('total_quantity', 'DESC')
                    ->skip(0)
                    ->take(5);
                    if($request->type=='today') {
                        if($open_time=='1'){
                            $dateFrom = date('Y-m-d ' . '00:00:00');
                            $dateTo = date('Y-m-d ' . '23:59:59');  
                        }else{
                            if($cktime === NULL){
                                $dateFrom = date('Y-m-d ' . '00:00:00');
                                $dateTo = date('Y-m-d ' . '23:59:59');   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00');
                                     $tomorrow = date('Y-m-d');
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                    $dateFrom = date('Y-m-d ' . ''.$start_time.':00');
                                    $dateTo = date('Y-m-d ' . ''.$end_time.':59');
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);

                    }elseif($request->type=='weekly'){

                        $monday = strtotime('next Monday -1 week');
                        $monday = date('w', $monday)==date('w') ? strtotime(date("Y-m-d",$monday)." +7 days") : $monday;
                        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

                        if($open_time=='1'){
                             $dateFrom = date('Y-m-d ' . '00:00:00',$monday);
                             $dateTo = date('Y-m-d ' . '23:59:59',$sunday);  
                        }else{
                            if($cktime === NULL){
                                 $dateFrom = date('Y-m-d ' . '00:00:00',$monday);
                                 $dateTo = date('Y-m-d ' . '23:59:59',$sunday);   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',$monday);
                                     $tomorrow = date('Y-m-d ' ,$sunday);
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',$monday);
                                     $dateTo = date('Y-m-d ' . ''.$end_time.'59',$sunday);
                                }
                            }
                        }
                    
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='month'){

                        if($open_time=='1'){
                             $dateFrom = date('Y-m-d ' . '00:00:00',strtotime("first day of this month"));
                             $dateTo = date('Y-m-d ' . '23:59:59',strtotime("last day of this month"));  
                        }else{
                            if($cktime === NULL){
                                 $dateFrom = date('Y-m-d ' . '00:00:00',strtotime("first day of this month"));
                                 $dateTo = date('Y-m-d ' . '23:59:59',strtotime("last day of this month"));   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',strtotime("first day of this month"));
                                     $tomorrow = date('Y-m-d' ,strtotime("last day of this month"));
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',strtotime("first day of this month"));
                                     $dateTo = date('Y-m-d ' . ''.$end_time.':59',strtotime("last day of this month"));
                                }
                            }
                        }

                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='year'){

                        if($open_time=='1'){
                              $dateFrom = date('Y-01-01 00:00:00');
                              $dateTo   =  date('Y-12-31 23:59:59');  
                        }else{
                            if($cktime === NULL){
                                  $dateFrom = date('Y-01-01 00:00:00');
                                  $dateTo   =  date('Y-12-31 23:59:59');   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-01-01 '.$start_time.':00');
                                     $tomorrow = date('Y-12-31');
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-01-01 '.$start_time.':00');
                                     $dateTo   = date('Y-12-31 '.$end_time.':59');   
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='custom'){

                        $range = explode('_', $request->dateRange);
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);

                        if($open_time=='1'){
                              $dateFrom =  $startdate. ' 00:00:00';
                              $dateTo = $enddate. ' 23:59:59';  
                        }else{
                            if($cktime === NULL){
                                  $dateFrom = $startdate. ' 00:00:00';
                                  $dateTo = $enddate. ' 23:59:59';   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = $startdate. ' '.$start_time.':00';
                                     $tomorrow = $enddate;
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = $startdate. ' '.$start_time.':00';
                                     $dateTo = $enddate. ' '.$end_time.':59';   
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }

                     $result = $report->get();
                    
            if(count($result)>0){
          
                $responseData = array('success'=>'1', 'data'=>$result,'message'=>"return all data..");
            }else{
               $responseData = array('success'=>'0', 'message'=>"no data found"); 
            }

        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function topCategory($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $settings = $authController->getSetting();
        $open_time = $settings['shop_open'];
        $cktime=$settings['order_open_time'];
        if($authenticate==1){
            $report=DB::table('orders_products')
                    ->leftJoin('orders', 'orders.orders_id', '=', 'orders_products.orders_id')
                    ->leftJoin('products_to_categories', 'products_to_categories.products_id', '=', 'orders_products.products_id')
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                    ->selectRaw('sum(orders_products.products_quantity) as total_quantity,categories_description.categories_name,products_to_categories.categories_id')
                    ->where('categories_description.language_id', '=', '1')
                    ->where('orders.order_status_id', '!=', '3')
                    ->groupBy('products_to_categories.categories_id')
                    ->orderBy('total_quantity', 'DESC')
                    ->skip(0)
                    ->take(5);
                    if($request->type=='today') {
                        if($open_time=='1'){
                            $dateFrom = date('Y-m-d ' . '00:00:00');
                            $dateTo = date('Y-m-d ' . '23:59:59');  
                        }else{
                            if($cktime === NULL){
                                $dateFrom = date('Y-m-d ' . '00:00:00');
                                $dateTo = date('Y-m-d ' . '23:59:59');   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00');
                                     $tomorrow = date('Y-m-d');
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                    $dateFrom = date('Y-m-d ' . ''.$start_time.':00');
                                    $dateTo = date('Y-m-d ' . ''.$end_time.':59');
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);

                    }elseif($request->type=='weekly'){

                        $monday = strtotime('next Monday -1 week');
                        $monday = date('w', $monday)==date('w') ? strtotime(date("Y-m-d",$monday)." +7 days") : $monday;
                        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

                        if($open_time=='1'){
                             $dateFrom = date('Y-m-d ' . '00:00:00',$monday);
                             $dateTo = date('Y-m-d ' . '23:59:59',$sunday);  
                        }else{
                            if($cktime === NULL){
                                 $dateFrom = date('Y-m-d ' . '00:00:00',$monday);
                                 $dateTo = date('Y-m-d ' . '23:59:59',$sunday);   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',$monday);
                                     $tomorrow = date('Y-m-d ' ,$sunday);
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',$monday);
                                     $dateTo = date('Y-m-d ' . ''.$end_time.'59',$sunday);
                                }
                            }
                        }

                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='month'){

                        if($open_time=='1'){
                             $dateFrom = date('Y-m-d ' . '00:00:00',strtotime("first day of this month"));
                             $dateTo = date('Y-m-d ' . '23:59:59',strtotime("last day of this month"));  
                        }else{
                            if($cktime === NULL){
                                 $dateFrom = date('Y-m-d ' . '00:00:00',strtotime("first day of this month"));
                                 $dateTo = date('Y-m-d ' . '23:59:59',strtotime("last day of this month"));   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',strtotime("first day of this month"));
                                     $tomorrow = date('Y-m-d' ,strtotime("last day of this month"));
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-m-d ' . ''.$start_time.':00',strtotime("first day of this month"));
                                     $dateTo = date('Y-m-d ' . ''.$end_time.':59',strtotime("last day of this month"));
                                }
                            }
                        }
                        
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='year'){

                        if($open_time=='1'){
                              $dateFrom = date('Y-01-01 00:00:00');
                              $dateTo   =  date('Y-12-31 23:59:59');  
                        }else{
                            if($cktime === NULL){
                                  $dateFrom = date('Y-01-01 00:00:00');
                                  $dateTo   =  date('Y-12-31 23:59:59');   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = date('Y-01-01 '.$start_time.':00');
                                     $tomorrow = date('Y-12-31');
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = date('Y-01-01 '.$start_time.':00');
                                     $dateTo   = date('Y-12-31 '.$end_time.':59');   
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }elseif($request->type=='custom'){

                        $range = explode('_', $request->dateRange);
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);

                        if($open_time=='1'){
                              $dateFrom =  $startdate. ' 00:00:00';
                              $dateTo = $enddate. ' 23:59:59';  
                        }else{
                            if($cktime === NULL){
                                  $dateFrom = $startdate. ' 00:00:00';
                                  $dateTo = $enddate. ' 23:59:59';   
                            }else{
                                $newtime=explode(" - ",$cktime);
                                $start_time=$newtime[0];
                                $end_time=$newtime[1];

                                if($start_time > $end_time){
                                     $dateFrom = $startdate. ' '.$start_time.':00';
                                     $tomorrow = $enddate;
                                     $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                                     $dateTo = $ntom.' '.$end_time.':59';
                                }else{
                                     $dateFrom = $startdate. ' '.$start_time.':00';
                                     $dateTo = $enddate. ' '.$end_time.':59';   
                                }
                            }
                        }
                        $report->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    }
                    $result = $report->get();
            if(count($result)>0){
                $responseData = array('success'=>'1', 'data'=>$result,'message'=>"return all data..");
            }else{
               $responseData = array('success'=>'0', 'message'=>"no data found"); 
            }

        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function getPosTable($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier = DB::table('users')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $table = DB::table('table_menu')->where('outlet', $cashier->outlet)->where('status', '1')->orderBy('id','ASC')->get();
                    if(count($table)>0){
                       $tdate=date('Y-m-d');
                       
                       foreach ($table as $jestable) {
                            //$status=DB::table('booking_table')->where(['table_id' => $jestable->id])->whereDate('checkin_date',$tdate)->whereIn('status', ['reserved', 'checkin'])->first();
                            $status=DB::table('booking_table')->where(['table_id' => $jestable->id])->whereIn('status', ['reserved', 'checkin'])->first();
                            if($status){
                                $hold=DB::table('hold')->where('session_id', $status->qrcode)->first();
                                $ttotal_amount=0;
                                $nstatus=$status->status;
                                $cdate= $status->checkin_date;
                                $bookingid=$status->id;
                                $qrcode=$status->qrcode;
                                $qrcode_url=$status->qrcode_url;
                                if($hold){
                                    $hold_id=$hold->id;
                                }else{
                                   $hold_id='0'; 
                                }
                                
                                $tamount=DB::table('customers_basket')->where('session_id', $status->qrcode)->get();
                                if(count($table)>0){
                                    foreach ($tamount as $jestamount) {
                                       $ttotal_amount=$ttotal_amount+($jestamount->final_price*$jestamount->customers_basket_quantity);
                                    }
                                    $total_amount=$ttotal_amount;
                                }else{
                                   $total_amount=0; 
                                }
                            }else{
                                $nstatus='';
                                $cdate= '0000-00-00 00:00:00';
                                $bookingid='';
                                $qrcode='';
                                $qrcode_url='';
                                $total_amount='0.00';
                                $hold_id='0';
                            }

                            $dataall[]=array(
                            'id'=>$jestable->id,
                            'name' => $jestable->table_no,
                            'max_per' => $jestable->max_per,
                            'status' => $nstatus,
                            'checkin_date'=>$cdate,
                            'bookingid'=>$bookingid,
                            'order_amount'=>$total_amount,
                            'qrcode'=>$qrcode,
                            'session_id'=>$qrcode,
                            'qrcode_url'=>$qrcode_url,
                            'hold_id'=>$hold_id,
                            );
                       }
                       $responseData = array('success'=>'1', 'data'=>$dataall,'message'=>"return all data.."); 
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"No data found");
                    }
                }else{
                   $responseData = array('success'=>'0', 'message'=>"Invalid api token"); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function posTableCheckin($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        $guest = $authController->getGuestUser();
        //print_r($guest->id);die();
        if($authenticate==1){
            if($request->api_token == '' || $request->tableid == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier = DB::table('users')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $tdate=date('Y-m-d');
                    //$table=DB::table('booking_table')->where(['table_id' => $request->tableid])->whereDate('checkin_date',$tdate)->whereIn('status', ['reserved', 'checkin'])->first();
                     $table=DB::table('booking_table')->where(['table_id' => $request->tableid])->whereIn('status', ['reserved', 'checkin'])->first();
                    if($table){
                        $responseData = array('success'=>'0','message'=>"Table already checkin.");
                    }else{
                        $table = DB::table('table_menu')->where('id', $request->tableid)->first();
                        // add the booking details
                        $getSetting = $authController->getSetting();
                        $currency = $getSetting['currency'];
                        $currency_value = $getSetting['currencyValue'];
                        $qrcode=$authController->generate_string(10);
                        $url = url('/').'/merchant/'.$qrcode;
                        $book_id = DB::table('booking_table')->insertGetId(
                            [
                                'customer_id'=>$guest->id,
                                'table_id' => $request->tableid,
                                'table_name'=> $table->table_no,
                                'merchant_id' => $cashier->id,
                                'outletid'=> $cashier->outlet,
                                'qrcode'=> $qrcode,
                                'qrcode_url'=> $url,
                                'checkin_date'=> date('Y-m-d H:i:s'),
                                'duration' => '00:00:00',
                                'status' => 'reserved',
                                'currency' => $currency,
                                'currency_value'=> $currency_value,
                                'created_at'=> date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);

                        $bookid=$authController->PaymentID($book_id);
                        $checkin_id='DE'.$authController->PaymentID($book_id);

                        DB::table('booking_table')->where([['id', '=', $book_id]])->update(
                        [
                            'bookid' => $bookid,
                            'checkin_id' => $checkin_id,
                        ]);
                        // add to hold
                         $hold = DB::table('hold')->insertGetId([
                                'note' => $table->table_no,
                                'total_amount' => '0',
                                'hold_by' => $cashier->id,
                                'hold_status' => '1',
                                'table_id' => $request->tableid,
                                'table_name' => $table->table_no,
                                'created_at' =>date('Y-m-d h:i:s'),
                                'session_id' => $qrcode,
                                'pos_order_type' => 'table',
                                'customer_id'=>$guest->id,
                            ]);
                        $sdata=[
                            'qrcode'=>$url,
                            'hold_id'=>$hold,
                            'session_id'=>$qrcode
                        ];
                        $responseData = array('success'=>'1', 'data'=>$sdata, 'message'=>"Table checkin successfully");  
                    }
                }else{
                   $responseData = array('success'=>'0', 'message'=>"Invalid api token");  
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;     
    }

    public static function scanQrcode($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $session_id = md5(uniqid(rand(), true));
            if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $decrypt = $authController->resDecrypted($request->api_token);
                if($decrypt){
                    $code  = explode("|",$decrypt);
                    $countcode= count($code);
                    if($countcode == '3'){
                        $checkvalue=$code['2'];
                        if($checkvalue == '001'){
                            $userid=$code['0'];
                            $user = DB::table('users')->where('role_id', '2')->where('id', '=', $userid)->first();
                            if($user){
                                if($user->phone_verified=='1'){
                                    if($user->status=='1'){
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
                                        $uaddress=DB::table('address_book')->where('user_id',$user->id)->first();
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

                                         $sdata=[
                                            "id"=>$user->id,
                                             "first_name"=>$user->first_name,
                                             "last_name"=>$user->last_name,
                                             "gender"=>$user->gender,
                                             "country_code"=>$user->country_code,
                                             "phone"=>$user->phone,
                                             "email"=>$user->email,
                                             "status"=>$user->status,
                                             "phone_verified"=>$user->phone_verified,
                                             "loyalty_points"=>$user->loyalty_points,
                                             "users_level"=>$user->users_level,
                                             "dob"=>$user->dob,
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
                                         ];
                                         $responseData = array("success"=>'1', "type"=>'001',"data"=>$sdata, "message"=>"Returned all user list.");
                                    }else{
                                        $responseData = array('success'=>'0', 'message'=>"Your account has been locked please contact the system administrator");
                                    }
                                }else{
                                    $responseData = array('success'=>'0', 'message'=>"User phone number not verified");
                                }
                            }else{
                               $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");  
                            }
                        }else if($checkvalue == '004'){
                            // check Voucher product
                            $redeem_id=$code['0'];
                            $redeem = DB::table('tb_redeem')->where('reStatus', '1')->where('id', '=', $redeem_id)->first();
                            if($redeem){
                                $currentDateTimes = Carbon::now();
                                if($redeem->max_time <= $currentDateTimes){
                                    $responseData = array('success'=>'0', 'message'=>"Time out please redeem voucher code and try again");
                                }else{
                                    $coupons = DB::table('coupons')->where('coupans_id', $redeem->vouID)->first();
                                    $products_data = DB::table('products')->where('products_id', $coupons->products_id)->first();
                                    // add to cart product
                                    $customers_basket_id = DB::table('customers_basket')->insertGetId(
                                        [
                                            'customers_id' => $redeem->user_id,
                                            'products_id' => $coupons->products_id,
                                            'session_id' => $request->session_id,
                                            'customers_basket_quantity' => '1',
                                            'final_price' => $coupons->amount,
                                            'original_price'=> $products_data->products_price,
                                            'discount_type'=> 'product_voucher',
                                            'customers_basket_date_added' => date('Y-m-d'),
                                            'order_source' => 'normal',
                                            'discount_price' => '0.00',
                                        ]);
                                    // add table tb_usage_voucher_list
                                    if(!empty($request->cashier_token)){
                                        $cashier = DB::table('users')->where('api_token', $request->cashier_token)->first();
                                        $cid=$cashier->id;
                                    }else{
                                        $cid='0';
                                    }
                                        $list = DB::table('tb_usage_voucher_list')->insertGetId(
                                        [
                                            'qrcode' => $request->api_token,
                                            'voucherID' => $redeem->vouID,
                                            'voucherCode' => $coupons->qrcode,
                                            'userID' => $redeem->user_id,
                                            'orderID' => '0',
                                            'merchantID' => $cid,
                                            'status' => '1',
                                            'type'=>'coupons',
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ]);
                                    // delete redeem data
                                    $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("id",$redeem_id)->delete();
                                    $responseData = array("success"=>'1', "type"=>'004',"data"=>$request->session_id, "message"=>"Voucher redeem successfully");
                                }
                            }else{
                               $responseData = array('success'=>'0', 'message'=>"Invalid qrcode"); 
                           }
                        }else if($checkvalue == '005'){
                            // check Voucher point product
                            $redeem_id=$code['0'];
                            $redeem = DB::table('tb_redeem')->where('reStatus', '1')->where('id', '=', $redeem_id)->first();
                            if($redeem){
                                $currentDateTimes = Carbon::now();
                                if($redeem->max_time <= $currentDateTimes){
                                    $responseData = array('success'=>'0', 'message'=>"Time out please redeem voucher code and try again");
                                }else{
                                    $coupons = DB::table('redeem_points_settings')->where('id', $redeem->vouID)->first();
                                    $products_data = DB::table('products')->where('products_id', $coupons->products_id)->first();
                                    // add to cart product
                                    $customers_basket_id = DB::table('customers_basket')->insertGetId(
                                        [
                                            'customers_id' => $redeem->user_id,
                                            'products_id' => $coupons->products_id,
                                            'session_id' => $request->session_id,
                                            'customers_basket_quantity' => '1',
                                            'final_price' => $coupons->no_rm,
                                            'original_price'=> $products_data->products_price,
                                            'discount_type'=> 'product_voucher',
                                            'customers_basket_date_added' => date('Y-m-d'),
                                        ]);
                                    // add table tb_usage_voucher_list
                                    if(!empty($request->cashier_token)){
                                        $cashier = DB::table('users')->where('api_token', $request->cashier_token)->first();
                                        $cid=$cashier->id;
                                    }else{
                                        $cid='0';
                                    }
                                        $list = DB::table('tb_usage_voucher_list')->insertGetId(
                                        [
                                            'qrcode' => $request->api_token,
                                            'voucherID' => $redeem->vouID,
                                            'voucherCode' => $coupons->qrcode,
                                            'userID' => $redeem->user_id,
                                            'orderID' => '0',
                                            'merchantID' => $cid,
                                            'status' => '1',
                                            'type'=>'points',
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ]);
                                    // delete redeem data
                                    $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("id",$redeem_id)->delete();
                                    $responseData = array("success"=>'1', "type"=>'004',"data"=>$request->session_id, "message"=>"Voucher redeem successfully");
                                }
                            }else{
                               $responseData = array('success'=>'0', 'message'=>"Invalid qrcode"); 
                            }
                        }else if($checkvalue == '003'){
                            $redeem_id=$code['0'];
                            $cart_total=0;
                            $redeem = DB::table('tb_redeem')->where('reStatus', '1')->where('id', '=', $redeem_id)->first();
                            if($redeem){
                                $currentDateTimes = Carbon::now();
                                if($redeem->max_time <= $currentDateTimes){
                                    $responseData = array('success'=>'0', 'message'=>"Time out please redeem voucher code and try again");
                                }else{
                                    $coupons = DB::table('coupons')->where('coupans_id', $redeem->vouID)->first();

                                    $cart = DB::table('customers_basket')->where('is_order', '=', '0')->where('hold_status', '=','0')->where('session_id', '=',$request->session_id)->get();

                                    if(!empty($cart)){
                                        foreach($cart as $jescart){
                                            $cart_total=$cart_total+($jescart->final_price*$jescart->customers_basket_quantity);
                                        }
                                    }

                                    // calculate discount amount
                                    if($coupons->minimum_amount >= $cart_total){
                                        $responseData = array('success'=>'0', 'message'=>"Coupon amount limit is low than minimum price"); 
                                        //print_r($cart_total);die();
                                    }else{

                                        if ($coupons->discount_type == 'fixed_cart') {
                                            if ($coupons->amount < $cart_total) {
                                                $coupon_discount = $coupons->amount;
                                            }else{
                                                $coupon_discount = $cart_total; 
                                            }
                                        }elseif($coupons->discount_type == 'percent'){
                                            $current_discount = $coupons->amount / 100 * $cart_total;
                                            $cart_price = $cart_total - $current_discount;
                                            if ($cart_price > 0) {
                                                if(!empty($coupons->cap_amount)){
                                                    if($current_discount < $coupons->cap_amount){
                                                        $coupon_discount = $current_discount;
                                                    }else{
                                                        $coupon_discount = $coupons->cap_amount;
                                                }
                                            }else{
                                                $coupon_discount = $current_discount;
                                            }
                                        }else{
                                           $coupon_discount = $cart_total;   
                                        }
                                    }

                                    // add temp_pos_coupons table
                                    $temp_id = DB::table('temp_pos_coupons')->insertGetId(
                                        [
                                            'session_id' => $request->session_id,
                                            'coupon_id' => $coupons->coupans_id,
                                            'code' => $coupons->code,
                                            'amount' => $coupons->amount,
                                            'discount' => $coupon_discount,
                                            'discount_type' => $coupons->discount_type,
                                            'created_at' =>date('Y-m-d H:i:s'),
                                            'updated_at' =>date('Y-m-d H:i:s')
                                        ]);

                                    // add table tb_usage_voucher_list
                                    if(!empty($request->cashier_token)){
                                        $cashier = DB::table('users')->where('api_token', $request->cashier_token)->first();
                                        $cid=$cashier->id;
                                    }else{
                                        $cid='0';
                                    }

                                    $list = DB::table('tb_usage_voucher_list')->insertGetId(
                                        [
                                            'qrcode' => $request->api_token,
                                            'voucherID' => $redeem->vouID,
                                            'voucherCode' => $coupons->qrcode,
                                            'userID' => $redeem->user_id,
                                            'orderID' => $temp_id,
                                            'merchantID' => $cid,
                                            'status' => '1',
                                            'type'=>'coupons',
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                    // delete redeem data
                                    $deleteRedeem = DB::table('tb_redeem')->where("reStatus",1)->where("id",$redeem_id)->delete();
                                    $responseData = array("success"=>'1', "type"=>'003',"data"=>$request->session_id, "message"=>"Voucher redeem successfully");

                                    }
                                }
                            }else{
                              $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");  
                            }
                        }else{
                           $responseData = array('success'=>'0', 'message'=>"Invalid qrcode"); 
                        }
                    }else{
                        $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");
                    }   
                }else{
                    // check product bar code
                    $product = DB::table('products')->where(['products_status' => '1','is_current' => '1','product_sku'=>$request->api_token])->first();
                    if($product){
                        //print_r($product);die();
                        $products_id=$product->products_id;
                        $quantity = '1';
                        $session_id=$request->session_id;
                        $attributeid='';
                        $option_id='';
                        $options_values_id='';
                        $customers_basket_id='';
                        $customers_id=$request->customers_id;
                        $cart = $authController->barCodeAddtoCart($products_id,$quantity,$session_id,$attributeid,$option_id,$customers_basket_id,$options_values_id,$customers_id);
                        if($cart=='add'){
                            $responseData = array("success"=>'1', "type"=>'002',"data"=>$request->session_id, "message"=>"Product added successfully");
                        }else{
                            $responseData = array('success'=>'0', 'message'=>"Cart error");
                        }
                    }else{
                        $product = DB::table('products_attributes')->where(['attributes_sku'=>$request->api_token])->first();
                        if($product){
                            //print_r($product);die();
                            $products_id=$product->products_id;
                            $quantity = '1';
                            $session_id=$request->session_id;
                            $attributeid=array('attributeid'=>$product->products_attributes_id);
                            $option_id=array('option_id'=>$product->options_id);
                            $options_values_id=$product->options_values_id;
                            $customers_basket_id='';
                            $customers_id=$request->customers_id;
                            $cart = $authController->barCodeAddtoCart($products_id,$quantity,$session_id,$attributeid,$option_id,$customers_basket_id,$options_values_id,$customers_id);
                            if($cart=='add'){
                            $responseData = array("success"=>'1', "type"=>'002',"data"=>$request->session_id, "message"=>"Product added successfully");
                            }else{
                                $responseData = array('success'=>'0', 'message'=>"Cart error");
                            }
                        }else{
                            $responseData = array('success'=>'0', 'message'=>"Invalid qrcode");
                        }
                    }  
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function checkQrcode($request){

        $user_id='523';
        $coupons = DB::table('coupons')->where('qrcode', $request->qrcode)->where('coupans_type', 'external')->first();

        $limit = DB::table('tb_usage_voucher_list')->where('voucherID', $coupons->coupans_id)->where('type', 'coupons')->count();
        $limit_user = DB::table('tb_usage_voucher_list')->where('voucherID', $coupons->coupans_id)->where('type', 'coupons')->where('userID', $user_id)->count();
        //print_r($coupons);die();

        if($coupons->usage_limit != '' && $coupons->usage_limit_per_user != ''){
            if($coupons->usage_limit <= $limit || $coupons->usage_limit_per_user <= $limit_user){
                $message = 'This coupon has been reached to its maximum usage limit';
            }else{
                $message = 'ok';
            }
        }else if($coupons->usage_limit != '' && $coupons->usage_limit_per_user == ''){
            if($coupons->usage_limit <= $limit){
                $message = 'This coupon has been reached to its maximum usage limit';
            }else{
                $message = 'ok'; 
            }
        }else if($coupons->usage_limit == '' && $coupons->usage_limit_per_user != ''){
            if($coupons->usage_limit_per_user <= $limit_user){
                $message = 'This coupon has been reached to its maximum usage limit';
            }else{
                $message = 'ok'; 
            }  
        }else{
            $message = 'ok';
        }

        return $message;
    }

    public static function addPrinter($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->printer_ip == '' || $request->printer_places_id == ''|| $request->api_token == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                   $printerarray=array();  $printerarray=explode(",",$request->printer_places_id);

                    foreach($printerarray as $jesprinter){
                        $result= DB::table('printer_ip')->where('printer_places_id', $jesprinter)->where('printer_ip', $request->printer_ip)->where('cashier_id', $cashier->id)->first();
                        if(empty($result)){
                            $list = DB::table('printer_ip')->insertGetId(
                                    [
                                        'cashier_id' =>$cashier->id,
                                        'type'=>'ip',
                                        'printer_places_id' => $jesprinter,
                                        'printer_ip' => $request->printer_ip,
                                        'status' => '1',
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                        }else{
                           $responseData = array('success'=>'0', 'message'=>"Printer ip already inserted");
                           $mediaResponse = json_encode($responseData);
                           return $mediaResponse;
                           break; 
                        }
                    }

                 $responseData = array('success'=>'1', 'message'=>"Printer added successfully"); 
             }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
             }       
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function viewPrinter($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_places')->where('status', '1')->get();
                    if(!empty($result)){
                        foreach ($result as $jesresult) {
                            $ip=DB::table('printer_ip')->where('printer_places_id', $jesresult->id)->where('cashier_id', $cashier->id)->where('type', 'ip')->get();
                            $dataall[]=array(
                                "id"=> $jesresult->id,
                                "printer_places"=>$jesresult->printer_places,
                                "status"=>$jesresult->status,
                                "ip_address"=>$ip
                            );
                        }
                        $responseData=array("success"=>"1","data"=>$dataall);
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"No data found"); 
                    }
                }else{
                    $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
                }
            }     
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function updatePrinter($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->update_id == '' || $request->status == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_ip')->where('id', $request->update_id)->where('cashier_id', $cashier->id)->first();
                    if($result){
                         DB::table('printer_ip')->where('id', '=', $request->update_id)->update([
                            'status' => $request->status,
                        ]);
                         $responseData = array('success'=>'1', 'message'=>"Printer updated successfully"); 
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"Invalid update id."); 
                    }
                }else{
                   $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function deletePrinter($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->delete_id == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           } else {
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_ip')->where('id', $request->delete_id)->where('cashier_id', $cashier->id)->first();
                    if($result){
                        $checkRecord = DB::table('printer_ip')->where([
                          'id' => $request->delete_id
                      ])->delete();
                       $responseData = array('success'=>'1', 'message'=>"Printer deleted successfully"); 
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"Invalid delete id."); 
                    }
                }else{
                    $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
                }
           }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function addCashierDevices($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data); 
        if($authenticate==1){
            if($request->api_token == '' || $request->device_type == '' || $request->device_token == '' || $request->device_meta == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    if ($request->device_type == 'iOS') { /* iphone */
                        $type = 1;
                    } elseif ($request->device_type == 'Android') { /* android */
                        $type = 2;
                    } elseif ($request->device_type == 'Desktop') { /* other */
                        $type = 3;
                    }
                     $existUserDevice = DB::table('devices')->where('user_id', $cashier->id)->get();
                     if (count($existUserDevice)>0) {
                        DB::table('devices')->where('user_id', $cashier->id)->update([
                            'device_id'     => $request->device_token,
                           ]);
                        $responseData = array('success' => '1', 'message' => "Device is updated successfully.");
                     }else{
                        DB::table('devices')->insertGetId(
                            [   'device_id' => $request->device_token,
                                'device_type' => $type,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'status' => '1',
                                'user_id' =>  $cashier->id,
                                'ram' => '2 GB',
                                'processor' => $request->device_type,
                                'device_os' => $request->device_meta,
                                'location' => 'Malaysia',
                                'device_model' => $request->device_type,
                                'manufacturer' => $request->device_type,
                            ]);
                        $responseData = array('success' => '1', 'message' => "Device is registered.");
                     }
                }else{
                  $responseData = array('success'=>'0', 'message'=>"Invalid api token.");   
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function getServeProduct($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->type == '' || $request->status == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $language_id='1';
               if($request->type=='bar'){
                  $type='1';
               }elseif($request->type=='kitchen'){
                  $type='2';
               }
               $cart = DB::table('customers_basket')
                ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
                ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                    'products_description.products_name as products_name', 'products.products_quantity as quantity',
                    'products.products_price as price', 'products.products_weight as weight',
                    'products.products_weight_unit as unit')->where('customers_basket.is_order', '=', '1')->where('products_description.language_id', '=', $language_id)
                ->where('customers_basket.hold_status', '=','1')
                ->where('customers_basket.serve_status', '=',$request->status)
                ->where('products.product_serve', '=',$type)
                ->get();
                $result = array();
                    if (!$cart->isEmpty()){
                        foreach ($cart as $baskit_data) {
                            //products_image
                            $default_images = DB::table('image_categories')
                              ->where('image_id', '=', $baskit_data->products_image)
                              ->where('image_type', 'THUMBNAIL')
                              ->first();

                            if ($default_images) {
                                      $baskit_data->image = $default_images->path;
                                  } else {
                                      $default_images = DB::table('image_categories')
                                          ->where('image_id', '=', $baskit_data->products_image)
                                          ->where('image_type', 'MEDIUM')
                                          ->first();

                                      if ($default_images) {
                                          $baskit_data->image = $default_images->path;
                                      } else {
                                          $default_images = DB::table('image_categories')
                                              ->where('image_id', '=', $baskit_data->products_image)
                                              ->where('image_type', 'ACTUAL')
                                              ->first();
                                          $baskit_data->image = $default_images->path;
                                      }
                                  }

                        $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })

                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                       ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=',  $language_id)
                       ->where('products_options_values_descriptions.language_id', '=',  $language_id)
                       ->where('customers_basket_attributes.session_id', '=',  $baskit_data->session_id)
                       ->get();

                           if (!$attributes->isEmpty()) {
                                $baskit_data->attributes = $attributes;
                           }else{
                                $baskit_data->attributes = [];
                           }
                           array_push($result, $baskit_data);
                        }
						$responseData = array('success'=>'1', 'data'=>$result,  'message'=>"Return all cart data."); 

                    }else{
						$responseData = array('success'=>'0','message'=>"No data found");
					}             
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function changeStatusServeProduct($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->updateid == '' || $request->status == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                //$result=DB::table('customers_basket')->where('customers_basket_id', $request->updateid)->first();
                $updatearray=array();  
                $updatearray=explode(",",$request->updateid);
                if(!empty($updatearray)){
                    foreach($updatearray as $jescate){
                     if($request->status=='1' || $request->status=='2' || $request->status=='3'){
                        $data=DB::table('customers_basket')->where('customers_basket_id', $jescate)->first();
                        //print_r($data);die();
                        $result=DB::table('customers_basket')->where('products_id', $data->products_id)->where('session_id', $data->session_id)->where('serve_status', $request->status)->first();
                        if($result){
                            $update_total=$result->customers_basket_quantity+$data->customers_basket_quantity;
                                // update total
                                DB::table('customers_basket')->where('customers_basket_id', $jescate)->update([
                                'customers_basket_quantity'     => $update_total,
                               ]);
                               // delete old order
                                DB::table('customers_basket')->where('customers_basket_id', $result->customers_basket_id)->delete();

                        }
                     }
                     DB::table('customers_basket')->where('customers_basket_id', $jescate)->update([
                            'serve_status'     => $request->status,
                           ]);
                    }

                    $responseData = array('success' => '1', 'message' => "Status updated successfully.");
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid updated id."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function pointConvertAmount($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->no_points == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user=DB::table('users')->where('role_id', '2')->where('api_token', $request->api_token)->first();
                if($user){
                  if($user->loyalty_points >= $request->no_points){
                    $settings = DB::table('settings')->where('id', '=','214')->first();
                    $get_amount=($request->no_points*$settings->value);
                    // update user table
                    $balance_point=$user->loyalty_points-$request->no_points;
                    $wallet_amount=$user->wallet_amount+$get_amount;

                    DB::table('users')->where('id', $user->id)->update([
                            'loyalty_points'     => $balance_point,
                            'wallet_amount'     => $wallet_amount,
                    ]);

                     // add tb_point_to_amount table
                       $order_id = DB::table('tb_point_to_amount')->insertGetId(
                            [   'customer_id' => $user->id,
                                'use_point' => $request->no_points,
                                'amount' => $get_amount,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);

                    // add transaction_points table
                    DB::table('transaction_points')->insertGetId(
                            [   'user_id' => $user->id,
                                'order_id' => $order_id,
                                'loyalty_id' => '0',
                                'points' =>  $request->no_points,
                                'balance_points' => $balance_point,
                                'points_status' => 'out',
                                'description' => 'Point change to amount',
                                'status' => '1',
                                'type' => 'amount',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);

                     $sdata=[
                        'loyalty_points'=>$balance_point,
                        'wallet_amount'=>$wallet_amount
                    ];
                   
                    $responseData = array('success' => '1', 'data'=>$sdata, 'message' => "Amount credited on your wallet.");
                  }else{
                    $responseData = array('success'=>'0','message'=>"Insufficient balance ponts");
                  } 
                }else{
                  $responseData = array('success'=>'0','message'=>"Invalid user api token.");   
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function addProductDiscount($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->id == '' || $request->discount_price == '' || $request->session_id == '' || $request->cashier_token==''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cart=DB::table('customers_basket')->where('customers_basket_id', $request->id)->where('session_id', $request->session_id)->first();
                if($cart){
                        $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                        if($cashier){
                             DB::table('customers_basket')->where('customers_basket_id', $request->id)->update([
                                'discount_price'     => $request->discount_price,
                            ]);
                            $responseData = array('success' => '1', 'message' => "Discount updated successfully.");
                        }else{
                            $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
                        }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cart id."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function addBillDiscount($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->discount_price == '' || $request->session_id == '' || $request->cashier_token==''){
               $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $cart=DB::table('customers_basket')->where('session_id', $request->session_id)->get();
                if (!$cart->isEmpty()) {
                    $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                    if($cashier){
                        $check=DB::table('temp_pos_coupons')->where('session_id', $request->session_id)->where('discount_type', 'bill_discount')->where('code', 'Bill Discount')->first();
                        if($check){
                            //update
                             DB::table('temp_pos_coupons')->where('id', $check->id)->update([
                                'amount'     => $request->discount_price,
                                'discount'     => $request->discount_price,
                            ]);
                             
                            $responseData = array('success' => '1', 'message' => "Discount updated successfully.");
                        }else{
                           // add
                           $order_id = DB::table('temp_pos_coupons')->insertGetId(
                            [   'session_id' => $request->session_id,
                                'coupon_id' => '0',
                                'code' => 'Bill Discount',
                                'amount'=> $request->discount_price,
                                'discount'=> $request->discount_price,
                                'discount_type'=>'bill_discount',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                           
                           $responseData = array('success' => '1', 'message' => "Discount inserted successfully.");
                        }
                    }else{
                       $responseData = array('success'=>'0','message'=>"Invalid cashier api token.");  
                    }
                }else{
                     $responseData = array('success'=>'0','message'=>"Invalid session id."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function createTable($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data); 
        if($authenticate==1){
            if($request->cashier_token == '' || $request->name == '' || $request->number_person =='' || $request->outlet_id==''){
                $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                if($cashier){
                    $checkExist = DB::table('table_menu')->where('table_no','=',$request->name)->where('outlet','=',$request->outlet_id)->first();
                    if($checkExist){
                        $responseData = array('success'=>'0','message'=>"Table name already exists."); 
                    }else{
                        $date_added = date('y-m-d h:i:s');
                            DB::table('table_menu')->insert([
                            'table_no'  =>  $request->name,
                            'max_per'   =>  $request->number_person,
                            'outlet'    =>  $request->outlet_id,
                            'status'    =>  '1',
                            'created_at'=>   $date_added,
                            'updated_at'=>  $date_added
                        ]);
                        $responseData = array('success' => '1', 'message' => "Table inserted successfully.");
                    }
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid cashier api token.");
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function updatePin($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data); 
        if($authenticate==1){
            if($request->cashier_token == '' || $request->pin == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");  
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                if($cashier){
                        //update
                         DB::table('users')->where('id', $cashier->id)->update([
                            'pin'     => $request->pin,
                        ]);
                        $responseData = array('success' => '1', 'message' => "Pin updated successfully."); 
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }

        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function getCashierProfile($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->cashier_token == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields."); 
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                if($cashier){
                    if($cashier->outlet=='0'){
                        $outaddress=[];
                    }else{
                         $address = DB::table('appointment_outlet')
                            ->leftjoin('zones', 'zones.zone_id', '=', 'appointment_outlet.zone_id')
                            ->leftjoin('countries', 'countries.countries_id', '=', 'appointment_outlet.countries_id')
                            ->select('appointment_outlet.*','zones.zone_name','countries.countries_name')
                            ->where('appointment_outlet.id', '=', $cashier->outlet)
                            ->first();
                            if($address){
                               $outaddress=$address; 
                            }else{
                               $outaddress=[]; 
                            }
                    }
                    // get plan details
                        $superadmin=DB::table('users')->where('id', '1')->first();
                        if($superadmin){
                            $result=DB::connection('mysql2')->table('tb_user')->where('id', $superadmin->super_admin_id)->first();
                            if($result){
                                $plandata=DB::connection('mysql2')->table('manage_plan')->where('plan_method', $result->plan)->first();
                                if($plandata){
                                   $plan=$plandata;
                                }else{
                                   $plan=[];  
                                }
                            }else{
                              $plan=[];  
                            }
                        }else{
                            $plan=[];
                        }
                    // get cashier info
                    $info=DB::table('cashier_info')->where('admin_id', $cashier->id)->first();
                    if($info){
                        $infodata=$info;
                    }else{
                       $infodata=[]; 
                    }
                    $responseData = array('success' => '1', 'message' => "Returned cashier data.",'data'=>$cashier,'outlet'=>$outaddress,'subscription'=>$plan,'setting'=>$infodata); 
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid cashier api token.");
                }
            }
        }else{
          $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function checkoutTable($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->cashier_token == '' || $request->booking_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                if($cashier){
                    $book=DB::table('booking_table')->where(['id'=>$request->booking_id])->first();
                    if($book){
                        $order=DB::table('customers_basket')->where(['session_id'=>$book->qrcode])->get();
                        if(count($order)>0){
                            $responseData = array('success'=>'0','message'=>"Please pay bill after checkout table.");
                        }else{
                           //update
                             DB::table('booking_table')->where('id', $request->booking_id)->update([
                                'status'     => 'checkout',
                                'checkout_date' => date('y-m-d h:i:s'),
                            ]);
                             $responseData = array('success' => '1', 'message' => "Table checkout successfully."); 
                        }
                    }else{
                        $responseData = array('success'=>'0','message'=>"Invalid booking id.");
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function getBarKitchenProduct($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->type == '' || $request->status == '' || $request->api_token == ''){
               $responseData = array('success'=>'0','message'=>"Required all fields."); 
           }else{
                $result=DB::table('users')->where('api_token', $request->api_token)->first();
                if($result){
                    $hold=DB::table('hold')
                    ->join('customers_basket', 'customers_basket.hold_id', '=', 'hold.id')
                    ->select('hold.*')
                    ->where('customers_basket.serve_status', '=', $request->status)
                    ->groupBy('customers_basket.hold_id')
                    ->get();
                     if (!$hold->isEmpty()) {
                            foreach ($hold as $jeshold) {
                                $product=$authController->getHoldProduct($jeshold->id,$request->type,$request->status);
                                $dataall[] = array(
                                    "id"=> $jeshold->id,
                                    "note"=>$jeshold->note,
                                    "total_amount"=>$jeshold->total_amount,
                                    "hold_by"=>$jeshold->hold_by,
                                    "hold_status"=>$jeshold->hold_status,
                                    "table_id"=>$jeshold->table_id,
                                    "table_name"=>$jeshold->table_name,
                                    "customer_id"=>$jeshold->customer_id,
                                    "session_id"=>$jeshold->session_id,
                                    "pos_order_type "=> $jeshold->pos_order_type ,
                                    "created_at"=> $jeshold->created_at,
                                    "product"=>$product
                                ); 
                            }
                        $responseData = array('success' => '1', 'data'=>$dataall, 'message' => "Amount credited on your wallet.");
                     }else{
                        $responseData = array('success'=>'0','message'=>"No data found."); 
                     }
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid api token."); 
                }   
           }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function deleteBarKitchenProduct($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->deleteId == '' || $request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all fields."); 
            }else{
                $result=DB::table('users')->where('api_token', $request->api_token)->first();
                if($result){
                    $delete=DB::table('customers_basket')->where('customers_basket_id', $request->deleteId)->where('serve_status', '1')->first();
                    if($delete){
                            DB::table('customers_basket')->where([
                                ['customers_basket_id', '=', $request->deleteId],
                            ])->delete();

                            DB::table('customers_basket_attributes')->where([
                                ['customers_basket_id', '=', $request->deleteId],
                            ])->delete();
                        $responseData = array('success' => '1','message' => "Product deleted successfully.");     
                    }else{
                       $responseData = array('success'=>'0','message'=>"Invalid delete id."); 
                    }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid api token.");   
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;   
    }

    public static function tipsReport($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            $reportBase = $request->reportBase;
            $cashier = DB::table('users')->where('role_id','=','14')->where('status','!=','3')->get();
            if(!$cashier->isEmpty()){
                if ($reportBase == 'this_month') {
                    $dateFrom = date('Y-m-01 00:00:00',time()); // hard-coded '01' for first day
                    $dateTo  = date('Y-m-t 23:59:59',time());
                }else if ($reportBase == 'last_month') {
                    $dateFrom=date('Y-m-d 00:00:00', strtotime('first day of last month'));
                    $dateTo=date('Y-m-d 23:59:59', strtotime('last day of last month'));
                }else if ($reportBase == 'last_year') {
                    $dateFrom=date('Y-01-01 00:00:00',time());
                    $dateTo=date('Y-12-31 23:59:59',time());
                }else{
                    $reportBase = str_replace('dateRange', '', $reportBase);
                    $reportBase = str_replace('=', '', $reportBase);
                    $reportBase = str_replace('-', '/', $reportBase);

                    $From = substr($reportBase, 0, 10);
                    $To = substr($reportBase, 11, 21);

                    $dateFrom = date('Y-m-d 00:00:00', strtotime($From));
                    $dateTo = date('Y-m-d 23:59:59', strtotime($To));

                    //print_r($dateTo);die();
                }
                
                    foreach ($cashier as $jescashier) {
                        $totalSale = DB::table('orders')
                            ->whereBetween('date_purchased', [$dateFrom, $dateTo]) 
                            ->where('cashier_id', '=', $jescashier->id)
                            ->where('order_status_id', '!=', '3')
                            ->count();
                        $purchases = DB::table('orders')
                            ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                            ->where('cashier_id', '=', $jescashier->id)
                            ->where('order_status_id', '!=', '3')
                            ->sum('order_price');
                        $tips = DB::table('orders')
                            ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                            ->where('cashier_id', '=', $jescashier->id)
                            ->where('order_status_id', '!=', '3')
                            ->sum('pos_tips_amount'); 
                       $dataall[] = array(
                                "first_name"=> $jescashier->first_name,
                                "last_name"=>$jescashier->last_name,
                                "count"=>$totalSale,
                                "total_tips"=>$tips,
                                "total"=>$purchases
                                );  
                    }
                    $responseData = array('success' => '1', 'data'=>$dataall, 'message' => "Return all report.");
            }else{
                $responseData = array('success'=>'0','message'=>"No data found."); 
            }
            
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function getSalesPerson($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == ''){
                $responseData = array('success'=>'0','message'=>"Required all fields."); 
            }else{
               $result=DB::table('users')->where('api_token', $request->api_token)->first(); 
               if($result){
                   $data=DB::table('users')->where('role_id', '28')
                   ->select('id','first_name','last_name','phone','email','api_token')
                   ->get();
                   if(!empty($data)){
                      $responseData = array('success' => '1', 'data'=>$data, 'message' => "Return all sales person.");
                   }else{
                      $responseData = array('success'=>'0','message'=>"No data found.");
                   }  
               }else{
                 $responseData = array('success'=>'0','message'=>"Invalid api token.");  
               }
            } 
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }
    public static function addCartSalesPerson($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->session_id == '' || $request->api_token == '' || $request->sales_person_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all fields.");
           }else{
                $result=DB::table('users')->where('api_token', $request->api_token)->first();
                if($result){
                    $date_added = date('y-m-d h:i:s');
                    $check=DB::table('sales_person_cart')->where('session_id', $request->session_id)->first();
                        if($check){
                            if($request->sales_person_id == '0'){
                                // delete
                                DB::table('sales_person_cart')->where([
                                    ['id', '=', $check->id],
                                ])->delete();
                            $responseData = array('success' => '1', 'message' => "Sales person delete cart successfully.");
                            }else{
                                //update
                                 DB::table('sales_person_cart')->where('id', $check->id)->update([
                                    'sales_person_id'     => $request->sales_person_id,
                                    'updated_at' =>  $date_added,
                                ]);
                            $responseData = array('success' => '1', 'message' => "Sales person update cart successfully.");  
                            }
                        }else{
                             DB::table('sales_person_cart')->insert([
                                'session_id'  =>  $request->session_id,
                                'sales_person_id' => $request->sales_person_id,
                                'created_at'=>  $date_added,
                                'updated_at'=>  $date_added
                            ]);
                        $responseData = array('success' => '1', 'message' => "Sales person add cart successfully.");  
                        }
                }else{
                  $responseData = array('success'=>'0','message'=>"Invalid api token.");  
                }
           } 
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function productTaxCal($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->cart_id == '' || $request->currency_code == '' || $request->country_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all fields.");
            }else{
               $currency_value = DB::table('currencies')->where('code', $request->currency_code)->first();
               $cartid=explode(",",$request->cart_id);
               $index = '0';
               $total_tax = '0';
               foreach ($cartid as $key=>$jescartid){
                    $cartdata=DB::table('customers_basket')->where('customers_basket_id', $jescartid)->first();
                    $final_price = $cartdata->final_price;
                    $quantity = $cartdata->total_basket_quantity;
                    $products_id = $cartdata->products_id;

                    $products = DB::table('products')
                    ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'products.products_tax_class_id')
                    ->where('tax_rates.tax_zone_id', $request->country_id)
                    ->where('products_id', $products_id)->get();

                        if (count($products) > 0) {
                            $tax_value = $products[0]->tax_rate / 100 * $final_price * $quantity * $currency_value->value;
                            $total_tax = $total_tax + $tax_value;
                            $index++;
                        }
               }

                if ($total_tax > 0) {
                    $tax = $total_tax;
                } else {
                    $tax = '0';
                } 
                $responseData = array('success' => '1', 'data'=>$tax, 'message' => "Return all tax amount.");   
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function scanPosUser($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->member_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all fields."); 
            }else{
                $result=DB::table('users')->where(['member_id'=>$request->member_id,'role_id'=>'2','status'=>'1'])->first();
                if($result){
                     $user=DB::table('users')
                            ->where(['member_id'=>$request->member_id,'role_id'=>'2','status'=>'1'])
                            ->select('id','first_name','last_name','phone','email','member_id','wallet_amount')
                            ->first();
                     if($user){
                        $responseData = array('success' => '1', 'data'=>$user, 'message' => "Return user data.");
                     }else{
                        $responseData = array('success'=>'0','message'=>"No data found.");
                     }
                }else{
                  $responseData = array('success'=>'0','message'=>"Invalid api token.");   
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }

    public static function posTopup($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->member_id == '' || $request->amount == '' || $request->cashier_token == ''){
              $responseData = array('success'=>'0','message'=>"Required all fields."); 
           }else{
              $result=DB::table('users')->where(['member_id'=>$request->member_id,'role_id'=>'2','status'=>'1'])->first();
              if($result){
                  $cashier=DB::table('users')->where(['api_token'=>$request->cashier_token,'role_id'=>'14','status'=>'1'])->first();
                  if($cashier){
                        $date_added = date('y-m-d h:i:s');
                        $refno = uniqid();
                        DB::table('wallet')->insert([
                            'user_id'  =>  $result->id,
                            'wallet_type' => 'deposit',
                            'description' => 'Add Money to Wallet from Pos',
                            'payment_method' => 'pos',
                            'payment_id' => $refno,
                            'amount' => $request->amount,
                            'pay_status' => 'TXN_SUCCESS',
                            'status' => '2',
                            'payment_response' => 'Cashier direct topup on pos',
                            'transaction_id' => $cashier->id,
                            'created_at'=>  $date_added,
                            'updated_at'=>  $date_added
                        ]);
                        $newamount=$result->wallet_amount+$request->amount;
                        //update amount
                             DB::table('users')->where('id', $result->id)->update([
                                'wallet_amount'     => $newamount
                        ]);
                        $responseData = array('success' => '1', 'message' => "Topup credited successfully.",'amount'=>$newamount); 
                  }else{
                    $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
                  }
              }else{
                $responseData = array('success'=>'0','message'=>"Invalid api token.");
              }
           } 
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;  
    }

    public static function getDrawerCategory($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->type == '' ){ 
              $responseData = array('success'=>'0','message'=>"Required all fields.");
           }else{
             $cashier=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1'])->first();
             if($cashier){
                $result=DB::table('drawer_category')->where(['type'=>$request->type,'status'=>'1'])->get();
                if (!$result->isEmpty()) {
                    $responseData = array('success' => '1', 'data'=>$result);
                }else{
                    $responseData = array('success'=>'0','message'=>"No data found.");
                }
             }else{
                $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
             }
           }
        }else{
           $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");  
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function editAmount($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->id == '' || $request->price == '' || $request->session_id == '' || $request->cashier_token==''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cart=DB::table('customers_basket')->where('customers_basket_id', $request->id)->where('session_id', $request->session_id)->first();
                if($cart){
                    $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->cashier_token)->first();
                        if($cashier){
                             DB::table('customers_basket')->where('customers_basket_id', $request->id)->update([
                                'final_price'     => $request->price,
                            ]);
    
                             $responseData = array('success' => '1', 'message' => "New amount updated successfully.");
                        }else{
                            $responseData = array('success'=>'0','message'=>"Invalid cashier api token."); 
                        }
                }else{
                   $responseData = array('success'=>'0','message'=>"Invalid cart id."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function addPrinterUsb($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->printer_ip == '' || $request->printer_places_id == ''|| $request->api_token == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                   $printerarray=array();  $printerarray=explode(",",$request->printer_places_id);

                    foreach($printerarray as $jesprinter){
                        $result= DB::table('printer_ip')->where('printer_places_id', $jesprinter)->where('printer_ip', $request->printer_ip)->first();
                        if(empty($result)){
                            $list = DB::table('printer_ip')->insertGetId(
                                    [
                                        'cashier_id' =>$cashier->id,
                                        'type'=>'usb',
                                        'printer_places_id' => $jesprinter,
                                        'printer_ip' => $request->printer_ip,
                                        'status' => '1',
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                        }else{
                           $responseData = array('success'=>'0', 'message'=>"Printer ip already inserted");
                           $mediaResponse = json_encode($responseData);
                           return $mediaResponse;
                           break; 
                        }
                    }

                 $responseData = array('success'=>'1', 'message'=>"Printer added successfully"); 
             }else{
                $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
             }       
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function viewPrinterUsb($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_places')->where('status', '1')->get();
                    if(!empty($result)){
                        foreach ($result as $jesresult) {
                            $ip=DB::table('printer_ip')->where('printer_places_id', $jesresult->id)->where('cashier_id', $cashier->id)->where('type', 'usb')->get();
                            $dataall[]=array(
                                "id"=> $jesresult->id,
                                "printer_places"=>$jesresult->printer_places,
                                "status"=>$jesresult->status,
                                "ip_address"=>$ip
                            );
                        }
                        $responseData=array("success"=>"1","data"=>$dataall);
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"No data found"); 
                    }
                }else{
                    $responseData = array('success'=>'0', 'message'=>"Invalid api token.");
                }
            }     
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function updatePrinterUsb($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->update_id == '' || $request->status == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_ip')->where('id', $request->update_id)->where('cashier_id', $cashier->id)->first();
                    if($result){
                         DB::table('printer_ip')->where('id', '=', $request->update_id)->update([
                            'status' => $request->status,
                        ]);
                         $responseData = array('success'=>'1', 'message'=>"Printer updated successfully"); 
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"Invalid update id."); 
                    }
                }else{
                   $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public static function deletePrinterUsb($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
           if($request->api_token == '' || $request->delete_id == '' ){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
           } else {
                $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
                if($cashier){
                    $result = DB::table('printer_ip')->where('id', $request->delete_id)->where('cashier_id', $cashier->id)->first();
                    if($result){
                        $checkRecord = DB::table('printer_ip')->where([
                          'id' => $request->delete_id
                      ])->delete();
                       $responseData = array('success'=>'1', 'message'=>"Printer deleted successfully"); 
                    }else{
                       $responseData = array('success'=>'0', 'message'=>"Invalid delete id."); 
                    }
                }else{
                    $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
                }
           }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }
    public static function updateCustomerCart($request)
    {
        $consumer_data                       =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->api_token == '' || $request->customers_id == '' || $request->session_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all fields.");
            }else{
               $cashier=DB::table('users')->where('role_id', '14')->where('api_token', $request->api_token)->first();
               if($cashier){
                    $result = DB::table('customers_basket')->where('session_id', $request->session_id)->get();
                    if (!$result->isEmpty()) {
                        foreach ($result as $jesresult) {
                            DB::table('customers_basket')->where('customers_basket_id', '=', $jesresult->customers_basket_id)->update([
                                'customers_id' => $request->customers_id,
                            ]);
                        }
                        $responseData = array('success'=>'1', 'message'=>"Customer updated successfully"); 
                    }else{
                        $responseData = array('success'=>'0', 'message'=>"No data found");
                    }
               }else{
                    $responseData = array('success'=>'0', 'message'=>"Invalid api token."); 
               }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse; 
    }
}

?>