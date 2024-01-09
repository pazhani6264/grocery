<?php
namespace App\Http\Controllers\App;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Customer;

class CustomersController extends Controller
{

	//login
	public function processlogin(Request $request){
    $userResponse = Customer::processlogin($request);
		print $userResponse;
	}

	public function processlogout(Request $request){
		$userResponse = Customer::processlogout($request);
			print $userResponse;
		}	

	//registration
	public function processregistration(Request $request){
    $userResponse = Customer::processregistration($request);
		print $userResponse;
	}

	//notify_me
	public function notify_me(Request $request){
    $categoryResponse = Customer::notify_me($request);
		print $categoryResponse;
	}

	//update profile
	public function updatecustomerinfo(Request $request){
    $userResponse = Customer::updatecustomerinfo($request);
		print $userResponse;

	}

	//update email
	public function updateMyEmail(Request $request){
		$userResponse = Customer::updateMyEmail($request);
			print $userResponse;
	
		}

	//processforgotPassword
	public function processforgotpassword(Request $request){
    $userResponse = Customer::processforgotpassword($request);
		print $userResponse;
	}

	//facebookregistration
	public function facebookregistration(Request $request){
	  $userResponse = Customer::facebookregistration($request);
		print $userResponse;


	}


	//googleregistration
	public function googleregistration(Request $request){
    $userResponse = Customer::googleregistration($request);
		print $userResponse;


		}

	//appleregistration
	public function appleregistration(Request $request){
    $userResponse = Customer::appleregistration($request);
		print $userResponse;
	}

	//generate random password
	function createRandomPassword() {
		$pass = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
		return $pass;
	}

	//generate random password
	function registerdevices(Request $request) {
    	$userResponse = Customer::registerdevices($request);
		print $userResponse;
	}

	function registerdevicesnew(Request $request) {
    	$userResponse = Customer::registerdevicesnew($request);
		print $userResponse;
	}

	function updatepassword(Request $request) {
		$userResponse = Customer::updatepassword($request);
		print $userResponse;
	}
	function sendotp(Request $request){
		$otpResponse = Customer::sendotp($request);
		print $otpResponse;
	}
	function resendotp(Request $request)
	{
		$otpResponse = Customer::resendotp($request);
		print $otpResponse;
	}
	function otpverification(Request $request)
	{
		$otpResponse = Customer::otpverification($request);
		print $otpResponse;
	}
	function pointshistory(Request $request)
	{
		$otpResponse = Customer::pointshistory($request);
		print $otpResponse;
	}
	function getprofile(Request $request)
	{
		$profileResponse = Customer::getprofile($request);
		print $profileResponse;
	}
	function addcustomer(Request $request)
	{
		$addcustomer = Customer::addcustomer($request);
		print $addcustomer;
	}
	function editcustomer(Request $request)
	{
		$editcustomer = Customer::editcustomer($request);
		print $editcustomer;
	}
	function deletecustomer(Request $request)
	{
		$deletecustomer = Customer::deletecustomer($request);
		print $deletecustomer;
	}
	function customerlist(Request $request)
	{
		$customerlist = Customer::customerlist($request);
		print $customerlist;
	}

	function adduseragent(Request $request)
	{
		$adduseragent = Customer::adduseragent($request);
		print $adduseragent;
	}
	function addGuest(Request $request)
	{
		$addGuest = Customer::addGuest($request);
		print $addGuest;
	}

	public function getPromotionalVoucher(Request $request)
	{
		$getPromotionalVoucher = Customer::getPromotionalVoucher($request);
		print $getPromotionalVoucher;
	}
	public function getRewardsVoucher(Request $request)
	{
		$getRewardsVoucher = Customer::getRewardsVoucher($request);
		print $getRewardsVoucher;
	}
	public function getDiscountsVoucher(Request $request)
	{
		$getDiscountsVoucher = Customer::getDiscountsVoucher($request);
		print $getDiscountsVoucher;
	}
	public function getActiveVoucher(Request $request)
	{
		$getActiveVoucher = Customer::getActiveVoucher($request);
		print $getActiveVoucher;
	}
	public function getUseExpiredVoucher(Request $request)
	{
		$getUseExpiredVoucher = Customer::getUseExpiredVoucher($request);
		print $getUseExpiredVoucher;
	}
	public function getFavouriteVoucher(Request $request)
	{
		$getFavouriteVoucher = Customer::getFavouriteVoucher($request);
		print $getFavouriteVoucher;
	}
}
