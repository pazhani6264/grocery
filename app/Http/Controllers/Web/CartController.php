<?php
namespace App\Http\Controllers\Web;

//use Mail;
//validator is builtin class in laravel
use App\Models\Web\Cart;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Products;
use App\Models\Web\Table;
//for authenitcate login data
use Carbon;
use DB;
//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Lang;
use Session;

class CartController extends Controller
{

    public function __construct(
        Index $index,
        Products $products,
        Cart $cart,
        Table $table
    ) {
        $this->index = $index;
        $this->products = $products;
        $this->cart = $cart;
        $this->table = $table;
        $this->theme = new ThemeController();

    }

    //myCart
    public function viewcart(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.View Cart"));
        $result = array();
        $data = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();

        $result['cart'] = $this->cart->myCart($data);

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => '', 'limit' => 4, 'min_price' => '', 'max_price' => '');
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;
        $carts = '';
             $result['cartArray'] = $this->products->cartIdArray($carts);

            if($result['commonContent']['settings']['voucher_redeem']=='0'){
                $redeem=$this->cart->my_redeem_point_active();
            }else{
               $redeem=$this->cart->my_redeem_point();  
            }
       

        $items=$this->cart->my_redeem_coupon();
        $customers_id = session('customers_id');
        $user_data=$this->cart->my_user_data($customers_id);
        //print_r($items);die();
        //apply coupon
        if (session('coupon')) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            $response = array();
            if (!empty($session_coupon_data)) {
                foreach ($session_coupon_data as $key => $session_coupon) {
                    $response = $this->cart->common_apply_coupon($session_coupon->code);
                }
            }
        }
        return view("web.carts.viewcart", ['title' => $title, 'final_theme' => $final_theme,'redeem'=>$redeem,'user_data'=>$user_data,'items'=>$items])->with('result', $result);
    }

    // web order cart
    public function orderviewcart(Request $request)
    {
         $title = array('pageTitle' => Lang::get("website.View Cart"));
        $result = array();
        $data = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();

        $result['cart'] = $this->cart->myCart($data);

            if($result['commonContent']['settings']['voucher_redeem']=='0'){
                $redeem=$this->cart->my_redeem_point_active();
            }else{
               $redeem=$this->cart->my_redeem_point();  
            }
       

        $items=$this->cart->my_redeem_coupon();
        $customers_id = session('customers_id');
        $user_data=$this->cart->my_user_data($customers_id);
        //print_r($items);die();
        //apply coupon
        if (session('coupon')) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            $response = array();
            if (!empty($session_coupon_data)) {
                foreach ($session_coupon_data as $key => $session_coupon) {
                    $response = $this->cart->common_apply_coupon($session_coupon->code);
                }
            }
        }
        return view("web.carts.webviewcart", ['title' => $title, 'final_theme' => $final_theme,'redeem'=>$redeem,'user_data'=>$user_data,'items'=>$items])->with('result', $result);
    }

    //eidtCart
    public function editcart(Request $request, $id, $slug)
    {

        $title = array('pageTitle' => Lang::get('website.Product Detail'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
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

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsBySlug($slug);

        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category)) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

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

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;

        $i = 0;
        foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
            if ($i == 0) {
                $postCategoryId = $postCategory->categories_id;
                $i++;
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();

        $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $top_seller = $this->products->products($data);
        $result['top_seller'] = $top_seller;

        $result['cart'] = $this->cart->myCart($id);

        return view("web.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }

    //deleteCart
    public function deleteCart(Request $request)
    {

        $result['commonContent'] = $this->index->commonContent();
        $check = $this->cart->deleteCart($request);
        //apply coupon
        if (!empty(session('coupon')) and count(session('coupon')) > 0) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            if (count($session_coupon_data) == '2') {
                $response = array();
                if (!empty($session_coupon_data)) {
                    foreach ($session_coupon_data as $key => $session_coupon) {
                        $response = $this->cart->common_apply_coupon($session_coupon->code);
                    }
                }
            }
        }
        if(!empty(session('points_discount') && $result['commonContent']['settings']['voucher_redeem']=='1')){
            $check = $this->cart->delete_points_discount($request);   
        }else{
            $red_id=session('transaction_id');
             // update user table
            DB::table('redeem_points_voucher')->where('id', $red_id)->update([
                'status' => '0',
            ]);

            session(['points_discount' => '']);
            session(['transaction_id' => '']);
        }

        if (!empty($request->type) and $request->type == 'header cart') {
            $result['commonContent'] = $this->index->commonContent();
            if (empty($check)) {
                $message = Lang::get("website.Cart item has been deleted successfully");
                return redirect('/')->with('message', $message);

            } else {
                $message = Lang::get("website.Cart item has been deleted successfully");
                $final_theme = $this->index->finalTheme();
                return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
            }
        } else {
            if (empty($check)) {
                $message = Lang::get("website.Cart item has been deleted successfully");
                return redirect('/')->with('message', $message);

            } else {
                $message = Lang::get("website.Cart item has been deleted successfully");
                return redirect()->back()->with('message', $message);
            }
        }
    }

    //getCart
    public function cartIdArray($request)
    {
        $this->cart->cartIdArray($request);
    }

    //updatesinglecart
    public function updatesinglecart(Request $request)
    {
        $this->cart->updatesinglecart($request);
        $final_theme = $this->index->finalTheme();
        return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
    }

    //addToCart
    public function addToCart(Request $request)
    {
        $result = $this->cart->addToCart($request);
        if (!empty($result['status']) && $result['status'] == 'exceed') {
            return $result;
        }
        
        $final_theme = $this->index->finalTheme();
        // if(!empty(session('table_qrcode'))){
        //    return view("web.headers.cartButtons.webordercartbutton")->with('result', $result);
        // }else{
            if($final_theme->header == '46')
            {
                return view("web.headers.cartButtons.cartButton19")->with('result', $result);
            }
            else
            {
                return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
            }
            
        // }
        
    }


    public function addToCarttable(Request $request)
    {
        $index = new Index();
        $products = new Products();

        $cid = session('table_qrcode');

        if($request->products_type == 1)
        {


        $option_id_array = $request->option_id;
     

        $attributeid_array = $request->attributeid;
      

        $option_name_array = $request->option_name;
        

        $options_values_id_array = $request->options_values_id;
        
        }
    
   
          $products_id=$request->products_id;
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

        $session_id = session('table_qrcode');
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

        }else{

            $exist = DB::table('customers_basket')->where([
                ['session_id', '=', $session_id],
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
          $detail = $this->table->products($data);
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


$attribute_price = 0;
if (!empty($attributeid_array) and count($attributeid_array) > 0) {

    foreach ($attributeid_array as $attribute) {
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
$qunatity['attributes'] = $attributeid_array;

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

    

if (count($option_id_array) > 0) {
    foreach ($option_id_array as $key => $option_id) {

        DB::table('customers_basket_attributes')->where([
            ['customers_basket_id', '=', $basket_id],
            ['products_id', '=', $products_id],
            ['products_options_id', '=', $option_id],
        ])->update(
            [
                'customers_id' => $customers_id,
                'products_options_values_id' => $options_values_id_array[$key],
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
            'order_source' => 'table',
            'discount_price' => $discountprice,
        ]);

    if (!empty($option_id_array) && count($option_id_array) > 0) {
        foreach ($option_id_array as $key => $option_id) {

            DB::table('customers_basket_attributes')->insert(
                [
                    'customers_id' => $customers_id,
                    'products_id' => $products_id,
                    'products_options_id' => $option_id,
                    'products_options_values_id' => $options_values_id_array[$key],
                    'session_id' => $session_id,
                    'customers_basket_id' => $customers_basket_id,
                ]);

        $attdata = DB::table('products_attributes')->where(['products_id'=>$products_id,'options_id'=>$option_id,'options_values_id'=>$options_values_id_array[$key]])->first();
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

    if (!empty($option_id_array)) {
        if (count($option_id_array) > 0) {

            foreach ($exist as $exists) {
                $totalAttribute = '0';
                foreach ($option_id_array as $key => $option_id) {
                    $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                        ['customers_basket_id', '=', $exists->customers_basket_id],
                        ['products_id', '=', $products_id],
                        ['products_options_id', '=', $option_id],
                        ['customers_id', '=', $customers_id],
                        ['products_options_values_id', '=', $options_values_id_array[$key]],
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
                    'order_source' => 'table',
                    'discount_price' => $discountprice,
                ]);

            if (count($option_id_array) > 0) {
                foreach ($option_id_array as $key => $option_id) {

                    DB::table('customers_basket_attributes')->insert(
                        [
                            'customers_id' => $customers_id,
                            'products_id' => $products_id,
                            'products_options_id' => $option_id,
                            'products_options_values_id' => $options_values_id_array[$key],
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

            if (count($option_id_array) > 0) {
                foreach ($option_id_array as $keey => $option_id) {

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

$totalprice = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('hold_status', '=', 0) ->sum(DB::raw('original_price * customers_basket_quantity'));

$totalprice = $totalprice * session('currency_value');

$total_amount_new = number_format($totalprice, 2);

return $total_amount_new;

    }

    //addToCartFixed
    public function addToCartFixed(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
        if(!empty(session('table_qrcode'))){
            return view("web.headers.cartButtons.webordercartbuttonfixed")->with('result', $result);   
        }        
        if($request->fixedheader_id == '1'){     
            return view("web.headers.cartButtons.cartButtonFixed")->with('result', $result);
        }
        if($request->fixedheader_id == '12'){
            return view("web.headers.cartButtons.cartButtonFixed12")->with('result', $result);
        }
        if($request->fixedheader_id == '15'){
            return view("web.headers.cartButtons.cartButtonFixed15")->with('result', $result);
        }
        if($request->fixedheader_id == '17'){
            return view("web.headers.cartButtons.cartButtonFixed17")->with('result', $result);
        }
        if($request->fixedheader_id == '18'){
            return view("web.headers.cartButtons.cartButtonFixed18")->with('result', $result);
        }
        if($request->fixedheader_id == '20'){
            return view("web.headers.cartButtons.cartButtonFixed20")->with('result', $result);
        }
        if($request->fixedheader_id == '24'){
            return view("web.headers.cartButtons.cartButtonFixed24")->with('result', $result);
        }
        if($request->fixedheader_id == '28'){
            return view("web.headers.cartButtons.cartButtonFixed28")->with('result', $result);
        }
        if($request->fixedheader_id == '30'){
            return view("web.headers.cartButtons.cartButtonFixed30")->with('result', $result);
        }
        if($request->fixedheader_id == '32'){
            return view("web.headers.cartButtons.cartButtonFixed32")->with('result', $result);
        }
        if($request->fixedheader_id == '33'){
            return view("web.headers.cartButtons.cartButtonFixed33")->with('result', $result);
        }
        if($request->fixedheader_id == '35'){
            return view("web.headers.cartButtons.cartButtonFixed35")->with('result', $result);
        }
        if($request->fixedheader_id == '36'){
            return view("web.headers.cartButtons.cartButtonFixed36")->with('result', $result);
        }
        if($request->fixedheader_id == '37'){
            return view("web.headers.cartButtons.cartButtonFixed37")->with('result', $result);
        }
        if($request->fixedheader_id == '38'){
            return view("web.headers.cartButtons.cartButtonFixed38")->with('result', $result);
        }
        if($request->fixedheader_id == '39'){
            return view("web.headers.cartButtons.cartButtonFixed39")->with('result', $result);
        }
        if($request->fixedheader_id == '40'){
            return view("web.headers.cartButtons.cartButtonFixed40")->with('result', $result);
        }
        if($request->fixedheader_id == '41'){
            return view("web.headers.cartButtons.cartButtonFixed41")->with('result', $result);
        }
        if($request->fixedheader_id == '42'){
            return view("web.headers.cartButtons.cartButtonFixed42")->with('result', $result);
        }
        if($request->fixedheader_id == '43'){
            return view("web.headers.cartButtons.cartButtonFixed43")->with('result', $result);
        }
        if($request->fixedheader_id == '44'){
            return view("web.headers.cartButtons.cartButtonFixed44")->with('result', $result);
        }
        if($request->fixedheader_id == '45'){
            return view("web.headers.cartButtons.cartButtonFixed45")->with('result', $result);
        }
        if($request->fixedheader_id == '46'){
            return view("web.headers.cartButtons.cartButtonFixed46")->with('result', $result);
        }
        if($request->fixedheader_id == '47'){
            return view("web.headers.cartButtons.cartButtonFixed47")->with('result', $result);
        } if($request->fixedheader_id == '48'){
            return view("web.headers.cartButtons.cartButtonFixed48")->with('result', $result);
        } if($request->fixedheader_id == '49'){
            return view("web.headers.cartButtons.cartButtonFixed49")->with('result', $result);
        }
        if($request->fixedheader_id == '50'){
            return view("web.headers.cartButtons.cartButtonFixed50")->with('result', $result);
        }
    }

    public function addToCartResponsive(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent(); 
         if(!empty(session('table_qrcode'))){
            return view("web.headers.cartButtons.webordercartbuttonmobile")->with('result', $result);   
        }       
        if($request->mobileheader_id == '1'){
            return view("web.headers.cartButtons.cartButton")->with('result', $result);
        }
        if($request->mobileheader_id == '11'){
            return view("web.headers.cartButtons.cartButtonMobile11")->with('result', $result);
        }
        if($request->mobileheader_id == '12'){
            return view("web.headers.cartButtons.cartButtonMobile12")->with('result', $result);
        }
        if($request->mobileheader_id == '13'){
            return view("web.headers.cartButtons.cartButtonMobile13")->with('result', $result);
        }
        if($request->mobileheader_id == '14'){
            return view("web.headers.cartButtons.cartButtonMobile14")->with('result', $result);
        }
        if($request->mobileheader_id == '15'){
            return view("web.headers.cartButtons.cartButtonMobile15")->with('result', $result);
        }
        if($request->mobileheader_id == '16'){
            return view("web.headers.cartButtons.cartButtonMobile16")->with('result', $result);
        }
        if($request->mobileheader_id == '17'){
            return view("web.headers.cartButtons.cartButtonMobile17")->with('result', $result);
        }
        if($request->mobileheader_id == '18'){
            return view("web.headers.cartButtons.cartButtonMobile18")->with('result', $result);
        }
        if($request->mobileheader_id == '19'){
            return view("web.headers.cartButtons.cartButtonMobile19")->with('result', $result);
        }
        if($request->mobileheader_id == '20'){
            return view("web.headers.cartButtons.cartButtonMobile20")->with('result', $result);
        }
        if($request->mobileheader_id == '22'){
            return view("web.headers.cartButtons.cartButtonMobile22")->with('result', $result);
        }
        if($request->mobileheader_id == '23'){
            return view("web.headers.cartButtons.cartButtonMobile23")->with('result', $result);
        }
        if($request->mobileheader_id == '24'){
            return view("web.headers.cartButtons.cartButtonMobile24")->with('result', $result);
        }
        if($request->mobileheader_id == '25'){
            return view("web.headers.cartButtons.cartButtonMobile25")->with('result', $result);
        }
        if($request->mobileheader_id == '27'){
            return view("web.headers.cartButtons.cartButtonMobile27")->with('result', $result);
        }
        if($request->mobileheader_id == '28'){
            return view("web.headers.cartButtons.cartButtonMobile28")->with('result', $result);
        }
        if($request->mobileheader_id == '29'){
            return view("web.headers.cartButtons.cartButtonMobile29")->with('result', $result);
        }
        if($request->mobileheader_id == '30'){
            return view("web.headers.cartButtons.cartButtonMobile30")->with('result', $result);
        }
        if($request->mobileheader_id == '32'){
            return view("web.headers.cartButtons.cartButtonMobile32")->with('result', $result);
        }
        if($request->mobileheader_id == '33'){
            return view("web.headers.cartButtons.cartButtonMobile33")->with('result', $result);
        }
        if($request->mobileheader_id == '34'){
            return view("web.headers.cartButtons.cartButtonMobile34")->with('result', $result);
        }
        if($request->mobileheader_id == '35'){
            return view("web.headers.cartButtons.cartButtonMobile35")->with('result', $result);
        }
        if($request->mobileheader_id == '36'){
            return view("web.headers.cartButtons.cartButtonMobile36")->with('result', $result);
        }
        if($request->mobileheader_id == '37'){
            return view("web.headers.cartButtons.cartButtonMobile37")->with('result', $result);
        }
        if($request->mobileheader_id == '38'){
            return view("web.headers.cartButtons.cartButtonMobile38")->with('result', $result);
        }
        if($request->mobileheader_id == '39'){
            return view("web.headers.cartButtons.cartButtonMobile39")->with('result', $result);
        }
        if($request->mobileheader_id == '40'){
            return view("web.headers.cartButtons.cartButtonMobile40")->with('result', $result);
        }
        if($request->mobileheader_id == '41'){
            return view("web.headers.cartButtons.cartButtonMobile41")->with('result', $result);
        }
        if($request->mobileheader_id == '42'){
            return view("web.headers.cartButtons.cartButtonMobile42")->with('result', $result);
        }
        if($request->mobileheader_id == '43'){
            return view("web.headers.cartButtons.cartButtonMobile43")->with('result', $result);
        }
        if($request->mobileheader_id == '44'){
            return view("web.headers.cartButtons.cartButtonMobile44")->with('result', $result);
        }
        if($request->mobileheader_id == '45'){
            return view("web.headers.cartButtons.cartButtonMobile45")->with('result', $result);
        }
        if($request->mobileheader_id == '46'){
            return view("web.headers.cartButtons.cartButtonMobile46")->with('result', $result);
        }
        if($request->mobileheader_id == '47'){
            return view("web.headers.cartButtons.cartButtonMobile47")->with('result', $result);
        } if($request->mobileheader_id == '48'){
            return view("web.headers.cartButtons.cartButtonMobile48")->with('result', $result);
        } if($request->mobileheader_id == '49'){
            return view("web.headers.cartButtons.cartButtonMobile49")->with('result', $result);
        }
        if($request->mobileheader_id == '50'){
            return view("web.headers.cartButtons.cartButtonMobile50")->with('result', $result);
        }
        
    }   

    //updateCart
    public function updateCart(Request $request)
    {
        session(['out_of_stock' => 0]);
        session(['out_of_stock_product' =>0]);
        session(['min_order' => 0]);
        session(['min_order_value' => 0]);
        session(['min_order_product' => 0]);
        session(['max_order' => 0]);
        session(['max_order_value' => 0]);
        session(['max_order_product' => 0]);
        session(['min_order_price' => 0]);
        session(['coupon_usage_per_user_limit'=>0]);
     
        if (empty(session('customers_id'))) {
            $customers_id = '';
        } else {
            $customers_id = session('customers_id');
        }
        $session_id = Session::getId();
        foreach ($request->cart as $key => $customers_basket_id) {
            $this->cart->updateRecord($customers_basket_id, $customers_id, $session_id, $request->quantity[$key]);
        }

       

        $message = Lang::get("website.Cart has been updated successfully");
        
     
        return redirect()->back()->with('message', $message);

    }

      //apply_coupon
      public function apply_coupon(Request $request)
      {
          $result['commonContent'] = $this->index->commonContent();
          if($result['commonContent']['settings']['Vouchercheck']=='1' && !empty(session('points_discount'))){
              $response = array('success' => '0', 'message' => 'You can able to apply either one at a time');
  
              print_r(json_encode($response));
          }else{
                  $result = array();
              $coupon_code = $request->coupon_code;

              $point=DB::table('redeem_points_voucher')->where('code', $coupon_code)->where('status', 0)->first();
             
              if($point !='')
              {
                $this->redeempoints($point->id);
                $response = array('success' => '1', 'message' => Lang::get("website.Redeem has been applied successfully"));
              }
              else
              {
              $carts = $this->cart->myCart(array());
              if (count($carts) > 0) {
                  $response = $this->cart->common_apply_coupon($coupon_code);
              } else {
                  $response = array('success' => '0', 'message' => Lang::get("website.Coupon can not be apllied to empty cart"));
              }
            }
              print_r(json_encode($response));
          }  
      }
      public function applyredeempoints($id)
      {
          $result['commonContent'] = $this->index->commonContent();
         // print_r($result['commonContent']['settings']['Vouchercheck']);die();
      if($result['commonContent']['settings']['Vouchercheck']=='1' && !empty(session('coupon'))){
  
              $message = 'You can able to apply either one at a time';
                  return redirect()->back()->with('message', $message);
  
          }else{
               $response = $this->cart->common_apply_redeem_point($id);
               //print_r($response);die();
               if($response=='success'){
                  $message = Lang::get("website.Redeem has been applied successfully");
                  return redirect()->back()->with('message', $message);
               }else if($response=='failure'){
                  $message = Lang::get("website.Redeem amount is greater than total price");
                  return redirect()->back()->with('message', $message);
               }else if($response == 'already'){
                  $message = Lang::get("website.Loyalty voucher already applied");
                  return redirect()->back()->with('message', $message);
               }
          }
      }
      public function redeempoints($id)
      {
          $result['commonContent'] = $this->index->commonContent();
          if($result['commonContent']['settings']['Vouchercheck']=='1' && !empty(session('coupon'))){
               $message = 'You can able to apply either one at a time';
                  return redirect()->back()->with('message', $message);
           }else{   
              $response = $this->cart->redeempoints($id);
                if($response=='success'){
                      $message = Lang::get("website.Redeem has been applied successfully");
                      return redirect()->back()->with('message', $message);
                }
                else if($response=='failure'){
                  $message = Lang::get("website.Redeem amount is greater than total price");
                  return redirect()->back()->with('message', $message);
               }else if($response == 'already'){
                  $message = Lang::get("website.Loyalty voucher already applied");
                  return redirect()->back()->with('message', $message);
               }
          }
      }
      //removeCoupon
      public function removeCoupon(Request $request)
      {
  
          $coupons_id = $request->id;
          //delted point coupon
           $result=DB::table('coupons')->where('discount_type', '=', 'point')->where('coupans_id',$request->id)->first();
           if($result){
              DB::table('coupons')->where('discount_type', '=', 'point')->where('coupans_id',$request->id)->delete();
           }
          $session_coupon_data = session('coupon');
          session(['coupon' => array()]);
          session(['coupon_discount' => 0]);
          session(['applied_id' => '']);
          $response = array();
          if (!empty($session_coupon_data)) {
              foreach ($session_coupon_data as $key => $session_coupon) {
                  if ($session_coupon->coupans_id != $coupons_id) {
                      $response = $this->cart->common_apply_coupon($session_coupon->code);
                  }
              }
          }
  
          $message = Lang::get("website.Coupon has been removed successfully");
          return redirect()->back()->with('message', $message);
  
      }
      //removeCoupon
      public function removeLoyalty($id)
      {
           $trans = DB::table('transaction_points')->where('id', $id)->first();
           $cdata = DB::table('users')->where('id', session('customers_id'))->first();
           $newbalnce=$cdata->loyalty_points+$trans->points;
            // update user table
              DB::table('users')->where('id', session('customers_id'))->update(['loyalty_points' => $newbalnce,]);
          //delete transaction_points table
              DB::table('transaction_points')->where([['id', '=', $id]])->delete();
          //delete temp_point_transaction table 
              DB::table('temp_point_transaction')->where([['trans_id', '=',$id]])->delete();
              session(['points_discount' => 0]);
              session(['transaction_id' => '']);
          $message = $message = 'Redeem Points has been removed successfully';;
          return redirect()->back()->with('message', $message);
      }
  
      public function removeactivateredeem($id)
      {
              session(['transaction_id' => '']);
              session(['points_discount' => 0]);
              session(['defaultstatus' => '']);
          $message = Lang::get("website.Coupon has been removed successfully");
          return redirect()->back()->with('message', $message);
      }
  
      public function addRedeempoint(Request $request)
      {
           $response = $this->cart->addRedeempoint($request);
          if($response=='invaild_amount'){
              return 'invaild_amount';
           }else{
             return view("web.view_add_voucher")->with('result', $response); 
           }
            
      }

      public function getPointhistory(Request $request)
      {
          
        return view("web.view_pointhistory");    
      }
  
      public function viewReward(Request $request)
      {
           $response = $this->cart->viewReward($request);
          
             return view("web.view_get_reward")->with('result', $response); 
           
            
      }


      //updateToCart
    public function updateToCart(Request $request)
    {
        $result = $this->cart->addToCart($request);
        if (!empty($result['status']) && $result['status'] == 'exceed') {
            return $result;
        }

    }

}
