<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Models\Core\Order;

class OrdersController extends Controller
{
    //
    public function __construct( Setting $setting, Order $order )
    {
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
        $this->Order = $order;
    }

    //add listingOrders
    public function display()
    {
        $title = array('pageTitle' => Lang::get("labels.ListingOrders"));        

        $message = array();
        $errorMessage = array();     

       

        
        $ordersData['orders'] = $this->Order->paginator();

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $ordersData['dateFrom'] = date('d-m-Y ', strtotime($startdate));
            $ordersData['dateTo'] = date('d-m-Y ', strtotime($enddate));
        }
        else{
            $ordersData['dateFrom'] = date('d-m-Y ');
            $ordersData['dateTo'] = date('d-m-Y ');
        }

        
        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['currency'] = $this->myVarsetting->getSetting(); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.Orders.index", $title)->with('listingOrders', $ordersData)->with('result', $result);
    }

    public function filter(Request $request){
        $title = array('pageTitle' => Lang::get("labels.ListingOrders"));      
        $message = array();
        $errorMessage = array();        
        
        $ordersData['orders'] = $this->Order->filter($request);
        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['currency'] = $this->myVarsetting->getSetting(); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.Orders.index", $title)->with('result', $result)->with(['listingOrders'=> $ordersData, 'name'=> $request->FilterBy, 'param'=> $request->parameter , 'param2'=> $request->parameter2 , 'dateRange'=> $request->dateRange]);
      }

    //view order detail
    public function vieworder(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ViewOrder"));
        $message = array();
        $errorMessage = array();

        //orders data
        $ordersData = $this->Order->detail($request);        

        // current order status
        $orders_status_history = $this->Order->currentOrderStatus($request);  

        //all statuses 
        $orders_status = $this->Order->orderStatuses();  
        
        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;

        //get function from other controller
        $ordersData['currency'] = $this->myVarsetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();

        //dd($ordersData);

        return view("admin.Orders.vieworder", $title)->with('data', $ordersData)->with('result', $result);
    }

    //update order
    public function updateOrder(Request $request)
    {

        $orders_status = $request->orders_status;
        $old_orders_status = $request->old_orders_status;

        $comments = $request->comments;
        $orders_id = $request->orders_id;

        //get function from other controller
        $setting = $this->myVarsetting->getSetting();       

        if ($old_orders_status == $orders_status) {
            return redirect()->back()->with('error', Lang::get("labels.StatusChangeError"));
        } else {
            //update order
            $orders_status = $this->Order->updateRecord($request);  
            return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
        }

    }

    //deleteorders
    public function deleteOrder(Request $request)
    {       
        //reverse stock
        $this->Order->reverseStock($request);     
        $this->Order->deleteRecord($request);
        
        return redirect()->back()->withErrors([Lang::get("labels.OrderDeletedMessage")]);
    }

    //view order detail
    public function invoiceprint(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ViewOrder"));
        $language_id = '1';
        $orders_id = $request->id;

        $message = array();
        $errorMessage = array();

        DB::table('orders')->where('orders_id', '=', $orders_id)
            ->where('customers_id', '!=', '')->update(['is_seen' => 1]);

        $order = DB::table('orders')
            ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

        foreach ($order as $data) {
            $orders_id = $data->orders_id;

            $orders_products = DB::table('orders_products')
                ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                ->select('orders_products.*', 'products.products_image as image')
                ->where('orders_products.orders_id', '=', $orders_id)->get();
            $i = 0;
            $total_price = 0;
            $total_tax = 0;
            $product = array();
            $subtotal = 0;
            foreach ($orders_products as $orders_products_data) {

                //categories
                $categories = DB::table('products_to_categories')
                    ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                    ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                    ->where('products_id', '=', $orders_products_data->orders_products_id)
                    ->where('categories_description.language_id', '=', $language_id)->get();

                $orders_products_data->categories = $categories;

                $product_attribute = DB::table('orders_products_attributes')
                    ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                    ])
                    ->get();

                $orders_products_data->attribute = $product_attribute;
                $product[$i] = $orders_products_data;
                $total_price = $total_price + $orders_products[$i]->final_price;

                $subtotal += $orders_products[$i]->final_price;

                $i++;
            }
            $data->data = $product;
            $orders_data[] = $data;
        }

        $orders_status_history = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)
            ->orderBy('orders_status_history.date_added', 'desc')
            ->where('orders_id', '=', $orders_id)->get();

        $orders_status = DB::table('orders_status')->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)->where('orders_status.role_id', '<=', 2)->get();

        $ordersData['message'] = $message;
        $ordersData['errorMessage'] = $errorMessage;
        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['orders_status'] = $orders_status;
        $ordersData['orders_status_history'] = $orders_status_history;
        $ordersData['subtotal'] = $subtotal;

        //get function from other controller

        $ordersData['currency'] = $this->myVarsetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.Orders.invoiceprint", $title)->with('data', $ordersData)->with('result', $result);

    }

    public function assignOrders(Request $request)
    {
        $orders = $this->Order->assignOrders($request);


        $deliveryboy_id = $request->deliveryboy_id;
        $orders_id = $request->orders_id;
        $devices_data = DB::table('devices')
        ->where('user_id', $deliveryboy_id)->first();
    

       
        if($devices_data != '')
        {
            $device_id = $devices_data->device_id;
            $message = 'New order assigned';
            $title = 'order assigned';
            $pageResponse = 1;
            $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/images/logo.png';
    
            $sendData = array
                (
                'body' => $message,
                'title' => $title,
                'title' => $title,
                'icon' => 'myicon', /*Default Icon*/
                'sound' => 'mySound', /*Default sound*/
                'key' => 'order_id', 
                'value' => $orders_id, 
                'key1' => 'deliveryboy_id', 
                'value1' => $deliveryboy_id, 
                'key2' => 'language_id', 
                'value2' => '1', 
                'image' => $websiteURL,
            );
            $response[] = $this->onesignalNotification($device_id, $sendData, $pageResponse);
        }
        else {
            $response[] = '2';
        }

        return redirect()->back()->with('message', Lang::get("labels.Orders successfully assigned to the delivery boy"));
    }

     public function onesignalNotification($device_id, $sendData){
		
        //get function from other controller     
        
       
     
        $setting = $this->myVarsetting->getSetting();
        
        $settings = $setting->unique('id')->keyBy('id');
        
		$content = array(
		   "en" => $sendData['body']
		   );
		
		$headings = array(
		   "en" => $sendData['title']
		   );
		$big_picture = array(
		   "id1" => $sendData['image']
		   );
		
		$fields = array(
		    'app_id' => $settings[194]->value,
		   'include_player_ids' => array($device_id),		   
		   'contents' => $content,
		   'headings'=>$headings,
		   'chrome_web_image'=>$sendData['image'],
		   'big_picture'=>$sendData['image'],
		   'ios_attachments'=>$sendData['image'],
		   'firefox_icon'=>$sendData['image'],
           'data' => array($sendData['key'] => $sendData['value'],$sendData['key1'] => $sendData['value1'],$sendData['key2'] => $sendData['value2'])
          
		);


       
	
		$fields = json_encode($fields);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic OGIyY2ZmMDYtOTU5Yy00OTM5LWE4N2MtMzIyNzA1NDA0M2E5'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		$result = curl_exec($ch);
       
		$data = json_decode($result);
		curl_close($ch);
       
       
		
    }

    public function updateOrderPayment(Request $request)
    {
       //update order
        $orders_status = $this->Order->updateOrderPayment($request);  
        return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
    } 


    /* public function onesignalNotification($device_id, $sendData){
		
        //get function from other controller     
        
       
     
        $setting = $this->myVarsetting->getSetting();
        
        $settings = $setting->unique('id')->keyBy('id');
        
		$content = array(
		   "en" => $sendData['body']
		   );
		
		$headings = array(
		   "en" => $sendData['title']
		   );
		$big_picture = array(
		   "id1" => $sendData['image']
		   );
		
		$fields = array(
            'app_id' => $settings[197]->value,
		   'include_player_ids' => array($device_id),		   
		   'contents' => $content,
		   'headings'=>$headings,
		   'chrome_web_image'=>$sendData['image'],
		   'big_picture'=>$sendData['image'],
		   'ios_attachments'=>$sendData['image'],
		   'firefox_icon'=>$sendData['image'],
           'data' => array($sendData['key'] => $sendData['value'],$sendData['key1'] => $sendData['value1'],$sendData['key2'] => $sendData['value2'])
          
		);


       
	
		$fields = json_encode($fields);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
				   'Authorization: Basic NDkzZGNjNjktYTQwMi00YjEzLWFkNTctNzBiNTExNjcxMzNm'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
		$result = curl_exec($ch);
       
		//$data = json_decode($result);
		curl_close($ch);

        
       
    } */


}
