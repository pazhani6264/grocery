@extends('admin.support.layouts.default')
@section('title', 'View ticket No.#'.$ticket->id)
@section('content')
<div class="page__title ticket-common-bg">
	<h1>{{ __('Ticket No.#') }}{{$ticket->id}}</h1>
</div>
<div class="fowtickets__main__content mb-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				@if(session('success'))
					<div class="note note-success">
						<span class="icon"><i class="fa fa-check"></i></span>
					   {{session('success')}}
					</div>
				@endif
				<div class="card ticket-card mb-3">
					<div class="ticket__view__info">
						<span class="posted"><i class="fa fa-clock-o"></i> {{__('Posted at : ')}}{{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</span>
						<h3 class="card-title">{{$ticket->subject}}</h3>
						<p>{{$ticket->description}}</p>
						@if(!$ticket->attachfile == null)
						<a data-toggle="modal" data-target=".bd-example-modal-lg" href="" target="_blank" class="btn btn-link">
						<i class="fa fa fa-cloud-download"></i> {{ __('File attachment')}}</a>
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">{{ __('File attachment')}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="{{ $ticket->attachfile }}" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						@endif
					</div>
					@if($replies->count())
					<div class="card-body p-2">
						@foreach($replies as $reply)
						@php
						$user = \DB::table('users')->where('id', '=', $reply->user_id)->first();
						@endphp
						<div class="auth__reply @if($reply->shop_name == 'superadmin') bg-admin @else bg-user @endif">
						<span class="reply__posted"><i class="fa fa-clock-o"></i> {{__('Replied at :')}} {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
						<div class="reply-info">
						<div class="user-avatar-name">
						<img src="{{asset('/images/default-avatar.png')}}" width="40">
						<span class="user-name">
							@if($reply->shop_name == 'superadmin') 
								<span>Superadmin</span>
							@else
								{{$user->first_name}} {{$user->last_name}}
							@endif
							</span>
						</div>
						<p>{{$reply->replay_body}}</p>
						@if(!$reply->replay_file == null)
						<a data-toggle="modal" data-target=".replies{{ $reply->id }}" href="" target="_blank" class="btn btn-link">
						<i class="fa fa fa-cloud-download"></i> {{ __('File attachment')}}</a>
						<div class="modal fade bd-example-modal-lg replies{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">{{ __('File attachment')}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="{{ $reply->replay_file }}" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						@endif
						</div>
						</div>
						@endforeach
					</div>
					@else
					 <div class="text-center pt-3 pb-3">
                        <span class="text-muted">{{ __('No replies yet')}}</span>
                     </div>
					@endif
				</div>
				<div class="card mb-3">
					<div class="card-body">
						@if($ticket->status == 3)
						<div class="text-center pt-3 pb-3">
                           <span class="text-muted">{{ __('Your ticket is now closed you cannot add any reply')}}</span>
                        </div>
						@else
						<div class="replay__form">
							<form action="{{ URL::to('admin/support/ticket/store')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
								<div class="form-group">
									<label>{{ __('Your Replay :') }} <span class="fsgred">*</span></label>
									<textarea class="form-control @error('replay_body') is-invalid @enderror" rows="5" name="replay_body" required>{{ old('replay_body') }}</textarea>
									@error('replay_body')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="form-group">
									<label>{{ __('Attach File (optional) :') }}</label>
									<input type="file" name="replay_file" class="form-control @error('replay_file') is-invalid @enderror">
									<small class="text-muted">{{ __('Only allowed (JPEG, JPG, PNG, PDF)') }}</small>
									@error('replay_file')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<button class="btn btn-secondary" type="submit">{{ __('Submit') }}</button>
							</form>
						</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card ticket-card ticketview-info">
					<div class="card-body">
						@if(session('error'))
						<div class="note note-danger">
							{{session('error')}}
						</div>
						@endif
						<h4 class="card-title">{{ __('Ticket Information')}}</h4>
						<form action="{{ URL::to('admin/support/ticket/update')}}" method="POST">
							@csrf
							@if($ticket->status == 1 or $ticket->status == 2)
							<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
							<button type="submit" class="btn btn-secondary btn-sm">{{ __('Close Ticket')}}</button>
							@elseif($ticket->status == 3)
							<input type="hidden" name="ticketId" value="{{$ticket->id}}">
							<button type="submit" class="btn btn-success btn-sm">{{ __('Re-open Ticket')}}</button>
							@endif
						</form>
					</div>
					<ul class="list-group">
						<li class="list-group-item"><i class="fa fa-clock-o"></i> {{ __('Datetime :')}} <span class="float-right"><?=str_replace('-', '/', $ticket->created_at)?></span></li>
						<li class="list-group-item"><i class="fa fa-archive"></i> {{ __('Product :')}} <span class="float-right">{{$ticket->product}}</span></li>
						<li class="list-group-item"><i class="fa fa-hourglass-start"></i> {{ __('Ticket status :')}}
							@if($ticket->status == 1)
							<span class="float-right badge badge-pill badge-primary">{{ __('Opened')}}</span>
							@elseif($ticket->status == 2)
							<span class="float-right badge badge-pill badge-success">{{ __('Answered')}}</span>
							@elseif($ticket->status == 3)
							<span class="float-right badge badge-pill badge-danger">{{ __('Closed')}}</span>
							@endif
						</li>
						<li class="list-group-item"><i class="fa fa-fire"></i> {{__('Ticket priority  :')}}
							@if($ticket->priority == 1)
							<span class="float-right badge badge-pill badge-secondary">{{ __('Low')}}</span>
							@elseif($ticket->priority == 2)
							<span class="float-right badge badge-pill badge-warning">{{ __('high')}}</span>
							@elseif($ticket->priority == 3)
							<span class="float-right badge badge-pill badge-danger">{{ __('Urgent')}}</span>
							@endif
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop