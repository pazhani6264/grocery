<?php
  namespace App\Http\Controllers\AdminControllers;

  use Zxing\QrReader;

  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Lang;

  use App\Models\Core\Setting;
  use App\Models\Core\Inventory;
  use App\Models\Core\Products;

  class InventoryController extends Controller
{
	public function __construct(Setting $setting, Inventory $inventory, Products $products) {
        $this->Setting = $setting;
        $this->inventory = $inventory;
        $this->products = $products;
    }

	public function stockMovement(Request $request)
  {
    	$title = array('pageTitle' => 'Stock Movement');
    	$result = array();
    	$data = $this->inventory->stock_movement();
      $result['stock'] = $data;
    	//print_r($data);die();
    	$result['commonContent'] = $this->Setting->commonContent();
        return view("admin.inventory.stock_movement", $title)->with('result', $result);
  }
  public function scan()
    {
        $qrCode = new QrReader(request()->input('image'));
        $text = $qrCode->text();
        return view('admin.inventory.barcode', ['text' => $text]);
    }
  public function stockmovementdetails($id)
  {
      $result=$this->inventory->get_out_data($id);
      return view("admin.inventory.stock_movement_popup")->with('result', $result);
  }
  public function scanView($id)
  {
     $result = $this->inventory->stock_movement_scan($id);
     return view("admin.inventory.scan_ajax_call")->with('result', $result);
     //print_r($data);die();
  }
  public function stockinView(Request $request)
  {
    $title = array('pageTitle' => 'Stock IN');
    $result = array();
    $result['commonContent'] = $this->Setting->commonContent();
    $data = $this->inventory->stock_in_out_get('in',$request);
    $result['stock'] = $data;
      //print_r($data);die();
    return view("admin.inventory.stock_in_view", $title)->with('result', $result);
  }
  public function stockinAdd(Request $request)
  {
    $title = array('pageTitle' => 'Stock IN');
    $result = array();
    $result = $this->products->addinventoryfromsidebar();
    $result['vendor'] = $this->inventory->get_vendor();
    $result['commonContent'] = $this->Setting->commonContent();
    //print_r($result['products']);die();
    return view("admin.inventory.add_stockin", $title)->with('result', $result);
  }
   public function ajax_attr_inven($id)
  {
      $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
      $result = $this->products->ajax_attr($id);
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.inventory.attribute_div")->with('result', $result);
  }
  public function get_product($id)
  {
      $result = $this->inventory->get_product_data($id);
      $mediaResponse = json_encode($result);
      return $mediaResponse;
  }
  public function stockinInsert(Request $request)
  {
     //dd($request);
    $this->inventory->stockininsert($request);
    $request->session()->flash('message.level', 'success');
    $request->session()->flash('message.content', Lang::get("labels.inventoryaddedsuccessfully"));
    return redirect()->back();
  }
  public function stockinoutdetails($id,$type)
  {
     $result=$this->inventory->get_details_in_out_data($id,$type);
     return view("admin.inventory.stock_in_out_popup")->with('result', $result);
  }
  public function stockoutView(Request $request)
  {
    $title = array('pageTitle' => 'Stock Out');
    $result = array();
    $result['commonContent'] = $this->Setting->commonContent();
    $data = $this->inventory->stock_in_out_get('out',$request);
    $result['stock'] = $data;
      //print_r($data);die();
    return view("admin.inventory.stock_out_view", $title)->with('result', $result);
  }
  public function stockoutAdd(Request $request)
  {
      $title = array('pageTitle' => 'Stock Out');
      $result = array();
      $result = $this->products->addinventoryfromsidebar();
      $result['vendor'] = $this->inventory->get_vendor();
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.inventory.add_stockout", $title)->with('result', $result);
  }
  public function getcurrentstockarr($products_id,$attributeid)
  {
      $result = $this->inventory->currentstock($products_id,$attributeid);
      print_r(json_encode($result));
  }
  public function adjustStock(Request $request)
  {
      $title = array('pageTitle' => 'Adjust Stock');
      $result = array();
      $result['commonContent'] = $this->Setting->commonContent();
      $data = $this->inventory->stock_in_out_get('adjust',$request);
      $result['stock'] = $data;
      //print_r($data);die();
      return view("admin.inventory.adjust_stock_view", $title)->with('result', $result);
  }
  public function addAdjustStock(Request $request)
  {
      $title = array('pageTitle' => 'Add Adjust Stock');
      $result = array();
      $result = $this->products->addinventoryfromsidebar();
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.inventory.add_adjust_stock", $title)->with('result', $result);
  }
  public function adjustStockInsert(Request $request)
  {
     //dd($request);
     $this->inventory->adjustStockInsert($request);
     $request->session()->flash('message.level', 'success');
     $request->session()->flash('message.content', Lang::get("labels.inventoryaddedsuccessfully"));
     return redirect()->back();
  }
  public function viewVendor(Request $request)
  {
    $title = array('pageTitle' => 'Vendor');
    $result = array();
    $result['commonContent'] = $this->Setting->commonContent();
    $data = $this->inventory->get_vendor();
    $result['vendor'] = $data;
    return view("admin.inventory.view_vendor", $title)->with('result', $result);
  }
  public function addVendor(Request $request)
  {
    $title = array('pageTitle' => 'Add Vendor');
    $result = array();
    $result['countries'] = $this->inventory->countries();
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.inventory.add_vendor", $title)->with('result', $result);
  }
  public function vendorInsert(Request $request)
  {
     $result=$this->inventory->vendorInsert($request);
     if($result=='email'){
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'This email id already exists');
        return redirect()->back();
     }elseif($result=='phone'){
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'This phone number already exists');
        return redirect()->back();
     }else{
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Vendor added successfully');
        return redirect()->back();
     }
  }

  public function vendorEdit($id)
  {
     $title = array('pageTitle' => 'Edit Vendor');
     $result = array();
     $result['vendor'] = $this->inventory->vendorEdit($id);
     $result['countries'] = $this->inventory->countries();
     $result['state'] = $this->inventory->state();
     $result['commonContent'] = $this->Setting->commonContent();
     return view("admin.inventory.edit_vendor", $title)->with('result', $result);
  }

  public function vendorupdate(Request $request)
  {
      $result=$this->inventory->vendorupdate($request);
      if($result=='email'){
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'This email id already exists');
        return redirect()->back();
     }elseif($result=='phone'){
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'This phone number already exists');
        return redirect()->back();
     }else{
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Vendor updated successfully');
        return redirect()->back();
     }
  }

  public function deleteVendor(Request $request)
  {
     $result=$this->inventory->vendordelete($request);
     $request->session()->flash('message.level', 'success');
     $request->session()->flash('message.content', 'Vendor deleted successfully');
     return redirect()->back();
  }

}
?>