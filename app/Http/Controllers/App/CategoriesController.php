<?php
namespace App\Http\Controllers\App;

use Validator;
use DB;
use Hash;
use App\Administrator;
use Auth;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AppModels\Category;
use App\Http\Controllers\App\AppSettingController;



class CategoriesController extends Controller
{
	public function getMainCategories($language_id){
		$getCategories = Category::getMainCategories($language_id);
		return($getCategories);
	}

	public function getCategories(Request $request){
    $getCategories = Category::getCategories($request);
		return($getCategories) ;
	}

    public function getposcategories(Request $request)
    {
       $getposcategories = Category::getposcategories($request);
        return($getposcategories);  
    }

   




    public function deletecategories(Request $request)
    {
        $deletecategories = Category::deletecategories($request);
        return($deletecategories);
    }

    public function gettaxclass(Request $request)
    {
         $gettaxclass = Category::gettaxclass($request);
         return($gettaxclass);
    }

    public function getmanufacturer(Request $request)
    {
        $getmanufacturer = Category::getmanufacturer($request);
         return($getmanufacturer);
    }

	public function addcategories(Request $request)
	{
		$authController = new AppSettingController();
		$date_added	= date('y-m-d h:i:s');

		    $categoryName = $request->category_name;
        $parent_id    = $request->parent_id;
        $time = Carbon::now();

        if($request->image == '' || $request->icon == '' || $request->category_name == '' || $request->categories_status == '' || $request->category_descriptions ==''){
        	$responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
        	
          $categories_id = Category::categories_insert($request->image,$date_added,$parent_id,$request->icon,$request->categories_status);
            $slug_flag = false;

        	 $languages = $authController->fetchLanguages();
        	 //multiple lanugauge with record
        	 foreach($languages as $languages_data){
        	 	$categoryName= $request->category_name;
            	$categoryDescriptions= $request->category_descriptions;

            	if($slug_flag==false){
            		 $slug_flag=true;
            		 $slug = $request->category_name;
            		 $old_slug = $request->category_name;
            		 $slug_count = 0;
            		 do{
            		 	if($slug_count==0){
            		 		$currentSlug = $authController->slugify($old_slug);
            		 	}else{
            		 		$currentSlug = $authController->slugify($old_slug.'-'.$slug_count);
            		 	}
            		 	$slug = $currentSlug;
            		 	 $checkSlug = $authController->checkSlug($currentSlug);
                    	 $slug_count++;
            		 }
            		 while(count($checkSlug)>0);
            		 $updateSlug = $authController->updateSlug($categories_id,$slug);
            	}

            	$categoryNameSub = $request->category_name;
            	$descriptions = $request->category_descriptions;
            	$languages_data_id = $languages_data->languages_id;
            	$subcatoger_des = Category::insertcategorydescription($categoryNameSub,$categories_id,$languages_data_id,$descriptions);
        	 }
        	 $responseData = array('success'=>'1','message'=>"Category added successfully.");

      }
       
       $loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;

	}

