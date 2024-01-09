<?php
namespace App\Http\Controllers\AdminControllers;
use App\Models\Core\Superadmin;
use App\Models\Core\Languages;
use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use App\Models\Core\Reports;
use App\Models\Core\Coupon;
use App\Models\Core\Currency;
use App\Models\Core\Products;

use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use App\Models\Core\User;
use Carbon\Carbon;
use App\Models\Core\DeliveryBoys;

//for requesting a value

class AppointmentController extends Controller
{
    public function __construct(Admin $admin,Reports $reports, Setting $setting, Customers $customers, Products $products,Currency $currency, Coupon $coupon, DeliveryBoys $deliveryBoys,Order $order,Superadmin $superadmin) {
        $this->reports = $reports;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;
        $this->DeliveryBoys = $deliveryBoys;
        $this->Customers = $customers;
        $this->Currency = $currency;
        $this->Products = $products;
        $this->Coupon = $coupon;
		$this->Order = $order;
		$this->Admin = $admin;
		$this->Superadmin = $superadmin;
    }

	
	public function appointment(Request $request){
		
		$result['commonContent'] = $this->Setting->commonContent();

		if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $result['dateFrom'] = date('d-m-Y ', strtotime($startdate));
            $result['dateTo'] = date('d-m-Y ', strtotime($enddate));
        }
        else{
            $result['dateFrom'] = date('d-m-Y ');
            $result['dateTo'] = date('d-m-Y ');
        }

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->orderBy('appointment.created_at','DESC')->groupBy('appointment.id')->paginate(10);
		
