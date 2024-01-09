<?php
 namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\News;
use App\Models\Core\NewsCategory;
use App\Models\Core\Collection;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Lang;
class CollectionController extends Controller
{
	public function __construct(Collection $collection,Images $images, Setting $setting)
    {
    	$this->Collection = $collection;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }

    public function view(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.collection"));
    	$collection = $this->Collection->paginator();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.collection.view_collection", $title)->with('result', $result)->with('collection',$collection);
    }
    public function add(Request $request)
    {
    	$allimage = $this->images->getimages();
    	$title = array('pageTitle' => Lang::get("labels.collection"));
    	$language_id = '1';
    	$result = array();
    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.collection.add_collection", $title)->with('result', $result)->with('allimage', $allimage);
    }

    public function insert(Request $request)
    {
    	$date_added	= date('y-m-d h:i:s');
    	$result = array();
    	//get function from other controller
        $languages = $this->myVarsetting->getLanguages();
        $uploadImage = $request->image_id;
        $categories_status  = $request->categories_status;

        $collection_id = $this->Collection->insert($uploadImage,$date_added,$categories_status);

        foreach($languages as $languages_data){
        	$collectionName= 'title_'.$languages_data->languages_id;
        	$collectionDescriptions= 'description_'.$languages_data->languages_id;

        	$title = $request->$collectionName;
        	$descriptions = $request->$collectionDescriptions;
        	$languages_data_id = $languages_data->languages_id;
        	$checkExist = DB::table('collections_description')->where('language_id','=',$languages_data->languages_id)->where('collections_name','=',$title)->first();
        	if($checkExist){
        		DB::table('collections')->where('id','=',$collection_id)->delete();
        		$message = Lang::get("labels.collection_already");
        		return redirect()->back()->withErrors([$message]);
        	}else{
        		$subcatoger_des = $this->Collection->insertearndescription($title,$collection_id,$languages_data_id, $descriptions);
        	}
        }
        $message = Lang::get("labels.collection_insert");
        return redirect()->back()->withErrors([$message]);
    }

