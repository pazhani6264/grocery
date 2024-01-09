<?php

namespace App\Models\Core;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Core\User;
use App\Models\Core\Setting;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use Illuminate\Support\Str;

class Customers extends Model
{
    //
    use Sortable;
    protected $table = 'customers';
    public function address_book(){

        return $this->belongsTo('App\address_book');
    }

    public function customer_info(){
        return $this->belongsTo('App\Customer_info');
    }

    public function countryrelation(){
        return $this->belongsTo('App\Country');
    }

    public function zone(){
        return $this->belongsTo('App\Zone');
    }

    public function images(){
        return $this->belongsTo('App\Images');
    }

    public $sortableAs = ['entry_street_address','entry_firstname','entry_company'];
    public $sortable = ['id', 'gender', 'first_name','last_name','dob','email','phone','status','created_at','updated_at','entry_street_address'];

    public function getter(){

        $user = User::sortable(['id'=>'ASC'])
            ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
            ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
            ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
            ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
            ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
            'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
            'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
            'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
            'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
            ->where('role_id',2)
            ->groupby('users.id')
            ->get();

        return $user;
    }


    public function paginator(){
      $user = User::getCustomers();

      return $user;
    }

    public function email($request){
        $existEmail = DB::table('users')->where('email', '=', $request->email)->get();
        return $existEmail;
    }

    public function phone($request){
        $existPhone = DB::table('users')->where('phone', '=', $request->customers_telephone)->get();
        return $existPhone;
    }

    public function insert($request){
      $uploadImage = '';
      $setting = new Setting();
      
      //
      // $var = "20/04/2012";
      // $date = str_replace('/', '-', $var);
      // echo date("Y-m-d", strtotime($date) );

      //$date = strtotime($request->dob);
        // $date = str_replace('/', '-', $request->dob);
        // $date = date("Y-m-d", strtotime($date) );
        $customers_id = DB::table('users')->insertGetId([
            'role_id' => 2,
            'first_name' => $request->customers_firstname,
            'last_name' => $request->customers_lastname,
            'dob' => $request->customers_dob,
            'gender' => $request->customers_gender,
            'email' => $request->email,
            'country_code' => $request->ccode,
            'phone' => $request->customers_telephone,
            'check_password'=>$request->password,
            'password' => Hash::make($request->password),
            'status' => $request->isActive,
            'avatar' => $uploadImage,
            'phone_verified' => $request->phone_verified,
            'api_token'=> Str::random(80),
            'created_at' => date('Y-m-d H:i:s'),
            'role_id'    => '2'
        ]);
        
        // update user api_token
            $timestamp=date('YmdHis');
            $qdata=$customers_id.'|'.$timestamp.'|001';
            $qrcode = $setting->getResEncryption($qdata);

            //user member id
                $str = Str::random(10);
                $code='MI'.$customers_id.$str;

                DB::table('users')->where('id', '=', $customers_id)->update(['api_token'=>$qrcode,'member_id'=>$code]);

        return $customers_id;
    }

    public function addresses($id){
        $addresses = DB::table('user_to_address')
            ->leftjoin('address_book', 'address_book.address_book_id','=','user_to_address.address_book_id')
            ->leftJoin('zones', 'zones.zone_id', '=', 'address_book.entry_zone_id')
            ->leftJoin('countries', 'countries.countries_id', '=', 'address_book.entry_country_id')
            ->where('user_to_address.user_id', '=', $id)->get();
          return $addresses;
    }

    public function  country(){
        $countries = DB::table('countries')->get();
        return $countries;
    }

    public function addcustomeraddress($request){

      if(!empty($request->entry_state_box)){
        $state = $request->entry_state_box;
      }else{
        $state = $request->entry_state;
      }

      ///////// To get longitude and latitude //////////////
      $zones =  DB::table('zones')->where('zone_id', $state)->first();
      $countries =  DB::table('countries')->where('countries_id', $request->entry_country_id)->first();
      if($zones){
          $state_name = $zones->zone_name;
      }else{
        $state_name = '';
      }
      $country_name = $countries->countries_name;
      $country_code = $countries->country_code;

      $cordinates_address = urlencode($request->entry_street_address.' '.$request->entry_city.' '.$state_name. ' '. $request->entry_postcode. ' '.$country_name);
      
      $setting = new Setting();
      $getSettings = $setting->getSettings();

      $latitude = '';
      $longitude = '';
      if(!empty($getSettings[103]->value)){
          $google_map_api	  =  $getSettings[103]->value;
          $cordinates = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key='.$google_map_api.'&address='.$cordinates_address);
          
          $cordinates = json_decode($cordinates);
          
          if($cordinates->status=="OK"){
              $latitude = $cordinates->results[0]->geometry->location->lat;
              $longitude = $cordinates->results[0]->geometry->location->lng;
          }
      }

      $address_book_id = DB::table('address_book')->insertGetId([
          'entry_gender'		 	=>   $request->entry_gender,
          'entry_company'		 	=>   $request->entry_company,
          'entry_firstname'	 	=>	 $request->entry_firstname,
          'entry_lastname'   		=>   $request->entry_lastname,
          'entry_street_address'	=>   $request->entry_street_address,
          'entry_suburb' 			=>   $request->entry_suburb,
          'entry_postcode'	 	=>	 $request->entry_postcode,
          'entry_cc_code'	 	    =>	 $country_code,
          'entry_phone'	 	    =>	 $request->entry_phone,
          'entry_city'   			=>   $request->entry_city,
          'entry_state'		 	=>   $state,
          'entry_country_id'		=>   $request->entry_country_id,
          'entry_zone_id'	 		=>	 $state,
          'entry_latitude'            =>   $latitude,
          'entry_longitude'           =>   $longitude,
      ]);

      //set default address
      if($request->is_default=='1'){
          DB::table('user_to_address')->where('user_id','=', $request->user_id)->update([
              'is_default'		 	=>   0
          ]);
      }

      $address_id = DB::table('user_to_address')->insertGetId([
          'user_id'   		    =>   $request->user_id,
          'address_book_id'		=>   $address_book_id,
          'is_default'		 	  =>   $request->is_default,
      ]);
    }

