<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\AdminControllers\MediaController;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Web\Products;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lang;
use Mail;
use Image;
use Hash;


class AppSettingController extends Controller
{

    public function apiAuthenticate($consumer_data)
    {
        $settings = $this->getSetting();
        //$check=$this->resDecrypted($consumer_data['consumer_nonce']);
        $callExist = DB::table('api_calls_list')
            ->where([
                ['device_id', '=', $consumer_data['consumer_device_id']],
                ['nonce', '=', $consumer_data['consumer_nonce']],
                ['url', '=', $consumer_data['consumer_url']],
            ])
            ->get();
        $ip = $consumer_data['consumer_ip'];
        $device_id = $consumer_data['consumer_device_id'];

        $block_check = DB::table('block_ips')->where('ip', $ip)->orwhere('device_id', $device_id)->first();
        //print_r($block_check);die();
        if ($block_check != null) {
            return '0';
        }

        $http_call_record = DB::table('http_call_record')->where('ip', $ip)->orderBy('ping_time', 'desc')->first();
        if ($http_call_record == null) {
            $last_ping_time = Carbon::now();
            $difference_from_previous = 0;
        } else {
            $last_ping_time = $http_call_record->ping_time;
            $difference_from_previous = $http_call_record->difference_from_previous;

        }
        $date = new Carbon(Carbon::now()->toDateTimeString());
        $difference = $date->floatDiffInSeconds($last_ping_time);

        DB::table('http_call_record')
            ->insert([
                'ip' => $ip,
                'device_id' => $device_id,
                'url' => $consumer_data['consumer_url'],
                'ping_time' => Carbon::now(),
                'difference_from_previous' => $difference,
            ]);

        $time_taken = DB::table('http_call_record')->where('url', $consumer_data['consumer_url'])->where('ip', $ip)->take(10)->sum('difference_from_previous');
        $record_count = DB::table('http_call_record')->where('ip', $ip)->count();
        //print_r(md5($settings['consumer_secret']));die();
        if(md5($settings['consumer_key']) == $consumer_data['consumer_key'] &&
            md5($settings['consumer_secret']) == $consumer_data['consumer_secret']
             && count($callExist)==0){
            //if($check){
            //$devalue  = explode("|",$check);
            //$countdevalue = count($devalue);
            //$checkvalue=$devalue['2'];
            //if($countdevalue=='3'){
                //if($checkvalue=='userapp'){
                    DB::table('api_calls_list')
                       ->insert([
                             'device_id'=>$consumer_data['consumer_device_id'],
                             'nonce'=>$consumer_data['consumer_nonce'],
                             'url'=>$consumer_data['consumer_url'],
                             'created_at'=>date('Y-m-d h:i:s')
                         ]);
                    return '1';
               //}else{
                // return '0'; 
               //}    
            //}else{
                //return '0'; 
            //}
        //}else{
            //return '0';
        //}
        }else{
              if($record_count >= 1000 && $time_taken <=60 ){
                     DB::table('http_call_record')->where('url',$consumer_data['consumer_url'])->where('ip',$ip)->delete();

                DB::table('block_ips')
                      ->insert([
                            'ip' => $ip,
                            'device_id' => $device_id,
                     'created_at' => Carbon::now()
                        ]);
                    return '0';
                 }else{
                     return '0';
                 }
        }
    }

