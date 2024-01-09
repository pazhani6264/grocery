<?php

header('Content-Type: text/html; charset=utf-8');
if(file_exists(storage_path('installed'))){
	$check = DB::table('settings')->where('id', 94)->first();
	if($check->value == 'Maintenance'){
		$middleware = ['installer','env'];
	}
	else{
		$middleware = ['installer'];
	}
}
else{
	$middleware = ['installer'];
}
 Route::fallback(function () {

    return view("web.404");

}); 
Route::get('/maintance','Web\IndexController@maintance');

Route::group(['namespace' => 'Web','middleware' => ['installer']], function () {
Route::get('/login', 'CustomersController@login');

Route::get('/loginPdf', 'CustomersController@loginPdf');

Route::post('/process-login', 'CustomersController@processLogin');

Route::post('/process-login_molla', 'CustomersController@processLoginMolla');

Route::get('/login_nine', 'CustomersController@loginNine');
Route::post('/process-login-nine', 'CustomersController@processLoginNine');


Route::get('/logout', 'CustomersController@logout')->middleware('Customer');
});
Route::group(['namespace' => 'Web','middleware' => $middleware], function () {
	Route::get('general_error/{msg}', function($msg) {
		 return view('errors.general_error',['msg' => $msg]);
	});
	// route for to show payment form using get method
		Route::get('pay', 'RazorpayController@pay')->name('pay');
    	Route::post('/paytm-callback', 'PaytmController@paytmCallback');
    	Route::post('/paytmserver', 'PaytmController@paytmServer');
		Route::get('/store_paytm', 'PaytmController@store');
		Route::post('/paytm-callback-app', 'PaytmController@paytmCallbackApp');
		Route::post('/paytm-callback-wallet', 'PaytmController@paytmCallbackWallet');
		Route::get('/paytm_callback_app/{id}', 'PaytmController@paytm_callback_app');
		Route::get('/store_app/{id}', 'PaytmController@store_app');
		Route::get('/wallet_app/{id}', 'PaytmController@wallet_app');

		
	
		// route for make payment request using post method
		Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

		Route::get('/','IndexController@index');
		Route::get('/readytemplate_demo/{id}', 'ReadyTemplateController@demoTemplate');

		Route::post('/change_language', 'WebSettingController@changeLanguage');
		Route::post('/change_currency', 'WebSettingController@changeCurrency');
		Route::post('/addToCart', 'CartController@addToCart');
		Route::post('/updateToCart', 'CartController@updateToCart');
		Route::post('/addToCartFixed', 'CartController@addToCartFixed');
		Route::post('/addToCartResponsive', 'CartController@addToCartResponsive');
		
		Route::post('/modal_show', 'ProductsController@ModalShow');
		Route::post('/modal_show2', 'ProductsController@ModalShow2');
		Route::post('/quickmodal_show3', 'ProductsController@quickModalShow3');
		Route::post('/modal_show5', 'ProductsController@ModalShow5');
		
		Route::get('/login_modal', 'CustomersController@LoginModalShow');
		Route::get('/login_modal1', 'CustomersController@LoginModalShow1');
		Route::get('/login_modal2', 'CustomersController@LoginModalShow2');
		Route::get('/login_modal3', 'CustomersController@LoginModalShow3');
		Route::get('/login_modal4', 'CustomersController@LoginModalShow4');

		Route::post('/reviews', 'ProductsController@reviews');
		Route::post('/reviewadd', 'ProductsController@reviewadd');
		Route::post('/ask_a_question', 'ProductsController@askAQuestion');
		Route::post('/ask_a_questionnote', 'ProductsController@askAQuestionnote');
		Route::post('/deliveryreviews', 'ProductsController@deliveryreviews');
		Route::get('/deleteCart', 'CartController@deleteCart');
		Route::get('/viewcart', 'CartController@viewcart');
		Route::get('/applyredeempoints/{id}', 'CartController@applyredeempoints');
		Route::get('/redeempoints/{id}', 'CartController@redeempoints');
		Route::get('/editcart/{id}/{slug}', 'CartController@editcart');
		Route::post('/updateCart', 'CartController@updateCart');
		Route::post('/updatesinglecart', 'CartController@updatesinglecart');
		Route::get('/cartButton', 'CartController@cartButton');

		Route::get('/profile', 'CustomersController@profile')->middleware('Customer');
		Route::get('/change-password', 'CustomersController@changePassword')->middleware('Customer');
		
		Route::get('/wishlist', 'CustomersController@wishlist')->middleware('Customer');
		Route::post('/updateMyProfile', 'CustomersController@updateMyProfile')->middleware('Customer');
		Route::post('/updateMyPhone', 'CustomersController@updateMyPhone')->middleware('Customer');
		
		Route::get('update_phoneotp/{id}', 'CustomersController@update_phoneotp')->middleware('Customer');
		Route::post('/processotpupdate', 'CustomersController@processotpupdate')->middleware('Customer');
		Route::get('resendotpupdate/{id}/{phone}', 'CustomersController@resendotpupdate');
		Route::post('/updateMyPassword', 'CustomersController@updateMyPassword')->middleware('Customer');
		Route::get('UnlikeMyProduct/{id}', 'CustomersController@unlikeMyProduct')->middleware('Customer');
		Route::post('likeMyProduct', 'CustomersController@likeMyProduct');
		Route::post('addToCompare', 'CustomersController@addToCompare');
		Route::get('compare', 'CustomersController@Compare')->middleware('Customer');
		Route::get('deletecompare/{id}', 'CustomersController@DeleteCompare')->middleware('Customer');
		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::get('/rating_delivery/{id}', 'OrdersController@ratingDelivery')->middleware('Customer');
		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::get('/shipping-address', 'ShippingAddressController@shippingAddress')->middleware('Customer');
		Route::get('/shipping-address-new', 'ShippingAddressController@shippingAddressnew')->middleware('Customer');
		
		Route::post('/addMyAddress', 'ShippingAddressController@addMyAddress')->middleware('Customer');
		Route::post('/myDefaultAddress', 'ShippingAddressController@myDefaultAddress')->middleware('Customer');
		Route::post('/update-address', 'ShippingAddressController@updateAddress')->middleware('Customer');
		Route::get('/delete-address/{id}', 'ShippingAddressController@deleteAddress')->middleware('Customer');
		Route::post('/ajaxZones', 'ShippingAddressController@ajaxZones');
		//news section
		Route::get('/news', 'NewsController@news');
		Route::get('/news-detail/{slug}', 'NewsController@newsDetail');
		Route::get('/news-detail-p24/{slug}', 'NewsController@newsDetailp24');
		Route::post('/loadMoreNews', 'NewsController@loadMoreNews');
		Route::get('/page', 'IndexController@page');
		Route::get('/shop', 'ProductsController@shop');
		Route::get('/filter_index', 'ProductsController@filterindex');
		Route::get('/productbrand', 'ProductsController@productbrand');
		Route::post('/shop', 'ProductsController@shop');
		Route::get('/product-detail/{slug}', 'ProductsController@productDetail');
		Route::post('/filterProducts', 'ProductsController@filterProducts');
		Route::post('/getquantity', 'ProductsController@getquantity');

		Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'ProductsController@autocomplete'));

		Route::get('/guest_checkout', 'OrdersController@guest_checkout');
		Route::get('/merchantguest_checkout', 'OrdersController@merchantguest_checkout');

		Route::get('/checkout', 'OrdersController@checkout')->middleware('Customer');

		Route::post('/checkout_shipping_address', 'OrdersController@checkout_shipping_address')->middleware('Customer');
		Route::post('/checkout_shipping_address_new', 'OrdersController@checkout_shipping_address_new')->middleware('Customer');
		Route::post('/banktransfer_fileupload', 'OrdersController@banktransfer_fileupload')->middleware('Customer');
		Route::post('/checkout_billing_address', 'OrdersController@checkout_billing_address')->middleware('Customer');
		Route::post('/checkout_payment_method', 'OrdersController@checkout_payment_method')->middleware('Customer');
		Route::post('/checkout_payment_method_checkout3', 'OrdersController@checkout_payment_method_checkout3')->middleware('Customer');
		Route::post('/paymentComponent', 'OrdersController@paymentComponent');
		Route::post('/paymentcurrencycheck', 'OrdersController@paymentcurrencycheck');
		Route::post('/place_order', 'OrdersController@place_order')->middleware('Customer');
		
		Route::get('/order_filter', 'OrdersController@order_filter')->middleware('Customer');
		Route::get('/order_filter_pending', 'OrdersController@order_filter_pending')->middleware('Customer');
		Route::get('/order_filter_completed', 'OrdersController@order_filter_completed')->middleware('Customer');
        Route::get('/order_filter_print', 'ReportsController@order_filter_print')->middleware('report');

		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');

		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::post('/myorders', 'OrdersController@myorders')->middleware('Customer');
		Route::get('/invoiceprint/{id}', 'OrdersController@invoiceprint')->middleware('Customer');
		Route::get('/stripeForm', 'OrdersController@stripeForm')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::post('/pay-instamojo', 'OrdersController@payIinstamojo')->middleware('Customer');
		Route::get('/thankyou', 'OrdersController@thankyou')->middleware('Customer');
		Route::get('/paytm_thankyou', 'OrdersController@paytm_thankyou')->middleware('Customer');
		Route::get('/point-transaction', 'OrdersController@pointTransaction')->middleware('Customer');

		//paystack
		Route::get('/paystack/transaction', 'OrdersController@paystackTransaction')->middleware('Customer');
		Route::get('/paystack/verify/transaction', 'OrdersController@authorizepaystackTransaction')->middleware('Customer');
		
		//paystack
		Route::get('/midtrans/transaction', 'MidtransController@midtransTransaction')->middleware('Customer');
		// Route::get('/midtrans/verify/transaction', 'OrdersController@authorize<idtransTransaction')->middleware('Customer');

		//ipay88
		Route::post('/checkout/ipay88', 'OrdersController@ipay88')->middleware('Customer');
		Route::post('/callback/response', 'OrdersController@backend_response');
		Route::post('/onlinepay/response', 'OrdersController@ipay88response');
		Route::get('/appcheckout/ipay88/{id}', 'OrdersController@appcheckout_ipay88');
		Route::get('/appcheckout/ipayresponse/{id}/{status}', 'OrdersController@appcheckout_ipayresponse');

		//senangpay
		Route::post('/checkout/senangpay', 'OrdersController@senangPay')->middleware('Customer');
		Route::get('/senangpay/requests/{id}', 'OrdersController@senangpayRequests')->middleware('Customer');
		Route::get('/senangpay/response', 'OrdersController@senangpayResponse');
		Route::post('/senangpay/serverresponse', 'OrdersController@senangpayServerResponse');


		Route::get('/checkout/ipayresponse/{id}/{status}', 'OrdersController@ipayresponse')->middleware('Customer');
		Route::get('/checkout/payipay88/{id}', 'OrdersController@payipay88')->middleware('Customer');
		Route::get('/checkout/payNow/{id}', 'OrdersController@payNow')->middleware('Customer');
		Route::get('/checkout/hyperpay', 'OrdersController@hyperpay')->middleware('Customer');
		Route::get('/checkout/hyperpay/checkpayment', 'OrdersController@checkpayment')->middleware('Customer');
		Route::post('/checkout/payment/changeresponsestatus', 'OrdersController@changeresponsestatus')->middleware('Customer');
		Route::post('/apply_coupon', 'CartController@apply_coupon');
		Route::get('/removeCoupon/{id}', 'CartController@removeCoupon')->middleware('Customer');
		Route::get('/removeLoyalty/{id}', 'CartController@removeLoyalty')->middleware('Customer');
		Route::get('/removeactivateredeem/{id}', 'CartController@removeactivateredeem')->middleware('Customer');

		Route::get('/checkout/premierpay', 'OrdersController@premierpay')->middleware('Customer');
		Route::get('/premierpay/response/{id}', 'PremierpayController@premierpayresponse');
		Route::get('/premierpay/callback', 'OrdersController@premierpaycallback');
		Route::get('/premierpay/app/{id}', 'OrdersController@appcheckout_premierpay');

		Route::post('/addRedeempoint', 'CartController@addRedeempoint');
		Route::get('/getPointhistory', 'CartController@getPointhistory');

		Route::get('/signup', 'CustomersController@signup');
		Route::get('/logoutt', 'CustomersController@logout')->middleware('Customer');
		Route::post('/signupProcess', 'CustomersController@signupProcess');
		Route::post('/signupProcessMolla', 'CustomersController@signupProcessMolla');
		Route::get('/forgotPassword', 'CustomersController@forgotPassword');
		Route::get('/forgotPasswordMolla', 'CustomersController@forgotPasswordMolla');
		Route::get('/register', 'CustomersController@register');
		Route::get('/register1', 'CustomersController@register1');
		Route::get('/recoverPassword', 'CustomersController@recoverPassword');
		Route::post('/processPassword', 'CustomersController@processPassword');
		Route::post('/processPassword1', 'CustomersController@processPassword1');

		Route::get('otpVerfication/{id}', 'CustomersController@otpVerfication');
		Route::post('/processotpsignup', 'CustomersController@processotpsignup');
		Route::get('resendotp/{id}/{phone}', 'CustomersController@resendotp');

		Route::get('socialconfirm_phoneno/{id}', 'CustomersController@socialconfirm_phoneno');
		Route::post('/socialphonenoverfication', 'CustomersController@socialphonenoverfication');
		Route::get('socialotpVerfication/{id}', 'CustomersController@socialotpVerfication');
		Route::post('/socialprocessotpsignup', 'CustomersController@socialprocessotpsignup');
		Route::get('socialresendotp/{id}/{phone}', 'CustomersController@socialresendotp');

		Route::get('login/{social}', 'CustomersController@socialLogin');
		Route::get('login/{social}/callback', 'CustomersController@handleSocialLoginCallback');
		Route::post('/commentsOrder', 'OrdersController@commentsOrder');
		Route::post('/subscribeNotification/', 'CustomersController@subscribeNotification');
		Route::get('/contact', 'IndexController@contactus');
		Route::post('/processContactUs', 'IndexController@processContactUs');
		
		Route::get('/setcookie', 'IndexController@setcookie');
		Route::get('/newsletter', 'IndexController@newsletter');

		Route::get('/subscribeMail', 'IndexController@subscribeMail');
		Route::get('/notifyme', 'IndexController@notifyme');

		
		Route::get('/coming_soon', 'IndexController@coming_soon');
		Route::get('/faq', 'IndexController@faq');
		Route::get('/subscription', 'IndexController@subscription');
		Route::post('/instagram_feed', 'InstagramController@instagram_feed');

		Route::get('/newthankyou/{id}', 'PremierpayController@newthankyou');

		Route::post('/viewReward', 'CartController@viewReward');
		Route::post('/getloyalty_point', 'IndexController@getloyalty_point');
		Route::post('/unsubscribehide', 'IndexController@unsubscribehide');
		Route::get('/updatesubscription/{id}', 'IndexController@updatesubscription');
		

		Route::get('/tickets', 'TicketsController@tickets')->middleware('Customer');
		Route::get('/view_tickets', 'TicketsController@view_tickets')->middleware('Customer');
		Route::get('/search', 'TicketsController@search')->middleware('Customer');
		Route::get('/ticket/{id}', 'TicketsController@ViewTicketData')->middleware('Customer');
		Route::post('/ticket/store', 'TicketsController@AddTicketData')->middleware('Customer');
		Route::post('/ticket/update', 'TicketsController@UpdateTicketData')->middleware('Customer');
		Route::get('/open-ticket', 'TicketsController@openTicket')->middleware('Customer');
		Route::post('/insert-ticket', 'TicketsController@InsertTicket')->middleware('Customer');
		Route::get('/notifications', 'TicketsController@Notifications')->middleware('Customer');

		// ajax function

		// category 

		
		Route::post('/getallproductBycategory1', 'AjaxController@getallproductBycategory1');
		Route::post('/getallproductBycategory2', 'AjaxController@getallproductBycategory2');
		Route::post('/getallproductBycategory3', 'AjaxController@getallproductBycategory3');
		Route::post('/getallproductBycategory4', 'AjaxController@getallproductBycategory4');
		Route::post('/getallproductBycategory5', 'AjaxController@getallproductBycategory5');
		Route::post('/getallproductBycategory6', 'AjaxController@getallproductBycategory6');
		Route::post('/getallproductBycategory7', 'AjaxController@getallproductBycategory7');
		Route::post('/getallproductBycategory8', 'AjaxController@getallproductBycategory8');
		Route::post('/getallproductBycategory9', 'AjaxController@getallproductBycategory9');
		Route::post('/getallproductBycategory10', 'AjaxController@getallproductBycategory10');

		// category by product section

		Route::post('/getallproductBycategory1_section', 'AjaxController@getallproductBycategory1_section');
		Route::post('/getallproductBycategory2_section', 'AjaxController@getallproductBycategory2_section');
		Route::post('/getallproductBycategory3_section', 'AjaxController@getallproductBycategory3_section');
		Route::post('/getallproductBycategory3_section1', 'AjaxController@getallproductBycategory3_section1');


		// Trending product section

		Route::post('/getalltrendproduct1_section', 'AjaxController@getalltrendproduct1_section');
		Route::post('/getalltrendproduct2_section', 'AjaxController@getalltrendproduct2_section');
		Route::post('/getalltrendproduct2_mostliked_content', 'AjaxController@getalltrendproduct2_mostliked_content');
		Route::post('/getalltrendproduct2_special_content', 'AjaxController@getalltrendproduct2_special_content');
		Route::post('/getalltrendproduct2_topseller_content', 'AjaxController@getalltrendproduct2_topseller_content');

		Route::post('/getalltrendproduct3_section', 'AjaxController@getalltrendproduct3_section');
		Route::post('/getalltrendproduct4_section', 'AjaxController@getalltrendproduct4_section');
		Route::post('/getalltrendproduct5_section', 'AjaxController@getalltrendproduct5_section');

		Route::post('/getalltrendproduct6_section', 'AjaxController@getalltrendproduct6_section');
		Route::post('/getalltrendproduct7_section', 'AjaxController@getalltrendproduct7_section');
		Route::post('/getalltrendproduct8_section', 'AjaxController@getalltrendproduct8_section');
		Route::post('/getalltrendproduct9_section', 'AjaxController@getalltrendproduct9_section');
		Route::post('/getalltrendproduct10_section', 'AjaxController@getalltrendproduct10_section');
		Route::post('/getalltrendproduct11_section', 'AjaxController@getalltrendproduct11_section');
		Route::post('/getalltrendproduct12_section', 'AjaxController@getalltrendproduct12_section');
		Route::post('/getalltrendproduct13_section', 'AjaxController@getalltrendproduct13_section');
		Route::post('/getalltrendproduct14_section', 'AjaxController@getalltrendproduct14_section');
		Route::post('/getalltrendproduct15_section', 'AjaxController@getalltrendproduct15_section');
		Route::post('/getalltrendproduct16_section', 'AjaxController@getalltrendproduct16_section');


		// banners

		Route::post('/getbanner_1', 'AjaxController@getbanner_1');
		Route::post('/getbanner_2', 'AjaxController@getbanner_2');
		Route::post('/getbanner_3', 'AjaxController@getbanner_3');
		Route::post('/getbanner_4', 'AjaxController@getbanner_4');
		Route::post('/getbanner_5', 'AjaxController@getbanner_5');
		Route::post('/getbanner_6', 'AjaxController@getbanner_6');
		Route::post('/getbanner_7', 'AjaxController@getbanner_7');
		Route::post('/getbanner_8', 'AjaxController@getbanner_8');
		Route::post('/getbanner_9', 'AjaxController@getbanner_9');
		Route::post('/getbanner_10', 'AjaxController@getbanner_10');
		Route::post('/getbanner_11', 'AjaxController@getbanner_11');
		Route::post('/getbanner_12', 'AjaxController@getbanner_12');
		Route::post('/getbanner_13', 'AjaxController@getbanner_13');
		Route::post('/getbanner_14', 'AjaxController@getbanner_14');
		Route::post('/getbanner_15', 'AjaxController@getbanner_15');
		Route::post('/getbanner_16', 'AjaxController@getbanner_16');
		Route::post('/getbanner_17', 'AjaxController@getbanner_17');
		Route::post('/getbanner_18', 'AjaxController@getbanner_18');
		Route::post('/getbanner_19', 'AjaxController@getbanner_19');
		Route::post('/getbanner_20', 'AjaxController@getbanner_20');
		
		Route::post('/getbanner_22', 'AjaxController@getbanner_22');
		Route::post('/getbanner_23', 'AjaxController@getbanner_23');
		Route::post('/getbanner_24', 'AjaxController@getbanner_24');
		Route::post('/getbanner_25', 'AjaxController@getbanner_25');
		Route::post('/getbanner_26', 'AjaxController@getbanner_26');
		Route::post('/getbanner_27', 'AjaxController@getbanner_27');
		Route::post('/getbanner_28', 'AjaxController@getbanner_28');
		
		Route::post('/getbanner_30', 'AjaxController@getbanner_30');
		Route::post('/getbanner_31', 'AjaxController@getbanner_31');
		Route::post('/getbanner_32', 'AjaxController@getbanner_32');
		Route::post('/getbanner_33', 'AjaxController@getbanner_33');
		Route::post('/getbanner_34', 'AjaxController@getbanner_34');
		Route::post('/getbanner_35', 'AjaxController@getbanner_35');
		Route::post('/getbanner_36', 'AjaxController@getbanner_36');
		Route::post('/getbanner_37', 'AjaxController@getbanner_37');
		Route::post('/getbanner_38', 'AjaxController@getbanner_38');
		Route::post('/getbanner_39', 'AjaxController@getbanner_39');
		Route::post('/getbanner_40', 'AjaxController@getbanner_40');
		Route::post('/getbanner_41', 'AjaxController@getbanner_41');
		Route::post('/getbanner_42', 'AjaxController@getbanner_42');
		Route::post('/getbanner_43', 'AjaxController@getbanner_43');
		Route::post('/getbanner_44', 'AjaxController@getbanner_44');
		Route::post('/getbanner_45', 'AjaxController@getbanner_45');
		Route::post('/getbanner_46', 'AjaxController@getbanner_46');
		Route::post('/getbanner_47', 'AjaxController@getbanner_47');
		Route::post('/getbanner_48', 'AjaxController@getbanner_48');
		Route::post('/getbanner_49', 'AjaxController@getbanner_49');
		Route::post('/getbanner_50', 'AjaxController@getbanner_50');
		Route::post('/getbanner_51', 'AjaxController@getbanner_51');
		Route::post('/getbanner_52', 'AjaxController@getbanner_52');
		Route::post('/getbanner_53', 'AjaxController@getbanner_53');
		Route::post('/getbanner_54', 'AjaxController@getbanner_54');
		Route::post('/getbanner_55', 'AjaxController@getbanner_55');
		Route::post('/getbanner_56', 'AjaxController@getbanner_56');
		Route::post('/getbanner_57', 'AjaxController@getbanner_57');
		Route::post('/getbanner_58', 'AjaxController@getbanner_58');
		Route::post('/getbanner_59', 'AjaxController@getbanner_59');
		Route::post('/getbanner_60', 'AjaxController@getbanner_60');
		Route::post('/getbanner_61', 'AjaxController@getbanner_61');
		Route::post('/getbanner_62', 'AjaxController@getbanner_62');
		Route::post('/getbanner_63', 'AjaxController@getbanner_63');
		Route::post('/getbanner_64', 'AjaxController@getbanner_64');
		Route::post('/getbanner_65', 'AjaxController@getbanner_65');
		Route::post('/getbanner_66', 'AjaxController@getbanner_66');
		Route::post('/getbanner_67', 'AjaxController@getbanner_67');
		Route::post('/getbanner_68', 'AjaxController@getbanner_68');
		Route::post('/getbanner_69', 'AjaxController@getbanner_69');
		Route::post('/getbanner_70', 'AjaxController@getbanner_70');
		Route::post('/getbanner_71', 'AjaxController@getbanner_71');
		Route::post('/getbanner_72', 'AjaxController@getbanner_72');
		Route::post('/getbanner_73', 'AjaxController@getbanner_73');

		// flash sales

		Route::post('/getflashsales_1', 'AjaxController@getflashsales_1');
		Route::post('/getflashsales_2', 'AjaxController@getflashsales_2');
		Route::post('/getflashsales_3', 'AjaxController@getflashsales_3');
		Route::post('/getflashsales_4', 'AjaxController@getflashsales_4');
		Route::post('/getflashsales_5', 'AjaxController@getflashsales_5');

		// brand

		Route::post('/getclientbrand_1', 'AjaxController@getclientbrand_1');
		Route::post('/getclientbrand_2', 'AjaxController@getclientbrand_2');
		Route::post('/getclientbrand_3', 'AjaxController@getclientbrand_3');
		Route::post('/getclientbrand_4', 'AjaxController@getclientbrand_4');
		Route::post('/getclientbrand_5', 'AjaxController@getclientbrand_5');
		Route::post('/getclientbrand_6', 'AjaxController@getclientbrand_6');
		Route::post('/getclientbrand_7', 'AjaxController@getclientbrand_7');
		Route::post('/getclientbrand_8', 'AjaxController@getclientbrand_8');
		Route::post('/getclientbrand_9', 'AjaxController@getclientbrand_9');
		Route::post('/getclientbrand_10', 'AjaxController@getclientbrand_10');
		Route::post('/getclientbrand_11', 'AjaxController@getclientbrand_11');
		Route::post('/getclientbrand_12', 'AjaxController@getclientbrand_12');
		Route::post('/getclientbrand_13', 'AjaxController@getclientbrand_13');
		Route::post('/getclientbrand_14', 'AjaxController@getclientbrand_14');
		Route::post('/getclientbrand_15', 'AjaxController@getclientbrand_15');
		Route::post('/getclientbrand_16', 'AjaxController@getclientbrand_16');
		Route::post('/getclientbrand_17', 'AjaxController@getclientbrand_17');
		Route::post('/getclientbrand_18', 'AjaxController@getclientbrand_18');
		Route::post('/getclientbrand_19', 'AjaxController@getclientbrand_19');
		Route::post('/getclientbrand_20', 'AjaxController@getclientbrand_20');
		Route::post('/getclientbrand_21', 'AjaxController@getclientbrand_21');

		// info box

		Route::post('/getinfobox_1', 'AjaxController@getinfobox_1');
		Route::post('/getinfobox_2', 'AjaxController@getinfobox_2');
		Route::post('/getinfobox_3', 'AjaxController@getinfobox_3');
		Route::post('/getinfobox_4', 'AjaxController@getinfobox_4');
		Route::post('/getinfobox_5', 'AjaxController@getinfobox_5');
		Route::post('/getinfobox_6', 'AjaxController@getinfobox_6');
		Route::post('/getinfobox_7', 'AjaxController@getinfobox_7');
		Route::post('/getinfobox_8', 'AjaxController@getinfobox_8');
		Route::post('/getinfobox_9', 'AjaxController@getinfobox_9');
		Route::post('/getinfobox_10', 'AjaxController@getinfobox_10');
		Route::post('/getinfobox_11', 'AjaxController@getinfobox_11');
		Route::post('/getinfobox_12', 'AjaxController@getinfobox_12');
		Route::post('/getinfobox_13', 'AjaxController@getinfobox_13');
		Route::post('/getinfobox_14', 'AjaxController@getinfobox_14');
		Route::post('/getinfobox_15', 'AjaxController@getinfobox_15');
		Route::post('/getinfobox_16', 'AjaxController@getinfobox_16');
		Route::post('/getinfobox_17', 'AjaxController@getinfobox_17');
		Route::post('/getinfobox_18', 'AjaxController@getinfobox_18');
		Route::post('/getinfobox_19', 'AjaxController@getinfobox_19');
		Route::post('/getinfobox_20', 'AjaxController@getinfobox_20');
		Route::post('/getinfobox_21', 'AjaxController@getinfobox_21');
		Route::post('/getinfobox_22', 'AjaxController@getinfobox_22');

		// carousel

		Route::post('/getcarousel_1', 'AjaxController@getcarousel_1');
		Route::post('/getcarousel_2', 'AjaxController@getcarousel_2');
		Route::post('/getcarousel_3', 'AjaxController@getcarousel_3');
		Route::post('/getcarousel_4', 'AjaxController@getcarousel_4');
		Route::post('/getcarousel_5', 'AjaxController@getcarousel_5');
		Route::post('/getcarousel_40', 'AjaxController@getcarousel_40');

		// parallex banner

		Route::post('/getparallexbanner_one', 'AjaxController@getparallexbanner_one');
		Route::post('/getparallexbanner_two', 'AjaxController@getparallexbanner_two');
		Route::post('/getparallexbanner_three', 'AjaxController@getparallexbanner_three');


		Route::post('/getallproductBytopselling', 'AjaxController@getallproductBytopselling');
		Route::post('/getallproductBytopselling2', 'AjaxController@getallproductBytopselling2');
		Route::post('/getallproductBytopselling3', 'AjaxController@getallproductBytopselling3');
		Route::post('/getallproductBytopselling4', 'AjaxController@getallproductBytopselling4');
		Route::post('/getallproductBytopselling5', 'AjaxController@getallproductBytopselling5');
		Route::post('/getallproductBytopselling6', 'AjaxController@getallproductBytopselling6');
		Route::post('/getallproductBytopselling7', 'AjaxController@getallproductBytopselling7');
		Route::post('/getallproductBytopselling8', 'AjaxController@getallproductBytopselling8');
		Route::post('/getallproductBytopselling9', 'AjaxController@getallproductBytopselling9');
		Route::post('/getallproductBytopselling10', 'AjaxController@getallproductBytopselling10');
		Route::post('/getallproductBytopselling11', 'AjaxController@getallproductBytopselling11');
		Route::post('/getallproductBytopselling12', 'AjaxController@getallproductBytopselling12');
		Route::post('/getallproductBytopselling13', 'AjaxController@getallproductBytopselling13');
		Route::post('/getallproductBytopselling14', 'AjaxController@getallproductBytopselling14');
		Route::post('/getallproductBytopselling15', 'AjaxController@getallproductBytopselling15');
		Route::post('/getallproductBytopselling16', 'AjaxController@getallproductBytopselling16');
		Route::post('/getallproductBytopselling17', 'AjaxController@getallproductBytopselling17');




		Route::post('/getalltabcontent', 'AjaxController@getalltabcontent');
		Route::post('/getalltabcontent2', 'AjaxController@getalltabcontent2');
		Route::post('/getalltabcontent3', 'AjaxController@getalltabcontent3');
		Route::post('/getalltabcontent4', 'AjaxController@getalltabcontent4');
		Route::post('/getalltabcontent5', 'AjaxController@getalltabcontent5');
		Route::post('/getalltabcontent6', 'AjaxController@getalltabcontent6');
		Route::post('/getalltabcontent7', 'AjaxController@getalltabcontent7');
		Route::post('/getalltabcontent8', 'AjaxController@getalltabcontent8');


		Route::post('/getallcollections', 'AjaxController@getallcollections');
		Route::post('/getalltabcontent_mostliked_content', 'AjaxController@getalltabcontent_mostliked_content');
		Route::post('/getalltabcontent_special_content', 'AjaxController@getalltabcontent_special_content');
		Route::post('/getalltabcontent_topseller_content', 'AjaxController@getalltabcontent_topseller_content');
		Route::post('/getalltabcontent_mostliked_content2', 'AjaxController@getalltabcontent_mostliked_content2');
		Route::post('/getalltabcontent_special_content2', 'AjaxController@getalltabcontent_special_content2');
		Route::post('/getalltabcontent_topseller_content2', 'AjaxController@getalltabcontent_topseller_content2');
		Route::post('/getalltabcontent_mostliked_content4', 'AjaxController@getalltabcontent_mostliked_content4');
		Route::post('/getalltabcontent_special_content4', 'AjaxController@getalltabcontent_special_content4');
		Route::post('/getalltabcontent_topseller_content4', 'AjaxController@getalltabcontent_topseller_content4');
		Route::post('/getalltabcontent_mostliked_content5', 'AjaxController@getalltabcontent_mostliked_content5');
		Route::post('/getalltabcontent_special_content5', 'AjaxController@getalltabcontent_special_content5');
		Route::post('/getalltabcontent_topseller_content5', 'AjaxController@getalltabcontent_topseller_content5');
		Route::post('/getalltabcontent_mostliked_content6', 'AjaxController@getalltabcontent_mostliked_content6');
		Route::post('/getalltabcontent_special_content6', 'AjaxController@getalltabcontent_special_content6');
		Route::post('/getalltabcontent_topseller_content6', 'AjaxController@getalltabcontent_topseller_content6');
		Route::post('/getalltabcontent_mostliked_content7', 'AjaxController@getalltabcontent_mostliked_content7');
		Route::post('/getalltabcontent_special_content7', 'AjaxController@getalltabcontent_special_content7');
		Route::post('/getalltabcontent_topseller_content7', 'AjaxController@getalltabcontent_topseller_content7');
		Route::post('/getalltabcontent_mostliked_content8', 'AjaxController@getalltabcontent_mostliked_content8');
		Route::post('/getalltabcontent_special_content8', 'AjaxController@getalltabcontent_special_content8');
		Route::post('/getalltabcontent_topseller_content8', 'AjaxController@getalltabcontent_topseller_content8');

		Route::post('/getallnewsevent', 'AjaxController@getallnewsevent');
		Route::post('/getallnewsevent3', 'AjaxController@getallnewsevent3');
		Route::post('/getallnewsevent4', 'AjaxController@getallnewsevent4');
		Route::post('/getallnewsevent5', 'AjaxController@getallnewsevent5');
		Route::post('/getallnewsevent6', 'AjaxController@getallnewsevent6');
		Route::post('/getallnewsevent7', 'AjaxController@getallnewsevent7');
		Route::post('/getallnewsevent8', 'AjaxController@getallnewsevent8');
		Route::post('/getallnewsevent9', 'AjaxController@getallnewsevent9');
		Route::post('/getallnewsevent10', 'AjaxController@getallnewsevent10');
		Route::post('/getallnewsevent11', 'AjaxController@getallnewsevent11');
		Route::post('/getallnewsevent12', 'AjaxController@getallnewsevent12');
		Route::post('/getallnewsevent13', 'AjaxController@getallnewsevent13');
		Route::post('/getallnewsevent14', 'AjaxController@getallnewsevent14');
		Route::post('/getallnewsevent15', 'AjaxController@getallnewsevent15');
		Route::post('/getallnewsevent16', 'AjaxController@getallnewsevent16');
		Route::post('/getallnewsevent17', 'AjaxController@getallnewsevent17');
		Route::post('/getallnewsevent18', 'AjaxController@getallnewsevent18');
		Route::post('/getallnewsevent19', 'AjaxController@getallnewsevent19');
		Route::post('/getallnewsevent20', 'AjaxController@getallnewsevent20');


		Route::post('/getallproductBynewest', 'AjaxController@getallproductBynewest');
		Route::post('/getallproductBynewest2', 'AjaxController@getallproductBynewest2');
		Route::post('/getallproductBynewest3', 'AjaxController@getallproductBynewest3');
		Route::post('/getallproductBynewest4', 'AjaxController@getallproductBynewest4');
		Route::post('/getallproductBynewest5', 'AjaxController@getallproductBynewest5');
		Route::post('/getallproductBynewest6', 'AjaxController@getallproductBynewest6');
		Route::post('/getallproductBynewest7', 'AjaxController@getallproductBynewest7');
		Route::post('/getallproductBynewest8', 'AjaxController@getallproductBynewest8');
		Route::post('/getallproductBynewest9', 'AjaxController@getallproductBynewest9');
		Route::post('/getallproductBynewest10', 'AjaxController@getallproductBynewest10');
		Route::post('/getallproductBynewest11', 'AjaxController@getallproductBynewest11');
		Route::post('/getallproductBynewest12', 'AjaxController@getallproductBynewest12');
		Route::post('/getallproductBynewest13', 'AjaxController@getallproductBynewest13');
		Route::post('/getallproductBynewest14', 'AjaxController@getallproductBynewest14');
		Route::post('/getallproductBynewest15', 'AjaxController@getallproductBynewest15');
		Route::post('/getallproductBynewest16', 'AjaxController@getallproductBynewest16');
		Route::post('/getallproductBynewest17', 'AjaxController@getallproductBynewest17');
		Route::post('/getallproductBynewest18', 'AjaxController@getallproductBynewest18');
		Route::post('/getallproductBynewest19', 'AjaxController@getallproductBynewest19');
		Route::post('/getallproductBynewest20', 'AjaxController@getallproductBynewest20');
		Route::post('/getallproductBynewest21', 'AjaxController@getallproductBynewest21');
		Route::post('/getallproductBynewest22', 'AjaxController@getallproductBynewest22');
		Route::post('/getallproductBynewest23', 'AjaxController@getallproductBynewest23');
		Route::post('/getallproductBynewest24', 'AjaxController@getallproductBynewest24');
		Route::post('/getallproductBynewest25', 'AjaxController@getallproductBynewest25');




		Route::post('/getallproductByspecial', 'AjaxController@getallproductByspecial');
		Route::post('/getallproductByspecial2', 'AjaxController@getallproductByspecial2');
		Route::post('/getallproductByspecial3', 'AjaxController@getallproductByspecial3');
		Route::post('/getallproductByspecial4', 'AjaxController@getallproductByspecial4');
		Route::post('/getallproductByspecial5', 'AjaxController@getallproductByspecial5');
		Route::post('/getallproductByspecial6', 'AjaxController@getallproductByspecial6');
		Route::post('/getallproductByspecial7', 'AjaxController@getallproductByspecial7');
		Route::post('/getallproductByspecial8', 'AjaxController@getallproductByspecial8');
		Route::post('/getallproductByspecial9', 'AjaxController@getallproductByspecial9');
		Route::post('/getallproductByspecial10', 'AjaxController@getallproductByspecial10');
		Route::post('/getallproductByspecial11', 'AjaxController@getallproductByspecial11');
		Route::post('/getallproductByspecial12', 'AjaxController@getallproductByspecial12');
		Route::post('/getallproductByspecial13', 'AjaxController@getallproductByspecial13');
		Route::post('/getallproductByspecial14', 'AjaxController@getallproductByspecial14');
		Route::post('/getallproductByspecial15', 'AjaxController@getallproductByspecial15');


		Route::post('/getwhychooseus_1', 'AjaxController@getwhychooseus_1');
		Route::post('/getwhychooseus_2', 'AjaxController@getwhychooseus_2');



		Route::post('/updateMyEmail', 'CustomersController@updateMyEmail')->middleware('Customer');
		Route::get('/noEmailCheckout', 'CustomersController@noEmailCheckout')->middleware('Customer');
		Route::get('/wallet', 'CustomersController@wallet')->middleware('Customer');
		//ipay88 wallet
		Route::get('/wallet/ipaycheckout', 'WalletController@ipayCheckout')->middleware('Customer');
		Route::get('/wallet/ipayappcheckout/{id}', 'WalletController@ipayappcheckout');
		Route::post('/wallet/ipaywalletresponse', 'WalletController@ipaywalletResponse');
		Route::post('/wallet/ipayappwalletresponse', 'WalletController@ipayappwalletresponse');
		Route::post('/walletBank', 'WalletController@walletBank')->middleware('Customer');
		Route::post('/walletBanktransfer', 'WalletController@walletBanktransfer')->middleware('Customer');
		Route::post('/paymentComponentWallet', 'OrdersController@paymentComponentWallet')->middleware('Customer');
		Route::get('/wallet_thankyou', 'OrdersController@wallet_thankyou')->middleware('Customer');

	

		Route::get('/edit_profile', 'CustomersController@editProfile')->middleware('Customer');
		Route::get('/phone_ver', 'CustomersController@phoneVer')->middleware('Customer');
		Route::get('/phone_ver_success', 'CustomersController@phoneVerSuccess')->middleware('Customer');
		Route::post('/profile_update_phoneotp', 'CustomersController@profile_update_phoneotp')->middleware('Customer');
		Route::get('profile_otp_verification/{id}', 'CustomersController@profile_otp_verification')->middleware('Customer');
		Route::get('profile_resendotp_verification/{id}/{phone}', 'CustomersController@profile_resendotp_verification');
		Route::post('update_otp_profile', 'CustomersController@update_otp_profile');
		Route::post('ck_otp_isvalid', 'CustomersController@ck_otp_isvalid');

		Route::get('/add_shipping', 'ShippingAddressController@addShipping')->middleware('Customer');
		Route::get('/edit_shipping', 'ShippingAddressController@editShipping')->middleware('Customer');

		Route::get('/pending_orders', 'OrdersController@pendingOrders')->middleware('Customer');
		Route::get('/complete_orders', 'OrdersController@completeOrders')->middleware('Customer');

		Route::get('/wallet_send', 'CustomersController@walletSend')->middleware('Customer');


		Route::post('/appointment', 'AppointmentController@appointment');
		Route::get('/view_appointment', 'AppointmentController@viewAppointment');
		Route::get('/view_appointment_detail/{id}', 'AppointmentController@viewAppointmentDetail');
		Route::get('/appointment_ajax', 'AppointmentController@appointmentAjax');
		Route::get('/appointment_ajax_date', 'AppointmentController@appointmentAjaxDate');
		Route::get('/appointment_invoice_print/{id}', 'AppointmentController@appointmentInvoicePrint');
		Route::post('/appointment_updatestatus', 'AppointmentController@appointmentUpdateStatus');
		Route::get('/pending_appointment', 'AppointmentController@pendingAppointment')->middleware('Customer');
		Route::get('/completed_appointment', 'AppointmentController@completedAppointment')->middleware('Customer');
		Route::get('/appointment_filter', 'AppointmentController@appointmentFilter');
		Route::get('/pending_appointment_filter', 'AppointmentController@pendingAppointmentFilter');
		Route::get('/completed_appointment_filter', 'AppointmentController@completedAppointmentFilter');
		Route::get('/appointment_export', 'AppointmentController@appointmentExport');
		Route::get('/appointment_pdf', 'AppointmentController@appointmentPDF');
		
		Route::get('/appointment_staffs', 'AppointmentController@appointmentStaffs');
		Route::get('/appointment_services', 'AppointmentController@appointmentServices');
		Route::get('/appointment_ajaxDate_by_outletID', 'AppointmentController@appointmentAjaxDateByOutletID');

		Route::get('/lpoint', 'CustomersController@lPoint');
		Route::get('/epoint', 'CustomersController@ePoint');
		Route::get('/gpoint', 'CustomersController@gPoint')->middleware('Customer');
		Route::get('/accpoint', 'CustomersController@accPoint')->middleware('Customer');
		Route::get('/helppoint', 'CustomersController@helpPoint');

		Route::post('/filter24', 'ThemeController@filter24');
		Route::get('/order_export', 'OrdersController@orderExport')->middleware('Customer');
		Route::get('/order_pdf', 'OrdersController@orderPDF')->middleware('Customer');
		Route::get('/callback', 'OrdersController@callback');

		// table order
		Route::get('/ordershop', 'ProductsController@ordershop')->middleware('qrcode_expired');
		Route::get('/orderviewcart', 'CartController@orderviewcart')->middleware('qrcode_expired');
		Route::post('/addtableorder', 'TableController@addtableorder');
		Route::get('/tablethankyou', 'TableController@tablethankyou');
		Route::get('/orderhistory', 'TableController@orderHistory')->middleware('qrcode_expired');
		Route::get('/web-product-detail/{slug}', 'ProductsController@webProductDetail')->middleware('qrcode_expired');
		Route::get('/webthankyou', 'TableController@webthankyou');
   
		Route::post('/tablepay', 'TableController@tablepay')->middleware('qrcode_expired');
		Route::get('/tableipay', 'TableController@tableipay')->middleware('qrcode_expired');
		Route::post('/tableipayresponse', 'TableController@tableipayresponse');
		Route::get('/qrcodeexpired', 'TableController@qrcodeexpired');
		Route::get('/qrcodetable', 'TableController@qrcodetable')->middleware('qrcode_expired');
		Route::get('/qrcodeorder', 'TableController@qrcodeorder')->middleware('qrcode_expired');
		Route::get('/qrcodedetail/{slug}', 'TableController@qrcodedetail');
		Route::get('/edit_qrcodedetail/{slug}', 'TableController@editqrcodedetail');
		Route::get('/qrcodecart', 'TableController@qrcodecart');
		Route::get('/orderconfirmation', 'TableController@orderconfirmation');
		Route::post('/deleteAll', 'TableController@DeleteAll')->middleware('qrcode_expired');
		Route::post('/deleteByID', 'TableController@DeleteByID')->middleware('qrcode_expired');
		Route::post('/plusMinus', 'TableController@plusMinus')->middleware('qrcode_expired');

		Route::get('/table_login', 'TableController@tableLogin');
		Route::get('/table_login_otp/{id}', 'TableController@tableLoginOtp');
		Route::get('/table_resendotp/{id}', 'TableController@table_resendotp');
		Route::post('/table_login_process', 'TableController@table_login_process');
		Route::post('table_ck_otp_isvalid', 'TableController@table_ck_otp_isvalid');
		Route::post('table_update_otp_profile', 'TableController@table_update_otp_profile');

		
		Route::get('/merchant/{id}', 'TableController@merchantlogin');
		Route::get('/guest_merchant', 'TableController@guestMerchant');
		
		Route::post('/process-login_table', 'TableController@processLoginTable');
		Route::post('/addtocarttable', 'CartController@addToCarttable')->middleware('qrcode_expired');
		Route::post('/edittocarttable', 'TableController@edittocarttable')->middleware('qrcode_expired');
		Route::post('/placeatcounter', 'TableController@placeatcounter')->middleware('qrcode_expired');
		Route::post('/paymentcurrencychecktable', 'TableController@paymentcurrencychecktable');

		Route::get('/qrcodelogintable', 'TableController@qrcodelogintable')->middleware('qrcode_expired');
		Route::get('/qrcodeprofile', 'TableController@qrcodeprofile')->middleware('qrcode_expired');

		Route::get('/qrcodelogout', 'TableController@qrcodelogout');

		//paytm
		Route::get('/qrcode_paytm', 'PaytmController@qrcodePaytm');
		Route::post('/qrcode-callback', 'TableController@paytmQrcodeCallback');

		

		//senangpay
		Route::get('/senangpay/table_requests/{id}', 'TableController@senangpayRequests')->middleware('qrcode_expired');
		Route::get('/senangpay/table_response', 'TableController@senangpayResponse');
		Route::post('/senangpay/table_serverresponse', 'TableController@senangpayServerResponse');

		//stipe
		Route::post('/stripe_table_payment', 'TableController@stripeResponse')->middleware('qrcode_expired');

		//banktranfer
		Route::post('/banktransfer_table_payment', 'TableController@banktranferResponse')->middleware('qrcode_expired');

		//wallet
		Route::get('/wallet_table_response', 'TableController@walletResponse')->middleware('qrcode_expired');


	});



	