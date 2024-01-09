<?php

namespace App\Models\Web;

use App\Models\Core\Categories;
use App\Models\Web\Index;
use App\Models\Web\Products;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Session;

class Cart extends Model
{
    //mycart
   public function myCart($baskit_id)
   {

    if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
        }else{
            $session_id = Session::getId();
        }
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
               ['customers_basket.is_order', '=', '0'],
               ['products_description.language_id', '=', Session::get('language_id')],
           ]);

       if (empty(session('customers_id'))) {
           $cart->where('customers_basket.session_id', '=',  $session_id);
       } else {
           $cart->where('customers_basket.customers_id', '=', session('customers_id'));
       }

       if (!empty($baskit_id)) {
           $cart->where('customers_basket.customers_basket_id', '=', $baskit_id);
       }

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
                   ->where('categories_description.language_id', '=', Session::get('language_id'))->get();
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
                       ->where('products_options_descriptions.language_id', '=', Session::get('language_id'))
                       ->where('products_options_values_descriptions.language_id', '=', Session::get('language_id'));

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
    //getCart
    public function cart($request)
    {
        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
        }else{
            $session_id = Session::getId();
        }

        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->leftJoin('price_by_currency', 'products.products_id', '=', 'price_by_currency.product_id')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
            ->leftJoin('currencies', 'price_by_currency.currency_id', '=', 'currencies.id')
            ->select('currencies.symbol_left as currency_symbol_left', 'currencies.symbol_right as currency_symbol_right', 'price_by_currency.price as price', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'customers_basket.*', 'products.products_model as model', 'products.products_image as image', 'products_description.products_name as products_name', 'products.products_quantity as quantity', 'products.products_price as price', 'products.products_weight_unit as unit')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', Session::get('language_id'));

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', $session_id);
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->groupBy('customers_basket.products_id')->get();

        

        return ($baskit);

    }

    public function editcart($request)
    {
        $index = new Index();
        $products = new Products();
        $result = array();
        $data = array();
        $baskit_id = $request->id;
        //category
        $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')->where('products_to_categories.products_id', $result['cart'][0]->products_id)->where('categories.parent_id', 0)->where('language_id', Session::get('language_id'))->get();

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')->where('products_to_categories.products_id', $result['cart'][0]->products_id)->where('categories.parent_id', '>', 0)->where('language_id', Session::get('language_id'))->get();

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = DB::table('flash_sale')->where('products_id', $result['cart'][0]->products_id)
            ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
            ->get();

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $result['cart'][0]->products_id, 'limit' => '1', 'min_price' => '', 'max_price' => '');
        $detail = $products->products($data);
        $result['detail'] = $detail;

        $i = 0;
        foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
            if ($i == 0) {
                $postCategoryId = $postCategory->categories_id;
                $i++;
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => '15', 'min_price' => '', 'max_price' => '');
        $simliar_products = $products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $products->likedProducts();
        return $result;
    }

    public function deleteCart($request)
    {
        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
        }else{
            $session_id = Session::getId();
        }

        session(['out_of_stock' => 0]);
        $baskit_id = $request->id;

        DB::table('customers_basket')->where([
            ['customers_basket_id', '=', $baskit_id],
        ])->delete();

        DB::table('customers_basket_attributes')->where([
            ['customers_basket_id', '=', $baskit_id],
        ])->delete();
        $check = DB::table('customers_basket')
            ->where('customers_basket.session_id', '=', $session_id)
            ->first();
        return $check;

    }

    public function cartIdArray($request)
    {

        $cart = DB::table('customers_basket')->where('customers_basket.is_order', '=', '0');

        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
        }else{
            $session_id = Session::getId();
        }

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', $session_id);
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->get();

        $result = array();
        $index = 0;
        foreach ($baskit as $baskit_data) {
            $result[$index++] = $baskit_data->products_id;
        }

        return ($result);

    }

    public function updatesinglecart($request)
    {
        $index = new Index();
        $products = new Products();
        $products_id = $request->products_id;
        $basket_id = $request->cart_id;

        if (empty(session('customers_id'))) {
            $customers_id = '';
        } else {
            $customers_id = session('customers_id');
        }

        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');

        }else{
            $session_id = Session::getId();
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

        $data = array('page_number' => '0', 'type' => '', 'products_id' => $products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);

        $detail = $products->products($data);
        //price is not default
        $final_price = $request->products_price;
        //quantity is not default
        $customers_basket_quantity = $request->quantity;

        $parms = array(
            'customers_id' => $customers_id,
            'products_id' => $products_id,
            'session_id' => $session_id,
            'customers_basket_quantity' => $customers_basket_quantity,
            'final_price' => $final_price,
            'customers_basket_date_added' => $customers_basket_date_added,
        );
        //update into cart
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
            foreach ($request->option_id as $option_id) {

                DB::table('customers_basket_attributes')->where([
                    ['customers_basket_id', '=', $basket_id],
                    ['products_id', '=', $products_id],
                    ['products_options_id', '=', $option_id],
                ])->update(
                    [
                        'customers_id' => $customers_id,
                        'products_options_values_id' => $request->$option_id,
                        'session_id' => $session_id,
                    ]);
            }

        }
        //apply coupon
        if (count(session('coupon')) > 0) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            $response = array();
            if (!empty($session_coupon_data)) {
                foreach ($session_coupon_data as $key => $session_coupon) {
                    $response = $this->common_apply_coupon($session_coupon->code);
                }
            }
        }
        $result['commonContent'] = $index->commonContent();
        return $result;
    }

    public function addToCart($request)
    {
        $index = new Index();
        $products = new Products();

        $products_id = $request->products_id;

        if (empty(session('customers_id'))) {
            $user = DB::table('users')->where('user_name','guest_user')->where('role_id', '2')->first();
             if($user){
                $customers_id = $user->id;
             }else{
                $customers_id = '';
             }
            
        } else {
            $customers_id = session('customers_id');
        }

        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
            $source='table';
        }else{
            $session_id = Session::getId();
             $source='normal';
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
                ['session_id', '=', $session_id],
                ['products_id', '=', $products_id],
                ['is_order', '=', 0],
                ['serve_status', '=', 0],
            ])->get();

        } else {

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

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $request->products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
        $detail = $products->products($data);
        $result['detail'] = $detail;

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

                if ($count > $default_stock) {

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

        if ($request->customers_basket_id) {
            $basket_id = $request->customers_basket_id;
            DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                [
                    'customers_id' => $customers_id,
                    'products_id' => $products_id,
                    'session_id' => $session_id,
                    'customers_basket_quantity' => $customers_basket_quantity,
                    'weight' => $final_weight,
                    'final_price' => $final_price,
                    'customers_basket_date_added' => $customers_basket_date_added,
                ]);

                if (!empty($request->option_id) && count($request->option_id) > 0) {
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
                        'weight' => $final_weight,
                        'customers_basket_date_added' => $customers_basket_date_added,
                        'order_source' => $source,
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
                                'weight' => $final_weight,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => $source,
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
                            'weight' => $final_weight,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }
                //apply coupon
                if (count(session('coupon')) > 0) {
                    $session_coupon_data = session('coupon');
                    session(['coupon' => array()]);
                    $response = array();
                    if (!empty($session_coupon_data)) {
                        foreach ($session_coupon_data as $key => $session_coupon) {
                            $response = $this->common_apply_coupon($session_coupon->code);
                        }
                    }
                }

            }
        }
        $result['commonContent'] = $index->commonContent();
        return $result;
    }

    public function common_apply_coupon($coupon_code)
    {
        
        $date = date('y-m-d H:i:s');
        $customers_id = session('customers_id');
        $currency = Session::get('symbol_left') ? Session::get('symbol_left') : Session::get('symbol_right');
            // dd($currency);
        $currency_value = DB::table('currencies')->where('symbol_right',$currency)->orwhere('symbol_left',$currency)->first();
        $currency_value = $currency_value ? $currency_value->value : 1 ;
        $result = array();
        
        //current date
        $currentDate = date('Y-m-d 00:00:00', time());

        $data = DB::table('coupons')->where([
            ['code', '=', $coupon_code],
            ['expiry_date', '>', $currentDate],
        ]);
        $coupons = $data->get();
        //print_r(session('applied_id'));die();
        if(!empty(session('applied_id'))){
          if(session('applied_id')!= $coupons[0]->coupans_id){
            session(['coupon' => array()]);
            session(['coupon_discount' => 0]);
            session(['applied_id' => '']);
          }
        }

        if (session('coupon') == '' or count(session('coupon')) == 0) {
            session(['coupon' => array()]);
            session(['coupon_discount' => 0]);
        }

        $session_coupon_ids = array();
        $session_coupon_data = array();
        if (!empty(session('coupon'))) {
            foreach (session('coupon') as $session_coupon) {
                array_push($session_coupon_data, $session_coupon);
                $session_coupon_ids[] = $session_coupon->coupans_id;

            }
        }

        
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

        if (count($coupons) > 0) {

            if (!empty(auth()->guard('customer')->user()->email) and in_array(auth()->guard('customer')->user()->email, explode(',', $coupons[0]->email_restrictions))) {
                $response = array('success' => '2', 'message' => Lang::get("website.You are not allowed to use this coupon"));
            } else {
                if ($coupons[0]->usage_limit > 0 and $coupons[0]->usage_limit == $usedcouponcount) {
                    $response = array('success' => '2', 'message' => Lang::get("website.This coupon has been reached to its maximum usage limit"));
                } else if($coupons[0]->usage_limit_per_user == $usedcouponcount_limit and !empty($coupons[0]->usage_limit_per_user)) {
                     $response = array('success' => '2', 'message' => Lang::get("website.This coupon has been reached to its maximum usage limit"));
                }else{

                    $carts = $this->myCart(array());

                    $total_cart_items = count($carts);
                    $price = 0;
                    $discount_price = 0;
                    $used_by_user = 0;
                    $individual_use = 0;
                    $price_of_sales_product = 0;
                    $exclude_sale_items = array();
                    $currentDate = time();
                    
                    foreach ($carts as $cart) {
                        //user limit
                        if (in_array($coupons[0]->coupans_id, $session_coupon_ids)) {
                            $used_by_user++;
                        }

                        //cart price
                        $price += $cart->final_price * $cart->customers_basket_quantity;

                    }

                    

                        //check limit
                        if ($coupons[0]->usage_limit_per_user > 0 and $coupons[0]->usage_limit_per_user <= $used_by_user) {
                            $response = array('success' => '2', 'message' => Lang::get("website.coupon is used limit"));
                        } else {

                            $cart_price = $price + 0 - $discount_price;

                            if ($coupons[0]->minimum_amount*$currency_value > 0 and $coupons[0]->minimum_amount >= $cart_price) {
                                $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount limit is low than minimum price"));
                            } else {

                                //exclude sales item
                                //print 'price before applying sales cart price: '.$cart_price;
                                $cart_price = $cart_price - $price_of_sales_product;
                                //print 'current cart price: '.$cart_price;
                                    if ($coupons[0]->discount_type == 'fixed_cart') {

                                        if ($coupons[0]->amount < $cart_price) {

                                            $coupon_discount = $coupons[0]->amount;
                                            $coupon[] = $coupons[0];

                                        } else {
                                            $coupon_discount = $price;
                                            $coupon[] = $coupons[0];
                                            //$response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than total price"));
                                        }

                                    } elseif ($coupons[0]->discount_type == 'percent') {
                                        $current_discount = $coupons[0]->amount / 100 * $cart_price;
                                        $cart_price = $cart_price - $current_discount;
                                        if ($cart_price > 0) {
                                          if(!empty($coupons[0]->cap_amount)){
                                            if($current_discount < $coupons[0]->cap_amount){
                                                $coupon_discount = $current_discount;
                                                $coupon[] = $coupons[0];
                                           }else{
                                              $coupon_discount = $coupons[0]->cap_amount;
                                                $coupon[] = $coupons[0];
                                           }
                                         }else{
                                            $coupon_discount = $current_discount;
                                                $coupon[] = $coupons[0];
                                         }
                                         //print_r($coupon_discount);die();

                                        } else {
                                            $coupon_discount = $price;
                                            $coupon[] = $coupons[0];
                                            //$response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than total price"));
                                        }

                                    } elseif($coupons[0]->discount_type == 'point'){
                                       
                                       $cdata = DB::table('users')->where('id', $customers_id)->first();
                                       if($coupons[0]->points <= $cdata->loyalty_points){
                                          $current_discount=$coupons[0]->amount;
                                          $cart_price = $cart_price - $current_discount;
                                            if ($cart_price > 0) {
                                                 $coupon_discount = $current_discount;
                                                 $coupon[] = $coupons[0];
                                            }else{
                                              $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than total price"));
                                            }
                                       }else{
                                        $response = array('success' => '2', 'message' => Lang::get("website.insufficient_loyalty_points"));
                                       }

                                    } 
                                

                            }

                        }

                   

                }
            }
            
            if(empty($response)){
                if (!in_array($coupons[0]->coupans_id, $session_coupon_ids)) {

                    if (count($session_coupon_data) > 0) {
                        $index = count($session_coupon_data);
                    } else {
                        $index = 0;
                    }
                    $session_coupon_data[$index] = $coupons[0];
                    $customers_id = session('customers_id');
                    session(['coupon_discount' => session('coupon_discount') + $coupon_discount]);
                    session(['applied_id' => $coupons[0]->coupans_id]);
                    $response = array('success' => '1', 'message' => Lang::get("website.Couponisappliedsuccessfully"));
    
                } else {
                    $response = array('success' => '0', 'message' => Lang::get("website.Coupon is already applied"));
                }
    
                session(['coupon' => $session_coupon_data]);
            }
           

        } else {

            $response = array('success' => '0', 'message' => Lang::get("website.Coupon does not exist"));
        }

        return $response;

    }

    public function updateRecord($customers_basket_id, $customers_id, $session_id, $quantity)
    {
        $result = DB::table('customers_basket_attributes')->where('customers_basket_id', '=',$customers_basket_id)->orderBy('customers_basket_attributes_id', 'DESC')->first();
        if ($result){
             $attdata = DB::table('products_attributes')->where(['products_id'=>$result->products_id,'options_id'=>$result->products_options_id,'options_values_id'=>$result->products_options_values_id])->first();
            $totalqnt = $quantity * $attdata->quantity_count;
        }else{
           $basket = DB::table('customers_basket')->where('customers_basket_id', '=',$customers_basket_id)->first();
           $product = DB::table('products')->where('products_id', '=',$basket->products_id)->first();
           $totalqnt = $quantity * $product->quantity_count;
        }

        DB::table('customers_basket')->where('customers_basket_id', '=', $customers_basket_id)->update(
            [
                'customers_id' => $customers_id,
                'session_id' => $session_id,
                'customers_basket_quantity' => $quantity,
                'total_basket_quantity' => $totalqnt, 
            ]);
    }
    public function my_redeem_point()
    {
        $redeem = DB::table('redeem_points_settings')
                       ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->select('redeem_points_settings.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
                        ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
                        ->where('redeem_points_settings.status', 1)
                        ->groupBy('redeem_points_settings.id')
                         ->get();
       return $redeem;
    }
    public function my_redeem_point_active()
    {
         $customers_id = session('customers_id');
        $redeem = DB::table('redeem_points_voucher')
              ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
              ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
              ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
              ->select('redeem_points_settings.*','image_categories.path_type as image_path_type', 'image_categories.path as image_path','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description','redeem_points_voucher.id as redeem_id')
              ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
              ->where('redeem_points_voucher.user_id', $customers_id)
              ->where('image_categories.image_type', '=', 'ACTUAL')
              ->where('redeem_points_voucher.status', 0)
              ->orderby('redeem_points_voucher.id', 'DESC')
              ->get();
          return $redeem;
    }
    public function my_redeem_coupon()
    {
             $currentDate = date('Y-m-d');
              $items=DB::table('coupons')
            ->leftJoin('image_categories', 'coupons.image', '=', 'image_categories.image_id')
             ->select('coupons.*', 'image_categories.path_type as image_path_type','image_categories.path as image_path')
             ->whereIn('coupons.discount_type', ['percent', 'fixed_cart'])
             ->where('coupons.coupans_type', 'internal')
             ->whereDate('expiry_date','>=',$currentDate)
             ->groupBy('coupons.coupans_id')
             ->get();
             return $items;
    }

    public function my_user_data($customers_id)
    {
        $user_data = DB::table('users')->where('id', $customers_id)->first();
         return $user_data;
    }

    public function common_apply_redeem_point($id)
    {
        //print_r(session('transaction_id'));die();
        $carts = $this->myCart(array());
        $customers_id = session('customers_id');
        $price = 0;
        $point=DB::table('redeem_points_settings')->where('id', $id)->first();

        $check='';

         if(!empty(session('points_discount'))){
              $check_amount = session('points_discount');
          }else{
              $check_amount = '0';
          }

        foreach ($carts as $cart) {
          //cart price
          $price += ($cart->final_price * $cart->customers_basket_quantity)-$check_amount;
        }

        if($check){
            return 'already';
        }else{
           
                $date_added = date('Y-m-d H:i:s');
                  //old transcation date delete
                  if(!empty(session('transaction_id'))){
                    $old=DB::table('transaction_points')->where('user_id', $customers_id)->where('id', session('transaction_id'))->where('status', '0')->first();
                  if($old){
                    $cdata = DB::table('users')->where('id', $customers_id)->first();
                     $new=$cdata->loyalty_points+$old->points;
                     //print_r($new);die();
                     // update user table
                            DB::table('users')->where('id', $customers_id)->update([
                                'loyalty_points' => $new,
                            ]);
                     // detete old trancation date
                    DB::table('transaction_points')->where('id', session('transaction_id'))->delete();
                    DB::table('temp_point_transaction')->where('trans_id', session('transaction_id'))->delete();
                  }
                }
                 $userdata = DB::table('users')->where('id', $customers_id)->first();
                 $oldbalnce=$userdata->loyalty_points;
                 $newbalnce=$userdata->loyalty_points-$point->points;

                  if($point->no_rm < $price){
                    $new_dis_amount= $point->no_rm;
                  }else{
                    $new_dis_amount= $price;
                  }

                    if ($point->discount_type == 'fixed_cart') {
                        $discount_amount = $new_dis_amount;
                    }elseif ($point->discount_type == 'percent') {
                        $dis_amount = $point->no_rm / 100 *  $price;
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
                    //print_r($discount_amount);die();

                 //insert point details
                            $trns_id=DB::table('transaction_points')->insertGetId([
                                'user_id' => $customers_id,
                                'order_id'=> '0',
                                'loyalty_id'=>$point->id,
                                'points' => $point->points,
                                'balance_points' => $newbalnce,
                                'points_status' => 'out',
                                'description'=>'Apply point coupon',
                                'created_at' => $date_added,
                                'updated_at' => $date_added
                            ]);
                            session(['transaction_id' => $trns_id]);
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
                            // update user table
                            DB::table('users')->where('id', $customers_id)->update([
                                'loyalty_points' => $newbalnce,
                            ]);

                   
                            $amount = $discount_amount;

                          session(['points_discount' => $amount]);
                          

             return 'success';
           // }else{
           //    return 'failure';
           // }
      }
    }


    public function qtyredeempoints($id)
    {
       
        $carts = $this->myCart(array());
        $customers_id = session('customers_id');
        $price = 0;
        $redeem=DB::table('redeem_points_voucher')->where('id', $id)->first();

        $point=DB::table('redeem_points_settings')->where('id', $redeem->redeem_id)->first();

        //print_r($point);die();

        if(!empty(session('points_discount'))){
              $check_amount = session('points_discount');
          }else{
              $check_amount = '0';
          }

          foreach ($carts as $cart) {
          //cart price
          $price += ($cart->final_price * $cart->customers_basket_quantity);
          }

          if($point->no_rm < $price){
                    $new_dis_amount= $point->no_rm;
                  }else{
                    $new_dis_amount= $price;
                  }

                    if ($point->discount_type == 'fixed_cart') {
                        $discount_amount = $new_dis_amount;
                    }elseif ($point->discount_type == 'percent') {
                        $dis_amount = $point->no_rm / 100 *  $price;
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

                    // update
                     /*  DB::table('redeem_points_voucher')->where('id',$id)->update([
                            'status' => '1',
                        ]); */

                   $amount = $discount_amount;
                  session(['transaction_id' => $id]);
                  session(['defaultstatus' => 1]);
                  session(['points_discount' => $amount]);
                  return 'success'; 
    }

    public function redeempoints($id)
    {
       
        if(session('defaultstatus') == 1){
            return 'already'; 
        }
        else
        {

        $carts = $this->myCart(array());
        $customers_id = session('customers_id');
        $price = 0;
        $redeem=DB::table('redeem_points_voucher')->where('id', $id)->first();

        $point=DB::table('redeem_points_settings')->where('id', $redeem->redeem_id)->first();

        //print_r($point);die();

        if(!empty(session('points_discount'))){
              $check_amount = session('points_discount');
          }else{
              $check_amount = '0';
          }

          foreach ($carts as $cart) {
          //cart price
          $price += ($cart->final_price * $cart->customers_basket_quantity)-$check_amount;
          }

          if($point->no_rm < $price){
                    $new_dis_amount= $point->no_rm;
                  }else{
                    $new_dis_amount= $price;
                  }

                    if ($point->discount_type == 'fixed_cart') {
                        $discount_amount = $new_dis_amount;
                    }elseif ($point->discount_type == 'percent') {
                        $dis_amount = $point->no_rm / 100 *  $price;
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

                    // update
                     /*  DB::table('redeem_points_voucher')->where('id',$id)->update([
                            'status' => '1',
                        ]); */

                   $amount = $discount_amount;
                  session(['transaction_id' => $id]);
                  session(['defaultstatus' => 1]);
                  session(['points_discount' => $amount]);
                  return 'success'; 
                   
        }
    }


    public function delete_points_discount($request)
   {
      $temp = DB::table('temp_point_transaction')->where('user_id', '=', session('customers_id'))->get();
      //print_r($temp);die();
            if(!empty($temp)){
                foreach ($temp as $jestemp) {
                    $cdata = DB::table('users')->where('id', session('customers_id'))->first();
                    $trans = DB::table('transaction_points')->where('id', $jestemp->trans_id)->first();
                    if($trans){
                    $newbalnce=$cdata->loyalty_points+$trans->points;
                    // update user table
                        DB::table('users')->where('id', session('customers_id'))->update([
                            'loyalty_points' => $newbalnce,
                        ]);
                    //delete transaction_points table
                      DB::table('transaction_points')->where([['id', '=', $jestemp->trans_id]])->delete();
                    //delete temp_point_transaction table 
                     DB::table('temp_point_transaction')->where([['id', '=', $jestemp->id]])->delete(); 
                   }else{
                    //delete temp_point_transaction table 
                     DB::table('temp_point_transaction')->where([['id', '=', $jestemp->id]])->delete(); 
                   }
                }
            }
            session(['points_discount' => '']);
   }

   public function generateRandomString($len) 
   {
        $length = $len;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
      return $randomString;
  }

  public function addRedeempoint($request)
  {
     $customers_id = session('customers_id');
     $date_added = date('Y-m-d H:i:s');
     $code=$this->generateRandomString('5');

     $userdata = DB::table('users')->where('id', $customers_id)->first();
     $point=DB::table('redeem_points_settings')->where('id', $request->redeem_id)->first();

     //print_r($code);die();
     $check = DB::table('redeem_points_voucher')->where('redeem_id',$request->redeem_id)->where('user_id',$customers_id)->where('status','0')->first();
   
       if($userdata->loyalty_points >= $point->points){

       //user point reeduce
       $oldbalnce=$userdata->loyalty_points;
       $newbalnce=$userdata->loyalty_points-$point->points;

       //insert point details
     $trns_id=DB::table('transaction_points')->insertGetId([
           'user_id' => $customers_id,
           'order_id'=> '0',
           'loyalty_id'=>$point->id,
           'points' => $point->points,
           'balance_points' => $newbalnce,
           'points_status' => 'out',
           'description'=>'Apply point coupon',
           'status'=>'1',
           'created_at' => $date_added,
           'updated_at' => $date_added
         ]);

     DB::table('temp_point_transaction')->insert([
             'trans_id' => $trns_id,
             'loyalty_id'=> $point->id,
             'user_id'=> $customers_id,
             'created_at' => $date_added
     ]);

   // update user table
       DB::table('users')->where('id', $customers_id)->update([
           'loyalty_points' => $newbalnce,
       ]);

       $trns_id=DB::table('redeem_points_voucher')->insertGetId([
             'redeem_id' => $request->redeem_id,
             'user_id'=> $customers_id,
             'code'=>$code,
             'status' => '0',
             'created_at' => $date_added,
             'updated_at' => $date_added
           ]);


          $redeem = DB::table('redeem_points_voucher')
             ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
             ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
             ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
             ->select('redeem_points_settings.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description','redeem_points_voucher.id as voucher_id', 'redeem_points_voucher.created_at as voucher_date','image_categories.image_id')
             ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
             ->where('redeem_points_voucher.user_id', session('customers_id'))
             ->where('redeem_points_voucher.status', 0)
             ->where('image_categories.image_type', '=', 'ACTUAL')
             ->orderBy('redeem_points_voucher.id', 'DESC')
             ->get();
            
            
         return $redeem;
     }else{
         return 'invaild_amount';
     }
  }


   public function viewReward($request)
   {
        $customers_id = session('customers_id');
        $reedem_id = $request->redeem_id;

        $redeem = DB::table('redeem_points_voucher')
        ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
        ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
        ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
        ->select('redeem_points_settings.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description','redeem_points_voucher.id as voucher_id', 'redeem_points_voucher.created_at as voucher_date','redeem_points_voucher.code as voucher_code','image_categories.image_id')
        ->where('redeem_points_description.language_id', '=', Session::get('language_id'))
        ->where('redeem_points_voucher.id', $reedem_id)
        ->where('image_categories.image_type', '=', 'ACTUAL')
        ->orderBy('redeem_points_voucher.id', 'DESC')
        ->get();
        return $redeem;
     
   }
   
}
