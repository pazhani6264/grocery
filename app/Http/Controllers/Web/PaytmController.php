<?php

namespace App\Http\Controllers\Web;

use App\Models\Web\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\App\AlertController;
use session;
use DB;
use Auth;
class PaytmController extends Controller
{

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_id = uniqid();
        if(session('onlinetype') == 'wallet'){
            $toalamount=session('wallet_price');
        }elseif(session('onlinetype') == 'orderproduct'){
            $toalamount=session('total_price');
        }
        //print_r($toalamount);die();
        $data_for_request = $this->handlePaytmRequest($order_id,$toalamount);

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

    public function handlePaytmRequest($order_id, $amount)
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
        $paramList["CALLBACK_URL"] = url('/paytm-callback');
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

//app

    public function store_app($id)
    {
        //$order_id = uniqid();
        $order = DB::table('orders')->where('transaction_id',$id)->first();
        $total_price = $order->order_price;
        $orders_id = $order->orders_id;
        
        $data_for_request = $this->handlePaytmRequest_app($orders_id, $total_price);
        
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

    public function handlePaytmRequest_app($order_id, $amount)
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
        $paramList["CALLBACK_URL"] = url('/paytm-callback-app');
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

    public function paytmCallbackApp(Request $request)
    {
        $orders_id = $request['ORDERID'];

        if ('TXN_SUCCESS' === $request['STATUS']) {
            //echo 'success';
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

            $myVar = new AlertController();
     
            $alertSetting = $myVar->orderAlert($ordersData);
          DB::table('orders')->where('orders_id', $orders_id)->update(['order_ref_no'=>'success']);
            return redirect('/paytm_callback_app/success');
         

        } else if ('TXN_FAILURE' === $request['STATUS']) {
            //echo 'failure';
            $coupon_used = DB::table('orders')->select('coupon_code','customers_id')->where('orders_id',$orders_id)->first();

            $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_id)->get();

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
       
            if($coupon_used->coupon_code !='')
            {
                $coupon_array = json_decode($coupon_used->coupon_code);
                $code = $coupon_array[0]->code;
                $getloyalty = DB::table('coupons')->select('used_by')->where('code',$code)->first();
                $user_id = $getloyalty->used_by;
                $user_id = trim($user_id, ',');
                $user_array =(explode(",",$user_id));
                if (($key = array_search($coupon_used->customers_id, $user_array)) !== false) {
                        unset($user_array[$key]);
                }
                $user_array =(implode(",",$user_array));
                $cus_id = ','.$user_array;
                DB::table('coupons')->where('code',$code)->update([
                    'used_by' => $cus_id,
                ]);
            
            }

            $getloyalty = DB::table('transaction_points')->where('order_id',$orders_id)->first();


            
            if($getloyalty != '')
            {
                DB::table('redeem_points_voucher')->where('id',$getloyalty->loyalty_id)->update([
                    'status' => '0',
                ]);
            }
           
           DB::table('orders')->where('orders_id', $orders_id)->delete(); 
            return redirect('/paytm_callback_app/failure');
        }
      
    }