    public function addressBook($address_book_id){
        $customer_addresses = DB::table('address_book')
            ->leftJoin('zones', 'zones.zone_id', '=', 'address_book.entry_zone_id')
            ->leftJoin('countries', 'countries.countries_id', '=', 'address_book.entry_country_id')
            ->where('address_book_id', '=', $address_book_id)->get();
       return $customer_addresses;
    }

    public function countries(){
        $countries = DB::table('countries')->get();
        return $countries;
    }

    public function zones($customer_addresses){

        $zones = DB::table('zones')->where('zone_country_id','=', $customer_addresses[0]->entry_country_id)->get();

      return $zones;
    }

    public function checkdefualtaddress($address_id){
        $customers = DB::table('user_to_address')->where('address_book_id','=', $address_id)->get();
        return $customers;
    }

    public function updateaddress($request){

        $user_id            =   $request->user_id;
        $address_book_id    =   $request->address_book_id;

        if(!empty($request->entry_state_box)){
          $state = $request->entry_state_box;
        }else{
          $state = $request->entry_state;
        }

        ///////// To get longitude and latitude //////////////
        $zones =  DB::table('zones')->where('zone_id', $state)->first();
        $countries =  DB::table('countries')->where('countries_id', $request->entry_country_id)->first();
        if($zones){
            $state_name = $zones->zone_name;
        }else{
          $state_name = '';
        }
        $country_name = $countries->countries_name;
        $country_code = $countries->country_code;

        $cordinates_address = urlencode($request->entry_street_address.' '.$request->entry_city.' '.$state_name. ' '. $request->entry_postcode. ' '.$country_name);
        
        $setting = new Setting();
        $getSettings = $setting->getSettings();

        $latitude = '';
        $longitude = '';
        if(!empty($getSettings[103]->value)){
            $google_map_api	  =  $getSettings[103]->value;
            $cordinates = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key='.$google_map_api.'&address='.$cordinates_address);
            
            $cordinates = json_decode($cordinates);
            //dd($cordinates);   
            if($cordinates->status=="OK"){
                $latitude = $cordinates->results[0]->geometry->location->lat;
                $longitude = $cordinates->results[0]->geometry->location->lng;
            }
        }

        DB::table('address_book')->where('address_book_id','=', $address_book_id)->update([
            'entry_gender'		  	=>   $request->entry_gender,
            'entry_company'		 	  =>   $request->entry_company,
            'entry_firstname'	 	  =>	 $request->entry_firstname,
            'entry_lastname'   		=>   $request->entry_lastname,
            'entry_street_address'=>   $request->entry_street_address,
            'entry_suburb' 			  =>   $request->entry_suburb,
            'entry_postcode'	 	  =>	 $request->entry_postcode,
            'entry_city'   		   	=>   $request->entry_city,
            'entry_state'		 	    =>   $state,
            'entry_country_id'		=>   $request->entry_country_id,
            'entry_zone_id'	 		  =>	 $state,
            'entry_cc_code'	 	    =>	 $country_code,
          'entry_phone'	 	    =>	 $request->entry_phone,
            'entry_latitude'            =>   $latitude,
            'entry_longitude'           =>   $longitude,
        ]);

        //set default address
        if($request->is_default=='1'){
            DB::table('user_to_address')->where('user_id','=', $request->user_id)->update([
                'is_default'		 	=>   0
            ]);
        }

        DB::table('user_to_address')->where('address_book_id','=', $address_book_id)->update([
            'user_id'   		    =>   $request->user_id,
            'is_default'		 	  =>   $request->is_default,
        ]);

        $customer_addresses =  $this->addresses($request->user_id);
        return 'success';
    }

    public function deleteAddresses($request){
        $address_book_id    =   $request->address_book_id;
        DB::table('address_book')->where('address_book_id','=', $address_book_id)->delete();
        DB::table('user_to_address')->where('address_book_id','=', $address_book_id)->delete();
    }


    public function edit($id){
      DB::table('users')->where('id', '=', $id)->update(['is_seen' => 1 ]);

      $customers = DB::table('users')->where('id','=', $id)->first();
      return $customers;
    }

