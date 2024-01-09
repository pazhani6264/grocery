<?php
namespace App\Models\AppModels;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Products;
use App\Models\Core\Setting;

use DB;
use Lang;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon\Carbon;
use Session;

class Cart extends Model{

	public static function addCart($request){

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
			if($request->products_id == '' || $request->quantity == '')
            {
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }
            else
            {
                $products_id=$request->products_id;
                if (empty($request->customers_id)) {
                    $customers_id = '';
                } else {
                    $customers_id = $request->customers_id;
                }

               
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

                if (empty($customers_id)) {

                    $exist = DB::table('customers_basket')->where([
                        ['products_id', '=', $products_id],
                        ['is_order', '=', 0],
                        ['serve_status', '=', 0],
                    ])->get();
                }else{
                    $exist = DB::table('customers_basket')->where([
                        ['customers_id', '=', $customers_id],
                        ['products_id', '=', $products_id],
                        ['is_order', '=', 0],
                        ['serve_status', '=', 0],
                    ])->get();
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
                $detail = $products->products($data);

                $result['detail'] = $detail;

                if ($result['detail']['product_data'][0]->products_type == 0) 
                {

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
                $final_weight = $result['detail']['product_data'][0]->products_weight;

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
                            $final_weight = $attribute->weight;
                            $special_price = $attribute->special_price;
                            if($result['detail']['product_data'][0]->is_special == 'yes')
                            {
                                $final_price = $special_price;
                            

                            }
                            else
                            {
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

                if ($request->customers_basket_id) 
                {
                    $basket_id = $request->customers_basket_id;
                    DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                    [
                        'customers_id' => $customers_id,
                        'products_id' => $products_id,
                        'customers_basket_quantity' => $customers_basket_quantity,
                        'final_price' => $final_price,
                        'weight' => $final_weight,
                        'customers_basket_date_added' => $customers_basket_date_added,
                    ]);

                    if (count($request->option_id) > 0) {
                        foreach ($request->option_id as $option_id) {

                            DB::table('customers_basket_attributes')->where([
                                ['customers_basket_id', '=', $basket_id],
                                ['products_id', '=', $products_id],
                                ['products_options_id', '=', $option_id],
                            ])->update(
                                [
                                    'customers_id' => $customers_id,
                                    'products_options_values_id' => $request->$option_id,
                                    
                                ]);
                        }

                    }
                } else {
                    //insert into cart
                    if (count($exist) == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'weight' => $final_weight,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => $discountprice,
                            ]);

                        if (!empty($request->option_id) && count($request->option_id) > 0) {
                            foreach ($request->option_id as $key => $option_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $option_id,
                                        'products_options_values_id' => $request->options_values_id[$key],
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } 
                        else if (!empty($detail['product_data'][0]->attributes)) 
                        {

                            foreach ($detail['product_data'][0]->attributes as $attribute) 
                            {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
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
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'weight' => $final_weight,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => $discountprice,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $key => $option_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $option_id,
                                        'products_options_values_id' => $request->options_values_id[$key],
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
                                        'weight' => $final_weight,
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                       
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
                                
                                'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $option_id) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_options_values_id' => $request->$option_id,
                                        
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
                            
                            'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                            'final_price' => $final_price,
                            'weight' => $final_weight,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }

		        }
        }
    
            $wordCount = DB::table('customers_basket')->where('customers_id', '=', $request->customers_id)->where('is_order', '=', '0')->count();
        	$responseData = array('success'=>'1','message'=>"Cart added successfully.",'count'=>$wordCount);
          //}
    }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function viewCart($request)
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
                'products.products_weight_unit as unit')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', $language_id);
        
            $cart->where('customers_basket.customers_id', '=',$request->customers_id);
        

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
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function deleteCart($request)
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


    public static function updateCart($request)
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

	public static function clearallCart($request)
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
			if($request->customer_id == '' ){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('customers_basket')->where('customers_id', '=',$request->customer_id)->get();

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

    public static function updateCartQuantity($request)
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
            if($request->customers_basket_id == '' || $request->api_token == '' || $request->quantity == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $user=DB::table('users')->where(['api_token'=>$request->api_token,'status'=>'1','role_id'=>'2'])->first();
                if($user){
                    $result = DB::table('customers_basket')->where('customers_basket_id', '=',$request->customers_basket_id)->where('customers_id', '=',$user->id)->first();
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
                        $responseData = array('success'=>'0', 'message'=>"Invalid customers basket id or customers id.");
                    }
                }else{
                    $responseData = array('success'=>'0','message'=>"Invalid api token.");
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