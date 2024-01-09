<?php
namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
//for password encryption or hash protected
use App\Models\Core\Languages;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use DB;
use Illuminate\Http\Request;

//for authenitcate login data
use Lang;

//for requesting a value

class AdminSlidersController extends Controller
{

    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    //listingTaxClass
    public function sliders(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingSliders"));

        $result = array();
        $message = array();

        

        $banner = DB::table('sliders_images')
            ->leftJoin('languages', 'languages.languages_id', '=', 'sliders_images.languages_id')
           /*  ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id') */
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'sliders_images.sliders_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as tabTable', function ($join) {
                $join->on('tabTable.image_id', '=', 'sliders_images.sliders_tab_image')
                    ->where(function ($query) {
                        $query->where('tabTable.image_type', '=', 'THUMBNAIL')
                            ->where('tabTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('tabTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('sliders_images.*','categoryTable.path as path', 'categoryTable.path_type as path_type','iconTable.path as iconpath', 'iconTable.path_type as iconpath_type', 'tabTable.path as tabpath', 'tabTable.path_type as tabpath_type', 'languages.name as language_name');

            $current_theme = DB::table('current_theme')->where('id', '=', '1')->first();

            if($request->sliderType == ''){
                
            if($current_theme->template == 0)
            {
                if($current_theme->carousel == 1)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [1,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 1);
                    }
                    
                }
                if($current_theme->carousel == 2)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [2,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 2);
                    }
                }
                if($current_theme->carousel == 3)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [3,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 3);
                    }
                }
                if($current_theme->carousel == 4)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [4,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 4);
                    }
                }
                if($current_theme->carousel == 5)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [5,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 5);
                    }
                }
                if($current_theme->carousel == 6)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [6,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 6);
                    }
                }
                if($current_theme->carousel == 7)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [7,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 7);
                    }
                }
                if($current_theme->carousel == 8)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [8,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 8);
                    }
                }
                if($current_theme->carousel == 9)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [9,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 9);
                    }
                }
                if($current_theme->carousel == 10)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [10,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 10);
                    }
                }
                if($current_theme->carousel == 11)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [11,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 11);
                    }
                }
                if($current_theme->carousel == 12)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [12,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 12);
                    }
                }
                if($current_theme->carousel == 13)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [13,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 13);
                    }
                }
                if($current_theme->carousel == 14)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [14,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 14);
                    }
                }
                if($current_theme->carousel == 15)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [15,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 15);
                    }
                }
                if($current_theme->carousel == 16)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [16,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 16);
                    }
                }
                if($current_theme->carousel == 17)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [17,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 17);
                    }
                }
                if($current_theme->carousel == 18)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [18,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 18);
                    }
                }
                if($current_theme->carousel == 19)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [19,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 19);
                    }
                }
                if($current_theme->carousel == 20)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [20,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 20);
                    }
                }
                if($current_theme->carousel == 21)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [21,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 21);
                    }
                }
                if($current_theme->carousel == 22)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [22,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 22);
                    }
                }
                if($current_theme->carousel == 23)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [23,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 23);
                    }
                }
                if($current_theme->carousel == 24)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [24,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 24);
                    }
                }
                if($current_theme->carousel == 25)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [25,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 25);
                    }
                }
                if($current_theme->carousel == 26)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [26,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 26);
                    }
                }
                if($current_theme->carousel == 27)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [27,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 27);
                    }
                }
                if($current_theme->carousel == 28)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [28,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 28);
                    }
                }
                if($current_theme->carousel == 29)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [29,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 29);
                    }
                }
                if($current_theme->carousel == 30)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [30,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 30);
                    }
                }
                if($current_theme->carousel == 31)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [31,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 31);
                    }
                }
                if($current_theme->carousel == 32)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [32,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 32);
                    }
                }
                if($current_theme->carousel == 33)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [33,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 33);
                    }
                }
                
                if($current_theme->carousel == 35)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [35,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 35);
                    }
                }
                if($current_theme->carousel == 36)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [36,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 36);
                    }
                }
                if($current_theme->carousel == 37)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [37,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 37);
                    }
                }
                if($current_theme->carousel == 38)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [38,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 38);
                    }
                }
                if($current_theme->carousel == 39)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [39,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 39);
                    }
                }
                if($current_theme->carousel == 40)
                {
                    if($current_theme->recent_arrival == 17)
                    {
                        $banner->whereIn('carousel_id', [40,34]);
                    }
                    else
                    {
                        $banner->where('carousel_id', 40);
                    }
                }
                
            }
            if($current_theme->template == 1)
            {
                $banner->where('carousel_id', 6);
            }
            if($current_theme->template == 2)
            {
                $banner->where('carousel_id', 7);
            }
            if($current_theme->template == 3)
            {
                $banner->where('carousel_id', 8);
            }
            if($current_theme->template == 4)
            {
                $banner->where('carousel_id', 9);
            }
            if($current_theme->template == 5)
            {
                $banner->where('carousel_id', 10);
            }
            if($current_theme->template == 6)
            {
                $banner->where('carousel_id', 11);
            }
            if($current_theme->template == 8)
            {
                $banner->where('carousel_id', 22);
            }
            if($current_theme->template == 9)
            {
                $banner->where('carousel_id', 12);
            }
            if($current_theme->template == 10)
            {
                $banner->where('carousel_id', 23);
            }
            if($current_theme->template == 11)
            {
                $banner->where('carousel_id', 13);
            }
            if($current_theme->template == 12)
            {
                $banner->where('carousel_id', 25);
            }
            if($current_theme->template == 13)
            {
                $banner->where('carousel_id', 26);
            }
            if($current_theme->template == 14)
            {
                $banner->where('carousel_id', 14);
            }
            if($current_theme->template == 15)
            {
                $banner->where('carousel_id', 30);
            }
            if($current_theme->template == 16)
            {
                $banner->where('carousel_id', 27);
            }
            if($current_theme->template == 18)
            {
                $banner->where('carousel_id', 28);
            }
            if($current_theme->template == 19)
            {
                $banner->where('carousel_id', 34);
            }
            if($current_theme->template == 21)
            {
                $banner->where('carousel_id', 15);
            }
            if($current_theme->template == 22)
            {
                $banner->where('carousel_id', 29);
            }
            if($current_theme->template == 23)
            {
                $banner->where('carousel_id', 31);
            }
            if($current_theme->template == 24)
            {
                $banner->where('carousel_id', 32);
            }
            if($current_theme->template == 25)
            {
                $banner->where('carousel_id', 33);
            }
            if($current_theme->template == 26)
            {
                $banner->where('carousel_id', 16);
            }
            if($current_theme->template == 27)
            {
                $banner->where('carousel_id', 35);
            }
            if($current_theme->template == 28)
            {
                $banner->where('carousel_id', 17);
            }
            if($current_theme->template == 29)
            {
                $banner->where('carousel_id', 36);
            }
            if($current_theme->template == 30)
            {
                $banner->where('carousel_id', 37);
            }
            if($current_theme->template == 31)
            {
                $banner->where('carousel_id', 38);
            }
            if($current_theme->template == 32)
            {
                $banner->where('carousel_id', 19);
            }
            if($current_theme->template == 33)
            {
                $banner->where('carousel_id', 19);
            }
            if($current_theme->template == 34)
            {
                $banner->where('carousel_id', 18);
            }
            if($current_theme->template == 35)
            {
                $banner->where('carousel_id', 21);
            }


        }



            if($request->sliderType){
                $banner->where('carousel_id', $request->sliderType);
            }

            
            $banner->orderBy('sliders_images.sliders_id', 'ASC')
            ->groupBy('sliders_images.sliders_id');

        $banners = $banner->paginate(20);

        $result['message'] = $message;
        $result['sliders'] = $banners;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.web.sliders.index", $title)->with('result', $result);
    }

    //addTaxClass
    public function addsliderimage(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddSliderImage"));

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

        return view("admin.settings.web.sliders.add", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    //addNewZone
    public function addNewSlide(Request $request)
    {

        $images = new Images();
        $allimage = $images->getimages();

        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $expiryDate = str_replace('/', '-', $request->expires_date);
        $expiryDateFormate = date('Y-m-d H:i:s', strtotime($expiryDate));
        $type = $request->type;
       
        $uploadImagestab = '';
        if ($request->image_id) {
            $uploadImage = $request->image_id;
        } else {
            $uploadImage = '';
        }

        if ($request->image_icone) {
            $uploadImages = $request->image_icone;
        } else {
            $uploadImages = '';
        }

        if ($request->image_iconetab) {
            $uploadImagestab= $request->image_iconetab;
        } else {
            $uploadImagestab = '';
        }

        if ($type == 'category') {
            $sliders_url = $request->categories_id;
        } else if ($type == 'product') {
            $sliders_url = $request->products_id;
        }
        else if ($type == 'link') {
            $sliders_url = $request->linkContent;
        }
        else if ($type == 'externallink') {
            $sliders_url = $request->externl_linkContent;
        }
         else {
            $sliders_url = '';
        }
        if($request->carousel_id == 1){
            $title = 'Full Screen Slider (1600x420)';
        }elseif($request->carousel_id == 2){
            $title = 'Full Page Slider (1170x420)';
        }elseif($request->carousel_id == 3){
            $title = 'Right Slider with Thumbs (770x400)';
        }elseif($request->carousel_id == 4){
            $title = 'Right Slider with Navigation (770x400)';
        }elseif($request->carousel_id == 5){
            $title = 'Left Slider with Thumbs (770x400)';
        }elseif($request->carousel_id == 6){
            $title = 'Carousal 6';
        }elseif($request->carousel_id == 7){
            $title = 'Carousal 7';
        }elseif($request->carousel_id == 8){
            $title = 'Carousal 8';
        }elseif($request->carousel_id == 9){
            $title = 'Carousal 9';
        }elseif($request->carousel_id == 10){
            $title = 'Carousal 10';
        }elseif($request->carousel_id == 11){
            $title = 'Carousal 11';
        }elseif($request->carousel_id == 12){
            $title = 'Carousal 12';
        }elseif($request->carousel_id == 13){
            $title = 'Carousal 13';
        }elseif($request->carousel_id == 14){
            $title = 'Carousal 14';
        }elseif($request->carousel_id == 15){
            $title = 'Carousal 15';
        }elseif($request->carousel_id == 16){
            $title = 'Carousal 16';
        }elseif($request->carousel_id == 17){
            $title = 'Carousal 17';
        }elseif($request->carousel_id == 18){
            $title = 'Carousal 18';
        }
        elseif($request->carousel_id == 19){
            $title = 'Carousal 19';
        }
        elseif($request->carousel_id == 20){
            $title = 'Carousal 20';
        }
        elseif($request->carousel_id == 21){
            $title = 'Carousal 21';
        }
        elseif($request->carousel_id == 22){
            $title = 'Carousal 22';
        }
        elseif($request->carousel_id == 23){
            $title = 'Carousal 23';
        }
        elseif($request->carousel_id == 24){
            $title = 'Carousal 24';
        }
        elseif($request->carousel_id == 25){
            $title = 'Carousal 25';
        }
        elseif($request->carousel_id == 26){
            $title = 'Carousal 26';
        }
        elseif($request->carousel_id == 27){
            $title = 'Carousal 27';
        }
        elseif($request->carousel_id == 28){
            $title = 'Carousal 28';
        }
        elseif($request->carousel_id == 29){
            $title = 'Carousal 29';
        }
        elseif($request->carousel_id == 30){
            $title = 'Carousal 30';
        }
        elseif($request->carousel_id == 31){
            $title = 'Carousal 31';
        }
        elseif($request->carousel_id == 32){
            $title = 'Carousal 32';
        }
        elseif($request->carousel_id == 33){
            $title = 'Carousal 33';
        }
        elseif($request->carousel_id == 34){
            $title = 'Carousal 34';
        }
        elseif($request->carousel_id == 35){
            $title = 'Carousal 35';
        }
        elseif($request->carousel_id == 36){
            $title = 'Carousal 36';
        }
        elseif($request->carousel_id == 37){
            $title = 'Carousal 37';
        }
        elseif($request->carousel_id == 38){
            $title = 'Carousal 38';
        }

        DB::table('sliders_images')->insert([
            'sliders_title' => $title,
            'title' => $request->title,
            'description' => $request->description,
            'description2' => $request->description2,
            'name' => $request->name,
            'date_added' => date('Y-m-d H:i:s'),
            'sliders_image' => $uploadImage,
            'sliders_mobile_image' => $uploadImages,
            'sliders_tab_image' => $uploadImagestab,
            'carousel_id' => $request->carousel_id,
            'sliders_url' => $sliders_url,
            'status' => $request->status,
            'expires_date' => $expiryDateFormate,
            'type' => $request->type,
            'languages_id' => $request->languages_id,
        ]);

        $message = Lang::get("labels.SliderAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //editTaxClass
    public function editslide(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditSliderImage"));
        $result = array();
        $result['message'] = array();

        $banners = DB::table('sliders_images')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
            ->leftJoin('image_categories as tabTable','tabTable.image_id', '=', 'sliders_images.sliders_tab_image')
            ->select('sliders_images.*',
            'ImageTable.path as imagepath','IconTable.path as iconpath','tabTable.path as tabpath')
            ->where('sliders_id', $request->id)
            ->groupBy('sliders_images.sliders_id')
            ->first();
        $result['sliders'] = $banners;

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

        return view('admin.settings.web.sliders.edit', $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function updateSlide(Request $request)
    {
        $myVar = new Languages();
        $languages = $myVar->getter();
        $expiryDate = str_replace('/', '-', $request->expires_date);
        $expiryDateFormate = date('Y-m-d H:i:s', strtotime($expiryDate));
        $type = $request->type;

        if ($type == 'category') {
            $sliders_url = $request->categories_id;
        } else if ($type == 'product') {
            $sliders_url = $request->products_id;
        }
        else if ($type == 'link') {
            $sliders_url = $request->linkContent;
        }
        else if ($type == 'externallink') {
            $sliders_url = $request->externl_linkContent;
        } else {
            $sliders_url = '';
        }

        if($request->carousel_id == 1){
            $title = 'Full Screen Slider (1600x420)';
        }elseif($request->carousel_id == 2){
            $title = 'Full Page Slider (1170x420)';
        }elseif($request->carousel_id == 3){
            $title = 'Right Slider with Thumbs (770x400)';
        }elseif($request->carousel_id == 4){
            $title = 'Right Slider with Navigation (770x400)';
        }elseif($request->carousel_id == 5){
            $title = 'Left Slider with Thumbs (770x400)';
        }elseif($request->carousel_id == 6){
            $title = 'Carousal 6';
        }elseif($request->carousel_id == 7){
            $title = 'Carousal 7';
        }elseif($request->carousel_id == 8){
            $title = 'Carousal 8';
        }elseif($request->carousel_id == 9){
            $title = 'Carousal 9';
        }elseif($request->carousel_id == 10){
            $title = 'Carousal 10';
        }elseif($request->carousel_id == 11){
            $title = 'Carousal 11';
        }elseif($request->carousel_id == 12){
            $title = 'Carousal 12';
        }elseif($request->carousel_id == 13){
            $title = 'Carousal 13';
        }elseif($request->carousel_id == 14){
            $title = 'Carousal 14';
        }elseif($request->carousel_id == 15){
            $title = 'Carousal 15';
        }elseif($request->carousel_id == 16){
            $title = 'Carousal 16';
        }elseif($request->carousel_id == 17){
            $title = 'Carousal 17';
        }elseif($request->carousel_id == 18){
            $title = 'Carousal 18';
        }
        elseif($request->carousel_id == 19){
            $title = 'Carousal 19';
        }
        elseif($request->carousel_id == 20){
            $title = 'Carousal 20';
        }
        elseif($request->carousel_id == 21){
            $title = 'Carousal 21';
        }
        elseif($request->carousel_id == 22){
            $title = 'Carousal 22';
        }
        elseif($request->carousel_id == 23){
            $title = 'Carousal 23';
        }
        elseif($request->carousel_id == 24){
            $title = 'Carousal 24';
        }
        elseif($request->carousel_id == 25){
            $title = 'Carousal 25';
        }
        elseif($request->carousel_id == 26){
            $title = 'Carousal 26';
        }
        elseif($request->carousel_id == 27){
            $title = 'Carousal 27';
        }
        elseif($request->carousel_id == 28){
            $title = 'Carousal 28';
        }
        elseif($request->carousel_id == 29){
            $title = 'Carousal 29';
        }
        elseif($request->carousel_id == 30){
            $title = 'Carousal 30';
        }
        elseif($request->carousel_id == 31){
            $title = 'Carousal 31';
        }
        elseif($request->carousel_id == 32){
            $title = 'Carousal 32';
        }
        elseif($request->carousel_id == 33){
            $title = 'Carousal 33';
        }
        elseif($request->carousel_id == 34){
            $title = 'Carousal 34';
        }
        elseif($request->carousel_id == 35){
            $title = 'Carousal 35';
        }
        elseif($request->carousel_id == 36){
            $title = 'Carousal 36';
        }
        elseif($request->carousel_id == 37){
            $title = 'Carousal 37';
        }
        elseif($request->carousel_id == 38){
            $title = 'Carousal 38';
        }
        
        $uploadIcontab = '';
        if($request->image_id!==null){
            $uploadImage = $request->image_id;
        }else{
            $uploadImage = $request->oldImage;
        }
   
        if($request->image_icone !==null){
            $uploadIcon = $request->image_icone;
        }	else{
            $uploadIcon = $request->oldIcon;
        }

        if($request->image_iconetab !==null){
            $uploadIcontab = $request->image_iconetab;
        }	else{
            $uploadIcontab = $request->oldIcontab;
        }


        $countryUpdate = DB::table('sliders_images')->where('sliders_id', $request->id)->update([
            'date_status_change' => date('Y-m-d H:i:s'),
            'sliders_title' => $title,
            'sliders_image' => $uploadImage,
            'title' => $request->title,
            'description' => $request->description,
            'description2' => $request->description2,
            'name' => $request->name,
            'sliders_mobile_image' => $uploadIcon,
            'sliders_tab_image' => $uploadIcontab,
            'date_added' => date('Y-m-d H:i:s'),
            'sliders_url' => $sliders_url,
            'status' => $request->status,
            'expires_date' => $expiryDateFormate,
            'type' => $request->type,
            'languages_id' => $request->languages_id,
        ]);
   
/* 
        if ($request->image_id) {
            $uploadImage = $request->image_id;
            $countryUpdate = DB::table('sliders_images')->where('sliders_id', $request->id)->update([
                'date_status_change' => date('Y-m-d H:i:s'),
                'sliders_title' => $title,
                'date_added' => date('Y-m-d H:i:s'),
                'sliders_image' => $uploadImage,
                'sliders_url' => $sliders_url,
                'status' => $request->status,
                'expires_date' => $expiryDateFormate,
                'type' => $request->type,
                'languages_id' => $request->languages_id,
            ]);
        } else {
            $countryUpdate = DB::table('sliders_images')->where('sliders_id', $request->id)->update([
                'date_status_change' => date('Y-m-d H:i:s'),
                'sliders_title' => $title,
                'date_added' => date('Y-m-d H:i:s'),
                'sliders_url' => $sliders_url,
                'status' => $request->status,
                'expires_date' => $expiryDateFormate,
                'type' => $request->type,
                'languages_id' => $request->languages_id,
            ]);
        } */

        $message = Lang::get("labels.SliderUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //deleteCountry
    public function deleteSlider(Request $request)
    {
        DB::table('sliders_images')->where('sliders_id', $request->sliders_id)->delete();
        return redirect()->back()->withErrors([Lang::get("labels.SliderDeletedMessage")]);
    }
}
