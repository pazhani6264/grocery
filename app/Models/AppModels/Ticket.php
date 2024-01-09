<?php
namespace App\Models\AppModels;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminSiteSettingController;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use App\Models\Web\Products;

use DB;
use Lang;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon\Carbon;
use Session;

class Ticket extends Model{

	public static function tickets($request){
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          }else{
          	$user = DB::table('users')->where('id', $request->customer_id)->first();
          	if($user){
          		$userId=$request->customer_id;
          		// Opened tickets count
        			$open_tickets= DB::table('tickets')
                            ->where([['user_id', '=', $userId], ['status', '=', 1]])
                            ->get();
                    $open_tickets_count=$open_tickets->count();

                   // Answered tickets count
        			$answered_tickets = DB::table('tickets')
                            ->where([['user_id', '=', $userId], ['status', '=', 2]])
                            ->get();
                    $answered_tickets_count=$answered_tickets->count();

                    // Get closed tickets data                         
        			$closed_tickets = DB::table('tickets')
        						->orderBy('id', 'DESC')->where([
                                ['user_id', '=', $userId],
                                ['status', '=', 3],
                                ])->get();
        			$closed_tickets_count=$closed_tickets->count();

        			$responseData = array('success'=>'1','open_tickets_count'=>$open_tickets_count,'answered_tickets_count'=>$answered_tickets_count,'closed_tickets_count'=>$closed_tickets_count,'open_tickets'=>$open_tickets,'answered_tickets'=>$answered_tickets,'message'=>"View all tickets.");

          	}else{
          		 $responseData = array('data'=>array(),'success'=>'0','message'=>"You're not a customer..");
          	}
          }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}

	public static function ticketsCount($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$user = DB::table('users')->where('id', $request->customer_id)->first();
          		if($user){

          			$userId=$request->customer_id;

          			$all_count = DB::table('tickets')
		            ->where([['user_id', '=', $userId]])
		            ->get();
		            $all_tickets_count=$all_count->count();

		            $open_count = DB::table('tickets')
		            ->where([['user_id', '=', $userId], ['status', '=', 1]])
		            ->get();
		            $open_tickets_count=$open_count->count();

		            $answered_count = DB::table('tickets')
            		->where([['user_id', '=', $userId], ['status', '=', 2]])
            		->get();
            		$answered_tickets_count=$answered_count->count();

            		$closed_count = DB::table('tickets')
		            ->where([['user_id', '=', $userId], ['status', '=', 3]])
		            ->get();
		            $closed_tickets_count=$closed_count->count();

		            $responseData = array('success'=>'1','all_tickets_count'=>$all_tickets_count,'open_tickets_count'=>$open_tickets_count,'answered_tickets_count'=>$answered_tickets_count,'closed_tickets_count'=>$closed_tickets_count,'message'=>"View all tickets count.");

          		}else{
          			$responseData = array('success'=>'0','message'=>"You're not a customer..");
          		}	
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");	
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}

	public static function viewTickets($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->type == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          	   $user = DB::table('users')->where('id', $request->customer_id)->first();
          	   if($user){
          	   		$userId=$request->customer_id;
          	   		if($request->type=='all'){
          	   			$tickets = DB::table('tickets')
			            ->orderByDesc('id')
			            ->where('user_id', $userId)
			            ->paginate(100, ['*'], 'all');
          	   		}else if($request->type=='opened'){
          	   			 $tickets = DB::table('tickets')
			            ->orderByDesc('id')
			            ->where([['user_id', '=', $userId], ['status', '=', 1]])
			            ->paginate(100, ['*'], 'opened');
          	   		}else if($request->type=='answered'){
          	   			$tickets = DB::table('tickets')
			            ->orderByDesc('id')
			            ->where([['user_id', '=', $userId], ['status', '=', 2]])
			            ->paginate(100, ['*'], 'answered');
          	   		}else if($request->type=='closed'){
          	   			$tickets = DB::table('tickets')
			            ->orderByDesc('id')
			            ->where([['user_id', '=', $userId], ['status', '=', 3]])
			            ->paginate(100, ['*'], 'closed');
          	   		}
          	   		if (!$tickets->isEmpty()) { 
          	   			foreach ($tickets as $jestickets) {
          	   				$all_ticket_count = DB::table('replies')->where('ticket_id', '=', $jestickets->id)->get();
                			$all_replies_count = $all_ticket_count->count();
          	   				$dataall[]=array(
			                    'id'=>$jestickets->id,
			                    'subject' => $jestickets->subject,
			                    'created_at' => $jestickets->created_at,
			                    'product' => $jestickets->product,
			                    'status'=> $jestickets->status,
			                    'replies_count'=>$all_replies_count
			                 );
          	   			}
          	   			$responseData = array('success'=>'1', 'data'=>$dataall,  'message'=>"Return all tickets.");
          	   		}else{
          	   			$responseData = array('success'=>'0','data'=>array(),'message'=>"No data found");
          	   		}
          	   }else{
          	   	 $responseData = array('success'=>'0','data'=>array(),'message'=>"You're not a customer..");
          	   }	
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}

	public static function viewTicketData($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->ticket_id == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$user = DB::table('users')->where('id', $request->customer_id)->first();
          		if($user){
          			$userId=$request->customer_id;
          			 $ticket = DB::table('tickets')->where('user_id', $userId)->where('id', $request->ticket_id)->first();
          			 if($ticket){
          			 	$replies =DB::table('replies')
          			 	->join('users', 'users.id', '=', 'replies.user_id')
          			 	->select('replies.*', 'users.role_id', 'users.first_name', 'users.last_name')
          			 	->where('ticket_id',$request->ticket_id)
          			 	->get();
          			 	$update = DB::table('tickets')
		                        ->where('id', $request->ticket_id)
		                        ->where('user_id', $userId)
		                        ->update(['notice' => 1]);
		                $responseData = array('success'=>'1', 'ticket'=>$ticket, 'replies'=>$replies,'message'=>"Return all tickets.");
          			 }else{
          			 	$responseData = array('success'=>'0','data'=>array(),'message'=>"Invalid ticket id");
          			 }
          		}else{
          			$responseData = array('success'=>'0','data'=>array(),'message'=>"You're not a customer..");
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}
	public static function addTicketData($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->ticket_id == '' || $request->replay_body == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$user = DB::table('users')->where('id', $request->customer_id)->first();
          		if($user){
          			$userId=$request->customer_id;
          			$ticket = DB::table('tickets')->where('user_id', $userId)->where('id', $request->ticket_id)->first();
          			 if($ticket){
          				$status = 1;
          				$update = DB::table('tickets')
	                        ->where('id', $request->ticket_id)
	                        ->update(['status' => $status ]);
	                    if($request->replay_file == null) {
	                    	//insert data into customer
	                    	$customers_id = DB::table('replies')->insertGetId([
			                    'user_id' => $userId,
			                    'ticket_id' => $request->ticket_id,
			                    'replay_body' => strip_tags($request->replay_body),
	                            'created_at'=> date('Y-m-d H:i:s'),
		                	]);
	                    }else{
	                    	 $fileName = time() . '.' . $request->replay_file->getclientoriginalextension();
	                    	  $request->replay_file->move('uploads/replies/' , $fileName);

	                    	  //insert data into customer
			                $customers_id = DB::table('replies')->insertGetId([
			                    'user_id' => $userId,
			                    'ticket_id' => $request->ticket_id,
			                    'replay_body' => strip_tags($request->replay_body),
			                    'replay_file' => $fileName,
	                            'created_at'=> date('Y-m-d H:i:s'),
			                ]);
	                    }
	                    $responseData = array('success'=>'1','message'=>"Your reply has been submitted");
          			 }else{
          			 	$responseData = array('success'=>'0','message'=>"Invalid ticket id");
          			 }
          		}else{
          			$responseData = array('success'=>'0','message'=>"You're not a customer..");	
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}
	public static function UpdateTicketData($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->ticket_id == '' || $request->type == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$userId=$request->customer_id;
          		$ticket = DB::table('tickets')->where('user_id', $userId)->where('id', $request->ticket_id)->first();
          		if($ticket){
          			if($request->type=='close'){
          				$status = 3;
			            $update = DB::table('tickets')
			               ->where('id', $request->ticket_id)
			               ->where('user_id', $userId)
			               ->update(['status' => $status]);
			            $message='Ticket closed successfully';
          			}elseif($request->type=='reopen'){
          				$status = 1;
			            $update = DB::table('tickets')
			               ->where('id', $request->ticket_id)
			               ->where('user_id', $userId)
			               ->update(['status' => $status]);
			           $message='Ticket re-open successfully';     
          			}
          			$responseData = array('success'=>'1','message'=>$message);
          		}else{
          			$responseData = array('success'=>'0','message'=>"Invalid ticket id");
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");	
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}

	public static function InsertTicket($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' || $request->subject == '' || $request->product == '' || $request->priority == '' || $request->description == ''){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$user = DB::table('users')->where('id', $request->customer_id)->first();
          		if($user){
          			if ($request->attachfile == null){
          				//insert data into customer
          				$customers_id = DB::table('tickets')->insertGetId([
		                    'user_id' => $request->customer_id,
		                    'subject' => strip_tags($request->subject),
		                    'product' => $request->product,
		                    'description'=> strip_tags($request->description),
                            'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request->priority,
		                ]);
          			}else{
          			 //insert data into customer
          			 	$fileName = time() . '.' . $request->attachfile->getclientoriginalextension();
                    	$request->attachfile->move('uploads/tickets/' , $fileName);

                    	$customers_id = DB::table('tickets')->insertGetId([
		                    'user_id' => $request->customer_id,
		                    'subject' => strip_tags($request->subject),
		                    'product' => $request->product,
		                    'description'=> strip_tags($request->description),
		                    'attachfile'=> $fileName,
		                    'created_at'=> date('Y-m-d H:i:s'),
                            'priority'=> $request->priority,
		                   ]);
          			}
          		 $responseData = array('success'=>'1','message'=>"New ticket inserted successfully");
          		}else{
          		$responseData = array('success'=>'0','message'=>"You're not a customer..");	
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}

	public static function viewTicketProduct($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			$product = DB::table('tickets_products')->get();
			if (!$product->isEmpty()) {
				$responseData = array('success'=>'1', 'data'=>$product,  'message'=>"Return all product.");
			 }else{
			 	$responseData = array('success'=>'0','data'=>array(),'message'=>"No data found");
			 }
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}
	public static function ticketNotification($request)
	{
		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){
			if($request->customer_id == '' ){
               $responseData = array('success'=>'0','message'=>"Required all Fields.");
          	}else{
          		$user = DB::table('users')->where('id', $request->customer_id)->first();
          		if($user){
          			$notice = DB::table('tickets')
	                ->where('user_id', $request->customer_id)
	                ->where('notice', 2)
	                ->get();
	                $count=$notice->count();
	                $responseData = array('success'=>'1', 'note_count'=>$count, 'data'=>$notice,  'message'=>"Return all notification.");
          		}else{
          		$responseData = array('success'=>'0','message'=>"You're not a customer..");
          		}
          	}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$ticketResponse = json_encode($responseData);
		return $ticketResponse;
	}
}