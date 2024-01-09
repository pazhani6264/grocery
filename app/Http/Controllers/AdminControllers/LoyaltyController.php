<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\News;
use App\Models\Core\NewsCategory;
use App\Models\Core\Loyalty;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lang;

class LoyaltyController extends Controller
{
	public function __construct(Loyalty $loyalty,Images $images, Setting $setting)
    {
    	$this->Loyalty = $loyalty;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }
	public function earn_points_view(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.News"));
    	$earn_points = $this->Loyalty->paginator($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.earn_points_view", $title)->with('earn_points', $earn_points)->with('result', $result);
    }
    public function filter(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.point"));
      $earn_points = $this->Loyalty->filter($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.earn_points_view", $title)->with(['earn_points'=> $earn_points, 'name'=> $request->FilterBy, 'param'=> $request->parameter])->with('result', $result);
    }
    public function add_earn_points(Request $request)
    {
    	$allimage = $this->images->getimages();
    	$title = array('pageTitle' => Lang::get("labels.add_new_earn_points"));
    	$language_id = '1';
    	$result = array();
    	$result['languages'] = $this->myVarsetting->getLanguages();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.add_earn_points", $title)->with('result', $result)->with('allimage', $allimage);
    }
    public function add_earn_points_action(Request $request)
    {
    	$date_added	= date('y-m-d h:i:s');
        $result = array();
        //get function from other controller
        $languages = $this->myVarsetting->getLanguages();

        $uploadImage = $request->image_id;
        $categories_status  = $request->categories_status;
        $point = $request->point;
        $no_rm = $request->amount;
        $earn_points_id = $this->Loyalty->insert($uploadImage,$point,$date_added,$categories_status,$no_rm);
        //multiple lanugauge with record
        foreach($languages as $languages_data){
        	$earnName= 'title_'.$languages_data->languages_id;
            $earnDescriptions= 'description_'.$languages_data->languages_id;

            $titleNameSub = $request->$earnName;
            $descriptions = $request->$earnDescriptions;
            $languages_data_id = $languages_data->languages_id;

            $subcatoger_des = $this->Loyalty->insertearndescription($titleNameSub,$earn_points_id,$languages_data_id, $descriptions);
        }
         $message = Lang::get("labels.Addearnpoints");
        return redirect()->back()->withErrors([$message]);
    }
    public function edit_earn_points(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.edit_new_earn_points"));
    	$images = new Images;
    	$allimage = $images->getimages();

    	$result = array();
    	$result['message'] = array();
    	$editearnpoints = $this->Loyalty->editearnpoints($request);
    	$result['editearnpoints'] = $editearnpoints;

    	//get function from other controller
    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$description_data = array();
    	foreach($result['languages'] as $languages_data){
        $languages_id = $languages_data->languages_id;
        $id = $request->id;
        $description = $this->Loyalty->editdescription_earn($languages_id,$id);

        if(count($description)>0){
          $description_data[$languages_data->languages_id]['name'] = $description[0]->earn_points_title;
          $description_data[$languages_data->languages_id]['descriptions'] = $description[0]->earn_points_description;
          $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
          $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }else{
          $description_data[$languages_data->languages_id]['name'] = '';
          $description_data[$languages_data->languages_id]['descriptions'] = '';
          $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
          $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }
    }

    $result['description'] = $description_data;
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.loyalty.edit_earn_points",$title)->with('result', $result)->with('allimage', $allimage);
    }

    public function update_earn_points(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.edit_new_earn_points"));
    	$result = array();
    	$result['message'] = Lang::get("labels.Earn point has been updated successfully");
    	$last_modified 	=   date('y-m-d h:i:s');
    	$earn_point_id = $request->id;
    	$points=$request->point;
    	$no_rm = $request->amount;
     	$status  = $request->categories_status;

     	//get function from other controller
     	$languages = $this->myVarsetting->getLanguages();
     	$extensions = $this->myVarsetting->imageType();

     	 if($request->image_id!==null){
         	$uploadImage = $request->image_id;
     	}else{
         	$uploadImage = $request->oldImage;
     	}
     	$update = $this->Loyalty->updaterecord_earn_point($earn_point_id,$uploadImage,$points,$last_modified,$status,$no_rm);
     	foreach($languages as $languages_data){
     		$earnTitle = 'title_'.$languages_data->languages_id;
      		$earnDescriptions= 'description_'.$languages_data->languages_id;

      		$descriptions = $request->$earnDescriptions;
      		$title = $request->$earnTitle;
      		$checkExist = $this->Loyalty->checkExit_earn_point($earn_point_id,$languages_data);
      		if(count($checkExist)>0){
      			$category_des_update = $this->Loyalty->updatedescription_earn_point($title,$languages_data,$earn_point_id,$descriptions);
      		}else{
      		   $updat_des = $this->Loyalty->insertcategorydescription_earn_point($title,$earn_point_id, $languages_data->languages_id, $descriptions);
      		}
     	}
     	$message = Lang::get("labels.Earn point has been updated successfully");
     	return redirect()->back()->withErrors([$message]);
    }

    
    public function redeem_delete(Request $request)
    {
      $delete = $this->Loyalty->deleterecord_redeem($request);
      $message = 'Redeem point Deleted Successfully';
      return redirect()->back()->withErrors([$message]);
    }

    public function redeem_points_view(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.point"));
    	$earn_points = $this->Loyalty->paginator_redeem($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.redeem_points_view", $title)->with('earn_points', $earn_points)->with('result', $result);
    }
    public function redeem_filter(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.point"));
      $earn_points = $this->Loyalty->filter_redeem($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.redeem_points_view", $title)->with(['earn_points'=> $earn_points, 'name'=> $request->FilterBy, 'param'=> $request->parameter, 'param2'=> $request->parameter2, 'param3'=> $request->parameter3])->with('result', $result);
    }
    public function redeem_earn_points(Request $request)
    {
    	$allimage = $this->images->getimages();
    	$title = array('pageTitle' => Lang::get("labels.add_new_redeem_points"));
    	$language_id = '1';
    	$result = array();
        $products = $this->Loyalty->cutomers();
        $result['products'] = $products;
    	$result['languages'] = $this->myVarsetting->getLanguages();
      $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.loyalty.add_redeem_points", $title)->with('result', $result)->with('allimage', $allimage);
    }
    public function add_redeem_points_action(Request $request)
    {
    	 $date_added	= date('y-m-d h:i:s');
        $result = array();
        //get function from other controller
        $languages = $this->myVarsetting->getLanguages();
        $uploadImage = $request->image_id;
        $categories_status  = $request->categories_status;
        $point = $request->point;
        $no_rm = $request->amount;
        $discount_type = $request->discount_type;
        //if(!empty($request->cap_amount)){
            $cap_amount = $request->cap_amount;
        //}else{
            //$cap_amount = '0';
        //}

        if($request->products_id!==null){
            $products_id = $request->products_id;
        }else{
            $products_id = '0';
        }
        

        $redeem_points_id = $this->Loyalty->insert_redeem($uploadImage,$point,$date_added,$categories_status,$no_rm,$discount_type,$cap_amount,$products_id);
        //update qrcode 
                $timestamp=date('YmdHis');
                if($request->discount_type == 'product'){
                    $qdata=$redeem_points_id.'|'.$timestamp.'|005';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }else{
                    $qdata=$redeem_points_id.'|'.$timestamp.'|006';
                    $qrcode=$this->Setting->getResEncryption($qdata);
                }
        DB::table('redeem_points_settings')->where('id', '=', $redeem_points_id)->update(['qrcode'=>$qrcode]);
        //multiple lanugauge with record
        foreach($languages as $languages_data){
        	$earnName= 'title_'.$languages_data->languages_id;
            $earnDescriptions= 'description_'.$languages_data->languages_id;

            $titleNameSub = $request->$earnName;
            $descriptions = $request->$earnDescriptions;
            $languages_data_id = $languages_data->languages_id;

            $subcatoger_des = $this->Loyalty->insertearndescription_redeem($titleNameSub,$redeem_points_id,$languages_data_id, $descriptions);
        }
        $message = Lang::get("labels.Addredeempoints");
        return redirect()->back()->withErrors([$message]);

    }
    public function edit_redeem_points(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.edit_redeem_points"));
    	$images = new Images;
    	$allimage = $images->getimages();

    	$result = array();
    	$result['message'] = array();
    	$editredeempoints = $this->Loyalty->editredeem_points($request);
    	$result['editredeempoints'] = $editredeempoints;
        $products = $this->Loyalty->cutomers();
        $result['products'] = $products;
    	//print_r($editearnpoints);die();

    	//get function from other controller
    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$description_data = array();
    	foreach($result['languages'] as $languages_data){
        $languages_id = $languages_data->languages_id;
        $id = $request->id;
        $description = $this->Loyalty->editdescription_redeem($languages_id,$id);

        if(count($description)>0){
          $description_data[$languages_data->languages_id]['name'] = $description[0]->redeem_points_title;
          $description_data[$languages_data->languages_id]['descriptions'] = $description[0]->redeem_points_description;
          $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
          $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }else{
          $description_data[$languages_data->languages_id]['name'] = '';
          $description_data[$languages_data->languages_id]['descriptions'] = '';
          $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
          $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }
    }

    $result['description'] = $description_data;
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.loyalty.edit_redeem_points",$title)->with('result', $result)->with('allimage', $allimage);

    }

    public function update_redeem_points(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.edit_redeem_points"));
    	$result = array();
    	$result['message'] = Lang::get("labels.Redeem point has been updated successfully");
    	$last_modified 	=   date('y-m-d h:i:s');

    	$redeem_point_id = $request->id;
    	$points=$request->point;
     	$status  = $request->categories_status;
     	$no_rm = $request->amount;
      $discount_type = $request->discount_type;
      
      //if(!empty($request->cap_amount)){
          $cap_amount = $request->cap_amount;
      //}else{
          //$cap_amount = '0';
     // }

        if($request->products_id!==null){
            $products_id = $request->products_id;
        }else{
            $products_id = '0';
        }

        $timestamp=date('YmdHis');
        if($request->discount_type == 'product'){
            $qdata=$redeem_point_id.'|'.$timestamp.'|004';
            $qrcode=$this->Setting->getResEncryption($qdata);
        }else{
            $qdata=$redeem_point_id.'|'.$timestamp.'|003';
            $qrcode=$this->Setting->getResEncryption($qdata);
        }

     	//get function from other controller
     	$languages = $this->myVarsetting->getLanguages();
     	$extensions = $this->myVarsetting->imageType();

     	 if($request->image_id!==null){
         	$uploadImage = $request->image_id;
     	}else{
         	$uploadImage = $request->oldImage;
     	}
     	$update = $this->Loyalty->updaterecord_redeem_points($redeem_point_id,$uploadImage,$points,$last_modified,$status,$no_rm,$discount_type,$cap_amount,$products_id,$qrcode);

     	foreach($languages as $languages_data){
     		$earnTitle = 'title_'.$languages_data->languages_id;
      		$earnDescriptions= 'description_'.$languages_data->languages_id;

      		$descriptions = $request->$earnDescriptions;
      		$title = $request->$earnTitle;
      		$checkExist = $this->Loyalty->checkExit_redeem_points($redeem_point_id,$languages_data);
      		if(count($checkExist)>0){
      			$category_des_update = $this->Loyalty->updatedescription_redeem_points($title,$languages_data,$redeem_point_id,$descriptions);
      		}else{
      		   $updat_des = $this->Loyalty->insertcategorydescription_redeem_points($title,$redeem_point_id, $languages_data->languages_id, $descriptions);
      		}
     	}
     	$message = Lang::get("labels.Redeem point has been updated successfully");
     	return redirect()->back()->withErrors([$message]);
    }

    public function view_member_type(Request $request)
    {
       $title = array('pageTitle' => Lang::get("labels.member_type"));
       $member_type = $this->Loyalty->member_type_view();
       //print_r($member_type);die();
       $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.view_member_type", $title)->with('member_type', $member_type)->with('result', $result);
    }
    public function add_member_type(Request $request)
    {

      $allimage = $this->images->getimages();
      $title = array('pageTitle' => Lang::get("labels.add_new_member_type"));
      $language_id = '1';
      $result = array();
      $result['languages'] = $this->myVarsetting->getLanguages();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.add_member_type", $title)->with('result', $result)->with('allimage', $allimage);
    }

    public function add_member_type_action(Request $request)
    {
        $date_added = date('y-m-d h:i:s');
        $result = array();
        //get function from other controller
        $languages = $this->myVarsetting->getLanguages();
        
        $categories_status  = $request->categories_status;
        $title= $request->title;
        $point = $request->point;
        $no_rm = $request->amount;
        $rate_others=$request->rate_others;
        $rate_wallet=$request->rate_wallet;
        $member_card=$request->image_id;
        $member_icon=$request->image_icone;

        $result = $this->Loyalty->insert_member_type($title,$point,$no_rm,$rate_others,$rate_wallet,$member_card,$member_icon,$categories_status,$date_added);

        if($result == 'failure'){
            $message = Lang::get("labels.Addmembertype_checkExist");
        }else{
            $message = Lang::get("labels.Addmembertype");
        }
        return redirect()->back()->withErrors([$message]);
    }

    public function edit_member_type(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.edit_new_member_type"));
        $images = new Images;
        $allimage = $images->getimages();

        $result = array();
        $result['message'] = array();
        $member_type = $this->Loyalty->edit_member_type($request);
        $result['member_type'] = $member_type;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.loyalty.edit_member_type",$title)->with('result', $result)->with('allimage', $allimage);
    }
    public function edit_member_type_action(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.edit_new_member_type"));
      $result = array();
      //$result['message'] = Lang::get("labels.Member type has been updated successfully");
      $date_added   =   date('y-m-d h:i:s');

        $member_type_id = $request->id;
        $categories_status  = $request->categories_status;
        $title= $request->title;
        $point = $request->point;
        $no_rm = $request->amount;
        $rate_others=$request->rate_others;
        $rate_wallet=$request->rate_wallet;
      
        if($request->image_id!==null){
            $member_card = $request->image_id;
        }else{
          $member_card = $request->oldImage;
        }

       if($request->image_icone !==null){
           $member_icon = $request->image_icone;
       }  else{
           $member_icon = $request->oldIcon;
       }

       $result = $this->Loyalty->edit_member_type_action($member_type_id,$title,$point,$no_rm,$rate_others,$rate_wallet,$member_card,$member_icon,$categories_status,$date_added);
       if($result == 'failure'){
            $message = Lang::get("labels.Addmembertype_checkExist");
        }else{
            $message = Lang::get("labels.Member type has been updated successfully");
        }
        return redirect()->back()->withErrors([$message]);
    }

    public function delete_member_type(Request $request)
    {
      $deletecategory = $this->Loyalty->deleterecord_member_type($request);
      $message = Lang::get("labels.memberDeleteMessage");
      return redirect()->back()->withErrors([$message]);
    }
}
?>