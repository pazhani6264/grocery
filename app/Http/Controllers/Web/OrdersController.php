<?php
namespace App\Http\Controllers\Web;


use App\Exports\ExportsOrders;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

//use Mail;
//validator is builtin class in laravel
use App\Http\Controllers\Web\CartController;
use Illuminate\Support\Facades\Validator;
//for password encryption or hash protected
use App\Http\Controllers\Web\ShippingAddressController;

//for authenitcate login data
use App\Models\Web\Cart;
use App\Models\Web\Currency;

//for requesting a value
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Shipping;
use App\Models\Core\Order as CoreOrder;

use App\Models\Web\Order;
use App\Models\Core\Setting;
//for Carbon a value
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Session;
use DB;
use Hash;
//email

class OrdersController extends Controller
{

    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Cart $cart,
        Shipping $shipping,
        Order $order,
        Coreorder $Coreorder,
        Setting $setting
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->cart = $cart;
        $this->shipping = $shipping;
        $this->order = $order;
        $this->Setting = $setting;
        $this->Coreorder = $Coreorder;
        $this->theme = new ThemeController();
    }

    //test stripe
    public function stripeForm(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        return view("stripeForm", $title)->with('result', $result);
    }

    public function guest_checkout()
    {

        session(['guest_checkout' => 1]);
        return redirect('/checkout');
    }
    public function merchantguest_checkout()
    {
        $qrcodeid=Session::get('table_qrcode');
        $table=DB::table('booking_table')->where('qrcode', $qrcodeid)->first();
        $outlet=DB::table('appointment_outlet')->where('id', $table->outletid)->first();

        $shipping_data['firstname'] = $outlet->name;
        $shipping_data['lastname'] = $outlet->name;
        $shipping_data['company'] = $outlet->name;
        $shipping_data['latitude'] = $outlet->lat;
        $shipping_data['longitude'] = $outlet->lng;
        $shipping_data['street'] = $outlet->address;
        $shipping_data['countries_id'] = $outlet->countries_id;
        $shipping_data['zone_id'] = $outlet->zone_id;
        $shipping_data['city'] = $outlet->address;
        $shipping_data['postcode'] = $outlet->address;
        $shipping_data['delivery_phone'] = $outlet->phone;
        $shipping_data['email']='guest@gmail.com';

        $address = (object) $shipping_data;
        

        $billing_data['billing_firstname'] = $outlet->name;
        $billing_data['billing_lastname'] = $outlet->name;
        $billing_data['billing_company'] = $outlet->name;
        $billing_data['billing_street'] = $outlet->address;
        $billing_data['billing_countries_id'] = $outlet->countries_id;;
        $billing_data['billing_zone_id'] = $outlet->zone_id;
        $billing_data['billing_city'] = $outlet->address;
        $billing_data['billing_zip'] = $outlet->address;
        $billing_data['billing_phone'] = $outlet->phone;
        $billing_address = (object) $billing_data;
        $billing_address->same_billing_address = 1;

        session(['shipping_address' => $address]);
        session(['billing_address' => $billing_address]);
        session(['step' => '3']);
        session(['coupon' => array()]);
        //print_r($billing_address);
        
        return redirect('/checkout');
    }
    //checkout
    public function checkout(Request $request)
    {   
        //$email = session('shipping_address')->email;
       
        $currency_symbol = session('symbol_left') ? session('symbol_left') : session('symbol_right') ;
        $currency  = DB::table('currencies')->where('symbol_left',$currency_symbol)->orwhere('symbol_right',$currency_symbol)->first();
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $final_theme = $this->theme->theme();
        $result = array();
        $applied_coupons = array();



        //cart data
        $result['cart'] = $this->cart->myCart($result);
        $result['currency_value'] = $currency ? $currency->value : 1;
        session(['banktransfer'=> '']);
        $result['default'] = $this->shipping->getShippingAddress_Default();
        $result['address'] = $this->shipping->getShippingAddress($address_id='');
        
        
        if (count($result['cart']) == 0) {
            return redirect("/");
        } else {

            //apply coupon

            if (!empty(session('coupon')) and count(session('coupon')) > 0) {

                if (!empty(session('coupon'))) {
                    foreach (session('coupon') as $key => $session_coupon) {
                        $applied_coupons[] = $session_coupon->code;
                    }
                }

                 
                if (Session::get('guest_checkout') == 1 && session('shipping_address')) {

                    $email = session('shipping_address')->email;

                    $check = DB::table('users')->where('role_id', 2)->where('email', $email)->first();
                    if ($check == null) {
                        $customers_id = DB::table('users')
                            ->insertGetId([
                                'role_id' => 2,
                                'email' => $email = session('shipping_address')->email,
                                'password' => Hash::make('123456dfdfdf'),
                                'first_name' => session('shipping_address')->firstname,
                                'last_name' => session('shipping_address')->lastname,
                                'phone' => session('billing_address')->billing_phone,
                            ]);
                        session(['customers_id' => $customers_id]);
                    } else {
                        $customers_id = $check->id;
                        session(['customers_id' => $customers_id]);
                    }
                } else {
                    $customers_id = auth()->guard('customer')->user() ? auth()->guard('customer')->user() ->id : "";
                }
                
                if(!empty($customers_id)){
                    $usedcouponcount = 0 ;
                    $count_of_coupon_used = DB::table('orders')->select('coupon_code')->where('coupon_code','!=',"")->where('customers_id',$customers_id)->get();
                    
                    foreach($count_of_coupon_used as $couponcount){
                        $coupon_array = json_decode($couponcount->coupon_code);
                        foreach($coupon_array as $coupon_array_item){
                            if(in_array($coupon_array_item->code,$applied_coupons)){
                                $usedcouponcount++;
                            }
                        }
                    }
                    $coupons = DB::table('coupons')->whereIn('code',$applied_coupons)->first();
                    // dd($coupons,$applied_coupons);
                    if($coupons){
                        if($coupons->usage_limit_per_user == $usedcouponcount and !empty($coupons->usage_limit_per_user)){
                            session(['coupon_usage_per_user_limit' => 1]);
                            session(['coupon' => array()]);
                            session(['coupon_discount' => '']);
                            return redirect('viewcart');
                        }
                    }
                    
                }
                $session_coupon_data = session('coupon');
                session(['coupon' => array()]);
                $response = array();
                if (!empty($session_coupon_data)) {
                    foreach ($session_coupon_data as $key => $session_coupon) {
                        $response = $this->cart->common_apply_coupon($session_coupon->code);
                        $applied_coupons[] = $session_coupon->code;
                    }
                }
            }



            $result['commonContent'] = $this->index->commonContent();
            //print_r($result['commonContent']);die();

            $InventoryStatus = isset($result['commonContent']) ? $result['commonContent']['settings']['Inventory'] : '0';
            $address = array();



            if (empty(session('step'))) {
                session(['step' => '0']);
            }

            if(auth()->guard('customer')->check()){
                
                $all_addresses = $this->shipping->getShippingAddress(array());
                
                if (!empty($all_addresses) and count($all_addresses)>0) {
                    foreach($all_addresses as $default_address){
                        if($default_address->default_address==1){                        
                            $default_address->delivery_phone = auth()->guard('customer')->user()->phone;
                            $address = $default_address;
                        }
                    }
                    
                }
            }
            
            if (empty(session('shipping_address'))) {
                session(['shipping_address' => $address]);
            }
            


            //shipping counties
            if (!empty(session('shipping_address')->countries_id)) {
                $countries_id = session('shipping_address')->countries_id;
            } else {
                $countries_id = '';
            }


            $result['countries'] = $this->shipping->countries();
            $result['zones'] = $this->shipping->zones($countries_id);


            //get tax
            if($result['commonContent']['settings']['tax_class']=='2'){
                if (!empty(session('shipping_address')->countries_id)) {
                    $tax_zone_id = session('shipping_address')->countries_id;
                    $tax = $this->calculateTax($tax_zone_id);
                    session(['tax_rate' => $tax]);
                } else {
                    session(['tax_rate' => '0']);
                }
            }else{
                if (!empty(session('shipping_address')->countries_id)) {
                    $tax_type=$result['commonContent']['settings']['tax_class'];
                    $tax_zone_id = session('shipping_address')->countries_id;
                    $tax = $this->calculateCommonTax($tax_zone_id,$tax_type);
                    session(['tax_rate' => $tax]);
                }else{
                  session(['tax_rate' => '0']);  
                }
            }

             //print_r(session('tax_rate'));die();
              //print_r(count(session('coupon')));die();
            //shipping methods
            
            $tax_type=$result['commonContent']['settings']['tax_class'];
            $result['commonTax']=$this->getCommonTax($countries_id,$tax_type);
            //print_r($result['commonTax']);die();

            $result['shipping_methods'] = $this->shipping_methods();
             

            

            //print_r($result['shipping_methods']);die(); 
           
            //payment methods
            $result['payment_methods'] = $this->getPaymentMethods();
                     
            
            //dd($result['cart']);


            //price
            $price = 0;
            //print_r($result['cart']);die();
            if (count($result['cart']) > 0) {

                foreach ($result['cart'] as $products) {
                    $req = array();
                    $attr = array();
                    $req['products_id'] = $products->products_id;
                    if (isset($products->attributes)) {
                        foreach ($products->attributes as $key => $value) {
                            $attr[$key] = $value->products_attributes_id;
                        }
                        $req['attributes'] = $attr;
                    }
                    $check = $this->products->getquantity($req);
                    $product_data = DB::table('products')->where('products_id', '=',$products->products_id)->first();

                    // dd($products->customers_basket_quantity." ".$products->max_order);
                    if($InventoryStatus === '1' && $product_data->stock_status == '1'){

                        if ($products->products_type == 3 || $products->products_type == 4) {


                            // $productComboData = DB::table('product_combo')
                            // ->where('status', '1')
                            // ->where('pro_id', $products->products_id)
                            // ->get();
                            // foreach($productComboData as $proCombo){
                            //     if ($proCombo->qty > $check['stock']) {
                            //         print_r($check['stock']);
                            //         session(['out_of_stock' => 1]);
                            //         session(['out_of_stock_product' => $proCombo->product_id]);
                            //         return redirect('viewcart');
                            //     } elseif($proCombo->qty < $products->min_order){
                            //         print_r('ok1');
                            //         session(['min_order' => 1]);
                            //         session(['min_order_value' => $products->min_order]);
                            //         session(['min_order_product' => $proCombo->product_id]);
                            //         return redirect('viewcart');
                            //     } elseif($proCombo->qty > $products->max_order  && $products->max_order !=0){
                            //         print_r('ok2');
                            //         session(['max_order' => 1]);
                            //         session(['max_order_value' => $products->max_order]);
                            //         session(['max_order_product' => $proCombo->product_id]);
                            //         return redirect('viewcart');
                            //     } else{
                                    session(['out_of_stock' => 0]);
                                    session(['out_of_stock_product' =>0]);
                                    session(['min_order' => 0]);
                                    session(['min_order_value' => 0]);
                                    session(['min_order_product' => 0]);
                                    session(['max_order' => 0]);
                                    session(['max_order_value' => 0]);
                                    session(['max_order_product' => 0]);
                                //}
                            //}
                        } else {
                            if ($products->customers_basket_quantity > $check['stock']) {
                                session(['out_of_stock' => 1]);
                                session(['out_of_stock_product' => $products->products_id]);
                                return redirect('viewcart');
                            }elseif($products->customers_basket_quantity < $products->min_order){
                                session(['min_order' => 1]);
                                session(['min_order_value' => $products->min_order]);
                                session(['min_order_product' => $products->products_id]);
                                return redirect('viewcart');
                            }
                            elseif($products->customers_basket_quantity > $products->max_order  && $products->max_order !=0){
                                session(['max_order' => 1]);
                                session(['max_order_value' => $products->max_order]);
                                session(['max_order_product' => $products->products_id]);
                                return redirect('viewcart');
                            }
                            else{
                                session(['out_of_stock' => 0]);
                                session(['out_of_stock_product' =>0]);
                                session(['min_order' => 0]);
                                session(['min_order_value' => 0]);
                                session(['min_order_product' => 0]);
                                session(['max_order' => 0]);
                                session(['max_order_value' => 0]);
                                session(['max_order_product' => 0]);
                            }
                        }
                    }else{
                        if($products->customers_basket_quantity < $products->min_order){
                            session(['min_order' => 1]);
                            session(['min_order_value' => $products->min_order]);
                            session(['min_order_product' => $products->products_id]);
                            return redirect('viewcart');
                        }
                        elseif($products->customers_basket_quantity > $products->max_order){
                            session(['max_order' => 1]);
                            session(['max_order_value' => $products->max_order]);
                            session(['max_order_product' => $products->products_id]);
                            return redirect('viewcart');
                        }
                        else{
                            session(['out_of_stock' => 0]);
                            session(['out_of_stock_product' =>0]);
                            session(['min_order' => 0]);
                            session(['min_order_value' => 0]);
                            session(['min_order_product' => 0]);
                            session(['max_order' => 0]);
                            session(['max_order_value' => 0]);
                            session(['max_order_product' => 0]);
                            session(['min_order_price' => 0]);
                            session(['min_order_price_value' =>'']);
                            session(['coupon_usage_per_user_limit'=>0]);
                        }
                    }
                    

                    $price += $products->final_price * $products->customers_basket_quantity;
                }

                
                if($price  < $result['commonContent']['settings']['min_order_price']){
                    session(['min_order_price' => 1]);
                    session(['min_order_price_value' => $result['commonContent']['settings']['min_order_price']]);
                    return redirect('viewcart');
                }
                
                session(['products_price' => $price]);
            }


            //breaintree token
            $token = $this->generateBraintreeTokenWeb();
            session(['braintree_token' => $token]); 

            $ship_flag = DB::table('user_redirect_flag')->where('user_id', auth()->guard('customer')->user()->id)->where('status', 1)->where('flag_name', 'Shipping_flag')->first(); 

		if($ship_flag != '')
		{
            DB::table('user_redirect_flag')->where('status', 1)->where('flag_name', 'Shipping_flag')->where('user_id', auth()->guard('customer')->user()->id)->delete();
        }

        session(['login_flag'=>0]);

            //print_r($token);die(); 
            $current_theme = DB::table('current_theme')->first();
            $checkout_theme = $current_theme->checkout;

            return view('web.checkout.checkout'.$checkout_theme.'', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

            
        }

    }

    

    //update shipping address
	public function checkout_coupon(Request $request){
       /*  print_r('ok');die(); */
        }


        public function checkout_shipping_address_new(Request $request)
        {
             /* $geofencing = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->zone_id)->where('country_id', $request->countries_id)->WhereRaw('FIND_IN_SET(' .$request->postcode. ',pincode)')->first(); */
    
             $geofencingCountry = DB::table('geo_fencing')->where('status', '1')->where('country_id', $request->countries_id)->first();
             $geocheck = 0;
             if($geofencingCountry !='')
             { 
                if($geofencingCountry->state_id !='')
                { 
                $geofencingCountryState = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->zone_id)->where('country_id', $geofencingCountry->country_id)->first();
                     if($geofencingCountryState !='')
                     { 
                         if($geofencingCountryState->pincode !='')
                         { 
                             $geofencingCountryStatepostcode = DB::table('geo_fencing')->where('status', '1')->where('state_id', $geofencingCountryState->state_id)->where('country_id', $geofencingCountryState->country_id)->WhereRaw('FIND_IN_SET(' .$request->postcode. ',pincode)')->first();
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
    
    
            if($geocheck == 1)
                { 
            //print_r($request->save);die();
            if($request->save=="yes"){
                $result = $this->order->save_address_user_account($request);
            }
            $title = array('pageTitle' => Lang::get('website.Checkout'));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
    
            if (session('step') == '0') {
                session(['step' => '1']);
            }
    
            foreach ($request->all() as $key => $value) {
                $shipping_data[$key] = $value;
    
               
    
                //billing address
                if ($key == 'firstname') {
                    $billing_data['billing_firstname'] = $value;
                } else if ($key == 'lastname') {
                    $billing_data['billing_lastname'] = $value;
                } else if ($key == 'company') {
                    $billing_data['billing_company'] = $value;
                } else if ($key == 'street') {
                    $billing_data['billing_street'] = $value;
                } else if ($key == 'countries_id') {
                    $billing_data['billing_countries_id'] = $value;
                } else if ($key == 'zone_id') {
                    $billing_data['billing_zone_id'] = $value;
                } else if ($key == 'city') {
                    $billing_data['billing_city'] = $value;
                } else if ($key == 'postcode') {
                    $billing_data['billing_zip'] = $value;
                } else if ($key == 'delivery_phone') {
                    $billing_data['billing_phone'] = $value;
                }
            }
    
            if (empty(session('billing_address')) or session('billing_address')->same_billing_address == 1) {
                $billing_address = (object) $billing_data;
                $billing_address->same_billing_address = 1;
                session(['billing_address' => $billing_address]);
            }
    
            $address = (object) $shipping_data;
            session(['shipping_address' => $address]);
    
            //print_r($address);die();
    
            //return redirect()->back();
    
         }
        else
        {
            //return redirect()->back()->with('error', 'Unable to deliver under this address, please change your address.');
        } 
        }



    //checkout
    public function checkout_shipping_address(Request $request)
    {
         /* $geofencing = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->zone_id)->where('country_id', $request->countries_id)->WhereRaw('FIND_IN_SET(' .$request->postcode. ',pincode)')->first(); */

         $geofencingCountry = DB::table('geo_fencing')->where('status', '1')->where('country_id', $request->countries_id)->first();
         $geocheck = 0;
         if($geofencingCountry !='')
         { 
            if($geofencingCountry->state_id !='')
            { 
            $geofencingCountryState = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->zone_id)->where('country_id', $geofencingCountry->country_id)->first();
                 if($geofencingCountryState !='')
                 { 
                     if($geofencingCountryState->pincode !='')
                     { 
                         $geofencingCountryStatepostcode = DB::table('geo_fencing')->where('status', '1')->where('state_id', $geofencingCountryState->state_id)->where('country_id', $geofencingCountryState->country_id)->WhereRaw('FIND_IN_SET(' .$request->postcode. ',pincode)')->first();
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


        if($geocheck == 1)
            { 
        //print_r($request->save);die();
        if($request->save=="yes"){
            $result = $this->order->save_address_user_account($request);
        }
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        if (session('step') == '0') {
            session(['step' => '1']);
        }

        foreach ($request->all() as $key => $value) {
            $shipping_data[$key] = $value;

           

            //billing address
            if ($key == 'firstname') {
                $billing_data['billing_firstname'] = $value;
            } else if ($key == 'lastname') {
                $billing_data['billing_lastname'] = $value;
            } else if ($key == 'company') {
                $billing_data['billing_company'] = $value;
            } else if ($key == 'street') {
                $billing_data['billing_street'] = $value;
            } else if ($key == 'countries_id') {
                $billing_data['billing_countries_id'] = $value;
            } else if ($key == 'zone_id') {
                $billing_data['billing_zone_id'] = $value;
            } else if ($key == 'city') {
                $billing_data['billing_city'] = $value;
            } else if ($key == 'postcode') {
                $billing_data['billing_zip'] = $value;
            } else if ($key == 'delivery_phone') {
                $billing_data['billing_phone'] = $value;
            }
        }

        if (empty(session('billing_address')) or session('billing_address')->same_billing_address == 1) {
            $billing_address = (object) $billing_data;
            $billing_address->same_billing_address = 1;
            session(['billing_address' => $billing_address]);
        }

        $address = (object) $shipping_data;
        session(['shipping_address' => $address]);

        //print_r($address);die();

        return redirect()->back();

     }
    else
    {
        return redirect()->back()->with('error', 'Unable to deliver under this address, please change your address.');
    } 
    }

    //checkout_billing_address
    public function checkout_billing_address(Request $request)
    {
       
        
        

        if (session('step') == '1') {
            session(['step' => '2']);
        }

        if (empty($request->same_billing_address)) {

            foreach ($request->all() as $key => $value) {
                $billing_data[$key] = $value;
            }

            

            $billing_address = (object) $billing_data;
            $billing_address->same_billing_address = 0;
            session(['billing_address' => $billing_address]);
        } else {
            

            $billing_address = session('billing_address');
           
            $billing_address->same_billing_address = 1;
            session(['billing_address' => $billing_address]);
        }

        return redirect()->back();
  

    }

    public function checkout_payment_method_checkout3(Request $request)
    {
       
        $result['commonContent'] = $this->index->commonContent();

        

        
        foreach ($request->all() as $key => $value) {
            if ($key == 'shipping_price') {
                if(!empty($result['commonContent']['setting'][82]->value) and $result['commonContent']['setting'][82]->value <= session('total_price')){
                    $shipping_detail['shipping_price'] = 0;
                }else{
                    $shipping_detail['shipping_price'] = $value;
                }
            } else {
                $shipping_detail[$key] = $value;
            }

        }

        session(['total_price'=>($request['total_price'])]);
       

        session(['shipping_detail' => (object) $shipping_detail]);
     
      

    }

    //checkout_payment_method
    public function checkout_payment_method(Request $request)
    {
       
      
        if (session('step') == '2') {
            session(['step' => '3']);
        }
        $result['commonContent'] = $this->index->commonContent();

        $shipping_detail = array();
        foreach ($request->all() as $key => $value) {
            if ($key == 'shipping_price') {
                if(!empty($result['commonContent']['setting'][82]->value) and $result['commonContent']['setting'][82]->value <= session('total_price')){
                    $shipping_detail['shipping_price'] = 0;
                }else{
                    $shipping_detail['shipping_price'] = $value;
                }
            } else {
                $shipping_detail[$key] = $value;
            }

        }
        //print_r($shipping_detail);

        session(['shipping_detail' => (object) $shipping_detail]);
        //print_r($shipping_detail);die();
        return redirect()->back();

    }

    //order_detail
    public function paymentComponent(Request $request)
    {
        session(['payment_method' => $request->payment_method]);
        session(['onlinetype' => $request->onlinetype]);

    }


    public function paymentcurrencycheck(Request $request)
    {

        $payment_methods = DB::table('payment_methods')->where([
            ['payment_method', '=', $request->payment_method],
        ])->first(); 

        $payment_id = $payment_methods->payment_methods_id;
        

        $key = $request->payment_method.'_ccode';

        if($payment_id !=4)
        {
            if($payment_id !=9)
            {
              
              $payment_ccode = DB::table('payment_methods_detail')->where([
                    ['payment_methods_id', '=', $payment_id],
                    ['key', '=', $key],
                ])->first(); 

                $ccode = json_decode($payment_ccode->value);

                if($ccode != '')
                {

                    if (in_array($request->currency_code, $ccode)) {
                        echo 1;
                    }
                    else{
                        echo 0;
                    }
                }
                else{
                    echo 1;
                } 
            }
            else{
                echo 1;
            }
        }
        else{
            echo 1;
        }
        
    }

    //generate token
    public function generateBraintreeTokenWeb()
    {

        $payments_setting = $this->order->payments_setting_for_brain_tree();
        if ($payments_setting['merchant_id']->status == 1) {
            //braintree transaction get nonce
            $is_transaction = '0'; # For payment through braintree

            if ($payments_setting['merchant_id']->environment == '0') {
                $braintree_environment = 'sandbox';
            } else {
                $environment = 'production';
            }
            //for token please check braintree.php file
            require_once app_path('braintree/index.php');          

            $braintree_merchant_id = $payments_setting['merchant_id']->value;
            $braintree_public_key = $payments_setting['public_key']->value;
            $braintree_private_key = $payments_setting['private_key']->value;


        } else {
            $clientToken = '';
        }
        return $clientToken;

        

    }

    //place_order
    public function place_order(Request $request)
    {
        $current_theme = DB::table('current_theme')->first();
        $checkout_theme = $current_theme->checkout;
        if($checkout_theme == 1 || $checkout_theme == 2 || $checkout_theme == 3)
        {
            $payment_status = $this->order->place_order_new($request);
        } 
        else
        {
            $payment_status = $this->order->place_order($request);
        }
       
        if ($payment_status == 'success') {
            $message = Lang::get("website.Payment has been processed successfully");
            return redirect('/thankyou');
        } else {
            return redirect()->back()->with('error', Lang::get("website.Error while placing order"));
        }
    }

   
     public function banktransfer_fileupload(Request $request)
     {
       

$postData = $request->only('bankimage');


$file = $postData['bankimage'];

// Build the input for validation
$fileArray = array('bankimage' => $file);

// Tell the validator that this file should be an image
$rules = array(
  'bankimage' => 'mimes:jpeg,jpg,png,gif|required|max:2048' // max 10000kb
);

// Now pass the input and rules into the validator
$validator = Validator::make($fileArray, $rules);

// Check to see if validation fails or passes


if ($validator->fails()) {
    return redirect()->back()->with('error', "Unable to upload image, maxmium upload size 2MB");
}
else
{
    $fileName = time() . '.' . $request->bankimage->getclientoriginalextension();
    $request->bankimage->getclientoriginalextension();
    $request->bankimage->move('images/banktransfer/' , $fileName);
    $bank_image = 'images/banktransfer/'.$fileName ;
    DB::table('orders')->where('orders_id',$request->image_order_id)->update([
        'banktransfer_image' => $bank_image,
    ]);

    return redirect()->back()->with('message', "Invoice image uploaded successfully");
}


     }
 

    //thankyou
    public function thankyou(Request $request)
    {
        
       
        $title = array('pageTitle' => Lang::get('website.Thank You'));
        $bankdetail = array();
        
   
        if(!empty(session('banktransfer')) and session('banktransfer') == 'yes'){
            $payments_setting = $this->order->payments_setting_for_directbank();    
           

            $bankdetail = array(
                'account_name' => $payments_setting['account_name']->value,
                'account_number' => $payments_setting['account_number']->value,
                'payment_method' => $payments_setting['account_name']->payment_method,
                'bank_name' => $payments_setting['bank_name']->value,
                'short_code' => $payments_setting['short_code']->value,
                'iban' => $payments_setting['iban']->value,
                'swift' => $payments_setting['swift']->value,
            );
           
        }
        
        $final_theme = $this->theme->theme();
        $result = $this->order->orders($request);
        $details = DB::table('orders_status_history')->where('orders_id', '=', session('orders_id'))->orderby('orders_status_history_id', 'desc')->first();


        $orderdetails = DB::table('orders')->where('orders_id', '=', session('orders_id'))->first();
        $status = $orderdetails->payment_status;
        $payment_method = $orderdetails->payment_method;

        session(['premierpaystatus' => $status]);
        session(['premierpaymethod' => $payment_method]);

        $order_email = DB::table('alert_settings')->where('order_email', 1)->first();
        if($status == 2 && $payment_method == 'PremierPay')
        {
            DB::table('redeem_points_voucher')->where('id',session('transaction_id'))->update([
                'status' => '1',
            ]);

                 DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);

            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
         

            if($order_email != '')
            {
            //$this->customer_email();
            }
        }
        if($status == 2 && $payment_method == 'Cash on Delivery')
        {
            DB::table('redeem_points_voucher')->where('id',session('transaction_id'))->update([
                'status' => '1',
            ]);

             
            DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);

            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
            
            if($order_email != '')
            {
            //$this->customer_email();
            }
        }
        else if($status == 1 && $payment_method == 'PayTm')
        {
            DB::table('redeem_points_voucher')->where('id',session('transaction_id'))->update([
                'status' => '1',
            ]);

            
            DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);
             
            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
            
            if($order_email != '')
            {
            //$this->customer_email();
            }
        }
        else if($status == 2 && $payment_method == 'ipay88')
        {
            DB::table('redeem_points_voucher')->where('id',session('transaction_id'))->update([
                'status' => '1',
            ]);

           
                DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);
             
            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
        
            if($order_email != '')
            {
            //$this->customer_email();
            }
        }
        else
        {
            
        DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);
             
            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
        }


        return view("web.thankyou", ['title' => $title, 'final_theme' => $final_theme, 'bankdetail'=>$bankdetail,'details'=>$details])->with('result', $result);
    }



    public function paytm_thankyou(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get('website.Thank You'));
       
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();

         

            session(['transaction_id' => '']);
            session(['defaultstatus' => '']);
            session(['points_discount' => '']);
            session(['applied_id' => '']);
            

        return view("web.paytm_thankyou", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    //orders
    public function orders(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.My Orders"));
        $final_theme = $this->theme->theme();
        $result = $this->order->orders($request); 

        $language_id = 1;
        $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
         $result['status'] = $status;

        //print_r($result);die();    
        return view("web.orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

     //pending orders
     public function pendingOrders(Request $request)
     {
         $title = array('pageTitle' => Lang::get("website.My Orders"));
         $final_theme = $this->theme->theme();
         $result = $this->order->pendingorders($request); 

         $language_id = 1;
         $status = DB::table('orders_status')
                 ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                 ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
          $result['status'] = $status;

         //print_r($result);die();    
         return view("web.pending_orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
     }

     //completed orders
     public function completeOrders(Request $request)
     {
         $title = array('pageTitle' => Lang::get("website.My Orders"));
         $final_theme = $this->theme->theme();
         $result = $this->order->completeorders($request); 

         $language_id = 1;
         $status = DB::table('orders_status')
                 ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                 ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
          $result['status'] = $status;

         //print_r($result);die();    
         return view("web.completed_orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
     }

    public function pointTransaction(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.My_point_transaction"));
        $final_theme = $this->theme->theme();
        $result = $this->order->get_point($request); 
        //print_r($result);die();    
        return view("web.my_point", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    //viewMyOrder
    public function viewOrder(Request $request, $id)
    {

        $title = array('pageTitle' => Lang::get("website.View Order"));
        $final_theme = $this->theme->theme();
        // $result = $this->order->viewOrder($request, $id);
        //orders data
        $ordersData = $this->Coreorder->detail($request);        

        // current order status
        $orders_status_history = $this->Coreorder->currentOrderStatus($request);  

        //all statuses 
        $orders_status = $this->Coreorder->orderStatuses();  
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;
        $result['commonContent'] = $this->index->commonContent();
        $details = DB::table('orders_status_history')->where('orders_id', '=', $id)->orderby('orders_status_history_id', 'desc')->first();
         //dd($result['commonContent']);
        if ($result['res'] = "view-order") {
            return view("web.view-order", $title)->with(['data'=>$ordersData,'result' => $result, 'final_theme' => $final_theme,'details'=>$details]);
        } else {
            return redirect('orders');
        }
    }


        //viewMyOrder
        public function ratingDelivery(Request $request, $id)
        {
    
            $title = array('pageTitle' => Lang::get("website.View Order"));
            $final_theme = $this->theme->theme();
            // $result = $this->order->viewOrder($request, $id);
            //orders data
            $ordersData = $this->Coreorder->detail($request);        
    
            // current order status
            $orders_status_history = $this->Coreorder->currentOrderStatus($request);  
    
            //all statuses 
            $orders_status = $this->Coreorder->orderStatuses();  
            $ordersData['orders_status'] = $orders_status;
            $ordersData['orders_status_history'] = $orders_status_history;
            $result['commonContent'] = $this->index->commonContent();
            $details = DB::table('orders_status_history')->where('orders_id', '=', $id)->orderby('orders_status_history_id', 'desc')->first();

            $language_id = Session::get('language_id');

            $reviews = DB::table('reviews') ->LeftJoin('reviews_description', 'reviews_description.review_id', '=', 'reviews.reviews_id')->where('orders_id', '=', $id)->where('reviews_description.language_id', '=', $language_id)->where('customers_id', '=', auth()->guard('customer')->user()->id)->first();

            
             //dd($result['commonContent']);
          
                return view("web.rating_delivery", $title)->with(['data'=>$ordersData,'result' => $result, 'final_theme' => $final_theme,'details'=>$details,'reviews'=>$reviews]);
           
        }
    

    //calculate tax
    public function calculateTax($tax_zone_id)
    {

        $tax = $this->order->calculateTax($tax_zone_id);
        return $tax;

    }

    public function calculateCommonTax($tax_zone_id,$tax_type)
    {
        $tax = $this->order->calculateCommonTax($tax_zone_id,$tax_type);
        return $tax;

    }
    public function getCommonTax($countries_id,$tax_type)
    {
        $commontax = $this->order->getCommonTax($countries_id,$tax_type);
        return $commontax;
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {

       /*  print_r($latitude1);
        print_r($longitude1);
        print_r($latitude2);
        print_r($longitude2);die(); */
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

     //shipping methods
     public function shipping_methods()
     {
         $result = array();
         if (!empty(session('shipping_address'))) {
             $countries_id = session('shipping_address')->countries_id;
             $toPostalCode = session('shipping_address')->postcode;
             $toCity = session('shipping_address')->city;
             $toAddress = 'gh';
             $countries = $this->order->getCountries($countries_id);
             $toCountry = $countries[0]->countries_iso_code_2;
             $zone_id = session('shipping_address')->zone_id;
             if ($zone_id != -1 and !empty($zone_id)) {
                 $zones = $this->order->getZones($zone_id);
                 $toState = $zones[0]->zone_code;
             }
         } else {
             $countries_id = '';
             $toPostalCode = '';
             $toCity = '';
             $toAddress = '';
             $toCountry = '';
             $zone_id = '';
         }
 
         //product weight
         $cart = $this->cart->myCart($result);
 
         $index = '0';
         $total_weight = '0';
 
         foreach ($cart as $products_data) {
             if ($products_data->unit == 'Gram') {
                 $productsWeight = $products_data->weight / 453.59237;
             } else if ($products_data->unit == 'Kilogram') {
                 $productsWeight = $products_data->weight / 0.45359237;
             } else {
                 $productsWeight = $products_data->weight;
             }
 
             $total_weight += $productsWeight;
         }
 
         $products_weight = $total_weight;
 
         //website path
         //$websiteURL =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
         $websiteURL = "https://" . $_SERVER['SERVER_NAME'] . '/';
         $replaceURL = str_replace('getRate', '', $websiteURL);
         $requiredURL = $replaceURL . 'app/ups/ups.php';
 
         //default shipping method
         $shippings = $this->order->getShippingMethods();
         $result = array();
         $mainIndex = 0;
         foreach ($shippings as $shipping_methods) {
 
             $shippings_detail = $this->order->getShippingDetail($shipping_methods);
 
             //ups shipping rate
             if ($shipping_methods->methods_type_link == 'upsShipping' and $shipping_methods->status == '1') {
 
                 $result2 = array();
                 $is_transaction = '0';
 
                 $ups_shipping = $this->order->getUpsShipping();
 
                 //shipp from and all credentials
                 $accessKey = $ups_shipping[0]->access_key;
                 $userId = $ups_shipping[0]->user_name;
                 $password = $ups_shipping[0]->password;
 
                 //ship from address
                 $fromAddress = $ups_shipping[0]->address_line_1;
                 $fromPostalCode = $ups_shipping[0]->post_code;
                 $fromCity = $ups_shipping[0]->city;
                 $fromState = $ups_shipping[0]->state;
                 $fromCountry = $ups_shipping[0]->country;
 
                 //production or test mode
                 if ($ups_shipping[0]->shippingEnvironment == 1) { #production mode
                 $useIntegration = true;
                 } else {
                     $useIntegration = false; #test mode
                 }
 
                 $serviceData = explode(',', $ups_shipping[0]->serviceType);
 
                 $index = 0;
                 foreach ($serviceData as $value) {
                     if ($value == "US_01") {
                         $name = Lang::get('website.Next Day Air');
                         $serviceTtype = "1DA";
                     } else if ($value == "US_02") {
                         $name = Lang::get('website.2nd Day Air');
                         $serviceTtype = "2DA";
                     } else if ($value == "US_03") {
                         $name = Lang::get('website.Ground');
                         $serviceTtype = "GND";
                     } else if ($value == "US_12") {
                         $name = Lang::get('website.3 Day Select');
                         $serviceTtype = "3DS";
                     } else if ($value == "US_13") {
                         $name = Lang::get('website.Next Day Air Saver');
                         $serviceTtype = "1DP";
                     } else if ($value == "US_14") {
                         $name = Lang::get('website.Next Day Air Early A.M.');
                         $serviceTtype = "1DM";
                     } else if ($value == "US_59") {
                         $name = Lang::get('website.2nd Day Air A.M.');
                         $serviceTtype = "2DM";
                     } else if ($value == "IN_07") {
                         $name = Lang::get('website.Worldwide Express');
                         $serviceTtype = "UPSWWE";
                     } else if ($value == "IN_08") {
                         $name = Lang::get('website.Worldwide Expedited');
                         $serviceTtype = "UPSWWX";
                     } else if ($value == "IN_11") {
                         $name = Lang::get('website.Standard');
                         $serviceTtype = "UPSSTD";
                     } else if ($value == "IN_54") {
                         $name = Lang::get('website.Worldwide Express Plus');
                         $serviceTtype = "UPSWWEXPP";
                     }
 
                     $some_data = array(
                         'access_key' => $accessKey, # UPS License Number
                         'user_name' => $userId, # UPS Username
                         'password' => $password, # UPS Password
                         'pickUpType' => '03', # Drop Off Location
                         'shipToPostalCode' => $toPostalCode, # Destination  Postal Code
                         'shipToCountryCode' => $toCountry, # Destination  Country
                         'shipFromPostalCode' => $fromPostalCode, # Origin Postal Code
                         'shipFromCountryCode' => $fromCountry, # Origin Country
                         'residentialIndicator' => 'IN', # Residence Shipping and for commercial shipping "COM"
                         'cServiceCodes' => $serviceTtype, # Sipping rate for UPS Ground
                         'packagingType' => '02',
                         'packageWeight' => $productsWeight,
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
 
                     if (is_numeric($rate)) {
                         $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name, 'is_default' => $shipping_methods->isDefault);
                         $result2[$index] = array('name' => $name, 'rate' => $rate, 'currencyCode' => 'MYR', 'shipping_method' => 'upsShipping');
                         $index++;
                     } else {
                         $success = array('success' => '0', 'message' => "Selected regions are not supported for UPS shipping", 'name' => $shippings_detail[0]->name);
                     }
                     $success['services'] = $result2;
                 }
                 $result[$mainIndex] = $success;
                 $mainIndex++;
 
                
 
             }
             
             else if($shipping_methods->methods_type_link == 'localPickup' and $shipping_methods->status == '1') {

                $data2 = array('name' => $shipping_methods->name, 'rate' => 0, 'currencyCode' => $shipping_methods->currency, 'shipping_method' => 'localPickup');
              
                    $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shipping_methods->name, 'weight' => 0, 'is_default' => $shipping_methods->isDefault);
                    $success['services'][0] = $data2;
                    $result[$mainIndex] = $success;
                    $mainIndex++;
        
              }
              
              
              else if ($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1') {
                 $ups_shipping = $this->order->getUpsShippingRate();
                 $data2 = array('name' => $shipping_methods->name, 'rate' => $shipping_methods->flate_rate, 'currencyCode' => $shipping_methods->currency, 'shipping_method' => 'flateRate');
                 if (count($ups_shipping) > 0) {
                     $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shipping_methods->name, 'weight' => 0, 'is_default' => $shipping_methods->isDefault);
                     $success['services'][0] = $data2;
                     $result[$mainIndex] = $success;
                     $mainIndex++;
                 }
               
             }
             
             else if ($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1') {
                $ups_shipping = $this->order->getUpsShippingRate();
                $data2 = array('name' => $shipping_methods->name, 'rate' => $shipping_methods->flate_rate, 'currencyCode' => $shipping_methods->currency, 'shipping_method' => 'flateRate');
                if (count($ups_shipping) > 0) {
                    $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shipping_methods->name, 'weight' => 0, 'is_default' => $shipping_methods->isDefault);
                    $success['services'][0] = $data2;
                    $result[$mainIndex] = $success;
                    $mainIndex++;
                }
              
            }
            else if ($shipping_methods->methods_type_link == 'shippingByWeightAndKM' and $shipping_methods->status == '1') {

                if(!empty(session('shipping_address'))) 
                {
                    $delivery_latitude = session('shipping_address')->latitude;
                    $delivery_longitude = session('shipping_address')->longitude;
                   
                    $settings = $this->index->commonContent();
            
                    $contact_latitude =$settings['settings']['latitude'];
                    $contact_longitude =$settings['settings']['longitude'];

                    $range = $this->getDistanceBetweenPointsNew($delivery_latitude,$delivery_longitude,$contact_latitude,$contact_longitude,'kilometers');
            
                    $kilometer = round($range);

                   //print_r($kilometer);

                    $pricebykm = DB::table('shipping_by_weight_and_km')->where('from_weight_km', '<=', $kilometer)->where('to_weight_km', '>=', $kilometer)->where('type', 'KM')->where('status', 1)->get();

                        if (!empty($pricebykm) and count($pricebykm) > 0) {
                            $priceKM = $pricebykm[0]->price_weight_km;
                        } else {
                            $priceKM = 0;
                        }

                    $carts = $this->cart->myCart('');
 
                    $weight = 0;
                    foreach ($carts as $cart) {
                        $weight += $cart->weight * $cart->customers_basket_quantity;
                    }
                    //print_r($weight);

                    $priceByWeight = DB::table('shipping_by_weight_and_km')->where('from_weight_km', '<=', $weight)->where('to_weight_km', '>=', $weight)->where('type', 'Weight')->where('status', 1)->get();

                        if (!empty($priceByWeight) and count($priceByWeight) > 0) {
                            $priceWeight = $priceByWeight[0]->price_weight_km;
                        } else {
                            $priceWeight = 0;
                        }

                        $tPrice = $priceWeight + $priceKM;

                    if (count($pricebykm) > 0) {

                       
                        $price = $tPrice;
                        $msg = '1';
                    }
                    else
                    {
                        $price = 0;
                        $msg = '3';
                    }
                }
                else
                {
                    $kilometer = 0;
                    $price = 0;
                    $msg = '3';
                }

                $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();


 
                 $data2 = array('name' => $shippings_detail[0]->name, 'rate' => $price, 'currencyCode' => 'MYR', 'shipping_method' => 'shippingByKM','km' => $kilometer,'weight' => $weight,'getallkm' => $getallkm);
                 $success = array('success' => $msg, 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name,'km' => $kilometer,'weight' => $weight, 'is_default' => 1);
                 $success['services'][0] = $data2;
                 $result[$mainIndex] = $success;
                 $mainIndex++;
 
             } 

            else if ($shipping_methods->methods_type_link == 'shippingByKM' and $shipping_methods->status == '1') {

                if(!empty(session('shipping_address'))) 
                {
                    $delivery_latitude = session('shipping_address')->latitude;
                    $delivery_longitude = session('shipping_address')->longitude;
                   
                    $settings = $this->index->commonContent();
            
                    $contact_latitude =$settings['settings']['latitude'];
                    $contact_longitude =$settings['settings']['longitude'];

                    $range = $this->getDistanceBetweenPointsNew($delivery_latitude,$delivery_longitude,$contact_latitude,$contact_longitude,'kilometers');
            
                    $kilometer = round($range);

                   

                    $pricebykm = DB::table('products_shipping_rates_km')->where('km_from', '<=', $kilometer)->where('km_to', '>=', $kilometer)->where('km_status', 1)->get();

                   

                 

                    if (count($pricebykm) > 0) {
                        $price = $pricebykm[0]->km_price;
                        $msg = '1';
                    }
                    else
                    {
                        $price = 0;
                        $msg = '3';
                    }
                }
                else
                {
                    $kilometer = 0;
                    $price = 0;
                    $msg = '3';
                }

                $getallkm = DB::table('products_shipping_rates_km')->where('km_status', 1)->get();


 
                 $data2 = array('name' => $shippings_detail[0]->name, 'rate' => $price, 'currencyCode' => 'MYR', 'shipping_method' => 'shippingByKM','km' => $kilometer,'getallkm' => $getallkm);
                 $success = array('success' => $msg, 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name,'km' => $kilometer,'weight' => 0, 'is_default' => 1);
                 $success['services'][0] = $data2;
                 $result[$mainIndex] = $success;
                 $mainIndex++;
 
             } else if ($shipping_methods->methods_type_link == 'freeShipping' and $shipping_methods->status == '1') {
 
                 $data2 = array('name' => $shippings_detail[0]->name, 'weight' => 0,  'rate' => '0', 'currencyCode' => 'MYR', 'shipping_method' => 'freeShipping');
                 $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name, 'weight' => 0, 'is_default' => $shipping_methods->isDefault);
                 $success['services'][0] = $data2;
                 $result[$mainIndex] = $success;
                 $mainIndex++;
                 
             } else if ($shipping_methods->methods_type_link == 'grab' and $shipping_methods->status == '1') {

                $data2 = array('name' => $shippings_detail[0]->name, 'weight' => 0,  'rate' => '0', 'currencyCode' => 'MYR', 'shipping_method' => 'grab');
                 $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name, 'weight' => 0, 'is_default' => $shipping_methods->isDefault);
                 $success['services'][0] = $data2;
                 $result[$mainIndex] = $success;
                 $mainIndex++;

             } else if ($shipping_methods->methods_type_link == 'shippingByWeight' and $shipping_methods->status == '1') {
 
                 //cart data
                 $carts = $this->cart->myCart('');
 
                 $weight = 0;
                 foreach ($carts as $cart) {
                     $weight += $cart->weight * $cart->customers_basket_quantity;
                 }
                 
 
                 //check price by weight
                 $priceByWeight = $this->order->priceByWeight($weight);
 
                 if (!empty($priceByWeight) and count($priceByWeight) > 0) {
                     $price = $priceByWeight[0]->weight_price;
                 } else {
                     $price = 0;
                 }
 
                 $data2 = array('name' => $shippings_detail[0]->name, 'weight' => $weight, 'rate' => $price, 'currencyCode' => 'MYR', 'shipping_method' => 'shippingByWeight');
                 $success = array('success' => '1', 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name, 'weight' => $weight, 'is_default' => $shipping_methods->isDefault);
                 $success['services'][0] = $data2;
                 $result[$mainIndex] = $success;
                 $mainIndex++;
             }
         }
         //print_r($result);die();
         return $result;
     }

    //get default payment method
    public function getPaymentMethods()
    {

        /**   BRAIN TREE **/
        //////////////////////
        $result = array();
        $payments_setting = $this->order->payments_setting_for_brain_tree();
        if ($payments_setting['merchant_id']->environment == '0') {
            $braintree_enviroment = 'Test';
        } else {
            $braintree_enviroment = 'Live';
        }

        $braintree = array(
            'environment' => $braintree_enviroment,
            'name' => $payments_setting['merchant_id']->name,
            'public_key' => $payments_setting['public_key']->value,
            'active' => $payments_setting['merchant_id']->status,
            'payment_method' => $payments_setting['merchant_id']->payment_method,
            'payment_currency' => Session::get('currency_code'),
        );
        /**  END BRAIN TREE **/
        //////////////////////

        /**   STRIPE**/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_stripe();
        if ($payments_setting['publishable_key']->environment == '0') {
            $stripe_enviroment = 'Test';
        } else {
            $stripe_enviroment = 'Live';
        }

        $stripe = array(
            'environment' => $stripe_enviroment,
            'name' => $payments_setting['publishable_key']->name,
            'public_key' => $payments_setting['publishable_key']->value,
            'active' => $payments_setting['publishable_key']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['publishable_key']->payment_method,
        );

        /**   END STRIPE**/
        //////////////////////

        /**   CASH ON DELIVERY**/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_cod();

        $cod = array(
            'environment' => 'Live',
            'name' => $payments_setting->name,
            'public_key' => '',
            'active' => $payments_setting->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting->payment_method,
        );

        /**   END CASH ON DELIVERY**/
        /*************************/

      
        /*************************/

        /**   INSTAMOJO**/
        /*************************/
        $payments_setting = $this->order->payments_setting_for_instamojo();
        if ($payments_setting['auth_token']->environment == '0') {
            $instamojo_enviroment = 'Test';
        } else {
            $instamojo_enviroment = 'Live';
        }

        $instamojo = array(
            'environment' => $instamojo_enviroment,
            'name' => $payments_setting['auth_token']->name,
            'public_key' => $payments_setting['api_key']->value,
            'active' => $payments_setting['api_key']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['api_key']->payment_method,
        );

        /**   END INSTAMOJO**/
        /*************************/

        /**   END HYPERPAY**/
        /*************************/
        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //dd($payments_setting);
        if ($payments_setting['userid']->environment == '0') {
            $hyperpay_enviroment = 'Test';
        } else {
            $hyperpay_enviroment = 'Live';
        }

        $hyperpay = array(
            'environment' => $hyperpay_enviroment,
            'name' => $payments_setting['userid']->name,
            'public_key' => $payments_setting['userid']->value,
            'active' => $payments_setting['userid']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['userid']->payment_method,
        );
        /**   END HYPERPAY**/
        /*************************/

        $payments_setting = $this->order->payments_setting_for_razorpay();
        
        if ($payments_setting['RAZORPAY_SECRET']->environment == '0') {
            $razorpay_enviroment = 'Test';
        } else {
            $razorpay_enviroment = 'Live';
        }

        $razorpay = array(
            'environment' => $razorpay_enviroment,
            'public_key' => $payments_setting['RAZORPAY_KEY']->value,
            'name' => $payments_setting['RAZORPAY_KEY']->name,
            'RAZORPAY_KEY' => $payments_setting['RAZORPAY_KEY']->value,
            'RAZORPAY_SECRET' => $payments_setting['RAZORPAY_SECRET']->value,
            'active' => $payments_setting['RAZORPAY_SECRET']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['RAZORPAY_SECRET']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_paytm();
        

        if ($payments_setting['paytm_mid']->environment == '0') {
            $paytm_enviroment = 'Test';
        } else {
            $paytm_enviroment = 'Live';
        }

        $paytm = array(
            'environment' => $paytm_enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => '',
            'name' => $payments_setting['paytm_mid']->name,
            'active' => $payments_setting['paytm_mid']->status,
            'payment_method' => $payments_setting['paytm_mid']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_directbank();     

        if ($payments_setting['account_name']->environment == '0') {
            $enviroment = 'Live';
        } else {
            $enviroment = 'Live';
        }

        $banktransfer = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => '',
            'name' => $payments_setting['account_name']->name,
            'descriptions' => $payments_setting['account_name']->sub_name_1,
            'active' => $payments_setting['account_name']->status,
            'payment_method' => $payments_setting['account_name']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_paystack();   
        if ($payments_setting['secret_key']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $paystack = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['secret_key']->value,
            'name' => $payments_setting['secret_key']->name,
            'active' => $payments_setting['secret_key']->status,
            'payment_method' => $payments_setting['secret_key']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_midtrans();  

        if ($payments_setting['merchant_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $midtrans = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['server_key']->value,
            'name' => $payments_setting['merchant_id']->name,
            'active' => $payments_setting['merchant_id']->status,
            'payment_method' => $payments_setting['merchant_id']->payment_method,
        ); 
         /**   ipay88 **/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_ipay88();  

        if ($payments_setting['merchant_code']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $ipay88 = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['merchant_key']->value,
            'merchant_code'=> $payments_setting['merchant_code']->value,
            'name' => $payments_setting['merchant_code']->name,
            'active' => $payments_setting['merchant_code']->status,
            'payment_method' => $payments_setting['merchant_code']->payment_method,
        );

        /** paynet_fpx **/
        ////////////////////// 

        $payments_setting = $this->order->payments_setting_for_paynet_fpx();  

        if ($payments_setting['seller_ex_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $paynetfpx = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['seller_id']->value,
            'merchant_code'=> $payments_setting['seller_ex_id']->value,
            'name' => $payments_setting['seller_ex_id']->name,
            'active' => $payments_setting['seller_ex_id']->status,
            'payment_method' => $payments_setting['seller_ex_id']->payment_method,

        );

         /** PremierPay **/
        ////////////////////// 

        $payments_setting = $this->order->payments_setting_for_premierpay();  

        if ($payments_setting['store_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $premierpay = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['store_id']->value,
            'merchant_code'=> $payments_setting['store_key']->value,
            'name' => $payments_setting['store_id']->name,
            'active' => $payments_setting['store_id']->status,
            'payment_method' => $payments_setting['store_id']->payment_method,
            'redirect_url' => $payments_setting['store_id']->value,
            'callback_url' => $payments_setting['store_id']->value,
            'store_key' => $payments_setting['store_key']->value,
            'store_id'=> $payments_setting['store_id']->value,
        );

        /* Wallet */
        ////////////////////// 
        $payments_setting = $this->order->payments_setting_for_wallet(); 

        if ($payments_setting['wallet_code']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $wallet = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['wallet_code']->value,
            'wallet_code' => $payments_setting['wallet_code']->value,
            'name' => $payments_setting['wallet_code']->name,
            'active' => $payments_setting['wallet_code']->status,
            'payment_method' => $payments_setting['wallet_code']->payment_method,
        );

        /* Senangpay */
        ////////////////////// 
        $payments_setting = $this->order->payments_setting_for_senangpay();

        if ($payments_setting['merchant_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $senangpay = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['merchant_id']->value,
            'secretkey'=> $payments_setting['secretkey']->value,
            'name' => $payments_setting['secretkey']->name,
            'active' => $payments_setting['secretkey']->status,
            'payment_method' => $payments_setting['secretkey']->payment_method,
        );



        $result[0] = $braintree;
        $result[1] = $stripe;
        $result[2] = $cod;
        $result[4] = $instamojo;
        $result[5] = $hyperpay;
        $result[6] = $razorpay;
        $result[7] = $paytm;
        $result[8] = $banktransfer;
        $result[9] = $paystack;
        $result[10] = $midtrans;
        $result[11] = $ipay88;
        $result[12] = $paynetfpx;
        $result[13] = $premierpay;
        $result[14] = $wallet;
        $result[15] = $senangpay;
        return $result;
    }

    public function commentsOrder(Request $request)
    {
        session(['order_comments' => $request->comments]);
    }

    public function payIinstamojo(Request $request)
    {
        $commonContent = $this->index->commonContent();

        if (empty($commonContent['setting'][18]->value)) {
            $siteName = Lang::get('website.Empty Site Name');
        } else {
            $siteName = $commonContent['setting'][18]->value;
        }

        //payment methods
        $payments_setting = $this->order->payments_setting_for_instamojo();
        $instamojo_api_key = $payments_setting['api_key']->value;
        $instamojo_auth_token = $payments_setting['auth_token']->value;

        $websiteURL = "http://" . $_SERVER['SERVER_NAME'] . '/';
        $fullname = $request->fullname;
        $email_id = $request->email_id;
        $phone_number = $request->phone_number;
        $amount = $request->amount;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:" . $instamojo_api_key,
                "X-Auth-Token:" . $instamojo_auth_token));
        $payload = array(
            'purpose' => $siteName . ' Payment',
            'amount' => $amount,
            'phone' => $phone_number,
            'buyer_name' => $fullname,
            'send_email' => true,
            'send_sms' => true,
            'email' => $email_id,
            'allow_repeated_payments' => false,
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        session(['instamojo_info' => $response]);

        print_r($response);

    }

    //hyperpaytoken
    public function hyperpay(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $replaceURL = str_replace('/hyperpay', '/hyperpay/checkpayment', $actual_link);

        $amount = number_format((float) session('total_price') + 0, 2, '.', '');
        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //check envinment
        if ($payments_setting['userid']->environment == '0') {
            $env_url = "https://test.oppwa.com/v1/checkouts";
            $order_url = "test";
        } else {
            $env_url = "https://oppwa.com/v1/checkouts";
            $order_url = "live";
        }

        if(Auth::guard('customer')->check()){
            $email = auth()->guard('customer')->user()->email;
        }else{
            $email = session('shipping_address')->email;          
        }

        $url = $env_url;
        $data = "authentication.userId=" . $payments_setting['userid']->value .
        "&authentication.password=" . $payments_setting['password']->value .
        "&authentication.entityId=" . $payments_setting['entityid']->value .
        "&amount=" . $amount .
        "&currency=SAR" .
        "&paymentType=DB" .
        "&customer.email=" . $email .
        "&testMode=EXTERNAL" .
        "&merchantTransactionId=" . uniqid();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $data = json_decode($responseData);

        if ($data->result->code == '000.200.100') {
            $result['token'] = $data->id;
            $result['webURL'] = $replaceURL;
            $result['order_url'] = $order_url;

            return view("web.hyperpay", $title)->with('result', $result);
        } else {
            return redirect()->back()->with('error', $data->result->description);
        }
    }

    public function ipay88(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $amount = number_format((float) session('total_price') + 0, 2, '.', '');
        $payments_setting = $this->order->payments_setting_for_ipay88();
        session(['payment_method' => 'ipay88']);
       
        $payment_status = $this->order->place_order_new($request);
        $orders_id = session('orders_id');

        $name= DB::table('orders_products')->where('orders_id', '=', $orders_id)->first(); 
        $product_name=$name->products_name;

        $result['orders_id'] = $orders_id;
        $result['product_name'] = $product_name;
        $result['amount'] = $amount;

        $reponse = json_encode(array('orders_id'=>$orders_id, 'product_name'=>$product_name, 'amount'=>$amount));
        print $reponse;

       

        //return view("ipay.request", $title)->with('result',$payments_setting)->with('id',$orders_id);
       
    }

    public function senangPay(Request $request)
    {
        $payment_status = $this->order->place_order_new($request);
        session(['payment_method' => 'senangpay']);
        $orders_id = session('orders_id');
        print $orders_id;
             
    }
    public function senangpayRequests($id)
    {
        
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $payments_setting = $this->order->payments_setting_for_senangpay();
        $data= DB::table('orders')->where('orders_id', '=', $id)->first();
        return view("web.senangpay.senangpay", $title)->with('result',$payments_setting)->with('order_data',$data);
    }

    public function senangpayResponse(Request $request)
    {
       $status_id=$request->status_id;
       $order_id=$request->order_id;
       $transaction_id=$request->transaction_id;
       $msg=$request->msg;
       $hash=$request->hash;

       $orderdetail = [
            'status_id' => $status_id,
            'order_id' => $order_id,
            'transaction_id' => $transaction_id,
            'msg' => $msg,
            'hash' => $hash
        ];

        Order::where('transaction_id', $order_id)
                ->update([
                    'payment_status' => $status_id,
                    'order_information' => json_encode($orderdetail)
                ]);
        return redirect('/thankyou');
    }

    public function senangpayServerResponse(Request $request)
    {
       $status_id=$request->status_id;
       $order_id=$request->order_id;
       $transaction_id=$request->transaction_id;
       $msg=$request->msg;
       $hash=$request->hash;

       $orderdetail = [
            'status_id' => $status_id,
            'order_id' => $order_id,
            'transaction_id' => $transaction_id,
            'msg' => $msg,
            'hash' => $hash
        ];

        Order::where('transaction_id', $order_id)
                ->update([
                    'payment_status' => $status_id,
                    'order_information' => json_encode($orderdetail)
                ]);
        echo 'OK';
        //return 'OK';
    }
     

    public function ipay88callback(Request $request)
	    {
	    
	       	$refno = $_REQUEST["RefNo"];
	        $estatus = $_REQUEST["Status"];
	        $merchantcode = $_REQUEST["MerchantCode"];
	        $paymentid = $_REQUEST["PaymentId"];
	        $amount = $_REQUEST["Amount"];
	        $ecurrency = $_REQUEST["Currency"];
	        $remark = $_REQUEST["Remark"];
	        $transid = $_REQUEST["TransId"];
	        $authcode = $_REQUEST["AuthCode"];
	        $errdesc = $_REQUEST["ErrDesc"];
	        $signature = $_REQUEST["Signature"];
	        
	        
	        
	        if($estatus == 1){
	          $status='paid'; 
             
           			echo "RECEIVEOK";
			} 
        
		else {
		 $status='unpaid'; 
		    echo "DATA NOT RECEIVED";
		  
		}
		
		 Order::where('orders_id', $refno)
                ->update([
                    'payment_status' => $status,
                    'delivery_suburb' => "backend_url",
                    'order_information' => json_encode($orderdetail),
                    'transaction_id' => $transid
                    
                
                ]);
            
	       
	    }

        public function ipay88response(Request $request)
        {
            $refno = $_REQUEST["RefNo"];
            $estatus = $_REQUEST["Status"];
            $merchantcode = $_REQUEST["MerchantCode"];
            $paymentid = $_REQUEST["PaymentId"];
            $amount = $_REQUEST["Amount"];
            $ecurrency = $_REQUEST["Currency"];
            $remark = $_REQUEST["Remark"];
            $transid = $_REQUEST["TransId"];
            $authcode = $_REQUEST["AuthCode"];
            $errdesc = $_REQUEST["ErrDesc"];
            $signature = $_REQUEST["Signature"];
           
            
    
           /*  $orderdetails = [
                'merchantcode' => $merchantcode,
                'refno' => $refno,
                'transactionid' => $transid,
                'paymentid' => $refno,
                'amount' => $amount,
                'ecurrency' => $ecurrency,
                'remark' => $remark,
                'authcode' => $authcode,
                'errdesc' => $errdesc,
                'status' => $estatus,
                'signature' => $signature
                ];
                print_r($orderdetails);die();   */
         
            
            if($estatus==1)
            {
                $status='paid'; 
                $paystatus=2;
                session(['ipay_call' => 1]); 
                $orders_id = $refno;
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
    
    
                $myVar = new AlertController();
                $alertSetting = $myVar->orderAlert($ordersData);
            } 
            else 
            {
                 $status='unpaid'; 
                 $paystatus=0;
                 session(['ipay_call' => 0]); 
    
    
                $settings = $this->index->commonContent();

            
                $Inventory =$settings['settings']['Inventory'];
                if($Inventory == 1)
                {
                    $orders_products = DB::table('orders_products')->where('orders_id', '=', $refno)->get();
        
                    foreach ($orders_products as $products_data) {
        
                        $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
                        $date_added = date('Y-m-d H:i:s');
                        $inventory_ref_id = DB::table('inventory')->insertGetId([
                            'products_id' => $products_data->products_id,
                            'stock' => $products_data->products_quantity,
                            'reference_code' => $products_data->orders_id,
                            'admin_id' => 0,
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
                                    $prodocuts_attributes = DB::table('products_attributes')
                                        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                                        ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'options_values_id')
                                        ->where('products_options_values_descriptions.options_values_name', $attribute->products_options_values)
                                        ->where('products_options_descriptions.options_name', $attribute->products_options)
                                        ->where('products_attributes.products_id', $products_data->products_id)
                                        ->select('products_attributes.products_attributes_id')
                                        ->first();
            
            
                                    $id = DB::table('inventory_detail')->insert([
                                        'inventory_ref_id' => $inventory_ref_id,
                                        'products_id' => $products_data->products_id,
                                        'attribute_id' => $prodocuts_attributes->products_attributes_id,
                                    ]);
        
                            }
        
                        }
                    }
                }
            
                 
            }
    
            $orderdetail = [
            'merchantcode' => $merchantcode,
            'refno' => $refno,
            'transactionid' => $transid,
            'paymentid' => $refno,
            'amount' => $amount,
            'ecurrency' => $ecurrency,
            'remark' => $remark,
            'authcode' => $authcode,
            'errdesc' => $errdesc,
            'signature' => $signature,
            'payment_status' => $status
            ];
    
            Order::where('orders_id', $refno)
                    ->update([
                        'payment_status' => $paystatus,
                        'order_information' => json_encode($orderdetail),
                        'transaction_id' => $transid
                    
                    ]);
                    $order=Order::where(['orders_id'=>$refno])->first();
                $result = array();
                $result['commonContent'] = $this->index->commonContent();
            return view('ipay.response', compact('order'))->with('result', $result);
           
        }

    
    public function payipay88($id)
    {
       $title = array('pageTitle' => Lang::get('website.Checkout'));
       $payments_setting = $this->order->payments_setting_for_ipay88();
       $details = DB::table('orders')->where('transaction_id', '=', $id)->first();
       session(['orders_id' => $details->orders_id]);
       return view("ipay.request_food", ['title' => $title, 'pay_id' => $id])->with('result', $payments_setting);

    }

    public function payNow($id)
    {
        $orders = DB::table('orders')->where('order_ref_no',$id)->first();
        $order_id = $orders->orders_id;
        DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->where('is_order', 2)->orwhere('is_order', 3)->update(['is_order' => 0]);

       
        $orders_products = DB::table('orders_products')->where('orders_id', '=', $order_id)->get();

        foreach ($orders_products as $products_data) {

            $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
            //dd($product_detail);
            $date_added = date('Y-m-d h:i:s');
            $inventory_ref_id = DB::table('inventory')->insertGetId([
                'products_id' => $products_data->products_id,
                'stock' => $products_data->products_quantity,
                'admin_id' => 0,
                'reference_code' => "No reference",
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

        DB::table('orders_products_attributes')->where([['orders_id', '=', $order_id],
        ])->delete();
        DB::table('orders')->where([['orders_id', '=', $order_id],
        ])->delete();
        DB::table('inventory')->where([['reference_code', '=', $order_id],
        ])->delete();
        DB::table('orders_products')->where([['orders_id', '=', $order_id],
        ])->delete();

        return redirect('viewcart');


    }
    public function ipayresponse($id,$status)
    {
        //echo $id;
        $new_pay_id=session('orders_id');
        //print_r($new_pay_id);die();
        $date_added = date('Y-m-d h:i:s');
        if($status=='success'){

            DB::table('orders')->where('orders_id', $new_pay_id)->update(['transaction_id' => $id,'payment_status'=>'2']);

            //  //orders status history
            // $orders_history_id = DB::table('orders_status_history')->insertGetId(
            //     [
            //         'orders_id' => $new_pay_id,
            //         'orders_status_id' => '2',
            //         'date_added' => $date_added,
            //         'customer_notified' => '1',
            //         'comments' => 'Online payment success',
            //     ]
            // );
             

        }else{
            DB::table('orders')->where('orders_id', $new_pay_id)->update(['transaction_id' => $id,'payment_status'=>'1']);
             // $orders_history_id = DB::table('orders_status_history')->insertGetId(
             //    [
             //        'orders_id' => $new_pay_id,
             //        'orders_status_id' => '3',
             //        'date_added' => $date_added,
             //        'customer_notified' => '1',
             //        'comments' => 'Online payment failure',
             //    ]
            //);
             

        }
        return redirect('/thankyou');

    }

    public function appcheckout_ipay88($id)
    {
        //print_r($id);
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $amount = number_format((float) session('total_price') + 0, 2, '.', '');
        $payments_setting = $this->order->payments_setting_for_ipay88();
        $order = DB::table('orders')->where('transaction_id',$id)->first();
        if($order){
            if($order->payment_status!='2'){
                echo'Invalid Transaction Id';
            }else{
                return view("ipay.request_app_ipay88", $title)->with('result',$payments_setting)->with('order',$order);
            }
     }else{
        echo'Invalid Transaction Id';
     }
    }

    public function appcheckout_ipayresponse($id,$status)
    {
        if($status=='success'){
            DB::table('orders')->where('transaction_id', $id)->update(['payment_status'=>'2']);
            echo 'success';
        }else{
            DB::table('orders')->where('transaction_id', $id)->update(['payment_status'=>'1']);
            echo 'failure';
        }
        //return redirect('/thankyou');
    }

    public function premierpay(Request $request)
    {

        $payment_status = $this->order->place_order($request);
         if ($payment_status == 'success') {
            $PremierPay_setting = $this->order->payments_setting_for_premierpay();

                $store_key = $PremierPay_setting['store_key']->value;
                $store_id = $PremierPay_setting['store_id']->value;
                
                $callback_url = $PremierPay_setting['callback_url']->value;

                //print_r($redirect_url);die();

                if (!empty(session('order_comments'))) {
                    $comments = session('order_comments');
                } else {
                    $comments = 'string';
                }

                $timestamp = time();
                $date_added = date('Y-m-d h:i:s');

                $customers_id = auth()->guard('customer')->user() ? auth()->guard('customer')->user() ->id : "";
                $orders_id = session('orders_id');

                $refno = 'ORDINV'.$orders_id.$timestamp;

                $redirect_url = $PremierPay_setting['redirect_url']->value.'?id='.$refno;



                $str = '{"amount":200,"callbackUrl":"'.$callback_url.'","currency":"MYR","description":"Full Set","membershipReferenceNo":"'.$customers_id.'","orderReferenceNo":"'.$refno.'","redirectUrl":"'.$redirect_url.'","remarks":"'.$comments.'","title":"Grocery Platinum24"}';
                $data = base64_encode($str);

                $signature = base64_encode(hash_hmac('sha512', 'data='.$data.'&timestamp='.$timestamp.'&nonce='.$timestamp.'', $store_key, true));

                // isert premier_pay table
                $insert = $this->order->add_premier_pay($orders_id,$customers_id,$refno,$signature,$timestamp,$date_added);

                $path='https://sb-api.glypay.com/glypay/api/merchant/order/store/'.$store_id.'/online';

                session(['x-sign' => $signature]);
                session(['x-time' => $timestamp]);
                session(['x-refno' => $refno]);

                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $path,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $str,
                    CURLOPT_HTTPHEADER => array(
                        // Set here requred headers
                        "x-signature: $signature",
                        "x-timestamp: $timestamp",
                        "x-nonce: $timestamp",
                        "content-type: application/json",
                    ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
        
                $json_a=json_decode($response,true);
                $reurl = $json_a['data'];
        
                //print_r($reurl);
                //echo $response; 
                header('Location: '.$reurl.'');
                
         }else{
            return redirect()->back()->with('error', Lang::get("website.Error while placing order"));
         }
    }

    public function appcheckout_premierpay($id)
    {
        $order = DB::table('orders')->where('transaction_id',$id)->first();
        if($order){
            if($order->payment_status=='2'){
                echo'Invalid Transaction Id';
            }else{
                $PremierPay_setting = $this->order->payments_setting_for_premierpay();

                $store_key = $PremierPay_setting['store_key']->value;
                $store_id = $PremierPay_setting['store_id']->value;
                
                $callback_url = $PremierPay_setting['callback_url']->value; 

                $comments = 'string';
                $timestamp = time();
                $date_added = date('Y-m-d h:i:s');
                $customers_id = $order->customers_id;
                $orders_id = $order->orders_id;

                $refno = 'ORDINV'.$orders_id.$timestamp;
                $redirect_url = $PremierPay_setting['redirect_url']->value.'?id='.$refno;

                $str = '{"amount":200,"callbackUrl":"'.$callback_url.'","currency":"MYR","description":"Full Set","membershipReferenceNo":"'.$customers_id.'","orderReferenceNo":"'.$refno.'","redirectUrl":"'.$redirect_url.'","remarks":"'.$comments.'","title":"Grocery Platinum24"}';
                $data = base64_encode($str);

                 $signature = base64_encode(hash_hmac('sha512', 'data='.$data.'&timestamp='.$timestamp.'&nonce='.$timestamp.'', $store_key, true));

                 // isert premier_pay table
                $insert = $this->order->add_premier_pay($orders_id,$customers_id,$refno,$signature,$timestamp,$date_added);

                $path='https://sb-api.glypay.com/glypay/api/merchant/order/store/'.$store_id.'/online';

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $path,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $str,
                    CURLOPT_HTTPHEADER => array(
                        // Set here requred headers
                        "x-signature: $signature",
                        "x-timestamp: $timestamp",
                        "x-nonce: $timestamp",
                        "content-type: application/json",
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
        
                $json_a=json_decode($response,true);
                $reurl = $json_a['data'];
        
                //print_r($reurl);
                //echo $response; 
                header('Location: '.$reurl.'');
            }
     }else{
        echo'Invalid Transaction Id';
     }
    }

    public function premierpaycallback(Request $request)
    {
        $transId = $_GET["transId"];
        $status = $_GET["status"];
        $paymentMethod = $_GET["paymentMethod"];
        $paymentCode = $_GET["paymentCode"];
        $new_pay_id=session('orders_id');


        DB::table('orders')->where('orders_id', $new_pay_id)->update(['order_ref_no' => $transId,'premierpay_status_des' => $status,'premierpay_code'=> $paymentCode]);

      
    }

    //checkpayment
    public function checkpayment(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();

        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //check envinment
        if ($payments_setting['userid']->environment == '0') {
            $env_url = "https://test.oppwa.com";
        } else {
            $env_url = "https://oppwa.com";
        }

        $url = $env_url . $request->resourcePath;
        $url .= "?authentication.userId=" . $payments_setting['userid']->value;
        $url .= "&authentication.password=" . $payments_setting['password']->value;
        $url .= "&authentication.entityId=" . $payments_setting['entityid']->value;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $data = json_decode($responseData);

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $data->result->code)) {
            $transaction_id = $data->ndc;
            session(['paymentResponseData' => $data]);
            session(['paymentResponse' => 'success']);
            return redirect('/checkout');
        } else {
            session(['paymentResponseData' => $data->result->description]);
            session(['paymentResponse' => 'error']);
            return redirect('/checkout');
        }

    }

    //changeresponsestatus
    public function changeresponsestatus(Request $request)
    {
        session(['paymentResponseData' => '']);
        session(['paymentResponse' => '']);
    }

    //updatestatus
    public function updatestatus(Request $request)
    {   
        //  dd($request->orders_status);
        if (!empty($request->orders_id)) {
            $date_added = date('Y-m-d h:i:s');
            $comments = '';
            $ordersCheck = $this->order->ordersCheck($request);
            
            if (count($ordersCheck) > 0) {

                $orders_history_id = $this->Coreorder->updateRecord($request);
                // dd($orders_history_id );
                return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
            } else {
                return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
            }
        } else {
            return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
        }
    }

    //paystack

	public function paystackTransaction(REQUEST $request){

		$result = array();
        //Set other parameters as keys in the $postdata array
        //"reference" => '7PVGX8MEk85tgeEpVDtDD'

        if(Auth::guard('customer')->check()){
            $email = auth()->guard('customer')->user()->email;
        }else{
            $email = session('shipping_address')->email;          
        }
        $payments_setting = $this->order->payments_setting_for_paystack();
        $amount = number_format((float) session('total_price') + 0, 2) ;
        $amount = $amount * 100;
        // dd($amount);
		$postdata =  array('email' => $email, 'amount' => $amount, "reference" => uniqid());
		$url = "https://api.paystack.co/transaction/initialize";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
		'Authorization: Bearer '.$payments_setting['secret_key']->value,
		'Content-Type: application/json',

		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec ($ch);
        
        if ($response === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        }

		curl_close ($ch);

		// if ($response) {
		// 	$result = json_decode($response, true);
        // }
        
       
		//print_r($response);
    }

    public function authorizepaystackTransaction(REQUEST $request){

		$result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/'.$request->reference;
        $payments_setting = $this->order->payments_setting_for_paystack();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
        $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$payments_setting['secret_key']->value]
        );
        $request = curl_exec($ch);
        curl_close($ch);

        if ($request) {
            $result = json_decode($request, true);
            $message = $result['message'];
           // dd($result);

            if($result){
            //message    
            session(['paymentResponseData'=> $message]);

            if(!empty($result['data']) and count($result['data'])>0){
                //something came in
                if($result['data']['status'] == 'success'){
                // the transaction was successful, you can deliver value
                /* 
                @ also remember that if this was a card transaction, you can store the 
                @ card authorization to enable you charge the customer subsequently. 
                @ The card authorization is in: 
                @ $result['data']['authorization']['authorization_code'];
                @ PS: Store the authorization with this email address used for this transaction. 
                @ The authorization will only work with this particular email.
                @ If the user changes his email on your system, it will be unusable
                */
                //echo "Transaction was successful";

                session(['paymentResponse'=>'success']);
                session(['payment_json'=> $result]);

                }else{
                    session(['paymentResponse'=>'error']);
                // the transaction was not successful, do not deliver value'
                // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                //echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
                }
            }else{
                session(['paymentResponse'=>'error']);
            }

            }else{
            //print_r($result);
                session(['paymentResponse'=>'error']);
                $message = "Opps! Something went wrong please check merchant account seeting.";
                session(['paymentResponseData'=> $message]);
            }
        }else{
            //var_dump($request);
            session(['paymentResponse'=>'error']);
            $message = "Opps! Something went wrong please check merchant account seeting.";
            session(['paymentResponseData'=> $message]);
        }

        
        
         return redirect('checkout');
    }
    
    public function invoiceprint(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ViewOrder"));
        $language_id = '1';
        $orders_id = $request->id;

        $message = array();
        $errorMessage = array();

        $order = DB::table('orders')
            ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();
        foreach ($order as $data) {
            $orders_id = $data->orders_id;

            $orders_products = DB::table('orders_products')
                ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                ->select('orders_products.*', 'products.products_image as image')
                ->where('orders_products.orders_id', '=', $orders_id)->get();
            $i = 0;
            $total_price = 0;
            $total_tax = 0;
            $product = array();
            $subtotal = 0;
            foreach ($orders_products as $orders_products_data) {

                //categories
                $categories = DB::table('products_to_categories')
                    ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                    ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                    ->where('products_id', '=', $orders_products_data->orders_products_id)
                    ->where('categories_description.language_id', '=', $language_id)->get();

                $orders_products_data->categories = $categories;

                $product_attribute = DB::table('orders_products_attributes')
                    ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                    ])
                    ->get();

                $orders_products_data->attribute = $product_attribute;
                $product[$i] = $orders_products_data;
                $total_price = $total_price + $orders_products[$i]->final_price;

                $subtotal += $orders_products[$i]->final_price;

                $i++;
            }
            $data->data = $product;
            $orders_data[] = $data;
        }

        $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->orderBy('orders_status_history.date_added', 'desc')
            ->where('orders_id', '=', $orders_id)->get();

        $orders_status = DB::table('orders_status')->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)->get();

        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;
        $ordersData['subtotal'] = $subtotal;
        $result['commonContent'] = $this->index->commonContent();

        //$ordersData['currency'] = $this->myVarsetting->getSetting();
        //$result['commonContent'] = $this->Setting->commonContent();


        return view("web.Orders.invoiceprint", $title)->with('data', $ordersData)->with('result',$result);

    }

    public function customer_email()
    {
        $settings = $this->index->commonContent();

        $output = '';
        $outputs = '';
        $name = "Grocery platinum24 online store";
        $app_name =$settings['settings']['app_name'];
        $order_email =$settings['settings']['order_email'];
        $from = $app_name. "<".$order_email.">";
        $to = auth()->guard('customer')->user()->email;
        $website_link = $settings['settings']['external_website_link'];
        $aws_url = $settings['settings']['aws_url'];


        $result = $this->order->getporder(session('orders_id'));
        $product=$result;
        $orderno = $settings['setting'][150]->value.session('orders_id');

        $domain = $settings['setting'][123]->value;
        $api_key = $settings['setting'][122]->value;
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
                                    foreach ($product as $key => $pdata) {
                                       
                                        $productname=$pdata->products_name;
                                        $qty=$pdata->products_quantity;
                                        $imgpath=$pdata->image;
                                        $website_link = $settings['settings']['external_website_link'];

                                        if($pdata->image_path_type == 'aws')
                                        {
                                            $imgurl = $aws_url.$imgpath;
                                        }
                                        else
                                        {
                                            $imgurl = $website_link.$imgpath;
                                        }

                                           
                                       
                                       
                      
            $output             .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;vertical-align: middle;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
                                    <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';
                                    }
            $output             .= '</div><div><p style="color: #212529;"> If you have any questions, reply to this email or contact us at <span style="color:#fd5397">orders@grocery.platinum24.net</span></p></div>';

            $html = $output;

            $result=$this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

            // admin mail

            $outputs  .= '<div><h1 style="color: #fd5397;">'.$name.'<span style="font-size: 12px; float: right; color: #212529; padding-top:10px;">'.$orderno.'</span></h1></div>
        <div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
        <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div>
        <div style="border-bottom: 1px solid #dee2e6; padding: 15px 0; "></div>
        <div><h2 style="color: #212529; font-weight: 400;">Items in this shippment</h2></div><div>';

        foreach ($product as $key => $pdata) {
           
            $productname=$pdata->products_name;
            $qty=$pdata->products_quantity;
            $imgpath=$pdata->image;
            if($pdata->image_path_type == 'aws')
                {
                    $imgurl = $aws_url.$imgpath;
                }
                else
                {
                    $imgurl = $website_link.$imgpath;
                }
           

            $outputs .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
                    <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';
                    }
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
    }

    //order_detail
    public function paymentComponentWallet(Request $request)
    {
        session(['payment_method' => $request->payment_method]);
        session(['wallet_price' => $request->wamount]);
        session(['onlinetype' => $request->onlinetype]);
    }

    public function wallet_thankyou(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Thank You'));

        $bankdetail = array();
        
   
        if(!empty(session('wpay_status')) and session('wpay_status') == '3'){
            $payments_setting = $this->order->payments_setting_for_directbank();    
           

            $bankdetail = array(
                'account_name' => $payments_setting['account_name']->value,
                'account_number' => $payments_setting['account_number']->value,
                'payment_method' => $payments_setting['account_name']->payment_method,
                'bank_name' => $payments_setting['bank_name']->value,
                'short_code' => $payments_setting['short_code']->value,
                'iban' => $payments_setting['iban']->value,
                'swift' => $payments_setting['swift']->value,
            );
           
        }
        //print_r($bankdetail);die();
       
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent(); 

        session(['wallet_price' => '']);
        session(['onlinetype' => '']);

        return view("web.wallet_thankyou", ['title' => $title, 'final_theme' => $final_theme,'bankdetail'=>$bankdetail])->with('result', $result);
    }

    

    public function  order_filter(Request $request){

        $title = array('pageTitle' => Lang::get("website.My Orders"));
        $final_theme = $this->theme->theme();
        $result = $this->order->ordersFilter($request); 

        $language_id = 1;
        $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
         $result['status'] = $status;

        //print_r($result);die();    
        return view("web.orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }



    public function  order_filter_pending(Request $request){

        $title = array('pageTitle' => Lang::get("website.My Orders"));
        $final_theme = $this->theme->theme();
        $result = $this->order->ordersFilterPending($request); 

        $language_id = 1;
        $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
         $result['status'] = $status;

        //print_r($result);die();    
        return view("web.pending_orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }


    public function  order_filter_completed(Request $request){

        $title = array('pageTitle' => Lang::get("website.My Orders"));
        $final_theme = $this->theme->theme();
        $result = $this->order->ordersFilterCompleted($request); 

        $language_id = 1;
        $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
         $result['status'] = $status;

        //print_r($result);die();    
        return view("web.completed_orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }



    public function orderExport(Request $request) 
    {

        $date = date('Y-m-d H:i:s');

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        if($request->status_name == 'All'){
            $orders = DB::table('orders')->select('orders_id','date_purchased')->orderBy('date_purchased', 'DESC')->where('customers_id', '=', auth()->guard('customer')->user()->id);
        } elseif($request->status_name == 'Pending'){
            $orders = DB::table('orders')->orderBy('date_purchased', 'DESC')->where('order_status_id','!=',2)->where('order_status_id','!=',3)->where('customers_id', '=', Session::get('customers_id'));
        } elseif($request->status_name == 'Completed'){
            $orders = DB::table('orders')->orderBy('date_purchased', 'DESC')->where('order_status_id','=',2)->where('customers_id', '=', auth()->guard('customer')->user()->id);
        }

        if ($orders_id) {
            $orders->where(function ($q) use ($orders_id) {
                $q->where('orders_id', 'like', "$orders_id%");
            });
        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $orders->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }
        if ($orders_status) {
            $orders->where('order_status_id', $orders_status);
        }

        $orders = $orders->get();

        $index = 0;
        $total_price = array();
        $productQty = array();

        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')
                ->select('final_price', DB::raw('SUM(final_price) as total_price'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->get();

                $orders_products_count = DB::table('orders_products')
                ->select('products_quantity', DB::raw('SUM(products_quantity) as productQty'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->get();

            $orders[$index]->productQty = $orders_products_count[0]->productQty;
            $orders[$index]->total_price = Session::get('symbol_left').' '.$orders_products[0]->total_price. ' ' .Session::get('symbol_right');

            

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
                ->where('orders_status.role_id', '=', 2)->where('orders_id', '=', $orders_data->orders_id)->where('orders_status_description.language_id', session('language_id'))->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();

            //$orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            $index++;
        }

        return Excel::download(new ExportsOrders($orders), 'Orders_'.$date.'.xlsx');
    }  


    public function orderPDF(Request $request) 
    {

        $result['commonContent'] = $this->index->commonContent();
        
        $date = date('Y-m-d H:i:s');

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        if($request->status_name == 'All'){
            $orders = DB::table('orders')->select('orders_id','date_purchased')->orderBy('date_purchased', 'DESC')->where('customers_id', '=', auth()->guard('customer')->user()->id);
        } elseif($request->status_name == 'Pending'){
            $orders = DB::table('orders')->orderBy('date_purchased', 'DESC')->where('order_status_id','!=',2)->where('order_status_id','!=',3)->where('customers_id', '=', Session::get('customers_id'));
        } elseif($request->status_name == 'Completed'){
            $orders = DB::table('orders')->orderBy('date_purchased', 'DESC')->where('order_status_id','=',2)->where('customers_id', '=', auth()->guard('customer')->user()->id);
        }

        if ($orders_id) {
            $orders->where(function ($q) use ($orders_id) {
                $q->where('orders_id', 'like', "$orders_id%");
            });
        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $orders->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }
        if ($orders_status) {
            $orders->where('order_status_id', $orders_status);
        }

        $orders = $orders->get();

        $index = 0;
        $total_price = array();
        $productQty = array();

        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')
                ->select('final_price', DB::raw('SUM(final_price) as total_price'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->get();

                $orders_products_count = DB::table('orders_products')
                ->select('products_quantity', DB::raw('SUM(products_quantity) as productQty'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->get();

            $orders[$index]->productQty = $orders_products_count[0]->productQty;
            $orders[$index]->total_price = Session::get('symbol_left').' '.$orders_products[0]->total_price. ' ' .Session::get('symbol_right');

            

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
                ->where('orders_status.role_id', '=', 2)->where('orders_id', '=', $orders_data->orders_id)->where('orders_status_description.language_id', session('language_id'))->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();

            //$orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            $index++;
        }

        $result['orders'] = $orders;

        $pdf = PDF::loadView('web.Orders.orderspdf', ['result' => $result]);

        return $pdf->download('Orders_'.$date.'.pdf');
    }  



}