    public function getlanguages()
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $languages = DB::table('languages')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'languages.image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
              })->select('languages.*', 'image_categories.path as image')->get();
            $responseData = array('success' => '1', 'languages' => $languages, 'message' => "Returned all languages.");
        } else {
            $responseData = array('success' => '0', 'languages' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
	}

    public function getcurrencies()
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $currencies = DB::table('currencies')->where('status',1)->where('is_current',1)->get();
            $responseData = array('success' => '1', 'data' => $currencies, 'message' => "Returned all currencies.");
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
	}

    public function getAlertSetting(){
		$setting = DB::table('alert_settings')->get();
		return $setting;
	}

    public function getSetting()
    {
        $setting = DB::table('settings')->get();
        $result = array();
        foreach ($setting as $settings) {
            $name = $settings->name;
            $value = $settings->value;
            $result[$name] = $value;
        }

        $alertsettings = $this->getAlertSetting();

        $language = DB::table('languages')->where('is_default',1)->first();
        $result['langId'] = $language ? $language->languages_id : 1;
        $result['languageCode'] = $language ? $language->code :"en"; //default language code
        $result['direction'] = $language ? $language->direction : "ltr"; //default language direction of app
        
        $currency = DB::table('currencies')->where('is_default',1)->first();
        // Please visit this link to get your html code https://html-css-js.com/html/character-codes/currency/
        $result['currency'] = $currency ? $currency->symbol_left ? $currency->symbol_left : $currency->symbol_right : "$"; //default currecny html code to show in app.
        $result['currencyCode'] = $currency ? $currency->code :"USD"; //default currency code
        $result['currencyPos'] = $currency ? $currency->symbol_left ? "left" :"right" : "left"; //default currency position
        $result['decimals'] = $currency ? $currency->decimal_places : 2; //default currecny decimal
        $result['currencyValue'] = $currency ? $currency->value  : "1.00000000"; //default currecny decimal

        $result['alertsetting'] = $alertsettings;
        return $result;
    }

    public function sitesetting()
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $settings = $this->getSetting();
           
            $responseData = array('success' => '1', 'data' => $settings, 'message' => "Returned all site data.");
        } else {
            $responseData = array('success' => '0', 'languages' => array(), 'message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function contactus(Request $request)
    {

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $setting = $this->getSetting();
          

            $contact_us_email = DB::table('alert_settings')->where('contact_us_email', 1)->first();
            
            if($contact_us_email != '')
            {
    
                $app_name =$setting['app_name'];
                $order_email =$setting['order_email'];
                $from = $app_name. "<".$order_email.">";
                $to = $setting['contact_us_email'];
                $bcc = $email;
                $api_key = $setting['mail_chimp_api'];
                $domain = $setting['mail_chimp_list_id'];
                $subject = $app_name. " Contact Us";

                $html ='<div style="width: 100%; display:block;"><h2>'.$app_name.'</h2><p><strong>HI Admin!</strong><br><br>Name: '.$name.'<br>Email: '.$email.'<br><br> '.$message.'<br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>';

    
                $subject = $subject;
                $MailData            = array();
                $api_key             = $api_key;
                $domain              = $domain;
                $MailData['from']    = $from;
                $MailData['to']      = $to;
                $MailData['bcc']     = $bcc;
                $MailData['subject'] = $subject;
                $MailData['html'] = $html;
        
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

                $responseData = array('success' => '1', 'data' => '', 'message' => "Message has been sent successfully!");
                $categoryResponse = json_encode($responseData);
                print $categoryResponse;
            }
            else
            {
                $responseData = array('success' => '0', 'data' => '', 'message' => "You was Not allowed to contact us!");
                $categoryResponse = json_encode($responseData);
                print $categoryResponse;

            }


            

          

        } else {
            $responseData = array('success' => '0', 'languages' => array(), 'message' => "Unauthenticated call.");
            $categoryResponse = json_encode($responseData);
            print $categoryResponse;
        }
    }

    public function applabels(Request $request)
    {
        $language_id = $request->lang;
        $labels = DB::table('labels')
            ->leftJoin('label_value', 'label_value.label_id', '=', 'labels.label_id')
            ->where('language_id', '=', $language_id)
            ->get();

        $result = array();
        foreach ($labels as $labels_data) {
            $result[$labels_data->label_name] = $labels_data->label_value;
        }

        $responseData = array('success' => '1', 'labels' => $result, 'message' => "Returned all site labels.");
        $categoryResponse = json_encode($responseData);
        print $categoryResponse;

    }

    public function applabels3(Request $request)
    {

        $language_id = $request->lang;

        $labels = DB::table('labels')
            ->leftJoin('label_value', 'label_value.label_id', '=', 'labels.label_id')
            ->where('language_id', '=', $language_id)
            ->get();

        $result = array();
        foreach ($labels as $labels_data) {
            $result[$labels_data->label_name] = $labels_data->label_value;
        }

        $categoryResponse = json_encode($result);
        print $categoryResponse;
    }

    public function getlocation(Request $request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            $address = urlencode($request->address);
            $settings = $this->getSetting();
            

            $data = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $settings['google_map_api'] . '&address=' . $address);
            $data = json_decode($data);

            if ($data->error_message) {
                $responseData = array('success' => '0', 'data' => array(), 'message' => $data->error_message);
            }else{
                $responseData = array('success' => '1', 'data' => $data, 'message' => "Current location is returned successfully.");                
            }

        } else {
            $responseData = array('success' => '0', 'languages' => array(), 'message' => "Unauthenticated call.");

        }

        $response = json_encode($responseData);
        print $response;
    }

    public function uploadimage(Request $request)
    {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;

        $authenticate = $this->apiAuthenticate($consumer_data);

        if ($authenticate == 1) {
            if ($request->user_id) {
                $user_id = $request->user_id;
            } else {
                $user_id = 0;
            }

            // Creating a new time instance, we'll use it to name our file and declare the path
            $time = Carbon::now();
            // Requesting the file from the form
            $image = $request->file('file');
            $extensions = Setting::imageType();
            if ($request->hasFile('file') and in_array($request->file->extension(), $extensions)) {

                // getting size
                $size = getimagesize($image);
                list($width, $height, $type, $attr) = $size;
                // Getting the extension of the file
                $extension = $image->getClientOriginalExtension();

                // Creating the directory, for example, if the date = 18/10/2017, the directory will be 2017/10/
                $directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
                // Creating the file name: random string followed by the day, random number and the hour
                $filename = str_random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
                // This is our upload main function, storing the image in the storage that named 'public'
                $upload_success = $image->storeAs($directory, $filename, 'public');

                //store DB
                $Path = 'images/media/' . $directory . '/' . $filename;
                $Images = new Images();
                $image_id = $Images->imagedata($filename,$Pathss, $Path, $width, $height, $pathtype,$user_id);
                $AllImagesSettingData = $Images->AllimagesHeightWidth();

                $mediaController = new MediaController();

                switch (true) {
                    case ($width >= $AllImagesSettingData[5]->value || $height >= $AllImagesSettingData[4]->value):
                        $tuhmbnail = $mediaController->storeThumbnial($Path, $filename, $directory, $filename);
                        $mediumimage = $mediaController->storeMedium($Path, $filename, $directory, $filename);
                        $largeimage = $mediaController->storeLarge($Path, $filename, $directory, $filename);
                        break;
                    case ($width >= $AllImagesSettingData[3]->value || $height >= $AllImagesSettingData[2]->value):
                        $tuhmbnail = $mediaController->storeThumbnial($Path, $filename, $directory, $filename);
                        $mediumimage = $mediaController->storeMedium($Path, $filename, $directory, $filename);
                        //                $storeLargeImage = $this->Images->Largerecord($filename,$Path,$width,$height);
                        break;
                    case ($width >= $AllImagesSettingData[0]->value || $height >= $AllImagesSettingData[1]->value):
                        $tuhmbnail = $mediaController->storeThumbnial($Path, $filename, $directory, $filename);

                        break;
                }
                $returnimages = DB::table('image_categories')->where('image_id', $image_id)->get();

                //$uploaded_image = DB::table()-where()
                $responseData = array('success' => '1', 'data' => $returnimages, 'message' => "image is uploaded successfully.");
            } else {
                $responseData = array('success' => '0', 'data' => array(), 'message' => "Please upload a valid image.");
            }
        } else {
            $responseData = array('success' => '0', 'data' => array(), 'message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        print $categoryResponse;
    }

    public function otp($phone,$otp,$ccode)
    {
        $id = "AC4b8af2e752c5dee537af4f6594a62b0d";
        $token = "f1503158702e4db2bfd21df2ddc13a58";
        $url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
        $from = "+12028914626";
        //$to = "+601127350684"; // twilio trial verified 
        $to = $ccode.$phone; // twilio trial verified number
        $body = "Grocery Platinum24 : OTP requested to verify your account. OTP:".$otp.". Do not Share with anyone";
        $data = array (
            'From' => $from,
            'To' => '+'.$to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);
        // var_dump($post);
        // var_dump($y);
    }
    public function insert_point($userid,$nopoints,$date)
    {
        //insert point details
        DB::table('transaction_points')->insert([
                    'user_id' => $userid,
                    'points' => $nopoints,
                    'balance_points' => $nopoints,
                    'points_status' => 'in',
                    'description'=>'Create Account',
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
        // update user table
        DB::table('users')->where('id', $userid)->update([
                    'loyalty_points' => $nopoints,
        ]);
    }

     public function update_level($userid,$level_id,$date)
    {
         // update user table
        DB::table('users')->where('id', $userid)->update([
                    'users_level' => $level_id,
        ]);
    }

    public  function generateRandomString($len) 
   {
        $length = $len;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
      return $randomString;
  }

  public  function imageType()
    {
        $extensions = array('gif', 'jpg', 'jpeg', 'png');
        return $extensions;
    }

    public  function imagedata($filename,$Pathss,$Path, $width, $height, $pathtype, $user_id = null)
    {
        $user_id = '1';

        $imagedata = DB::table('images')->insert([
            ['name' => $filename, 'user_id' => $user_id]
        ]);
        $getimage_id =  DB::table('images')->where('name', $filename)->first();

        $image_id = $getimage_id->id;

        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '1', 'height' =>$height,'width' =>$width,'path' =>$Pathss,'path_type'=>$pathtype]
        ]);
        return $image_id;

    }

    public function AllimagesHeightWidth()
    {
        $Thumbnail_height = DB::table('settings')->where('name','Thumbnail_height')->get();
        $Thumbnail_width = DB::table('settings')->where('name','Thumbnail_width')->get();
        $Medium_height = DB::table('settings')->where('name','Medium_height')->get();
        $Medium_width = DB::table('settings')->where('name','Medium_width')->get();
        $Large_height = DB::table('settings')->where('name','Large_height')->get();
        $Large_width = DB::table('settings')->where('name','Large_width')->get();
        $AllImagessetting = array($Thumbnail_height[0],$Thumbnail_width[0],$Medium_height[0],$Medium_width[0],$Large_height[0],$Large_width[0]);
        return $AllImagessetting;
    }

    public function thumbnailrecord($filename,$Path,$width,$height,$pathtype){
      $getimage_id =  DB::table('images')->where('name', $filename)->first();
      $image_id = $getimage_id->id;

      $imagecatedata = DB::table('image_categories')->insert([
        ['image_id' => $image_id, 'image_type' => '2', 'height' =>$height,'width' =>$width,'path' =>$Path,'path_type'=>$pathtype]
      ]);
    }

    public function thumbnailHeightWidth()
    {
        $Thumbnail_height = DB::table('settings')->where('name','Thumbnail_height')->get();
        $Thumbnail_width = DB::table('settings')->where('name','Thumbnail_width')->get();
        $thumbnailsetting = array($Thumbnail_height[0],$Thumbnail_width[0]);
        return $thumbnailsetting;
    }

    public function Mediumrecord($filename,$Path,$width,$height,$pathtype){
        $getimage_id =  DB::table('images')->where('name', $filename)->first();
        $image_id = $getimage_id->id;
        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '4', 'height' =>$height,'width' =>$width,'path' =>$Path,'path_type'=>$pathtype]
        ]);

    }

    public function MediumHeightWidth()
    {
        $Medium_height = DB::table('settings')->where('name','Medium_height')->get();
        $Medium_width = DB::table('settings')->where('name','Medium_width')->get();
        $Mediumsetting = array($Medium_height[0],$Medium_width[0]);
        return $Mediumsetting;
    }

    public function Largerecord($filename,$Path,$width,$height,$pathtype){

        $getimage_id =  DB::table('images')->where('name', $filename)->first();

        $image_id = $getimage_id->id;

        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '3', 'height' =>$height,'width' =>$width,'path' =>$Path, 'path_type'=>$pathtype,'updated_at'     => date('y-m-d h:i:s')]
        ]);
    }

   public function LargeHeightWidth()
    {
        $Large_height = DB::table('settings')->where('name','Large_height')->get();
        $Large_width = DB::table('settings')->where('name','Large_width')->get();


        $Largesetting = array($Large_height[0],$Large_width[0]);


        return $Largesetting;
    }

    public function fetchLanguages()
    {
        $language = DB::table('languages')->get();
        return $language;
    }

    public function slugify($slug)
    {

        // replace non letter or digits by -
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

        // transliterate
        if (function_exists('iconv')) {
            $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
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
 
     public function checkSlug($currentSlug){
        $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->get();
        return $checkSlug;
    }

    public function updateSlug($categories_id,$slug){
       $updateSlug = DB::table('categories')->where('categories_id',$categories_id)->update([
            'categories_slug'    =>   $slug
        ]);
       return $updateSlug;
   }

   public function storeThumbnialApp($Path, $filename, $directory, $input,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $thumbnail_values = $Images->thumbnailHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values[1]->value,

            'height' => $thumbnail_values[0]->value,

            'grayscale' => false));

        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . time() . $filename);
        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/thumbnail' . time() . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }
       
      
        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
       
        $Paths = $Paths . 'thumbnail' . time() . $filename;

        $storethumbnail = $this->thumbnailrecord($input, $Paths, $width, $height ,$pathtype);

        return $namethumbnail;
    }

    public function storeMediumApp($Path, $filename, $directory, $input ,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $Medium_values = $Images->MediumHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Medium_values[1]->value,

            'height' => $Medium_values[0]->value,

            'grayscale' => false));
        $namemedium = $thumbnailImage->save($destinationPath . 'medium' . time() . $filename);

        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/medium' . time() . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }

       

        $Path = 'images/media/' . $directory . '/' . 'medium' . time() . $filename;

        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $Paths = $Paths . 'medium' . time() . $filename;

        $storeMediumImage = $this->Mediumrecord($input, $Paths, $width, $height ,$pathtype);

        return $namemedium;
    }

    public function storeLargeApp($Path, $filename, $directory, $input ,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $Large_values = $Images->LargeHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Large_values[1]->value,

            'height' => $Large_values[0]->value,

            'grayscale' => false));