    public function edit($id)
    {
    	$title = array('pageTitle' => Lang::get("labels.collection"));
    	$images = new Images;
    	$allimage = $images->getimages();

    	$result = array();
    	$result['message'] = array();
    	$editcollection = $this->Collection->edit($id);
    	$result['editcollection'] = $editcollection;

    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$description_data = array();

    	foreach($result['languages'] as $languages_data){
    		$languages_id = $languages_data->languages_id;
    		$id = $id;
    		$description = $this->Collection->editdescription_Collection($languages_id,$id);
    		if(count($description)>0){
    			$description_data[$languages_data->languages_id]['name'] = $description[0]->collections_name;
    			$description_data[$languages_data->languages_id]['descriptions'] = $description[0]->collections_description;
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
    	return view("admin.collection.edit_collection",$title)->with('result', $result)->with('allimage', $allimage);
    }

    public function update(Request $request)
    {
    	$result = array();
    	$result['message'] = Lang::get("labels.Collection has been updated successfully");
    	$last_modified 	=   date('y-m-d h:i:s');
    	$collection_id = $request->id;
    	$status  = $request->categories_status;

    		//get function from other controller
     	$languages = $this->myVarsetting->getLanguages();
     	$extensions = $this->myVarsetting->imageType();

     	if($request->image_id!==null){
         	$uploadImage = $request->image_id;
     	}else{
         	$uploadImage = $request->oldImage;
     	}

     	$update = $this->Collection->updaterecord_Collection($collection_id,$uploadImage,$last_modified,$status);
     	foreach($languages as $languages_data){
     		$collectionTitle = 'title_'.$languages_data->languages_id;
     		$collectionDescriptions= 'description_'.$languages_data->languages_id;
     		$descriptions = $request->$collectionDescriptions;
      		$title = $request->$collectionTitle;
      		$languages_data_id = $languages_data->languages_id;

      		$checktitle=DB::table('collections_description')->where('language_id','=',$languages_data->languages_id)->where('collections_name','=',$title)->where('collections_id','!=',$collection_id)->first();

      		if(empty($checktitle)){
      			$checkExist = $this->Collection->checkExit_earn_point($collection_id,$languages_data);
      			if(count($checkExist)>0){
      				$collection_update = $this->Collection->updatedescription_collection($title,$languages_data,$collection_id,$descriptions);
      			}else{
      				$updat_des = $this->Collection->insertearndescription($title,$collection_id,$languages_data_id, $descriptions);
      			}
      		}else{
      			$message = Lang::get("labels.collection_already");
        		return redirect()->back()->withErrors([$message]);
      		}
     	}
     	$message = Lang::get("labels.Collection has been updated successfully");
     	return redirect()->back()->withErrors([$message]);
    }

	//deleteNews
	public function delete(Request $request)
	{
		$this->Collection->destroyrecord($request);
		return redirect()->back()->withErrors(['Collection has been deleted successfully!']);
	}
	public function delete_product(Request $request)
	{
		$this->Collection->destroyrecord_product($request);
		return redirect()->back()->withErrors(['Collection Product has been deleted successfully!']);
	}

    public function filter(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.collection"));
    	$collection = $this->Collection->filter($request);
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.collection.view_collection", $title)->with('result', $result)->with(['collection'=> $collection, 'name'=> $request->FilterBy, 'param'=> $request->parameter]);
    }

    public function product(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.collection"));
    	$collection=$this->Collection->get_collection();
      $category=$this->Collection->get_category();
      //print_r($category);die();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.collection.add_collection_product", $title)->with(['collection'=> $collection, 'result'=> $result,'category'=>$category]);
    }

    public function getproduct(Request $request)
    {
       $getproduct = array();
	   $currentDate = time();
	   $nonflashsale = DB::table('flash_sale')->where('flash_sale.flash_status', '=', '1')->where('flash_expires_date', '>', $currentDate)->pluck('products_id');
	   if(count($nonflashsale) > 0)
	   {
		$nonflashsales = $nonflashsale;
		}
		else
		{
			$nonflashsales[] = 0;
		}
	  
		 
	   
        $getproduct = DB::table('products_to_categories')
         ->leftJoin('products_description','products_description.products_id', '=', 'products_to_categories.products_id')
        ->select('products_to_categories.products_id','products_description.products_name')
         ->where('products_description.language_id', '1')
        ->where('products_to_categories.categories_id', $request->categories_id)
		->whereNotIn('products_to_categories.products_id', $nonflashsales)
		
	   
		->groupby('products_to_categories.products_id')->get();
	   

	   
        if (count($getproduct) > 0) {
            $responseData = array('success' => '1', 'data' => $getproduct, 'message' => "Returned all product.");
        } else {

            $responseData = array('success' => '0', 'data' => $getproduct, 'message' => "Returned all product.");
        }
        $zoneResponse = json_encode($responseData);
        print $zoneResponse;
    }
    public function add_product(Request $request)
    {
        $proid=$request->product_id;

          foreach($proid as $jesproid){
          
           $product = $this->Collection->insert_product($request,$jesproid);
           if($product=='failure'){
              $message = Lang::get("labels.collection_product_already");
           }else{
              $message = Lang::get("labels.collection_product_insert");
           }
        }
        return redirect()->back()->withErrors([$message]);
    }
    public function view_product($id)
    {
      $title = array('pageTitle' => Lang::get("labels.collection"));
      $result['commonContent'] = $this->Setting->commonContent();
      $product=$this->Collection->collection_product($id);
      return view("admin.collection.collection_product_view", $title)->with(['result'=> $result,'product'=>$product]);
    }
    public function product_edit($id)
    {
        $title = array('pageTitle' => Lang::get("labels.collection"));
        $result['commonContent'] = $this->Setting->commonContent();
        $product=$this->Collection->collection_product_edit($id);
        $collection=$this->Collection->get_collection();
        $category=$this->Collection->get_category();
        $getproduct=$this->Collection->get_product();
        //print_r($getproduct);die();
        return view("admin.collection.collection_product_edit", $title)->with(['result'=> $result,'product'=>$product,'collection'=> $collection,'category'=>$category,'getproduct'=>$getproduct]);
    }

    public function update_product(Request $request)
    {
         $product = $this->Collection->update_product($request);

         if($product=='failure'){
          $message = Lang::get("labels.collection_product_already");
       }else{
          $message = Lang::get("labels.collection_product_insert");
       }
       return redirect()->back()->withErrors([$message]);
    }
}
?>