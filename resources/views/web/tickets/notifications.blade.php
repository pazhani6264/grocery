@extends('web.tickets.layouts.default')
@section('title', 'Notifications')
@section('content')
@php
             $notice = DB::table('tickets')
                ->where('user_id', auth()->guard('customer')->user()->id)
                ->where('notice', 2)
                ->get();
          @endphp
<div class="page__title ticket-common-bg">
  <h1>{{ __('Notifications ('.$notice->count()).')' }}</h1>
</div>
<div class="fowtickets__main__content mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">

        @if($notice->count() > 0)
        @foreach($notice as $note)
        <div class="user_notice" onclick="window.location.href='{{url('ticket')}}/{{$note->id}}'">
          <div class="row">
            <div class="col-lg-2 text-center  d-none d-lg-block">
              <img src="{{ asset('images/tickets/bell.svg') }}" alt="Notifications">
            </div>
            <div class="col-lg-10">
              <span class="notice-text text-muted">{{__('New reply on your tiket')}}</span>
              <h5>{{$note->subject}}</h5>
            </div>
          </div>
        </div>
        @endforeach
        @else 
        <div class="text-center pt-3 pb-3 bg-white">
            <span class="text-muted">{{ __('You dont have Notifications')}}</span>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@stop