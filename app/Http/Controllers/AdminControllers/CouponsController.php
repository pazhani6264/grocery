<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Coupon;
use App\Models\Core\Setting;
use App\Models\Core\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    //
    public function __construct(Coupon $coupon, Setting $setting,Images $images)
    {
        $this->Coupon = $coupon;
        $this->images = $images;
        $this->myVarSetting = new SiteSettingController($setting);
        $this->Setting = $setting;

    }

    public function display(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ListingCoupons"));
        $result = array();
        $message = array();
        $coupons = Coupon::sortable()
            ->orderBy('created_at', 'DESC')
            ->paginate(7);
        $result['coupons'] = $coupons;
        //get function from other controller
        $result['currency'] = $this->myVarSetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.coupons.index", $title)->with('result', $result)->with('coupons', $coupons);

    }

    public function filter(Request $request)
    {

        $result = array();
        $message = array();
        $title = array('pageTitle' => Lang::get("labels.EditSubCategories"));
        $name = $request->FilterBy;
        $param = $request->parameter;
        $param2 = $request->parameter2;
        $dateRange = $request->dateRange;
        switch ($name) {
            case 'Code':
                
                $couponsnew = Coupon::sortable()->where('code', 'LIKE', '%' . $param . '%');
                if (isset($dateRange)) {
                    $range = explode('-', $dateRange);
        
                    $startdate = trim($range[0]);
                    $enddate = trim($range[1]);
        
                    $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                    $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                    $couponsnew->whereBetween('expiry_date', [$dateFrom, $dateTo]);
        
                }
                $coupons = $couponsnew->orderBy('created_at', 'DESC')
                    ->paginate(7);

                break;
            case 'type':
                $couponsnew = Coupon::sortable()->where('coupans_type', $param2);
                if (isset($dateRange)) {
                    $range = explode('-', $dateRange);
        
                    $startdate = trim($range[0]);
                    $enddate = trim($range[1]);
        
                    $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                    $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                    $couponsnew->whereBetween('expiry_date', [$dateFrom, $dateTo]);
        
                }
                $coupons = $couponsnew->orderBy('created_at', 'DESC')
                    
                    ->paginate(7);

                break;
            case 'CouponAmount':
                $coupons = Coupon::sortable()->where('amount', 'LIKE', '%' . $param . '%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(7);

                break;
            case 'Description':
                $coupons = Coupon::sortable()->where('description', 'LIKE', '%' . $param . '%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(7);

                break;
            default:
            $couponsnew = Coupon::sortable()->where('code', 'LIKE', '%' . $param . '%');
            if (isset($dateRange)) {
                $range = explode('-', $dateRange);
    
                $startdate = trim($range[0]);
                $enddate = trim($range[1]);
    
                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $couponsnew->whereBetween('expiry_date', [$dateFrom, $dateTo]);
    
            }
            $coupons = $couponsnew->orderBy('created_at', 'DESC')
                    
                    ->paginate(7);

                break;
        }

        $result['coupons'] = $coupons;
        //get function from other controller
        $result['currency'] = $this->myVarSetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.coupons.index", $title)->with('result', $result)->with('coupons', $coupons)->with('name', $name)->with('param', $param)->with('param2', $param2)->with('dateRange', $dateRange);
    }

    public function add(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddCoupon"));
        $result = array();
        $message = array();
        $result['message'] = $message;
        $allimage = $this->images->getimages();
        $emails = $this->Coupon->email();
        $result['emails'] = $emails;
        $products = $this->Coupon->cutomers();
        $result['products'] = $products;
        $categories = $this->Coupon->categories();
        $result['categories'] = $categories;
        $result['point']=$this->Coupon->get_point_settings();
        //print_r($result['point']);die();

        $payment = $this->Coupon->payment();
        $result['payment'] = $payment;

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.coupons.add", $title)->with('result', $result)->with('allimage', $allimage);
    }

    public function insert(Request $request)
    {
        if ($request->free_shipping !== null) {
            $free_shipping = $request->free_shipping;
        } else {
            $free_shipping = '0';
        }

        $code = $request->code;
        $description = $request->description;
        $discount_type = $request->discount_type;
        $amount = $request->amount;
        $coupans_type=$request->coupon_type;

        //if(!empty($request->cap_amount)){
            $cap_amount = $request->cap_amount;
        //}else{
            //$cap_amount = '0';
        //}
        

        $date = str_replace('/', '-', $request->expiry_date);
        $expiry_date = date('Y-m-d', strtotime($date));

        if ($request->individual_use !== null) {
            $individual_use = $request->individual_use;
        } else {
            $individual_use = 0;
        }

        //include products
        if ($request->product_ids !== null) {
            $product_ids = implode(',', $request->product_ids);
        } else {
            $product_ids = '';
        }

        if ($request->exclude_product_ids !== null) {
            $exclude_product_ids = implode(',', $request->exclude_product_ids);
        } else {
            $exclude_product_ids = '';
        }

        //limit
        $usage_limit = $request->usage_limit;
        $usage_limit_per_user = $request->usage_limit_per_user;

        //$limit_usage_to_x_items = $request->limit_usage_to_x_items;

        if ($request->product_categories !== null) {
            $product_categories = implode(',', $request->product_categories);
        } else {
            $product_categories = '';
        }

        if ($request->excluded_product_categories !== null) {
            $excluded_product_categories = implode(',', $request->excluded_product_categories);
        } else {
            $excluded_product_categories = '';
        }

        if ($request->exclude_sale_items !== null) {
            $exclude_sale_items = $request->exclude_sale_items;
        } else {
            $exclude_sale_items = 0;
        }

        if ($request->email_restrictions !== null) {
            $email_restrictions = implode(',', $request->email_restrictions);
        } else {
            $email_restrictions = '';
        }

        //$minimum_amount = $request->minimum_amount;
        $maximum_amount = $request->maximum_amount;

        if ($request->usage_count !== null) {
            $usage_count = $request->usage_count;
        } else {
            $usage_count = 0;
        }

        if ($request->used_by !== null) {
            $used_by = $request->used_by;
        } else {
            $used_by = '';
        }

        if ($request->limit_usage_to_x_items !== null) {
            $limit_usage_to_x_items = $request->limit_usage_to_x_items;
        } else {
            $limit_usage_to_x_items = 0;
        }

        if($request->discount_type == 'point'){
            $addpoint=$request->point;
        }else{
            $addpoint=0;
        }

        if($request->payment_type != ''){
            $payment_type=$request->payment_type;
        }else{
            $payment_type = 0;
        }

        

         if($request->minimum_amount!==null){
            $minimum_amount = $request->minimum_amount;
        }else{
            $minimum_amount ='0';
        }

        if($request->products_id!==null){
            $products_id = $request->products_id;
        }else{
            $products_id = '0';
        }

        $uploadImage = $request->image_id;

        $validator = Validator::make(
            array(
                'code' => $request->code,
            ),
            array(
                'code' => 'required',
            )
        );
        //check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            //check coupon already exist
            $couponInfo = $this->Coupon->coupon($code);

            if (count($couponInfo) > 0) {
                return redirect()->back()->withErrors(Lang::get("labels.CouponAlreadyError"))->withInput();
            } else if (empty($code)) {
                return redirect()->back()->withErrors(Lang::get("labels.EnterCoupon"))->withInput();
            } else {

                if(!empty($usage_limit_per_user) && !empty($usage_limit)){

                    if($usage_limit_per_user <= $usage_limit){

                //insert record
                $coupon_id = $this->Coupon->addcoupon($code, $description,
                    $discount_type,$payment_type, $amount, $individual_use, $product_ids,
                    $exclude_product_ids, $usage_limit, $usage_limit_per_user, $usage_count
                    , $used_by, $limit_usage_to_x_items, $product_categories, $excluded_product_categories,
                    $exclude_sale_items, $email_restrictions, $minimum_amount, $maximum_amount, $expiry_date, $free_shipping,$addpoint,$uploadImage,$coupans_type,$cap_amount,$products_id);
                //update qrcode 
                $timestamp=date('YmdHis');
                if($request->discount_type == 'product'){
                    $qdata=$coupon_id.'|'.$timestamp.'|004';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }else{
                    $qdata=$coupon_id.'|'.$timestamp.'|003';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }
                DB::table('coupons')->where('coupans_id', '=', $coupon_id)->update(['qrcode'=>$qrcode]);

                return redirect('admin/coupons/add')->with('success', Lang::get("labels.CouponAddedMessage"));
            }else{
               return redirect('admin/coupons/add')->with('failure', Lang::get("labels.CouponfailureMessage"));
            }
        }else{
             $coupon_id = $this->Coupon->addcoupon($code, $description,
                    $discount_type,$payment_type, $amount, $individual_use, $product_ids,
                    $exclude_product_ids, $usage_limit, $usage_limit_per_user, $usage_count
                    , $used_by, $limit_usage_to_x_items, $product_categories, $excluded_product_categories,
                    $exclude_sale_items, $email_restrictions, $minimum_amount, $maximum_amount, $expiry_date, $free_shipping,$addpoint,$uploadImage,$coupans_type,$cap_amount,$products_id);
             //update qrcode 
                $timestamp=date('YmdHis');
                if($request->discount_type == 'product'){
                    $qdata=$coupon_id.'|'.$timestamp.'|004';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }else{
                    $qdata=$coupon_id.'|'.$timestamp.'|003';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }
                DB::table('coupons')->where('coupans_id', '=', $coupon_id)->update(['qrcode'=>$qrcode]);

             return redirect('admin/coupons/add')->with('success', Lang::get("labels.CouponAddedMessage"));
        }

            }
        }

    }

    public function edit(Request $request, $id)
    {

        $title = array('pageTitle' => Lang::get("labels.EditCoupon"));
        $result = array();
        $message = array();
        $result['message'] = $message;
        //coupon
        $allimage = $this->images->getimages();
        $coupon = $this->Coupon->getcoupon($id);
        $result['coupon'] = $coupon;
        $emails = $this->Coupon->getemail();
        $result['emails'] = $emails;
        $products = $this->Coupon->getproduct();
        $result['products'] = $products;
        $categories = $this->Coupon->getcategories();
        $result['categories'] = $categories;
        $result['point']=$this->Coupon->get_point_settings();
        $result['commonContent'] = $this->Setting->commonContent();

        $payment = $this->Coupon->payment();
        $result['payment'] = $payment;
        
        return view("admin.coupons.edit", $title)->with('result', $result)->with('allimage', $allimage);
    }

    public function update(Request $request)
    {

        $coupans_id = $request->id;
        if (!empty($request->free_shipping)) {
            $free_shipping = $request->free_shipping;
        } else {
            $free_shipping = '0';
        }
        $code = $request->code;
        $description = $request->description;
        $discount_type = $request->discount_type;
        $amount = $request->amount;
        $coupans_type=$request->coupon_type;
        
        //if(!empty($request->cap_amount)){
            $cap_amount = $request->cap_amount;
        //}else{
            //$cap_amount = '0';
        //}

        $date = str_replace('/', '-', $request->expiry_date);
        $expiry_date = date('Y-m-d', strtotime($date));
        if (!empty($request->individual_use)) {
            $individual_use = $request->individual_use;
        } else {
            $individual_use = '';
        }
        //include products
        if (!empty($request->product_ids)) {
            $product_ids = implode(',', $request->product_ids);
        } else {
            $product_ids = '';
        }
        if (!empty($request->exclude_product_ids)) {
            $exclude_product_ids = implode(',', $request->exclude_product_ids);
        } else {
            $exclude_product_ids = '';
        }
        $usage_limit = $request->usage_limit;
        $usage_limit_per_user = $request->usage_limit_per_user;
        if (!empty($request->product_categories)) {
            $product_categories = implode(',', $request->product_categories);
        } else {
            $product_categories = '';
        }
        if (!empty($request->excluded_product_categories)) {
            $excluded_product_categories = implode(',', $request->excluded_product_categories);
        } else {
            $excluded_product_categories = '';
        }
        if (!empty($request->email_restrictions)) {
            $email_restrictions = implode(',', $request->email_restrictions);
        } else {
            $email_restrictions = '';
        }
        //$minimum_amount = $request->minimum_amount;
        $maximum_amount = $request->maximum_amount;
        $validator = Validator::make(
            array(
                'code' => $request->code,
            ),
            array(
                'code' => 'required',
            )
        );

        if ($request->usage_count !== null) {
            $usage_count = $request->usage_count;
        } else {
            $usage_count = 0;
        }
        if ($request->used_by !== null) {
            $used_by = $request->used_by;
        } else {
            $used_by = '';
        }
        if ($request->limit_usage_to_x_items !== null) {
            $limit_usage_to_x_items = $request->limit_usage_to_x_items;
        } else {
            $limit_usage_to_x_items = 0;
        }

         if($request->discount_type == 'point'){
            $addpoint=$request->point;
        }else{
            $addpoint=0;
        }

        if($request->payment_type != ''){
            $payment_type=$request->payment_type;
        }else{
            $payment_type=0;
        }

        if($request->image_id!==null){
            $uploadImage = $request->image_id;
        }else{
            $uploadImage = $request->oldImage;
        }

        if($request->minimum_amount!==null){
            $minimum_amount = $request->minimum_amount;
        }else{
            $minimum_amount ='0';
        }

        if($request->products_id!==null){
            $products_id = $request->products_id;
        }else{
            $products_id = '0';
        }

        $timestamp=date('YmdHis');
        if($request->discount_type == 'product'){
            $qdata=$coupans_id.'|'.$timestamp.'|004';
            $qrcode=$this->Setting->getResEncryption($qdata);
        }else{
            $qdata=$coupans_id.'|'.$timestamp.'|003';
            $qrcode=$this->Setting->getResEncryption($qdata);
        }




        //check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            //check coupon already exist
            $couponInfo = $this->Coupon->getcode($code);
            if (count($couponInfo) > 1) {
                return redirect()->back()->withErrors(Lang::get("labels.CouponAlreadyError"))->withInput();
            } else if (empty($code)) {
                return redirect()->back()->withErrors(Lang::get("labels.EnterCoupon"))->withInput();
            } else {
                 if(!empty($usage_limit_per_user) && !empty($usage_limit)){
                if($usage_limit_per_user <= $usage_limit){
                //insert record
                $coupon_id = $this->Coupon->couponupdate($coupans_id, $code, $description, $discount_type,$payment_type, $amount, $individual_use,
                    $product_ids, $exclude_product_ids, $usage_limit, $usage_limit_per_user, $usage_count,
                    $limit_usage_to_x_items, $product_categories, $used_by, $excluded_product_categories,
                    $request, $email_restrictions, $minimum_amount, $maximum_amount, $expiry_date, $free_shipping,$addpoint,$uploadImage,$coupans_type,$cap_amount,$products_id,$qrcode);

                $message = Lang::get("labels.CouponUpdatedMessage");
                return redirect()->back()->withErrors([$message]);
            }else{
               return redirect('admin/coupons/add')->with('failure', Lang::get("labels.CouponfailureMessage"));
            }
        }else {
             //insert record
                $coupon_id = $this->Coupon->couponupdate($coupans_id, $code, $description, $discount_type,$payment_type, $amount, $individual_use,
                    $product_ids, $exclude_product_ids, $usage_limit, $usage_limit_per_user, $usage_count,
                    $limit_usage_to_x_items, $product_categories, $used_by, $excluded_product_categories,
                    $request, $email_restrictions, $minimum_amount, $maximum_amount, $expiry_date, $free_shipping,$addpoint,$uploadImage,$coupans_type,$cap_amount,$products_id,$qrcode);
                 $message = Lang::get("labels.CouponUpdatedMessage");
                return redirect()->back()->withErrors([$message]);

        }



            }

        }

    }

    public function delete(Request $request)
    {
        $deletecoupon = DB::table('coupons')->where('coupans_id', '=', $request->id)->delete();
        return redirect()->back()->withErrors([Lang::get("labels.CouponDeletedMessage")]);
    }

}
