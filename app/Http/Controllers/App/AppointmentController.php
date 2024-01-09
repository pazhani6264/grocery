<?php
namespace App\Http\Controllers\App;

//validator is builtin class in laravel
use Validator;
use Mail;
use DB;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AppModels\Appointment;
use Carbon;


class AppointmentController extends Controller
{

	public function appointmentOutlet(Request $request){
		$appointmentResponse = Appointment::appointmentOutlet($request);
		print $appointmentResponse;
	}
	public function appointmentOutletSelect(Request $request){
		$appointmentResponse = Appointment::appointmentOutletSelect($request);
		print $appointmentResponse;
	}
	public function appointmentDateSelect(Request $request){
		$appointmentResponse = Appointment::appointmentDateSelect($request);
		print $appointmentResponse;
	}
	public function addtoAppointment(Request $request){
		$appointmentResponse = Appointment::addtoAppointment($request);
		print $appointmentResponse;
	}
	public function viewAppointment(Request $request){
		$appointmentResponse = Appointment::viewAppointment($request);
		print $appointmentResponse;
	}
	public function viewAppointmentByID(Request $request){
		$appointmentResponse = Appointment::viewAppointmentByID($request);
		print $appointmentResponse;
	}
	public function cancelAppointment(Request $request){
		$appointmentResponse = Appointment::cancelAppointment($request);
		print $appointmentResponse;
	}
	public function trackAppointment(Request $request){
		$appointmentResponse = Appointment::trackAppointment($request);
		print $appointmentResponse;
	}

}
