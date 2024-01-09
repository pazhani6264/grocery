<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Categories;
use App\Models\Core\Languages;
use App\Models\Core\Products;
use DB;
use App\Models\Core\Clientbrand;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Lang;

class ClientbrandController extends Controller
{

    public function __construct(Clientbrand $clientbrand, Images $images, Setting $setting)
    {
        $this->Clientbrand = $clientbrand;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }

    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Clientbrand"));
        $clientbrand = $this->Clientbrand->paginator();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.clientbrand.index", $title)->with('clientbrand', $clientbrand)->with('result', $result);
    }

    public function add(Request $request)
    {

        
        $title = array('pageTitle' => Lang::get("labels.AddNews"));
        $language_id = '1';
        $result = array();

         //get function from other controller
         $myVar = new Categories();
         $categories = $myVar->getter(1);
 
         $images = new Images();
         $allimage = $images->getimages();
 
         $myVar = new Products();
         $products = $myVar->getter();

         $brand = DB::table('manufacturers')->get();
 
       
        $result['languages'] = $this->myVarsetting->getLanguages();
        $result['brand'] = $brand;
        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.clientbrand.add", $title)->with('result', $result)->with('allimage', $allimage);

    }

    //addNewNews
    public function insert(Request $request)
    {

        
        $images = new Images();
        $allimage = $images->getimages();

        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $type = $request->type;
       

        if ($request->image_id) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = '';
        }

        $url = '';
        if($type == 'category') {
            $url = $request->categories_id;
        } 
        if($type == 'product') {
            $url = $request->products_id;
        } 
        if($type == 'brand') {
            $url = $request->brand_id;
        }
   
        DB::table('clientbrand')->insert([
            'title' => $request->title,
            'created_at' => date('Y-m-d H:i:s'),
            'image_id' => $uploadImage,
            'url' => $url,
            'status' => $request->status,
            'type' => $request->type,
        ]);


        $message = Lang::get("labels.SliderAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //editnew
    public function edit(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.EditClientbrand"));
        $result = array();
        $result['message'] = array();

        $brand = DB::table('clientbrand')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'clientbrand.image_id')
            ->select('clientbrand.*',
            'ImageTable.path as imagepath')
            ->where('clientbrand.id', $request->id)
            ->first();
           
        $result['brand'] = $brand;
        $mbrand = DB::table('manufacturers')->get();
        $result['mbrand'] = $mbrand;

        

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        //get function from other controller
        $myVar = new Products();
        $products = $myVar->getter();

        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin.clientbrand.edit', $title)->with(['result' => $result, 'allimage' => $allimage]);

    }

    //updatenew
    public function update(Request $request)
    {
       
        $myVar = new Languages();
        $languages = $myVar->getter();
        $type = $request->type;
        $url = '';
        if($type == 'category') {
            $url = $request->categories_id;
        } 
        if($type == 'product') {
            $url = $request->products_id;
        } 
        if($type == 'brand') {
            $url = $request->brand_id;
        }

        if($request->image_id!==null){
            $uploadImage = $request->image_id;
        }else{
            $uploadImage = $request->oldImage;
        }
   
       
        $countryUpdate = DB::table('clientbrand')->where('id', $request->id)->update([
            'title' => $request->title,
            'image_id' => $uploadImage,
            'url' => $url,
            'status' => $request->status,
            'type' => $request->type,
        ]);
   


        $message = Lang::get("labels.SliderUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //deleteNews
    public function delete(Request $request)
    {
        $this->Clientbrand->destroyrecord($request);
        return redirect()->back()->withErrors(['Client Brand has been deleted successfully!']);
    }

    public function filter(Request $request)
    {
        $name = $request->FilterBy;
        $param = $request->parameter;
        $title = array('pageTitle' => Lang::get("labels.brand"));
        $brand = $this->Clientbrand->filter($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.clientbrand.index", $title)->with('clientbrand', $brand)->with('result', $result)->with('title', $name)->with('param', $param);
    }

}