    public function editcategories(Request $request)
    {
        $authController = new AppSettingController();
         $last_modified     =   date('y-m-d h:i:s');
           $time = Carbon::now();
        if($request->category_name == '' || $request->categories_status == '' || $request->category_descriptions =='' || $request->edit_id == '' || $request->slug == '' || $request->image == '' || $request->icon == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
             $result=DB::table('categories')->where('categories_id', '=', $request->edit_id)->first();
             if($result){
                //check slug
                if($result->categories_slug!=$request->slug){
                    $slug = $request->slug;
                     $slug_count = 0;
                     do{
                        if($slug_count==0){
                            $currentSlug = $authController->slugify($request->slug);
                        }else{
                            $currentSlug = $authController->slugify($request->slug.'-'.$slug_count);
                        }
                         $slug = $currentSlug;
                         $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->where('categories_id','!=',$request->edit_id)->get();
                         $slug_count++;
                       }
                        while(count($checkSlug)>0);
                }else{
                  $slug = $request->slug;
                }

                $updateCategory = Category::updaterecord($request->edit_id,$request->image,$request->icon,$last_modified,$request->parent_id,$slug,$request->categories_status);
                $languages = $authController->fetchLanguages();

                foreach($languages as $languages_data){
                    $categories_name = $request->category_name;
                    $categoryDescriptions= $request->category_descriptions;

                    $checkExist = Category::checkExit($request->edit_id,$languages_data);
                    if(count($checkExist)>0){
                        $category_des_update = Category::updatedescription($categories_name,$languages_data,$request->edit_id,$categoryDescriptions);
                    }else{
                       $updat_des = Category::insertcategorydescription($categories_name,$request->edit_id, $languages_data->languages_id, $categoryDescriptions); 
                    }
                }

                $responseData = array('success'=>'1','message'=>"Category updated successfully.");

             }else{
               $responseData = array('success'=>'0','message'=>"Invalid edit id"); 
             }
        }
        $loyaltyResponse = json_encode($responseData);
        return $loyaltyResponse;
    }

