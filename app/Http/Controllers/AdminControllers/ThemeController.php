<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Theme;
use DB;
use Illuminate\Http\Request;
use App\Models\Core\Languages;
use Lang;
use View;
use App\Models\Core\Setting;

class ThemeController extends Controller
{
    //

    public function __construct(Setting $setting,Images $images)
    {
        $this->Setting = $setting;
        $this->images = $images;
    }

    public function moveToBanners($banner_id)
    {
        $result = array();
        $images = new Images();
        $theme = new Theme();
        $allimage = $images->getimages();
        $result['images'] = $allimage;
        $homeBanners = $theme->getBanners($banner_id);
        $result['languages'] = $homeBanners;
        if ($banner_id == 1) {
            $banner = (string) View::make('admin.banners_views.banner1', ['result' => $result])->render();
        } elseif ($banner_id == 2) {
            $banner = (string) View::make('admin.banners_views.banner2', ['result' => $result])->render();
        } elseif ($banner_id == 3) {
            $banner = (string) View::make('admin.banners_views.banner3', ['result' => $result])->render();
        } elseif ($banner_id == 4) {
            $banner = (string) View::make('admin.banners_views.banner4', ['result' => $result])->render();
        } elseif ($banner_id == 5) {
            $banner = (string) View::make('admin.banners_views.banner5', ['result' => $result])->render();
        } elseif ($banner_id == 6) {
            $banner = (string) View::make('admin.banners_views.banner6', ['result' => $result])->render();
        } elseif ($banner_id == 7) {
            $banner = (string) View::make('admin.banners_views.banner7', ['result' => $result])->render();
        } elseif ($banner_id == 8) {
            $banner = (string) View::make('admin.banners_views.banner8', ['result' => $result])->render();
        } elseif ($banner_id == 9) {
            $banner = (string) View::make('admin.banners_views.banner9', ['result' => $result])->render();
        } elseif ($banner_id == 10) {
            $banner = (string) View::make('admin.banners_views.banner10', ['result' => $result])->render();
        } elseif ($banner_id == 11) {
            $banner = (string) View::make('admin.banners_views.banner11', ['result' => $result])->render();
        } elseif ($banner_id == 12) {
            $banner = (string) View::make('admin.banners_views.banner12', ['result' => $result])->render();
        } elseif ($banner_id == 13) {
            $banner = (string) View::make('admin.banners_views.banner13', ['result' => $result])->render();
        } elseif ($banner_id == 14) {
            $banner = (string) View::make('admin.banners_views.banner14', ['result' => $result])->render();
        } elseif ($banner_id == 15) {
            $banner = (string) View::make('admin.banners_views.banner15', ['result' => $result])->render();
        } elseif ($banner_id == 16) {
            $banner = (string) View::make('admin.banners_views.banner16', ['result' => $result])->render();
        } elseif ($banner_id == 17) {
            $banner = (string) View::make('admin.banners_views.banner17', ['result' => $result])->render();
        } elseif ($banner_id == 18) {
            $banner = (string) View::make('admin.banners_views.banner18', ['result' => $result])->render();
        } elseif ($banner_id == 19) {
            $banner = (string) View::make('admin.banners_views.banner19', ['result' => $result])->render();
        } elseif ($banner_id == 20) {
            $banner = (string) View::make('admin.banners_views.carousal_banner1', ['result' => $result])->render();
        } elseif ($banner_id == 21) {
            $banner = (string) View::make('admin.banners_views.ad_banner1', ['result' => $result])->render();        
        } elseif ($banner_id == 41) {
            $banner = (string) View::make('admin.banners_views.ad_banner3', ['result' => $result])->render();
        }
        else {
            $banner = (string) View::make('admin.banners_views.ad_banner2', ['result' => $result])->render();
        }

        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.theme.banner_images')->with('banner', $banner)->with('result', $result);
    }