    //wallet_app
     public function wallet_app($id)
    {
        //$order_id = uniqid();
        $order = DB::table('wallet')->where('payment_id',$id)->first();
        $total_price = $order->amount;
        $orders_id = $order->payment_id;
        
        $data_for_request = $this->handlePaytmRequest_wallet($orders_id, $total_price);
        
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

    public function handlePaytmRequest_wallet($order_id, $amount)
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
        $paramList["CALLBACK_URL"] = url('/paytm-callback-wallet');
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

    public function paytmCallbackWallet(Request $request)
    {
        $order_id = $request['ORDERID'];
        $data=array("CURRENCY"=>$request['CURRENCY'],'MID'=>$request['MID'],"ORDERID"=>$request['ORDERID'],"RESPCODE"=>$request['RESPCODE'],"RESPMSG"=>$request['RESPMSG'],"STATUS"=>$request['STATUS'],"TXNAMOUNT"=>$request['TXNAMOUNT'],"TXNID"=>$request['TXNID']);
        $response=json_encode($data);
        $amount=$request['TXNAMOUNT'];
        $transid=$request['TXNID'];
        $payment=DB::table('wallet')->where('payment_id', $order_id)->first();

        if('TXN_SUCCESS' === $request['STATUS']){
            $pay_status='TXN_SUCCESS';
            $status='2';
            $url='success';

           // update user wallet amount
             $user=DB::table('users')->where('id', $payment->user_id)->first();
             $upamount=$user->wallet_amount+$amount;
             DB::table('users')->where('id',$payment->user_id)->update([
                'wallet_amount' => $upamount,
             ]);
        }else if('TXN_FAILURE' === $request['STATUS']){
            $pay_status='TXN_FAILURE';
            $status='1';
            $url='failure';
        }

        // update table
            DB::table('wallet')->where('id',$payment->id)->update([
            'amount' => $amount,
            'pay_status' => $pay_status,
            'status' => $status,
            'payment_response' =>$response,
            'transaction_id' =>$transid,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/paytm_callback_app/'.$url.'');
        //echo $pay_status;
    }

    //Qrcode
    public function qrcodePaytm()
    {
        $orderid=session('table_qrcode');
        $total_price = 0;
        $order = DB::table('orders_products')->where('orders_id',$orderid)->get();
        $totalprice = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('order_status', '=', 1)->sum(DB::raw('original_price * customers_basket_quantity'));

        $total_price = $totalprice * session('currency_value');
        // foreach ($order as $data) { 
        //     $total_price=$total_price+$data->final_price;
        // }
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
            $url='success';
        }else if('TXN_FAILURE' === $request['STATUS']){
            $pay_status='TXN_FAILURE';
            $status='1';
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
        DB::table('booking_table')->where('qrcode', $borderid)->update([
            'checkout_date' => date('Y-m-d h:i:s'),
            'status'=>'checkout'
        ]);

        session(['tablepaystatus' => $status]);
        session(['payment_method' => '']);
        session(['table_qrcode' => '']);

        return redirect('/webthankyou');
    }

    public function paytm_callback_app($id)
    {
       echo($id);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Get all the functions from encdec_paytm.php
     */
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

    public function paytmCallback(Request $request)
    {
        $order_id = $request['ORDERID'];
        $type= session('onlinetype');
        $data=array("CURRENCY"=>$request['CURRENCY'],'MID'=>$request['MID'],"ORDERID"=>$request['ORDERID'],"RESPCODE"=>$request['RESPCODE'],"RESPMSG"=>$request['RESPMSG'],"STATUS"=>$request['STATUS'],"TXNAMOUNT"=>$request['TXNAMOUNT'],"TXNID"=>$request['TXNID']);
        $response=json_encode($data);

        if ('TXN_SUCCESS' === $request['STATUS'] && $type=='orderproduct') {
            Session(['paytm' => 'success']);
            return redirect('/checkout');

        } else if ('TXN_FAILURE' === $request['STATUS'] && $type=='orderproduct') {
            return view('web.paytm.payment-failed');
        }else if('TXN_SUCCESS' === $request['STATUS'] && $type=='wallet'){
            // insert table
             $wallet = DB::table('wallet')->insertGetId([
                    'user_id' => auth()->guard('customer')->user()->id,
                    'payment_method' => 'paytm',
                    'payment_id' => $order_id,
                    'amount' => $request['TXNAMOUNT'],
                    'pay_status' => $request['STATUS'],
                    'status' => '2',
                    'payment_response' =>$response,
                    'transaction_id' =>$request['TXNID'],
                    'wallet_type'   => 'deposit',
                    'description'   => 'Add Money to Wallet',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            // update user wallet amount
            $user=DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
            $upamount=$user->wallet_amount+$request['TXNAMOUNT'];
            DB::table('users')->where('id',auth()->guard('customer')->user()->id)->update([
                'wallet_amount' => $upamount,
            ]);
            session(['wpay_status' => '2']);   
            return redirect('/wallet_thankyou');

        }else if('TXN_FAILURE' === $request['STATUS'] && $type=='wallet'){
            // insert table
             $wallet = DB::table('wallet')->insertGetId([
                    'user_id' => auth()->guard('customer')->user()->id,
                    'payment_method' => 'paytm',
                    'payment_id' => $order_id,
                    'amount' => $request['TXNAMOUNT'],
                    'pay_status' => $request['STATUS'],
                    'status' => '1',
                    'payment_response' =>$response,
                    'transaction_id' =>$request['TXNID'],
                    'wallet_type'   => 'deposit',
                    'description'   => 'Add Money to Wallet',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
             session(['wpay_status' =>'1']);
             return redirect('/wallet_thankyou');
        }
    }
    public function paytmServer(Request $request)
    {
        echo 'reju';
    }
}
