<?php
namespace App\Http\Controllers\AdminControllers;
use App\Models\Web\Index;
use App\Models\Web\Ticket;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Session;
use Carbon\Carbon;

class SupportController extends Controller
{
	public function __construct(
        Index $index
    ) {
        $this->index = $index;
    }
	public function tickets(Request $request)
	{
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		 $userId = auth()->user()->id;
         $username = DB::table('users')->where('role_id',1)->first();
         $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
         $shopID = $shop_id->id;
         //print_r($userId);die();

		  // Answered tickets count
        $answered_tickets_count = DB::connection('mysql2')->table('tickets')
                            ->where([['shop_id', '=', $shopID], ['status', '=', 2]])
                            ->get();

        // Opened tickets count
        $open_tickets_count = DB::connection('mysql2')->table('tickets')
                            ->where([['shop_id', '=', $shopID], ['status', '=', 1]])
                            ->get();
		// Get opened tickets data
        $open_tickets = DB::connection('mysql2')->table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['shop_id', '=', $shopID],
                                ['status', '=', 1],
                                ])->limit(6)->get();
         // Get answered tickets data
        $answered_tickets = DB::connection('mysql2')->table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['shop_id', '=', $shopID],
                                ['status', '=', 2],
                                ])->limit(6)->get();
        // Get closed tickets data                         
        $closed_tickets = DB::connection('mysql2')->table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['shop_id', '=', $shopID],
                                ['status', '=', 3],
                                ])->get(); 

		 return view('admin.support.dashboard', ['open_tickets'=>$open_tickets, 
                                      'answered_tickets'=>$answered_tickets,
                                       'closed_tickets'=>$closed_tickets,
                                       'answered_tickets_count' => $answered_tickets_count,
                                       'open_tickets_count' => $open_tickets_count])->with('result', $result);
	}

	public function view_tickets(Request $request)
	{
		$userId = auth()->user()->id;
        $username = DB::table('users')->where('role_id',1)->first();
         $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
         $shopID = $shop_id->id;

		$result['commonContent'] = $this->index->commonContent();

        $all_tickets_count = DB::connection('mysql2')->table('tickets')
            ->where([['shop_id', '=', $shopID]])
            ->get();

        $answered_tickets_count = DB::connection('mysql2')->table('tickets')
            ->where([['shop_id', '=', $shopID], ['status', '=', 2]])
            ->get();

        $open_tickets_count = DB::connection('mysql2')->table('tickets')
            ->where([['shop_id', '=', $shopID], ['status', '=', 1]])
            ->get();

        $closed_tickets_count = DB::connection('mysql2')->table('tickets')
            ->where([['shop_id', '=', $shopID], ['status', '=', 3]])
            ->get();

        $all_tickets = DB::connection('mysql2')->table('tickets')
            ->orderByDesc('id')
            ->where('shop_id', $shopID)
            ->paginate(10, ['*'], 'all');

        $open_tickets = DB::connection('mysql2')->table('tickets')
            ->orderByDesc('id')
            ->where([['shop_id', '=', $shopID], ['status', '=', 1]])
            ->paginate(10, ['*'], 'opened');

        $answered_tickets = DB::connection('mysql2')->table('tickets')
            ->orderByDesc('id')
            ->where([['shop_id', '=', $shopID], ['status', '=', 2]])
            ->paginate(10, ['*'], 'answered');

        $closed_tickets = DB::connection('mysql2')->table('tickets')
            ->orderByDesc('id')
            ->where([['shop_id', '=', $shopID], ['status', '=', 3]])
            ->paginate(10, ['*'], 'closed');

        return view('admin.support.tickets',
            ['open_tickets' => $open_tickets, 'answered_tickets' => $answered_tickets,
                'closed_tickets' => $closed_tickets, 'all_tickets' => $all_tickets,
                'all_tickets_count' => $all_tickets_count, 'answered_tickets_count' => $answered_tickets_count,
                'open_tickets_count' => $open_tickets_count, 'closed_tickets_count' => $closed_tickets_count])->with('result', $result);
	}

	public function search(Request $request)
    {
        $userId = auth()->user()->id;
        $username = DB::table('users')->where('role_id',1)->first();
         $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
         $shopID = $shop_id->id;

        $result['commonContent'] = $this->index->commonContent();
        $q = $request->input('q');
        if ($q) {
            $all_tickets = DB::connection('mysql2')->table('tickets')
            	->where([['shop_id', '=', $shopID], ['subject', 'LIKE', '%' . $q . '%']])
                ->orWhere([['shop_id', '=', $shopID], ['id', 'like', '%' . $q . '%']])
                ->orWhere([['shop_id', '=', $shopID], ['product', 'like', '%' . $q . '%']])
                //->withCount('replies')
                ->orderbyDesc('id')
                ->get();
            return view('admin.support.search', ['all_tickets' => $all_tickets])->with('result', $result);
        } else {
            return redirect('/view_tickets');
        }

    }

    public function ViewTicketData($id) {

        $userId = auth()->user()->id;
        $username = DB::table('users')->where('role_id',1)->first();
         $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
         $shopID = $shop_id->id;

        $result['commonContent'] = $this->index->commonContent();

        $ticket = DB::connection('mysql2')->table('tickets') 
                     ->where([['shop_id', '=', $shopID]])
                     ->find($id);

 
        $replies =DB::connection('mysql2')->table('replies')
        		->where('ticket_id',$id)->get();

        $update = DB::connection('mysql2')->table('tickets')
                        ->where('id', $id)
                        ->where('shop_id', $shopID)
                        ->update(['notice' => 1]);

        
        if ($ticket === null) {

            return redirect()->back();

        }else {
            
             return view('admin.support.ticket', ['ticket' => $ticket, 'replies'=>$replies])->with('result', $result);
        }       

       
    }

    public function AddTicketData(Request $request)
    {
    	$validate = $request->validate(
            ['replay_body' => ['required', 'string', 'max:1000'], 
             'replay_file' => ['max:2048', 'mimes:jpg,png,jpeg,pdf']]);

    	 if($request['ticket_id']) {

    	 	$userId = auth()->user()->id;

             $username = DB::table('users')->where('role_id',1)->first();
                $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
        	 	$shopID = $shop_id->id;

    	 	 $ticket = DB::connection('mysql2')->table('tickets')
               ->where('id', $request['ticket_id'])
               ->where('shop_id', $shopID)
               ->get();
             if($ticket->count() > 0) {
             	$status = 1;

             	$update = DB::connection('mysql2')->table('tickets')
                        ->where('id', $request['ticket_id'])
                        ->update(['status' => $status ]);
                if($request->replay_file == null) {
                	//insert data into customer
		                $customers_id = DB::connection('mysql2')->table('replies')->insertGetId([
		                    'user_id' => $userId,
		                    'ticket_id' => $request['ticket_id'],
		                    'replay_body' => strip_tags($request['replay_body']),
                            'created_at'=> date('Y-m-d H:i:s'),
                            'shop_id'=> $shopID,
                            'shop_name'=> auth()->user()->user_name,
		                ]);
					
						$domainNoti = DB::connection('mysql2')->table('notification')->insert([
							  'shop_id' => $shopID,
							  'shop_name' => auth()->user()->user_name,
							  'comments' => 'Tickets',
							  'created_at'=> date('Y-m-d H:i:s'),
							  'status'=> 1,
							]);
					
                }else{
					$fileName = time() . '.' . $request->replay_file->getclientoriginalextension();
                	 $fileNamestore = url('uploads/replies'). '/'.time() . '.' . $request->replay_file->getclientoriginalextension();
					//print_r($fileName);die();
                	 $request->replay_file->move('uploads/replies/' , $fileName);

                	 //insert data into customer
		                $customers_id = DB::connection('mysql2')->table('replies')->insertGetId([
		                    'user_id' => $userId,
		                    'ticket_id' => $request['ticket_id'],
		                    'replay_body' => strip_tags($request['replay_body']),
		                    'replay_file' => $fileNamestore,
                            'created_at'=> date('Y-m-d H:i:s'),
                            'shop_id'=> $shopID,
                            'shop_name'=> auth()->user()->user_name,
		                ]);
					
							$domainNoti = DB::connection('mysql2')->table('notification')->insert([
							  'shop_id' => $shopID,
							  'shop_name' => auth()->user()->user_name,
							  'comments' => 'Tickets',
							  'created_at'=> date('Y-m-d H:i:s'),
							  'status'=> 1,
							]);
                }
             }else{
             	return redirect()->back();
             }
             $request->session()->flash('success', 'Your reply has been submitted');
            return redirect()->back();
    	 }
    }

    public function UpdateTicketData(Request $request)
    {
    	$userId = auth()->user()->id;
        $username = DB::table('users')->where('role_id',1)->first();
         $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
         $shopID = $shop_id->id;


        if($request['ticket_id']) {
            
            $status = 3;
            
            $update = DB::connection('mysql2')->table('tickets')
               ->where('id', $request['ticket_id'])
               ->where('shop_id', $shopID)
               ->update(['status' => $status]);

        }elseif($request['ticketId']) {

            $status = 1;

            $update = DB::connection('mysql2')->table('tickets')
               ->where('id', $request['ticketId'])
               ->where('shop_id', $shopID)
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

    public function openTicket(Request $request)
    {
    	$products = DB::connection('mysql2')->table('tickets_products')->where('status', 1)->orderByDesc('id')
            ->get();
            $result['commonContent'] = $this->index->commonContent();
        return view('admin.support.open-ticket', ['products' => $products])->with('result', $result);
    }
    public function InsertTicket(Request $request)
    {
    	$validate = $request->validate([
            'subject' => ['required', 'string', 'max:70'],
            'product' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'description' => ['required', 'string', 'max:1000'],
            'attachfile' => ['max:2048', 'mimes:jpg,png,jpeg,pdf'],
            'terms' => ['required'],
        ]);
        if ($validate)
        {
        	 $product = DB::connection('mysql2')->table('tickets_products')->where([['product_name', '=', $request['product']]])->get();
        	 if ($product->count() > 0)
        	 {
                $userId = auth()->user()->id;
                $username = DB::table('users')->where('role_id',1)->first();
                $shop_id = DB::connection('mysql2')->table('tb_user')->where('shop_name',$username->user_name)->first();
        	 	$shopID = $shop_id->id;
                 //print_r($shopID);die();
        	 	if ($request->attachfile == null)
        	 	{
        	 		//insert data into customer
		                $customers_id = DB::connection('mysql2')->table('tickets')->insertGetId([
		                    'user_id' => $username->id,
		                    'subject' => strip_tags($request['subject']),
		                    'product' => $request['product'],
		                    'description'=> strip_tags($request['description']),
                            'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request['priority'],
                            'shop_id'=> $shopID,
                            'shop_name'=> auth()->user()->user_name,
		                ]);
					
							$domainNoti = DB::connection('mysql2')->table('notification')->insert([
							  'shop_id' => $shopID,
							  'shop_name' => $username->user_name,
							  'comments' => 'Tickets',
							  'created_at'=> date('Y-m-d H:i:s'),
							  'status'=> 1,
							]);
						  
        	 	}else{
					$fileName = time() . '.' . $request->attachfile->getclientoriginalextension();
        	 		$fileNamestore = url('uploads/tickets').'/'.time() . '.' . $request->attachfile->getclientoriginalextension();
                    $request->attachfile->move('uploads/tickets/' , $fileName);

                    //insert data into customer
		                $customers_id = DB::connection('mysql2')->table('tickets')->insertGetId([
		                    'user_id' => $userId,
		                    'subject' => strip_tags($request['subject']),
		                    'product' => $request['product'],
		                    'description'=> strip_tags($request['description']),
		                    'attachfile'=> $fileNamestore,
		                    'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request['priority'],
                            'shop_id'=> $shopID,
                            'shop_name'=> auth()->user()->user_name,
		                   ]);
					
							$domainNoti = DB::connection('mysql2')->table('notification')->insert([
							  'shop_id' => $shopID,
							  'shop_name' => $username->user_name,
							  'comments' => 'Tickets',
							  'created_at'=> date('Y-m-d H:i:s'),
							  'status'=> 1,
							]);
        	 	}
        	 	return redirect()->intended('admin/support/ticket/'.$customers_id);
        	 }else{
        	 	return redirect()->back();
        	 }
        }
    }

    public function Notifications(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
    	return view('admin.support.notifications')->with('result', $result);
    }
}
?>