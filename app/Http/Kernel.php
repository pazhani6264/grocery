<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\Language::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],

		'vendor' => [
            'throttle:60,1',
            'bindings',
        ],

        'deliveryboy'=> [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
      'web_installed' => \App\Http\Middleware\web_installed::class,
      'env' => \App\Http\Middleware\env::class,
      'admin' => \App\Http\Middleware\RedirectIfNotAdmin::class,
      'Customer' => \App\Http\Middleware\RedirectIfNotCustomer::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'installer' => \App\Http\Middleware\Installation::class,
        'view_language' => \App\Http\Middleware\languages\view_language::class,
        'edit_language' => \App\Http\Middleware\languages\edit_language::class,
        'delete_language' => \App\Http\Middleware\languages\delete_language::class,
        'add_language' => \App\Http\Middleware\languages\add_language::class,
        'view_media' => \App\Http\Middleware\media\view_media::class,
        'edit_media' => \App\Http\Middleware\media\edit_media::class,
        'delete_media' => \App\Http\Middleware\media\delete_media::class,
        'add_media' => \App\Http\Middleware\media\add_media::class,
        'view_manufacturer' => \App\Http\Middleware\manufacturer\view_manufacturer::class,
        'edit_manufacturer' => \App\Http\Middleware\manufacturer\edit_manufacturer::class,
        'delete_manufacturer' => \App\Http\Middleware\manufacturer\delete_manufacturer::class,
        'add_manufacturer' => \App\Http\Middleware\manufacturer\add_manufacturer::class,
        'view_product' => \App\Http\Middleware\product\view_product::class,
        'edit_product' => \App\Http\Middleware\product\edit_product::class,
        'delete_product' => \App\Http\Middleware\product\delete_product::class,
        'add_product' => \App\Http\Middleware\product\add_product::class,
        'view_news' => \App\Http\Middleware\news\view_news::class,
        'edit_news' => \App\Http\Middleware\news\edit_news::class,
        'delete_news' => \App\Http\Middleware\news\delete_news::class,
        'add_news' => \App\Http\Middleware\news\add_news::class,
        'view_customer' => \App\Http\Middleware\customer\view_customer::class,
        'edit_customer' => \App\Http\Middleware\customer\edit_customer::class,
        'delete_customer' => \App\Http\Middleware\customer\delete_customer::class,
        'add_customer' => \App\Http\Middleware\customer\add_customer::class,
        'view_tax' => \App\Http\Middleware\tax\view_tax::class,
        'edit_tax' => \App\Http\Middleware\tax\edit_tax::class,
        'delete_tax' => \App\Http\Middleware\tax\delete_tax::class,
        'add_tax' => \App\Http\Middleware\tax\add_tax::class,
        'view_coupon' => \App\Http\Middleware\coupon\view_coupon::class,
        'edit_coupon' => \App\Http\Middleware\coupon\edit_coupon::class,
        'delete_coupon' => \App\Http\Middleware\coupon\delete_coupon::class,
        'add_coupon' => \App\Http\Middleware\coupon\add_coupon::class,
        'view_notification' => \App\Http\Middleware\notification\view_notification::class,
        'edit_notification' => \App\Http\Middleware\notification\edit_notification::class,
        'view_shipping' => \App\Http\Middleware\shipping\view_shipping::class,
        'edit_shipping' => \App\Http\Middleware\shipping\edit_shipping::class,
        'view_order' => \App\Http\Middleware\order\view_order::class,
        'edit_order' => \App\Http\Middleware\order\edit_order::class,
        'view_payment' => \App\Http\Middleware\payment\view_payment::class,
        'edit_payment' => \App\Http\Middleware\payment\edit_payment::class,
        'view_web_setting' => \App\Http\Middleware\web_setting\view_web_setting::class,
        'edit_web_setting' => \App\Http\Middleware\web_setting\edit_web_setting::class,
        'view_app_setting' => \App\Http\Middleware\app_setting\view_app_setting::class,
        'edit_app_setting' => \App\Http\Middleware\app_setting\edit_app_setting::class,
        'view_pos_setting' => \App\Http\Middleware\pos_setting\view_pos_setting::class,
        'edit_pos_setting' => \App\Http\Middleware\pos_setting\edit_pos_setting::class,
        'view_general_setting' => \App\Http\Middleware\general_setting\view_general_setting::class,
        'edit_general_setting' => \App\Http\Middleware\general_setting\edit_general_setting::class,
        'view_manage_admin' => \App\Http\Middleware\manage_admin\view_manage_admin::class,
        'edit_manage_admin' => \App\Http\Middleware\manage_admin\edit_manage_admin::class,
        'delete_manage_admin' => \App\Http\Middleware\manage_admin\delete_manage_admin::class,
        'add_manage_admin' => \App\Http\Middleware\manage_admin\add_manage_admin::class,
        'view_admin_type' => \App\Http\Middleware\admin_type\view_admin_type::class,
        'edit_admin_type' => \App\Http\Middleware\admin_type\edit_admin_type::class,
        'delete_admin_type' => \App\Http\Middleware\admin_type\delete_admin_type::class,
        'add_admin_type' => \App\Http\Middleware\admin_type\add_admin_type::class,
        'report' => \App\Http\Middleware\report\report::class,
        'dashboard' => \App\Http\Middleware\dashboard\dashboard::class,
        'manage_role' => \App\Http\Middleware\manage_role\manage_role::class,
        'view_vendor' => \App\Http\Middleware\vendors\view_vendor::class,
        'edit_vendor' => \App\Http\Middleware\vendors\edit_vendor::class,
        'delete_vendor' => \App\Http\Middleware\vendors\delete_vendor::class,
        'add_vendor' => \App\Http\Middleware\vendors\add_vendor::class,
       
        'edit_management' => \App\Http\Middleware\management\edit_management::class,
        'application_routes' => \App\Http\Middleware\app_setting\application_routes::class,
        'pos_routes' => \App\Http\Middleware\pos_setting\pos_routes::class,
        'website_routes' => \App\Http\Middleware\web_setting\website_routes::class,

        'view_categories' => \App\Http\Middleware\categories\view_categories::class,
        'edit_categories' => \App\Http\Middleware\categories\edit_categories::class,
        'delete_categories' => \App\Http\Middleware\categories\delete_categories::class,
        'add_categories' => \App\Http\Middleware\categories\add_categories::class,
        'view_reviews' => \App\Http\Middleware\reviews\view_reviews::class,
        'edit_reviews' => \App\Http\Middleware\reviews\edit_reviews::class,

        'view_deliveryboy' => \App\Http\Middleware\deliveryboy\view_deliveryboy::class,
        'add_deliveryboy' => \App\Http\Middleware\deliveryboy\add_deliveryboy::class,
        'edit_deliveryboy' => \App\Http\Middleware\deliveryboy\edit_deliveryboy::class,
        'delete_deliveryboy' => \App\Http\Middleware\deliveryboy\delete_deliveryboy::class,

        'view_finance' => \App\Http\Middleware\finance\view_finance::class,
        
        'view_loyalty' => \App\Http\Middleware\loyalty\view_loyalty::class,
        'add_loyalty' => \App\Http\Middleware\loyalty\add_loyalty::class,
        'edit_loyalty' => \App\Http\Middleware\loyalty\edit_loyalty::class,
        'delete_loyalty' => \App\Http\Middleware\loyalty\delete_loyalty::class,

        'view_collection' => \App\Http\Middleware\collection\view_collection::class,
        'add_collection' => \App\Http\Middleware\collection\add_collection::class,
        'edit_collection' => \App\Http\Middleware\collection\edit_collection::class,
        'delete_collection' => \App\Http\Middleware\collection\delete_collection::class,

        'view_newsletter' => \App\Http\Middleware\newsletter\view_newsletter::class,
        'add_newsletter' => \App\Http\Middleware\newsletter\add_newsletter::class,
        'edit_newsletter' => \App\Http\Middleware\newsletter\edit_newsletter::class,
        'delete_newsletter' => \App\Http\Middleware\newsletter\delete_newsletter::class,

        'view_shoppinginfo' => \App\Http\Middleware\shoppinginfo\view_shoppinginfo::class,
        'add_shoppinginfo' => \App\Http\Middleware\shoppinginfo\add_shoppinginfo::class,
        'edit_shoppinginfo' => \App\Http\Middleware\shoppinginfo\edit_shoppinginfo::class,
        'delete_shoppinginfo' => \App\Http\Middleware\shoppinginfo\delete_shoppinginfo::class,

        'add_ticket' => \App\Http\Middleware\ticket\add_ticket::class,
        'delete_ticket' => \App\Http\Middleware\ticket\delete_ticket::class,
        'edit_ticket' => \App\Http\Middleware\ticket\edit_ticket::class,
        'view_ticket' => \App\Http\Middleware\ticket\view_ticket::class,
        'wallet_view' => \App\Http\Middleware\wallet\wallet_view::class,

        'add_table' => \App\Http\Middleware\table\add_table::class,
        'delete_table' => \App\Http\Middleware\table\delete_table::class,
        'update_table' => \App\Http\Middleware\table\update_table::class,
        'view_table' => \App\Http\Middleware\table\view_table::class,

        'appointment_view' => \App\Http\Middleware\appointment\appointment_view::class,
        'appointment_setting_view' => \App\Http\Middleware\appointment\appointment_setting_view::class,
        'add_appointment_setting_view' => \App\Http\Middleware\appointment\add_appointment_setting_view::class,
        'edit_appointment_setting_view' => \App\Http\Middleware\appointment\edit_appointment_setting_view::class,
        'delete_appointment_setting_view' => \App\Http\Middleware\appointment\delete_appointment_setting_view::class,

        'outlet_view' => \App\Http\Middleware\appointment\outlet_view::class,
        'add_outlet_view' => \App\Http\Middleware\appointment\add_outlet_view::class,
        'edit_outlet_view' => \App\Http\Middleware\appointment\edit_outlet_view::class,
        'delete_outlet_view' => \App\Http\Middleware\appointment\delete_outlet_view::class,

        'slot_view' => \App\Http\Middleware\appointment\slot_view::class,
        'add_slot_view' => \App\Http\Middleware\appointment\add_slot_view::class,
        'edit_slot_view' => \App\Http\Middleware\appointment\edit_slot_view::class,
        'delete_slot_view' => \App\Http\Middleware\appointment\delete_slot_view::class,

        'edit_holiday_view' => \App\Http\Middleware\appointment\edit_holiday_view::class,
        'delete_holiday_view' => \App\Http\Middleware\appointment\delete_holiday_view::class,

        'appstatus_view' => \App\Http\Middleware\appointment\appstatus_view::class,
        'add_appstatus_view' => \App\Http\Middleware\appointment\add_appstatus_view::class,
        'edit_appstatus_view' => \App\Http\Middleware\appointment\edit_appstatus_view::class,
        'delete_appstatus_view' => \App\Http\Middleware\appointment\delete_appstatus_view::class,

        'qrcode_expired'=>\App\Http\Middleware\QrcodeExpired::class,


        'whychooseus_view' => \App\Http\Middleware\whychooseus\whychooseus_view::class,
        'add_whychooseus_view' => \App\Http\Middleware\whychooseus\add_whychooseus_view::class,
        'edit_whychooseus_view' => \App\Http\Middleware\whychooseus\edit_whychooseus_view::class,
        'delete_whychooseus_view' => \App\Http\Middleware\whychooseus\delete_whychooseus_view::class,

        'whychooseusimage_view' => \App\Http\Middleware\whychooseus\whychooseusimage_view::class,
        'add_whychooseusimage_view' => \App\Http\Middleware\whychooseus\add_whychooseusimage_view::class,
        'edit_whychooseusimage_view' => \App\Http\Middleware\whychooseus\edit_whychooseusimage_view::class,
        'delete_whychooseusimage_view' => \App\Http\Middleware\whychooseus\delete_whychooseusimage_view::class,

        'gallery_view' => \App\Http\Middleware\gallery\gallery_view::class,
        'add_gallery_view' => \App\Http\Middleware\gallery\add_gallery_view::class,
        'edit_gallery_view' => \App\Http\Middleware\gallery\edit_gallery_view::class,
        'delete_gallery_view' => \App\Http\Middleware\gallery\delete_gallery_view::class,

        'galleryimage_view' => \App\Http\Middleware\gallery\galleryimage_view::class,
        'add_galleryimage_view' => \App\Http\Middleware\gallery\add_galleryimage_view::class,
        'edit_galleryimage_view' => \App\Http\Middleware\gallery\edit_galleryimage_view::class,
        'delete_galleryimage_view' => \App\Http\Middleware\gallery\delete_galleryimage_view::class,

        'profile_view' => \App\Http\Middleware\profile\profile_view::class,
        'profile_update' => \App\Http\Middleware\profile\profile_update::class,

        'stock_movement_view' => \App\Http\Middleware\inventory\stock_movement_view::class,
        'stockin_view' => \App\Http\Middleware\inventory\stockin_view::class,
        'stockout_view' => \App\Http\Middleware\inventory\stockout_view::class,
        'adjuststock_view' => \App\Http\Middleware\inventory\adjuststock_view::class,
        'checkctock_view' => \App\Http\Middleware\inventory\checkctock_view::class,
        'stockin_add' => \App\Http\Middleware\inventory\stockin_add::class,
        'stockout_add' => \App\Http\Middleware\inventory\stockout_add::class,
        'adjuststock_add' => \App\Http\Middleware\inventory\adjuststock_add::class,
        'vendor_add' => \App\Http\Middleware\inventory\vendor_add::class,
        'vendor_edit' => \App\Http\Middleware\inventory\vendor_edit::class,
        'vendor_delete' => \App\Http\Middleware\inventory\vendor_delete::class,
        'vendor_view' => \App\Http\Middleware\inventory\vendor_view::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given general_setting.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
