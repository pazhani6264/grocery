<?php
namespace App\Http\Controllers\Web;
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

class TicketsController extends Controller
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

		 $userId = auth()->guard('customer')->user()->id;

		  // Answered tickets count
        $answered_tickets_count = DB::table('tickets')
                            ->where([['user_id', '=', $userId], ['status', '=', 2]])
                            ->get();

        // Opened tickets count
        $open_tickets_count = DB::table('tickets')
                            ->where([['user_id', '=', $userId], ['status', '=', 1]])
                            ->get();
		// Get opened tickets data
        $open_tickets = DB::table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['user_id', '=', $userId],
                                ['status', '=', 1],
                                ])->limit(6)->get();
         // Get answered tickets data
        $answered_tickets = DB::table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['user_id', '=', $userId],
                                ['status', '=', 2],
                                ])->limit(6)->get();
        // Get closed tickets data                         
        $closed_tickets = DB::table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['user_id', '=', $userId],
                                ['status', '=', 3],
                                ])->get(); 

		 return view('web.tickets.dashboard', ['open_tickets'=>$open_tickets, 
                                      'answered_tickets'=>$answered_tickets,
                                       'closed_tickets'=>$closed_tickets,
                                       'answered_tickets_count' => $answered_tickets_count,
                                       'open_tickets_count' => $open_tickets_count])->with('result', $result);
	}

	public function view_tickets(Request $request)
	{
		$userId = auth()->guard('customer')->user()->id;
		$result['commonContent'] = $this->index->commonContent();

        $all_tickets_count = DB::table('tickets')
            ->where([['user_id', '=', $userId]])
            ->get();

        $answered_tickets_count = DB::table('tickets')
            ->where([['user_id', '=', $userId], ['status', '=', 2]])
            ->get();

        $open_tickets_count = DB::table('tickets')
            ->where([['user_id', '=', $userId], ['status', '=', 1]])
            ->get();

        $closed_tickets_count = DB::table('tickets')
            ->where([['user_id', '=', $userId], ['status', '=', 3]])
            ->get();

        $all_tickets = DB::table('tickets')
            ->orderByDesc('id')
            ->where('user_id', $userId)
            ->paginate(10, ['*'], 'all');

        $open_tickets = DB::table('tickets')
            ->orderByDesc('id')
            ->where([['user_id', '=', $userId], ['status', '=', 1]])
            ->paginate(10, ['*'], 'opened');

        $answered_tickets = DB::table('tickets')
            ->orderByDesc('id')
            ->where([['user_id', '=', $userId], ['status', '=', 2]])
            ->paginate(10, ['*'], 'answered');

        $closed_tickets = DB::table('tickets')
            ->orderByDesc('id')
            ->where([['user_id', '=', $userId], ['status', '=', 3]])
            ->paginate(10, ['*'], 'closed');

        return view('web.tickets.tickets',
            ['open_tickets' => $open_tickets, 'answered_tickets' => $answered_tickets,
                'closed_tickets' => $closed_tickets, 'all_tickets' => $all_tickets,
                'all_tickets_count' => $all_tickets_count, 'answered_tickets_count' => $answered_tickets_count,
                'open_tickets_count' => $open_tickets_count, 'closed_tickets_count' => $closed_tickets_count])->with('result', $result);
	}

	public function search(Request $request)
    {
        $userId =auth()->guard('customer')->user()->id;
        $result['commonContent'] = $this->index->commonContent();
        $q = $request->input('q');
        if ($q) {
            $all_tickets = DB::table('tickets')
            	->where([['user_id', '=', $userId], ['subject', 'LIKE', '%' . $q . '%']])
                ->orWhere([['user_id', '=', $userId], ['id', 'like', '%' . $q . '%']])
                ->orWhere([['user_id', '=', $userId], ['product', 'like', '%' . $q . '%']])
                //->withCount('replies')
                ->orderbyDesc('id')
                ->get();
            return view('web.tickets.search', ['all_tickets' => $all_tickets])->with('result', $result);
        } else {
            return redirect('/view_tickets');
        }

    }

    public function ViewTicketData($id) {

        $userId = auth()->guard('customer')->user()->id;
        $result['commonContent'] = $this->index->commonContent();

        $ticket = DB::table('tickets') 
                     ->where([['user_id', '=', $userId]])
                     ->find($id);

 
        $replies =DB::table('replies')
        		->where('ticket_id',$id)->get();

        $update = DB::table('tickets')
                        ->where('id', $id)
                        ->where('user_id', $userId)
                        ->update(['notice' => 1]);

        
        if ($ticket === null) {

            return redirect()->back();

        }else {
            
             return view('web.tickets.ticket', ['ticket' => $ticket, 'replies'=>$replies])->with('result', $result);
        }       

       
    }

    public function AddTicketData(Request $request)
    {
    	$validate = $request->validate(
            ['replay_body' => ['required', 'string', 'max:1000'], 
             'replay_file' => ['max:2048', 'mimes:jpg,png,jpeg,pdf']]);

    	 if($request['ticket_id']) {

    	 	$userId = auth()->guard('customer')->user()->id;

    	 	 $ticket = DB::table('tickets')
               ->where('id', $request['ticket_id'])
               ->where('user_id', $userId)
               ->get();
             if($ticket->count() > 0) {
             	$status = 1;

             	$update = DB::table('tickets')
                        ->where('id', $request['ticket_id'])
                        ->update(['status' => $status ]);
                if($request->replay_file == null) {
                	//insert data into customer
		                $customers_id = DB::table('replies')->insertGetId([
		                    'user_id' => $userId,
		                    'ticket_id' => $request['ticket_id'],
		                    'replay_body' => strip_tags($request['replay_body']),
                            'created_at'=> date('Y-m-d H:i:s'),
		                ]);
                }else{
                	 $fileName = time() . '.' . $request->replay_file->getclientoriginalextension();
                	 $request->replay_file->move('uploads/replies/' , $fileName);

                	 //insert data into customer
		                $customers_id = DB::table('replies')->insertGetId([
		                    'user_id' => $userId,
		                    'ticket_id' => $request['ticket_id'],
		                    'replay_body' => strip_tags($request['replay_body']),
		                    'replay_file' => $fileName,
                            'created_at'=> date('Y-m-d H:i:s'),
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
    	$userId = auth()->guard('customer')->user()->id;

        if($request['ticket_id']) {
            
            $status = 3;
            
            $update = DB::table('tickets')
               ->where('id', $request['ticket_id'])
               ->where('user_id', $userId)
               ->update(['status' => $status]);

        }elseif($request['ticketId']) {

            $status = 1;

            $update = DB::table('tickets')
               ->where('id', $request['ticketId'])
               ->where('user_id', $userId)
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
    	$products = DB::table('tickets_products')->where('status', 1)->orderByDesc('id')
            ->get();
            $result['commonContent'] = $this->index->commonContent();
        return view('web.tickets.open-ticket', ['products' => $products])->with('result', $result);
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
        	 $product = DB::table('tickets_products')->where([['product_name', '=', $request['product']]])->get();
        	 if ($product->count() > 0)
        	 {
        	 	$userId = auth()->guard('customer')->user()->id;
        	 	if ($request->attachfile == null)
        	 	{
        	 		//insert data into customer
		                $customers_id = DB::table('tickets')->insertGetId([
		                    'user_id' => $userId,
		                    'subject' => strip_tags($request['subject']),
		                    'product' => $request['product'],
		                    'description'=> strip_tags($request['description']),
                            'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request['priority'],
		                ]);
        	 	}else{
        	 		$fileName = time() . '.' . $request->attachfile->getclientoriginalextension();
                    $request->attachfile->move('uploads/tickets/' , $fileName);

                    //insert data into customer
		                $customers_id = DB::table('tickets')->insertGetId([
		                    'user_id' => $userId,
		                    'subject' => strip_tags($request['subject']),
		                    'product' => $request['product'],
		                    'description'=> strip_tags($request['description']),
		                    'attachfile'=> $fileName,
		                    'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request['priority'],
		                   ]);
        	 	}
        	 	return redirect()->intended('ticket/'.$customers_id);
        	 }else{
        	 	return redirect()->back();
        	 }
        }
    }

    public function Notifications(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();
    	return view('web.tickets.notifications')->with('result', $result);
    }
}
?>