    public function moveToSliders($carousal_id)
    {
        $result = array();
        $images = new Images();
        $theme = new Theme();
        $allimage = $images->getimages();
        $result['images'] = $allimage;
        $sliders = $theme->getSliders($carousal_id);
        $result['languages'] = $sliders;
        if ($carousal_id == 1) {
            $slider = (string) View::make('admin.sliders_view.carousal1', ['result' => $result])->render();
        } elseif ($carousal_id == 2) {
            $slider = (string) View::make('admin.sliders_view.carousal2', ['result' => $result])->render();
        } elseif ($carousal_id == 3) {
            $slider = (string) View::make('admin.sliders_view.carousal3', ['result' => $result])->render();
        } elseif ($carousal_id == 4) {
            $slider = (string) View::make('admin.sliders_view.carousal4', ['result' => $result])->render();
        } else {
            $slider = (string) View::make('admin.sliders_view.carousal5', ['result' => $result])->render();
        }
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.theme.slider_images')->with('slider', $slider)->with('result', $result);
    }

    public function updatebanner(Request $request)
    {
        $theme = new Theme();
        $theme->updateBanners($request);
        $homeBanners = $theme->getBannersForUpdate($request->style);
        return $homeBanners;
    }

    public function updateslider(Request $request)
    {
        $theme = new Theme();
        $theme->updateSliders($request);
        $sliders = $theme->getSlidersForUpdate($request->carousel_id);
        return $sliders;
    }
    public function index2($id)
    {
        $current_theme = DB::table('current_theme')->first();
        $data = DB::table('front_end_theme_content')->first();
        //dd($data);
        $settings = DB::table('settings')->get();
        $top_offers = json_decode($data->top_offers, true);
        $headers = json_decode($data->headers, true);
        $carousels = json_decode($data->carousels, true);
        $banners = json_decode($data->banners, true);
        $banners_two = json_decode($data->banners_two, true);
        $category = json_decode($data->category, true);
        $productcategory = json_decode($data->productcategory, true);
        $blog = json_decode($data->blog, true);
        $whychooseus = json_decode($data->whychooseus, true);
        $customer_review = json_decode($data->customer_review, true);
        $subscribe = json_decode($data->subscribe, true);
        $footers = json_decode($data->footers, true);
        $brands = json_decode($data->brand, true);
        $info_boxes = json_decode($data->info_box, true);
        $instagrams = json_decode($data->instagram, true);
        $special_pros = json_decode($data->special_pro, true);
        $trend_pros = json_decode($data->trend_pro, true);
        $new_deals = json_decode($data->new_deal, true);
        $tab_sections = json_decode($data->tab_section, true);
        $top_sells = json_decode($data->top_sell, true);
        $recent_arrivals = json_decode($data->recent_arrival, true);
        $multibanners = json_decode($data->multibanner, true);
        $multibanners_one = json_decode($data->multibanner_one, true);
        $multibanners_two = json_decode($data->multibanner_two, true);
        $categories = json_decode($data->category, true);
        $productcategories = json_decode($data->productcategory, true);
        $blogs = json_decode($data->blog, true);
        $whychooseuss = json_decode($data->whychooseus, true);
        $customer_reviews = json_decode($data->customer_review, true);
        $subscribes = json_decode($data->subscribe, true);
        $flashes = json_decode($data->flash, true);
        $cart = json_decode($data->cart, true);
        $checkout = json_decode($data->checkout, true);
        $news = json_decode($data->news, true);
        $detail = json_decode($data->detail, true);
        $shop = json_decode($data->shop, true);
        $contact = json_decode($data->contact, true);
        $login = json_decode($data->login, true);
        $news = json_decode($data->news, true);
        //$news = json_decode($data->news, true);
        $transitions = json_decode($data->transitions, true);

        $product_section_order = json_decode($data->product_section_order, true);
        $data = array();
        $data['top_offers'] = $top_offers;
        $data['headers'] = $headers;
        $data['carousels'] = $carousels;
        $data['banners'] = $banners;
        $data['banners_two'] = $banners_two;
        $data['category'] = $category;
        $data['productcategory'] = $productcategory;
        $data['blog'] = $blog;
        $data['whychooseus'] = $whychooseus;
        $data['customer_review'] = $customer_review;
        $data['subscribe'] = $subscribe;
        $data['footers'] = $footers;
        $data['brands'] = $brands;
        $data['info_boxes'] = $info_boxes;
        $data['instagrams'] = $instagrams;
        $data['special_pros'] = $special_pros;
        $data['trend_pros'] = $trend_pros;
        $data['new_deals'] = $new_deals;
        $data['tab_sections'] = $tab_sections;
        $data['top_sells'] = $top_sells;
        $data['recent_arrivals'] = $recent_arrivals;
        $data['multibanners'] = $multibanners;
        $data['multibanners_one'] = $multibanners_one;
        $data['multibanners_two'] = $multibanners_two;
        $data['categories'] = $categories;
        $data['productcategories'] = $productcategories;
        $data['blogs'] = $blogs;
        $data['whychooseuss'] = $whychooseuss;
        $data['customer_reviews'] = $customer_reviews;
        $data['subscribes'] = $subscribes;
        $data['flashes'] = $flashes;
        $data['product_section_order'] = $product_section_order;
        $data['cart'] = $cart;
        $data['checkout'] = $checkout;
        //$data['blog'] = $news;
        $data['detail'] = $detail;
        $data['shop'] = $shop;
        $data['contact'] = $contact;
        $data['section_id'] = $id;
        $data['settings'] = $settings;
        $data['login'] = $login;
        $data['news'] = $news;
        $data['transitions'] = $transitions;
        $categories = DB::table('categories')
            ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image',  'categories.created_at as date_added', 
            'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug'
            , 'categories.parent_id')
            ->where('categories_description.language_id','=', 1 )
            //->where('parent_id', '0')
            ->where('categories_status', '1')
            ->get();


