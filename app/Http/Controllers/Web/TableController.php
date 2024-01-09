<?php 
namespace App\Http\Controllers\Web;
use App\Models\Web\Cart;
use App\Models\Web\Index;
use App\Models\Web\Products;
use Illuminate\Support\Facades\Validator;
use App\Models\Web\Table;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Order;
use App\Models\Web\Customer;
use Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Auth;
use Session;
use Config;
use App;

class TableController extends Controller
{
	public function __construct(
        Index $index,
        Products $products,
        Table $table,
        Customer $customer,
        Order $order,
        Cart $cart
    ) {
        $this->index = $index;
        $this->products = $products;
        $this->customer = $customer;
        $this->cart = $cart;
        $this->table = $table;
        $this->order = $order;
        $this->theme = new ThemeController();

    }

    public function addtableorder(Request $request)
    {
    	$payment_status = $this->table->place_order($request);
        session(['tablepaystatus' => '3']);
        session(['payment_method' => '']);
        return redirect('/tablethankyou');	  
    }

    public function qrcodeprofile(Request $request)
    {
       
        $user  = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
    	return view('web.table.qrcodeprofile')->with('user', $user);
    }


    
    public function placeatcounter(Request $request)
    {
    	$payment_status = $this->table->placeatcounter($request);
        session(['tablepaystatus' => '3']);
        session(['payment_method' => '']);
        return redirect('/tablethankyou');	  

    }

