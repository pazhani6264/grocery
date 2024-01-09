<?php

namespace App\Models\Web;

use App\Http\Controllers\Web\AlertController;
use App\Models\Web\Index;
use App\Models\Web\Products;
use App\User;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Lang;
use Session;
use Socialite;
use Illuminate\Support\Str;

class Customer extends Model
{

    public function addToCompare($request)
    {
        if (!empty(auth()->guard('customer')->user()->id)) {
            $check = DB::table('compare')->where('product_ids', $request->product_id)->where('customer_id', auth()->guard('customer')->user()->id)->first();
            if (!$check) {
                $id = DB::table('compare')
                    ->insertGetId([
                        'product_ids' => $request->product_id,
                        'customer_id' => auth()->guard('customer')->user()->id,
                    ]);
                    $count = DB::table('compare')->where('customer_id', auth()->guard('customer')->user()->id)->count();
                    return $count;
            }
            else {
                $responseData = array('success' => '0', 'message' => Lang::get("Product already added to compare list"));
            }
           
        } else {
            $responseData = array('success' => '0', 'message' => Lang::get("website.Please Login First!"));
        }
        $cartResponse = json_encode($responseData);
        return $cartResponse;
    }

    public function DeleteCompare($id)
    {
        DB::table('compare')->where('product_ids', $id)->where('customer_id', auth()->guard('customer')->user()->id)->delete();
        $responseData = array('success' => '1', 'message' => Lang::get("website.Removed Successfully"));
        return $responseData;
    }
    public function updateMyProfile($request)
    {

        $customers_id = auth()->guard('customer')->user()->id;
        $customers_firstname = $request->customers_firstname;
        $customers_lastname = $request->customers_lastname;
        $customers_fax = $request->fax;
        $customers_newsletter = $request->newsletter;
        //$customers_telephone = $request->customers_telephone;
        $customers_gender = $request->gender;
      
        $customers_info_date_account_last_modified = date('y-m-d h:i:s');

        $customers_dob = $request->customers_dob;
        if( $customers_dob != '')
        {
            if(auth()->guard('customer')->user()->dob == '')
            {
            $tempArr=explode('/', $request->customers_dob);
            $customers_dob=$tempArr[2].'-'.$tempArr[1].'-'.$tempArr[0];
            $dob_created_date = date('Y-m-d');
            }
            else
            {
                $tempArr=explode('/', $request->customers_dob);
                $customers_dob=$tempArr[2].'-'.$tempArr[1].'-'.$tempArr[0];
                $dob_created_date = auth()->guard('customer')->user()->dob_created_date;
            }

        }
        else
        {
            $dob_created_date = " ";
        }
      

        $extensions = array('gif', 'jpg', 'jpeg', 'png');
        if ($request->hasFile('picture') and in_array($request->picture->extension(), $extensions)) {
            $image = $request->picture;
            $fileName = time() . '.' . $image->getClientOriginalName();
            $image->move('resources/assets/images/user_profile/', $fileName);
            $customers_picture = 'resources/assets/images/user_profile/' . $fileName;
        } else {
            $customers_picture = $request->customers_old_picture;
        }

        $customer_data = array(
            'first_name' => $customers_firstname,
            'last_name' => $customers_lastname,
            //'phone' => $customers_telephone,
            'gender' => $customers_gender,
            'dob' => $customers_dob,
            'dob_created_date' => $dob_created_date,
            'avatar' => $customers_picture,
            'updated_at' => date('Y-m-d H:i:s'),
        );

        //update into customer
        DB::table('users')->where('id', $customers_id)->update($customer_data);

        DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified' => $customers_info_date_account_last_modified]);
        $message = Lang::get("website.Profile has been updated successfully");

        return $message;

    }