    public function addproduct(Request $request)
    {
        $authController = new AppSettingController();
        $getsetting=$authController->getSetting();
        if($request->products_type == '' || $request->categories == '' || $request->products_price == '' || $request->products_min_order == '' || $request->products_max_stock == '' || $request->image == '' || $request->products_name == '' || $request->products_status == '' || $request->products_descriptions ==''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{
            $allvals=DB::table('products')->where('product_sku','=', $request->products_sku)->select('product_sku')->first();
            if(empty($allvals)) {
                $date_added = date('Y-m-d h:i:s');
                $time = Carbon::now();
            $products_id = DB::table('products')->insertGetId([
                'manufacturers_id' => $request->manufacturers_id,
                'products_quantity' => 0,
                'special_type' => $request->specialtype,
                'products_model' => $request->products_model,
                'products_price' => $request->products_price,
                'products_filter_price' => $request->products_price,
                'created_at' => $date_added,
                'products_weight' => $request->products_weight,
                'products_status' => $request->products_status,
                'products_tax_class_id' => $request->tax_class_id,
                'products_weight_unit' => $request->products_weight_unit,
                'low_limit' => 0,
                'products_slug' => 0,
                'products_type' => $request->products_type,
                'is_feature' => $request->is_feature,
                'is_special' => $request->isSpecial,
                'products_min_order' => $request->products_min_order,
                'products_max_stock' => $request->products_max_stock,
                'products_video_link' => $request->products_video_link,
                'button_type' => $request->button_type,
                'product_serve' => $request->product_serve,
                'product_view' => $request->product_view,
                'is_current'      => 1,
                'stock_status'    => $request->stock_status,
                'quantity_type'   => $request->quantity_type,
                'quantity_count'  => $request->quantity_count,
                'cost_price'      => $request->cost_price,
                'commission_sales'=>'0',
                'commission_type'=>'percentage',
                'fresh_price'=>$request->fresh_price
         ]);


         // Insert Combo Product 

            if($request->products_type == 3){
                $cate_name = $request->cate;
                $product_name = $request->product;
                $attr_name = $request->attr;
                $qty = $request->qty;
                
                for ($i = 0; $i < count($cate_name); $i++) {
                    $productCombo = DB::table('product_combo')->insertGetId([
                        'pro_id' => $products_id,
                        'cate_id' => $cate_name[$i],
                        'product_id' => $product_name[$i],
                        'attractive_id' => $attr_name[$i],
                        'qty' => $qty[$i],
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }



            // insert product image

            $imagearray=array();  $imagearray=explode(",",$request->image);
            $i=1;
             foreach($imagearray as $jesimage){
                  if($i=='1'){
                    DB::table('products')
                      ->where('products_id', $products_id)
                      ->update([
                            'products_image' => $jesimage
                      ]);
                  }else{
                    $count = DB::table('products_images')->where('products_id', '=', $products_id)->count();
                    $new_count=$count+1;

                        DB::table('products_images')->insert([
                            'products_id' => $products_id,
                            'image' => $jesimage,
                            'sort_order' => $new_count
                        ]);
                  }
            $i++;
            }
            
            $slug_flag = false;
            $languages = $authController->fetchLanguages();
            foreach($languages as $languages_data){
                $products_name = $request->products_name;
                $products_description = $request->products_descriptions;

                //slug
                    if($slug_flag==false){
                        $slug_flag=true;
                        $slug = $request->products_name;
                        $old_slug = $request->products_name;
                        $slug_count = 0;
                        do{
                            if($slug_count==0){
                                $currentSlug = $authController->slugify($slug);
                            }else{
                                $currentSlug = $authController->slugify($old_slug.'-'.$slug_count);
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

                  DB::table('products_description')->insert([
                    'products_name' => $products_name,
                    'language_id' => $languages_data->languages_id,
                    'products_id' => $products_id,
                    'products_url' => '',
                    'products_left_banner' => '',
                    'products_left_banner_start_date' => null,
                    'products_left_banner_expire_date' => null,
                    'products_right_banner' => '',
                    'products_right_banner_start_date' => null,
                    'products_right_banner_expire_date' => null,
                    'products_description' => addslashes($products_description)

                ]);  
            }

            //flash sale product
            if($request->isFlash == 'yes'){
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

                     if($request->specialtype == '1'){
                        $special_price = $request->products_price - $request->specials_new_products_price;
                    }else{
                        $special_price  = ($request->products_price * $request->specials_new_products_price) / 100;
                        $special_price = $request->products_price - $special_price;
                    }
                   $expiryDate = str_replace('/', '-', $request->expires_date);
                   $expiryDateFormate = strtotime($expiryDate); 
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

             $catearray=array();  $catearray=explode(",",$request->categories);

             foreach($catearray as $jescategories){
                  DB::table('products_to_categories')
                    ->insert([
                      'products_id' => $products_id,
                      'categories_id' => $jescategories
                  ]);
            }

            if(!empty($request->products_sku)){
                $sku=$request->products_sku;
            }else{
                $cate_name=DB::table('products_to_categories')
                ->join('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                ->select('categories_description.categories_name')
                ->where('products_to_categories.products_id', $products_id)
                ->first();
                if(!empty($request->manufacturers_id)){
                    $manufacturers=DB::table('manufacturers')->where('manufacturers_id', '=', $request->manufacturers_id)->first();
                    $brand=$manufacturers->manufacturer_name;
                }else{
                    $brand=$getsetting['app_name'];
                }
                $sku = $authController->SKU_gen($products_name,$cate_name->categories_name,$brand,$products_id);
            }

             // update sku
                DB::table('products')->where('products_id', '=', $products_id)->update([
                    'product_sku' => $sku,
                ]);

            $responseData = array('success'=>'1','message'=>"Product added successfully",'data'=>$products_id);
        }else{
           $responseData = array('success'=>'0','message'=>"This sku already inserted"); 
        }
        }

        $loyaltyResponse = json_encode($responseData);
        return $loyaltyResponse;
    }

      public function editproduct(Request $request)
      {
         $authController = new AppSettingController();
         $getsetting=$authController->getSetting();
         if($request->products_type == '' || $request->categories == '' || $request->products_price == '' || $request->products_min_order == '' || $request->products_max_stock == ''  || $request->products_name == '' || $request->products_status == '' || $request->products_descriptions =='' || $request->id=='' || $request->old_slug == '' || $request->oldImage == ''){
            $responseData = array('success'=>'0','message'=>"Required all Fields.");
        }else{

            $allvals=DB::table('products')->where('product_sku','=', $request->products_sku)
                ->where('products_id','!=', $request->id)
                ->select('product_sku')
                ->first();

            if(empty($allvals)) {

            $startdate = strtotime($request->flash_start_date);
            $expiredate = strtotime($request->flash_expires_date);
            $startdate = $request->flash_start_date;
            $starttime = $request->flash_start_time;
            $start_date = str_replace('/','-',$startdate.' '.$starttime);
            $flash_start_date = strtotime($start_date);
            $expiredate = $request->flash_expires_date;
            $expiretime = $request->flash_end_time;
            $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
            $flash_expires_date = strtotime($expire_date);

            if($flash_start_date > $flash_expires_date){
                $responseData = array('success'=>'0','message'=>"Flash sale start date can not be greater then expiry date.");
            }

            $language_id      =   '1';
            $products_id      =   $request->id;
            $products_last_modified = date('Y-m-d h:i:s');
            $expiryDate = str_replace('/', '-', $request->expires_date);
            $expiryDateFormate = strtotime($expiryDate);
            $languages = $authController->fetchLanguages();

            //check slug
             if($request->old_slug!=$request->slug ){
                $slug = $request->slug;
                $slug_count = 0;
                do{
                  if($slug_count==0){
                      $currentSlug = $authController->slugify($request->slug);
                  }else{
                      $currentSlug = $authController->slugify($request->slug.'-'.$slug_count);
                  }
                  $slug = $currentSlug;
                  $checkSlug = DB::table('products')->where('products_slug', $currentSlug)->where('products_id', '!=', $products_id)->get();
                  $slug_count++;
              }
              while(count($checkSlug)>0);
             }else{
                $slug = $request->slug;
             }

             if($request->image !== null){
                $uploadImage = $request->image;
              }else{
                $uploadImage = $request->oldImage;
              }

              if($request->products_type == '0'){
                $attributes = DB::table('products_attributes')->where('products_id',$products_id)->get();
                    if(count($attributes)>0){
                        DB::table('products_attributes')->where([
                                ['products_id', '=', $products_id],
                            ])->delete();

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
              'button_type' => $request->button_type,
              'product_serve' => $request->product_serve,
              'product_view' => $request->product_view,
              'stock_status'       => $request->stock_status,
              'quantity_type'       => $request->quantity_type,
              'quantity_count'      => $request->quantity_count,
              'cost_price'      => $request->cost_price,
              'commission_sales'=> 0,
              'commission_type'=>'percentage',
              'fresh_price'=>$request->fresh_price,
          ]);


          // Insert Combo Product 

            if($request->products_type == 3){
                $cate_name = $request->cate;
                $product_name = $request->product;
                $attr_name = $request->attr;
                $qty = $request->qty;

                $productCombo = DB::table('product_combo')->where('pro_id',$products_id)->delete();
                
                for ($i = 0; $i < count($cate_name); $i++) {
                    $productCombo = DB::table('product_combo')->insertGetId([
                        'pro_id' => $products_id,
                        'cate_id' => $cate_name[$i],
                        'product_id' => $product_name[$i],
                        'attractive_id' => $attr_name[$i],
                        'qty' => $qty[$i],
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } else {
                $productCombo = DB::table('product_combo')->where('pro_id',$products_id)->delete();
            }

            foreach($languages as $languages_data){
              $products_name = $request->products_name;
              $products_url = '';
              $products_description = $request->products_descriptions;

              $checkExist = DB::table('products_description')->where('products_id', '=', $products_id)->where('language_id', '=', $languages_data->languages_id)->get();
              if(count($checkExist)>0){
                  $req_products_name = $request->products_name;
                  $req_products_url = '';
                  $req_products_description = $request->products_descriptions;

                  DB::table('products_description')->where('products_id', '=', $products_id)
                  ->where('language_id', '=', $languages_data->languages_id)->update([
                      'products_name' => $req_products_name,
                      'products_url' => '',
                      'products_left_banner' => '',
                      'products_right_banner' => '',
                      'products_left_banner_start_date' => null,
                      'products_left_banner_expire_date' => null,
                      'products_right_banner_start_date' => null,
                      'products_right_banner_expire_date' => null,
                      'products_description' => addslashes($req_products_description)

                  ]);
              }else{
                    $req_products_name = $request->products_name;
                    $req_products_url = '';
                    $req_products_description = $request->products_descriptions;

                    DB::table('products_description')->insert([
                        'products_name' => $req_products_name,
                        'language_id' => $languages_data->languages_id,
                        'products_id' => $products_id,
                        'products_url' => '',
                        'products_left_banner' => '',
                        'products_left_banner_start_date' => null,
                        'products_left_banner_expire_date' => null,
                        'products_right_banner' => '',
                        'products_right_banner_start_date' => null,
                        'products_right_banner_expire_date' => null,
                        'products_description' => addslashes($req_products_description)
                    ]);  
              }
            }

                //delete categories
              DB::table('products_to_categories')->where([
                  'products_id' => $products_id,
              ])->delete();
              
              $catearray=array();  $catearray=explode(",",$request->categories);
              foreach($catearray as $categories){
                DB::table('products_to_categories')->insert([
                    'products_id' => $products_id,
                    'categories_id' => $categories
                ]);
              }

             //special product
              if($request->isSpecial == 'yes'){
                if($request->specialtype == '1'){
                    $special_price = $request->products_price - $request->specials_new_products_price;
                }else{
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
              ->get();

               //insert sku

                 if(!empty($request->products_sku)){
                        $sku=$request->products_sku;
                    }else{
                        $cate_name=DB::table('products_to_categories')
                        ->join('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
                        ->select('categories_description.categories_name')
                        ->where('products_to_categories.products_id', $products_id)
                        ->first();
                        if(!empty($request->manufacturers_id)){
                            $manufacturers=DB::table('manufacturers')->where('manufacturers_id', '=', $request->manufacturers_id)->first();
                            $brand=$manufacturers->manufacturer_name;
                        }else{
                            $brand=$getsetting['app_name'];
                        }
                        $sku = $authController->SKU_gen($products_name,$cate_name->categories_name,$brand,$products_id);
                    }
                    // update sku
                DB::table('products')->where('products_id', '=', $products_id)->update([
                    'product_sku' => $sku,
                ]);

        $responseData = array('success'=>'1','data'=>$products_id,'message'=>"Product edit successfully.");

        }else{
           $responseData = array('success'=>'0','message'=>"This sku already inserted");  
        }

        }

        $loyaltyResponse = json_encode($responseData);
        return $loyaltyResponse;
      }



	public function storeThumbnial($Path, $filename, $directory, $input)
    {
        $authController = new AppSettingController();
        $thumbnail_values = $authController->thumbnailHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');

        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values[1]->value,

            'height' => $thumbnail_values[0]->value,

            'grayscale' => false));
        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
        
        $storethumbnail = $authController->thumbnailrecord($input, $Path, $width, $height);

        return $namethumbnail;
    }

    public function storeMedium($Path, $filename, $directory, $input)
    {
        $authController = new AppSettingController();
        $Medium_values = $authController->MediumHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Medium_values[1]->value,

            'height' => $Medium_values[0]->value,

            'grayscale' => false));
        $namemedium = $thumbnailImage->save($destinationPath . 'medium' . time() . $filename);
        $Path = 'images/media/' . $directory . '/' . 'medium' . time() . $filename;

        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeMediumImage = $authController->Mediumrecord($input, $Path, $width, $height);

        return $namemedium;
    }

    public function storeLarge($Path, $filename, $directory, $input)
    {
        $authController = new AppSettingController();
        $Large_values = $authController->LargeHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Large_values[1]->value,

            'height' => $Large_values[0]->value,

            'grayscale' => false));
//        $upload_success = $thumbnailImage->save($directory, $filename, 'public');
        $namelarge = $thumbnailImage->save($destinationPath . 'large' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'large' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeLargeImage = $authController->Largerecord($input, $Path, $width, $height);

        return $namelarge;
    }

    public function getOptionName(Request $request)
    {
        $getOptionName = Category::getOptionName($request);
        return($getOptionName);
    }

    public function getOptionsValue(Request $request)
    {
        $getOptionsValue = Category::getOptionsValue($request);
        return($getOptionsValue);
    }

    public function addOptionsValue(Request $request)
    {
        $addOptionsValue = Category::addOptionsValue($request);
        return($addOptionsValue);
    }

    public function viewProductsattributes(Request $request)
    {
         $viewProductsattributes = Category::viewProductsattributes($request);
         return($viewProductsattributes);
    }
    public function updateOptionsValue(Request $request)
    {
        $updateOptionsValue = Category::updateOptionsValue($request);
         return($updateOptionsValue);
    }
    public function deleteOptionsValue(Request $request)
    {
        $deleteOptionsValue = Category::deleteOptionsValue($request);
         return($deleteOptionsValue);
    }
    public function addAdditionalOptions(Request $request)
    {
        $addAdditionalOptions = Category::addAdditionalOptions($request);
         return($addAdditionalOptions);
    }
    public function updateAdditionalOptions(Request $request)
    {
        $updateAdditionalOptions = Category::updateAdditionalOptions($request);
        return($updateAdditionalOptions);
    }
     public function deleteAdditionalOptions(Request $request)
     {
          $deleteAdditionalOptions = Category::deleteAdditionalOptions($request);
          return($deleteAdditionalOptions);
     }
     public function viewproductimage(Request $request)
    {
         $viewproductimage = Category::viewproductimage($request);
         return($viewproductimage);
    }
    public function insertproductimages(Request $request)
    {
        $insertproductimages = Category::insertproductimages($request);
        return($insertproductimages);  
    }
    public function editproductimages(Request $request)
    {
        $editproductimages = Category::editproductimages($request);
        return($editproductimages);
    }
    public function deleteproductimages(Request $request)
    {
        $deleteproductimages = Category::deleteproductimages($request);
        return($deleteproductimages);
    }
    public function deleteproduct(Request $request)
    {
        $deleteproduct = Category::deleteproduct($request);
        return($deleteproduct);
    }
    public function getproduct(Request $request)
    {
         $getproduct = Category::getproduct($request);
         return($getproduct);
    }
    public function displayProductVideos(Request $request)
    {
        $displayProductVideos=Category::displayProductVideos($request);
        return($displayProductVideos);
    }
    public function addProductVideos(Request $request)
    {
        $addProductVideos=Category::addProductVideos($request);
        return($addProductVideos);
    }
    public function updateproductvideo(Request $request)
    {
        $updateproductvideo=Category::updateproductvideo($request);
        return($updateproductvideo);
    }
    public function deleteproductvideorecord(Request $request)
    {
        $deleteproductvideorecord=Category::deleteproductvideorecord($request);
        return($deleteproductvideorecord); 
    }
    public function getUserProduct(Request $request)
    {
        $getUserProduct=Category::getUserProduct($request);
        return($getUserProduct);
    }
    public function getCategoriesProduct(Request $request)
    {
        $getCategoriesProduct=Category::getCategoriesProduct($request);
        return($getCategoriesProduct);
    }




    /*                   qrorder      */



    public function gettablecategories(Request $request)
    {
       $gettablecategories = Category::gettablecategories($request);
        return($gettablecategories);  
    }

    public function gettableproducts(Request $request)
    {
       $gettableproducts = Category::gettableproducts($request);
        return($gettableproducts);  
    }

    public function addtableCart(Request $request)
    {
       $addtableCart = Category::addtableCart($request);
        return($addtableCart);  
    }

	public function viewtableCart(Request $request)
	{
		$viewtableCart = Category::viewtableCart($request);
		print $viewtableCart;
	}

	public function deletetableCart(Request $request)
	{
		$deletetableCart = Category::deletetableCart($request);
		print $deletetableCart;
	}
    public function clearalltableCart(Request $request)
	{
		$clearalltableCart = Category::clearalltableCart($request);
		print $clearalltableCart;
	}
	public function updatetableCart(Request $request)
	{
		$updatetableCart = Category::updatetableCart($request);
		print $updatetableCart;
	}
    public function getBrands(Request $request)
    {
        $getBrands = Category::getBrands($request);
        print $getBrands;
    }

}