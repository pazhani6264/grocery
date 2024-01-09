<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Web\Order;
use App\Models\Web\Currency;
use App\Models\Core\Setting;

use Auth;
use Lang;
use Session;
use DB;
use Hash;

class WalletController extends Controller
{
	public function __construct(
        Currency $currency,
        Order $order,
        Setting $setting
    ) {
        $this->currencies = $currency;
        $this->order = $order;
        $this->Setting = $setting;
    }
	public function ipayCheckout()
	{
		$payments_setting = $this->order->payments_setting_for_ipay88();
		return view("ipay.request_wallet")->with('result',$payments_setting);
	}
    public function ipayappcheckout($id)
    {
       $payments_setting = $this->order->payments_setting_for_ipay88();
       $payment=DB::table('wallet')->where('payment_id', $id)->first();
       if($payment){
       if($payment->status=='2'){
            echo 'Invalid Transaction Id';
       }else{
            return view("ipay.request_app_wallet")->with('result',$payments_setting)->with('payment',$payment);
       }
    }else{
        echo 'Invalid Transaction Id';  
    }
    }
	public function ipaywalletResponse(Request $request)
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
            $data=array("RefNo"=>$_REQUEST["RefNo"],'Status'=>$_REQUEST["Status"],"MerchantCode"=>$_REQUEST["MerchantCode"],"PaymentId"=>$_REQUEST["PaymentId"],"Amount"=>$_REQUEST["Amount"],"Currency"=>$_REQUEST["Currency"],"Remark"=>$_REQUEST["Remark"],"TransId"=>$_REQUEST["TransId"],"AuthCode"=>$_REQUEST["AuthCode"],"ErrDesc"=>$_REQUEST["ErrDesc"],"Signature"=>$_REQUEST["Signature"]);
            $response=json_encode($data);
            
            if($estatus==1){
            	$pay_status='TXN_SUCCESS';
            	$status='2';

                // update user wallet amount
                    $user=DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
                    $upamount=$user->wallet_amount+$amount;
                    DB::table('users')->where('id',auth()->guard('customer')->user()->id)->update([
                        'wallet_amount' => $upamount,
                    ]);
            }else{
            	$pay_status='TXN_FAILURE';
            	$status='1';
            }

             // insert table
             $wallet = DB::table('wallet')->insertGetId([
                    'user_id' => auth()->guard('customer')->user()->id,
                    'payment_method' => 'ipay88',
                    'payment_id' => $refno,
                    'amount' => $amount,
                    'pay_status' => $pay_status,
                    'status' => $status,
                    'payment_response' =>$response,
                    'transaction_id' =>$transid,
                    'wallet_type'   => 'deposit',
                    'description'   => 'Add Money to Wallet',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

           	  session(['wpay_status' =>$status]);
             return redirect('/wallet_thankyou');
	}
    public function ipayappwalletresponse(Request $request)
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
            $data=array("RefNo"=>$_REQUEST["RefNo"],'Status'=>$_REQUEST["Status"],"MerchantCode"=>$_REQUEST["MerchantCode"],"PaymentId"=>$_REQUEST["PaymentId"],"Amount"=>$_REQUEST["Amount"],"Currency"=>$_REQUEST["Currency"],"Remark"=>$_REQUEST["Remark"],"TransId"=>$_REQUEST["TransId"],"AuthCode"=>$_REQUEST["AuthCode"],"ErrDesc"=>$_REQUEST["ErrDesc"],"Signature"=>$_REQUEST["Signature"]);
            $response=json_encode($data);

            $payment=DB::table('wallet')->where('payment_id', $refno)->first();
            
            if($estatus==1){
                $pay_status='TXN_SUCCESS';
                $status='2';

                // update user wallet amount
                    $user=DB::table('users')->where('id', $payment->user_id)->first();
                    $upamount=$user->wallet_amount+$amount;
                    DB::table('users')->where('id',$payment->user_id)->update([
                        'wallet_amount' => $upamount,
                    ]);
            }else{
                $pay_status='TXN_FAILURE';
                $status='1';
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
        echo $pay_status;
    }
    public function walletBank(Request $request)
    {
        // insert table
             $refno = uniqid();
             $amount= $request->amount;
             $wallet = DB::table('wallet')->insertGetId([
                    'user_id' => auth()->guard('customer')->user()->id,
                    'payment_method' => 'banktransfer',
                    'payment_id' => $refno,
                    'amount' => $amount,
                    'pay_status' => 'TXN_FAILURE',
                    'status' => '3',
                    'payment_response' =>'banktransfer',
                    'transaction_id' =>$refno,
                    'wallet_type'   => 'deposit',
                    'description'   => 'Add Money to Wallet',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
             session(['wpay_status' =>'3']);
             //return redirect('/wallet_thankyou');
    }
    public function walletBanktransfer(Request $request)
    {
        $fileName = time() . '.' . $request->bankimage->getclientoriginalextension();
        $request->bankimage->getclientoriginalextension();
        $request->bankimage->move(base_path('public/images/banktransfer'),$fileName);

        $bank_image = 'images/banktransfer/'.$fileName;
         DB::table('wallet')->where('id',$request->update_id)->update([
            'payment_response' => $bank_image,
            'status' =>'4',
        ]);

        return redirect()->back();
    }
}
?>