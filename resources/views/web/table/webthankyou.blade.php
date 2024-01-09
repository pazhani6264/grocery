@extends('web.tablelayout')
@section('content')

<section class="pro-content empty-content" style="padding-top:50px;">

  <div class="container">
      @if(session('tablepaystatus') == '2')
      <div class="row">
        <div class="col-12">
            <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa-check-circle"></i></h2>
              <h1 >@lang('website.Thank You')</h1>
              <p>
              @lang('website.You have successfully place your order')
                <a href="{{url('/orderhistory')}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>
        </div>
      </div>
      @elseif(session('tablepaystatus') == '1')
        <div class="row">
         <div class="col-12">
        <div class="pro-empty-page">
              <h2 style="font-size: 150px;"><i class="far fa fa-ban"></i></h2>
              <h1 >@lang('website.Sorry')</h1>
              <p>
              @lang('website.Your online payment failed')
                <a href="{{url('/orderhistory')}}" class="btn-link"><b>@lang('website.Order Detail')</b></a>
              </p>
            </div>
            </div>
      </div>
      @endif
  </div>    
</section> 

@endsection
