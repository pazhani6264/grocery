<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\Categories;
use App\Models\Core\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\AdminControllers\AlertController;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Products extends Model
{

    use Sortable;
    public $sortable =['products_id','updated_at'];
    public $sortableAs =['categories_name','products_name'];

	public function paginator($request){
        $setting = new Setting();
        $myVarsetting = new SiteSettingController($setting);
        $commonsetting = $myVarsetting->commonsetting();
        $myVaralter = new AlertController($setting);

        $language_id = '1';
        $categories_id = $request->categories_id;
        $product  = $request->product;
        $FilterBy  = $request->FilterBy;
        $type  = $request->type;
        $results = array();
        $data = $this->sortable(['products_id'=>'DESC'])
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('manufacturers', function ($join) {
                $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
            })

            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
            })
            ->LeftJoin('flash_sale', function ($join) {
                $join->on('flash_sale.products_id', '=', 'products.products_id')->where('flash_sale.flash_status', '=', '1');
            })
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            });


            $data->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id');



        $data->select('products.*', 'products_description.*', 'specials.specials_id', 'manufacturers.*',
        'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price',
        'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified',
        'specials.expires_date','flash_sale.flash_sale_id', 'flash_sale.products_id as flash_sale_products_id', 'flash_sale.flash_sale_products_price as flash_sale_products_price',
        'flash_sale.flash_sale_date_added as flash_sale_date_added', 'flash_sale.flash_sale_last_modified as flash_sale_last_modified',
        'flash_sale.flash_expires_date as flash_sale_expires_date', 'image_categories.path as path', 'products.updated_at as productupdate', 'categories_description.categories_id',
        'categories_description.categories_name')
            ->where('products_description.language_id', '=', $language_id)
            ->where('categories_description.language_id', '=', $language_id);

        
            
        if (isset($FilterBy)) {
        if ($FilterBy == 'category') {

        if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])) {
            if (!empty(session('categories_id'))) {
                $cat_array = explode(',', session('categories_id'));
                $data->whereIn('products_to_categories.categories_id', '=', $cat_array);
            }

            $data->where('products_to_categories.categories_id', '=', $_REQUEST['categories_id']);

            if (isset($_REQUEST['product']) and !empty($_REQUEST['product'])) {
                $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
            }

            $products = $data->orderBy('products.productOrder', 'ASC')
            ->where('is_current', '1')
            ->where('categories_status', '1')->paginate(10);

        } else if (isset($_REQUEST['product']) and !empty($_REQUEST['product'])) {

            $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
            $products = $data->orderBy('products.productOrder', 'ASC')
            ->where('is_current', '1')
            ->where('categories_status', '1')->paginate(10);
        } else {

            if (!empty(session('categories_id'))) {
                $cat_array = explode(',', session('categories_id'));
                $data->whereIn('products_to_categories.categories_id', $cat_array);
            }
            $products = $data->orderBy('products.productOrder', 'ASC')
            ->where('categories_status', '1')
            ->where('is_current', '1')
            ->groupBy('products.products_id')->paginate(10);
        }
    }
    else if ($FilterBy == 'product') {
            $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
            $products = $data->orderBy('products.productOrder', 'ASC')
            ->where('is_current', '1')
            ->where('categories_status', '1')
            ->groupBy('products.products_id')->paginate(10);
    }
    else
    {

        $products = $data->orderBy('products.productOrder', 'ASC')
        ->where('categories_status', '1')
        ->where('products_type', $type)
        ->where('is_current', '1')
        ->groupBy('products.products_id')->paginate(10);

    }
}
else
{

    $products = $data->orderBy('products.productOrder', 'ASC')
    ->where('categories_status', '1')
    ->where('is_current', '1')
    ->groupBy('products.products_id')->paginate(10);

}

        return $products;
    }

  public function getter(){
              $setting = new Setting();
              $myVarsetting = new SiteSettingController($setting);
              $commonsetting = $myVarsetting->commonsetting();
              $myVaralter = new AlertController($setting);

              $language_id = '1';
              $categories_id = '';
              $product  = '';
              $results = array();
              $data = $this->sortable(['products_id'=>'DESC'])
                  ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                  ->LeftJoin('manufacturers', function ($join) {
                      $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
                  })
                  ->LeftJoin('specials', function ($join) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');
                  })
                  ->LeftJoin('image_categories', function ($join) {
                      $join->on('image_categories.image_id', '=', 'products.products_image')
                          ->where(function ($query) {
                              $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                  ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                  ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                          });
                  });

            //  if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id']) or !empty(session('categories_id'))) {

                  $data->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                      ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                      ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id');

            //  }

              $data->select('products.*', 'products_description.*', 'specials.specials_id', 'manufacturers.*', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date', 'image_categories.path as path',
              'products.updated_at as productupdate', 'categories_description.categories_id', 'categories_description.categories_name')
                  ->where('products_description.language_id', '=', $language_id)
                  ->where('categories_description.language_id', '=', $language_id);


               

              if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])) {

             

                  if (!empty(session('categories_id'))) {
                      $cat_array = explode(',', session('categories_id'));
                      $data->whereIn('products_to_categories.categories_id', '=', $cat_array);
                  }

                  $data->where('products_to_categories.categories_id', '=', $_REQUEST['categories_id']);

                  if (isset($_REQUEST['product']) and !empty($_REQUEST['product'])) {
                      $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
                  }

                  $products = $data->orderBy('products.products_id', 'DESC')->get();

              } else {

                  if (!empty(session('categories_id'))) {
                      $cat_array = explode(',', session('categories_id'));
                      $data->whereIn('products_to_categories.categories_id', $cat_array);
                  }
                  $products = $data->orderBy('products.products_id', 'DESC')
                  ->groupBy('products.products_id')->get();
              }

              return $products;
          }

  public function insert($request){
    $language_id      =   '1';
    $date_added	= date('Y-m-d H:i:s');

  

    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $languages = $myVarsetting->getLanguages();
    $setting = $myVarsetting->getSetting();

    $expiryDate = str_replace('/', '-', $request->expires_date);
    $expiryDateFormate = strtotime($expiryDate);

    if($request->image_id !== null){
      $uploadImage = $request->image_id[0];
    }else{
        $uploadImage = '';
    }

    if($request->stock_status !== null){
        $stocks=$request->stock_status;
    }else{
         $stocks='0';
    }
    
    $new_image=$request->image_id;
    array_shift($new_image);

    
    if ($request->tax_class_id == "Select Tax Class"){
        $tax_Class_id = 0;
    }else{
        $tax_Class_id = $request->tax_class_id;
    }

    if(empty($request->qut_type)){
        $qut_type='0';
    }else{
        $qut_type=$request->qut_type;
    }

    if(empty($request->qunt_count)){
        $qunt_count='1';
    }else{
        if($request->qut_type =='0'){
          $qunt_count='1';
        }else{
          $qunt_count=$request->qunt_count;  
        }
    }

    $products_id = DB::table('products')->insertGetId([
        'products_image' => $uploadImage,
        'manufacturers_id' => $request->manufacturers_id,
        'products_quantity' => 0,
        'special_type' => $request->specialtype,
        'products_model' => $request->products_model,
        'products_price' => $request->products_price,
        'products_filter_price' => $request->products_price,
        'created_at' => $date_added,
        'products_weight' => $request->products_weight,
        'products_status' => $request->products_status,
        'products_tax_class_id' => $tax_Class_id,
        'products_weight_unit' => $request->products_weight_unit,
        'low_limit' => 0,
        'products_slug' => 0,
        'products_type' => $request->products_type,
        'is_feature' => $request->is_feature,
        'is_special' => $request->isSpecial,
        'products_min_order' => $request->products_min_order,
        'products_max_stock' => $request->products_max_stock,
        'products_video_link' => $request->products_video_link,
        'is_current'         => 1,
        'button_type'        => $request->button_type,
        'product_serve'       => $request->product_serve,
        'product_view'        => $request->product_view,
        'stock_status'        => $stocks,
        'quantity_type'       => $qut_type,
        'quantity_count'      => $qunt_count,
        'cost_price'      => $request->cost_price,
        'commission_sales'=> $request->commission,
        'commission_type'=> $request->commission_type
    ]);

// Insert Combo Product 

    if($request->products_type == 3){
        $cate_name = $request->cate;
        $product_name = $request->product;
        $qty = $request->qty;
        
        for ($i = 0; $i < count($cate_name); $i++) {

            if(!empty($request->attr[$i])){
                $attr_name = $request->attr[$i];
            } else {
                $attr_name = '';
            }
            if(!empty($request->attrValue[$i])){
                $attr_value = $request->attrValue[$i];
            } else {
                $attr_value = '';
            }

            $productCombo = DB::table('product_combo')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name[$i],
                'product_id' => $product_name[$i],
                'attractive_id' => $attr_name,
                'option_id' => $attr_value,
                'qty' => $qty[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    // Insert Buy x And Get x Product 

    if($request->products_type == 4){
        $cate_name = $request->cate;
        $product_name = $request->product;
        $qty = $request->qty;
        
        for ($i = 0; $i < count($cate_name); $i++) {

            if(!empty($request->attr[$i])){
                $attr_name = $request->attr[$i];
            } else {
                $attr_name = '';
            }
            if(!empty($request->attrValue[$i])){
                $attr_value = $request->attrValue[$i];
            } else {
                $attr_value = '';
            }

            $productBuyX = DB::table('product_buy_x')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name[$i],
                'product_id' => $product_name[$i],
                'attractive_id' => $attr_name,
                'option_id' => $attr_value,
                'qty' => $qty[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $cate_name_get_x = $request->cate_get_x;
        $product_name_get_x = $request->product_get_x;
        $qty_get_x = $request->qty_get_x;

        for ($i = 0; $i < count($cate_name_get_x); $i++) {

            if(!empty($request->attr_get_x[$i])){
                $attr_name_get_x = $request->attr_get_x[$i];
            } else {
                $attr_name_get_x = '';
            }
    
            if(!empty($request->attrValue_get_x[$i])){
                $attr_value_get_x = $request->attrValue_get_x[$i];
            } else {
                $attr_value_get_x = '';
            }

            $productGetX = DB::table('product_get_x')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name_get_x[$i],
                'product_id' => $product_name_get_x[$i],
                'attractive_id' => $attr_name_get_x,
                'option_id' => $attr_value_get_x,
                'qty' => $qty_get_x[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }


    // insert product image
    if(!empty($new_image))
    {
      foreach ($new_image as $jesnewimage) {
      $count = DB::table('products_images')->where('products_id', '=', $products_id)->count();
        $new_count=$count+1;
            DB::table('products_images')->insert([
              'products_id' => $products_id,
              'image' => $jesnewimage,
              'sort_order' => $new_count
          ]);
      }
    }

    $slug_flag = false;
    foreach($languages as $languages_data){
        $products_name = 'products_name_'.$languages_data->languages_id;
        $products_url = 'products_url_'.$languages_data->languages_id;
        $products_description = 'products_description_'.$languages_data->languages_id;
        //left banner
        $products_left_banner = 'products_left_banner_'.$languages_data->languages_id;
        $products_left_banner_start_date = 'products_left_banner_start_date_'.$languages_data->languages_id;
        if(!empty($request->$products_left_banner_start_date)){
          $leftStartDate = str_replace('/', '-', $request->$products_left_banner_start_date);
          $leftStartDateFormat = strtotime($leftStartDate);
        }else{
            $leftStartDateFormat = null;
        }
        //expire date
        $products_left_banner_expire_date = 'products_left_banner_expire_date_'.$languages_data->languages_id;
        if(!empty($request->$products_left_banner_expire_date)){
          $leftExpiretDate = str_replace('/', '-', $request->$products_left_banner_expire_date);
          $leftExpireDateFormat = strtotime($leftExpiretDate);
        }else{
            $leftExpireDateFormat = null;
        }
        //right banner
        $products_right_banner = 'products_right_banner_'.$languages_data->languages_id;
        $products_right_banner_start_date = 'products_right_banner_start_date_'.$languages_data->languages_id;
        if(!empty($request->$products_right_banner_start_date)){
            $rightStartDate = str_replace('/', '-', $request->$products_right_banner_start_date);
            $rightStartDateFormat = strtotime($rightStartDate);
        }else{
            $rightStartDateFormat = null;
        }
        //expire date
        $products_right_banner_expire_date = 'products_right_banner_expire_date_'.$languages_data->languages_id;
        if(!empty($request->$products_right_banner_expire_date)){
            $rightExpiretDate = str_replace('/', '-', $request->$products_right_banner_expire_date);
            $rightExpireDateFormat = strtotime($rightExpiretDate);
        }else{
            $rightExpireDateFormat = null;
        }
        //slug
        if($slug_flag==false){
            $slug_flag=true;
            $slug = $request->$products_name;
            $old_slug = $request->$products_name;
            $slug_count = 0;
            do{
                if($slug_count==0){
                    $currentSlug = $myVarsetting->slugify($slug);
                }else{
                    $currentSlug = $myVarsetting->slugify($old_slug.'-'.$slug_count);
                }
                $slug = $currentSlug;
                $checkSlug = DB::table('products')->where('products_slug', $currentSlug)->get();
                $slug_count++;
            }
            while(count($checkSlug)>0);
            DB::table('products')
              ->where('products_id', $products_id)
              ->update([
                'products_slug' => $slug
            ]);
        }

        if($request->$products_left_banner !== null){
            $leftBanner = $request->$products_left_banner;
        }else{
            $leftBanner = '';
        }
        if($request->$products_right_banner !== null){
            $rightBanner = $request->$products_right_banner;
        }else{
            $rightBanner = '';
        }
        $req_products_name = $request->$products_name ;
        $req_products_url = $request->$products_url;
        $req_products_description = $request->$products_description;
        DB::table('products_description')->insert([
            'products_name' => $req_products_name,
            'language_id' => $languages_data->languages_id,
            'products_id' => $products_id,
            'products_url' => $req_products_url,
            'products_left_banner' => $leftBanner,
            'products_left_banner_start_date' => $leftStartDateFormat,
            'products_left_banner_expire_date' => $leftExpireDateFormat,
            'products_right_banner' => $rightBanner,
            'products_right_banner_start_date' => $rightStartDateFormat,
            'products_right_banner_expire_date' => $rightExpireDateFormat,
            'products_description' => addslashes($req_products_description)

        ]);
    }

    //flash sale product
    //print_r($request->isFlash);die();

    if($request->isFlash != 'no'){
        $startdate = $request->flash_start_date;
        $starttime = $request->flash_start_time;
        $start_date = str_replace('/','-',$startdate.' '.$starttime);
        $flash_start_date = strtotime($start_date);
        $expiredate = $request->flash_expires_date;
        $expiretime = $request->flash_end_time;
        $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
        $flash_expires_date = strtotime($expire_date);
        DB::table('flash_sale')->insert([
            'products_id' => $products_id,
            'flash_sale_products_price' => $request->flash_sale_products_price,
            'created_at' => $date_added,
            'flash_start_date' => $flash_start_date,
            'flash_expires_date' => $flash_expires_date,
            'flash_status' => $request->flash_status
        ]);
    }

    //special product
    if($request->isSpecial == 'yes'){
        if($request->specialtype == '1')
        {
            $special_price = $request->products_price - $request->specials_new_products_price;
        }
        else
        {
            $special_price  = ($request->products_price * $request->specials_new_products_price) / 100;
            $special_price = $request->products_price - $special_price;
        }
      DB::table('specials')
      ->where('products_id', '=', $products_id)
      ->update([
          'specials_last_modified' => $date_added,
          'date_status_change' => $date_added,
          'status' => 0,
      ]);
      DB::table('specials')
      ->insert([
          'products_id' => $products_id,
          'specials_new_products_price' => $special_price,
          'special_price' => $request->specials_new_products_price,
          'special_type' => $request->specialtype,
          'specials_date_added' => time(),
          'expires_date' => $expiryDateFormate,
          'status' => $request->status,
      ]);

      DB::table('products')->where('products_id', '=', $products_id)->update([
        'products_filter_price' => $special_price,
    ]);

    }
    foreach($request->categories as $categories){
      DB::table('products_to_categories')
        ->insert([
          'products_id' => $products_id,
          'categories_id' => $categories
      ]);
    }
    //insert sku
    if(!empty($request->products_sku)){
        $sku=$request->products_sku;
    }else{
         $product_name=DB::table('products_description')->where('products_id', '=', $products_id)->where('language_id', '=', $language_id)->first();
        $cate_name=DB::table('products_to_categories')
        ->join('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
        ->select('categories_description.categories_name')
        ->where('products_to_categories.products_id', $products_id)
        ->first();
        if(!empty($request->manufacturers_id)){
            $manufacturers=DB::table('manufacturers')->where('manufacturers_id', '=', $request->manufacturers_id)->first();
            $brand=$manufacturers->manufacturer_name;
        }else{
            $brand=$setting[18]->value;
        }
         $sku = $myVarsetting->SKU_gen($product_name->products_name,$cate_name->categories_name,$brand,$products_id);
    }

    // update sku
    DB::table('products')->where('products_id', '=', $products_id)->update([
        'product_sku' => $sku,
    ]);

    $options = DB::table('products_options')
        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
        ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
        ->where('products_options_descriptions.language_id', $language_id)
        ->get();

    if(!empty($options) and count($options)>0){
      $result['options'] = $options;
    }else{
        $result['options'] = '';
    }

    $options_value = DB::table('products_options_values')
    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
    ->where('products_options_values_descriptions.language_id', '=', $language_id)
    ->get();
    if(!empty($options_value) and count($options_value)>0){
       $result['options_value'] = $options_value;
   }else{
       $result['options_value'] = '';
   }
    return $products_id;
  }

  public function edit($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $products_id      =   $request->id;
    $category_id	  =	  '0';
    $result = array();

    //get function from other controller
    $result['languages'] = $myVarsetting->getLanguages();
    $result['units'] = $myVarsetting->getUnits();


    //get function from ManufacturerController controller
    $getManufacturers = DB::table('manufacturers')
        ->leftJoin('manufacturers_info','manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
        ->select('manufacturers.manufacturers_id as id', 'manufacturers.manufacturer_image as image',  'manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url', 'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date')
        ->where('manufacturers_info.languages_id', $language_id)->get();
    $result['manufacturer'] = $getManufacturers;
    $product = DB::table('products')
        ->LeftJoin('image_categories', function ($join) {

            $join->on('image_categories.image_id', '=', 'products.products_image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });

        })
        ->where('products.products_id', '=', $products_id)
        ->get();

    $description_data = array();

    foreach($result['languages'] as $languages_data){
      $description = DB::table('products_description')
          ->LeftJoin('image_categories as imgleftbannert', function ($join) {

              $join->on('imgleftbannert.image_id', '=', 'products_description.products_left_banner')
                  ->where(function ($query) {
                      $query->where('imgleftbannert.image_type', '=', 'THUMBNAIL')
                          ->where('imgleftbannert.image_type', '!=', 'THUMBNAIL')
                          ->orWhere('imgleftbannert.image_type', '=', 'ACTUAL');
                  });

          })
          ->LeftJoin('image_categories as imgrightbannert', function ($join) {

              $join->on('imgrightbannert.image_id', '=', 'products_description.products_right_banner')
                  ->where(function ($query) {
                      $query->where('imgrightbannert.image_type', '=', 'THUMBNAIL')
                          ->where('imgrightbannert.image_type', '!=', 'THUMBNAIL')
                          ->orWhere('imgrightbannert.image_type', '=', 'ACTUAL');
                  });

          })
          ->where([
              ['language_id', '=', $languages_data->languages_id],
              ['products_id', '=', $products_id],

          ])->select('products_description.*', 'imgrightbannert.path as imgright', 'imgleftbannert.path as imgleft')->get();



        if(count($description)>0){
            $description_data[$languages_data->languages_id]['products_name'] = $description[0]->products_name;
            $description_data[$languages_data->languages_id]['products_url'] = $description[0]->products_url;
            $description_data[$languages_data->languages_id]['products_description'] = $description[0]->products_description;
            $description_data[$languages_data->languages_id]['products_left_banner'] =  $description[0]->products_left_banner;
            $description_data[$languages_data->languages_id]['products_left_banner_start_date'] = $description[0]->products_left_banner_start_date;
            $description_data[$languages_data->languages_id]['products_left_banner_expire_date'] = $description[0]->products_left_banner_expire_date;
            $description_data[$languages_data->languages_id]['products_right_banner'] = $description[0]->products_right_banner;
            $description_data[$languages_data->languages_id]['products_right_banner_start_date'] = $description[0]->products_right_banner_start_date;
            $description_data[$languages_data->languages_id]['products_right_banner_expire_date'] = $description[0]->products_right_banner_expire_date;
            $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
            $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            $description_data[$languages_data->languages_id]['imgright'] = $description[0]->imgright;
            $description_data[$languages_data->languages_id]['imgleft'] = $description[0]->imgleft;

        }else{
            $description_data[$languages_data->languages_id]['products_name'] = '';
            $description_data[$languages_data->languages_id]['products_url'] = '';
            $description_data[$languages_data->languages_id]['products_description'] = '';
            $description_data[$languages_data->languages_id]['products_left_banner'] =  '';
            $description_data[$languages_data->languages_id]['products_left_banner_start_date'] = '';
            $description_data[$languages_data->languages_id]['products_left_banner_expire_date'] = '';
            $description_data[$languages_data->languages_id]['products_right_banner'] =  '';
            $description_data[$languages_data->languages_id]['products_right_banner_start_date'] = '';
            $description_data[$languages_data->languages_id]['products_right_banner_expire_date'] = '';
            $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
            $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
            $description_data[$languages_data->languages_id]['imgright'] =  '';
            $description_data[$languages_data->languages_id]['imgleft'] =  '';

        }

    }
    $result['description'] = $description_data;
    $result['product'] = $product;
    $categories = DB::table('products_to_categories')
        ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
        ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
        ->where('products_id', '=', $products_id)->where('categories_description.language_id', '=', $language_id)
        ->where('categories_status', '1')
        ->get();

    $categories_array = array();
    foreach($categories as $category){
        $categories_array[] = $category->categories_id;
    }

    $result['categories_array'] = $categories_array;
    $getSpecialProduct = DB::table('specials')->where('products_id', $products_id)->orderby('specials_id', 'desc')->limit(1)->get();
    if(count($getSpecialProduct)>0){
        $specialProduct = $getSpecialProduct;
    }else{
        $specialProduct[0] = (object) array('specials_id'=>'', 'products_id'=>'', 'specials_new_products_price'=>'', 'status'=>'', 'expires_date' => '');
    }
    $result['specialProduct'] = $specialProduct;

    $getflashProduct = DB::table('flash_sale')->where('products_id', $products_id)->orderby('flash_sale_id', 'desc')->limit(1)->get();
    if(count($getflashProduct)>0){
        $flashProduct = $getflashProduct;
    }else{
        $flashProduct[0] = (object) array('products_id'=>'', 'flash_sale_products_price'=>'', 'flash_status'=>'', 'flash_start_date' => '', 'flash_expires_date' => '');
    }
    $result['flashProduct'] = $flashProduct;

    return $result;
  }

  public function updaterecord($request){
          $setting = new Setting();
          $myVarsetting = new SiteSettingController($setting);
          $myVaralter = new AlertController($setting);
          $settings = $myVarsetting->getSetting();

          $language_id      =   '1';
          $products_id      =   $request->id;
          $products_last_modified	= date('Y-m-d h:i:s');
          $expiryDate = str_replace('/', '-', $request->expires_date);
          $expiryDateFormate = strtotime($expiryDate);
          $languages = $myVarsetting->getLanguages();

          //check slug
          if($request->old_slug!=$request->slug ){
              $slug = $request->slug;
              $slug_count = 0;
              do{
                  if($slug_count==0){
                      $currentSlug = $myVarsetting->slugify($request->slug);
                  }else{
                      $currentSlug = $myVarsetting->slugify($request->slug.'-'.$slug_count);
                  }
                  $slug = $currentSlug;
                  $checkSlug = DB::table('products')->where('products_slug', $currentSlug)->where('products_id', '!=', $products_id)->get();
                  $slug_count++;
              }
              while(count($checkSlug)>0);
          }else{
              $slug = $request->slug;
          }
          if($request->image_id !== null){
              $uploadImage = $request->image_id;
          }else{
              $uploadImage = $request->oldImage;
          }

          if($request->stock_status !== null){
                $stocks=$request->stock_status;
          }else{
                $stocks='0';
          }

          if($request->products_type == '0'){
            $attributes = DB::table('products_attributes')->where('products_id',$products_id)->get();
            if(count($attributes)>0){
                DB::table('products_attributes')->where([
                        ['products_id', '=', $products_id],
                    ])->delete();

            }
          }
          if(empty($request->qut_type)){
                $qut_type='0';
            }else{
                $qut_type=$request->qut_type;
            }

            if(empty($request->qunt_count)){
                $qunt_count='1';
            }else{
                if($request->qut_type =='0'){
                  $qunt_count='1';
                }else{
                  $qunt_count=$request->qunt_count;  
                }
            }
          DB::table('products')->where('products_id', '=', $products_id)->update([
              'products_image' => $uploadImage,
              'manufacturers_id' => $request->manufacturers_id,
              'products_quantity' => 0,
              'products_model' => $request->products_model,
              'products_price' => $request->products_price,
              'special_type' => $request->specialtype,
              'products_filter_price' => $request->products_price,
              'updated_at' => $products_last_modified,
              'products_weight' => $request->products_weight,
              'products_status' => $request->products_status,
              'products_tax_class_id' => $request->tax_class_id,
              'products_weight_unit' => $request->products_weight_unit,
              'low_limit' => 0,
              'products_slug' => $slug,
              'products_type' => $request->products_type,
              'is_feature' => $request->is_feature,
              'is_special' => $request->isSpecial,
              'products_min_order' => $request->products_min_order,
              'products_max_stock' => $request->products_max_stock,
              'products_video_link' => $request->products_video_link,
              'button_type'        => $request->button_type,
              'product_serve'        => $request->product_serve,
              'product_view'        => $request->product_view,
              'stock_status'        => $stocks,
              'quantity_type'       => $qut_type,
              'quantity_count'      => $qunt_count,
              'cost_price'      => $request->cost_price,
              'commission_sales'=> $request->commission,
              'commission_type'=> $request->commission_type,
          ]);



// Insert Combo Product 

    if($request->products_type == 3){
        $cate_name = $request->cate;
        $product_name = $request->product;
        $qty = $request->qty;

        $productCombo = DB::table('product_combo')->where('pro_id',$products_id)->delete();
        
        for ($i = 0; $i < count($cate_name); $i++) {

            if(!empty($request->attr[$i])){
                $attr_name = $request->attr[$i];
            } else {
                $attr_name = '';
            }
            if(!empty($request->attrValue[$i])){
                $attr_value = $request->attrValue[$i];
            } else {
                $attr_value = '';
            }

            $productCombo = DB::table('product_combo')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name[$i],
                'product_id' => $product_name[$i],
                'attractive_id' => $attr_name,
                'option_id' => $attr_value,
                'qty' => $qty[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    } else {
        $productCombo = DB::table('product_combo')->where('pro_id',$products_id)->delete();
    }


    // Insert Buy x and Get x Product 

    if($request->products_type == 4){
        $cate_name = $request->cate;
        $product_name = $request->product;
        $qty = $request->qty;

        $productBuyX = DB::table('product_buy_x')->where('pro_id',$products_id)->delete();
        
        for ($i = 0; $i < count($cate_name); $i++) {

            if(!empty($request->attr[$i])){
                $attr_name = $request->attr[$i];
            } else {
                $attr_name = '';
            }
            if(!empty($request->attrValue[$i])){
                $attr_value = $request->attrValue[$i];
            } else {
                $attr_value = '';
            }

            $productBuyX = DB::table('product_buy_x')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name[$i],
                'product_id' => $product_name[$i],
                'attractive_id' => $attr_name,
                'option_id' => $attr_value,
                'qty' => $qty[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }


        $cate_name_get_x = $request->cate_get_x;
        $product_name_get_x = $request->product_get_x;
        $qty_get_x = $request->qty_get_x;

        $productGetX = DB::table('product_get_x')->where('pro_id',$products_id)->delete();
        
        for ($i = 0; $i < count($cate_name_get_x); $i++) {

            if(!empty($request->attr_get_x[$i])){
                $attr_name_get_x = $request->attr_get_x[$i];
            } else {
                $attr_name_get_x = '';
            }
    
            if(!empty($request->attrValue_get_x[$i])){
                $attr_value_get_x = $request->attrValue_get_x[$i];
            } else {
                $attr_value_get_x = '';
            }

            $productGetX = DB::table('product_get_x')->insertGetId([
                'pro_id' => $products_id,
                'cate_id' => $cate_name_get_x[$i],
                'product_id' => $product_name_get_x[$i],
                'attractive_id' => $attr_name_get_x,
                'option_id' => $attr_value_get_x,
                'qty' => $qty_get_x[$i],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

    } else {
        $productBuyX = DB::table('product_buy_x')->where('pro_id',$products_id)->delete();
        $productGetX = DB::table('product_get_x')->where('pro_id',$products_id)->delete();
    }

          foreach($languages as $languages_data){
              $products_name = 'products_name_'.$languages_data->languages_id;
              $products_url = 'products_url_'.$languages_data->languages_id;
              $products_description = 'products_description_'.$languages_data->languages_id;
              //left banner
              $products_left_banner = 'products_left_banner_'.$languages_data->languages_id;
              $products_left_banner_start_date = 'products_left_banner_start_date_'.$languages_data->languages_id;
              if(!empty($request->$products_left_banner_start_date)){
                  $leftStartDate = str_replace('/', '-', $request->$products_left_banner_start_date);
                  $leftStartDateFormat = strtotime($leftStartDate);
              }else{
                  $leftStartDateFormat = '';
              }
              //expire date
              $products_left_banner_expire_date = 'products_left_banner_expire_date_'.$languages_data->languages_id;
              if(!empty($request->$products_left_banner_expire_date)){
                  $leftExpiretDate = str_replace('/', '-', $request->$products_left_banner_expire_date);
                  $leftExpireDateFormat = strtotime($leftExpiretDate);
              }else{
                  $leftExpireDateFormat = '';
              }
              //right banner
              $products_right_banner = 'products_right_banner_'.$languages_data->languages_id;
              $products_right_banner_start_date = 'products_right_banner_start_date_'.$languages_data->languages_id;
              if(!empty($request->$products_right_banner_start_date)){
                  $rightStartDate = str_replace('/', '-', $request->$products_right_banner_start_date);
                  $rightStartDateFormat = strtotime($rightStartDate);
              }else{
                  $rightStartDateFormat = '';
              }
              //expire date
              $products_right_banner_expire_date = 'products_right_banner_expire_date_'.$languages_data->languages_id;
              if(!empty($request->$products_right_banner_expire_date)){
                  $rightExpiretDate = str_replace('/', '-', $request->$products_right_banner_expire_date);
                  $rightExpireDateFormat = strtotime($rightExpiretDate);
              }else{
                  $rightExpireDateFormat = '';
              }
              $old_left_banner = 'old_left_banner_'.$languages_data->languages_id;
              $old_right_banner = 'old_right_banner_'.$languages_data->languages_id;
              if($request->$products_left_banner !== null){
                  $leftBanner = $request->$products_left_banner;
              }else{
                  $leftBanner = $request->$old_left_banner;
              }
              if($request->$products_right_banner !== null){
                  $rightBanner = $request->$products_right_banner;
              }else{
                  $rightBanner = $request->$old_right_banner;
              }
              $checkExist = DB::table('products_description')->where('products_id', '=', $products_id)->where('language_id', '=', $languages_data->languages_id)->get();
              if(count($checkExist)>0){
                  $req_products_name = $request->$products_name;
                  $req_products_url = $request->$products_url;
                  $req_products_description = $request->$products_description;

                  DB::table('products_description')->where('products_id', '=', $products_id)
                  ->where('language_id', '=', $languages_data->languages_id)->update([
                      'products_name' => $req_products_name,
                      'products_url' => $req_products_url,
                      'products_left_banner' => $leftBanner,
                      'products_right_banner' => $rightBanner,
                      'products_left_banner_start_date' => $leftStartDateFormat,
                      'products_left_banner_expire_date' => $leftExpireDateFormat,
                      'products_right_banner_start_date' => $rightStartDateFormat,
                      'products_right_banner_expire_date' => $rightExpireDateFormat,
                      'products_description' => addslashes($req_products_description)

                  ]);
              }else{
                  $req_products_name = $request->$products_name;
                  $req_products_url = $request->$products_url;
                  $req_products_description = $request->$products_description;
                  DB::table('products_description')->insert([
                      'products_name' => $req_products_name,
                      'language_id' => $languages_data->languages_id,
                      'products_id' => $products_id,
                      'products_url' => $req_products_url,
                      'products_left_banner' => $leftBanner,
                      'products_right_banner' => $rightBanner,
                      'products_left_banner_start_date' => $leftStartDateFormat,
                      'products_left_banner_expire_date' => $leftExpireDateFormat,
                      'products_right_banner_start_date' => $rightStartDateFormat,
                      'products_right_banner_expire_date' => $rightExpireDateFormat,
                      'products_description' => addslashes($req_products_description)
                  ]);
              }
          }
          //delete categories
          DB::table('products_to_categories')->where([
              'products_id' => $products_id,
          ])->delete();
          foreach($request->categories as $categories){
            DB::table('products_to_categories')->insert([
                'products_id' => $products_id,
                'categories_id' => $categories
            ]);
          }

          //insert sku
            if(!empty($request->products_sku)){
                $sku=$request->products_sku;
            }else{
                 $product_name=DB::table('products_description')->where('products_id', '=', $products_id)->where('language_id', '=', $language_id)->first();
                $cate_name=DB::table('products_to_categories')
                ->join('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                ->select('categories_description.categories_name')
                ->where('products_to_categories.products_id', $products_id)
                ->first();
                if(!empty($request->manufacturers_id)){
                    $manufacturers=DB::table('manufacturers')->where('manufacturers_id', '=', $request->manufacturers_id)->first();
                    $brand=$manufacturers->manufacturer_name;
                }else{
                    $brand=$settings[18]->value;
                }
                 $sku = $myVarsetting->SKU_gen($product_name->products_name,$cate_name->categories_name,$brand,$products_id);
            }

            // update sku
    DB::table('products')->where('products_id', '=', $products_id)->update([
        'product_sku' => $sku,
    ]);

          //special product
          if($request->isSpecial == 'yes'){
            if($request->specialtype == '1')
            {
                $special_price = $request->products_price - $request->specials_new_products_price;
            }
            else
            {
                $special_price  = ($request->products_price * $request->specials_new_products_price) / 100;

                $special_price = $request->products_price - $special_price;
            }

            DB::table('specials')->where('products_id', '=', $products_id)->update([
                'specials_last_modified' => $products_last_modified,
                'date_status_change' => $products_last_modified,
                'status' => 0,
            ]);
            DB::table('specials')->insert([
                'products_id' => $products_id,
                'specials_new_products_price' => $special_price,
                'special_price' => $request->specials_new_products_price,
          'special_type' => $request->specialtype,
                'specials_date_added' => time(),
                'expires_date' => $expiryDateFormate,
                'status' => $request->status,
            ]);
            DB::table('products')->where('products_id', '=', $products_id)->update([
                'products_filter_price' => $special_price,
            ]);
            }else if($request->isSpecial == 'no'){
              DB::table('specials')->where('products_id', '=', $products_id)->delete();
            }

          //flash sale product
          if($request->isFlash == 'yes'){
            DB::table('flash_sale')->where('products_id', '=', $products_id)->update([
                'updated_at' => $products_last_modified,
                'flash_status' => 0,
            ]);
              $startdate = $request->flash_start_date;
              $starttime = $request->flash_start_time;
              $start_date = str_replace('/','-',$startdate.' '.$starttime);
              $flash_start_date = strtotime($start_date);
              $expiredate = $request->flash_expires_date;
              $expiretime = $request->flash_end_time;
              $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
              $flash_expires_date = strtotime($expire_date);
              DB::table('flash_sale')->insert([
                  'products_id' => $products_id,
                  'flash_sale_products_price' => $request->flash_sale_products_price,
                  'created_at' => $products_last_modified,
                  'flash_start_date' => $flash_start_date,
                  'flash_expires_date' => $flash_expires_date,
                  'flash_status' => $request->flash_status
              ]);
           }else if($request->isFlash == 'no'){
             DB::table('flash_sale')->where('products_id', '=', $products_id)->delete();                
            }
          $options = DB::table('products_options')
             ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
             ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')->where('products_options_descriptions.language_id', '1')->get();

          $result['options'] = $options;
          $options_value = DB::table('products_options_values')
              ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
              ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
              ->where('products_options_values_descriptions.language_id', '=', $language_id)
              ->get();                $result['options_value'] = $options_value;
          $result['data'] = array('products_id'=>$products_id, 'language_id'=>$language_id);

          $pr_price = DB::table('products')->where(['products_id' => $products_id])->first();
            if($pr_price != '')
            {
                $checkdefault = DB::table('products_attributes')->where('products_id','=',$products_id)->where('is_default','=', 1)->first();
                if($checkdefault != '')
                {
                    $or_price = $pr_price->products_price;
                    $option_price = $checkdefault->options_values_price;
                    if($request->price_prefix == '+')
                    {
                        $or_total = $or_price + $option_price;
                    }
                    else
                    {
                        $or_total = $or_price - $option_price;
                    }
                    if($request->isSpecial == 'yes'){
                        if($request->specialtype == '1')
                        {
                            $special_price = $or_total - $request->specials_new_products_price;
                        }
                        else
                        {
                            $special_price  = ($or_total * $request->specials_new_products_price) / 100;
            
                            $special_price = $or_total - $special_price;
                        }
                   
                        DB::table('products_attributes')->where('products_attributes_id', '=', $checkdefault->products_attributes_id)->update([
                            'special_type' => $request->specialtype,
                            'special_price' => $special_price,
                            'special_discount' => $request->specials_new_products_price,
                        ]);
                    }
                }
            }
          return $result;
  }

  public function deleterecord($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $products_id = $request->products_id;
    $categories = DB::table('products_to_categories')->where('products_id', $products_id)->delete();
    $categories = DB::table('products')->where('products_id', $products_id)->delete();
    $categories = DB::table('specials')->where('products_id', $products_id)->delete();
    $categories = DB::table('products_description')->where('products_id', $products_id)->delete();
    $categories = DB::table('products_attributes')->where('products_id', $products_id)->delete();
    $categories = DB::table('flash_sale')->where('products_id', $products_id)->delete();
    $categories = DB::table('liked_products')->where('liked_products_id', $products_id)->delete();
    $categories = DB::table('product_combo')->where('pro_id', $products_id)->delete();
    $categories = DB::table('product_buy_x')->where('pro_id', $products_id)->delete();
    $categories = DB::table('product_get_x')->where('pro_id', $products_id)->delete();
  }

  public function addinventory($id){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $products_id      =   $id;
    $result = array();
    $message = array();
    $errorMessage = array();
    $result['currency'] = $myVarsetting->getSetting();
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

            $product =  $product->get();
    $result['products'] = $product;
    $products = $product;
    $result['message'] = $message;
    $result['errorMessage'] = $errorMessage;
    $result2 = array();
    $index = 0;
    $stocks = 0;
    $min_level = 0;
    $max_level = 0;
    $purchase_price  = 0;
    if($result['products'][0]->products_type!=1){

      $currentStocks = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->get();
      $purchase_price = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->sum('purchase_price');

        if(count($currentStocks)>0){
            foreach($currentStocks as $currentStock){
                $stocks += $currentStock->stock;
            }
        }

          $manageLevel = DB::table('manage_min_max')->where('products_id', $result['products'][0]->products_id)->get();
        if(count($manageLevel)>0){
            $min_level = $manageLevel[0]->min_level;
            $max_level = $manageLevel[0]->max_level;
        }

    }

    $result['purchase_price'] = $purchase_price;
    $result['stocks'] = $stocks;
    $result['min_level'] = $min_level;
    $result['max_level'] = $max_level;
    $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->get();
    $products_attribute = $products_attribute->unique('options_id')->keyBy('options_id');
    if(count($products_attribute)>0){
        $index2 = 0;
        foreach($products_attribute as $attribute_data){
          $option_name = DB::table('products_options')
              ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
              ->where('products_options_descriptions.language_id', $language_id)
              ->where('products_options.products_options_id', $attribute_data->options_id)
              ->get();
            if(count($option_name)>0){

                $temp = array();
                $temp_option['id'] = $attribute_data->options_id;
                $temp_option['name'] = $option_name[0]->products_options_name;
                $attr[$index2]['option'] = $temp_option;
                // fetch all attributes add join from products_options_values table for option value name
                $attributes_value_query = DB::table('products_attributes')
                ->where('products_id', '=', $products_id)
                ->where('options_id', '=', $attribute_data->options_id)
                ->get();
                foreach($attributes_value_query as $products_option_value){
                    $option_value = DB::table('products_options_values')
                    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                    ->where('products_options_values_descriptions.language_id', '=', $language_id)
                    ->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)
                    ->get();
                    if(count($option_value)>0){
                        $attributes = DB::table('products_attributes')
                        ->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])
                        ->get();
                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                        $temp_i['id'] = $products_option_value->options_values_id;
                        $temp_i['value'] = $option_value[0]->products_options_values_name;
                        $temp_i['price'] = $products_option_value->options_values_price;
                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                        array_push($temp,$temp_i);
                    }

                }

                $attr[$index2]['values'] = $temp;
                $result['attributes'] = 	$attr;
                $index2++;

            }
        }

    }else{

        $result['attributes'] = 	array();

    }
      return $result;
  }

  public function ajax_attr($id){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $products_id      =   $id;
    $result = array();
    $message = array();
    $errorMessage = array();
    $result['currency'] = $myVarsetting->getSetting();
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

            $product =  $product->get();
    $result['products'] = $product;
    $products = $product;
    $result['message'] = $message;
    $result['errorMessage'] = $errorMessage;
    $result2 = array();
    $index = 0;
    $stocks = 0;
    $min_level = 0;
    $max_level = 0;
    $purchase_price  = 0;
    if($result['products'][0]->products_type!=1){

      $stocksin = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'in')->sum('stock');
      $stockOut = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'out')->sum('stock');
      $stocks = $stocksin - $stockOut;

          $manageLevel = DB::table('manage_min_max')->where('products_id', $result['products'][0]->products_id)->get();
        if(count($manageLevel)>0){
            $min_level = $manageLevel[0]->min_level;
            $max_level = $manageLevel[0]->max_level;
        }

    }

    $result['purchase_price'] = $purchase_price;
    $result['stocks'] = $stocks;
    $result['min_level'] = $min_level;
    $result['max_level'] = $max_level;
    $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->get();
    $products_attribute = $products_attribute->unique('options_id')->keyBy('options_id');
    if(count($products_attribute)>0){
        $index2 = 0;
        foreach($products_attribute as $attribute_data){
          $option_name = DB::table('products_options')
              ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')
              ->where('products_options_descriptions.language_id', $language_id)
              ->where('products_options.products_options_id', $attribute_data->options_id)
              ->get();
            if(count($option_name)>0){

                $temp = array();
                $temp_option['id'] = $attribute_data->options_id;
                $temp_option['name'] = $option_name[0]->products_options_name;
                $temp_option['is_default'] = $attribute_data->is_default;
                $temp_option['options_required'] = $option_name[0]->options_required;
                $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                $attr[$index2]['option'] = $temp_option;
                // fetch all attributes add join from products_options_values table for option value name
                $attributes_value_query = DB::table('products_attributes')
                ->where('products_id', '=', $products_id)
                ->where('options_id', '=', $attribute_data->options_id)
                ->get();
                foreach($attributes_value_query as $products_option_value){
                    $option_value = DB::table('products_options_values')
                    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                    ->where('products_options_values_descriptions.language_id', '=', $language_id)
                    ->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)
                    ->get();
                    if(count($option_value)>0){
                        $attributes = DB::table('products_attributes')
                        ->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])
                        ->get();
                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                        $temp_i['id'] = $products_option_value->options_values_id;
                        $temp_i['value'] = $option_value[0]->products_options_values_name;
                        $temp_i['price'] = $products_option_value->options_values_price;
                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                        array_push($temp,$temp_i);
                    }

                }

                $attr[$index2]['values'] = $temp;
                $result['attributes'] = 	$attr;
                $index2++;

            }
        }

    }else{

        $result['attributes'] = 	array();

    }
      return $result;
  }

  public function ajax_min_max($id){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $products_id      =   $id;
    $result = array();
    $message = array();
    $errorMessage = array();
    $result['currency'] = $myVarsetting->getSetting();
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

            $product =  $product->get();
    $result['products'] = $product;
    $products = $product;
    $result['message'] = $message;
    $result['errorMessage'] = $errorMessage;
    $result2 = array();
    $index = 0;
    $stocks = 0;
    $min_level = 0;
    $max_level = 0;
    $purchase_price = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->sum('purchase_price');

    if($result['products'][0]->products_type!=1){

      $stocksin = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'in')->sum('stock');
      $stockOut = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->where('stock_type', 'out')->sum('stock');
      $stocks = $stocksin - $stockOut;

        $manageLevel = DB::table('manage_min_max')->where('products_id', $result['products'][0]->products_id)->get();
        if(count($manageLevel)>0){
            $min_level = $manageLevel[0]->min_level;
            $max_level = $manageLevel[0]->max_level;
        }

    }

    $result['purchase_price'] = $purchase_price;
    $result['stocks'] = $stocks;
    $result['min_level'] = $min_level;
    $result['max_level'] = $max_level;
    $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->get();
    $products_attribute = $products_attribute->unique('options_id')->keyBy('options_id');
    if(count($products_attribute)>0){
        $index2 = 0;
        foreach($products_attribute as $attribute_data){
          $option_name = DB::table('products_options')
              ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
              ->where('products_options_descriptions.language_id', $language_id)
              ->where('products_options.products_options_id', $attribute_data->options_id)
              ->get();
            if(count($option_name)>0){

                $temp = array();
                $temp_option['id'] = $attribute_data->options_id;
                $temp_option['name'] = $option_name[0]->products_options_name;
                $attr[$index2]['option'] = $temp_option;
                // fetch all attributes add join from products_options_values table for option value name
                $attributes_value_query = DB::table('products_attributes')
                ->where('products_id', '=', $products_id)
                ->where('options_id', '=', $attribute_data->options_id)
                ->get();
                foreach($attributes_value_query as $products_option_value){
                    $option_value = DB::table('products_options_values')
                    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                    ->where('products_options_values_descriptions.language_id', '=', $language_id)
                    ->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)
                    ->get();
                    if(count($option_value)>0){
                        $attributes = DB::table('products_attributes')
                        ->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])
                        ->get();
                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                        $temp_i['id'] = $products_option_value->options_values_id;
                        $temp_i['value'] = $option_value[0]->products_options_values_name;
                        $temp_i['price'] = $products_option_value->options_values_price;
                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                        array_push($temp,$temp_i);
                    }

                }

                $attr[$index2]['values'] = $temp;
                $result['attributes'] = 	$attr;
                $index2++;

            }
        }

    }else{

        $result['attributes'] = 	array();

    }
      return $result;
  }

  public function addinventoryfromsidebar(){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $result = array();
    $message = array();
    $errorMessage = array();
    $result['currency'] = $myVarsetting->getSetting();
    $product = DB::table('products')
                ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                ->LeftJoin('specials', function ($join) {

                    $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

                })
                ->select('products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_id', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
                ->where('products.products_type', '!=', '3')->where('products.products_type', '!=', '4')
                ->where('products_description.language_id', '=', $language_id);

    $product =  $product->get();
    $result['products'] = $product;
    $products = $product;
    $result['message'] = $message;
    $result['errorMessage'] = $errorMessage;
    $result2 = array();
    $index = 0;
    $stocks = 0;
    $min_level = 0;
    $max_level = 0;
    $purchase_price  = 0;
    if(count($product)>0){
        $products_id = $result['products'][0]->products_id;
    if($result['products'][0]->products_type!=1){

      $currentStocks = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->get();
      $purchase_price = DB::table('inventory')->where('products_id', $result['products'][0]->products_id)->sum('purchase_price');

        if(count($currentStocks)>0){
            foreach($currentStocks as $currentStock){
                $stocks += $currentStock->stock;
            }
        }

          $manageLevel = DB::table('manage_min_max')->where('products_id', $result['products'][0]->products_id)->get();
        if(count($manageLevel)>0){
            $min_level = $manageLevel[0]->min_level;
            $max_level = $manageLevel[0]->max_level;
        }

    }

    $result['purchase_price'] = $purchase_price;
    $result['stocks'] = $stocks;
    $result['min_level'] = $min_level;
    $result['max_level'] = $max_level;
    $products_attribute = DB::table('products_attributes')->where('products_id', '=', 1)->get();
    $products_attribute = $products_attribute->unique('options_id')->keyBy('options_id');
    if(count($products_attribute)>0){
        $index2 = 0;
        foreach($products_attribute as $attribute_data){
          $option_name = DB::table('products_options')
              ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
              ->where('products_options_descriptions.language_id', $language_id)
              ->where('products_options.products_options_id', $attribute_data->options_id)
              ->get();
            if(count($option_name)>0){

                $temp = array();
                $temp_option['id'] = $attribute_data->options_id;
                $temp_option['name'] = $option_name[0]->products_options_name;
                $attr[$index2]['option'] = $temp_option;
                // fetch all attributes add join from products_options_values table for option value name
                $attributes_value_query = DB::table('products_attributes')
                ->where('products_id', '=', $products_id)
                ->where('options_id', '=', $attribute_data->options_id)
                ->get();
                foreach($attributes_value_query as $products_option_value){
                    $option_value = DB::table('products_options_values')
                    ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                    ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                    ->where('products_options_values_descriptions.language_id', '=', $language_id)
                    ->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)
                    ->get();
                    if(count($option_value)>0){
                        $attributes = DB::table('products_attributes')
                        ->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])
                        ->get();
                        $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                        $temp_i['id'] = $products_option_value->options_values_id;
                        $temp_i['value'] = $option_value[0]->products_options_values_name;
                        $temp_i['price'] = $products_option_value->options_values_price;
                        $temp_i['price_prefix'] = $products_option_value->price_prefix;
                        array_push($temp,$temp_i);
                    }
                }

                $attr[$index2]['values'] = $temp;
                $result['attributes'] = 	$attr;
                $index2++;

            }
        }

    }else{
        $result['attributes'] = 	array();
    }

    }else{
        $result['attributes'] = 	array();
    }

      return $result;
  }


  
  public function addnewstock($request){
    $products_id = $request->products_id;
    if($request->stock_type === "out"){
        if(($request->current_stocks_input - $request->stock ) < 0 ){
            // dd($request->current_stocks_input - $request->stock);
            return false;
        }
    }
    $language_id     =   1;
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

            $product =  $product->get();
            $products = $product;
            $date_added	= date('Y-m-d h:i:s');
            $inventory_ref_id = DB::table('inventory')->insertGetId([
                'products_id' => $products_id,
                'reference_code' => $request->reference_code != "" ? $request->reference_code :"no  refrence",
                'stock' => $request->stock,
                'admin_id' => auth()->user()->id,
                'created_at' => $date_added,
                'purchase_price' => $request->purchase_price,
                'stock_type'  	=>  $request->stock_type

            ]);
            

            if($inventory_ref_id) {

                $emailcheck = DB::table('notify')->where('products_id', $products_id)->get();
               
                $notify_product = DB::table('products')->where('products_id', $products_id)->first();
                 
                foreach($emailcheck as $email_sub){
                  
                    $order_email = DB::table('settings')->where('id', '=','71')->first();
                    $app_name = DB::table('settings')->where('id', '=','19')->first();
                    $website_logo = DB::table('settings')->where('id', '=','16')->first();
                    $api_key = DB::table('settings')->where('id', '=','123')->first();
                    $domain = DB::table('settings')->where('id', '=','124')->first();
                    $website_link = DB::table('settings')->where('id', '=','103')->first();
                    $imgurl = $website_logo->value;
                    $product_link = $website_link->value.'product-detail/'.$notify_product->products_slug;


                    $product_image_ids = DB::table('products')->where('products_id', $products_id)->first();

                    $product_names = DB::table('products_description')->where('language_id', 1)->where('products_id', $products_id)->first();
                    $product_name = $product_names->products_name;

                    $product_image_id = $product_image_ids->products_image;

                    $product_image = DB::table('image_categories')->where('image_type', 'ACTUAL')->where('image_id', $product_image_id)->first();
                    $image_path = $product_image->path;

                    

                    $proimgurl = $image_path;

                  
                    $title = 'Product Available';

                    $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;"><img style="width:200px" src="'.$imgurl .'" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"><p style="text-align:center;">Your Required Product Available now</p><h2 style="text-align:center;">'.$product_name.'</h2><div style="text-align:center;"><img src="'.$proimgurl .'" alt="'.$app_name->value.'" style="width:400px"></div><br><br><div style="width: 100%;text-align:center;"><a href="'.$product_link.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Product</b></a></div></div></div>';


                    $subject = $title;
                    $MailData            = array();
                    $api_key             = $api_key->value;
                    $domain              = $domain->value;
                    $MailData['from']    = $app_name->value. "<".$order_email->value.">";
                    $MailData['to']      = $email_sub->notify_email;
                    //$MailData['to']      = 'sakthi@platinumcode.com.my';
                    $MailData['subject'] = $title;
                    $MailData['html'] =  $html;
            
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

                DB::table('notify')->where('products_id', $products_id)->delete();
                
            }
        



            if($products[0]->products_type==1){
                foreach($request->attributeid as $attribute){
                    if(!empty($attribute)){
                    DB::table('inventory_detail')->insert([
                        'inventory_ref_id' => $inventory_ref_id,
                        'products_id' => $products_id,
                        'attribute_id' => $attribute,
                    ]);
                    }
                }
            }
            return true;
  }

  public function addminmax($request){

    $products_id = $request->products_id;

    $language_id     =   1;
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
            $product =  $product->get();

            $products = $product;
    if($products[0]->products_type==1){
        $inventory_ref_id = $request->inventory_ref_id;
    }else{
        $inventory_ref_id = 0;
    }



    $checkExist = DB::table('manage_min_max')
                    ->where('products_id', $products_id)
                    ->where('inventory_ref_id', $inventory_ref_id)
                    ->get();
    if(count($checkExist)==0){
      $manageMaxandMin = DB::table('manage_min_max')->insertGetId([
          'products_id' => $products_id,
          'min_level' => $request->min_level,
          'max_level' => $request->max_level,
          'inventory_ref_id' => $inventory_ref_id,
      ]);

    $stocksin = DB::table('inventory')->where('products_id', $request->products_id)->where('stock_type', 'in')->sum('stock');
    $stockOut = DB::table('inventory')->where('products_id', $request->products_id)->where('stock_type', 'out')->sum('stock');
    $stocks = $stocksin - $stockOut;
    $manageLevel = DB::table('manage_min_max')->where('min_max_id', $manageMaxandMin)->get();
    if(count($manageLevel)>0){
       
        $min_level = $manageLevel[0]->min_level;
        $max_level = $manageLevel[0]->max_level;
    }
    if((int)$stocks < (int)$min_level){
      
       DB::table('manage_min_max')->where('min_max_id', '=', $manageMaxandMin)->update(['is_seen' => 0 ]);
    }
    else
    {
      
       DB::table('manage_min_max')->where('min_max_id', '=', $manageMaxandMin)->update(['is_seen' => 1 ]);
    }
    
    }else{
      $minandmax = DB::table('manage_min_max')->where('products_id', $products_id)->update([
          'min_level' => $request->min_level,
          'max_level' => $request->max_level,
          'inventory_ref_id' => $inventory_ref_id,
      ]);

      $stocksin = DB::table('inventory')->where('products_id', $request->products_id)->where('stock_type', 'in')->sum('stock');
      $stockOut = DB::table('inventory')->where('products_id', $request->products_id)->where('stock_type', 'out')->sum('stock');
      $stocks = $stocksin - $stockOut;
      $manageLevel = DB::table('manage_min_max')->where('products_id', $request->products_id)->get();
      $minmaxid = DB::table('manage_min_max')->where('products_id', $request->products_id)->first();
      if(count($manageLevel)>0){
         
          $min_level = $manageLevel[0]->min_level;
          $max_level = $manageLevel[0]->max_level;
      }
      if((int)$stocks < (int)$min_level){
      
         DB::table('manage_min_max')->where('min_max_id', '=', $minmaxid->min_max_id)->update(['is_seen' => 0 ]);
      }
      else
      {
      
         DB::table('manage_min_max')->where('min_max_id', '=', $minmaxid->min_max_id)->update(['is_seen' => 1 ]);
      }
    }

  }

  public function displayProductImages($request){
    $products_id = $request->id;
    $result['data'] = array('products_id'=>$products_id);
    $products_images = DB::table('products_images')
        ->LeftJoin('image_categories', function ($join) {
            $join->on('image_categories.image_id', '=', 'products_images.image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });

        })
        ->where('products_id', '=', $products_id)
        ->select('products_images.*', 'image_categories.path')
        ->orderBy('sort_order', 'asc')
        ->get();
    $result['products_images'] = $products_images;
    return $result;
  }

  public function addProductImages($products_id){
    $result['data'] = array('products_id'=>$products_id);
    $products_images = DB::table('products_images')
        ->where('products_id','=', $products_id)
        ->orderBy('sort_order', 'ASC')
        ->get();
    $result['products_images'] = $products_images;
    return $result;
  }

  public function insertProductImages($request){
    $product_id = $request->products_id;

         if($request->image_id !== null){
             $image = $request->image_id;
         }else{
             $image = '';
         }

          
         // $sort_id = DB::table('products_images')
         //               ->where('products_id',$product_id)
         //               ->select('sort_order')
         //               ->orderBy('id', 'desc')
         //               ->first();

         // if($sort_id == null){
         //     $sort_order = 1;
         // }else{
         // $sort_order = $sort_id->sort_order+1;
         // }
         if(!empty($image))
         {
          foreach ($image as $jesnewimage) {
            $count = DB::table('products_images')->where('products_id', '=', $product_id)->count();
            $new_count=$count+1;
            DB::table('products_images')->insert([
              'products_id' => $product_id,
              'image' => $jesnewimage,
              'htmlcontent' => $request->htmlcontent,
              'sort_order' => $new_count
          ]);
          }
         }
         // DB::table('products_images')->insert([
         //     'products_id' => $product_id,
         //     'image' => $image,
         //     'htmlcontent' => $request->htmlcontent,
         //     'sort_order' => $sort_order,
         // ]);

       return $product_id;
  }

  public function editProductImages($id){

    $products_images = DB::table('products_images')
        ->LeftJoin('image_categories', function ($join) {

            $join->on('image_categories.image_id', '=', 'products_images.image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });

        })
        ->where('products_images.id', '=', $id)
        ->select('products_images.*', 'image_categories.path')
        ->get();

        return $products_images;
  }

  public function updateproductimage($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);


        if($request->image_id !== null){
          $uploadImage = $request->image_id;
        }else{
          $uploadImage = $request->oldImage;
        }
        $product_id = $request->products_id;

      DB::table('products_images')->where('products_id', '=', $request->products_id)->where('id', '=', $request->id)
          ->update([
              'image' => $uploadImage,
              'htmlcontent' => $request->htmlcontent,
              'sort_order' => $request->sort_order,
          ]);

          $products_images = DB::table('products_images')
              ->LeftJoin('image_categories', function ($join) {

                  $join->on('image_categories.image_id', '=', 'products_images.image')
                      ->where(function ($query) {
                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                      });

            })
              ->where('products_id', '=', $request->products_id)
              ->select('products_images.*', 'image_categories.path')
              ->orderBy('sort_order', 'ASC')
              ->get();
      $result['products_images'] = $products_images;
      return $result;
  }

  public function deleteproductimage($request){
        DB::table('products_images')
        ->where('products_id', '=', $request->products_id)->where('id', '=', $request->id)
        ->delete();
  }

  public function addproductattribute($request){
    $language_id = 1;
    $products_id      =   $request->id;
    $subcategory_id   =   $request->subcategory_id;
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $result['languages'] = $myVarsetting->getLanguages();
    $options = DB::table('products_options')
    ->leftjoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
    ->where('products_options_descriptions.language_id', '=', $language_id)
    ->get();
    $result['options'] = $options;
    $result['subcategory_id'] = $subcategory_id;
    $options_value = DB::table('products_options_values')->get();
    $result['options_value'] = $options_value;
    $result['data'] = array('products_id'=>$products_id);
    $products_attributes = DB::table('products_attributes')
        ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
        ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')
        ->select('products_attributes.*', 'products_options_descriptions.options_name', 'products_options_values_descriptions.options_values_name')
        ->where('products_attributes.products_id', '=', $products_id)
        ->where('products_options_descriptions.language_id', '=', $language_id)
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->orderBy('products_attributes_id', 'DESC')
        ->get();
    $result['products_attributes'] = $products_attributes;

    return $result;
  }

  public function addnewdefaultattribute($request){
    $language_id = 1;
    $products_attributes = '';
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    if(!empty($request->products_options_id) and !empty($request->products_id) and !empty($request->products_options_values_id)){
      $checkRecord = DB::table('products_attributes')->where([
          'options_id' => $request->products_options_id,
          'products_id' => $request->products_id,
          'options_values_id' => $request->products_options_values_id,
      ])->get();
        if(count($checkRecord)>0){
            $products_attributes = 'already';
        }else{

            $special_pro = DB::table('specials')->where([
                'products_id' => $request->products_id,
                'status' => 1,
            ])->first();
            if($special_pro != '')
            {
                $sp_type = $special_pro->special_type;
                $sp_new_pro_price = $special_pro->specials_new_products_price;
                $sp_price = $special_pro->special_price;
            }
            else
            {
                $sp_type = 0;
                $sp_new_pro_price = 0;
                $sp_price = 0;
            }

            $options=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();

          $products_attributes_id = DB::table('products_attributes')->insertGetId([
              'products_id' => $request->products_id,
              'options_id' => $request->products_options_id,
              'options_values_id' => $request->products_options_values_id,
              'options_values_price' => '0',
              'price_prefix' => '+',
              'weight' => $request->products_weight,
              'weight_unit' => $request->products_weight_unit,
              'special_type' =>$sp_type,
                'special_price' => $sp_new_pro_price,
                'special_discount' => $sp_price,
              'is_default' => $request->is_default,
              'options_required'=>$options->options_required,
              'options_select_type'=>$options->options_select_type,
              'quantity_type'=> $request->dequt_type,
              'quantity_count'=> $request->dequnt_count
          ]);

           $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
           $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
           $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();
           if(!empty($request->option_sku)){
             $sku = $request->option_sku;
           }else{
             $sku = $myVarsetting->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$products_attributes_id);
           }

           // update sku
            DB::table('products_attributes')->where('products_attributes_id', '=', $products_attributes_id)->update([
                'attributes_sku' => $sku
            ]);

            // add remaining attributes
            // $value = DB::table('products_options_values')
            // ->where('products_options_values.products_options_id', '=', $request->products_options_id)
            // ->get();

            // //print_r($value);die();

            // if (count($value) > 0) {
            //     foreach ($value as $jesvalue) {
            //         if($jesvalue->products_options_values_id != $request->products_options_values_id){

            //             $products_attributes_id = DB::table('products_attributes')->insertGetId([
            //                 'products_id' => $request->products_id,
            //                 'options_id' => $request->products_options_id,
            //                 'options_values_id' => $jesvalue->products_options_values_id,
            //                 'options_values_price' => '0',
            //                 'price_prefix' => '+',
            //                 'weight' => $request->products_weight,
            //                 'weight_unit' => $request->products_weight_unit,
            //                 'special_type' => $sp_type,
            //                 'special_price' => $sp_new_pro_price,
            //                 'special_discount' => $sp_price,
            //                 'is_default' => '0',
            //                 'options_required'=>$options->options_required,
            //                 'options_select_type'=>$options->options_select_type,
            //                    'quantity_type'=> $request->dequt_type,
            //                    'quantity_count'=> $request->dequnt_count
            //             ]);


            //             // update sku
            //                 $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
            //                 $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
            //                 $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $jesvalue->products_options_values_id)->first();

            //                 if(!empty($request->option_sku)){
            //                      $sku = $request->option_sku.$products_attributes_id;
            //                 }else{
            //                     $sku = $myVarsetting->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$products_attributes_id);
            //                 }

            //            // update sku
            //             DB::table('products_attributes')->where('products_attributes_id', '=', $products_attributes_id)->update([
            //                 'attributes_sku' => $sku
            //             ]);


            //         } 
            //     }
            // }

          $products_attributes = DB::table('products_attributes')
              ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
              ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
              ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
              ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
              ->where('products_options_descriptions.language_id', '=', $language_id)
              ->where('products_options_values_descriptions.language_id', '=', $language_id)
              ->where('products_attributes.products_id', '=', $request->products_id)
              ->where('products_attributes.is_default', '=', '1')
              ->orderBy('products_attributes_id', 'DESC')
              ->get();
        }
    }else{
        $products_attributes = 'empty';
    }

    return $products_attributes;
  }

  public function editdefaultattribute($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $languages = $myVarsetting->getLanguages();

    $products_id = $request->products_id;
    $products_attributes_id = $request->products_attributes_id;
    $language_id = 1;
    $options_id = $request->options_id;
    $options = DB::table('products_options')
        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
        ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
        ->where('products_options_descriptions.language_id', '=', $language_id)
        ->get();
    $result['options'] = $options;
    $options_value = DB::table('products_options_values')
        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
        ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->where('products_options_values.products_options_id', '=', $options_id)
        ->get();
    $result['options_value'] = $options_value;
    $result['data'] = array('products_id'=>$request->products_id, 'products_attributes_id'=>$products_attributes_id, 'language_id'=>$language_id);
    $products_attributes = DB::table('products_attributes')
        ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
        ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
        ->where('products_options_descriptions.language_id', '=', $language_id)
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->where('products_attributes.products_attributes_id', '=', $products_attributes_id)
        ->get();
    $result['products_attributes'] = $products_attributes;
    $result['languages'] = $languages;
    return $result;
  }

  public function updatedefaultattribute($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    if(!empty($request->products_options_id) and !empty($request->products_id) and !empty($request->products_options_values_id)){
        $language_id = 1;
        $checkRecord = DB::table('products_attributes')->where([
            'options_id' => $request->products_options_id,
            'options_values_id' => $request->products_options_values_id,
            'products_id' => $request->products_id
        ])->get();
        $special_pro = DB::table('specials')->where([
            'products_id' => $request->products_id,
            'status' => 1,
        ])->first();
        if($special_pro != '')
        {
            $sp_type = $special_pro->special_type;
            $sp_new_pro_price = $special_pro->specials_new_products_price;
            $sp_price = $special_pro->special_price;
        }
        else
        {
            $sp_type = 0;
            $sp_new_pro_price = 0;
            $sp_price = 0;
        }

        $options=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
        $productsattri = DB::table('products_attributes')->where('products_attributes_id', '=', $request->products_attributes_id)->update([
            'options_id' => $request->products_options_id,
            'options_values_id' => $request->products_options_values_id,            
            'options_values_price' => 0,
            'price_prefix' => '+',
            'weight' => $request->products_weight,
            'weight_unit' => $request->products_weight_unit,
            'special_type' =>$sp_type,
            'special_price' => $sp_new_pro_price,
            'special_discount' => $sp_price,
            'options_required'=>$options->options_required,
            'options_select_type'=>$options->options_select_type,

        ]);
        $products_attributes = DB::table('products_attributes')
            ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
            ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
            ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
            ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
            ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
            ->where('products_options_descriptions.language_id', '=', $language_id)
            ->where('products_options_values_descriptions.language_id', '=', $language_id)
            ->where('products_attributes.products_id', '=', $request->products_id)
            ->where('products_attributes.is_default', '=', '1')
            ->orderBy('products_attributes_id', 'DESC')
            ->get();
    }else{
        $products_attributes = 'empty';
    }
    return $products_attributes;
  }

  public function deletedefaultattribute($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);

              $language_id      =   '1';
              $checkRecord = DB::table('products_attributes')->where([
                  'products_attributes_id' => $request->products_attributes_id,
                  'products_id' => $request->products_id
              ])->delete();
              $products_attributes = DB::table('products_attributes')
                  ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                  ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                  ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                  ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                  ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                  ->where('products_options_descriptions.language_id', '=', $language_id)
                  ->where('products_options_values_descriptions.language_id', '=', $language_id)
                  ->where('products_attributes.products_id', '=', $request->products_id)
                  ->where('products_attributes.is_default', '=', '1')
                  ->orderBy('products_attributes_id', 'DESC')
                  ->get();
                  return $products_attributes;
  }

  public function showoptions($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);

            if(!empty($request->products_options_id) and !empty($request->products_id) and !empty($request->products_options_values_id) and isset($request->options_values_price)){
              $checkRecord = DB::table('products_attributes')->where([
                  'options_id' => $request->products_options_id,
                  'options_values_id' => $request->products_options_values_id,
                  'products_id' => $request->products_id
              ])->get();
                if(count($checkRecord)>0){
                    $products_attributes = '';
                }else{

                    $pr_price = DB::table('products')->where([
                        'products_id' => $request->products_id
                    ])->first();

                    $or_price = $pr_price->products_price;
                    if($request->price_prefix == '+')
                    {
                        $or_total = $or_price + $request->options_values_price;
                    }
                    else
                    {
                        $or_total = $or_price - $request->options_values_price;
                    }
                   

                   
                    if($request->specialtype == 1)
                    {
                        $special_price = $or_total - $request->special_price;
                    }
                    else
                    {
                        $special_price = ($or_total * $request->special_price) / 100; 
                        $special_price = $or_total - $special_price;
                    }
                    

                    $language_id = 1;
                    $options=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
                    $products_attributes_id = DB::table('products_attributes')->insertGetId([
                        'products_id' => $request->products_id,
                        'options_id' => $request->products_options_id,
                        'options_values_id' => $request->products_options_values_id,
                        'options_values_price' => $request->options_values_price,
                        'price_prefix' => $request->price_prefix,
                        'weight' => $request->products_weight,
                        'weight_unit' => $request->products_weight_unit,
                        'special_type' => $request->specialtype,
                        'special_price' => $special_price,
                        'special_discount' => $request->special_price,
                        'is_default' => $request->is_default,
                        'options_required'=>$options->options_required,
                        'options_select_type'=>$options->options_select_type,
                        'quantity_type'=> $request->addqut_type,
                        'quantity_count'=> $request->addqunt_count,
                    ]);

                    $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
           $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
           $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();
           if(!empty($request->addoption_sku)){
             $sku = $request->addoption_sku;
           }else{
             $sku = $myVarsetting->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$products_attributes_id);
           }

           // update sku
            DB::table('products_attributes')->where('products_attributes_id', '=', $products_attributes_id)->update([
                'attributes_sku' => $sku
            ]);
            
                    $products_attributes = DB::table('products_attributes')
                        ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                        ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
                        ->where('products_options_descriptions.language_id', '=', $language_id)
                        ->where('products_options_values_descriptions.language_id', '=', $language_id)
                        ->where('products_attributes.products_id', '=', $request->products_id)
                        ->where('products_attributes.is_default', '=', '0')
                        ->orderBy('products_attributes_id', 'DESC')
                        ->get();
                }
            }else{
                $products_attributes = 'empty';
            }

            return $products_attributes;
  }

  public function editoptionform($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
          $languages = $myVarsetting->getLanguages();
          $products_id = $request->products_id;
          $products_attributes_id = $request->products_attributes_id;
          $language_id = $request->language_id;
          $options_id = $request->options_id;
          $languages = $myVarsetting->getLanguages();

          $products_id = $request->products_id;
          $products_attributes_id = $request->products_attributes_id;
          $language_id = 1;
          $options_id = $request->options_id;
          $options = DB::table('products_options')
              ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id')
              ->where('products_options_descriptions.language_id', '=', $language_id)
              ->get();
          $result['options'] = $options;
          $options_value = DB::table('products_options_values')
              ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
              ->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
              ->where('products_options_values_descriptions.language_id', '=', $language_id)
              ->where('products_options_values.products_options_id', '=', $options_id)
              ->get();
          $result['options_value'] = $options_value;
          $is_special = DB::table('products')->where([
            'products_id' => $request->products_id
        ])->first();
    
          $result['data'] = array('products_id'=>$request->products_id, 'products_attributes_id'=>$products_attributes_id, 'is_special'=>$is_special->is_special,'language_id'=>$language_id);
          $products_attributes = DB::table('products_attributes')
              ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
              ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
              ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
              ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
              ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
              ->where('products_options_descriptions.language_id', '=', $language_id)
              ->where('products_options_values_descriptions.language_id', '=', $language_id)
              ->where('products_attributes.products_attributes_id', '=', $products_attributes_id)
              ->get();
          $result['products_attributes'] = $products_attributes;
          $result['languages'] = $languages;
          return $result;
  }

  public function updateoption($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id = 1;
    $checkRecord = DB::table('products_attributes')->where([
        'options_id' => $request->products_options_id,
        'options_values_id' => $request->products_options_values_id,
        'products_id' => $request->products_id
    ])->get();
    $pr_price = DB::table('products')->where([
        'products_id' => $request->products_id
    ])->first();

    $or_price = $pr_price->products_price;
    if($request->price_prefix == '+')
    {
        $or_total = $or_price + $request->options_values_price;
    }
    else
    {
        $or_total = $or_price - $request->options_values_price;
    }
   
   
 
    if($request->special_type == 1)
    {
        $special_price = $or_total - $request->special_price;
    }
    else
    {
        $special_price = ($or_total * $request->special_price) / 100; 
        $special_price = $or_total - $special_price;
    }
    $options=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
    DB::table('products_attributes')->where('products_attributes_id', '=', $request->products_attributes_id)->update([
        'options_id' => $request->products_options_id,
        'options_values_id' => $request->products_options_values_id,
        'options_values_price' => $request->options_values_price,
        'price_prefix' => $request->price_prefix,
        'weight' => $request->products_weight,
        'weight_unit' => $request->products_weight_unit,
        'special_type' => $request->special_type,
        'special_price' => $special_price,
        'special_discount' => $request->special_price,
        'options_required'=>$options->options_required,
        'options_select_type'=>$options->options_select_type,
        'quantity_type'=> $request->addqut_type,
        'quantity_count'=> $request->addqunt_count,
    ]);
    $products_attributes = DB::table('products_attributes')
        ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
        ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
        ->where('products_options_descriptions.language_id', '=', $language_id)
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->where('products_attributes.products_id', '=', $request->products_id)
        ->where('products_attributes.is_default', '=', '0')
        ->orderBy('products_attributes_id', 'DESC')
        ->get();
        return $products_attributes;
  }

  public function deleteoption($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $language_id      =   '1';
    $checkRecord = DB::table('products_attributes')->where([
        'products_attributes_id' => $request->products_attributes_id,
        'products_id' => $request->products_id
    ])->delete();
    $products_attributes = DB::table('products_attributes')
        ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
        ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
        ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
        ->select('products_attributes.*', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')
        ->where('products_options_descriptions.language_id', '=', $language_id)
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->where('products_attributes.products_id', '=', $request->products_id)
        ->where('products_attributes.is_default', '=', '0')
        ->orderBy('products_attributes_id', 'DESC')
        ->get();

        return $products_attributes;
  }

  public function getOptionsValue($request){
    $language_id = 1;
    $value = DB::table('products_options_values')
        ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
        ->select('products_options_values_descriptions.*')
        ->where('products_options_values_descriptions.language_id', '=', $language_id)
        ->where('products_options_values.products_options_id', '=', $request->option_id)
        ->get();

    return $value;
  }


 

  public function currentstock($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $inventory_ref_id = array();
    $products_id = $request->products_id;
    $attributes = array_filter($request->attributeid);
    $attributeid = implode(',',$attributes);
    $postAttributes = count($attributes);

    // $inventory = DB::table('inventory')->where('products_id', $products_id)->where('stock_type', 'in')->get();
    $inventory = DB::table('inventory')->where('products_id', $products_id)->get();

    $reference_ids =array();
    $stockIn = 0;
    $purchasePrice = 0;
    $stockOut = 0;
    // dd($attributeid);
    foreach($inventory as $inventory){
        $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
        $totalAttributes = count($totalAttribute);

        if($postAttributes>$totalAttributes){
            $count = $postAttributes;
        }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
            $count = $totalAttributes;
        }

        $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
            ->selectRaw('inventory.*')
            ->whereIn('inventory_detail.attribute_id', [$attributeid])
            ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
            ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
            ->get();

        if(count($individualStock) > 0 ){
            if($individualStock[0]->stock_type == 'in'){
                $inventory_ref_id[] = $individualStock[0]->inventory_ref_id;
                $stockIn += $individualStock[0]->stock;
                $purchasePrice += $individualStock[0]->purchase_price;
            }
            if($individualStock[0]->stock_type == 'out'){
                $stockOut += $individualStock[0]->stock;
            }

        }
    }

    $options_names  = array();
    $options_values = array();
    foreach($attributes as $attribute){
      $productsAttributes = DB::table('products_attributes')
          ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
          ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
          ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
          ->where('products_attributes_id', $attribute)->get();
        $options_names[] = $productsAttributes[0]->options_name;
        $options_values[] = $productsAttributes[0]->options_values;
    }

    $options_names_count = count($options_names);
    $options_names = implode ( "','", $options_names);
    $options_names = "'" . $options_names . "'";
    $options_values = "'" . implode ( "','", $options_values ) . "'";
    $orders_products = DB::table('orders_products')->where('products_id', $products_id)->get();
    
    
    foreach($orders_products as $orders_product){
        $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
        $totalAttributes = count($totalAttribute);
        if($postAttributes>$totalAttributes){
            $count = $postAttributes;
        }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
            $count = $totalAttributes;
        }
        $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and `orders_products_attributes`.`orders_products_id`= '".$orders_product->orders_products_id."') = ".$count." and `orders_products`.`orders_products_id` = '".$orders_product->orders_products_id."' group by `orders_products_attributes`.`orders_products_id`");
        if(count($products)>0){
            $stockOut += $products[0]->products_quantity;
        }
    }
    
    $result = array();
    $result['purchasePrice'] = $purchasePrice;
    $result['remainingStock'] = $stockIn - $stockOut;

    if(count($inventory_ref_id) > 0){
        $inventory_ref_id = $inventory_ref_id;

        
        $minMax = DB::table('manage_min_max')->whereIn('inventory_ref_id', $inventory_ref_id)->where('products_id', $products_id)->get();
       
        if(count($minMax) > 0){
            $lastMinMax[]= $minMax[count($minMax) - 1];
            $minMax = $lastMinMax;
        }
           
       
        $inventory_ref_id = $inventory_ref_id[count($inventory_ref_id)-1];
        
        
    }else{
        $minMax = '';
    }
    // return $minMax;
    $result['inventory_ref_id'] = $inventory_ref_id;
    $result['products_id'] = $products_id;
    $result['minMax'] = $minMax;
    return $result;
  }

  /* sakthi 8-7-22 */

  public function getreportproduct(){
    $products = DB::table('products')->select('products.products_id', 'products_description.products_name','products.products_type','products.stock_status')
    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    ->where('products_description.language_id', '=', 1)
    ->where('products.cat_status', '=', 1)->get();

    return $products;

  }
  
  public function getterinv(){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $commonsetting = $myVarsetting->commonsetting();
    $myVaralter = new AlertController($setting);

    $language_id = '1';
    $categories_id = '';
    $product  = '';
    $results = array();
    $data = $this->sortable(['products_id'=>'ASC'])
        ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
        ->LeftJoin('manufacturers', function ($join) {
            $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
        })
        ->LeftJoin('specials', function ($join) {
            $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');
        })
        ->LeftJoin('image_categories', function ($join) {
            $join->on('image_categories.image_id', '=', 'products.products_image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });
        });

  //  if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id']) or !empty(session('categories_id'))) {

        $data->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id');

  //  }

    $data->select('products.*', 'products_description.*', 'specials.specials_id', 'manufacturers.*', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date', 'image_categories.path as path',
    'products.updated_at as productupdate', 'categories_description.categories_id', 'categories_description.categories_name')
        ->where('products_description.language_id', '=', $language_id)
        ->where('categories_description.language_id', '=', $language_id);

    if (isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])) {
        if (!empty(session('categories_id'))) {
            $cat_array = explode(',', session('categories_id'));
            $data->whereIn('products_to_categories.categories_id', '=', $cat_array);
        }

        $data->where('products_to_categories.categories_id', '=', $_REQUEST['categories_id']);

        if (isset($_REQUEST['product']) and !empty($_REQUEST['product'])) {
            $data->where('products_name', 'like', '%' . $_REQUEST['product'] . '%');
        }

        $products = $data->orderBy('products.products_id', 'DESC')->paginate(10);

    } else {

        if (!empty(session('categories_id'))) {
            $cat_array = explode(',', session('categories_id'));
            $data->whereIn('products_to_categories.categories_id', $cat_array);
        }
        $products = $data->orderBy('products.products_id', 'DESC')
        ->groupBy('products.products_id')->get();
    }

    

    return $products;
}


