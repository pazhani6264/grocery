@extends('admin.support.layouts.default')
@section('title', 'Search for '.app('request')->input('q'))
@section('content')
<div class="page__title ticket-common-bg">
   <h1>{{ __('Search results for "'.app('request')->input('q').'"') }}</h1>
</div>
<div class="fowtickets__main__content mb-5">
   <div class="container">
    <h4>{{__($all_tickets->count().' Results found')}}</h4>
    <hr/>
    <form action="{{ URL::to('admin/support/search')}}" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="q" class="form-control" placeholder="Enter ticket id, subject, product...">
            <div class="input-group-append">
              <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> {{__('Search')}}</button>
            </div>
        </div>
        </form>
      @if($all_tickets->count() > 0)
      <div class="card fowtickets__all__tickets">
         @foreach($all_tickets as $all_ticket)
         <div class="ticket ppdo" onclick="window.location.href='{{url('admin/support/ticket')}}/{{$all_ticket->id}}'">
            <div class="row">
               <div class="col-lg-1">
                 @php
                $all_ticket_count = \DB::table('replies')->where('ticket_id', '=', $all_ticket->id)->get();
                $all_replies_count = $all_ticket_count->count();
                //print_r($all_replies_count);die();
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
      </div>
      @else 
      <div class="note note-info text-center">
          {{__('No data fount "'.$all_tickets->count().'"')}}
      </div>
      @endif
   </div>
</div>
@stop