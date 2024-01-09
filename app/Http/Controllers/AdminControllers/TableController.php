<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\News;
use App\Models\Core\NewsCategory;
use App\Models\Core\Table;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Lang;

class TableController extends Controller
{
	public function __construct(Table $table,Images $images, Setting $setting)
    {
		$this->Table = $table;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;
    }

    public function viewtable(Request $request)
    {
    	$title = array('pageTitle' => 'Table');
    	$table = $this->Table->paginator($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.table.view", $title)->with('result', $result)->with('table', $table);
    }

    public function filter(Request $request)
    {
      $title = array('pageTitle' => 'Table');
      $table = $this->Table->filter($request);
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.table.view", $title)->with(['table'=> $table, 'name'=> $request->FilterBy, 'param'=> $request->parameter , 'param2'=> $request->parameter2])->with('result', $result);
    }
    public function addtable(Request $request)
    {
       $title = array('pageTitle' => 'Add Table');
       $outlet = $this->Table->view_outlet();
       $result['commonContent'] = $this->Setting->commonContent();
       return view("admin.table.add", $title)->with('result', $result)->with('outlet', $outlet);
    }
    public function addNew(Request $request)
    {
       $checkExist = $this->Table->checkExistTable($request);
       if($checkExist){
          $message = 'Table name already exists';
          return redirect()->back()->withErrors([$message]);
       }else{
           $insert = $this->Table->table_insert($request);
           $message = 'Table inserted successfully';
           return redirect()->back()->withErrors([$message]);
       }
    }
    public function edittable($id)
    {
       $title = array('pageTitle' => 'Edit Table');
       $outlet = $this->Table->view_outlet();
       $table = $this->Table->geteditTable($id);
       $result['commonContent'] = $this->Setting->commonContent();
       return view("admin.table.edit", $title)->with('result', $result)->with('outlet', $outlet)->with('table', $table);
    }

    public function update(Request $request)
    {
       $checkExist = $this->Table->editExist($request);
       if(empty($checkExist)) {
          $insert = $this->Table->table_update($request);
          $message = 'Table updated successfully';
           return redirect()->back()->withErrors([$message]);
       }else{
         $message = 'Table name already exists';
          return redirect()->back()->withErrors([$message]);
       }
    }

   public function deletetable(Request $request)
   {
      $delete = $this->Table->table_delete($request);
      return redirect()->back()->withErrors(['Table has been deleted successfully!']);
   }
   public function vieworder(Request $request)
   {
      $title = array('pageTitle' => 'Table');
      $order = $this->Table->get_order($request);
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.table.vieworder", $title)->with('result', $result)->with('order', $order);
   }

   public function orderedit($id)
   {
      $title = array('pageTitle' => 'View Order');
      $result['commonContent'] = $this->Setting->commonContent();
      $data  = $this->Table->get_details_order($id);
      return view("admin.table.editorder", $title)->with('result', $result)->with('data', $data);
   }
}
?>