<?php
namespace App\Http\Controllers\Web;

use App\Exports\ExportsAppointment;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

//validator is builtin class in laravel
use App\Models\Web\Currency;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Languages;

//for authenitcate login data
use App\Models\Web\Products;
use Auth;

//for requesting a value
use DB;
//for Carbon a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Session;
//email

class AppointmentController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->theme = new ThemeController();
    }


    public function viewAppointment(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();


        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['appointment_count'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->orderby('appointment.id','DESC')->get();


		$result['appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->orderby('appointment.id','DESC')->paginate($pcnts);

        $result['pending_appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->where('appointment.booking_status','!=',3)
        ->where('appointment.booking_status','!=',4)
        ->orderby('appointment.id','DESC')->get();

        $result['completed_appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC')->get();

		
		return view("web.view_appointment")->with('result', $result)->with('final_theme',$final_theme);
	}


    public function  appointmentFilter(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();


        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['appointment_count'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->orderby('appointment.id','DESC');


		$result['appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->orderby('appointment.id','DESC');

        $result['pending_appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->where('appointment.booking_status','!=',3)
        ->where('appointment.booking_status','!=',4)
        ->orderby('appointment.id','DESC');

        $result['completed_appointment'] = DB::table('appointment')
        ->select('appointment.*','appointment.id as appID','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')
        ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
        ->where('appointment.user_id',auth()->guard('customer')->user()->id)
        ->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');


        if ($orders_id) {
            $result['appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['appointment_count']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['pending_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['completed_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $result['appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['appointment_count']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['pending_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['completed_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
        }
        if ($orders_status) {
            $result['appointment']->where('booking_status', $orders_status);
            $result['appointment_count']->where('booking_status', $orders_status);
            $result['pending_appointment']->where('booking_status', $orders_status);
            $result['completed_appointment']->where('booking_status', $orders_status);
        }

        $result['appointment'] = $result['appointment']->paginate($pcnts);
        $result['appointment_count'] = $result['appointment_count']->get();
        $result['pending_appointment'] = $result['pending_appointment']->get();
        $result['completed_appointment'] = $result['completed_appointment']->get();

		
		return view("web.view_appointment")->with('result', $result)->with('final_theme',$final_theme);

    }


    public function pendingAppointment(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['pending_appointment_count'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->where('booking_status','!=',3)->where('booking_status','!=',4)->orderby('id','DESC')->get();

		$result['appointment'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->orderby('id','DESC')->get();

        $result['pending_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','!=',3)->where('appointment.booking_status','!=',4)->orderby('appointment.id','DESC')->groupBy('appointment.id')->paginate($pcnts);

        $result['completed_appointment'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->where('booking_status','=',4)->orderby('id','DESC')->get();


		return view("web.pending_appointment")->with('result', $result)->with('final_theme',$final_theme);
	}



    public function pendingAppointmentFilter(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['pending_appointment_count'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','!=',3)->where('appointment.booking_status','!=',4)->orderby('appointment.id','DESC');

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->orderby('appointment.id','DESC');

        $result['pending_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','!=',3)->where('appointment.booking_status','!=',4)->orderby('appointment.id','DESC');

        $result['completed_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');


        if ($orders_id) {
            $result['appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['pending_appointment_count']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['pending_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['completed_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $result['appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['pending_appointment_count']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['pending_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['completed_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
        }
        if ($orders_status) {
            $result['appointment']->where('booking_status', $orders_status);
            $result['pending_appointment_count']->where('booking_status', $orders_status);
            $result['pending_appointment']->where('booking_status', $orders_status);
            $result['completed_appointment']->where('booking_status', $orders_status);
        }

        $result['appointment'] = $result['appointment']->get();
        $result['pending_appointment_count'] = $result['pending_appointment_count']->get();
        $result['pending_appointment'] = $result['pending_appointment']->paginate($pcnts);
        $result['completed_appointment'] = $result['completed_appointment']->get();

		
		return view("web.pending_appointment")->with('result', $result)->with('final_theme',$final_theme);
	}

    public function completedAppointment(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['completed_appointment_count'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->where('booking_status','=',4)->orderby('id','DESC')->get();

		$result['appointment'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->orderby('id','DESC')->get();

        $result['pending_appointment'] = DB::table('appointment')->where('user_id',auth()->guard('customer')->user()->id)->where('booking_status','!=',3)->where('booking_status','!=',4)->orderby('id','DESC')->get();

        $result['completed_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC')->groupBy('appointment.id')->paginate($pcnts);
		
		return view("web.completed_appointment")->with('result', $result)->with('final_theme',$final_theme);
	}


    public function completedAppointmentFilter(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $result['varr'] = str_replace($request->url(), '',$request->fullUrl());

        if($request->pagecnt){
            $pcnts=$request->pagecnt;
        }else{
            $pcnts=10;
        }

        $result['appstatus'] = DB::table('appointment_status')->where('status',1)->get();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;

        $result['completed_appointment_count'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->orderby('appointment.id','DESC');

        $result['pending_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','!=',3)->where('appointment.booking_status','!=',4)->orderby('appointment.id','DESC');

        $result['completed_appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','appointment.created_at as createdDate','appointment_status.status_name','appointment_status.id as status_id')->join('products','products.products_id','=','appointment.product_id')->join('products_description','products_description.products_id','=','appointment.product_id')->join('appointment_status','appointment_status.id','=','appointment.booking_status')->where('appointment.user_id',auth()->guard('customer')->user()->id)->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');


        if ($orders_id) {
            $result['appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['completed_appointment_count']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['pending_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

            $result['completed_appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $result['appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['completed_appointment_count']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['pending_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
            $result['completed_appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
        }
        if ($orders_status) {
            $result['appointment']->where('booking_status', $orders_status);
            $result['completed_appointment_count']->where('booking_status', $orders_status);
            $result['pending_appointment']->where('booking_status', $orders_status);
            $result['completed_appointment']->where('booking_status', $orders_status);
        }

        $result['appointment'] = $result['appointment']->get();
        $result['completed_appointment_count'] = $result['completed_appointment_count']->get();
        $result['pending_appointment'] = $result['pending_appointment']->get();
        $result['completed_appointment'] = $result['completed_appointment']->paginate($pcnts);

		
		return view("web.completed_appointment")->with('result', $result)->with('final_theme',$final_theme);
	}


    public function viewAppointmentDetail($id,Request $request){
        
        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','image_categories.path_type','image_categories.path','appointment.created_at as createdDate')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('products_description','products_description.products_id','=','appointment.product_id')->join('image_categories','image_categories.image_id','=','products.products_image')->where('appointment.id',$id)->first();
		
		$result['appstatus'] = DB::table('appointment_status')->get();

		$result['outlet'] = DB::table('appointment_outlet')->select('appointment_outlet.name','appointment_outlet.phone','appointment_outlet.address','appointment_outlet.postal_code')->join('appointment','appointment.outlet_id','=','appointment_outlet.id')->where('appointment.id',$id)->first();

		$result['appointment_setting'] = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->first();

		$result['orderTrack'] = DB::table('appointment_track')->join('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.appointment_id',$id)->get();
		
		return view("web.view_appointment_detail")->with('result', $result)->with('final_theme',$final_theme);
	}



    public function appointmentInvoicePrint($id,Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

		$result['appointment'] = DB::table('appointment')->select('appointment.*','products.*','appointment.id as appID','products_description.*','image_categories.path_type','image_categories.path','appointment.created_at as createdDate')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('products_description','products_description.products_id','=','appointment.product_id')->join('image_categories','image_categories.image_id','=','products.products_image')->where('appointment.id',$id)->first();
		
		$result['appstatus'] = DB::table('appointment_status')->get();

		$result['outlet'] = DB::table('appointment_outlet')->select('appointment_outlet.name','appointment_outlet.phone','appointment_outlet.address','appointment_outlet.postal_code')->join('appointment','appointment.outlet_id','=','appointment_outlet.id')->where('appointment.id',$id)->first();

		$result['appointment_setting'] = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->first();

		$result['orderTrack'] = DB::table('appointment_track')->join('appointment_status','appointment_status.id','=','appointment_track.booking_id')->where('appointment_track.appointment_id',$id)->get();
		
		return view("web.appointment_invoice_print")->with('result', $result);

	}


    public function appointment(Request $request)
    {

        //print_r($request->appTime);die();


        $appointment = DB::table('appointment')->insertGetId([


            'user_id' => auth()->guard('customer')->user()->id,
            'outlet_id' => $request->outlet_id,
            'product_id' => $request->products_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'app_date' => $request->appDate,
            'app_time' => $request->appTime,
            'message' => $request->message,
            'amount'=> $request->products_price,
            'address' => $request->address,
            'app_services' => $request->app_services,
            'app_staffs' => $request->app_staffs,
            'booking_status' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $appointment = DB::table('appointment_track')->insertGetId([

            
            'appointment_id' => $appointment,
            'booking_id' => 1,
            'status' => 1,
            'comments' => '',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $settings = $this->index->commonContent();

        $output = '';
        $outputs = '';
        $name = "Grocery platinum24 online store";
        $app_name =$settings['settings']['app_name'];
        $order_email =$settings['settings']['order_email'];
        $from = $app_name. "<".$order_email.">";
        $to = auth()->guard('customer')->user()->email;
        $website_link = $settings['settings']['external_website_link'];
        $aws_url = $settings['settings']['aws_url'];


        $result = $request->products_id;
        $product=$result;
        $orderno = $settings['setting'][150]->value.$request->products_id;

        $domain = $settings['setting'][123]->value;
        $api_key = $settings['setting'][122]->value;
        $subject = 'Hooray! Your order '.$orderno.' is being processed!';
        $bcc  = '';

        $h = "Here's your tracking details";
        $p = "Please note that it may take up to 1 - 2 days for the tracking status to be updated by the logistics team";
        $url = $website_link."orders";

         $output             .= '<div><h1 style="color: #fd5397;">'.$app_name.'<span style="font-size: 12px; float: right; color: #212529; padding-top:10px;">'.$orderno.'</span></h1></div>
                                    <div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
                                    <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div>
                                    <div style="border-bottom: 1px solid #dee2e6; padding: 15px 0; "></div>
                                    <div><h2 style="color: #212529; font-weight: 400;">Items in this shippment</h2></div><div>';
                                       
                                        $productname=$request->product_name;
                                       

                                        $appointment_setting = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->where('appointment_setting.outlet_id',$request->outlet_id)->first();

                                        $qty=$appointment_setting->no_of_pax;

                                        $iamgepath = DB::table('products')->join('image_categories','image_categories.image_id','=','products.products_image')->where('products.products_id',$request->products_id)->first();

                                        $imgpath=$iamgepath->path;

                                        $website_link = $settings['settings']['external_website_link'];

                                        if($iamgepath->path_type == 'aws')
                                        {
                                            $imgurl = $aws_url.$imgpath;
                                        }
                                        else
                                        {
                                            $imgurl = $website_link.$imgpath;
                                        }

                                           
                                       
                                       
                      
            $output             .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;vertical-align: middle;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
                                    <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';

            $output             .= '</div><div><p style="color: #212529;"> If you have any questions, reply to this email or contact us at <span style="color:#fd5397">orders@grocery.platinum24.net</span></p></div>';

            $html = $output;

            $result=$this->index->mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html);

            // Insert main count in Superadmin

            $resuluser = DB::table('users')->where('role_id', 1)->first();
            $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
            $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
                'email' => $bcc,
                'comments' => 'Appointment',
                'user_id' => $resuluser->id,
                'shop_name' => $resuluser->user_name,
                'shop_id' => $shopmail->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // admin mail

            $outputs  .= '<div><h1 style="color: #fd5397;">'.$name.'<span style="font-size: 12px; float: right; color: #212529; padding-top:10px;">'.$orderno.'</span></h1></div>
        <div><h2 style="color: #212529; font-weight: 400;">'.$h.'</h2><p style="color: #212529; padding-bottom:15px;">'.$p.'</p></div>
        <div style="width: 100%;"><a href="'.$url.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Orders</b></a></div>
        <div style="border-bottom: 1px solid #dee2e6; padding: 15px 0; "></div>
        <div><h2 style="color: #212529; font-weight: 400;">Items in this shippment</h2></div><div>';

        $productname=$request->product_name;

        $appointment_setting = DB::table('appointment_setting')->join('appointment','appointment.outlet_id','=','appointment_setting.outlet_id')->where('appointment_setting.outlet_id',$request->outlet_id)->first();

        $qty=$appointment_setting->no_of_pax;

        $iamgepath = DB::table('products')->join('image_categories','image_categories.image_id','=','products.products_image')->where('products.products_id',$request->products_id)->first();

        $imgpath=$iamgepath->path;

        $website_link = $settings['settings']['external_website_link'];

        if($iamgepath->path_type == 'aws')
        {
            $imgurl = $aws_url.$imgpath;
        }
        else
        {
            $imgurl = $website_link.$imgpath;
        }
           

            $outputs .= '<div style="height: 50px;margin-bottom: 10px;"><div style="display: inline-block; width:50px; height:50px; padding-right:20px; "><img style="max-width: 100%; height: 100%;" src="'.$imgurl.'"></div><div  style="display:inline-block;color:#212529;height: 50px;margin-bottom: 15px;">'.$productname.' * '.$qty.'</div></div>
                    <div style="border-bottom: 1px solid #dee2e6; margin-bottom: 10px; "></div>';
                    
            $outputs .= '</div><div><p style="color: #212529;"> If you have any questions, reply to this email or contact us at <span style="color:#fd5397">orders@platinum24.net</span></p></div>';

        $to = $order_email;
        $subject = $subject;
        
        $message = $outputs;
        $charset = "GB2312";
        
        $header = "From:orders@platinum24.net \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "X-Accept-Language: cn\n";
        $header .= "Content-type: text/html; charset={$charset}\n";
        
        $retval = mail ($to,$subject,$message,$header); 

        // Insert main count in Superadmin

        $resuluser = DB::table('users')->where('role_id', 1)->first();
        $shopmail = DB::connection('mysql2')->table('tb_user')->where('id',$resuluser->super_admin_id)->where('status',1)->first();
        $p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
            'email' => $bcc,
            'comments' => 'Appointment Admin Mail',
            'user_id' => $resuluser->id,
            'shop_name' => $resuluser->user_name,
            'shop_id' => $shopmail->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }

    public function appointmentAjax(Request $request)
    {
        $content = '';
        $ouletcheck = DB::table('appointment_slot')->where('outlet_id',$request->outletID)->where('status','1')->count();

        if($ouletcheck != 0){

            $data = DB::table('appointment_slot')->where('outlet_id',$request->outletID)->where('status','1')->get();
            
            // $starthour = array();
            // $endhour = array();
            // foreach($data as $resdata){

            //     $slotID = $resdata->id;
            //     $starthour = $resdata->start_hour;
            //     if($resdata->end_hour !=''){
            //         $endhour = '- '.$resdata->end_hour;
            //     }else{
            //         $endhour = '';
            //     }
                
            //     $endhourValue = $resdata->end_hour;

            //     $content .= '<div class="chip chip-checkbox" aria-labelledby="'.$slotID.'" tabindex="0" role="radio" aria-checked="false">';
            //     $content .= '<input type="radio" name="app_time" id="app_time" value="'.$starthour.'-'.$endhourValue.'"/>';
            //     $content .= '<span id="'.$slotID.'">'.$starthour.' '.$endhour.'</span>';
            //     $content .= '</div>';

            // }

            return $data;
            
        } else {
            
            // $content .= '<span style="color:red">Please add time slot in admin panel</span>';
            return 0;

        }

        return response()->json([

            // 'startHour'=> $starthour,
            // 'endHour'=>$endhour,
            'content'=> $content,
    
          ]);
        
        
    }

    public function appointmentAjaxDate(Request $request)
    {
       
        $content = '';
        $starthour = array();
        $endhour = array();

   

        $appointmentCheck = DB::table('appointment')->where('app_date','=',$request->date)->where('outlet_id',$request->outletID)->where('status','1')->count();

        if($appointmentCheck != 0){

            $slot = DB::table('appointment_slot')->where('outlet_id',$request->outletID)->where('status','1')->get();

            foreach($slot as $resdata){

                $appointment = DB::table('appointment')->where('app_date','=',$request->date)->where('outlet_id',$request->outletID)->where('app_time',$resdata->start_end)->where('status','1')->first();

                $appointmentCount = DB::table('appointment')->where('app_date','=',$request->date)->where('outlet_id',$request->outletID)->where('app_time',$resdata->start_end)->where('status','1')->count();

                if($appointment){

                    $app_setting = DB::table('appointment_setting')->where('outlet_id',$request->outletID)->where('status','1')->first();

                    if($app_setting->no_of_booking >= $appointmentCount){

                        $slotID = $resdata->id;
                        $starthour = $resdata->start_hour;
                        if($resdata->end_hour !=''){
                            $endhour = '- '.$resdata->end_hour;
                        }else{
                            $endhour = '';
                        }
                        
                        $endhourValue = $resdata->end_hour;
            
                        $content .= '<div class="chip chip-checkbox" aria-labelledby="'.$slotID.'" tabindex="0" role="radio" aria-checked="false">';
                        $content .= '<input type="radio" name="app_time" id="app_time" value="'.$starthour.'-'.$endhourValue.'"/>';
                        $content .= '<span id="'.$slotID.'">'.$starthour.' '.$endhour.'</span>';
                        $content .= '</div>';
                    } else {

                        $content .= '<span style="color:red">Slot not avaialble in this date</span>';

                    }
                }
    
            }
           
        } else {
            
            $slot = DB::table('appointment_slot')->where('outlet_id',$request->outletID)->where('status','1')->get();

            foreach($slot as $resdata){

                $slotID = $resdata->id;
                $starthour = $resdata->start_hour;
                if($resdata->end_hour !=''){
                    $endhour = '- '.$resdata->end_hour;
                }else{
                    $endhour = '';
                }
                
                $endhourValue = $resdata->end_hour;
    
                $content .= '<div class="chip chip-checkbox" aria-labelledby="'.$slotID.'" tabindex="0" role="radio" aria-checked="false">';
                $content .= '<input type="radio" name="app_time" id="app_time" value="'.$starthour.'-'.$endhourValue.'"/>';
                $content .= '<span id="'.$slotID.'">'.$starthour.' '.$endhour.'</span>';
                $content .= '</div>';
    
            }

        }
        
        
       
        

        return response()->json([

            // 'startHour'=> $starthour,
            // 'endHour'=>$endhour,
            'content'=> $content,
    
          ]);
        
        
    }

    public function appointmentAjaxDateByOutletID(Request $request)
    {  
        $allholidays=DB::table('appointment_holiday')->where('status',1)->where('outlet_id',$request->outletID)->get();
        return $allholidays;
    }
    


     //updatestatus
     public function appointmentUpdateStatus(Request $request)
     {   
         //  dd($request->orders_status);
         if (!empty($request->appointment_id)) {
             $date_added = date('Y-m-d h:i:s');
             $comments = 'user cancel this order';

             $appointmentCheck = DB::table('appointment')->where(['user_id' => auth()->guard('customer')->user()->id], ['id' => $request->appointment_id])->get();
             
             if (count($appointmentCheck) > 0) {
 
                $appointment_track = DB::table('appointment_track')->insertGetId(
                    [
                        'appointment_id' => $request->appointment_id,
                        'booking_id' => $request->orders_status,
                        'comments' => $comments,
                        'status' => '1',
                        'created_at' => $date_added,
                    ]
                );

                $appointment = DB::table('appointment')->where('id',$request->appointment_id)->update([
                
                    'booking_status' => $request->orders_status,

                ]);

                $order_user= DB::table('appointment')->where('id', '=', $request->appointment_id)->first();

                $user= DB::table('users')->where('id', '=', $order_user->user_id)->first();

                $order_email = DB::table('settings')->where('id', '=','71')->first();
                $app_name = DB::table('settings')->where('id', '=','19')->first();
                $website_logo = DB::table('settings')->where('id', '=','16')->first();
                $api_key = DB::table('settings')->where('id', '=','123')->first();
                $domain = DB::table('settings')->where('id', '=','124')->first();
                $website_link = DB::table('settings')->where('id', '=','103')->first();
    
                $imagepath = DB::table('image_categories')->where('path', '=', $website_logo->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                if($imagepath->path_type == 'aws')
                {
                    $imgurl = $website_logo->value;
                }
                else
                {
                    $imgurl = $website_link.$website_logo->value;
                }
    
    
                $title = 'Congratulation '.$user->first_name. ' !';
    
                $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;width: 150px;height: 150px;margin: auto;"><img src="'.$imgurl .'" style="height: 100%;width: 100%;object-fit: contain;" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"><p style="text-align:center;">Your Appointment was Cancelled Successfully....!</p></div></div>';
    
    
    
                $subject = $title;
                $MailData            = array();
                $api_key             = $api_key->value;
                $domain              = $domain->value;
                $MailData['from']    = $app_name->value. "<".$order_email->value.">";
                $MailData['to']      = $user->email;
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
                

                
                 return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
             } else {
                 return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
             }
         } else {
             return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
         }
     }
 

     public function holidayOutlet(Request $request){

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

		
		$result = DB::table('appointment_holiday')->where('outlet_id',$request->outletID)->where('status',1)->get();
		return $result;

	}


    public function appointmentExport(Request $request) 
    {

        $date = date('Y-m-d H:i:s');

        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;


        if($request->status_name == 'All'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->orderby('appointment.id','DESC');
        } elseif($request->status_name == 'Pending'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->where('appointment.booking_status','!=',3)
            ->where('appointment.booking_status','!=',4)
            ->orderby('appointment.id','DESC');
        } elseif($request->status_name == 'Completed'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');
        }


        if ($orders_id) {
            $result['appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $result['appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
          
        }
        if ($orders_status) {
            $result['appointment']->where('booking_status', $orders_status);
           
        }

        $appointmentdata = $result['appointment']->get();

        $appointment = array();
        foreach($appointmentdata as $resdata){

            $appointment[] = array(
                $appID = $resdata->appID,
                $createdDate = $resdata->createdDate,
                $amount = Session::get('symbol_left').' '.$resdata->amount. ' ' .Session::get('symbol_right'),
                $status_name = $resdata->status_name
            );

        }

        //print_r($appointment);die();

        return Excel::download(new ExportsAppointment($appointment), 'Appointment_'.$date.'.xlsx');

    }


    public function appointmentPDF(Request $request) 
    {
        $date = date('Y-m-d H:i:s');

       
        $index = new Index();
        $result = array();
        $result['commonContent'] = $index->commonContent();
        $final_theme = $this->theme->theme();

        $orders_id = $request->orders_id;
        $orders_status = $request->orders_status;


        if($request->status_name == 'All'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->orderby('appointment.id','DESC');
        } elseif($request->status_name == 'Pending'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->where('appointment.booking_status','!=',3)
            ->where('appointment.booking_status','!=',4)
            ->orderby('appointment.id','DESC');
        } elseif($request->status_name == 'Completed'){
            $result['appointment'] = DB::table('appointment')
            ->select('appointment.id as appID','appointment.created_at as createdDate','appointment.amount','appointment_status.status_name')
            ->join('appointment_status','appointment_status.id','=','appointment.booking_status')
            ->where('appointment.user_id',auth()->guard('customer')->user()->id)
            ->where('appointment.booking_status','=',4)->orderby('appointment.id','DESC');
        }


        if ($orders_id) {
            $result['appointment']->where(function ($q) use ($orders_id) {
                $q->where('appointment.id', 'like', "$orders_id%");
            });

        }
        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

            $result['appointment']->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
          
        }
        if ($orders_status) {
            $result['appointment']->where('booking_status', $orders_status);
           
        }

        $result['appointment'] = $result['appointment']->get();


        $pdf = PDF::loadView('web.appointmentpdf', ['result' => $result]);

        return $pdf->download('Appointment_'.$date.'.pdf');
    }  



    public function appointmentServices(Request $request)
    {
        $content = '';
        $ouletcheck = DB::table('appointment_services')->where('outlet_id',$request->outletID)->where('status','1')->count();

        if($ouletcheck != 0){
            $data = DB::table('appointment_services')->where('outlet_id',$request->outletID)->where('status','1')->get();
            return $data;
        } else {
            return 0;
        }
    }

    public function appointmentStaffs(Request $request)
    {
        $content = '';
        $ouletcheck = DB::table('appointment_staffs')->where('outlet_id',$request->outletID)->where('status','1')->count();

        if($ouletcheck != 0){
            $data = DB::table('appointment_staffs')->where('outlet_id',$request->outletID)->where('status','1')->get();
            return $data;
        } else {
            return 0;
        }
    }



}