		return view("admin.appointment.appointment")->with('result', $result);
	}

	public function appointmentDetail($id,Request $request){
		
		$result['commonContent'] = $this->Setting->commonContent();

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','image_categories.path_type','image_categories.path','appointment.created_at as createdDate')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('products_description','products_description.products_id','=','appointment.product_id')->join('image_categories','image_categories.image_id','=','products.products_image')->where('appointment.id',$id)->first();
		
		$result['appstatus'] = DB::table('appointment_status')->get();

		$result['outlet'] = DB::table('appointment_outlet')->select('appointment_outlet.name','appointment_outlet.phone','appointment_outlet.address','appointment_outlet.postal_code')->join('appointment','appointment.outlet_id','=','appointment_outlet.id')->where('appointment.id',$id)->first();

		$result['appointment_setting'] = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->first();

		$result['orderTrack'] = DB::table('appointment_track')->select('appointment_track.*','appointment_track.created_at as trackDate','appointment_status.*')->join('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.appointment_id',$id)->get();
		
		return view("admin.appointment.appointment_detail")->with('result', $result);
	}


	public function appinvoiceprint($id,Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','image_categories.path_type','image_categories.path','appointment.created_at as createdDate')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('products_description','products_description.products_id','=','appointment.product_id')->join('image_categories','image_categories.image_id','=','products.products_image')->where('appointment.id',$id)->first();
		
		$result['appstatus'] = DB::table('appointment_status')->get();

		$result['outlet'] = DB::table('appointment_outlet')->select('appointment_outlet.name','appointment_outlet.phone','appointment_outlet.address','appointment_outlet.postal_code')->join('appointment','appointment.outlet_id','=','appointment_outlet.id')->where('appointment.id',$id)->first();

		$result['appointment_setting'] = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->first();

		$result['orderTrack'] = DB::table('appointment_track')->join('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.appointment_id',$id)->get();
		
		return view("admin.appointment.appointment_invoice")->with('result', $result);

	}


	public function changeBookingid(Request $request){

		$changebookid = DB::table('appointment_track')->insertGetId([
			
			'appointment_id' => $request->appointment_id,
			'booking_id' => $request->orders_status,
			'comments' => $request->comments,
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),

		]);


		$appointmentUpdate = DB::table('appointment')->where('id',$request->appointment_id)->update(['booking_status' => $request->orders_status]);

		return redirect()->back()->with('update','Appointment Deleted Successfully...');

	}




	public function deleteAppointment(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$appontment_setting = DB::table('appointment')->where('id',$request->orders_id)->delete();

		return redirect()->back()->with('update','Appointment Deleted Successfully...');

	}




	public function appointmentFilter(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$name = $request->FilterBy;
		$param = $request->parameter;
		$param2 = $request->parameter2;
		$dateRange = $request->dateRange;
  
		switch ( $name ) {
			case 'Name':

				$resultnew = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id');

					if (isset($dateRange)) {
						$range = explode('-', $dateRange);
			
						$startdate = trim($range[0]);
						$enddate = trim($range[1]);
			
						$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
						$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
						$resultnew->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
			
					}
					$result['appointment'] = $resultnew->where('appointment.name', 'LIKE', '%' . $param . '%')->orderBy('appointment.id','DESC')->groupBy('appointment.id')
				->paginate(10);
  
			break;
			case 'Status':

				$resultnew = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id');

					if (isset($dateRange)) {
						$range = explode('-', $dateRange);
			
						$startdate = trim($range[0]);
						$enddate = trim($range[1]);
			
						$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
						$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
						$resultnew->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
			
					}
					$result['appointment'] = $resultnew->where('appointment.booking_status', $param2)->orderBy('appointment.id','DESC')->groupBy('appointment.id')
				->paginate(10);
  
			break;
			case 'Product':
  
				$resultnew = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id');

					if (isset($dateRange)) {
						$range = explode('-', $dateRange);
			
						$startdate = trim($range[0]);
						$enddate = trim($range[1]);
			
						$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
						$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
						$resultnew->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
			
					}
					$result['appointment'] = $resultnew->where('products_description.products_name', 'LIKE', '%' . $param . '%')->orderBy('appointment.id','DESC')->groupBy('appointment.id')
				->paginate(10);

				break;

				case 'Phone':

					$resultnew = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id');

					if (isset($dateRange)) {
						$range = explode('-', $dateRange);
			
						$startdate = trim($range[0]);
						$enddate = trim($range[1]);
			
						$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
						$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
						$resultnew->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
			
					}
					$result['appointment'] = $resultnew->where('appointment.phone', 'LIKE', '%' . $param . '%')->orderBy('appointment.id','DESC')->groupBy('appointment.id')
					->paginate(10);
	  
				break;
			default:

			$resultnew = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id');

					if (isset($dateRange)) {
						$range = explode('-', $dateRange);
			
						$startdate = trim($range[0]);
						$enddate = trim($range[1]);
			
						$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
						$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
						$resultnew->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
			
					}
					$result['appointment'] = $resultnew->orderBy('appointment.id','DESC')->groupBy('appointment.id')
					->paginate(10);

					

				break;
			  }
			  return view("admin.appointment.appointment")->with('result', $result)->with('name', $name)->with('param', $param)->with('param2', $param2)->with('dateRange', $dateRange);

	  }





	public function appointmentSetting(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['appointment_setting'] = DB::table('appointment_setting')->select('appointment_setting.*','appointment_outlet.*','appointment_outlet.id as outID','appointment_setting.id as appoID','appointment_setting.status as appStatus')->join('appointment_outlet','appointment_outlet.id','=','appointment_setting.outlet_id')->paginate(10);
		return view("admin.appointment.viewappointmentsetting")->with('result', $result);
	}


	public function addappointmentSetting(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['outlet'] = DB::table('appointment_outlet')->where('appointment_setting_status','=','1')->get();
		return view("admin.appointment.addappointmentsetting")->with('result', $result);
	}

	public function addappointmentSettingAction(Request $request){

		  //orders status history
		  $appontment_setting = DB::table('appointment_setting')->insertGetId([
			
				'outlet_id' => $request->outlet_name,
				'multiple_time' => $request->multiple_time,
				'no_of_booking' => $request->no_of_booking,
                'no_of_pax' => $request->no_of_pax,
                'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),

            ]);
			
			$outlet = DB::table('appointment_outlet')->where('id',$request->outlet_name)->update(['appointment_setting_status' => 1 ]);


			return redirect()->back()->with('update','Appointment Setting Added Successfully...');
	}


	public function editappointmentSetting(Request $request,$id){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['appointment_setting'] = DB::table('appointment_setting')->where('id','=',$id)->first();
		$result['outlet'] = DB::table('appointment_outlet')->where('status','=','1')->get();
		return view("admin.appointment.editappointmentsetting")->with('result', $result);
	}



	public function editappointmentSettingAction(Request $request){

		//orders status history
		$appontment_setting = DB::table('appointment_setting')->where('id',$request->id)->update([
		  
			  'outlet_id' => $request->outlet_name,
			  'multiple_time' => $request->multiple_time,
			  'no_of_booking' => $request->no_of_booking,
			  'no_of_pax' => $request->no_of_pax,
			  'services' => $request->services,
			  'staffs' => $request->staffs,
			  'status' =>  $request->status,
			  'created_at' => date('Y-m-d H:i:s'),

		  ]);


		  return redirect()->back()->with('update','Appointment Setting Updated Successfully...');
  	}



  	public function deleteappointmentSetting(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$result['appointment_setting'] = DB::table('appointment_setting')->where('id','=',$request->orders_id)->first();
		$outlet = DB::table('appointment_outlet')->where('id',$result['appointment_setting']->outlet_id)->update(['appointment_setting_status' => 0 ]);

		DB::table('appointment_setting')->where('id', $request->orders_id)->delete();



		return redirect()->back()->with('update','Appointment Setting Deleted Successfully...');

	}


	public function appointmentSettingFilter(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$name = $request->FilterBy;
		$param = $request->parameter;
		$param2 = $request->parameter2;

		
		if($param2 == 2)
		{
		  $param2n = 0;
		}
		else
		{
		  $param2n = $request->parameter2;
		}

	
  
		switch ( $name ) {
			case 'outlet_name':

				$result['appointment_setting'] = DB::table('appointment_setting')->select('appointment_setting.*','appointment_outlet.*','appointment_outlet.id as outID','appointment_setting.id as appoID','appointment_setting.status as appStatus')->join('appointment_outlet','appointment_outlet.id','=','appointment_setting.outlet_id')->where('appointment_setting.status','=','1')->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')->paginate(10);
  
			break;
			case 'booking':

				$result['appointment_setting'] = DB::table('appointment_setting')->select('appointment_setting.*','appointment_outlet.*','appointment_outlet.id as outID','appointment_setting.id as appoID','appointment_setting.status as appStatus')->join('appointment_outlet','appointment_outlet.id','=','appointment_setting.outlet_id')->where('appointment_setting.status','=','1')->where('appointment_setting.multiple_time', $param2n)->paginate(10);
  
			break;
			default:

				$result['appointment_setting'] = DB::table('appointment_setting')->select('appointment_setting.*','appointment_outlet.*','appointment_outlet.id as outID','appointment_setting.id as appoID','appointment_setting.status as appStatus')->join('appointment_outlet','appointment_outlet.id','=','appointment_setting.outlet_id')->where('appointment_setting.status','=','1')->paginate(10);

				break;
			  }
			 
			
			  return view("admin.appointment.viewappointmentsetting")->with('result', $result)->with('name', $name)->with('param', $param)->with('param2', $param2);
	  }


	public function viewOutlet(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['outlet'] = DB::table('appointment_outlet')->paginate(10);
		return view("admin.appointment.viewoutlet")->with('result', $result);
	}



	public function addOutlet(Request $request){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		return view("admin.appointment.addoutlet")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}

	public function addOutletAction(Request $request){

		  //orders status history
		  $outlet = DB::table('appointment_outlet')->insertGetId([
			
				'name' => $request->outlet_name,
				'phone' => $request->phone,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
				'lat' => $request->latitude,
				'lng' => $request->longitude,
				'zone_id'=> $request->state_id,
				'countries_id'=> $request->country_id,
				'image' => $request->image_id,
                'status' => 1,
				'appointment_setting_status' => 1,
				'created_at' => date('Y-m-d H:i:s'),

            ]);

			$appontment_setting = DB::table('appointment_setting')->insertGetId([
			
				'outlet_id' => $outlet,
				'multiple_time' => 0,
				'no_of_booking' => 1,
                'no_of_pax' => 1,
                'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),

            ]);
			


			return redirect()->back()->with('update','Outlet Added Successfully...');
	}


	public function editOutlet(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['outlet'] = DB::table('appointment_outlet')->where('id','=',$id)->first();
		$result['outlet_image'] =  DB::table('image_categories')->where('image_type','ACTUAL')->where('image_id','=',$result['outlet']->image)->first();
		$result['slot'] = DB::table('appointment_slot')->where('outlet_id','=',$id)->paginate(10);
		$result['holiday'] = DB::table('appointment_holiday')->where('outlet_id','=',$id)->paginate(10);

		return view("admin.appointment.editoutlet")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}



	public function editOutletAction(Request $request){


		if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

		//orders status history
		$outlet = DB::table('appointment_outlet')->where('id',$request->id)->update([
			
				'name' => $request->outlet_name,
				'phone' => $request->phone,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
				'lat' => $request->latitude,
				'lng' => $request->longitude,
				'image' => $uploadImage,
                'status' => $request->status,
                'zone_id'=> $request->state_id,
				'countries_id'=> $request->country_id,
				'created_at' => date('Y-m-d H:i:s'),

		]);


		  return redirect()->back()->with('update','Outlet Updated Successfully...');
  	}



  	public function deleteOutlet(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('appointment_outlet')->where('id', $request->orders_id)->delete();
		return redirect()->back()->with('update','Outlet Deleted Successfully...');

	}



	public function outletFilter(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$name = $request->FilterBy;
		$param = $request->parameter;
  
		switch ( $name ) {
			case 'Name':

				$result['outlet'] = DB::table('appointment_outlet')->where('name', 'LIKE', '%' . $param . '%')->orderBy('id','DESC')->paginate(10);
  
			break;
			
			case 'Phone':

				$result['outlet'] = DB::table('appointment_outlet')->where('phone', 'LIKE', '%' . $param . '%')->orderBy('id','DESC')->paginate(10);

	
			break;
			default:

			$result['outlet'] = DB::table('appointment_outlet')->where('name', 'LIKE', '%' . $param . '%')->orderBy('id','DESC')->paginate(10);

				break;
			  }
			  return view("admin.appointment.viewoutlet")->with('result', $result)->with('name', $name)->with('param', $param);
	  }



	  public function viewSlot(Request $request,$id){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['slot'] = DB::table('appointment_slot')->select('appointment_slot.*','appointment_outlet.name')->join('appointment_outlet','appointment_outlet.id','appointment_slot.outlet_id')->where('appointment_slot.outlet_id','=',$id)->paginate(10);

		$result['holiday'] = DB::table('appointment_holiday')->select('appointment_holiday.*','appointment_outlet.name')->join('appointment_outlet','appointment_outlet.id','appointment_holiday.outlet_id')->where('appointment_holiday.outlet_id','=',$id)->paginate(10);

		return view("admin.appointment.viewslot")->with('result', $result);
	}




	  public function addSlot(Request $request,$outlet_id){

		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.appointment.addslot")->with('result', $result)->with('outlet_id', $outlet_id);
	}

	public function addSlotAction(Request $request){

		$slotcheck = DB::table('appointment_slot')->where('start_hour',$request->start_hour)->where('end_hour',$request->end_hour)->first();
		if($slotcheck){
			return redirect()->back()->with('error','Already exists.');
		}else{

			$startHour = date('H:i',strtotime($request->start_hour));
			$endHour = date('H:i',strtotime($request->end_hour));

			if($startHour > $endHour){
				return redirect()->back()->with('error','End Date grater than Start Date');
			} else {
				$outlet = DB::table('appointment_slot')->insertGetId([
				
					'outlet_id' => $request->outlet_id,
					'start_hour' => $request->start_hour,
					'end_hour' => $request->end_hour,
					'start_end' => $request->start_hour.'-'.$request->end_hour,
					'status' => 1,
					'created_at' => date('Y-m-d H:i:s'),

				]);
				return redirect()->back()->with('update','Appointment Slot Added Successfully...');
		  }
		}
	}


	public function editSlot(Request $request,$id){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['slot'] = DB::table('appointment_slot')->select('appointment_slot.*','appointment_outlet.name')->join('appointment_outlet','appointment_outlet.id','appointment_slot.outlet_id')->where('appointment_slot.id','=',$id)->first();

		return view("admin.appointment.editslot")->with('result', $result);
	}


	public function editHoliday(Request $request,$id){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['holiday'] = DB::table('appointment_holiday')->select('appointment_holiday.*','appointment_outlet.name')->join('appointment_outlet','appointment_outlet.id','appointment_holiday.outlet_id')->where('appointment_holiday.id','=',$id)->first();

		return view("admin.appointment.editholiday")->with('result', $result);
	}

	public function editSlotAction(Request $request){

		$slotcheck = DB::table('appointment_slot')->where('start_hour',$request->start_hour)->where('end_hour',$request->end_hour)->first();
		if($slotcheck){
			return redirect()->back()->with('error','Already exists.');
		}else{

			$startHour = date('H:i',strtotime($request->start_hour));
			$endHour = date('H:i',strtotime($request->end_hour));

			if($startHour > $endHour){
				return redirect()->back()->with('error','End Date grater than Start Date');
			} else {

				$outlet = DB::table('appointment_slot')->where('id',$request->editslot_id)->update([
			
				'outlet_id' => $request->outlet_id,
				'start_hour' => $request->start_hour,
				'end_hour' => $request->end_hour,
				'start_end' => $request->start_hour.'-'.$request->end_hour,
				'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),

				]);
				return redirect()->back()->with('update','Appointment Slot Updated Successfully...');
			}
		}
  }

	public function deleteSlot(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('appointment_slot')->where('id', $request->orders_id)->delete();
		return redirect()->back()->with('update','Slot Deleted Successfully...');

	}

	public function addHolidayAction(Request $request){

		//orders status history
		$holiday = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
		//print_r($holiday);die();

		$holidaychk = DB::table('appointment_holiday')->where('outlet_id',$request->outlet_id)->where('date',$holiday)->first();
		if($holidaychk){
			return redirect()->back()->with('error','Already exists.');
		}else{
			$outlet = DB::table('appointment_holiday')->insertGetId([
		  
			  'outlet_id' => $request->outlet_id,
			  'date' => $holiday,
			  'status' => 1,
			  'created_at' => date('Y-m-d H:i:s'),

		  	]);

		  	return redirect()->back()->with('update','Appointment Holiday Added Successfully...');
		}
  }

  public function editHolidayAction(Request $request){

	//orders status history
	$holiday = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

	$holidaychk = DB::table('appointment_holiday')->where('date',$holiday)->first();
	if($holidaychk){
		return redirect()->back()->with('error','Already exists.');
	}else{
		$outlet = DB::table('appointment_holiday')->where('id',$request->editholiday_id)->update([
	  
		  'outlet_id' => $request->outlet_id,
		  'date' => $holiday,
		  'status' => 1,
		  'created_at' => date('Y-m-d H:i:s'),

	  	]);
	}


	  return redirect()->back()->with('update','Appointment Holiday Updated Successfully...');
}

		public function deleteHoliday(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			DB::table('appointment_holiday')->where('id', $request->holiday_id)->delete();
			return redirect()->back()->with('update','Holiday Deleted Successfully...');

		}



		public function viewAppointmentStatus(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			$result['appstatus'] = DB::table('appointment_status')->paginate(10);
			return view("admin.appointment.viewappointmentstatus")->with('result', $result);
		}


		public function addAppointmentStatus(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			return view("admin.appointment.addappointmentstatus")->with('result', $result);
		}

		public function addAppointmentStatusAction(Request $request){

			//orders status history
			$appointmentStatus = DB::table('appointment_status')->insertGetId([
			  
				  'status_name' => $request->status_name,
				  'cancel' => 0,
				  'status' => 1,
				  'created_at' => date('Y-m-d H:i:s'),
	
			  ]);
	
			  return redirect()->back()->with('update','Appointment Status Added Successfully...');
	  }

	  public function editAppointmentStatus(Request $request,$id){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['appointmentStatus'] = DB::table('appointment_status')->where('id','=',$id)->first();

		return view("admin.appointment.editappointmentstatus")->with('result', $result);
	}

	public function editAppointmentStatusAction(Request $request){

		//orders status history
		$appointmentStatus = DB::table('appointment_status')->where('id',$request->id)->update([
		  
			'status' => $request->status,
			

		  ]);


		  return redirect()->back()->with('update','Appointment Status Updated Successfully...');
  }

		public function changeAppointmentStatusAction(Request $request)
		{

			$statusedec_id = DB::table('appointment_status')->where('id', '=', $request->status_id)
			->update(['cancel' => $request->status]);

		}


		

		public function appointmentReport(Request $request)
		{

			if(isset($request->customers_id) || isset($request->orderid) ){
				$result['price'] = $this->reports->appointmentcustomersReportTotal($request);
				$result['reports'] = $this->reports->appointmentcustomersReport($request);
			}
			
			else{
				$result['price'] = 0;
				$result['reports'] = array('orders' => [], 'total_price' => 0);
			}
			
			
			$result['customers'] = $this->Customers->getter();
			$result['orderstatus'] = $this->reports->allorderstatuses();
			$result['currency'] = $this->Currency->getter();
			$result['deliveryboys'] = $this->DeliveryBoys->getter();
			$myVar = new SiteSettingController();
			$result['setting'] = $myVar->getSetting();
			$result['commonContent'] = $myVar->Setting->commonContent();

			return view("admin.appointment.appointment_report")->with('result', $result);
	
		}


		public function appointmentPrint(Request $request)
		{
	
			if(isset($request->customers_id) || isset($request->orderid) ){
				$result['price'] = $this->reports->appointmentcustomersReportTotal($request);
				$result['reports'] = $this->reports->appointmentcustomersReport($request);
			}
			
			else{
				$result['price'] = 0;
				$result['reports'] = array('orders' => [], 'total_price' => 0);
			}
			
			
			$result['customers'] = $this->Customers->getter();
			$result['orderstatus'] = $this->reports->allorderstatuses();
			$result['currency'] = $this->Currency->getter();
			$result['deliveryboys'] = $this->DeliveryBoys->getter();
			$myVar = new SiteSettingController();
			$result['setting'] = $myVar->getSetting();
			$result['commonContent'] = $myVar->Setting->commonContent();
		

			return view("admin.appointment.appointment_print")->with('result', $result);
	
		}


		public function appointmentServices(Request $request){
			$result['commonContent'] = $this->Setting->commonContent();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

			$result['appservices'] = DB::table('appointment_services')->select('appointment_services.*','appointment_outlet.name','image_categories.path')->join('appointment_outlet','appointment_outlet.id','appointment_services.outlet_id')->LeftJoin('image_categories', function ($join) {
                  $join->on('image_categories.image_id', '=', 'appointment_services.image')
                      ->where(function ($query) {
                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                      });
              })->paginate(10);
			return view("admin.appointment.appointment_services")->with('result', $result);
		}

		public function addAppointmentServices(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			$images = new Images;
			$allimage = $images->getimages();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();
			return view("admin.appointment.add_appointment_services")->with('result', $result)->with('allimage',$allimage);

		}

		public function addAppointmentServicesAction(Request $request){

			$appointmentService = DB::table('appointment_services')->insertGetId([
				'outlet_id' => $request->outlet_id,
				'title' => $request->title,
				'image' => $request->image,
				'description' => $request->description,
				'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
			]);

			return redirect()->back()->with('update','Appointment Services Added Successfully...');
		}

		public function editAppointmentServices(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			$images = new Images;
			$allimage = $images->getimages();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

			$result['editappservices'] = DB::table('appointment_services')->select('appointment_services.*','appointment_outlet.name','image_categories.path')->join('appointment_outlet','appointment_outlet.id','appointment_services.outlet_id')->LeftJoin('image_categories', function ($join) {
				$join->on('image_categories.image_id', '=', 'appointment_services.image')
					->where(function ($query) {
						$query->where('image_categories.image_type', '=', 'THUMBNAIL')
							->where('image_categories.image_type', '!=', 'THUMBNAIL')
							->orWhere('image_categories.image_type', '=', 'ACTUAL');
					});
			})->where('appointment_services.id',$request->id)->first();

			return view("admin.appointment.edit_appointment_services")->with('result', $result)->with('allimage',$allimage);

		}

		public function editAppointmentServicesAction(Request $request){

			$appointmentService = DB::table('appointment_services')->where('id',$request->id)->update([
				'outlet_id' => $request->outlet_id,
				'title' => $request->title,
				'image' => $request->image,
				'description' => $request->description,
				'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
			]);

			return redirect()->back()->with('update','Appointment Services Updated Successfully...');
		}

		public function deleteAppointmentServices(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			DB::table('appointment_services')->where('id', $request->orders_id)->delete();
			return redirect()->back()->with('update','Appointment Services Deleted Successfully...');

		}

		public function filterAppointmentServices(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
	
			$name = $request->FilterBy;
			$param = $request->parameter;
	  
			switch ( $name ) {
				case 'Name':
	
					$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

					$result['appservices'] = DB::table('appointment_services')->join('appointment_outlet','appointment_outlet.id','=','appointment_services.outlet_id')->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')->orderBy('appointment_services.id','DESC')->paginate(10);
	  
				break;
				
				case 'Title':

					$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();
	
					$result['appservices'] = DB::table('appointment_services')->join('appointment_outlet','appointment_outlet.id','=','appointment_services.outlet_id')->where('appointment_services.title', 'LIKE', '%' . $param . '%')->orderBy('appointment_services.id','DESC')->paginate(10);
	
		
				break;
				default:
	
				$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

				$result['appservices'] = DB::table('appointment_services')->join('appointment_outlet','appointment_outlet.id','=','appointment_services.outlet_id')->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')->orderBy('appointment_services.id','DESC')->paginate(10);
	
					break;
				  }
				  return view("admin.appointment.appointment_services")->with('result', $result)->with('name', $name)->with('param', $param);
		  }
	

		public function appointmentStaffs(Request $request){
			$result['commonContent'] = $this->Setting->commonContent();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

			$result['appstaffs'] = DB::table('appointment_staffs')->select('appointment_staffs.*','appointment_outlet.name','image_categories.path')->join('appointment_outlet','appointment_outlet.id','appointment_staffs.outlet_id')->LeftJoin('image_categories', function ($join) {
                  $join->on('image_categories.image_id', '=', 'appointment_staffs.image')
                      ->where(function ($query) {
                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                      });
              })->paginate(10);
			
			return view("admin.appointment.appointment_staffs")->with('result', $result);
		}


		public function addAppointmentStaffs(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			$images = new Images;
			$allimage = $images->getimages();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();
			return view("admin.appointment.add_appointment_staffs")->with('result', $result)->with('allimage',$allimage);

		}

		public function addAppointmentStaffsAction(Request $request){

			$appointmentService = DB::table('appointment_staffs')->insertGetId([
				'outlet_id' => $request->outlet_id,
				'title' => $request->title,
				'image' => $request->image,
				'description' => $request->description,
				'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
			]);

			return redirect()->back()->with('update','Appointment Staffs Added Successfully...');
		}

		public function editAppointmentStaffs(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			$images = new Images;
			$allimage = $images->getimages();

			$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

			$result['editappstaffs'] = DB::table('appointment_staffs')->select('appointment_staffs.*','appointment_outlet.name','image_categories.path')->join('appointment_outlet','appointment_outlet.id','appointment_staffs.outlet_id')->LeftJoin('image_categories', function ($join) {
				$join->on('image_categories.image_id', '=', 'appointment_staffs.image')
					->where(function ($query) {
						$query->where('image_categories.image_type', '=', 'THUMBNAIL')
							->where('image_categories.image_type', '!=', 'THUMBNAIL')
							->orWhere('image_categories.image_type', '=', 'ACTUAL');
					});
			})->where('appointment_staffs.id',$request->id)->first();

			return view("admin.appointment.edit_appointment_staffs")->with('result', $result)->with('allimage',$allimage);

		}

		public function editAppointmentStaffsAction(Request $request){

			$appointmentService = DB::table('appointment_staffs')->where('id',$request->id)->update([
				'outlet_id' => $request->outlet_id,
				'title' => $request->title,
				'image' => $request->image,
				'description' => $request->description,
				'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
			]);

			return redirect()->back()->with('update','Appointment Staffs Updated Successfully...');
		}

		public function deleteAppointmentStaffs(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
			DB::table('appointment_staffs')->where('id', $request->orders_id)->delete();
			return redirect()->back()->with('update','Appointment Staffs Deleted Successfully...');

		}

		public function filterAppointmentStaffs(Request $request){

			$result['commonContent'] = $this->Setting->commonContent();
	
			$name = $request->FilterBy;
			$param = $request->parameter;
	  
			switch ( $name ) {
				case 'Name':
	
					$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

					$result['appstaffs'] = DB::table('appointment_staffs')->join('appointment_outlet','appointment_outlet.id','=','appointment_staffs.outlet_id')->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')->orderBy('appointment_staffs.id','DESC')->paginate(10);
	  
				break;
				
				case 'Title':

					$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();
	
					$result['appstaffs'] = DB::table('appointment_staffs')->join('appointment_outlet','appointment_outlet.id','=','appointment_staffs.outlet_id')->where('appointment_staffs.title', 'LIKE', '%' . $param . '%')->orderBy('appointment_staffs.id','DESC')->paginate(10);
	
		
				break;
				default:
	
				$result['outlet'] = DB::table('appointment_outlet')->join('appointment_setting','appointment_setting.outlet_id','appointment_outlet.id')->where('appointment_outlet.status',1)->where('appointment_setting.services',1)->select('appointment_outlet.id as outID','appointment_outlet.name')->get();

				$result['appstaffs'] = DB::table('appointment_staffs')->join('appointment_outlet','appointment_outlet.id','=','appointment_staffs.outlet_id')->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')->orderBy('appointment_staffs.id','DESC')->paginate(10);
	
					break;
				  }
				  return view("admin.appointment.appointment_staffs")->with('result', $result)->with('name', $name)->with('param', $param);
		  }

}
