<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class Reports extends Model
{
    use Sortable;
    public $sortable = ['reviews_id', 'products_id', 'customers_id', 'customers_name', 'reviews_rating', 'reviews_status', 'reviews_read', 'created_at', 'updated_at','coupans_id','code','description','discount_type','amount',
        'expiry_date','usage_count','individual_use','individual_use','exclude_product_ids',
        'usage_limit','usage_limit_per_user','limit_usage_to_x_items','free_shipping',
        'product_categories','excluded_product_categories','excluded_product_categories','minimum_amount','maximum_amount','email_restrictions','used_by'];



        public function salesprintReport($request)
        {
           
    
            $language_id = '1';
            $report = DB::table('orders')->where('orders.order_status_id', '!=', 3);
            if (isset($request->orderid)) {
                $report->where('orders_id', $request->orderid);
            }
            if (isset($request->dateRange)) {
                $range = explode('-', $request->dateRange);
    
                $startdate = trim($range[0]);
                $enddate = trim($range[1]);
    
                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                if (isset($request->platform)) {
                    if($request->platform =='Website')
                    {
                    $report->where('ordered_source', 1);
                    }
                    if($request->platform =='App')
                    {
                    $report->where('ordered_source', 2);
                    }
                    if($request->platform =='Pos')
                    {
                    $report->where('ordered_source', 0);
                    }
                }
            }
            else
            {
                $startdate = date('d-m-Y ');
                $enddate = date('d-m-Y ');
                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                if (isset($request->platform)) {
                    if($request->platform =='Website')
                    {
                    $report->where('ordered_source', 1);
                    }
                    if($request->platform =='App')
                    {
                    $report->where('ordered_source', 2);
                    }
                    if($request->platform =='Pos')
                    {
                    $report->where('ordered_source', 0);
                    }
                }
            }
            if (isset($request->orders_status_id)) {
    
                $orders_status_id = $request->orders_status_id;
                $report->LeftJoin('orders_status_history', function ($join) use ($orders_status_id) {
                    $join->on('orders_status_history.orders_id', '=', 'orders.orders_id')
                        ->orderby('orders_status_history.date_added', 'DESC')->limit(1);
                });
    
            }
    
    
            if (isset($request->customers_id)) {
                
             
                $report->where('customers_id', $request->customers_id);
            }
            $report->orderBy('orders_id','desc');
            if ($request->page and $request->page == 'invioce') {
                $orders = $report->get();
            } else {
                $orders = $report->paginate(50);
            }
    
            $total_orders_price = $report->sum('order_price');
            // dd($total_orders_price);
            $index = 0;
            $total_price = 0;
    
            
            foreach ($orders as $orders_data) {
                $orders_status = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                    ->where('orders_status_description.language_id', '=', $language_id)
                    ->where('orders_id', '=', $orders_data->orders_id)
                    ->where('orders_status.role_id', '<=', 2);
                
                if (isset($request->orders_status_id)) {
                    $orders_status->where('orders_status_history.orders_status_id', $request->orders_status_id);
                }
    
                $orders_status_history = $orders_status->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();
    
                 $current_boy = DB::table('users')
                     ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
                     ->leftjoin('orders_to_delivery_boy', 'orders_to_delivery_boy.deliveryboy_id', '=', 'users.id')
                 ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status')
                     ->where('orders_to_delivery_boy.orders_id', '=', $orders_data->orders_id)
                     ->where('users.role_id', 4)
                    ->where('is_current', 1)
                     ->first();
    
                     
    
                 if ($current_boy) {
                     $orders[$index]->deliveryboy_name = $current_boy->first_name . ' ' . $current_boy->last_name;
                   
                 } else {
                    $orders[$index]->deliveryboy_name = '---';
                 }
                if(count($orders_status_history) > 0){
                    $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                    $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                }else{
                    unset($orders[$index]);
                }
               
                
                $index++;
    
            }
            $result = array('orders' => $orders, 'total_price' => $total_orders_price);
            return $result;
        }
    

    public function customersReport($request)
    {
      

        $language_id = '1';
        $report = DB::table('orders');
        if (isset($request->orderid)) {
            $report->where('orders_id', $request->orderid);
          
        }

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
          
        }
        else
        {
            $startdate = date('d-m-Y ');
            $enddate = date('d-m-Y ');
            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            //$report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
           
        }
        if (isset($request->orders_status_id)) {

            $orders_status_id = $request->orders_status_id;
            $report->LeftJoin('orders_status_history', function ($join) use ($orders_status_id) {
                $join->on('orders_status_history.orders_id', '=', 'orders.orders_id')
                    ->orderby('orders_status_history.date_added', 'DESC')->limit(1);
            });
           

        }

      
       

        if (isset($request->customers_id)) {
            
            
           
         
            $report->where('customers_id', $request->customers_id);
        }
        $report->orderBy('orders_id','desc');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
           
        } else {
            
            $orders = $report->paginate(50);
        }

        $total_orders_price = $report->sum('order_price');
        // dd($total_orders_price);
        $index = 0;
        $total_price = 0;

       
        
        foreach ($orders as $orders_data) {
            $orders_status = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '<=', 2);
            
            if (isset($request->orders_status_id)) {
                $orders_status->where('orders_status_history.orders_status_id', $request->orders_status_id);
            }

            $orders_status_history = $orders_status->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();

             $current_boy = DB::table('users')
                 ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
                 ->leftjoin('orders_to_delivery_boy', 'orders_to_delivery_boy.deliveryboy_id', '=', 'users.id')
             ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status')
                 ->where('orders_to_delivery_boy.orders_id', '=', $orders_data->orders_id)
                 ->where('users.role_id', 4)
                ->where('is_current', 1)
                 ->first();

                 

             if ($current_boy) {
                 $orders[$index]->deliveryboy_name = $current_boy->first_name . ' ' . $current_boy->last_name;
               
             } else {
                $orders[$index]->deliveryboy_name = '---';
             }
            if(count($orders_status_history) > 0){
                $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            }else{
                unset($orders[$index]);
            }
           
            
            $index++;

        }
        if (isset($request->orderid) || isset($request->customers_id)) {
        $result = array('orders' => $orders, 'total_price' => $total_orders_price);
        }
        else
        {
          
            $result = array('orders' => array(), 'total_price' => 0);
        }
       

        return $result;
    }

    public function customersWallet($request)
    {
        $language_id = '1';
        $report = DB::table('wallet');

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('created_at', [$dateFrom, $dateTo]);
        }
        else
        {
            $startdate = date('d-m-Y ');
            $enddate = date('d-m-Y ');
            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('created_at', [$dateFrom, $dateTo]);
        }

        if (isset($request->customers_id)) {
            $report->where('user_id', $request->customers_id);
        }

            $report->orderBy('id','desc');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        return $orders;
    }

    public function couponReport($request)
    {
        $report = DB::table('orders');

        if (isset($request->couponcode)) {
            $report->where('coupon_code', $request->couponcode);
        }

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

        $report->select('orders.*')->where('customers_id', '!=', '')->where('coupon_code', '!=', '')->orderby('orders.orders_id', 'ASC')->groupby('orders.orders_id');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        $total_orders_price = $report->sum('order_price');

        $index = 0;
        $total_price = 0;

        $result = array('orders' => $orders);
        return $result;
    }

    public function customersWalletTotal($request)
    {
       $report = DB::table('users')->where('id', $request->customers_id)->first(); 
       return $report->wallet_amount;
    }

    public function customersReportTotal($request)
    {
        $report = DB::table('orders');

        if (isset($request->orderid)) {
            $report->where('orders_id', $request->orderid);
        }

        if (isset($request->customers_id)) {
            $report->where('customers_id', $request->customers_id);
        }
        if (isset($request->currency)) {
            $report->where('orders.currency', $request->currency);
        }
        if (isset($request->dateRange)) {

            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);

           
        }
        $orders = $report->get();

       

        $prices = 0;

        foreach($orders as $order){
            $data = DB::select(DB::raw('SELECT * FROM `orders_status_history` WHERE orders_id = '.$order->orders_id.' ORDER BY `orders_status_history`.`orders_status_history_id` DESC LIMIT 1'));
            foreach($data as $d){
                if($d->orders_status_id == 2){
                        $prices = $prices + $order->order_price;
                }
            }
           
        }
        return ($prices);
    }

    public function allorderstatuses()
    {
        $statuses = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
        // ->where('orders_status.role_id', '=', 2)
            ->orderby('role_id')
            ->get();

        return $statuses;
    }

    public function salesreport($request)
    {

        $report = DB::table('orders')->where('orders.order_status_id', '!=', 3)
                    //->selectRaw("date_purchased,orders_id,count('orders.orders_id') as total_orders,sum(order_price) as total_price,currency");
                    ->select('orders.*');
                    if (isset($request->dateRange)) {
                        $range = explode('-', $request->dateRange);
            
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);
            
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);

                        if (isset($request->platform)) {
                            if($request->platform =='Website')
                            {
                            $report->where('ordered_source', 1);
                            }
                            if($request->platform =='App')
                            {
                            $report->where('ordered_source', 2);
                            }
                            if($request->platform =='Pos')
                            {
                            $report->where('ordered_source', 0);
                            }
                        }
                    }
                    else{
                        $dateFrom = date('Y-m-d ' . '00:00:00');
                        $dateTo = date('Y-m-d ' . '23:59:59');
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                    }

        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
            $total_orders_pricenew =  $report->sum('order_price');
        } else {
            $total_orders_pricenew =  $report->sum('order_price');
            $orders = $report->paginate(10);
          
          

        }

        $allcount = DB::table('orders')->where('orders.order_status_id', '!=', 3);
        $websitecount = DB::table('orders')->where('orders.order_status_id', '!=', 3)->where('ordered_source', 1);
        $appcount = DB::table('orders')->where('orders.order_status_id', '!=', 3)->where('ordered_source', 2);
        $poscount = DB::table('orders')->where('orders.order_status_id', '!=', 3)->where('ordered_source', 0);
        $topProducts = DB::table('orders')->where('orders.order_status_id', '!=', 3)
        ->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
        ->select('orders_products.products_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
        ->groupBy('orders_products.products_id');
        $topcat = DB::table('orders')->where('orders.order_status_id', '!=', 3)
        ->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
        ->join('products', 'products.products_id', '=', 'orders_products.products_id')
        ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
        ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
        ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
        ->groupBy('categories_description.categories_name');

 

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $allcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $websitecount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $appcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $poscount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topProducts->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topcat->whereBetween('date_purchased', [$dateFrom, $dateTo]);

           
            if (isset($request->platform)) {
                if($request->platform =='Website')
                {
               
                $topProducts->where('ordered_source', 1);
                $topcat->where('ordered_source', 1);
                }
                if($request->platform =='App')
                {
                   
                    $topProducts->where('ordered_source', 2);
                    $topcat->where('ordered_source', 2);
                }
                if($request->platform =='Pos')
                {
                    
                    $topProducts->where('ordered_source', 0);
                    $topcat->where('ordered_source', 0);
                }
            }


        } elseif (isset($request->ptype)) {

            $allcount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $websitecount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $appcount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $poscount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $topProducts->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->where('products.products_type', $request->ptype);

            $topcat->where('products.products_type', $request->ptype);

            if (isset($request->platform)) {
                if($request->platform =='Website')
                {
               
                $topProducts->where('ordered_source', 1);
                $topcat->where('ordered_source', 1);
                }
                if($request->platform =='App')
                {
                   
                    $topProducts->where('ordered_source', 2);
                    $topcat->where('ordered_source', 2);
                }
                if($request->platform =='Pos')
                {
                    
                    $topProducts->where('ordered_source', 0);
                    $topcat->where('ordered_source', 0);
                }
            }

        }else{
            $dateFrom = date('Y-m-d ' . '00:00:00');
            $dateTo = date('Y-m-d ' . '23:59:59');
            $allcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $websitecount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $appcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $poscount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topProducts->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topcat->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

        $newallcount = $allcount->count();
        $newwebsitecount = $websitecount->count();
        $newappcount = $appcount->count();
        $newposcount = $poscount->count();
        $topproductsnew = $topProducts->orderByDesc('total_sales')->take(5)->get();
        $topcatnew = $topcat->orderByDesc('total_sales')->take(5)->get();

        
        $total_orders_price = DB::table('orders')
                    ->sum('order_price');
        
        $result = array('orders' => $orders, 'total_price' => $total_orders_price, 'total_pricenew' => $total_orders_pricenew, 'allcount' => $newallcount, 'websitecount' => $newwebsitecount, 'appcount' => $newappcount, 'poscount' => $newposcount, 'top_products' => $topproductsnew, 'topcats' => $topcatnew);
        return $result;
    } 

    public function ProfitLossReport($request)
    {


        $report = DB::table('orders')
        ->where('orders.order_status_id', '!=', 3)
                    ->selectRaw("date_purchased,orders_id,count('orders.orders_id') as total_orders,sum(order_price) as total_price,currency");
                    if (isset($request->dateRange)) {
                        $range = explode('-', $request->dateRange);
            
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);
            
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));

                      
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo])->groupby(DB::raw('Date(date_purchased)'));
                    }
                    else{
                        $dateFrom = date('Y-m-d ' . '00:00:00');
                        $dateTo = date('Y-m-d ' . '23:59:59');
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo])->groupby(DB::raw('Date(date_purchased)'));
                    }

        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);

        }


        $total_orders_price = DB::table('orders')
                    ->sum('order_price');
        
        $result = array('orders' => $orders, 'total_price' => $total_orders_price);
        return $result;
    }

     public function salesdetail($id)
    {
         $language_id = '1';
        $orders_id = $id; 
        $ordersData = array();       
        $subtotal  = 0;
        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($orders_id));
        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($orders_id));

       // print_r($dateFrom);die();


        $order = DB::table('orders')
            // ->where('orders.order_status_id', '!=', 3)
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
                ->select('orders_products.*', 'image_categories.path as image','image_categories.path_type as image_path_type')
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
        return $ordersData;
    } 


   /*  public function salesdetail($id)
    {
       
        $orderdate = $id; 
     
        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($orderdate));
        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($orderdate));

       

        $order = DB::table('orders')
            ->leftjoin('orders_products', 'orders_products.orders_id', '=', 'orders.orders_id')
            ->whereBetween('date_purchased', [$dateFrom, $dateTo])
            ->select('orders.*','orders_products.*')
            ->where('orders.order_status_id', '!=', 3)
            ->get();

         

       
        return $order;
    } */

    public function productsalesreport($request)
    {
        $orders_data = array();
            $orders_products = DB::table('orders_products')
                ->select('orders_products.*','orders.date_purchased','orders.currency','orders.currency_value')
                ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                ->join('orders', 'orders.orders_id', '=', 'orders_products.orders_id');
                
                if (isset($request->dateRange)) {
                    $range = explode('-', $request->dateRange);
            
                    $startdate = trim($range[0]);
                    $enddate = trim($range[1]);
            
                    $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                    $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                    $orders_products->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    
                    if(isset($request->categories_id)) {
                        if($request->categories_id == 'all') 
                        {
                            if(isset($request->products_id)){
                                $orders_products->where('orders_products.products_id', $request->products_id);
                                
                            }
                        }
                        else
                        {
                            if(isset($request->products_id)){
                                $orders_products->where('orders_products.products_id', $request->products_id);
                               
                            }
                            else
                            {
                                $orders_products->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id');
                                $orders_products->where('products_to_categories.categories_id', $request->categories_id);
                                
                            }

                        }
                    }
                    else
                    {
                        
                    }
                }else{
                    $dateFrom = date('Y-m-d ' . '00:00:00');
                    $dateTo = date('Y-m-d ' . '23:59:59');
                    $orders_products->whereBetween('orders.date_purchased', [$dateFrom, $dateTo]);
                    if(isset($request->categories_id)) {
                        if($request->categories_id == 'all') 
                        {
                            if(isset($request->products_id)){
                                $orders_products->where('orders_products.products_id', $request->products_id);
                               
                            }
                        }
                        else
                        {
                            if(isset($request->products_id)){
                                $orders_products->where('orders_products.products_id', $request->products_id);
                              
                            }
                            else
                            {
                                $orders_products->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id');
                                $orders_products->where('products_to_categories.categories_id', $request->categories_id);
                                
                            }

                        }
                    }
                    else
                    {
                        
                    }
                    }
            if ($request->page and $request->page == 'invioce') {
                $orders_products = $orders_products->get();
            } else {
                $orders_products = $orders_products->get();
            }
            
            foreach ($orders_products as $orders_products_data) {
                $product_attribute = DB::table('orders_products_attributes')
                    ->where([
                        ['orders_products_id', '=', $orders_products_data->orders_products_id],
                        ['orders_id', '=', $orders_products_data->orders_id],
                    ])
                    ->get();

                $orders_products_data->attribute = $product_attribute;
                $orders_data[] = $orders_products_data;
            }

        return $orders_data;
    }

    public function inventoryreport($request)
    {
        $report = DB::table('inventory');
        if(isset($request->value) && isset($request->products_id)){
            $inventory_ref_id  = DB::table('inventory_detail')->where('products_id',$request->products_id)->where('attribute_id',$request->value)->pluck('inventory_ref_id');
            $report->whereIn('inventory.inventory_ref_id', $inventory_ref_id);
            if (isset($request->dateRange)) {
                $range = explode('-', $request->dateRange);

                $startdate = trim($range[0]);
                $enddate = trim($range[1]);

                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('created_at', [$dateFrom, $dateTo]);
            }
        }
        elseif (isset($request->products_id)) {
            $report->where('inventory.products_id', $request->products_id);

            if (isset($request->dateRange)) {
                $range = explode('-', $request->dateRange);

                $startdate = trim($range[0]);
                $enddate = trim($range[1]);

                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('created_at', [$dateFrom, $dateTo]);
                
            }

        } else {
            $report->where('inventory.inventory_ref_id', '');
        }
        $report->orderBy('inventory.inventory_ref_id','desc');
        if ($request->page and $request->page == 'invioce') {
            
            $reports = $report->get();
        } else {
            $reports = $report->paginate(50);
        }

        return $reports;

    }

    public function minstock($request)
    {
        $product = DB::table('products')
        ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
        ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
        ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
        ->LeftJoin('specials', function ($join) {

            $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

        })
        ->select('products.products_id','products.products_type', 'products_description.products_name')
        ->where('products_description.language_id', '=', 1);
        $product->orderBy('products.products_id', 'DESC');

        $product =  $product->get();
        $stocks = 0;
        $min_level = 0;
        $max_level = 0;
        $result = array();
        foreach($product as $key => $product){
            if($product->products_type!=1){
                
                $stocksin = DB::table('inventory')->where('products_id', $product->products_id)->where('stock_type', 'in')->sum('stock');
                $stockOut = DB::table('inventory')->where('products_id', $product->products_id)->where('stock_type', 'out')->sum('stock');
                $stocks = $stocksin - $stockOut;
                $manageLevel = DB::table('manage_min_max')->where('products_id', $product->products_id)->get();
                if(count($manageLevel)>0){
                    $min_level = $manageLevel[0]->min_level;
                    $max_level = $manageLevel[0]->max_level;
                }
                if((int)$stocks < (int)$min_level){
                    $result[] = json_decode(json_encode(
                        [
                            'products_name' => $product->products_name,
                            'products_id' => $product->products_id,
                            'stocks' => $stocks,
                            'min_level' => $min_level 
                            ]
                    ));
                }
                ;
            }
            else{
                
            }

        }
        // dd($result);
        if ($request->page and $request->page == 'invioce') {
            $orders = $result;
        } else {
            $orders = $this->paginate($result);
        }

        return $orders;

    }

    public function maxstock($request)
    {
        $product = DB::table('products')
        ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
        ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
        ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
        ->LeftJoin('specials', function ($join) {

            $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');

        })
        ->select('products.products_id','products.products_type', 'products_description.products_name')
        ->where('products_description.language_id', '=', 1);
        $product->orderBy('products.products_id', 'DESC');

        $product =  $product->get();
        $stocks = 0;
        $min_level = 0;
        $max_level = 0;
        $result = array();
        foreach($product as $key => $product){
            if($product->products_type!=1){
                
                $stocksin = DB::table('inventory')->where('products_id', $product->products_id)->where('stock_type', 'in')->sum('stock');
                $stockOut = DB::table('inventory')->where('products_id', $product->products_id)->where('stock_type', 'out')->sum('stock');
                $stocks = $stocksin - $stockOut;
                $manageLevel = DB::table('manage_min_max')->where('products_id', $product->products_id)->get();
                if(count($manageLevel)>0){
                    $min_level = $manageLevel[0]->min_level;
                    $max_level = $manageLevel[0]->max_level;
                }
                if((int)$stocks > (int)$max_level){
                    $result[] = json_decode(json_encode(
                        [
                            'products_name' => $product->products_name,
                            'products_id' => $product->products_id,
                            'stocks' => $stocks,
                            'max_level' => $max_level 
                            ]
                    ));
                }
                ;
            }
            else{
                
            }

        }
        // dd($result);
        if ($request->page and $request->page == 'invioce') {
            $orders = $result;
        } else {
            $orders = $this->paginate($result);
        }
        return $orders;
    }

    public function outofstock($request)
    {
        $report = DB::table('inventory')
                    ->leftjoin('products_description', 'products_description.products_id' ,'=' ,'inventory.products_id')
                    ->leftjoin('products', 'products.products_id' ,'=' ,'inventory.products_id')
                    ->select('products.products_type','products_description.products_id', 'products_description.products_name')
                    ->where('products_description.language_id', 1)
                    ->where('products.products_type','!=', 1)
                    ->groupby('inventory.products_id')
                    ->havingRaw("SUM(IF(stock_type = 'in', stock, 0)) - SUM(IF(stock_type = 'out', stock, 0)) = 0")->get();

                // $variableProduct = DB::select(DB::raw("SELECT inventory_detail.*,products_description.products_name , products_attributes.options_id,products_options_values_descriptions.options_values_name, SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END) AS instocksum,SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END) AS outstocksum,(SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END)-SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END)) as finalstock FROM `inventory` LEFT JOIN inventory_detail on inventory.inventory_ref_id = inventory_detail.inventory_ref_id LEFT JOIN products_attributes ON products_attributes.products_attributes_id = inventory_detail.attribute_id LEFT JOIN products_options_values_descriptions ON products_options_values_descriptions.products_options_values_descriptions_id = products_attributes.options_values_id LEFT JOIN products_description ON products_description.products_id = inventory_detail.products_id GROUP by attribute_id DESC"));
                // $out_of_stock_variable_product = array();
                // foreach($variableProduct as $vproduct){
                //     if($vproduct->finalstock == 0){
                //         $report->push( json_decode(json_encode(array("products_type" => 0,"products_name" => $vproduct->products_name.'('.$vproduct->options_values_name.')', "products_id" => $vproduct->products_id))) );

                //     }
                // }

                $notInsertedinInentory = DB::select(DB::raw('SELECT products.products_id,products_description.products_name FROM `products` LEFT JOIN products_description ON products_description.products_id = products.products_id WHERE products_description.language_id = 1 AND products.products_id NOT IN (SELECT products_id FROM inventory GROUP BY products_id)'));
                foreach($notInsertedinInentory as $vproduct){
                        $report->push( json_decode(json_encode(array("products_type" => 0,"products_name" => $vproduct->products_name, "products_id" => $vproduct->products_id))) );
                }
        // dd($report);
        //print_r($report);die();
        if ($request->page and $request->page == 'invioce') {
            $orders = $report;
        } else {
            $orders = $this->paginate($report);
        }
        
        //print_r($orders);die();
        return $orders;

    }


    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

     
       
        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function view_loyaltyreport()
    {
        $redeem_points = DB::table('redeem_points_settings')
        ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
         ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

         ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

          ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
            'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
            'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
            'redeem_points_description.language_id','categoryTable.path as imgpath', 
            'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
         
           ->where('redeem_points_description.language_id', '1')
           ->groupby('redeem_points_settings.id')
           ->paginate(10);
           return ($redeem_points);
    }
    public function filter_loyaltyreport($data)
    {
        $name = $data['FilterBy'];
        $param = $data['parameter'];
        switch ( $name ) {
             case 'Name':
                $redeem_points = DB::table('redeem_points_settings')
                ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                 ->LeftJoin('image_categories as categoryTable', function ($join) {
                        $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                            ->where(function ($query) {
                                $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                    ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                            });
                  })

                 ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                        $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                            ->where(function ($query) {
                                $query->where('parent_description.language_id', '=', 1)->limit(1);
                            });
                    })

                  ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                    'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                    'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                    'redeem_points_description.language_id','categoryTable.path as imgpath', 
                    'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                 
                   ->where('redeem_points_description.language_id', '1')
                   ->where('redeem_points_description.redeem_points_title', 'LIKE', '%' . $param . '%')
                   ->groupby('redeem_points_settings.id')
                   ->paginate(10);
             break;
             default:
                $redeem_points = DB::table('redeem_points_settings')
        ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
         ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

         ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

          ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
            'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
            'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
            'redeem_points_description.language_id','categoryTable.path as imgpath', 
            'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
         
           ->where('redeem_points_description.language_id', '1')
           ->groupby('redeem_points_settings.id')
           ->paginate(10);
             break;
        }
        return $redeem_points;
    }

    public function loyaltyreportuser($id)
    {
        $user_details = DB::table('transaction_points')
        ->leftJoin('users','users.id', '=', 'transaction_points.user_id')
        ->select('users.first_name','users.last_name','transaction_points.created_at','transaction_points.points')
        ->where('transaction_points.loyalty_id', $id)
        ->paginate(10);
        return $user_details;
    }

    public function couponreportuser($id)
    {
       $user_details = DB::table('orders')
        ->leftJoin('users','users.id', '=', 'orders.customers_id')
        ->select('users.first_name','users.last_name','orders.date_purchased','orders.coupon_amount')
        ->where('orders.coupon_code_id', $id)
         ->paginate(7);
         return $user_details;  
    }

    public function appointmentcustomersReportTotal($request)
    {
        $report = DB::table('appointment')->join('products','products.products_id','=','appointment.product_id');

        if (isset($request->orderid)) {
            $report->where('appointment.id', $request->orderid);
        }

        if (isset($request->customers_id)) {
            $report->where('appointment.user_id', $request->customers_id);
        }
        // if (isset($request->currency)) {
        //     $report->where('orders.currency', $request->currency);
        // }
        if (isset($request->dateRange)) {

            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);

           
        }
        $orders = $report->get();

        

        $prices = 0;

        foreach($orders as $order){
            $data = DB::select(DB::raw('SELECT * FROM `appointment_track` WHERE booking_id = '.$order->booking_status.' ORDER BY `appointment_track`.`id` DESC LIMIT 1'));
            foreach($data as $d){
                if($d->booking_id == 4){
                        $prices = $prices + $order->products_price;
                }
            }
           
        }
        return ($prices);
    }




    public function appointmentcustomersReport($request)
    {
       

        $language_id = '1';
        $report = DB::table('appointment')->select('appointment.*','products.products_price','users.first_name')->leftjoin('products','products.products_id','=','appointment.product_id')->leftjoin('users','users.id','=','appointment.user_id');

        if (isset($request->orderid)) {
            $report->where('appointment.id', $request->orderid);
        }

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
        }
        else
        {
            $startdate = date('d-m-Y ');
            $enddate = date('d-m-Y ');
            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('appointment.created_at', [$dateFrom, $dateTo]);
        }
        if (isset($request->orders_status_id)) {

            $orders_status_id = $request->orders_status_id;
            $report->LeftJoin('appointment_track', function ($join) use ($orders_status_id) {
                $join->on('appointment_track.booking_id', '=', 'appointment.booking_status')
                    ->orderby('appointment_track.created_at', 'DESC')->limit(1);
            });

        }
       

        if (isset($request->customers_id)) {
            
            $report->where('appointment.user_id', $request->customers_id);
        }
        $report->orderBy('appointment.id','desc');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        $total_orders_price = $report->sum('products.products_price');
        // dd($total_orders_price);
        $index = 0;
        $total_price = 0;

        
        foreach ($orders as $orders_data) {
            $orders_status = DB::table('appointment_track')
                ->LeftJoin('appointment_status', 'appointment_status.id', '=', 'appointment_track.booking_id')
                ->select('appointment_status.status_name', 'appointment_track.*')
                ->where('appointment_track.appointment_id', '=', $orders_data->id);
                
            if (isset($request->orders_status_id)) {
                $orders_status->where('appointment_track.booking_id', $request->orders_status_id);
            }

            $orders_status_history = $orders_status->orderby('appointment_track.booking_id', 'DESC')->limit(1)->get();

            //  $current_boy = DB::table('users')
            //      ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
            //      ->leftjoin('orders_to_delivery_boy', 'orders_to_delivery_boy.deliveryboy_id', '=', 'users.id')
            //  ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status')
            //      ->where('orders_to_delivery_boy.orders_id', '=', $orders_data->orders_id)
            //      ->where('users.role_id', 4)
            //     ->where('is_current', 1)
            //      ->first();

                 

            //  if ($current_boy) {
            //      $orders[$index]->deliveryboy_name = $current_boy->first_name . ' ' . $current_boy->last_name;
               
            //  } else {
            //     $orders[$index]->deliveryboy_name = '---';
            //  }
            if(count($orders_status_history) > 0){
                $orders[$index]->orders_status_id = $orders_status_history[0]->booking_id;
                $orders[$index]->orders_status = $orders_status_history[0]->status_name;
            }else{
                unset($orders[$index]);
            }
           
            
            $index++;

        }
        if (isset($request->orderid) || isset($request->customers_id)) {
        $result = array('orders' => $orders, 'total_price' => $total_orders_price);
        }
        else
        {
          
            $result = array('orders' => array(), 'total_price' => 0);
        }
        return $result;
    }

    public function sales_person_report($request)
    {
        $report = DB::table('orders');

            if (isset($request->dateRange)) {
                $range = explode('-', $request->dateRange);
            
                $startdate = trim($range[0]);
                $enddate = trim($range[1]);
            
                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));

                      
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            }else{
                $dateFrom = date('Y-m-d ' . '00:00:00');
                $dateTo = date('Y-m-d ' . '23:59:59');
                $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            }
            $report = $report->orderby('orders_id', 'DESC')->paginate(50);
        return $report;
    }

    public function get_sales_person()
    {
        $sales=DB::table('users')->where('role_id','28')->where('status','!=','3')->get();
        return $sales;
    }
    public function salescancelreport($request)
    {

        $report = DB::table('orders')->where('orders.order_status_id', '=', 3)
                    //->selectRaw("date_purchased,orders_id,count('orders.orders_id') as total_orders,sum(order_price) as total_price,currency");
                    ->select('orders.*');
                    if (isset($request->dateRange)) {
                        $range = explode('-', $request->dateRange);
            
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);
            
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);

                        if (isset($request->platform)) {
                            if($request->platform =='Website')
                            {
                            $report->where('ordered_source', 1);
                            }
                            if($request->platform =='App')
                            {
                            $report->where('ordered_source', 2);
                            }
                            if($request->platform =='Pos')
                            {
                            $report->where('ordered_source', 0);
                            }
                        }
                    }
                    else{
                        $dateFrom = date('Y-m-d ' . '00:00:00');
                        $dateTo = date('Y-m-d ' . '23:59:59');
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                    }

        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
            $total_orders_pricenew =  $report->sum('order_price');
        } else {
            $total_orders_pricenew =  $report->sum('order_price');
            $orders = $report->paginate(10);
          
          

        }

        $allcount = DB::table('orders')->where('orders.order_status_id', '=', 3);
        $websitecount = DB::table('orders')->where('orders.order_status_id', '=', 3)->where('ordered_source', 1);
        $appcount = DB::table('orders')->where('orders.order_status_id', '=', 3)->where('ordered_source', 2);
        $poscount = DB::table('orders')->where('orders.order_status_id', '=', 3)->where('ordered_source', 0);
        $topProducts = DB::table('orders')->where('orders.order_status_id', '=', 3)
        ->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
        ->select('orders_products.products_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
        ->groupBy('orders_products.products_id');
        $topcat = DB::table('orders')->where('orders.order_status_id', '=', 3)
        ->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
        ->join('products', 'products.products_id', '=', 'orders_products.products_id')
        ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
        ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
        ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
        ->groupBy('categories_description.categories_name');

 

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $allcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $websitecount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $appcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $poscount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topProducts->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topcat->whereBetween('date_purchased', [$dateFrom, $dateTo]);

           
            if (isset($request->platform)) {
                if($request->platform =='Website')
                {
               
                $topProducts->where('ordered_source', 1);
                $topcat->where('ordered_source', 1);
                }
                if($request->platform =='App')
                {
                   
                    $topProducts->where('ordered_source', 2);
                    $topcat->where('ordered_source', 2);
                }
                if($request->platform =='Pos')
                {
                    
                    $topProducts->where('ordered_source', 0);
                    $topcat->where('ordered_source', 0);
                }
            }


        } elseif (isset($request->ptype)) {

            $allcount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $websitecount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $appcount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $poscount->join('orders_products', 'orders.orders_id', '=', 'orders_products.orders_id')
            ->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->select('categories_description.categories_name', DB::raw('SUM(orders_products.products_quantity) AS total_sales'))
            ->groupBy('categories_description.categories_name')
            ->where('products_type', $request->ptype);

            $topProducts->join('products', 'products.products_id', '=', 'orders_products.products_id')
            ->join('products_to_categories', 'products_to_categories.products_id', '=', 'products.products_id')
            ->join('categories_description', 'products_to_categories.categories_id', '=', 'categories_description.categories_id')
            ->where('products.products_type', $request->ptype);

            $topcat->where('products.products_type', $request->ptype);

            if (isset($request->platform)) {
                if($request->platform =='Website')
                {
               
                $topProducts->where('ordered_source', 1);
                $topcat->where('ordered_source', 1);
                }
                if($request->platform =='App')
                {
                   
                    $topProducts->where('ordered_source', 2);
                    $topcat->where('ordered_source', 2);
                }
                if($request->platform =='Pos')
                {
                    
                    $topProducts->where('ordered_source', 0);
                    $topcat->where('ordered_source', 0);
                }
            }

        }else{
            $dateFrom = date('Y-m-d ' . '00:00:00');
            $dateTo = date('Y-m-d ' . '23:59:59');
            $allcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $websitecount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $appcount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $poscount->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topProducts->whereBetween('date_purchased', [$dateFrom, $dateTo]);
            $topcat->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

        $newallcount = $allcount->count();
        $newwebsitecount = $websitecount->count();
        $newappcount = $appcount->count();
        $newposcount = $poscount->count();
        $topproductsnew = $topProducts->orderByDesc('total_sales')->take(5)->get();
        $topcatnew = $topcat->orderByDesc('total_sales')->take(5)->get();

        
        $total_orders_price = DB::table('orders')
                    ->sum('order_price');
        
        $result = array('orders' => $orders, 'total_price' => $total_orders_price, 'total_pricenew' => $total_orders_pricenew, 'allcount' => $newallcount, 'websitecount' => $newwebsitecount, 'appcount' => $newappcount, 'poscount' => $newposcount, 'top_products' => $topproductsnew, 'topcats' => $topcatnew);
        return $result;
    } 
}
