<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Products_shipping_rate_weight_and_km;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ShippingByWeightAndKMController extends Controller
{
    //
    public function __construct(Products_shipping_rate_weight_and_km $Products_shipping_rate_weight_and_km, Setting $setting)
    {
        $this->Products_shipping_rate_weight_and_km = $Products_shipping_rate_weight_and_km;
        $this->Setting = $setting;
    }

    public function shippingbyweightandkm(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.shippingbykm"));
        $products_shipping = $this->Products_shipping_rate_weight_and_km->getshpippingRate();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbyweightandkm.index", $title)->with('result', $result)->with('products_shipping', $products_shipping);
    }

    public function addWeight(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddWeight"));
        $result = array();
        $result['message'] = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbyweightandkm.add_weight", $title)->with('result', $result);

    }

     //addshippingbykm
     public function insertWeight(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.AddshippingbyWeight"));
         $this->Products_shipping_rate_weight_and_km->insertWeight($request);
         $message = Lang::get("labels.shippingbykmAddedMessage");
         return redirect()->back()->withErrors([$message]);
 
     }

     public function editWeight(Request $request)
     {
        
         $title = array('pageTitle' => Lang::get("labels.Editshippingbykm"));
         $result = $this->Products_shipping_rate_weight_and_km->editWeight($request);
         $result['commonContent'] = $this->Setting->commonContent();
         return view("admin.shippingmethods.shippingbyweightandkm.edit_weight", $title)->with('result', $result);
 
     }

     public function deleteWeight(Request $request)
     {
         $this->Products_shipping_rate_weight_and_km->destroyrecordWeight($request);
         return redirect()->back()->withErrors([Lang::get("labels.shippingbykmDeletedMessage")]);
 
     }
     public function updateWeight(Request $request)
    {
        $this->Products_shipping_rate_weight_and_km->updaterecordWeight($request);
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
            $this->Products_shipping_rate->updateshippingpriceWeight($re_weight_from, $re_weight_to, $re_weight_price, $products_shipping_rates_id);
        }
        
        $message = Lang::get("labels.WeightPriceUpdatedSuccessMessage");
        return redirect()->back()->withErrors([$message]);
    }



    public function addKM(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddKM"));
        $result = array();
        $result['message'] = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.shippingbyweightandkm.add_km", $title)->with('result', $result);

    }

     //addshippingbykm
     public function insertKM(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.Addshippingbykm"));
         $this->Products_shipping_rate_weight_and_km->insertKM($request);
         $message = Lang::get("labels.shippingbykmAddedMessage");
         return redirect()->back()->withErrors([$message]);
 
     }

     public function editKM(Request $request)
     {
        
         $title = array('pageTitle' => Lang::get("labels.Editshippingbykm"));
         $result = $this->Products_shipping_rate_weight_and_km->editKM($request);
         $result['commonContent'] = $this->Setting->commonContent();
         return view("admin.shippingmethods.shippingbyweightandkm.edit_km", $title)->with('result', $result);
 
     }

     public function deleteKM(Request $request)
     {
         $this->Products_shipping_rate_weight_and_km->destroyrecordKM($request);
         return redirect()->back()->withErrors([Lang::get("labels.shippingbykmDeletedMessage")]);
 
     }
     public function updateKM(Request $request)
    {
        $this->Products_shipping_rate_weight_and_km->updaterecordKM($request);
        $message = Lang::get("labels.shippingbykmUpdatedMessage");
        return redirect()->back()->withErrors([$message]);
    }


    public function updateShppingKMPrice(Request $request)
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
            $this->Products_shipping_rate->updateshippingpriceKM($re_weight_from, $re_weight_to, $re_weight_price, $products_shipping_rates_id);
        }
        
        $message = Lang::get("labels.WeightPriceUpdatedSuccessMessage");
        return redirect()->back()->withErrors([$message]);
    }

}
