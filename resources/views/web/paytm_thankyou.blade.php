@extends('web.layout')
@section('content')

<section class="pro-content empty-content">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="pro-empty-page">
          <h2 style="font-size: 150px;"><i class="far fa fa-ban"></i></h2>
          <h1 >@lang('website.Sorry')</h1>
          <p>
            @lang('website.Your online payment failed')
            <a href="{{url('/viewcart/')}}" class="btn-link"><b>@lang('website.Shopping cart')</b></a>
          </p>
        </div>  
      </div>
    </div> 
  </div>  
</section> 

@endsection
