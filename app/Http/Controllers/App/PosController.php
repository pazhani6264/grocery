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
use App\Models\AppModels\Pos;

class PosController extends Controller
{
	public function addposCart(Request $request)
	{
		$addposCart = Pos::addposCart($request);
		print $addposCart;
	}
	public function viewposCart(Request $request)
	{
		$viewposCart = Pos::viewposCart($request);
		print $viewposCart;
	}
	public function deleteposCart(Request $request)
	{
		$deleteposCart = Pos::deleteposCart($request);
		print $deleteposCart;
	}
	public function clearallposCart(Request $request)
	{
		$clearallposCart = Pos::clearallposCart($request);
		print $clearallposCart;
	}
	public function cashierLogin(Request $request)
	{
		$cashierLogin = Pos::cashierLogin($request);
		print $cashierLogin;
	}
	public function viewBill(Request $request)
	{
		$viewBill = Pos::viewBill($request);
		print $viewBill;
	}
	public function cancelBill(Request $request)
	{
		$cancelBill = Pos::cancelBill($request);
		print $cancelBill;
		
	}
	public function openDrawer(Request $request)
	{
		$openDrawer = Pos::openDrawer($request);
		print $openDrawer;
	}
	public function viewDrawer(Request $request)
	{
		 $viewDrawer = Pos::viewDrawer($request);
		 print $viewDrawer;
	}
	public function closeDrawer(Request $request)
	{
		$closeDrawer = Pos::closeDrawer($request);
		 print $closeDrawer;
	}
	public function drawerHistory(Request $request)
	{
		$drawerHistory = Pos::drawerHistory($request);
		print $drawerHistory;	
	}
	public function getPosPayment(Request $request)
	{
		$getPosPayment = Pos::getPosPayment($request);
		print $getPosPayment;
	}
	public function viewPosCoupon(Request $request)
	{
		$viewPosCoupon = Pos::viewPosCoupon($request);
		print $viewPosCoupon;
	}
	public function viewshopsetting(Request $request)
	{
		$viewshopsetting = Pos::viewshopsetting($request);
		print $viewshopsetting;
	}
	public function updateshopsetting(Request $request)
	{
		$updateshopsetting = Pos::updateshopsetting($request);
		print $updateshopsetting;
	}
	public function viewposlanguages(Request $request)
	{
		$viewposlanguages = Pos::viewposlanguages($request);
		print $viewposlanguages;
	}
	public function salesreport(Request $request)
	{
		$salesreport = Pos::salesreport($request);
		print $salesreport;
	}
	public function productwisesalesreport(Request $request)
	{
		$productwisesalesreport = Pos::productwisesalesreport($request);
		print $productwisesalesreport;
		
	}
	public function posunseenOrders(Request $request)
	{
		$posunseenOrders = Pos::posunseenOrders($request);
		print $posunseenOrders;
	}
	public function updateposunseenOrders(Request $request)
	{
		$updateposunseenOrders = Pos::updateposunseenOrders($request);
		print $updateposunseenOrders;
	}
	public function updatePosPaymentstatus(Request $request)
	{
		$updatePosPaymentstatus = Pos::updatePosPaymentstatus($request);
		print $updatePosPaymentstatus;
	}
	public function updatedrawerstatus(Request $request)
	{
		$updatedrawerstatus = Pos::updatedrawerstatus($request);
		print $updatedrawerstatus;
	}
	public function posadminrole(Request $request)
	{
		$posadminrole = Pos::posadminrole($request);
		print $posadminrole;
	}
	public function dashboardreport(Request $request)
	{
	  	$dashboardreport = Pos::dashboardreport($request);
		print $dashboardreport;
	}
	public function addhold(Request $request)
	{
	  	$addhold = Pos::addhold($request);
		print $addhold;
	}
	public function viewhold(Request $request)
	{
		$viewhold = Pos::viewhold($request);
		print $viewhold;
	}
	public function viewholddetails(Request $request)
	{
		$viewholddetails = Pos::viewholddetails($request);
		print $viewholddetails;
	}
	public function holdretrieve(Request $request)
	{
		$holdretrieve = Pos::holdretrieve($request);
		print $holdretrieve;
	}
	public function holddelete(Request $request)
	{
		$holddelete = Pos::holddelete($request);
		print $holddelete;
	}
	public function posGetallproducts(Request $request)
	{
		$posGetallproducts = Pos::posGetallproducts($request);
		print $posGetallproducts;
	}
	public function getreportproduct(Request $request)
	{
		$getreportproduct = Pos::getreportproduct($request);
		print $getreportproduct;
	}
	public function applyposcoupon(Request $request)
	{
		$applyposcoupon = Pos::applyposcoupon($request);
		print $applyposcoupon;
	}
	public function getstockaddproduct(Request $request)
	{
		$getstockaddproduct=Pos::getstockaddproduct($request);
		print $getstockaddproduct;
	}
	public function currentstock(Request $request)
	{
		$currentstock=Pos::currentstock($request);
		print $currentstock;

	}
	public function addstock(Request $request)
	{
		$addstock=Pos::addstock($request);
		print $addstock;
	}
	public function viewStockReport(Request $request)
	{
		$report=Pos::viewStockReport($request);
		print $report;
	}
	public function addCashManagementCate(Request $request)
	{
		$report=Pos::addCashManagementCate($request);
		print $report;
	}
	public function getCashManagementCate(Request $request)
	{
		$report=Pos::getCashManagementCate($request);
		print $report;
	}
	public function addPaidInOut(Request $request)
	{
		$report=Pos::addPaidInOut($request);
		print $report;
	}
	public function cashierRole(Request $request)
	{
		$report=Pos::cashierRole($request);
		print $report;
	}
	public function fastCash(Request $request)
	{
		$report=Pos::fastCash($request);
		print $report;
	}
	public function updateFastCash(Request $request)
	{
		$report=Pos::updateFastCash($request);
		print $report;
	}
	public function topProduct(Request $request)
	{
		$report=Pos::topProduct($request);
		print $report;
	}
	public function topCategory(Request $request)
	{
		$report=Pos::topCategory($request);
		print $report;
	}
	public function getPosTable(Request $request)
	{
		$getPosTable=Pos::getPosTable($request);
		print $getPosTable;
	}
	public function posTableCheckin(Request $request)
	{
		$posTableCheckin=Pos::posTableCheckin($request);
		print $posTableCheckin;
	}
	public function scanQrcode(Request $request)
	{
		$scanQrcode=Pos::scanQrcode($request);
		print $scanQrcode;
	}
	public function checkQrcode(Request $request)
	{
		$checkQrcode=Pos::checkQrcode($request);
		print $checkQrcode;
	}
	public function updateposCart(Request $request)
	{
		$updateposCart=Pos::updateposCart($request);
		print $updateposCart;
	}
	public function addPrinter(Request $request)
	{
		$addPrinter=Pos::addPrinter($request);
		print $addPrinter;
	}
	public function viewPrinter(Request $request)
	{
		$viewPrinter=Pos::viewPrinter($request);
		print $viewPrinter;
	}
	public function updatePrinter(Request $request)
	{
		$updatePrinter=Pos::updatePrinter($request);
		print $updatePrinter;
	}
	public function deletePrinter(Request $request)
	{
		$deletePrinter=Pos::deletePrinter($request);
		print $deletePrinter;
	}
	public function addCashierDevices(Request $request)
	{
		$addCashierDevices=Pos::addCashierDevices($request);
		print $addCashierDevices;
	}
	public function getServeProduct(Request $request)
	{
		$getServeProduct=Pos::getServeProduct($request);
		print $getServeProduct;
	}
	public function changeStatusServeProduct(Request $request)
	{
		$changeStatusServeProduct=Pos::changeStatusServeProduct($request);
		print $changeStatusServeProduct;
	}
	public function pointConvertAmount(Request $request)
	{
		$pointConvertAmount=Pos::pointConvertAmount($request);
		print $pointConvertAmount;
	}
	public function addProductDiscount(Request $request)
	{
		$addProductDiscount=Pos::addProductDiscount($request);
		print $addProductDiscount;
	}
	public function addBillDiscount(Request $request)
	{
		$addBillDiscount=Pos::addBillDiscount($request);
		print $addBillDiscount;
	}
	public function createTable(Request $request)
	{
		$createTable=Pos::createTable($request);
		print $createTable;
	}
	public function updatePin(Request $request)
	{
		$updatePin=Pos::updatePin($request);
		print $updatePin;
	}
	public function getCashierProfile(Request $request)
	{
		$getCashierProfile=Pos::getCashierProfile($request);
		print $getCashierProfile;
	}
	public function checkoutTable(Request $request)
	{
		$checkoutTable=Pos::checkoutTable($request);
		print $checkoutTable;
	}
	public function getBarKitchenProduct(Request $request)
	{
		$getBarKitchenProduct=Pos::getBarKitchenProduct($request);
		print $getBarKitchenProduct;
	}
	public function deleteBarKitchenProduct(Request $request)
	{
		$deleteBarKitchenProduct=Pos::deleteBarKitchenProduct($request);
		print $deleteBarKitchenProduct;
	}
	public function tipsReport(Request $request)
	{
		$tipsReport=Pos::tipsReport($request);
		print $tipsReport;
	}
	public function getSalesPerson(Request $request)
	{
		$getSalesPerson=Pos::getSalesPerson($request);
		print $getSalesPerson;
	}
	public function addCartSalesPerson(Request $request)
	{
		$addCartSalesPerson=Pos::addCartSalesPerson($request);
		print $addCartSalesPerson;
	}
	public function productTaxCal(Request $request)
	{
		$productTaxCal=Pos::productTaxCal($request);
		print $productTaxCal;
	}
	public function scanPosUser(Request $request)
	{
		$scanPosUser=Pos::scanPosUser($request);
		print $scanPosUser;
	}
	public function posTopup(Request $request)
	{
		$posTopup=Pos::posTopup($request);
		print $posTopup;
	}
	public function getDrawerCategory(Request $request)
	{
		$getDrawerCategory=Pos::getDrawerCategory($request);
		print $getDrawerCategory;
	}
	public function editAmount(Request $request)
	{
		$editAmount=Pos::editAmount($request);
		print $editAmount;
	}
	public function addPrinterUsb(Request $request)
	{
		$addPrinterUsb=Pos::addPrinterUsb($request);
		print $addPrinterUsb;
	}
	public function viewPrinterUsb(Request $request)
	{
		$viewPrinterUsb=Pos::viewPrinterUsb($request);
		print $viewPrinterUsb;
	}
	public function updatePrinterUsb(Request $request)
	{
		$updatePrinterUsb=Pos::updatePrinterUsb($request);
		print $updatePrinterUsb;
	}
	public function deletePrinterUsb(Request $request)
	{
		$deletePrinterUsb=Pos::deletePrinterUsb($request);
		print $deletePrinterUsb;
	}
	public function updateCustomerCart(Request $request)
	{
		$updateCustomerCart=Pos::updateCustomerCart($request);
		print $updateCustomerCart;
	}
}
?>