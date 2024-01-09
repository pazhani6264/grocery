<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminControllers\AlertController;
class Order extends Model
{
    public function paginator(){

        $language_id = '1';
        $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');

        
       
        $orders = $ordersnew->where('customers_id', '!=', '')->paginate(40);

        $index = 0;
        $total_price = array();

        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')->sum('final_price');

            $orders[$index]->total_price = $orders_products;

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '<=', 2)
                ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

            $deliveryboy_orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '=', 3)
                ->orderby('orders_status_history.date_added', 'DESC')->first();

            if ($deliveryboy_orders_status_history !='') {
                $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
            } else {
                $orders[$index]->deliveryboy_orders_status_id = '';
                $orders[$index]->deliveryboy_orders_status = '';
            }
            $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            $index++;

        }
        return $orders;
    }


    public function filter($data){
       
        $name = $data['FilterBy'];
        $parameter = $data['parameter'];
        $dateRange = $data['dateRange'];
  
        switch ( $name ) {
            case 'Name':
                $language_id = '1';
                $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');
                if (isset($dateRange)) {
                    $range = explode('-', $dateRange);
        
                    $startdate = trim($range[0]);
                    $enddate = trim($range[1]);
        
                    $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                    $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                    $ordersnew->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        
                }
                $orders = $ordersnew->where('customers_id', '!=', '')
                    ->where('customers_name', 'LIKE', '%' .  $parameter . '%')->paginate(40);
                    
        
                $index = 0;
                $total_price = array();
        
                foreach ($orders as $orders_data) {
                    $orders_products = DB::table('orders_products')->sum('final_price');
        
                    $orders[$index]->total_price = $orders_products;
        
                    $orders_status_history = DB::table('orders_status_history')
                        ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                        ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                        ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                        ->where('orders_status_description.language_id', '=', $language_id)
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->where('orders_status.role_id', '<=', 2)
                        ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();
        
                    $deliveryboy_orders_status_history = DB::table('orders_status_history')
                        ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                        ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                        ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                        ->where('orders_status_description.language_id', '=', $language_id)
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->where('orders_status.role_id', '=', 3)
                        ->orderby('orders_status_history.date_added', 'DESC')->first();
        
                    if ($deliveryboy_orders_status_history) {
                        $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                        $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
                    } else {
                        $orders[$index]->deliveryboy_orders_status_id = '';
                        $orders[$index]->deliveryboy_orders_status = '';
                    }
                    $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                    $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                    $index++;
        
                }
  
            break;
            case 'ID':
  
                $language_id = '1';
                $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');
                if (isset($dateRange)) {
                    $range = explode('-', $dateRange);
        
                    $startdate = trim($range[0]);
                    $enddate = trim($range[1]);
        
                    $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                    $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                    $ordersnew->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        
                }
                $orders = $ordersnew->where('customers_id', '!=', '')
                    ->where('orders_id', 'LIKE', '%' .  $parameter . '%')->paginate(40);
        
                $index = 0;
                $total_price = array();
        
                foreach ($orders as $orders_data) {
                    $orders_products = DB::table('orders_products')->sum('final_price');
        
                    $orders[$index]->total_price = $orders_products;
        
                    $orders_status_history = DB::table('orders_status_history')
                        ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                        ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                        ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                        ->where('orders_status_description.language_id', '=', $language_id)
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->where('orders_status.role_id', '<=', 2)
                        ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();
        
                    $deliveryboy_orders_status_history = DB::table('orders_status_history')
                        ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                        ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                        ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                        ->where('orders_status_description.language_id', '=', $language_id)
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->where('orders_status.role_id', '=', 3)
                        ->orderby('orders_status_history.date_added', 'DESC')->first();
        
                    if ($deliveryboy_orders_status_history) {
                        $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                        $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
                    } else {
                        $orders[$index]->deliveryboy_orders_status_id = '';
                        $orders[$index]->deliveryboy_orders_status = '';
                    }
                    $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                    $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                    $index++;
        
                }

                break;
                case 'Status':
      
                    $language_id = '1';
                    $parameter2 = $data['parameter2'];
                    if($parameter2 == 'All')
                    {
                        $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');
                        if (isset($dateRange)) {
                            $range = explode('-', $dateRange);
                
                            $startdate = trim($range[0]);
                            $enddate = trim($range[1]);
                
                            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                            $ordersnew->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                
                        }
                        $orders = $ordersnew->where('customers_id', '!=', '')
                        ->paginate(40);
                    }
                    else
                    {
                        $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');
                        if (isset($dateRange)) {
                            $range = explode('-', $dateRange);
                
                            $startdate = trim($range[0]);
                            $enddate = trim($range[1]);
                
                            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                            $ordersnew->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                
                        }
                        $orders = $ordersnew->where('customers_id', '!=', '')
                        ->where('orders.order_status_id', $parameter2)->paginate(40);
                    }
            
                    $index = 0;
                    $total_price = array();
            
                    foreach ($orders as $orders_data) {
                        $orders_products = DB::table('orders_products')->sum('final_price');
            
                        $orders[$index]->total_price = $orders_products;
            
                        $orders_status_history = DB::table('orders_status_history')
                            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                            ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                            ->where('orders_status_description.language_id', '=', $language_id)
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->where('orders_status.role_id', '<=', 2)
                            ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();
            
                        $deliveryboy_orders_status_history = DB::table('orders_status_history')
                            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                            ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                            ->where('orders_status_description.language_id', '=', $language_id)
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->where('orders_status.role_id', '=', 3)
                            ->orderby('orders_status_history.date_added', 'DESC')->first();
            
                        if ($deliveryboy_orders_status_history) {
                            $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                            $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
                        } else {
                            $orders[$index]->deliveryboy_orders_status_id = '';
                            $orders[$index]->deliveryboy_orders_status = '';
                        }
                        $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                        $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                        $index++;
            
                    }
                break;
            default:
            $language_id = '1';
            $ordersnew = DB::table('orders')->orderBy('orders_id', 'DESC');
            if (isset($dateRange)) {
                $range = explode('-', $dateRange);
    
                $startdate = trim($range[0]);
                $enddate = trim($range[1]);
    
                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $ordersnew->whereBetween('date_purchased', [$dateFrom, $dateTo]);
    
            }
            $orders = $ordersnew->where('customers_id', '!=', '')
                ->paginate(40);
    
            $index = 0;
            $total_price = array();
    
            foreach ($orders as $orders_data) {
                $orders_products = DB::table('orders_products')->sum('final_price');
    
                $orders[$index]->total_price = $orders_products;
    
                $orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                    ->where('orders_status_description.language_id', '=', $language_id)
                    ->where('orders_id', '=', $orders_data->orders_id)
                    ->where('orders_status.role_id', '<=', 2)
                    ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();
    
                $deliveryboy_orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                    ->where('orders_status_description.language_id', '=', $language_id)
                    ->where('orders_id', '=', $orders_data->orders_id)
                    ->where('orders_status.role_id', '=', 3)
                    ->orderby('orders_status_history.date_added', 'DESC')->first();
    
                if ($deliveryboy_orders_status_history) {
                    $orders[$index]->deliveryboy_orders_status_id = $deliveryboy_orders_status_history->orders_status_id;
                    $orders[$index]->deliveryboy_orders_status = $deliveryboy_orders_status_history->orders_status_name;
                } else {
                    $orders[$index]->deliveryboy_orders_status_id = '';
                    $orders[$index]->deliveryboy_orders_status = '';
                }
                $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                $index++;
    
            }
              }
          return $orders;
      }
  

    public function detail($request){

        $language_id = '1';
        $orders_id = $request->id; 
        $ordersData = array();       
        $subtotal  = 0;
       /*  DB::table('orders')->where('orders_id', '=', $orders_id)
            ->where('customers_id', '!=', '')->update(['is_seen' => 1]); */

        $order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.customers_id')
            ->where('orders.orders_id', '=', $orders_id)
            ->select('orders.*', 'users.country_code as cc')
            ->get();
        
        foreach ($order as $data) {
            $orders_id = $data->orders_id;

            $orders_products = DB::table('orders_products')
                ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'products.products_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                ->select('orders_products.*', 'image_categories.path as image','image_categories.path_type as image_path_type','products.products_type')
                ->where('orders_products.orders_id', '=', $orders_id)->get();
            $i = 0;
            $total_price = 0;
            $total_tax = 0;
            $product = array();
            $subtotal = 0;
            foreach ($orders_products as $orders_products_data) {
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

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_id', '=', $orders_id)
                ->where('orders_status.role_id','=',2)->where('orders_status_description.language_id', $language_id)
                ->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->first();

            $data->orders_status_id = $orders_status_history->orders_status_id;
            $data->orders_status_name = $orders_status_history->orders_status_name;
            
            $data->data = $product;
            $orders_data[] = $data;
        }

        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['subtotal'] = $subtotal;

        $current_boy = DB::table('orders_to_delivery_boy')
            ->select('orders_to_delivery_boy.*')
            ->where('orders_to_delivery_boy.orders_id', '=', $orders_id)
            ->where('orders_to_delivery_boy.is_current', '=', '1')
            ->orderby('orders_to_delivery_boy.created_at', 'DESC')
            ->first();

        $ordersData['current_boy'] = $current_boy;

        $delivery_boys = DB::table('users')
            ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
            ->leftjoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'deliveryboy_info.availability_status')
            ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status', 'orders_status_description.orders_status_name as deliveryboy_status')
            ->where('status', 1)
            ->where('users.role_id', 4)
            ->where('language_id', 1)
            ->get();
        $ordersData['delivery_boys'] = $delivery_boys;
        return $ordersData;
    }

    public function currentOrderStatus($request){
        $language_id = 1;
        $status = DB::table('orders_status_history')
            ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', $language_id)
            ->where('orders_status.role_id', '<=', 2)
            ->orderBy('orders_status_history.date_added', 'ASC')
            ->where('orders_id', '=', $request->id)->get();
            return $status;
    }

    public function orderStatuses(){
        $language_id = 1;
        $status = DB::table('orders_status')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)->where('role_id', '<=', 2)->get();
        return $status;
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) { 
          case 'miles': 
            break; 
          case 'kilometers' : 
            $distance = $distance * 1.609344; 
        } 
        return (round($distance,2)); 
      }


    public function updateRecord($request){
        $date_added = date('Y-m-d H:i:s');
        $orders_status = $request->orders_status;
        $old_orders_status = $request->old_orders_status;
     

        $comments = $request->comments;
        $orders_id = $request->orders_id;

        $status = DB::table('orders_status')->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->where('orders_status_description.language_id', '=', 1)->where('role_id', '<=', 2)->where('orders_status_description.orders_status_id', '=', $orders_status)->get();
        
        $current_boy = DB::table('orders_to_delivery_boy')
            ->leftjoin('deliveryboy_info','deliveryboy_info.users_id','=','orders_to_delivery_boy.deliveryboy_id')
            ->where('orders_to_delivery_boy.orders_id', '=', $orders_id)
            ->where('orders_to_delivery_boy.is_current', '=', '1')
            ->orderby('orders_to_delivery_boy.created_at', 'DESC')
            ->first();

        // $trans_point_check = DB::table('transaction_points')->where('order_id', '=', $orders_id)->first();

        // if($trans_point_check != '')
        // {
        //     DB::table('transaction_points')->where('order_id', $orders_id)->delete();

        //     $uppoint=DB::table('member_type')->where('status', '1')->get();
        //     if(!$uppoint->isEmpty()){
        //         $customer_id= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            
        //         $pointsIn = DB::table('transaction_points')->where('user_id', '=', $customer_id->customers_id)->where('points_status', '=', 'in')->sum('points');

        //         $pointsOut = DB::table('transaction_points')->where('user_id', '=', $customer_id->customers_id)->where('points_status', '=', 'out')->sum('points');

        //         $totalPoints = $pointsIn - $pointsOut;

        //         DB::table('users')->where('id', $customer_id->customers_id)->update([
        //             'loyalty_points' => $totalPoints,
        //         ]);
        //         foreach ($uppoint as  $jespoint) {
                
        //         if($jespoint->points <= $totalPoints){
        //             DB::table('users')->where('id', $customer_id->customers_id)->update([
        //                 'users_level' => $jespoint->id,
        //             ]);
        //         }
        //         }
        //     }
        // }

        //orders status history
        $orders_history_id = DB::table('orders_status_history')->insertGetId(
            ['orders_id' => $orders_id,
                'orders_status_id' => $orders_status,
                'date_added' => $date_added,
                'customer_notified' => '1',
                'comments' => $comments,
            ]);
        
        //orders update
        $orders_update = DB::table('orders')->where('orders_id',$orders_id)->update(['order_status_id' => $orders_status]);

        if($orders_status == '2') {

             if(!empty($current_boy->deliveryboy_id) and $old_orders_status != '2') {

                

                $order_data = DB::table('orders')->where('orders_id', '=', $orders_id)->first();

                if($order_data->shipping_method == 'shippingByKM') {
                $kilometer = round($order_data->order_km);
                $commissionbykm = DB::table('products_shipping_rates_km')->where('km_from', '<=', $kilometer)->where('km_to', '>=', $kilometer)->where('km_status', 1)->get();

                if(count($commissionbykm) > 0) {
                    $commission = $commissionbykm[0]->km_commission;
                }
                else
                {
                    $commission = 0;
                }

                    DB::table('users_balance')->insertGetId(
                        ['orders_id' => $orders_id,
                            'users_id' => $current_boy->deliveryboy_id,
                            'products_id' => 0,
                            'created_at' => $date_added,
                            'updated_at' => $date_added,
                            'transaction_type' => 'in',
                            'amount' => $commission,
                            'status' => 'Completed',
                            'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                        ]
                        );
    
                        DB::table('payment_withdraw')->insertGetId(
                            [   'orders_id' => $orders_id,
                                'user_id' => $current_boy->deliveryboy_id,
                                'amount' => $commission,
                                'created_at' => $date_added,
                                'status'=>0,
                                'method'=>'Bank',
                            ]
                        );
                }
                elseif($order_data->shipping_method == 'shippingByWeight') {
                    $weight = $order_data->order_weight;

                    $commissionbyweight = DB::table('products_shipping_rates')->where('weight_from', '<=', $weight)->where('weight_to', '>=', $weight)->where('products_shipping_status', 1)->get();

                    if (count($commissionbyweight) > 0) {
                        $commission = $commissionbyweight[0]->weight_commission;
                    }
                    else
                    {
                        $commission = 0;
                    }
    
                        DB::table('users_balance')->insertGetId(
                            ['orders_id' => $orders_id,
                                'users_id' => $current_boy->deliveryboy_id,
                                'products_id' => 0,
                                'created_at' => $date_added,
                                'updated_at' => $date_added,
                                'transaction_type' => 'in',
                                'amount' => $commission,
                                'status' => 'Completed',
                                'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                            ]
                            );
        
                            DB::table('payment_withdraw')->insertGetId(
                                [   'orders_id' => $orders_id,
                                    'user_id' => $current_boy->deliveryboy_id,
                                    'amount' => $commission,
                                    'created_at' => $date_added,
                                    'status'=>0,
                                    'method'=>'Bank',
                                ]
                            );
                    }
                else
                {

                    DB::table('users_balance')->insertGetId(
                    ['orders_id' => $orders_id,
                        'users_id' => $current_boy->deliveryboy_id,
                        'products_id' => 0,
                        'created_at' => $date_added,
                        'updated_at' => $date_added,
                        'transaction_type' => 'in',
                        'amount' => $current_boy->commission,
                        'status' => 'Completed',
                        'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                    ]
                    );

                    DB::table('payment_withdraw')->insertGetId(
                        [   'orders_id' => $orders_id,
                            'user_id' => $current_boy->deliveryboy_id,
                            'amount' => $current_boy->commission,
                            'created_at' => $date_added,
                            'status'=>0,
                            'method'=>'Bank',
                        ]
                    );
                }
            }

            // PAz Add START

                // $payck= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
                // if($payck->payment_method == 'Cash on Delivery'){
                //     DB::table('orders')->where('orders_id', $orders_id)->update([
                //         'payment_status' => 1,
                //     ]);
                // }

                // if($payck->payment_method == 'banktransfer'){
                //     DB::table('orders')->where('orders_id', $orders_id)->update([
                //         'payment_status' => 1,
                //     ]);
                // }

            // PAz Add END

            $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_id)->get();

            foreach ($orders_products as $products_data) {
                DB::table('products')->where('products_id', $products_data->products_id)->update([
                    'products_quantity' => DB::raw('products_quantity - "' . $products_data->products_quantity . '"'),
                    'products_ordered' => DB::raw('products_ordered + 1'),
                ]);
            }
            //add point to user
            $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            //$exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->where('user_id', '=', $order_user->customers_id)->get();
            //$settings = DB::table('settings')->where('id', '=','148')->first();
            //$member_type = DB::table('settings')->where('id', '=','149')->first();
            //$wallet = DB::table('settings')->where('id', '=','202')->first();

            

            //$point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();

            //$cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
                //$oldbalnce=$cdata->loyalty_points;
                //$amount = $order_user->order_price;

            // if($wallet->value == '1' && $order_user->payment_method == 'wallet')
            // { 
            //     if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1')
            //     {
                    
            //         $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
            //         if($level != '')
            //         {

                    

            //             $level_amount = $level->rate_others;
            //             $level_wallet_amount = $level->rate_wallet;
            //             $level_peramount = $level->number_amount;
            //             $count_level_amount = round($amount/$level_peramount);
            //             $member_point = $count_level_amount*$level_amount;
            //             $wallet_point = $count_level_amount*$level_wallet_amount;

            //             if($point)
            //             {
            //                 $no_rm = $point->no_rm;
            //                 $no_point = $point->points;
            //                 $count_rm = round($amount/$no_rm);
            //                 $give_point = $count_rm*$no_point;
            //                 $total_point = $give_point+$member_point+$wallet_point;
            //                 $newbalnce=$oldbalnce+$total_point;

            //             }
            //             else
            //             {
            //                 $total_point = $member_point+$wallet_point;
            //                 $newbalnce=$oldbalnce+$total_point;
            //             }

            //             //print_r($total_point);die();

            //             // get user level

            //             //Update user type
            //             $uppoint=DB::table('member_type')->where('status', '1')->get();
            //             if(!$uppoint->isEmpty()){
            //                 foreach ($uppoint as  $jespoint) {
                            
            //                 if($jespoint->points <= $newbalnce){
            //                     DB::table('users')->where('id', $order_user->customers_id)->update([
            //                         'users_level' => $jespoint->id,
            //                     ]);
            //                 }
            //                 }
            //             }
            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }

            //     }
            //     elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1')
            //     {
                
            //         $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
            //         if($level != '')
            //         {
            //             $level_amount = $level->rate_others;
            //             $level_wallet_amount = $level->rate_wallet;
            //             $level_peramount = $level->number_amount;
            //             $count_level_amount = round($amount/$level_peramount);
            //             $member_point = $count_level_amount*$level_amount;
            //             $wallet_point = $count_level_amount*$level_wallet_amount;
            //             $total_point = $member_point+$wallet_point;
            //             $newbalnce=$oldbalnce+$total_point;

            //             $uppoint=DB::table('member_type')->where('status', '1')->get();
            //             if(!$uppoint->isEmpty()){
            //                 foreach ($uppoint as  $jespoint) {
                            
            //                 if($jespoint->points <= $newbalnce){
            //                     DB::table('users')->where('id', $order_user->customers_id)->update([
            //                         'users_level' => $jespoint->id,
            //                     ]);
            //                 }
            //                 }
            //             }
            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }
            //     }
            //     elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1')
            //     {
                    
            //         if($point)
            //         {
            //             $no_rm = $point->no_rm;
            //             $no_point = $point->points;
            //             $count_rm = round($amount/$no_rm);
            //             $give_point = $count_rm*$no_point;
            //             $total_point = $give_point;
            //             $newbalnce=$oldbalnce+$total_point;

            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }
            //     }
            // }
            // else
            // {
            //     if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1')
            //     {
                    
            //         $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
            //         if($level != '')
            //         {

                    

            //             $level_amount = $level->rate_others;
            //             $level_peramount = $level->number_amount;
            //             $count_level_amount = round($amount/$level_peramount);
            //             $member_point = $count_level_amount*$level_amount;

            //             if($point)
            //             {
            //                 $no_rm = $point->no_rm;
            //                 $no_point = $point->points;
            //                 $count_rm = round($amount/$no_rm);
            //                 $give_point = $count_rm*$no_point;
            //                 $total_point = $give_point+$member_point;
            //                 $newbalnce=$oldbalnce+$total_point;

            //             }
            //             else
            //             {
            //                 $total_point = $member_point;
            //                 $newbalnce=$oldbalnce+$total_point;
            //             }

            //             //print_r($total_point);die();

            //             // get user level

            //             //Update user type
            //             $uppoint=DB::table('member_type')->where('status', '1')->get();
            //             if(!$uppoint->isEmpty()){
            //                 foreach ($uppoint as  $jespoint) {
                            
            //                 if($jespoint->points <= $newbalnce){
            //                     DB::table('users')->where('id', $order_user->customers_id)->update([
            //                         'users_level' => $jespoint->id,
            //                     ]);
            //                 }
            //                 }
            //             }
            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }

            //     }
            //     elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1')
            //     {
                
            //         $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
            //         if($level != '')
            //         {
            //             $level_amount = $level->rate_others;
            //             $level_peramount = $level->number_amount;
            //             $count_level_amount = round($amount/$level_peramount);
            //             $member_point = $count_level_amount*$level_amount;
            //             $total_point = $member_point;
            //             $newbalnce=$oldbalnce+$total_point;

            //             $uppoint=DB::table('member_type')->where('status', '1')->get();
            //             if(!$uppoint->isEmpty()){
            //                 foreach ($uppoint as  $jespoint) {
                            
            //                 if($jespoint->points <= $newbalnce){
            //                     DB::table('users')->where('id', $order_user->customers_id)->update([
            //                         'users_level' => $jespoint->id,
            //                     ]);
            //                 }
            //                 }
            //             }
            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }
            //     }
            //     elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1')
            //     {
                    
            //         if($point)
            //         {
            //             $no_rm = $point->no_rm;
            //             $no_point = $point->points;
            //             $count_rm = round($amount/$no_rm);
            //             $give_point = $count_rm*$no_point;
            //             $total_point = $give_point;
            //             $newbalnce=$oldbalnce+$total_point;

            //         }
            //         else
            //         {
            //             $total_point = 0;
            //             $newbalnce=$oldbalnce+$total_point;
            //         }
            //     }

            // }
            //insert point details
            // DB::table('transaction_points')->insert([
            //     'user_id' => $order_user->customers_id,
            //     'order_id'=> $orders_id,
            //     'points' => $total_point,
            //     'balance_points' => $newbalnce,
            //     'points_status' => 'in',
            //     'description'=>'Make Purchase',
            //     'created_at' => $date_added,
            //     'updated_at' => $date_added
            // ]);


            $user= DB::table('users')->where('id', '=', $order_user->customers_id)->first();

            $order_email = DB::table('settings')->where('id', '=','71')->first();
            $app_name = DB::table('settings')->where('id', '=','19')->first();
            $website_logo = DB::table('settings')->where('id', '=','16')->first();
            $api_key = DB::table('settings')->where('id', '=','123')->first();
            $domain = DB::table('settings')->where('id', '=','124')->first();
            $website_link = DB::table('settings')->where('id', '=','103')->first();

            $imagepath = DB::table('image_categories')->where('path', '=', $website_logo->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
            if($imagepath->path_type == 'aws')
            {
                $imgurl = $website_logo->value;
            }
            else
            {
                $imgurl = $website_link.$website_logo->value;
            }


            $title = 'Congratulation '.$user->first_name. ' !';

            $html = '<div style="padding: 15px;background: #f4f4f3;"><div style="text-align:center;width: 150px;height: 150px;margin: auto;"><img src="'.$imgurl .'"  style="height: 100%;width: 100%;object-fit: contain;" alt="'.$app_name->value.'"></div><div style="background: white;padding: 50px;margin-top: 35px;"></div></div>';


            $balance_point_email = DB::table('alert_settings')->where('balance_point_email', 1)->first();

            if($balance_point_email != '')
            {
                

            $subject = $title;
            $MailData            = array();
            $api_key             = $api_key->value;
            $domain              = $domain->value;
            $MailData['from']    = $app_name->value. "<".$order_email->value.">";
            $MailData['to']      = $user->email;
            //$MailData['to']      = 'sakthi@platinumcode.com.my';
            $MailData['subject'] = $title;
            $MailData['html'] =  $html;
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
            //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
            curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
            $resultss = curl_exec($ch);
            curl_close($ch);  
            //echo $resultss;
            //return $result;
            }


            $resuluser = DB::table('users')->where('role_id', 1)->first();
	$shopmail = DB::connection('mysql2')->table('tb_user')->where('shop_name',$resuluser->user_name)->where('status',1)->first();
	$p24mail = DB::connection('mysql2')->table('shop_mail')->insert([
		'email' => $user->email,
		'comments' => 'Order Completed',
		'user_id' => $user->id,
		'shop_name' => $resuluser->user_name,
		'shop_id' => $shopmail->id,
		'created_at' => date('Y-m-d H:i:s')
	]);
    
         
            // update user table

            // DB::table('users')->where('id', $order_user->customers_id)->update([
            //     'loyalty_points' => $newbalnce,
            // ]);
        }

        if ($orders_status == '3') {


            if (!empty($current_boy->deliveryboy_id) and $old_orders_status != '2') 
            {

                DB::table('users_balance')
                ->where('products_id', 0)
                ->where('users_id', $current_boy->deliveryboy_id)
                ->where('orders_id', $orders_id)
                ->update([
                    'status' => 'Recharge Back',
                    'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                ]);

                //update balance table
                DB::table('users_balance')->insertGetId(
                ['orders_id' => $orders_id,
                    'users_id' => $current_boy->deliveryboy_id,
                    'products_id' => 0,
                    'created_at' => $date_added,
                    'updated_at' => $date_added,
                    'transaction_type' => 'out',
                    'amount' => $current_boy->commission,
                    'status' => 'Cancelled By Admin',
                    'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                ]
                );
            }

            $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_id)->get();

            foreach ($orders_products as $products_data) {

                $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
                $date_added = date('Y-m-d H:i:s');
                $inventory_ref_id = DB::table('inventory')->insertGetId([
                    'products_id' => $products_data->products_id,
                    'stock' => $products_data->products_quantity,
                    'reference_code' => $products_data->orders_id,
                    'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                    'added_date' => time(),
                    'created_at' => $date_added,
                    'stock_type' => 'in',

                ]);
                //dd($product_detail);
               
               
                if ($product_detail->products_type == 1) {
                    $product_attribute = DB::table('orders_products_attributes')
                        ->where([
                            ['orders_products_id', '=', $products_data->orders_products_id],
                            ['orders_id', '=', $products_data->orders_id],
                        ])
                        ->get();
                        
                       
                      

                    foreach ($product_attribute as $attribute) {
                        $prodocuts_attributes = DB::table('products_attributes')
                            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                            ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'options_values_id')
                            ->where('products_options_values_descriptions.options_values_name', $attribute->products_options_values)
                            ->where('products_options_descriptions.options_name', $attribute->products_options)
                            ->where('products_attributes.products_id', $products_data->products_id)
                            ->select('products_attributes.products_attributes_id')
                            ->first();


                        $id = DB::table('inventory_detail')->insert([
                            'inventory_ref_id' => $inventory_ref_id,
                            'products_id' => $products_data->products_id,
                            'attribute_id' => $prodocuts_attributes->products_attributes_id,
                        ]);
                       

                    }

                }
            }

            // update point
            $settings = DB::table('settings')->where('id', '=','148')->first();

            if($settings->value == '1'){
            $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();

            $outpoint = DB::table('transaction_points')->where('user_id', '=', $order_user->customers_id)->where('points_status', '=', 'out')->where('order_id', '=', $orders_id)->get();

            if(!empty($outpoint)){
            foreach ($outpoint as $jesoutpoint) {
               $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
               $oldbalnce=$cdata->loyalty_points;
               $newbalnce=$oldbalnce+$jesoutpoint->points;

                //insert point details
                    DB::table('transaction_points')->insert([
                        'user_id' => $order_user->customers_id,
                        'order_id'=> $orders_id,
                        'points' => $jesoutpoint->points,
                        'balance_points' => $newbalnce,
                        'points_status' => 'in',
                        'description'=>'Cancelled coupon purchase',
                        'created_at' => $date_added,
                        'updated_at' => $date_added
                    ]);

                    // update user table
                    DB::table('users')->where('id', $order_user->customers_id)->update([
                        'loyalty_points' => $newbalnce,
                    ]);
            }
             
            }
        }
        }

        $orders = DB::table('orders')->where('orders_id', '=', $orders_id)
            ->where('customers_id', '!=', '')->get();

        $data = array();
        $data['customers_id'] = $orders[0]->customers_id;
        $data['orders_id'] = $orders_id;
        $data['status'] = $status[0]->orders_status_name;

        //point upadete
        //$inpoint = DB::table('transaction_points')->where('user_id', '=', $orders[0]->customers_id)->where('points_status', '=', 'in')->where('order_id', '=', $orders_id)->first();

        // if($inpoint){
        //     $cdata = DB::table('users')->where('id', $orders[0]->customers_id)->first();
        //     $oldbalnce=$cdata->loyalty_points;
        //     $newbalnce=$oldbalnce-$inpoint->points;

        //     //insert point details
        //             DB::table('transaction_points')->insert([
        //                 'user_id' => $orders[0]->customers_id,
        //                 'order_id'=> $orders_id,
        //                 'points' => $inpoint->points,
        //                 'balance_points' => $newbalnce,
        //                 'points_status' => 'out',
        //                 'description'=>'Cancelled purchase',
        //                 'created_at' => $date_added,
        //                 'updated_at' => $date_added
        //             ]);
        //     // update user table
        //             DB::table('users')->where('id', $orders[0]->customers_id)->update([
        //                 'loyalty_points' => $newbalnce,
        //             ]);
        // }

        

        return 'success';
    }    


    //
    public function fetchorder($request)
    {
        $reportBase = $request->reportBase;
        $language_id = '1';
        $orders = DB::table('orders')
            ->LeftJoin('currencies', 'currencies.code', '=', 'orders.currency')
            ->get();

        $index = 0;
        $total_price = array();
        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')
                ->select('final_price', DB::raw('SUM(final_price) as total_price'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->groupBy('final_price')
                ->get();

            $orders[$index]->total_price = $orders_products[0]->total_price;

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('role_id', '<=', 2)
                ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

            $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;

            $index++;
        }

        $compeleted_orders = 0;
        $pending_orders = 0;
        foreach ($orders as $orders_data) {

            if ($orders_data->orders_status_id == '2') {
                $compeleted_orders++;
            }
            if ($orders_data->orders_status_id == '1') {
                $pending_orders++;
            }
        }

        $result['orders'] = $orders->chunk(10);
        $result['pending_orders'] = $pending_orders;
        $result['compeleted_orders'] = $compeleted_orders;
        $result['total_orders'] = count($orders);

        $result['inprocess'] = count($orders) - $pending_orders - $compeleted_orders;
        //add to cart orders
        $cart = DB::table('customers_basket')->get();

        $result['cart'] = count($cart);

        //Rencently added products
        $recentProducts = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->paginate(8);

        $result['recentProducts'] = $recentProducts;

        //products
        $products = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->get();

        //low products & out of stock
        $lowLimit = 0;
        $outOfStock = 0;
        foreach ($products as $products_data) {
            $currentStocks = DB::table('inventory')->where('products_id', $products_data->products_id)->get();
            if (count($currentStocks) > 0) {
                if ($products_data->products_type == 1) {


                } else {
                    $stockIn = 0;

                    foreach ($currentStocks as $currentStock) {
                        $stockIn += $currentStock->stock;
                    }
                    /*print $stocks;
                    print '<br>';*/
                    $orders_products = DB::table('orders_products')
                        ->select(DB::raw('count(orders_products.products_quantity) as stockout'))
                        ->where('products_id', $products_data->products_id)->get();
                    //print($product->products_id);
                    //print '<br>';
                    $stocks = $stockIn - $orders_products[0]->stockout;

                    $manageLevel = DB::table('manage_min_max')->where('products_id', $products_data->products_id)->get();
                    $min_level = 0;
                    $max_level = 0;
                    if (count($manageLevel) > 0) {
                        $min_level = $manageLevel[0]->min_level;
                        $max_level = $manageLevel[0]->max_level;
                    }

                    /*print 'min level'.$min_level;
                    print '<br>';
                    print 'max level'.$max_level;
                    print '<br>';*/

                    if ($stocks >= $min_level) {
                        $lowLimit++;
                    }
                    $stocks = $stockIn - $orders_products[0]->stockout;
                    if ($stocks == 0) {
                        $outOfStock++;
                    }

                }
            } else {
                $outOfStock++;
            }
        }

        $result['lowLimit'] = $lowLimit;
        $result['outOfStock'] = $outOfStock;
        $result['totalProducts'] = count($products);

        $customers = DB::table('customers')
            ->LeftJoin('customers_info', 'customers_info.customers_info_id', '=', 'customers.customers_id')
            ->leftJoin('images', 'images.id', '=', 'customers.customers_picture')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'customers.customers_picture')
            ->where('image_categories.image_type', '=', 'THUMBNAIL')
            ->select('customers.created_at', 'customers_id', 'customers_firstname', 'customers_lastname', 'customers_dob', 'email', 'user_name', 'customers_default_address_id', 'customers_telephone', 'customers_fax'
                , 'password', 'customers_picture', 'path')
            ->orderBy('customers.created_at', 'DESC')
            ->get();

        $result['recentCustomers'] = $customers->take(6);
        $result['totalCustomers'] = count($customers);
        $result['reportBase'] = $reportBase;

        return $result;
    }

    public function deleteRecord($request){
        DB::table('orders')->where('orders_id', $request->orders_id)->delete();
        DB::table('orders_products')->where('orders_id', $request->orders_id)->delete();
        return 'success';
    }

    public function reverseStock($request){
        $orders_products = DB::table('orders_products')->where('orders_id', '=', $request->orders_id)->get();

        foreach ($orders_products as $products_data) {

            $product_detail = DB::table('products')->where('products_id', $products_data->products_id)->first();
            //dd($product_detail);
            $date_added = date('Y-m-d h:i:s');
            $inventory_ref_id = DB::table('inventory')->insertGetId([
                'products_id' => $products_data->products_id,
                'stock' => $products_data->products_quantity,
                'admin_id' => isset(auth()->user()->id) ? auth()->user()->id  : 0,
                'created_at' => $date_added,
                'stock_type' => 'in',

            ]);
            //dd($product_detail);
            if ($product_detail->products_type == 1) {
                $product_attribute = DB::table('orders_products_attributes')
                    ->where([
                        ['orders_products_id', '=', $products_data->orders_products_id],
                        ['orders_id', '=', $products_data->orders_id],
                    ])
                    ->get();

                foreach ($product_attribute as $attribute) {
                    $prodocuts_attributes = DB::table('products_attributes')
                        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                        ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'options_values_id')
                        ->where('products_options_values_descriptions.options_values_name', $attribute->products_options_values)
                        ->where('products_options_descriptions.options_name', $attribute->products_options)
                        ->select('products_attributes.products_attributes_id')
                        ->first();
                      

                    DB::table('inventory_detail')->insert([
                        'inventory_ref_id' => $inventory_ref_id,
                        'products_id' => $products_data->products_id,
                        'attribute_id' => $prodocuts_attributes->products_attributes_id,
                    ]);

                }

            }
        }
        return 'success';
    }

    public function assignOrders($request)
    {
        $comments = $request->delivery_comments;
        $orders_id = $request->orders_id;
        $old_deliveryboy_id = $request->old_deliveryboy_id;
        $deliveryboy_id = $request->deliveryboy_id;
        $created_at = date('Y-m-d H:i:s');
        //dd($request->all());
        $orders_history_id = DB::table('orders_status_history')->insertGetId(
            ['orders_id' => $orders_id,
                'orders_status_id' => 10,
                'date_added' => $created_at,
                'customer_notified' => '1',
                'comments' => addslashes($comments),
                'role_id' => 1,
            ]
        );

        DB::table('orders_to_delivery_boy')->where(['orders_id' => $orders_id])->update(['is_current' => 0]);

       if ($deliveryboy_id != $old_deliveryboy_id) {
           DB::table('deliveryboy_info')->where('users_id', $old_deliveryboy_id)->update([
                'availability_status' => 8
            ]);

           DB::table('deliveryboy_info')->where('users_id', $deliveryboy_id)->update([
                'availability_status' => 10
            ]);
       }

        $orders_to_deliveryboy_id = DB::table('orders_to_delivery_boy')->insertGetId([
            'deliveryboy_id' => $deliveryboy_id,
            'orders_id' => $orders_id,
            'is_current' => '1',
        ]);

        $notification = new AlertController();
        //$send = $notification->ordersNotification($deliveryboy_id, $orders_id);

       
      
    }
    public function updateOrderPayment($request)
    {
        $orders_id=$request->orders_pay_id;
        $date_added = date('Y-m-d H:i:s');
        if($request->orders_payment=='1'){
            $payck= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            if($payck->payment_method == 'Cash on Delivery'){
                DB::table('orders')->where('orders_id', $orders_id)->update([
                        'payment_status' => 1,
                    ]);
            }elseif($payck->payment_method == 'banktransfer'){
                DB::table('orders')->where('orders_id', $orders_id)->update([
                        'payment_status' => 1,
                    ]);
            }else{
                DB::table('orders')->where('orders_id', $orders_id)->update([
                        'payment_status' => 1,
                    ]); 
            }

            $order_user= DB::table('orders')->where('orders_id', '=', $orders_id)->first();
            $exist = DB::table('transaction_points')->where('order_id', '=', $orders_id)->where('user_id', '=', $order_user->customers_id)->get();
            $settings = DB::table('settings')->where('id', '=','148')->first();
            $member_type = DB::table('settings')->where('id', '=','149')->first();
            $wallet = DB::table('settings')->where('id', '=','202')->first();

            $point = DB::table('earn_points_settings')->where('status', '1')->where('id', '1')->first();
            $cdata = DB::table('users')->where('id', $order_user->customers_id)->first();
            $oldbalnce=$cdata->loyalty_points;
            $amount = $order_user->order_price;

            if($wallet->value == '1' && $order_user->payment_method == 'wallet'){
                if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_wallet_amount = $level->rate_wallet;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $wallet_point = $count_level_amount*$level_wallet_amount;
                        if($point){
                            $no_rm = $point->no_rm;
                            $no_point = $point->points;
                            $count_rm = round($amount/$no_rm);
                            $give_point = $count_rm*$no_point;
                            $total_point = $give_point+$member_point+$wallet_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }else{
                            $total_point = $member_point+$wallet_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }
                         // get user level
                        // Update user type
                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_wallet_amount = $level->rate_wallet;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $wallet_point = $count_level_amount*$level_wallet_amount;
                        $total_point = $member_point+$wallet_point;
                        $newbalnce=$oldbalnce+$total_point;

                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                         $total_point = 0;
                         $newbalnce=$oldbalnce+$total_point;
                    }
                }elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1'){
                    if($point){
                        $no_rm = $point->no_rm;
                        $no_point = $point->points;
                        $count_rm = round($amount/$no_rm);
                        $give_point = $count_rm*$no_point;
                        $total_point = $give_point;
                        $newbalnce=$oldbalnce+$total_point;
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }
            }else{
                if(count($exist)=='0' && $member_type->value == '1' && $settings->value == '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;

                        if($point){
                            $no_rm = $point->no_rm;
                            $no_point = $point->points;
                            $count_rm = round($amount/$no_rm);
                            $give_point = $count_rm*$no_point;
                            $total_point = $give_point+$member_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }else{
                            $total_point = $member_point;
                            $newbalnce=$oldbalnce+$total_point;
                        }

                        // get user level
                        // Update user type
                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;  
                    }
                }elseif(count($exist)=='0' && $member_type->value == '1' && $settings->value != '1'){
                    $level = DB::table('member_type')->where('status', '1')->where('id', $cdata->users_level)->first();
                    if($level != ''){
                        $level_amount = $level->rate_others;
                        $level_peramount = $level->number_amount;
                        $count_level_amount = round($amount/$level_peramount);
                        $member_point = $count_level_amount*$level_amount;
                        $total_point = $member_point;
                        $newbalnce=$oldbalnce+$total_point;

                        $uppoint=DB::table('member_type')->where('status', '1')->get();
                        if(!$uppoint->isEmpty()){
                            foreach ($uppoint as  $jespoint) {
                                if($jespoint->points <= $newbalnce){
                                    DB::table('users')->where('id', $order_user->customers_id)->update([
                                        'users_level' => $jespoint->id,
                                    ]);
                                }
                            }
                        }
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }

                }elseif(count($exist)=='0' && $member_type->value != '1' && $settings->value == '1'){
                    if($point){
                        $no_rm = $point->no_rm;
                        $no_point = $point->points;
                        $count_rm = round($amount/$no_rm);
                        $give_point = $count_rm*$no_point;
                        $total_point = $give_point;
                        $newbalnce=$oldbalnce+$total_point;
                    }else{
                        $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                    }
                }else{
                    $total_point = 0;
                        $newbalnce=$oldbalnce+$total_point;
                }
            }

            //insert point details
            DB::table('transaction_points')->insert([
                'user_id' => $order_user->customers_id,
                'order_id'=> $orders_id,
                'points' => $total_point,
                'balance_points' => $newbalnce,
                'points_status' => 'in',
                'description'=>'Make Purchase',
                'created_at' => $date_added,
                'updated_at' => $date_added
            ]);

            // update user table
            DB::table('users')->where('id', $order_user->customers_id)->update([
                'loyalty_points' => $newbalnce,
            ]);
        }else{
           DB::table('orders')->where('orders_id', $orders_id)->update([
                        'payment_status' => $request->orders_payment,
            ]);

            $trans_point_check = DB::table('transaction_points')->where('order_id', '=', $orders_id)->first();
            if($trans_point_check != ''){
                DB::table('transaction_points')->where('order_id', $orders_id)->delete();
                $uppoint=DB::table('member_type')->where('status', '1')->get();
                if(!$uppoint->isEmpty()){
                    $customer_id= DB::table('orders')->where('orders_id', '=', $orders_id)->first();

                    $pointsIn = DB::table('transaction_points')->where('user_id', '=', $customer_id->customers_id)->where('points_status', '=', 'in')->sum('points');
                    $pointsOut = DB::table('transaction_points')->where('user_id', '=', $customer_id->customers_id)->where('points_status', '=', 'out')->sum('points');

                    $totalPoints = $pointsIn - $pointsOut;
                    DB::table('users')->where('id', $customer_id->customers_id)->update([
                        'loyalty_points' => $totalPoints,
                    ]);
                    foreach ($uppoint as  $jespoint) {
                        if($jespoint->points <= $totalPoints){
                            DB::table('users')->where('id', $customer_id->customers_id)->update([
                                'users_level' => $jespoint->id,
                            ]);
                        }
                    }
                }
            }
        }

        return 'success';
    }
}
