<?php
namespace App\Http\Controllers\Web;

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

class ProductsController extends Controller
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

    public function reviews(Request $request)
    {
      
        $result['commonContent'] = $this->index->commonContent();

        if($result['commonContent']['settings']['Review']=='1'){
            $instatus='-1';
            $read='0';
        }else{
            $instatus='1';
            $read='1';
        }

        if (Auth::guard('customer')->check()) {
            $check = DB::table('reviews')
                ->where('customers_id', Auth::guard('customer')->user()->id)
                ->where('products_id', $request->products_id)
                ->first();

            if ($check) {
                return 'already_commented';
            }
            $name = Auth::guard('customer')->user()->first_name;
            if($request->name !='')
            {
                $name = $request->name;
            }
            else
            {
                $name = Auth::guard('customer')->user()->first_name;
            }
            $url='';
            if($request->url !='')
            {
                $url = $request->url;
            }
            $id = DB::table('reviews')->insertGetId([
                'products_id' => $request->products_id,
                'products_name' => $request->products_name,
                'reviews_rating' => $request->rating,
                'reviews_title' => $request->reviews_text,
                'customers_id' => Auth::guard('customer')->user()->id,
                'customers_name' => $name,
                'customers_email' => $request->email,
                'reviews_status'=> $instatus,
                'reviews_read'=>$read,
                'url'=>$url,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
           /*  if($request->pictures->getclientoriginalextension() !='')
            {
                $fileName = time() . '.' . $request->pictures->getclientoriginalextension();
                $request->pictures->getclientoriginalextension();
                $request->pictures->move('images/reviews_photo/' , $fileName);
                $pictures = 'images/reviews_photo/'.$fileName ;
                DB::table('reviews')->where('reviews_id ',$id)->update([
                    'image' => $pictures,
                ]);
            }
            if($request->video->getclientoriginalextension() !='')
            {
                $fileName = time() . '.' . $request->video->getclientoriginalextension();
                $request->video->getclientoriginalextension();
                $request->video->move('images/reviews_video/' , $fileName);
                $video = 'images/reviews_video/'.$fileName ;
                DB::table('reviews')->where('reviews_id ',$id)->update([
                    'video' => $video,
                ]);
            }
         */
          
            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => Session::get('language_id'),
                    'reviews_text' => $request->reviews_text,
                ]);
            return 'done';
        } else {
            return 'not_login';

        }
    }


    public function deliveryreviews(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();

      
            $instatus='1';
            $read='1';
       

        if (Auth::guard('customer')->check()) {
            $check = DB::table('reviews')
                ->where('customers_id', Auth::guard('customer')->user()->id)
                ->where('orders_id', $request->products_id)
                ->first();

            if ($check) {
                return 'already_commented';
            }
            $id = DB::table('reviews')->insertGetId([
                'orders_id' => $request->products_id,
                'deliveryboy_id' => $request->deliveryboy_id,
                'reviews_rating' => $request->rating,
                'customers_id' => Auth::guard('customer')->user()->id,
                'customers_name' => Auth::guard('customer')->user()->first_name,
                'reviews_status'=> $instatus,
                'reviews_read'=>$read,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => Session::get('language_id'),
                    'reviews_text' => $request->reviews_text,
                ]);
            return 'done';
        } else {
            return 'not_login';

        }
    }
    //productbrand
    public function productbrand(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.brand'));
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
      

        return view("web.productbrand", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }


    //shop
    public function shop(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Shop'));
        $result = array();

        $result['commonContent'] = $this->index->commonContent();
      
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $this->products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['categories_status'] = $categories_status;

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode(',',$options);
            $filters['option_value'] = implode(',',$option_values);

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        }

        $brand = '';

        if(isset($request->brand)){
            $brand = $request->brand;
        }
        $data1111 = array('check' => 1,'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'brand' => $brand);

            

        /* $products = $this->products->products_check($data1111);         */
        $products = $this->products->products_paginate($data1111);        
        $result['products'] = $products;
       //print_r($result['products']);die();

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $this->filters($data);
        $result['filters'] = $filters;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        if ($limit > $result['products']['total_record']) {
            $result['limit'] = $result['products']['total_record'];
        } else {
            $result['limit'] = $limit;
        }

       

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        $result['categories'] = $this->products->categories();

        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;

       
       
        $final_theme = $this->theme->theme();

       // print_r('ok');die();

        return view("web.shop", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }

    public function filterProducts(Request $request)
    {

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
          
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        

        //if(!empty($request->category_id)){
        if (!empty($request->category) and $request->category != 'all') {
            $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories_slug', $request->category)->where('language_id', Session::get('language_id'))->get();

            $categories_id = $category[0]->categories_id;
        } else {
            $categories_id = '';
        }

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

       

       

        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $filters['options_count'] = count($request->options_value);
            $filters['options'] = $request->options;
            $filters['option_value'] = $request->options_value;
        } else {
            $filters = array();
        }

       

        $data = array('page_number' => $request->page_number, 'type' => $type, 'limit' => $limit, 'categories_id' => $categories_id, 'search' => $search, 'filters' => $filters, 'min_price' => $min_price, 'max_price' => $max_price);
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        $result['commonContent'] = $this->index->commonContent();
        return view("web.filterproducts")->with('result', $result);

    }

    public function ModalShow(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal1")->with('result', $result);
    }

    
    public function ModalShow5(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal5")->with('result', $result);
    }



    public function ModalShow2(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal2")->with('result', $result);
    }


    public function quickModalShow3(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal3")->with('result', $result);
    }

   

    //access object for custom pagination
    public function accessObjectArray($var)
    {
        return $var;
    }

     //productDetail
     public function productDetail(Request $request)
     {
        $product_check  = DB::table('products')->where('products_slug',$request->slug)->first();

        if($product_check !='')
        {
            $proData  = DB::table('products_description')->where('products_id',$product_check->products_id)->where('language_id',session('language_id'))->first();
            
            DB::table('products_description')->where('products_id',$product_check->products_id)->update([
                'products_viewed' => $proData->products_viewed + 1,
            ]);

 
         $title = array('pageTitle' => Lang::get('website.Product Detail'));
         $result = array();
         $result['commonContent'] = $this->index->commonContent();
         $result['shoppinginfo'] = $this->index->shoppinginfo();
         $final_theme = $this->theme->theme();
         //min_price
         if (!empty($request->min_price)) {
             $min_price = $request->min_price;
         } else {
             $min_price = '';
         }
 
         //max_price
         if (!empty($request->max_price)) {
             $max_price = $request->max_price;
         } else {
             $max_price = '';
         }
 
         if (!empty($request->limit)) {
             $limit = $request->limit;
         } else {
             $limit = 15;
         }
 
         $products = $this->products->getProductsBySlug($request->slug);
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
 
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
 
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
             $isFlash = $this->products->getFlashSale($products[0]->products_id);
 
             if (!empty($isFlash) and count($isFlash) > 0) {
                 $type = "flashsale";
             } else {
                 $type = "";
             }
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;
             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $simliar_products = $this->products->products($data);
             $result['simliar_products'] = $simliar_products;
 
             $cart = '';
             $result['cartArray'] = $this->products->cartIdArray($cart);
 
             //liked products
             $result['liked_products'] = $this->products->likedProducts();
 
             $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $top_seller = $this->products->products($data);
             $result['top_seller'] = $top_seller;		
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }
         
         $currency_symbol = session('symbol_left') ? session('symbol_left') : session('symbol_right') ;
         $currency  = DB::table('currencies')->where('symbol_left',$currency_symbol)->orwhere('symbol_right',$currency_symbol)->first();
         $result['currency_value'] = $currency ? $currency->value : 1;
        //  dd($result['currency_value']);
         return view("web.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
        else
        {
            return view("web.404");
        }
     }

    //filters
    public function filters($data)
    {
        $response = $this->products->filters($data);
        return ($response);
    }

    //getquantity
    public function getquantity(Request $request)
    {
        $data = array();
        $data['products_id'] = $request->products_id;
        $data['attributes'] = $request->attributeid;

        $result = $this->products->productQuantity($data);
        print_r(json_encode($result));
    }

    public function autocomplete(Request $request)
    {
        //$data = Post::select("title as name","image as img","body as desc")->where("title","LIKE","%{$request->input('query')}%")->get();
        $currentDate = time();
        $nonflashsale = DB::table('flash_sale')->where('flash_sale.flash_status', '=', '1')->pluck('products_id');
     
        if($request->cat != '')
        {
        $category = DB::table('categories')->where('categories_slug', $request->cat)->where('categories_status', 1)->first();
        $cat_id = $category->categories_id; 
        $data = DB::table('products')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
             ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
             ->leftJoin('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->select('products_description.products_name as name', 'products.products_slug as slug', 'image_categories.path as img', 'image_categories.path_type as image_path_type', 'products_description.products_description as desc','products_to_categories.categories_id')
            ->where('products_description.products_name', 'LIKE', '%' . $request->search . '%')
            ->where('products_to_categories.categories_id',$cat_id)
            ->whereNotIn('products.products_id', $nonflashsale)
            ->groupBy('products.products_id')
            ->get();
        }
        else
        {
           

            $data = DB::table('products')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
            ->leftJoin('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
             ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->select('products_description.products_name as name', 'products.products_slug as slug', 'image_categories.path as img', 'image_categories.path_type as image_path_type', 'products_description.products_description as desc')
            ->where('products_description.products_name', 'LIKE', '%' . $request->search . '%')
            ->whereNotIn('products.products_id', $nonflashsale)
            ->where('categories.categories_status', 1)
            ->whereIn('product_view', [0, 1])
            ->groupBy('products.products_id')
            ->get();
          
           
        }
           
      
        echo json_encode($data);
    }
  
    public function askAQuestion(Request $request){
        if (auth()->guard('customer')->check()) {
        $user_id = auth()->guard('customer')->user()->id;
        }
        else
        {
            $user_id = 0;
        }
        $question_name = $request->question_name;
        $question_email = $request->question_email;
        $question = $request->question_content;
        $products_id = $request->question_products_id;
        $products_name = $request->question_products_name;
        $date = date('y-m-d H:i:s');
      

        DB::table('ask_question')->insert([
            'user_id' => $user_id,
            'name'=> $question_name,
            'email' => $question_email,
            'question' => $question,
            'products_id' => $products_id,
            'products_name' => $products_name,
            'created_at' => $date,
        ]);

		
		return redirect()->back()->with('questionsuccess', 'Thank you for your question! We will notify you once it gets answered.!');
		

	}

    public function askAQuestionnote(Request $request){
        if (auth()->guard('customer')->check()) {
        $user_id = auth()->guard('customer')->user()->id;
        }
        else
        {
            $user_id = 0;
        }
        $question_name = $request->question_name;
        $question_email = $request->question_email;
        $question = $request->question_content;
        $products_id = $request->question_products_id;
        $products_name = $request->question_products_name;
        $date = date('y-m-d H:i:s');
      

        DB::table('ask_question')->insert([
            'user_id' => $user_id,
            'name'=> $question_name,
            'email' => $question_email,
            'question' => $question,
            'products_id' => $products_id,
            'products_name' => $products_name,
            'created_at' => $date,
        ]);

		
		return redirect()->back()->with('questionnotesuccess', 'Thank you for your question! We will notify you once it gets answered.!');
		

	}


    public function reviewadd(Request $request)
    {

        print_r($request->pictures->getclientoriginalextension());die();
        /* $result['commonContent'] = $this->index->commonContent();

        if($result['commonContent']['settings']['Review']=='1'){
            $instatus='-1';
            $read='0';
        }else{
            $instatus='1';
            $read='1';
        }

        if (Auth::guard('customer')->check()) {
            $check = DB::table('reviews')
                ->where('customers_id', Auth::guard('customer')->user()->id)
                ->where('products_id', $request->products_id)
                ->first();

            if ($check) {
                return 'already_commented';
            }
            $id = DB::table('reviews')->insertGetId([
                'products_id' => $request->products_id,
                'reviews_rating' => $request->rating,
                'customers_id' => Auth::guard('customer')->user()->id,
                'customers_name' => Auth::guard('customer')->user()->first_name,
                'reviews_status'=> $instatus,
                'reviews_read'=>$read,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => Session::get('language_id'),
                    'reviews_text' => $request->reviews_text,
                ]);
            return 'done';
        } else {
            return 'not_login';

        } */
    }



      //shop
      public function filterindex(Request $request)
      {
          $title = array('pageTitle' => Lang::get('website.Shop'));
          $result = array();
  
          $result['commonContent'] = $this->index->commonContent();
        
          if (!empty($request->page)) {
              $page_number = $request->page;
          } else {
              $page_number = 0;
          }
  
          if (!empty($request->limit)) {
              $limit = $request->limit;
          } else {
              $limit = 15;
          }
  
          if (!empty($request->type)) {
              $type = $request->type;
          } else {
              $type = '';
          }
  
          //min_max_price
          if (!empty($request->price)) {
              $d = explode(";", $request->price);
              $min_price = $d[0];
              $max_price = $d[1];
          } else {
              $min_price = '';
              $max_price = '';
          }
          $exist_category = '1';
          $categories_status = 1;
          //category
          if (!empty($request->category) and $request->category != 'all') {
              $category = $this->products->getCategories($request);
              
              if(!empty($category) and count($category)>0){
                  $categories_id = $category[0]->categories_id;
                  //for main
                  if ($category[0]->parent_id == 0) {
                      $category_name = $category[0]->categories_name;
                      $sub_category_name = '';
                      $category_slug = '';
                      $categories_status = $category[0]->categories_status;
                  } else {
                      //for sub
                      $main_category = $this->products->getMainCategories($category[0]->parent_id);
  
                      $category_slug = $main_category[0]->categories_slug;
                      $category_name = $main_category[0]->categories_name;
                      $sub_category_name = $category[0]->categories_name;
                      $categories_status = $category[0]->categories_status;
                  }
              }else{
                  $categories_id = '';
                  $category_name = '';
                  $sub_category_name = '';
                  $category_slug = '';
                  $categories_status = 0;
              }
                              
  
          } else {
              $categories_id = '';
              $category_name = '';
              $sub_category_name = '';
              $category_slug = '';
              $categories_status = 1;
          }
  
          $result['category_name'] = $category_name;
          $result['category_slug'] = $category_slug;
          $result['sub_category_name'] = $sub_category_name;
          $result['categories_status'] = $categories_status;
  
          //search value
          if (!empty($request->search)) {
              $search = $request->search;
          } else {
              $search = '';
          }
  
          $filters = array();
          if (!empty($request->filters_applied) and $request->filters_applied == 1) {
              $index = 0;
              $options = array();
              $option_values = array();
  
              $option = $this->products->getOptions();
  
              foreach ($option as $key => $options_data) {
                  $option_name = str_replace(' ', '_', $options_data->products_options_name);
  
                  if (!empty($request->$option_name)) {
                      $index2 = 0;
                      $values = array();
                      foreach ($request->$option_name as $value) {
                          $value = $this->products->getOptionsValues($value);
                          $option_values[] = $value[0]->products_options_values_id;
                      }
                      $options[] = $options_data->products_options_id;
                  }
              }
  
              $filters['options_count'] = count($options);
  
              $filters['options'] = implode(',',$options);
              $filters['option_value'] = implode(',',$option_values);
  
              $filters['filter_attribute']['options'] = $options;
              $filters['filter_attribute']['option_values'] = $option_values;
  
              $result['filter_attribute']['options'] = $options;
              $result['filter_attribute']['option_values'] = $option_values;
          }
  
          $brand = '';
  
          if(isset($request->brand)){
              $brand = $request->brand;
          }
          $data1111 = array('check' => 1,'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
              'categories_id' => $categories_id, 'search' => $search,
              'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'brand' => $brand);
  
              
  
          /* $products = $this->products->products_check($data1111);         */
          $products = $this->products->products_paginate($data1111);        
          $result['products'] = $products;
         //print_r($result['products']);die();
  
          $data = array('limit' => $limit, 'categories_id' => $categories_id);
          $filters = $this->filters($data);
          $result['filters'] = $filters;
  
          $cart = '';
          $result['cartArray'] = $this->products->cartIdArray($cart);
  
          if ($limit > $result['products']['total_record']) {
              $result['limit'] = $result['products']['total_record'];
          } else {
              $result['limit'] = $limit;
          }
  
         
  
          //liked products
          $result['liked_products'] = $this->products->likedProducts();
          $result['categories'] = $this->products->categories();
  
          $result['min_price'] = $min_price;
          $result['max_price'] = $max_price;



          $result1 = array();

          $result1['commonContent'] = $this->index->commonContent();
        
          if (!empty($request->page)) {
              $page_number = $request->page;
          } else {
              $page_number = 0;
          }
  
          if (!empty($request->limit)) {
              $limit = $request->limit;
          } else {
              $limit = 8;
          }
  
          if (!empty($request->type)) {
              $type = $request->type;
          } else {
              $type = '';
          }
  
          //min_max_price
          if (!empty($request->price)) {
              $d = explode(";", $request->price);
              $min_price = $d[0];
              $max_price = $d[1];
          } else {
              $min_price = '';
              $max_price = '';
          }
          $exist_category = '1';
          $categories_status = 1;
          //category
          if (!empty($request->category) and $request->category != 'all') {
              $category = $this->products->getCategories($request);
              
              if(!empty($category) and count($category)>0){
                  $categories_id = $category[0]->categories_id;
                  //for main
                  if ($category[0]->parent_id == 0) {
                      $category_name = $category[0]->categories_name;
                      $sub_category_name = '';
                      $category_slug = '';
                      $categories_status = $category[0]->categories_status;
                  } else {
                      //for sub
                      $main_category = $this->products->getMainCategories($category[0]->parent_id);
  
                      $category_slug = $main_category[0]->categories_slug;
                      $category_name = $main_category[0]->categories_name;
                      $sub_category_name = $category[0]->categories_name;
                      $categories_status = $category[0]->categories_status;
                  }
              }else{
                  $categories_id = '';
                  $category_name = '';
                  $sub_category_name = '';
                  $category_slug = '';
                  $categories_status = 0;
              }
                              
  
          } else {
              $categories_id = '';
              $category_name = '';
              $sub_category_name = '';
              $category_slug = '';
              $categories_status = 1;
          }
  
          $result1['category_name'] = $category_name;
          $result1['category_slug'] = $category_slug;
          $result1['sub_category_name'] = $sub_category_name;
          $result1['categories_status'] = $categories_status;
  
  
          $category_section = array();
          if(!empty($result1['commonContent']['settings']['home_category']))
          {
              $categories_array = explode(',',$result1['commonContent']['settings']['home_category']);
              $index = 0;
              foreach($categories_array as $item){
                  
                  //get category section detail
                  $category = $this->products->getCategorybyId($item);
                  if($category){
                      $category_section[$index] = $category;
                     
                          $data = array('page_number' => '0', 'categories_id'=>$category->categories_id, 'type' => '', 'limit' => 8, 'min_price' => '', 'max_price' => '');
                      
                      $single_product = $this->products->products($data);
                      $category_section[$index]->products = $single_product;
                      $index++;
                  }
              }
              
          }
          $result1['category_section'] = $category_section;
      
  
  
          //search value
          if (!empty($request->search)) {
              $search = $request->search;
          } else {
              $search = '';
          }
  
          $filters = array();
          if (!empty($request->filters_applied) and $request->filters_applied == 1) {
              $index = 0;
              $options = array();
              $option_values = array();
  
              $option = $this->products->getOptions();
  
              foreach ($option as $key => $options_data) {
                  $option_name = str_replace(' ', '_', $options_data->products_options_name);
  
                  if (!empty($request->$option_name)) {
                      $index2 = 0;
                      $values = array();
                      foreach ($request->$option_name as $value) {
                          $value = $this->products->getOptionsValues($value);
                          $option_values[] = $value[0]->products_options_values_id;
                      }
                      $options[] = $options_data->products_options_id;
                  }
              }
  
              $filters['options_count'] = count($options);
  
              $filters['options'] = implode(',',$options);
              $filters['option_value'] = implode(',',$option_values);
  
              $filters['filter_attribute']['options'] = $options;
              $filters['filter_attribute']['option_values'] = $option_values;
  
              $result1['filter_attribute']['options'] = $options;
              $result1['filter_attribute']['option_values'] = $option_values;
          }
  
          $brand = '';
  
          if(isset($request->brand)){
              $brand = $request->brand;
          }
          $data1111 = array('check' => 1,'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
              'categories_id' => $categories_id, 'search' => $search,
              'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'brand' => $brand);
  
              
  
          $products1 = $this->products->products_check($data1111);  
          // print_r($products);die();      
          $result1['products'] = $products1;
         
  
          $data = array('limit' => $limit, 'categories_id' => $categories_id);
          $filters = $this->products->filters($data);
          $result1['filters'] = $filters;
  
  
          if ($limit > $result1['products']['total_record']) {
              $result1['limit'] = $result1['products']['total_record'];
          } else {
              $result1['limit'] = $limit;
          }
  
         
  
          //liked products
          $result1['liked_products'] = $this->products->likedProducts();
          $result1['categories'] = $this->products->categories();
  
          $result1['min_price'] = $min_price;
          $result1['max_price'] = $max_price;
  
         
         
          $final_theme = $this->theme->theme();
  
         // print_r('ok');die();
  
          return view("web.filter_index", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result)->with('result1', $result1);
  
      }


}
