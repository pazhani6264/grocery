<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



class Inventory extends Model
{
	public function stock_movement()
	{
		$language_id = '1';
		$data = DB::table('products')
			  ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
			  ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
              ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
              ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
              ->leftJoin('image_categories', 'image_categories.image_id', '=', 'products.products_image')
			  ->select('products.*', 'products_description.*','image_categories.path as path', 'products.updated_at as productupdate', 'categories_description.categories_id','categories_description.categories_name')
			  ->where('products_description.language_id', '=', $language_id)
              ->where('categories_description.language_id', '=', $language_id)
            ->groupBy('products.products_id')->paginate(10);

         return $data;
	}

	public function stock_movement_scan($id)
	{
		$language_id = '1';
		$data = DB::table('products')
			  ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
			  ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
              ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
              ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
              ->leftJoin('image_categories', 'image_categories.image_id', '=', 'products.products_image')
			  ->select('products.*', 'products_description.*','image_categories.path as path', 'products.updated_at as productupdate', 'categories_description.categories_id','categories_description.categories_name')
			  ->where('products.product_sku', '=', $id)
			  ->where('products_description.language_id', '=', $language_id)
              ->where('categories_description.language_id', '=', $language_id)
              ->first();
            return $data;
	}

	public function get_out_data($id)
	{
		$data = DB::table('inventory')->where(['products_id'=> $id,'stock_type'=>'out'])->get();
		return $data;
	}

	public function get_product_data($id)
	{
		$data = DB::table('products')
		->leftJoin('image_categories', 'image_categories.image_id', '=', 'products.products_image')
		->select('products.product_sku', 'image_categories.path as path','products.products_type')
		->where('products.products_id', '=', $id)
		->first();
		$stocks = 0;
		if($data->products_type!=1){
			$stocksin = DB::table('inventory')->where('products_id', $id)->where('stock_type', 'in')->sum('stock');
      		$stockOut = DB::table('inventory')->where('products_id', $id)->where('stock_type', 'out')->sum('stock');
      		$stocks = $stocksin - $stockOut;
		}else{
			$stocks = '0';
		}
		$datas=array("product_sku"=>$data->product_sku,"path"=>$data->path,"stock"=>$stocks);
		return $datas;
	}
	public function stock_in_out_get($type,$request)
	{
		$data = DB::table('inventory_ref')
				->where('inventory_ref.type', '=', $type);
				if(isset($request->dateRange)) {
					$range = explode('-', $request->dateRange);
					$startdate = trim($range[0]);
                	$enddate = trim($range[1]);

                	$dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                	$dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                	$data->whereBetween('inventory_ref.created_at', [$dateFrom, $dateTo]);
				}
				$data = $data->orderby('inventory_ref.created_at', 'desc')
				->limit(10)
				->get();
		return $data;
	}
	public function stockininsert($request)
	{
		//dd($request);
		$var  = $request->flash_start_date;
		$check_date = str_replace('/', '-', $var);
		$new_date_format = date('Y-m-d', strtotime($check_date));
		$date_added	= date('Y-m-d H:i:s');

		if($request->discount !== null){
	        $discount=$request->discount;
	    }else{
	        $discount='0';
	    }
		$stock_id = DB::table('inventory_ref')->insertGetId([
	        'type' => $request->stock_type,
	        'date' => $new_date_format,
	        'vendor' => $request->vendor,
	        'ref_no' => $request->ref_no,
	        'note' => $request->sock_note,
	        'total' => $request->total,
	        'tax_included' => $request->taxin,
	        'tax' => $request->tax_amount,
	        'discount' => $discount,
	        'grand_total' => $request->grand_total,
	        'created_at' => $date_added,
	        'updated_at' => $date_added
    	]);

    	// add array data
    	foreach ($request->products_id as $key => $jesproductid) {
    		
    		$stock = DB::table('inventory')->insertGetId([
    			'admin_id' => '1',
    			'added_date'=>'0',
    			'reference_code'=>'new stock method',
    			'stock'=>$request->stock_quantity[$key],
    			'products_id'=>$jesproductid,
    			'purchase_price'=>$request->price_unit[$key],
    			'stock_type'=>$request->stock_type,
    			'created_at'=>$date_added,
    			'updated_at'=>$date_added,
    			'orders_products_id'=>'0',
    			'discount_unit'=>$request->discount_unit[$key],
    			'reference_no'=>$stock_id
    		]);

    		$product = DB::table('products')->where(['products_id'=> $jesproductid])->first();
    		if($product->products_type=='1'){
    			$attributeid='attributeid'.$jesproductid;
    			$options=$request->$attributeid;

    			if(!empty($options) and count($options)>0){
    				// insert inventory_detail
    				foreach ($options as $jesoptions) {
    					$option = DB::table('inventory_detail')->insertGetId([
    						'inventory_ref_id' => $stock,
    						'products_id' => $jesproductid,
    						'attribute_id' => $jesoptions
    					]);
    				}
    			}
    		}
    	}
	}

	public function get_details_in_out_data($id,$type)
	{
		$data = DB::table('inventory')
		->leftJoin('products_description', 'products_description.products_id', '=', 'inventory.products_id')
		->select('products_description.products_name', 'inventory.*')
		->where('inventory.reference_no', '=', $id)
		->where('inventory.stock_type', '=', $type)
		->groupBy('products_description.products_id')
		->get();
		return $data;
	}