    public function updateMyPassword($request)
    {

        $old_session = Session::getId();
        $customers_id = auth()->guard('customer')->user()->id;
        $new_password = $request->new_password;
        $current_password = $request->current_password;

        $updated_at = date('y-m-d h:i:s');
        $customers_info_date_account_last_modified = date('y-m-d h:i:s');

        $customer_data = array(
            'password' => bcrypt($new_password),
            'check_password' => $new_password,
            'updated_at' => date('y-m-d h:i:s'),
        );

        $userData = DB::table('users')->where('id', $customers_id)->update($customer_data);
        $user = DB::table('users')->where('id', $customers_id)->get();

        DB::table('customers_info')->where('customers_info_id', $customers_id)->update(['customers_info_date_account_last_modified' => $customers_info_date_account_last_modified]);

        $message = Lang::get("website.Password has been updated successfully");
        return $message;

    }
    public function createRandomPassword()
    {
        $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $pass;
    }

    public function handleSocialLoginCallback($social)
    {
        $index = new Index();
        $exuser =  DB::table('users')->where('role_id', 2)->where('phone_verified', '=', '0')->get();
        foreach($exuser as $users){
            $existUsercustomer = DB::table('customers')->where('user_id', $users->id)->delete();
            $existUserInfo = DB::table('customers_info')->where('customers_info_id', $users->id)->delete();
            $existUserotp = DB::table('otp')->where('user_id', $users->id)->delete();
            $existUseronline = DB::table('whos_online')->where('customer_id',$users->id)->delete();
            $existUser = DB::table('users')->where('id', $users->id)->delete();
        }

        $old_session = Session::getId();

        $user = Socialite::driver($social)->stateless()->user();
        $password = $this->createRandomPassword();
        // OAuth Two Providers
        $token = $user->token;
        if (!empty($user['gender'])) {
            if ($user['gender'] == 'male') {
                $customers_gender = '0';
            } else {
                $customers_gender = '1';
            }
        } else {
            $customers_gender = '0';
        }

        // All Providers
        $social_id = $user->getId();

        $customers_firstname = substr($user->getName(), 0, strpos($user->getName(), ' '));
        $customers_lastname = str_replace($customers_firstname . ' ', '', $user->getName());

        $email = $user->getEmail();
       

        if ($social == 'facebook') {

           

            $existUser = DB::table('customers')
                ->Where('customers.fb_id', '=', $social_id)->get();
    
            if (count($existUser) > 0) {
               
                
                $customers_id = $existUser[0]->user_id;

                $fb_user = DB::table('users')->where('id', '=', $customers_id)->first();
                $email = $fb_user->email;

                //update data of customer
                DB::table('users')->where('id', '=', $customers_id)->update([
                    'first_name' => $customers_firstname,
                    'last_name' => $customers_lastname,
                    'password' => Hash::make($password),
                    'status' => '1',
                    'created_at' => time(),
                ]);
                DB::table('customers')->where('user_id', '=', $customers_id)->update([
                    'fb_id' => $social_id,
                ]);
            } else {
                //insert data of customer
               

                $customers_id = DB::table('users')->insertGetId([
                    'role_id' => 2,
                    'first_name' => $customers_firstname,
                    'last_name' => $customers_lastname,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'status' => '1',
                    'api_token' => Str::random(80),
                    'created_at' => time(),
                ]);
                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $index->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customer_id.$str;

                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

                DB::table('customers')->insertGetId([
                    'user_id' => $customers_id,
                    'fb_id' => $social_id,
                ]);
                
            }
        }

        if ($social == 'google') {

            $existUser = DB::table('users')
                ->Where('users.email', '=', $email)->get();

            $customers_firstname_new=substr($email, 0, strrpos($email, '@'));

            if (count($existUser) > 0) {

                $customers_id = $existUser[0]->id;

                //update data of customer
                DB::table('users')->where('id', '=', $customers_id)->update([
                    'first_name' => $customers_firstname_new,
                    'last_name' => $customers_lastname,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'status' => '1',
                    'created_at' => time(),
                ]);
                $socialexistUser = DB::table('customers')
                ->Where('user_id', '=', $customers_id)->get();
                if (count($socialexistUser) > 0) {
                    DB::table('customers')->where('user_id', '=', $customers_id)->update([
                        'google_id' => $social_id,
                    ]);
                }
                else
                {
                    DB::table('customers')->insertGetId([
                        'user_id' => $customers_id,
                        'google_id' => $social_id,
                    ]);
                }
            } else {
                //insert data of customer
                $customers_id = DB::table('users')->insertGetId([
                    'role_id' => 2,
                    'first_name' => $customers_firstname_new,
                    'last_name' => $customers_lastname,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'status' => '1',
                    'api_token' => Str::random(80),
                    'created_at' => time(),
                ]);
                
                // update user api_token
                $timestamp=date('YmdHis');
                $qdata=$customers_id.'|'.$timestamp.'|001';
                $qrcode = $index->getResEncryption($qdata);

                //user member id
                $str = Str::random(10);
                $code='MI'.$customer_id.$str;
                
                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

                DB::table('customers')->insertGetId([
                    'user_id' => $customers_id,
                    'google_id' => $social_id,
                ]);
            }
        }

        $userData = DB::table('users')->where('id', '=', $customers_id)->get();

        $existUserInfo = DB::table('customers_info')->where('customers_info_id', $customers_id)->get();
        $customers_info_id = $customers_id;
        $customers_info_date_of_last_logon = date('Y-m-d H:i:s');
        $customers_info_number_of_logons = '1';
        $customers_info_date_account_created = date('Y-m-d H:i:s');
        $global_product_notifications = '1';

        if (count($existUserInfo) > 0) {
            //update customers_info table
            DB::table('customers_info')->where('customers_info_id', $customers_info_id)->update([
                'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                'global_product_notifications' => $global_product_notifications,
                'customers_info_number_of_logons' => DB::raw('customers_info_number_of_logons + 1'),
            ]);

        } else {

            //insert customers_info table
            $customers_default_address_id = DB::table('customers_info')->insertGetId([
                'customers_info_id' => $customers_info_id,
                'customers_info_date_of_last_logon' => $customers_info_date_of_last_logon,
                'customers_info_number_of_logons' => $customers_info_number_of_logons,
                'customers_info_date_account_created' => $customers_info_date_account_created,
                'global_product_notifications' => $global_product_notifications,
            ]);

        }

        //check if already login or not
        $already_login = DB::table('whos_online')->where('customer_id', '=', $customers_id)->get();
        if (count($already_login) > 0) {
            DB::table('whos_online')
                ->where('customer_id', $customers_id)
                ->update([
                    'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                    'time_entry' => date('Y-m-d H:i:s'),
                ]);
        } else {
            DB::table('whos_online')
                ->insert([
                    'full_name' => $userData[0]->first_name . ' ' . $userData[0]->last_name,
                    'time_entry' => date('Y-m-d H:i:s'),
                    'customer_id' => $customers_id,
                ]);
        }

       

        $customerInfo = array("email" => $email, "password" => $password, "role_id" => 2);
        
       
        $old_session = Session::getId();

        if (auth()->guard('customer')->attempt($customerInfo)) {
            
            $customer = auth()->guard('customer')->user();

            //set session
            session(['customers_id' => $customer->id]);

            //cart
            $cart = DB::table('customers_basket')->where([
                ['session_id', '=', $old_session],
            ])->get();

            if (count($cart) > 0) {
                foreach ($cart as $cart_data) {
                    $exist = DB::table('customers_basket')->where([
                        ['customers_id', '=', $customer->id],
                        ['products_id', '=', $cart_data->products_id],
                        ['is_order', '=', '0'],
                    ])->delete();
                }
            }

            DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            //insert device id
            if (!empty(session('device_id'))) {
                DB::table('devices')->where('device_id', session('device_id'))->update(['user_id' => $customer->id]);
            }

            $result['customers'] = DB::table('users')->where('id', $customer->id)->get();

          

            $this->getdobreward($customer->id);
            return $result;
        }
        $result = "";
        return $result;

    }