public function displayProductVideos($request){
    $products_id = $request->id;
    $result['data'] = array('product_id'=>$products_id);
    $products_video = DB::table('product_video')
    ->LeftJoin('image_categories', function ($join) {
        $join->on('image_categories.image_id', '=', 'product_video.image_id')
            ->where(function ($query) {
                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
            });
        })
        ->where('product_id', '=', $products_id)
        ->select('product_video.*','image_categories.path as path')
        ->orderBy('sort_order', 'asc')
        ->get();
    $result['products_videos'] = $products_video;
    return $result;
  }

  public function addProductVideos($product_id){
    $result['data'] = array('product_id'=>$product_id);
    $product_video = DB::table('product_video')
        ->where('product_id','=', $product_id)
        ->orderBy('sort_order', 'ASC')
        ->get();
    $result['products_videos'] = $product_video;
    return $result;
  }

  public function getYoutubeVideoId($iframeCode) {
  
    // Extract video url from embed code
    return preg_replace_callback('/<iframe\s+.?\s+src=(".?").*?<\/iframe>/', function ($matches) {
        // Remove quotes
        $youtubeUrl = $matches[1];
        $youtubeUrl = trim($youtubeUrl, '"');
        $youtubeUrl = trim($youtubeUrl, "'");
        // Extract id
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $videoId);
        return $youtubeVideoId = isset($videoId[1]) ? $videoId[1] : "";
        print($youtubeVideoId);die();
    }, $iframeCode);

}

  public function insertProductVideos($request){
    $product_id = $request->product_id;
    $count = DB::table('product_video')->where('product_id', '=', $product_id)->count();
    $new_count=$count+1;
       
    $video_ids = explode("embed/", $request->products_video_link);
    $video_ids = $video_ids[1];
    $video_id = explode(" title=", $video_ids);
    $video_id = $video_id[0];

    $youtube_id = rtrim($video_id, '"');

    DB::table('product_video')->insert([
        'product_id' => $product_id,
        'video_link' => $request->products_video_link,
        'image_id'   =>   $request->image_id,
        'youtube_id'   =>   $youtube_id,
        'sort_order' => $new_count
    ]);
       return $product_id;
  }

  public function editProductVideos($id){

    $products_videos = DB::table('product_video')
    ->LeftJoin('image_categories', function ($join) {
        $join->on('image_categories.image_id', '=', 'product_video.image_id')
            ->where(function ($query) {
                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
            });
        })
    ->select('product_video.*','image_categories.path as path')
    ->where( 'product_video.id', $id )
    ->first();


        return $products_videos;
  }


  public function updateproductvideo($request){
    $video_ids = explode("embed/", $request->products_video_link);
    $video_ids = $video_ids[1];
    $video_id = explode(" title=", $video_ids);
    $video_id = $video_id[0];

    $youtube_id = rtrim($video_id, '"');

    if($request->image_id==null){

        $uploadImage = $request->oldImage;

    }else{

        $uploadImage = $request->image_id;
    }
  
     $result = DB::table('product_video')->where('product_id', '=', $request->product_id)->where('id', '=', $request->id)
          ->update([
              'video_link' => $request->products_video_link,
              'sort_order' => $request->sort_order,
              'image_id'   =>   $uploadImage,
                'youtube_id'   =>   $youtube_id,
          ]);
          
      return $result;
  }

  public function deleteproductvideorecord($request){
        DB::table('product_video')->where('id', $request->id)->delete();
  }

  public function sku_already_check($request){
    $allvals=DB::table('products')->where('product_sku','=', $request->products_sku)
                ->where('products_id','!=', $request->id)
                ->select('product_sku')
                ->first();
    if(empty($allvals)) {
        $result='0';
        return $result;
    }else{
        $result='1';
        return $result;
    }
  }

  public function check_product_sku($request){
         $allvals=DB::table('products')->where('product_sku','=', $request->products_sku)
                ->select('product_sku')
                ->first();
        if(empty($allvals)) {
            $result='0';
            return $result;
        }else{
            $result='1';
            return $result;
        }
  }



  /// PAZHANI Add

  public function ajaxAttribute($request){
    
    $attribute = DB::table('products_attributes')
    ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
    ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
    ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name','products_attributes.options_required')
    ->where('products_options_descriptions.language_id', 1)
    ->where('products_attributes.products_id', $request->proID)
    ->groupBy('products_options_descriptions.products_options_id')
    ->get();
    $result['attribute'] = $attribute;

    return $result;

  }


  public function ajaxAttributeValue($request){

    $attributeValue = DB::table('products_attributes')
    ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
    ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
    ->where('products_attributes.products_id', $request->proID)
    ->where('products_options_values.products_options_id', $request->proOPTID)
    ->groupBy('products_options_values.products_options_values_id')
    ->get();

    $result['attributeValue'] = $attributeValue;

    return $result;

  }



  public function ajaxProduct($request){

    $product = DB::table('products')
    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
    ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
    ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
    ->where('products_description.language_id', '=', 1)
    ->where('categories_description.language_id', '=', 1)
    ->whereIn('products.products_type',[0,1])
    ->where('products_status', '1')
    ->where('categories.categories_id', $request->catID)
    ->orderBy('products.products_id', 'DESC')->get();

    $result['product'] = $product;

    return $result;

  }


  public function deleterecordMultiple($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $products_id = $request->product_id;

    foreach(explode(',', $products_id) as $proid){

        $categories = DB::table('products_to_categories')->where('products_id', $proid)->delete();
        $categories = DB::table('products')->where('products_id', $proid)->delete();
        $categories = DB::table('specials')->where('products_id', $proid)->delete();
        $categories = DB::table('products_description')->where('products_id', $proid)->delete();
        $categories = DB::table('products_attributes')->where('products_id', $proid)->delete();
        $categories = DB::table('flash_sale')->where('products_id', $proid)->delete();
        $categories = DB::table('liked_products')->where('liked_products_id', $proid)->delete();
        $categories = DB::table('product_combo')->where('pro_id', $proid)->delete();
        $categories = DB::table('product_buy_x')->where('pro_id', $proid)->delete();
        $categories = DB::table('product_get_x')->where('pro_id', $proid)->delete();

    }
    return "success";
  }

  public function statusMultiple($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $products_id = $request->product_id;

    foreach(explode(',', $products_id) as $proid){

       
        $categories = DB::table('products')->where('products_id', $proid)->update([
            'products_status'=> $request->product_status
        ]);  
        $categories = DB::table('product_combo')->where('product_id', $proid)->update([
            'status'=> $request->product_status
        ]);  
        $categories = DB::table('product_buy_x')->where('product_id', $proid)->update([
            'status'=> $request->product_status
        ]);  
        $categories = DB::table('product_get_x')->where('product_id', $proid)->update([
            'status'=> $request->product_status
        ]);  

    }

    return "success";
  }


  public function cloneProduct($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);

    $products_id = $request->product_id;

    foreach(explode(',', $products_id) as $proid){

        $product = DB::table('products')->where('products_id', $proid)->first();  
        $productDescription = DB::table('products_description')->where('products_id', $proid)->get();
        $procat = DB::table('products_to_categories')->where('products_id', $proid)->get();  
        $productAttribute = DB::table('products_attributes')->where('products_id', $proid)->get();
        $special = DB::table('specials')->where('products_id', $proid)->orderBy('specials_id','DESC')->first();  
        $flash = DB::table('flash_sale')->where('products_id', $proid)->orderBy('flash_sale_id','DESC')->first();
        $like = DB::table('liked_products')->where('liked_products_id', $proid)->first();
        $combo = DB::table('product_combo')->where('pro_id', $proid)->first();
        $buyx = DB::table('product_buy_x')->where('pro_id', $proid)->first();
        $getx = DB::table('product_get_x')->where('pro_id', $proid)->first();

        if(!empty($product)){
            $product = DB::table('products')->insertGetId([
                'products_quantity' => $product->products_quantity,
                'products_model' => $product->products_model,
                'products_image'=> $product->products_image,
                'products_video_link'=> $product->products_video_link,
                'products_price'=> $product->products_price,
                'products_filter_price'=> $product->products_filter_price,
                'cost_price'=> $product->cost_price,
                'products_date_added'=> $product->products_date_added,
                'products_last_modified'=> $product->products_last_modified,
                'products_date_available'=> $product->products_date_available,
                'products_weight'=> $product->products_weight,
                'products_weight_unit'=> $product->products_weight_unit,
                'special_type'=> $product->special_type,
                'special_price'=> $product->special_price,
                'products_status'=> $product->products_status,
                'is_current'=> $product->is_current,
                'products_tax_class_id'=> $product->products_tax_class_id,
                'manufacturers_id'=> $product->manufacturers_id,
                'products_ordered'=> $product->products_ordered,
                'products_liked'=> $product->products_liked,
                'low_limit'=> $product->low_limit,
                'is_feature'=> $product->is_feature,
                'is_special'=> $product->is_special,
                'products_slug'=> $product->products_slug.'-1',
                'products_type'=> $product->products_type,
                'products_min_order'=> $product->products_min_order,
                'products_max_stock'=> $product->products_max_stock,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
                'cat_status'=> $product->cat_status,
                'button_type'=> $product->button_type,
                'product_sku'=> $product->product_sku.'-1',
                'product_serve'=> $product->product_serve,
                'product_view'=> $product->product_view,
                'stock_status'=> $product->stock_status,
                'quantity_type'=> $product->quantity_type,
                'quantity_count'=> $product->quantity_count,
                'commission_sales'=> $product->commission_sales,
                'commission_type'=> $product->commission_type,
            ]);
        }

        if(!empty($productDescription)){
            foreach($productDescription as $prodDescription){
                $productDescription = DB::table('products_description')->insertGetId([
                    'products_id' => $product,
                    'language_id' => $prodDescription->language_id,
                    'products_name'=> $prodDescription->products_name,
                    'products_description'=> $prodDescription->products_description,
                    'products_url'=> $prodDescription->products_url,
                    'products_viewed'=> $prodDescription->products_viewed,
                    'products_left_banner'=> $prodDescription->products_left_banner,
                    'products_left_banner_start_date'=> $prodDescription->products_left_banner_start_date,
                    'products_left_banner_expire_date'=> $prodDescription->products_left_banner_expire_date,
                    'products_right_banner'=> $prodDescription->products_right_banner,
                    'products_right_banner_start_date'=> $prodDescription->products_right_banner_start_date,
                    'products_right_banner_expire_date'=> $prodDescription->products_right_banner_expire_date,
                ]);
            }
        }

        if(!empty($procat)){
            foreach($procat as $procats){
                $procat = DB::table('products_to_categories')->insertGetId([
                    'products_id' => $product,
                    'categories_id' => $procats->categories_id,
                ]);
            }
        }


        if(!empty($productAttribute)){
            if(!empty($product->products_type) && $product->products_type == 1){
                foreach($productAttribute as $proAttribute){
                    $productAttribute = DB::table('products_attributes')->insertGetId([
                        'products_id' => $product,
                        'options_id' => $proAttribute->options_id,
                        'options_values_id'=> $proAttribute->options_values_id,
                        'options_values_price'=> $proAttribute->options_values_price,
                        'weight'=> $proAttribute->weight,
                        'weight_unit'=> $proAttribute->weight_unit,
                        'special_type'=> $proAttribute->special_type,
                        'special_price'=> $proAttribute->special_price,
                        'special_discount'=> $proAttribute->special_discount,
                        'price_prefix'=> $proAttribute->price_prefix,
                        'is_default'=> $proAttribute->is_default,
                        'attributes_sku'=> $proAttribute->attributes_sku,
                        'options_required'=> $proAttribute->options_required,
                        'options_select_type'=> $proAttribute->options_select_type,
                        'quantity_type'=> $proAttribute->quantity_type,
                        'quantity_count'=> $proAttribute->quantity_count,
                    ]);
                }
            }
        }


        if(!empty($special)){
            if(!empty($product->is_special) && $product->is_special == 'yes'){
                $special = DB::table('specials')->insertGetId([
                    'products_id' => $product,
                    'specials_new_products_price'=> $special->specials_new_products_price,
                    'special_type'=> $special->special_type,
                    'special_price'=> $special->special_price,
                    'specials_date_added'=> $special->specials_date_added,
                    'specials_last_modified'=> $special->specials_last_modified,
                    'expires_date'=> $special->expires_date,
                    'date_status_change'=> $special->date_status_change,
                    'status'=> $special->status,
                ]);
            }
        }

        if(!empty($flash)){
            $flash = DB::table('flash_sale')->insertGetId([
                'products_id' => $product,
                'flash_sale_products_price'=> $flash->flash_sale_products_price,
                'flash_sale_date_added'=> $flash->flash_sale_date_added,
                'flash_sale_last_modified'=> $flash->flash_sale_last_modified,
                'flash_start_date'=> $flash->flash_start_date,
                'flash_expires_date'=> $flash->flash_expires_date,
                'flash_status'=> $flash->flash_status,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
        }
       
        if(!empty($like)){
            $like = DB::table('liked_products')->insertGetId([
                'liked_products_id' => $product,
                'liked_customers_id'=> $like->liked_customers_id,
                'date_liked'=> date('Y-m-d H:i:s'),
            ]);
        }

        if(!empty($combo)){
            if(!empty($product->products_type) && $product->products_type == 3){
                $combo = DB::table('product_combo')->insertGetId([
                    'pro_id' => $product,
                    'cate_id'=> $combo->cate_id,
                    'product_id'=> $combo->product_id,
                    'attractive_id'=> $combo->attractive_id,
                    'option_id'=> $combo->option_id,
                    'qty'=> $combo->qty,
                    'status'=> $combo->status,
                    'created_at'=> date('Y-m-d H:i:s'),
                ]);
            }
        }


        if(!empty($buyx)){
            if(!empty($product->products_type) && $product->products_type == 4){
                $buyx = DB::table('product_buy_x')->insertGetId([
                    'pro_id' => $product,
                    'cate_id'=> $buyx->cate_id,
                    'product_id'=> $buyx->product_id,
                    'attractive_id'=> $buyx->attractive_id,
                    'option_id'=> $buyx->option_id,
                    'qty'=> $buyx->qty,
                    'status'=> $buyx->status,
                    'created_at'=> date('Y-m-d H:i:s'),
                ]);
            }
        }

        if(!empty($getx)){
            if(!empty($product->products_type) && $product->products_type == 4){
                $getx = DB::table('product_get_x')->insertGetId([
                    'pro_id' => $product,
                    'cate_id'=> $getx->cate_id,
                    'product_id'=> $getx->product_id,
                    'attractive_id'=> $getx->attractive_id,
                    'option_id'=> $getx->option_id,
                    'qty'=> $getx->qty,
                    'status'=> $getx->status,
                    'created_at'=> date('Y-m-d H:i:s'),
                ]);
            }
        }


    }
    return "success";
  }


  public function allproductListbyID($id){
    $products = DB::table('products')
    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
    ->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
    ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*')
    ->where('products_to_categories.categories_id', '=', $id)
    ->groupBy('products_description.products_id')
    ->orderBy('products.productOrder', 'ASC')
    ->get();

    return $products;
  }


  public function currentstocknew($request){
    $setting = new Setting();
    $myVarsetting = new SiteSettingController($setting);
    $myVaralter = new AlertController($setting);
    $inventory_ref_id = array();
    $products_id = $request->products_id;
    $attributes = array_filter($request->attributeid);
    $attributeid = implode(',',$attributes);
    $attributesnew = $request->attributes_id_new;
    $attributeidnews = explode(',',$attributesnew);
    $attributeidnew = implode(',',$attributeidnews);
    $postAttributes = count($attributes);
    $postAttributesnew = count($attributeidnews);


    // $inventory = DB::table('inventory')->where('products_id', $products_id)->where('stock_type', 'in')->get();
    $inventory = DB::table('inventory')->where('products_id', $products_id)->get();

    $reference_ids =array();
    $stockIn = 0;
    $purchasePrice = 0;
    $stockOut = 0;
    // dd($attributeid);
    foreach($inventory as $inventory){
        $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
        $totalAttributes = count($totalAttribute);

        if($postAttributesnew>$totalAttributes){
            $count = $postAttributesnew;
        }elseif($postAttributesnew<$totalAttributes or $postAttributesnew==$totalAttributes){
            $count = $totalAttributes;
        }

        $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
            ->selectRaw('inventory.*')
            ->whereIn('inventory_detail.attribute_id', [$attributeidnew])
            ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeidnew . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
            ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
            ->get();

        if(count($individualStock) > 0 ){
            if($individualStock[0]->stock_type == 'in'){
                $inventory_ref_id[] = $individualStock[0]->inventory_ref_id;
                $stockIn += $individualStock[0]->stock;
                $purchasePrice += $individualStock[0]->purchase_price;
            }
            if($individualStock[0]->stock_type == 'out'){
                $stockOut += $individualStock[0]->stock;
            }

        }
    }

    $options_names  = array();
    $options_values = array();
    foreach($attributes as $attribute){
      $productsAttributes = DB::table('products_attributes')
          ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
          ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
          ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
          ->where('products_attributes_id', $attribute)->get();
        $options_names[] = $productsAttributes[0]->options_name;
        $options_values[] = $productsAttributes[0]->options_values;
    }

    $options_names_count = count($options_names);
    $options_names = implode ( "','", $options_names);
    $options_names = "'" . $options_names . "'";
    $options_values = "'" . implode ( "','", $options_values ) . "'";
    $orders_products = DB::table('orders_products')->where('products_id', $products_id)->get();
    
    
    foreach($orders_products as $orders_product){
        $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
        $totalAttributes = count($totalAttribute);
        if($postAttributes>$totalAttributes){
            $count = $postAttributes;
        }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
            $count = $totalAttributes;
        }
        $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '".$products_id."' and `orders_products_attributes`.`products_options` in (".$options_names.") and `orders_products_attributes`.`products_options_values` in (".$options_values.") and `orders_products_attributes`.`orders_products_id`= '".$orders_product->orders_products_id."') = ".$count." and `orders_products`.`orders_products_id` = '".$orders_product->orders_products_id."' group by `orders_products_attributes`.`orders_products_id`");
        if(count($products)>0){
            $stockOut += $products[0]->products_quantity;
        }
    }
    
    $result = array();
    $result['purchasePrice'] = $purchasePrice;
    $result['remainingStock'] = $stockIn - $stockOut;

    if(count($inventory_ref_id) > 0){
        $inventory_ref_id = $inventory_ref_id;

        
        $minMax = DB::table('manage_min_max')->whereIn('inventory_ref_id', $inventory_ref_id)->where('products_id', $products_id)->get();
       
        if(count($minMax) > 0){
            $lastMinMax[]= $minMax[count($minMax) - 1];
            $minMax = $lastMinMax;
        }
           
       
        $inventory_ref_id = $inventory_ref_id[count($inventory_ref_id)-1];
        
        
    }else{
        $minMax = '';
    }
    // return $minMax;
    $result['inventory_ref_id'] = $inventory_ref_id;
    $result['products_id'] = $products_id;
    $result['minMax'] = $minMax;
    return $result;
  }

  public function addnewstocknew($request){
    $products_id = $request->products_id;
    if($request->stock_type === "out"){
        if(($request->current_stocks_input - $request->stock ) < 0 ){
            // dd($request->current_stocks_input - $request->stock);
            return false;
        }
    }
    $language_id     =   1;
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

            $product =  $product->get();
            $products = $product;
            $date_added	= date('Y-m-d h:i:s');
            $inventory_ref_id = DB::table('inventory')->insertGetId([
                'products_id' => $products_id,
                'reference_code' => $request->reference_code != "" ? $request->reference_code :"no  refrence",
                'stock' => $request->stock,
                'admin_id' => auth()->user()->id,
                'created_at' => $date_added,
                'purchase_price' => $request->purchase_price,
                'stock_type'  	=>  $request->stock_type

            ]);
            

            if($inventory_ref_id) {

                $emailcheck = DB::table('notify')->where('products_id', $products_id)->get();
               
                $notify_product = DB::table('products')->where('products_id', $products_id)->first();
                 
                foreach($emailcheck as $email_sub){
                  
                    $order_email = DB::table('settings')->where('id', '=','71')->first();
                    $app_name = DB::table('settings')->where('id', '=','19')->first();
                    $website_logo = DB::table('settings')->where('id', '=','16')->first();
                    $api_key = DB::table('settings')->where('id', '=','123')->first();
                    $domain = DB::table('settings')->where('id', '=','124')->first();
                    $website_link = DB::table('settings')->where('id', '=','103')->first();
                    $imgurl = $website_logo->value;
                    $product_link = $website_link->value.'product-detail/'.$notify_product->products_slug;


                    $product_image_ids = DB::table('products')->where('products_id', $products_id)->first();

                    $product_names = DB::table('products_description')->where('language_id', 1)->where('products_id', $products_id)->first();
                    $product_name = $product_names->products_name;

                    $product_image_id = $product_image_ids->products_image;

                    $product_image = DB::table('image_categories')->where('image_type', 'ACTUAL')->where('image_id', $product_image_id)->first();
                    $image_path = $product_image->path;

                    

                    $proimgurl = $image_path;

                  
                    $title = 'Product Available';

                    $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;"><img style="width:200px" src="'.$imgurl .'" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"><p style="text-align:center;">Your Required Product Available now</p><h2 style="text-align:center;">'.$product_name.'</h2><div style="text-align:center;"><img src="'.$proimgurl .'" alt="'.$app_name->value.'" style="width:400px"></div><br><br><div style="width: 100%;text-align:center;"><a href="'.$product_link.'" class=" btn btn-secondary" style="color: #fff; padding-bottom:15px; background-color: #fd5397; border-color: #fd5397; padding: 0.6rem 1.8rem;"><b>View Product</b></a></div></div></div>';


                    $subject = $title;
                    $MailData            = array();
                    $api_key             = $api_key->value;
                    $domain              = $domain->value;
                    $MailData['from']    = $app_name->value. "<".$order_email->value.">";
                    $MailData['to']      = $email_sub->notify_email;
                    //$MailData['to']      = 'sakthi@platinumcode.com.my';
                    $MailData['subject'] = $title;
                    $MailData['html'] =  $html;
            
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

                DB::table('notify')->where('products_id', $products_id)->delete();
                
            }
        


            $attributesnew = $request->attributes_id_new;
            $attributeidnews = explode(',',$attributesnew);

            if($products[0]->products_type==1){
                foreach($attributeidnews as $attribute){
                    if(!empty($attribute)){
                    DB::table('inventory_detail')->insert([
                        'inventory_ref_id' => $inventory_ref_id,
                        'products_id' => $products_id,
                        'attribute_id' => $attribute,
                    ]);
                    }
                }
            }
            return true;
  }


  public function getProductsBySlug($slug)
    {
        $products = DB::table('products')->where('products_slug', $slug)->get();
        return $products;
    }

  public function getProductsById($id)
  {
      $products = DB::table('products')->where('products_id', $id)->get();
      return $products;
  }

  public function getCategoryByParent($products_id)
  {
      $category = DB::table('categories')
          ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
          ->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')
          ->where('products_to_categories.products_id', $products_id)
          ->where('categories.parent_id', 0)
          ->where('categories.categories_status', 1)
          ->where('language_id', 1)->get();
      return $category;
  }

  public function getSubCategoryByParent($products_id)
  {
      $sub_category = DB::table('categories')
          ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
          ->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')
          ->where('products_to_categories.products_id', $products_id)
          ->where('categories.parent_id', '>', 0)
          ->where('categories.categories_status', 1)
          ->where('language_id', 1)
          ->get();
      return $sub_category;
  }


      //products
      public function products($data)
      {
  
        
          if (empty($data['page_number']) or $data['page_number'] == 0) {
              $skip = $data['page_number'] . '0';
          } else {
              $skip = $data['limit'] * $data['page_number'];
          }
  
          $min_price = $data['min_price'];
          $max_price = $data['max_price'];
          $take = $data['limit'];
          $currentDate = time();
          $type = $data['type'];
        //   $index = new Index();
        //   $result['commonContent'] = $index->commonContent();
         
   
          if ($type == "atoz") {
              $sortby = "products_name";
              $order = "ASC";
          } elseif ($type == "ztoa") {
              $sortby = "products_name";
              $order = "DESC";
          } elseif ($type == "hightolow") {
              $sortby = "products_filter_price";
              $order = "DESC";
          } elseif ($type == "lowtohigh") {
              $sortby = "products_filter_price";
              $order = "ASC";
          } elseif ($type == "topseller") {
              $sortby = "products_ordered";
              $order = "DESC";
          } elseif ($type == "mostliked") {
              $sortby = "products_liked";
              $order = "DESC";
  
          } 
          elseif ($type == "Trending") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
              $sortby = "collections_product.product_id";
              $order = "desc";
              }
              else
              {
                  $sortby = "products_name";
                  $order = "desc";
              }
          } 
          elseif ($type == "collection") {
              $sortby = "collections_product.product_id";
              $order = "DESC";
  
          }elseif ($type == "special") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
              $sortby = "collections_product.product_id";
              $order = "desc";
              }
              else
              {
                  $sortby = "specials.products_id";
                  $order = "desc";
              }
          } elseif ($type == "flashsale") { //flashsale products
              $sortby = "flash_sale.flash_start_date";
              $order = "asc";
          } else {
              $sortby = "products.productOrder";
              $order = "ASC";
          }
  
        //   if(!empty(Session::get('language_id'))){
        //       $language_id=Session::get('language_id');
        //   }else{
              $language_id='1';
          //}
  
          $filterProducts = array();
          $eliminateRecord = array();
  
          $categories = DB::table('products')
              ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
              ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
              ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
              ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id');
  
          if (!empty($data['categories_id'])) {
              $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                  ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                  ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id');
          }
          if (!empty($data['collection_id'])) {
            
              $categories->LeftJoin('collections_product', 'products.products_id', '=', 'collections_product.product_id')
                  ->leftJoin('collections', 'collections.id', '=', 'collections_product.collection_id')
                  ->LeftJoin('collections_description', 'collections_description.collections_id', '=', 'collections_product.collection_id');
          }
         
  
         
          //parameter special
          
  
  
          if (!empty($data['filters']) and empty($data['search'])) {
              $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id');
          }
  
          if (!empty($data['search'])) {
              $categories->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id');
          }
          //wishlist customer id
        
          if ($type == "wishlist") {
              $categories->LeftJoin('liked_products', 'liked_products.liked_products_id', '=', 'products.products_id')
                  ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url');
                  $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                  ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price'); 
          }
  
          elseif ($type == "topseller") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                          $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                      })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
              else
              {
                  $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                  })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
          }
          elseif ($type == "mostliked") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                          $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                      })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
              else
              {
                  $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                  })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
          }
  
          elseif ($type == "Trending") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                          $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                      })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
              else
              {
                  $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                  })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
          }
  
          elseif ($type == "special") {
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                      $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                      $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                          $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
                      })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
              }
              else
              {
  
                  $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                  ->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price'); 
              }
          }
  
  
       elseif ($type == "flashsale") {
              //flash sale
              $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                  ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as flash_price');
  
          } elseif ($type == "compare") {
              //flash sale
              $categories->LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                  ->select(DB::raw(time() . ' as server_time'), 'products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as discount_price');
                  $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                  })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
  
          } else {
              $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                  $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
              })->select('products.*', 'image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price');
          }
  
          if ($type == "special") {
            
  
  
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                  $categories->where('collections_product.collection_id', 2);
                  $categories->where('collections_product.status', 1);
              }
              else
              {
                  $categories->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
              }
          }
  
         
  
          if ($type == "flashsale") { //flashsale
              $categories->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate);
  
          } elseif ($type != "flashsale" && $type != "compare"){
              $nonflashsale = DB::table('flash_sale')->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate)->pluck('products_id');
              if(count($nonflashsale) > 0)
                  $categories->whereNotIn('products.products_id', $nonflashsale);
          }
          // elseif ($type != "compare") {
          //     $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
          //         $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
          //     });
  
          // }
  
          //get single products
          if (!empty($data['products_id']) && $data['products_id'] != "") {
              $categories->where('products.products_id', '=', $data['products_id']);
          }
  
          //for min and maximum price
          if (!empty($max_price)) {
  
              if (!empty($max_price)) {
                  //check session contain default currency
                  $current_currency = DB::table('currencies')->where('id', session('currency_id'))->first();
                  if($current_currency->is_default == 0){
                      $max_price = $max_price / session('currency_value');
                      $min_price = $min_price / session('currency_value');
                  }
      
              }
  
              $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
          }
  
       
  
  
          if (!empty($data['search'])) {
  
              $searchValue = $data['search'];
              
              $categories->where('products_options.products_options_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
  
              if (!empty($data['categories_id'])) {
                  $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
              }
  
              if (!empty($data['collection_id'])) {
                  $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                  $categories->where('collections_product.status', 1);
              }
  
              
              if (!empty($data['filters'])) {
                  $temp_key = 0;
                  foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
  
                    
  
                      if ($temp_key == 0) {
  
                          $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
  
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      } else {
                          $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
  
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      }
                      $temp_key++;
                  }
  
              }
  
              if (!empty($max_price)) {
                  $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
              }
              $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                  $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
              });
              $categories->orWhere('products_options_values.products_options_values_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
              if (!empty($data['categories_id'])) {
                  $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
              }
              if (!empty($data['collection_id'])) {
                  $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                  $categories->where('collections_product.status', 1);
              }
  
              if (!empty($data['filters'])) {
                  $temp_key = 0;
                  foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
  
                      if ($temp_key == 0) {
  
                          $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
  
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      } else {
                          $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
  
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      }
                      $temp_key++;
                  }
  
              }
  
              if (!empty($max_price)) {
                  $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
              }
  
              $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                  $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
              });
  
              $categories->orWhere('products_name', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
  
              if (!empty($data['categories_id'])) {
                  $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
              }
              if (!empty($data['collection_id'])) {
                  $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                  $categories->where('collections_product.status', 1);
              }
  
              if (!empty($data['filters'])) {
                  $temp_key = 0;
                  foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
  
                      if ($temp_key == 0) {
  
                          $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
  
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      } else {
                          $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
  
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      }
                      $temp_key++;
                  }
  
              }
  
              if (!empty($max_price)) {
                  $categories->whereBetween('products.products_filter_price', [$min_price, $max_price]);
              }
  
              $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                  $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
              });
  
              $categories->orWhere('products_model', 'LIKE', '%' . $searchValue . '%')->where('products_status', '=', 1);
  
              if (!empty($data['categories_id'])) {
                  $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
              }
              if (!empty($data['collection_id'])) {
                  $categories->where('collections_product.collection_id', '=', $data['collection_id']);
                  $categories->where('collections_product.status', 1);
              }
  
              if (!empty($data['filters'])) {
                  $temp_key = 0;
                  foreach ($data['filters']['filter_attribute']['option_values'] as $option_id_temp) {
  
                      if ($temp_key == 0) {
  
                          $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
  
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      } else {
                          $categories->orwhereIn('products_attributes.options_id', [$data['filters']['options']])
                              ->where('products_attributes.options_values_id', $option_id_temp);
  
                          if (count($data['filters']['filter_attribute']['options']) > 1) {
                              $categories->where(DB::raw('(select count(*) from `products_attributes` where `products_attributes`.`products_id` = `products`.`products_id` and `products_attributes`.`options_id` in (' . $data['filters']['options'] . ') and `products_attributes`.`options_values_id` in (' . $data['filters']['option_value'] . '))'), '>=', $data['filters']['options_count']);
                          }
  
                      }
                      $temp_key++;
                  }
  
              }
              $categories->whereNotIn('products.products_id', function ($query) use ($currentDate) {
                  $query->select('flash_sale.products_id')->from('flash_sale')->where('flash_sale.flash_status', '=', '1');
              });
          }
  
       
  
          if (!empty($data['filters'])) {
              $temp_key = 0;
              
              $categories->whereIn('products_attributes.options_id', [$data['filters']['options']])
                  ->whereIn('products_attributes.options_values_id',[$data['filters']['option_value']]);
          }
  
          //wishlist customer id
          if ($type == "wishlist") {
              $categories->where('liked_customers_id', '=', session('customers_id'));
          }
  
          if ($type == "collection") {
              $categories->where('collection_id', '>', 4);
          }
  
          //wishlist customer id
          if ($type == "is_feature") {
              $categories->where('products.is_feature', '=', 1);
          }
          if(!empty($data['brand'])){
              $brand = $data['brand'];
              $brand = DB::table('manufacturers')->where('manufacturer_name',$brand)->first();
              if($brand)
                  $categories->where('products.manufacturers_id', '=', $brand->manufacturers_id);
          }
          $categories->where('products_description.language_id', '=', $language_id)->where('products_status', '=', 1);
  
          //get single category products
          if (!empty($data['categories_id'])) {
              $categories->where('products_to_categories.categories_id', '=', $data['categories_id']);
              $categories->where('categories.categories_status', '=', 1);
              $categories->where('categories_description.language_id', '=', $language_id);
          }else{
              $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id');
                  // ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id');
              $categories->whereIn('products_to_categories.categories_id', function ($query) use ($currentDate) {
                  $query->select('categories_id')->from('categories')->where('categories.categories_status',1);
              });
          }
  
          if (!empty($data['collection_id'])) {
              $categories->where('collections_product.collection_id', '=', $data['collection_id']);
              $categories->where('collections.status', '=', 1);
              $categories->where('collections_description.language_id', '=', $language_id);
              $categories->where('collections_product.status', 1);
          }
  
          if ($type == "topseller") {
            
  
  
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                  $categories->where('collections_product.collection_id', 1);
                  $categories->where('collections_product.status', 1);
              }
              else
              {
              $categories->where('products.products_ordered', '>', 0);
              }
          }
  
          if ($type == "mostliked") {
            
  
  
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                  $categories->where('collections_product.collection_id', 3);
                  $categories->where('collections_product.status', 1);
              }
              else
              {
              $categories->where('products.products_liked', '>', 0);
              }
          }
  
          if ($type == "Trending") {
            
  
  
              if($result['commonContent']['settings']['collection_product'] == '1')
              {
                  $categories->where('collections_product.collection_id', 10);
                  $categories->where('collections_product.status', 1);
              }
              else
              {
              $categories->where('products.products_id', '>', 0);
              }
          }
  
  
          $categories->where('products.products_status', 1);
          $categories->whereIn('product_view', [0, 1]);
          $categories->orderBy($sortby, $order)->groupBy('products.products_id');
  
          //count
          $total_record = $categories->get();
          $products = $categories->skip($skip)->take($take)->get();
  
          $result = array();
          $result2 = array();
  
          //check if record exist
          if (count($products) > 0) {
  
              $index = 0;
              foreach ($products as $products_data) {
  
                  $reviews = DB::table('reviews')
                      ->leftjoin('users', 'users.id', '=', 'reviews.customers_id')
                      ->leftjoin('reviews_description', 'reviews.reviews_id', '=', 'reviews_description.review_id')
                      ->select('reviews.*', 'reviews_description.reviews_text')
                      ->where('products_id', $products_data->products_id)
                      ->where('reviews_status', '1')
                      ->where('reviews_read', '1')
                      ->get();
  
                  $avarage_rate = 0;
                  $total_user_rated = 0;
  
                  if (count($reviews) > 0) {
                      $five_star = 0;
                      $five_count = 0;
  
                      $four_star = 0;
                      $four_count = 0;
  
                      $three_star = 0;
                      $three_count = 0;
  
                      $two_star = 0;
                      $two_count = 0;
  
                      $one_star = 0;
                      $one_count = 0;
  
                      foreach ($reviews as $review) {
  
                          //five star ratting
                          if ($review->reviews_rating == '5') {
                              $five_star += $review->reviews_rating;
                              $five_count++;
                          }
  
                          //four star ratting
                          if ($review->reviews_rating == '4') {
                              $four_star += $review->reviews_rating;
                              $four_count++;
                          }
                          //three star ratting
                          if ($review->reviews_rating == '3') {
                              $three_star += $review->reviews_rating;
                              $three_count++;
                          }
                          //two star ratting
                          if ($review->reviews_rating == '2') {
                              $two_star += $review->reviews_rating;
                              $two_count++;
                          }
  
                          //one star ratting
                          if ($review->reviews_rating == '1') {
                              $one_star += $review->reviews_rating;
                              $one_count++;
                          }
                      }
  
                      $five_ratio = round($five_count / count($reviews) * 100);
                      $four_ratio = round($four_count / count($reviews) * 100);
                      $three_ratio = round($three_count / count($reviews) * 100);
                      $two_ratio = round($two_count / count($reviews) * 100);
                      $one_ratio = round($one_count / count($reviews) * 100);
                      if(($five_star + $four_star + $three_star + $two_star + $one_star) > 0){
                          $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
                      }else{
                          $avarage_rate = 0;
                      }
                      $total_user_rated = count($reviews);
                      $reviewed_customers = $reviews;
                  } else {
                      $reviewed_customers = array();
                      $avarage_rate = 0;
                      $total_user_rated = 0;
  
                      $five_ratio = 0;
                      $four_ratio = 0;
                      $three_ratio = 0;
                      $two_ratio = 0;
                      $one_ratio = 0;
                  }
  
                  $products_data->rating = number_format($avarage_rate, 2);
                  $products_data->total_user_rated = $total_user_rated;
  
                  $products_data->five_ratio = $five_ratio;
                  $products_data->four_ratio = $four_ratio;
                  $products_data->three_ratio = $three_ratio;
                  $products_data->two_ratio = $two_ratio;
                  $products_data->one_ratio = $one_ratio;
  
                  //review by users
                  $products_data->reviewed_customers = $reviewed_customers;
                  $products_id = $products_data->products_id;
  
                  //products_image
                  $default_images = DB::table('image_categories')
                      ->where('image_id', '=', $products_data->products_image)
                      ->where('image_type', 'ACTUAL')
                      ->first();
  
                  if ($default_images) {
                      $products_data->image_path = $default_images->path;
                      $products_data->image_path_type = $default_images->path_type;
                  } else {
                      $default_images = DB::table('image_categories')
                          ->where('image_id', '=', $products_data->products_image)
                          ->where('image_type', 'ACTUAL')
                          ->first();
  
                      if ($default_images) {
                          $products_data->image_path = $default_images->path;
                          $products_data->image_path_type = $default_images->path_type;
                      } else {
                          $default_images = DB::table('image_categories')
                              ->where('image_id', '=', $products_data->products_image)
                              ->where('image_type', 'ACTUAL')
                              ->first();
                          $products_data->image_path = $default_images->path;
                          $products_data->image_path_type = $default_images->path_type;
                      }
  
                  }
  
                  $default_images = DB::table('image_categories')
                      ->where('image_id', '=', $products_data->products_image)
                      ->where('image_type', 'ACTUAL')
                      ->first();
                  if ($default_images) {
                      $products_data->default_images = $default_images->path;
                      $products_data->default_images_path_type = $default_images->path_type;
                  } else {
                      $default_images = DB::table('image_categories')
                          ->where('image_type', 'ACTUAL')
                          ->where('image_id', '=', $products_data->products_image)
                          ->first();
                      if ($default_images) {
                          $products_data->default_images = $default_images->path;
                          $products_data->default_images_path_type = $default_images->path_type;
                      }
                  }
  
                  //multiple images
                  $products_images = DB::table('products_images')
                      ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')
                      ->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                      ->where('products_id', '=', $products_id)
                      ->orderBy('sort_order', 'ASC')
                      ->get();
  
                  $products_data->images = $products_images;
  
                   //multiple video
                   $products_video = DB::table('product_video')
                   ->LeftJoin('image_categories', 'product_video.image_id', '=', 'image_categories.image_id')
                   ->select('product_video.*','image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                   ->where('product_id', '=', $products_id)
                   ->orderBy('sort_order', 'ASC')
                   ->get();
  
               $products_data->multivideo = $products_video;
  
                  $default_image_thumb = DB::table('products')
                      ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
                      ->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                      ->where('products_id', '=', $products_id)
                      ->where('image_type', '=', 'ACTUAL')
                      ->first();
                  if ($default_image_thumb) {
                      $products_data->default_thumb = $default_image_thumb->image_path;
                      $products_data->default_thumb_image_path_type = $default_image_thumb->image_path_type;
                  } else {
                      $products_data->default_thumb = $products_data->default_images;
                      $products_data->default_thumb_image_path_type = $products_data->image_path_type;
                  }
  
                  //categories
                  $categories = DB::table('products_to_categories')
                      ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                      ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                      ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id', 'categories.categories_slug', 'categories.categories_status')
                      ->where('products_id', '=', $products_id)
                      ->where('categories_description.language_id', '=', $language_id)
                      ->where('categories.categories_status', 1)
                      ->orderby('parent_id', 'ASC')->get();
  
                  $products_data->categories = $categories;
                  array_push($result, $products_data);
  
                  $options = array();
                  $attr = array();
  
                  $stocks = 0;
                  $stockOut = 0;
                  if ($products_data->products_type == '0') {
                      $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                      $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                  }
  
                  $result[$index]->defaultStock = $stocks - $stockOut;
  
                  //like product
                  if (!empty(session('customers_id'))) {
                      $liked_customers_id = session('customers_id');
                      $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();
  
                      if (count($categories) > 0) {
                          $result[$index]->isLiked = '1';
                      } else {
                          $result[$index]->isLiked = '0';
                      }
                  } else {
                      $result[$index]->isLiked = '0';
                  }
  
                  // fetch all options add join from products_options table for option name
                  $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                  if (count($products_attribute)) {
                      $index2 = 0;
                      foreach ($products_attribute as $attribute_data) {
                          $option_name = DB::table('products_options')
                          ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                          if (count($option_name) > 0) {
  
                              $temp = array();
                              $temp_option['id'] = $attribute_data->options_id;
                              $temp_option['name'] = $option_name[0]->products_options_name;
                              $temp_option['is_default'] = $attribute_data->is_default;
                              $temp_option['options_required'] = $option_name[0]->options_required;
                              $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                              $attr[$index2]['option'] = $temp_option;
  
                              // fetch all attributes add join from products_options_values table for option value name
                              $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                              $k = 0;
                              foreach ($attributes_value_query as $products_option_value) {
  
                                  $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values_descriptions.language_id', '=', $language_id)->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();
  
                                  $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
  
                                
  
                                  $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                  $temp_i['id'] = $products_option_value->options_values_id;
                                  $temp_i['value'] = $option_value[0]->products_options_values_name;
                                  $temp_i['price'] = $products_option_value->options_values_price;
                                  $temp_i['price_prefix'] = $products_option_value->price_prefix;
                                  $temp_i['is_default'] = $products_option_value->is_default;
                                  array_push($temp, $temp_i);
  
                              }
                              $attr[$index2]['values'] = $temp;
                              $result[$index]->attributes = $attr;
                              $index2++;
                          }
                      }
                  } else {
                      $result[$index]->attributes = array();
                  }
                  $index++;
              }
              $responseData = array('success' => '1', 'product_data' => $result, 'message' => Lang::get('website.Returned all products'), 'total_record' => count($total_record));
  
          } else {
              $responseData = array('success' => '0', 'product_data' => $result, 'message' => Lang::get('website.Empty record'), 'total_record' => count($total_record));
          }
  
          return ($responseData);
      }
  

      public function AdminComboDelete($request){
        $setting = new Setting();
        $myVarsetting = new SiteSettingController($setting);
        $myVaralter = new AlertController($setting);
        $id = $request->id;
        $categories = DB::table('product_combo')->where('id', $id)->delete();
      }

}
