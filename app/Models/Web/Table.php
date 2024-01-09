<?php 
namespace App\Models\Web;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Products;
use App\Http\Controllers\App\AlertController;
use App\Http\Controllers\App\AppSettingController;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Lang;
use Session;

class Table extends Model
{
	public function place_order($request)
    {
    	$index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
    	$InventoryStatus = isset($result['commonContent']) ? $result['commonContent']['settings']['Inventory'] : '0';
    	//dd($InventoryStatus);
    	$cart = new Cart();
    	$result = array();
    	$cart_items = $cart->myCart($result);
    	$products_tax = 1;
        $total_amount= 0;
        $holdid=0;
        $tdate=date('Y-m-d');
        $authController = new AppSettingController();
        $guest = $authController->getGuestUser();

        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
            $orderid=session('table_qrcode');
        }else{
            $session_id = Session::getId();
            $orderid=Session::getId();
        }

        // add the hold table
            $qorder= DB::table('booking_table')->where('qrcode', '=', $session_id)->where('status', '=', 'checkin')->first();
            if($qorder){
                $holdCheck=DB::table('hold')->where(['table_id'=>$qorder->table_id,'session_id'=>$session_id])->first();
                if(empty($holdCheck)){
                        $hold = DB::table('hold')->insertGetId([
                                'note' => 'Web Table',
                                'total_amount' => $total_amount,
                                'hold_by' => $qorder->merchant_id,
                                'hold_status' => '1',
                                'table_id' => $qorder->table_id,
                                'table_name'=> $qorder->table_name,
                                'customer_id'=>$guest->id,
                                'created_at' =>date('Y-m-d h:i:s'),
                            ]);
                    $holdid=$hold;
                    $total_amount= 0;
                }else{
                    $holdid=$holdCheck->id;
                    $total_amount= $holdCheck->total_amount;
                }

            }

          
        
