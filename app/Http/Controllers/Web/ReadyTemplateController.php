<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Order;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Lang;
use View;
use DB;
use Cookie;
class ReadyTemplateController extends Controller
{

    public function __construct(
        Index $index,
        News $news,
        Languages $languages,
        Products $products,
        Currency $currency,
        Order $order
    ) {
        $this->index = $index;
        $this->order = $order;
        $this->news = $news;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->theme = new ReadyTemplateThemeController();
    }

    public function demoTemplate($id)
    {
        $title = array('pageTitle' => Lang::get("website.Home"));
        $final_theme = $this->theme->theme();
/*********************************************************************/
/**                   GENERAL CONTENT TO DISPLAY                    **/
/*********************************************************************/
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $result['shoppinginfo'] = $this->index->shoppinginfo();
        $title = array('pageTitle' => Lang::get("website.Home"));
/********************************************************************/

/*********************************************************************/
/**                   GENERAL SETTINGS TO FETCH PRODUCTS           **/
/*******************************************************************/

        /**  SET LIMIT OF PRODUCTS  **/
        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 12;
        }

        /**  MINIMUM PRICE **/
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        /**  MAXIMUM PRICE  **/
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }
/*************************************************************************/
        /*********************************************************************/
        /**                     FETCH NEWEST PRODUCTS                       **/
        /*********************************************************************/

        $data = array('page_number' => '0', 'type' => '', 'limit' => 12, 'min_price' => $min_price, 'max_price' => $max_price);
        $newest_products = $this->products->products($data);
        $result['products'] = $newest_products;
        /*********************************************************************/
        /**                     Compare Counts                              **/
        /*********************************************************************/

/*********************************************************************/

        /***************************************************************/
        /**   CART ARRAY RECORDS TO CHECK WETHER OR NOT DISPLAYED--   **/
        /**  --PRODUCT HAS BEEN ALREADY ADDE TO CART OR NOT           **/
/***************************************************************/
        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
/**************************************************************/

