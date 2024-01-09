<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Products;
use App\Models\Core\Setting;
use Illuminate\Support\Str;

use DB;
use Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon;

class Category extends Model
{

  public static function convertprice($current_price, $requested_currency)
  {
    $required_currency = DB::table('currencies')->where('is_current',1)->where('code', $requested_currency)->first();
    $products_price = $current_price * $required_currency->value;
    return $products_price;
  }

  


 public static function getMainCategories($language_id)
{
  $getCategories = DB::table('categories')
  ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
  ->select('categories.categories_id as id', 'categories.categories_image as image',  'categories.date_added as date_added', 'categories.last_modified as last_modified', 'categories_description.categories_name as name')
  ->where('parent_id', '0')->where('categories_description.language_id', $language_id)->orderBy('categories.CategoryOrder', 'ASC')->get();
  return($getCategories) ;
}

public static function getCategories($request)
{
  $language_id 	 = '1';

  if(empty($request->category_id)){
    $category_id	= '0';
  }else{
    $category_id	=   $request->category_id;
  }

  $getCategories = DB::table('categories')
  ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
  ->select('categories.categories_id as id', 'categories.categories_image as image',  'categories.date_added as date_added', 'categories.last_modified as last_modified', 'categories_description.categories_name as name')
  ->where('parent_id', $category_id)->where('categories_description.language_id', $language_id)->orderBy('categories.CategoryOrder', 'ASC')->get();
  return($getCategories) ;
}

public static function getposcategories($request)
{
       $consumer_data = array();
       $consumer_data['consumer_key'] = request()->header('consumer-key');
       $consumer_data['consumer_secret'] = request()->header('consumer-secret');
       $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
       $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
       $consumer_data['consumer_ip'] = request()->header('consumer-ip');
       $consumer_data['consumer_url'] = __FUNCTION__;
       $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      
       if ($authenticate == 1) {
            if($request->language_id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $items = DB::table('categories')
            ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
            ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
            ->where('categories_description.language_id', '=', $request->language_id)
            ->where('categories.categories_status', 1)
            ->groupBy('categories.categories_id')
            ->orderBy('categories.CategoryOrder', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->categories_id])) {
                    $item->childs = $childs[$item->categories_id];
                }else{
                    $item->childs=[];
                }
            }

            $tree = $childs[0];
            }
            $responseData = array('success' => '1', 'data' => $tree, 'message' => "Returned all categories.");
          }
       }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
       }
       $categoryResponse = json_encode($responseData);
      return $categoryResponse;
}