        foreach ($cart_items as $products) {

            $total_amount=$total_amount+$products->final_price * $products->customers_basket_quantity;

        	$orders_products_id = DB::table('orders_products')->insertGetId(
                    [
                        'orders_id' => $orderid,
                        'products_id' => $products->products_id,
                        'products_name' => $products->products_name,
                        'products_model' => $products->model,
                        'products_price' => $products->original_price,
                        'final_price' => $products->original_price * $products->customers_basket_quantity,
                        'products_tax' => $products_tax,
                        'products_quantity' => $products->customers_basket_quantity,
                    ]
                );

        	if ($InventoryStatus === '1') {

                $productData = DB::table('products')
                    ->where('products_status', '1')
                    ->where('products_id', $products->products_id)
                    ->first();

                    if($productData->products_type == 3){

                        $productComboData = DB::table('product_combo')
                        ->where('status', '1')
                        ->where('pro_id', $products->products_id)
                        ->get();
                        foreach($productComboData as $proComData){

                            $inventory_ref_id = DB::table('inventory')->insertGetId([
                                'products_id' => $proComData->product_id,
                                'reference_code' => $orderid,
                                'orders_products_id' => $orders_products_id,
                                'stock' => $proComData->qty * $products->customers_basket_quantity,
                                'admin_id' => 0,
                                'created_at' => date('Y-m-d h:i:s'),
                                'added_date' => time(),
                                'purchase_price' => 0,
                                'stock_type' => 'out',
                            ]);

                            $attributes = DB::table('product_combo')
                            ->leftjoin('products_options', 'product_combo.attractive_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_attributes', 'products_attributes.options_id', '=', 'products_options.products_options_id')
                            ->select('products_options.products_options_name as attribute_name','products_options_values.products_options_values_name as attribute_value','products_attributes.products_attributes_id as products_attributes_id','products_attributes.price_prefix','products_attributes.options_values_price')
                            ->where('product_combo.product_id', $proComData->product_id)
                            ->where('products_options.products_options_id', $proComData->attractive_id)
                            ->where('products_options_values.products_options_values_id', $proComData->option_id)
                            ->get();

                            if (!empty($attributes) and count($attributes) > 0) {
                                foreach ($attributes as $attribute) {
                                    DB::table('orders_products_attributes')->insert(
                                        [
                                            'orders_id' => $orderid,
                                            'products_id' => $proComData->product_id,
                                            'orders_products_id' => $orders_products_id,
                                            'products_options' => $attribute->attribute_name,
                                            'products_options_values' => $attribute->attribute_value,
                                            'options_values_price' => $attribute->options_values_price,
                                            'price_prefix' => $attribute->price_prefix,
                                        ]
                                    );
                                }

                                $prodocuts_attributes = DB::table('products_attributes')
                                ->where('products_id', $proComData->product_id)
                                ->where('options_id', $proComData->attractive_id)
                                ->where('options_values_id', $proComData->option_id)
                                ->select('products_attributes_id','products_id')
                                ->get();

                                if (!empty($prodocuts_attributes) and count($prodocuts_attributes) > 0) {
                                    foreach($prodocuts_attributes as $proattr){
                                        if ($InventoryStatus === '1') {
                                            DB::table('inventory_detail')->insert([
                                                'inventory_ref_id' => $inventory_ref_id,
                                                'products_id' => $proattr->products_id,
                                                'attribute_id' =>  $proattr->products_attributes_id,
                                            ]);
                                        }
                                    }
                                }
                            }

                        }

                    } else if($productData->products_type == 4){

                        $productBuyData = DB::table('product_buy_x')
                        ->where('status', '1')
                        ->where('pro_id', $products->products_id)
                        ->get();
                        foreach($productBuyData as $proBuyData){

                            $inventory_ref_id = DB::table('inventory')->insertGetId([
                                'products_id' => $proBuyData->product_id,
                                'reference_code' => $orderid,
                                'orders_products_id' => $orders_products_id,
                                'stock' => $proBuyData->qty * $products->customers_basket_quantity,
                                'admin_id' => 0,
                                'created_at' => date('Y-m-d h:i:s'),
                                'added_date' => time(),
                                'purchase_price' => 0,
                                'stock_type' => 'out',
                            ]);

                            $attributes = DB::table('product_buy_x')
                            ->leftjoin('products_options', 'product_buy_x.attractive_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_attributes', 'products_attributes.options_id', '=', 'products_options.products_options_id')
                            ->select('products_options.products_options_name as attribute_name','products_options_values.products_options_values_name as attribute_value','products_attributes.products_attributes_id as products_attributes_id','products_attributes.price_prefix','products_attributes.options_values_price')
                            ->where('product_buy_x.product_id', $proBuyData->product_id)
                            ->where('products_options.products_options_id', $proBuyData->attractive_id)
                            ->where('products_options_values.products_options_values_id', $proBuyData->option_id)
                            ->get();

                            if (!empty($attributes) and count($attributes) > 0) {
                                foreach ($attributes as $attribute) {
                                    DB::table('orders_products_attributes')->insert(
                                        [
                                            'orders_id' => $orderid,
                                            'products_id' => $proBuyData->product_id,
                                            'orders_products_id' => $orders_products_id,
                                            'products_options' => $attribute->attribute_name,
                                            'products_options_values' => $attribute->attribute_value,
                                            'options_values_price' => $attribute->options_values_price,
                                            'price_prefix' => $attribute->price_prefix,
                                        ]
                                    );
                                }
                                if ($InventoryStatus === '1') {
                                    DB::table('inventory_detail')->insert([
                                        'inventory_ref_id' => $inventory_ref_id,
                                        'products_id' => $proBuyData->product_id,
                                        'attribute_id' => $attribute->products_attributes_id,
                                    ]);
                                }
                            }

                        }

                        $productGetData = DB::table('product_get_x')
                        ->where('status', '1')
                        ->where('pro_id', $products->products_id)
                        ->get();
                        foreach($productGetData as $proGetData){

                            $inventory_ref_id = DB::table('inventory')->insertGetId([
                                'products_id' => $proGetData->product_id,
                                'reference_code' => $orderid,
                                'orders_products_id' => $orders_products_id,
                                'stock' => $proGetData->qty * $products->customers_basket_quantity,
                                'admin_id' => 0,
                                'created_at' => date('Y-m-d h:i:s'),
                                'added_date' => time(),
                                'purchase_price' => 0,
                                'stock_type' => 'out',
                            ]);

                            $attributes = DB::table('product_get_x')
                            ->leftjoin('products_options', 'product_get_x.attractive_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                            ->leftjoin('products_attributes', 'products_attributes.options_id', '=', 'products_options.products_options_id')
                            ->select('products_options.products_options_name as attribute_name','products_options_values.products_options_values_name as attribute_value','products_attributes.products_attributes_id as products_attributes_id','products_attributes.price_prefix','products_attributes.options_values_price')
                            ->where('product_get_x.product_id', $proGetData->product_id)
                            ->where('products_options.products_options_id', $proGetData->attractive_id)
                            ->where('products_options_values.products_options_values_id', $proGetData->option_id)
                            ->get();

                            if (!empty($attributes) and count($attributes) > 0) {
                                foreach ($attributes as $attribute) {
                                    DB::table('orders_products_attributes')->insert(
                                        [
                                            'orders_id' => $orderid,
                                            'products_id' => $proGetData->product_id,
                                            'orders_products_id' => $orders_products_id,
                                            'products_options' => $attribute->attribute_name,
                                            'products_options_values' => $attribute->attribute_value,
                                            'options_values_price' => $attribute->options_values_price,
                                            'price_prefix' => $attribute->price_prefix,
                                        ]
                                    );
                                }
                                if ($InventoryStatus === '1') {
                                    DB::table('inventory_detail')->insert([
                                        'inventory_ref_id' => $inventory_ref_id,
                                        'products_id' => $proGetData->product_id,
                                        'attribute_id' => $attribute->products_attributes_id,
                                    ]);
                                }
                            }

                        }
                        
                    }else {
                        $inventory_ref_id = DB::table('inventory')->insertGetId([
                            'products_id' => $products->products_id,
                            'reference_code' => $orderid,
                            'orders_products_id' => $orders_products_id,
                            'stock' => $products->customers_basket_quantity,
                            'admin_id' => 0,
                            'created_at' => date('Y-m-d h:i:s'),
                            'added_date' => time(),
                            'purchase_price' => 0,
                            'stock_type' => 'out',
                        ]);
                    }


                        
               

                        
            }


            if (!empty($products->attributes) and count($products->attributes) > 0) {



                foreach ($products->attributes as $attribute) {
                    DB::table('orders_products_attributes')->insert(
                        [
                            'orders_id' => $orderid,
                            'products_id' => $products->products_id,
                            'orders_products_id' => $orders_products_id,
                            'products_options' => $attribute->attribute_name,
                            'products_options_values' => $attribute->attribute_value,
                            'options_values_price' => $attribute->values_price,
                            'price_prefix' => $attribute->prefix,
                        ]
                    );
                }
                if ($InventoryStatus === '1') {
                        DB::table('inventory_detail')->insert([
                            'inventory_ref_id' => $inventory_ref_id,
                            'products_id' => $products->products_id,
                            'attribute_id' => $attribute->products_attributes_id,
                        ]);
                }
            }

            DB::table('customers_basket')->where('session_id', $session_id)->where('products_id', $products->products_id)->update(['is_order' => '1','order_status' => '1','hold_id' => $holdid,'hold_status' => '1']);
        }

        if($qorder){
            DB::table('hold')->where('id', $holdid)->update(['total_amount' => $total_amount]);
        }

             //notification/email
                $myVar = new AlertController();
             $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id')
          ->where('users.role_id', '=', '14')->where('users.status', '=', '1')->where('users.outlet', '=', $qorder->outletid)->get();
          if(!$cashier->isEmpty()){
            foreach ($cashier as $jescashier) {
                $token=$jescashier->device_id;
                $title='New Order';
                $message='New order has been placed';
                $myVar->sendNotificationsCashier($token,$title,$message);
            }
          }

          echo 'success';
    }

