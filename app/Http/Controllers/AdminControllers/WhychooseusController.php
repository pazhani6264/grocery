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

class WhychooseusController extends Controller
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



	public function viewWhychooseus(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['whychooseus'] = DB::table('why_choose_us')->select('why_choose_us.*','image_categories.path')->join('image_categories','image_categories.image_id','=','why_choose_us.image')->where('image_categories.image_type','ACTUAL')->where('why_choose_us.status',1)->paginate(10);
		//$result['whychooseus_image'] =  DB::table('image_categories')->where('image_type','ACTUAL')->where('image','=',$result['whychooseus']->image)->first();
		return view("admin.whychooseus.view")->with('result', $result);
	}



	public function addWhychooseus(Request $request){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		return view("admin.whychooseus.add")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}

	public function addWhychooseusAction(Request $request){

		  //orders status history
		  $whychooseus = DB::table('why_choose_us')->insertGetId([
			
				'name' => $request->name,
				'name1' => $request->name1,
				'description' => $request->description,
				'image' => $request->image_id,
                'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),

            ]);


			return redirect()->back()->with('update','Whychooseus Added Successfully...');
	}


	public function editWhychooseus(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['whychooseus'] = DB::table('why_choose_us')->where('id','=',$id)->first();
		$result['whychooseus_image'] =  DB::table('image_categories')->where('image_type','ACTUAL')->where('image_id','=',$result['whychooseus']->image)->first();

		return view("admin.whychooseus.edit")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}



	public function editWhychooseusAction(Request $request){


		if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

		//orders status history
		$outlet = DB::table('why_choose_us')->where('id',$request->id)->update([
			
				'name' => $request->name,
				'name1' => $request->name1,
				'description' => $request->description,
				'image' => $uploadImage,
                'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
		]);


		  return redirect()->back()->with('update','Whychooseus Updated Successfully...');
  	}



  	public function deleteWhychooseus(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('why_choose_us')->where('id', $request->orders_id)->delete();
		DB::table('why_choose_us_image')->where('whychooseid', $request->orders_id)->delete();
		return redirect()->back()->with('update','Whychooseus Deleted Successfully...');

	}



	public function whychooseusFilter(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$name = $request->FilterBy;
		$param = $request->parameter;
  
		switch ( $name ) {
			case 'Name':

				$result['whychooseus'] = DB::table('why_choose_us')->where('name', 'LIKE', '%' . $param . '%')->orderBy('id','DESC')->paginate(10);
  
			break;
			
			default:

					$result['whychooseus'] = DB::table('why_choose_us')->orderBy('id','DESC')->paginate(10);

				break;
			  }
			  return view("admin.whychooseus.view")->with('result', $result)->with('name', $name)->with('param', $param);
	  }



	  public function viewWhychooseusImage(Request $request,$id){

		//$result['gallery'] = DB::table('gallery')->where('id','=',$id)->first();

		$result['commonContent'] = $this->Setting->commonContent();
		$result['galleryimage'] = DB::table('why_choose_us_image')->select('why_choose_us_image.*','image_categories.path')->join('image_categories','image_categories.image_id','=','why_choose_us_image.image')->where('image_categories.image_type','ACTUAL')->where('why_choose_us_image.status',1)->where('why_choose_us_image.whychooseid',$id)->paginate(10);
		return view("admin.whychooseus.view_image")->with('result', $result);
	}



	public function addWhychooseusImage(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		//$result['gallery'] = DB::table('gallery')->where('id','=',$id)->first();


		return view("admin.whychooseus.add_image")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}

	public function addWhychooseusImageAction(Request $request){


		//orders status history
		$galleryimage = DB::table('why_choose_us_image')->insertGetId([
			
			'whychooseid' => $request->id,
			'name' => $request->name,
			'description' => $request->description,
			'image' => $request->image_id,
			'status' => $request->status,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);

			return redirect()->back()->with('update','Whychooseus Image Added Successfully...');
	}


	public function editWhychooseusImage(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['galleryimage'] = DB::table('why_choose_us_image')->where('id','=',$id)->first();
		$result['galleryimage_image'] =  DB::table('image_categories')->where('image_type','ACTUAL')->where('image_id','=',$result['galleryimage']->image)->first();

		return view("admin.whychooseus.edit_image")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}



	public function editWhychooseusImageAction(Request $request){


		if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

		//orders status history
		$image = DB::table('why_choose_us_image')->where('id',$request->id)->update([
			
				'name' => $request->name,
				'description' => $request->description,
				'image' => $uploadImage,
                'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
		]);


		  return redirect()->back()->with('update','Whychooseus Image Updated Successfully...');
  	}



  	public function deleteWhychooseusImage(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('why_choose_us_image')->where('id', $request->orders_id)->delete();
		return redirect()->back()->with('update','Whychooseus Image Deleted Successfully...');

	}



}
