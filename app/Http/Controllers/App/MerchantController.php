<?php
namespace App\Http\Controllers\App;
use Validator;
use Mail;
use DateTime;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Merchant;
class MerchantController extends Controller
{
	public function merchantLogin(Request $request)
	{
		$merchantLogin = Merchant::merchantLogin($request);
		print $merchantLogin;
	}

	public function getMerchantOrders(Request $request)
	{
		$getMerchantOrders = Merchant::getMerchantOrders($request);
		print $getMerchantOrders;
	}
	public function viewStatus(Request $request)
	{
		$viewStatus = Merchant::viewStatus($request);
		print $viewStatus;
	}
	public function updateOrder(Request $request)
	{
		$updateOrder = Merchant::updateOrder($request);
		print $updateOrder;
	}
	public function deliveryBoys(Request $request)
	{
		$deliveryBoys = Merchant::deliveryBoys($request);
		print $deliveryBoys;
	}
	public function currentBoy(Request $request)
	{
		$currentBoy = Merchant::currentBoy($request);
		print $currentBoy;
	}
	public function assignOrders(Request $request)
	{
		$assignOrders = Merchant::assignOrders($request);
		print $assignOrders;
	}
	public function getOrderStatus(Request $request)
	{
		$getOrderStatus = Merchant::getOrderStatus($request);
		print $getOrderStatus;
	}
}
?>