    public function detail()
    {
    	$orderid=session('table_qrcode');
    	$ordersData = array();       
        $subtotal  = 0;
    	$order = DB::table('booking_table')
            ->where('qrcode', '=', $orderid)
            ->select('booking_table.*')
            ->get();
       foreach ($order as $data) { 
         $orders_id = $data->id;

      

    	 $orders_products = DB::table('customers_basket')
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
                ->select('customers_basket.*','products.*', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image', 'products_description.products_name as products_name')
                ->where('products_description.language_id', '=', 1)
                ->where('customers_basket.order_status', '=', 1)
                ->where('customers_basket.session_id', '=', $orderid)->get();
        $i = 0;
        $total_price = 0;
        $total_tax = 0;
        $product = array();
        $subtotal = 0;

        //print_r($orders_products);die();

        foreach ($orders_products as $orders_products_data) {

            $product_attribute = DB::table('customers_basket_attributes')
            ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
            ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
            ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
            ->leftjoin('products_attributes', function ($join) {
                $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
            })
            ->select('products_options_descriptions.options_name as products_options', 'products_options_values_descriptions.options_values_name as products_options_values', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

            ->where('customers_basket_attributes.products_id', '=', $orders_products_data->products_id)
            ->where('customers_basket_id', '=', $orders_products_data->customers_basket_id)
            ->where('products_options_descriptions.language_id', '=',  1)
            ->where('products_options_values_descriptions.language_id', '=',  1)->get();

               

                $orders_products_data->attribute = $product_attribute;
                $product[$i] = $orders_products_data;
                $total_price = $total_price + ($orders_products[$i]->final_price * $orders_products[$i]->customers_basket_quantity);

                $subtotal += ($orders_products[$i]->original_price * $orders_products[$i]->customers_basket_quantity);

                $i++;
            }

        $data->data = $product;
        $orders_data[] = $data;
    }

        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['subtotal'] = $subtotal;

        return $ordersData;
    }

    public function add_payment($request)
    {

        $payment_method = session('payment_method');
        $orderid=session('table_qrcode');

        //print_r($payment_method);die();

        $orders_products_id = DB::table('table_payment')->insertGetId([
                        'amount' => $request->amount,
                        'payment_method' => $payment_method,
                        'payment_response' => $payment_method,
                        'payment_status' => 'TXN_SUCCESS',
                        'status' => '2',
                        'book_id' => $orderid,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]
                );
        // update table booking
        DB::table('booking_table')->where('qrcode', $orderid)->update([
            'checkout_date' => date('Y-m-d h:i:s'),
            'status'=>'checkout'
        ]);
    }

    public function getallcard($session_id)
    {

       
       $cart = DB::table('customers_basket')
           ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
           ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
           ->LeftJoin('image_categories', function ($join) {
               $join->on('image_categories.image_id', '=', 'products.products_image')
                   ->where(function ($query) {
                       $query->where('image_categories.image_type', '=', 'ACTUAL')
                           ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                           ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                   });
           })
           ->select('customers_basket.*',
               'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products.products_model as model',
               'products.products_type as products_type', 'products.products_min_order as min_order', 'products.products_max_stock as max_order',
               'products.products_image as image', 'products_description.products_name as products_name', 'products.products_price as price',
                'products.products_weight_unit as unit', 'products.products_slug','customers_basket_quantity as quantity','products.button_type')
           ->where([
               ['customers_basket.order_status', '=', '0'],
               ['products_description.language_id', '=', 1],
           ]);

 
           $cart->where('customers_basket.session_id', '=',  $session_id);
   
    

       $baskit = $cart->get();
       $total_carts = count($baskit);
       $result = array();
       $index = 0;
       if ($total_carts > 0) {
           foreach ($baskit as $cart_data) {
               $attribute_price = 0; 
               $attributes_price_values = DB::table('customers_basket_attributes')
                    ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                    ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                    ->leftjoin('products_attributes', function ($join) {
                        $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                    })
                    ->select('products_attributes.options_values_price as attr_price')

                    ->where('customers_basket_attributes.products_id', '=', $cart_data->products_id)
                    ->where('customers_basket_id', '=', $cart_data->customers_basket_id)->get();

                    foreach($attributes_price_values as $attributes_price_value){
                        $attribute_price = $attribute_price+$attributes_price_value->attr_price;
                    }
               $product = new Products;
               $isFlash = $product->getFlashSale($cart_data->products_id);
               
               
               if (!empty($isFlash) and count($isFlash) > 0) {
                   $data = array('page_number' => '0', 'type' =>'flashsale', 'products_id' =>$cart_data->products_id, 'limit' => 15, 'min_price' => '', 'max_price' => '');
                   $detail = $product->products($data);
                   DB::table('customers_basket')->where('customers_basket_id' , $cart_data->customers_basket_id)->where('products_id',$cart_data->products_id)->update(
                       [ 'final_price' => $detail['product_data'][0]->flash_price+$attribute_price ]
                   );
               } else {
                   $data = array('page_number' => '0', 'type' =>'', 'products_id' =>$cart_data->products_id, 'limit' => 15, 'min_price' => '', 'max_price' => '');
                   $detail = $product->products($data);
                   
                   if(isset($detail['product_data'][0]->discount_price) AND $detail['product_data'][0]->discount_price != Null){
                      /*  DB::table('customers_basket')->where('customers_basket_id' , $cart_data->customers_basket_id)->where('products_id',$cart_data->products_id)->update(
                           [ 'final_price' => $detail['product_data'][0]->discount_price+$attribute_price ]
                       ); */
                   }
                   // else{
                   //     print_r($attribute_price);die();
                   //     DB::table('customers_basket2')->where('customers_basket_id' , $cart_data->customers_basket_id)->where('products_id',$cart_data->products_id)->update(
                   //         [ 'final_price' => $detail['product_data'][0]->products_price+$attribute_price ]
                   //     );
                   // }
               }
               //products_image
               $default_images = DB::table('image_categories')
                   ->where('image_id', '=', $cart_data->image)
                   ->where('image_type', 'ACTUAL')
                   ->first();

               if ($default_images) {
                   $cart_data->image_path = $default_images->path;
               } else {
                   $default_images = DB::table('image_categories')
                       ->where('image_id', '=', $cart_data->image)
                       ->where('image_type', 'ACTUAL')
                       ->first();

                   if ($default_images) {
                       $cart_data->image_path = $default_images->path;
                   } else {
                       $default_images = DB::table('image_categories')
                           ->where('image_id', '=', $cart_data->image)
                           ->where('image_type', 'ACTUAL')
                           ->first();
                       $cart_data->image_path = $default_images->path;
                   }

               }

               //categories
               $categories = DB::table('products_to_categories')
                   ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                   ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                   ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                   ->where('products_id', '=', $cart_data->products_id)
                   ->where('categories_description.language_id', '=', 1)->get();
               if (!empty($categories) and count($categories) > 0) {
                   $cart_data->categories = $categories;
               } else {
                   $cart_data->categories = array();
               }
               array_push($result, $cart_data);

               //default product
               $stocks = 0;
               if ($cart_data->products_type == '0') {

                   $currentStocks = DB::table('inventory')->where('products_id', $cart_data->products_id)->get();
                   if (count($currentStocks) > 0) {
                       foreach ($currentStocks as $currentStock) {
                           $stocks += $currentStock->stock;
                       }
                   }

                   if (!empty($cart_data->max_order) and $cart_data->max_order != 0) {
                       if ($cart_data->max_order >= $stocks) {
                          // $result[$index]->max_order = $stocks;
                       }
                   } else {
                    //   $result[$index]->max_order = $stocks;
                   }
                   $index++;

               } else {

                   $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })
                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $cart_data->products_id)
                       ->where('customers_basket_id', '=', $cart_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=', 1)
                       ->where('products_options_values_descriptions.language_id', '=', 1);

                   if (empty(session('customers_id'))) {
                       $attributes->where('customers_basket_attributes.session_id', '=',  $session_id);
                   } else {
                       $attributes->where('customers_basket_attributes.customers_id', '=', session('customers_id'));
                   }

                   $attributes_data = $attributes->get();

                   //if($index==0){
                   $products_attributes_id = array();
                   //}

                   foreach ($attributes_data as $attributes_datas) {
                       if ($cart_data->products_type == '1') {
                           $products_attributes_id[] = $attributes_datas->products_attributes_id;

                       }

                   }
                   $myVar = new Products();

                   $qunatity['products_id'] = $cart_data->products_id;
                   $qunatity['attributes'] = $products_attributes_id;

                   $content = $myVar->productQuantity($qunatity);
                   $stocks = $content['remainingStock'];
                   if (!empty($cart_data->max_order) and $cart_data->max_order != 0) {
                       if ($cart_data->max_order >= $stocks) {
                        //   $result[$index]->max_order = $stocks;
                       }
                   } else {
                      // $result[$index]->max_order = $stocks;
                   }

                   $result[$index]->attributes_id = $products_attributes_id;

                   $result2 = array();
                   if (!empty($cart_data->coupon_id)) {
                       //coupon
                       $coupons = explode(',', $cart_data->coupon_id);
                       $index2 = 0;
                       foreach ($coupons as $coupons_data) {
                           $coupons = DB::table('coupons')->where('coupans_id', '=', $coupons_data)->get();
                           $result2[$index2++] = $coupons[0];
                       }

                   }

                   $result[$index]->coupons = $result2;
                   $result[$index]->attributes = $attributes_data;
                   $index++;
               }
           }
       }
       return ($result);
          
}

public function categories()
    {
        $items = DB::table('categories')
            ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id')
            ->where('categories_description.language_id', '=', 1)
            ->where('categories.categories_status', 1)
            ->groupBy('categories.categories_id')
            ->orderBy('categories.CategoryOrder', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->categories_id])) {
                    $item->childs = $childs[$item->categories_id];
                }
            }

            $tree = $childs[0];
            return $tree;
        }
    }


       //products
       public function products($data)
       {
   
         
           if (empty($data['page_number']) or $data['page_number'] == 0) {
               $skip = $data['page_number'] . '0';
           } else {
               $skip = $data['limit'] * $data['page_number'];
           }
   
           $min_price = $data['min_price'];
           $max_price = $data['max_price'];
           $take = $data['limit'];
           $currentDate = time();
           $type = $data['type'];
           $index = new Index();
           $result['commonContent'] = $index->commonContent();
          
    
           if ($type == "atoz") {
               $sortby = "products_name";
               $order = "ASC";
           } elseif ($type == "ztoa") {
               $sortby = "products_name";
               $order = "DESC";
           } elseif ($type == "hightolow") {
               $sortby = "products_filter_price";
               $order = "DESC";
           } elseif ($type == "lowtohigh") {
               $sortby = "products_filter_price";
               $order = "ASC";
           } elseif ($type == "topseller") {
               $sortby = "products_ordered";
               $order = "DESC";
           } elseif ($type == "mostliked") {
               $sortby = "products_liked";
               $order = "DESC";
   
           } 
           elseif ($type == "collection") {
               $sortby = "collections_product.product_id";
               $order = "DESC";
   
           }elseif ($type == "special") {
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
               $sortby = "collections_product.product_id";
               $order = "desc";
               }
               else
               {
                   $sortby = "specials.products_id";
                   $order = "desc";
               }
           } elseif ($type == "flashsale") { //flashsale products
               $sortby = "flash_sale.flash_start_date";
               $order = "asc";
           } else {
               $sortby = "products.products_id";
               $order = "desc";
           }
   
           if(!empty(Session::get('language_id'))){
               $language_id=Session::get('language_id');
           }else{
               $language_id='1';
           }
   
           $filterProducts = array();
           $eliminateRecord = array();
   
           $categories = DB::table('products')
               ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
               ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
               ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
               ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id');
   
           if (!empty($data['categories_id'])) {
               $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                   ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                   ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id');
           }
           if (!empty($data['collection_id'])) {
             
               $categories->LeftJoin('collections_product', 'products.products_id', '=', 'collections_product.product_id')
                   ->leftJoin('collections', 'collections.id', '=', 'collections_product.collection_id')
                   ->LeftJoin('collections_description', 'collections_description.collections_id', '=', 'collections_product.collection_id');
           }
          
   
          
           //parameter special
           
   
   
           if (!empty($data['filters']) and empty($data['search'])) {
               $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id');
           }
   
           if (!empty($data['search'])) {
               $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
                   ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                   ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id');
           }
           //wishlist customer id
         
           if ($type == "wishlist") {
               $categories->LeftJoin('liked_products', 'liked_products.liked_products_id', '=', 'products.products_id')
                   ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url');
                   $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                   ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price'); 
           }
   
           elseif ($type == "topseller") {
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
                       $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                       $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                           $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                       })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
               }
               else
               {
                   $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                       $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                   })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
               }
           }
           elseif ($type == "mostliked") {
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
                       $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                       $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                           $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                       })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
               }
               else
               {
                   $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                       $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                   })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
               }
           }
   
           elseif ($type == "special") {
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
                       $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                       $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                           $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                       })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
               }
               else
               {
   
                   $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                   ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price'); 
               }
           }
   
   
        elseif ($type == "flashsale") {
               //flash sale
               $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                   ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as flash_price');
   
           } elseif ($type == "compare") {
               //flash sale
               $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                   ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as discount_price');
                   $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                       $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                   })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
   
           } else {
               $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                   $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
               })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
           }
   
           if ($type == "special") {
             
   
   
               if($result['commonContent']['settings']['collection_product'] == '1')
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
   
           } elseif ($type != "flashsale" && $type != "compare"){
               $nonflashsale = DB::table('flash_sale')->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate)->pluck('products_id');
               if(count($nonflashsale) > 0)
                   $categories->whereNotIn('products.products_id', $nonflashsale);
           }
           // elseif ($type != "compare") {
           //     $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
           //         $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
           //     });
   
           // }
   
           //get single products
           if (!empty($data['products_id']) && $data['products_id'] != "") {
               $categories->where('products.products_id', '=', $data['products_id']);
           }
   
           //for min and maximum price
           if (!empty($max_price)) {
   
               if (!empty($max_price)) {
                   //check session contain default currency
                   $current_currency = DB::table('currencies')->where('id', session('currency_id'))->first();
                   if($current_currency->is_default == 0){
                       $max_price = $max_price / session('currency_value');
                       $min_price = $min_price / session('currency_value');
                   }
       
               }
   
               $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
           }
   
        
   
   
           if (!empty($data['search'])) {
   
               $searchValue = $data['search'];
               
               $categories->where('products_options.products_options_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
   
               if (!empty($data['categories_id'])) {
                   $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
               }
   
               if (!empty($data['collection_id'])) {
                   $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                   $categories->where('collections_product.status', 1);
               }
   
               
               if (!empty($data['filters'])) {
                   $temp_key = 0;
                   foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
   
                     
   
                       if ($temp_key == 0) {
   
                           $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
   
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       } else {
                           $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
   
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       }
                       $temp_key++;
                   }
   
               }
   
               if (!empty($max_price)) {
                   $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
               }
               $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                   $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
               });
               $categories->orWhere('products_options_values.products_options_values_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
               if (!empty($data['categories_id'])) {
                   $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
               }
               if (!empty($data['collection_id'])) {
                   $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                   $categories->where('collections_product.status', 1);
               }
   
               if (!empty($data['filters'])) {
                   $temp_key = 0;
                   foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
   
                       if ($temp_key == 0) {
   
                           $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
   
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       } else {
                           $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
   
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       }
                       $temp_key++;
                   }
   
               }
   
               if (!empty($max_price)) {
                   $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
               }
   
               $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                   $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
               });
   
               $categories->orWhere('products_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
   
               if (!empty($data['categories_id'])) {
                   $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
               }
               if (!empty($data['collection_id'])) {
                   $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                   $categories->where('collections_product.status', 1);
               }
   
               if (!empty($data['filters'])) {
                   $temp_key = 0;
                   foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
   
                       if ($temp_key == 0) {
   
                           $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
   
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       } else {
                           $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
   
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       }
                       $temp_key++;
                   }
   
               }
   
               if (!empty($max_price)) {
                   $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
               }
   
               $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                   $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
               });
   
               $categories->orWhere('products_model', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
   
               if (!empty($data['categories_id'])) {
                   $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
               }
               if (!empty($data['collection_id'])) {
                   $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                   $categories->where('collections_product.status', 1);
               }
   
               if (!empty($data['filters'])) {
                   $temp_key = 0;
                   foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
   
                       if ($temp_key == 0) {
   
                           $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
   
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       } else {
                           $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                               ->where('products_attributes.options_values_id', $option_id_temp);
   
                           if (count($data['filters']['filter_attribute']['options']) > 1) {
                               $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                           }
   
                       }
                       $temp_key++;
                   }
   
               }
               $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                   $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
               });
           }
   
        
   
           if (!empty($data['filters'])) {
               $temp_key = 0;
               
               $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                   ->whereIn('products_attributes.options_values_id',[$data['filters']['option_value']]);
           }
   
           //wishlist customer id
           if ($type == "wishlist") {
               $categories->where('liked_customers_id', '=', session('customers_id'));
           }
   
           if ($type == "collection") {
               $categories->where('collection_id', '>', 4);
           }
   
           //wishlist customer id
           if ($type == "is_feature") {
               $categories->where('products.is_feature', '=', 1);
           }
           if(!empty($data['brand'])){
               $brand = $data['brand'];
               $brand = DB::table('manufacturers')->where('manufacturer_name',$brand)->first();
               if($brand)
                   $categories->where('products.manufacturers_id', '=', $brand->manufacturers_id);
           }
           $categories->where('products_description.language_id', '=', $language_id)->where('products_status', '=', 1);
   
           //get single category products
           if (!empty($data['categories_id'])) {
               $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
               $categories->where('categories.categories_status', '=', 1);
               $categories->where('categories_description.language_id', '=', $language_id);
           }else{
               $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id');
                   // ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id');
               $categories->whereIn('products_to_categories.categories_id', function ($query) use ($currentDate) {
                   $query->select('categories_id')->from('categories')->where('categories.categories_status',1);
               });
           }
   
           if (!empty($data['collection_id'])) {
               $categories->where('collections_product.collection_id', '=', $data['collection_id']);
               $categories->where('collections.status', '=', 1);
               $categories->where('collections_description.language_id', '=', $language_id);
               $categories->where('collections_product.status', 1);
           }
   
           if ($type == "topseller") {
             
   
   
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
                   $categories->where('collections_product.collection_id', 1);
                   $categories->where('collections_product.status', 1);
               }
               else
               {
               $categories->where('products.products_ordered', '>', 0);
               }
           }
   
           if ($type == "mostliked") {
             
   
   
               if($result['commonContent']['settings']['collection_product'] == '1')
               {
                   $categories->where('collections_product.collection_id', 3);
                   $categories->where('collections_product.status', 1);
               }
               else
               {
               $categories->where('products.products_liked', '>', 0);
               }
           }
   
   
           $categories->where('products.products_status', 1);
        
           $categories->orderBy($sortby, $order)->groupBy('products.products_id');
   
           //count
           $total_record = $categories->get();
           $products = $categories->skip($skip)->take($take)->get();
   
           $result = array();
           $result2 = array();
   
           //check if record exist
           if (count($products) > 0) {
   
               $index = 0;
               foreach ($products as $products_data) {
   
                   $reviews = DB::table('reviews')
                       ->leftjoin('users', 'users.id', '=', 'reviews.customers_id')
                       ->leftjoin('reviews_description', 'reviews.reviews_id', '=', 'reviews_description.review_id')
                       ->select('reviews.*', 'reviews_description.reviews_text')
                       ->where('products_id', $products_data->products_id)
                       ->where('reviews_status', '1')
                       ->where('reviews_read', '1')
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
                   $products_id = $products_data->products_id;
   
                   //products_image
                   $default_images = DB::table('image_categories')
                       ->where('image_id', '=', $products_data->products_image)
                       ->where('image_type', 'ACTUAL')
                       ->first();
   
                   if ($default_images) {
                       $products_data->image_path = $default_images->path;
                       $products_data->image_path_type = $default_images->path_type;
                   } else {
                       $default_images = DB::table('image_categories')
                           ->where('image_id', '=', $products_data->products_image)
                           ->where('image_type', 'ACTUAL')
                           ->first();
   
                       if ($default_images) {
                           $products_data->image_path = $default_images->path;
                           $products_data->image_path_type = $default_images->path_type;
                       } else {
                           $default_images = DB::table('image_categories')
                               ->where('image_id', '=', $products_data->products_image)
                               ->where('image_type', 'ACTUAL')
                               ->first();
                           $products_data->image_path = $default_images->path;
                           $products_data->image_path_type = $default_images->path_type;
                       }
   
                   }
   
                   $default_images = DB::table('image_categories')
                       ->where('image_id', '=', $products_data->products_image)
                       ->where('image_type', 'ACTUAL')
                       ->first();
                   if ($default_images) {
                       $products_data->default_images = $default_images->path;
                       $products_data->default_images_path_type = $default_images->path_type;
                   } else {
                       $default_images = DB::table('image_categories')
                           ->where('image_type', 'ACTUAL')
                           ->where('image_id', '=', $products_data->products_image)
                           ->first();
                       if ($default_images) {
                           $products_data->default_images = $default_images->path;
                           $products_data->default_images_path_type = $default_images->path_type;
                       }
                   }
   
                   //multiple images
                   $products_images = DB::table('products_images')
                       ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')
                       ->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                       ->where('products_id', '=', $products_id)
                       ->orderBy('sort_order', 'ASC')
                       ->get();
   
                   $products_data->images = $products_images;
   
                    //multiple video
                    $products_video = DB::table('product_video')
                    ->LeftJoin('image_categories', 'product_video.image_id', '=', 'image_categories.image_id')
                    ->select('product_video.*','image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                    ->where('product_id', '=', $products_id)
                    ->orderBy('sort_order', 'ASC')
                    ->get();
   
                $products_data->multivideo = $products_video;
   
                   $default_image_thumb = DB::table('products')
                       ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
                       ->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                       ->where('products_id', '=', $products_id)
                       ->where('image_type', '=', 'ACTUAL')
                       ->first();
                   if ($default_image_thumb) {
                       $products_data->default_thumb = $default_image_thumb->image_path;
                       $products_data->default_thumb_image_path_type = $default_image_thumb->image_path_type;
                   } else {
                       $products_data->default_thumb = $products_data->default_images;
                       $products_data->default_thumb_image_path_type = $products_data->image_path_type;
                   }
   
                   //categories
                   $categories = DB::table('products_to_categories')
                       ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                       ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                       ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id', 'categories.categories_slug', 'categories.categories_status')
                       ->where('products_id', '=', $products_id)
                       ->where('categories_description.language_id', '=', $language_id)
                       ->where('categories.categories_status', 1)
                       ->orderby('parent_id', 'ASC')->get();
   
                   $products_data->categories = $categories;
                   array_push($result, $products_data);
   
                   $options = array();
                   $attr = array();
   
                   $stocks = 0;
                   $stockOut = 0;
                   if ($products_data->products_type == '0') {
                       $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                       $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                   }
   
                   $result[$index]->defaultStock = $stocks - $stockOut;
   
                   //like product
                   if (!empty(session('customers_id'))) {
                       $liked_customers_id = session('customers_id');
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
                   if (count($products_attribute)) {
                       $index2 = 0;
                       foreach ($products_attribute as $attribute_data) {
   
                           $option_name = DB::table('products_options')
                               ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
   
                           if (count($option_name) > 0) {
   
                               $temp = array();
                               $temp_option['id'] = $attribute_data->options_id;
                               $temp_option['name'] = $option_name[0]->products_options_name;
                               $temp_option['is_default'] = $attribute_data->is_default;
                               $temp_option['options_required'] = $option_name[0]->options_required;
                               $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                               $attr[$index2]['option'] = $temp_option;
   
                               // fetch all attributes add join from products_options_values table for option value name
                               $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                               $k = 0;
                               foreach ($attributes_value_query as $products_option_value) {
   
                                   $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values_descriptions.language_id', '=', $language_id)->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();
   
                                   $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
   
                                 
   
                                   $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                   $temp_i['id'] = $products_option_value->options_values_id;
                                   $temp_i['value'] = $option_value[0]->products_options_values_name;
                                   $temp_i['price'] = $products_option_value->options_values_price;
                                   $temp_i['price_prefix'] = $products_option_value->price_prefix;
                                   $temp_i['is_default'] = $products_option_value->is_default;
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
               $responseData = array('success' => '1', 'product_data' => $result, 'message' => Lang::get('website.Returned all products'), 'total_record' => count($total_record));
   
           } else {
               $responseData = array('success' => '0', 'product_data' => $result, 'message' => Lang::get('website.Empty record'), 'total_record' => count($total_record));
           }
   
           return ($responseData);
       }


       public function placeatcounter($request)
       {
           $index = new Index();
           $result = array();
           $result['commonContent'] = $index->commonContent();
           $InventoryStatus = isset($result['commonContent']) ? $result['commonContent']['settings']['Inventory'] : '0';
           //dd($InventoryStatus);
           $cart = new Cart();
           $result = array();
           $cart_items = $cart->myCart($result);
           $products_tax = 1;
           $total_amount= 0;
           $holdid=0;
           $tdate=date('Y-m-d');
           $authController = new AppSettingController();
           $guest = $authController->getGuestUser();
   
           if(!empty(session('table_qrcode'))){
               $session_id = session('table_qrcode');
               $orderid=session('table_qrcode');
           }else{
               $session_id = Session::getId();
               $orderid=Session::getId();
           }
           $payment_method = session('payment_method');
           $orderid=session('table_qrcode');
   
           //print_r($payment_method);die();
           $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

           $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();
   
      
           $order_price = $price->total_amount;
          

   
           $orders_products_id = DB::table('table_payment')->insertGetId([
                           'amount' => $order_price,
                           'payment_method' => 'Cash on Delivery',
                           'payment_response' => 'Cash on Delivery',
                           'payment_status' => 'TXN_SUCCESS',
                           'status' => '2',
                           'book_id' => $orderid,
                           'created_at' => date('Y-m-d h:i:s'),
                           'updated_at' => date('Y-m-d h:i:s')
                       ]
                   );

   
           // add the hold table
               $qorder= DB::table('booking_table')->where('qrcode', '=', $session_id)->where('status', '=', 'checkin')->first();
   
             
   
               foreach ($cart_items as $products) {
   
          
              
                   DB::table('customers_basket')->where('session_id', $session_id)->where('products_id', $products->products_id)->update(['hold_status' => '2']);
               }
       
               if($qorder){
                   DB::table('hold')->where('session_id', $session_id)->update(['hold_status' => 2]);
               }
               
   
       
   
   
                //notification/email
                   $myVar = new AlertController();
                $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id')
             ->where('users.role_id', '=', '14')->where('users.status', '=', '1')->where('users.outlet', '=', $qorder->outletid)->get();
             if(!$cashier->isEmpty()){
               foreach ($cashier as $jescashier) {
                   $token=$jescashier->device_id;
                   $title='Pay at Counter';
                   $message='New order has been placed';
                   $myVar->sendNotificationsCashier($token,$title,$message);
               }
             }
   
             echo 'success';
       }

       public function get_country_code()
       {
           $data = DB::table('countries')->get();
           return $data;
       }


       public function sendotp_login($phone,$otpresult,$country_code,$customerid,$app_name)
       {
           $date = date('y-m-d h:i:s');
           DB::table('otp')->where('otp_status', 5)->where('phone', $phone)->delete();
           // insert otp
                         DB::table('otp')->insert([
                           'user_id' => $customerid,
                           'phone' => $phone,
                           'otp_no' => $otpresult,
                           'otp_status' => 5,
                           'ccode' => $country_code,
                           'created_at' => $date,
                       ]);
           $this->sendotp($phone,$otpresult,$country_code,$app_name);
       }

       public function sendotp($phone,$otp,$ccode,$app_name)
       {
          
           
           $cdate = date('Y-m-d');
         
           $exit_user = DB::table('otp')->where('phone', $phone)->first();
           $user_ip = $this->get_client_ip();
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

           $id = "ACd86651fa77a74d1d4e7dd95c8d4e2cd9";
           $token = "8826557f52a9448d1cf0660e08f8094d";
           $url = "https://api.twilio.com/2010-04-01/Accounts/".$id."/Messages.json";
           $msid = "MGa04bc174832558d72526e6bbd25951fd"; 
           $from = "+12179608969";
           //$to = "+601127350684"; // twilio trial verified 
           $to = $ccode.$phone; // twilio trial verified number
           $body = $app_name. " : OTP requested to verify your account. OTP:".$otp.". Do not Share with anyone";
           $data = array (
               'From' => $from,
               'To' => '+'.$to,
               'Body' => $body,
               'MessagingServiceSid' => $msid,
           );
           $post = http_build_query($data);
           $x = curl_init($url );
           curl_setopt($x, CURLOPT_POST, true);
           curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
           curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
           curl_setopt($x, CURLOPT_POSTFIELDS, $post);
           $y = curl_exec($x);
           curl_close($x);
           //print_r($y);die();
           // var_dump($post);
           // var_dump($y);
   
       }
       }
       public function get_client_ip() {
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

}
?>