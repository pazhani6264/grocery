<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Superadmin;
use App\Models\Core\Images;
use App\Models\Core\Language;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SiteSettingController extends Controller
{
    public function __construct()
    {
        $setting = new Setting();
        $this->Setting = $setting;

        $superadmin = new Superadmin();
        $this->Superadmin = $superadmin;

    }

    public function commonsetting()
    {
        $result = array('pagination' => '20');
        return $result;
    }

    public function getSetting()
    {

        $setting = $this->Setting->getSettings();
        return $setting;
    }

    public function imageType()
    {
        $extensions = array('gif', 'jpg', 'jpeg', 'png');
        return $extensions;
    }

    public function getlanguages()
    {

        $languages = $this->Setting->fetchLanguages();
        return $languages;
    }

    //units page
    public function getUnits()
    {

        $units = $this->Setting->Units();
        return $units;
    }
//alert Setting
    public function getAlertSetting()
    {
        $setting = $this->Setting->alterSetting();
        return $setting;
    }

// slugify method
    public function slugify($slug)
    {
        //header('Content-Type: text/html; charset=utf-8');
        // replace non letter or digits by -
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

        // transliterate
        if (function_exists('iconv')) {
            $slug = iconv('utf-8', 'us-ascii//IGNORE', $slug);
        }

        // remove unwanted characters
        $slug = preg_replace('~[^-\w]+~', '', $slug);

        // trim
        $slug = trim($slug, '-');

        // remove duplicate -
        $slug = preg_replace('~-+~', '-', $slug);

        // lowercase
        $slug = strtolower($slug);

        if (empty($slug)) {
            return 'n-a';
        }

        return $slug;
    }

    //getsinglelanguages
    public function getSingleLanguages($language_id)
    {

        $languagesClass = new Language();

        $languages = $languagesClass->getSingleLan();
        return $languages;
    }
// sku create
    public function SKU_gen($pname, $cat, $brand, $id, $l = 3){
            $results = ''; // empty string
            //print_r($pname);die();

            $arr = explode(" ", $pname);
            $str1 = array_shift($arr);
            $str1 = strtoupper(substr($str1, 0, $l));

            $arr1 = explode(" ", $cat);
            $str2 = array_shift($arr1);
            $str2 = strtoupper(substr($str2, 0, $l));

            $arr2 = explode(" ", $brand);
            $str3 = array_shift($arr2);
            $str3 = strtoupper(substr($str3, 0, $l));

            $id = str_pad($id , 5, 0, STR_PAD_LEFT);

            $results .= "{$str1}-{$str2}{$str3}{$id}";
            return $results;
}
    //setting page
    public function setting(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->getallsetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.setting", $title)->with('result', $result);
    }

    //update setting
    public function updateSetting(Request $request)
    {

        $languages = $this->getLanguages();
        $extensions = $this->imageType();
        foreach ($request->all() as $key => $value) {

            if ($key == 'newsletter_image') {
                if( $request->newsletter_image !== null){
                    $allimagesth = DB::table('images')
                        ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
                        ->select('path', 'images.id', 'image_type')
                        ->where('image_categories.image_type', 'ACTUAL')
                        ->where('image_categories.image_id', $request->newsletter_image)
                        ->first();
                        $value = $allimagesth->path;
                        $this->Setting->settingUpdate($key, $value);
                }
                
            }
            //website logo
            elseif ($key == 'website_logo') {
                if( $request->website_logo !== null){
                    $allimagesth = DB::table('images')
                        ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
                        ->select('path', 'images.id', 'image_type')
                        ->where('image_categories.image_type', 'ACTUAL')
                        ->where('image_categories.image_id', $request->website_logo)
                        ->first();
                        $value = $allimagesth->path;
                        $this->Setting->settingUpdate($key, $value);
                }
                
            }
            elseif ($key == 'footer_logo') {
                if( $request->footer_logo !== null){
                    $allimagesth = DB::table('images')
                        ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
                        ->select('path', 'images.id', 'image_type')
                        ->where('image_categories.image_type', 'ACTUAL')
                        ->where('image_categories.image_id', $request->footer_logo)
                        ->first();
                        $value = $allimagesth->path;
                        $this->Setting->settingUpdate($key, $value);
                }
                
            }else{

                if ($key == 'favicon') {
                    if( $request->favicon !== null){
                        $allimagesth = DB::table('images')
                            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
                            ->select('path', 'images.id', 'image_type')
                            ->where('image_categories.image_type', 'ACTUAL')
                            ->where('image_categories.image_id', $request->favicon)
                            ->first();
                            $value = $allimagesth->path;
                            $this->Setting->settingUpdate($key, $value);
                    }
                    
                }else{
                    $this->Setting->settingUpdate($key, $value);
                }


                if ($key == 'shop_open') {
                    if($request->shop_open == 2){

                        $startHour = date('H:i',strtotime($request->start_hour));
                        $endHour = date('H:i',strtotime($request->end_hour));

                        //if($startHour > $endHour){
                            //return redirect()->back()->with('error','End Date grater than Start Date');
                          //} else {
                            $value = $startHour.' - '.$endHour;
                            $updateSetting = DB::table('settings')->where('name', '=', 'order_open_time')->update([
                                'value' => addslashes($value),
                                'updated_at' => date('Y-m-d h:i:s'),
                            ]);
                        //}
                        
                        if($key == 'shop_open'){
                            $value = 2;
                            $this->Setting->settingUpdate($key, $value);
                        }
                    } 
                    
                    if($request->shop_open == 1){

                        $value = null;
                        $updateSetting = DB::table('settings')->where('name', '=', 'order_open_time')->update([
                            'value' => addslashes($value),
                            'updated_at' => date('Y-m-d h:i:s'),
                        ]);

                        if($key == 'shop_open'){
                            $value = 1;
                            $this->Setting->settingUpdate($key, $value);
                        }
                    }
                } 


            }

           

            
        }

        $message = Lang::get("labels.SettingUpdateMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //webSettings
    public function websettings(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.websetting", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function deliveryboysetting(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.app.deliveryboysetting", $title)->with('result', $result)->with('allimage', $allimage);

    }
    
    public function newsletter(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.newsletter", $title)->with('result', $result)->with('allimage', $allimage);

    }


    public function emailsetting(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.email.emailsetting", $title)->with('result', $result)->with('allimage', $allimage);

    }

  

    public function newuser(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.email.newuser", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function subscription(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.email.subscription", $title)->with('result', $result)->with('allimage', $allimage);

    }



    

    //appSettings
    public function appSettings(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.application_settings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.app.appSettings", $title)->with('result', $result);
    }

    //posSettings
    public function posSettings(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.pos_settings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.app.posSettings", $title)->with('result', $result);
    }

       //qrordersettings
       public function qrordersettings(Request $request)
       {
           $title = array('pageTitle' => 'qrsetting');
           $result = array();
           $settings = $this->Setting->getallsetting();
           $result['settings'] = $settings->unique('id')->keyBy('id');
           $result['commonContent'] = $this->Setting->commonContent();
           return view("admin.settings.qr.qrSettings", $title)->with('result', $result);
       }

    //admobSettings
    public function admobSettings(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.admobSettings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.app.admobSettings", $title)->with('result', $result);
    }

    //facebookSettings
    public function facebookSettings(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.facebook_settings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $facebookupdate = $this->Superadmin->facebookPendingUpdate();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.facebookSettings", $title)->with('result', $result);
    }

    //googleSettings
    public function googleSettings(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.google_settings"));

        $result = array();

        $settings = $this->Setting->getallsetting();
        $googleupdate = $this->Superadmin->googlePendingUpdate();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.googleSettings", $title)->with('result', $result);
    }


     //instagramSettings
     public function instagramSettings(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.google_settings"));
 
         $result = array();
 
         $settings = $this->Setting->getallsetting();
 
         $result['settings'] = $settings->unique('id')->keyBy('id');
         $result['commonContent'] = $this->Setting->commonContent();
 
         return view("admin.settings.general.instagramSettings", $title)->with('result', $result);
     }
 

    //applicationApi
    public function applicationApi(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.applicationApi"));

        $result = array();

        $settings = $this->Setting->getallsetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.app.applicationApi", $title)->with('result', $result);
    }

    //websiteThemes
    public function webthemes(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.themes setting"));
        $result = array();
        $setting = $this->Setting->getallsetting();
        $result['settings'] = $setting->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.webthemes", $title)->with('result', $result);
    }

    //seo
    public function seo(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.SEO Content"));

        $result = array();

        $settings = $this->Setting->getallsetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.seo", $title)->with('result', $result);
    }

    //customstyle
    public function customstyle(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.custom_style/js"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.customstyle", $title)->with('result', $result);

    }

    //update Website Theme
    public function updateWebTheme(Request $request)
    {

        $chkAlreadyApplied = $this->Setting->chkalreadyApplied($request);

        if (count($chkAlreadyApplied) == 0) {
            $setting = $this->Setting->appliedsetting($request);
            print 'success';
        } else {
            print 'already';
        }
    }

    //generateKey
    public function generateKey(Request $request)
    {
        $result = array();
        $result['consumerKey'] = $this->getKey();
        $result['consumerSecret'] = $this->getKey();

        $this->Setting->appkey($result);

        $this->Setting->consumersecret($result);

        return $result;
    }

    public function getKey()
    {
        $start = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        $middle = time();
        $end = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $start . $middle . $end;
    }

    //Units
    public function units(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ListingUnits"));

        $result = array();

        $units = $this->Setting->fetchunit();

        $result['units'] = $units;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.units.index", $title)->with('result', $result);
    }

    //addunit
    public function addunit(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddUnit"));
        $result = array();
        $languages = $this->Setting->fetchLanguages();
        $result['languages'] = $languages;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.units.add", $title)->with('result', $result);
    }

    //addnewunit
    public function addnewunit(Request $request)
    {
        $unitId = $this->Setting->fetchUnitid($request);
        $languages = $this->Setting->fetchLanguages();

        foreach ($languages as $languages_data) {
            $OrdersStatus = 'UnitName_' . $languages_data->languages_id;
            $language_id = $languages_data->languages_id;
            $req_OrdersStatus = $request->$OrdersStatus;

            $statusedec_id = $this->Setting->insetunit_desc($req_OrdersStatus, $unitId, $language_id);

        }

        $message = Lang::get("labels.UnitAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //editunit
    public function editunit(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditUnit"));
        $result = array();
        $languages = $this->Setting->fetchLanguages();
        $result = $this->Setting->editunit($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.units.edit", $title)->with('result', $result);
    }

    //updateunit
    public function updateunit(Request $request)
    {
        $orders_status = $this->Setting->updateunit($request);

        $languages = $this->Setting->fetchLanguages();
        foreach ($languages as $languages_data) {
            $OrdersStatus = 'UnitName_' . $languages_data->languages_id;
            $language_id = $languages_data->languages_id;
            $req_OrdersStatus = $request->$OrdersStatus;
            $check = $this->Setting->existUnit($request->id, $language_id);
            if ($check) {
                $this->Setting->updateunit_des($req_OrdersStatus, $request, $language_id);
            } else {
                $this->Setting->insetunit_desc($req_OrdersStatus, $request->id, $language_id);
            }

        }

        $message = Lang::get("labels.UnitUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //deleteunit
    public function deleteunit(Request $request)
    {
        $this->Setting->deleteunits($request);
        return redirect()->back()->withErrors([Lang::get("labels.UnitDeletedMessage")]);
    }

    //pushNotification
    public function pushNotification(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.pushNotification"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.pushNotification", $title)->with('result', $result);
    }

    //setting page
    public function alertSetting(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.alertSetting"));
        $result = array();
        $setting = $this->Setting->alterSetting();
        $result['setting'] = $setting;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.general.alertSetting", $title)->with('result', $result);
    }

    //alertSetting
    public function updateAlertSetting(Request $request)
    {
        $orders_status = $this->Setting->orderstatus($request);
        $message = Lang::get("labels.alertSettingUpdateMessage");
        return redirect()->back()->withErrors([$message]);
    }

    public function orderstatus(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingOrderStatus"));
        $result = array();
        $orders_status = $this->Setting->orderstatuses();
        $result['orders_status'] = $orders_status;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.Orders.orderstatus", $title)->with('result', $result);
    }

    public function editorderstatus(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditOrderStatus"));
        $result = array();
        $result = $this->Setting->editorderstatus($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.Orders.editorderstatus", $title)->with('result', $result);
    }

    public function updateOrderStatus(Request $request)
    {
        $languages = $this->getlanguages();
        if ($request->public_flag == 1) {
            $orders_status = $this->Setting->updateflagestatus($request);
        }

        $orders_status = $this->Setting->updateflag($request);

        foreach ($languages as $languages_data) {
            //dd($request->all());

            $OrdersStatus = 'OrdersStatus_' . $languages_data->languages_id;
            $language_id = $languages_data->languages_id;
            $req_OrdersStatus = $request->$OrdersStatus;

            //check if exist record
            $check = $this->Setting->existOrderStatus($request->id, $language_id);
            if ($check) {
                $this->Setting->updateorderstatus($request, $language_id, $req_OrdersStatus);
            } else {
                // dd($request->id, $req_OrdersStatus, $language_id);
                $this->Setting->orderstatusadd($request->id, $req_OrdersStatus, $language_id);
            }
        }

        $message = Lang::get("labels.OrderStatusUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    public function deleteOrderStatus(Request $request)
    {
        $this->Setting->deleteorderstatus($request);
        return redirect()->back()->withErrors([Lang::get("labels.OrderStatusDeletedMessage")]);
    }

    //addorderstatus
    public function addorderstatus(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddOrderStatus"));
        $result = array();

        $languages = $this->Setting->fetchLanguages();
        $result['languages'] = $languages;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.Orders.addorderstatus", $title)->with('result', $result);
    }

    //addNewOrderStatus
    public function addNewOrderStatus(Request $request)
    {

        $languagesdata = $this->getlanguages();

        //total records
        $orders_status = $this->Setting->addneworder();
        $orders_status_id = $orders_status->orders_status_id + 1;
        $role_id = $request->role_id;

        if ($request->public_flag == 1) {
            $languages = $this->Setting->addflagorderstatus();
        }

        $statuse_id = $this->Setting->getorderstatusid($orders_status_id, $request);

        foreach ($languagesdata as $languages_data) {
            $OrdersStatus = 'OrdersStatus_' . $languages_data->languages_id;
            $language_id = $languages_data->languages_id;
            $req_OrdersStatus = $request->$OrdersStatus;
            $statusedec_id = $this->Setting->orderstatusadd($statuse_id, $req_OrdersStatus, $language_id);
        }

        $message = Lang::get("labels.OrderStatusAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    public function instafeed(Request $request)
    {
        $images = new Images;
        $title = array('pageTitle' => Lang::get("labels.instagramfeed"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.instafeed", $title)->with('result', $result);
    }

    public function firebase(Request $request)
    {
        $images = new Images;
        $title = array('pageTitle' => Lang::get("labels.instagramfeed"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.firebase", $title)->with('result', $result);
    }

    public function loginsetting(Request $request)
    {
        $images = new Images;
        $title = array('pageTitle' => Lang::get("labels.Login Setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.loginsetting", $title)->with('result', $result);
    }

    public function geoFencing(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.geo-fencing"));
      $result = array();
      $geo = $this->Setting->view_geo_fencing();
      //print_r($geo);die();
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.settings.general.geo.index", $title)->with('result', $result)->with('geo', $geo);  
    }
    public function addgeoFencing(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.geo-fencing"));
      $result = array();
      $customerData = array();
      $customerData['countries'] = $this->Setting->countries();
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.settings.general.geo.add", $title)->with('result', $result)->with('data', $customerData);
    }

    public function addGeoFencingaction(Request $request)
    {
         $this->Setting->insert_geo_fencing($request);
        $message = Lang::get("labels.GeoAddedMessage");
        //return redirect()->back()->with('message', $message);
        return redirect()->back()->withErrors([$message]);
    }
    public function editgeoFencing($id)
    {
      $title = array('pageTitle' => Lang::get("labels.geo-fencing"));
      $result = array();
      $customerData = array();
      $geo = $this->Setting->get_geo_fencing($id);
      $customerData['countries'] = $this->Setting->countries();
      $customerData['state'] = $this->Setting->state();
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.settings.general.geo.edit", $title)->with('result', $result)->with('data', $customerData)->with('geo', $geo);
    }
    public function editGeoFencingaction(Request $request)
    {
        $this->Setting->edit_geo_fencing($request);
        $message = Lang::get("labels.GeoAddedMessage");
        //return redirect()->back()->with('message', $message);
        return redirect()->back()->withErrors([$message]);
    }
    public function GeoFencingdelete(Request $request)
    {
      $deletegeo = $this->Setting->delete_geo_fencing($request);
      $message = Lang::get("labels.GeoDeleteMessage");
      return redirect()->back()->withErrors([$message]);
    }
    public function geoFilter(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.geo-fencing"));
      $result = array();
      $geo = $this->Setting->geoFilter($request);
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.settings.general.geo.index", $title)->with('result', $result)->with('geo', $geo)->with(['name'=> $request->FilterBy, 'param'=> $request->parameter]);
    }
    public function SetCancelStatus(Request $request)
    {
        $result = $this->Setting->SetCancelStatus($request);
    }












    public function emailsettingDeveloper(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.email.emailsetting_developer", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function settingDeveloper(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->getallsetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.setting_developer", $title)->with('result', $result);
    }

    public function firebaseDeveloper(Request $request)
    {
        $images = new Images;
        $title = array('pageTitle' => Lang::get("labels.instagramfeed"));

        $result = array();

        $settings = $this->Setting->websetting();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.general.firebase_developer", $title)->with('result', $result);
    }

    
    //update setting
    public function updatesubscribeSetting(Request $request)
    {
       if($request->website_logo !== null){
           $img = $request->website_logo;
       }
       else
       {
           $img = $request->oldImage;
       }
       $updaate=DB::table('home_subscribe')->where('subscribe_id', '=', '1')->update([
           'subscribe_title' => $request->title,
           'subscribe_description' => $request->desc,
           'subscribe_image_id' => $img,
       ]);
        $message = 'Subscription setting updated successfully';
        return redirect()->back()->withErrors([$message]);
    }

    public function subscribe(Request $request)
    {

        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.setting"));

        $result = array();

        $settings = $this->Setting->websetting();

        $subscribe = DB::table('home_subscribe')
       ->leftJoin('image_categories', 'home_subscribe.subscribe_image_id', 'image_categories.image_id')
       ->select('home_subscribe.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
       ->where('image_type', 'ACTUAL')
       ->first();

        $result['settings'] = $settings->unique('id')->keyBy('id');
        $result['commonContent'] = $this->Setting->commonContent();
        $result['subscribe'] = $subscribe;

        return view("admin.theme.subscribe", $title)->with('result', $result)->with('allimage', $allimage);

    }



     //update setting
     public function updatenewdealSetting(Request $request)
     {
        if($request->website_logo !== null){
            $img = $request->website_logo;
        }
        else
        {
            $img = $request->oldImage;
        }
        $updaate=DB::table('new_deal')->where('new_deal_id', '=', '1')->update([
            'new_deal_title' => $request->title,
            'new_deal_description' => $request->desc,
            'new_deal_image_id' => $img,
            'new_deal_button_name' => $request->button_name,
        ]);
         $message = 'New Deal setting updated successfully';
         return redirect()->back()->withErrors([$message]);
     }
 
     public function newdeal(Request $request)
     {
 
         $images = new Images;
         $allimage = $images->getimages();
         $title = array('pageTitle' => Lang::get("labels.setting"));
 
         $result = array();
 
         $settings = $this->Setting->websetting();
 
         $newdeal_data = DB::table('new_deal')
        ->leftJoin('image_categories', 'new_deal.new_deal_image_id', 'image_categories.image_id')
        ->select('new_deal.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
        ->first();
 
         $result['settings'] = $settings->unique('id')->keyBy('id');
         $result['commonContent'] = $this->Setting->commonContent();
         $result['newdeal_data'] = $newdeal_data;
 
         return view("admin.theme.newdeal", $title)->with('result', $result)->with('allimage', $allimage);
 
     }


    public function cashierrole(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.pos_settings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['cashier']=$this->Setting->getCashier();
        return view("admin.settings.app.cashierrole", $title)->with('result', $result);
    }
    public function cashierroleupdate($id)
    {
        $title = array('pageTitle' => Lang::get("labels.pos_settings"));
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['user_types_id'] = $id;
        $adminType = DB::table('users')->where('id',$id)->get();
        $result['adminType'] = $adminType;
        $roles = DB::table('cashier_manage_role')->where('cashier_id','=', $id)->get();
        if(count($roles)>0){
            $product_management = $roles[0]->product_management;
            $bill_management = $roles[0]->bill_management;
            $cancel_bill = $roles[0]->cancel_bill;
            $inventory_management = $roles[0]->inventory_management;
            $dashboard_report = $roles[0]->dashboard_report;
            $customer = $roles[0]->customer;
            $settings = $roles[0]->settings;
            $drawer = $roles[0]->drawer;
            $user_cashier = $roles[0]->user_cashier;
            $net_profit = $roles[0]->net_profit;

            $create_stock_in = $roles[0]->create_stock_in;
            $edit_stock_in = $roles[0]->edit_stock_in;
            $create_stock_out = $roles[0]->create_stock_out;
            $edit_stock_out = $roles[0]->edit_stock_out;
            $create_adjust_stock = $roles[0]->create_adjust_stock;
        }else{
            $product_management = '0';
            $bill_management='0';
            $cancel_bill = '0';
            $inventory_management = '0';
            $dashboard_report = '0';
            $customer = '0';
            $settings = '0';
            $drawer = '0';
            $user_cashier = '0';
            $net_profit = '0';

            $create_stock_in = '0';
            $edit_stock_in = '0';
            $create_stock_out = '0';
            $edit_stock_out = '0';
            $create_adjust_stock = '0';
        }
        $result2[0]['link_name'] = 'Roles';
        $result2[0]['permissions'] = array(
                    '0'=>array('name'=>'product_management','value'=>$product_management),
                    '1'=>array('name'=>'bill_management','value'=>$bill_management),
                    '2'=>array('name'=>'cancel_bill','value'=>$cancel_bill),
                    '3'=>array('name'=>'inventory_management','value'=>$inventory_management),
                    '4'=>array('name'=>'dashboard_report','value'=>$dashboard_report),
                    '5'=>array('name'=>'customer','value'=>$customer),
                    '6'=>array('name'=>'settings','value'=>$settings),
                    '7'=>array('name'=>'drawer','value'=>$drawer),
                    '8'=>array('name'=>'user_cashier','value'=>$user_cashier),
                    '9'=>array('name'=>'net_profit','value'=>$net_profit)
                    );
        $result2[1]['link_name'] = 'Inventory Access';
        $result2[1]['permissions'] = array(
                    '0'=>array('name'=>'create_stock_in','value'=>$create_stock_in),
                    '1'=>array('name'=>'edit_stock_in','value'=>$edit_stock_in),
                    '2'=>array('name'=>'create_stock_out','value'=>$create_stock_out),
                    '3'=>array('name'=>'edit_stock_out','value'=>$edit_stock_out),
                    '4'=>array('name'=>'create_adjust_stock','value'=>$create_adjust_stock),
                    );
        $result['data'] = $result2;
        return view("admin.settings.app.updatecashierrole", $title)->with('result', $result);
    }
    public function addnewcashierroles(Request $request)
    {
        $user_types_id = $request->user_types_id;
        DB::table('cashier_manage_role')->where('cashier_id',$user_types_id)->delete();

        $roles = DB::table('cashier_manage_role')->where('cashier_id',$request->user_types_id)->insert([
                        'cashier_id'  =>   $request->user_types_id,
                        'product_management'=>$request->product_management,
                        'bill_management' => $request->bill_management,
                        'cancel_bill' => $request->cancel_bill,
                        'inventory_management' => $request->inventory_management,
                        'dashboard_report' => $request->dashboard_report,
                        'customer' => $request->customer,
                        'settings' => $request->settings,
                        'drawer' => $request->drawer,
                        'user_cashier' => $request->user_cashier,
                        'net_profit' => $request->net_profit,
                        'create_stock_in'=> $request->create_stock_in,
                        'edit_stock_in' => $request->edit_stock_in,
                        'create_stock_out' => $request->create_stock_out,
                        'edit_stock_out' => $request->edit_stock_out,
                        'create_adjust_stock' => $request->create_adjust_stock,
                        'created_at' => date('y-m-d h:i:s'),
                        'updated_at' => date('y-m-d h:i:s'),
                        ]);
        $message = Lang::get("labels.Roles has been added successfully");
        return redirect()->back()->with('message', $message);
    }

    public function posfastcash(Request $request)
    {
        $title = array('pageTitle' => "Pos Fast Cash");
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['cash']=$this->Setting->getposfastcash();
        return view("admin.settings.app.posfastcash", $title)->with('result', $result);
    }
    public function updateposfastcash(Request $request)
    {
        $cash = $this->Setting->getposfastcash();
        if(count($cash) > 0){
            foreach ($cash  as $jescash)
            {
                $amountName= 'fcash_'.$jescash->id;
                $amount=$request->$amountName;
                $updaate=DB::table('pos_fast_cash')->where('id', '=', $jescash->id)->update([
                    'fast_amount' => $amount
                ]);
            }
        }
        $message = "Fast cash has been added successfully";
        return redirect()->back()->with('message', $message);
    }
    public function pospayment(Request $request)
    {
        $title = array('pageTitle' => "Pos Payment Methods");
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['payment']=$this->Setting->getpospayment();
        return view("admin.settings.app.viewpospayment", $title)->with('result', $result);
    }
    public function addpospayment(Request $request)
    {
        $title = array('pageTitle' => "Add Pos Payment Methods");
        $images = new Images;
        $allimage = $images->getimages();
        $result = array();
        $result['languages'] = $this->Setting->fetchLanguages();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.app.addpospayment",$title)->with('result', $result)->with('allimage', $allimage);

    }
    public function insertpospayment(Request $request)
    {
        $date_added = date('y-m-d h:i:s');
        //get function from other controller
        $languages = $this->Setting->fetchLanguages();

        $uploadImage = $request->image_id;
        $uploadIcon  = $request->image_icone;
        $status  = $request->categories_status;
        $id = $this->Setting->insert_pos_payment($uploadImage,$date_added,$uploadIcon,$status);

        //multiple lanugauge with record
        foreach($languages as $languages_data){
            $methodName= 'methodName_'.$languages_data->languages_id;
            $name = $request->$methodName;
            $languages_data_id = $languages_data->languages_id;
            $subcatoger_des = $this->Setting->insertpaymentname($name,$id,$languages_data_id);
        }

        $message = "Payment methods added successfully";
        return redirect()->back()->withErrors([$message]);

    }
    public function pospaymentedit($id)
    {
       $title = array('pageTitle' => "Pos Payment Methods");
       $result = array();
       $images = new Images;
       $allimage = $images->getimages();
       $settings = $this->Setting->getallsetting();
       $result['commonContent'] = $this->Setting->commonContent();
       $result['languages'] = $this->Setting->fetchLanguages();
       $result['payment']=$this->Setting->edit_pospayment($id);

       $description_data = array();
       foreach($result['languages'] as $languages_data){
            $languages_id = $languages_data->languages_id;
            $description = $this->Setting->editpaymentname($languages_id,$id);
            if(count($description)>0){
                $description_data[$languages_data->languages_id]['name'] = $description[0]->name;
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            }else{
                $description_data[$languages_data->languages_id]['name'] = '';
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            }
       }
       $result['description'] = $description_data;
       //print_r($result['description']);die();
       return view("admin.settings.app.editpospayment",$title)->with('result', $result)->with('allimage', $allimage);
    }

    public function updatepospayment(Request $request)
    {
        $edit_id = $request->id;
        $status  = $request->categories_status;
        $last_modified  =   date('y-m-d h:i:s');

        //get function from other controller
        $languages = $this->Setting->fetchLanguages();

        if($request->image_id!==null){
            $uploadImage = $request->image_id;
         }else{
            $uploadImage = $request->oldImage;
         }

         if($request->image_icone !==null){
            $uploadIcon = $request->image_icone;
        }else{
            $uploadIcon = $request->oldIcon;
        }

         $updatePayment = $this->Setting->update_pos_payment($edit_id,$uploadImage,$uploadIcon,$last_modified,$status);

         foreach($languages as $languages_data){
            $name = 'methodName_'.$languages_data->languages_id;
            $payment_name = $request->$name;
            $checkExist = $this->Setting->checkExit($edit_id,$languages_data);
            if(count($checkExist)>0){
                $category_des_update = $this->Setting->updatedescription($payment_name,$languages_data,$edit_id);
            }else{
                $updat_des = $this->Setting->insertpaymentname($payment_name,$edit_id,$languages_data->languages_id);
            }
         }

         $message = "Payment methods updated successfully";
         return redirect()->back()->withErrors([$message]);
    }

    public function updateqrSetting(Request $request)
    {
        if($request->web_color_style == 'style')
        {
            $color_code = '#28B293';
        }
        if($request->web_color_style == 'style')
        {
            $color_code = '#28B293';
        }
        if($request->web_color_style == 'style.1')
        {
            $color_code = '#b7853f';
        }
        if($request->web_color_style == 'style.2')
        {
            $color_code = '#B3182A';
        }
        if($request->web_color_style == 'style.3')
        {
            $color_code = '#3E5902';
        }
        if($request->web_color_style == 'style.4')
        {
            $color_code = '#483A6F';
        }
        if($request->web_color_style == 'style.5')
        {
            $color_code = '#621529';
        }
        if($request->web_color_style == 'style.6')
        {
            $color_code = '#212529';
        }
        if($request->web_color_style == 'style.7')
        {
            $color_code = '#479af1';
        }
        if($request->web_color_style == 'style.8')
        {
            $color_code = '#e83e8c';
        }
        if($request->web_color_style == 'style.9')
        {
            $color_code = '#ff4c3b';
        }
        if($request->web_color_style == 'style.10')
        {
            $color_code = '#c99d7b';
        }
        if($request->web_color_style == 'style.11')
        {
            $color_code = '#866e6c';
        }
        if($request->web_color_style == 'style.12')
        {
            $color_code = '#dc457e';
        }
        if($request->web_color_style == 'style.13')
        {
            $color_code = '#6d7e87';
        }
        if($request->web_color_style == 'style.14')
        {
            $color_code = '#81ba00';
        }
        if($request->web_color_style == 'style.15')
        {
            $color_code = '#01effc';
        }
        if($request->web_color_style == 'style.16')
        {
            $color_code = '#5d7227';
        }
        if($request->web_color_style == 'style.17')
        {
            $color_code = '#5fcbc4';
        }
        if($request->web_color_style == 'style.18')
        {
            $color_code = '#e38888';
        }
        if($request->web_color_style == 'style.19')
        {
            $color_code = '#000000';
        }
        if($request->web_color_style == 'style.20')
        {
            $color_code = '#a6c76c';
        }
        if($request->web_color_style == 'style.21')
        {
            $color_code = '#c96';
        }
        if($request->web_color_style == 'style.22')
        {
            $color_code = '#fcb941';
        }
        if($request->web_color_style == 'style.23')
        {
            $color_code = '#39f';
        }
        if($request->web_color_style == 'style.24')
        {
            $color_code = '#c66';
        }
        if($request->web_color_style == 'style.25')
        {
            $color_code = '#8A6BAA';
        }
        if($request->web_color_style == 'style.26')
        {
            $color_code = '#eea287';
        }
        if($request->web_color_style == 'style.27')
        {
            $color_code = '#1cc0a0';
        }
        if($request->web_color_style == 'style.28')
        {
            $color_code = '#445f84';
        }
        if($request->web_color_style == 'style.29')
        {
            $color_code = '#fcb842';
        }
        if($request->web_color_style == 'style.30')
        {
            $color_code = '#66f';
        }
        if($request->web_color_style == 'style.31')
        {
            $color_code = '#61ab00';
        }
        if($request->web_color_style == 'style.32')
        {
            $color_code = '#fdda05';
        }
        if($request->web_color_style == 'style.33')
        {
            $color_code = '#f05970';
        }
        if($request->web_color_style == 'style.34')
        {
            $color_code = '#ffcc02';
        }

        DB::table('settings')->where('name', '=', 'qr_color_style')->update([
            'value' => $request->web_color_style,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        DB::table('settings')->where('name', '=', 'qr_color_code')->update([
            'value' => $color_code,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        $message = 'Color has been updated Successfully';
        return redirect()->back()->with('message', $message);
    }

    public function drawercate(Request $request)
    {
        $title = array('pageTitle' => "Drawer Category");
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['category']=$this->Setting->getdrawercate();
        return view("admin.settings.app.viewdrawercate", $title)->with('result', $result);
    }

    public function adddrawercate(Request $request)
    {
        $title = array('pageTitle' => "Add Drawer Category");
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.app.adddrawercate", $title)->with('result', $result);
    }
    public function insertdrawercate(Request $request)
    {
        $presult=$this->Setting->check_drawer_cate($request);
        if($presult=='0'){
           $id = $this->Setting->insert_drawer_cate($request); 
           $message = "Drawer category added successfully";
            return redirect()->back()->withErrors([$message]);
        }else{
            $message = "This drawer category already exists";
            return redirect()->back()->withErrors([$message]); 
        }
    }
    public function editdrawercate($id)
    {
        $title = array('pageTitle' => "Edit Drawer Category");
        $result = array();
        $settings = $this->Setting->getallsetting();
        $result['commonContent'] = $this->Setting->commonContent();
        $result['cate'] = $this->Setting->get_drawercate($id);
        return view("admin.settings.app.editdrawercate", $title)->with('result', $result); 
    }
    public function updatedrawercate(Request $request)
    {
        $allvals=$this->Setting->drawercate_already_check($request);
        if($allvals=='0'){
            $id = $this->Setting->update_drawer_cate($request); 
            $message = "Drawer category updated successfully";
            return redirect()->back()->withErrors([$message]);
        }else{
           $message = "This drawer category already exists";
           return redirect()->back()->withErrors([$message]);  
        }
    }
    public function deletedrawercate(Request $request)
    {
      $deletecategory = $this->Setting->deleterecord($request);
      $message = Lang::get("labels.CategoriesDeleteMessage");
      return redirect()->back()->withErrors([$message]);
    }

}
