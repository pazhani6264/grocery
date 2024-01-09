<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Products_shipping_rate_weight;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ShippingByWeightController extends Controller
{
    //
    public function __construct(Products_shipping_rate_weight $products_shipping_rate_weight, Setting $setting)
    {
        $this->Products_shipping_rate_weight = $products_shipping_rate_weight;
        $this->Setting = $setting;
    }

    public function shippingbyweight(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.shippingbyweight"));
        $products_shipping = $this->Products_shipping_rate_weight->getshpippingRate();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbyweight.index", $title)->with('result', $result)->with('products_shipping', $products_shipping);
    }

    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddKM"));
        $result = array();
        $result['message'] = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbyweight.add", $title)->with('result', $result);

    }

     //addshippingbykm
     public function insert(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.Addshippingbyweight"));
         $this->Products_shipping_rate_weight->insert($request);
         $message = Lang::get("labels.shippingbyweightAddedMessage");
         return redirect()->back()->withErrors([$message]);
 
     }

     public function edit(Request $request)
     {
        
         $title = array('pageTitle' => Lang::get("labels.Editshippingbyweight"));
         $result = $this->Products_shipping_rate_weight->edit($request);
         $result['commonContent'] = $this->Setting->commonContent();
         return view("admin.shippingmethods.shippingbyweight.edit", $title)->with('result', $result);
 
     }

     public function delete(Request $request)
     {
         $this->Products_shipping_rate_weight->destroyrecord($request);
         return redirect()->back()->withErrors([Lang::get("labels.shippingbyweightDeletedMessage")]);
 
     }
     public function update(Request $request)
    {
        $this->Products_shipping_rate_weight->updaterecord($request);
        $message = Lang::get("labels.shippingbyweightUpdatedMessage");
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