    public function likeMyProduct($request)
    {

        if (!empty(auth()->guard('customer')->user()->id)) {
            $liked_products_id = $request->products_id;

            $liked_customers_id = auth()->guard('customer')->user()->id;
            $date_liked = date('Y-m-d H:i:s');

            //to avoide duplicate record
            $record = DB::table('liked_products')->where([
                'liked_products_id' => $liked_products_id,
                'liked_customers_id' => $liked_customers_id,
            ])->get();

            if (count($record) > 0) {

                DB::table('liked_products')->where([
                    'liked_products_id' => $liked_products_id,
                    'liked_customers_id' => $liked_customers_id,
                ])->delete();

                $total_wishlist = 0;
                if (!empty(session('customers_id'))) {
                    $total_wishlist = DB::table('liked_products')
                        ->leftjoin('products', 'products.products_id', '=', 'liked_products.liked_products_id')
                        ->where('products_status', '1')
                        ->where('liked_customers_id', '=', session('customers_id'))->count();
                }

                DB::table('products')->where('products_id', '=', $liked_products_id)->decrement('products_liked');
                $products = DB::table('products')->where('products_id', '=', $liked_products_id)->get();

                $responseData = array('success' => '1', 'message' => Lang::get("website.Product is disliked"), 'total_likes' => $products[0]->products_liked, 'id' => 'like_count_' . $liked_products_id, 'total_wishlist' => $total_wishlist);
            } else {

                DB::table('liked_products')->insert([
                    'liked_products_id' => $liked_products_id,
                    'liked_customers_id' => $liked_customers_id,
                    'date_liked' => $date_liked,
                ]);
                DB::table('products')->where('products_id', '=', $liked_products_id)->increment('products_liked');

                $total_wishlist = 0;
                if (!empty(session('customers_id'))) {
                    $total_wishlist = DB::table('liked_products')
                        ->leftjoin('products', 'products.products_id', '=', 'liked_products.liked_products_id')
                        ->where('products_status', '1')
                        ->where('liked_customers_id', '=', session('customers_id'))->count();
                }
                $products = DB::table('products')->where('products_id', '=', $liked_products_id)->get();

                $responseData = array('success' => '2', 'message' => Lang::get("website.Product is liked"), 'total_likes' => $products[0]->products_liked, 'id' => 'like_count_' . $liked_products_id, 'total_wishlist' => $total_wishlist);

            }

        } else {
            $responseData = array('success' => '0', 'message' => Lang::get("website.Please login first to like this product"));
        }
        $cartResponse = json_encode($responseData);
        return $cartResponse;
    }

