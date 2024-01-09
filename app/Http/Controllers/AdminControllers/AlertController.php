<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

 
class AlertController extends Controller
{


    //new product notifications
    public function newProductNotification($products_id){
        $result = array();
        //alert setting

        $myVar = new SiteSettingController();
        $alertSetting = $myVar->getAlertSetting();

        $product = DB::table('products_to_categories')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('products_description','products_description.products_id','=','products.products_id')
            ->LeftJoin('manufacturers', function ($join) {
                $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
            })
            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');
            })

            ->select('products_to_categories.*', 'categories_description.categories_name','categories.*', 'products.*','products_description.*', 'specials.specials_id', 'manufacturers.*', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
            ->where('products_description.language_id','=', 1)
            ->where('products.products_id','=', $products_id)
            ->where('categories_description.language_id','=', 1)->get();

        $result['product'] = $product;

        //email
        if($alertSetting[0]->new_product_email==1){

            $customers = DB::table('customers')->get();

            $result['customers'] = $customers;

            foreach($customers as $customers_data){
                $customers_data->product = $product;
                if( !empty($customers_data->email) )
                {
                    Mail::send('/mail/newProduct', ['customers_data' => $customers_data], function($m) use ($customers_data){
                        $m->to($customers_data->email)->subject(Lang::get("labels.NewProductEmailTitle"))->getSwiftMessage()
                            ->getHeaders()
                            ->addTextHeader('x-mailgun-native-send', 'true');
                    });
                }

            }


        }

        //notification
        if($alertSetting[0]->new_product_notification==1){

            $title	  = Lang::get("labels.newProductNotificationTitle");
            $message  = Lang::get("labels.newProductNotficationMessagePart1").$product[0]->products_name.'" '.Lang::get("labels.newProductNotficationMessagePart2");

            //image
            $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/demos/website/'. $product[0]->products_image;

            $sendData = array
            (
                'body' 	=> $message,
                'title'	=> $title ,
                'icon'	=> 'myicon',/*Default Icon*/
                'sound' => 'mySound',/*Default sound*/
                'image' => $websiteURL
            );

            //status change push notifications

            $setting = $this->myVarsetting->getSetting();

            $devices = DB::table('devices')
                ->where('status','=', 1)
                ->where('devices.is_notify','=', '1')
                ->get();

            $functionName = 'onesignalNotification';

            foreach($devices as $devices_data){
                $response[] = $this->onesignalNotification($devices_data->device_id, $sendData);
            }
        }

    }

    //new product notifications
    public function newsNotification($news_id)
    {
        $result = array();
        //alert setting

        $myVar = new SiteSettingController();
        $alertSetting = $myVar->getAlertSetting();

        $news = DB::table('news_to_news_categories')
            ->leftJoin('news_categories', 'news_categories.categories_id', '=', 'news_to_news_categories.categories_id')
            ->leftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
            ->leftJoin('news_description', 'news_description.news_id', '=', 'news.news_id')
            ->leftJoin('news_categories_description', 'news_categories_description.categories_id', '=', 'news_to_news_categories.categories_id')
            ->select('news_to_news_categories.*', 'news_categories_description.categories_name', 'news_categories.*', 'news.*', 'news_description.*')
            ->where('news.news_id', '=', $news_id)
            ->where('news_description.language_id', '=', 1)
            ->where('news_categories_description.language_id', '=', 1)
            ->orderBy('news.news_id', 'ASC')
            ->get();

        $result['news'] = $news;
        
        $website_link = DB::table('settings')->where('id', '=','103')->first();
        $img = DB::table('image_categories')->where('image_id', '=', $news[0]->news_image)->where('image_type', '=', 'ACTUAL')->first();
        if($img->path_type == 'aws')
        {
            $imgurl = $img->path;
        }
        else
        {
            $imgurl = $website_link->value.$img->path;
        }
       

        //email
        if ($alertSetting[0]->news_email == 1) {

            $customers = DB::table('users')->get();

            $result['customers'] = $customers;

            

            foreach ($customers as $customers_data) {
                $customers_data->news = $news;
                if (!empty($customers_data->email)) {

                    
                    $order_email = DB::table('settings')->where('id', '=','71')->first();
            $app_name = DB::table('settings')->where('id', '=','19')->first();
            $website_logo = DB::table('settings')->where('id', '=','16')->first();
            $api_key = DB::table('settings')->where('id', '=','123')->first();
            $domain = DB::table('settings')->where('id', '=','124')->first();
           

                    $des = stripslashes($customers_data->news[0]->news_description);
                    $title = $customers_data->news[0]->news_name;
                    $first_name = $customers_data->first_name;
                    $last_name = $customers_data->last_name;

                    //print_r($last_name);die;

                    $html = '<div style="width: 100%; display:block;"><h2>'.$title.'</h2><strong>Hi '.$first_name.' '.$last_name.'!</strong><br>'.$des.'<br><img src="'.$imgurl.'" style="width:50%;height:auto;"><br><strong>Sincerely,</strong><br>'.$app_name->value.'<p></div>';


                    $subject = $title;
                    $MailData            = array();
                    $api_key             = $api_key->value;
                    $domain              = $domain->value;
                    $MailData['from']    = $app_name->value. "<".$order_email->value.">";
                    $MailData['to']      = $customers_data->email;
                    //$MailData['to']      = 'sakthi@platinumcode.com.my';
                    $MailData['subject'] = $title;
                    $MailData['html'] =  $html;
            
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
                    //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
                    $resultss = curl_exec($ch);
                    curl_close($ch);  
                    //echo $resultss;
                    //return $result;



                }
            }

        }
        //notification
        if($alertSetting[0]->news_notification==1){

            $title	  = 'New Blog is added';
            $message  = $news[0]->news_name.' '.Lang::get("labels.newsNotficationMessagePart1");

            //image
            $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/demos/website/'. $news[0]->news_image;

            $sendData = array
            (
                'body' 	=> $message,
                'title'	=> $title ,
                'icon'	=> 'myicon',/*Default Icon*/
                'sound' => 'mySound',/*Default sound*/
                'image' => $imgurl
            );

            

            //$setting = $this->myVarsetting->getSetting();


            $devices = DB::table('devices')
                ->where('status','=', 1)
                ->where('devices.is_notify','=', '1')
                ->get();

            foreach($devices as $devices_data){
                $response[] = $this->onesignalNotification($devices_data->device_id, $sendData);
            }
        }
    }

    

    public function newsNotificationCron()
    {
        $result = array();
      
        //alert setting

        $myVar = new SiteSettingController();
        $alertSetting = $myVar->getAlertSetting();

        $news = DB::table('news_to_news_categories')
            ->leftJoin('news_categories', 'news_categories.categories_id', '=', 'news_to_news_categories.categories_id')
            ->leftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
            ->leftJoin('news_description', 'news_description.news_id', '=', 'news.news_id')
            ->leftJoin('news_categories_description', 'news_categories_description.categories_id', '=', 'news_to_news_categories.categories_id')
            ->select('news_to_news_categories.*', 'news_categories_description.categories_name', 'news_categories.*', 'news.*', 'news_description.*')
            ->where('news.cron_status', '=', 0)
            ->where('news_description.language_id', '=', 1)
            ->where('news_categories_description.language_id', '=', 1)
            ->orderBy('news.news_id', 'ASC')
            ->get();

           

        $news_id =  $news[0]->news_id;

        $result['news'] = $news;
        

        
        $website_link = DB::table('settings')->where('id', '=','103')->first();
        $img = DB::table('image_categories')->where('image_id', '=', $news[0]->news_image)->where('image_type', '=', 'ACTUAL')->first();
        if($img->path_type == 'aws')
        {
            $imgurl = $img->path;
        }
        else
        {
            $imgurl = $website_link->value.$img->path;
        }

    
        if(count($news) > 0)
        {
            //email
            if ($alertSetting[0]->news_email == 1) {
              
                $customers = DB::table('users')->get();
                $result['customers'] = $customers;
               
                foreach ($customers as $customers_data) {
                    $customers_data->news = $news;
                    if (!empty($customers_data->email)) {

                       

                        $order_email = DB::table('settings')->where('id', '=','71')->first();
                        $app_name = DB::table('settings')->where('id', '=','19')->first();
                        $website_logo = DB::table('settings')->where('id', '=','16')->first();
                        $api_key = DB::table('settings')->where('id', '=','123')->first();
                        $domain = DB::table('settings')->where('id', '=','124')->first();

                       

                        $des = stripslashes($customers_data->news[0]->news_description);
                        $title = $customers_data->news[0]->news_name;
                        $first_name = $customers_data->first_name;
                        $last_name = $customers_data->last_name;

                        //print_r($last_name);die;

                        $html = '<div style="width: 100%; display:block;"><h2>'.$title.'</h2><strong>Hi '.$first_name.' '.$last_name.'!</strong><br>'.$des.'<br><img src="'.$imgurl.'" style="width:50%;height:auto;"><br><strong>Sincerely,</strong><br>'.$app_name->value.'<p></div>';


                        $subject = $title;
                        $MailData            = array();
                        $api_key             = $api_key->value;
                        $domain              = $domain->value;
                        $MailData['from']    = $app_name->value. "<".$order_email->value.">";
                        $MailData['to']      = $customers_data->email;
                        //$MailData['to']      = 'sakthi@platinumcode.com.my';
                        $MailData['subject'] = $title;
                        $MailData['html'] =  $html;
            
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                        curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
                        //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
                        $resultss = curl_exec($ch);
                        curl_close($ch);  
                        //echo $resultss;
                        //return $result;
                    }
                }

            }

            //notification
            if($alertSetting[0]->news_notification==1){
                $title	  = 'New Blog is added';
                $message  = $news[0]->news_name.' '.Lang::get("labels.newsNotficationMessagePart1");
                //image
                $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/demos/website/'. $news[0]->news_image;
                $sendData = array
                (
                    'body' 	=> $message,
                    'title'	=> $title ,
                    'icon'	=> 'myicon',/*Default Icon*/
                    'sound' => 'mySound',/*Default sound*/
                    'image' => $imgurl,
                    'key' => 'news_id', 
					'value' => $ordersData['orders_data'][0]->news_id, 
                );
                //$setting = $this->myVarsetting->getSetting();
                $devices = DB::table('devices')
                    ->where('status','=', 1)
                    ->where('devices.is_notify','=', '1')
                    ->get();
                foreach($devices as $devices_data){
                    $response[] = $this->onesignalNotification($devices_data->device_id, $sendData);
                }
            }
            
             DB::table('news')->where('news_id',  $news_id)->update([
                'cron_status' => 1,
            ]);
            
            echo 'ok';
        }
    }

    public function onesignalNotification($device_id, $sendData){
		
        //get function from other controller        
        $myVar = new SiteSettingController();
        $setting = $myVar->getSetting();
        
        $settings = $setting->unique('id')->keyBy('id');
        
		$content = array(
		   "en" => $sendData['body']
		   );
		
		$headings = array(
		   "en" => $sendData['title']
		   );
		
		$big_picture = array(
		   "id1" => $sendData['image']
		   );
		
		$fields = array(
		   'app_id' => $settings[56]->value,
		   'include_player_ids' => array($device_id),		   
		   'contents' => $content,
		   'headings'=>$headings,
		   'chrome_web_image'=>$sendData['image'],
		   'big_picture'=>$sendData['image'],
		   'ios_attachments'=>$sendData['image'],
		   'firefox_icon'=>$sendData['image'],
           'data' => array($sendData['key'] => $sendData['value'])
		);
	
		$fields = json_encode($fields);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic ZTJhZTcwNzItODQ4Ni00Y2FiLWFjZjEtMGY4ODZhZGZlMGZl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		$result = curl_exec($ch);
		//$data = json_decode($result);
		curl_close($ch);
		
    }

}
