<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Products_shipping_rate_km;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ShippingByKMController extends Controller
{
    //
    public function __construct(Products_shipping_rate_km $products_shipping_rate_km, Setting $setting)
    {
        $this->Products_shipping_rate_km = $products_shipping_rate_km;
        $this->Setting = $setting;
    }

    public function shippingbykm(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.shippingbykm"));
        $products_shipping = $this->Products_shipping_rate_km->getshpippingRate();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbykm.index", $title)->with('result', $result)->with('products_shipping', $products_shipping);
    }

    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddKM"));
        $result = array();
        $result['message'] = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbykm.add", $title)->with('result', $result);

    }

     //addshippingbykm
     public function insert(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.Addshippingbykm"));
         $this->Products_shipping_rate_km->insert($request);
         $message = Lang::get("labels.shippingbykmAddedMessage");
         return redirect()->back()->withErrors([$message]);
 
     }

     public function edit(Request $request)
     {
        
         $title = array('pageTitle' => Lang::get("labels.Editshippingbykm"));
         $result = $this->Products_shipping_rate_km->edit($request);
         $result['commonContent'] = $this->Setting->commonContent();
         return view("admin.shippingmethods.shippingbykm.edit", $title)->with('result', $result);
 
     }

     public function delete(Request $request)
     {
         $this->Products_shipping_rate_km->destroyrecord($request);
         return redirect()->back()->withErrors([Lang::get("labels.shippingbykmDeletedMessage")]);
 
     }
     public function update(Request $request)
    {
        $this->Products_shipping_rate_km->updaterecord($request);
        $message = Lang::get("labels.shippingbykmUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }


    public function updateShppingWeightPrice(Request $request)
    {
        for ($i = 0; $i <= 4; $i++) {
            $weight_from = 'weight_from_' . $i;
            $weight_to = 'weight_to_' . $i;
            $weight_price = 'weight_price_' . $i;
            print $request->$weight_from;
            $products_shipping_rates_id = $i + 1;
            $re_weight_from = $request->$weight_from;
            $re_weight_to = $request->$weight_to;
            $re_weight_price = $request->$weight_price;
            $this->Products_shipping_rate->updateshippingprice($re_weight_from, $re_weight_to, $re_weight_price, $products_shipping_rates_id);
        }
        
        $message = Lang::get("labels.WeightPriceUpdatedSuccessMessage");
        return redirect()->back()->withErrors([$message]);
    }

}