    public function unlikeMyProduct($id)
    {

        $liked_products_id = $id;

        $liked_customers_id = auth()->guard('customer')->user()->id;

        DB::table('liked_products')->where([
            'liked_products_id' => $liked_products_id,
            'liked_customers_id' => $liked_customers_id,
        ])->delete();

        DB::table('products')->where('products_id', '=', $liked_products_id)->decrement('products_liked');

    }

    public function wishlist($request)
    {
        $index = new Index();
        $productss = new Products();
        $result = array();
        $result['commonContent'] = $index->commonContent();

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $data = array('page_number' => 0, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
        $products = $productss->products($data);
        $result['products'] = $products;
        $cart = '';
        $result['cartArray'] = $productss->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $productss->likedProducts();
        if ($limit > $result['products']['total_record']) {
            $result['limit'] = $result['products']['total_record'];
        } else {
            $result['limit'] = $limit;
        }

        //echo '<pre>'.print_r($result['products'], true).'</pre>';
        return $result;
    }

    public function processLogin($request, $old_session)
    {
        $result = array();
        $customer = auth()->guard('customer')->user();
        session(['guest_checkout' => 0]);

        //set session
        session(['customers_id' => $customer->id]);

        //cart
        $cart = DB::table('customers_basket')->where([
            ['session_id', '=', $old_session],
        ])->get();

        if (count($cart) > 0) {
            foreach ($cart as $cart_data) {
                $exist = DB::table('customers_basket')->where([
                    ['customers_id', '=', $customer->id],
                    ['products_id', '=', $cart_data->products_id],
                    ['is_order', '=', '0'],
                ])->delete();
            }
        }

        DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
            'customers_id' => $customer->id,
        ]);

        DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
            'customers_id' => $customer->id,
        ]);

        //insert device id
        if (!empty(session('device_id'))) {
            DB::table('devices')->where('device_id', session('device_id'))->update(['user_id' => $customer->id]);
        }

        $result['customers'] = DB::table('users')->where('id', $customer->id)->get();

        $this->getdobreward($customer->id);
        return $result;

    }

    public function getdobreward($customer_id)
    {
        //insert point details

        $result['customers'] = DB::table('users')->where('id', $customer_id)->get();

        $created_at = $result['customers'][0]->created_at;
        $dob_created_date = $result['customers'][0]->dob_created_date;
        $dob = $result['customers'][0]->dob;
        $loyalty_points = $result['customers'][0]->loyalty_points;
        $points = $loyalty_points + 1000;
        $current_date = date("Y-m-d");
        $created_date = date("Y-m-d",strtotime($created_at));
        $dob_check = date("m-d",strtotime($dob));
        $date = date('Y-m-d H:i:s');
        $current_year = date("Y");
        $new_date = $current_year.'-'.$dob_check;
        if($dob !="")
        {
            if($current_date != $dob_created_date)
            {
                $year_check = DB::table('transaction_points')->where('user_id', $customer_id)->where('type', 'dob')->whereYear('created_at', date('Y'))->get();
                if (count($year_check) > 0) {
                    DB::table('users')->where('id', '=', $customer_id)->update([
                        'dob_status' => 0,
                    ]);
                   
                }
                else
                {
                    if($current_date >= $new_date)
                    {
                        $dob_check = DB::table('users')->where('id', $customer_id)->where('dob_status', 0)->get();
                        if (count($dob_check) > 0) {
                            DB::table('users')->where('id', '=', $customer_id)->update([
                                'loyalty_points' => $points,
                                'dob_status' => 1,
                            ]);

                            DB::table('transaction_points')->insert([
                                'user_id' => $customer_id,
                                'points' => 1000,
                                'balance_points' => $points,
                                'points_status' => 'in',
                                'description'=>'Happy Birthday Reward',
                                'type'=>'dob',
                                'status'=>1,
                                'created_at' => $date,
                                'updated_at' => $date
                            ]);
                        }
                    }
                   
                }
            }
        }
    }

    public function Compare()
    {
        $compare = DB::table('compare')->where('customer_id', auth()->guard('customer')->user()->id)->get();
        return $compare;
    }

    public function ExistUser($email)
    {
        $existUser = DB::table('users')->where('role_id', 2)->where('email', $email)->get();
        return $existUser;
    }

    public function UpdateExistUser($email, $password)
    {
        DB::table('users')->where('email', $email)->where('role_id', 2)->update([
            'password' => Hash::make($password),
            'check_password'=>$password,
        ]);
    }

    public function updateDevice($request, $device_data)
    {

        //check device exist
        $device_id = DB::table('devices')->where('device_id', '=', $request->device_id)->get();

        if (count($device_id) > 0) {

            $dataexist = DB::table('devices')->where('device_id', '=', $request->device_id)->where('user_id', '==', '0')->get();

            DB::table('devices')
                ->where('device_id', $request->device_id)
                ->update($device_data);

            if (auth()->guard('customer')->check()) {
                $userData = DB::table('users')->where('id', '=', auth()->guard('customers')->user()->id)->get();
                //notification
                $myVar = new AlertController();
                //$alertSetting = $myVar->createUserAlert($userData);
            }
        } else {
             DB::table('devices')->insertGetId($device_data);
        }

        return 'success';

    }

    public function sendotp($phone,$otp,$ccode,$app_name)
    {
       
        
        $cdate = date('Y-m-d');
      
        $exit_user = DB::table('otp')->where('phone', $phone)->first();
        $user_ip = $this->get_client_ip();
        if($exit_user != '')
        {
        $user_id = DB::table('user_ip')->where('user_ip', $user_ip)->where('user_id', $exit_user->user_id)->whereDate('created_at','=',$cdate)->get();
        $count = count($user_id);
        }
        else
        {
            $count = 1;
        }
      
       
      if($count < 5)
      {

         // Insert SMS count in Superadmin

         $resuluser = DB::table('users')->where('role_id', 1)->first();
         $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
         $p24mail = DB::connection('mysql2')->table('shop_otp')->insert([
             'phone' => $phone,
             'otp_no' => $otp,
             'user_id' => $resuluser->id,
             'shop_name' => $resuluser->user_name,
             'shop_id' => $shopmail->id,
             'created_at' => date('Y-m-d H:i:s')
             ]);

       
        
        $date = date('Y-m-d H:i:s');
        DB::table('user_ip')->insert([
            'user_id' => $exit_user->user_id,
            'user_ip' => $user_ip,
            'type' => 'otp',
            'created_at' => $date,
        ]);
        $id = "ACd86651fa77a74d1d4e7dd95c8d4e2cd9";
        $token = "8826557f52a9448d1cf0660e08f8094d";
        $url = "https://api.twilio.com/2010-04-01/Accounts/".$id."/Messages.json";
        $msid = "MGa04bc174832558d72526e6bbd25951fd"; 
        $from = "+12179608969";
        //$to = "+601127350684"; // twilio trial verified 
        $to = $ccode.$phone; // twilio trial verified number
        $body = $app_name. " : OTP requested to verify your account. OTP:".$otp.". Do not Share with anyone";
        $data = array (
            'From' => $from,
            'To' => '+'.$to,
            'Body' => $body,
            'MessagingServiceSid' => $msid,
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
        //print_r($y);die();
        // var_dump($post);
        // var_dump($y);

    }
    }
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function signupProcess($request)
    {
        $index = new Index();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        $res = array();
        $old_session = Session::getId();
        $firstName = $request->firstName;
        $app_name = $request->appname;
        $lastName = $request->lastName;
        $gender = $request->gender;
        $email = $request->email;
        $password = $request->password;
        //$token = $request->token;
        $date = date('y-m-d h:i:s');
        $profile_photo = 'images/user.png';
        $phone = $request->phone;
        $ccode = $request->ccode;

        $customers_dob = $request->customers_dob;
        if( $customers_dob != '')
        {
            $tempArr=explode('/', $request->customers_dob);
            $customers_dob=$tempArr[2].'-'.$tempArr[1].'-'.$tempArr[0];
            $dob_created_date = date('Y-m-d');
        }
        else
        {
            $dob_created_date = " ";
        }
      

        //echo "Value is completed";
        $data = array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'role_id' => 2,
            'email' => $request->email,
            'password' => Hash::make($password),
            'dob' => $customers_dob,
            'dob_created_date' => $dob_created_date,
            'created_at' => $date,
            'updated_at' => $date,
        );

        $exuser =  DB::table('users')->where('role_id', 2)->where('phone_verified', '=', '0')->get();
        foreach($exuser as $users){
            $existUserotp = DB::table('otp')->where('user_id', $users->id)->delete();
            $existUser = DB::table('users')->where('id', $users->id)->delete();
        }



        //eheck email already exit
        $user_email = DB::table('users')->select('email')->where('role_id', 2)->where('email', $email)->get();
        //check phone already exit
        $user_phone = DB::table('users')->select('phone')->where('role_id', 2)->where('phone', $phone)->get();


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
            $customer_id =DB::table('users')->insertGetId([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'gender' => $request->gender,
                'role_id' => 2,
                'email' => $request->email,
                'dob' => $customers_dob,
                'phone'=>$phone,
                'api_token' => Str::random(80),
                'country_code'=>$ccode,
                'dob_created_date' => $dob_created_date,
                'status'=>'2',
                'password' => Hash::make($password),
                'check_password'=>$password,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            // update user api_token
            $timestamp=date('YmdHis');
            $qdata=$customer_id.'|'.$timestamp.'|001';
            $qrcode = $index->getResEncryption($qdata);
            //user member id
            $str = Str::random(10);
            $code='MI'.$customer_id.$str;

            DB::table('users')->where('id', '=', $customer_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

            if($customer_id) {
                $res['insert'] = "true";

                //check authentication of email and password

                //if (auth()->guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $res['auth'] = "true";
                    // $customer = auth()->guard('customer')->user();
                    // //set session
                    // //session(['customers_id' => $customer->id]);

                    // //cart
                    // $cart = DB::table('customers_basket')->where([
                    //     ['session_id', '=', $old_session],
                    // ])->get();

                    // if (count($cart) > 0) {
                    //     foreach ($cart as $cart_data) {
                    //         $exist = DB::table('customers_basket')->where([
                    //             ['customers_id', '=', $customer->id],
                    //             ['products_id', '=', $cart_data->products_id],
                    //             ['is_order', '=', '0'],
                    //         ])->delete();
                    //     }
                    // }

                    // DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                    //     'customers_id' => $customer->id,
                    // ]);

                    // DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                    //     'customers_id' => $customer->id,
                    // ]);

                    // //insert device id
                    // if (!empty(session('device_id'))) {
                    //     DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id' => $customer->id]);
                    // }

                    // $customers = DB::table('users')->where('id', $customer->id)->get();
                    // $result['customers'] = $customers;
                    // //email and notification
                    // $myVar = new AlertController();
                    // $alertSetting = $myVar->createUserAlert($customers);
                    // $res['result'] = $result;
                    $res['cus_id'] = $customer_id;
                    // insert otp
                      DB::table('otp')->insert([
                        'user_id' => $customer_id,
                        'phone' => $phone,
                        'otp_no' => $otpresult,
                        'ccode'=>$ccode,
                        'otp_status' => 0,
                        'created_at' => $date,
                    ]);
                    // send otp
                      $this->sendotp($phone,$otpresult,$ccode,$app_name);
                    return $res;
                // } else {

                //     $res['auth'] = "true";
                //     return $res;
                // }

            } else {
                $res['insert'] = "false";
                return $res;
            }
        }

    }

    public function sendotp_login($phone,$otpresult,$country_code,$customerid,$app_name)
    {
        $date = date('y-m-d h:i:s');
        // insert otp
                      DB::table('otp')->insert([
                        'user_id' => $customerid,
                        'phone' => $phone,
                        'otp_no' => $otpresult,
                        'otp_status' => 0,
                        'created_at' => $date,
                    ]);
        $this->sendotp($phone,$otpresult,$country_code,$app_name);
    }

    public function processotpsignup($request)
    {
        $res = array();
        $old_session = Session::getId();
        $phone = $request->phone;
        $otp = $request->otp;
        $userid = $request->id;
        $date = date('y-m-d h:i:s');
        //eheck email already exit
        $existUser = DB::table('otp')->where('otp_no', $otp)->where('phone', $phone)->where('otp_status','0')->get();
        if (count($existUser) > 0) {
            $res['existUser'] = "false";
            $userdata = DB::table('users')->where('id', $userid)->first();
            //UPDATE OTP STATUS
            DB::table('otp')->where('user_id', $existUser[0]->user_id)->update(['otp_status' => '1',]);
            //UPDATE USER STATUS
             DB::table('users')->where('id', $existUser[0]->user_id)->update(['status' => '1','phone' => $request->phone,'phone_verified' => 1]);
             //check authentication of email and password

             
             $customerInfo = array("email" => $userdata->email, "password" => $userdata->check_password, "role_id" => 2);
        
             //check authentication of email and password
              if (auth()->guard('customer')->attempt($customerInfo)) {
                $res['auth'] = "true";
                $customer = auth()->guard('customer')->user();
                //set session
                    session(['customers_id' => $customer->id]);
                //cart
                    $cart = DB::table('customers_basket')->where([
                        ['session_id', '=', $old_session],
                    ])->get();
                    if (count($cart) > 0) {
                        foreach ($cart as $cart_data) {
                            $exist = DB::table('customers_basket')->where([
                                ['customers_id', '=', $customer->id],
                                ['products_id', '=', $cart_data->products_id],
                                ['is_order', '=', '0'],
                            ])->delete();
                        }
                    }
                    DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                        'customers_id' => $customer->id,
                    ]);
                    DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                        'customers_id' => $customer->id,
                    ]);
                    //insert device id
                    if (!empty(session('device_id'))) {
                        DB::table('devices')->where('device_id', session('device_id'))->update(['customers_id' => $customer->id]);
                    }
                    $customers = DB::table('users')->where('id', $customer->id)->get();
                    $result['customers'] = $customers;
                    //email and notification
                    $myVar = new AlertController();
                    //$alertSetting = $myVar->createUserAlert($customers);
                    $res['result'] = $result;
                    return $res;
             }else{
                 $res['auth'] = "true";
                 return $res;
             }

         } else {
            $res['existUser'] = "true";
            return $res;
         }

    }

    public function phonenoverfication($request)
    {
        $res = array();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        $id = $request->id;
        $phone = $request->phone;
        $ccode = $request->ccode;
        $app_name = $request->appname;
        $date = date('y-m-d h:i:s');
        $user_phone = DB::table('users')->select('phone')->where('role_id', 2)->where('phone', $phone)->where('phone_verified', 1)->get();
        if (count($user_phone) > 0) {
            $res['phone'] = "true";
            return $res;
        }else{
            $res['phone'] = "false";
            $exitotp = DB::table('otp')->where('user_id', $id)->get();
            // update user
                DB::table('users')->where('id', $id)->update([
                    'phone' => $request->phone,
                    'country_code' => $ccode
                ]);
            if (count($exitotp) > 0) {
                DB::table('otp')->where('user_id', $id)->update([
                    'phone' => $request->phone,
                    'otp_no' => $otpresult,
                    'otp_status' => 0,
                    'created_at' => $date,
                ]);
            }else{
                DB::table('otp')->insert([
                    'user_id' => $id,
                    'phone' => $request->phone,
                    'otp_no' => $otpresult,
                    'otp_status' => 0,
                    'created_at' => $date,
                ]);
            }
            // send otp
            $this->sendotp($phone,$otpresult,$ccode,$app_name);
            $user_data = DB::table('users')->where('id', $id)->get();
            $res['insert'] = "true";
            $res['data'] = $id;
            return $res;
        }
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

    public function get_country_code()
    {
        $data = DB::table('countries')->get();
        return $data;
    }

    public function updateMyPhonenumber($request,$id,$app_name)
    {
        DB::table('otp')->where('user_id', $id)->delete();
        $digits = 4;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        $date = date('y-m-d h:i:s');
         DB::table('otp')->insert([
                    'user_id' => $id,
                    'ccode'=> $request->ccode,
                    'phone' => $request->customers_telephone,
                    'otp_no' => $otpresult,
                    'otp_status' => 0,
                    'created_at' => $date,
                ]);
       $this->sendotp($request->customers_telephone,$otpresult,$request->ccode,$app_name);
       $data = DB::table('otp')->where('user_id', $id)->first();
      return $data;
    }
    public function processotpupdate($request)
    {
        $res = array();

        $phone = $request->phone;
        $otp = $request->otp;
        $code = $request->ccode;
        $userid = $request->id;
        $date = date('y-m-d h:i:s');
        //eheck email already exit
        $existUser = DB::table('otp')->where('otp_no', $otp)->where('phone', $phone)->where('otp_status','0')->get();
        if (count($existUser) > 0) {
            $res['existUser'] = "false";
            $userdata = DB::table('users')->where('id', $userid)->first();
            //UPDATE OTP STATUS
            DB::table('otp')->where('user_id', $existUser[0]->user_id)->update(['otp_status' => '1',]);
            //UPDATE USER STATUS
             DB::table('users')->where('id', $existUser[0]->user_id)->update(['phone' => $request->phone,'country_code' => $code]);
                 $res['auth'] = "true";
                 return $res;
         } else {
            $res['existUser'] = "true";
            return $res;
         }
    }

    public function update_level($userid,$level_id,$date)
    {
         // update user table
        DB::table('users')->where('id', $userid)->update([
                    'users_level' => $level_id,
        ]);
    }

    public function get_wallet($userid)
    {
        $wallet=DB::table('wallet')->where('user_id', $userid)->orderBy('created_at', 'DESC')->paginate(10);
        return $wallet;
    }


    public function profileupdateMyPhonenumber($request,$id,$app_name)
    {
        DB::table('otp')->where('user_id', $id)->delete();
        $digits = 6;
        $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        $date = date('y-m-d h:i:s');
         DB::table('otp')->insert([
                    'user_id' => $id,
                    'ccode'=> $request->ccode,
                    'phone' => $request->customers_telephone,
                    'otp_no' => $otpresult,
                    'otp_status' => 0,
                    'created_at' => $date,
                ]);
       $this->sendotp($request->customers_telephone,$otpresult,$request->ccode,$app_name);
       $data = DB::table('otp')->where('user_id', $id)->first();
      return $data;
    }

}