            $theme = new Theme();
            $allimage = $this->images->getimages();
             //get function from other controller
             $myVar = new Languages();
             $result['languages'] = $myVar->getter();
             
      
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.index")->with(['data' => $data, 'result' => $result, 'current_theme' => $current_theme, 'categories'=>$categories , 'allimage'=>$allimage]);
    }

    public function index()
    {
        $current_theme = DB::table('current_theme')->first();
        $data = DB::table('front_end_theme_content')->first();
        $headers = json_decode($data->headers, true);
        $carousels = json_decode($data->carousels, true);
        $banners = json_decode($data->banners, true);
        $footers = json_decode($data->footers, true);
        $brands = json_decode($data->brands, true);
        $info_boxes = json_decode($data->info_boxes, true);
        $instagrams = json_decode($data->instagrams, true);
        $special_pros = json_decode($data->special_pros, true);
        $trend_pros = json_decode($data->trend_pros, true);
        $new_deals = json_decode($data->new_deals, true);
        $tab_sections = json_decode($data->tab_sections, true);
        $top_sells = json_decode($data->top_sells, true);
        $recent_arrivals = json_decode($data->recent_arrivals, true);
        $multibanners = json_decode($data->multibanner, true);
        $multibanners_one = json_decode($data->multibanner_one, true);
        $multibanners_two = json_decode($data->multibanner_two, true);
        $categories = json_decode($data->categories, true);
        $productcategories = json_decode($data->productcategories, true);
        $blogs = json_decode($data->blogs, true);
        $whychooseuss = json_decode($data->whychooseuss, true);
        $customer_reviews = json_decode($data->customer_reviews, true);
        $subscribes = json_decode($data->subscribes, true);
        $flashes = json_decode($data->flashes, true);
        $cart = json_decode($data->cart, true);
        $checkout = json_decode($data->checkout, true);
        $news = json_decode($data->news, true);
        $detail = json_decode($data->detail, true);
        $shop = json_decode($data->shop, true);
        $contact = json_decode($data->contact, true);
        $login = json_decode($data->login, true);
        $banners_two = json_decode($data->banners_two, true);
        $category = json_decode($data->category, true);
        $productcategory = json_decode($data->productcategory, true);
        $blog = json_decode($data->blog, true);
        $whychooseus = json_decode($data->whychooseus, true);
        $customer_review = json_decode($data->customer_review, true);
        $subscribe = json_decode($data->subscribe, true);

        $product_section_order = json_decode($data->product_section_order, true);
        $data = array();
        $data['headers'] = $headers;
        $data['carousels'] = $carousels;
        $data['banners'] = $banners;
        $data['footers'] = $footers;
        $data['brands'] = $brands;
        $data['info_boxes'] = $info_boxes;
        $data['instagrams'] = $instagrams;
        $data['special_pros'] = $special_pros;
        $data['trend_pros'] = $trend_pros;
        $data['new_deals'] = $new_deals;
        $data['tab_sections'] = $tab_sections;
        $data['top_sells'] = $top_sells;
        $data['recent_arrivals'] = $recent_arrivals;
        $data['multibanners'] = $multibanners;
        $data['multibanners_one'] = $multibanners_one;
        $data['multibanners_two'] = $multibanners_two;
        $data['categories'] = $categories;
        $data['productcategories'] = $productcategories;
        $data['blogs'] = $blogs;
        $data['whychooseuss'] = $whychooseuss;
        $data['customer_reviews'] = $customer_reviews;
        $data['subscribes'] = $subscribes;
        $data['flashes'] = $flashes;
        $data['product_section_order'] = $product_section_order;
        $data['cart'] = $cart;
        $data['checkout'] = $checkout;
        $data['blog_news'] = $news;
        $data['detail'] = $detail;
        $data['shop'] = $shop;
        $data['contact'] = $contact;
        $data['login'] = $login;
        $data['banners_two'] = $banners_two;
        $data['category'] = $category;
        $data['productcategory'] = $productcategory;
        $data['blog'] = $blog;
        $data['whychooseus'] = $whychooseus;
        $data['customer_review'] = $customer_review;
        $data['subscribe'] = $subscribe;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.index")->with(['data' => $data, 'result' => $result, 'current_theme' => $current_theme]);
    }

    public function set(Request $request)
    {
        $header_id = $request['request']['header_id'];
        $carousel_id = $request['request']['carousel_id'];
        $banner_id = $request['request']['banner_id'];
        $footer_id = $request['request']['footer_id'];
        $brand_id = $request['request']['brand_id'];
        $info_box_id = $request['request']['info_box_id'];
        $instagram_id = $request['request']['instagram_id'];
        $special_pro_id = $request['request']['special_pro_id'];
        $trend_pro_id = $request['request']['trend_pro_id'];
        $new_deal_id = $request['request']['new_deal_id'];
        $tab_section_id = $request['request']['tab_section_id'];
        $top_sell_id = $request['request']['top_sell_id'];
        $recent_arrival_id = $request['request']['recent_arrival_id'];
        $multibanner_id = $request['request']['multibanner_id'];
        $multibanner_one_id = $request['request']['multibanner_one_id'];
        $multibanner_two_id = $request['request']['multibanner_two_id'];
        $category_id = $request['request']['category_id'];
        $productcategory_id = $request['request']['productcategory_id'];
        $blog_id = $request['request']['blog_id'];
        $whychooseus_id = $request['request']['whychooseus_id'];
        $customer_review_id = $request['request']['customer_review_id'];
        $subscribe_id = $request['request']['subscribe_id'];
        $flash_id = $request['request']['flash_id'];
        $cart = $request['request']['cart_id'];
        $checkout = $request['request']['checkout_id'];
        $news = $request['request']['news_id'];
        $detail = $request['request']['detail_id'];
        $shop = $request['request']['shop_id'];
        $contact = $request['request']['contact_id'];

        $product_section_order = DB::table('front_end_theme_content')->select('product_section_order')->first();
        $product_section_order = $product_section_order->product_section_order;

        $response = DB::table('current_theme')
            ->where('id', 1)
            ->update([
                'header' => $header_id,
                'carousel' => $carousel_id,
                'banner' => $banner_id,
                'footer' => $footer_id,
                'brand' => $brand_id,
                'info_box' => $info_box_id,
                'instagram' => $instagram_id,
                'special_pro' => $special_pro_id,
                'trend_pro' => $trend_pro_id,
                'new_deal' => $new_deal_id,
                'tab_section' => $tab_section_id,
                'top_sell' => $top_sell_id,
                'recent_arrival' => $recent_arrival_id,
                'multibanner' => $multibanner_id,
                'multibanner_one' => $multibanner_one_id,
                'multibanner_two' => $multibanner_two_id,
                'category' => $category_id,
                'productcategory' => $productcategory_id,
                'blog' => $blog_id,
                'whychooseus' => $whychooseus_id,
                'customer_review' => $customer_review_id,
                'subscribe' => $subscribe_id,
                'flash' => $flash_id,
                'product_section_order' => $product_section_order,
            ]);

        return $response;
    }

    public function setPages(Request $request)
    {
        if ($request->page == 2) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'cart' => $request->cart_id,
                ]);
                $message = 'Cart page has been updated Successfully';
           // return redirect('viewcart');
        }
        if ($request->page == 16) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'checkout' => $request->checkout_id,
                ]);
                $message = 'Checkout page has been updated Successfully';
           
        }
        if ($request->page == 3) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'news' => $request->news_id,
                ]);
                $message = 'News page has been updated Successfully';
         //   return redirect('news');
        }
        if ($request->page == 4) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'detail' => $request->detail_id,
                ]);
                $message = 'Product Detail Page has been updated Successfully';
          //  return redirect('/');
        }
        if ($request->page == 5) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'shop' => $request->shop_id,
                ]);
                $message = 'Shop Page has been updated Successfully';
          //  return redirect('shop');
        }
        if ($request->page == 6) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'contact' => $request->contact_id,
                ]);
                $message = 'Contact Us Page has been updated Successfully';
         //   return redirect('contact');
        }
        if ($request->page == 7) {

            if($request->web_color_style == 'app')
            {
                $color_code = '#28B293';
            }
            if($request->web_color_style == 'app')
            {
                $color_code = '#28B293';
            }
            if($request->web_color_style == 'app.theme.1')
            {
                $color_code = '#b7853f';
            }
            if($request->web_color_style == 'app.theme.2')
            {
                $color_code = '#B3182A';
            }
            if($request->web_color_style == 'app.theme.3')
            {
                $color_code = '#3E5902';
            }
            if($request->web_color_style == 'app.theme.4')
            {
                $color_code = '#483A6F';
            }
            if($request->web_color_style == 'app.theme.5')
            {
                $color_code = '#621529';
            }
            if($request->web_color_style == 'app.theme.6')
            {
                $color_code = '#212529';
            }
            if($request->web_color_style == 'app.theme.7')
            {
                $color_code = '#479af1';
            }
            if($request->web_color_style == 'app.theme.8')
            {
                $color_code = '#e83e8c';
            }
            if($request->web_color_style == 'app.theme.9')
            {
                $color_code = '#ff4c3b';
            }
            if($request->web_color_style == 'app.theme.10')
            {
                $color_code = '#c99d7b';
            }
            if($request->web_color_style == 'app.theme.11')
            {
                $color_code = '#866e6c';
            }
            if($request->web_color_style == 'app.theme.12')
            {
                $color_code = '#dc457e';
            }
            if($request->web_color_style == 'app.theme.13')
            {
                $color_code = '#6d7e87';
            }
            if($request->web_color_style == 'app.theme.14')
            {
                $color_code = '#81ba00';
            }
            if($request->web_color_style == 'app.theme.15')
            {
                $color_code = '#01effc';
            }
            if($request->web_color_style == 'app.theme.16')
            {
                $color_code = '#5d7227';
            }
            if($request->web_color_style == 'app.theme.17')
            {
                $color_code = '#5fcbc4';
            }
            if($request->web_color_style == 'app.theme.18')
            {
                $color_code = '#e38888';
            }
            if($request->web_color_style == 'app.theme.19')
            {
                $color_code = '#000000';
            }
            if($request->web_color_style == 'app.theme.20')
            {
                $color_code = '#a6c76c';
            }
            if($request->web_color_style == 'app.theme.21')
            {
                $color_code = '#c96';
            }
            if($request->web_color_style == 'app.theme.22')
            {
                $color_code = '#fcb941';
            }
            if($request->web_color_style == 'app.theme.23')
            {
                $color_code = '#39f';
            }
            if($request->web_color_style == 'app.theme.24')
            {
                $color_code = '#c66';
            }
            if($request->web_color_style == 'app.theme.25')
            {
                $color_code = '#8A6BAA';
            }
            if($request->web_color_style == 'app.theme.26')
            {
                $color_code = '#eea287';
            }
            if($request->web_color_style == 'app.theme.27')
            {
                $color_code = '#1cc0a0';
            }
            if($request->web_color_style == 'app.theme.28')
            {
                $color_code = '#445f84';
            }
            if($request->web_color_style == 'app.theme.29')
            {
                $color_code = '#fcb842';
            }
            if($request->web_color_style == 'app.theme.30')
            {
                $color_code = '#66f';
            }
            if($request->web_color_style == 'app.theme.31')
            {
                $color_code = '#61ab00';
            }
            if($request->web_color_style == 'app.theme.32')
            {
                $color_code = '#fdda05';
            }
            if($request->web_color_style == 'app.theme.33')
            {
                $color_code = '#f05970';
            }
            if($request->web_color_style == 'app.theme.34')
            {
                $color_code = '#ffcc02';
            }
            
            



    
            DB::table('settings')->where('name', '=', 'web_color_style')->update([
                'value' => $request->web_color_style,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            DB::table('settings')->where('name', '=', 'web_color_code')->update([
                'value' => $color_code,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);

            $message = 'Color has been updated Successfully';
          //  return redirect()->back();
        }

        if ($request->page == 8) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'login' => $request->login_id,
                ]);

                $message = 'Login Page has been updated Successfully';
           // return redirect('login');
        }

        if ($request->page == 9) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'news' => $request->news_id,
                ]);
                $message = 'News Page has been updated Successfully';
           // return redirect('news');
        }
        
        if ($request->page == 10) {
            DB::table('current_theme')
                ->where('id', 1)
                ->update([
                    'transitions' => $request->transitions_id,
                ]);
                $message = 'Transitions setting  updated Successfully';
            //    return redirect('/');
        }

        if ($request->page == 11) {
            DB::table('settings')->where('name', '=', 'web_card_style')->update([
                'value' => $request->web_card_style,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            $message = 'Product Cart Style has been updated Successfully';
           // return redirect()->back();
        }
        if ($request->page == 12) {
            DB::table('settings')->where('name', '=', 'home_categories_img_icn')->update([
                'value' => $request->home_categories_img_icn,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            DB::table('settings')->where('name', '=', 'home_categories_records')->update([
                'value' => $request->home_categories_records,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            DB::table('settings')->where('name', '=', 'home_categories_records_mobile')->update([
                'value' => $request->home_categories_records_mobile,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            $message = 'Categories widget has been updated Successfully';
            //return redirect()->back();
        }

        if ($request->page == 13) {

            if($request->selectCategory == '139'){
                $home_category = array_filter($request->home_category);
                $home_category = implode(',',$home_category);
                DB::table('settings')->where('name', '=', 'home_category')->update([
                    'value' => $home_category,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);
            }

            if($request->selectCategory == '240'){
                $topsell_category = array_filter($request->topsell_category);
                $topsell_category = implode(',',$topsell_category);
                DB::table('settings')->where('name', '=', 'topsell_category')->update([
                    'value' => $topsell_category,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);
            }

            if($request->selectCategory == '241'){
                $newarrival_category = array_filter($request->newarrival_category);
                $newarrival_category = implode(',',$newarrival_category);
                DB::table('settings')->where('name', '=', 'newarrival_category')->update([
                    'value' => $newarrival_category,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);
            }

            if($request->selectCategory == '242'){
                $trending_category = array_filter($request->trending_category);
                $trending_category = implode(',',$trending_category);
                DB::table('settings')->where('name', '=', 'trending_category')->update([
                    'value' => $trending_category,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);
            }

            if($request->selectCategory == '243'){
                $special_category = array_filter($request->special_category);
                $special_category = implode(',',$special_category);
                DB::table('settings')->where('name', '=', 'special_category')->update([
                    'value' => $special_category,
                    'updated_at' => date('Y-m-d h:i:s'),
                ]);
            }

            $message = 'Category Section updated Successfully';
            
            //return redirect()->back();
        }

        if ($request->page == 14) {
            DB::table('settings')->where('name', '=', 'font')->update([
                'value' => $request->font,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            $message = 'Font Family updated Successfully';
          //  return redirect()->back();
        }

        if ($request->page == 15) {

            
            DB::table('settings')->where('name', '=', 'background_type')->update([
                'value' => $request->background_type,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
            DB::table('settings')->where('name', '=', 'background_color')->update([
                'value' => $request->back_theme_color,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);

            if( $request->website_logo !== null){
            $allimagesth = DB::table('images')
            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
            ->select('path', 'images.id', 'image_type')
            ->where('image_categories.image_type', 'ACTUAL')
            ->where('image_categories.image_id', $request->website_logo)
            ->first();
            $value = $allimagesth->path;

            DB::table('settings')->where('name', '=', 'background_image')->update([
                'value' => $value,
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        }
        $message = 'Background setting updated Successfully';

           // return redirect('login');
        }

        return redirect()->back()->with('message', $message);
    }

    public function reorder(Request $request)
    {
        $product_section_orders = json_encode($request->product_section_orders, true);
        DB::table('front_end_theme_content')
            ->where('id', 1)
            ->update([
                'product_section_order' => $product_section_orders,
            ]);
    }

    public function specialContent(Request $request)
    {
        //$product_section_orders = json_encode($request->product_section_orders, true);
        DB::table('theme_page_content')
            ->where('theme_cat_id', $request->input('id'))
            ->where('theme_cat_type','Special')
            ->update([
                'title' => $request->input('title'),
                'button_name' => $request->input('buttonName'),
                'title1' => $request->input('title1'),
                'description' => $request->input('description'),
            ]);
    }

    public function trendingContent(Request $request)
    {
        //$product_section_orders = json_encode($request->product_section_orders, true);
        DB::table('theme_page_content')
            ->where('theme_cat_id', $request->input('id'))
            ->where('theme_cat_type','Trending')
            ->update([
                'title' => $request->input('title'),
                'button_name' => $request->input('buttonName'),
                'title1' => $request->input('title1'),
                'description' => $request->input('description'),
            ]);
    }

    public function topContent(Request $request)
    {
        //$product_section_orders = json_encode($request->product_section_orders, true);
        DB::table('theme_page_content')
            ->where('theme_cat_id', $request->input('id'))
            ->where('theme_cat_type','Topsell')
            ->update([
                'title' => $request->input('title'),
                'button_name' => $request->input('buttonName'),
                'title1' => $request->input('title1'),
                'description' => $request->input('description'),
            ]);
    }

    public function newContent(Request $request)
    {
        //$product_section_orders = json_encode($request->product_section_orders, true);
        DB::table('theme_page_content')
            ->where('theme_cat_id', $request->input('id'))
            ->where('theme_cat_type','Newarrival')
            ->update([
                'title' => $request->input('title'),
                'button_name' => $request->input('buttonName'),
                'title1' => $request->input('title1'),
                'description' => $request->input('description'),
            ]);
    }

    public function changestatus(Request $request)
    {
        $json = $request->product_section_orders;
        foreach ($json as $key => $var) {
            if ($var['id'] == $request->id) {
                if ($var['status'] == 1) {
                    $json[$key]['status'] = 0;
                } else {
                    $json[$key]['status'] = 1;
                }
            }
        }
        $json1 = json_encode($json, true);
        DB::table('front_end_theme_content')
            ->where('id', 1)
            ->update([
                'product_section_order' => $json1,
            ]);
        return $json;
    }

    public function topoffer(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
        $allimage = $this->images->getimages();
         //get function from other controller
         $myVar = new Languages();
         $result['languages'] = $myVar->getter();


        $offers = DB::table('top_offers')
        ->leftJoin('image_categories', 'top_offers.type_value', '=', 'image_categories.image_id')
        ->select('top_offers.*', 'image_categories.path')
        ->first();
        $result['offers'] = $offers;


        $result['offer'] = $theme->topoffer();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.topoffer", $title)->with('allimage', $allimage)->with('result', $result);
    }

    public function updateTopOffer(Request $request)
    {
        $theme = new Theme();
        $result = $theme->updateTopOffer($request);
        $message = Lang::get("labels.Top offer has been updated successfully");
        return redirect()->back()->withErrors([$message]);

    }

    public function subscribeModal(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
         $myVar = new Languages();

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.subscribe_modal", $title)->with('result', $result);
    }

    public function updatesubscribeModal(Request $request)
    {
        $theme = new Theme();
     
        DB::table('settings')->where('name', '=', 'subscribe_modal')->update([
            'value' => $request->style,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        $message = "subscribe Modal has been updated successfully";
        return redirect()->back()->withErrors([$message]);

    }

    public function htmltemplate1(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
        $myVar = new Languages();

        $result['htmltemplate1'] = DB::table('settings')->where('name', '=', 'htmltemplate1')->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.html_template1", $title)->with('result', $result);
    }

    public function htmltemplate1Action(Request $request)
    {
        $theme = new Theme();
     
        DB::table('settings')->where('id', 244)->update([
            'value' => $request->htmltemplate1,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        $message = "HTML Content has been updated successfully";
        return redirect()->back()->withErrors([$message]);

    }


    public function htmltemplate2(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
        $myVar = new Languages();

        $result['htmltemplate2'] = DB::table('settings')->where('name', '=', 'htmltemplate2')->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.html_template2", $title)->with('result', $result);
    }

    public function htmltemplate2Action(Request $request)
    {
        $theme = new Theme();
     
        DB::table('settings')->where('id', 245)->update([
            'value' => $request->htmltemplate2,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        $message = "HTML Content has been updated successfully";
        return redirect()->back()->withErrors([$message]);

    }


    public function htmltemplate3(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
        $myVar = new Languages();

        $result['htmltemplate3'] = DB::table('settings')->where('name', '=', 'htmltemplate3')->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.html_template3", $title)->with('result', $result);
    }

    public function htmltemplate3Action(Request $request)
    {
        $theme = new Theme();
     
        DB::table('settings')->where('id', 246)->update([
            'value' => $request->htmltemplate3,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        $message = "HTML Content has been updated successfully";
        return redirect()->back()->withErrors([$message]);

    }


    public function htmltemplate4(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingTaxClasses"));

        $theme = new Theme();
        $myVar = new Languages();

        $result['htmltemplate4'] = DB::table('settings')->where('name', '=', 'htmltemplate4')->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.theme.html_template4", $title)->with('result', $result);
    }

    public function htmltemplate4Action(Request $request)
    {
        $theme = new Theme();
     
        DB::table('settings')->where('id', 247)->update([
            'value' => $request->htmltemplate4,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        $message = "HTML Content has been updated successfully";
        return redirect()->back()->withErrors([$message]);

    }



}
