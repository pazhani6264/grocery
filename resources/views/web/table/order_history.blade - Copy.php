<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title><?=stripslashes($result['commonContent']['settings']['website_name'])?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Include js plugin -->
       @include('web.common.scripts')
</head>
<style type="text/css">
   .navba {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navba a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navba a:hover {
  background: #ddd;
  color: black;
}
  @media only screen and (max-width: 600px){
    .col-sm-6{
		width:49%;
		display: inline-block;
	}
  }
</style>
<div class="navba">
  <a href="{{ URL::to('/qrcodeorder')}}" style="width: 85px;height: 50px;">
  @if($result['commonContent']['settings']['sitename_logo']=='logo')
  <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-mobile" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-mobile" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
  @endif
  </a>
  <a style="float: right;" href="{{url('/orderhistory')}}"><i class="fa fa-history" style="font-size: 4.8rem;" aria-hidden="true"></i></a>
</div><br><br><br>
<section class="pro-content empty-content" style="padding-top:50px;">
  
  @php
  $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first();
  @endphp
  <div class="container">
       <div class="row">
        <div class="col-md-12 table-responsive">
          <table class="table table-striped" style="background-color: white;">
             <thead>
              <tr>
                <th>{{ trans('labels.Qty') }}</th>
                <th>{{ trans('labels.Image') }}</th>
                <th>{{ trans('labels.ProductName') }}</th>
                <th>{{ trans('labels.ProductModal') }}</th>
                <th>{{ trans('labels.Options') }}</th>
                <th>{{ trans('labels.Price') }}</th>
              </tr>
              @foreach($data['orders_data'][0]->data as $products)
              @php
                 $imagepath = DB::table('image_categories')->where('path', '=', $products->image)->where('image_type', 'ACTUAL')->select('path_type')->first();
              @endphp
              <tr>
                <td>{{  $products->products_quantity }}</td>
                <td>
                    @if($imagepath->path_type == 'aws')
                      <img src="{{$products->image }}" width="60px"> <br>
                    @else
                      <img src="{{ asset('').$products->image }}" width="60px"> <br>
                    @endif
                </td>
                 <td  width="30%">
                    {{  $products->products_name }}<br>
                </td>
                <td>
                    {{  $products->products_model }}
                </td>
                <td>
                @foreach($products->attribute as $attributes)
                  <b>{{ trans('labels.Name') }}:</b> {{ $attributes->products_options }}<br>
                    <b>{{ trans('labels.Value') }}:</b> {{ $attributes->products_options_values }}<br>
                    <b>{{ trans('labels.Price') }}:</b> 
                    @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{ $attributes->options_values_price * $data['orders_data'][0]->currency_value }} @else  {{ $attributes->options_values_price * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                @endforeach</td>
                <td>
               
                  @if($symbol_left != '')
                 {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} @else  {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
                  </td>
              </tr>
              @endforeach
            </thead>
          </table>
        </div>
       </div>

       <div class="row">
        <div class="col-md-7">
        </div>
         <div class="col-md-5">
           <div class="table-responsive">
              <table class="table order-table" style="background-color: white;">
              <tr>
                <th style="width:50%">{{ trans('labels.Subtotal') }}:</th>
                <td>
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                  </td>
              </tr>
              
              <tr>
                <th>{{ trans('labels.Total') }}:</th>
                <td>
               @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                  </td>
              </tr>
            </table>
           </div>
         </div>
       </div>
        <input type="hidden" name="wamount" id="wamount" value="{{$data['subtotal']  * $data['orders_data'][0]->currency_value }}">
        <div class="col-12 col-sm-12 mb-3">
          <div class="row">
            <div class="heading" style="width:100%;">
              <h2>@lang('website.Payment Methods')</h2>
            <hr>
          </div>

          <div class="alert alert-danger error_payment" style="display:none" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           @lang('website.Please select your payment method')
         </div>
          <input id="payment_currency" type="hidden" onClick="paymentTable();" name="payment_currency" value="{{session('currency_code')}}">
          @foreach($result['payment_methods'] as $payment_methods)
          @if($payment_methods['active']==1)
          <input id="{{$payment_methods['payment_method']}}_public_key" type="hidden" name="public_key" value="{{$payment_methods['public_key']}}">
            <input id="{{$payment_methods['payment_method']}}_environment" type="hidden" name="{{$payment_methods['payment_method']}}_environment" value="{{$payment_methods['environment']}}">
            <div class="col-md-4 col-sm-6" style="height:100%;">
                                                    <input onClick="paymentTable();" id="{{$payment_methods['payment_method']}}_label" type="radio" name="payment_method" class="form-check-input payment_method" value="{{$payment_methods['payment_method']}}" @if(!empty(session('payment_method'))) @if(session('payment_method')==$payment_methods['payment_method']) checked @endif @endif>
                                                    <label class="form-check-label" for="{{$payment_methods['payment_method']}}_label">
                                                      @if(file_exists( 'web/images/miscellaneous/'.$payment_methods['payment_method'].'.png'))
                                                        <img width="100px" src="{{asset('web/images/miscellaneous/').'/'.$payment_methods['payment_method'].'.png'}}" alt="{{$payment_methods['name']}}">
                                                      @else
                                                      {{$payment_methods['name']}}
                                                      @endif
                                                    </label>
                                                  </div>
          @endif
          @endforeach 

            </div>
        </div>

          <div class="button mobile-align-check-btn">
          <button id="cash_on_delivery_button" class="btn btn-dark payment_btns btn_disables" style="display: none">@lang('website.Order Now')</button>

          <a href="{{ URL::to('/qrcode_paytm')}}" id="pay_tm_button" class="btn btn-dark payment_btns btn_disable"  style="display: none"  type="button">@lang('website.Order Now')</a>

          <button id="banktransfer_button" class="btn btn-dark payment_btns" style="display: none">@lang('website.Order Now')</button>

           <a href="{{ URL::to('/tableipay')}}" id="ipay88_button" class="btn btn-dark payment_btns btn_disable" style="display: none">@lang('website.Order Now')</a>
         </div>

        

  </div>    
</section> 
</body>
</html>
<script type="text/javascript">
  jQuery(document).on('click', '#cash_on_delivery_button ', function(e){
  jQuery(".btn_disables").attr("disabled", true);
   var amount= jQuery("#wamount").val();
      jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      url: '{{ URL::to("/tablepay")}}',
      type: "POST",
      data: '&amount='+amount,
      success: function (res) {
         window.location = 'webthankyou';
      },

    });
});
</script>