    public function updaterecord($customer_data,$user_id,$user_data){
      DB::table('users')->where('id', '=', $user_id)->update($user_data);
      DB::table('customers')->where('user_id', '=', $user_id)->update($customer_data);

    }

    public function extendemail($request){
      $existEmail = DB::table('users')->where('email', '=', $request->email)->get();
      return $existEmail;
    }

    public function destroyrecord($user_id){

        DB::table('users')->where('id','=', $user_id)->update([
            'status'		 	=>   2,
            'phone_verified'		 	=>   2
        ]);
      DB::table('users')->where('id','=', $user_id)->delete();
      $addresses = DB::table('user_to_address')->where('user_to_address.user_id','=', $user_id)->get();
      foreach($addresses as $address){
        DB::table('address_book')->where('address_book_id','=', $address->address_book_id)->delete();
      }
      DB::table('user_to_address')->where('user_to_address.user_id','=', $user_id)->delete();
    }

    public function destroyrecords($user_id){

        DB::table('users')->where('id','=', $user_id)->delete();
        DB::table('otp')->where('otp.user_id','=', $user_id)->delete();
        DB::table('address_book')->where('user_id','=', $user_id)->delete();
        DB::table('customers')->where('user_id','=', $user_id)->delete();
        DB::table('newsletter_subscribe_customerhide')->where('user_id','=', $user_id)->delete();
        DB::table('customers_basket')->where('customers_id','=', $user_id)->delete();
        DB::table('whos_online')->where('customer_id','=', $user_id)->delete();
        DB::table('customers_info')->where('customers_info_id','=', $user_id)->delete();
      
    }

    public function filter($request){

    $filter = $request->FilterBy;
    $parameter = $request->parameter;
        switch ( $filter )
        {
            case 'Name':
                $user = DB::table('users')
                    ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                    ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                    ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                    ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                    //->leftJoin('images','images.id', '=', 'users.avatar')
                    //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                    ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                    'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                    'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                    'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                    'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                    // ->where(function($query) {
                    //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                    //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                    //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                    // })
                    ->where('first_name', 'LIKE', '%' .  $parameter . '%')
                    ->orwhere('last_name', 'LIKE', '%' .  $parameter . '%')
                    ->orWhereRaw("concat(first_name, ' ', last_name) like '%$parameter%' ")
                    ->where('users.role_id','=','2')
                    ->orderBy('users.id','ASC')
                    ->groupby('users.id')
                    ->paginate(10);

            break;
            case 'E-mail':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('email', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;

            case 'Phone':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('phone', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;

            case 'Address':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('address_book.entry_street_address', 'LIKE', '%' .  $parameter . '%')
                ->orWhere('address_book.entry_city', 'LIKE', '%' .  $parameter . '%')
                ->orWhere('address_book.entry_state', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);

            break;

            case 'Postcode':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('address_book.entry_postcode', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;

            case 'City':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('address_book.entry_city', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;

            case 'State':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('zones.zone_name', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;

            case 'Country':
            $user = DB::table('users')
                ->LeftJoin('user_to_address', 'user_to_address.user_id' ,'=', 'users.id')
                ->LeftJoin('address_book','address_book.address_book_id','=', 'user_to_address.address_book_id')
                ->LeftJoin('countries','countries.countries_id','=', 'address_book.entry_country_id')
                ->LeftJoin('zones','zones.zone_id','=', 'address_book.entry_zone_id')
                //->leftJoin('images','images.id', '=', 'users.avatar')
                //->leftJoin('image_categories','image_categories.image_id', '=', 'users.avatar')
                ->select('users.*', 'address_book.entry_gender as entry_gender', 'address_book.entry_company as entry_company',
                'address_book.entry_firstname as entry_firstname', 'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_postcode as entry_postcode', 'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
                // ->where(function($query) {
                //     $query->where('image_categories.image_type', '=',  'THUMBNAIL')
                //         ->where('image_categories.image_type','!=',   'THUMBNAIL')
                //         ->orWhere('image_categories.image_type','=',   'ACTUAL');
                // })
                ->where('countries.countries_name', 'LIKE', '%' .  $parameter . '%')
                ->where('users.role_id','=','2')
                ->orderBy('users.id','ASC')
                ->groupby('users.id')
                ->paginate(10);
            break;
            default: $user = $this->paginator();
        }
        return $user;

    }

    public function paginator_order($id){

        $language_id = '1';
        $orders = DB::table('orders')->orderBy('created_at', 'DESC')
            ->where('customers_id', '=', $id)->paginate(40);

        $index = 0;
        $total_price = array();

        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')->sum('final_price');

            $orders[$index]->total_price = $orders_products;

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '<=', 2)
                ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

            $deliveryboy_orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '=', 3)
                ->orderby('orders_status_history.date_added', 'DESC')->first();

            if ($deliveryboy_orders_status_history) {
                $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
            } else {
                $orders[$index]->deliveryboy_orders_status_id = '';
                $orders[$index]->deliveryboy_orders_status = '';
            }
            $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            $index++;

        }
        return $orders;
    }
}
