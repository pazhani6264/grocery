<?php
namespace App\Http\Controllers\Web;
//use Mail;
//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//for Carbon a value
use Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Currency;
use App\Models\Web\Shipping;

//email
use Illuminate\Support\Facades\Mail;

class ShippingAddressController extends Controller
{
	public function __construct(
											Index $index,
											Languages $languages,
											Products $products,
											Currency $currency,
											Shipping $shipping

											)
	{
		$this->index = $index;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->shipping = $shipping;
		$this->theme = new ThemeController();
	}



	//get all zones
	public function ajaxZones(Request $request){

		$getZones = $this->shipping->zones($request->country_id);

		return($getZones);

	}



	//get all customer addresses url
	public function shippingAddress(Request $request){

		$title = array('pageTitle' => Lang::get('website.Shipping Address'));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();

		//print_r($request->update);
		if(!empty($request->action)){
			$result['action'] = $request->action;
		}else{
			$result['action'] = '';
		}

		// address book
		$result['address'] = $this->shipping->getShippingAddress($address_id='');
		$result['countries'] = $this->shipping->countries();

		//edit address
		if(!empty($request->address_id)){
			$result['editAddress'] = $this->shipping->getShippingAddress($request->address_id);
			$result['zones'] = $this->shipping->zones($result['editAddress'][0]->countries_id);

		}else{
			$result['editAddress'] = '';
			$result['zones']	   = '';
		}

		return view("web.shipping", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}

	//get all customer addresses url
	public function addShipping(Request $request){

		$title = array('pageTitle' => Lang::get('website.Shipping Address'));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();

		//print_r($request->update);
		if(!empty($request->action)){
			$result['action'] = $request->action;
		}else{
			$result['action'] = '';
		}

		// address book
		$result['address'] = $this->shipping->getShippingAddress($address_id='');
		$result['countries'] = $this->shipping->countries();

		//edit address
		if(!empty($request->address_id)){
			$result['editAddress'] = $this->shipping->getShippingAddress($request->address_id);
			$result['zones'] = $this->shipping->zones($result['editAddress'][0]->countries_id);

		}else{
			$result['editAddress'] = '';
			$result['zones']	   = '';
		}

		return view("web.add_shipping", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}


	//get all customer addresses url
	public function editShipping(Request $request){

		$title = array('pageTitle' => Lang::get('website.Shipping Address'));
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();

		//print_r($request->update);
		if(!empty($request->action)){
			$result['action'] = $request->action;
		}else{
			$result['action'] = '';
		}

		// address book
		$result['address'] = $this->shipping->getShippingAddress($address_id='');
		$result['countries'] = $this->shipping->countries();

		//edit address
		if(!empty($request->address_id)){
			$result['editAddress'] = $this->shipping->getShippingAddress($request->address_id);
			$result['zones'] = $this->shipping->zones($result['editAddress'][0]->countries_id);

		}else{
			$result['editAddress'] = '';
			$result['zones']	   = '';
		}

		return view("web.edit_shipping", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}

	//get all customer addresses url
	public function getShippingAddress($address_id){
    $this->shipping->getShippingAddress($address_id);
		return $result;

	}

	public function addMyAddress(Request $request){
		

		$geofencingCountry = DB::table('geo_fencing')->where('status', '1')->where('country_id', $request->entry_country_id)->first();
        $geocheck = 0;
        if($geofencingCountry !='')
        { 
           if($geofencingCountry->state_id !='')
           { 
			 
           $geofencingCountryState = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->entry_zone_id)->where('country_id', $geofencingCountry->country_id)->first();
		  
				if($geofencingCountryState !='')
				{ 
					if($geofencingCountryState->pincode !='')
					{ 
						$geofencingCountryStatepostcode = DB::table('geo_fencing')->where('status', '1')->where('state_id', $geofencingCountryState->state_id)->where('country_id', $geofencingCountryState->country_id)->WhereRaw('FIND_IN_SET(' .$request->entry_postcode. ',pincode)')->first();
						if($geofencingCountryStatepostcode !='')
						{ 
							$geocheck = 1;
						}
						else
						{
							$geocheck = 0;
						}
					
					}
					else
					{
						$geocheck = 1;
					}
				}
				else
				{
					$geocheck = 0;
				}
           }
           else
           {
		
               $geocheck = 1; 
           }
        }
        else
        {
           $geocheck = 0;
        }
      


       if($geocheck == 1)
           {
    	$this->shipping->addMyAddress($request);
			
		$flag = DB::table('user_redirect_flag')->where('user_id', auth()->guard('customer')->user()->id)->where('status', 1)->where('flag_name', 'Shipping_flag')->first(); 

		if($flag != '')
		{
			return redirect('checkout');
		}
		else
		{
		return redirect()->back()->with('success', 'Your address has been added successfully!');
		}
		}
		else
		{
			return redirect()->back()->with('adderror', 'Unable to deliver under this address, please change your address.')->withInput();
		}

	}


	//update shipping address
	public function updateAddress(Request $request){

		$geofencingCountry = DB::table('geo_fencing')->where('status', '1')->where('country_id', $request->entry_country_id)->first();
        $geocheck = 0;
        if($geofencingCountry !='')
        { 
           if($geofencingCountry->state_id !='')
           { 
			 
           $geofencingCountryState = DB::table('geo_fencing')->where('status', '1')->where('state_id', $request->entry_zone_id)->where('country_id', $geofencingCountry->country_id)->first();
		  
				if($geofencingCountryState !='')
				{ 
					if($geofencingCountryState->pincode !='')
					{ 
						$geofencingCountryStatepostcode = DB::table('geo_fencing')->where('status', '1')->where('state_id', $geofencingCountryState->state_id)->where('country_id', $geofencingCountryState->country_id)->WhereRaw('FIND_IN_SET(' .$request->entry_postcode. ',pincode)')->first();
						if($geofencingCountryStatepostcode !='')
						{ 
							$geocheck = 1;
						}
						else
						{
							$geocheck = 0;
						}
					
					}
					else
					{
						$geocheck = 1;
					}
				}
				else
				{
					$geocheck = 0;
				}
           }
           else
           {
		
               $geocheck = 1; 
           }
        }
        else
        {
           $geocheck = 0;
        }


       if($geocheck == 1)
           {

			$location = $request->location;
			if(!empty($location)){
				$iparr = explode(",",$location);
				$lat = ltrim($iparr[0]);
				$lng = rtrim($iparr[1]);
			}else{
				$lat = '';
				$lng = '';
			}

		$customers_id            				=   auth()->guard('customer')->user()->id;
		$address_book_id            			=   $request->address_book_id;
		$entry_firstname            		    =   $request->entry_firstname;
		$entry_lastname             		    =   $request->entry_lastname;
		$entry_street_address       		    =   $request->entry_street_address;
		$entry_suburb             				=   $request->entry_suburb;
		$entry_postcode             			=   $request->entry_postcode;
		$entry_city             				=   $request->entry_city;
		$entry_state             				=   $request->entry_state;
		$entry_country_id             			=   $request->entry_country_id;
		$entry_zone_id             				=   $request->entry_zone_id;
		$entry_gender							=   $request->entry_gender;
		$entry_company							=   $request->entry_company;
		$customers_default_address_id			=   $request->customers_default_address_id;
		$entry_phone							=   $request->phone_number;
		$entry_cc_code							=   $request->entry_cc_code;
		$landmark								=   $request->landmark;
		$default_set							=   $request->default_set;
		$entry_latitude 						= 	$request->latitude;
        $entry_longitude 						= 	$request->longitude;

		if(!empty($customers_id)){

			$address_book_data = array(
				'entry_firstname'               =>   $entry_firstname,
				'entry_lastname'                =>   $entry_lastname,
				'entry_street_address'          =>   $entry_street_address,
				'entry_suburb'             		=>   $entry_suburb,
				'entry_postcode'            	=>   $entry_postcode,
				'entry_city'             		=>   $entry_city,
				'entry_state'            		=>   $entry_state,
				'entry_country_id'            	=>   $entry_country_id,
				'entry_zone_id'             	=>   $entry_zone_id,
				'customers_id'             		=>   $customers_id,
				'entry_gender'					=>   $entry_gender,
				'entry_company'					=>   $entry_company,
				'entry_phone'					=>   $entry_phone,
				'entry_cc_code'					=>   $entry_cc_code,
				'landmark'						=>   $landmark,
				'entry_latitude'				=>   $entry_latitude,
				'entry_longitude'				=>   $entry_longitude 
			);

			//add address into address book
			$this->shipping->updateAddressBook($address_book_data,$address_book_id);

			//default address id
			if($customers_default_address_id == '1'){
			 $this->shipping->updateCustomer($customers_id,$address_book_id);
			}

			if($default_set == 1){
				DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '!=', $address_book_id)->where('is_default', '=', 1)->update(['is_default' => 0]);
				DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '=', $address_book_id)->update(['is_default' => $default_set]);
			}else{
				DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '=', $address_book_id)->update(['is_default' => $default_set]);
			}

			return redirect('shipping-address?action=update');
		}
		}
		else
		{
			return redirect('shipping-address?action=update')->with('adderror', 'Unable to deliver under this address, please change your address.');
		}

	}

	//delete shipping address
	public function deleteAddress($id){
    $this->shipping->deleteAddress($id);
		return redirect()->back();

	}



	//update shipping address
	public function myDefaultAddress(Request $request){
	 	$this->shipping->myDefaultAddress($request);

		$customers_id = auth()->guard('customer')->user()->id;
		$address_book_id = $request->address_id;
		$res = DB::table('address_book')->where('user_id', $customers_id)->where('address_book_id', '=', $address_book_id)->get();
        return $res;
	}
}
