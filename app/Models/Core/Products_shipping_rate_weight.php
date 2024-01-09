<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products_shipping_rate_weight extends Model
{
    //

    public function getshpippingRate(){

        $products_shipping = DB::table('products_shipping_rates')->orderBy('products_shipping_rates_id' , 'asc')
        ->paginate(10);
        return $products_shipping;
    }

    public function insert($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbyweight = DB::table('products_shipping_rates')->insertGetId([
            'weight_from'   =>   $request->weightfrom,
            'weight_to'   =>    $request->weightto,
            'weight_price'   =>    $request->weightprice,
            'weight_commission'   =>    $request->weightcommission,
            'products_shipping_status'  =>   $request->weightstatus,
            'created_at' =>	  $date_added,
        ]);
        return $shippingbyweight;
    }

    public function edit($request)
    {
    	$editshippingbyweight = DB::table('products_shipping_rates')
            ->where('products_shipping_rates_id', $request->id)->get();
           
        $result['weight'] = $editshippingbyweight;
        return $result;
    }

    
    public function destroyrecord($request){
        DB::table('products_shipping_rates')->where('products_shipping_rates_id', $request->weight_id)->delete();
        return 'success';
    }

    public function updaterecord($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbyweight = DB::table('products_shipping_rates')->where('products_shipping_rates_id', $request->weight_id)->update([
            'weight_from'   =>   $request->weightfrom,
            'weight_to'   =>    $request->weightto,
            'weight_price'   =>    $request->weightprice,
            'weight_commission'   =>    $request->weightcommission,
            'products_shipping_status'  =>   $request->weightstatus,
            'updated_at' =>	  $date_added,
        ]);
        return $shippingbyweight;
    }



    public function updateshippingprice($re_weight_from,$re_weight_to,$re_weight_price,$products_shipping_rates_id){

       $updatePrice = DB::table('products_shipping_rates')->where('products_shipping_rates_id', $products_shipping_rates_id)->update([
            'weight_from'	 =>   $re_weight_from,
            'weight_to'		 =>   $re_weight_to,
            'weight_price'	 =>   $re_weight_price,
        ]);


        return $updatePrice;
    }

}
