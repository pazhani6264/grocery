<?php
namespace App\Http\Controllers\App;
use Validator;
use Mail;
use DB;
use DateTime;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use Log;
use Lang;
use App\Models\AppModels\Loyalty;

class LoyaltyController extends Controller
{
	 public function getloyalty(Request $request)
	{
		$loyaltyResponse = Loyalty::getloyalty($request);
		print $loyaltyResponse;
	}

	public function availablecoupon(Request $request)
	{
		$loyaltyResponse = Loyalty::availablecoupon($request);
		print $loyaltyResponse;
	}

	public function applyredeempoints(Request $request)
	{
		$loyaltyResponse = Loyalty::applyredeempoints($request);
		print $loyaltyResponse;	
	}
	public function removeloyalty(Request $request)
	{
		$loyaltyResponse = Loyalty::removeloyalty($request);
		print $loyaltyResponse;
	}
	public function activeredeempoint(Request $request)
	{
		$loyaltyResponse = Loyalty::activeredeempoint($request);
		print $loyaltyResponse;
	}
	public function viewyourrewards(Request $request)
	{
		$loyaltyResponse = Loyalty::viewyourrewards($request);
		print $loyaltyResponse;
	}
	
}
?>