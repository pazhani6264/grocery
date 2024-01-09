<?php
header('Content-Type: text/html; charset=utf-8');
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // $exitCode = Artisan::call('config:cache');
});


Route::get('/phpinfo', function () {
    phpinfo();
});
 Route::group(['namespace' => 'AdminControllers', 'prefix' => 'admin'], function () {
    Route::get('/newsNotificationCron', 'AlertController@newsNotificationCron');
}); 


/* Route::get('/newsNotificationCron', 'AdminControllers/AlertController@newsNotificationCron'); */

Route::group(['middleware' => ['installer']], function () {
    Route::get('/not_allowed', function () {
        return view('errors.not_found');
    });
    Route::group(['namespace' => 'AdminControllers', 'prefix' => 'admin'], function () {
        Route::get('/login', 'AdminController@login');
        Route::get('/forgot', 'AdminController@forgot');
        Route::post('/checkforgot', 'AdminController@checkforgot');
        Route::post('/checkLogin', 'AdminController@checkLogin');
        Route::get('/newsNotificationCron', 'AlertController@newsNotificationCron');
    });

    Route::get('/home', function () {
        return redirect('/admin/languages/display');
    });
    Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('ckeditor.upload');
    Route::group(['namespace' => 'AdminControllers', 'middleware' => 'auth', 'prefix' => 'admin'], function () {
        Route::post('webPagesSettings/changestatus', 'ThemeController@changestatus');
        Route::post('webPagesSettings/setting/set', 'ThemeController@set');
        Route::post('webPagesSettings/reorder', 'ThemeController@reorder');

        Route::post('webPagesSettings/specialContent', 'ThemeController@specialContent');
        Route::post('webPagesSettings/trendingContent', 'ThemeController@trendingContent');
        Route::post('webPagesSettings/topContent', 'ThemeController@topContent');
        Route::post('webPagesSettings/newContent', 'ThemeController@newContent');


        Route::get('/home', function () {
            return redirect('/dashboard/{reportBase}');
        });
        Route::get('/generateKey', 'SiteSettingController@generateKey');

        //log out
        Route::get('/logout', 'AdminController@logout');
        Route::get('/webPagesSettings/{id}', 'ThemeController@index2');
      

        Route::get('/topoffer/display', 'ThemeController@topoffer');
        Route::post('/topoffer/update', 'ThemeController@updateTopOffer');

        Route::get('/subscribe_modal/display', 'ThemeController@subscribeModal');
        Route::post('/subscribeModal/update', 'ThemeController@updatesubscribeModal');
        

        Route::get('/dashboard/{reportBase}', 'AdminController@dashboard');
        
        //add adddresses against customers
        Route::get('/addaddress/{id}/', 'CustomersController@addaddress')->middleware('add_customer');
        Route::post('/addNewCustomerAddress', 'CustomersController@addNewCustomerAddress')->middleware('add_customer');
        Route::post('/editAddress', 'CustomersController@editAddress')->middleware('edit_customer');
        Route::post('/updateAddress', 'CustomersController@updateAddress')->middleware('edit_customer');
        Route::post('/deleteAddress', 'CustomersController@deleteAddress')->middleware('delete_customer');
        Route::post('/getZones', 'AddressController@getzones');

        //sliders
        Route::get('/sliders', 'AdminSlidersController@sliders')->middleware('website_routes');
        Route::get('/addsliderimage', 'AdminSlidersController@addsliderimage')->middleware('website_routes');
        Route::post('/addNewSlide', 'AdminSlidersController@addNewSlide')->middleware('website_routes');
        Route::get('/editslide/{id}', 'AdminSlidersController@editslide')->middleware('website_routes');
        Route::post('/updateSlide', 'AdminSlidersController@updateSlide')->middleware('website_routes');
        Route::post('/deleteSlider/', 'AdminSlidersController@deleteSlider')->middleware('website_routes');



        //constant banners
        Route::get('/constantbanners', 'AdminConstantController@constantBanners')->middleware('website_routes');
        Route::get('/addconstantbanner', 'AdminConstantController@addconstantBanner')->middleware('website_routes');
        Route::post('/addNewConstantBanner', 'AdminConstantController@addNewconstantBanner')->middleware('website_routes');
        Route::get('/editconstantbanner/{id}', 'AdminConstantController@editconstantbanner')->middleware('website_routes');
        Route::post('/updateconstantBanner', 'AdminConstantController@updateconstantBanner')->middleware('website_routes');
        Route::post('/deleteconstantBanner/', 'AdminConstantController@deleteconstantBanner')->middleware('website_routes');

        //banner two
        Route::get('/constantbannerstwo', 'AdminConstantController@constantBannerstwo')->middleware('website_routes');
        Route::get('/addconstantbannertwo', 'AdminConstantController@addconstantBannertwo')->middleware('website_routes');
        Route::post('/addNewConstantBannertwo', 'AdminConstantController@addNewconstantBannertwo')->middleware('website_routes');
        Route::get('/editconstantbannertwo/{id}', 'AdminConstantController@editconstantbannertwo')->middleware('website_routes');
        Route::post('/updateconstantBannertwo', 'AdminConstantController@updateconstantBannertwo')->middleware('website_routes');
        Route::post('/deleteconstantBannertwo/', 'AdminConstantController@deleteconstantBannertwo')->middleware('website_routes');

        //banner three
        Route::get('/constantbannersthree', 'AdminConstantController@constantBannersthree')->middleware('website_routes');
        Route::get('/addconstantbannerthree', 'AdminConstantController@addconstantBannerthree')->middleware('website_routes');
        Route::post('/addNewConstantBannerthree', 'AdminConstantController@addNewconstantBannerthree')->middleware('website_routes');
        Route::get('/editconstantbannerthree/{id}', 'AdminConstantController@editconstantbannerthree')->middleware('website_routes');
        Route::post('/updateconstantBannerthree', 'AdminConstantController@updateconstantBannerthree')->middleware('website_routes');
        Route::post('/deleteconstantBannerthree/', 'AdminConstantController@deleteconstantBannerthree')->middleware('website_routes');

         //banner Four
         Route::get('/constantbannersfour', 'AdminConstantController@constantBannersfour')->middleware('website_routes');
         Route::get('/addconstantbannerfour', 'AdminConstantController@addconstantBannerfour')->middleware('website_routes');
         Route::post('/addNewConstantBannerfour', 'AdminConstantController@addNewconstantBannerfour')->middleware('website_routes');
         Route::get('/editconstantbannerfour/{id}', 'AdminConstantController@editconstantbannerfour')->middleware('website_routes');
         Route::post('/updateconstantBannerfour', 'AdminConstantController@updateconstantBannerfour')->middleware('website_routes');
         Route::post('/deleteconstantBannerfour/', 'AdminConstantController@deleteconstantBannerfour')->middleware('website_routes');
    });

     

     Route::group(['prefix' => 'admin/clientbrand', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        //sliders
     Route::get('/display', 'ClientbrandController@display')->middleware('view_language');
     Route::get('/add', 'ClientbrandController@add')->middleware('add_language');
     Route::post('/insert', 'ClientbrandController@insert')->middleware('add_language');
     Route::get('/edit/{id}', 'ClientbrandController@edit')->middleware('edit_language');
     Route::post('/update', 'ClientbrandController@update')->middleware('edit_language');
     Route::post('/delete', 'ClientbrandController@delete')->middleware('delete_language');
     Route::get('/filter', 'ClientbrandController@filter')->middleware('view_language');

    });

    Route::group(['prefix' => 'admin/languages', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'LanguageController@display')->middleware('view_language');
        Route::post('/default', 'LanguageController@default')->middleware('edit_language');
        Route::get('/add', 'LanguageController@add')->middleware('add_language');
        Route::post('/add', 'LanguageController@insert')->middleware('add_language');
        Route::get('/edit/{id}', 'LanguageController@edit')->middleware('edit_language');
        Route::post('/update', 'LanguageController@update')->middleware('edit_language');
        Route::post('/delete', 'LanguageController@delete')->middleware('delete_language');
        Route::get('/filter', 'LanguageController@filter')->middleware('view_language');

    });

    Route::group(['prefix' => 'admin/media', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'MediaController@display')->middleware('view_media');
        Route::get('/add', 'MediaController@add')->middleware('view_media');
        Route::post('/updatemediasetting', 'MediaController@updatemediasetting')->middleware('edit_media');
        Route::post('/uploadimage', 'MediaController@fileUpload')->middleware('add_media');
        Route::post('/delete', 'MediaController@deleteimage')->middleware('delete_media');
        Route::get('/detail/{id}', 'MediaController@detailimage')->middleware('view_media');
        Route::get('/refresh', 'MediaController@refresh');
        Route::post('/regenerateimage', 'MediaController@regenerateimage')->middleware('add_media');
    });

    Route::group(['prefix' => 'admin/theme', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/setting', 'ThemeController@index');
        Route::get('/setting/{id}', 'ThemeController@moveToBanners');
        Route::get('/setting/carousals/{id}', 'ThemeController@moveToSliders');
        Route::post('setting/set', 'ThemeController@set');
        Route::post('setting/setPages', 'ThemeController@setPages');
        Route::post('/setting/updatebanner', 'ThemeController@updatebanner');
        Route::post('/setting/carousals/updateslider', 'ThemeController@updateslider');
        Route::post('/setting/addbanner', 'ThemeController@addbanner');
        Route::post('/reorder', 'ThemeController@reorder');
        Route::post('/setting/changestatus', 'ThemeController@changestatus');
        Route::post('/setting/fetchlanguages', 'LanguageController@fetchlanguages')->middleware('view_language');

        Route::get('/htmltemplate1', 'ThemeController@htmltemplate1');
        Route::get('/htmltemplate2', 'ThemeController@htmltemplate2');
        Route::get('/htmltemplate3', 'ThemeController@htmltemplate3');
        Route::get('/htmltemplate4', 'ThemeController@htmltemplate4');
        Route::post('/htmltemplate1_action', 'ThemeController@htmltemplate1Action');
        Route::post('/htmltemplate2_action', 'ThemeController@htmltemplate2Action');
        Route::post('/htmltemplate3_action', 'ThemeController@htmltemplate3Action');
        Route::post('/htmltemplate4_action', 'ThemeController@htmltemplate4Action');
    });

    Route::group(['prefix' => 'admin/manufacturers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ManufacturerController@display')->middleware('view_manufacturer');
        Route::get('/add', 'ManufacturerController@add')->middleware('add_manufacturer');
        Route::post('/add', 'ManufacturerController@insert')->middleware('add_manufacturer');
        Route::get('/edit/{id}', 'ManufacturerController@edit')->middleware('edit_manufacturer');
        Route::post('/update', 'ManufacturerController@update')->middleware('edit_manufacturer');
        Route::post('/delete', 'ManufacturerController@delete')->middleware('delete_manufacturer');
        Route::get('/filter', 'ManufacturerController@filter')->middleware('view_manufacturer');
    });

    Route::group(['prefix' => 'admin/newscategories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NewsCategoriesController@display')->middleware('view_news');
        Route::get('/add', 'NewsCategoriesController@add')->middleware('add_news');
        Route::post('/add', 'NewsCategoriesController@insert')->middleware('add_news');
        Route::get('/edit/{id}', 'NewsCategoriesController@edit')->middleware('edit_news');
        Route::post('/update', 'NewsCategoriesController@update')->middleware('edit_news');
        Route::post('/delete', 'NewsCategoriesController@delete')->middleware('delete_news');
        Route::get('/filter', 'NewsCategoriesController@filter')->middleware('view_news');
    });

    Route::group(['prefix' => 'admin/news', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NewsController@display')->middleware('view_news');
        Route::get('/add', 'NewsController@add')->middleware('add_news');
        Route::post('/add', 'NewsController@insert')->middleware('add_news');
        Route::get('/edit/{id}', 'NewsController@edit')->middleware('edit_news');
        Route::post('/update', 'NewsController@update')->middleware('edit_news');
        Route::post('/delete', 'NewsController@delete')->middleware('delete_news');
        Route::get('/filter', 'NewsController@filter')->middleware('view_news');
    });

    Route::group(['prefix' => 'admin/loyalty', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
    Route::get('/earn_points_view', 'LoyaltyController@earn_points_view')->middleware('view_loyalty');
    Route::get('/add_earn_points', 'LoyaltyController@add_earn_points')->middleware('add_loyalty');
    Route::post('/add_earn_points_action', 'LoyaltyController@add_earn_points_action')->middleware('add_loyalty');
    Route::get('/edit_earn_points/{id}', 'LoyaltyController@edit_earn_points')->middleware('edit_loyalty');
    Route::post('/update_earn_points', 'LoyaltyController@update_earn_points')->middleware('edit_loyalty');
    Route::get('/filter', 'LoyaltyController@filter')->middleware('view_loyalty');


    Route::get('/redeem_points_view', 'LoyaltyController@redeem_points_view')->middleware('view_loyalty');
    Route::get('/redeem_earn_points', 'LoyaltyController@redeem_earn_points')->middleware('add_loyalty');
    Route::post('/add_redeem_points_action', 'LoyaltyController@add_redeem_points_action')->middleware('add_loyalty');
    Route::get('/edit_redeem_points/{id}', 'LoyaltyController@edit_redeem_points')->middleware('edit_loyalty');
    Route::post('/update_redeem_points', 'LoyaltyController@update_redeem_points')->middleware('edit_loyalty');
    Route::get('/redeem_filter', 'LoyaltyController@redeem_filter')->middleware('view_loyalty');
    Route::post('/redeem_delete', 'LoyaltyController@redeem_delete')->middleware('delete_loyalty');

    Route::get('/view_member_type', 'LoyaltyController@view_member_type')->middleware('view_loyalty');
    Route::get('/add_member_type', 'LoyaltyController@add_member_type')->middleware('add_loyalty');
    Route::post('/add_member_type_action', 'LoyaltyController@add_member_type_action')->middleware('add_loyalty');
    Route::get('/edit_member_type/{id}', 'LoyaltyController@edit_member_type')->middleware('edit_loyalty');
     Route::post('/edit_member_type_action', 'LoyaltyController@edit_member_type_action')->middleware('edit_loyalty');
     Route::post('/delete_member_type', 'LoyaltyController@delete_member_type')->middleware('delete_loyalty');
     });

     Route::group(['prefix' => 'admin/collection', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/view', 'CollectionController@view')->middleware('view_collection');
        Route::get('/add', 'CollectionController@add')->middleware('add_collection');;
        Route::post('/add_action', 'CollectionController@insert')->middleware('add_collection');;
        Route::get('/edit/{id}', 'CollectionController@edit')->middleware('edit_collection');;
        Route::post('/update', 'CollectionController@update')->middleware('edit_collection');;
        Route::post('/delete', 'CollectionController@delete')->middleware('delete_collection');;
        Route::get('/filter', 'CollectionController@filter')->middleware('view_collection');;
        Route::get('/product', 'CollectionController@product')->middleware('add_collection');;
        Route::post('/getproduct', 'CollectionController@getproduct')->middleware('add_collection');;
        Route::post('/add_product', 'CollectionController@add_product')->middleware('add_collection');;
        Route::get('/view_product/{id}', 'CollectionController@view_product')->middleware('view_collection');;
        Route::get('/product_edit/{id}', 'CollectionController@product_edit')->middleware('edit_collection');;
        Route::post('/update_product', 'CollectionController@update_product')->middleware('edit_collection');;
        Route::post('/delete_product', 'CollectionController@delete_product')->middleware('delete_collection');;

     });

     Route::group(['prefix' => 'admin/ticket', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/product', 'TicketController@view_product')->middleware('view_ticket');
        Route::get('/add_product', 'TicketController@add_product')->middleware('add_ticket');
        Route::post('/add_product_action', 'TicketController@add_product_action')->middleware('add_ticket');
        Route::get('/edit_product/{id}', 'TicketController@edit_product')->middleware('edit_ticket');
        Route::post('/edit_product_action', 'TicketController@edit_product_action')->middleware('edit_ticket');
        Route::post('/delete_product', 'TicketController@delete_product')->middleware('delete_ticket');
        Route::get('/view/{id}', 'TicketController@view')->middleware('view_ticket');
        Route::get('/view_ticket/{id}', 'TicketController@ticketDetails')->middleware('view_ticket');
        Route::post('/store', 'TicketController@store')->middleware('add_ticket');
        Route::post('/update', 'TicketController@update')->middleware('edit_ticket');

    });


    Route::group(['prefix' => 'admin/support', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/tickets', 'SupportController@tickets');
        Route::get('/view_tickets', 'SupportController@view_tickets');
        Route::get('/search', 'SupportController@search');
        Route::get('/ticket/{id}', 'SupportController@ViewTicketData');
        Route::post('/ticket/store', 'SupportController@AddTicketData');
        Route::post('/ticket/update', 'SupportController@UpdateTicketData');
        Route::get('/open-ticket', 'SupportController@openTicket');
        Route::post('/insert-ticket', 'SupportController@InsertTicket');
        Route::get('/notifications', 'SupportController@Notifications');
    });

     Route::group(['prefix' => 'admin/shoppinginfo', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/view', 'ShoppinginfoController@view')->middleware('view_shoppinginfo');;
        Route::get('/add', 'ShoppinginfoController@add')->middleware('add_shoppinginfo');;
        Route::post('/add_action', 'ShoppinginfoController@insert')->middleware('add_shoppinginfo');;
        Route::get('/edit/{id}', 'ShoppinginfoController@edit')->middleware('edit_shoppinginfo');;
        Route::post('/update', 'ShoppinginfoController@update')->middleware('edit_shoppinginfo');;
        Route::post('/delete', 'ShoppinginfoController@delete')->middleware('delete_shoppinginfo');;
        Route::get('/filter', 'ShoppinginfoController@filter')->middleware('view_shoppinginfo');;
    });


    Route::group(['prefix' => 'admin/categories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CategoriesController@display')->middleware('view_categories');;
        Route::get('/add', 'CategoriesController@add')->middleware('add_categories');;
        Route::post('/add', 'CategoriesController@insert')->middleware('add_categories');;
        Route::post('/edit/{id}', 'CategoriesController@edit')->middleware('edit_categories');;
        Route::post('/update', 'CategoriesController@update')->middleware('edit_categories');;
        Route::post('/delete', 'CategoriesController@delete')->middleware('delete_categories');;
        Route::get('/filter', 'CategoriesController@filter')->middleware('view_categories');;
        Route::post('/delete_multiple', 'CategoriesController@deleteMultiple')->middleware('delete_categories');;
        Route::post('/status_multiple', 'CategoriesController@statusMultiple')->middleware('view_categories');;
        Route::post('/clone_category', 'CategoriesController@cloneCategory')->middleware('view_categories');;
        Route::get('/sorting', 'CategoriesController@sorting')->middleware('view_categories');;
        Route::post('/updateorder', 'CategoriesController@updateorder')->middleware('view_categories');;
        Route::get('/subcategory/sorting/{id}', 'CategoriesController@subcategorySorting')->middleware('view_categories');;
        Route::post('/updateordersubcat', 'CategoriesController@updateordersubcat')->middleware('view_categories');;
        
    });

    Route::group(['prefix' => 'admin/newsletter', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/view', 'NewsletterController@view')->middleware('view_newsletter');
        Route::get('/add', 'NewsletterController@add')->middleware('add_newsletter');;
        Route::post('/add_action', 'NewsletterController@insert')->middleware('add_newsletter');;
        Route::post('/delete', 'NewsletterController@delete')->middleware('delete_newsletter');;
        Route::get('/filter', 'NewsletterController@filter')->middleware('view_newsletter');;
        Route::get('/detail/{id}', 'NewsletterController@details')->middleware('view_newsletter');
     });

    Route::group(['prefix' => 'admin/currencies', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CurrencyController@display')->middleware('view_general_setting');
        Route::get('/add', 'CurrencyController@add')->middleware('edit_general_setting');
        Route::post('/add', 'CurrencyController@insert')->middleware('edit_general_setting');
        Route::get('/edit/{id}', 'CurrencyController@edit')->middleware('edit_general_setting');
        Route::get('/edit/warning/{id}', 'CurrencyController@warningedit')->middleware('edit_general_setting');
        Route::post('/update', 'CurrencyController@update')->middleware('edit_general_setting');
        Route::post('/delete', 'CurrencyController@delete')->middleware('edit_general_setting');

        
    });
	
	Route::group(['prefix' => 'admin/inventory', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/stockmovement', 'InventoryController@stockMovement')->middleware('stock_movement_view'); 
        Route::get('/scanview/{id}', 'InventoryController@scanView')->middleware('stock_movement_view');
        Route::get('/stockmovementdetails/{id}', 'InventoryController@stockmovementdetails')->middleware('stock_movement_view');
        Route::get('/stockinview', 'InventoryController@stockinView')->middleware('stockin_view');
        Route::get('/stockin', 'InventoryController@stockinAdd')->middleware('stockin_add');
        Route::get('/ajax_attr_inven/{id}/', 'InventoryController@ajax_attr_inven')->middleware('stockin_add');
        Route::get('/get_product/{id}/', 'InventoryController@get_product')->middleware('stockin_add');
        Route::post('/stockininsert', 'InventoryController@stockinInsert')->middleware('stockin_add');
        Route::get('/stockinoutdetails/{id}/{type}', 'InventoryController@stockinoutdetails')->middleware('stockin_add');
        Route::get('/stockoutview', 'InventoryController@stockoutView')->middleware('stockout_view');
        Route::get('/stockout', 'InventoryController@stockoutAdd')->middleware('stockout_add');
        Route::get('/getcurrentstockarr/{id}/{type}', 'InventoryController@getcurrentstockarr')->middleware('stockout_add');
        Route::get('/adjuststock', 'InventoryController@adjustStock')->middleware('adjuststock_view');
        Route::get('/addadjuststock', 'InventoryController@addAdjustStock')->middleware('adjuststock_add');
        Route::post('/adjuststockinsert', 'InventoryController@adjustStockInsert')->middleware('adjuststock_add');
        Route::get('/vendor', 'InventoryController@viewVendor')->middleware('vendor_view');
        Route::get('/addvendor', 'InventoryController@addVendor')->middleware('vendor_add');
        Route::post('/vendorinsert', 'InventoryController@vendorInsert')->middleware('vendor_add');
        Route::get('/editvendor/{id}', 'InventoryController@vendorEdit')->middleware('vendor_edit');
        Route::post('/vendorupdate', 'InventoryController@vendorupdate')->middleware('vendor_edit');
        Route::post('/deleteVendor', 'InventoryController@deleteVendor')->middleware('vendor_delete');
    });

    Route::group(['prefix' => 'admin/products', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductController@display')->middleware('view_product');
        Route::post('/successMsg', 'ProductController@successMsg')->middleware('view_product');
        Route::get('/add', 'ProductController@add')->middleware('add_product');
        Route::post('/add', 'ProductController@insert')->middleware('add_product');
        Route::post('/edit/{id}', 'ProductController@edit')->middleware('edit_product');
        Route::post('/update', 'ProductController@update')->middleware('edit_product');
        Route::post('/delete', 'ProductController@delete')->middleware('delete_product');
        Route::get('/filter', 'ProductController@filter')->middleware('view_product');
        Route::post('/import', 'ProductController@import')->middleware('add_product');
        Route::get('/category_list', 'ProductController@categoryList')->middleware('view_product');;
        Route::get('/sorting/{id}', 'ProductController@productSorting')->middleware('view_product');;
        Route::post('/updateorderproduct', 'ProductController@updateorderProduct')->middleware('view_product');;
        
        Route::post('/ajax_product', 'ProductController@ajaxProduct')->middleware('view_product');
        Route::post('/ajax_attribute', 'ProductController@ajaxAttribute')->middleware('view_product');
        Route::post('/ajax_attribute_value', 'ProductController@ajaxAttributeValue')->middleware('view_product');
        Route::post('/delete_multiple', 'ProductController@deleteMultiple')->middleware('delete_product');
        Route::post('/status_multiple', 'ProductController@statusMultiple')->middleware('view_product');;
        Route::post('/clone_product', 'ProductController@cloneProduct')->middleware('view_product');;

        Route::post('/admin_modal_show', 'ProductController@AdminModalShow');
        Route::post('/admin_combo-delete', 'ProductController@AdmincomboDelete');


        Route::group(['prefix' => 'inventory'], function () {
            Route::get('/display', 'ProductController@addinventoryfromsidebar')->middleware('view_product');
            // Route::post('/addnewstock', 'ProductController@addinventory')->middleware('view_product');
            Route::get('/ajax_min_max/{id}/', 'ProductController@ajax_min_max')->middleware('view_product');
            Route::get('/ajax_attr/{id}/', 'ProductController@ajax_attr')->middleware('view_product');
            Route::post('/addnewstock', 'ProductController@addnewstock')->middleware('add_product');
            Route::post('/addnewstocknew', 'ProductController@addnewstocknew')->middleware('add_product');
            Route::post('/addminmax', 'ProductController@addminmax')->middleware('add_product');
            Route::get('/addproductimages/{id}/', 'ProductController@addproductimages')->middleware('add_product');

        });
        Route::group(['prefix' => 'images'], function () {
            Route::get('/display/{id}/', 'ProductController@displayProductImages')->middleware('view_product');
            Route::get('/add/{id}/', 'ProductController@addProductImages')->middleware('add_product');
            Route::post('/insertproductimage', 'ProductController@insertProductImages')->middleware('add_product');
            
            Route::get('/editproductimage/{id}', 'ProductController@editProductImages')->middleware('edit_product');
            Route::post('/updateproductimage', 'ProductController@updateproductimage')->middleware('edit_product');
            Route::post('/deleteproductimagemodal', 'ProductController@deleteproductimagemodal')->middleware('view_product');
            Route::post('/deleteproductimage', 'ProductController@deleteproductimage')->middleware('delete_product');
             Route::post('/changeorder', 'ProductController@changeOrder')->middleware('edit_product');

        });

        Route::group(['prefix' => 'videos'], function () {
            Route::get('/display/{id}/', 'ProductController@displayProductVideos')->middleware('view_product');
            Route::get('/add/{id}/', 'ProductController@addProductVideos')->middleware('add_product');
            Route::post('/insertproductvideo', 'ProductController@insertProductVideos')->middleware('add_product');
            
            Route::get('/editproductvideo/{id}', 'ProductController@editProductVideos')->middleware('edit_product');
            Route::post('/updateproductvideo', 'ProductController@updateproductVideos')->middleware('edit_product');
            Route::post('/deleteproductvideorecord', 'ProductController@deleteproductvideorecord')->middleware('edit_product');
            Route::post('/deleteproductvideo', 'ProductController@deleteproductvideo')->middleware('delete_product');
             Route::post('/changeorder', 'ProductController@changeOrder')->middleware('edit_product');

        });
        Route::group(['prefix' => 'attach/attribute'], function () {
            Route::get('/display/{id}', 'ProductController@addproductattribute')->middleware('view_product');
            Route::group(['prefix' => '/default'], function () {
                Route::post('/', 'ProductController@addnewdefaultattribute')->middleware('view_product');
                Route::post('/edit', 'ProductController@editdefaultattribute')->middleware('edit_product');
                Route::post('/update', 'ProductController@updatedefaultattribute')->middleware('edit_product');
                Route::post('/deletedefaultattributemodal', 'ProductController@deletedefaultattributemodal')->middleware('view_product');
                Route::post('/delete', 'ProductController@deletedefaultattribute')->middleware('delete_product');
                Route::group(['prefix' => '/options'], function () {
                    Route::post('/add', 'ProductController@showoptions')->middleware('view_product');
                    Route::post('/edit', 'ProductController@editoptionform')->middleware('edit_product');
                    Route::post('/update', 'ProductController@updateoption')->middleware('edit_product');
                    Route::post('/showdeletemodal', 'ProductController@showdeletemodal')->middleware('edit_product');
                    Route::post('/delete', 'ProductController@deleteoption')->middleware('delete_product');
                    Route::post('/getOptionsValue', 'ProductController@getOptionsValue')->middleware('edit_product');
                    Route::post('/currentstock', 'ProductController@currentstock')->middleware('view_product');
                    Route::post('/currentstock_new', 'ProductController@currentstock_new')->middleware('view_product');
                });

            });

        });

    });

    Route::group(['prefix' => 'admin/products/attributes', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductAttributesController@display')->middleware('view_product');
        Route::get('/add', 'ProductAttributesController@add')->middleware('add_product');
        Route::post('/insert', 'ProductAttributesController@insert')->middleware('add_product');
        Route::get('/edit/{id}', 'ProductAttributesController@edit')->middleware('edit_product');
        Route::post('/update', 'ProductAttributesController@update')->middleware('edit_product');
        Route::post('/delete', 'ProductAttributesController@delete')->middleware('delete_product');

        Route::group(['prefix' => 'options/values'], function () {
            Route::get('/display/{id}', 'ProductAttributesController@displayoptionsvalues')->middleware('view_product');
            Route::post('/insert', 'ProductAttributesController@insertoptionsvalues')->middleware('add_product');
            Route::get('/edit/{id}', 'ProductAttributesController@editoptionsvalues')->middleware('edit_product');
            Route::post('/update', 'ProductAttributesController@updateoptionsvalues')->middleware('edit_product');
            Route::post('/delete', 'ProductAttributesController@deleteoptionsvalues')->middleware('delete_product');
            Route::post('/addattributevalue', 'ProductAttributesController@addattributevalue')->middleware('add_product');
            Route::post('/updateattributevalue', 'ProductAttributesController@updateattributevalue')->middleware('edit_product');
            Route::post('/checkattributeassociate', 'ProductAttributesController@checkattributeassociate')->middleware('edit_product');
            Route::post('/checkvalueassociate', 'ProductAttributesController@checkvalueassociate')->middleware('edit_product');
        });
    });

    Route::group(['prefix' => 'admin/admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/profile', 'AdminController@profile')->middleware('profile_view');
        Route::post('/update', 'AdminController@update')->middleware('profile_update');
        Route::post('/updatepassword', 'AdminController@updatepassword');
    });

    Route::group(['prefix' => 'admin/reviews', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductController@reviews')->middleware('view_reviews');
        Route::get('/edit/{id}/{status}', 'ProductController@editreviews')->middleware('edit_reviews');
        Route::get('/filter', 'ProductController@filter')->middleware('view_reviews');
    });
