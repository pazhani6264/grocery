<?php
namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\ConstantBanner;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Lang;

class AdminConstantController extends Controller
{
    public function __construct(Setting $setting, Languages $languages)
    {
        $this->Setting = $setting;
        $this->Languages = $languages;
    }
    //constantBanners
    public function constantBanners(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingConstantBanners"));
        $result = ConstantBanner::paginator($request);
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->Languages->getter();
        if($request->bannerType){
            $bannerType = $request->bannerType;    
        }else{
            $bannerType = '';
        }

        if($request->languages_id){
            $languages_id = $request->languages_id;    
        }else{
            $languages_id = '';
        }
        
        return view("admin.settings.web.banners.index", $title)->with(['result' => $result, 'bannerType'=>$bannerType,'languages_id'=>$languages_id]);
    }

    public function constantBannerstwo(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingConstantBanners"));
        $result = ConstantBanner::paginatortwo($request);
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->Languages->getter();
        if($request->bannerType){
            $bannerType = $request->bannerType;    
        }else{
            $bannerType = '';
        }

        if($request->languages_id){
            $languages_id = $request->languages_id;    
        }else{
            $languages_id = '';
        }
        
        return view("admin.settings.web.bannerstwo.index", $title)->with(['result' => $result, 'bannerType'=>$bannerType,'languages_id'=>$languages_id]);
    }

    public function constantBannersthree(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingConstantBanners"));
        $result = ConstantBanner::paginatorthree($request);
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->Languages->getter();
        if($request->bannerType){
            $bannerType = $request->bannerType;    
        }else{
            $bannerType = '';
        }

        if($request->languages_id){
            $languages_id = $request->languages_id;    
        }else{
            $languages_id = '';
        }
        
        return view("admin.settings.web.bannersthree.index", $title)->with(['result' => $result, 'bannerType'=>$bannerType,'languages_id'=>$languages_id]);
    }

    public function constantBannersfour(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingConstantBanners"));
        $result = ConstantBanner::paginatorfour($request);
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->Languages->getter();
        if($request->bannerType){
            $bannerType = $request->bannerType;    
        }else{
            $bannerType = '';
        }

        if($request->languages_id){
            $languages_id = $request->languages_id;    
        }else{
            $languages_id = '';
        }
        
        return view("admin.settings.web.bannersfour.index", $title)->with(['result' => $result, 'bannerType'=>$bannerType,'languages_id'=>$languages_id]);
    }


    public function addconstantbanner(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddConstantBanner"));

        $result = array();
        $message = array();

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['message'] = $message;
        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.banners.add", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function addNewConstantBanner(Request $request)
    {
        //check exist banner
        $exist = ConstantBanner::existbanner($request);

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {

            //add banner
            $insert = ConstantBanner::insert($request);

            return redirect()->back()->with('success', Lang::get("labels.BannerAddedMessage"));
        }

    }

    public function editconstantbanner(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();

        $banners = ConstantBanner::edit($request);
        $result['banners'] = $banners;

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.banners.edit", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function editconstantbannertwo(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();

        $banners = ConstantBanner::edittwo($request);
        $result['banners'] = $banners;

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.bannerstwo.edit", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function editconstantbannerthree(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();

        $banners = ConstantBanner::editthree($request);
        $result['banners'] = $banners;

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.bannersthree.edit", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function editconstantbannerfour(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();

        $banners = ConstantBanner::editfour($request);
        $result['banners'] = $banners;

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.bannersfour.edit", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function updateconstantBanner(Request $request)
    {
        $exist = ConstantBanner::existbannerforupdate($request);
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {
            $exist = ConstantBanner::updatebanner($request);
            return redirect()->back()->with('success', Lang::get("labels.BannerUpdatedMessage"));
        }
    }

    public function updateconstantBannertwo(Request $request)
    {
     
        $exist = ConstantBanner::existbannerforupdatetwo($request);
        
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {
            $exist = ConstantBanner::updatebannertwo($request);
            return redirect()->back()->with('success', Lang::get("labels.BannerUpdatedMessage"));
        }
    }

    public function updateconstantBannerthree(Request $request)
    {
        $exist = ConstantBanner::existbannerforupdatethree($request);
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {
            $exist = ConstantBanner::updatebannerthree($request);
            return redirect()->back()->with('success', Lang::get("labels.BannerUpdatedMessage"));
        }
    }
    public function updateconstantBannerfour(Request $request)
    {
        $exist = ConstantBanner::existbannerforupdatefour($request);
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {
            $exist = ConstantBanner::updatebannerfour($request);
            return redirect()->back()->with('success', Lang::get("labels.BannerUpdatedMessage"));
        }
    }

    public function deleteconstantBanner(Request $request)
    {
        ConstantBanner::deletebanners($request);
        return redirect()->back()->withErrors([Lang::get("labels.BannerDeletedMessage")]);

    }
}
