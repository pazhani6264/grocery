<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Bannertwo;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class BannerstwoController extends Controller
{
    //

    public function __construct(Bannertwo $bannertwo, Setting $setting)
    {
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Bannertwo = $bannertwo;
        $this->Setting = $setting;
    }
    
    //banners two
    public function banners_two(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingBanners"));

        $result = array();
        $message = array();

        $banners = Bannertwo::sortable()
            ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'bannertwos.banners_image')
            ->select('bannertwos.*', 'categoryTable.path')->orderBy('banners_id')

            ->paginate(20);

        $result['message'] = $message;
        $result['banners'] = $banners;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.Banners_two.index", $title)->with('result', $result);
    }

    //addTaxClass
    public function addbanner_two(Request $request)
    {
        $language_id = 1;
        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.AddBanner"));

        $result = array();
        $message = array();

        //get function from other controller

        $categories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image', 'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug')
            ->where('categories_description.language_id', '=', $language_id)->get();

        $products_id = null;
        $product = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
            ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');
            })
            ->select('products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_id', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
            ->where('products_description.language_id', '=', $language_id);
        if ($products_id != null) {
            $product->where('products.products_id', '=', $products_id);
        } else {
            $product->orderBy('products.products_id', 'DESC');
        }
        $product = $product->get();

        $products = $product;

        $result['message'] = $message;
        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->myVarsetting->getLanguages();

        return view("admin.Banners_two.add", $title)->with('result', $result)->with('allimage', $allimage);
    }

    //addNewZone
    public function addNewBanner_two(Request $request)
    {

        $expiryDate = str_replace('/', '-', $request->expires_date);
        $expiryDateFormate = date('Y-m-d H:i:s', strtotime($expiryDate));
        $type = $request->type;

        //get function from other controller

        $extensions = $this->myVarsetting->imageType();
        $setting = $this->myVarsetting->getSetting();

        if ($request->image_id !== null) {

            $uploadImage = $request->image_id;
        } else {
            $uploadImage = '';
        }

        if ($type == 'category') {
            $banners_url = $request->categories_id;
        } else if ($type == 'product') {
            $banners_url = $request->products_id;
        } else {
            $banners_url = '';
        }

        $this->Bannertwo->fetchbanner($request, $uploadImage, $banners_url, $expiryDateFormate);

        $message = Lang::get("labels.BannerAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //editTaxClass
    public function editbanner_two(Request $request)
    {
        $images = new Images;
        $allimage = $images->getimages();
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();
        $language_id = 1;
        $banners = $this->Bannertwo->editbanners($request);
        $result['banners'] = $banners;

        //get function from other controller
        $categories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image', 'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug')
            ->where('categories_description.language_id', '=', $language_id)->get();

        $products_id = null;
        $product = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
            ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
            ->LeftJoin('specials', function ($join) {

                $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

            })
            ->select('products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_id', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
            ->where('products_description.language_id', '=', $language_id);

        if ($products_id != null) {

            $product->where('products.products_id', '=', $products_id);

        } else {

            $product->orderBy('products.products_id', 'DESC');

        }

        $product = $product->get();

        $products = $product;

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->myVarsetting->getLanguages();

        return view("admin.Banners_two.edit", $title)->with('result', $result)->with('allimage', $allimage);
    }

    //updateTaxClass
    public function updateBanner_two(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        $expiryDate = str_replace('/', '-', $request->expires_date);
        $expiryDateFormate = date('Y-m-d H:i:s', strtotime($expiryDate));
        $type = $request->type;

        //get function from other controller

        $extensions = $this->myVarsetting->imageType();
        $setting = $this->myVarsetting->getSetting();

        if ($request->image_id !== null) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = $request->oldImage;
        }

        if ($type == 'category') {
            $banners_url = $request->categories_id;
        } else if ($type == 'product') {
            $banners_url = $request->products_id;
        } else {
            $banners_url = '';
        }

        $countryData = array();
        $message = Lang::get("labels.BannerUpdatedMessage");

        $bannersUpdate = $this->Bannertwo->updatebanner($request, $uploadImage, $banners_url, $expiryDateFormate);

        return redirect()->back()->withErrors([$message]);
    }

    //deleteCountry
    public function deleteBanner_two(Request $request)
    {
        $this->Bannertwo->deletebanners($request);
        return redirect()->back()->withErrors([Lang::get("labels.BannerDeletedMessage")]);
    }

    public function filterbanners_two(Request $request)
    {
        $name = $request->FilterBy;
        $param = $request->parameter;

        $title = array('pageTitle' => Lang::get("labels.ListingBanners"));

        $result = array();
        $message = array();

        switch ($name) {
            case 'Title':
                $banners = Banner::sortable()
                    ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'banners.banners_image')
                    ->select('banners.*', 'categoryTable.path')
                    ->where('banners.banners_title', 'LIKE', '%' . $param . '%')
                    ->orderBy('banners_id')

                    ->paginate(20);

                break;

            default:

                $banners = Banner::sortable()
                    ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'banners.banners_image')
                    ->select('banners.*', 'categoryTable.path')->orderBy('banners_id')

                    ->paginate(20);
                break;
        }

        $result['message'] = $message;
        $result['banners'] = $banners;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.Banners_two.index", $title)->with('result', $result)->with('name', $name)->with('param', $param);

    }

}