    public function tablethankyou(Request $request)
    {	
    	$title = array('pageTitle' => Lang::get('website.Thank You'));
    	$final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
    	return view("web.table.tablethankyou", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }
    public function orderHistory(Request $request)
    {
        $title = array('pageTitle' => 'Order History');
        $result['payment_methods'] = $this->getPaymentMethods();
        $ordersData = $this->table->detail();
        $bankdetail = array();
        
   
    
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
           
       
        //print_r($ordersData);die();
        return view("web.table.order_history", ['title' => $title, 'data'=>$ordersData, 'bankdetail'=>$bankdetail])->with('result', $result);
    }

    public function tablepay(Request $request)
    {
        $orders = $this->table->add_payment($request);

        session(['tablepaystatus' => '2']);
        session(['payment_method' => '']);
        session(['table_qrcode' => '']);

    }

    public function webthankyou(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Thank You'));
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        return view("web.table.webthankyou", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function tableipay(Request $request)
    {
        $payments_setting = $this->order->payments_setting_for_ipay88();
        return view("ipay.request_web_order")->with('result',$payments_setting);
       
    }

    public function tableipayresponse(Request $request)
    {
            $payment_method = session('payment_method');
            $borderid=session('table_qrcode');
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
            $data=array("RefNo"=>$_REQUEST["RefNo"],'Status'=>$_REQUEST["Status"],"MerchantCode"=>$_REQUEST["MerchantCode"],"PaymentId"=>$_REQUEST["PaymentId"],"Amount"=>$_REQUEST["Amount"],"Currency"=>$_REQUEST["Currency"],"Remark"=>$_REQUEST["Remark"],"TransId"=>$_REQUEST["TransId"],"AuthCode"=>$_REQUEST["AuthCode"],"ErrDesc"=>$_REQUEST["ErrDesc"],"Signature"=>$_REQUEST["Signature"]);
            $response=json_encode($data);

            if($estatus==1){
                $pay_status='TXN_SUCCESS';
                $status='2';
                $paid_status='1';
            }else{
                $pay_status='TXN_FAILURE';
                $status='1';
                $paid_status='3';
            }

             $orders_products_id = DB::table('table_payment')->insertGetId([
                        'amount' => $_REQUEST["Amount"],
                        'payment_method' => $payment_method,
                        'payment_response' => $response,
                        'payment_status' => $pay_status,
                        'status' => $status,
                        'book_id' => $borderid,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
        // update table booking
        if($status == 2)
        {
        $this->place_order_table($paid_status,$status,$data,$payment_method);
        }
      
        return redirect('/tablethankyou');
    }

    public function qrcodeexpired()
    {
        return view('errors.qrcodeexpired');
    }

    public function qrcodeorder(Request $request)
    {
         $result = array();
         $borderid=session('table_qrcode');
         $result['commonContent'] = $this->index->commonContent();
         //print_r($borderid);die();
         // update table booking
            DB::table('booking_table')->where('qrcode', $borderid)->update([
            'checkin_date' => date('Y-m-d h:i:s'),
            'status'=>'checkin'
            ]);
         $result['categories'] = $this->table->categories();

         $languages = DB::table('languages')
            ->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
            ->select('languages.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
            ->where('languages.is_default', '1')
            ->get(); 

            if (!Session::has('custom_locale')) {
                $locale = $languages[0]->code;
                session()->put('language_id', $languages[0]->languages_id);
                session()->put('direction', $languages[0]->direction);
                session()->put('locale', $languages[0]->code);
                session()->put('language_name', $languages[0]->name);
                session()->put('language_image', $languages[0]->image_path);
                App::setLocale($locale);
            }

        // print_r($result['categories']);die();
        
         $totalprice = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('order_status', '=', 0)->sum(DB::raw('original_price * customers_basket_quantity'));

        $totalprice = $totalprice * session('currency_value');

         $result['total_amount'] = $totalprice;
         
         return view('web.table.qrcodeorder')->with('result', $result);
    }

    public function qrcodedetail(Request $request)
    {
        $result = array();
        $type = "";
        $limit = 15;
        $min_price = '';
        $max_price = '';
        $result['categories'] = $this->table->categories();
        $product_check  = DB::table('products')->where('products_slug',$request->slug)->first();
        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $product_check->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->table->products($data);
        $result['detail'] = $detail;
        //print_r($result['detail']);die();
        return view('web.table.qrcodedetail')->with('result', $result);
    }

    public function qrcodecart(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->table->getallcard(session('table_qrcode'));
        $result['categories'] = $this->table->categories();
        return view('web.table.qrcodecart')->with('result', $result);
    }
    public function orderconfirmation(Request $request)
    {
        $result = array();
        $result['categories'] = $this->products->categories();
        return view('web.table.orderconfirmation')->with('result', $result);
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
        //$result[2] = $cod;
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

    public function qrcodelogout(Request $request)
    {
       
       
            Auth::guard('customer')->logout();  

            return redirect('/merchant/'.session('table_qrcode'));
         
      
    }


    public function qrcodetable(Request $request)
    {
         $result = array();
         $borderid=session('table_qrcode');
         //print_r($borderid);die();
         // update table booking
            DB::table('booking_table')->where('qrcode', $borderid)->update([
            'checkin_date' => date('Y-m-d h:i:s'),
            'status'=>'checkin'
            ]);
            Auth::guard('customer')->logout();  
         
         return view('web.table.qrcodetable');
    }

    public function qrcodelogintable(Request $request)
    {
         $result = array();
         $borderid=session('table_qrcode');
         //print_r($borderid);die();
         // update table booking
            DB::table('booking_table')->where('qrcode', $borderid)->update([
            'checkin_date' => date('Y-m-d h:i:s'),
            'status'=>'checkin'
            ]);
         
         return view('web.table.qrcodetable');
    }


    public function DeleteAll(Request $request)
    {
        $deleteId = $request->deleteId;

        $chkdd =  DB::table('customers_basket')->where('session_id', $deleteId)->where('is_order', '0')->first();
        $cusBack =  DB::table('customers_basket')->where('session_id', $deleteId)->where('is_order', '0')->delete();

        if($chkdd){
            $cusBackAtt =  DB::table('customers_basket_attributes')->where('session_id', $deleteId)->delete();
        }

    }


    public function plusMinus(Request $request)
    {
        $insertid=$request->cart_id;
        $qtyplus=$request->new_quantity;


        $data = DB::table('customers_basket')->where('customers_basket_id', $insertid)->first();
            $Price = $data->original_price;

         $res =   DB::table('customers_basket')->where('customers_basket_id', $insertid)->update([
                'customers_basket_quantity' => $qtyplus,
                'final_price'=>$Price
                ]);
        
        


        $totQty = DB::table('customers_basket')->select('customers_basket.*', DB::raw('SUM(final_price) as total'))->where('session_id',  session('table_qrcode'))->where('is_order', '0')->get();

        $TotalQty = 0;
        foreach ($totQty as $tQty){
            $TotalQty = $tQty->total;
        }
        
        $final_price = $TotalQty*$qtyplus * session('currency_value');;
        $cart_total_amount_new = number_format($final_price, 2);
    

        return response()->json([
            'proQty'=>$Price,
            'TotalQty'=>$cart_total_amount_new
        ]);
    
    }


    public function editqrcodedetail(Request $request)
    {
        $result = array();
        $type = "";
        $limit = 15;
        $min_price = '';
        $max_price = '';
        $result['commonContent'] = $this->index->commonContent();
        $result['categories'] = $this->table->categories();
        $att_empty_check = DB::table('customers_basket_attributes')->where('customers_basket_id', $request->slug)->first();
        $get_quantity = DB::table('customers_basket')->where('customers_basket_id', $request->slug)->first();
     
        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $att_empty_check->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->table->products($data);
        $result['detail'] = $detail;
        //print_r($result['detail']);die();
        return view('web.table.edit_qrcodedetail')->with('customers_basket_id', $request->slug)->with('customers_basket_quantity', $get_quantity->customers_basket_quantity)->with('result', $result);
    }

    public function DeleteByID(Request $request)
    {

        $deleteId = $request->deleteId;
        $apiToken = $request->token;

        if (is_string($deleteId)) {
            $deleteIdArray = explode(',', $deleteId);
        } else {
            $deleteIdArray = $deleteId;
        }
        
        $cusBack = DB::table('customers_basket')
            ->where('session_id', $apiToken)
            ->where('is_order', '0')
            ->whereIn('customers_basket_id', $deleteIdArray) // Use $deleteIdArray
            ->delete();
        
        $ckddd = DB::table('customers_basket')
            ->where('session_id', $apiToken)
            ->where('is_order', '0')
            ->whereIn('customers_basket_id', $deleteIdArray) // Use $deleteIdArray
            ->first();
        
        if ($ckddd) {
            $cusBackatt = DB::table('customers_basket_attributes')
                ->where('session_id', $apiToken)
                ->whereIn('customers_basket_id', $deleteIdArray) // Use $deleteIdArray
                ->delete();
        }
        


    }

    public function merchantlogin($id)
    {
        $data=DB::table('booking_table')->where('qrcode', $id)->whereIn('status', ['reserved', 'checkin'])->first();
        if($data){
            $title = array('pageTitle' => 'Merchant login');
            session(['table_qrcode' => $id]);
            return view("auth.merchant_login", ['title' => $title,]);
      }else{
            echo 'Invalid Table Booking Qrcode';
      }
    }
    public function guestMerchant()
    {
        session(['guest_checkout' => 1]);
        return redirect('/');
    }

    public function edittocarttable(Request $request)
    {
        $option_id_array = $request->option_id;
        $attributeid_array = $request->attributeid;
        $option_name_array = $request->option_name;
        $options_values_id_array = $request->options_values_id;
        $customers_basket_id = $request->customers_basket_id;
        $quantity = $request->quantity;
        $products_id = $request->products_id;
        $final_price = $request->final_price;

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




        DB::table('customers_basket_attributes')->where('customers_basket_id', $customers_basket_id)->delete();

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
            }
        }

        DB::table('customers_basket')->where('customers_basket_id', $customers_basket_id)->update([
            'customers_basket_quantity' => $quantity,
            'total_basket_quantity'=> $quantity,
            'final_price' => $final_price,
            'original_price'=> $final_price,
        ]);




    }

    public function tableLogin(Request $request)
    {
            $previous_url = Session::get('_previous.url');
            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');
            session(['previous' => $previous_url]);
            $cresult = $this->table->get_country_code();
            return view('web.table.tablelogin', ['code'=>$cresult]);
           
           
    }
    

    public function tableLoginOtp($id)
    {
        $scount = DB::table('customers')->where('user_id', $id)->count();
        $user_data = DB::table('otp')->where('user_id', $id)->where('otp_status','5')->first();

        return view("web.table.tableloginotp")->with('result', $user_data)->with('scount',$scount);
          
           
           
    }

    public function table_ck_otp_isvalid(Request $request){

        $userid = $request->id;
        $ccode = $request->ccode;
        $phone = $request->phone;
        $otp = $request->otp1.''.$request->otp2.''.$request->otp3.''.$request->otp4;

       

        $cphone = $ccode.''.$phone;

        $chk = DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','5')->first();

        $chk_user = DB::table('users')->where('id', $userid)->first();

       

        if($chk){

          
            $customerInfo = array("email" => $chk_user->email, "password" => $chk_user->check_password, "role_id" => 2);
    
          
            if (auth()->guard('customer')->attempt($customerInfo)) {
                 $customer = auth()->guard('customer')->user();
                
    
            return "2";
            }
            else
            {
                return "3";
            }
        }else{
            return "1";
        }

    }

    
    public function table_update_otp_profile(Request $request){


        $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();

        $userid = $request->id;
        $ccode = $request->ccode;
        $phone = $request->phone;
        $otp = $request->otp1.''.$request->otp2.''.$request->otp3.''.$request->otp4.''.$request->otp5.''.$request->otp6;

        $cphone = $ccode.''.$phone;

        $chk = DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','0')->first();

        if($chk){
            DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','0')->update(['otp_status' => '1']);

            DB::table('users')->where('id', $userid)->update(['phone' => $phone,'country_code' => $ccode ]);

            return view("web.phone_verification_success", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('scount',$scount)->with('cphone',$cphone);
        }else{
            return "1";
        }

    }


    public function table_login_process(Request $request)
    {
       
        $check = DB::table('users')
        ->where('phone','=', $request->customers_telephone)
        ->where('country_code','=', $request->ccode)
        ->where('role_id','=', '2')
        ->where('phone_verified','=', '1')
        ->first(); 
      
        if($check !=''){
          
        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $result['commonContent'] = $this->index->commonContent();
        $app_name =$result['commonContent']['settings']['app_name'];
        $result=$this->table->sendotp_login($check->phone,$otpresult,$check->country_code,$check->id,$app_name);

          return $check->id;
           
        } else {
            return "1";
        }
         
      

}

public function table_resendotp($userid)
{
    $digits = 4;
    $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    $user = DB::table('otp')->where('user_id', $userid)->where('otp_status','5')->first();
    $result['commonContent'] = $this->index->commonContent();
    $app_name =$result['commonContent']['settings']['app_name'];
    $result=$this->table->sendotp_login($user->phone,$otpresult,$user->ccode,$userid,$app_name);

        return redirect('/table_login_otp'.'/'.$userid);
   
}




    public function processLoginTable(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $customerInfo = array("email" => $request->email, "password" => $request->password, "role_id" => 2);

      
        if (auth()->guard('customer')->attempt($customerInfo)) {
             $customer = auth()->guard('customer')->user();
            

            //insert user agent details
             $ip = $request->ip();
             $browserAgent = $_SERVER['HTTP_USER_AGENT'];
             $data = \Location::get($ip);
             if($data){
                $address=$data->countryName.','.$data->regionName.','.$data->cityName.','.$data->zipCode;
             }else{
                $address='local';
             }
             
                $customid = DB::table('user_agent')->insertGetId([
                    'user_id' => $customer->id,
                    'device_type' => 'web',
                    'device_version' =>$browserAgent,
                    'device_ip' => $ip,
                    'network_address' =>$address,
                    'create_date' => date('Y-m-d H:i:s'),
                ]);
            
           
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    return "2";
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                 if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

                  

                    return redirect('/otpVerfication'.'/'.$customer->id);
                 }else{
                  
                    return Redirect::to(session('previous'));
                 }
            } else {

                if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

                
                    return redirect('/otpVerfication'.'/'.$customer->id);
                }else{
                    Session::forget('guest_checkout');
                    return redirect('/')->with('result', $result);
                }     
            }
        } else {
            return "1";
        }
        //}
    }


    public function paymentComponent(Request $request)
    {
        session(['payment_method' => $request->payment_method]);
        session(['onlinetype' => $request->onlinetype]);

    }


    public function paymentcurrencychecktable(Request $request)
    {

        $payment_methods = DB::table('payment_methods')->where([
            ['payment_method', '=', $request->payment_method],
        ])->first(); 

        $payment_id = $payment_methods->payment_methods_id;
        
        $currency = DB::table('currencies')
        ->where('is_default', 1)
        ->where('is_current', 1)
        ->first();

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

                    if (in_array($currency->code, $ccode)) {
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



    public function getAllEncdecFunc()
    {
        function encrypt_e($input, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function decrypt_e($crypt, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function pkcs5_pad_e($text, $blocksize)
        {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }

        function pkcs5_unpad_e($text)
        {
            $pad = ord($text[strlen($text) - 1]);
            if ($pad > strlen($text)) {
                return false;
            }

            return substr($text, 0, -1 * $pad);
        }

        function generateSalt_e($length)
        {
            $random = "";
            srand((double) microtime() * 1000000);

            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";

            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }

            return $random;
        }

        function checkString_e($value)
        {
            if ($value == 'null') {
                $value = '';
            }

            return $value;
        }

        function getChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getChecksumFromString($str, $key)
        {

            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function verifychecksum_e($arrayList, $key, $checksumvalue)
        {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . "|" . $salt;

            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;

            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function verifychecksum_eFromStr($str, $key, $checksumvalue)
        {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . "|" . $salt;

            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;

            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function getArray2Str($arrayList)
        {
            $findme = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function getArray2StrForVerify($arrayList)
        {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function redirect2PG($paramList, $key)
        {
            $hashString = getchecksumFromArray($paramList, $key);
            $checksum = encrypt_e($hashString, $key);
        }

        function removeCheckSumParam($arrayList)
        {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }

        function getTxnStatus($requestParamList)
        {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }

        function getTxnStatusNew($requestParamList)
        {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }

        function initiateTxnRefund($requestParamList)
        {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }

        function callAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }

        function callNewAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList)
        {
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }

    /**
     * Config Paytm Settings from config_paytm.php file of paytm kit
     */
    public function getConfigPaytmSettings()
    {
        define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
        define('PAYTM_MERCHANT_KEY', '31Q9BhP79JVip77'); //Change this constant's value with Merchant key downloaded from portal
        define('PAYTM_MERCHANT_MID', 'Websit5239737375544'); //Change this constant's value with MID (Merchant ID) received from Paytm
        define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm

        $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL = 'https://securegw-stage.paytm.in/theia/processTransaction';
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL = 'https://securegw.paytm.in/theia/processTransaction';
        }
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
    }


     //Qrcode
     public function qrcodePaytm()
     {
      
         $orderid=session('table_qrcode');
         $total_price = 0;
         $final_tax_amount = 0;
         $order = DB::table('orders_products')->where('orders_id',$orderid)->get();
         foreach ($order as $data) { 
             $total_price=$total_price+$data->final_price;
         }

         $tax_class = DB::table('settings')->where('id',234)->first();
         if($tax_class->value == 1)
         {
         $taxdata = DB::table('tax_class')
         ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
         ->where('tax_rates.tax_zone_id', $country_id->value)
         ->where('tax_class.tax_type', 1)->get();
      
         $taxsum = 0;
     
       if(count($taxdata)>0){
         foreach ($taxdata as $jescomtax){
         
             $view_tax=$jescomtax->tax_rate / 100 * $final_price * session('currency_value');
             $view_tax = number_format($view_tax, 2);
             $taxsum += $view_tax;
        
         
            }

        }
       $to = $total_price + $taxsum;
       $final_tax_amount = number_format($to, 2);
      
       

         }


 
         $order_id = uniqid();
         
         //print_r($toalamount);die();
         $data_for_request = $this->handlePaytmRequest_qrcode($order_id,$final_tax_amount);
 
         $paramList = $data_for_request['paramList'];
         $checkSum = $data_for_request['checkSum'];
         $enviroment = $data_for_request['enviroment'];
 
         if($enviroment=='1'){
             $paytm_txn_url='https://securegw.paytm.in/theia/processTransaction';
         }else{
             $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
         }
         return view('web.paytm.paytm-merchant-form', compact('paytm_txn_url', 'paramList', 'checkSum'));
 
     }
 
     public function handlePaytmRequest_qrcode($order_id, $amount)
     {
         // Load all functions of encdec_paytm.php and config-paytm.php
         $this->getAllEncdecFunc();
         $this->getConfigPaytmSettings();
 
         $checkSum = "";
         $paramList = array();
         $payments_setting = $this->order->payments_setting_for_paytm();
         
         // Create an array having all required parameters for creating checksum.
         $paramList["MID"] = $payments_setting['paytm_mid']->value;
         $paramList["ORDER_ID"] = $order_id;
         $paramList["CUST_ID"] = $order_id;
         $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
         $paramList["CHANNEL_ID"] = 'WEB';
         $paramList["TXN_AMOUNT"] = $amount;
         $paramList["WEBSITE"] = 'WEBSTAGING';
         $paramList["CALLBACK_URL"] = url('/qrcode-callback');
         $paytm_merchant_key = $payments_setting['paytm_key']->value;
         $enviroment=$payments_setting['paytm_mid']->environment;
         //Here checksum string will return by getChecksumFromArray() function.
         $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);
 
         return array(
             'checkSum' => $checkSum,
             'paramList' => $paramList,
             'enviroment' => $enviroment,
         );
     }
 
     public function paytmQrcodeCallback(Request $request)
     {
         $payment_method = session('payment_method');
         $borderid=session('table_qrcode');
         $order_id = $request['ORDERID'];
         $data=array("CURRENCY"=>$request['CURRENCY'],'MID'=>$request['MID'],"ORDERID"=>$request['ORDERID'],"RESPCODE"=>$request['RESPCODE'],"RESPMSG"=>$request['RESPMSG'],"STATUS"=>$request['STATUS'],"TXNAMOUNT"=>$request['TXNAMOUNT'],"TXNID"=>$request['TXNID']);
         $response=json_encode($data);
 
         if('TXN_SUCCESS' === $request['STATUS']){
             $pay_status='TXN_SUCCESS';
             $status='2';
             $paid_status='1';
             $url='success';
         }else if('TXN_FAILURE' === $request['STATUS']){
             $pay_status='TXN_FAILURE';
             $status='1';
             $paid_status='3';
             $url='failure';
         }
 
         $orders_products_id = DB::table('table_payment')->insertGetId([
                         'amount' => $request['TXNAMOUNT'],
                         'payment_method' => $payment_method,
                         'payment_response' => $response,
                         'payment_status' => $pay_status,
                         'status' => $status,
                         'book_id' => $borderid,
                         'created_at' => date('Y-m-d h:i:s'),
                         'updated_at' => date('Y-m-d h:i:s')
                     ]);
         // update table booking
         if($status == 2)
         {
         $this->place_order_table($paid_status,$status,$data,$payment_method);
         }
      
 
         return redirect('/tablethankyou');	  
     }
 
     public function paytm_callback_app($id)
     {
        echo($id);
     }



     public function senangpayRequests($id)
     {
         
         $title = array('pageTitle' => Lang::get('website.Checkout'));
         $payments_setting = $this->order->payments_setting_for_senangpay();

         $data = array();
       
         $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

         $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();

         $totalprice = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('order_status', '=', 1)->sum(DB::raw('original_price * customers_basket_quantity'));

         $total_price = $totalprice * session('currency_value');

         $country_id = DB::table('settings')->where('id',235)->first();
         $tax_class = DB::table('settings')->where('id',234)->first();
         if($tax_class->value == 1)
         {
         $taxdata = DB::table('tax_class')
         ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
         ->where('tax_rates.tax_zone_id', $country_id->value)
         ->where('tax_class.tax_type', 1)->get();
      
         $taxsum = 0;
     
       if(count($taxdata)>0){
         foreach ($taxdata as $jescomtax){
         
             $view_tax=$jescomtax->tax_rate / 100 * $total_price * session('currency_value');
             $view_tax = number_format($view_tax, 2);
             $taxsum += $view_tax;
        
         
            }
 
        }
       $to = $total_price + $taxsum;
       $final_tax_amount = number_format($to, 2);
      
       
 
         }
         else
         {
             $final_tax_amount = number_format($total_price, 2);
         }
 

         $user = DB::table('users')->where('id', '=', $qorder->customer_id)->first();

         $data['transaction_id'] = session('table_qrcode');
         $data['order_price'] = $final_tax_amount;
         $data['customers_name'] = $user->first_name;
         $data['customers_telephone'] = $user->phone;
         $data['email'] = $user->email;


      

         return view("web.senangpay.senangpay_table", $title)->with('result',$payments_setting)->with('order_data',$data);
     }
 
     public function senangpayResponse(Request $request)
     {
        $status_id=$request->status_id;
        $order_id=$request->order_id;
        $transaction_id=$request->transaction_id;
        $msg=$request->msg;
        $hash=$request->hash;

        $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();
 
         $payment_method = session('payment_method');
         $borderid=session('table_qrcode');
         $order_id = $order_id;
         $data=array("status_id"=>$status_id,'order_id'=>$order_id,"transaction_id"=>$transaction_id,"msg"=>$msg,"hash"=>$hash);
         $response=json_encode($data);
 
         if($status_id == 1){
             $pay_status='TXN_SUCCESS';
             $status='2';
             $paid_status='1';
             $url='success';
         }else if($status_id == 2){
             $pay_status='TXN_FAILURE';
             $status='1';
             $paid_status='3';
             $url='failure';
         }
 
         $orders_products_id = DB::table('table_payment')->insertGetId([
                         'amount' => $price->total_amount,
                         'payment_method' => $payment_method,
                         'payment_response' => $response,
                         'payment_status' => $pay_status,
                         'status' => $status,
                         'book_id' => $borderid,
                         'created_at' => date('Y-m-d h:i:s'),
                         'updated_at' => date('Y-m-d h:i:s')
                     ]);
         // update table booking
         if($status == 2)
         {
         $this->place_order_table($paid_status,$status,$data,$payment_method);
         }
        
      
 
         return redirect('/tablethankyou');	 
     }
 
     public function senangpayServerResponse(Request $request)
     {
        $status_id=$request->status_id;
        $order_id=$request->order_id;
        $transaction_id=$request->transaction_id;
        $msg=$request->msg;
        $hash=$request->hash;
 
        $status_id=$request->status_id;
        $order_id=$request->order_id;
        $transaction_id=$request->transaction_id;
        $msg=$request->msg;
        $hash=$request->hash;

        $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();
 
         $payment_method = session('payment_method');
         $borderid=session('table_qrcode');
         $order_id = $order_id;
         $data=array("status_id"=>$status_id,'order_id'=>$order_id,"transaction_id"=>$transaction_id,"msg"=>$msg,"hash"=>$hash);
         $response=json_encode($data);
 
         if($status_id == 1){
             $pay_status='TXN_SUCCESS';
             $status='2';
             $url='success';
         }else if($status_id == 2){
             $pay_status='TXN_FAILURE';
             $status='1';
             $url='failure';
         }
 
         $orders_products_id = DB::table('table_payment')->insertGetId([
                         'amount' => $price->total_amount,
                         'payment_method' => $payment_method,
                         'payment_response' => $response,
                         'payment_status' => $pay_status,
                         'status' => $status,
                         'book_id' => $borderid,
                         'created_at' => date('Y-m-d h:i:s'),
                         'updated_at' => date('Y-m-d h:i:s')
                     ]);
   // update table booking
   DB::table('booking_table')->where('qrcode', $borderid)->update([
    'checkout_date' => date('Y-m-d h:i:s'),
    'status'=>'checkout'
]);

         echo 'OK';
         //return 'OK';
     }

     public function stripeResponse(Request $request)
    {
        $payments_setting =  $this->order->payments_setting_for_stripe();
        require_once app_path('stripe/config.php');

            //get token from app
        $token = $request->token;

        $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

        $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();

        $user = DB::table('users')->where('id', '=', $qorder->customer_id)->first();

        $order_id = session('table_qrcode');
        $order_price = $price->total_amount;
        $name = $user->first_name;
        $phone = $user->phone;
        $email = $user->email;
        $customers_id = $qorder->customer_id;

        $customer = \Stripe\Customer::create(array(
            'email' => $email,
            'source' => $token,
        ));

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount' => 100 * $order_price,
            'currency' => 'usd',
        ));



     
        if ($charge->paid == true) {
             $pay_status='TXN_SUCCESS';
             $status='2';
             $paid_status='1';
             $url='success';
             $paid = 'true';
         }else {
             $pay_status='TXN_FAILURE';
             $status='1';
             $url='failure';
             $paid_status='3';
             $paid = 'false';
             
         }

         $order_information = array(
            'paid' => $paid,
            'transaction_id' => $charge->id,
            'type' => $charge->outcome->type,
            'balance_transaction' => $charge->balance_transaction,
            'status' => $charge->status,
            'currency' => $charge->currency,
            'amount' => $charge->amount,
            'created' => date('d M,Y', $charge->created),
            'dispute' => $charge->dispute,
            'customer' => $charge->customer,
            'address_zip' => $charge->source->address_zip,
            'seller_message' => $charge->outcome->seller_message,
            'network_status' => $charge->outcome->network_status,
            'expirationMonth' => $charge->outcome->type,
        );
 
         $orders_products_id = DB::table('table_payment')->insertGetId([
                         'amount' => $order_price ,
                         'payment_method' => 'stripe',
                         'payment_response' => json_encode($order_information),
                         'payment_status' => $pay_status,
                         'status' => $status,
                         'book_id' => $order_id,
                         'created_at' => date('Y-m-d h:i:s'),
                         'updated_at' => date('Y-m-d h:i:s')
                     ]);
                     if($status == 2)
                     {
                        $this->place_order_table($paid_status,$status,$order_information,'stripe');
                     }
      
       

        return redirect('/tablethankyou');	 

    }


       
    public function banktranferResponse(Request $request)
    {


        $payment_method = session('payment_method');
        $orderid=session('table_qrcode');

        //print_r($payment_method);die();
        $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

        $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();

   
        $order_price = $price->total_amount;
       


        $orders_products_id = DB::table('table_payment')->insertGetId([
                        'amount' => $order_price,
                        'payment_method' => $payment_method,
                        'payment_response' => $payment_method,
                        'payment_status' => 'TXN_SUCCESS',
                        'status' => '2',
                        'book_id' => $orderid,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]
                );


      

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
   DB::table('table_payment')->where('book_id',$orderid)->update([
       'banktransfer_image' => $bank_image,
   ]);

   $cart = new Cart();
   $result = array();
   $cart_items = $cart->myCart($result);

   
   if(!empty(session('table_qrcode'))){
      $session_id = session('table_qrcode');
      $orderid=session('table_qrcode');
  }else{
      $session_id = Session::getId();
      $orderid=Session::getId();
  }

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
               $title='Online Payment';
               $message='New order has been placed';
               $myVar->sendNotificationsCashier($token,$title,$message);
           }
       }

  


 
} 

session(['tablepaystatus' => 3]);
session(['payment_method' => '']);


return redirect('/tablethankyou');	 



    }

    public function walletResponse(Request $request)
    {

        if(auth()->guard('customer')->check())
        {
            $orderid=session('table_qrcode');

            //print_r($payment_method);die();
            $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

            $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();

            $order_price = $price->total_amount;
        


            $orders_products_id = DB::table('table_payment')->insertGetId([
                    'amount' => $order_price,
                    'payment_method' => 'wallet',
                    'payment_response' => 'wallet',
                    'payment_status' => 'TXN_SUCCESS',
                    'status' => '2',
                    'book_id' => $orderid,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ]
            );


            $user=DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
            $upamount=$user->wallet_amount-$order_price;
            DB::table('users')->where('id',auth()->guard('customer')->user()->id)->update([
                'wallet_amount' => $upamount,
            ]);
        
            // insert wallet table
            $worder_id = uniqid();
            $wallet = DB::table('wallet')->insertGetId([
                'user_id' => auth()->guard('customer')->user()->id,
                'payment_method' => 'wallet',
                'payment_id' => $worder_id,
                'amount' => $order_price,
                'pay_status' => 'TXN_SUCCESS',
                'status' => '2',
                'payment_response' =>'Purchase product',
                'transaction_id' =>$worder_id,
                'wallet_type'   => 'withdrawal',
                'description'   => 'Purchase product',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
                
            if($status == 2)
            {
                $this->place_order_table(1,2,$worder_id,'wallet');
            }
          


            return redirect('/tablethankyou');	 
        }

    }
   

    public function place_order_table($paid_status,$status,$order_information,$pay_method_new)
    {

        if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
            $orderid=session('table_qrcode');
        }else{
            $session_id = Session::getId();
            $orderid=Session::getId();
        }
        $price = 0;
        $inventory = DB::table('settings')->where('name' , 'Inventory')->first();
        $is_inventory = $inventory ? $inventory->value : 1;
        $scommission = DB::table('settings')->where('name' , 'salesperson_commission')->first();
        $is_commission = $scommission ? $scommission->value : 1;


        $qorder= DB::table('booking_table')->where('qrcode', '=', session('table_qrcode'))->where('status', '=', 'checkin')->first();

        $price= DB::table('hold')->where('session_id', '=', session('table_qrcode'))->first();

        $user = DB::table('users')->where('id', '=', $qorder->customer_id)->first();

        $order_id = session('table_qrcode');
        $order_price = $price->total_amount;
        $name = $user->first_name;
        $phone = $user->phone;
        $email = $user->email;
        $customers_id = $qorder->customer_id;


        $usertoadd = DB::table('user_to_address')->where('user_id', '=', $customers_id)->where('is_default', '=', 1)->first();
        $cus_add = DB::table('address_book')->where('address_book_id', '=', $usertoadd->address_book_id)->first();
        // add the hold table
        $qorder= DB::table('booking_table')->where('qrcode', '=', $session_id)->where('status', '=', 'checkin')->first();

        $myVar = new AlertController();
                
        $cashier  = DB::table('users')->leftJoin('devices', 'devices.user_id', '=', 'users.id')->select('devices.device_id','users.id')->where('users.role_id', '=', '14')->where('users.status', '=', '1')->where('users.outlet', '=', $qorder->outletid)->get();

    
        if(!$cashier->isEmpty()){

            $cashier_id = $cashier[0]->id;
            foreach ($cashier as $jescashier) {
                $token=$jescashier->device_id;
                $title='Online Payment';
                $message='New order has been placed';
                $myVar->sendNotificationsCashier($token,$title,$message);
            }
        }
        else
        {
            $cashier_id = 0;
        }


        if($status == 2)
        {
            $currency_value = DB::table('currencies')->where('code','MYR')->first();
            $orderid=session('table_qrcode');
            $total_price = 0;
            $order = DB::table('orders_products')->where('orders_id',$orderid)->get();
            foreach ($order as $data) { 
                $total_price=$total_price+$data->final_price;
            }
            $country_id = DB::table('settings')->where('id',235)->first();
            $tax_class = DB::table('settings')->where('id',234)->first();
            if($tax_class->value == 1)
            {
                $taxdata = DB::table('tax_class')
                ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
                ->where('tax_rates.tax_zone_id', $country_id->value)
                ->where('tax_class.tax_type', 1)->get();
                $taxsum = 0;
                if(count($taxdata)>0){
                    foreach ($taxdata as $jescomtax){
                    
                        $view_tax=$jescomtax->tax_rate / 100 * $total_price * session('currency_value');
                        $view_tax = number_format($view_tax, 2);
                        $taxsum += $view_tax;
                    }
                }
                $to = $total_price + $taxsum;
                $final_tax_amount = number_format($to, 2);
            }
            if($tax_class->value == 2)
            {
                $final_tax_amount = number_format($total_price, 2);
            }
            if($tax_class->value == 0)
            {
                $final_tax_amount = number_format($total_price, 2);
            }


            $RefNo = md5(uniqid(rand(), true));
            $orders_id = DB::table('orders')->insertGetId(
            [  'customers_id' => $customers_id,
                'customers_name'  => $cus_add->entry_firstname.' '.$cus_add->entry_lastname,
                'customers_street_address' => $cus_add->entry_street_address,
                'customers_suburb'  =>  $cus_add->entry_suburb,
                'customers_city' => $cus_add->entry_city,
                'customers_postcode'  => $cus_add->entry_postcode,
                'customers_state' => $cus_add->entry_state,
                'customers_country'  =>  $cus_add->entry_country_id,
                'customers_telephone' => $phone,
                'email'  => $email,

                'delivery_name'  =>  $cus_add->entry_firstname.' '.$cus_add->entry_lastname,
                'delivery_street_address' => $cus_add->entry_street_address,
                'delivery_suburb'  => $cus_add->entry_suburb,
                'delivery_city' => $cus_add->entry_city,
                'delivery_postcode'  =>  $cus_add->entry_postcode,
                'delivery_state' => $cus_add->entry_state,
                'delivery_country'  => $cus_add->entry_country_id,
                'delivery_latitude'  =>  $cus_add->entry_latitude,
                'delivery_longitude'  =>  $cus_add->entry_longitude,

                'billing_name'  => $cus_add->entry_firstname.' '.$cus_add->entry_lastname,
                'billing_street_address' => $cus_add->entry_street_address,
                'billing_suburb'  =>  $cus_add->entry_suburb,
                'billing_city' => $cus_add->entry_city,
                'billing_postcode'  => $cus_add->entry_postcode,
                'billing_state' => $cus_add->entry_state,
                'billing_country'  =>  $cus_add->entry_country_id,

                'payment_method'  =>  $pay_method_new,
                'cc_type' => '',
                'cc_owner'  => '',
                'cc_number' =>'',
                'cc_expires'  =>  '',
                'last_modified' => date('Y-m-d H:i:s'),
                'date_purchased'  =>date('Y-m-d H:i:s'),
                'order_price'  => $order_price,
                'order_weight'  => 0,
                'order_km'  => 0,
                'shipping_cost' =>0 / $currency_value->value,
                'shipping_method'  =>  $pay_method_new,
                'currency'  =>  $currency_value ? $currency_value->symbol_left ? $currency_value->symbol_left : $currency_value->symbol_right : '$',
                'currency_value' => $currency_value ? $currency_value->value : 1 ,
                'order_information' => json_encode($order_information),
                'coupon_code'     =>   '',
                'coupon_amount'   =>   0 / $currency_value->value,
                'total_tax'     =>   $final_tax_amount / $currency_value->value,
                'ordered_source'    => 0,
                'delivery_phone'  =>   $phone,
                'billing_phone'   =>   $phone,
                'transaction_id'  =>  $RefNo,
                'payment_status'  => $paid_status,
                'coupon_code_id'  =>     '',
                'points_amount'   =>     0,
                'cashier_id'      =>    $cashier_id,
                'discount_amount' =>    0,
                'order_type'      =>    'Table',
                'pos_tips_amount' =>    0,
                'refund_amount'   =>    0
            ]); 

            $orders_history_id = DB::table('orders_status_history')->insertGetId(
                [  'orders_id'  => $orders_id,
                    'orders_status_id' => $status,
                    'date_added'  => date('Y-m-d H:i:s'),
                    'customer_notified' =>'1',
                    'comments'  =>  'product placed'
                ]);

            // insert order product
            $total_commission=0;
      
            $get_cat_id = DB::table('customers_basket')->select('customers_basket_id')->where('session_id', session('table_qrcode'))->get();

            $cus_bas_ids = []; // Initialize an array to store products_ids

            //print_r($get_pro_id);die();
            
            foreach ($get_cat_id as $item) {
                $cus_bas_ids[] = $item->customers_basket_id; // Assuming the field name is 'products_id'
            }

       

            foreach($cus_bas_ids as $cartid)
            {
               
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
                    'products_tax'    =>   $final_tax_amount,
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
                    if($prodata->products_type == 3)
                    {
                        $comboPro = DB::table('product_combo')->where('pro_id', $prodata->products_id)->get();
                        if(!$comboPro->isEmpty())
                        {
                            foreach($comboPro as $key=>$comboProd)
                            {

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
                    }
                    elseif($prodata->products_type == 4)
                    {
                        $comboProgetx = DB::table('product_get_x')
                        ->join('product_buy_x', 'product_buy_x.pro_id', '=', 'product_get_x.pro_id')
                        ->where('product_get_x.pro_id', $prodata->products_id)
                        ->where('product_buy_x.pro_id', $prodata->products_id)
                        ->get();

                        if(!$comboProgetx->isEmpty())
                        {
                            foreach($comboProgetx as $key=>$comboProdgetx)
                            {

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

                // if($is_commission == 1)
                // {
                //     $cproduct=DB::table('products')->where('products_id', $cartdata->products_id)->first();
                //     if($cproduct->commission_type=='percentage'){
                //     $ctotal_price = $final_price;
                //     $camount=(($ctotal_price/100)*$cproduct->commission_sales);
                //     $co_amount=$authController->cutNum($camount);
                //     }else{
                //     $camount=$cproduct->commission_sales*$cartdata->customers_basket_quantity;
                //     $co_amount=$authController->cutNum($camount);
                //     }
                //     $total_commission=$total_commission+$co_amount;
                // }

                $attrdata=DB::table('customers_basket_attributes')->where('customers_basket_id', $cartid)->get();
                if (!$attrdata->isEmpty()) 
                {
                    foreach ($attrdata as $key => $value)
                    {
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


            $table = DB::table('booking_table')->where('qrcode', '=', $session_id)->first();
            if($table)
            {
                // update booking_table table
                DB::table('booking_table')->where('id', $table->id)->update([
                    'status' => 'checkout',
                    'checkout_date' => date('Y-m-d h:i:s'),
                ]);
            }

            if(!empty($session_id))
            {
                // delete pos hold data
                $hold_data = DB::table('hold')->where('session_id', '=', $session_id)->first();
                if($hold_data)
                {
                    // delete hold data
                    DB::table('hold')->where('session_id', '=', $session_id)->delete();
                }
            }
        } 

        session(['tablepaystatus' => $status]);
        session(['payment_method' => '']);
        session(['table_qrcode' => '']);
     
    }



  
      
 
 


    
}
?>