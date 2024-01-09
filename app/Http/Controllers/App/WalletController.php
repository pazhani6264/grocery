<?php
namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Wallet;

class WalletController extends Controller
{
	public function viewWalletPayment(Request $request)
	{
		$viewWalletPayment = Wallet::viewWalletPayment($request);
		print $viewWalletPayment;
	}
	public function viewWalletHistory(Request $request)
	{
		$viewWalletHistory = Wallet::viewWalletHistory($request);
		print $viewWalletHistory;
	}
	public function addWallet(Request $request)
	{
		$addWallet = Wallet::addWallet($request);
		print $addWallet;
	}
	public function getWalletStatus(Request $request)
	{
		$getWalletStatus = Wallet::getWalletStatus($request);
		print $getWalletStatus;
	}
	public function uploadBankbill(Request $request)
	{
		$uploadBankbill = Wallet::uploadBankbill($request);
		print $uploadBankbill;
	}
}
?>