//        $upload_success = $thumbnailImage->save($directory, $filename, 'public');
        $namelarge = $thumbnailImage->save($destinationPath . 'large' . time() . $filename);

        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/large' . time() . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }

        


        $Path = 'images/media/' . $directory . '/' . 'large' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $Paths = $Paths . 'large' . time() . $filename;
        $storeLargeImage = $this->Largerecord($input, $Paths, $width, $height ,$pathtype);

        return $namelarge;
    }

    public function getUnits()
    {

        $units = DB::table('units')
            ->leftJoin('units_descriptions', 'units_descriptions.unit_id', '=', 'units.unit_id')
            ->where('is_active', '1')
            ->where('languages_id', '1')
            ->get();
        return $units;
    }

    public function ordersstatus(Request $request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authenticate = $this->apiAuthenticate($consumer_data);
        if($authenticate==1){
            if($request->status_id == '' || $request->language_id == ''){
                 $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
             $status = DB::table('orders_status')
            ->leftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status.orders_status_id', $request->status_id)
            ->where('orders_status_description.language_id', $request->language_id)
            ->get();
            if (!$status->isEmpty()) { 
                    $responseData = array('success'=>'1', 'data'=>$status,'message'=>"return all status..");
                }else{
                    $responseData = array('success'=>'0', 'message'=>"no data found");
                }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public function getCountryCode(Request $request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']         =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authenticate = $this->apiAuthenticate($consumer_data);
        if($authenticate==1){
                // IP address 
                $userIP = $_SERVER['REMOTE_ADDR'];
                
                 
                // API end URL 
                $apiURL = 'https://freegeoip.app/json/'.$userIP; 
                 
                // Create a new cURL resource with URL 
                $ch = curl_init($apiURL); 
                 
                // Return response instead of outputting 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                 
                // Execute API request 
                $apiResponse = curl_exec($ch); 
                 
                // Close cURL resource 
                curl_close($ch); 
                 
                // Retrieve IP data from API response 
                $ipData = json_decode($apiResponse, true);
                
                if(!empty($ipData)){ 
                   $responseData = array('success'=>'1', 'data'=>$ipData,'message'=>"return all data.."); 
                }else{
                   $responseData = array('success'=>'0', 'message'=>"IP data is not found!"); 
                }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(), 'message'=>"Unauthenticated call."); 
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

    public  function onesignalNotification($device_id, $sendData){
        
        //get function from other controller        
     
        $settings = $this->getSetting();
        
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
           'app_id' => $settings['onesignal_app_id'],
           'include_player_ids' => array($device_id),          
           'contents' => $content,
           'headings'=>$headings,
           'chrome_web_image'=>$sendData['image'],
           'big_picture'=>$sendData['image'],
           'ios_attachments'=>$sendData['image'],
           'firefox_icon'=>$sendData['image'],
           'data' => array($sendData['key'] => $sendData['value'],$sendData['key1'] => $sendData['value1'],$sendData['key2'] => $sendData['value2'])
          
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

    public function resDecrypted($encrypted)
    {
        $privKey = '-----BEGIN RSA PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAICb44gGyuIExwatdGWQdww7SzISR6IJyRphh0nIcVivx+r9iCH7TVjVghnKBwPyB8/r3fx2A2LCfCKU+GqPaHkWIRmeZAOTdi3eZHzu13SHq0SJ5k0ev0oROlp3/OqYuv9kUuTfvgWLqV3WwJGey5Kkr8tBtXz0NVutwOtcruLVAgMBAAECgYBhL+yYnbFxbXTNigR8v9gGyUQA2amCPOzY37yxuCRXhbaI0QCv1U1VBTukq3PzulHHARImtzPFzPyr0XGMbUTfpn+TSV0ru9Jp2L6GpUJ6/I4qfCYZaCJiqKlrIlv0Qp2NnzyP0T6reRq8vvVwRg2dybDTb5722Po3DeM94lZTnQJBAPHjg1OeBMRbT4oZqOG5/tyh2OK+uN85Bc7MHpnKiVhaf4hUzT02n9AWA8JrYIYPcUPwVj8KlUdrkKT2a4dk8/8CQQCIHJlU8vNYDfPc6j8pUSuMUOYSPsEmpYpyBFnW7wnqngVbl0tFJCw09z7hk4z5lh9tdfD+imONimoeRGIFGhkrAkEAlgP5HbHB2RmcQdTaJWxaAPGrdiy8sUxHKtLzI4Q2HAK8V4voYc9v2/jbSgeYLGyFXZI/mwdwP4QZiAV/+M+GdwJAZWYg2IcxwByM2rvrl+UvcxXlgBweGqNiczRIlXV4xr84MJaSbYzYHhE/WB9q+5jaCtq9UXNZXN2L1saM204pBwJAYjDbEIWfl0jzAFfBo7eSbjNVWR2gYNmWp0jY466HunfcnbaBFIFIiUaVdretrbM8VRfG9sFrBiGWXqn7qbLoxw==
-----END RSA PRIVATE KEY-----';

        $encrypted = $encrypted;
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $privKey);
        return $decrypted;
    }

    public  function PaymentID($id)
    {

        if($id<10){
            $uniqueId="0000000" . $id;
        }else if($id>=10 and $id<100){
            $uniqueId="000000" . $id;
        }else if($id>=100 and $id<1000){
            $uniqueId="00000" . $id;
        }else if($id>=1000 and $id<10000){
            $uniqueId="0000" . $id;
        }else if($id>=10000 and $id<100000){
            $uniqueId="000" . $id;
        }else if($id>=100000 and $id<1000000){
            $uniqueId="00" . $id;
        }else if($id>=1000000 and $id<10000000){
            $uniqueId="0" . $id;
        }else if($id>=10000000){
            $uniqueId=$id;
        }
        return $uniqueId;
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

    public function checkCoupons($user_id,$qrcode)
    {
        $coupons = DB::table('coupons')->where('qrcode', $qrcode)->first();

        $limit = DB::table('tb_usage_voucher_list')->where('voucherID', $coupons->coupans_id)->where('type', 'coupons')->count();
        $limit_user = DB::table('tb_usage_voucher_list')->where('voucherID', $coupons->coupans_id)->where('type', 'coupons')->where('userID', $user_id)->count();
        //print_r($coupons);die();

        if($coupons->usage_limit != '' && $coupons->usage_limit_per_user != ''){
            if($coupons->usage_limit <= $limit || $coupons->usage_limit_per_user <= $limit_user){
                $message = 'This coupon has been reached to its maximum usage limit';
            }else{
                $message = 'ok';
            }
        }else if($coupons->usage_limit != '' && $coupons->usage_limit_per_user == ''){
            if($coupons->usage_limit <= $limit){
                $message = 'This coupon has been reached to its maximum usage limit';
            }else{
                $message = 'ok'; 
            }
        }else if($coupons->usage_limit == '' && $coupons->usage_limit_per_user != ''){
            if($coupons->usage_limit_per_user <= $limit_user){
                $message = 'Coupon is used limit';
            }else{
                $message = 'ok'; 
            }  
        }else{
            $message = 'ok';
        }

        return $message;
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

    public function  barCodeAddtoCart($products_id,$quantity,$session_id,$attributeid,$option_id,$customers_basket_id,$options_values_id,$customers_id)
    {
        $products = new Products();
        $products_id=$products_id;
                if (empty($session_id)) {
                    $session_id = '';
                } else {
                    $session_id = $session_id;
                }

                $customers_basket_date_added = date('Y-m-d H:i:s');
                $limit = 15;
                $min_price = '';
                $max_price = '';

                if (empty($session_id)) {

                    $exist = DB::table('customers_basket')->where([
                        ['session_id', '=', $session_id],
                        ['products_id', '=', $products_id],
                        ['is_order', '=', 0],
                        ['serve_status', '=', 0],
                    ])->get();
                }else{
                    $exist = DB::table('customers_basket')->where([
                        ['session_id', '=', $session_id],
                        ['products_id', '=', $products_id],
                        ['is_order', '=', 0],
                        ['serve_status', '=', 0],
                    ])->get();
                }
                $isFlash = DB::table('flash_sale')->where('products_id', $products_id)
                ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
                ->get();
                //get products detail  is not default
                if (!empty($isFlash) and count($isFlash) > 0) {
                    $type = "flashsale";
                } else {
                    $type = "";
                }

                $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
                $detail = $products->products($data);
                $result['detail'] = $detail;
                if ($result['detail']['product_data'][0]->products_type == 0) 
                {

                    //check lower value to match with added stock
                    if ($result['detail']['product_data'][0]->products_max_stock != null and $result['detail']['product_data'][0]->products_max_stock < $result['detail']['product_data'][0]->defaultStock) {
                        $default_stock = $result['detail']['product_data'][0]->products_max_stock;
                    } else {
                        $default_stock = $result['detail']['product_data'][0]->defaultStock;
                    }

                    if (!empty($exist) and count($exist) > 0) {
                        $count = $exist[0]->customers_basket_quantity + $quantity;
                        $remain = $result['detail']['product_data'][0]->defaultStock - $exist[0]->customers_basket_quantity;

                        if ($count > $default_stock){

                        // return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                        }

                        // if ($count >= $result['detail']['product_data'][0]->defaultStock || $count > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {

                        //     return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                        // }
                    } else {

                        //if ($request->quantity > $result['detail']['product_data'][0]->defaultStock || $request->quantity > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {
                        if ($quantity > $default_stock) {
                            $count = $quantity;
                            $remain = $result['detail']['product_data'][0]->defaultStock - $count;
                        // return array('status' => 'exceed');
                        }
                    }
                }
                if(!empty($result['detail']['product_data'][0]->products_weight)){
                    $final_weight = $result['detail']['product_data'][0]->products_weight;
                }else{
                    $final_weight='0';
                }
                

                if (!empty($result['detail']['product_data'][0]->flash_price)) {
                    $final_price = $result['detail']['product_data'][0]->flash_price + 0;
                } elseif (!empty($result['detail']['product_data'][0]->discount_price)) {
                    $final_price = $result['detail']['product_data'][0]->discount_price + 0;
                } else {
                    $final_price = $result['detail']['product_data'][0]->products_price + 0;
                }

                //$variables_prices = 0
                if ($result['detail']['product_data'][0]->products_type == 1) {
                    $attributeid = $attributeid;
                    $attribute_price = 0;
                    if (!empty($attributeid) and count($attributeid) > 0) {

                        foreach ($attributeid as $attribute) {
                            $attribute = DB::table('products_attributes')->where('products_attributes_id', $attribute)->first();
                            $symbol = $attribute->price_prefix;
                            $values_price = $attribute->options_values_price;
                            if(!empty($attribute->weight)){
                                $final_weight = $attribute->weight;
                            }else{
                                $final_weight = '0';
                            }
                            
                            $special_price = $attribute->special_price;
                            if($result['detail']['product_data'][0]->is_special == 'yes')
                            {
                                $final_price = $special_price;
                            

                            }
                            else
                            {
                                if ($symbol == '+') {
                                    //$final_price = intval($final_price) + intval($values_price);
                                    $final_price = $final_price + $values_price;
                                }
                                if ($symbol == '-') {
                                    //$final_price = intval($final_price) - intval($values_price);
                                    $final_price = $final_price - $values_price;
                                }
                            }
                        }
                    }

                }

                //check quantity
                if ($result['detail']['product_data'][0]->products_type == 1) {
                    $qunatity['products_id'] = $products_id;
                    $qunatity['attributes'] = $attributeid;

                    $content = $products->productQuantity($qunatity);
                    //dd($content);
                    $stocks = $content['remainingStock'];

                } else {
                    $stocks = $result['detail']['product_data'][0]->defaultStock;

                }

                if ($stocks <= $result['detail']['product_data'][0]->products_max_stock or $result['detail']['product_data'][0]->products_max_stock ==0) {
                    $stocksToValid = $stocks;
                } else {
                    $stocksToValid = $result['detail']['product_data'][0]->products_max_stock;
                }

                //check variable stock limit
                if (!empty($exist) and count($exist) > 0) {
                    $count = $exist[0]->customers_basket_quantity + $quantity;
                    if ($count > $stocksToValid) {
                        // return array('status' => 'exceed');
                    }
                }

                if (empty($quantity)) {
                    $customers_basket_quantity = 1;
                } else {
                    $customers_basket_quantity = $quantity;
                }

                if ($stocksToValid > $customers_basket_quantity) {
                    $customers_basket_quantity = $result['detail']['product_data'][0]->products_min_order;
                }

                //quantity is not default
                if (empty($quantity)) {
                    $customers_basket_quantity = 1;
                } else {
                    $customers_basket_quantity = $quantity;
                }

                if ($customers_basket_id) 
                {
                    $basket_id = $customers_basket_id;
                    DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                    [
                        'session_id' => $session_id,
                        'products_id' => $products_id,
                        'customers_basket_quantity' => $customers_basket_quantity,
                        'final_price' => $final_price,
                        'weight' => $final_weight,
                        'customers_basket_date_added' => $customers_basket_date_added,
                    ]);

                    if (count($option_id) > 0) {
                        foreach ($option_id as $option_id) {

                            DB::table('customers_basket_attributes')->where([
                                ['customers_basket_id', '=', $basket_id],
                                ['products_id', '=', $products_id],
                                ['products_options_id', '=', $option_id],
                            ])->update(
                                [
                                    'session_id' => $session_id,
                                    'products_options_values_id' => $options_values_id,
                                    
                                ]);
                        }

                    }
                } else {
                    //insert into cart
                    if (count($exist) == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'session_id' => $session_id,
                                'products_id' => $products_id,
                                'customers_id' => $customers_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'weight' => $final_weight,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => '0.00',
                            ]);

                        if (!empty($option_id) && count($option_id) > 0) {
                            foreach ($option_id as $jesoption_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'session_id' => $session_id,
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $jesoption_id,
                                        'products_options_values_id' =>$options_values_id,
                                        
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } 
                        else if (!empty($detail['product_data'][0]->attributes)) 
                        {

                            foreach ($detail['product_data'][0]->attributes as $attribute) 
                            {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'session_id' => $session_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'customers_id' => $customers_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }
                    } else {

                $existAttribute = '0';
                $totalAttribute = '0';
                $basket_id = '0';

                if (!empty($option_id)) {
                    if (count($option_id) > 0) {

                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($option_id as $jesoption_id) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $jesoption_id],
                                    ['session_id', '=', $session_id],
                                    ['products_options_values_id', '=', $options_values_id],
                                    
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }

                            }

                            if ($totalAttribute == $existAttribute) {
                                $basket_id = $exists->customers_basket_id;
                            }
                        }

                    } else
                    if (!empty($detail['product_data'][0]->attributes)) {
                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($detail['product_data'][0]->attributes as $attribute) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $attribute['option']['id']],
                                    ['session_id', '=', $session_id],
                                    ['products_options_values_id', '=', $attribute['values'][0]['id']],
                                    ['products_options_id', '=', $jesoption_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }
                                if ($totalAttribute == $existAttribute) {
                                    $basket_id = $exists->customers_basket_id;
                                }
                            }
                        }

                    }

                    //attribute exist
                    if ($basket_id == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'session_id' => $session_id,
                                'products_id' => $products_id,
                                'customers_id' => $customers_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'weight' => $final_weight,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => '0.00',
                            ]);

                        if (count($option_id) > 0) {
                            foreach ($option_id as $jesoption_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'session_id' => $session_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $jesoption_id,
                                        'products_options_values_id' => $options_values_id,
                                        'customers_id' => $customers_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'session_id' => $session_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'weight' => $final_weight,
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'customers_id' => $customers_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    } else {

                        //update into cart
                        DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                            [
                                'session_id' => $session_id,
                                'products_id' => $products_id,
                                
                                'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);
                        //print_r($option_id);die();
                        if (count($option_id) > 0) {
                            foreach ($option_id as $jesoption_id) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $jesoption_id],
                                ])->update(
                                    [
                                        'session_id' => $session_id,
                                        'products_options_values_id' => $options_values_id,
                                        
                                    ]);
                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $jesoption_id],
                                ])->update(
                                    [
                                        'session_id' => $session_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    }

                } else {
                    //update into cart
                    DB::table('customers_basket')->where('customers_basket_id', '=', $exist[0]->customers_basket_id)->update(
                        [
                            'session_id' => $session_id,
                            'products_id' => $products_id,
                            
                            'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                            'final_price' => $final_price,
                            'weight' => $final_weight,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }

                }
        }

        return 'add';
    
    }

    public function generate_string($strength) {

        $input='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }

    public function getGuestUser()
    {
        $user = DB::table('users')->where('user_name','guest_user')->where('role_id', '2')->first();
        if($user){
            $userData = DB::table('users')
                     ->join('address_book','address_book.user_id','=','users.id')
                     ->where('users.id', '=', $user->id)->where('status', '1')->first();
        }else{
            //insert data into customer
            $customers_id = DB::table('users')->insertGetId([
                        'user_name'=>'guest_user',
                        'role_id' => 2,
                        'first_name' =>'Guest',
                        'last_name' => 'User',
                        'phone' => '9876543210',
                        'country_code'=>'91',
                        'gender'=>  'Male',
                        'api_token' => Str::random(80),
                        'email' => 'guest@gmail.com',
                        'dob'=> date('y-m-d'),
                        'loyalty_points'=>'0',
                        'password' => Hash::make('guest_user'),
                        'check_password'=>'guest_user',
                        'status' => '1',
                        'phone_verified'=>'1',
                        'created_at' => date('y-m-d h:i:s'),
            ]);

            $getsetting = $this->getSetting();
            // add address
                     $address_book_data = array(
                    'entry_firstname' => 'Guest',
                    'entry_lastname' => 'User',
                    'entry_street_address' => $getsetting['address'],
                    'entry_postcode' => $getsetting['zip'],
                    'entry_city' => $getsetting['city'],
                    'entry_country_id' => $getsetting['country'],
                    'entry_phone'=> $getsetting['phone_no'],
                    'entry_state' => $getsetting['state'],
                    'user_id' => $customers_id,
                    'entry_latitude'=> $getsetting['latitude'],
                    'entry_longitude'=> $getsetting['longitude'],
            );
            $address_book_id = DB::table('address_book')->insertGetId($address_book_data);
            DB::table('user_to_address')->insertGetId(['user_id' => $customers_id, 'address_book_id' => $address_book_id, 'is_default' => '1']);
            $userData = DB::table('users')
                     ->join('address_book','address_book.user_id','=','users.id')
                     ->where('users.id', '=', $customers_id)->where('status', '1')->first(); 
        }

        return $userData;
    }

    public function viewposCartDetails($session_id)
    {
        $customers_id='';
        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                'products_description.products_name as products_name', 'products.products_quantity as quantity',
                'products.products_price as price', 'products.products_weight as weight',
                'products.products_weight_unit as unit','products.product_serve','products.fresh_price','products.products_tax_class_id')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', '1')
            ->where('customers_basket.hold_status', '=','0');
        if (empty($customers_id)) {
            $cart->where('customers_basket.session_id', '=',$session_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        } else {
            $cart->where('customers_basket.customers_id', '=',$customers_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        }

        $baskit = $cart->get();
        $result = array();
            if (!$baskit->isEmpty()){
                foreach ($baskit as $baskit_data) {
                     //products_image
                        $default_images = DB::table('image_categories')
                            ->where('image_id', '=', $baskit_data->products_image)
                            ->where('image_type', 'THUMBNAIL')
                            ->first();

                    if ($default_images) {
                            $baskit_data->image = $default_images->path;
                        } else {
                            $default_images = DB::table('image_categories')
                                ->where('image_id', '=', $baskit_data->products_image)
                                ->where('image_type', 'MEDIUM')
                                ->first();

                            if ($default_images) {
                                $baskit_data->image = $default_images->path;
                            } else {
                                $default_images = DB::table('image_categories')
                                    ->where('image_id', '=', $baskit_data->products_image)
                                    ->where('image_type', 'ACTUAL')
                                    ->first();
                                $baskit_data->image = $default_images->path;
                            }
                        }
                        if($baskit_data->products_tax_class_id==0){
                            $baskit_data->products_tax = '0';
                        }else{
                           $tax=DB::table('tax_rates')->where('tax_class_id', $baskit_data->products_tax_class_id)->first();
                           if($tax){
                                $baskit_data->products_tax = $tax->tax_rate;
                           }else{
                                $baskit_data->products_tax = '0';
                           }
                        }

                        $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })
                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                       ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=',  '1')
                       ->where('products_options_values_descriptions.language_id', '=',  '1');

                       if (empty($customers_id)) {
                            $attributes->where('customers_basket_attributes.session_id', '=',  $session_id);
                       } else {
                           $attributes->where('customers_basket_attributes.customers_id', '=', $customers_id);
                       }

                       $attributes_data = $attributes->get();
                        // $attributes = DB::table('customers_basket_attributes')
                        //     ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                        //     ->get();
                            if (!$attributes_data->isEmpty()) { 
                               $baskit_data->attributes = $attributes_data; 
                            }else{
                               $baskit_data->attributes = [];
                            }
                        array_push($result, $baskit_data);
                }

            }else{
                $result = array();
            }

            return $result;
    }

    public function getPosCartUser($session_id)
    {
        $getsetting = $this->getSetting();
        $cusdata=DB::table('customers_basket')->where('is_order', '=', '0')->where('hold_status', '=','0')->where('session_id', '=',$session_id)->first();
        if($cusdata){
            $userdata = DB::table('users')->where('id', '=',$cusdata->customers_id)->first();
            $uaddress=DB::table('address_book')->where('user_id',$cusdata->customers_id)->first();
                if($uaddress){
                     $daddress=$uaddress;
                }else{
                    $daddress=DB::table('address_book')->where('entry_company', $getsetting['app_name'])->first();
                }
                $country=DB::table('countries')->where('countries_id',$daddress->entry_country_id)->first();
                $zone=DB::table('zones')->where('zone_id', $daddress->entry_zone_id)->first();
                    if($country){
                        $cname=$country->countries_name;
                    }else{
                        $cname='';
                    }
                    if($zone){
                        $zname=$zone->zone_name;
                    }else{
                        $zname='';
                    }
                $sdata=[
                             "id"=>$userdata->id,
                             "first_name"=>$userdata->first_name,
                             "last_name"=>$userdata->last_name,
                             "gender"=>$userdata->gender,
                             "country_code"=>$userdata->country_code,
                             "phone"=>$userdata->phone,
                             "email"=>$userdata->email,
                             "status"=>$userdata->status,
                             "phone_verified"=>$userdata->phone_verified,
                             "loyalty_points"=>$userdata->loyalty_points,
                             "users_level"=>$userdata->users_level,
                             "dob"=>$userdata->dob,
                             "address_book_id"=>$daddress->address_book_id,
                             "entry_firstname"=>$daddress->entry_firstname,
                             "entry_lastname"=>$daddress->entry_lastname,
                             "entry_street_address"=>$daddress->entry_street_address,
                             "entry_suburb"=>$daddress->entry_suburb,
                             "entry_postcode"=>$daddress->entry_postcode,
                             "entry_cc_code"=>$daddress->entry_cc_code,
                             "entry_phone"=>$daddress->entry_phone,
                             "entry_city"=>$daddress->entry_city,
                             "entry_state"=>$daddress->entry_state,
                             "entry_country_id"=>$daddress->entry_country_id,
                             "entry_zone_id"=>$daddress->entry_zone_id,
                             "entry_latitude"=>$daddress->entry_latitude,
                             "entry_longitude"=>$daddress->entry_longitude,
                             "country_name"=>$cname,
                             "zone_name"=>$zname 
                        ];

        }else{
            $sdata=[];
        }
        return $sdata;
    }

    public function getPosCartCoupons($session_id)
    {
        $coupon=DB::table('temp_pos_coupons')->where('session_id', '=',$session_id)->whereIn('discount_type', ['fixed_cart', 'percent'])->first();
            if($coupon){
                $coupon_data=$coupon;
            }else{
                $coupon_data=[];
            }
        return $coupon_data;
    }

    public function getPosCartDiscount($session_id)
    {
        $coupon=DB::table('temp_pos_coupons')->where('session_id', '=',$session_id)->whereIn('discount_type', ['bill_discount'])->where('coupon_id', '=','0')->first();
            if($coupon){
                $coupon_data=$coupon;
            }else{
                $coupon_data=[];
            }
        return $coupon_data;
    }

    public function getPosBookTable($session_id)
    {
        $table=DB::table('booking_table')->where('qrcode', '=',$session_id)->whereIn('status', ['checkin','reserved'])->first();
            if($table){
                $table_data=$table;
            }else{
                $table_data=[];
            }
        return $table_data;
    }

    public function getPosHold($session_id)
    {
        $hold=DB::table('hold')->where('session_id', '=',$session_id)->first();
            if($hold){
                $hold_data=$hold;
            }else{
                $hold_data=[];
            }
        return $hold_data;
    }

    public function getSaleMan($session_id)
    {
        $saleman=DB::table('sales_person_cart')->where('session_id', '=',$session_id)->first();
            if($saleman){
                $sale_data=$saleman;
            }else{
                $sale_data=[];
            }
        return $sale_data;
    }

    public function getSegment($id)
    {
            $seg_data=DB::table('cashier_segment')
                    ->leftjoin('users', 'users.id', '=', 'cashier_segment.cashier_id')
                    ->select('users.id','users.first_name','users.last_name','users.api_token','users.pin')
                    ->where('cashier_segment.segment_id', $id)
                    ->get();
            if(!$seg_data->isEmpty()){
                foreach ($seg_data as $key => $jesseg) {
                        $info=DB::table('cashier_info')->where('admin_id', $jesseg->id)->first();
                        if($info){
                            $infodata=$info;
                        }else{
                            $infodata=[]; 
                        }
                     $dataall[]=array(
                            'id'=>$jesseg->id,
                            'first_name' => $jesseg->first_name,
                            'last_name' => $jesseg->last_name,
                            'api_token' => $jesseg->api_token,
                            'pin' => $jesseg->pin,
                            'setting'=>$infodata
                        );
                }
                $segment=$dataall;
            }else{
                $segment=[];
            }
        return $segment;
    }

    public function getSubcateProduct($categories_id,$language_id,$currency_code,$customers_id)
    {
        $result = array();
        $sub_cate = DB::table('categories')
                    ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
                    ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
                    ->where('categories_description.language_id', '=', $language_id)
                    ->where('categories.categories_status', 1)
                    ->where('categories.parent_id', $categories_id)
                    ->groupBy('categories.categories_id')
                    ->get();
        if (!$sub_cate->isEmpty()){

            // get roduct
             foreach ($sub_cate as $jessub_cate) {
                $subdata = DB::table('products_to_categories')
                ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->leftJoin('image_categories as proimg', 'products.products_image', '=', 'proimg.image_id')
                ->select('products.*','proimg.path as product_image','proimg.path_type as image_path_type','products_description.products_name','products_description.products_description')
                 ->where('products_description.language_id', '=', $language_id)
                 ->where('products_to_categories.categories_id', '=', $jessub_cate->categories_id)
                 ->groupBy('products.products_id')
                 ->get();

                 if (!$subdata->isEmpty()) { 
                        $jessub_cate->product = $this->getCategoriesProduct($jessub_cate->categories_id,$language_id,$currency_code,$customers_id); 
                    }else{
                        $jessub_cate->product = [];
                    }
                array_push($result, $jessub_cate);
             }
                return $result;
        }else{
            return [];
        }
    }

    public function getCategoriesProduct($categories_id,$language_id,$currency_code,$customers_id)
    {
        $currentDate = time();
        $result = array();
        $index = 0;
        $setting = $this->getSetting();
        $products = DB::table('products_to_categories')
                ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                ->LeftJoin('specials', function ($join) use ($currentDate) {
                    $join->on('specials.products_id', '=', 'products_to_categories.products_id')
                    ->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                })

                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
                })

                ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                ->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
                ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')
                ->select('products_to_categories.*', 'products.*', 'image_categories.path as products_image','image_categories.path_type as path_type',  'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price')
                ->where('products_description.language_id', '=', $language_id)
                ->where('products_to_categories.categories_id', '=', $categories_id)
                ->where('products.products_status', '=', '1')
                ->groupBy('products.products_id')
                ->get();

                foreach ($products as $products_data) {
                    $requested_currency = $currency_code;
                    $current_price = $products_data->products_price;
                    $products_price = $this->convertprice($current_price, $requested_currency);

                     ////////// for discount price    /////////
                     if(!empty($products_data->discount_price)){
                        $discount_price = $this->convertprice($products_data->discount_price, $requested_currency);
                        $products_data->discount_price = $discount_price;
                    }
                     $products_data->products_price = $products_price;
                     $products_data->currency = $requested_currency;

                    $products_id = $products_data->products_id;
                    $products_description_new = stripslashes($products_data->products_description);
                    $products_data->products_description_new = $products_description_new;

                    $current_date = date("Y-m-d", strtotime("now"));
                    $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products_data->products_id)->first();
                    $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
                    $date=date_create($string);
                    date_add($date,date_interval_create_from_date_string($setting['new_product_duration']." days")); 
                    $after_date = date_format($date,"Y-m-d");
                    if($after_date >= $current_date){
                        $products_data->is_new = 1;
                    }else{
                        $products_data->is_new = 0;
                    }
                    $products_video_link = $products_data->products_video_link;
                    //multiple images
                     $products_images = DB::table('products_images')
                         ->LeftJoin('image_categories', function ($join) {
                            $join->on('image_categories.image_id', '=', 'products_images.image')
                            ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                });
                            })
                     ->select('products_images.*', 'image_categories.path as image','image_categories.path_type as path_type')
                    ->where('products_id', '=', $products_id)->orderBy('sort_order', 'ASC')->get();

                    $products_data->images = $products_images;

                     $products_videos = DB::table('product_video')
                      ->LeftJoin('image_categories', function ($join) {
                        $join->on('image_categories.image_id', '=', 'product_video.image_id')
                            ->where(function ($query) {
                                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                            });
                    })
                      ->select('product_video.*', 'image_categories.path as image','image_categories.path_type as path_type')
                      ->where('product_id', '=', $products_id)->orderBy('id', 'ASC')->get();

                  $products_data->videos = $products_videos;

                  $categories = DB::table('products_to_categories')
                        ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                        ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                        ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                        ->where('products_id', '=', $products_id)
                        ->where('categories_description.language_id', '=', $language_id)->get();

                    $products_data->categories = $categories;

                  $reviews = DB::table('reviews')
                    ->join('users', 'users.id', '=', 'reviews.customers_id')
                    ->select('reviews.*', 'users.avatar as image')
                    ->where('products_id', $products_data->products_id)
                    ->where('reviews_status', '1')
                    ->get();

                    $avarage_rate = 0;
                    $total_user_rated = 0;

                    if (count($reviews) > 0) {

                        $five_star = 0;
                        $five_count = 0;

                        $four_star = 0;
                        $four_count = 0;

                        $three_star = 0;
                        $three_count = 0;

                        $two_star = 0;
                        $two_count = 0;

                        $one_star = 0;
                        $one_count = 0;

                            foreach ($reviews as $review) {

                                          //five star ratting
                                          if ($review->reviews_rating == '5') {
                                              $five_star += $review->reviews_rating;
                                              $five_count++;
                                          }

                                          //four star ratting
                                          if ($review->reviews_rating == '4') {
                                              $four_star += $review->reviews_rating;
                                              $four_count++;
                                          }
                                          //three star ratting
                                          if ($review->reviews_rating == '3') {
                                              $three_star += $review->reviews_rating;
                                              $three_count++;
                                          }
                                          //two star ratting
                                          if ($review->reviews_rating == '2') {
                                              $two_star += $review->reviews_rating;
                                              $two_count++;
                                          }

                                          //one star ratting
                                          if ($review->reviews_rating == '1') {
                                              $one_star += $review->reviews_rating;
                                              $one_count++;
                                          }

                                      }

                                      $five_ratio = round($five_count / count($reviews) * 100);
                                      $four_ratio = round($four_count / count($reviews) * 100);
                                      $three_ratio = round($three_count / count($reviews) * 100);
                                      $two_ratio = round($two_count / count($reviews) * 100);
                                      $one_ratio = round($one_count / count($reviews) * 100);

                                      $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
                                      $total_user_rated = count($reviews);
                                      $reviewed_customers = $reviews;
                                  } else {
                                      $reviewed_customers = array();
                                      $avarage_rate = 0;
                                      $total_user_rated = 0;

                                      $five_ratio = 0;
                                      $four_ratio = 0;
                                      $three_ratio = 0;
                                      $two_ratio = 0;
                                      $one_ratio = 0;
                                  }

                                  $products_data->rating = number_format($avarage_rate, 2);
                                  $products_data->total_user_rated = $total_user_rated;

                                  $products_data->five_ratio = $five_ratio;
                                  $products_data->four_ratio = $four_ratio;
                                  $products_data->three_ratio = $three_ratio;
                                  $products_data->two_ratio = $two_ratio;
                                  $products_data->one_ratio = $one_ratio;

                                  //review by users
                                  $products_data->reviewed_customers = $reviewed_customers;

                                  array_push($result, $products_data);

                                  $options = array();
                                  $attr = array();

                                  //like product
                                  if (!empty($customers_id)) {
                                      $liked_customers_id = $customers_id;
                                      $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();
                                      if (count($categories) > 0) {
                                          $result[$index]->isLiked = '1';
                                      } else {
                                          $result[$index]->isLiked = '0';
                                      }
                                  } else {
                                      $result[$index]->isLiked = '0';
                                  }

                                  $stocks = 0;
                                  $stockOut = 0;
                                  $defaultStock = 0;
                                  if ($products_data->products_type == '0') {
                                      $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                                      $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                                      $defaultStock = $stocks - $stockOut;
                                  }

                                  if ($products_data->products_max_stock < $defaultStock && $products_data->products_max_stock > 0) {
                                      $result[$index]->defaultStock = $products_data->products_max_stock;
                                  } else {
                                      $result[$index]->defaultStock = $defaultStock;
                                  }
                        // fetch all options add join from products_options table for option name
                                  $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                                if (count($products_attribute) > 0) {
                                    $index2 = 0;
                                    foreach ($products_attribute as $attribute_data) {
                                        $option_name = DB::table('products_options')
                                              ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                                        if (count($option_name) > 0) {
                                            $temp = array();
                                            $temp_option['id'] = $attribute_data->options_id;
                                            $temp_option['name'] = $option_name[0]->products_options_name;
                                            $attr[$index2]['option'] = $temp_option;

                                            // fetch all attributes add join from products_options_values table for option value name
                                              $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                                            foreach ($attributes_value_query as $products_option_value) {
                                                $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values_descriptions.language_id', '=', $language_id)->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();
                                                $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
                                                  $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                                  $temp_i['id'] = $products_option_value->options_values_id;
                                                  $temp_i['value'] = $option_value[0]->products_options_values_name;
                                                  //check currency start
                                                  $current_price = $products_option_value->options_values_price;
                                                  $attr_weight = $products_option_value->weight;
                                                  $attr_weight_unit = $products_option_value->weight_unit;
                                                  $attribute_price = $this->convertprice($current_price, $requested_currency);

                                                  //check currency end
                                                  $temp_i['price'] = $attribute_price;
                                                  $temp_i['weight'] = $attr_weight;
                                                  $temp_i['weight_unit'] = $attr_weight_unit;
                                                  $temp_i['price_prefix'] = $products_option_value->price_prefix;
                                                  array_push($temp, $temp_i);
                                            }

                                              $attr[$index2]['values'] = $temp;
                                              $result[$index]->attributes = $attr;
                                              $index2++;
                                        }
                                    }
                                }else {
                                    $result[$index]->attributes = array();
                                }

                        //array_push($products_data, $result[$index]);
                                  $index++;
                }

                 return $result;
    }


    public function convertprice($current_price, $requested_currency)
  {
    $required_currency = DB::table('currencies')->where('is_current',1)->where('code', $requested_currency)->first();
    $products_price = $current_price * $required_currency->value;
    return $products_price;
  }

  public function getHoldProduct($hold_id,$gettype,$status)
  {
        $language_id='1';
            if($gettype=='bar'){
                $type='1';
            }elseif($gettype=='kitchen'){
                $type='2';
            }
        $cart = DB::table('customers_basket')
                ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
                ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                    'products_description.products_name as products_name', 'products.products_quantity as quantity',
                    'products.products_price as price', 'products.products_weight as weight',
                    'products.products_weight_unit as unit')->where('customers_basket.is_order', '=', '1')->where('products_description.language_id', '=', $language_id)
                ->where('customers_basket.hold_status', '=','1')
                ->where('customers_basket.serve_status', '=',$status)
                ->where('customers_basket.hold_id', '=',$hold_id)
                ->where('products.product_serve', '=',$type)
                ->get();
                $result = array();
                if (!$cart->isEmpty()){
                    foreach ($cart as $baskit_data) {
                            //products_image
                            $default_images = DB::table('image_categories')
                              ->where('image_id', '=', $baskit_data->products_image)
                              ->where('image_type', 'THUMBNAIL')
                              ->first();

                            if ($default_images) {
                                      $baskit_data->image = $default_images->path;
                                  } else {
                                      $default_images = DB::table('image_categories')
                                          ->where('image_id', '=', $baskit_data->products_image)
                                          ->where('image_type', 'MEDIUM')
                                          ->first();

                                      if ($default_images) {
                                          $baskit_data->image = $default_images->path;
                                      } else {
                                          $default_images = DB::table('image_categories')
                                              ->where('image_id', '=', $baskit_data->products_image)
                                              ->where('image_type', 'ACTUAL')
                                              ->first();
                                          $baskit_data->image = $default_images->path;
                                      }
                                  }

                        $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })

                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                       ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=',  $language_id)
                       ->where('products_options_values_descriptions.language_id', '=',  $language_id)
                       ->where('customers_basket_attributes.session_id', '=',  $baskit_data->session_id)
                       ->get();

                           if (!$attributes->isEmpty()) {
                                $baskit_data->attributes = $attributes;
                           }else{
                                $baskit_data->attributes = [];
                           }
                           array_push($result, $baskit_data);
                    }
                    return $result;
                }else{
                    return []; 
                }
  }

  public function getPosAttributesStock($products_id)
  {
     $proAttributes = DB::table('products_attributes')->where('products_id', $products_id)->get();
     if (!empty($proAttributes)) {
         $attributes = array();
         foreach($proAttributes as $jesattributs){
            $attributes[]=$jesattributs->products_attributes_id;
         }
         $attributeid = implode(',', $attributes);
         $postAttributes = count($attributes);
         //print_r($attributeid);die();
        $inventories = DB::table('inventory')->where('products_id', $products_id)->get();
        $reference_ids = array();
        $stockIn = 0;
        $stockOut = 0;
        $inventory_ref_id = array();

        foreach ($inventories as $inventory) {
            $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
            $totalAttributes = count($totalAttribute);

            if ($postAttributes > $totalAttributes) {
                $count = $postAttributes;
            } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                $count = $totalAttributes;
            }

            $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                    ->selectRaw('inventory.*')
                    ->whereIn('inventory_detail.attribute_id', [$attributeid])
                    ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
                    ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
                    ->groupBy('inventory_detail.inventory_ref_id')
                    ->get();
             if (count($individualStock) > 0) {

                    if ($individualStock[0]->stock_type == 'in') {
                        $stockIn += $individualStock[0]->stock;
                    }

                    if ($individualStock[0]->stock_type == 'out') {
                        $stockOut += $individualStock[0]->stock;
                    }

                    $inventory_ref_id[] = $individualStock[0]->inventory_ref_id;
                }
        }

        $remainingStock = $stockIn - $stockOut;
        //print_r($remainingStock);die();
     }else{
        $remainingStock = '0';
     }
     return $remainingStock;
  }

  public function cutNum($num, $precision = 2)
  {
     return floor($num) . substr(str_replace(floor($num), '', $num), 0, $precision + 1);
  }
  public function getPaymentByAmount($id)
  {
        $payment = DB::table('pos_payment_methods')
                    ->LeftJoin('pos_payment_description', 'pos_payment_description.payment_methods_id', '=', 'pos_payment_methods.payment_methods_id')
                    ->where('pos_payment_methods.status', '1')
                    ->where('language_id', '1')->get();
        if (!$payment->isEmpty()) {
            foreach ($payment as $jespayment){
                if($jespayment->name=='Cash'){
                    $mothod='Cash on Pos';
                }elseif($jespayment->name=='Credit'){
                    $mothod='Credit/Debit Card';
                }elseif($jespayment->name=='PromptPay'){
                    $mothod='Prompt Pay';
                }elseif($jespayment->name=='Delivery'){
                    $mothod='Delivery';
                }elseif($jespayment->name=='Coupon'){
                     $mothod='Coupon';
                }else{
                     $mothod=$jespayment->name;
                }
                 $total_sale=DB::table('orders')
                    ->where(['cashier_id' => $id,'drawer_status'=>'0','payment_method'=>$mothod])->where('order_status_id', '!=', '3')->sum('order_price');
                $dataall[] = array(
                                $jespayment->name => $total_sale
                                );  
            }
            $data=$dataall;
        }else{
            $data='[]';
        }
        return $data;
    }

    public function getPaymentByDashboard($type,$startTime,$endTime)
    {
       $reportBase=$type; 
       if($reportBase=='this_month'){
            if($startTime > $endTime){
                $dateFrom = date('Y-m-01 '.$startTime.':00', time());
                $tomorrow = date("Y-m-t");
                $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                $dateTo = $ntom.' '.$endTime.':59';
            }else{
                $dateFrom = date('Y-m-01 '.$startTime.':00', time());
                $dateTo = date('Y-m-t '.$endTime.':59', time());
            }
       }elseif($reportBase=='last_month'){
            if($startTime > $endTime){
                $dateFrom = date('Y-m-01 '.$startTime.':00', time());
                $tomorrow = date("Y-m-t");
                $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                $dateTo = $ntom.' '.$endTime.':59';
            }else{
                $dateFrom = date('Y-m-01 '.$startTime.':00', time());
                $dateTo = date('Y-m-t '.$endTime.':59', time());
            }
       }elseif($reportBase=='last_year'){
            if($startTime > $endTime){
                $dateFrom = date('Y-m-d '.$startTime.':00',strtotime("this year January 1st"));
                $tomorrow = date("Y-m-d",strtotime("this year December 31st"));
                $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                $dateTo = $ntom.' '.$endTime.':59';
            }else{
                $dateFrom = date('Y-m-d '.$startTime.':00',strtotime("this year January 1st"));
                $dateTo = date('Y-m-d '.$endTime.':59',strtotime("this year December 31st"));
            }
       }else{
            $reportBase = str_replace('dateRange', '', $reportBase);
            $str = str_replace('=', '', $reportBase);
            $data = explode("_",$str);
            //print_r($data);die();
            $arr = explode('/', $data[0]);
            $earr = explode('/', $data[1]);
            $startdate = $arr[2].'-'.$arr[0].'-'.$arr[1];
            $enddate = $earr[2].'-'.$earr[0].'-'.$earr[1];
            if($startTime > $endTime){
                $dateFrom = date($startdate.' '.$startTime.':00', time());
                $tomorrow = date($enddate);
                $ntom=date ('Y-m-d',strtotime('+1 day', strtotime($tomorrow)));
                $dateTo = $ntom.' '.$endTime.':59';
                //print_r($dateTo);die();
            }else{
                $dateFrom = date($startdate.' '.$startTime.':00', time());
                $dateTo = date($enddate.' '.$endTime.':59', time());
            } 
       }

       $payment = DB::table('pos_payment_methods')
                  ->LeftJoin('pos_payment_description', 'pos_payment_description.payment_methods_id', '=', 'pos_payment_methods.payment_methods_id')
                    ->where('pos_payment_methods.status', '1')
                    ->where('language_id', '1')->get();
        if (!$payment->isEmpty()) {

            foreach ($payment as $jespayment) {
                if($jespayment->name=='Cash'){
                    $mothod='Cash on Pos';
                }elseif($jespayment->name=='Credit'){
                    $mothod='Credit/Debit Card';
                }elseif($jespayment->name=='PromptPay'){
                    $mothod='Prompt Pay';
                }elseif($jespayment->name=='Delivery'){
                    $mothod='Delivery';
                }elseif($jespayment->name=='Coupon'){
                     $mothod='Coupon';
                 }else{
                    $mothod=$jespayment->name;
                 }
                 $total_sale=DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->where(['payment_method'=>$mothod])->where('order_status_id', '!=', '3')->sum('order_price');
                $dataall[] = array(
                                $jespayment->name => $total_sale
                                );  
            }
            $result=$dataall;

        }else{
            $result='[]';
        }
        return $result;
    }

    public function getDrawerHistory($id,$date)
    {
        $result = array();
        $getdata=DB::table('drawer')
            ->LeftJoin('users as o', 'o.id', '=', 'drawer.shift_opened_by')
            ->LeftJoin('users as c', 'c.id', '=', 'drawer.shift_closed_by')
            ->select('drawer.*', 'o.first_name as shift_opened_name','c.first_name as shift_closed_name')
            ->where(['drawer.shift_opened_by' => $id,'drawer.status'=>'close'])
            ->whereDate('shift_closed', '=', $date)
            ->get();
        if (!$getdata->isEmpty()) {
            foreach ($getdata as $jesgetdata) {
                $jesgetdata->payment=$this->getDrawerHistoryPayment($jesgetdata->id,$id);
                // get paid in history
                $jesgetdata->paid_in_list= DB::table('paid_in_out')->where('type', '=','income')->where('drawer_id', '=', $jesgetdata->id)->get();
                // get paid out history
                $jesgetdata->paid_out_list= DB::table('paid_in_out')->where('type', '=','expanse')->where('drawer_id', '=', $jesgetdata->id)->get();
                array_push($result, $jesgetdata);
            }
        }else{
           $result='[]'; 
        }
        return $result;
    }

    public function getDrawerHistoryPayment($drawerid,$cashierid)
    {
        $payment = DB::table('pos_payment_methods')
                    ->LeftJoin('pos_payment_description', 'pos_payment_description.payment_methods_id', '=', 'pos_payment_methods.payment_methods_id')
                    ->where('pos_payment_methods.status', '1')
                    ->where('language_id', '1')->get();
        if (!$payment->isEmpty()) {
            foreach ($payment as $jespayment) {
                if($jespayment->name=='Cash'){
                    $mothod='Cash on Pos';
                }elseif($jespayment->name=='Credit'){
                    $mothod='Credit/Debit Card';
                }elseif($jespayment->name=='PromptPay'){
                    $mothod='Prompt Pay';
                }elseif($jespayment->name=='Delivery'){
                    $mothod='Delivery';
                }elseif($jespayment->name=='Coupon'){
                     $mothod='Coupon';
                 }else{
                    $mothod=$jespayment->name;
                 }
                 $total_sale=DB::table('orders')
                    ->where(['cashier_id' => $cashierid,'payment_method'=>$mothod,'drawer_id'=>$drawerid])->where('order_status_id', '!=', '3')->sum('order_price');
                $dataall[] = array(
                                $jespayment->name => $total_sale
                                );  
            }
            $data=$dataall;
        }else{
            $data='[]';
        }
        return $data;
    }

    public function addLoyaltyPoints($orders_id)
    {
        $date_added = date('Y-m-d H:i:s');
        $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            $exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->where('user_id', '=', $order_user->customers_id)->get();
            $settings = DB::table('settings')->where('id', '=','148')->first();
            $member_type = DB::table('settings')->where('id', '=','149')->first();
            $wallet = DB::table('settings')->where('id', '=','202')->first();

            $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();
            $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
            $oldbalnce=$cdata->loyalty_points;
            $amount = $order_user->order_price;

            if($wallet->value == '1' && $order_user->payment_method == 'wallet'){
                if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_wallet_amount = $level->rate_wallet;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $wallet_point = $count_level_amount*$level_wallet_amount;
                        if($point){
                            $no_rm = $point->no_rm;
                            $no_point = $point->points;
                            $count_rm = round($amount/$no_rm);
                            $give_point = $count_rm*$no_point;
                            $total_point = $give_point+$member_point+$wallet_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }else{
                            $total_point = $member_point+$wallet_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }
                         // get user level
                        // Update user type
                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_wallet_amount = $level->rate_wallet;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $wallet_point = $count_level_amount*$level_wallet_amount;
                        $total_point = $member_point+$wallet_point;
                        $newbalnce=$oldbalnce+$total_point;

                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                         $total_point = 0;
                         $newbalnce=$oldbalnce+$total_point;
                    }
                }elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1'){
                    if($point){
                        $no_rm = $point->no_rm;
                        $no_point = $point->points;
                        $count_rm = round($amount/$no_rm);
                        $give_point = $count_rm*$no_point;
                        $total_point = $give_point;
                        $newbalnce=$oldbalnce+$total_point;
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }
            }else{
                if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;

                        if($point){
                            $no_rm = $point->no_rm;
                            $no_point = $point->points;
                            $count_rm = round($amount/$no_rm);
                            $give_point = $count_rm*$no_point;
                            $total_point = $give_point+$member_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }else{
                            $total_point = $member_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }

                        // get user level
                        // Update user type
                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;  
                    }
                }elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $total_point = $member_point;
                        $newbalnce=$oldbalnce+$total_point;

                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }

                }elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1'){
                    if($point){
                        $no_rm = $point->no_rm;
                        $no_point = $point->points;
                        $count_rm = round($amount/$no_rm);
                        $give_point = $count_rm*$no_point;
                        $total_point = $give_point;
                        $newbalnce=$oldbalnce+$total_point;
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }
            }

            //insert point details
            DB::table('transaction_points')->insert([
                'user_id' => $order_user->customers_id,
                'order_id'=> $orders_id,
                'points' => $total_point,
                'balance_points' => $newbalnce,
                'points_status' => 'in',
                'description'=>'Make Purchase',
                'created_at' => $date_added,
                'updated_at' => $date_added
            ]);

            // update user table
            DB::table('users')->where('id', $order_user->customers_id)->update([
                'loyalty_points' => $newbalnce,
            ]);

            return 'success';
    }
}
