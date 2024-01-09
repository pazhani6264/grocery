<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products_shipping_rate_km extends Model
{
    //

    public function getshpippingRate(){

        $products_shipping = DB::table('products_shipping_rates_km')->orderBy('km_id' , 'asc')
        ->paginate(10);
        return $products_shipping;
    }

    public function insert($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbykm = DB::table('products_shipping_rates_km')->insertGetId([
            'km_from'   =>   $request->kmfrom,
            'km_to'   =>    $request->kmto,
            'weight_from'   =>   $request->weightfrom,
            'weight_to'   =>    $request->weightto,
            'km_price'   =>    $request->kmprice,
            'km_commission'   =>    $request->kmcommission,
            'km_status'  =>   $request->kmstatus,
            'created_at' =>	  $date_added,
        ]);
        return $shippingbykm;
    }

    public function edit($request)
    {
    	$editshippingbykm = DB::table('products_shipping_rates_km')
            ->where('km_id', $request->id)->get();
           
        $result['km'] = $editshippingbykm;
        return $result;
    }

    
    public function destroyrecord($request){
        DB::table('products_shipping_rates_km')->where('km_id', $request->km_id)->delete();
        return 'success';
    }

    public function updaterecord($request){
        $date_added	= date('y-m-d H:i:s');
        $shippingbykm = DB::table('products_shipping_rates_km')->where('km_id', $request->km_id)->update([
            'km_from'   =>   $request->kmfrom,
            'km_to'   =>    $request->kmto,
            'weight_from'   =>   $request->weightfrom,
            'weight_to'   =>    $request->weightto,
            'km_price'   =>    $request->kmprice,
            'km_commission'   =>    $request->kmcommission,
            'km_status'  =>   $request->kmstatus,
            'updated_at' =>	  $date_added,
        ]);
        return $shippingbykm;
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
