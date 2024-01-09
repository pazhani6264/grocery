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
use App\Models\AppModels\Cart;

class CartController extends Controller
{
	public function addCart(Request $request)
	{
		$addCart = Cart::addCart($request);
		print $addCart;
	}

	public function viewCart(Request $request)
	{
		$viewCart = Cart::viewCart($request);
		print $viewCart;
	}

	public function deleteCart(Request $request)
	{
		$deleteCart = Cart::deleteCart($request);
		print $deleteCart;
	}
	public function updateCart(Request $request)
	{
		$updateCart = Cart::updateCart($request);
		print $updateCart;
	}
	public function clearallCart(Request $request)
	{
		$clearallCart = Cart::clearallCart($request);
		print $clearallCart;
	}
	public function updateCartQuantity(Request $request)
	{
		$updateCartQuantity = Cart::updateCartQuantity($request);
		print $updateCartQuantity;
	}
	
}
?>