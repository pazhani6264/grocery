<?php
header('Content-Type: text/html; charset=utf-8');
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api', 'cors')->get('/user', function (Request $request) {
    return $request->user();
});
 */




/*
	|--------------------------------------------------------------------------
	| App Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains all Routes of application
	|
	|
*/

Route::group(['namespace' => 'App'], function () {

	//Route::post('/uploadimage', 'AppSettingController@uploadimage');
	
	Route::post('/getcategories', 'CategoriesController@getcategories');

	Route::post('/getposcategories', 'CategoriesController@getposcategories');

	Route::post('/addcategories', 'CategoriesController@addcategories');

	Route::post('/editcategories', 'CategoriesController@editcategories');

	Route::post('/deletecategories', 'CategoriesController@deletecategories');

	Route::post('/addproduct', 'CategoriesController@addproduct');
	
	Route::post('/editproduct', 'CategoriesController@editproduct');
	Route::post('/viewproductimage', 'CategoriesController@viewproductimage');
	Route::post('/insertproductimages', 'CategoriesController@insertproductimages');
	Route::post('/editproductimages', 'CategoriesController@editproductimages');
	Route::post('/deleteproductimages', 'CategoriesController@deleteproductimages');
	Route::post('/deleteproduct', 'CategoriesController@deleteproduct');
	Route::post('/getproduct', 'CategoriesController@getproduct');
	Route::post('/getUserProduct', 'CategoriesController@getUserProduct');
	Route::post('/getCategoriesProduct', 'CategoriesController@getCategoriesProduct');

	Route::post('/gettaxclass', 'CategoriesController@gettaxclass');

	Route::post('/getmanufacturer', 'CategoriesController@getmanufacturer');
	Route::post('/getBrands', 'CategoriesController@getBrands');

	//registration url
	Route::post('/registerdevices', 'CustomersController@registerdevices');
	Route::post('/registerdevicesnew', 'CustomersController@registerdevicesnew');

	//processregistration url
	Route::post('/processregistration', 'CustomersController@processregistration');


	//update customer info url
	Route::post('/updatecustomerinfo', 'CustomersController@updatecustomerinfo');
	Route::get('/updatepassword', 'CustomersController@updatepassword');

	// login url
	Route::post('/processlogin', 'CustomersController@processlogin');

	Route::post('/processlogout', 'CustomersController@processlogout');

	//social login
	Route::post('/facebookregistration', 'CustomersController@facebookregistration');
	Route::post('/googleregistration', 'CustomersController@googleregistration');
	Route::post('/appleregistration', 'CustomersController@appleregistration');

	//push notification setting
	Route::post('/notify_me', 'CustomersController@notify_me');
	Route::post('/getPromotionalVoucher', 'CustomersController@getPromotionalVoucher');
	Route::post('/getRewardsVoucher', 'CustomersController@getRewardsVoucher');
	Route::post('/getDiscountsVoucher', 'CustomersController@getDiscountsVoucher');
	Route::post('/getActiveVoucher', 'CustomersController@getActiveVoucher');
	Route::post('/getUseExpiredVoucher', 'CustomersController@getUseExpiredVoucher');
	Route::post('/getFavouriteVoucher', 'CustomersController@getFavouriteVoucher');

	// forgot password url
	Route::post('/processforgotpassword', 'CustomersController@processforgotpassword');

	/*
	|--------------------------------------------------------------------------
	| Location Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains countries shipping detail
	| This section contains links of affiliated to address
	|
	*/

	//get country url
	Route::post('/getcountries', 'LocationController@getcountries');

	//get zone url
	Route::post('/getzones', 'LocationController@getzones');

	//get all address url
	Route::post('/getalladdress', 'LocationController@getalladdress');

	//address url
	Route::post('/addshippingaddress', 'LocationController@addshippingaddress');

	//update address url
	Route::post('/updateshippingaddress', 'LocationController@updateshippingaddress');

	//update default address url
	Route::post('/updatedefaultaddress', 'LocationController@updatedefaultaddress');

	//delete address url
	Route::post('/deleteshippingaddress', 'LocationController@deleteshippingaddress');

	/*
	|--------------------------------------------------------------------------
	| Product Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains product data
	| Such as:
	| top seller, Deals, Liked, categroy wise or category individually and detail of every product.
	*/


	//get categories
	Route::post('/allcategories', 'MyProductController@allcategories');

	//getAllProducts
	Route::post('/getallproducts', 'MyProductController@getallproducts');
	Route::post('/getProductsbrand', 'MyProductController@getProductsbrand');

	//recent product
	Route::post('/getrecentproducts', 'MyProductController@getrecentproducts');

	//like products
	Route::post('/likeproduct', 'MyProductController@likeproduct');

	//notify me

	Route::post('/notifyme_product', 'MyProductController@notifyme_product');

	//unlike products
	Route::post('/unlikeproduct', 'MyProductController@unlikeproduct');

	//get filters
	Route::post('/getfilters', 'MyProductController@getfilters');

	//get getFilterproducts
	Route::post('/getfilterproducts', 'MyProductController@getfilterproducts');

	Route::post('/getsearchdata', 'MyProductController@getsearchdata');

	//getquantity
	Route::post('/getquantity', 'MyProductController@getquantity');

	Route::post('/getproductQuantity', 'MyProductController@getproductQuantity');


	/*
	|--------------------------------------------------------------------------
	| News Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains news data
	| Such as:
	| top news or category individually and detail of every news.

	*/


	//get categories
	Route::post('/allnewscategories', 'NewsController@allnewscategories');

	//getAllProducts
	Route::post('/getallnews', 'NewsController@getallnews');

	/*
	|--------------------------------------------------------------------------
	| Cart Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains customer orders
	|
	*/

	//hyperpaytoken
	Route::post('/hyperpaytoken', 'OrderController@hyperpaytoken');

	//hyperpaytoken
	Route::get('/hyperpaypaymentstatus', 'OrderController@hyperpaypaymentstatus');

	//paymentsuccess
	Route::get('/paymentsuccess', 'OrderController@paymentsuccess');

	//paymenterror
	Route::post('/paymenterror', 'OrderController@paymenterror');

	//generateBraintreeToken
	Route::get('/generatebraintreetoken', 'OrderController@generatebraintreetoken');

	//generateBraintreeToken
	Route::get('/instamojotoken', 'OrderController@instamojotoken');

	//add To order
	Route::post('/addtoorder', 'OrderController@addtoorder');
	Route::post('/newaAddtoOrder', 'OrderController@newaAddtoOrder');

	//checkstock
	Route::post('/checkstock', 'OrderController@checkstock');

	//ipay88
	Route::post('/ipay88_Callback', 'OrderController@ipay88_Callback');

	//updatestatus
	Route::post('/updatestatus/', 'OrderController@updatestatus');

	//get all orders
	Route::post('/getorders', 'OrderController@getorders');
	Route::post('/getordersbyid', 'OrderController@getordersbyid');
	Route::post('/getordersbyType', 'OrderController@getordersbyType');

	//get default payment method
	Route::post('/getpaymentmethods', 'OrderController@getpaymentmethods');
	Route::post('/getdirectbank', 'OrderController@getdirectbank');

	//get shipping / tax Rate
	Route::post('/getrate', 'OrderController@getrate');

	//get Coupon
	Route::post('/getcoupon', 'OrderController@getcoupon');
	Route::post('/redeemCoupon', 'OrderController@redeemCoupon');
	Route::post('/redeemPointCoupon', 'OrderController@redeemPointCoupon');
	Route::post('/addFavouriteCoupon', 'OrderController@addFavouriteCoupon');
	Route::post('/addFavouritePointCoupon', 'OrderController@addFavouritePointCoupon');


	//paytm hash key
	Route::get('/generatpaytmhashes', 'OrderController@generatpaytmhashes');

	Route::post('/cancelorder', 'OrderController@cancelorder');
	/*
	|--------------------------------------------------------------------------
	| Banner Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains banners, banner history
	|
	*/

	//get banners
	Route::get('/getbanners', 'BannersController@getbanners');

	//banners history
	Route::post('/bannerhistory', 'BannersController@bannerhistory');

	/*
	|--------------------------------------------------------------------------
	| App setting Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains app  languages
	|

	*/
	Route::get('/sitesetting', 'AppSettingController@sitesetting');

	Route::post('/ordersstatus', 'AppSettingController@ordersstatus');

	Route::post('/getCountryCode', 'AppSettingController@getCountryCode');
	//old app label
	Route::post('/applabels', 'AppSettingController@applabels');

	//new app label
	Route::get('/applabels3', 'AppSettingController@applabels3');
	Route::post('/contactus', 'AppSettingController@contactus');
	Route::get('/getlanguages', 'AppSettingController@getlanguages');


	/*
	|--------------------------------------------------------------------------
	| Page Controller Routes
	|--------------------------------------------------------------------------
	|
	| This section contains news data
	| Such as:
	| top Page individually and detail of every Page.

	*/

	//getAllPages
	Route::post('/getallpages', 'PagesController@getallpages');


  /*
	|--------------------------------------------------------------------------
	| reviews Controller Routes
	|--------------------------------------------------------------------------
 */

   Route::post('/givereview', 'ReviewsController@givereview');
   Route::post('/updatereview', 'ReviewsController@updatereview');
   Route::get('/getreviews', 'ReviewsController@getreviews');
   Route::post('/giveorderreview', 'ReviewsController@giveorderreview');
   Route::get('/getorderreviews', 'ReviewsController@getorderreviews');

  /*
  |--------------------------------------------------------------------------
  | current location Controller Routes
  |--------------------------------------------------------------------------
  */

  Route::get('/getlocation', 'AppSettingController@getlocation');
  
  /*
  |--------------------------------------------------------------------------
  | currency location Controller Routes
  |--------------------------------------------------------------------------
  */

  Route::get('/getcurrencies', 'AppSettingController@getcurrencies');

  Route::post('/getloyalty', 'LoyaltyController@getloyalty');

  Route::post('/availablecoupon', 'LoyaltyController@availablecoupon');

  Route::post('/applyredeempoints', 'LoyaltyController@applyredeempoints');

  Route::post('/getpaymentstatus', 'OrderController@getpaymentstatus');

  Route::post('/sendotp', 'CustomersController@sendotp');

  Route::post('/resendotp', 'CustomersController@resendotp');

  Route::post('/otpverification', 'CustomersController@otpverification');

  Route::post('/pointshistory', 'CustomersController@pointshistory');

  Route::post('/removeloyalty', 'LoyaltyController@removeloyalty');

  Route::post('/geofencing', 'OrderController@geofencing');

 Route::post('/getprofile', 'CustomersController@getprofile');

 Route::post('/activeredeempoint', 'LoyaltyController@activeredeempoint');

 Route::post('/viewyourrewards', 'LoyaltyController@viewyourrewards');


Route::post('/gallery', 'MediaController@viewimage');

Route::post('/addgallery', 'MediaController@addGallery');

// Add Default Options
Route::post('/getOptionName', 'CategoriesController@getOptionName');
Route::post('/getOptionsValue', 'CategoriesController@getOptionsValue');
Route::post('/addOptionsValue', 'CategoriesController@addOptionsValue');
Route::post('/viewProductsattributes', 'CategoriesController@viewProductsattributes');
Route::post('/updateOptionsValue', 'CategoriesController@updateOptionsValue');
Route::post('/deleteOptionsValue', 'CategoriesController@deleteOptionsValue');



// Listing Additional Products Options
Route::post('/addAdditionalOptions', 'CategoriesController@addAdditionalOptions');
Route::post('/updateAdditionalOptions', 'CategoriesController@updateAdditionalOptions');
Route::post('/deleteAdditionalOptions', 'CategoriesController@deleteAdditionalOptions');

// Product video
Route::post('/displayProductVideos', 'CategoriesController@displayProductVideos');
Route::post('/addProductVideos', 'CategoriesController@addProductVideos');
Route::post('/updateproductvideo', 'CategoriesController@updateproductvideo');
Route::post('/deleteproductvideorecord', 'CategoriesController@deleteproductvideorecord');

Route::post('/addcustomer', 'CustomersController@addcustomer');
Route::post('/editcustomer', 'CustomersController@editcustomer');
Route::post('/deletecustomer', 'CustomersController@deletecustomer');
Route::post('/customerlist', 'CustomersController@customerlist');
Route::post('/adduseragent', 'CustomersController@adduseragent');
Route::post('/addGuest', 'CustomersController@addGuest');

//pos Ticket
Route::post('/tickets', 'TicketsController@tickets');
Route::post('/ticketsCount', 'TicketsController@ticketsCount');
Route::post('/viewTickets', 'TicketsController@viewTickets');
Route::post('/viewTicketData', 'TicketsController@viewTicketData');
Route::post('/addTicketData', 'TicketsController@addTicketData');
Route::post('/UpdateTicketData', 'TicketsController@UpdateTicketData');
Route::post('/InsertTicket', 'TicketsController@InsertTicket');
Route::post('/viewTicketProduct', 'TicketsController@viewTicketProduct');
Route::post('/ticketNotification', 'TicketsController@ticketNotification');
//pos app
Route::post('/addposCart', 'PosController@addposCart');
Route::post('/viewposCart', 'PosController@viewposCart');
Route::post('/deleteposCart', 'PosController@deleteposCart');
Route::post('/updateposCart', 'PosController@updateposCart');
Route::post('/clearallposCart', 'PosController@clearallposCart');

Route::post('/addhold', 'PosController@addhold');
Route::post('/viewhold', 'PosController@viewhold');
Route::post('/holddetails', 'PosController@viewholddetails');
Route::post('/holdretrieve', 'PosController@holdretrieve');
Route::post('/holddelete', 'PosController@holddelete');

Route::post('/cashierLogin', 'PosController@cashierLogin');
Route::post('/viewBill', 'PosController@viewBill');
Route::post('/cancelBill', 'PosController@cancelBill');
Route::post('/openDrawer', 'PosController@openDrawer');
Route::post('/viewDrawer', 'PosController@viewDrawer');
Route::post('/closeDrawer', 'PosController@closeDrawer');
Route::post('/drawerHistory', 'PosController@drawerHistory');
Route::post('/getPosPayment', 'PosController@getPosPayment');
Route::post('/viewPosCoupon', 'PosController@viewPosCoupon');
Route::post('/posGetallproducts', 'PosController@posGetallproducts');
//pos app settings
Route::post('/viewshopsetting', 'PosController@viewshopsetting');
Route::post('/updateshopsetting', 'PosController@updateshopsetting');
Route::post('/viewposlanguages', 'PosController@viewposlanguages');
Route::post('/updatePosPaymentstatus', 'PosController@updatePosPaymentstatus');
Route::post('/addPrinter', 'PosController@addPrinter');
Route::post('/viewPrinter', 'PosController@viewPrinter');
Route::post('/updatePrinter', 'PosController@updatePrinter');
Route::post('/deletePrinter', 'PosController@deletePrinter');
Route::post('/addCashierDevices', 'PosController@addCashierDevices');
//pos app report
Route::post('/salesreport', 'PosController@salesreport');
Route::post('/productwisesalesreport', 'PosController@productwisesalesreport');
Route::post('/dashboardreport', 'PosController@dashboardreport');
Route::post('/tipsReport', 'PosController@tipsReport');
Route::post('/posunseenOrders', 'PosController@posunseenOrders');
Route::post('/updateposunseenOrders', 'PosController@updateposunseenOrders');
Route::post('/updatedrawerstatus', 'PosController@updatedrawerstatus');
Route::post('/posadminrole', 'PosController@posadminrole');
Route::post('/getreportproduct', 'PosController@getreportproduct');
Route::post('/applyposcoupon', 'PosController@applyposcoupon');
Route::post('/createTable', 'PosController@createTable');
Route::post('/checkoutTable', 'PosController@checkoutTable');
Route::post('/getDrawerCategory', 'PosController@getDrawerCategory');

Route::post('/merchantLogin', 'MerchantController@merchantLogin');
Route::post('/getMerchantOrders', 'MerchantController@getMerchantOrders');
Route::post('/viewStatus', 'MerchantController@viewStatus');
Route::post('/updateOrder', 'MerchantController@updateOrder');
Route::post('/deliveryBoys', 'MerchantController@deliveryBoys');
Route::post('/currentBoy', 'MerchantController@currentBoy');
Route::post('/assignOrders', 'MerchantController@assignOrders');
Route::post('/getOrderStatus', 'MerchantController@getOrderStatus');

// pos stock 
Route::post('/getstockaddproduct', 'PosController@getstockaddproduct');
Route::post('/currentstock', 'PosController@currentstock');
Route::post('/addstock', 'PosController@addstock');
Route::post('/viewstockreport', 'PosController@viewStockReport');

Route::post('/invoiceImageInsert', 'OrderController@invoiceImageInsert');
Route::post('/updateMyEmail', 'CustomersController@updateMyEmail');

Route::post('/addCart', 'CartController@addCart');
Route::post('/viewCart', 'CartController@viewCart');
Route::post('/deleteCart', 'CartController@deleteCart');
Route::post('/updateCart', 'CartController@updateCart');
Route::post('/clearallCart', 'CartController@clearallCart');
Route::post('/updateCartQuantity', 'CartController@updateCartQuantity');

Route::post('/viewWalletPayment', 'WalletController@viewWalletPayment');
Route::post('/getWallethistory', 'WalletController@viewWalletHistory');
Route::post('/addWallet', 'WalletController@addWallet');
Route::post('/getWalletStatus', 'WalletController@getWalletStatus');
Route::post('/uploadBankbill', 'WalletController@uploadBankbill');

Route::post('/addCashManagementCate', 'PosController@addCashManagementCate');
Route::post('/getCashManagementCate', 'PosController@getCashManagementCate');
Route::post('/addPaidInOut', 'PosController@addPaidInOut');
Route::post('/cashierRole', 'PosController@cashierRole');
Route::post('/fastCash', 'PosController@fastCash');
Route::post('/updateFastCash', 'PosController@updateFastCash');	
Route::post('/topProduct', 'PosController@topProduct');
Route::post('/topCategory', 'PosController@topCategory');
Route::post('/getServeProduct', 'PosController@getServeProduct');
Route::post('/changeStatusServeProduct', 'PosController@changeStatusServeProduct');
Route::post('/pointConvertAmount', 'PosController@pointConvertAmount');
Route::post('/addProductDiscount', 'PosController@addProductDiscount');
Route::post('/addBillDiscount', 'PosController@addBillDiscount');
Route::post('/updatePin', 'PosController@updatePin');
Route::post('/getCashierProfile', 'PosController@getCashierProfile');
Route::post('/getBarKitchenProduct', 'PosController@getBarKitchenProduct');
Route::post('/deleteBarKitchenProduct', 'PosController@deleteBarKitchenProduct');
Route::post('/getSalesPerson', 'PosController@getSalesPerson');
Route::post('/addCartSalesPerson', 'PosController@addCartSalesPerson');
Route::post('/productTaxCal', 'PosController@productTaxCal');
Route::post('/scanUser', 'PosController@scanPosUser');
Route::post('/posTopup', 'PosController@posTopup');
Route::post('/editAmount', 'PosController@editAmount');
Route::post('/addPrinterUsb', 'PosController@addPrinterUsb');
Route::post('/viewPrinterUsb', 'PosController@viewPrinterUsb');
Route::post('/updatePrinterUsb', 'PosController@updatePrinterUsb');
Route::post('/deletePrinterUsb', 'PosController@deletePrinterUsb');
Route::post('/updateCustomerCart', 'PosController@updateCustomerCart');

//pos table
 Route::post('/getPosTable', 'PosController@getPosTable');
 Route::post('/posTableCheckin', 'PosController@posTableCheckin');

//scan qrcode
 Route::post('/scanQrcode', 'PosController@scanQrcode');
 Route::post('/checkQrcode', 'PosController@checkQrcode');

/* --------------- Appointment ----------------- */
// getoutlet
Route::post('/appointmentOutlet', 'AppointmentController@appointmentOutlet');
Route::post('/appointmentOutletSelect', 'AppointmentController@appointmentOutletSelect');
Route::post('/appointmentDateSelect', 'AppointmentController@appointmentDateSelect');
Route::post('/addtoAppointment', 'AppointmentController@addtoAppointment');
Route::post('/viewAppointment', 'AppointmentController@viewAppointment');
Route::post('/viewAppointmentByID', 'AppointmentController@viewAppointmentByID');
Route::post('/cancelAppointment', 'AppointmentController@cancelAppointment');
Route::post('/trackAppointment', 'AppointmentController@trackAppointment');



/* --------------- qrorder ----------------- */

Route::post('/gettablecategories', 'CategoriesController@gettablecategories');
Route::post('/gettableproducts', 'CategoriesController@gettableproducts');
Route::post('/addtableCart', 'CategoriesController@addtableCart');
Route::post('/viewtableCart', 'CategoriesController@viewtableCart');
Route::post('/deletetableCart', 'CategoriesController@deletetableCart');
Route::post('/updatetableCart', 'CategoriesController@updatetableCart');
Route::post('/clearalltableCart', 'CategoriesController@clearalltableCart');

});
