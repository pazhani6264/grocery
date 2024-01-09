<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\Products;
use App\Models\Core\Reviews;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

class ProductController extends Controller
{

    public function __construct(Products $products, Languages $language, Images $images, Categories $category, Setting $setting,
        Manufacturers $manufacturer, Reviews $reviews) {
        $this->category = $category;
        $this->reviews = $reviews;
        $this->language = $language;
        $this->images = $images;
        $this->manufacturer = $manufacturer;
        $this->products = $products;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;

    }

    public function reviews(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.reviews"));
        $result = array();
        $data = $this->reviews->paginator();
        $result['reviews'] = $data;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.reviews.index", $title)->with('result', $result);

    }

    public function filter(Request $request)
    {
       $title = array('pageTitle' => Lang::get("labels.reviews"));
       $result = array();
       $data = $this->reviews->filter($request);
        $result['reviews'] = $data;
       $result['commonContent'] = $this->Setting->commonContent(); 
        return view("admin.reviews.index", $title)->with('result', $result)->with(['name'=> $request->FilterBy, 'param'=> $request->parameter]);
    }

    public function editreviews($id, $status)
    {
        if ($status == 1) {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_status' => 1,
                ]);
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                ]);
        } elseif ($status == 0) {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                ]);
        } else {
            DB::table('reviews')
                ->where('reviews_id', $id)
                ->update([
                    'reviews_read' => 1,
                    'reviews_status' => -1,
                ]);
        }
        $message = Lang::get("labels.reviewupdateMessage");
        return redirect()->back()->withErrors([$message]);

    }

    public function display(Request $request)
    {
        $language_id = '1';
        $categories_id = $request->categories_id;
        $product = $request->product;
        $type = $request->type;
        $FilterBy = $request->FilterBy;
        $title = array('pageTitle' => Lang::get("labels.Products"));
        $subCategories = $this->category->allcategories($language_id);
        $products = $this->products->paginator($request);
        $results['products'] = $products;
        $results['currency'] = $this->myVarsetting->getSetting();
        $results['units'] = $this->myVarsetting->getUnits();
        $results['subCategories'] = $subCategories;
        $currentTime = array('currentTime' => time());
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.index", $title)->with('result', $result)->with('results', $results)->with('categories_id', $categories_id)->with('product', $product)->with('type', $type)->with('FilterBy', $FilterBy);

    }

    public function add(Request $request)
    {
       
        $title = array('pageTitle' => Lang::get("labels.AddProduct"));
        $language_id = '1';
        $allimage = $this->images->getimages();
        $result = array();
        $categories = $this->category->recursivecategories_product($request);

        $parent_id = array();
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
            <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class=" required_one categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
          ' . $parents->categories_name . '
          </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
          <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }
        $option .= '</ul>';

        $result['categories'] = $option;

        $result['manufacturer'] = $this->manufacturer->getter($language_id);
        $result['languages'] = $this->myVarsetting->getLanguages();
        $result['units'] = $this->myVarsetting->getUnits();
        $result['commonContent'] = $this->Setting->commonContent();
        if($result['commonContent']['setting']['tax_class']=='2'){
            $taxClass = DB::table('tax_class')->where('tax_type', '2')->get();
        }else{
            $taxClass=[]; 
        }
        $result['taxClass'] = $taxClass;
        return view("admin.products.add", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function childcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            if (in_array($child->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $contents .= '<label> <input id="categories_' . $child->categories_id . '" parents_id="' . $child->parent_id . '"  type="checkbox" name="categories[]" class="required_one sub_categories categories sub_categories_' . $child->parent_id . '" value="' . $child->categories_id . '" ' . $checked . '> ' . $child->categories_name . '</label>';

            if (isset($child->childs)) {
                $contents .= '<ul class="list-group">
        <li class="list-group-item">';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</li></ul>";
            }

        }
        return $contents;
    }

    public function edit(Request $request)
    {
        $allimage = $this->images->getimages();
        $result = $this->products->edit($request);
        //dd($result['categories_array']);
        $categories = $this->category->recursivecategories_product($request);

        $parent_id = $result['categories_array'];
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
        <label style="width:100%">
          <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class=" required_one categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
        ' . $parents->categories_name . '
        </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
        <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }

        $option .= '</ul>';
        $result['categories'] = $option;
        $title = array('pageTitle' => Lang::get("labels.EditProduct"));
        $result['commonContent'] = $this->Setting->commonContent();
         //tax class
        if($result['commonContent']['setting']['tax_class']=='2'){
            $taxClass = DB::table('tax_class')->where('tax_type', '2')->get();
        }else{
            $taxClass=[]; 
        }

        $result['fullURL'] = $request->furl;
        $result['taxClass'] = $taxClass;
        return view("admin.products.edit", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function update(Request $request)
    {
        $allvals=$this->products->sku_already_check($request);
        if($allvals=='0'){
            $startdate = strtotime($request->flash_start_date);
            $expiredate = strtotime($request->flash_expires_date);
            $startdate = $request->flash_start_date;
            $starttime = $request->flash_start_time;
            $start_date = str_replace('/','-',$startdate.' '.$starttime);
            $flash_start_date = strtotime($start_date);
            $expiredate = $request->flash_expires_date;
            $expiretime = $request->flash_end_time;
            $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
            $flash_expires_date = strtotime($expire_date);


            if($flash_start_date > $flash_expires_date){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Flash sale start date can not be greater then expiry date');
                return redirect()->back();
            }
            
           
            $result = $this->products->updaterecord($request);
            $products_id = $request->id;
            if ($request->products_type == 1) {
                $request->session()->put('furl', $request->furl);
                return redirect('admin/products/attach/attribute/display/' . $products_id);
            } else {
                $request->session()->put('furl', $request->furl);
                return redirect('admin/products/images/display/' . $products_id);
            } 
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'This product sku already exists');
            return redirect()->back();
        }       
        
    }

    public function delete(Request $request)
    {
        $this->products->deleterecord($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

    public function insert(Request $request)
    {
        $presult=$this->products->check_product_sku($request);

        if($presult=='0'){

            $startdate = strtotime($request->flash_start_date);
            $expiredate = strtotime($request->flash_expires_date);
            $startdate = $request->flash_start_date;
            $starttime = $request->flash_start_time;
            $start_date = str_replace('/','-',$startdate.' '.$starttime);
            $flash_start_date = strtotime($start_date);
            $expiredate = $request->flash_expires_date;
            $expiretime = $request->flash_end_time;
            $expire_date = str_replace('/','-',$expiredate.' '.$expiretime);
            $flash_expires_date = strtotime($expire_date);


            if($flash_start_date > $flash_expires_date){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Flash sale start date can not be greater then expiry date');
                return redirect()->back();
            }
            
            $title = array('pageTitle' => Lang::get("labels.AddAttributes"));
            $language_id = '1';
            if($request->image_id !== null){
                $uploadImage = $request->image_id[0];
              }else{
                  $uploadImage = '';
              }
              if($uploadImage != '')
              {
                $products_id = $this->products->insert($request);
                $result['data'] = array('products_id' => $products_id, 'language_id' => $language_id);
                    //$alertSetting = $this->myVaralter->newProductNotification($products_id);
                    if ($request->products_type == 1) {
                        $request->session()->put('furl', $request->furl);
                        return redirect('/admin/products/attach/attribute/display/' . $products_id);
                    } else {
                        $request->session()->put('furl', $request->furl);
                        return redirect('admin/products/images/display/' . $products_id);
                    }
              }
              else{
                return redirect()->back()->withErrors("Add image");
              }

        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'This product sku already exists');
            return redirect()->back();
        }
    }

    public function addinventory(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $id = $request->id;
        $result = $this->products->addinventory($id);
        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.add", $title)->with('result', $result);

    }

    public function ajax_min_max($id)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->ajax_min_max($id);
        return $result;

    }

    public function ajax_attr($id)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->ajax_attr($id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.attribute_div")->with('result', $result);

    }
    
    public function ajax_attr_inventory($id){
        $result = $this->products->ajax_attr($id);
        return $result;
    }
    public function addinventoryfromsidebar(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.add1", $title)->with('result', $result);

    }

    public function addnewstock(Request $request)
    {
    
       
        if($this->products->addnewstock($request)){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', Lang::get("labels.inventoryaddedsuccessfully"));
            return redirect()->back();
        }
        
        else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Stock Can not be in minus');
            return redirect()->back();
        }

    }

    public function addminmax(Request $request)
    {

       //dd($request);
       $this->products->addminmax($request);
       return redirect()->back()->withErrors([Lang::get("labels.Min max level added successfully")]);

    }

    public function displayProductImages(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddImages"));
        $products_id = $request->id;
        $result = $this->products->displayProductImages($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products/images/index", $title)->with('result', $result)->with('products_id', $products_id);

    }

    public function addProductImages($products_id)
    {
        $title = array('pageTitle' => Lang::get("labels.AddImages"));
        $allimage = $this->images->getimages();
        $result = $this->products->addProductImages($products_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.products.images.add', $title)->with('result', $result)->with('products_id', $products_id)->with('allimage', $allimage);

    }

    public function insertProductImages(Request $request)
    {
        $product_id = $this->products->insertProductImages($request);
        return redirect()->back()->with('product_id', $product_id);
    }

    public function editProductImages($id)
    {

        $allimage = $this->images->getimages();
        $products_images = $this->products->editProductImages($id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/images/edit")->with('result', $result)->with('products_images', $products_images)->with('allimage', $allimage);

    }

    public function updateproductimage(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.Manage Values"));
        $result = $this->products->updateproductimage($request);
        return redirect()->back();

    }

    public function deleteproductimagemodal(Request $request)
    {

        $products_id = $request->products_id;
        $id = $request->id;
        $result['data'] = array('products_id' => $products_id, 'id' => $id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/images/modal/delete")->with('result', $result);

    }

    public function deleteproductimage(Request $request)
    {
        $this->products->deleteproductimage($request);
        return redirect()->back()->with('success', trans('labels.DeletedSuccessfully'));

    }

    public function addproductattribute(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddAttributes"));
        $result = $this->products->addproductattribute($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.attribute.add", $title)->with('result', $result);
    }

    public function addnewdefaultattribute(Request $request)
    {
        $products_attributes = $this->products->addnewdefaultattribute($request);
        return ($products_attributes);
    }

    public function editdefaultattribute(Request $request)
    {
        $result = $this->products->editdefaultattribute($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/pop_up_forms/editdefaultattributeform")->with('result', $result);
    }

    public function updatedefaultattribute(Request $request)
    {
        $products_attributes = $this->products->updatedefaultattribute($request);
        return ($products_attributes);

    }

    public function deletedefaultattributemodal(Request $request)
    {

        $products_id = $request->products_id;
        $products_attributes_id = $request->products_attributes_id;
        $result['data'] = array('products_id' => $products_id, 'products_attributes_id' => $products_attributes_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/modals/deletedefaultattributemodal")->with('result', $result);

    }

    public function deletedefaultattribute(Request $request)
    {
        $products_attributes = $this->products->deletedefaultattribute($request);
        return ($products_attributes);
    }

    public function showoptions(Request $request)
    {
        $products_attributes = $this->products->showoptions($request);
        return ($products_attributes);
    }

    public function editoptionform(Request $request)
    {
        $result = $this->products->editoptionform($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/pop_up_forms/editproductattributeoptionform")->with('result', $result);

    }

    public function updateoption(Request $request)
    {
        $products_attributes = $this->products->updateoption($request);
        return ($products_attributes);
    }

    public function showdeletemodal(Request $request)
    {

        $products_id = $request->products_id;
        $products_attributes_id = $request->products_attributes_id;
        $result['data'] = array('products_id' => $products_id, 'products_attributes_id' => $products_attributes_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/modals/deleteproductattributemodal")->with('result', $result);

    }

    public function deleteoption(Request $request)
    {

        $products_attributes = $this->products->deleteoption($request);
        return ($products_attributes);

    }

    public function getOptionsValue(Request $request)
    {
        $value = $this->products->getOptionsValue($request);
        if (count($value) > 0) {
            foreach ($value as $value_data) {
                $value_name[] = "<option value='" . $value_data->products_options_values_id . "'>" . $value_data->options_values_name . "</option>";
            }
        } else {
            $value_name = "<option value=''>" . Lang::get("labels.ChooseValue") . "</option>";
        }
        print_r($value_name);
    }

    public function currentstock(Request $request)
    {
        $result = $this->products->currentstock($request);
        print_r(json_encode($result));
    }
 

    public function import(Request $request)
    {
        Excel::import(new ItemsImport,request()->file('userfile'));
        //return back();
        $message=Lang::get("labels.Excelimportsuccessfully");
        return redirect()->back()->withErrors([$message]);
    }

    public function successMsg(Request $request)
    {
        return redirect($request->furl)->withErrors('Product added successfully');;
    }

    public function changeOrder(Request $request)
    {
         if($request->ids){
            $balancearray=array();
            $balancearray=explode(",",$request->ids);
            foreach($balancearray as $sortOrder => $id){
                //$menu = Menu::find($id);
                //$menu->sort_id = $sortOrder;
                //$menu->save();
               DB::table('products_images')
                  ->where('id', $id)
                  ->update(['sort_order' => $sortOrder]);
            }
            return ['success'=>true,'message'=>'Updated'];
         }

    }



    /*  videos  */


    public function displayProductVideos(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddVideos"));
        $products_id = $request->id;
        $result = $this->products->displayProductVideos($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products/videos/index", $title)->with('result', $result)->with('products_id', $products_id);

    }

    public function addProductVideos($products_id)
    {
        $title = array('pageTitle' => Lang::get("labels.AddImages"));
        $result = $this->products->addProductVideos($products_id);
        $allimage = $this->images->getimages();
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.products.videos.add', $title)->with('allimage', $allimage)->with('result', $result)->with('product_id', $products_id);

    }

    public function insertProductVideos(Request $request)
    {
        $product_id = $this->products->insertProductVideos($request);
        $message = Lang::get("video added Successfully");
        return redirect()->back()->with('product_id', $product_id)->withErrors([$message]);
    }

    public function editProductVideos($id)
    {
        $products_videos = $this->products->editProductVideos($id);
        $result['commonContent'] = $this->Setting->commonContent();
        $allimage = $this->images->getimages();  

        
        return view("admin/products/videos/edit")->with('allimage', $allimage)->with('result', $result)->with('products_videos', $products_videos);
    }

    public function updateproductVideos(Request $request)
    {

        $result = $this->products->updateproductvideo($request);
        $message = Lang::get("Video Link Updated Successfully");
        return redirect()->back()->withErrors([$message]);

    }
    public function deleteproductvideorecord(Request $request){
        $deletevideo = $this->products->deleteproductvideorecord($request);
        $message = Lang::get("Video Deleted Successfully");
        return redirect()->back()->withErrors([$message]);
      }
    

      /// PAZHNAI ADd

      public function ajaxAttribute(Request $request){
        $result = $this->products->ajaxAttribute($request);
        return $result;
    }

    public function ajaxAttributeValue(Request $request){
        $result = $this->products->ajaxAttributeValue($request);
        return $result;
    }

    public function ajaxProduct(Request $request){
        $result = $this->products->ajaxProduct($request);
        return $result;
    }
   

    public function deleteMultiple(Request $request)
    {
        $this->products->deleterecordMultiple($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

    public function statusMultiple(Request $request)
    {
        $this->products->statusMultiple($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

    public function cloneProduct(Request $request)
    {
        $this->products->cloneProduct($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

    public function categoryList(Request $request){
        $title = array('pageTitle' => Lang::get("labels.SubCategories"));
        $categories = $this->category->cateall($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.category_list", $title)->with('result', $result)->with(['categories'=> $categories, 'name'=> $request->FilterBy, 'param'=> $request->parameter, 'param2'=> $request->parameter2]);
    }


    public function productSorting(Request $request,$id){
        $language_id = '1';
        $title = array('pageTitle' => Lang::get("labels.Products"));
        $products = $this->products->allproductListbyID($id);
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.product_sorting", $title)->with('result', $result);
    }

    public function updateorderProduct(Request $request)
  {
       $categoryindex = $request->categoryindex;
       $categoryid = $request->categoryid;
       foreach($categoryid as $key=>$id)
       {

    DB::table('products')->where('products_id', $id)->update(
      [
          'productOrder'      =>   $categoryindex[$key]+1,
      ]);

       }
      echo "Success";		 
  }

  public function currentstock_new(Request $request)
  {
      $result = $this->products->currentstocknew($request);
      print_r(json_encode($result));
  }
  public function addnewstocknew(Request $request)
  {
  
     
      if($this->products->addnewstocknew($request)){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content', Lang::get("labels.inventoryaddedsuccessfully"));
          return redirect()->back();
      }
      
      else{
          $request->session()->flash('message.level', 'danger');
          $request->session()->flash('message.content', 'Stock Can not be in minus');
          return redirect()->back();
      }

  }
  



  public function AdminModalShow(Request $request)
  {
      $result = array();
    //   $result['commonContent'] = $this->index->commonContent();
      //$final_theme = $this->theme->theme();
      //min_price
      if (!empty($request->min_price)) {
          $min_price = $request->min_price;
      } else {
          $min_price = '';
      }

      //max_price
      if (!empty($request->max_price)) {
          $max_price = $request->max_price;
      } else {
          $max_price = '';
      }

      if (!empty($request->limit)) {
          $limit = $request->limit;
      } else {
          $limit = 15;
      }

      $products = $this->products->getProductsById($request->products_id);

      $products = $this->products->getProductsBySlug($products[0]->products_slug);
      //category
      $category = $this->products->getCategoryByParent($products[0]->products_id);

      if (!empty($category) and count($category) > 0) {
          $category_slug = $category[0]->categories_slug;
          $category_name = $category[0]->categories_name;
      } else {
          $category_slug = '';
          $category_name = '';
      }
      $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

      if (!empty($sub_category) and count($sub_category) > 0) {
          $sub_category_name = $sub_category[0]->categories_name;
          $sub_category_slug = $sub_category[0]->categories_slug;
      } else {
          $sub_category_name = '';
          $sub_category_slug = '';
      }

      $result['category_name'] = $category_name;
      $result['category_slug'] = $category_slug;
      $result['sub_category_name'] = $sub_category_name;
      $result['sub_category_slug'] = $sub_category_slug;

     

      $data = array('page_number' => '0', 'type' => '', 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
      $detail = $this->products->products($data);
      $result['detail'] = $detail;
      $postCategoryId = '';
      if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
          $i = 0;
          foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
              if ($i == 0) {
                  $postCategoryId = $postCategory->categories_id;
                  $i++;
              }
          }
      }

      $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
      $simliar_products = $this->products->products($data);
      $result['simliar_products'] = $simliar_products;

    //   $cart = '';
    //   $result['cartArray'] = $this->products->cartIdArray($cart);

      //liked products
    //   $result['liked_products'] = $this->products->likedProducts();
      return view("admin.products.modal")->with('result', $result);
  }

  public function AdminComboDelete(Request $request)
    {
        $this->products->AdminComboDelete($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

}
