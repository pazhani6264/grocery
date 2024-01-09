<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;



class Superadmin extends Model
{

    public function lastLogin(){
       
        //last login
        $today = date('Y-m-d');
        $shopID = DB::connection('mysql2')->table('tb_user')->where('id', auth()->user()->super_admin_id)->first();
        $lastLoginCount = DB::connection('mysql2')->table('last_login')->whereDate('created_at',$today)->where('Shop_id',$shopID->id)->count();
        if($lastLoginCount == 0){
        $lastLogin = DB::connection('mysql2')->table('last_login')->insertGetId([
            'shop_id'       =>   $shopID->id,
            'shop_name'     =>   auth()->user()->user_name,
            'created_at'    =>   date('Y-m-d H:i:s'),
        ]);
        }
    }


    public function facebookPending(){
        $facebook_app_id = DB::table('settings')->where('id', 1)->first();
        $facebook_secret_id = DB::table('settings')->where('id', 2)->first();
        $facebook_callback_url = DB::table('settings')->where('id', 115)->first();
        if($facebook_app_id->value == '' ||  $facebook_secret_id->value == '' || $facebook_callback_url->value == ''){
            $shopID = DB::connection('mysql2')->table('tb_user')->where('id', auth()->user()->super_admin_id)->first();
            $notificationCount = DB::connection('mysql2')->table('notification')->where('comments','Facebook Pending')->where('Shop_id',$shopID->id)->count();
            if($notificationCount == 0){
            $notification = DB::connection('mysql2')->table('notification')->insertGetId([
                'shop_id'       =>   $shopID->id,
                'shop_name'     =>   auth()->user()->user_name,
                'comments'      =>   'Facebook Pending',
                'status'        =>   1,
                'created_at'    =>   date('Y-m-d H:i:s'),
            ]);
            }

            $facebookCount = DB::connection('mysql2')->table('fb_pending')->where('status','0')->where('Shop_id',$shopID->id)->count();
            if($facebookCount == 0){
            $facebook = DB::connection('mysql2')->table('fb_pending')->insertGetId([
                'shop_id'               =>   $shopID->id,
                'shop_name'             =>   auth()->user()->user_name,
                'facebook_app_id'       =>   $facebook_app_id->value,
                'facebook_secret_id'    =>   $facebook_secret_id->value,
                'facebook_callback_url' =>   $facebook_callback_url->value,
                'status'                =>   0,
                'created_at'            =>   date('Y-m-d H:i:s'),
            ]);
            }

        }
    }

    public function facebookPendingUpdate(){

        $facebook_app_id = DB::table('settings')->where('id', 1)->first();
        $facebook_secret_id = DB::table('settings')->where('id', 2)->first();
        $facebook_callback_url = DB::table('settings')->where('id', 115)->first();

        if($facebook_app_id->value !='' && $facebook_secret_id->value !='' && $facebook_callback_url->value !=''){
            $status = 1;
        }else{
            $status = 0;
        }

        $shopID = DB::connection('mysql2')->table('tb_user')->where('id', auth()->user()->super_admin_id)->first();
        $google = DB::connection('mysql2')->table('fb_pending')->where('shop_id', '=', $shopID->id)->update([
            'shop_id'               =>   $shopID->id,
            'shop_name'             =>   auth()->user()->user_name,
            'facebook_app_id'       =>   $facebook_app_id->value,
            'facebook_secret_id'    =>   $facebook_secret_id->value,
            'facebook_callback_url' =>   $facebook_callback_url->value,
            'status'                =>   $status,
            'created_at'            =>   date('Y-m-d H:i:s'),
        ]);
    }

    public function googlePending(){
        $google_app_id = DB::table('settings')->where('id', 116)->first();
        $google_secret_id = DB::table('settings')->where('id', 117)->first();
        $google_callback_url = DB::table('settings')->where('id', 118)->first();
        if($google_app_id->value == '' ||  $google_secret_id->value == '' || $google_callback_url->value == ''){
            $shopID = DB::connection('mysql2')->table('tb_user')->where('id', auth()->user()->super_admin_id)->first();
            $notificationCount = DB::connection('mysql2')->table('notification')->where('comments','Google Pending')->where('Shop_id',$shopID->id)->count();
            if($notificationCount == 0){
            $notification = DB::connection('mysql2')->table('notification')->insertGetId([
                'shop_id'       =>   $shopID->id,
                'shop_name'     =>   auth()->user()->user_name,
                'comments'      =>   'Google Pending',
                'status'      =>   1,
                'created_at'    =>   date('Y-m-d H:i:s'),
            ]);
            }

            $googleCount = DB::connection('mysql2')->table('google_pending')->where('status','0')->where('Shop_id',$shopID->id)->count();
            if($googleCount == 0){
            $google = DB::connection('mysql2')->table('google_pending')->insertGetId([
                'shop_id'               =>   $shopID->id,
                'shop_name'             =>   auth()->user()->user_name,
                'google_app_id'         =>   $google_app_id->value,
                'google_secret_id'      =>   $google_secret_id->value,
                'google_callback_url'   =>   $google_callback_url->value,
                'status'                =>   0,
                'created_at'            =>   date('Y-m-d H:i:s'),
            ]);
            }
        }
    }



    public function googlePendingUpdate(){

        $google_app_id = DB::table('settings')->where('id', 116)->first();
        $google_secret_id = DB::table('settings')->where('id', 117)->first();
        $google_callback_url = DB::table('settings')->where('id', 118)->first();

        if($google_app_id->value !='' && $google_secret_id->value !='' && $google_callback_url->value !=''){
            $status = 1;
        }else{
            $status = 0;
        }

        $shopID = DB::connection('mysql2')->table('tb_user')->where('id', auth()->user()->super_admin_id)->first();
        $google = DB::connection('mysql2')->table('google_pending')->where('shop_id', '=', $shopID->id)->update([
            'shop_id'               =>   $shopID->id,
            'shop_name'             =>   auth()->user()->user_name,
            'google_app_id'         =>   $google_app_id->value,
            'google_secret_id'      =>   $google_secret_id->value,
            'google_callback_url'   =>   $google_callback_url->value,
            'status'                =>   $status,
            'created_at'            =>   date('Y-m-d H:i:s'),
        ]);
    }





   
}