	public function currentstock($products_id,$attributeid)
	{
	$inventory_ref_id = array();
	$updatearray=array();
    $products_id = $products_id;
    $updatearray=explode(",",$attributeid);
    //print_r($updatearray);die();
    $attributes = array_filter($updatearray);
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
    $result['remainingStock'] = $stockIn - $stockOut;

    return $result;
	}

public function adjustStockInsert($request)
{
	$new_date_format = date('Y-m-d');
	$date_added	= date('Y-m-d H:i:s');
	$digits = 6;
    $otpresult= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
	
		$stock_id = DB::table('inventory_ref')->insertGetId([
	        'type' => $request->stock_type,
	        'date' => $new_date_format,
	        'vendor' => '0',
	        'ref_no' => '0',
	        'note' => $request->reason,
	        'total' => '0',
	        'tax_included' => '0',
	        'tax' => '0',
	        'discount' => '0',
	        'grand_total' => '0',
	        'created_at' => $date_added,
	        'updated_at' => $date_added
    	]);
		// update ref_no
    	$refno ='AS'.$otpresult.$stock_id;
    	$result = DB::table('inventory_ref')->where('id', '=', $stock_id)->update(['ref_no' => $refno]);

    	// add array data
    	foreach ($request->products_id as $key => $jesproductid) {
    		
    		$stock = DB::table('inventory')->insertGetId([
    			'admin_id' => '1',
    			'added_date'=>'0',
    			'reference_code'=>'new adjust method',
    			'stock'=>$request->stock_quantity[$key],
    			'products_id'=>$jesproductid,
    			'purchase_price'=>'0',
    			'stock_type'=>'in',
    			'created_at'=>$date_added,
    			'updated_at'=>$date_added,
    			'orders_products_id'=>'0',
    			'discount_unit'=>'0',
    			'reference_no'=>$stock_id
    		]);

    		$product = DB::table('products')->where(['products_id'=> $jesproductid])->first();
    		if($product->products_type=='1'){
    			$attributeid='attributeid'.$jesproductid;
    			$options=$request->$attributeid;

    			if(!empty($options) and count($options)>0){
    				// insert inventory_detail
    				foreach ($options as $jesoptions) {
    					$option = DB::table('inventory_detail')->insertGetId([
    						'inventory_ref_id' => $stock,
    						'products_id' => $jesproductid,
    						'attribute_id' => $jesoptions
    					]);
    				}
    			}
    		}
    	}
}
public function countries(){
        $countries = DB::table('countries')->get();
        return $countries;
}

public function state(){
	$zones = DB::table('zones')->get();
        return $zones;
}

public function get_vendor()
{
	$data = DB::table('vendor')
		->leftJoin('countries', 'countries.countries_id', '=', 'vendor.country')
		->leftJoin('zones', 'zones.zone_id', '=', 'vendor.state')
		->select('vendor.*', 'zones.zone_name','countries.countries_name')
		->orderBy('vendor.id', 'DESC')
		->get();
		return $data;
}

public function vendorInsert($request)
{
	$email = DB::table('vendor')->where(['email'=> $request->vendor_email])->first();
	if($email){
		return 'email';
	}else{
		$phone = DB::table('vendor')->where(['phone'=> $request->vendor_phone])->first();
		if($phone){
			return 'phone';
		}else{
			$date_added	= date('Y-m-d H:i:s');
			$vendor = DB::table('vendor')->insertGetId([
    				'name' => $request->vendor_name,
    				'email' => $request->vendor_email,
    				'cc_code' => $request->ccode,
    				'phone' => $request->vendor_phone,
    				'contact_name' => $request->contact_name,
    				'street_1' => $request->street_1,
    				'street_2' => $request->street_2,
    				'country' => $request->country,
    				'state' => $request->state,
    				'city' => $request->city,
    				'post_code' => $request->zipcode,
    				'created_at' => $date_added,
    				'updated_at' => $date_added
    		]);
    		return 'success';
		}	
	}
}
public function vendorEdit($id)
{
	$result = DB::table('vendor')->where(['id'=>$id])->first();
	return $result;
}
public function vendorupdate($request)
{
	$email = DB::table('vendor')->where(['email'=> $request->vendor_email])->where('id', '!=', $request->id)->get();
	if(count($email)>0){
		return 'email';
	}else{
		$phone = DB::table('vendor')->where(['phone'=> $request->vendor_phone])->where('id', '!=', $request->id)->get();
	    if(count($phone)>0){
	    	return 'phone';
	    }else{
	    	DB::table('vendor')->where('id', '=', $request->id)->update([
              'name' => $request->vendor_name,
    		  'email' => $request->vendor_email,
    		  'cc_code' => $request->ccode,
    		  'phone' => $request->vendor_phone,
    		  'contact_name' => $request->contact_name,
    		  'street_1' => $request->street_1,
    		  'street_2' => $request->street_2,
    		  'country' => $request->country,
    		  'state' => $request->state,
    		  'city' => $request->city,
    		  'post_code' => $request->zipcode,
          ]);

	    	return 'success';
	    }
	}
}
public function vendordelete($request)
{
	//delete categories
          DB::table('vendor')->where([
              'id' => $request->id,
          ])->delete();
}
}
?>