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

class GalleryController extends Controller
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

	
	public function viewGallery(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		$result['gallery'] = DB::table('gallery')->where('status',1)->paginate(10);
		return view("admin.gallery.view")->with('result', $result);
	}



	public function addGallery(Request $request){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		return view("admin.gallery.add")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}

	public function addGalleryAction(Request $request){

		  //orders status history
		  $gallery = DB::table('gallery')->insertGetId([
			
				'name' => $request->name,
				'name1' => $request->name1,
				'description' => $request->description,
                'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),

            ]);


			return redirect()->back()->with('update','Gallery Added Successfully...');
	}


	public function editGallery(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['gallery'] = DB::table('gallery')->where('id','=',$id)->first();

		return view("admin.gallery.edit")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}



	public function editGalleryAction(Request $request){


		if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

		//orders status history
		$gallery = DB::table('gallery')->where('id',$request->id)->update([
			
				'name' => $request->name,
				'name1' => $request->name1,
				'description' => $request->description,
                'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
		]);


		  return redirect()->back()->with('update','Gallery Updated Successfully...');
  	}



  	public function deleteGallery(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('gallery')->where('id', $request->orders_id)->delete();
		DB::table('gallery_image')->where('gallery_id', $request->orders_id)->delete();
		return redirect()->back()->with('update','Gallery Deleted Successfully...');

	}



	public function galleryFilter(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();

		$name = $request->FilterBy;
		$param = $request->parameter;
  
		switch ( $name ) {
			case 'Name':

				$result['gallery'] = DB::table('why_choose_us')->where('name', 'LIKE', '%' . $param . '%')->orderBy('id','DESC')->paginate(10);
  
			break;
			
			default:

					$result['gallery'] = DB::table('why_choose_us')->orderBy('id','DESC')->paginate(10);

				break;
			  }
			  return view("admin.gallery.view")->with('result', $result)->with('name', $name)->with('param', $param);
	  }




	  public function viewGalleryImage(Request $request,$id){

		$result['gallery'] = DB::table('gallery')->where('id','=',$id)->first();

		$result['commonContent'] = $this->Setting->commonContent();
		$result['galleryimage'] = DB::table('gallery_image')->select('gallery_image.*','image_categories.path')->join('image_categories','image_categories.image_id','=','gallery_image.image')->where('image_categories.image_type','ACTUAL')->where('gallery_image.status',1)->where('gallery_image.gallery_id',$id)->paginate(10);
		return view("admin.gallery.view_image")->with('result', $result);
	}



	public function addGalleryImage(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['gallery'] = DB::table('gallery')->where('id','=',$id)->first();


		return view("admin.gallery.add_image")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}

	public function addGalleryImageAction(Request $request){


		//orders status history
		$galleryimage = DB::table('gallery_image')->insertGetId([
			
			'gallery_id' => $request->id,
			'image' => $request->image_id,
			'status' => $request->status,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);

			return redirect()->back()->with('update','Gallery Image Added Successfully...');
	}


	public function editGalleryImage(Request $request,$id){

		$customerData = array();
        $customerData['countries'] = $this->Setting->countries();
		$result['commonContent'] = $this->Setting->commonContent();
		$images = new Images;
		$allimage = $images->getimages();
		$result['galleryimage'] = DB::table('gallery_image')->where('id','=',$id)->first();
		$result['galleryimage_image'] =  DB::table('image_categories')->where('image_type','ACTUAL')->where('image_id','=',$result['galleryimage']->image)->first();

		return view("admin.gallery.edit_image")->with('result', $result)->with('allimage', $allimage)->with('data', $customerData);
	}



	public function editGalleryImageAction(Request $request){


		if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

		//orders status history
		$image = DB::table('gallery_image')->where('id',$request->id)->update([
			
				'image' => $uploadImage,
                'status' => $request->status,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
		]);


		  return redirect()->back()->with('update','Gallery Image Updated Successfully...');
  	}



  	public function deleteGalleryImage(Request $request){

		$result['commonContent'] = $this->Setting->commonContent();
		DB::table('gallery_image')->where('id', $request->orders_id)->delete();
		return redirect()->back()->with('update','Gallery Image Deleted Successfully...');

	}




}
