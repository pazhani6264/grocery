@extends('admin.support.layouts.default')
@section('title', 'Dashboard')
@section('content')
<div class="page__title ticket-common-bg">
	<h1>{{ __('Welcome back '.auth()->user()->first_name).' !'}}</h1>
</div>
<div class="fowtickets__main__content">
	<div class="container">
		<div class="fowtickets__boxes">
			<div class="row">
				<div class="bbx col-lg-4">
					<div class="box ticket-common-bg ticket-margin-b15">
						<h1>{{$open_tickets_count->count()}}</h1>
						<p>{{ __('Opened Tickets')}}</p>
					</div>
				</div>
				<div class="bbx col-lg-4">
					<div class="box ticket-common-bg ticket-margin-b15">
						<h1>{{$answered_tickets_count->count()}}</h1>
						<p>{{ __('Answered Tickets')}}</p>
					</div>
				</div>
				<div class="bbx col-lg-4">
					<div class="box ticket-common-bg">
						<h1>{{$closed_tickets->count()}}</h1>
						<p>{{ __('Closed Tickets')}}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="fowtickets__last__tickets">
			<div class="row">
				<div class="col-lg-4">
					<div class="card edit-card">
						<div class="card-header">
							<i class="fa fa-folder-open" aria-hidden="true" style="color:#ff641a;"></i>
							{{ __('Last Opened Tickets')}}
							<span class="float-right">
								<a href="{{url('admin/support/view_tickets#opened')}}" class="btn btn-outline-primary btn-sm">{{ __('View all')}}</a>
							</span>
						</div>
						<div class="card-body">
							@if($open_tickets->count())
							@foreach($open_tickets as $open_ticket)
							<div class="ticket" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$open_ticket->id}}'">
								<div class="row">
									<div class="col-lg-8">
										<h5>{{$open_ticket->subject}}</h5>
									</div>
									<div class="col-lg-4">
										@if($open_ticket->status == 1)
										<span class="float-right badge badge-pill badge-primary">{{ __('Opened')}}</span>
										@elseif($open_ticket->status == 2)
										<span class="float-right badge badge-pill badge-success">{{ __('Answered')}}</span>
										@elseif($open_ticket->status == 3)
										<span class="float-right badge badge-pill badge-danger">{{ __('Closed')}}</span>
										@endif
									</div>
								</div>
								<small class="text-muted ppx"><i class="fa fa-info-circle"></i> {{__('Ticket ID : '.$open_ticket->id)}}</small>
								<small class="text-muted ppx"><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($open_ticket->created_at)->diffForHumans() }}</small>
								<small class="text-muted"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$open_ticket->product}} </small>
							</div>
							@endforeach
							@else
							<div class="text-center pt-3 pb-3">
								<span class="text-muted">{{ __('No data found')}}</span>
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card edit-card">
						<div class="card-header">
							<i class="fa fa-envelope-open" aria-hidden="true" style="color:#ff641a;"></i>
							{{__('Last Answered Tickets')}} <span class="float-right"><a href="{{url('admin/support/view_tickets#answered')}}" class="btn btn-outline-primary btn-sm">{{ __('View all')}}</a></span></div>
							<div class="card-body">
								@if($answered_tickets->count())
								@foreach($answered_tickets as $answered_ticket)
								<div class="ticket" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$answered_ticket->id}}'">
									<div class="row">
										<div class="col-lg-8">
											<h5>{{$answered_ticket->subject}}</h5>
										</div>
										<div class="col-lg-4">
											@if($answered_ticket->status == 1)
											<span class="float-right badge badge-pill badge-primary">{{ __('Opened')}}</span>
											@elseif($answered_ticket->status == 2)
											<span class="float-right badge badge-pill badge-success">{{ __('Answered')}}</span>
											@elseif($answered_ticket->status == 3)
											<span class="float-right badge badge-pill badge-danger">{{ __('Closed')}}</span>
											@endif
										</div>
									</div>
									<small class="text-muted ppx"><i class="fa fa-info-circle"></i> {{__('Ticket ID : '.$answered_ticket->id)}}</small>
									<small class="text-muted ppx"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($answered_ticket->created_at)->diffForHumans() }}</small>
									<small class="text-muted"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$answered_ticket->product}} </small>
								</div>
								@endforeach
								@else
								<div class="text-center pt-3 pb-3">
									<span class="text-muted">{{ __('No data found')}}</span>
								</div>
								@endif
							</div>
						</div>
					</div>
				

				<div class="col-lg-4">
					<div class="card edit-card">
						<div class="card-header">
							<i class="fa fa-envelope-open" aria-hidden="true" style="color:#ff641a;"></i>
							
							{{__('Last Closed Tickets')}} <span class="float-right"><a href="{{url('admin/support/view_tickets#closed')}}" class="btn btn-outline-primary btn-sm">{{ __('View all')}}</a></span></div>
							<div class="card-body">
							@if($closed_tickets->count())
          @foreach($closed_tickets as $closed_ticket)
								<div class="ticket" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$closed_ticket->id}}'">
									<div class="row">
										<div class="col-lg-8">
											<h5>{{$closed_ticket->subject}}</h5>
										</div>
										<div class="col-lg-4">
											@if($closed_ticket->status == 1)
											<span class="float-right badge badge-pill badge-primary">{{ __('Opened')}}</span>
											@elseif($closed_ticket->status == 2)
											<span class="float-right badge badge-pill badge-success">{{ __('Answered')}}</span>
											@elseif($closed_ticket->status == 3)
											<span class="float-right badge badge-pill badge-danger">{{ __('Closed')}}</span>
											@endif
										</div>
									</div>
									<small class="text-muted ppx"><i class="fa fa-info-circle"></i> {{__('Ticket ID : '.$closed_ticket->id)}}</small>
									<small class="text-muted ppx"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($closed_ticket->created_at)->diffForHumans() }}</small>
									<small class="text-muted"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$closed_ticket->product}} </small>
								</div>
								@endforeach
								@else
								<div class="text-center pt-3 pb-3">
									<span class="text-muted">{{ __('No data found')}}</span>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>


				</div>
			</div>
		</div>
	</div>
</div>
@stop

<style>
	@media screen and (max-width: 768px)
{
.ticket-margin-b15
{
	margin-bottom:15px;
}

}
</style>