//customers
    Route::group(['prefix' => 'admin/customers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CustomersController@display')->middleware('view_customer');
        Route::get('/add', 'CustomersController@add')->middleware('add_customer');
        Route::post('/add', 'CustomersController@insert')->middleware('add_customer');
        Route::get('/edit/{id}', 'CustomersController@edit')->middleware('edit_customer');
        Route::post('/update', 'CustomersController@update')->middleware('edit_customer');
        Route::post('/delete', 'CustomersController@delete')->middleware('delete_customer');
        Route::get('/filter', 'CustomersController@filter')->middleware('view_customer');
         Route::get('/view/{id}', 'CustomersController@view')->middleware('view_customer');
        //add adddresses against customers
        Route::get('/address/display/{id}/', 'CustomersController@diplayaddress')->middleware('add_customer');
        Route::post('/addcustomeraddress', 'CustomersController@addcustomeraddress')->middleware('add_customer');
        Route::post('/editaddress', 'CustomersController@editaddress')->middleware('edit_customer');
        Route::post('/updateaddress', 'CustomersController@updateaddress')->middleware('edit_customer');
        Route::post('/deleteAddress', 'CustomersController@deleteAddress')->middleware('edit_customer');
    });

    Route::group(['prefix' => 'admin/countries', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/filter', 'CountriesController@filter')->middleware('view_tax');
        Route::get('/display', 'CountriesController@index')->middleware('view_tax');
        Route::get('/add', 'CountriesController@add')->middleware('add_tax');
        Route::post('/add', 'CountriesController@insert')->middleware('add_tax');
        Route::get('/edit/{id}', 'CountriesController@edit')->middleware('edit_tax');
        Route::post('/update', 'CountriesController@update')->middleware('edit_tax');
        Route::post('/delete', 'CountriesController@delete')->middleware('delete_tax');
    });

    Route::group(['prefix' => 'admin/zones', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ZonesController@index')->middleware('view_tax');
        Route::get('/filter', 'ZonesController@filter')->middleware('view_tax');
        Route::get('/add', 'ZonesController@add')->middleware('add_tax');
        Route::post('/add', 'ZonesController@insert')->middleware('add_tax');
        Route::get('/edit/{id}', 'ZonesController@edit')->middleware('edit_tax');
        Route::post('/update', 'ZonesController@update')->middleware('edit_tax');
        Route::post('/delete', 'ZonesController@delete')->middleware('delete_tax');
    });

    Route::group(['prefix' => 'admin/tax', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {

        Route::group(['prefix' => '/taxclass'], function () {
            Route::get('/filter', 'TaxController@filtertaxclass')->middleware('view_tax');
            Route::get('/display', 'TaxController@taxindex')->middleware('view_tax');
            Route::get('/add', 'TaxController@addtaxclass')->middleware('add_tax');
            Route::post('/add', 'TaxController@inserttaxclass')->middleware('add_tax');
            Route::get('/edit/{id}', 'TaxController@edittaxclass')->middleware('edit_tax');
            Route::post('/update', 'TaxController@updatetaxclass')->middleware('edit_tax');
            Route::post('/delete', 'TaxController@deletetaxclass')->middleware('delete_tax');
        });

        Route::group(['prefix' => '/taxrates'], function () {
            Route::get('/display', 'TaxController@displaytaxrates')->middleware('view_tax');
            Route::get('/filter', 'TaxController@filtertaxrates')->middleware('view_tax');
            Route::get('/add', 'TaxController@addtaxrate')->middleware('add_tax');
            Route::post('/add', 'TaxController@inserttaxrate')->middleware('add_tax');
            Route::get('/edit/{id}', 'TaxController@edittaxrate')->middleware('edit_tax');
            Route::post('/update', 'TaxController@updatetaxrate')->middleware('edit_tax');
            Route::post('/delete', 'TaxController@deletetaxrate')->middleware('delete_tax');
        });

    });

    Route::group(['prefix' => 'admin/shippingmethods', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        //shipping setting
        Route::get('/display', 'ShippingMethodsController@display')->middleware('view_shipping');
        Route::get('/upsShipping', 'ShippingMethodsController@upsShipping')->middleware('view_shipping');
        Route::post('/updateupsshipping', 'ShippingMethodsController@updateupsshipping')->middleware('edit_shipping');
        Route::get('/flateRate/{id}', 'ShippingMethodsController@flateRate')->middleware('edit_shipping');
        Route::post('/updateflaterate', 'ShippingMethodsController@updateflaterate')->middleware('edit_shipping');
        Route::post('/defaultShippingMethod', 'ShippingMethodsController@defaultShippingMethod')->middleware('edit_shipping');
        Route::get('/detail/{table_name}', 'ShippingMethodsController@detail')->middleware('edit_shipping');
        Route::post('/update', 'ShippingMethodsController@update')->middleware('edit_shipping');

      /*   Route::get('/shppingbyweight', 'ShippingByWeightController@shppingbyweight')->middleware('view_shipping');
        Route::post('/updateShppingWeightPrice', 'ShippingByWeightController@updateShppingWeightPrice')->middleware('edit_shipping'); */
        Route::get('/shippingbykm/display', 'ShippingByKMController@shippingbykm')->middleware('view_shipping');
        Route::get('/shippingbykm/add', 'ShippingByKMController@add')->middleware('view_shipping');
        Route::post('/shippingbykm/insert', 'ShippingByKMController@insert')->middleware('edit_shipping');
        Route::get('/shippingbykm/edit/{id}', 'ShippingByKMController@edit')->middleware('edit_shipping');
        Route::post('/shippingbykm/update', 'ShippingByKMController@update')->middleware('edit_shipping');
        Route::post('/shippingbykm/delete', 'ShippingByKMController@delete')->middleware('edit_shipping');

        Route::get('/shippingbyweight/display', 'ShippingByWeightController@shippingbyweight')->middleware('view_shipping');
        Route::get('/shippingbyweight/add', 'ShippingByWeightController@add')->middleware('view_shipping');
        Route::post('/shippingbyweight/insert', 'ShippingByWeightController@insert')->middleware('edit_shipping');
        Route::get('/shippingbyweight/edit/{id}', 'ShippingByWeightController@edit')->middleware('edit_shipping');
        Route::post('/shippingbyweight/update', 'ShippingByWeightController@update')->middleware('edit_shipping');
        Route::post('/shippingbyweight/delete', 'ShippingByWeightController@delete')->middleware('edit_shipping');

        Route::get('/shippingbyweightandkm/display', 'ShippingByWeightAndKMController@shippingbyweightandkm')->middleware('view_shipping');
        Route::get('/shippingbyweightandkm/add_km', 'ShippingByWeightAndKMController@addKM')->middleware('view_shipping');
        Route::post('/shippingbyweightandkm/insert_km', 'ShippingByWeightAndKMController@insertKM')->middleware('edit_shipping');
        Route::get('/shippingbyweightandkm/edit_km/{id}', 'ShippingByWeightAndKMController@editKM')->middleware('edit_shipping');
        Route::post('/shippingbyweightandkm/update_km', 'ShippingByWeightAndKMController@updateKM')->middleware('edit_shipping');
        Route::post('/shippingbyweightandkm/delete_km', 'ShippingByWeightAndKMController@deleteKM')->middleware('edit_shipping');

        Route::get('/shippingbyweightandkm/add_weight', 'ShippingByWeightAndKMController@addWeight')->middleware('view_shipping');
        Route::post('/shippingbyweightandkm/insert_weight', 'ShippingByWeightAndKMController@insertWeight')->middleware('edit_shipping');
        Route::get('/shippingbyweightandkm/edit_weight/{id}', 'ShippingByWeightAndKMController@editWeight')->middleware('edit_shipping');
        Route::post('/shippingbyweightandkm/update_weight', 'ShippingByWeightAndKMController@updateWeight')->middleware('edit_shipping');
        Route::post('/shippingbyweightandkm/delete_weight', 'ShippingByWeightAndKMController@deleteWeight')->middleware('edit_shipping');

    });
    Route::group(['prefix' => 'admin/paymentmethods', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/index', 'PaymentMethodsController@index')->middleware('view_payment');
        Route::get('/display/{id}', 'PaymentMethodsController@display')->middleware('view_payment');
        Route::post('/update', 'PaymentMethodsController@update')->middleware('edit_payment');
        Route::post('/active', 'PaymentMethodsController@active')->middleware('edit_payment');
    });

    Route::group(['prefix' => 'admin/coupons', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CouponsController@display')->middleware('view_coupon');
        
        Route::get('/add', 'CouponsController@add')->middleware('add_coupon');
        Route::post('/insert', 'CouponsController@insert')->middleware('add_coupon');
        Route::get('/edit/{id}', 'CouponsController@edit')->middleware('edit_coupon');
        Route::post('/update', 'CouponsController@update')->middleware('edit_coupon');
        Route::post('/delete', 'CouponsController@delete')->middleware('delete_coupon');
        Route::get('/filter', 'CouponsController@filter')->middleware('view_coupon');
    });
    Route::group(['prefix' => 'admin/devices', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NotificationController@devices')->middleware('view_notification');
        Route::get('/viewdevices/{id}', 'NotificationController@viewdevices')->middleware('view_notification');
        Route::post('/notifyUser/', 'NotificationController@notifyUser')->middleware('edit_notification');
        Route::get('/notifications/', 'NotificationController@notifications')->middleware('view_notification');
        Route::post('/sendNotifications/', 'NotificationController@sendNotifications')->middleware('edit_notification');
        Route::post('/customerNotification/', 'NotificationController@customerNotification')->middleware('view_notification');
        Route::post('/singleUserNotification/', 'NotificationController@singleUserNotification')->middleware('edit_notification');
        Route::post('/deletedevice/', 'NotificationController@deletedevice')->middleware('view_notification');
    });

    Route::group(['prefix' => 'admin/devices', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/', 'NotificationController@devices')->middleware('view_notification');
        Route::get('/viewdevices/{id}', 'NotificationController@viewdevices')->middleware('view_notification');
        Route::post('/notifyUser/', 'NotificationController@notifyUser')->middleware('edit_notification');
        Route::get('/notifications/', 'NotificationController@notifications')->middleware('view_notification');
        Route::post('/sendNotifications/', 'NotificationController@sendNotifications')->middleware('edit_notification');
        Route::post('/customerNotification/', 'NotificationController@customerNotification')->middleware('view_notification');
        Route::post('/singleUserNotification/', 'NotificationController@singleUserNotification')->middleware('edit_notification');
        Route::post('/deletedevice/', 'NotificationController@deletedevice')->middleware('view_notification');
    });

    Route::group(['prefix' => 'admin/orders', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'OrdersController@display')->middleware('view_order');
        Route::get('/filter', 'OrdersController@filter')->middleware('view_order');
        Route::get('/vieworder/{id}', 'OrdersController@vieworder')->middleware('view_order');
        Route::post('/updateOrder', 'OrdersController@updateOrder')->middleware('edit_order');
        Route::post('/updateOrderPayment', 'OrdersController@updateOrderPayment')->middleware('edit_order');
        Route::post('/deleteOrder', 'OrdersController@deleteOrder')->middleware('edit_order');
        Route::get('/invoiceprint/{id}', 'OrdersController@invoiceprint')->middleware('view_order');
        Route::get('/orderstatus', 'SiteSettingController@orderstatus')->middleware('view_order');
        Route::get('/addorderstatus', 'SiteSettingController@addorderstatus')->middleware('edit_order');
        Route::post('/addNewOrderStatus', 'SiteSettingController@addNewOrderStatus')->middleware('edit_order');
        Route::get('/editorderstatus/{id}', 'SiteSettingController@editorderstatus')->middleware('edit_order');
        Route::post('/updateOrderStatus', 'SiteSettingController@updateOrderStatus')->middleware('edit_order');
        Route::post('/deleteOrderStatus', 'SiteSettingController@deleteOrderStatus')->middleware('edit_order');
        Route::post('/assignorders', 'OrdersController@assignorders')->middleware('edit_order');

         Route::post('/SetCancelStatus', 'SiteSettingController@SetCancelStatus')->middleware('edit_order');
    });

    Route::group(['prefix' => 'admin/banners', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/', 'BannersController@banners')->middleware('view_app_setting');
        Route::get('/add', 'BannersController@addbanner')->middleware('edit_app_setting');
        Route::post('/insert', 'BannersController@addNewBanner')->middleware('edit_app_setting');
        Route::get('/edit/{id}', 'BannersController@editbanner')->middleware('edit_app_setting');
        Route::post('/update', 'BannersController@updateBanner')->middleware('edit_app_setting');
        Route::post('/delete', 'BannersController@deleteBanner')->middleware('edit_app_setting');
        Route::get('/filter', 'BannersController@filterbanners')->middleware('edit_app_setting');

    });


    Route::group(['prefix' => 'admin/banners_two', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/', 'BannerstwoController@banners_two')->middleware('view_app_setting');
        Route::get('/add_two', 'BannerstwoController@addbanner_two')->middleware('edit_app_setting');
        Route::post('/insert_two', 'BannerstwoController@addNewBanner_two')->middleware('edit_app_setting');
        Route::get('/edit_two/{id}', 'BannerstwoController@editbanner_two')->middleware('edit_app_setting');
        Route::post('/update_two', 'BannerstwoController@updateBanner_two')->middleware('edit_app_setting');
        Route::post('/delete_two', 'BannerstwoController@deleteBanner_two')->middleware('edit_app_setting');
        Route::get('/filter_two', 'BannerstwoController@filterbanners_two')->middleware('edit_app_setting');

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {


        Route::get('/readytemplate', 'ReadyTemplateController@viewTemplate')->middleware('view_web_setting');
        Route::get('/readytemplate_demo/{id}', 'ReadyTemplateController@demoTemplate')->middleware('view_web_setting');
        Route::get('/readytemplate_save/{id}', 'ReadyTemplateController@updateTemplate')->middleware('view_web_setting');
        

        Route::get('/customers-orders-report', 'ReportsController@statsCustomers')->middleware('report');
        Route::get('/customer-orders-print', 'ReportsController@customerOrdersPrint')->middleware('report');
        Route::get('/customers-wallet-report', 'ReportsController@walletCustomers')->middleware('report');
        Route::get('/sales-orders-print', 'ReportsController@salesOrdersPrint')->middleware('report');
        Route::get('/statsproductspurchased', 'ReportsController@statsProductsPurchased')->middleware('report');
        Route::get('/statsproductsliked', 'ReportsController@statsProductsLiked')->middleware('report');
        Route::get('/outofstock', 'ReportsController@outofstock')->middleware('report');
        Route::get('/outofstockprint', 'ReportsController@outofstockprint')->middleware('report');
        
        Route::get('/lowinstock', 'ReportsController@lowinstock')->middleware('report');
        

        Route::post('/productSaleReport', 'ReportsController@productSaleReport')->middleware('dashboard');        
        Route::get('/driversreport', 'ReportsController@driversreport')->middleware('report');     
        Route::get('/driverreportsdetail/{id}', 'ReportsController@driverreportsdetail')->middleware('report');
        Route::get('/couponreport', 'ReportsController@couponReport')->middleware('report');
        Route::get('/couponreportfilter', 'ReportsController@couponreportfilter')->middleware('report');
        Route::get('/couponreportuser/{id}', 'ReportsController@couponreportuser')->middleware('report');
        
        Route::get('/couponreport-print', 'ReportsController@couponReportPrint')->middleware('report');
        Route::get('/loyaltyreport', 'ReportsController@loyaltyreport')->middleware('report');
        Route::get('/loyaltyreportfilter', 'ReportsController@loyaltyreportfilter')->middleware('report');
        Route::get('/loyaltyreportuser/{id}', 'ReportsController@loyaltyreportuser')->middleware('report');
        
        Route::get('/salesreport', 'ReportsController@salesreport')->middleware('report');
        Route::get('/salescancelreport', 'ReportsController@salescancelreport')->middleware('report');
        Route::post('/getproduct', 'ReportsController@getproduct')->middleware('report');
		Route::get('/salesreportdetail/{id}', 'ReportsController@salesReportDetails')->middleware('report');
		
		Route::get('/productsalesreport', 'ReportsController@productSalesReport')->middleware('report');
        Route::get('/sales-product-print', 'ReportsController@salesProductPrint')->middleware('report');
        // Route::get('/customer-orders-print', 'ReportsController@customerOrdersPrint')->middleware('report');
        
        Route::get('/inventoryreport', 'ReportsController@inventoryreport')->middleware('report');
        Route::get('/inventoryreportprint', 'ReportsController@inventoryreportprint')->middleware('report');

        
        Route::get('/minstock', 'ReportsController@minstock')->middleware('report');
        Route::get('/minstockprint', 'ReportsController@minstockprint')->middleware('report');
        
        Route::get('/maxstock', 'ReportsController@maxstock')->middleware('report');
        Route::get('/maxstockprint', 'ReportsController@maxstockprint')->middleware('report');
        Route::get('/profit_loss', 'ReportsController@profit_loss')->middleware('report');
        Route::get('/profitlossprint', 'ReportsController@profitlossprint')->middleware('report');
        Route::get('/sales_person_report', 'ReportsController@sales_person_report')->middleware('report');
        Route::get('/sales_person_view/{id}', 'ReportsController@sales_person_view')->middleware('report');
        
        ////////////////////////////////////////////////////////////////////////////////////
        //////////////     APP ROUTES
        ////////////////////////////////////////////////////////////////////////////////////
        //app pages controller
        Route::get('/pages', 'PagesController@pages')->middleware('view_app_setting', 'application_routes');
        Route::get('/addpage', 'PagesController@addpage')->middleware('edit_app_setting', 'application_routes');
        Route::post('/addnewpage', 'PagesController@addnewpage')->middleware('edit_app_setting', 'application_routes');
        Route::get('/editpage/{id}', 'PagesController@editpage')->middleware('edit_app_setting', 'application_routes');
        Route::post('/updatepage', 'PagesController@updatepage')->middleware('edit_app_setting', 'application_routes');
        Route::post('/deletepage', 'PagesController@deletepages')->middleware('edit_app_setting', 'application_routes');
        Route::get('/pageStatus', 'PagesController@pageStatus')->middleware('edit_app_setting', 'application_routes');
        Route::get('/filterpages', 'PagesController@filterpages')->middleware('view_app_setting', 'application_routes');
        //manageAppLabel
        Route::get('/listingAppLabels', 'AppLabelsController@listingAppLabels')->middleware('view_app_setting', 'application_routes');
        Route::get('/addappkey', 'AppLabelsController@addappkey')->middleware('edit_app_setting', 'application_routes');
        Route::post('/addNewAppLabel', 'AppLabelsController@addNewAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::get('/editAppLabel/{id}', 'AppLabelsController@editAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::post('/updateAppLabel/', 'AppLabelsController@updateAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::get('/applabel', 'AppLabelsController@manageAppLabel')->middleware('view_app_setting', 'application_routes');

        Route::get('/admobSettings', 'SiteSettingController@admobSettings')->middleware('view_app_setting', 'application_routes');
        Route::get('/applicationapi', 'SiteSettingController@applicationApi')->middleware('view_app_setting', 'application_routes');
        Route::get('/appsettings', 'SiteSettingController@appSettings')->middleware('view_app_setting', 'application_routes');

////////////////////////////////////////////////////////////////////////////////////
        //////////////     POS ROUTES
        ////////////////////////////////////////////////////////////////////////////////////

         Route::get('/possettings', 'SiteSettingController@posSettings')->middleware('view_pos_setting', 'pos_routes');
		 Route::get('/cashierrole', 'SiteSettingController@cashierrole')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/cashierroleupdate/{id}', 'SiteSettingController@cashierroleupdate')->middleware('view_pos_setting', 'pos_routes');
         Route::post('/addnewcashierroles', 'SiteSettingController@addnewcashierroles')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/posfastcash', 'SiteSettingController@posfastcash')->middleware('view_pos_setting', 'pos_routes');
         Route::post('/updateposfastcash', 'SiteSettingController@updateposfastcash')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/pospayment', 'SiteSettingController@pospayment')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/addpospayment', 'SiteSettingController@addpospayment')->middleware('view_pos_setting', 'pos_routes');
         Route::post('/insertpospayment', 'SiteSettingController@insertpospayment')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/pospaymentedit/{id}', 'SiteSettingController@pospaymentedit')->middleware('view_pos_setting', 'pos_routes');
         Route::post('/updatepospayment', 'SiteSettingController@updatepospayment')->middleware('view_pos_setting', 'pos_routes');
         Route::get('/qrordersettings', 'SiteSettingController@qrordersettings');
         Route::post('/updateqrSetting', 'SiteSettingController@updateqrSetting');
        Route::get('/drawercate', 'SiteSettingController@drawercate')->middleware('view_pos_setting', 'pos_routes');
        Route::get('/adddrawercate', 'SiteSettingController@adddrawercate')->middleware('view_pos_setting', 'pos_routes');
        Route::post('/insertdrawercate', 'SiteSettingController@insertdrawercate')->middleware('view_pos_setting', 'pos_routes');
        Route::get('/editdrawercate/{id}', 'SiteSettingController@editdrawercate')->middleware('view_pos_setting', 'pos_routes');
        Route::post('/updatedrawercate', 'SiteSettingController@updatedrawercate')->middleware('view_pos_setting', 'pos_routes');
        Route::post('/deletedrawercate', 'SiteSettingController@deletedrawercate')->middleware('view_pos_setting', 'pos_routes');

////////////////////////////////////////////////////////////////////////////////////
        //////////////     SITE ROUTES
        ////////////////////////////////////////////////////////////////////////////////////
        
        // home page banners
        Route::get('/homebanners', 'HomeBannersController@display')->middleware('view_web_setting', 'website_routes');
        Route::get('/homebannerstwo', 'HomeBannersController@display2')->middleware('view_web_setting', 'website_routes');
        Route::get('/homebannersthree', 'HomeBannersController@display3')->middleware('view_web_setting', 'website_routes');
        Route::post('/homebanners/insert', 'HomeBannersController@insert')->middleware('view_web_setting', 'website_routes');
        
        Route::get('/menus', 'MenusController@menus')->middleware('view_web_setting', 'website_routes');
        Route::get('/addmenus', 'MenusController@addmenus')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewmenu', 'MenusController@addnewmenu')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editmenu/{id}', 'MenusController@editmenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/updatemenu', 'MenusController@updatemenu')->middleware('edit_web_setting', 'website_routes');
        Route::get('/deletemenu/{id}', 'MenusController@deletemenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/deletemenu', 'MenusController@deletemenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/menuposition', 'MenusController@menuposition')->middleware('edit_web_setting', 'website_routes');
        Route::get('/catalogmenu', 'MenusController@catalogmenu')->middleware('edit_web_setting', 'website_routes');

        

        //site pages controller
        Route::get('/webpages', 'PagesController@webpages')->middleware('view_web_setting', 'website_routes');
        Route::get('/zippageadd', 'PagesController@zippageadd')->middleware('view_web_setting', 'website_routes');
        Route::post('/insertzippage', 'PagesController@insertzippage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/zippageedit/{id}', 'PagesController@zippageedit')->middleware('view_web_setting', 'website_routes');
        Route::post('/editzippage', 'PagesController@editzippage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/zippageStatus', 'PagesController@zippageStatus')->middleware('edit_app_setting');
        Route::post('/deletezippage', 'PagesController@deletezippages')->middleware('edit_app_setting', 'application_routes');

        Route::get('/addwebpage', 'PagesController@addwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewwebpage', 'PagesController@addnewwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewpagebuilder', 'PagesController@addnewpagebuilder')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editwebpage/{id}', 'PagesController@editwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editwebpagebuilder/{id}', 'PagesController@editwebpagebuilder')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editpagebuildcontent/{id}', 'PagesController@editpagebuildcontent')->middleware('edit_web_setting', 'website_routes');
        Route::post('/editnewwebpagebuilder', 'PagesController@editnewwebpagebuilder')->middleware('edit_web_setting', 'website_routes');
        Route::post('/updatewebpage', 'PagesController@updatewebpage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/pageWebStatus', 'PagesController@pageWebStatus')->middleware('view_web_setting', 'website_routes');

        Route::get('/pagebuilderStatus', 'PagesController@pagebuilderStatus')->middleware('view_web_setting', 'website_routes');
        Route::get('/addwebpagebuild', 'PagesController@addwebpagebuild')->middleware('edit_web_setting', 'website_routes');
        
        Route::post('/addcontentpagebuilder', 'PagesController@addcontentpagebuilder')->middleware('edit_web_setting', 'website_routes');
        Route::get('/addwebpagebuilder/{id}', 'PagesController@addwebpagebuilder')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewwebpagebuilder', 'PagesController@addnewwebpagebuilder')->middleware('edit_web_setting', 'website_routes');

        Route::get('/webthemes', 'SiteSettingController@webThemes')->middleware('view_web_setting', 'website_routes');
        Route::get('/themeSettings', 'SiteSettingController@themeSettings')->middleware('edit_web_setting', 'website_routes');
        Route::post('/updatesubscribeSetting', 'SiteSettingController@updatesubscribeSetting')->middleware('edit_web_setting', 'website_routes');

        Route::get('/seo', 'SiteSettingController@seo')->middleware('view_web_setting', 'website_routes');
        Route::get('/customstyle', 'SiteSettingController@customstyle')->middleware('view_web_setting', 'website_routes');
        Route::post('/updateWebTheme', 'SiteSettingController@updateWebTheme')->middleware('edit_web_setting', 'website_routes');
        Route::get('/websettings', 'SiteSettingController@webSettings')->middleware('view_web_setting', 'website_routes');
        Route::get('/subscribe', 'SiteSettingController@subscribe')->middleware('view_web_setting', 'website_routes');
        Route::get('/newdeal', 'SiteSettingController@newdeal')->middleware('view_web_setting', 'website_routes');
        Route::post('/updatenewdealSetting', 'SiteSettingController@updatenewdealSetting')->middleware('edit_web_setting', 'website_routes');
        Route::get('/instafeed', 'SiteSettingController@instafeed')->middleware('view_web_setting', 'website_routes');
        Route::get('/newsletter', 'SiteSettingController@newsletter')->middleware('view_web_setting', 'website_routes');


        Route::get('email/emailsetting', 'SiteSettingController@emailsetting')->middleware('edit_general_setting');
        Route::get('email/newuser', 'SiteSettingController@newuser')->middleware('edit_general_setting');
        Route::get('email/subscription', 'SiteSettingController@subscription')->middleware('edit_general_setting');


        Route::get('email/emailsetting_developer', 'SiteSettingController@emailsettingDeveloper')->middleware('edit_general_setting');
        Route::get('/setting_developer', 'SiteSettingController@settingDeveloper')->middleware('edit_general_setting');
        Route::get('/firebase_developer', 'SiteSettingController@firebaseDeveloper')->middleware('view_general_setting');

/////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////
        //////////////     GENERAL ROUTES
        ////////////////////////////////////////////////////////////////////////////////////


//units
       
        Route::get('/units', 'SiteSettingController@units')->middleware('view_product');
        Route::get('/addunit', 'SiteSettingController@addunit')->middleware('add_product');
        Route::post('/addnewunit', 'SiteSettingController@addnewunit')->middleware('edit_product');
        Route::get('/editunit/{id}', 'SiteSettingController@editunit')->middleware('edit_product');
        Route::post('/updateunit', 'SiteSettingController@updateunit')->middleware('edit_product');
        Route::post('/deleteunit', 'SiteSettingController@deleteunit')->middleware('view_product');

        Route::get('/orderstatus', 'SiteSettingController@orderstatus')->middleware('view_order');
        Route::get('/addorderstatus', 'SiteSettingController@addorderstatus')->middleware('edit_product');
        Route::post('/addNewOrderStatus', 'SiteSettingController@addNewOrderStatus')->middleware('edit_product');
        Route::get('/editorderstatus/{id}', 'SiteSettingController@editorderstatus')->middleware('edit_product');
        Route::post('/updateOrderStatus', 'SiteSettingController@updateOrderStatus')->middleware('edit_product');
        Route::post('/deleteOrderStatus', 'SiteSettingController@deleteOrderStatus')->middleware('edit_product');

        Route::get('/facebooksettings', 'SiteSettingController@facebookSettings')->middleware('view_general_setting');
        Route::get('/googlesettings', 'SiteSettingController@googleSettings')->middleware('view_general_setting');
        Route::get('/instagramsettings', 'SiteSettingController@instagramSettings')->middleware('view_general_setting');

        //pushNotification
        Route::get('/pushnotification', 'SiteSettingController@pushNotification')->middleware('view_general_setting');
        Route::get('/alertsetting', 'SiteSettingController@alertSetting')->middleware('view_general_setting');
        Route::post('/updateAlertSetting', 'SiteSettingController@updateAlertSetting');
        Route::get('/setting', 'SiteSettingController@setting')->middleware('edit_general_setting');
        Route::post('/updateSetting', 'SiteSettingController@updateSetting')->middleware('edit_general_setting');
        Route::get('/geo-fencing', 'SiteSettingController@geoFencing')->middleware('view_general_setting');
         Route::get('/add-geo-fencing', 'SiteSettingController@addgeoFencing')->middleware('edit_general_setting');
          Route::post('/addgeofencingaction', 'SiteSettingController@addGeoFencingaction')->middleware('edit_general_setting');
          Route::get('/edit-geo-fencing/{id}', 'SiteSettingController@editgeoFencing')->middleware('edit_general_setting');
          Route::post('/editgeofencingaction', 'SiteSettingController@editGeoFencingaction')->middleware('edit_general_setting');
          Route::post('/geodelete', 'SiteSettingController@GeoFencingdelete')->middleware('edit_general_setting');
          Route::get('/geo-filter', 'SiteSettingController@geoFilter')->middleware('view_general_setting');
        
        
        Route::get('/clearcache', 'SiteSettingController@clearcache');
        Route::get('/firebase', 'SiteSettingController@firebase')->middleware('view_general_setting');
        
        //login
        Route::get('/loginsetting', 'SiteSettingController@loginsetting')->middleware('view_general_setting');

        //admin managements
        Route::get('/admins', 'AdminController@admins')->middleware('view_manage_admin');
        Route::get('/addadmins', 'AdminController@addadmins')->middleware('add_manage_admin');
        Route::post('/addnewadmin', 'AdminController@addnewadmin')->middleware('add_manage_admin');
        Route::get('/editadmin/{id}', 'AdminController@editadmin')->middleware('edit_manage_admin');
        Route::post('/updateadmin', 'AdminController@updateadmin')->middleware('edit_manage_admin');
        Route::post('/deleteadmin', 'AdminController@deleteadmin')->middleware('delete_manage_admin');
        Route::post('/addnewsegment', 'AdminController@addnewsegment')->middleware('add_manage_admin');
        Route::get('/viewsegment/{id}', 'AdminController@viewsegment')->middleware('add_manage_admin');
        Route::get('/editsegment/{id}', 'AdminController@editsegment')->middleware('edit_manage_admin');
        Route::post('/updatenewsegment', 'AdminController@updatenewsegment')->middleware('edit_manage_admin');

        //admin managements
        Route::get('/manageroles', 'AdminController@manageroles')->middleware('manage_role');
        Route::get('/addrole/{id}', 'AdminController@addrole')->middleware('manage_role');
        Route::post('/addnewroles', 'AdminController@addnewroles')->middleware('manage_role');
        Route::get('/addadmintype', 'AdminController@addadmintype')->middleware('add_admin_type');
        Route::post('/addnewtype', 'AdminController@addnewtype')->middleware('add_admin_type');
        Route::get('/editadmintype/{id}', 'AdminController@editadmintype')->middleware('edit_admin_type');
        Route::post('/updatetype', 'AdminController@updatetype')->middleware('edit_admin_type');
        Route::post('/deleteadmintype', 'AdminController@deleteadmintype')->middleware('delete_admin_type');

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    });

    Route::group(['prefix' => 'admin/managements', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/merge', 'ManagementsController@merge')->middleware('edit_management');
        Route::get('/backup', 'ManagementsController@backup')->middleware('edit_management');
        Route::post('/take_backup', 'ManagementsController@take_backup')->middleware('edit_management');
        Route::get('/import', 'ManagementsController@import')->middleware('edit_management');
        Route::post('/importdata', 'ManagementsController@importdata')->middleware('edit_management');
        Route::post('/mergecontent', 'ManagementsController@mergecontent')->middleware('edit_management');
        Route::get('/updater', 'ManagementsController@updater')->middleware('edit_management');
        Route::post('/checkpassword', 'ManagementsController@checkpassword')->middleware('edit_management');
        Route::post('/updatercontent', 'ManagementsController@updatercontent')->middleware('edit_management');
        Route::get('/factory_reset', 'ManagementsController@factory_reset')->middleware('edit_management');
         Route::post('/reset_action', 'ManagementsController@reset_action')->middleware('edit_management');
    });

    Route::group(['prefix'=>'admin/deliveryboys','middleware' => 'auth','namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'DeliveryBoysController@display')->middleware('view_deliveryboy');
        Route::get('/add', 'DeliveryBoysController@add')->middleware('add_deliveryboy');
        Route::post('/add', 'DeliveryBoysController@insert')->middleware('add_deliveryboy');
        Route::get('/edit/{id}', 'DeliveryBoysController@edit')->middleware('edit_deliveryboy');
        Route::post('/update', 'DeliveryBoysController@update')->middleware('edit_deliveryboy');
        Route::post('/delete', 'DeliveryBoysController@delete')->middleware('delete_deliveryboy');
        Route::get('/filter', 'DeliveryBoysController@filter')->middleware('view_deliveryboy');
        Route::get('/eagleview', 'DeliveryBoysController@eagleview')->middleware('view_deliveryboy');
        Route::get('/eagleview/latlong', 'DeliveryBoysController@latlong')->middleware('view_deliveryboy');
        Route::get('/refresh', 'DeliveryBoysController@refresh');
        Route::get('/ratings/{id}', 'DeliveryBoysController@ratings')->middleware('view_deliveryboy');
        Route::post('/ratings/delete', 'DeliveryBoysController@ratingdelete')->middleware('delete_deliveryboy');
        Route::get('/setting', 'SiteSettingController@deliveryboysetting')->middleware('delete_deliveryboy');
      
        Route::group(['prefix'=>'finance/'], function () {
          Route::get('/sattlement/deliveryboy/{deliveryboys_id}', 'DeliveryboyFinanceController@deliveryboysattlement')->middleware('view_finance');
          Route::get('/monthreport/{month}/vendor/{vendor_id}', 'DeliveryboyFinanceController@earningsbymonthvendor')->middleware('view_finance');
          Route::get('/sattlement/orders', 'DeliveryboyFinanceController@orders')->middleware('view_finance');
      
          //Route::get('/paidpopupdetail', 'DeliveryboyFinanceController@paidpopupdetail')->middleware('view_finance');
          //Route::get('/popupdetail', 'DeliveryboyFinanceController@popupdetail')->middleware('view_finance');
        });
      
        Route::group(['prefix'=>'withdraw/'], function () {
          Route::get('/display', 'DeliveryBoysWithdrawController@display')->middleware('view_web_setting');
          Route::get('/paidpopupdetail', 'DeliveryBoysWithdrawController@paidpopupdetail')->middleware('view_web_setting');
          Route::get('/popupdetail', 'DeliveryBoysWithdrawController@popupdetail')->middleware('view_web_setting');
          Route::post('/pay', 'DeliveryBoysWithdrawController@pay')->middleware('view_web_setting');
        });
        Route::group(['prefix'=>'floatingcash/'], function () {
          Route::get('/display', 'DeliveryBoysFloatingCashController@display')->middleware('view_web_setting');
          Route::post('/recieved', 'DeliveryBoysFloatingCashController@recieved')->middleware('view_web_setting');
        });

        Route::get('/pages', 'DeliveryBoysPagesController@pages')->middleware('view_app_setting');
        Route::get('/addpage', 'DeliveryBoysPagesController@addpage')->middleware('edit_app_setting');
        Route::post('/addnewpage', 'DeliveryBoysPagesController@addnewpage')->middleware('edit_app_setting');
        Route::get('/editpage/{id}', 'DeliveryBoysPagesController@editpage')->middleware('edit_app_setting');
        Route::post('/updatepage', 'DeliveryBoysPagesController@updatepage')->middleware('edit_app_setting');
        Route::get('/pageStatus', 'DeliveryBoysPagesController@pageStatus')->middleware('edit_app_setting');
        Route::get('/filterpages', 'DeliveryBoysPagesController@filterpages')->middleware('view_app_setting');


        Route::group(['prefix' => 'status'], function () {
            Route::get('/display', 'DeliveryBoysStatusController@index')->middleware('view_app_setting');
            Route::get('/add', 'DeliveryBoysStatusController@add')->middleware('view_app_setting');
            Route::post('/addNew', 'DeliveryBoysStatusController@addNew')->middleware('view_app_setting');
            Route::get('/edit/{id}', 'DeliveryBoysStatusController@edit')->middleware('view_app_setting');
            Route::post('/update', 'DeliveryBoysStatusController@update')->middleware('view_app_setting');
            Route::post('/delete', 'DeliveryBoysStatusController@delete')->middleware('view_app_setting');
        });

      });


     Route::group(['prefix' => 'admin/wallet', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
            Route::get('/walletreport', 'WalletController@walletreport')->middleware('wallet_view');
            Route::get('/banktransfer', 'WalletController@banktransfer')->middleware('wallet_view');
            Route::post('/bankapprove', 'WalletController@bankapprove')->middleware('wallet_view');
            Route::get('/viewbankimage/{id}', 'WalletController@viewbankimage')->middleware('wallet_view');
            Route::get('/walletdetails/{id}', 'WalletController@walletdetails')->middleware('wallet_view');
      });

     Route::group(['prefix' => 'admin/appointment', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {

      Route::get('/appointment', 'AppointmentController@appointment')->middleware('appointment_view');
      Route::post('/delete_appointment', 'AppointmentController@deleteAppointment')->middleware('appointment_view');
      Route::get('/appointment_detail/{id}', 'AppointmentController@appointmentDetail')->middleware('appointment_view');
      Route::get('/appointment_filter', 'AppointmentController@appointmentFilter')->middleware('appointment_view');


      Route::get('/appointment_setting', 'AppointmentController@appointmentSetting')->middleware('appointment_setting_view');
      Route::get('/addappointmentsetting', 'AppointmentController@addappointmentSetting')->middleware('add_appointment_setting_view');
      Route::post('/addappointmentsetting_action', 'AppointmentController@addappointmentSettingAction')->middleware('add_appointment_setting_view');
      Route::get('/editappointmentsetting/{id}', 'AppointmentController@editappointmentSetting')->middleware('edit_appointment_setting_view');
      Route::post('/editappointmentsetting_action', 'AppointmentController@editappointmentSettingAction')->middleware('edit_appointment_setting_view');
      Route::post('/delete_appointment_setting', 'AppointmentController@deleteappointmentSetting')->middleware('delete_appointment_setting_view');
      Route::get('/appointment_setting_filter', 'AppointmentController@appointmentSettingFilter')->middleware('appointment_setting_view');
      Route::get('/appointment_services', 'AppointmentController@appointmentServices')->middleware('appointment_setting_view');
      Route::get('/appointment_staffs', 'AppointmentController@appointmentStaffs')->middleware('appointment_setting_view');
      Route::get('/add_appointment_services', 'AppointmentController@addAppointmentServices')->middleware('appointment_setting_view');
      Route::post('/add_appointment_services_action', 'AppointmentController@addAppointmentServicesAction')->middleware('appointment_setting_view');
      Route::get('/edit_appointment_services/{id}', 'AppointmentController@editAppointmentServices')->middleware('appointment_setting_view');
      Route::post('/edit_appointment_services_action', 'AppointmentController@editAppointmentServicesAction')->middleware('appointment_setting_view');
      Route::post('/delete_appointment_services', 'AppointmentController@deleteAppointmentServices')->middleware('appointment_setting_view');
      Route::get('/filter_appointment_services', 'AppointmentController@filterAppointmentServices')->middleware('appointment_setting_view');
      Route::get('/add_appointment_staffs', 'AppointmentController@addAppointmentStaffs')->middleware('appointment_setting_view');
      Route::post('/add_appointment_staffs_action', 'AppointmentController@addAppointmentStaffsAction')->middleware('appointment_setting_view');
      Route::get('/edit_appointment_staffs/{id}', 'AppointmentController@editAppointmentStaffs')->middleware('appointment_setting_view');
      Route::post('/edit_appointment_staffs_action', 'AppointmentController@editAppointmentStaffsAction')->middleware('appointment_setting_view');
      Route::post('/delete_appointment_staffs', 'AppointmentController@deleteAppointmentStaffs')->middleware('appointment_setting_view');
      Route::get('/filter_appointment_staffs', 'AppointmentController@filterAppointmentStaffs')->middleware('appointment_setting_view');

      Route::get('/add_slot/{id}', 'AppointmentController@addSlot')->middleware('add_slot_view');
      Route::post('/add_slot_action', 'AppointmentController@addSlotAction')->middleware('add_slot_view');
      Route::get('/edit_slot/{id}', 'AppointmentController@editSlot')->middleware('edit_slot_view');
      Route::post('/edit_slot_action', 'AppointmentController@editSlotAction')->middleware('edit_slot_view');
      Route::post('/delete_slot', 'AppointmentController@deleteSlot')->middleware('delete_slot_view');
      Route::get('/view_slot/{id}', 'AppointmentController@viewSlot')->middleware('slot_view');

      Route::post('/add_holiday_action', 'AppointmentController@addHolidayAction')->middleware('add_slot_view');
      Route::get('/edit_holiday/{id}', 'AppointmentController@editHoliday')->middleware('edit_holiday_view');
      Route::post('/edit_holiday_action', 'AppointmentController@editHolidayAction')->middleware('edit_holiday_view');
      Route::post('/delete_holiday', 'AppointmentController@deleteHoliday')->middleware('delete_holiday_view');

      Route::get('/outlet', 'AppointmentController@viewOutlet')->middleware('outlet_view');
      Route::get('/add_outlet', 'AppointmentController@addOutlet')->middleware('add_outlet_view');
      Route::post('/add_outlet_action', 'AppointmentController@addOutletAction')->middleware('add_outlet_view');
      Route::get('/edit_outlet/{id}', 'AppointmentController@editOutlet')->middleware('edit_outlet_view');
      Route::post('/edit_outlet_action', 'AppointmentController@editOutletAction')->middleware('edit_outlet_view');
      Route::post('/delete_outlet', 'AppointmentController@deleteOutlet')->middleware('delete_outlet_view');
      Route::get('/outlet_filter', 'AppointmentController@outletFilter')->middleware('outlet_view');


      Route::get('/add_appointment_status', 'AppointmentController@addAppointmentStatus')->middleware('add_appstatus_view');
      Route::post('/add_appointment_status_action', 'AppointmentController@addAppointmentStatusAction')->middleware('add_appstatus_view');
      Route::get('/edit_appointment_status/{id}', 'AppointmentController@editAppointmentStatus')->middleware('edit_appstatus_view');
      Route::post('/edit_appointment_status_action', 'AppointmentController@editAppointmentStatusAction')->middleware('edit_appstatus_view');
      Route::get('/appointment_status', 'AppointmentController@viewAppointmentStatus')->middleware('appstatus_view');
      Route::post('/change_appointment_status_action', 'AppointmentController@changeAppointmentStatusAction')->middleware('appstatus_view');
      Route::post('/change_bookingid', 'AppointmentController@changeBookingid')->middleware('appstatus_view');
      Route::get('/appinvoiceprint/{id}', 'AppointmentController@appInvoicePrint')->middleware('appstatus_view');
      Route::get('/appointment_report', 'AppointmentController@appointmentReport')->middleware('report');
      Route::get('/appointment-print', 'AppointmentController@appointmentPrint')->middleware('report');

    });


    Route::group(['prefix' => 'admin/table', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
            Route::get('/view', 'TableController@viewtable')->middleware('view_table');
            Route::get('/filter', 'TableController@filter')->middleware('view_table');
            Route::get('/add', 'TableController@addtable')->middleware('add_table');
            Route::post('/addNew', 'TableController@addNew')->middleware('add_table');
            Route::get('/edit/{id}', 'TableController@edittable')->middleware('update_table');
            Route::post('/update', 'TableController@update')->middleware('update_table');
            Route::post('/delete', 'TableController@deletetable')->middleware('delete_table');
            Route::get('/order', 'TableController@vieworder')->middleware('view_table');
            Route::get('/orderedit/{id}', 'TableController@orderedit')->middleware('view_table');
    });

    Route::group(['prefix' => 'admin/whychooseus', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/whychooseus', 'WhychooseusController@viewWhychooseus')->middleware('whychooseus_view');
        Route::get('/add_whychooseus', 'WhychooseusController@addWhychooseus')->middleware('add_whychooseus_view');
        Route::post('/add_whychooseus_action', 'WhychooseusController@addWhychooseusAction')->middleware('add_whychooseus_view');
        Route::get('/edit_whychooseus/{id}', 'WhychooseusController@editWhychooseus')->middleware('edit_whychooseus_view');
        Route::post('/edit_whychooseus_action', 'WhychooseusController@editWhychooseusAction')->middleware('edit_whychooseus_view');
        Route::post('/delete_whychooseus', 'WhychooseusController@deleteWhychooseus')->middleware('delete_whychooseus_view');
        Route::get('/whychooseus_filter', 'WhychooseusController@whychooseusFilter')->middleware('whychooseus_view');

        Route::get('/viewwhychooseusimage/{id}', 'WhychooseusController@viewWhychooseusImage')->middleware('whychooseusimage_view');
        Route::get('/add_whychooseusimage/{id}', 'WhychooseusController@addWhychooseusImage')->middleware('add_whychooseusimage_view');
        Route::post('/add_whychooseusimage_action', 'WhychooseusController@addWhychooseusImageAction')->middleware('add_whychooseusimage_view');
        Route::get('/edit_whychooseusimage/{id}', 'WhychooseusController@editWhychooseusImage')->middleware('edit_whychooseusimage_view');
        Route::post('/edit_whychooseusimage_action', 'WhychooseusController@editWhychooseusImageAction')->middleware('edit_whychooseusimage_view');
        Route::post('/delete_whychooseusimage', 'WhychooseusController@deleteWhychooseusImage')->middleware('delete_whychooseusimage_view');

    });


    Route::group(['prefix' => 'admin/gallery', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/view', 'GalleryController@viewGallery')->middleware('gallery_view');
        Route::get('/add_gallery', 'GalleryController@addGallery')->middleware('add_gallery_view');
        Route::post('/add_gallery_action', 'GalleryController@addGalleryAction')->middleware('add_gallery_view');
        Route::get('/edit_gallery/{id}', 'GalleryController@editGallery')->middleware('edit_gallery_view');
        Route::post('/edit_gallery_action', 'GalleryController@editGalleryAction')->middleware('edit_gallery_view');
        Route::post('/delete_gallery', 'GalleryController@deleteGallery')->middleware('delete_gallery_view');
        Route::get('/gallery_filter', 'GalleryController@galleryFilter')->middleware('gallery_view');

        Route::get('/viewgalleryimage/{id}', 'GalleryController@viewGalleryImage')->middleware('galleryimage_view');
        Route::get('/add_galleryimage/{id}', 'GalleryController@addGalleryImage')->middleware('add_galleryimage_view');
        Route::post('/add_galleryimage_action', 'GalleryController@addGalleryImageAction')->middleware('add_galleryimage_view');
        Route::get('/edit_galleryimage/{id}', 'GalleryController@editGalleryImage')->middleware('edit_galleryimage_view');
        Route::post('/edit_galleryimage_action', 'GalleryController@editGalleryImageAction')->middleware('edit_galleryimage_view');
        Route::post('/delete_galleryimage', 'GalleryController@deleteGalleryImage')->middleware('delete_galleryimage_view');

    });


Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
 //manageTableLabel
 Route::get('/listingTableLabels', 'TableLabelsController@listingTableLabels');
 Route::get('/addtablekey', 'TableLabelsController@addtablekey');
 Route::post('/addNewTableLabel', 'TableLabelsController@addNewTableLabel');
 Route::get('/editTableLabel/{id}', 'TableLabelsController@editTableLabel');
 Route::post('/updateTableLabel/', 'TableLabelsController@updateTableLabel');
 Route::get('/tablelabel', 'TableLabelsController@manageTableLabel');

});




});

        
