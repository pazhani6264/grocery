<?php 
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Table extends Model
{
	use Sortable;
	public $sortable =['id'];

	public function paginator($data){

        $sort = $data['sort'];
        $direction = $data['direction'];

        if($sort != '')
        {
	 	    $table = DB::table('table_menu')
		 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
		 	->select('table_menu.*', 'appointment_outlet.name as outletname')
	        ->orderBy($sort, $direction)
	        ->paginate(20);
        }else{
          $table = DB::table('table_menu')
		 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
		 	->select('table_menu.*', 'appointment_outlet.name as outletname')
	        ->paginate(20); 
        }
           return ($table);


	 }

	 public function filter($data)
     {
     	$sort = $data['sort'];
        $direction = $data['direction'];
        $name = $data['FilterBy'];
        $param = $data['parameter'];
        $param2 = $data['parameter2'];

       

        if($sort != ''){
        	switch ( $name ) {
        		case 'table':
	        		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
				 	->where('table_menu.table_no', 'LIKE', '%' . $param . '%')
			        ->orderBy($sort, $direction)
			        ->paginate(20);
		       	break;
            	case 'outlet':
            		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
				 	->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')
			        ->orderBy($sort, $direction)
			        ->paginate(20);
			    break;
                case 'Status':
                    
            		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
                     ->where('table_menu.status', $param2)
				 
			        ->orderBy($sort, $direction)
			        ->paginate(20);
			    break;
            	default:
	            	$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
			        ->orderBy($sort, $direction)
			        ->paginate(20);
			    break;
        	}
        }else{
        	switch ( $name ) {
        		case 'table':
	        		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
				 	->where('table_menu.table_no', 'LIKE', '%' . $param . '%')
			        ->paginate(20);
		       	break;
            	case 'outlet':
            		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
				 	->where('appointment_outlet.name', 'LIKE', '%' . $param . '%')
			        ->paginate(20);
			    break;
                case 'Status':
                    
            		$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
                     ->where('table_menu.status', $param2)
				
			        ->paginate(20);
			    break;
            	default:
	            	$table = DB::table('table_menu')
				 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'table_menu.outlet')
				 	->select('table_menu.*', 'appointment_outlet.name as outletname')
			        ->paginate(20);
			    break;
        	}

        }
        return $table;
     }

     public function view_outlet()
     {
     	  $outlet = DB::table('appointment_outlet')->where('status','=','1')->get();
     	  return $outlet;
     }
     public function checkExistTable($request)
     {
     		$checkExist = DB::table('table_menu')->where('table_no','=',$request->tname)->where('outlet','=',$request->outlet_id)->first();
     		return $checkExist;
     }
     public function table_insert($request)
     {
     		$date_added	= date('y-m-d h:i:s');
     		DB::table('table_menu')->insert([
            'table_no'  =>  $request->tname,
            'max_per'   =>  $request->nperson,
            'outlet'    =>  $request->outlet_id,
            'status' 	=>  $request->categories_status,
            'created_at'=>	 $date_added,
            'updated_at'=>  $date_added
        ]);
     }

     public function geteditTable($id)
     {
     	 $table=DB::table('table_menu')->where('id','=',$id)->first();
     	 return $table;
     }
     public function editExist($request)
     {
     		$checkExist = DB::table('table_menu')->where('table_no','=',$request->tname)->where('outlet','=',$request->outlet_id)->where('id','!=', $request->id)->first();
     		return $checkExist;
     }
     public function table_update($request)
     {
     		$date_added	= date('y-m-d h:i:s');
     		$table =  DB::table('table_menu')->where('id','=',$request->id)->update([
            'table_no'  =>  $request->tname,
            'max_per'   =>  $request->nperson,
            'outlet'    =>  $request->outlet_id,
            'status' 	=>  $request->categories_status,
            'updated_at'=>  $date_added
         ]);
        return $table;
     }
     public function table_delete($request)
     {
     	  $table_id = $request->id;
        DB::table('table_menu')->where('id', $table_id)->delete();
     }
     public function get_order($data)
     {
     	  $sort = $data['sort'];
        $direction = $data['direction'];
        if($sort != '')
        {
	 	    $table = DB::table('booking_table')
		 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'booking_table.outletid')
		 	->leftJoin('users','users.id', '=', 'booking_table.merchant_id')
		 	->select('booking_table.*', 'appointment_outlet.name as outletname','users.first_name','users.last_name')
	        ->orderBy($sort, $direction)
	        ->paginate(20);
        }else{
          $table = DB::table('booking_table')
		 	->leftJoin('appointment_outlet','appointment_outlet.id', '=', 'booking_table.outletid')
		 	->leftJoin('users','users.id', '=', 'booking_table.merchant_id')
			->select('booking_table.*', 'appointment_outlet.name as outletname','users.first_name','users.last_name')
	        ->orderBy('booking_table.id', 'DESC')
	        ->paginate(20); 
        }
           return ($table);
     }
     public function get_details_order($id)
     {
     		$orderid=$id;
    		$ordersData = array();       
        	$subtotal  = 0;
    	$order = DB::table('booking_table')
            ->where('id', '=', $orderid)
            ->select('booking_table.*')
            ->get();
       foreach ($order as $data) { 
         $orders_id = $data->id;
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
                ->where('orders_products.orders_id', '=', $data->qrcode)->get();
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

        $data->data = $product;
        $orders_data[] = $data;
    }

        $ordersData['orders_data'] = $orders_data;
        $ordersData['total_price'] = $total_price;
        $ordersData['subtotal'] = $subtotal;

        return $ordersData;
     }
}
?>