<?php

namespace App\Imports;

//use App\Items;
//use App\Categories;
//use App\Restorant;
use Illuminate\Support\Facades\DB;
use App\Models\Core\Setting;
use App\Http\Controllers\AdminControllers\SiteSettingController;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToModel, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
        
        $setting = new Setting();
        $myVarsetting = new SiteSettingController($setting);
        $result['commonContent'] =  $myVarsetting->getSetting();
        $languages = $myVarsetting->getLanguages();
        $inventory=$result['commonContent'][144]->value;
        $logo=$result['commonContent'][15]->value;

        // get image id
        $image = DB::table('image_categories')->where('path', $logo)->first();
        $imageid = $image->image_id;
        if(!empty($row['products_image_id'])){
           $updateimgid=$row['products_image_id'];
        }else{
           $updateimgid=$imageid;
        }

        if(!empty($row['created_at'])){
            $created_at=$row['created_at'];
        }else{
            $created_at= date('y-m-d h:i:s');
        }

        if(!empty($row['products_description'])){
            $description=$row['products_description'];
        }else{
            $description=$row['products_name'];
        }
        //print_r($row['products_price']);die();

        $products_id = DB::table('products')->insertGetId([
        'products_model' => $row['products_model'],
        'products_image' => $updateimgid,
        'manufacturers_id' => $row['manufacturers_id'],
        'products_quantity' => '0',
        'products_price' => (!is_null($row['products_price']) ? $row['products_price'] : "0"),
        'products_filter_price'=> (!is_null($row['products_price']) ? $row['products_price'] : "0"),
        'cost_price'=> (!is_null($row['cost_price']) ? $row['cost_price'] : "0"),
        'created_at' => $created_at,
        'products_weight' => $row['products_weight'],
        'products_status' => '1',
        'products_tax_class_id' => '0',
        'products_weight_unit' => $row['products_weight_unit'],
        'low_limit' => 0,
        'products_slug' => 0,
        'products_type' =>(!is_null($row['products_type']) ? $row['products_type'] : "0"),
        'is_feature' =>(!is_null($row['is_feature']) ? $row['is_feature'] : "0"),
        'products_min_order' => (!is_null($row['products_min_order']) ? $row['products_min_order'] : "1"),
        'products_max_stock' => (!is_null($row['products_max_stock']) ? $row['products_max_stock'] : "9999"),
        'is_current'         => '1',
        'quantity_type'      => '0',
        'quantity_count'     => '1'
        ]);

        $slug_flag = false;
        if($slug_flag==false){
            $slug_flag=true;
            $slug = $row['products_name'];
            $old_slug = $row['products_name'];
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


    foreach($languages as $languages_data){

        DB::table('products_description')->insert([
            'products_name' => (!is_null($row['products_name']) ? $row['products_name'] : ""),
            'language_id' => $languages_data->languages_id,
            'products_id' => $products_id,
            'products_description' => $description

        ]);
    }

    if(!empty($row['categories'])){
        if($row['categories']=='0'){
            DB::table('products_to_categories')
            ->insert([
              'products_id' => $products_id,
              'categories_id' => '-1'
            ]);
        }else{
        $balancearray=array();  $balancearray=explode(",",$row['categories']);
        foreach($balancearray as $categories){
          DB::table('products_to_categories')
            ->insert([
              'products_id' => $products_id,
              'categories_id' => $categories
          ]);
        }
    }
}else{
    DB::table('products_to_categories')
            ->insert([
              'products_id' => $products_id,
              'categories_id' => '-1'
          ]);
}


// add inventory
        if($inventory == '1'){
            $date_added = date('Y-m-d h:i:s');
            $inventory_ref_id = DB::table('inventory')->insertGetId([
                        'products_id' => $products_id,
                        'reference_code' =>"no  refrence",
                        'stock' => (!is_null($row['products_quantity']) ? $row['products_quantity'] : "0"),
                        'admin_id' => auth()->user()->id,
                        'created_at' => $date_added,
                        'purchase_price' => '0',
                        'stock_type'    => 'in'
                ]);
        }


         if(!empty($row['product_sku'])){
            $sku=$row['product_sku'];
        }else{
            $sku = $myVarsetting->SKU_gen($row['products_name'],$row['products_name'],$row['products_name'],$products_id);
        }

        // update sku
        DB::table('products')->where('products_id', '=', $products_id)->update([
            'product_sku' => $sku,
        ]);

    }
}