//special products

        $data = array('page_number' => '0', 'type' => 'special', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $special_products = $this->products->products($data);
        $result['special'] = $special_products;
//Flash sale

        $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $flash_sale = $this->products->products($data);
        $result['flash_sale'] = $flash_sale;
// //top seller
        $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $top_seller = $this->products->products($data);
        $result['top_seller'] = $top_seller;

//most liked
        $data = array('page_number' => '0', 'type' => 'mostliked', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $most_liked = $this->products->products($data);
        $result['most_liked'] = $most_liked;

//is feature
        $data = array('page_number' => '0', 'type' => 'is_feature', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $featured = $this->products->products($data);
        $result['featured'] = $featured;

        $data = array('page_number' => '0', 'type' => '', 'limit' => '15', 'is_feature' => '');
        $news = $this->news->getAllNews($data);
        $result['news'] = $news;

// Trending
        $data = array('page_number' => '0', 'type' => 'Trending', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $Trending = $this->products->products($data);
        $result['Trending'] = $Trending;

//current time

        $currentDate = Carbon\Carbon::now();
        $currentDate = $currentDate->toDateTimeString();

        $slides = $this->index->slides($currentDate);
        $result['slides'] = $slides;
        //liked products
        $result['liked_products'] = $this->products->likedProducts();

        $orders = $this->order->getOrders();
        if (count($orders) > 0) {
            $allOrders = $orders;
        } else {
            $allOrders = $this->order->allOrders();
        }

        $temp_i = array();
        foreach ($allOrders as $orders_data) {
            $mostOrdered = $this->order->mostOrders($orders_data);
            foreach ($mostOrdered as $mostOrderedData) {
                $temp_i[] = $mostOrderedData->products_id;
            }
        }
        $detail = array();
        $temp_i = array_unique($temp_i);
        foreach ($temp_i as $temp_data) {
            $data = array('page_number' => '0', 'type' => 'topseller', 'products_id' => $temp_data, 'limit' => 7, 'min_price' => '', 'max_price' => '');
            $single_product = $this->products->products($data);
            if (!empty($single_product['product_data'][0])) {
                $detail[] = $single_product['product_data'][0];
            }
        }

        $result['weeklySoldProducts'] = array('success' => '1', 'product_data' => $detail, 'message' => "Returned all products.", 'total_record' => count($detail));
        
        session(['paymentResponseData' => '']); 
            
        session(['paymentResponse'=>'']);
        session(['payment_json','']);

        $category_section = array();
        if(!empty($result['commonContent']['settings']['home_category'])){
             $categories_array = explode(',',$result['commonContent']['settings']['home_category']);
             $index = 0;
             foreach($categories_array as $item){
                 
                 //get category section detail
                 $category = $this->products->getCategorybyId($item);
                 if($category){
                     $category_section[$index] = $category;
                     $data = array('page_number' => '0', 'categories_id'=>$category->categories_id, 'type' => '', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
                     $single_product = $this->products->products($data);
                     $category_section[$index]->products = $single_product;
                     $index++;
                 }
             }
             
         }

         $collection_section = array();
          if($result['commonContent']['settings']['collection_product'] == 1){
            

            $collections_array = DB::table('collections')->where('id','>', 4)->where('status', 1)->get();

            

             $index = 0;
             foreach($collections_array as $item){

              
                 
                 //get category section detail
                 $collection = $this->products->getCollectionbyId($item);
               
                 if($collection){
                   
                     $collection_section[$index] = $collection;
                    
                     $data = array('page_number' => '0', 'collection_id'=>$collection->collections_id, 'type' => '', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
                     
                     $single_product = $this->products->products($data);

                    
                     $collection_section[$index]->products = $single_product;
                     $index++;
                 }

               
             }
             
         } 
 
        
         // dd($category_section);
         $result['category_section'] = $category_section;
         $result['collection_section'] = $collection_section;
        return view("web.readytemplateindex", ['title' => $title, 'final_theme' => $final_theme])->with(['result' => $result]);
    }

    public function maintance()
    {
        return view('errors.maintance');
    }

    public function error()
    {
        return view('errors.general_error', ['msg' => $msg]);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->back();
    }
    public function test()
    {
        $productcategories = $this->products->productCategories1();
        echo print_r($productcategories);

    }

    private function setHeader($header_id)
    {
        $count = $this->order->countCompare();
        $languages = $this->languages->languages();
        $currencies = $this->currencies->getter();
        $productcategories = $this->products->productCategories();
        $title = array('pageTitle' => Lang::get("website.Home"));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        if ($header_id == 1) {

            $header = (string) View::make('web.headers.headerOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 2) {
            $header = (string) View::make('web.headers.headerTwo');
        } elseif ($header_id == 3) {
            $header = (string) View::make('web.headers.headerThree')->render();
        } elseif ($header_id == 4) {
            $header = (string) View::make('web.headers.headerFour')->render();
        } elseif ($header_id == 5) {
            $header = (string) View::make('web.headers.headerFive')->render();
        } elseif ($header_id == 6) {
            $header = (string) View::make('web.headers.headerSix')->render();
        } elseif ($header_id == 7) {
            $header = (string) View::make('web.headers.headerSeven')->render();
        } elseif ($header_id == 8) {
            $header = (string) View::make('web.headers.headerEight')->render();
        } elseif ($header_id == 9) {
            $header = (string) View::make('web.headers.headerNine')->render();
        } else {
            $header = (string) View::make('web.headers.headerTen')->render();
        }
        return $header;
    }

    private function setBanner($banner_id)
    {
        if ($banner_id == 1) {
            $banner = (string) View::make('web.banners.banner1')->render();
        } elseif ($banner_id == 2) {
            $banner = (string) View::make('web.banners.banner2')->render();
        } elseif ($banner_id == 3) {
            $banner = (string) View::make('web.banners.banner3')->render();
        } elseif ($banner_id == 4) {
            $banner = (string) View::make('web.banners.banner4')->render();
        } elseif ($banner_id == 5) {
            $banner = (string) View::make('web.banners.banner5')->render();
        } elseif ($banner_id == 6) {
            $banner = (string) View::make('web.banners.banner6')->render();
        } elseif ($banner_id == 7) {
            $banner = (string) View::make('web.banners.banner7')->render();
        } elseif ($banner_id == 8) {
            $banner = (string) View::make('web.banners.banner8')->render();
        } elseif ($banner_id == 9) {
            $banner = (string) View::make('web.banners.banner9')->render();
        } elseif ($banner_id == 10) {
            $banner = (string) View::make('web.banners.banner10')->render();
        } elseif ($banner_id == 11) {
            $banner = (string) View::make('web.banners.banner11')->render();
        } elseif ($banner_id == 12) {
            $banner = (string) View::make('web.banners.banner12')->render();
        } elseif ($banner_id == 13) {
            $banner = (string) View::make('web.banners.banner13')->render();
        } elseif ($banner_id == 14) {
            $banner = (string) View::make('web.banners.banner14')->render();
        } elseif ($banner_id == 15) {
            $banner = (string) View::make('web.banners.banner15')->render();
        } elseif ($banner_id == 16) {
            $banner = (string) View::make('web.banners.banner16')->render();
        } elseif ($banner_id == 17) {
            $banner = (string) View::make('web.banners.banner17')->render();
        } elseif ($banner_id == 18) {
            $banner = (string) View::make('web.banners.banner18')->render();
        } elseif ($banner_id == 19) {
            $banner = (string) View::make('web.banners.banner19')->render();
        } else {
            $banner = (string) View::make('web.banners.banner20')->render();
        }
        return $banner;
    }

    private function setFooter($footer_id)
    {
        if ($footer_id == 1) {
            $footer = (string) View::make('web.footers.footer1')->render();
        } elseif ($footer_id == 2) {
            $footer = (string) View::make('web.footers.footer2')->render();
        } elseif ($footer_id == 3) {
            $footer = (string) View::make('web.footers.footer3')->render();
        } elseif ($footer_id == 4) {
            $footer = (string) View::make('web.footers.footer4')->render();
        } elseif ($footer_id == 5) {
            $footer = (string) View::make('web.footers.footer5')->render();
        } elseif ($footer_id == 6) {
            $footer = (string) View::make('web.footers.footer6')->render();
        } elseif ($footer_id == 7) {
            $footer = (string) View::make('web.footers.footer7')->render();
        } elseif ($footer_id == 8) {
            $footer = (string) View::make('web.footers.footer8')->render();
        } elseif ($footer_id == 9) {
            $footer = (string) View::make('web.footers.footer9')->render();
        } else {
            $footer = (string) View::make('web.footers.footer10')->render();
        }
        return $footer;
    }
    //page
    public function page(Request $request)
    {

        $pages = $this->order->getPages($request);
        if (count($pages) > 0) {
            $title = array('pageTitle' => $pages[0]->name);
            $final_theme = $this->theme->theme();
            $result['commonContent'] = $this->index->commonContent();
            $result['pages'] = $pages;
            return view("web.page", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

        } else {
            return redirect()->intended('/');
        }
    }
    //myContactUs
    public function contactus(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Contact Us"));
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();

        return view("web.contact-us", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

   /*  public function processContactUs(Request $request)
    {
        $MailData            = array();
        $api_key            = "key-f8a02d96988841f41ae9a37c75057994";
        $domain            = "platinum24.net";
        $MailData['from']    = "PlatinumCode <info@platinumcode.com.my>";
        $MailData['to']      = 'sakthi@platinumcode.com.my';
        $MailData['subject'] = 'New test';
        $MailData['html']  = 'Mailgun test on progress';
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
        //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox204042218dcf4743bbf94b9fe91d49dd.mailgun.org/messages'); // SanbBox
        curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
        $result = curl_exec($ch);
        curl_close($ch);
        //echo $result;
        //  return $result;
    } */
 
    //processContactUs
      public function processContactUs(Request $request)
    {

        $contact_us_email = DB::table('alert_settings')->where('contact_us_email', 1)->first();

        if($contact_us_email != '')
        {
             

        $name = $request->name;
        $email = $request->email;
        $messages = $request->message;

        $result['commonContent'] = $this->index->commonContent();

        $app_name =$result['commonContent']['settings']['app_name'];
        $order_email =$result['commonContent']['settings']['order_email'];
        $from = $app_name. "<".$order_email.">";
        $to = $result['commonContent']['settings']['contact_us_email'];
        $bcc = $email;
        $api_key = $result['commonContent']['settings']['mail_chimp_api'];
        $domain = $result['commonContent']['settings']['mail_chimp_list_id'];
        $subject = $app_name. " Contact Us";
        $html ='<div style="width: 100%; display:block;"><h2>'.$app_name.'</h2><p><strong>HI Admin!</strong><br><br>Name: '.$name.'<br>Email: '.$email.'<br><br> '.$messages.'<br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>';

        //print_r($subject);
        //print_r($domain);
        //print_r($from);die();
        //print_r($to);
        //print_r($bcc);
        //print_r($html);die();
      
        
        $header = "From: Grocery <orders@platinum24.net > \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        //$retval = mail ($to,$subject,$html,$header); 

        $result=$this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

        // Insert main count in Superadmin

        $resuluser = DB::table('users')->where('role_id', 1)->first();
        $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
        $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
            'email' => $bcc,
            'comments' => 'contact US',
            'user_id' => $resuluser->id,
            'shop_name' => $resuluser->user_name,
            'shop_id' => $shopmail->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', Lang::get("website.contact us message"));
        }
        else
        {
            return redirect()->back()->with('success', 'You was Not allowed to contauct us');
        }
    } 
 
    //setcookie
    public function setcookie(Request $request)
    {
        Cookie::queue('cookies_data', 1, 4000);
        return json_encode(array('accept'=>'yes'));
    }

    //newsletter
    public function newsletter(Request $request)
    {
        if (!empty(auth()->guard('customer')->user()->id)) {
            $customers_id = auth()->guard('customer')->user()->id;  
            $existUser = DB::table('customers')
                          ->leftJoin('users','customers.customers_id','=','users.id')
                          ->where('customers.fb_id', '=', $customers_id)
                          ->first();

                      
            if($existUser){                
                DB::table('customers')->where('user_id','=',$customers_id)->update([
                    'customers_newsletter' => 1,
                ]);
            }else{
                DB::table('customers')->insertGetId([
                    'user_id' => $customers_id,
                    'customers_newsletter' => 1,
                ]);
            }
                                            
        }
        session(['newsletter' => 1]);
        
        return 'subscribed';
    }


    public function subscribeMail(Request $request){

        
        $settings = $this->index->commonContent();
        $subscribe_email = DB::table('alert_settings')->where('subscribe_email', 1)->first();

        if($subscribe_email != '')
        {
      
                $email = $request->email;

            $emailcheck = DB::table('newsletter_subscribe')->where('email', $email)->where('status', 1)->get();
            if (count($emailcheck) > 0) {
                 print '2';
            }
            else
            {
                $date = date('y-m-d h:i:s');
                $emailchecks = DB::table('newsletter_subscribe')->where('email', $email)->get();
                if (count($emailchecks) > 0) {

                    $newsletter_subscribe_id = $emailchecks[0]->id;

                    DB::table('newsletter_subscribe')->where('id', $newsletter_subscribe_id)->update(['status' => '1']);
                }
                else
                {
                    $newsletter_subscribe_id =DB::table('newsletter_subscribe')->insertGetId([
                        'email' => $email,
                        'created_at' => $date,
                        ]);
                }

                if($newsletter_subscribe_id) {
                    $app_name =$settings['settings']['app_name'];
                    $order_email =$settings['settings']['order_email'];
                    $from = $app_name. "<".$order_email.">";
                    $to = $email;
                    $bcc = $order_email;
                    $api_key = $settings['settings']['mail_chimp_api'];
                    $domain = $settings['settings']['mail_chimp_list_id'];
                    $subject = $settings['settings']['subscription_subject'];
                    $website_link = $settings['settings']['external_website_link'];

                    $imgurl = $website_link.$settings['settings']['website_logo'];

                    $here_link = $website_link.'updatesubscription/'.$newsletter_subscribe_id;

            
                    $html = '<div style="width: 80%;margin: auto;"><div style="text-align:center"><img src="'.$imgurl .'" alt="'.$app_name.'"></div><div style="margin: 50px 0;"><p>'.stripslashes($settings['settings']['subscription_template_body']).'</p></div><div style="background: #f4f4f3;padding:50px;"><p>'.stripslashes($settings['settings']['subscription_template_footer']).'<div style="text-align:center">if you like to unsubscribe, click <a href="'.$here_link.'"> Here</a> </div></p></div></div>';


                     $result=$this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

                     // Insert main count in Superadmin

                    $resuluser = DB::table('users')->where('role_id', 1)->first();
                    $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                    $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                        'email' => $bcc,
                        'comments' => 'Subscribe User',
                        'user_id' => $resuluser->id,
                        'shop_name' => $resuluser->user_name,
                        'shop_id' => $shopmail->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    print '1';
                }else{
                    print '0';
                }
            }

        }else{
            print '0';
        }
        
    }


    public function notifyme(Request $request)
    {

        $notify_email = DB::table('alert_settings')->where('notify_email', 1)->first();

        if($notify_email != '')
        {

        $settings = $this->index->commonContent();
        $email = $request->email;
        $products_id = $request->products_id;

        $emailcheck = DB::table('notify')->where('notify_email', $email)->where('products_id', $products_id)->get();
        if (count($emailcheck) > 0) {
                print '2';
        }
        else
        {
            $date = date('y-m-d h:i:s');
            $notify_id =DB::table('notify')->insertGetId([
                'notify_email' => $email,
                'notify_status' => 1,
                'products_id' => $products_id,
                'created_at' => $date,
                'updated_at' => $date,
                ]);
                

                if($notify_id) {
                   $app_name =$settings['settings']['app_name'];
                    $order_email =$settings['settings']['order_email'];
                    $from = $app_name. "<".$order_email.">";
                    $to = $email;
                    $bcc = $order_email;
                    $api_key = $settings['settings']['mail_chimp_api'];
                    $domain = $settings['settings']['mail_chimp_list_id'];
                    $subject = "Notify Me";
                    $website_link = $settings['settings']['external_website_link'];

                    $imgurl = $website_link.$settings['settings']['website_logo'];

                    $product_image_ids = DB::table('products')->where('products_id', $products_id)->first();
                    $product_names = DB::table('products_description')->where('language_id', 1)->where('products_id', $products_id)->first();
                    $product_name = $product_names->products_name;
                    $product_image_id = $product_image_ids->products_image;

                    $product_image = DB::table('image_categories')->where('image_type', 'ACTUAL')->where('image_id', $product_image_id)->first();
                    $image_path = $product_image->path;

                    $proimgurl = $website_link.$image_path;

                    $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;"><img src="'.$imgurl .'" alt="'.$app_name.'"></div><div style="background: white;padding: 15px;margin-top: 35px;"><p style="text-align:center;">Thanks, we will let you know when this item is available again.</p><h2 style="text-align:center;">'.$product_name.'</h2><div style="text-align:center;"><img src="'.$proimgurl .'" alt="'.$app_name.'" style="width:50%;"></div></div></div>';


                     $result=$this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

                     // Insert main count in Superadmin

                    $resuluser = DB::table('users')->where('role_id', 1)->first();
                    $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                    $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                        'email' => $bcc,
                        'comments' => 'Notify Product',
                        'user_id' => $resuluser->id,
                        'shop_name' => $resuluser->user_name,
                        'shop_id' => $shopmail->id,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    print '1';
                }else{
                    print '0';
                }
            }
        }
    }


    public function updatesubscription($newsletter_subscribe_id){
        DB::table('newsletter_subscribe')->where('id', $newsletter_subscribe_id)->update(['status' => '0']); 
        return redirect('/subscription');   
    }

    public function subscription(Request $request)
    {
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        return view("web.subscription", ['final_theme' => $final_theme])->with('result', $result);
    }

    //setsession
    public function setSession(Request $request){
        session(['device_id'=>$request->device_id]);
        
    }

    public function getloyalty_point(Request $request)
    {
        $userData = DB::table('users')->where('id', '=', $request->user_id)->first();
        $loyalty_point = $userData->loyalty_points;
        return $loyalty_point;
    }

    public function unsubscribehide(Request $request)
    {
        $customers_id = DB::table('newsletter_subscribe_customerhide')->insertGetId([
            'user_id' => $request->user_id,
            'status' => 1,
        ]);
        return $customers_id;
    }


    public function pageNotFound(Request $request)
    {
       
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();

        return view("web.404", ['final_theme' => $final_theme])->with('result', $result);
    }

    public function faq(Request $request)
    {
       
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();

        return view("web.faq", ['final_theme' => $final_theme])->with('result', $result);
    }

    public function coming_soon(Request $request)
    {
       
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();

        return view("web.comingsoon", ['final_theme' => $final_theme])->with('result', $result);
    }

    public function instagram_feed(Request $request)
    {
        // Use curl to fetch the data from instagram
        
        function fetchData($url)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 20);
            $result = curl_exec($curl);
            curl_close($curl); 
            return $result;
        }
	
        // Decode fetched data
        //tags, location, comments, filter, created_time, link, likes, images[low_res, thumbnail, standard_res], users in photo
        
        $instafeed = fetchData('https://www.instagram.com/'.$request->user_id.'/?__a=1');

        //print_r($instafeed);die();
        $instafeed = json_decode($instafeed);

        $instafeed_array = $instafeed->graphql->user->edge_owner_to_timeline_media->edges;

        $folder_path = 'images/instafeed';
    
        // List of name of files inside
        // specified folder
        $files = glob($folder_path.'/*'); 
        
        // Deleting all the files in the list
        foreach($files as $file) {
            if(is_file($file)) 
                // Delete the given file
                unlink($file); 
        }
        DB::table('instagram')->truncate();

	    //print_r($instafeed->graphql->user->edge_owner_to_timeline_media->edges);die();
	
	
	    // Build loop of photos
	
	    $photos = array(); 
        $count = count($instafeed_array);
        $newArray = array_slice($instafeed_array, 0, 8, true);
	
        foreach ( $newArray as $edges ) {
            $url = $edges->node->display_url;
            $img_name = $edges->node->shortcode.'.png';
            $img = 'images/instafeed/'.$img_name; 
            file_put_contents($img, file_get_contents($url));

            DB::table('instagram')->insert([
                'shortcode' => $edges->node->shortcode,
            ]);
        
                       
        }

        $content ='';
        $settings = $this->index->commonContent();
        $website_link = $settings['settings']['external_website_link'];
        

        $content .='<div class="row">';  
        $instafeed = DB::table('instagram')->get();
        if ($instafeed->isNotEmpty()) {
         foreach($instafeed as $insta)
         {
           $shortcode = $insta->shortcode;
           $img = $website_link.'images/instafeed/'. $shortcode . '.png';
           $post = "https://www.instagram.com/p/". $shortcode;
           $direct = "https://www.instagram.com/". $request->user_id;
       
            $content .='<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="padding:5px;">';$content .='<a href="'.$post.'" target="_blank" class="box box--image">';
            $content .='<div class="insta-img-outer">';
            $content .='<img style="width:100%;height:100%" src="'.$img .'" alt="'.$shortcode.'">';
            $content .='</div>';
            $content .='</a>';
            $content .='</div>';
        
       } 
       if ($count == 8) { 
        $content .='
          <div class="col-xl-12 text-center" style="padding:5px;">
          <a href="'.$direct.'" target="_blank" class="box box--image">
           <button class="btn btn-secondary" >Load More</button>
        </a>
        </div>'; 
          

        } }
        $content .='</div>';  

        echo $content;
          
              


    } 


}
