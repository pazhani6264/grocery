<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\AlertController;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Customer;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Order;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Session;
use Socialite;
use Validator;
use Hash;
use File;
use PDF;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CustomersController extends Controller
{

    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Customer $customer,
        Order $order,
        Cart $cart
        
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->customer = $customer;
        $this->order = $order;
        $this->cart = $cart;
        $this->theme = new ThemeController();
    }

    public function signup(Request $request)
    {
        $final_theme = $this->theme->theme();
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {
            $title = array('pageTitle' => Lang::get("website.Sign Up"));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function login(Request $request)
    {
        $result = array();
        $customer = auth()->guard('customer')->user();
        if (auth()->guard('customer')->check() && $customer->phone_verified =='1') {
            return redirect('/');
        } else {
            $result['cart'] = $this->cart->myCart($result);

            if (count($result['cart']) != 0) {
                $result['checkout_button'] = 1;
            } else {
                $result['checkout_button'] = 0;

            }
            $previous_url = Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');

            session(['previous' => $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();
            $cresult = $this->customer->get_country_code();
            //print_r($cresult);die();

            $result['commonContent'] = $this->index->commonContent();
            return view("auth.login", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);
        }

    }
    public function processLogin(Request $request)
    {

    
        $old_session = Session::getId();

        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $customerInfo = array("email" => $request->email, "password" => $request->password, "role_id" => 2);

      

        if (auth()->guard('customer')->attempt($customerInfo)) {
             $customer = auth()->guard('customer')->user();
            
            //insert user agent details
             $ip = $request->ip();
             $browserAgent = $_SERVER['HTTP_USER_AGENT'];
             $data = \Location::get($ip);
             if($data){
                $address=$data->countryName.','.$data->regionName.','.$data->cityName.','.$data->zipCode;
             }else{
                $address='local';
             }
             
                $customid = DB::table('user_agent')->insertGetId([
                    'user_id' => $customer->id,
                    'device_type' => 'web',
                    'device_version' =>$browserAgent,
                    'device_ip' => $ip,
                    'network_address' =>$address,
                    'create_date' => date('Y-m-d H:i:s'),
                ]);
            
           
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    return redirect('login')->with('loginError', Lang::get("website.You Are Not Allowed With These Credentialss!"));
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                 if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

                    
                    return redirect('/otpVerfication'.'/'.$customer->id);
                 }else{
                  
                    return Redirect::to(session('previous'));
                 }
            } else {

                if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);


                    return redirect('/otpVerfication'.'/'.$customer->id);
                }else{
                    Session::forget('guest_checkout');
                    return redirect('/')->with('result', $result);
                }     
            }
        } else {
            return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
        }
        //}
    }

    public function addToCompare(Request $request)
    {
        $cartResponse = $this->customer->addToCompare($request);
        return $cartResponse;
    }

    public function DeleteCompare($id)
    {
        $Response = $this->customer->DeleteCompare($id);
        return redirect('/compare')->with('success',"product removed successfully");
        //return redirect()->back()->with($Response);
    }

    public function Compare()
    {
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $compare = $this->customer->Compare();
        $results = array();
        foreach ($compare as $com) {
            $data = array('products_id' => $com->product_ids, 'page_number' => '0', 'type' => 'compare', 'limit' => '15', 'min_price' => '', 'max_price' => '');
            $newest_products = $this->products->products($data);
            array_push($results, $newest_products);
        }
        $result['products'] = $results;
        return view('web.compare', ['result' => $result, 'final_theme' => $final_theme]);
    }

    public function profile()
    {
        $title = array('pageTitle' => Lang::get("website.Profile"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        //print_r($count);die();
        return view('web.profile', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount'=>$scount,'code'=>$cresult]);
    }


    public function editProfile()
    {
        $title = array('pageTitle' => Lang::get("website.Profile"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        //print_r($count);die();
        return view('web.edit_profile', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount'=>$scount,'code'=>$cresult]);
    }

    public function phoneVer()
    {
        $title = array('pageTitle' => Lang::get("website.Profile"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        //print_r($count);die();
        return view('web.phone_verification', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount'=>$scount,'code'=>$cresult]);
    }

    public function phoneVerSuccess()
    {
        $title = array('pageTitle' => Lang::get("website.Profile"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        //print_r($count);die();
        return view('web.phone_verification_success', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount'=>$scount,'code'=>$cresult]);
    }


    public function updateMyProfile(Request $request)
    {
        $message = $this->customer->updateMyProfile($request);
        return redirect()->back()->with('success', $message);

    }

    public function updateMyPhone(Request $request)
    {
        $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
        if($request->customers_telephone == $user->phone){
            $message = Lang::get("website.Phone number has been updated successfully");
            return redirect()->back()->with('success', $message);
        }else{
          $check = DB::table('users')
          ->where('phone','=', $request->customers_telephone)
          ->where('role_id','=', '2')
          ->where('phone_verified','=', '1')
          ->where('id','!=',auth()->guard('customer')->user()->id)
          ->first(); 
          if(empty($check)){
            $customers_id=auth()->guard('customer')->user()->id;
            $result['commonContent'] = $this->index->commonContent();
            $app_name =$result['commonContent']['settings']['app_name'];
            $result=$this->customer->updateMyPhonenumber($request,$customers_id,$app_name);
            return redirect()->intended('update_phoneotp/'.auth()->guard('customer')->user()->id)->with('result', $result);
          }else{
            $message = 'This phone Number is already taken';
            return redirect()->back()->with('error', $message);
          } 
        }  
    }

    public function updateMyEmail(Request $request)
    {
        $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
       
          $check = DB::table('users')
          ->where('email','=', $request->email)
          ->where('role_id','=', '2')
          ->where('phone_verified','=', '1')
          ->first(); 
          if(empty($check)){
            $customers_id=auth()->guard('customer')->user()->id;
            DB::table('users')->where('id', $customers_id)->update([
                'email' => $request->email ]);
            $message = 'Your Email Address Successfully Updated.';
            return redirect()->back()->with('success', $message);
          }else{
            $message = 'Email Address Already taken';
            return redirect()->back()->with('error', $message);
          } 
        
    }

    public function noEmailCheckout(Request $request)
    {
        $message = 'Add Email Address to checkout your product.';
 
   
        return redirect('profile')->with('success', $message);
      
        
    }

    public function update_phoneotp($id)
    {
        //echo $id;
         $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            $result['user_data'] = DB::table('otp')->where('user_id', $id)->first();
            return view("web.phoneupdateotp", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function processotpupdate(Request $request)
    {
        $phone = $request->phone;
        $userid = $request->id;
        $otp = $request->otp;
        $date = date('y-m-d h:i:s');
        $existUser = DB::table('otp')->where('otp_no', $otp)->where('phone', $phone)->where('user_id', $userid)->where('otp_status', 0)->first();
         if (!$existUser) {
            return redirect('update_phoneotp/'.$userid)->withInput($request->input())->with('error', Lang::get("website.Otp invalid"));
         }else{
            $res = $this->customer->processotpupdate($request);
            if ($res['existUser'] == "true") {
                return redirect('update_phoneotp/'.$id)->withInput($request->input())->with('error', Lang::get("website.Phone already exist"));
            }else{
                $message = Lang::get("website.Phone number has been updated successfully");
                return redirect('profile')->with('success', $message);
        }
            }
         }

    public function changePassword()
    {
        $title = array('pageTitle' => Lang::get("website.Change Password"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();

        return view('web.changepassword', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount' => $scount]);
    }

    public function updateMyPassword(Request $request)
    {
        $password = Auth::guard('customer')->user()->password;
        if (Hash::check($request->current_password, $password)) {
            $message = $this->customer->updateMyPassword($request);
            Auth::guard('customer')->logout();
            session()->flush();
            $request->session()->forget('customers_id');
            $request->session()->regenerate();
            //return redirect('login_nine');
        }else{
            return "1";
        }
    }

    public function logout(REQUEST $request)
    {
        Auth::guard('customer')->logout();
        session()->flush();
        $request->session()->forget('customers_id');
        $request->session()->regenerate();
        return redirect('/');
    }

    public function socialLogin($social)
    {
        // Google client ID

        $gclient_id = DB::table('settings')->where('id', 116)->first();
        $filePath = config_path('services.php');
        $fileContents = file_get_contents($filePath);
        $newClientId = $gclient_id->value;
        $oldClientId = config('services.google.client_id');
        $newFileContents = Str::replaceFirst($oldClientId, $newClientId, $fileContents);
        file_put_contents($filePath, $newFileContents);


        // Google Client secret

        $gclient_secret = DB::table('settings')->where('id', 117)->first();
        $filePath = config_path('services.php');
        $fileContents = file_get_contents($filePath);
        $newClientsecret = $gclient_secret->value;
        $oldClientsecret = config('services.google.client_secret');
        $newFileContents = Str::replaceFirst($oldClientsecret, $newClientsecret, $fileContents);
        file_put_contents($filePath, $newFileContents);


        // Google redirect url
        $user = DB::table('users')->where('role_id', 1)->first();
        if(request()->getHttpHost() == $user->user_name.'.platinum24.net'){
            $gclient_redirect = DB::table('settings')->where('id', 118)->first();
            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $gclient_redirect->value;
            $oldredirect = config('services.google.redirect');
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);
        } else {
            $gclient_redirect = DB::table('settings')->where('id', 225)->first();
            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $gclient_redirect->value;
            $oldredirect = config('services.google.redirect');
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);
        }


        // Facebook Client ID

        $facebookclient_id = DB::table('settings')->where('id', 1)->first();
        $filePath = config_path('services.php');
        $fileContents = file_get_contents($filePath);
        $newClientId = $facebookclient_id->value;
        $oldClientId = config('services.facebook.client_id');
        $newFileContents = Str::replaceFirst($oldClientId, $newClientId, $fileContents);
        file_put_contents($filePath, $newFileContents);


        // Facebook Client secret

        $facebookclient_secret = DB::table('settings')->where('id', 2)->first();
        $filePath = config_path('services.php');
        $fileContents = file_get_contents($filePath);
        $newClientsecret = $facebookclient_secret->value;
        $oldClientsecret = config('services.facebook.client_secret');
        $newFileContents = Str::replaceFirst($oldClientsecret, $newClientsecret, $fileContents);
        file_put_contents($filePath, $newFileContents);


        // Facebook redirect

        $user = DB::table('users')->where('role_id', 1)->first();
        if(request()->getHttpHost() == $user->user_name.'.platinum24.net'){
            $facebookredirect = DB::table('settings')->where('id', 115)->first();
            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $facebookredirect->value;
            $oldredirect = config('services.facebook.redirect');
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);
        } else {
            $facebookredirect = DB::table('settings')->where('id', 224)->first();
            $filePath = config_path('services.php');
            $fileContents = file_get_contents($filePath);
            $newredirect = $facebookredirect->value;
            $oldredirect = config('services.facebook.redirect');
            $newFileContents = Str::replaceFirst($oldredirect, $newredirect, $fileContents);
            file_put_contents($filePath, $newFileContents);
        }

        return Socialite::driver($social)->redirect();
    }

    public function handleSocialLoginCallback($social)
    {
        $result = $this->customer->handleSocialLoginCallback($social);
        
        // if (!empty($result)) {
        //     return redirect('/')->with('result', $result);
        // }
        //print_r($result);die();
        if ($result['customers'][0]->phone_verified == 1) {
            return redirect()->intended('/')->with('result', $result);
        }else{
            return redirect()->intended('socialconfirm_phoneno/'.$result['customers'][0]->id)->with('result', $result);
        }
    }

    public function createRandomPassword()
    {
        $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $pass;
    }

    public function likeMyProduct(Request $request)
    {
        $cartResponse = $this->customer->likeMyProduct($request);
        return $cartResponse;
    }

    public function unlikeMyProduct(Request $request, $id)
    {

        if (!empty(auth()->guard('customer')->user()->id)) {
            $this->customer->unlikeMyProduct($id);
            $message = 'Product is removed from wishlist';
            return redirect()->back()->with('success', $message);
            
        } else {
            return redirect('login')->with('loginError', 'Please login to like product!');
        }

    }

    public function wishlist(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Wishlist"));
        $final_theme = $this->theme->theme();
        $result = $this->customer->wishlist($request);
        return view("web.wishlist", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function loadMoreWishlist(Request $request)
    {

        $limit = $request->limit;

        $data = array('page_number' => $request->page_number, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $myVar = new CartController();
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        return view("web.wishlistproducts")->with('result', $result);

    }

    public function forgotPassword()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {

            $title = array('pageTitle' => Lang::get("website.Forgot Password"));
            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("web.forgotpassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function processPassword(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));

        $password = $this->createRandomPassword();

        $email = $request->email;
        $postData = array();

        //check email exist
        $existUser = $this->customer->ExistUser($email);
        if (count($existUser) > 0) {
        $exitsociallogin = DB::table('customers')->where('user_id', $existUser[0]->id)->first();
        if($exitsociallogin == '')
        {
        if (count($existUser) > 0) {
            $cdate = date('Y-m-d');
            $user_ip = $this->customer->get_client_ip();
            $user_id = DB::table('user_ip_email')->where('ip', $user_ip)->where('email', $existUser[0]->email)->whereDate('created_at',$cdate)->get();
            $count = count($user_id);
        
            if($count < 5)
            {
                $this->customer->UpdateExistUser($email, $password);
                $existUser[0]->password = $password;

                $result['commonContent'] = $this->index->commonContent();
            
            

                $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();

                if($forgot_email != '')
                {

                $app_name =$result['commonContent']['settings']['app_name'];
                $order_email =$result['commonContent']['settings']['order_email'];
                $from = $app_name. "<".$order_email.">";

            
                $to = $existUser[0]->email;
            
                $bcc = '';
                $api_key = $result['commonContent']['settings']['mail_chimp_api'];
                $domain = $result['commonContent']['settings']['mail_chimp_list_id'];
                $subject = 'Forget Password';

            

                $html =  '<div style="width: 100%; display:block;"><h2>'.$app_name.' Password Recovery</h2><p><strong>Hi '.$existUser[0]->first_name.' '.$existUser[0]->last_name.' !</strong><br>You have recently requested to recover your password.<br>Your password is: <strong>'.$password.'</strong><br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>'
                ;
                
                $date = date('Y-m-d H:i:s');
                DB::table('user_ip_email')->insert([
                    'ip' => $user_ip,
                    'email' => $existUser[0]->email,
                    'created_at' => $date,
                ]);


        
                $this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

                // Insert main count in Superadmin

                $resuluser = DB::table('users')->where('role_id', 1)->first();
                $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                    'email' => $bcc,
                    'comments' => 'Forgot Password',
                    'user_id' => $resuluser->id,
                    'shop_name' => $resuluser->user_name,
                    'shop_id' => $shopmail->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

               

                }

            

                return redirect('login')->with('success', Lang::get("website.Password has been sent to your email address"));
            } 
            else {
                return redirect('forgotPassword')->with('error', '“Tried more than Five times “ please try again later');
            }
        }
        else {
            return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
        }
    }
    else {
        return redirect('forgotPassword')->with('error', 'Social login password not able to change');
    }
    }
    else {
        return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
    }

    }

    public function processPassword1(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));

        $password = $this->createRandomPassword();

        $email = $request->email;
        $postData = array();

        //check email exist
        $existUser = $this->customer->ExistUser($email);
        if (count($existUser) > 0) {
        $exitsociallogin = DB::table('customers')->where('user_id', $existUser[0]->id)->first();
        if($exitsociallogin == '')
        {
        if (count($existUser) > 0) {
            $cdate = date('Y-m-d');
            $user_ip = $this->customer->get_client_ip();
            $user_id = DB::table('user_ip_email')->where('ip', $user_ip)->where('email', $existUser[0]->email)->whereDate('created_at',$cdate)->get();
            $count = count($user_id);
        
            if($count < 5)
            {
                $this->customer->UpdateExistUser($email, $password);
                $existUser[0]->password = $password;

                $result['commonContent'] = $this->index->commonContent();
            
            

                $forgot_email = DB::table('alert_settings')->where('forgot_email', 1)->first();

                if($forgot_email != '')
                {

                $app_name =$result['commonContent']['settings']['app_name'];
                $order_email =$result['commonContent']['settings']['order_email'];
                $from = $app_name. "<".$order_email.">";

            
                $to = $existUser[0]->email;
            
                $bcc = '';
                $api_key = $result['commonContent']['settings']['mail_chimp_api'];
                $domain = $result['commonContent']['settings']['mail_chimp_list_id'];
                $subject = 'Forget Password';

            

                $html =  '<div style="width: 100%; display:block;"><h2>'.$app_name.' Password Recovery</h2><p><strong>Hi '.$existUser[0]->first_name.' '.$existUser[0]->last_name.' !</strong><br>You have recently requested to recover your password.<br>Your password is: <strong>'.$password.'</strong><br><br><strong>Sincerely,</strong><br>'.$app_name.'</p></div>'
                ;
                
                $date = date('Y-m-d H:i:s');
                DB::table('user_ip_email')->insert([
                    'ip' => $user_ip,
                    'email' => $existUser[0]->email,
                    'created_at' => $date,
                ]);


        
                $this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

               
                // Insert main count in Superadmin

                $resuluser = DB::table('users')->where('role_id', 1)->first();
                $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                    'email' => $bcc,
                    'comments' => 'Forgot Password',
                    'user_id' => $resuluser->id,
                    'shop_name' => $resuluser->user_name,
                    'shop_id' => $shopmail->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);


                }

            
                return '1';
                //return redirect('login')->with('resetsuccess', Lang::get("website.Password has been sent to your email address"));
            } 
            else {
                return '2';
                //return redirect('login')->with('loginError', '“Tried more than Five times “ please try again later');
            }
        }
        else {
            return '3';
            //return redirect('login')->with('loginError', Lang::get("website.Email address does not exist"));
        }
    }
    else {
        return '4';
        //return redirect('login')->with('loginError', 'Social login password not able to change');
    }
    }
    else {
        return '5';
        //return redirect('login')->with('loginError', Lang::get("website.Email address does not exist"));
    }

    }


    public function recoverPassword()
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));
        $final_theme = $this->theme->theme();
        return view("web.recoverPassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function subscribeNotification(Request $request)
    {

        $setting = $this->index->commonContent();

        /* Desktop */
        $type = 3;

        session(['device_id' => $request->device_id]);

        if (auth()->guard('customer')->check()) {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'created_at' => time(),
                'updated_at' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'user_id' => auth()->guard('customers')->user()->id,
                'manufacturer' => '',
            );

        } else {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'created_at' => time(),
                'updated_at' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'manufacturer' => '',
            );

        }
        $this->customer->updateDevice($request, $device_data);
        print 'success';
    }

    public function signupProcess(Request $request)
    {
        $old_session = Session::getId();

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $gender = $request->gender;
        $email = $request->email;
        $password = $request->password;
        $date = date('y-md h:i:s');
        //        //validation start
        $validator = Validator::make(
            array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'customers_gender' => $request->gender,
                'email' => $request->email,
                'password' => $request->password,
                're_password' => $request->re_password,

            ), array(
                'firstName' => 'required ',
                'lastName' => 'required',
                'customers_gender' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                're_password' => 'required | same:password',
            )
        );
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        } else {

            $res = $this->customer->signupProcess($request);
            //eheck email already exit
            //dd($res);
            if ($res['email'] == "true") {
                return redirect('/login')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
            }else if ($res['phone'] == "true") {
                 return redirect('/login')->withInput($request->input())->with('error', Lang::get("website.Phone Number already exist"));
            } else {
                if ($res['insert'] == "true") {
                    if ($res['auth'] == "true") {
                        //$result = $res['result'];
                        //Session::forget('guest_checkout');
                        $cus_id=$res['cus_id'];
                        return redirect('/otpVerfication'.'/'.$cus_id);
                        //print_r($cus_id);die();
                        //return redirect('/')->with('result', $result);
                    } else {
                        return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
                    }
                } else {
                    return redirect('/login')->with('error', Lang::get("website.something is wrong"));
                }
            }

        }
    }

    public function otpVerfication($id)
    {
        $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $result['user_data'] = DB::table('users')->where('id', $id)->first();
        return view("web.otpverfication", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        //print_r($id);die();
    }
    public function processotpsignup(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
        $old_session = Session::getId();
        $phone = $request->phone;
        $userid = $request->id;
        $otp = $request->otp;
        $date = date('y-m-d h:i:s');
        $existUser = DB::table('otp')->where('otp_no', $otp)->where('phone', $phone)->where('user_id', $userid)->where('otp_status', 0)->first();
        $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '2')->first();
        $level = DB::table('member_type')->where('id', '1')->first();
        if (!$existUser) {
             return redirect('otpVerfication/'.$userid)->withInput($request->input())->with('error', Lang::get("website.Otp invalid"));
        }else{
            $res = $this->customer->processotpsignup($request);
            if ($res['existUser'] == "true") {
                return redirect('otpVerfication/'.$id)->withInput($request->input())->with('error', Lang::get("website.Phone already exist"));
            }else{
                if ($res['auth'] == "true") {
                    //update user create point
                    if($result['commonContent']['settings']['Loyalty']=='1'){
                        if($point){
                        $insert = $this->customer->insert_point($userid,$point->points,$date); 
                        }
                    }

                    $create_customer_email = DB::table('alert_settings')->where('create_customer_email', 1)->first();

                    if($create_customer_email != '')
                    {
                         
                      
                    $existUser = DB::table('users')->where('id', $userid)->first();

                        $app_name =$result['commonContent']['settings']['app_name'];
                        $order_email =$result['commonContent']['settings']['order_email'];
                        $from = $app_name. "<".$order_email.">";
                        $to = $result['commonContent']['settings']['contact_us_email'];
                        $bcc = $existUser->email;
                        $api_key = $result['commonContent']['settings']['mail_chimp_api'];
                        $domain = $result['commonContent']['settings']['mail_chimp_list_id'];
                        $subject = $result['commonContent']['settings']['newuser_subject'];
                        $website_link = $result['commonContent']['settings']['external_website_link'];

                        $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                        if($imagepath->path_type == 'aws')
                        {
                            $imgurl = $result['commonContent']['settings']['website_logo'];
                        }
                        else
                        {
                            $imgurl = $website_link.$result['commonContent']['settings']['website_logo'];
                        }
                        $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;width: 150px;height: 150px;margin: auto;"><img src="'.$imgurl .'" style="height: 100%;width: 100%;object-fit: contain;" alt="'.$app_name.'"></div><div style="background: white;padding: 15px;margin-top: 35px;"><p>'.stripslashes($result['commonContent']['settings']['newuser_template_body']).'</p></div></div>';

                
                        $this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);


                        // Insert main count in Superadmin

                        $resuluser = DB::table('users')->where('role_id', 1)->first();
                        $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                        $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                            'email' => $bcc,
                            'comments' => 'User Login',
                            'user_id' => $resuluser->id,
                            'shop_name' => $resuluser->user_name,
                            'shop_id' => $shopmail->id,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                       

                     }
                    // update user level
                    if($result['commonContent']['settings']['Membertype']=='1'){
                       if($level){
                        $update = $this->customer->update_level($userid,$level->id,$date);  
                       } 
                    }
                    $result = $res['result'];
                    Session::forget('guest_checkout');
                    if(session('login_flag') == 1)
                    {
                        return redirect('viewcart');
                    }
                    else
                    {
                        return redirect()->intended('/')->with('result', $result);
                    }
                }
            }
        }
    }
    public function resendotp($userid,$phone)
    {
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        DB::table('otp')->where('user_id', $userid)->update(['otp_status' => '0','otp_no' => $otpresult]);
        $user = DB::table('users')->where('id', $userid)->first();
        $result['commonContent'] = $this->index->commonContent();
        $app_name =$result['commonContent']['settings']['app_name'];
        $result=$this->customer->sendotp($phone,$otpresult,$user->country_code,$app_name);

        //if($result){
            return redirect('/otpVerfication'.'/'.$userid);
        //}else{
            //return redirect('/otpVerfication'.'/'.$userid)->with('error', Lang::get("website.something is wrong"));  
        //}
    }

    public function resendotpupdate($userid,$phone)
    {
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        DB::table('otp')->where('user_id', $userid)->update(['otp_status' => '0','otp_no' => $otpresult]);
        $user = DB::table('otp')->where('user_id', $userid)->first();
        $result['commonContent'] = $this->index->commonContent();
        $app_name =$result['commonContent']['settings']['app_name'];
        $result=$this->customer->sendotp($phone,$otpresult,$user->ccode,$app_name);

        //if($result){
            return redirect('/update_phoneotp'.'/'.$userid);
        //}else{
            //return redirect('/otpVerfication'.'/'.$userid)->with('error', Lang::get("website.something is wrong"));  
        //}
    }
    public function socialconfirm_phoneno($id)
    {
            $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            $result['user_data'] = DB::table('users')->where('id', $id)->first();
            $cresult = $this->customer->get_country_code();
            return view("web.socialconfirm_phoneno", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);
    }

    public function socialphonenoverfication(Request $request)
    {
        $old_session = Session::getId();
        $id = $request->id;
        $delivery_phone = $request->phone;
        $res = $this->customer->phonenoverfication($request);
        if ($res['phone'] == "true") {
            return redirect('/socialconfirm_phoneno/'.$id)->withInput($request->input())->with('error', Lang::get("website.Phone No  already exist"));
        }else{
            if ($res['insert'] == "true") {
                return redirect('/socialotpVerfication'.'/'.$id);
            }else{
                return redirect('/socialphonenoverfication')->with('error', Lang::get("website.something is wrong"));
            }
        }
    }
    public function socialotpVerfication($id)
    {
        //print_r($id);die();
        $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $result['user_data'] = DB::table('users')->where('id', $id)->first();
        return view("web.socialotpverfication", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function socialprocessotpsignup(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
        $old_session = Session::getId();
        $phone = $request->phone;
        $userid = $request->id;
        $otp = $request->otp;
        $date = date('y-m-d h:i:s');
        $id = $request->id;
        $existUser = DB::table('otp')->where('otp_no', $otp)->where('phone', $phone)->where('user_id', $userid)->where('otp_status', 0)->first();
        $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '2')->first();
        $level = DB::table('member_type')->where('id', '1')->first();
         if (!$existUser) {
            return redirect('socialotpVerfication/'.$id)->withInput($request->input())->with('error', Lang::get("website.Otp invalid"));
         }else{
            //update user create point
            if($result['commonContent']['settings']['Loyalty']=='1'){
            if($point){
                $insert = $this->customer->insert_point($userid,$point->points,$date); 
            }
        }

        $create_customer_email = DB::table('alert_settings')->where('create_customer_email', 1)->first();

        if($create_customer_email != '')
        {
                      
            $existUser = DB::table('users')->where('id', $userid)->first();

                $app_name =$result['commonContent']['settings']['app_name'];
                $order_email =$result['commonContent']['settings']['order_email'];
                $from = $app_name. "<".$order_email.">";
                $to = $result['commonContent']['settings']['contact_us_email'];
                $bcc = $existUser->email;
                $api_key = $result['commonContent']['settings']['mail_chimp_api'];
                $domain = $result['commonContent']['settings']['mail_chimp_list_id'];
                $subject = $result['commonContent']['settings']['newuser_subject'];
                $website_link = $result['commonContent']['settings']['external_website_link'];
                $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                if($imagepath->path_type == 'aws')
                {
                    $imgurl = $result['commonContent']['settings']['website_logo'];
                }
                else
                {
                    $imgurl = $website_link.$result['commonContent']['settings']['website_logo'];
                }

                $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;width: 150px;height: 150px;margin: auto;"><img src="'.$imgurl .'" style="height: 100%;width: 100%;object-fit: contain;" alt="'.$app_name.'"></div><div style="background: white;padding: 15px;margin-top: 35px;"><p>'.stripslashes($result['commonContent']['settings']['newuser_template_body']).'</p></div></div>';

        
                $this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

                // Insert main count in Superadmin

                $resuluser = DB::table('users')->where('role_id', 1)->first();
                $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
                $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                    'email' => $bcc,
                    'comments' => 'User Social Login',
                    'user_id' => $resuluser->id,
                    'shop_name' => $resuluser->user_name,
                    'shop_id' => $shopmail->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

               
                
             }
        // update user level
            if($result['commonContent']['settings']['Membertype']=='1'){
                if($level){
                    $update = $this->customer->update_level($userid,$level->id,$date);  
                } 
            }
            //update otp status
             DB::table('otp')->where('user_id', $userid)->update(['otp_status' => '1']);
             //update user status
             DB::table('users')->where('id', $userid)->update(['status' => '1','phone' => $request->phone,'phone_verified' => 1]);
             return redirect()->intended('/');
         }
    }

    public function socialresendotp($userid,$phone)
    {
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        DB::table('otp')->where('user_id', $userid)->update(['otp_status' => '0','otp_no' => $otpresult]);
        $user = DB::table('users')->where('id', $userid)->first();
        $result['commonContent'] = $this->index->commonContent();
        $app_name =$result['commonContent']['settings']['app_name'];
        $result=$this->customer->sendotp($phone,$otpresult,$user->country_code,$app_name);

        
            return redirect('/socialotpVerfication'.'/'.$userid);
    }

    public function wallet()
    {
        $bankdetail = array();
        $payments_setting = $this->order->payments_setting_for_directbank();
        $bankdetail = array(
                'account_name' => $payments_setting['account_name']->value,
                'account_number' => $payments_setting['account_number']->value,
                'payment_method' => $payments_setting['account_name']->payment_method,
                'bank_name' => $payments_setting['bank_name']->value,
                'short_code' => $payments_setting['short_code']->value,
                'iban' => $payments_setting['iban']->value,
                'swift' => $payments_setting['swift']->value,
        ); 
        $title = array('pageTitle' => 'Wallet');
        $result['commonContent'] = $this->index->commonContent();
        $result['payment_methods'] = $this->getPaymentMethods();
        $data = $this->customer->get_wallet(auth()->guard('customer')->user()->id);
        $final_theme = $this->theme->theme();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        return view('web.wallet', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme,'scount'=>$scount,'wallet'=>$data,'bankdetail'=>$bankdetail]);
    }


    public function getPaymentMethods()
    {

        /*   BRAIN TREE */
        //////////////////////
        $result = array();
        $payments_setting = $this->order->payments_setting_for_brain_tree();
        if ($payments_setting['merchant_id']->environment == '0') {
            $braintree_enviroment = 'Test';
        } else {
            $braintree_enviroment = 'Live';
        }

        $braintree = array(
            'environment' => $braintree_enviroment,
            'name' => $payments_setting['merchant_id']->name,
            'public_key' => $payments_setting['public_key']->value,
            'active' => $payments_setting['merchant_id']->status,
            'payment_method' => $payments_setting['merchant_id']->payment_method,
            'payment_currency' => Session::get('currency_code'),
        );
        /*  END BRAIN TREE */
        //////////////////////

        /*   STRIPE*/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_stripe();
        if ($payments_setting['publishable_key']->environment == '0') {
            $stripe_enviroment = 'Test';
        } else {
            $stripe_enviroment = 'Live';
        }

        $stripe = array(
            'environment' => $stripe_enviroment,
            'name' => $payments_setting['publishable_key']->name,
            'public_key' => $payments_setting['publishable_key']->value,
            'active' => $payments_setting['publishable_key']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['publishable_key']->payment_method,
        );

        /*   END STRIPE*/
        //////////////////////

        /*   CASH ON DELIVERY*/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_cod();

        $cod = array(
            'environment' => 'Live',
            'name' => $payments_setting->name,
            'public_key' => '',
            'active' => $payments_setting->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting->payment_method,
        );

        /*   END CASH ON DELIVERY*/
        /*********/

      
        /*********/

        /*   INSTAMOJO*/
        /*********/
        $payments_setting = $this->order->payments_setting_for_instamojo();
        if ($payments_setting['auth_token']->environment == '0') {
            $instamojo_enviroment = 'Test';
        } else {
            $instamojo_enviroment = 'Live';
        }

        $instamojo = array(
            'environment' => $instamojo_enviroment,
            'name' => $payments_setting['auth_token']->name,
            'public_key' => $payments_setting['api_key']->value,
            'active' => $payments_setting['api_key']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['api_key']->payment_method,
        );

        /*   END INSTAMOJO*/
        /*********/

        /*   END HYPERPAY*/
        /*********/
        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //dd($payments_setting);
        if ($payments_setting['userid']->environment == '0') {
            $hyperpay_enviroment = 'Test';
        } else {
            $hyperpay_enviroment = 'Live';
        }

        $hyperpay = array(
            'environment' => $hyperpay_enviroment,
            'name' => $payments_setting['userid']->name,
            'public_key' => $payments_setting['userid']->value,
            'active' => $payments_setting['userid']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['userid']->payment_method,
        );
        /*   END HYPERPAY*/
        /*********/

        $payments_setting = $this->order->payments_setting_for_razorpay();
        
        if ($payments_setting['RAZORPAY_SECRET']->environment == '0') {
            $razorpay_enviroment = 'Test';
        } else {
            $razorpay_enviroment = 'Live';
        }

        $razorpay = array(
            'environment' => $razorpay_enviroment,
            'public_key' => $payments_setting['RAZORPAY_KEY']->value,
            'name' => $payments_setting['RAZORPAY_KEY']->name,
            'RAZORPAY_KEY' => $payments_setting['RAZORPAY_KEY']->value,
            'RAZORPAY_SECRET' => $payments_setting['RAZORPAY_SECRET']->value,
            'active' => $payments_setting['RAZORPAY_SECRET']->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting['RAZORPAY_SECRET']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_paytm();
        

        if ($payments_setting['paytm_mid']->environment == '0') {
            $paytm_enviroment = 'Test';
        } else {
            $paytm_enviroment = 'Live';
        }

        $paytm = array(
            'environment' => $paytm_enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => '',
            'name' => $payments_setting['paytm_mid']->name,
            'active' => $payments_setting['paytm_mid']->status,
            'payment_method' => $payments_setting['paytm_mid']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_directbank();     

        if ($payments_setting['account_name']->environment == '0') {
            $enviroment = 'Live';
        } else {
            $enviroment = 'Live';
        }

        $banktransfer = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => '',
            'name' => $payments_setting['account_name']->name,
            'descriptions' => $payments_setting['account_name']->sub_name_1,
            'active' => $payments_setting['account_name']->status,
            'payment_method' => $payments_setting['account_name']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_paystack();   
        if ($payments_setting['secret_key']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $paystack = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['secret_key']->value,
            'name' => $payments_setting['secret_key']->name,
            'active' => $payments_setting['secret_key']->status,
            'payment_method' => $payments_setting['secret_key']->payment_method,
        );

        $payments_setting = $this->order->payments_setting_for_midtrans();  

        if ($payments_setting['merchant_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $midtrans = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['server_key']->value,
            'name' => $payments_setting['merchant_id']->name,
            'active' => $payments_setting['merchant_id']->status,
            'payment_method' => $payments_setting['merchant_id']->payment_method,
        ); 
         /*   ipay88 */
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_ipay88();  

        if ($payments_setting['merchant_code']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $ipay88 = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['merchant_key']->value,
            'merchant_code'=> $payments_setting['merchant_code']->value,
            'name' => $payments_setting['merchant_code']->name,
            'active' => $payments_setting['merchant_code']->status,
            'payment_method' => $payments_setting['merchant_code']->payment_method,
        );

        /* paynet_fpx */
        ////////////////////// 

        $payments_setting = $this->order->payments_setting_for_paynet_fpx();  

        if ($payments_setting['seller_ex_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $paynetfpx = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['seller_id']->value,
            'merchant_code'=> $payments_setting['seller_ex_id']->value,
            'name' => $payments_setting['seller_ex_id']->name,
            'active' => $payments_setting['seller_ex_id']->status,
            'payment_method' => $payments_setting['seller_ex_id']->payment_method,

        );

         /* PremierPay */
        ////////////////////// 

        $payments_setting = $this->order->payments_setting_for_premierpay();  

        if ($payments_setting['store_id']->environment == '0') {
            $enviroment = 'Test';
        } else {
            $enviroment = 'Live';
        }

        $premierpay = array(
            'environment' => $enviroment,
            'payment_currency' => Session::get('currency_code'),
            'public_key' => $payments_setting['store_id']->value,
            'merchant_code'=> $payments_setting['store_key']->value,
            'name' => $payments_setting['store_id']->name,
            'active' => $payments_setting['store_id']->status,
            'payment_method' => $payments_setting['store_id']->payment_method,
            'redirect_url' => $payments_setting['store_id']->value,
            'callback_url' => $payments_setting['store_id']->value,
            'store_key' => $payments_setting['store_key']->value,
            'store_id'=> $payments_setting['store_id']->value,
        );

        //$result[0] = $braintree;
        //$result[1] = $stripe;
        //$result[2] = $cod;
        //$result[4] = $instamojo;
        //$result[5] = $hyperpay;
        //$result[6] = $razorpay;
        $result[7] = $paytm;
        $result[8] = $banktransfer;
        //$result[9] = $paystack;
        //$result[10] = $midtrans;
        $result[11] = $ipay88;
        //$result[12] = $paynetfpx;
        //$result[13] = $premierpay;
        return $result;
    }

    public function merchantlogin($id)
    {
        $data=DB::table('booking_table')->where('qrcode', $id)->whereIn('status', ['reserved', 'checkin'])->first();
        if($data){
            $result = array();
            $title = array('pageTitle' => 'Merchant login');
            $final_theme = $this->theme->theme();
            $result['commonContent'] = $this->index->commonContent();
            session(['table_qrcode' => $id]);
            return view("auth.merchant_login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
      }else{
            echo 'Invalid Table Booking Qrcode';
      }
    }
    public function guestMerchant()
    {
        session(['guest_checkout' => 1]);
        return redirect('/');
    }



    public function profile_update_phoneotp(Request $request)
    {
        $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first();
        if($request->customers_telephone == $user->phone){
            $message = Lang::get("website.Phone number has been updated successfully");
            return redirect()->back()->with('success', $message);
        }else{
          $check = DB::table('users')
          ->where('phone','=', $request->customers_telephone)
          ->where('role_id','=', '2')
          ->where('phone_verified','=', '1')
          ->where('id','!=',auth()->guard('customer')->user()->id)
          ->first(); 
          if(empty($check)){
            $customers_id=auth()->guard('customer')->user()->id;
            $result['commonContent'] = $this->index->commonContent();
            $app_name =$result['commonContent']['settings']['app_name'];
            $result=$this->customer->profileupdateMyPhonenumber($request,$customers_id,$app_name);
            //return redirect()->intended('profile_otp_verification/'.auth()->guard('customer')->user()->id)->with('result', $result);
          }else{
            return '1';
          } 
        }  
    }


    public function profile_otp_verification($id)
    {
        //echo $id;
         $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();

            $result['user_data'] = DB::table('otp')->where('user_id', $id)->first();
            return view("web.profile_otp_verification", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('scount',$scount);
    }

    public function profile_resendotp_verification($userid,$phone)
    {
        $digits = 6;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        DB::table('otp')->where('user_id', $userid)->update(['otp_status' => '0','otp_no' => $otpresult]);
        $user = DB::table('otp')->where('user_id', $userid)->first();
        $result['commonContent'] = $this->index->commonContent();
        $app_name =$result['commonContent']['settings']['app_name'];
        $result=$this->customer->sendotp($phone,$otpresult,$user->ccode,$app_name);

        //if($result){
            return redirect('/profile_otp_verification'.'/'.$userid);
        //}else{
            //return redirect('/otpVerfication'.'/'.$userid)->with('error', Lang::get("website.something is wrong"));  
        //}
    }


    public function ck_otp_isvalid(Request $request){


        $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();

        $userid = $request->id;
        $ccode = $request->ccode;
        $phone = $request->phone;
        $otp = $request->otp1.''.$request->otp2.''.$request->otp3.''.$request->otp4.''.$request->otp5.''.$request->otp6;

        $cphone = $ccode.''.$phone;

        $chk = DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','0')->first();

        if($chk){
            return "2";
        }else{
            return "1";
        }

    }

    public function update_otp_profile(Request $request){


        $title = array('pageTitle' => Lang::get("website.OTP Verfication"));
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();

        $userid = $request->id;
        $ccode = $request->ccode;
        $phone = $request->phone;
        $otp = $request->otp1.''.$request->otp2.''.$request->otp3.''.$request->otp4.''.$request->otp5.''.$request->otp6;

        $cphone = $ccode.''.$phone;

        $chk = DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','0')->first();

        if($chk){
            DB::table('otp')->where('user_id', $userid)->where('ccode',$ccode)->where('phone',$phone)->where('otp_no',$otp)->where('otp_status','0')->update(['otp_status' => '1']);

            DB::table('users')->where('id', $userid)->update(['phone' => $phone,'country_code' => $ccode ]);

            return view("web.phone_verification_success", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('scount',$scount)->with('cphone',$cphone);
        }else{
            return "1";
        }

    }




    public function walletSend()
    {
        //print_r($id);die();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $scount = DB::table('customers')->where('user_id', auth()->guard('customer')->user()->id)->count();
        return view("web.wallet_send", ['final_theme' => $final_theme])->with('result', $result)->with('scount',$scount);
    }
    public function register()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {


            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();
            $cresult = $this->customer->get_country_code();
            

            $result['commonContent'] = $this->index->commonContent();
            return view("web.register", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);
        }
    }

    public function register1()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {


            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();
            $cresult = $this->customer->get_country_code();
            

            $result['commonContent'] = $this->index->commonContent();
            return view("web.register1", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);
        }
    }

    public function LoginModalShow(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("auth.logins.login4",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function LoginModalShow1(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("auth.logins.login5",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function LoginModalShow2(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("auth.logins.login6",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function LoginModalShow3(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("auth.logins.login7",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function LoginModalShow4(Request $request)
    {
        
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("auth.logins.login8",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }



    public function processLoginMolla(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $customerInfo = array("email" => $request->email, "password" => $request->password, "role_id" => 2);

      
        if (auth()->guard('customer')->attempt($customerInfo)) {
             $customer = auth()->guard('customer')->user();

            //insert user agent details
             $ip = $request->ip();
             $browserAgent = $_SERVER['HTTP_USER_AGENT'];
             $data = \Location::get($ip);
             if($data){
                $address=$data->countryName.','.$data->regionName.','.$data->cityName.','.$data->zipCode;
             }else{
                $address='local';
             }
             
                $customid = DB::table('user_agent')->insertGetId([
                    'user_id' => $customer->id,
                    'device_type' => 'web',
                    'device_version' =>$browserAgent,
                    'device_ip' => $ip,
                    'network_address' =>$address,
                    'create_date' => date('Y-m-d H:i:s'),
                ]);
            
           
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    $data = array('status'=>'2');
                    return $data;
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                 if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);
                    $data = array('status'=>'3','userID'=>$customer->id);
                    return $data;
                 }else{
                    return Redirect::to(session('previous'));
                 }
            } else {

                if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);
                    $data = array('status'=>'3','userID'=>$customer->id);
                    return $data;
                }else{
                    Session::forget('guest_checkout');
                    return redirect('/')->with('result', $result);
                }     
            }
        } else {
            $data = array('status'=>'1');
            return $data;
        }
        //}
    }


    public function loginNine(Request $request)
    {
        $result = array();
        $customer = auth()->guard('customer')->user();
        if (auth()->guard('customer')->check() && $customer->phone_verified =='1') {
            if(session('login_flag') == 1)
            {
                return redirect('viewcart');
            }
            else
            {
            return redirect('/');
            }
        } else {
            $result['cart'] = $this->cart->myCart($result);

            if (count($result['cart']) != 0) {
                $result['checkout_button'] = 1;
            } else {
                $result['checkout_button'] = 0;

            }
            $previous_url = Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');

            session(['previous' => $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();
            $cresult = $this->customer->get_country_code();
            //print_r($cresult);die();

            $result['commonContent'] = $this->index->commonContent();
            return view("auth.logins.login9", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);
        }

    }


    public function processLoginNine(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $customerInfo = array("email" => $request->email, "password" => $request->password, "role_id" => 2);

      

        if (auth()->guard('customer')->attempt($customerInfo)) {
             $customer = auth()->guard('customer')->user();
            

            //insert user agent details
             $ip = $request->ip();
             $browserAgent = $_SERVER['HTTP_USER_AGENT'];
             $data = \Location::get($ip);
             if($data){
                $address=$data->countryName.','.$data->regionName.','.$data->cityName.','.$data->zipCode;
             }else{
                $address='local';
             }
             
                $customid = DB::table('user_agent')->insertGetId([
                    'user_id' => $customer->id,
                    'device_type' => 'web',
                    'device_version' =>$browserAgent,
                    'device_ip' => $ip,
                    'network_address' =>$address,
                    'create_date' => date('Y-m-d H:i:s'),
                ]);
            
           
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    return redirect('login')->with('loginError', Lang::get("website.You Are Not Allowed With These Credentialss!"));
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                 if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);


                    return redirect('/otpVerfication'.'/'.$customer->id);
                 }else{
                  
                    return Redirect::to(session('previous'));
                 }
            } else {

                if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

            
                    return redirect('/otpVerfication'.'/'.$customer->id);
                }else{
                    Session::forget('guest_checkout');
                    return redirect('/')->with('result', $result);
                }     
            }
        } else {
            return redirect('login_nine')->with('loginError', Lang::get("website.Email or password is incorrect"));
        }
        //}
    }



    public function lPoint(Request $request){
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("web.loyality.loyality",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }


    public function ePoint(Request $request){
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("web.loyality.earn_point",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function gPoint(Request $request){
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("web.loyality.get_point",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }

    public function accPoint(Request $request){
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("web.loyality.acc_point",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }


    public function helpPoint(Request $request){
        $title = array('pageTitle' => Lang::get("website.Login"));
        $final_theme = $this->theme->theme();
        $cresult = $this->customer->get_country_code();


        $result['commonContent'] = $this->index->commonContent();
        return view("web.loyality.help_point",['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('code', $cresult);
    }



    public function signupProcessMolla(Request $request)
    {

        $exuser =  DB::table('users')->where('role_id', 2)->where('phone_verified', '=', '0')->get();
        foreach($exuser as $users){
            $existUserotp = DB::table('otp')->where('user_id', $users->id)->delete();
            $existUser = DB::table('users')->where('id', $users->id)->delete();
        }
        
        $user_email = DB::table('users')->select('email')->where('role_id', 2)->where('email', $request->email)->get();
        //check phone already exit
        $user_phone = DB::table('users')->select('phone')->where('role_id', 2)->where('phone', $request->phone)->get();


        if (count($user_email) > 0) {
            $res['email'] = "true";
            return $res;
        }else if (count($user_phone) > 0) { 
            $res['phone'] = "true";
            $res['email'] = "false";
            return $res;   
        } else {
            $res['email'] = "false";
            $res['phone'] = "false";
            return $res;   
        }

    }

    public function loginPdf(Request $request)
    {
       $pdf = PDF::loadView('web.pdf_view');
       return $pdf->download('pdf_file.pdf');
    }



    public function tableLogin(Request $request)
    {
        $result = array();
        $customer = auth()->guard('customer')->user();
       
            $result['cart'] = $this->cart->myCart($result);

            if (count($result['cart']) != 0) {
                $result['checkout_button'] = 1;
            } else {
                $result['checkout_button'] = 0;

            }
            $previous_url = Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');

            session(['previous' => $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();
            $cresult = $this->customer->get_country_code();
            //print_r($cresult);die();

            $result['commonContent'] = $this->index->commonContent();
            return view("auth.table-login", ['title' => $title, 'final_theme' => $final_theme,'code'=>$cresult])->with('result', $result);

    }


    public function processLoginTable(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        //check authentication of email and password
        $customerInfo = array("email" => $request->email, "password" => $request->password, "role_id" => 2);

      
        if (auth()->guard('customer')->attempt($customerInfo)) {
             $customer = auth()->guard('customer')->user();
            

            //insert user agent details
             $ip = $request->ip();
             $browserAgent = $_SERVER['HTTP_USER_AGENT'];
             $data = \Location::get($ip);
             if($data){
                $address=$data->countryName.','.$data->regionName.','.$data->cityName.','.$data->zipCode;
             }else{
                $address='local';
             }
             
                $customid = DB::table('user_agent')->insertGetId([
                    'user_id' => $customer->id,
                    'device_type' => 'web',
                    'device_version' =>$browserAgent,
                    'device_ip' => $ip,
                    'network_address' =>$address,
                    'create_date' => date('Y-m-d H:i:s'),
                ]);
            
           
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    return "2";
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                 if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

                  

                    return redirect('/otpVerfication'.'/'.$customer->id);
                 }else{
                  
                    return Redirect::to(session('previous'));
                 }
            } else {

                if($customer->phone_verified == '0'){
                    $result['commonContent'] = $this->index->commonContent();
                    $app_name =$result['commonContent']['settings']['app_name'];
                    $result=$this->customer->sendotp_login($customer->phone,$otpresult,$customer->country_code,$customer->id,$app_name);

                
                    return redirect('/otpVerfication'.'/'.$customer->id);
                }else{
                    Session::forget('guest_checkout');
                    return redirect('/')->with('result', $result);
                }     
            }
        } else {
            return "1";
        }
        //}
    }
    
   
}
