<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Ticket;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Lang;

class TicketController extends Controller
{
	public function __construct(Ticket $ticket,Images $images, Setting $setting)
    {
    	$this->Ticket = $ticket;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }
	public function view_product(Request $request)
	{
		$title = array('pageTitle' => Lang::get("labels.ticket_products"));
		 $result['commonContent'] = $this->Setting->commonContent();
		 $product = $this->Ticket->paginator();
        return view("admin.ticket.view_ticket_product", $title)->with('result', $result)->with('product',$product);
	}
	public function add_product(Request $request)
	{
		$title = array('pageTitle' => Lang::get("labels.add_new_product"));
		$result = array();
		$result['commonContent'] = $this->Setting->commonContent();
		return view("admin.ticket.add_ticket_product", $title)->with('result', $result);
	}
	public function add_product_action(Request $request)
	{
		$date_added	= date('y-m-d H:i:s');
		$result = array();
		$product_name  = $request->product_name;
		$status  = $request->categories_status;
		$checkExist = DB::table('tickets_products')->where('product_name','=',$product_name)->first();
		if($checkExist){
			$message = Lang::get("labels.ticket_products_already");
			return redirect()->back()->withErrors([$message]);
		}else{
			$this->Ticket->insert_product($product_name,$date_added,$status);
			$message = Lang::get("labels.ticket_products_add");
			return redirect()->back()->withErrors([$message]);
		}
	}
	public function edit_product($id)
	{
		$title = array('pageTitle' => Lang::get("labels.edit_new_product"));
		$result = array();
		$result['commonContent'] = $this->Setting->commonContent();
		$product = $this->Ticket->edit_product($id);
		//print_r($product);die();
		return view("admin.ticket.edit_ticket_product",$title)->with('result', $result)->with('product', $product);
	}
	public function edit_product_action(Request $request)
	{
		$result = array();
		$last_modified 	=   date('y-m-d H:i:s');
    	$update_id = $request->id;
    	$status  = $request->categories_status;
    	$product_name  = $request->product_name;

    	$checkExist =DB::table('tickets_products')->where('product_name','=', $product_name)
                ->where('id','!=', $update_id)
                ->select('product_name')
                ->first();
        if(empty($checkExist)) {
        	$this->Ticket->update_product($product_name,$last_modified,$status,$update_id);
        	$message = Lang::get("labels.ticket_products_edit");
			return redirect()->back()->withErrors([$message]);
        }else{
        	$message = Lang::get("labels.ticket_products_already");
			return redirect()->back()->withErrors([$message]);
        }
	}

	public function delete_product(Request $request)
	{
	  $product = $this->Ticket->delete_product($request);
      $message = Lang::get("labels.ticket_products_delete");
      return redirect()->back()->withErrors([$message]);
	}
	public function view($id)
	{
		 $title = array('pageTitle' => Lang::get("labels.ticket_products"));
		 $result['commonContent'] = $this->Setting->commonContent();
		 if($id=='open'){
		 	$open_tickets = $this->Ticket->open_tickets();
		 }elseif($id=='answer'){
		 	$open_tickets = $this->Ticket->answered_tickets();
		 }elseif($id=='close'){
		 	$open_tickets = $this->Ticket->closed_tickets();
		 }
        return view("admin.ticket.view_ticket", $title)->with('result', $result)->with('open_tickets',$open_tickets);
	}

	public function ticketDetails($id)
	{
		 $title = array('pageTitle' => Lang::get("labels.ticket_products"));
		 $result['commonContent'] = $this->Setting->commonContent();
		 $data = Ticket::find($id);
		 $replies = DB::table('replies')->where('ticket_id','=', $id)->get();
		 return view("admin.ticket.ticket", $title)->with('result', $result)->with('data',$data)->with('replies',$replies);
	}

	public function store(Request $request) {

        $validate = $request->validate(
            ['replay_body' => ['required', 'string', 'max:1000'], 
             'replay_file' => ['max:2048', 'mimes:jpg,png,jpeg,pdf']]);

        if($request['ticket_id']) {


			$userId = auth()->user()->id;
            
            //$reply = new Reply();

            $ticket = DB::table('tickets')
               ->where('id', $request['ticket_id'])
               ->get();

            if($ticket->count() > 0) {

                $notice = 2;
                $status = 2;

                $update = DB::table('tickets')
                        ->where('id', $request['ticket_id'])
                        ->update(['notice' => $notice, 'status' => $status ]);

                if($request->replay_file == null) {

					$customers_id = DB::table('replies')->insertGetId([
						'user_id' => $userId,
						'ticket_id' => $request['ticket_id'],
						'replay_body' => strip_tags($request['replay_body']),
						'created_at'=> date('Y-m-d H:i:s'),
					]);

                   /*  $reply->user_id = $userId;
                    $reply->ticket_id = $request['ticket_id'];
                    $reply->replay_body = strip_tags($request['replay_body']); */

                }else {

                    $fileName = time() . '.' . $request->replay_file->getclientoriginalextension();

                    $request->replay_file->move('uploads/replies/' , $fileName);

					$customers_id = DB::table('replies')->insertGetId([
						'user_id' => $userId,
						'ticket_id' => $request['ticket_id'],
						'replay_body' => strip_tags($request['replay_body']),
						'replay_file' => $fileName,
						'created_at'=> date('Y-m-d H:i:s'),
					]);

                /*     $reply->user_id = $userId;
                    $reply->ticket_id = $request['ticket_id'];
                    $reply->replay_body = strip_tags($request['replay_body']);
                    $reply->replay_file = $fileName; */

                    
                }
               
            } else {

                return redirect()->back();

            }

            //$reply->save();
            $request->session()->flash('success', 'Your reply has been submitted');
            return redirect()->back();
        }
        
    }


	public function update(Request $request) {

        if($request['ticket_id']) {
            
            $status = 3;
            
            $update = DB::table('tickets')
               ->where('id', $request['ticket_id'])
               ->update(['status' => $status]);

        }elseif($request['ticketId']) {

            $status = 1;

            $update = DB::table('tickets')
               ->where('id', $request['ticketId'])
               ->update(['status' => $status]);
               
        }else {
			$request->session()->flash('error', 'it looks like there is a problem');
            return redirect()->back();
        }

        if($update) {

            return redirect()->back();

        }else {
			$request->session()->flash('error', 'it looks like there is a problem');
            return redirect()->back();
            
        }     
        
    }


}
?>