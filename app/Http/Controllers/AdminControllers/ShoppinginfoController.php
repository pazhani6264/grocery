<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\News;
use App\Models\Core\NewsCategory;
use App\Models\Core\Shoppinginfo;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Lang;
class ShoppinginfoController extends Controller
{

	public function __construct(Shoppinginfo $shoppinginfo,Images $images, Setting $setting)
    {
    	$this->Shoppinginfo = $shoppinginfo;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }


  public function view(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.shoppinginfo"));
    	$shoppinginfo = $this->Shoppinginfo->paginator();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.shoppinginfo.view_shoppinginfo", $title)->with('result', $result)->with('shoppinginfo',$shoppinginfo);
    }


	public function add(Request $request)
    {
    	$allimage = $this->images->getimages();
    	$title = array('pageTitle' => Lang::get("labels.shoppinginfo"));
    	$language_id = '1';
    	$result = array();
    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$result['commonContent'] = $this->Setting->commonContent();
		$shoppinginfo = $this->Shoppinginfo->paginator();
		$count = count($shoppinginfo);
		if($count < 4)
		{
    	return view("admin.shoppinginfo.add_shoppinginfo", $title)->with('result', $result)->with('allimage', $allimage);
		}
		else
		{
		$message = Lang::get("labels.shoppinginfo_insert");
        return redirect('/admin/shoppinginfo/view')->withErrors([$message]);

		}
    }

    public function insert(Request $request)
    {
    	$date_added	= date('y-m-d h:i:s');
    	$result = array();
    	//get function from other controller
        $languages = $this->myVarsetting->getLanguages();
        $uploadImage = $request->image_id;
		$tint = $request->tint;
		

        $shoppinginfo_id = $this->Shoppinginfo->insert($uploadImage,$date_added,$tint);

        foreach($languages as $languages_data){
        	$shoppinginfoName= 'title_'.$languages_data->languages_id;
        	$shoppinginfoDescriptions= 'description_'.$languages_data->languages_id;

        	$title = $request->$shoppinginfoName;
        	$descriptions = $request->$shoppinginfoDescriptions;
        	$languages_data_id = $languages_data->languages_id;
        	
        		$subcatoger_des = $this->Shoppinginfo->insertearndescription($title,$shoppinginfo_id,$languages_data_id, $descriptions);
        }
        $message = Lang::get("labels.shoppinginfo_insert");
        return redirect()->back()->withErrors([$message]);
    }



	public function filter(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.shoppinginfo"));
    	$shoppinginfo = $this->Shoppinginfo->filter($request);
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.shoppinginfo.view_shoppinginfo", $title)->with('result', $result)->with(['shoppinginfo'=> $shoppinginfo, 'name'=> $request->FilterBy, 'param'=> $request->parameter]);
    }

	public function edit($id)
    {
    	$title = array('pageTitle' => Lang::get("labels.shoppinginfo"));
    	$images = new Images;
    	$allimage = $images->getimages();

    	$result = array();
    	$result['message'] = array();
    	$editshoppinginfo = $this->Shoppinginfo->edit($id);
    	$result['editshoppinginfo'] = $editshoppinginfo;

    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$description_data = array();

    	foreach($result['languages'] as $languages_data){
    		$languages_id = $languages_data->languages_id;
    		$id = $id;
    		$description = $this->Shoppinginfo->editdescription_Shoppinginfo($languages_id,$id);
    		if(count($description)>0){
    			$description_data[$languages_data->languages_id]['name'] = $description[0]->shopping_info_name;
    			$description_data[$languages_data->languages_id]['descriptions'] = $description[0]->shopping_info_description;
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
    	return view("admin.shoppinginfo.edit_shoppinginfo",$title)->with('result', $result)->with('allimage', $allimage);
    }

    public function update(Request $request)
    {
    	$result = array();
    	$result['message'] = Lang::get("labels.Shopping Info has been updated successfully");
    	$last_modified 	=   date('y-m-d h:i:s');
    	$shoppinginfo_id = $request->id;
    		//get function from other controller
     	$languages = $this->myVarsetting->getLanguages();
     	$extensions = $this->myVarsetting->imageType();

     	if($request->image_id!==null){
         	$uploadImage = $request->image_id;
     	}else{
         	$uploadImage = $request->oldImage;
     	}
		 $tint = $request->tint;

     	$update = $this->Shoppinginfo->updaterecord_Shoppinginfo($shoppinginfo_id,$uploadImage,$last_modified,$tint);
     	foreach($languages as $languages_data){
     		$shoppinginfoTitle = 'title_'.$languages_data->languages_id;
     		$shoppinginfoDescriptions= 'description_'.$languages_data->languages_id;
     		$descriptions = $request->$shoppinginfoDescriptions;
      		$title = $request->$shoppinginfoTitle;
      		$languages_data_id = $languages_data->languages_id;

      	
      		$shopping_info_update = $this->Shoppinginfo->updatedescription_shoppinginfo($title,$languages_data,$shoppinginfo_id,$descriptions);
      	
     	}
     	$message = Lang::get("labels.Shopping Info has been updated successfully");
     	return redirect()->back()->withErrors([$message]);
    }

	public function delete(Request $request){
		$deleteshoppinginfo = $this->Shoppinginfo->deleterecord($request);
		$message = Lang::get("labels.shoppinginfoDeleteMessage");
		return redirect()->back()->withErrors([$message]);
	  }




  
}