public static function deletecategories($request)
{
      $consumer_data = array();
      $consumer_data['consumer_key'] = request()->header('consumer-key');
      $consumer_data['consumer_secret'] = request()->header('consumer-secret');
      $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
      $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
      $consumer_data['consumer_ip'] = request()->header('consumer-ip');
      $consumer_data['consumer_url'] = __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate == 1) {
        if($request->categories_id == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
          //check if this is parent id 
          $category = DB::table('categories')->where('categories_id', $request->categories_id)->first();
          if($category) {
              //update its child to parents 
              if($category->parent_id == 0){
                  DB::table('categories')->where('parent_id', $request->categories_id)->update(
                  [
                      'parent_id'   =>   0,
                  ]);
              }else{
                  //update its child ids to its parent id
                  DB::table('categories')->where('parent_id', $request->categories_id)->update(
                  [
                      'parent_id'   =>   $category->parent_id,
                  ]);
              }
                DB::table('categories')->where('categories_id', $request->categories_id)->delete();
                DB::table('categories_description')->where('categories_id', $request->categories_id)->delete();

                $categories = DB::table('products_to_categories')->where('categories_id', $request->categories_id)->groupby('products_id')->get();

                if(!empty($categories) and count($categories)>0){
                  foreach($categories as $category){
                     //check count of products
                      $products = DB::table('products_to_categories')->where('products_id', $category->products_id)->count();
                      if($products == 1){
                            DB::table('products_to_categories')->insert([
                            'products_id' => $category->products_id,
                            'categories_id' => -1
                          ]);
                      }
                  }
                  DB::table('products_to_categories')->where('categories_id', $request->categories_id)->delete();
                }

                $responseData = array('success' => '1','message' => "Category deleted successfully.");

          }else{
            $responseData = array('success' => '0','message' => "Invalid categories id.");
          }
        }
      }else{
        $responseData = array('success' => '0','message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);
      return $categoryResponse;
}

  public static function categories_insert($imagedata,$date_added,$parent_id,$imageicon,$categories_status)
  {
      $categories = DB::table('categories')->insertGetId([
            'categories_image'   =>   $imagedata,
            'created_at'     =>   $date_added,
            'parent_id'      =>   $parent_id,
            'categories_icon'  =>   $imageicon,
            'categories_slug'    =>   'Null',
            'categories_status' => $categories_status
        ]);
        return $categories;
  }

  public static function insertcategorydescription($categoryNameSub,$categories_id,$languages_data_id,$descriptions)
  {
    DB::table('categories_description')->insert([
            'categories_name'   =>   $categoryNameSub,
            'categories_id'     =>   $categories_id,
            'language_id'       =>   $languages_data_id,
            'categories_description' => $descriptions
        ]);
  }

  public static function updaterecord($categories_id,$uploadImage,$uploadIcon,$last_modified,$parent_id,$slug,$categories_status)
  {
      DB::table('categories')->where('categories_id', $categories_id)->update(
        [
            'categories_image'   =>   $uploadImage,
            'categories_icon'    =>   $uploadIcon,
            'updated_at'         =>   $last_modified,
            'parent_id'          =>   $parent_id,
            'categories_slug'    =>   $slug,
            'categories_status'=>$categories_status
        ]);

      if($categories_status == 0){
           $items = DB::table('categories')
              ->where('parent_id', $categories_id)
              ->get();
          if(!empty($items) and count($items)>0){
             //update
              DB::table('categories')->where('parent_id', $categories_id)->update(
                  [
                      'categories_status'=>0
                  ]);
             foreach($items as $item){
                   $this->recursivedisable($item->categories_id);
              }
          }
      }
  }

   public static function recursivedisable($categories_id){   
          
          $items = DB::table('categories')
              ->where('parent_id', $categories_id)
              ->get();
  
          if(!empty($items) and count($items)>0){
              
              //update
              DB::table('categories')->where('parent_id', $categories_id)->update(
                  [
                      'categories_status'=>0
                  ]);
  
              foreach($items as $item){
                   $this->recursivedisable($item->categories_id);
              }
              
          }
          
      }

      public static function checkExit($categories_id,$languages_data){
        $checkExist = DB::table('categories_description')->where('categories_id','=',$categories_id)->where('language_id','=',$languages_data->languages_id)->get();
        return $checkExist;
    }

    public static function updatedescription($categories_name,$languages_data,$categories_id,$descriptions){
        $category =  DB::table('categories_description')->where('categories_id','=',$categories_id)->where('language_id','=',$languages_data->languages_id)->update([
             'categories_name'             =>  $categories_name,
             'categories_description' => $descriptions
         ]);
        return $category;
     }

     public static function gettaxclass($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

         if($authenticate == 1) {
            if($request->tax_type == '' || $request->country_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $taxClass = DB::table('tax_class')
                    ->LeftJoin('tax_rates', 'tax_rates.tax_class_id', '=', 'tax_class.tax_class_id')
                    ->select('tax_class.tax_class_id','tax_class.tax_class_title','tax_class.tax_class_description','tax_rates.tax_priority','tax_rates.tax_rate','tax_rates.tax_description')
                    ->where('tax_rates.tax_zone_id', $request->country_id)
                    ->where('tax_class.tax_type', $request->tax_type)->get();
                if(!$taxClass->isEmpty()){
                  $responseData = array('success' => '1', 'data' => $taxClass, 'message' => "Returned all taxclass.");
                }else{
                  $responseData = array('success' => '0','message' => "No data found.");
                }
            }
        }else{
            $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }

     public static function getmanufacturer($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->language_id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $manufacturers =  DB::table('manufacturers')
                  ->leftJoin('manufacturers_info','manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
                  ->select('manufacturers.manufacturers_id as id','manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url', 'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date')
                  ->where('manufacturers_info.languages_id', $request->language_id)
                  ->get();
              if(!empty($manufacturers)){
                  $responseData = array('success' => '1', 'data' => $manufacturers, 'message' => "Returned all manufacturers.");
              }else{
                $responseData = array('success' => '0','message' => "No data found.");
              }
            }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }

     public static function getOptionName($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
         if($authenticate == 1) {
            $language_id = 1;
            $options = DB::table('products_options')
            ->leftjoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
            ->where('products_options_descriptions.language_id', '=', $language_id)
            ->get();
            if(!$options->isEmpty()){
                $responseData = array('success' => '1', 'data' => $options, 'message' => "Returned all options.");
            }else{
              $responseData = array('success' => '0','message' => "No data found.");
            }
         }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
         }
         $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function getOptionsValue($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
            if($request->option_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $language_id = 1;
                $value = DB::table('products_options_values')
                ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')
                ->select('products_options_values_descriptions.*')
                ->where('products_options_values_descriptions.language_id', '=', $language_id)
                ->where('products_options_values.products_options_id', '=', $request->option_id)
                ->get();
                if(!empty($value)){
                   $responseData = array('success' => '1', 'data' => $value, 'message' => "Returned all options value.");
                }else{
                  $responseData = array('success' => '0','message' => "No data found.");
                }
            }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
          $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function addOptionsValue($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);

        if($authenticate == 1) {
             if($request->products_id == '' || $request->products_options_id == '' || $request->products_options_values_id == '' || $request->is_default == '' || $request->products_weight== '' || $request->products_weight_unit == '' ){
                  $responseData = array('success'=>'0','message'=>"Required all Fields.");
              }else{
                $checkRecord = DB::table('products_attributes')->where([
                    'options_id' => $request->products_options_id,
                    'products_id' => $request->products_id,
                    'options_values_id' => $request->products_options_values_id,
                ])->get();
                if(count($checkRecord)>0){
                  $responseData = array('success'=>'0','message'=>"This option has already been inserted.");
                }else{
                  $allvals=DB::table('products_attributes')->where(['attributes_sku'=> $request->option_sku,])->select('attributes_sku')->first();
                  if(empty($allvals)) {
                  $special_pro = DB::table('specials')->where([
                    'products_id' => $request->products_id,
                    'status' => 1,
                  ])->first();

                  if($special_pro != ''){
                      $sp_type = $special_pro->special_type;
                      $sp_new_pro_price = $special_pro->specials_new_products_price;
                      $sp_price = $special_pro->special_price;
                  }else{
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
                        'options_required'=> $options->options_required,
                        'options_select_type'=> $options->options_select_type
                    ]);

                   // add sku
                   $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
                   $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
                   $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();

                   if(!empty($request->option_sku)){
                      $sku = $request->option_sku;
                   }else{
                      $sku = $authController->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$products_attributes_id);
                    }

                    // update sku
                      DB::table('products_attributes')->where('products_attributes_id', '=', $products_attributes_id)->update([
                          'attributes_sku' => $sku
                      ]);

                   $responseData = array('success'=>'1','message'=>"Product option inserted successfully.");
                 }else{
                    $responseData = array('success'=>'0','message'=>"This sku already inserted");
                 }
                }
              }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }

     public static function viewProductsattributes($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
              $language_id='1';
              $products_attributes = DB::table('products_attributes')
                ->join('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')
                ->select('products_attributes.*', 'products_options_descriptions.options_name', 'products_options_values_descriptions.options_values_name')
                ->where('products_attributes.products_id', '=', $request->products_id)
                ->where('products_options_descriptions.language_id', '=', $language_id)
                ->where('products_options_values_descriptions.language_id', '=', $language_id)
                ->orderBy('products_attributes_id', 'DESC')
                ->get();

                if(!empty($products_attributes)){
                  $responseData = array('success' => '1', 'data' => $products_attributes, 'message' => "Returned all products attributes.");
                }else{
                  $responseData = array('success' => '0','message' => "No data found.");
                }
            }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function updateOptionsValue($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
           if($request->products_id == '' || $request->products_options_id == '' || $request->products_options_values_id == '' || $request->products_attributes_id == '' || $request->products_weight == '' || $request->products_weight_unit == ''){
                  $responseData = array('success'=>'0','message'=>"Required all Fields.");
              }else{
                 $allvals=DB::table('products_attributes')->where(['attributes_sku' => $request->option_sku])
                ->where('products_attributes_id','!=', $request->products_attributes_id)
                ->select('attributes_sku')
                ->first();
                if(empty($allvals)) {
                $special_pro = DB::table('specials')->where([
                    'products_id' => $request->products_id,
                    'status' => 1,
                ])->first();

              if($special_pro != ''){
                  $sp_type = $special_pro->special_type;
                  $sp_new_pro_price = $special_pro->specials_new_products_price;
                  $sp_price = $special_pro->special_price;
              }else{
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
                  'options_required'=> $options->options_required,
                  'options_select_type'=> $options->options_select_type,
              ]);

                // add sku
                   $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
                   $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
                   $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();

                   if(!empty($request->option_sku)){
                      $sku = $request->option_sku;
                   }else{
                      $sku = $authController->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$request->products_attributes_id);
                    }

                    // update sku
                      DB::table('products_attributes')->where('products_attributes_id', '=', $request->products_attributes_id)->update([
                          'attributes_sku' => $sku
                      ]);

              $responseData = array('success'=>'1','message'=>"Product option update successfully.");
            }else{
                $responseData = array('success'=>'0','message'=>"This sku already inserted");
              }
            }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
         $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function deleteOptionsValue($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
           if($request->products_id == '' || $request->products_attributes_id == ''){
                  $responseData = array('success'=>'0','message'=>"Required all Fields.");
              }else{
                  $checkRecord = DB::table('products_attributes')->where([
                  'products_attributes_id' => $request->products_attributes_id])->first();
                  if($checkRecord){
                      $checkRecord = DB::table('products_attributes')->where([
                          'products_attributes_id' => $request->products_attributes_id,
                          'products_id' => $request->products_id
                      ])->delete();
                     $responseData = array('success'=>'1','message'=>"Product option delete successfully.");  
                  }else{
                    $responseData = array('success'=>'0','message'=>"Invalid products attributes id.");
                  }
              } 
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function addAdditionalOptions ($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == '' || $request->products_options_id == '' || $request->products_options_values_id == '' || $request->options_values_price == '' || $request->price_prefix== '' || $request->products_weight == '' || $request->products_weight_unit == '' ){
                  $responseData = array('success'=>'0','message'=>"Required all Fields.");
              }else{
                  $checkRecord = DB::table('products_attributes')->where([
                    'options_id' => $request->products_options_id,
                    'options_values_id' => $request->products_options_values_id,
                    'products_id' => $request->products_id
                ])->get();
                  if(count($checkRecord)>0){
                    $responseData = array('success'=>'0','message'=>"This option has already been inserted.");
                  }else{
                    $allvals=DB::table('products_attributes')->where(['attributes_sku'=> $request->addoption_sku,])->select('attributes_sku')->first();
                    if(empty($allvals)) {
                    // get product 
                    $pr_price = DB::table('products')->where(['products_id' => $request->products_id
                    ])->first();

                    $or_price = $pr_price->products_price;

                    if($request->price_prefix == '+'){
                        $or_total = $or_price + $request->options_values_price;
                    }else{
                        $or_total = $or_price - $request->options_values_price;
                    }

                    if($pr_price->is_special == 1){
                        $special_price = $or_total - $pr_price->products_filter_price;
                    }else{
                        $special_price = ($or_total * $pr_price->products_filter_price) / 100; 
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
                        'is_default' => '0',
                        'options_required'=> $options->options_required,
                        'options_select_type'=> $options->options_select_type
                    ]);
                    // update sku
                    $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
                    $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
                    $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();

                    if(!empty($request->addoption_sku)){
                       $sku = $request->addoption_sku;
                     }else{
                       $sku = $authController->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$products_attributes_id);
                     }

                     // update sku
                      DB::table('products_attributes')->where('products_attributes_id', '=', $products_attributes_id)->update([
                          'attributes_sku' => $sku
                      ]);

                    $responseData = array('success'=>'1','message'=>"Product additional option inserted successfully.");
                  }else{
                    $responseData = array('success' => '0','message' => "This sku already inserted");
                  }
                  }
              }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function updateAdditionalOptions($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == '' || $request->products_options_id == '' || $request->products_options_values_id == '' || $request->options_values_price == '' || $request->price_prefix== '' || $request->products_attributes_id == '' || $request->products_weight == '' || $request->products_weight_unit== '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $allvals=DB::table('products_attributes')->where(['attributes_sku' => $request->addoption_sku])
                ->where('products_attributes_id','!=', $request->products_attributes_id)
                ->select('attributes_sku')
                ->first();
                if(empty($allvals)) {
                $pr_price = DB::table('products')->where([
                    'products_id' => $request->products_id
                ])->first();

                $or_price = $pr_price->products_price;

                if($request->price_prefix == '+'){
                  $or_total = $or_price + $request->options_values_price;
                }else{
                  $or_total = $or_price - $request->options_values_price;
                }

                if($pr_price->is_special == 1){
                  $special_price = $or_total - $pr_price->products_filter_price;
                }else{
                  $special_price = ($or_total * $pr_price->products_filter_price) / 100; 
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
                'options_required'=> $options->options_required,
                'options_select_type'=> $options->options_select_type,
            ]);
            // update sku
              $product_name=DB::table('products_description')->where('products_id', '=', $request->products_id)->first();
              $options_name=DB::table('products_options')->where('products_options_id', '=', $request->products_options_id)->first();
              $options_value=DB::table('products_options_values')->where('products_options_values_id', '=', $request->products_options_values_id)->first();

                if(!empty($request->addoption_sku)){
                    $sku = $request->addoption_sku;
                }else{
                    $sku = $authController->SKU_gen($product_name->products_name,$options_name->products_options_name,$options_value->products_options_values_name,$request->products_attributes_id);
                }
                // update sku
                  DB::table('products_attributes')->where('products_attributes_id', '=', $request->products_attributes_id)->update([
                        'attributes_sku' => $sku
                    ]);

             $responseData = array('success'=>'1','message'=>"Product additional option updated successfully.");  
             }else{
               $responseData = array('success' => '0','message' => "This sku already inserted");
             } 
          }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }

        $categoryResponse = json_encode($responseData);
          return $categoryResponse;
     }

     public static function deleteAdditionalOptions($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
             if($request->products_id == '' || $request->products_attributes_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $checkRecord = DB::table('products_attributes')->where([
                  'products_attributes_id' => $request->products_attributes_id])->first();
            if($checkRecord){

                   $Record = DB::table('products_attributes')->where([
                          'products_attributes_id' => $request->products_attributes_id,
                          'products_id' => $request->products_id
                      ])->delete();

                  $responseData = array('success'=>'1','message'=>"Product option delete successfully.");
            }else{
              $responseData = array('success'=>'0','message'=>"Invalid products attributes id.");
            }
          }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }
     public static function viewproductimage($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
           if($request->products_id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
              $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
              if($check){

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
                  ->orderBy('sort_order', 'asc')
                  ->get();
                     if (!$products_images->isEmpty()){ 
                        $responseData = array('success' => '1','data'=>$products_images,'message' => "Return all product image");
                     }else{
                        $responseData = array('success' => '0','message' => "No data found.");
                     } 
              }else{
                $responseData = array('success' => '0','message' => "Invalid product id..");
              }  
           }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }

     public static function insertproductimages($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == '' || $request->image_id==''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
               $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
               if($check){
                   $imagearray=array();  $imagearray=explode(",",$request->image_id);
                   foreach ($imagearray as $jesnewimage) {
                       $count = DB::table('products_images')->where('products_id', '=', $request->products_id)->count();
                       $new_count=$count+1;
                       DB::table('products_images')->insert([
                          'products_id' => $request->products_id,
                          'image' => $jesnewimage,
                          'htmlcontent' => '',
                          'sort_order' => $new_count
                        ]);
                   }
                   $responseData = array('success' => '1','message' => "Product image inserted successfully");
               }else{
                  $responseData = array('success' => '0','message' => "Invalid product id..");
               }
           }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }
     public static function editproductimages($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
           if($request->products_id == '' || $request->oldImage == '' || $request->id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
            $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
            if($check){
                if($request->image_id !== null){
                    $uploadImage = $request->image_id;
                }else{
                    $uploadImage = $request->oldImage;
                }
                DB::table('products_images')->where('products_id', '=', $request->products_id)->where('id', '=', $request->id)
                  ->update([
                      'image' => $uploadImage,
                      'htmlcontent' => '',
                  ]);
               $responseData = array('success' => '1','message' => "Product updated successfully..");
            }else{
               $responseData = array('success' => '0','message' => "Invalid product id..");
            }
           }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }

     public static function deleteproductimages($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == '' || $request->id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
            if($check){
                DB::table('products_images')
                  ->where([
                      'products_id' => $request->products_id,
                      'id' => $request->id
                  ])
               ->delete();
               $responseData = array('success' => '1','message' => "Product images deleted successfully..");
            }else{
              $responseData = array('success' => '0','message' => "Invalid product id..");
            }
          }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }
     public static function deleteproduct($request)
     {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
           if($request->products_id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
           }else{
              $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
              if($check){
                $products_id=$request->products_id;
                $categories = DB::table('products_to_categories')->where('products_id', $products_id)->delete();
                $categories = DB::table('products')->where('products_id', $products_id)->delete();
                $categories = DB::table('specials')->where('products_id', $products_id)->delete();
                $categories = DB::table('products_description')->where('products_id', $products_id)->delete();
                $categories = DB::table('products_attributes')->where('products_id', $products_id)->delete();
                $responseData = array('success' => '1','message' => "Product deleted successfully..");
              }else{
                $responseData = array('success' => '0','message' => "Invalid product id..");
              }
           }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
     }
  public static function getproduct($request)
  {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->products_id == '' || $request->language_id == ''){
             $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
             $check = DB::table('products')->where(['products_id' => $request->products_id])->first();
             if($check){
                $language_id      =   $request->language_id;
                $products_id      =   $request->products_id;
                $category_id    =   '0';
                $result = array();

                //get function from other controller
                  //$result['languages'] =  $authController->fetchLanguages();
                  //$result['units'] = $authController->getUnits();

                  //tax class
                  //$taxClass = DB::table('tax_class')->get();
                  //$result['taxClass'] = $taxClass;

                  //get function from ManufacturerController controller
                // $getManufacturers = DB::table('manufacturers')
                //     ->leftJoin('manufacturers_info','manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
                //     ->select('manufacturers.manufacturers_id as id', 'manufacturers.manufacturer_image as image',  'manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url', 'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date')
                //     ->where('manufacturers_info.languages_id', $language_id)->get();
                // $result['manufacturer'] = $getManufacturers;
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

                    //foreach($result['languages'] as $languages_data){
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
                              ['language_id', '=', $language_id],
                              ['products_id', '=', $products_id],

                          ])->select('products_description.*', 'imgrightbannert.path as imgright', 'imgleftbannert.path as imgleft')->first();

                    $result['description'] = $description;
                    $result['product'] = $product;
                    $categories = DB::table('products_to_categories')
                        ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                        ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                        ->where('products_id', '=', $products_id)->where('categories_description.language_id', '=', $language_id)
                        ->where('categories_status', '1')
                        ->get();

                    $categories_array = array();
                    foreach($categories as $category){
                         $categories_array['categories_id'] = $category->categories_id;
                        $categories_array['categories_name'] = $category->categories_name;
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

                //return $result;
                $responseData = array('success' => '1', 'data' => $result, 'message' => "Returned all products.");
             }else{
              $responseData = array('success' => '0','message' => "Invalid product id..");
             }
          }
         }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
         }
          $categoryResponse = json_encode($responseData);
          return $categoryResponse;
  }

  public static function displayProductVideos($request)
  {
    $consumer_data = array();
    $consumer_data['consumer_key'] = request()->header('consumer-key');
    $consumer_data['consumer_secret'] = request()->header('consumer-secret');
    $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
    $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
    $consumer_data['consumer_ip'] = request()->header('consumer-ip');
    $consumer_data['consumer_url'] = __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    if($authenticate == 1) {
      if($request->products_id == ''){
             $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $products_id = $request->products_id;
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
           if(!$products_video->isEmpty()){
               $responseData = array('success' => '1', 'data' => $products_video, 'message' => "Returned all products.");
           }else{
             $responseData = array('success' => '0','message' => "No data found");
           }

          }
    }else{
      $responseData = array('success' => '0','message' => "Unauthenticated call.");
    }
    $categoryResponse = json_encode($responseData);
    return $categoryResponse;
  }
  public static function addProductVideos($request)
  {
    $consumer_data = array();
    $consumer_data['consumer_key'] = request()->header('consumer-key');
    $consumer_data['consumer_secret'] = request()->header('consumer-secret');
    $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
    $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
    $consumer_data['consumer_ip'] = request()->header('consumer-ip');
    $consumer_data['consumer_url'] = __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data); 
    if($authenticate == 1) {
      if($request->products_id == '' || $request->products_video_link == '' || $request->image_id == ''){
             $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            $product_id = $request->products_id;
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

           $responseData = array('success' => '1','message' => "Product video added successfully"); 
          }
    }else{
      $responseData = array('success' => '0','message' => "Unauthenticated call.");
    }
    $categoryResponse = json_encode($responseData);
    return $categoryResponse;
  }
  public static function updateproductvideo($request)
  {
    $consumer_data = array();
    $consumer_data['consumer_key'] = request()->header('consumer-key');
    $consumer_data['consumer_secret'] = request()->header('consumer-secret');
    $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
    $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
    $consumer_data['consumer_ip'] = request()->header('consumer-ip');
    $consumer_data['consumer_url'] = __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data); 
    if($authenticate == 1) {
       if($request->products_id == '' || $request->products_video_link == '' || $request->image_id == '' || $request->edit_id == ''){
             $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
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

            $result = DB::table('product_video')->where('product_id', '=', $request->products_id)->where('id', '=', $request->edit_id)->update([
              'video_link' => $request->products_video_link,
              'image_id'   =>   $uploadImage,
                'youtube_id'   =>   $youtube_id,
            ]);
            $responseData = array('success' => '1','message' => "Product video updated successfully"); 
          }
    }else{
      $responseData = array('success' => '0','message' => "Unauthenticated call.");
    }
    $categoryResponse = json_encode($responseData);
    return $categoryResponse;
  }
  public static function deleteproductvideorecord($request)
  {
    $consumer_data = array();
    $consumer_data['consumer_key'] = request()->header('consumer-key');
    $consumer_data['consumer_secret'] = request()->header('consumer-secret');
    $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
    $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
    $consumer_data['consumer_ip'] = request()->header('consumer-ip');
    $consumer_data['consumer_url'] = __FUNCTION__;
    $authController = new AppSettingController();
    $authenticate = $authController->apiAuthenticate($consumer_data);
    if($authenticate == 1) {
      if($request->delete_id == '' ){
             $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
            DB::table('product_video')->where('id', $request->delete_id)->delete();
            $responseData = array('success' => '1','message' => "Product video delete successfully");
          }
    }else{
      $responseData = array('success' => '0','message' => "Unauthenticated call.");
    }
    $categoryResponse = json_encode($responseData);
    return $categoryResponse;
  }

  public static function getUserProduct($request)
  {
      $consumer_data = array();
      $consumer_data['consumer_key'] = request()->header('consumer-key');
      $consumer_data['consumer_secret'] = request()->header('consumer-secret');
      $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
      $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
      $consumer_data['consumer_ip'] = request()->header('consumer-ip');
      $consumer_data['consumer_url'] = __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate == 1) {

          $items = DB::table('categories')
            ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
            ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
            ->where('categories_description.language_id', '=', $request->language_id)
            ->where('categories.categories_status', 1)
            ->where('categories.parent_id', 0)
            ->groupBy('categories.categories_id')
            ->get();
            $result = array();
            if(!$items->isEmpty()){
                foreach ($items as $jesitems) {
                    $sub_cate = DB::table('categories')
                    ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
                    ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
                    ->where('categories_description.language_id', '=', $request->language_id)
                    ->where('categories.categories_status', 1)
                    ->where('categories.parent_id', $jesitems->categories_id)
                    ->groupBy('categories.categories_id')
                    ->get();

                      if (!$sub_cate->isEmpty()) { 
                          $jesitems->sub_category = $authController->getSubcateProduct($jesitems->categories_id,$request->language_id,$request->currency_code,$request->customers_id); 
                      }else{
                          $jesitems->sub_category = [];
                            $data = DB::table('products_to_categories')
                            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                            ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                            ->leftJoin('image_categories as proimg', 'products.products_image', '=', 'proimg.image_id')
                            ->select('products.*','proimg.path as product_image','proimg.path_type as image_path_type','products_description.products_name','products_description.products_description')
                            ->where('products_description.language_id', '=', $request->language_id)
                            ->where('products_to_categories.categories_id', '=', $jesitems->categories_id)
                            ->groupBy('products.products_id')
                            ->get();

                           if (!$data->isEmpty()) { 
                              $jesitems->product = $data;
                           }else{
                               $jesitems->product = [];
                           }
                      }
                      array_push($result, $jesitems);
                }
                 $responseData = array('success'=>'1', 'data'=>$result,'message'=>"Return all data."); 
            }else{
              $responseData = array('success' => '0','message' => "No data found");
            }
      }else{
        $responseData = array('success' => '0','message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);
      return $categoryResponse;
  }
  public static function getCategoriesProduct($request)
  {
      $consumer_data = array();
      $consumer_data['consumer_key'] = request()->header('consumer-key');
      $consumer_data['consumer_secret'] = request()->header('consumer-secret');
      $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
      $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
      $consumer_data['consumer_ip'] = request()->header('consumer-ip');
      $consumer_data['consumer_url'] = __FUNCTION__;
      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      if($authenticate == 1) {
        if($request->categories_id == '' || $request->language_id=='' || $request->currency_code == ''){
          $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
           //$data = $authController->getSubcateProduct($request->categories_id,$request->language_id); 
           //$responseData = array('success'=>'1', 'data'=>$data,'message'=>"Return all data.");

            $items = DB::table('categories')
            ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
            ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
            ->where('categories_description.language_id', '=', $request->language_id)
            ->where('categories_description.categories_id', '=', $request->categories_id)
            ->where('categories.categories_status', 1)
            ->where('categories.parent_id', 0)
            ->groupBy('categories.categories_id')
            ->orderBy('categories.CategoryOrder', 'ASC')
            ->get();
            $result = array();
            if(!$items->isEmpty()){
                foreach ($items as $jesitems) {
                    $sub_cate = DB::table('categories')
                    ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
                    ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
                    ->where('categories_description.language_id', '=', $request->language_id)
                    ->where('categories.categories_status', 1)
                    ->where('categories.parent_id', $jesitems->categories_id)
                    ->groupBy('categories.categories_id')
                    ->get();

                      if (!$sub_cate->isEmpty()) { 
                          $jesitems->sub_category = $authController->getSubcateProduct($jesitems->categories_id,$request->language_id,$request->currency_code,$request->customers_id); 


                            $data = DB::table('products_to_categories')
                            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                            ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                            ->leftJoin('image_categories as proimg', 'products.products_image', '=', 'proimg.image_id')
                            ->select('products.*','proimg.path as product_image','proimg.path_type as image_path_type','products_description.products_name','products_description.products_description')
                            ->where('products_description.language_id', '=', $request->language_id)
                            ->where('products_to_categories.categories_id', '=', $jesitems->categories_id)
                            ->groupBy('products.products_id')
                            ->get();

                           if (!$data->isEmpty()) { 
                              $jesitems->product = $authController->getCategoriesProduct($jesitems->categories_id,$request->language_id,$request->currency_code,$request->customers_id); 
                           }else{
                               $jesitems->product = [];
                           }

                      }else{
                          $jesitems->sub_category = [];
                            $data = DB::table('products_to_categories')
                            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                            ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                            ->leftJoin('image_categories as proimg', 'products.products_image', '=', 'proimg.image_id')
                            ->select('products.*','proimg.path as product_image','proimg.path_type as image_path_type','products_description.products_name','products_description.products_description')
                            ->where('products_description.language_id', '=', $request->language_id)
                            ->where('products_to_categories.categories_id', '=', $jesitems->categories_id)
                            ->groupBy('products.products_id')
                            ->get();

                           if (!$data->isEmpty()) { 
                              $jesitems->product = $authController->getCategoriesProduct($jesitems->categories_id,$request->language_id,$request->currency_code,$request->customers_id);
                           }else{
                               $jesitems->product = [];
                           }
                      }
                      array_push($result, $jesitems);
                }
                 $responseData = array('success'=>'1', 'data'=>$result,'message'=>"Return all data."); 
            }else{
              $responseData = array('success' => '0','message' => "No data found");
            } 
        }
      }else{
        $responseData = array('success' => '0','message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);
      return $categoryResponse;
  }






/*           qrorder             */



  public static function gettablecategories($request)
  {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        
        if ($authenticate == 1) {
              if($request->language_id == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
              }else{
                $items = DB::table('categories')
              ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
              ->leftJoin('image_categories as cateimg', 'categories.categories_image', '=', 'cateimg.image_id')
              ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
              ->select('categories.categories_id', 'image_categories.path as cate_icon_path', 'image_categories.path_type as icon_path_type', 'categories.categories_slug as slug', 'categories_description.categories_name', 'categories.parent_id','categories.categories_status','categories_description.categories_description','cateimg.path as cate_image_path','cateimg.path_type as image_path_type','categories.categories_icon as categories_icon_id','categories.categories_image as categories_image_id')
              ->where('categories_description.language_id', '=', $request->language_id)
              ->where('categories.categories_status', 1)
              ->groupBy('categories.categories_id')
              ->orderBy('categories.CategoryOrder', 'ASC')
              ->get();
          if ($items->isNotEmpty()) {
              $childs = array();
              foreach ($items as $item) {
                  $childs[$item->parent_id][] = $item;
              }

              foreach ($items as $item) {
                  if (isset($childs[$item->categories_id])) {
                      $item->childs = $childs[$item->categories_id];
                  }else{
                      $item->childs=[];
                  }
              }

              $tree = $childs[0];
              }
              $responseData = array('success' => '1', 'data' => $tree, 'message' => "Returned all categories.");
            }
        }else{
            $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
  }

  public static function gettableproducts($request)
  {
      $language_id = $request->language_id;
      $skip = $request->page_number . '0';
      $currentDate = time();
      $type = $request->type;

      //filter
    if(!empty($request->price)){
        $minPrice = $request->price['minPrice'];
        $maxPrices = $request->price['maxPrice'];

        $required_currency = DB::table('currencies')->where('is_current',1)->where('code', $request->currency_code)->first();
        $maxPrice = $maxPrices / $required_currency->value;
    }

      $consumer_data = array();
      $consumer_data['consumer_key'] = request()->header('consumer-key');
      $consumer_data['consumer_secret'] = request()->header('consumer-secret');
      $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
      $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
      $consumer_data['consumer_ip'] = request()->header('consumer-ip');
      $consumer_data['consumer_url'] = __FUNCTION__;

      $authController = new AppSettingController();
      $authenticate = $authController->apiAuthenticate($consumer_data);
      
      $settings = $authController->getSetting();
      $setting = $authController->getSetting();
        $collection_product =$settings['collection_product'];

      if ($authenticate == 1) {

          if ($type == "a to z") {
              $sortby = "products_name";
              $order = "ASC";
          } elseif ($type == "z to a") {
              $sortby = "products_name";
              $order = "DESC";
          } elseif ($type == "high to low") {
              $sortby = "products_filter_price";
              $order = "DESC";
          } elseif ($type == "low to high") {
              $sortby = "products_filter_price";
              $order = "ASC";
          } elseif ($type == "top seller") {
              $sortby = "products_ordered";
              $order = "DESC";
          } elseif ($type == "most liked") {
              $sortby = "products_liked";
              $order = "DESC";
          }
          
          elseif ($type == "special") {
            if($collection_product == '1')
            {
            $sortby = "collections_product.product_id";
            $order = "desc";
            }
            else
            {
                $sortby = "specials.products_id";
                $order = "desc";
            }
        } 
        elseif ($type == "flashsale") { //flashsale products
              $sortby = "flash_sale.flash_start_date";
              $order = "asc";
          } else {
              $sortby = "products.products_id";
              $order = "desc";
          }
          $searchValue ='';
          if($request->searchValue != '')
          {
          $searchValue = $request->searchValue;
          }

          $filterProducts = array();
          $eliminateRecord = array();
          $videosarray = '';
          $videoslatarray = array();
          if (!empty($request->filters)) {

            //print_r($request->filters);die();

              foreach ($request->filters as $filters_attribute) {

                  $data = DB::table('products_to_categories')
                      ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                      ->join('products', 'products.products_id', '=', 'products_to_categories.products_id')
                      ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                      ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                      ->LeftJoin('specials', function ($join) use ($currentDate) {
                          $join->on('specials.products_id', '=', 'products_to_categories.products_id')
                              ->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                      })

                      ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                      ->leftJoin('products_attributes', 'products_attributes.products_id', '=', 'products.products_id')
                      ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                      ->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')

                      ->select('products.*')
                      ->orwhere('products_description.products_name', 'LIKE', '%' . $searchValue . '%')
                      ->where('products_description.language_id', '=', $language_id)
                      ->whereBetween('products.products_filter_price', [$minPrice, $maxPrice]);
                      //->where('categories.parent_id', '!=', '0');

                  if (!empty($request->categories_id)) {
                      $data->where('products_to_categories.categories_id', '=', $request->categories_id);
                  }

                  if (!empty($request->brand_id)) {
                    $data->where('products.manufacturers_id', '=', $request->brand_id);
                    
                  }

                
                  $getProducts = $data->where('products_options_descriptions.options_name', '=', $filters_attribute['name'])
                      ->where('products_options_values_descriptions.options_values_name', '=', $filters_attribute['value'])
                      ->where('products.products_status', '=', '1')
                      //->skip($skip)->take(10)
                      ->groupBy('products.products_id')
                      ->get();

                  $foundRecord[] = $getProducts;

                 

                  

                  if (count($foundRecord) > 0) {
                      foreach ($getProducts as $getProduct) {
                       
                          if (!in_array($getProduct->products_id, $eliminateRecord)) {
                              $eliminateRecord[] = $getProduct->products_id;
                              //print_r($getProduct->products_id);die();
                              $productss = DB::table('products_to_categories')
                                  ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                                  ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                                  ->leftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                                  ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                                  ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                                  ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                                  ->leftJoin('specials', function ($join) use ($currentDate) {
                                      $join->on('specials.products_id', '=', 'products_to_categories.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                                  })
                                  ->LeftJoin('image_categories', function ($join) {
                                      $join->on('image_categories.image_id', '=', 'products.products_image')
                                          ->where(function ($query) {
                                              $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                                  ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                                  ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                          });
                                  })

                                  ->select('products_to_categories.*', 'products.*', 'image_categories.path as products_image','image_categories.path_type as path_type',  'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'products_to_categories.categories_id', 'categories_description.*')
                                  ->where('categories_description.language_id', '=', $language_id)
                                  ->where('products_description.language_id', '=', $language_id)
                                  ->where('products.products_id', '=', $getProduct->products_id);

                                  if (!empty($request->categories_id)) {
                                    $productss->where('products_to_categories.categories_id', '=', $request->categories_id);
                                }
                                  //->where('categories.parent_id', '!=', '0')
                                  $products = $productss->get();
                              $result = array();
                              $index = 0;
                              //print_r($products);die();
                              foreach ($products as $products_data) {
                                //check currency start
                                $requested_currency = $request->currency_code;
                                $current_price = $products_data->products_price;


                                  $products_price = Product::convertprice($current_price, $requested_currency);

                                  ////////// for discount price    /////////
                                  if(!empty($products_data->discount_price)){
                                    $discount_price = Product::convertprice($products_data->discount_price, $requested_currency);
                                    $products_data->discount_price = $discount_price;
                                  }


                                $products_data->products_price = $products_price;
                                $products_data->currency = $requested_currency;
                                //check currency end
                                  $products_id = $products_data->products_id;
                                  $products_description_new = stripslashes($products_data->products_description);
                                  $products_data->products_description_new = $products_description_new;

                                $current_date = date("Y-m-d", strtotime("now"));
                                $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products_data->products_id)->first();
                                $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
                                $date=date_create($string);
                                date_add($date,date_interval_create_from_date_string($setting['new_product_duration']." days")); 
                                $after_date = date_format($date,"Y-m-d");
                                if($after_date >= $current_date){
                                    $products_data->is_new = 1;
                                }
                                else
                                {
                                    $products_data->is_new = 0;
                                }

                                  $products_video_link = $products_data->products_video_link;
                                  

                                  //multiple images
                                  $products_images = DB::table('products_images')
                                      ->LeftJoin('image_categories', function ($join) {
                                          $join->on('image_categories.image_id', '=', 'products_images.image')
                                              ->where(function ($query) {
                                                  $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                                      ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                                      ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                              });
                                      })
                                      ->select('products_images.*', 'image_categories.path as image','image_categories.path_type as path_type')
                                      ->where('products_id', '=', $products_id)->orderBy('sort_order', 'ASC')->get();

                                   $products_data->images = $products_images;

                                   $products_videos = DB::table('product_video')
                      ->LeftJoin('image_categories', function ($join) {
                        $join->on('image_categories.image_id', '=', 'product_video.image_id')
                            ->where(function ($query) {
                                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                            });
                    })
                      ->select('product_video.*', 'image_categories.path as image','image_categories.path_type as path_type')
                      ->where('product_id', '=', $products_id)->orderBy('id', 'ASC')->get();

                  $products_data->videos = $products_videos;
           

                                  $categories = DB::table('products_to_categories')
                                      ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                                      ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                                      ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                                      ->where('products_id', '=', $products_id)
                                      ->where('categories_description.language_id', '=', $language_id)->get();

                                  $products_data->categories = $categories;

                                  $reviews = DB::table('reviews')
                                      ->join('users', 'users.id', '=', 'reviews.customers_id')
                                      ->select('reviews.*', 'users.avatar as image')
                                      ->where('products_id', $products_data->products_id)
                                      ->where('reviews_status', '1')
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

                                      $avarage_rate = (5 * $five_star + 4 * $four_star + 3 * $three_star + 2 * $two_star + 1 * $one_star) / ($five_star + $four_star + $three_star + $two_star + $one_star);
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

                                  array_push($result, $products_data);

                                  $options = array();
                                  $attr = array();

                                  //like product
                                  if (!empty($request->customers_id)) {
                                      $liked_customers_id = $request->customers_id;
                                      $categories = DB::table('liked_products')->where('liked_products_id', '=', $products_id)->where('liked_customers_id', '=', $liked_customers_id)->get();
                                      if (count($categories) > 0) {
                                          $result[$index]->isLiked = '1';
                                      } else {
                                          $result[$index]->isLiked = '0';
                                      }
                                  } else {
                                      $result[$index]->isLiked = '0';
                                  }

                                  $stocks = 0;
                                  $stockOut = 0;
                                  $defaultStock = 0;
                                  if ($products_data->products_type == '0' || $products_data->products_type == '1') {
                                      $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                                      $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                                      $defaultStock = $stocks - $stockOut;
                                  }else{
                                      //$attristock = $authController->getPosAttributesStock($products_data->products_id);
                                      $defaultStock = '0';
                                  }

                                  if ($products_data->products_max_stock < $defaultStock && $products_data->products_max_stock > 0) {
                                      $result[$index]->defaultStock = $products_data->products_max_stock;
                                  } else {
                                      $result[$index]->defaultStock = $defaultStock;
                                  }

                                  // fetch all options add join from products_options table for option name
                                  $products_attribute = DB::table('products_attributes')->where('products_id', '=', $products_id)->groupBy('options_id')->get();
                                  if (count($products_attribute) > 0) {
                                      $index2 = 0;
                                      foreach ($products_attribute as $attribute_data) {
                                          $option_name = DB::table('products_options')
                                              ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                                          if (count($option_name) > 0) {
                                              $temp = array();
                                              $temp_option['id'] = $attribute_data->options_id;
                                              $temp_option['options_required'] = $option_name[0]->options_required;
                                              $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                                              $temp_option['name'] = $option_name[0]->products_options_name;
                                              $attr[$index2]['option'] = $temp_option;

                                              // fetch all attributes add join from products_options_values table for option value name
                                              $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                                              foreach ($attributes_value_query as $products_option_value) {
                                                  $option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name')->where('products_options_values_descriptions.language_id', '=', $language_id)->where('products_options_values.products_options_values_id', '=', $products_option_value->options_values_id)->get();
                                                  $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
                                                  $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                                  $temp_i['id'] = $products_option_value->options_values_id;
                                                  $temp_i['value'] = $option_value[0]->products_options_values_name;
                                                  //check currency start
                                                  $current_price = $products_option_value->options_values_price;
                                                  $attr_weight = $products_option_value->weight;
                                                  $attr_weight_unit = $products_option_value->weight_unit;


                                                  $attribute_price = Product::convertprice($current_price, $requested_currency);


                                                  //check currency end

                                                  $temp_i['price'] = $attribute_price;
                                                  $temp_i['weight'] = $attr_weight;
                                                  $temp_i['weight_unit'] = $attr_weight_unit;
                                                  $temp_i['price_prefix'] = $products_option_value->price_prefix;
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
                                  array_push($filterProducts, $result[$index]);
                                  $index++;
                              }
                          }
                      }
                      $responseData = array('success' => '1', 'product_data' => $filterProducts, 'message' => "Returned all products.", 'total_record' => count($filterProducts));
                  } else {
                      $total_record = array();
                      $responseData = array('success' => '0', 'product_data' => $filterProducts, 'message' => "Search results empty.", 'total_record' => count($total_record));
                  }
              }
          } else {

              $categories = DB::table('products')
                  ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                  ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                  ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id');

              $categories->LeftJoin('image_categories', function ($join) {
                  $join->on('image_categories.image_id', '=', 'products.products_image')
                      ->where(function ($query) {
                          $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                              ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                      });
              });

              if (!empty($request->categories_id)) {

                  $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                      ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                      ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id');
              }
              else
              {
                $categories->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id');
              }

              

            

              //wishlist customer id
              if ($type == "wishlist") {
                  $categories->LeftJoin('liked_products', 'liked_products.liked_products_id', '=', 'products.products_id')
                  ->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                  ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'image_categories.path as products_image','image_categories.path_type as path_type','specials.specials_new_products_price as discount_price','image_categories.image_id as old_image_id');;
              }

              elseif ($type == "top seller") {
                if($collection_product == '1')
                {
                    $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                    $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                    ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
                else
                {
                    $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                    ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
            }
            elseif ($type == "most liked") {
                if($collection_product == '1')
                {
                    $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                    $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
                else
                {
                    $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                    ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
            }
             //parameter special
    
             elseif ($type == "special") {
                if($collection_product == '1')
                {
                        $categories->leftJoin('collections_product', 'collections_product.product_id', '=', 'products.products_id');
                        $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                        ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
                else
                {
                    $categories->LeftJoin('specials', 'specials.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
                }
            }

           
          
             
             elseif ($type == "flashsale") {
                  //flash sale
                  $categories->
                      LeftJoin('flash_sale', 'flash_sale.products_id', '=', 'products.products_id')
                      ->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_start_date', 'flash_sale.flash_expires_date', 'flash_sale.flash_sale_products_price as flash_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');

              } else {
                  $categories->LeftJoin('specials', function ($join) use ($currentDate) {
                      $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1')->where('expires_date', '>', $currentDate);
                  })->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'specials.specials_new_products_price as discount_price', 'image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');
              }
              $categories->orwhere('products_description.products_name', 'LIKE', '%' . $searchValue . '%');

              if ($type == "special") {
                if($collection_product == '1')
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
              } 
              else {
                // if (!isset($request->products_id)) {
                //     $categories->whereNotIn('products.products_id', function ($query) {
                //         $query->select('flash_sale.products_id')->from('flash_sale');
                //     });
                // }else{
                    $isFlash = DB::table('flash_sale')->where('flash_sale.products_id', '=', $request->products_id)->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate)->first();
                    //dd($isFlash);
                    if($isFlash){
                        $categories->LeftJoin('flash_sale', function ($join) use ($currentDate) {
                            $join->on('flash_sale.products_id', '=', 'products.products_id')->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate);
                        })->select(DB::raw(time() . ' as server_time'), 'products.*', 'products_description.*', 'manufacturers.*', 'manufacturers_info.manufacturers_url', 'flash_sale.flash_sale_products_price as flash_price', 'flash_sale.flash_start_date','flash_sale.flash_expires_date','image_categories.path as products_image','image_categories.path_type as path_type','image_categories.image_id as old_image_id');

                      
                        
                        $type = "flashsale";

                    }
                    
                //}
                  
              }

              //get single category products
              if (!empty($request->categories_id)) {
                  $categories->where('products_to_categories.categories_id', '=', $request->categories_id)
                      ->where('categories_description.language_id', '=', $language_id);
              }
              else
              {
                $categories->where('categories.categories_status', '=', 1);
                $categories->groupBy('products_to_categories.products_id');
              }

              if (!empty($request->brand_id)) {
                $categories->where('products.manufacturers_id', '=', $request->brand_id);
              
              }

             

              //get single products
              if (!empty($request->products_id) && $request->products_id != "") {
                  $categories->where('products.products_id', '=', $request->products_id);
              }
              //get multiple product multiple_products_id
              if (!empty($request->multiple_products_id) && $request->multiple_products_id != "") {

              
                $multiple_products_id = explode(",", $request->multiple_products_id);
              
                  $categories->whereIn('products.products_id', $multiple_products_id);
            }

              //for min and maximum price
              if (!empty($maxPrice)) {
                  $categories->whereBetween('products.products_filter_price', [$minPrice, $maxPrice]);
              }

              if ($type == "top seller") {
                if($collection_product == '1')
                {
                    $categories->where('collections_product.collection_id', 1);
                    $categories->where('collections_product.status', 1);
                   
                }
                else
                {
                $categories->where('products.products_ordered', '>', 0);
                }
            }
    
            if ($type == "most liked") {
                if($collection_product == '1')
                {
                    $categories->where('collections_product.collection_id', 3);
                    $categories->where('collections_product.status', 1);
                   
                }
                else
                {
                $categories->where('products.products_liked', '>', 0);
                }
            }
    
              //wishlist customer id
              if ($type == "wishlist") {
                  $categories->where('liked_customers_id', '=', $request->customers_id);
              }

              $categories->where('products_description.language_id', '=', $language_id)
                  ->where('products.products_status', '=', '1')
                  ->orderBy($sortby, $order);

              if ($type == "special") { //deals special products
                  $categories->groupBy('products.products_id');
              }
              //count
              $total_record = $categories->get();

              //$data = $categories->skip($skip)->take(10)->get();

              $data = $categories->get();

              $result = array();
              $result2 = array();
              //check if record exist
              if (count($data) > 0) {
                  $index = 0;
                  foreach ($data as $products_data) {

                        //check currency start
                        $requested_currency = $request->currency_code;
                        $current_price = $products_data->products_price;
                        //dd($current_price, $requested_currency);

                        $products_price = Product::convertprice($current_price, $requested_currency);
                        ////////// for discount price    /////////
                        if(!empty($products_data->discount_price)){
                            $discount_price = Product::convertprice($products_data->discount_price, $requested_currency);
                            $products_data->discount_price = $discount_price;
                        }

                      $products_data->products_price = $products_price;
                      $products_data->currency = $requested_currency;
                      $products_description_new = stripslashes($products_data->products_description);
                      $products_data->products_description_new = $products_description_new;
                      //check currency end
                      $current_date = date("Y-m-d", strtotime("now"));
                                $created_date = DB::table('products')->select('products.created_at')->where('products_id', $products_data->products_id)->first();
                                $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));
                                $date=date_create($string);
                                date_add($date,date_interval_create_from_date_string($setting['new_product_duration']." days")); 
                                $after_date = date_format($date,"Y-m-d");
                                if($after_date >= $current_date){
                                    $products_data->is_new = 1;
                                }
                                else
                                {
                                    $products_data->is_new = 0;
                                }



                      //for flashsale currency price start
                      if ($type == "flashsale"){
                        $current_price = $products_data->flash_price;
                        $flash_price = Product::convertprice($current_price, $requested_currency);
                        $products_data->flash_price = $flash_price;
                      }

                      //for flashsale currency price end
                      $products_id = $products_data->products_id;
                      $products_video_link = $products_data->products_video_link;

                      //multiple images
                      $products_images = DB::table('products_images')
                          ->LeftJoin('image_categories', function ($join) {
                              $join->on('image_categories.image_id', '=', 'products_images.image')
                                  ->where(function ($query) {
                                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                                  });
                          })
                          ->select('products_images.*', 'image_categories.path as image','image_categories.path_type as path_type')
                          ->where('products_id', '=', $products_id)->orderBy('sort_order', 'ASC')->get();
                          
                      $products_data->images = $products_images;
                      


                      $products_videos = DB::table('product_video')
                      ->LeftJoin('image_categories', function ($join) {
                        $join->on('image_categories.image_id', '=', 'product_video.image_id')
                            ->where(function ($query) {
                                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                            });
                    })
                      ->select('product_video.*', 'image_categories.path as image','image_categories.path_type as path_type')
                      ->where('product_id', '=', $products_id)->orderBy('id', 'ASC')->get();

                  $products_data->videos = $products_videos;

                      $categories = DB::table('products_to_categories')
                          ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                          ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                          ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                          ->where('products_id', '=', $products_id)
                          ->where('categories_description.language_id', '=', $language_id)->get();

                      $products_data->categories = $categories;

                      $reviews = DB::table('reviews')
                          ->join('users', 'users.id', '=', 'reviews.customers_id')
                          ->select('reviews.*', 'users.avatar as image')
                          ->where('products_id', $products_data->products_id)
                          ->where('reviews_status', '1')
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

                      array_push($result, $products_data);
                      $options = array();
                      $attr = array();

                      $stocks = 0;
                      $stockOut = 0;
                      $defaultStock = 0;
                      if ($products_data->products_type == '0' || $products_data->products_type == '1') {
                          $stocks = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                          $defaultStock = $stocks - $stockOut;
                      }else{
                          //$attristock = $authController->getPosAttributesStock($products_data->products_id);
                          $defaultStock = '0';
                      }

                      if ($products_data->products_max_stock < $defaultStock && $products_data->products_max_stock > 0) {
                          $result[$index]->defaultStock = $products_data->products_max_stock;
                      } else {
                          $result[$index]->defaultStock = $defaultStock;
                      }

                      //like product
                      if (!empty($request->customers_id)) {
                          $liked_customers_id = $request->customers_id;
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
                      if (count($products_attribute) > 0) {
                          $index2 = 0;
                          foreach ($products_attribute as $attribute_data) {
                              $option_name = DB::table('products_options')
                                  ->leftJoin('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name', 'products_options_descriptions.language_id','products_options.options_required','products_options.options_select_type')->where('language_id', '=', $language_id)->where('products_options.products_options_id', '=', $attribute_data->options_id)->get();
                              if (count($option_name) > 0) {
                                  $temp = array();
                                  $temp_option['id'] = $attribute_data->options_id;
                                  $temp_option['name'] = $option_name[0]->products_options_name;
                                  $temp_option['options_required'] = $option_name[0]->options_required;
                                  $temp_option['options_select_type'] = $option_name[0]->options_select_type;
                                  $attr[$index2]['option'] = $temp_option;

                                  // fetch all attributes add join from products_options_values table for option value name
                                  $attributes_value_query = DB::table('products_attributes')->where('products_id', '=', $products_id)->where('options_id', '=', $attribute_data->options_id)->get();
                                  foreach ($attributes_value_query as $products_option_value) {

                                      //$option_value = DB::table('products_options_values')->leftJoin('products_options_values_descriptions','products_options_values_descriptions.products_options_values_id','=','products_options_values.products_options_values_id')->select('products_options_values.products_options_values_id', 'products_options_values_descriptions.options_values_name as products_options_values_name' )->where('products_options_values_descriptions.language_id','=', $language_id)->where('products_options_values.products_options_values_id','=', $products_option_value->options_values_id)->get();
                                      $option_value = DB::table('products_options_values')->where('products_options_values_id', '=', $products_option_value->options_values_id)->get();

                                      $attributes = DB::table('products_attributes')->where([['products_id', '=', $products_id], ['options_id', '=', $attribute_data->options_id], ['options_values_id', '=', $products_option_value->options_values_id]])->get();
                                      $temp_i['products_attributes_id'] = $attributes[0]->products_attributes_id;
                                      $temp_i['id'] = $products_option_value->options_values_id;

                                      if (!empty($option_value[0]->products_options_values_name)) {
                                          $temp_i['value'] = $option_value[0]->products_options_values_name;
                                      } else {
                                          $temp_i['value'] = '';
                                      }

                                      //check currency start
                                      $current_price = $products_option_value->options_values_price;

                                      $attribute_price = Product::convertprice($current_price, $requested_currency);

                                      $attr_weight = $products_option_value->weight;
                                        $attr_weight_unit = $products_option_value->weight_unit;



                                      //check currency end

                                      //$temp_i['price'] = $products_option_value->options_values_price;
                                      $temp_i['price'] = $attribute_price;
                                      $temp_i['weight'] = $attr_weight;
                                      $temp_i['weight_unit'] = $attr_weight_unit;
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

                  $responseData = array('success' => '1', 'product_data' => $result, 'message' => "Returned all products.", 'total_record' => count($total_record));
              } else {
                  $responseData = array('success' => '0', 'product_data' => $result, 'message' => "Empty record.", 'total_record' => count($total_record));
              }
          }
      } else {
          $responseData = array('success' => '0', 'product_data' => array(), 'message' => "Unauthenticated call.");
      }
      $categoryResponse = json_encode($responseData);

      return $categoryResponse;
  }

  public static function addtableCart($request){

		$products = new Products();
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']         =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->products_id == '' || $request->quantity == '' || $request->session_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
                $cid=$request->session_id;
                //$already = DB::table('customers_basket')->where('session_id',$request->session_id)->where('products_id', $request->products_id)->first();
                //print_r($result);die();
                //if($already){
                 //$responseData = array('success'=>'0','message'=>"This product is already added in cart");     
                //}else{
          			$products_id=$request->products_id;
		          	if (empty($request->customers_id)) {
		            	$customers_id = '';
		       		} else {
		            	$customers_id = $request->customers_id;
                        DB::table('customers_basket')->where([
                        ['session_id', '=', $request->session_id],
                        ['is_order', '=', '0'],
                        ['hold_status', '=', '0'],
                    ])->update(
                        [
                            'customers_id' => $customers_id,
                        ]);
		        	}

		        	$session_id = $request->session_id;
		        	$customers_basket_date_added = date('Y-m-d H:i:s');

		if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

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

         //discount_price
        if (!empty($request->discount_price)) {
            $discountprice = $request->discount_price;
        } else {
            $discountprice = '0.00';
        }

		        	if (empty($customers_id)) {

		        		$exist = DB::table('customers_basket')->where([
			                ['session_id', '=', $session_id],
			                ['products_id', '=', $products_id],
			                ['is_order', '=', 0],
                            ['serve_status', '=', 0],
			            ])->get();

		        	}else{

		        		$exist = DB::table('customers_basket')->where([
                            ['session_id', '=', $session_id],
			                ['customers_id', '=', $customers_id],
			                ['products_id', '=', $products_id],
			                ['is_order', '=', 0],
                            ['serve_status', '=', 0],
			            ])->get();

		        	}
		        	$isFlash = DB::table('flash_sale')->where('products_id', $products_id)
		            ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
		            ->get();
			           //get products detail  is not default
				        if (!empty($isFlash) and count($isFlash) > 0) {
				            $type = "flashsale";
				        } else {
				            $type = "";
				        }

				      $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
				      $detail = $products->products($data);
        			  $result['detail'] = $detail;

        			  //print_r($detail);die();

        	if ($result['detail']['product_data'][0]->products_type == 0) {

            //check lower value to match with added stock
            if ($result['detail']['product_data'][0]->products_max_stock != null and $result['detail']['product_data'][0]->products_max_stock < $result['detail']['product_data'][0]->defaultStock) {
                $default_stock = $result['detail']['product_data'][0]->products_max_stock;
            } else {
                $default_stock = $result['detail']['product_data'][0]->defaultStock;
            }

            if (!empty($exist) and count($exist) > 0) {
                $count = $exist[0]->customers_basket_quantity + $request->quantity;
                $remain = $result['detail']['product_data'][0]->defaultStock - $exist[0]->customers_basket_quantity;

                if ($count > $default_stock){

                   // return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                }

                // if ($count >= $result['detail']['product_data'][0]->defaultStock || $count > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {

                //     return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                // }
            } else {

                //if ($request->quantity > $result['detail']['product_data'][0]->defaultStock || $request->quantity > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {
                if ($request->quantity > $default_stock) {
                    $count = $request->quantity;
                    $remain = $result['detail']['product_data'][0]->defaultStock - $count;
                   // return array('status' => 'exceed');
                }
            }
        }

        if (!empty($result['detail']['product_data'][0]->flash_price)) {
            $final_price = $result['detail']['product_data'][0]->flash_price + 0;
        } elseif (!empty($result['detail']['product_data'][0]->discount_price)) {
            $final_price = $result['detail']['product_data'][0]->discount_price + 0;
        } else {
            $final_price = $result['detail']['product_data'][0]->products_price + 0;
        }

        //$variables_prices = 0
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $attributeid = $request->attributeid;
            $attribute_price = 0;
            if (!empty($attributeid) and count($attributeid) > 0) {

                foreach ($attributeid as $attribute) {
                    $attribute = DB::table('products_attributes')->where('products_attributes_id', $attribute)->first();
                    $symbol = $attribute->price_prefix;
                    $values_price = $attribute->options_values_price;
                    if ($symbol == '+') {
                        //$final_price = intval($final_price) + intval($values_price);
                        $final_price = $final_price + $values_price;
                    }
                    if ($symbol == '-') {
                        //$final_price = intval($final_price) - intval($values_price);
                        $final_price = $final_price - $values_price;
                    }
                }
            }

        }

        //check quantity
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $qunatity['products_id'] = $request->products_id;
            $qunatity['attributes'] = $attributeid;

            $content = $products->productQuantity($qunatity);
            //dd($content);
            $stocks = $content['remainingStock'];

        } else {
            $stocks = $result['detail']['product_data'][0]->defaultStock;

        }

        if ($stocks <= $result['detail']['product_data'][0]->products_max_stock or $result['detail']['product_data'][0]->products_max_stock ==0) {
            $stocksToValid = $stocks;
        } else {
            $stocksToValid = $result['detail']['product_data'][0]->products_max_stock;
        }

        //check variable stock limit
        if (!empty($exist) and count($exist) > 0) {
            $count = $exist[0]->customers_basket_quantity + $request->quantity;
            if ($count > $stocksToValid) {
                // return array('status' => 'exceed');
            }
        }

        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($stocksToValid > $customers_basket_quantity) {
            $customers_basket_quantity = $result['detail']['product_data'][0]->products_min_order;
        }

        //quantity is not default
        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($request->customers_basket_id) {
            $basket_id = $request->customers_basket_id;
            DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                [
                    'customers_id' => $customers_id,
                    'products_id' => $products_id,
                    'session_id' => $session_id,
                    'customers_basket_quantity' => $customers_basket_quantity,
                    'final_price' => $final_price,
                    'customers_basket_date_added' => $customers_basket_date_added,
                ]);

            if (count($request->option_id) > 0) {
                foreach ($request->option_id as $key => $option_id) {

                    DB::table('customers_basket_attributes')->where([
                        ['customers_basket_id', '=', $basket_id],
                        ['products_id', '=', $products_id],
                        ['products_options_id', '=', $option_id],
                    ])->update(
                        [
                            'customers_id' => $customers_id,
                            'products_options_values_id' => $request->options_values_id[$key],
                            'session_id' => $session_id,
                        ]);
                }

            }
        } else {
            //insert into cart
            if (count($exist) == 0) {

                // get product
                $prodata = DB::table('products')->where('products_id', '=',$products_id)->first();
                $totalqnt = $customers_basket_quantity*$prodata->quantity_count;

                $customers_basket_id = DB::table('customers_basket')->insertGetId(
                    [
                        'customers_id' => $customers_id,
                        'products_id' => $products_id,
                        'session_id' => $session_id,
                        'customers_basket_quantity' => $customers_basket_quantity,
                        'total_basket_quantity'=> $totalqnt,
                        'final_price' => $final_price,
                        'original_price'=> $final_price,
                        'customers_basket_date_added' => $customers_basket_date_added,
                        'order_source' => 'normal',
                        'discount_price' => $discountprice,
                    ]);

                if (!empty($request->option_id) && count($request->option_id) > 0) {
                    foreach ($request->option_id as $key => $option_id) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $option_id,
                                'products_options_values_id' => $request->options_values_id[$key],
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);

                    $attdata = DB::table('products_attributes')->where(['products_id'=>$products_id,'options_id'=>$option_id,'options_values_id'=>$request->options_values_id[$key]])->first();
                     // update total_basket_quantity
                        $total_att = $customers_basket_quantity*$attdata->quantity_count;
                        DB::table('customers_basket')->where('customers_basket_id', $customers_basket_id)->update([
                                'total_basket_quantity'     => $total_att,
                            ]);
                    }

                } else if (!empty($detail['product_data'][0]->attributes)) {

                    foreach ($detail['product_data'][0]->attributes as $attribute) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $attribute['option']['id'],
                                'products_options_values_id' => $attribute['values'][0]['id'],
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);
                    }
                }
            } else {

                $existAttribute = '0';
                $totalAttribute = '0';
                $basket_id = '0';

                if (!empty($request->option_id)) {
                    if (count($request->option_id) > 0) {

                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($request->option_id as $key => $option_id) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $request->options_values_id[$key]],
                                    ['session_id', '=', $session_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }

                            }

                            if ($totalAttribute == $existAttribute) {
                                $basket_id = $exists->customers_basket_id;
                            }
                        }

                    } else
                    if (!empty($detail['product_data'][0]->attributes)) {
                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($detail['product_data'][0]->attributes as $attribute) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $attribute['option']['id']],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $attribute['values'][0]['id']],
                                    ['products_options_id', '=', $option_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }
                                if ($totalAttribute == $existAttribute) {
                                    $basket_id = $exists->customers_basket_id;
                                }
                            }
                        }

                    }

                    //attribute exist
                    if ($basket_id == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'original_price'=> $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                                'order_source' => 'normal',
                                'discount_price' => $discountprice,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $key => $option_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $option_id,
                                        'products_options_values_id' => $request->options_values_id[$key],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    } else {

                        //update into cart
                        DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $keey => $option_id) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        //'products_options_values_id' => $request->options_values_id[$keey],
                                        'session_id' => $session_id,
                                    ]);
                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    }

                } else {
                    //update into cart
                    DB::table('customers_basket')->where('customers_basket_id', '=', $exist[0]->customers_basket_id)->update(
                        [
                            'customers_id' => $customers_id,
                            'products_id' => $products_id,
                            'session_id' => $session_id,
                            'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                            'final_price' => $final_price,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }

		        }
        }
            //update coupons amount
            $coupon = DB::table('temp_pos_coupons')->where('session_id',$session_id)->whereIn('discount_type', ['fixed_cart', 'percent'])->first();
            if($coupon){
                $coupon_data = DB::table('coupons')->where('coupans_id',$coupon->coupon_id)->first();
                // total amount
                $cart_price=0;
                $cdata = DB::table('customers_basket')->where('session_id',$session_id)->where('is_order','0')->get();
                if(!$cdata->isEmpty()){
                    foreach ($cdata as $jescdata) {
                       $cart_price=$cart_price+($jescdata->final_price*$jescdata->customers_basket_quantity); 
                    }
                }
               if($coupon->discount_type=='fixed_cart'){
                    if ($coupon->amount < $cart_price) {
                        $coupon_discount = $coupon->amount;
                    }else{
                        $coupon_discount = $cart_price;
                    }
               }elseif($coupon->discount_type == 'percent'){
                    $current_discount = $coupon->amount / 100 * $cart_price;
                    $ccart_price = $cart_price - $current_discount;
                    if ($ccart_price > 0) {
                        if(!empty($coupon_data->cap_amount)){
                            if($current_discount < $coupon_data->cap_amount){
                                $coupon_discount = $current_discount;
                            }else{
                                $coupon_discount = $coupon_data->cap_amount;
                            }
                        }else{
                            $coupon_discount = $current_discount;
                        }
                    }else{
                        $coupon_discount = $cart_price;
                    }
               }
               // update coupons
               DB::table('temp_pos_coupons')->where('session_id', '=', $session_id)->update(
                [
                    'discount' => $coupon_discount,
                ]);   
            }
            $cartdata = $authController->viewposCartDetails($session_id);
            $cartuser = $authController->getPosCartUser($session_id);
            $cartcoupons = $authController->getPosCartCoupons($session_id);
            $cartdiscount = $authController->getPosCartDiscount($session_id);
            $gettable = $authController->getPosBookTable($session_id);
            $gethold = $authController->getPosHold($session_id);
            $getsaleman = $authController->getSaleMan($session_id);
            //print_r($cartdata);die();
        	$responseData = array('success'=>'1','message'=>"Cart added successfully.",'data'=>$cartdata,'user'=>$cartuser,'coupon'=>$cartcoupons,'discount'=>$cartdiscount,'table'=>$gettable,'hold'=>$gethold,'salesman'=>$getsaleman);
          //}
    }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function viewtableCart($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		$language_id='1';

		if($authenticate==1){
            $getsetting=$authController->getSetting();
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
            ->select('customers_basket.*','products.products_model as model', 'image_categories.path as image', 'image_categories.path_type as image_path_type', 'image_categories.image_id as products_image',
                'products_description.products_name as products_name', 'products.products_quantity as quantity',
                'products.products_price as price', 'products.products_weight as weight',
                'products.products_weight_unit as unit','products.product_serve')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', $language_id)
            ->where('customers_basket.hold_status', '=','0');
        if (empty($request->customers_id)) {
            $cart->where('customers_basket.session_id', '=',$request->session_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        } else {
            $cart->where('customers_basket.customers_id', '=',$request->customers_id)->orderBy('customers_basket.customers_basket_id', 'DESC');
        }

        $baskit = $cart->get();
        $result = array();
	        if (!$baskit->isEmpty()){
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

                        $attributes = DB::table('customers_basket_attributes')
                       ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                       ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                       ->leftjoin('products_attributes', function ($join) {
                           $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                       })
                       ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                       ->where('customers_basket_attributes.products_id', '=', $baskit_data->products_id)
                       ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                       ->where('products_options_descriptions.language_id', '=',  $language_id)
                       ->where('products_options_values_descriptions.language_id', '=',  $language_id);

                   if (empty($request->customers_id)) {
                       $attributes->where('customers_basket_attributes.session_id', '=',  $request->session_id);
                   } else {
                       $attributes->where('customers_basket_attributes.customers_id', '=', $request->customers_id);
                   }

                   $attributes_data = $attributes->get();
                        // $attributes = DB::table('customers_basket_attributes')
                        //     ->where('customers_basket_id', '=', $baskit_data->customers_basket_id)
                        //     ->get();
                            if (!$attributes_data->isEmpty()) { 
                               $baskit_data->attributes = $attributes_data; 
                            }else{
                               $baskit_data->attributes = [];
                            }
			            array_push($result, $baskit_data);
			        }

                    $cartuser = $authController->getPosCartUser($request->session_id);
                    $cartcoupons = $authController->getPosCartCoupons($request->session_id);
                    $cartdiscount = $authController->getPosCartDiscount($request->session_id);
                    $gettable = $authController->getPosBookTable($request->session_id);
                    $gethold = $authController->getPosHold($request->session_id);
                    $getsaleman = $authController->getSaleMan($request->session_id);
                    
			       $responseData = array('success'=>'1', 'data'=>$result, 'user'=>$cartuser, 'coupon'=>$cartcoupons, 'discount'=>$cartdiscount,'table'=>$gettable,'hold'=>$gethold,'salesman'=>$getsaleman,'message'=>"Return all cart data."); 
	        }else{
                $gettable = $authController->getPosBookTable($request->session_id);
                $getguest = $authController->getGuestUser();
                $gethold = $authController->getPosHold($request->session_id);
	        	$responseData = array('success'=>'1','message'=>"No data found",'table'=>$gettable,'user'=>$getguest,'hold'=>$gethold);	
	        }	
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

	public static function deletetableCart($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){

			if($request->id == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{

          		

          			DB::table('customers_basket')->whereRaw("find_in_set($request->id , customers_basket_id)")->delete();

			        DB::table('customers_basket_attributes')->whereRaw("find_in_set($request->id , customers_basket_id)")->delete();

			        $responseData = array('success'=>'1','message'=>"Cart deleted successfully");
          	
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
			 return $mediaResponse;
	}

    public static function updatetableCart($request)
    {
        $consumer_data                        =  array();
        $consumer_data['consumer_key']        =  request()->header('consumer-key');
        $consumer_data['consumer_secret']     =  request()->header('consumer-secret');
        $consumer_data['consumer_nonce']      =  request()->header('consumer-nonce');
        $consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
        $consumer_data['consumer_ip']  =  request()->header('consumer-ip');
        $consumer_data['consumer_url']        =  __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data); 
        if($authenticate==1){
            if($request->customers_basket_id == '' || $request->session_id == '' || $request->quantity == ''){
                $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
               $result = DB::table('customers_basket')->where('customers_basket_id', '=',$request->customers_basket_id)->where('session_id', '=',$request->session_id)->first(); 
               if($result){
                    $prodata = DB::table('products')->where('products_id', '=',$result->products_id)->first();
                    $totalqnt = $request->quantity*$prodata->quantity_count;

                    DB::table('customers_basket')->where('customers_basket_id', '=', $request->customers_basket_id)->update(
                        [
                            'session_id' => $request->session_id,
                            'customers_basket_quantity' => $request->quantity,
                            'total_basket_quantity'=>$totalqnt,
                        ]);
                    $responseData = array('success'=>'1', 'message'=>"Cart quantity update successfully.");
               }else{
                 $responseData = array('success'=>'0', 'message'=>"Invalid customers basket id or session id.");
               }
            }
        }else{
            $responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
        }
        $mediaResponse = json_encode($responseData);
        return $mediaResponse;
    }

	public static function clearalltableCart($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);

		if($authenticate==1){
			if($request->session_id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$result = DB::table('customers_basket')->where('session_id', '=',$request->session_id)->get();

				if (!$result->isEmpty()){
					//print_r($result);die();
					foreach ($result as $jesresult) {

						DB::table('customers_basket')->where([
			            ['customers_basket_id', '=', $jesresult->customers_basket_id],
				        ])->delete();

				        DB::table('customers_basket_attributes')->where([
				            ['customers_basket_id', '=', $jesresult->customers_basket_id],
				        ])->delete();
					}
                    // delete apply coupons
                    $coupons = DB::table('temp_pos_coupons')->where('session_id', '=',$request->session_id)->first();
                    if($coupons){
                        // delete coupons tb_usage_voucher_list
                        DB::table('tb_usage_voucher_list')->where([
                            ['orderID', '=', $coupons->id],
                        ])->delete();

                        // delete apply coupons
                        DB::table('temp_pos_coupons')->where([
                            ['session_id', '=', $request->session_id],
                        ])->delete();

                    }
					$responseData = array('success'=>'1','message'=>"Cart successfully cleared");
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid session id");	
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$mediaResponse = json_encode($responseData);
		return $mediaResponse;
	}

  public static function getBrands($request)
  {
        $consumer_data = array();
        $consumer_data['consumer_key'] = request()->header('consumer-key');
        $consumer_data['consumer_secret'] = request()->header('consumer-secret');
        $consumer_data['consumer_nonce'] = request()->header('consumer-nonce');
        $consumer_data['consumer_device_id'] = request()->header('consumer-device-id');
        $consumer_data['consumer_ip'] = request()->header('consumer-ip');
        $consumer_data['consumer_url'] = __FUNCTION__;
        $authController = new AppSettingController();
        $authenticate = $authController->apiAuthenticate($consumer_data);
        if($authenticate == 1) {
          if($request->language_id == ''){
              $responseData = array('success'=>'0','message'=>"Required all Fields.");
            }else{
                $skip = $request->page_number . '0';
                $manufacturers =  DB::table('manufacturers')
                  ->leftJoin('manufacturers_info','manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
                  ->LeftJoin('image_categories', function ($join) {
                      $join->on('image_categories.image_id', '=', 'manufacturers.manufacturer_image')
                          ->where(function ($query) {
                              $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                  ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                  ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                          });
                    })
                  ->select('manufacturers.manufacturers_id as id','manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url', 'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date','image_categories.path as image')
                  ->where('manufacturers_info.languages_id', $request->language_id)
                  //->groupBy('date')
                  ->orderBy('manufacturers.manufacturers_id', 'asc')
                  ->skip($skip)->take(10)
                  ->get();
              if(!empty($manufacturers)){
                  $responseData = array('success' => '1', 'data' => $manufacturers, 'message' => "Returned all manufacturers.");
              }else{
                $responseData = array('success' => '0','message' => "No data found.");
              }
            }
        }else{
          $responseData = array('success' => '0','message' => "Unauthenticated call.");
        }
        $categoryResponse = json_encode($responseData);
        return $categoryResponse;
  }

}
