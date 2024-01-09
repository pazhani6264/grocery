@extends('admin.support.layouts.default')
@section('title', 'Tickets')
@section('content')
<div class="page__title ticket-common-bg">
	<h1>{{ __('All Tickets') }}</h1>
</div>
<div class="fowtickets__main__content mb-5">
  <div class="container">
    <form action="{{ URL::to('admin/support/search')}}" method="GET"> 
      <div class="input-group mb-3">
        <input type="text" name="q" class="form-control" placeholder="Enter ticket id, subject, product...">
          <div class="input-group-append">
            <button class="btn btn-primary btn-secondary" type="submit"><i class="fa fa-search"></i> {{__('Search')}}</button>
          </div>
      </div>
    </form>
    <div class="fowtickets__all__tickets">
      <ul class="nav nav-tabs" id="Tabs" role="tablist">
        <li class="nav-item width-50">
          <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">{{ __('All Tickets') }} <span class="count bg-dark">{{$all_tickets_count->count()}}</span></a>
        </li>
        <li class="nav-item width-50">
          <a class="nav-link" id="opened-tab" data-toggle="tab" href="#opened" role="tab" aria-controls="opened" aria-selected="true">{{ __('Opened Tickets') }} <span class="count bg-primary">{{$open_tickets_count->count()}}</span></a>
        </li>
        <li class="nav-item width-50">
          <a class="nav-link" id="answered-tab" data-toggle="tab" href="#answered" role="tab" aria-controls="answered" aria-selected="false">{{ __('Answered Tickets') }} <span class="count bg-success">{{$answered_tickets_count->count()}}</span></a>
        </li>
        <li class="nav-item width-50">
          <a class="nav-link" id="closed-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">{{ __('Closed Tickets') }} <span class="count bg-danger">{{$closed_tickets_count->count()}}</span></a>
        </li>
      </ul>
      <div class="tab-content" id="TabsContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
          @if($all_tickets->count())
          @foreach($all_tickets as $all_ticket)
        <div class="ticket ppdo" onclick="window.location.href='{{URL::to('admin/support/ticket')}}/{{$all_ticket->id}}'">
            <div class="row">
              <div class="col-lg-1">
                 @php
                $all_ticket_count = \DB::table('replies')->where('ticket_id', '=', $all_ticket->id)->get();
                $all_replies_count = $all_ticket_count->count();
                //print_r($replies_count);die();
                @endphp
                <div class="response @if($all_replies_count == 0) bg-red @else bg-green @endif">
                  <h1>{{$all_replies_count}}</h1>
                </div>
              </div>
              <div class="col-lg-7">
                <h3>{{$all_ticket->subject}}</h3>
                <span class="info"><i class="fa fa-info-circle"></i> {{ __('Ticket ID: ')}} {{$all_ticket->id}} </span>
                <span class="info"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($all_ticket->created_at)->diffForHumans() }}</span>
                <span class="info"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$all_ticket->product}} </span>
              </div>
              <div class="col-lg-4 text-center">
                @if($all_ticket->status == 1)
                <span class="float-right badge badge-pill badge-primary">{{ __('Opened')}}</span>
                @elseif($all_ticket->status == 2)
                <span class="float-right badge badge-pill badge-success">{{ __('Answered')}}</span>
                @elseif($all_ticket->status == 3)
                <span class="float-right badge badge-pill badge-danger">{{ __('Closed')}}</span>
                @endif
              </div>
            </div>
          </div>
          @endforeach
          <div class="pages">
            {{$all_tickets->fragment('all')->render()}}
          </div>
          @else
          <div class="text-center pt-3 pb-3">
            <span class="text-muted">{{ __('No data found')}}</span>
          </div>
          @endif
        </div>
        <div class="tab-pane fade" id="opened" role="tabpanel" aria-labelledby="opened-tab">
          @if($open_tickets->count())
          @foreach($open_tickets as $open_ticket)
          <div class="ticket ppdo" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$open_ticket->id}}'">
            <div class="row">
              <div class="col-lg-1">
                @php
                $open_ticket_count = \DB::table('replies')->where('ticket_id', '=', $open_ticket->id)->get();
                $open_replies_count = $open_ticket_count->count();
                //print_r($open_ticket_count);die();
                @endphp
                <div class="response @if($open_replies_count == 0) bg-red @else bg-green @endif">
                  <h1>{{$open_replies_count}}</h1>
                </div>
              </div>
              <div class="col-lg-7">
                <h3>{{$open_ticket->subject}}</h3>
                <span class="info"><i class="fa fa-info-circle"></i> {{ __('Ticket ID: ')}} {{$open_ticket->id}} </span>
                <span class="info"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($open_ticket->created_at)->diffForHumans() }}</span>
                <span class="info"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$open_ticket->product}}</span>
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
          </div>
          @endforeach
          <div class="pages">
            {{$open_tickets->fragment('opened')->render()}}
          </div>
          @else
          <div class="text-center pt-3 pb-3">
            <span class="text-muted">{{ __('No data found')}}</span>
          </div>
          @endif
        </div>
        <div class="tab-pane fade" id="answered" role="tabpanel" aria-labelledby="answered-tab">
          @if($answered_tickets->count())
          @foreach($answered_tickets as $answered_ticket)
          <div class="ticket ppdo" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$answered_ticket->id}}'">
            <div class="row">
               <div class="col-lg-1">
                @php
                $answered_ticket_count = \DB::table('replies')->where('ticket_id', '=', $answered_ticket->id)->get();
                $answered_replies_count = $answered_ticket_count->count();
                //print_r($open_ticket_count);die();
                @endphp
                 <div class="response @if($answered_replies_count == 0) bg-red @else bg-green @endif">
                  <h1>{{$answered_replies_count}}</h1>
                </div>
              </div>
              <div class="col-lg-7">
                <h3>{{$answered_ticket->subject}}</h3>
                <span class="info"><i class="fa fa-info-circle"></i> {{ __('Ticket ID: ')}} {{$answered_ticket->id}} </span>
                <span class="info"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($answered_ticket->created_at)->diffForHumans() }} </span>
                <span class="info"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$answered_ticket->product}} </span>
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
          </div>
          @endforeach
          <div class="pages">
            {{$answered_tickets->fragment('answered')->render()}}
          </div>
          @else
          <div class="text-center pt-3 pb-3">
            <span class="text-muted">{{ __('No data found')}}</span>
          </div>
          @endif
        </div>
        <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
          @if($closed_tickets->count())
          @foreach($closed_tickets as $closed_ticket)
          <div class="ticket ppdo" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$closed_ticket->id}}'">
            <div class="row">
              <div class="col-lg-1">
                @php
                $closed_ticket_count = \DB::table('replies')->where('ticket_id', '=', $closed_ticket->id)->get();
                $closed_replies_count = $closed_ticket_count->count();
                //print_r($open_ticket_count);die();
                @endphp
                 <div class="response @if($closed_replies_count == 0) bg-red @else bg-green @endif">
                  <h1>{{$closed_replies_count}}</h1>
                </div>
              </div>
              <div class="col-lg-7">
                <h3>{{$closed_ticket->subject}}</h3>
                <span class="info"><i class="fa fa-info-circle"></i> {{ __('Ticket ID: ')}} {{$closed_ticket->id}} </span>
                <span class="info"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($closed_ticket->created_at)->diffForHumans() }} </span>
                <span class="info"><i class="fa fa-archive"></i> {{ __('Product : ')}} {{$closed_ticket->product}} </span>
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
          </div>
          @endforeach
          <div class="pages">
            {{$closed_tickets->fragment('closed')->render()}}
          </div>
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
@stop