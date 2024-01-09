<?php
namespace App\Http\Controllers\App;
use Validator;
use Mail;
use DateTime;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Ticket;

class TicketsController extends Controller
{
	public function tickets(Request $request)
	{
		$tickets = Ticket::tickets($request);
		print $tickets;
	}
	public function ticketsCount(Request $request)
	{
		$ticketsCount = Ticket::ticketsCount($request);
		print $ticketsCount;
	}
	public function viewTickets(Request $request)
	{
		$viewTickets = Ticket::viewTickets($request);
		print $viewTickets;
	}
	public function viewTicketData(Request $request)
	{
		$viewTicketData = Ticket::viewTicketData($request);
		print $viewTicketData;
	}
	public function addTicketData(Request $request)
	{
		$addTicketData = Ticket::addTicketData($request);
		print $addTicketData;
	}
	public function UpdateTicketData(Request $request)
	{
		$UpdateTicketData = Ticket::UpdateTicketData($request);
		print $UpdateTicketData;
	}
	public function InsertTicket(Request $request)
	{
		$InsertTicket = Ticket::InsertTicket($request);
		print $InsertTicket;
	}
	public function viewTicketProduct(Request $request)
	{
		$viewTicketProduct = Ticket::viewTicketProduct($request);
		print $viewTicketProduct;
	}
	public function ticketNotification(Request $request)
	{
		$ticketNotification = Ticket::ticketNotification($request);
		print $ticketNotification;
	}
}
?>