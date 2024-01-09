<?php
namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Payments_setting;
use App\Models\Core\Setting;
use App\Models\Core\Wallet;
use App\Models\Core\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use PDF;

class WalletController extends Controller
{
	public function __construct(Payments_setting $payments_setting,Setting $setting, Languages $languages, Wallet $wallet)
    {
        $this->Payments_setting = $payments_setting;
        $this->Setting = $setting;
        $this->Languages = $languages;
        $this->Wallet  = $wallet;
    }

    public function walletreport(Request $request)
    {
        $title = array('pageTitle' => 'Wallet Report');
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        $wallet=$this->Wallet->get_wallet_new();
        return view("admin.wallet.walletreport", $title)->with('result', $result)->with('wallet', $wallet);
    }

    public function banktransfer(Request $request)
    {
    	$title = array('pageTitle' => 'Wallet Report');
    	$result = array();
    	$result['commonContent'] = $this->Setting->commonContent();
    	$wallet=$this->Wallet->get_banktransfer_new();
    	return view("admin.wallet.banktransfer", $title)->with('result', $result)->with('wallet', $wallet);
    }

    public function bankapprove(Request $request)
    {
    	$updateid=$request->orders_id;
    	$type=$request->type;
    	$date_added = date('Y-m-d H:i:s');
    	$wallet=DB::table('wallet')->where('id', $updateid)->first();

    	if($type=='approve'){
    		DB::table('wallet')->where('id', $updateid)->update(
	        [
	            'status'     =>  '2',
	            'pay_status' =>   'TXN_SUCCESS',
	            'updated_at' =>   $date_added
	        ]);

	        // update user wallet amount
            $user=DB::table('users')->where('id', $wallet->user_id)->first();
            $upamount=$user->wallet_amount+$wallet->amount;
            DB::table('users')->where('id',$wallet->user_id)->update([
                'wallet_amount' => $upamount,
            ]);
    	}elseif($type=='cancel'){
    		DB::table('wallet')->where('id', $updateid)->update(
	        [
	            'status'     =>  '3',
	            'updated_at' =>   $date_added
	        ]);
    	}

    	return redirect()->back();
    }

    public function viewbankimage($id)
    {
        $wallet=$this->Wallet->get_banktransfer_image($id);
        return view("admin.wallet.view_banktransfer_image")->with('wallet', $wallet);
    }
    public function walletdetails($id)
    {
        $wallet=$this->Wallet->get_banktransfer_image($id);
        return view("admin.wallet.view_wallet_details")->with('wallet', $wallet);
    }
}
?>