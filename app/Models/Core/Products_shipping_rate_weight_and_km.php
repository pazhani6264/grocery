<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products_shipping_rate_weight_and_km extends Model
{
    //

    public function getshpippingRate(){

        $products_shipping = DB::table('shipping_by_weight_and_km')->where('status',1)->orderBy('id' , 'asc')->paginate(10);
        return $products_shipping;
    }

    public function insertWeight($request){
        $date_added	= date('Y-m-d H:i:s');
        $shippingbyweight = DB::table('shipping_by_weight_and_km')->insertGetId([
            'from_weight_km'   =>   $request->from_weight,
            'to_weight_km'   =>    $request->to_weight,
            'price_weight_km'   =>    $request->price_weight,
            'commission_weight_km'   =>    $request->commission_weight,
            'type'   =>    'Weight',
            'status'  =>   $request->status,
            'created_at' =>	  $date_added,
        ]);
        return $shippingbyweight;
    }

    public function editWeight($request)
    {
    	$editshippingbykm = DB::table('shipping_by_weight_and_km')->where('id', $request->id)->get();
        $result['weight'] = $editshippingbykm;
        return $result;
    }

    
    public function destroyrecordWeight($request){
        DB::table('shipping_by_weight_and_km')->where('id', $request->weight_id)->delete();
        return 'success';
    }

    public function updaterecordWeight($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbykm = DB::table('shipping_by_weight_and_km')->where('id', $request->weight_id)->update([
            'from_weight_km'   =>   $request->from_weight,
            'to_weight_km'   =>    $request->to_weight,
            'price_weight_km'   =>    $request->price_weight,
            'commission_weight_km'   =>    $request->commission_weight,
            'type'   =>    'Weight',
            'status'  =>   $request->status,
            'updated_at' =>	  $date_added,
        ]);
        return $shippingbykm;
    }



    public function updateshippingpriceWeight($re_weight_from,$re_weight_to,$re_weight_price,$products_shipping_rates_id){

       $updatePrice = DB::table('products_shipping_rates')->where('products_shipping_rates_id', $products_shipping_rates_id)->update([
            'weight_from'	 =>   $re_weight_from,
            'weight_to'		 =>   $re_weight_to,
            'weight_price'	 =>   $re_weight_price,
        ]);


        return $updatePrice;
    }



    public function insertKM($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbykm = DB::table('shipping_by_weight_and_km')->insertGetId([
            'from_weight_km'   =>   $request->from_km,
            'to_weight_km'   =>    $request->to_km,
            'price_weight_km'   =>    $request->price_km,
            'commission_weight_km'   =>    $request->commission_km,
            'type'   =>    'KM',
            'status'  =>   $request->status,
            'created_at' =>	  $date_added,
        ]);
        return $shippingbykm;
    }

    public function editKM($request)
    {
    	$editshippingbykm = DB::table('shipping_by_weight_and_km')
            ->where('id', $request->id)->get();
           
        $result['km'] = $editshippingbykm;
        return $result;
    }

    
    public function destroyrecordKM($request){
        DB::table('shipping_by_weight_and_km')->where('id', $request->km_id)->delete();
        return 'success';
    }

    public function updaterecordKM($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbykm = DB::table('shipping_by_weight_and_km')->where('id', $request->km_id)->update([
            'from_weight_km'   =>   $request->from_km,
            'to_weight_km'   =>    $request->to_km,
            'price_weight_km'   =>    $request->price_km,
            'commission_weight_km'   =>    $request->commission_km,
            'type'   =>    'KM',
            'status'  =>   $request->status,
            'updated_at' =>	  $date_added,
        ]);
        return $shippingbykm;
    }



    public function updateshippingpriceKM($re_weight_from,$re_weight_to,$re_weight_price,$products_shipping_rates_id){

       $updatePrice = DB::table('products_shipping_rates')->where('products_shipping_rates_id', $products_shipping_rates_id)->update([
            'weight_from'	 =>   $re_weight_from,
            'weight_to'		 =>   $re_weight_to,
            'weight_price'	 =>   $re_weight_price,
        ]);


        return $updatePrice;
    }

}
