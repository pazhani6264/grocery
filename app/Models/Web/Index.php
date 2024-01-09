<?php

namespace App\Models\Web;

use App;
use App\Models\Core\Categories;
use App\Models\Web\Cart;
use App\Models\Web\News;
use DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class Index extends Model
{
    public function slides($currentDate)
    {
        $slides = DB::table('sliders_images')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'sliders_mobile_image as mobileimage',
                'type',
                'sliders_title as title',
                'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
                'ImageTable.path as path',
                'ImageTable.path_type as image_path_type',
                'IconTable.path as iconpath',
                'IconTable.path_type as mobileimage_path_type'
            )
            ->where('status', '=', '1')
            ->where('ImageTable.image_type', '=', 'actual')
            ->where('IconTable.image_type', '=', 'actual')
            ->where('languages_id', '=', session('language_id'))
            ->orderBy('sliders_images.sliders_id', 'ASC')
            ->get();

           

         if (empty($slides) or count($slides) == 0) {

            $slides = DB::table('sliders_images')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'sliders_mobile_image as mobileimage',
                'type',
                'sliders_title as title',
                'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
                'ImageTable.path as path',
                'ImageTable.path_type as image_path_type',
                'IconTable.path as iconpath',
                'IconTable.path_type as mobileimage_path_type'
            )
                ->where('status', '=', '1')
                ->where('ImageTable.image_type', '=', 'THUMBNAIL')
                ->where('IconTable.image_type', '=', 'THUMBNAIL')
                ->where('languages_id', '=', 1)
                ->orderBy('sliders_images.sliders_id', 'ASC')
                ->get();
        }
 
        return $slides;
    }

    
    public function slidesByCarousel1($currentDate, $carousel_id)
    {
        $slides = DB::table('sliders_images')
        ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
        ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
      
        ->select('sliders_id as id',
            'sliders_title as title',
            'sliders_url as url',
            'sliders_image as image',
            'sliders_mobile_image as mobileimage',
            'type',
            'sliders_title as title',
            'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
            'ImageTable.path as path',
            'ImageTable.path_type as image_path_type',
            'IconTable.path as iconpath',
            'IconTable.path_type as mobileimage_path_type',
            
        )
       
            ->where('status', '=', '1')
            ->where('carousel_id', '=', $carousel_id)
            ->where('ImageTable.image_type', '=', 'actual')
            ->where('IconTable.image_type', '=', 'actual')
           
            ->whereDate('sliders_images.expires_date','>=',$currentDate)
            ->where('languages_id', '=', session('language_id'))
            ->orderBy('sliders_images.sliders_id', 'ASC')
            ->get();

          

        if (empty($slides) or count($slides) == 0) {
            $slides = DB::table('sliders_images')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
            
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'sliders_mobile_image as mobileimage',
                'type',
                'sliders_title as title',
                'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
                'ImageTable.path as path',
                'ImageTable.path_type as image_path_type',
                'IconTable.path as iconpath',
                'IconTable.path_type as mobileimage_path_type',
                
            )
                ->where('status', '=', '1')
                ->where('ImageTable.image_type', '=', 'THUMBNAIL')
                ->where('IconTable.image_type', '=', 'THUMBNAIL')
               
                ->where('carousel_id', '=', $carousel_id)
                ->whereDate('sliders_images.expires_date','>=',$currentDate)
                ->where('languages_id', '=', 1)
                ->orderBy('sliders_images.sliders_id', 'ASC')
                ->get();
        }
        return $slides;
    }

    public function slidesByCarousel($currentDate, $carousel_id)
    {
        $slides = DB::table('sliders_images')
        ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
        ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
        ->leftJoin('image_categories as tabTable','tabTable.image_id', '=', 'sliders_images.sliders_tab_image')
        ->select('sliders_id as id',
            'sliders_title as title',
            'sliders_url as url',
            'sliders_image as image',
            'sliders_mobile_image as mobileimage',
            'type',
            'sliders_title as title',
            'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
            'ImageTable.path as path',
            'ImageTable.path_type as image_path_type',
            'IconTable.path as iconpath',
            'IconTable.path_type as mobileimage_path_type',
            'tabTable.path as tabpath',
            'tabTable.path_type as tabpath_type'
        )
       
            ->where('status', '=', '1')
            ->where('carousel_id', '=', $carousel_id)
            ->where('ImageTable.image_type', '=', 'actual')
            ->where('IconTable.image_type', '=', 'actual')
            ->where('tabTable.image_type', '=', 'actual')
            ->whereDate('sliders_images.expires_date','>=',$currentDate)
            ->where('languages_id', '=', session('language_id'))
            ->orderBy('sliders_images.sliders_id', 'DESc')
            ->get();

          

        if (empty($slides) or count($slides) == 0) {
            $slides = DB::table('sliders_images')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'sliders_images.sliders_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'sliders_images.sliders_mobile_image')
            ->leftJoin('image_categories as tabTable','tabTable.image_id', '=', 'sliders_images.sliders_tab_image')
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'sliders_mobile_image as mobileimage',
                'type',
                'sliders_title as title',
                'title as con_title',
            'description as con_description',
            'description2 as con_description2',
            'name as con_name',
                'ImageTable.path as path',
                'ImageTable.path_type as image_path_type',
                'IconTable.path as iconpath',
                'IconTable.path_type as mobileimage_path_type',
                'tabTable.path as tabpath',
                'tabTable.path_type as tabpath_type'
            )
                ->where('status', '=', '1')
                ->where('ImageTable.image_type', '=', 'THUMBNAIL')
                ->where('IconTable.image_type', '=', 'THUMBNAIL')
                ->where('tabTable.image_type', '=', 'THUMBNAIL')
                ->where('carousel_id', '=', $carousel_id)
                ->whereDate('sliders_images.expires_date','>=',$currentDate)
                ->where('languages_id', '=', 1)
                ->orderBy('sliders_images.sliders_id', 'DESC')
                ->get();
        }
        return $slides;
    }
    public function compareCount()
    {
        $count = DB::table('compare')->where('customer_id', auth()->guard('customer')->user()->id)->count();
        return $count;
    }

    public function finalTheme()
    {
        $data = DB::table('current_theme')->first();
        return $data;
    }

    public function demofinalTheme()
    {
        $data = DB::table('demo_theme')->first();
        return $data;
    }


    public function color()
    {
        $data_color = DB::table('settings')->where('id',82)->first();
        return $data_color;
    }


    public function getbannersquery($type)
    {
        //home banners
        if($type == 1)
        {
            $homeBanners = DB::table('constant_banners')
                            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
                            ->select('constant_banners.*', 'image_categories.path', 'image_categories.image_type', 'image_categories.path_type as image_path_type',)
                            ->where('languages_id', session('language_id'))
                            ->where('image_type', 'ACTUAL')
                            ->groupBy('constant_banners.banners_id')
                            ->orderby('type', 'ASC')
                            ->get();
        }
        if($type == 2)
        {
            $homeBanners = DB::table('constant_banners_two as constant_banners')
                            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
                            ->select('constant_banners.*', 'image_categories.path', 'image_categories.image_type', 'image_categories.path_type as image_path_type',)
                            ->where('languages_id', session('language_id'))
                            ->where('image_type', 'ACTUAL')
                            ->groupBy('constant_banners.banners_id')
                            ->orderby('type', 'ASC')
                            ->get();
        }
        if($type == 3)
        {
            $homeBanners = DB::table('constant_banners_three as constant_banners')
                            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
                            ->select('constant_banners.*', 'image_categories.path', 'image_categories.image_type', 'image_categories.path_type as image_path_type',)
                            ->where('languages_id', session('language_id'))
                            ->where('image_type', 'ACTUAL')
                            ->groupBy('constant_banners.banners_id')
                            ->orderby('type', 'ASC')
                            ->get();
        }
        if($type == 4)
        {
            $homeBanners = DB::table('constant_banners_four as constant_banners')
                            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
                            ->select('constant_banners.*', 'image_categories.path', 'image_categories.image_type', 'image_categories.path_type as image_path_type',)
                            ->where('languages_id', session('language_id'))
                            ->where('image_type', 'ACTUAL')
                            ->groupBy('constant_banners.banners_id')
                            ->orderby('type', 'ASC')
                            ->get();
        }


        $result['homeBanners'] = $homeBanners;


      
        return $result;
    }

    public function commonContent()
    {
        $languages = DB::table('languages')
            ->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
            ->select('languages.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
            ->where('languages.is_default', '1')
            ->get();

        $currency = DB::table('currencies')
            ->where('is_default', 1)
            ->where('is_current', 1)
            ->first();

        if (empty(Session::get('currency_id'))) {
            session(['currency_id' => $currency->id]);
        }
        if (empty(Session::get('currency_title'))) {
            session(['currency_title' => $currency->code]);
        }
        if (empty(Session::get('symbol_right')) && empty(Session::get('symbol_left'))) {
            session(['symbol_right' => $currency->symbol_right]);
        }
        if (empty(Session::get('symbol_left')) && empty(Session::get('symbol_right'))) {
            session(['symbol_left' => $currency->symbol_left]);
        }
        if (empty(Session::get('currency_code'))) {
            session(['currency_code' => $currency->code]);
        }

        if (empty(Session::get('currency_value'))) {
            session(['currency_value' => $currency->value]);
        }

        if (empty(Session::get('language_id'))) {
            session(['language_id' => $languages[0]->languages_id]);
        }
        if (empty(Session::get('language_image'))) {
            session(['language_image' => $languages[0]->image_path]);
        }
        if (empty(Session::get('language_name'))) {
            session(['language_name' => $languages[0]->name]);
        }

        if (!Session::has('custom_locale')) {
            $locale = $languages[0]->code;
            session()->put('language_id', $languages[0]->languages_id);
            session()->put('direction', $languages[0]->direction);
            session()->put('locale', $languages[0]->code);
            session()->put('language_name', $languages[0]->name);
            session()->put('language_image', $languages[0]->image_path);
            App::setLocale($locale);
        }

        $result = array();
        $result['currency'] = $currency;
        $top_offers = DB::table('top_offers')
            ->leftJoin('image_categories', 'top_offers.type_value', '=', 'image_categories.image_id')
            ->select('top_offers.*', 'image_categories.path','image_categories.path_type as image_path_type',)
            ->where('top_offers.language_id', Session::get('language_id'))
            ->first();

        $result['top_offers'] = $top_offers;

        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', '=', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->groupBy('menus.id')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }

            $result["menus"] = $menus;
        } else {

            $result["menus"] = array();
        }

        $result["menusRecursive"] = $this->menusRecursive();
        $result["menusRecursiveFixed"] = $this->menusRecursiveFixed();
        $result["menusRecursiveMobiles"] = $this->menusRecursiveMobiles();
        $result["menusRecursiveMobile"] = $this->menusRecursiveMobile();
        $result["menusRecursiveMobile11"] = $this->menusRecursiveMobile11();
        
        $data = array();
        $categories = DB::table('news_categories')
            ->LeftJoin('news_categories_description', 'news_categories_description.categories_id', '=', 'news_categories.categories_id')
            ->select('news_categories.categories_id as id',
                'news_categories.categories_image as image',
                'news_categories.news_categories_slug as slug',
                'news_categories_description.categories_name as name'
            )
            ->where('news_categories_description.language_id', '=', Session::get('language_id'))->get();

        if (count($categories) > 0) {
            foreach ($categories as $categories_data) {
                $categories_id = $categories_data->id;
                $news = DB::table('news_categories')
                    ->LeftJoin('news_to_news_categories', 'news_to_news_categories.categories_id', '=', 'news_categories.categories_id')
                    ->LeftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
                    ->select('news_categories.categories_id', DB::raw('COUNT(DISTINCT news.news_id) as total_news'))
                    ->where('news_categories.categories_id', '=', $categories_id)
                    ->get();

                $categories_data->total_news = $news[0]->total_news;
                array_push($data, $categories_data);
            }
        }
        $result['newsCategories'] = $data;

        $myVar = new News();
        $data = array('page_number' => 0, 'type' => '', 'is_feature' => '1', 'limit' => 5, 'categories_id' => '', 'load_news' => 0);
        $featuredNews = $myVar->getAllNews($data);
        $result['featuredNews'] = $featuredNews;
        $data = array('type' => 'header');
        $cart = $this->cart($data);
        $result['cart'] = $cart;
        if (count($result['cart']) == 0) {
            session(['step' => '0']);
            session(['coupon' => array()]);
            session(['coupon_discount' => array()]);
            session(['billing_address' => array()]);
            session(['shipping_detail' => array()]);
            session(['payment_method' => array()]);
            session(['braintree_token' => array()]);
            session(['order_comments' => '']);
        }

        $result['setting'] = DB::table('settings')->orderby('id', 'ASC')->get();

        $settings = array();
        
        foreach($result['setting'] as $key=>$value){
          $settings[$value->name]=$value->value;
        }

        $result['settings'] = $settings;
        
        //home banners

        $homeBanners = DB::table('constant_banners')
            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
            ->select('constant_banners.*', 'image_categories.path', 'image_categories.image_type', 'image_categories.path_type as image_path_type',)
            ->where('languages_id', session('language_id'))
            ->where('image_type', 'ACTUAL')
            ->groupBy('constant_banners.banners_id')
            ->orderby('type', 'ASC')
            ->get();

        $result['homeBanners'] = $homeBanners;

        $result['pages'] = DB::table('pages')
            ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
            ->where([['type', '2'], ['status', '1'], ['pages_description.language_id', session('language_id')]])
            ->orderBy('pages_description.name', 'ASC')->get();

        //product categories
        $result['categories'] = $this->categories();
        $result['allcategories'] = $this->allcategories();

        $manufacturers = DB::table('manufacturers')
            ->leftJoin('manufacturers_info', 'manufacturers_info.manufacturers_id', 'manufacturers.manufacturers_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'manufacturers.manufacturer_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('manufacturers.*', 'manufacturers_info.*', 'image_categories.path as manufacturer_image', 'image_categories.path_type as image_path_type')
            ->get();

        $result['manufacturers'] = $manufacturers;

        //liked_products
        $total_wishlist = 0;
        if (!empty(session('customers_id'))) {
            $total_wishlist = DB::table('liked_products')
                ->leftjoin('products', 'products.products_id', '=', 'liked_products.liked_products_id')
                ->where('products_status', '1')
                ->where('liked_customers_id', '=', session('customers_id'))->count();
        }

        $result['total_wishlist'] = $total_wishlist;

        $homepagebanners = DB::table('home_banners')
            ->leftJoin('image_categories', 'home_banners.image', 'image_categories.image_id')
            ->select('home_banners.*', 'image_categories.path_type as image_path_type', 'image_categories.path as image_path')
            ->where('language_id', Session::get('language_id'))
            ->where('image_type', 'ACTUAL')
            ->orderby('banner_name', 'ASC')
            ->get();

        $result['homepagebanners'] = $homepagebanners;
        return $result;
    }

    private function allcategories()
    {
        $categories = DB::table('categories')
            ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->leftJoin('image_categories', 'categories.categories_image', '=', 'image_categories.image_id')
            ->select('categories.categories_id as id',
                'categories.categories_image as image',
                'categories.categories_icon as icon',
                'categories.sort_order as order',
                'categories.categories_slug as slug',
                'categories.parent_id',
                'categories_description.categories_name as name',
                'image_categories.path as path',
                'image_categories.path_type as image_path_type'
            )
            ->where('categories_description.language_id', '=', Session::get('language_id'))
            ->where('categories.categories_status', 1)
            ->groupBy('categories.categories_id')
            ->get();

        $result = array();
        $result['categories'] = $categories;
        $comma_categories = array();

        foreach ($categories as $category) {
            $comma_categories[] = $category->slug;
            $comma_categories[] = $category->name;
        }

        $result['comma_categories'] = implode(',', $comma_categories);
        return $categories;
    }

    private function categories()
    {

        $result = array();

        $categories = DB::table('categories')
            ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            //->leftJoin('image_categories', 'categories.categories_image', '=', 'image_categories.image_id')
            
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })

            ->select('categories.categories_id as id',
                'categories.categories_image as image',
                'categories.categories_icon as icon',
                'categories.sort_order as order',
                'categories.categories_slug as slug',
                'categories.parent_id',
                'categories_description.categories_name as name',
                'categoryTable.path as path',
                'iconTable.path as iconPath',
                'iconTable.path_type as image_path_type',
            )
            ->where('categories_description.language_id', '=', Session::get('language_id'))
            ->where('categories.categories_status', 1)
            ->where('parent_id', '0')
            ->groupBy('categories.categories_id')
            ->get();

        $index = 0;
        foreach ($categories as $categories_data) {

            //products_image
            $default_images = DB::table('image_categories')
                ->where('image_id', '=', $categories_data->image)
                ->where('image_type', 'MEDIUM')
                ->first();

            if ($default_images) {
                $categories_data->path = $default_images->path;
            } else {
                $default_images = DB::table('image_categories')
                    ->where('image_id', '=', $categories_data->image)
                    ->where('image_type', 'MEDIUM')
                    ->first();

                if ($default_images) {
                    $categories_data->path = $default_images->path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('image_id', '=', $categories_data->image)
                        ->where('image_type', 'ACTUAL')
                        ->first();
                    if ($default_images) {
                        $categories_data->path = $default_images->path;
                    } else {
                        $categories_data->path = '';
                    }
                }

            }

            $categories_id = $categories_data->id;

            $products = DB::table('categories')
                ->LeftJoin('categories as sub_categories', 'sub_categories.parent_id', '=', 'categories.categories_id')
                ->LeftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'sub_categories.categories_id')
                ->LeftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                ->select('categories.categories_id', DB::raw('COUNT(DISTINCT products.products_id) as total_products'))
                ->where('categories.categories_id', '=', $categories_id)
                ->where('categories.categories_status', 1)
                ->get();

            $categories_data->total_products = $products[0]->total_products;
            array_push($result, $categories_data);

            $sub_categories = DB::table('categories')
                ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                ->select('categories.categories_id as sub_id',
                    'categories.categories_image as sub_image',
                    'categories.categories_icon as sub_icon',
                    'categories.sort_order as sub_order',
                    'categories.categories_slug as sub_slug',
                    'categories.parent_id',
                    'categories_description.categories_name as sub_name'
                )
                ->where('categories_description.language_id', '=', Session::get('language_id'))
                ->where('parent_id', $categories_id)
                ->where('categories.categories_status', 1)
                ->get();

            $data = array();
            $index2 = 0;
            foreach ($sub_categories as $sub_categories_data) {
                $sub_categories_id = $sub_categories_data->sub_id;

                $individual_products = DB::table('products_to_categories')
                    ->LeftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                    ->select('products_to_categories.categories_id', DB::raw('COUNT(DISTINCT products.products_id) as total_products'))
                    ->where('products_to_categories.categories_id', '=', $sub_categories_id)
                    ->get();

                $sub_categories_data->total_products = $individual_products[0]->total_products;
                $data[$index2++] = $sub_categories_data;

            }

            $result[$index++]->sub_categories = $data;

        }
        return ($result);

    }

    public function cart($request)
    {

         if(!empty(session('table_qrcode'))){
            $session_id = session('table_qrcode');
        }else{
            $session_id = Session::getId();
        }

        //print_r($session_id);die();

        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('customers_basket.*', 'products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                'products_description.products_name as products_name', 'products.products_quantity as quantity',
                'products.products_price as price', 'products.products_weight as weight',
                'products.products_weight_unit as unit','products.products_slug','products.products_min_order','products.products_max_stock')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', Session::get('language_id'));

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', $session_id);
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->get();
        //print_r($baskit);die();
        $result = array();
        foreach ($baskit as $baskit_data) {
            //products_image
            $default_images = DB::table('image_categories')
                ->where('image_id', '=', $baskit_data->products_image)
                ->where('image_type', 'THUMBNAIL')
                ->first();

            if ($default_images) {
                $baskit_data->image = $default_images->path;
            } else {
                $default_images = DB::table('image_categories')
                    ->where('image_id', '=', $baskit_data->products_image)
                    ->where('image_type', 'MEDIUM')
                    ->first();

                if ($default_images) {
                    $baskit_data->image = $default_images->path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('image_id', '=', $baskit_data->products_image)
                        ->where('image_type', 'ACTUAL')
                        ->first();
                    $baskit_data->image = $default_images->path;
                }

            }
            array_push($result, $baskit_data);
        }

        return ($result);

    }

    public function menusRecursive()
    {

        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();

            $data = $this->finalTheme();
            $header_id = $data->header;

            $data = $this->color();
            $color_code = $data->value;


        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }

            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $div = 0;
                if($header_id == 1)
                {
                    $newArray = array_slice($menus, 0, 3, true);
                }
                else
                {
                    $newArray = array_slice($menus, 0, 4, true);
                }
               
                foreach ($newArray as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'dropdown-toggle';
                    } else {
                        $dropright = '';
                    }
                    
                    // if ($parents->type == 0) {
                    //     $link = ' target="_blank" href="' . $parents->link . '"';
                    // } elseif ($parents->type == 1) {
                    //     $link = ' href="' . url($parents->link) . '"';
                    // } elseif ($parents->type == 2) {
                    //     $link = ' href="' . url('page?name=') . $parents->link . '"';
                    // } elseif ($parents->type == 3) {
                    //     $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    // } elseif ($parents->type == 4) {
                    //     $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    // } elseif ($parents->type == 5) {
                    //     $link = ' href="' . url('') . $parents->link . '"';
                    // }else{
                    //     $link = '#';
                    // }


                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                        $menuactive = '';
                    } elseif ($parents->type == 1) {
                        if($parents->link == '/'){
                            $link = ' href="' . url(''). $parents->link . '"';
                            $menuactive = 'home';
                        }else{
                            $link = ' href="' . url(''). '/' .$parents->link . '"';
                            $menuactive = $parents->link;
                        }
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . '/' . $parents->link . '"';
                        $menuactive = $parents->link;
                    }else{
                        $link = '#';
                        $menuactive = '';
                    }

                    if($color_code =='app.theme.6' || $color_code =='app.theme.19')
                    {
                        if($header_id == 3 ||  $header_id == 7 || $header_id == 8 || $header_id == 9){
                            $header12black = 'header-12-balck';
                            $headerstyle = 'style="padding:0.6rem 0rem"';
                            $mActive = 'menu-actives-' . $menuactive;
                        }else{
                            $header12black = 'header-12-balck';
                            $headerstyle = 'style="padding:0.6rem 0rem"';
                            $mActive = 'menu-activess-' . $menuactive;
                        }
                    }
                    else
                    {
                        $header12black = '';
                        $headerstyle = '';
                        $mActive = 'menu-active-' . $menuactive;
                    }


                        $ul .= '<li ' . $headerstyle . ' class="nav-item dropdown ' . $mActive . '"><a class="nav-link ' . $header12black . ' ' . $dropright . '" ' . $link . ' >
                    ' . $parents->name . '
                    </a>';

                    if (isset($parents->childs)) {
                        $i = 1;
                        $ul .= '<div class="dropdown-menu dropdown-menu-new" >';
                        $ul .= $this->childMenu($parents->childs, $i, $parent_id, $div);
                        $ul .= '</div>';
                        $ul .= '</li>';
                    } else {
                        $ul .= '</li>';
                    }

                }


                if($header_id == 1)
                {
                    if(count($menus) > 3){

                    
                    
                        $ul .= '<li ' . $headerstyle . ' class="nav-item dropdown"><a href="#" class="nav-link ' . $header12black . ' dropdown-toggle">
                        More
                         </a><div class="dropdown-menu dropdown-menu-new" >';
    
                        foreach ($menus as $key=>$parents) {
                            if($key > 2){ 
    
    
    
                                if (isset($parents->childs)) {
                                    $dropright = 'dropdown-toggle';
                                } else {
                                    $dropright = '';
                                }
    
                                $ul .= '
                                <div class="dropdown-submenu submenu1">';
    
    
                                if ($parents->type == 0) {
                                    $link = ' target="_blank" href="' . $parents->link . '"';
                                    $menuactive = '';
                                } elseif ($parents->type == 1) {
                                    if($parents->link == '/'){
                                        $link = ' href="' . url(''). $parents->link . '"';
                                        $menuactive = 'home';
                                    }else{
                                        $link = ' href="' . url(''). '/' .$parents->link . '"';
                                        $menuactive = $parents->link;
                                    }
                                } elseif ($parents->type == 2) {
                                    $link = ' href="' . url('page?name=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 3) {
                                    $link = ' href="' . url('shop?category=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 4) {
                                    $link = ' href="' . url('product-detail') . '/'  . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 5) {
                                    $link = ' href="' . url('') . '/' . $parents->link . '"';
                                    $menuactive = $parents->link;
                                }else{
                                    $link = '#';
                                    $menuactive = '';
                                }
    
                                $ul .= '<a class="dropdown-item li-style nav-item dropdown-submenu submenu1"'  . $dropright . ' ' . $link  .' >
                                ' . $parents->name;
                                if($header_id == 1)
                                {
                                    if (isset($parents->childs)) {
                                        $ul .= '<span style="float:right"><i class="fas fa-chevron-left"></i>';
                                    }
                                }
                                else
                                {
                                    if (isset($parents->childs)) {
                                        $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                    }
                                }
                                $ul .='</a>';
            
                                /*     $ul .= '<li class="li-style nav-item dropdown-submenu submenu1  dropdown menu-active-' . $menuactive . '"><a style="color:black;" class="nav-link " ' . $link . ' >
                                ' . $parents->name . '
                                ';
    
                                if (isset($parents->childs)) {
                                    $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                }
                            $ul .='</a>'; */
            
                                if (isset($parents->childs)) {
                                    $i = 1;
                                    $ul .= '<div class="dropdown-menu dropdown-menu-new more-submenu" >';
                                    $ul .= $this->childMenumore($parents->childs, $i, $parent_id, $div);
                                    $ul .= '</div>';
                                    $ul .= '</div>';
                                } else {
                                    $ul .= '</div>';
                                }
    
                               
                            }
        
                        }
                        $ul .= '</div>';
                        $ul .= '</li>';
    
                    }
                }
                else
                {
                    if(count($menus) > 4){

                    
                    
                        $ul .= '<li ' . $headerstyle . ' class="nav-item dropdown"><a href="#" class="nav-link ' . $header12black . ' dropdown-toggle">
                        More
                         </a><div class="dropdown-menu dropdown-menu-new" >';
    
                        foreach ($menus as $key=>$parents) {
                            if($key > 3){ 
    
    
    
                                if (isset($parents->childs)) {
                                    $dropright = 'dropdown-toggle';
                                } else {
                                    $dropright = '';
                                }
    
                                $ul .= '
                                <div class="dropdown-submenu submenu1">';
    
    
                                if ($parents->type == 0) {
                                    $link = ' target="_blank" href="' . $parents->link . '"';
                                    $menuactive = '';
                                } elseif ($parents->type == 1) {
                                    if($parents->link == '/'){
                                        $link = ' href="' . url(''). $parents->link . '"';
                                        $menuactive = 'home';
                                    }else{
                                        $link = ' href="' . url(''). '/' .$parents->link . '"';
                                        $menuactive = $parents->link;
                                    }
                                } elseif ($parents->type == 2) {
                                    $link = ' href="' . url('page?name=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 3) {
                                    $link = ' href="' . url('shop?category=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 4) {
                                    $link = ' href="' . url('product-detail') . '/'  . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 5) {
                                    $link = ' href="' . url('') . '/' . $parents->link . '"';
                                    $menuactive = $parents->link;
                                }else{
                                    $link = '#';
                                    $menuactive = '';
                                }
    
                                $ul .= '<a class="dropdown-item li-style nav-item dropdown-submenu submenu1"'  . $dropright . ' ' . $link  .' >
                                ' . $parents->name;
                                    if (isset($parents->childs)) {
                                        $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                    }
                                $ul .='</a>';
            
                                /*     $ul .= '<li class="li-style nav-item dropdown-submenu submenu1  dropdown menu-active-' . $menuactive . '"><a style="color:black;" class="nav-link " ' . $link . ' >
                                ' . $parents->name . '
                                ';
    
                                if (isset($parents->childs)) {
                                    $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                }
                            $ul .='</a>'; */
            
                                if (isset($parents->childs)) {
                                    $i = 1;
                                    $ul .= '<div class="dropdown-menu dropdown-menu-new more-submenu" >';
                                    $ul .= $this->childMenumore($parents->childs, $i, $parent_id, $div);
                                    $ul .= '</div>';
                                    $ul .= '</div>';
                                } else {
                                    $ul .= '</div>';
                                }
    
                               
                            }
        
                        }
                        $ul .= '</div>';
                        $ul .= '</li>';
    
                    }
                }

               
        
               
            }

            return $ul;
        }

    }



    public function menusRecursiveFixed()
    {

        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();

            $data = $this->finalTheme();
            $header_id = $data->header;

           


        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }

            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $div = 0;
                if($header_id == 1)
                {
                    $newArray = array_slice($menus, 0, 3, true);
                }
                else
                {
                    $newArray = array_slice($menus, 0, 4, true);
                }
               
                foreach ($newArray as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'dropdown-toggle';
                    } else {
                        $dropright = '';
                    }
                    
                    // if ($parents->type == 0) {
                    //     $link = ' target="_blank" href="' . $parents->link . '"';
                    // } elseif ($parents->type == 1) {
                    //     $link = ' href="' . url($parents->link) . '"';
                    // } elseif ($parents->type == 2) {
                    //     $link = ' href="' . url('page?name=') . $parents->link . '"';
                    // } elseif ($parents->type == 3) {
                    //     $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    // } elseif ($parents->type == 4) {
                    //     $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    // } elseif ($parents->type == 5) {
                    //     $link = ' href="' . url('') . $parents->link . '"';
                    // }else{
                    //     $link = '#';
                    // }


                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                        $menuactive = '';
                    } elseif ($parents->type == 1) {
                        if($parents->link == '/'){
                            $link = ' href="' . url(''). $parents->link . '"';
                            $menuactive = 'home';
                        }else{
                            $link = ' href="' . url(''). '/' .$parents->link . '"';
                            $menuactive = $parents->link;
                        }
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                        $menuactive = $parents->link;
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . '/' . $parents->link . '"';
                        $menuactive = $parents->link;
                    }else{
                        $link = '#';
                        $menuactive = '';
                    }

                        $ul .= '<li style="padding:0.6rem 0rem" class="nav-item dropdown menu-active-' . $menuactive . '"><a class="nav-link header-12-balck ' . $dropright . '" ' . $link . ' >
                    ' . $parents->name . '
                    </a>';

                    if (isset($parents->childs)) {
                        $i = 1;
                        $ul .= '<div class="dropdown-menu " >';
                        $ul .= $this->childMenu($parents->childs, $i, $parent_id, $div);
                        $ul .= '</div>';
                        $ul .= '</li>';
                    } else {
                        $ul .= '</li>';
                    }

                }


                if($header_id == 1)
                {
                    if(count($menus) > 3){

                    
                    
                        $ul .= '<li style="padding:0.6rem 0rem" class="nav-item dropdown"><a href="#" class="nav-link header-12-balck dropdown-toggle">
                        More
                         </a><div class="dropdown-menu" >';
    
                        foreach ($menus as $key=>$parents) {
                            if($key > 2){ 
    
    
    
                                if (isset($parents->childs)) {
                                    $dropright = 'dropdown-toggle';
                                } else {
                                    $dropright = '';
                                }
    
                                $ul .= '
                                <div class="dropdown-submenu submenu1">';
    
    
                                if ($parents->type == 0) {
                                    $link = ' target="_blank" href="' . $parents->link . '"';
                                    $menuactive = '';
                                } elseif ($parents->type == 1) {
                                    if($parents->link == '/'){
                                        $link = ' href="' . url(''). $parents->link . '"';
                                        $menuactive = 'home';
                                    }else{
                                        $link = ' href="' . url(''). '/' .$parents->link . '"';
                                        $menuactive = $parents->link;
                                    }
                                } elseif ($parents->type == 2) {
                                    $link = ' href="' . url('page?name=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 3) {
                                    $link = ' href="' . url('shop?category=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 4) {
                                    $link = ' href="' . url('product-detail') . '/'  . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 5) {
                                    $link = ' href="' . url('') . '/' . $parents->link . '"';
                                    $menuactive = $parents->link;
                                }else{
                                    $link = '#';
                                    $menuactive = '';
                                }
    
                                $ul .= '<a class="dropdown-item li-style nav-item dropdown-submenu submenu1"'  . $dropright . ' ' . $link  .' >
                                ' . $parents->name;
                                    if (isset($parents->childs)) {
                                        $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                    }
                                $ul .='</a>';
            
                                /*     $ul .= '<li class="li-style nav-item dropdown-submenu submenu1  dropdown menu-active-' . $menuactive . '"><a style="color:black;" class="nav-link " ' . $link . ' >
                                ' . $parents->name . '
                                ';
    
                                if (isset($parents->childs)) {
                                    $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                }
                            $ul .='</a>'; */
            
                                if (isset($parents->childs)) {
                                    $i = 1;
                                    $ul .= '<div class="dropdown-menu dropdown-menu-new more-submenu" >';
                                    $ul .= $this->childMenumore($parents->childs, $i, $parent_id, $div);
                                    $ul .= '</div>';
                                    $ul .= '</div>';
                                } else {
                                    $ul .= '</div>';
                                }
    
                               
                            }
        
                        }
                        $ul .= '</div>';
                        $ul .= '</li>';
    
                    }
                }
                else
                {
                    if(count($menus) > 4){

                    
                    
                        $ul .= '<li style="padding:0.6rem 0rem" class="nav-item dropdown"><a href="#" class="nav-link header-12-balck dropdown-toggle">
                        More
                         </a><div class="dropdown-menu" >';
    
                        foreach ($menus as $key=>$parents) {
                            if($key > 3){ 
    
    
    
                                if (isset($parents->childs)) {
                                    $dropright = 'dropdown-toggle';
                                } else {
                                    $dropright = '';
                                }
    
                                $ul .= '
                                <div class="dropdown-submenu submenu1">';
    
    
                                if ($parents->type == 0) {
                                    $link = ' target="_blank" href="' . $parents->link . '"';
                                    $menuactive = '';
                                } elseif ($parents->type == 1) {
                                    if($parents->link == '/'){
                                        $link = ' href="' . url(''). $parents->link . '"';
                                        $menuactive = 'home';
                                    }else{
                                        $link = ' href="' . url(''). '/' .$parents->link . '"';
                                        $menuactive = $parents->link;
                                    }
                                } elseif ($parents->type == 2) {
                                    $link = ' href="' . url('page?name=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 3) {
                                    $link = ' href="' . url('shop?category=') . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 4) {
                                    $link = ' href="' . url('product-detail') . '/'  . $parents->link . '"';
                                    $menuactive = $parents->link;
                                } elseif ($parents->type == 5) {
                                    $link = ' href="' . url('') . '/' . $parents->link . '"';
                                    $menuactive = $parents->link;
                                }else{
                                    $link = '#';
                                    $menuactive = '';
                                }
    
                                $ul .= '<a class="dropdown-item li-style nav-item dropdown-submenu submenu1"'  . $dropright . ' ' . $link  .' >
                                ' . $parents->name;
                                    if (isset($parents->childs)) {
                                        $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                    }
                                $ul .='</a>';
            
                                /*     $ul .= '<li class="li-style nav-item dropdown-submenu submenu1  dropdown menu-active-' . $menuactive . '"><a style="color:black;" class="nav-link " ' . $link . ' >
                                ' . $parents->name . '
                                ';
    
                                if (isset($parents->childs)) {
                                    $ul .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                                }
                            $ul .='</a>'; */
            
                                if (isset($parents->childs)) {
                                    $i = 1;
                                    $ul .= '<div class="dropdown-menu dropdown-menu-new more-submenu" >';
                                    $ul .= $this->childMenumore($parents->childs, $i, $parent_id, $div);
                                    $ul .= '</div>';
                                    $ul .= '</div>';
                                } else {
                                    $ul .= '</div>';
                                }
    
                               
                            }
        
                        }
                        $ul .= '</div>';
                        $ul .= '</li>';
    
                    }
                }

               
        
               
            }

            return $ul;
        }

    }

    

    private function childMenu($childs, $i, $parent_id, $div)
    {
        $contents = '';
        foreach ($childs as $key => $child) {
            
            if (isset($child->childs)) {
                $dropright = 'dropdown-toggle';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . url($child->link) . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail') . '/' . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }

          
            $contents .= '<a class="li-style dropdown-item"'  . $dropright . ' ' . $link  .' >
            ' . $child->name;
                if (isset($child->childs)) {
                    $contents .= '<span style="float:right"><i class="fas fa-chevron-right"></i>';
                }
            $contents .='</a>';

            if (isset($child->childs)) {
                $contents .= '
                <div class="dropdown-menu dropdown-menu-new">';
                // $contents .= '
                // <div class="dropdown-submenu submenu1">';

                $k = $i + 1;
                $contents .= $this->childMenu($child->childs, $k, $parent_id, 1);
                $contents .= '</div></div>';
            } elseif ($i > 0) {
                $contents .= '</div>';
            }

        }
        return $contents;
    }

    private function childMenumore($childs, $i, $parent_id, $div)
    {
        $contents = '';
        foreach ($childs as $key => $child) {
            
            if (isset($child->childs)) {
                $dropright = 'dropdown-toggle';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . url($child->link) . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail') . '/' . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }

          
            $contents .= '<a class="li-style dropdown-item"'  . $dropright . ' ' . $link  .' >
            ' . $child->name;
               
            $contents .='</a>';

           if ($i > 0) {
                $contents .= '</div>';
            }

        }
        return $contents;
    }


    public function menusRecursiveMobiles(){
        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }
            
            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $i = 1;
                $newArray = $menus;
                foreach ($newArray as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
                    } else {
                        $dropright = '';
                    }
                    
                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                        $menuactive = '';
                    } elseif ($parents->type == 1) {
                        if($parents->link == '/'){
                            $link = ' href="' . url(''). $parents->link . '"';
                        }else{
                            $link = ' href="' . url(''). '/' .$parents->link . '"';
                        }
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . '/' . $parents->link . '"';
                    }else{
                        $link = '#';
                    }

                    $ul .= '<div class="main-manu btn"><a class=""' . $link  .' ><span>'.$parents->name.'</span></a>';
                    if (isset($parents->childs)) {
                        $ul .= '<span data-toggle="collapse" href="#shoppagesold'.$i.'" role="button" aria-expanded="false" aria-controls="shoppagesold'.$i.'"> <span><i class="fas fa-chevron-down"></i></span>
                            <span><i class="fas fa-chevron-up"></i></span></span>';
                    }
                    $ul .='</div>';

                   

                    if (isset($parents->childs)) {
                        $ul .= '<div class="sub-manu collapse multi-collapse" id="shoppagesold'.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $ul .= $this->childMenuMobiles($parents->childs, $i);
                        $ul .= '</li></ul>
                        </div>';
                        $i++;
                    } 

                }
               
            }

            return $ul;
        }
    }

    private function childMenuMobiles($childs, $i)
    {
        $contents = '';
        foreach ($childs as $key => $child) {

            if (isset($child->childs)) {
                $i++;
                $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . $child->link . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail/') . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }
            $contents .= '<div class="main-manu btn"><a class=""' . $link  .' ><span>'.$child->name.'</span></a>';
                if (isset($child->childs)) {
                    $contents .= '<span  data-toggle="collapse" href="#shoppagesoldchild'.$child->id.''.$i.'" role="button" aria-expanded="false" aria-controls="shoppagesoldchild'.$i.'"><i class="fas fa-chevron-down"></i></span>
                    <span><i class="fas fa-chevron-up"></i></span></span>';
                }
            $contents .='</div>';

            if (isset($child->childs)) {

                $contents .= '<div class="sub-manu collapse multi-collapse" id="shoppagesoldchild'.$child->id.''.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $contents .= $this->childMenuMobiles($child->childs, $i);
                        $contents .= '</li></ul>
                        </div>';
            } 

        }
        return $contents;
    }



    public function menusRecursiveMobile(){
        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }
            
            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $i = 1;
                $newArray = $menus;
                foreach ($newArray as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
                    } else {
                        $dropright = '';
                    }
                    
                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                        $menuactive = '';
                    } elseif ($parents->type == 1) {
                        if($parents->link == '/'){
                            $link = ' href="' . url(''). $parents->link . '"';
                        }else{
                            $link = ' href="' . url(''). '/' .$parents->link . '"';
                        }
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . '/' . $parents->link . '"';
                    }else{
                        $link = '#';
                    }

                    $ul .= '<div  style="margin-right: 0px !important;border-bottom: .1rem solid hsla(0,0%,100%,.08) !important;"><a class=""' . $link  .' ><div class="main-manu cate-12-bottom-border btn" style="width: 85% !important;border:none !important"><span>'.$parents->name.'</span></div></a>';
                    if (isset($parents->childs)) {
                        $ul .= '<span style="padding: 12px !important;" data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"><i class="fas fa-chevron-down"></i></span>';
                    }
                    $ul .='</div>';
                    

                    if (isset($parents->childs)) {
                        $ul .= '<div class="sub-manu collapse multi-collapse" id="shoppages'.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $ul .= $this->childMenuMobile($parents->childs, $i);
                        $ul .= '</li></ul>
                        </div>';
                        $i++;
                    } 

                }
               
            }

            return $ul;
        }
    }

    private function childMenuMobile($childs, $i)
    {
        $contents = '';
        foreach ($childs as $key => $child) {

            if (isset($child->childs)) {
                $i++;
                $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . $child->link . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail/') . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }
            $contents .= '<div  style="margin-right: 0px !important;border-bottom: .1rem solid hsla(0,0%,100%,.08) !important;"><a class=""' . $link  .' ><div class="main-manu cate-12-bottom-border btn" style="width: 81% !important;border:none !important"><span>'.$child->name.'</span></div></a>';
                if (isset($child->childs)) {
                    $contents .= '<span style="padding: 12px !important;" data-toggle="collapse" href="#shoppagesall'.$child->id.''.$i.'" role="button" aria-expanded="false" aria-controls="shoppagesall'.$i.'"><i class="fas fa-chevron-down"></i></span>';
                }
            $contents .='</div>';

        
            if (isset($child->childs)) {

                $contents .= '<div class="sub-manu collapse multi-collapse" id="shoppagesall'.$child->id.''.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $contents .= $this->childMenuMobile($child->childs, $i);
                        $contents .= '</li></ul>
                        </div>';
            } 

        }
        return $contents;
    }

    public function menusRecursiveMobile11(){
        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }
            
            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $i = 1;
                $newArray = $menus;
                foreach ($newArray as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
                    } else {
                        $dropright = '';
                    }
                    
                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                        $menuactive = '';
                    } elseif ($parents->type == 1) {
                        if($parents->link == '/'){
                            $link = ' href="' . url(''). $parents->link . '"';
                        }else{
                            $link = ' href="' . url(''). '/' .$parents->link . '"';
                        }
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . '/' . $parents->link . '"';
                    }else{
                        $link = '#';
                    }

                    $ul .= '<div  style="margin-right: 0px !important;border-bottom: .1rem solid hsla(0,0%,100%,.08) !important;border-bottom-color: #efefef !important;"><a class=""' . $link  .' ><div class="main-manu-11 btn cate-11-bottom-border" style="width: 85% !important;border:none !important"><span>'.$parents->name.'</span></div></a>';
                    if (isset($parents->childs)) {
                        $ul .= '<span style="padding: 12px !important;" data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"><i class="fas fa-chevron-down"></i></span>';
                    }
                    $ul .='</div>';
                    

                    if (isset($parents->childs)) {
                        $ul .= '<div class="sub-manu collapse multi-collapse" id="shoppages'.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $ul .= $this->childMenuMobile11($parents->childs, $i);
                        $ul .= '</li></ul>
                        </div>';
                        $i++;
                    } 

                }
               
            }

            return $ul;
        }
    }

    private function childMenuMobile11($childs, $i)
    {
        $contents = '';
        foreach ($childs as $key => $child) {

            if (isset($child->childs)) {
                $i++;
                $dropright = 'data-toggle="collapse" href="#shoppagesq'.$i.'" role="button" aria-expanded="false" aria-controls="shoppagesq'.$i.'"';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . $child->link . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail/') . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }
            $contents .= '<div  style="margin-right: 0px !important;border-bottom: .1rem solid hsla(0,0%,100%,.08) !important;border-bottom-color: #efefef !important;"><a class=""' . $link  .' ><div class="main-manu-11 btn btn cate-11-bottom-border" style="width: 81% !important;border:none !important"><span>'.$child->name.'</span></div></a>';
                if (isset($child->childs)) {
                    $contents .= '<span style="padding: 12px !important;" data-toggle="collapse" href="#shoppagesq'.$child->id.''.$i.'" role="button" aria-expanded="false" aria-controls="shoppagesq'.$i.'"><i class="fas fa-chevron-down"></i></span>';
                }
            $contents .='</div>';

        
            if (isset($child->childs)) {

                $contents .= '<div class="sub-manu collapse multi-collapse" id="shoppagesq'.$child->id.''.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $contents .= $this->childMenuMobile11($child->childs, $i);
                        $contents .= '</li></ul>
                        </div>';
            } 

        }
        return $contents;
    }

    public function mailMailGun($subject,$domain,$api_key,$from,$to,$bcc,$html)
     {
            $subject = $subject;
            $MailData            = array();
            $api_key             = $api_key;
            $domain              = $domain;
            $MailData['from']    = $from;
            $MailData['to']      = $to;
            $MailData['bcc']     = $bcc;
            $MailData['subject'] = $subject;
            $MailData['html'] = $html;
    
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
     }

     public function shoppinginfo(){
        $shoppinginfo = DB::table('shopping_info')
        ->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id','=','shopping_info.shopping_info_id')
        ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'shopping_info.shopping_info_icon')
        ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'shopping_info.shopping_info_icon')
        ->select('shopping_info.*',
            'shopping_info_description.*',
            'ImageTable.path as path',
            'ImageTable.path_type as image_path_type',
            'IconTable.path as iconpath',
        )
        ->where('shopping_info_description.language_id',Session::get('language_id'))
        ->groupBY('shopping_info.shopping_info_id')
        ->get();
        return $shoppinginfo;
      }

      public function getResEncryption($data)
    {
        $pkey='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCAm+OIBsriBMcGrXRlkHcMO0syEkeiCckaYYdJyHFYr8fq/Ygh+01Y1YIZygcD8gfP6938dgNiwnwilPhqj2h5FiEZnmQDk3Yt3mR87td0h6tEieZNHr9KETpad/zqmLr/ZFLk374Fi6ld1sCRnsuSpK/LQbV89DVbrcDrXK7i1QIDAQAB
-----END PUBLIC KEY-----';
        $pubKey = openssl_pkey_get_public($pkey);
        $data=$data;
        openssl_public_encrypt($data, $encrypted, $pubKey);
        return base64_encode($encrypted);
    }
    
}
