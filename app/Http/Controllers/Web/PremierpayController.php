<?php
namespace App\Http\Controllers\Web;
use App\Models\Web\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\User;
use session;
use Hash;
use Auth;
use Lang;


class PremierpayController extends Controller
{
	public function __construct(Order $order)
    {
        $this->order = $order;
        $this->theme = new ThemeController();
    }

    public function createRandomPassword()
    {
        $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $pass;
    }

    public function premierpayresponse($id)
    {
    	 Session::save();
    	 $PremierPay_setting = $this->order->payments_setting_for_PremierPay();
    	 $details = DB::table('premier_pay')->where('refno', '=', $id)->first();
    	 
    	 $date_added = date('Y-m-d h:i:s');
    	 $store_key = $PremierPay_setting['store_key']->value;
    	 $store_id = $PremierPay_setting['store_id']->value;
         $signature = $details->signature;
         $timestamp = $details->timestamp;
         $refno = $details->refno;
         $order_id= $details->orders_id;
         $customers_id= $details->customers_id;

         //print_r($signature);die();
          $path='https://sb-api.glypay.com/glypay/api/merchant/order/store/'.$store_id.'/status?transId='.$refno.'';
          $curl = curl_init();

          curl_setopt_array($curl, array(
                    CURLOPT_URL => $path,
                    CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => "",
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 30000,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => "GET",
                     CURLOPT_POSTFIELDS => $refno,
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
         //print_r($json_a);die();
         $status = $json_a['data']['status'];
         $code = $json_a['code'];

         session(['premierpaystatus' => $status]);
     	 session(['premierpaymethod' => 'PremierPay']);
     	 session(['orders_id' => $order_id]);
     	 session(['guest_checkout' => 0]);
     	
     	 //$customer = auth()->guard('customer')->user();
     	 //print_r($customer);die();

     	 $Uid = $json_a['data']['uid'];
     	 if($status==4){
     	 	
     	 	DB::table('orders')->where('orders_id', $order_id)->update(['order_ref_no' => $refno,'transaction_id' => $Uid,'premierpay_status' => $status,'order_information'=> $response,'payment_status'=>'2']);

     	 	//orders status history
     	 	$orders_history_id = DB::table('orders_status_history')->insertGetId(
                       [
                            'orders_id' => $order_id,
                             'orders_status_id' => '2',
                             'date_added' => $date_added,
                             'customer_notified' => '1',
                            'comments' => 'Online payment success',
                         ]
                    );
     	 }else{
     	 	 DB::table('orders')->where('orders_id', $order_id)->update(['order_ref_no' => $refno,'transaction_id' => $Uid,'premierpay_status' => $status,'order_information'=> $response,'payment_status'=>'1']);
     	 	 $orders_history_id = DB::table('orders_status_history')->insertGetId(
                         [
                             'orders_id' => $order_id,
                             'orders_status_id' => '3',
                             'date_added' => $date_added,
                             'customer_notified' => '1',
                             'comments' => 'Online payment failure',
                         ]);
     	 }
     	 	
     	$password = $this->createRandomPassword();
     	$old_session = Session::getId();
     	DB::table('users')->where('id', $customers_id)->update(['password' => Hash::make($password)]);

        $user = DB::table('users')->where('id', '=', $customers_id)->first();

        $customerInfo = array("email" => $user->email, "password" => $password);
        if (auth()->guard('customer')->attempt($customerInfo)) {
        	
        	$customer = auth()->guard('customer')->user();
        	session(['customers_id' =>  $customers_id]);

        	 //cart
            $cart = DB::table('customers_basket')->where([
                ['session_id', '=', $old_session],
            ])->get();

            if (count($cart) > 0) {
                foreach ($cart as $cart_data) {
                    $exist = DB::table('customers_basket')->where([
                        ['customers_id', '=', $customer->id],
                        ['products_id', '=', $cart_data->products_id],
                        ['is_order', '=', '0'],
                    ])->delete();
                }
            }

            DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            //insert device id
            if (!empty(session('device_id'))) {
                DB::table('devices')->where('device_id', session('device_id'))->update(['user_id' => $customer->id]);
            }

            $result['customers'] = DB::table('users')->where('id', $customer->id)->get();
            //return $result;
        	//return redirect('/newthankyou/'.$refno);
        }
         
        //$result['customers'] = DB::table('users')->where('id', $customers_id)->get();

       return redirect('/newthankyou/'.$refno);

       //return redirect($request->session()->get('/newthankyou/'.$refno));
    }

    public function newthankyou($id)
    {
    	Session::save();
    	$old_session = Session::getId();
    	$title = array('pageTitle' => Lang::get('website.Thank You'));
    	$final_theme = $this->theme->theme();
    	$bankdetail = array();
    	//print_r($id);die();
    	$detail = DB::table('premier_pay')->where('refno', '=', $id)->first();
    	$order_id= $detail->orders_id;
    	$customers_id= $detail->customers_id;

    	$password = $this->createRandomPassword();

    	DB::table('users')->where('id', $customers_id)->update(['password' => Hash::make($password)]);
    	$user = DB::table('users')->where('id', '=', $customers_id)->first();

    	session(['guest_checkout' => 0]);
    	//print_r(Session::get('guest_checkout'));die();
    	$customerInfo = array("email" => $user->email, "password" => $password);
    	if (auth()->guard('customer')->attempt($customerInfo)) {
    		$customer = auth()->guard('customer')->user();
        	session(['customers_id' =>  $customers_id]);
    	}

    	//print_r(auth()->guard('customer')->user()->id);die();

    	$result = $this->order->orders_new($detail->customers_id);
    	$details = DB::table('orders_status_history')->where('orders_id', '=', $detail->orders_id)->orderby('orders_status_history_id', 'desc')->first();
    	session(['orders_id' => $order_id]);
    	return view("web.thankyou", ['title' => $title, 'final_theme' => $final_theme, 'bankdetail'=>$bankdetail,'details'=>$details,'customer'=>$customer])->with('result', $result);
    }
}
?>