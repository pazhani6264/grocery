<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Setting extends Model
{
    public static function imageType()
    {
        $extensions = array('gif', 'jpg', 'jpeg', 'png', 'octet-stream');
        return $extensions;
    }

    //
    public function getSettings()
    {
        $setting = DB::table('settings')->orderby('id', 'ASC')->get();
        return $setting;
    }
    public function fetchLanguages()
    {
        $language = DB::table('languages')->get();
        return $language;
    }
    public function Units()
    {

        $units = DB::table('units')
            ->leftJoin('units_descriptions', 'units_descriptions.unit_id', '=', 'units.unit_id')
            ->where('is_active', '1')
            ->where('languages_id', '1')
            ->get();
        return $units;
    }

    public function getunits($language_id)
    {

        $units = DB::table('units')
            ->leftJoin('units_descriptions', 'units_descriptions.unit_id', '=', 'units.unit_id')
            ->where('is_active', '1')
            ->where('languages_id', $language_id)
            ->get();
        return $units;
    }

    public function settingmedia($requeest)
    {
        $mediasetting_Th = DB::table('settings')->where('name', 'Thumbnail_height')
            ->update(['value' => $requeest->ThumbnailHeight]);

        $mediasetting_Tw = DB::table('settings')
            ->where('name', 'Thumbnail_width')
            ->update(['value' => $requeest->ThumbnailWidth]);
        $mediasetting_Mh = DB::table('settings')
            ->where('name', 'Medium_height')
            ->update(['value' => $requeest->MediumHeight]);
        $mediasetting_Mt = DB::table('settings')
            ->where('name', 'Medium_width')
            ->update(['value' => $requeest->MediumWidth]);
        $mediasetting_Lh = DB::table('settings')
            ->where('name', 'Large_height')
            ->update(['value' => $requeest->LargeHeight]);
        $mediasetting_Lw = DB::table('settings')
            ->where('name', 'Large_width')
            ->update(['value' => $requeest->LargeWidth]);
        return "success";

    }

    public function alterSetting()
    {

        $setting = DB::table('alert_settings')->get();

        return $setting;

    }

    public function settingUpdate($key, $value)
    {

        if ($key == 'environmentt') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            $servicePath = base_path('.env');
            $file = base_path('.env');
            $file_contents = file_get_contents($file);
            $fh = fopen($file, "w");
            $env = app()->environment();
            $file_contents = str_replace(
                "APP_ENV=$env", "APP_ENV=$value", $file_contents);
            fwrite($fh, $file_contents);
            fclose($fh);
            Artisan::call('cache:clear');
        }
        if ($key == 'facebook_app_id') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'client_id' => '$qurey->value',", "'client_id' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

            //*****/ Pazhani new /*******//

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newClientId = $value;
            $oldClientId = $qurey->value;
            $newFileContents = Str::replaceFirst($oldClientId, $newClientId, $fileContents);
            file_put_contents($filePath, $newFileContents);

        }
        if ($key == 'facebook_secret_id') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'client_secret' => '$qurey->value',", "'client_secret' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

            //*****/ Pazhani new /*******//

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newClientsecret = $value;
            $oldClientsecret = $qurey->value;
            $newFileContents = Str::replaceFirst($oldClientsecret, $newClientsecret, $fileContents);
            file_put_contents($filePath, $newFileContents);

        }
        if ($key == 'fb_redirect_url') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'redirect' => '$qurey->value',", "'redirect' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

             //*****/ Pazhani new /*******//

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $value;
            $oldredirect = $qurey->value;
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);

        }
        if ($key == 'google_client_id') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'client_id' => '$qurey->value',", "'client_id' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

            //*****/ Pazhani new /*******//

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newClientId = $value;
            $oldClientId = $qurey->value;
            $newFileContents = Str::replaceFirst($oldClientId, $newClientId, $fileContents);
            file_put_contents($filePath, $newFileContents);

        }
        if ($key == 'google_client_secret') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'client_secret' => '$qurey->value',", "'client_secret' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

            //*****/ Pazhani new /*******//

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newClientsecret = $value;
            $oldClientsecret = $qurey->value;
            $newFileContents = Str::replaceFirst($oldClientsecret, $newClientsecret, $fileContents);
            file_put_contents($filePath, $newFileContents);

        }
        if ($key == 'google_redirect_url') {
            $qurey = DB::table('settings')->where('name', $key)->first();
            // $servicePath = base_path('config/services.php');
            // $file = base_path('config/services.php');
            // $file_contents = file_get_contents($file);
            // $fh = fopen($file, "w");
            // $file_contents = str_replace(
            //     "'redirect' => '$qurey->value',", "'redirect' => '$value',", $file_contents);
            // fwrite($fh, $file_contents);
            // fclose($fh);

            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $value;
            $oldredirect = $qurey->value;
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);


        }

        if($key == 'wallet' && $value=='0'){
            $updatepayment=DB::table('payment_methods')->where('payment_methods_id', '=', '15')->update([
                'status' => '0',
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        }

        $updateSetting = DB::table('settings')->where('name', '=', $key)->update([
            'value' => addslashes($value),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        return $updateSetting;

    }

    public function websetting()
    {

        $settings = DB::table('settings')
            ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'settings.value')
            ->select('settings.*', 'categoryTable.path')
            ->orderBy('id')->get();

        return $settings;
    }

    public function getallsetting()
    {
        $settings = DB::table('settings')
            ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'settings.value')
            ->select('settings.*', 'categoryTable.path')
            ->orderBy('id')->get();
        return $settings;
    }

    public function chkalreadyApplied($request)
    {

        $chkAlreadyApplied = DB::table('settings')->where([['name', 'website_themes'], ['value', $request->theme_id]])->get();

        return $chkAlreadyApplied;

    }

    public function appliedsetting($request)
    {

        $setting = DB::table('settings')->where('name', 'website_themes')->update(['value' => $request->theme_id]);

        return $setting;

    }

    public function appkey($result)
    {

        $consumerKey = DB::table('settings')->where('name', '=', 'consumer_key')->update([
            'value' => $result['consumerKey'],
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        return $consumerKey;

    }

    public function consumersecret($result)
    {

        $consumersecrect = DB::table('settings')->where('name', '=', 'consumer_secret')->update([
            'value' => $result['consumerSecret'],
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        return $consumersecrect;

    }

    public function orderstatus($request)
    {

        $orders_status = DB::table('alert_settings')->where('alert_id', '=', $request->alert_id)->update([
            'create_customer_email' => $request->create_customer_email,
            'create_customer_notification' => $request->create_customer_notification,
            'order_status_email' => $request->order_status_email,
            'order_status_notification' => $request->order_status_notification,
            'new_product_email' => $request->new_product_email,
            'new_product_notification' => $request->new_product_notification,
            'forgot_email' => $request->forgot_email,
            'forgot_notification' => $request->forgot_notification,
            'contact_us_email' => $request->email_contact_us,
            'news_email' => $request->news_email,
            'news_notification' => $request->news_notification,
            'order_email' => $request->order_email,
            'order_notification' => $request->order_notification,
            'notify_email' => $request->notify_email,
            'subscribe_email' => $request->subscribe_email,
            'balance_point_email' => $request->balance_point_email,
        ]);

        return $orders_status;

    }

    public function orderstatuses()
    {
        $orders_status = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
            ->where('orders_status.role_id', '=', 2)
            ->orderby('role_id')
            ->paginate(60);
        return $orders_status;
    }

    public function existOrderStatus($status_id, $language_id)
    {
        $exist = DB::table('orders_status_description')
            ->where('language_id', '=', $language_id)
            ->where('orders_status_id', '=', $status_id)
            ->first();
        return $exist;
    }
    public function existUnit($id, $language_id)
    {
        $exist = DB::table('units_descriptions')
            ->where('languages_id', '=', $language_id)
            ->where('unit_id', '=', $id)
            ->first();
        return $exist;
    }

    public function orderStatusesByCustomers()
    {
        $orders_status = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
            ->where('role_id', '=', '1')
            ->get();
        return $orders_status;
    }

    public function orderStatusesByVendors()
    {
        $orders_status = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
            ->where('role_id', '=', '2')
            ->get();
        return $orders_status;
    }

    public function orderStatusesByDeliveryboys()
    {
        $orders_status = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
            ->where('role_id', '=', '3')
            ->get();
        return $orders_status;
    }

    public function editorderstatus($request)
    {

        $language_id = '1';
        $result = array();

        $result['languages'] = $this->fetchLanguages();
        $orders_status = DB::table('orders_status')->where('orders_status_id', $request->id)->first();
        $result['orders_status'] = $orders_status;
        $description_data = array();
        foreach ($result['languages'] as $languages_data) {
            $description = DB::table('orders_status_description')->where([
                ['language_id', '=', $languages_data->languages_id],
                ['orders_status_id', '=', $orders_status->orders_status_id],
            ])->get();

            if (count($description) > 0) {
                $description_data[$languages_data->languages_id]['orders_status_name'] = $description[0]->orders_status_name;
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            } else {
                $description_data[$languages_data->languages_id]['orders_status_name'] = '';
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            }
        }

        $result['description'] = $description_data;
        // dd($result);
        return $result;

    }

    public function updateflagestatus($request)
    {
        $orders_status = DB::table('orders_status')->where('public_flag', '=', 1)->where('orders_status_id', '=', $request->id)
            ->update([
                'public_flag' => 0,
            ]);
        return $orders_status;
    }

    public function updateflag($request)
    {
        $orders_status = DB::table('orders_status')->where('orders_status_id', '=', $request->id)->update([
            'public_flag' => $request->public_flag,
            'role_id' => $request->role_id,
        ]);
        return $orders_status;
    }

    public function updateorderstatus($request, $language_id, $req_OrdersStatus)
    {
        $orders_status = DB::table('orders_status_description')
            ->where('orders_status_id', '=', $request->id)
            ->where('language_id', '=', $language_id)
            ->update([
                'orders_status_name' => $req_OrdersStatus,
            ]);
        return $orders_status;
    }

    public function deleteorderstatus($request)
    {
        $deleteorderstatus = DB::table('orders_status')->where('orders_status_id', $request->id)->delete();
        return $deleteorderstatus;
    }

    public function addneworder()
    {
        $orders_status = DB::table('orders_status')->select('orders_status_id')->orderBy('orders_status_id', 'desc')->first();
        return $orders_status;
    }

    public function addflagorderstatus()
    {

        $orders_status = DB::table('orders_status')->where('public_flag', 1)->update([
            'public_flag' => 0,
        ]);

        return $orders_status;

    }

    public function getorderstatusid($orders_status_id, $request)
    {

        $statuse_id = DB::table('orders_status')->insertGetId([
            'orders_status_id' => $orders_status_id,
            'public_flag' => $request->public_flag,
            'role_id' => $request->role_id,
            'downloads_flag' => 0,
        ]);

        return $statuse_id;

    }

    public function orderstatusadd($statuse_id, $req_OrdersStatus, $language_id)
    {
        $statusedec_id = DB::table('orders_status_description')->insert([
            'orders_status_id' => $statuse_id,
            'orders_status_name' => $req_OrdersStatus,
            'language_id' => $language_id,
        ]);
        return $statusedec_id;
    }

    public function fetchunit()
    {

        $units = DB::table('units')
            ->LeftJoin('units_descriptions', 'units_descriptions.unit_id', '=', 'units.unit_id')
            ->where('units_descriptions.languages_id', '=', '1')
            ->paginate(60);

        return $units;

    }

    public function fetchUnitid($request)
    {

        $unitId = DB::table('units')->insertGetId([

            'is_active' => $request->is_active,
        ]);

        return $unitId;

    }

    public function insetunit_desc($req_OrdersStatus, $unitId, $language_id)
    {

        $statusedec_id = DB::table('units_descriptions')->insert([
            'units_name' => $req_OrdersStatus,
            'unit_id' => $unitId,
            'languages_id' => $language_id,

        ]);

        return $statusedec_id;

    }

    public function editunit($request)
    {

        $result = array();

        $result['languages'] = $this->fetchLanguages();
        $units = DB::table('units')->where('unit_id', $request->id)->first();
        $result['units'] = $units;
        $description_data = array();
        foreach ($result['languages'] as $languages_data) {
            $description = DB::table('units_descriptions')->where([
                ['languages_id', '=', $languages_data->languages_id],
                ['unit_id', '=', $request->id],
            ])->get();

            if (count($description) > 0) {
                $description_data[$languages_data->languages_id]['units_name'] = $description[0]->units_name;
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            } else {
                $description_data[$languages_data->languages_id]['units_name'] = '';
                $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
                $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            }
        }

        $result['description'] = $description_data;
        return $result;

    }

    public function updateunit($request)
    {

        $orders_status = DB::table('units')->where('unit_id', '=', $request->id)->update([

            'is_active' => $request->is_active,
        ]);

        return $orders_status;

    }

    public function updateunit_des($req_OrdersStatus, $request, $language_id)
    {

        $statusedec_id = DB::table('units_descriptions')->where('unit_id', '=', $request->id)->where('languages_id', '=', $language_id)->update([
            'units_name' => $req_OrdersStatus,
            'unit_id' => $request->id,
            'languages_id' => $language_id,

        ]);

        return $statusedec_id;

    }

    public function deleteunits($request)
    {

        DB::table('units')->where('unit_id', $request->id)->delete();
        DB::table('units_descriptions')->where('unit_id', $request->id)->delete();

        return "success";

    }

    public function commonContent()
    {
        $result = array();
        $roles = DB::table('manage_role')
                   ->where('user_types_id',Auth()->user()->role_id)
                   ->first();

        $result['roles'] = $roles;        

        $settings = DB::table('settings')->get();
        $setting = array();
        
        foreach($settings as $key=>$value){
          $setting[$value->name]=$value->value;
        }

        $result['setting'] = $setting;
        $result['new_reviews'] = DB::table('reviews')->where('reviews_read',0)->count();    

        $result['currency'] = DB::table('currencies')->where('is_default', '1')->first();

        return $result;
    }
    public function countries()
    {
        $countries = DB::table('countries')->get();
        return $countries;
    }
    public function state()
    {
        $state = DB::table('zones')->get();
        return $state;  
    }
    public function view_geo_fencing()
    {
        $geo = DB::table('geo_fencing')
        ->LeftJoin('countries','geo_fencing.country_id','=','countries.countries_id')
        ->LeftJoin('zones','geo_fencing.state_id','=','zones.zone_id')
        ->select('geo_fencing.*', 'countries.countries_name',
            'zones.zone_name')
        ->paginate(10);
      return $geo;
    }
    public function insert_geo_fencing($request)
    {
        $addate=date('Y-m-d H:i:s');
        $pincodearray=array();
        if(!empty($request->pincode)) {
            $pincodearray=explode(",",$request->pincode);
            $addpcode=$request->pincode;
        }else{
            $addpcode='';
        }

        //print_r($pincodearray);die();

        $geo_id = DB::table('geo_fencing')->insertGetId([
            'country_id'    => $request->country_id,
            'state_id'      => $request->state_id,
            'pincode'       => $addpcode,
            'status'        => $request->news_status,
            'created_at'    => $addate,
            'updated_at'    => $addate
        ]);

        if(!empty($request->pincode))
        {
            foreach ($pincodearray as  $jespincode) {

                DB::table('geo_fencing_pincode')->insertGetId([
                    'geo_fencing_id'=> $geo_id,
                    'geo_pincode'      => $jespincode,
                    'status'       => $request->news_status,
                    'created_at'    => $addate,
                    'updated_at'    => $addate
                ]);

            }
        }

        return $geo_id;

    }

    public function get_geo_fencing($id)
    {
        $geo = DB::table('geo_fencing')->where('id', $id)->first();
        return $geo;
    }

    public function edit_geo_fencing($request)
    {
        $addate=date('Y-m-d H:i:s');
        $pincodearray=array();
        if(!empty($request->pincode)) {
            $pincodearray=explode(",",$request->pincode);
            $addpcode=$request->pincode;
        }else{
            $addpcode='';
        }

        $statusedec_id = DB::table('geo_fencing')->where('id', '=', $request->id)->update([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'pincode'       => $addpcode,
            'status' => $request->news_status,
            'updated_at'    => $addate
        ]);

        // delete old date
        DB::table('geo_fencing_pincode')->where('geo_fencing_id', $request->id)->delete();

        if(!empty($request->pincode))
        {
            foreach ($pincodearray as  $jespincode) {

                DB::table('geo_fencing_pincode')->insertGetId([
                    'geo_fencing_id'=> $request->id,
                    'geo_pincode'      => $jespincode,
                    'status'       => $request->news_status,
                    'created_at'    => $addate,
                    'updated_at'    => $addate
                ]);

            }
        }
    }

    public function delete_geo_fencing($request)
    {
        $geo_id = $request->id;
        DB::table('geo_fencing')->where('id', $geo_id)->delete();
        DB::table('geo_fencing_pincode')->where('geo_fencing_id', $geo_id)->delete();
        return "success";
    }
    public function geoFilter($data){
        $name = $data['FilterBy'];
        $param = $data['parameter'];
        switch ( $name ) {
             case 'Country':
                $geo = DB::table('geo_fencing')
                ->LeftJoin('countries','geo_fencing.country_id','=','countries.countries_id')
                ->LeftJoin('zones','geo_fencing.state_id','=','zones.zone_id')
                ->select('geo_fencing.*', 'countries.countries_name',
                    'zones.zone_name')
                ->where('countries.countries_name', 'LIKE', '%' . $param . '%')
                ->paginate(10);
             break;
             case 'State':
                 $geo = DB::table('geo_fencing')
                ->LeftJoin('countries','geo_fencing.country_id','=','countries.countries_id')
                ->LeftJoin('zones','geo_fencing.state_id','=','zones.zone_id')
                ->select('geo_fencing.*', 'countries.countries_name',
                    'zones.zone_name')
                ->where('zones.zone_name', 'LIKE', '%' . $param . '%')
                ->paginate(10);
             break;
             case 'pincode':
                $geo = DB::table('geo_fencing')
               ->LeftJoin('countries','geo_fencing.country_id','=','countries.countries_id')
               ->LeftJoin('zones','geo_fencing.state_id','=','zones.zone_id')
               ->select('geo_fencing.*', 'countries.countries_name',
                   'zones.zone_name')
               ->where('geo_fencing.pincode', 'LIKE', '%' . $param . '%')
               ->paginate(10);
            break;
             default:
                $geo = DB::table('geo_fencing')
                ->LeftJoin('countries','geo_fencing.country_id','=','countries.countries_id')
                ->LeftJoin('zones','geo_fencing.state_id','=','zones.zone_id')
                ->select('geo_fencing.*', 'countries.countries_name',
                    'zones.zone_name')
                //->where('zones.zone_name', 'LIKE', '%' . $param . '%')
                ->paginate(10);
             break;
        }
        return $geo;
    }

    public function SetCancelStatus($request)
    {
        $statusedec_id = DB::table('orders_status')->where('orders_status_id', '=', $request->status_id)->update([
            'cancel_flag' => $request->status
        ]);

    }
    public function getCashier()
    {
        $result = DB::table('users')->where('role_id', '14')->get();
        return $result;
    }

    public function getResEncryption($data)
    {
        $pkey='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCAm+OIBsriBMcGrXRlkHcMO0syEkeiCckaYYdJyHFYr8fq/Ygh+01Y1YIZygcD8gfP6938dgNiwnwilPhqj2h5FiEZnmQDk3Yt3mR87td0h6tEieZNHr9KETpad/zqmLr/ZFLk374Fi6ld1sCRnsuSpK/LQbV89DVbrcDrXK7i1QIDAQAB
-----END PUBLIC KEY-----';
        $pubKey = openssl_pkey_get_public($pkey);
        $data=$data;
        openssl_public_encrypt($data, $encrypted, $pubKey);
        return base64_encode($encrypted);
    }

    public function resDecrypted($encrypted)
    {
        $privKey = '-----BEGIN RSA PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAICb44gGyuIExwatdGWQdww7SzISR6IJyRphh0nIcVivx+r9iCH7TVjVghnKBwPyB8/r3fx2A2LCfCKU+GqPaHkWIRmeZAOTdi3eZHzu13SHq0SJ5k0ev0oROlp3/OqYuv9kUuTfvgWLqV3WwJGey5Kkr8tBtXz0NVutwOtcruLVAgMBAAECgYBhL+yYnbFxbXTNigR8v9gGyUQA2amCPOzY37yxuCRXhbaI0QCv1U1VBTukq3PzulHHARImtzPFzPyr0XGMbUTfpn+TSV0ru9Jp2L6GpUJ6/I4qfCYZaCJiqKlrIlv0Qp2NnzyP0T6reRq8vvVwRg2dybDTb5722Po3DeM94lZTnQJBAPHjg1OeBMRbT4oZqOG5/tyh2OK+uN85Bc7MHpnKiVhaf4hUzT02n9AWA8JrYIYPcUPwVj8KlUdrkKT2a4dk8/8CQQCIHJlU8vNYDfPc6j8pUSuMUOYSPsEmpYpyBFnW7wnqngVbl0tFJCw09z7hk4z5lh9tdfD+imONimoeRGIFGhkrAkEAlgP5HbHB2RmcQdTaJWxaAPGrdiy8sUxHKtLzI4Q2HAK8V4voYc9v2/jbSgeYLGyFXZI/mwdwP4QZiAV/+M+GdwJAZWYg2IcxwByM2rvrl+UvcxXlgBweGqNiczRIlXV4xr84MJaSbYzYHhE/WB9q+5jaCtq9UXNZXN2L1saM204pBwJAYjDbEIWfl0jzAFfBo7eSbjNVWR2gYNmWp0jY466HunfcnbaBFIFIiUaVdretrbM8VRfG9sFrBiGWXqn7qbLoxw==
-----END RSA PRIVATE KEY-----';

        $encrypted = $encrypted;
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $privKey);
        return $decrypted;
    }

    public function getposfastcash()
    {
        $result = DB::table('pos_fast_cash')->get();
        return $result;
    }
    public function getpospayment()
    {
        $payment = DB::table('pos_payment_methods')
            ->LeftJoin('pos_payment_description', 'pos_payment_description.payment_methods_id', '=', 'pos_payment_methods.payment_methods_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'pos_payment_methods.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'pos_payment_methods.icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('pos_payment_description.*','categoryTable.path as imgpath','pos_payment_methods.status','iconTable.path as iconpath')
            ->where('pos_payment_description.language_id', '=', '1')
            ->get();
        return $payment;
    }
    public function edit_pospayment($id)
    {
        $payment = DB::table('pos_payment_methods')
            ->LeftJoin('pos_payment_description', 'pos_payment_description.payment_methods_id', '=', 'pos_payment_methods.payment_methods_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'pos_payment_methods.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'pos_payment_methods.icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('pos_payment_description.*','categoryTable.path as imgpath','pos_payment_methods.status','iconTable.path as iconpath','pos_payment_methods.image','pos_payment_methods.icon','pos_payment_methods.payment_methods_id as editid')
            ->where('pos_payment_methods.payment_methods_id', '=', $id)
            ->where('pos_payment_description.language_id', '=', '1')
            ->get();
        return $payment;
    }
    public function insert_pos_payment($uploadImage,$date_added,$uploadIcon,$status)
    {
        $paymentid = DB::table('pos_payment_methods')->insertGetId([
            'icon'          => $uploadIcon,
            'image'         => $uploadImage,
            'status'        => $status,
            'created_at'    => $date_added,
            'updated_at'    => $date_added
        ]);
        return $paymentid;
    }

    public function insertpaymentname($name,$id,$languages_data_id)
    {
         DB::table('pos_payment_description')->insert([
            'payment_methods_id'   =>   $id,
            'name'                 =>   $name,
            'language_id'          =>   $languages_data_id
        ]);
    }

    public function editpaymentname($languages_id,$id)
    {
        $description = DB::table('pos_payment_description')->where([
            ['language_id', '=', $languages_id],
            ['payment_methods_id', '=', $id],
        ])->get();
        return $description;
    }

    public function update_pos_payment($edit_id,$uploadImage,$uploadIcon,$last_modified,$status)
    {
        DB::table('pos_payment_methods')->where('payment_methods_id', $edit_id)->update(
        [
            'icon'      =>   $uploadIcon,
            'image'     =>   $uploadImage,
            'updated_at'=>   $last_modified,
            'status'    =>   $status
        ]);
    }
    public function checkExit($edit_id,$languages_data){
        $checkExist = DB::table('pos_payment_description')->where('payment_methods_id','=',$edit_id)->where('language_id','=',$languages_data->languages_id)->get();
        return $checkExist;
    }

    public function updatedescription($payment_name,$languages_data,$edit_id){
        $payment =  DB::table('pos_payment_description')->where('payment_methods_id','=',$edit_id)->where('language_id','=',$languages_data->languages_id)->update([
             'name'                   => $payment_name
         ]);
        return $payment;
     }

     public function getdrawercate()
     {
        $cate = DB::table('drawer_category')->orderBy('id', 'DESC')->get();
        return $cate;
     }

     public function check_drawer_cate($request)
     {
        $allvals=DB::table('drawer_category')->where('type','=', $request->cate_type)->where('cate_name','=', $request->cate_name)
                ->select('cate_name')->first();
        if(empty($allvals)) {
            $result='0';
            return $result;
        }else{
            $result='1';
            return $result;
        }
     }
     public function insert_drawer_cate($request)
     {
        $date_added = date('y-m-d h:i:s');
         DB::table('drawer_category')->insert([
            'type'      =>  $request->cate_type,
            'cate_name' =>  $request->cate_name,
            'status'    =>  $request->categories_status,
            'created_at'=>  $date_added,
            'updated_at'=>  $date_added
        ]);
     }
     public function get_drawercate($id)
     {
        $result = DB::table('drawer_category')->where('id','=', $id)->first();
        return $result;
     }
     public function drawercate_already_check($request)
     {
        $allvals=DB::table('drawer_category')->where('type','=', $request->cate_type)->where('cate_name','=', $request->cate_name)
                ->where('id','!=', $request->editid)
                ->select('cate_name')
                ->first();
            if(empty($allvals)) {
                $result='0';
                return $result;
            }else{
                $result='1';
                return $result;
            }
     }
     public function update_drawer_cate($request)
     {
        $date_added = date('y-m-d h:i:s');
        DB::table('drawer_category')->where('id', $request->editid)->update(
        [
            'type'      =>  $request->cate_type,
            'cate_name' =>  $request->cate_name,
            'updated_at'=>   $date_added,
            'status'    =>  $request->categories_status
        ]);
     }
     public function deleterecord($request){
        $category_id = $request->drawercate_id;
         DB::table('drawer_category')->where('id', $category_id)->delete();
     }

}
