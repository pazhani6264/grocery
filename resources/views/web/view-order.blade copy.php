@extends('web.layout')
@section('content')
<style>
.logo_new_style_outer
{
    width: 125px !important;
    height:40px !important;
}
th {
    text-align: left;
}
</style>
<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active"><a href="{{ URL::to('/orders')}}">@lang('website.orders')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Order information')</li>
          </ol>
      </div>
    </nav>
</div> 

<!--My Order Content -->
<section class="order-two-content pro-content">
  <div class="container">
    <div class="page-heading-title">
        <h2>   @lang('website.Order information')
        </h2>
     
        </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12 col-lg-3 ">
      <div class="heading">
          <h2>
              @lang('website.My Account')
          </h2>
          <hr >
        </div>

        @if(Auth::guard('customer')->check())
        <ul class="list-group">
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/profile')}}">
                    <i class="fas fa-user"></i>
                  @lang('website.Profile')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/wishlist')}}">
                    <i class="fas fa-heart"></i>
                 @lang('website.Wishlist')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/orders')}}">
                    <i class="fas fa-shopping-cart"></i>
                  @lang('website.Orders')
                </a>
            </li>
             @if($result['commonContent']['settings']['Loyalty']=='1')
             <li class="list-group-item">
                    <a class="nav-link" href="{{ URL::to('/point-transaction')}}">
                        <i class="fas fa-gift"></i>
                     @lang('website.point_transaction')
                    </a>
           </li>
           @endif
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/shipping-address')}}">
                    <i class="fas fa-map-marker-alt"></i>
                 @lang('website.Shipping Address')
                </a>
            </li>
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/logout')}}">
                    <i class="fas fa-power-off"></i>
                  @lang('website.Logout')
                </a>
            </li>
          </ul>
          @elseif(!empty(session('guest_checkout')) and session('guest_checkout') == 1)
          <ul class="list-group">
            <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/orders')}}">
                    <i class="fas fa-shopping-cart"></i>
                  @lang('website.Orders')
                </a>
            </li>
          </ul>
          @endif
    </div>
    <div class="col-12 col-lg-9 ">
        <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      @if(session()->has('message'))
       <div class="col-md-12">
       <div class="row">
      	<div class="alert alert-success alert-dismissible" style="width:100%;">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        </div>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="col-md-12">
      	<div class="row">
        	<div class="alert alert-warning alert-dismissible" style="width:100%;">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('error') }}
            </div>
          </div>
         </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <h3 class="page-header" style="padding-bottom: 25px; margin-top:0;">
            <i class="fa fa-globe"></i> {{ trans('labels.OrderID') }}# {{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }}  
            
            <small style="display: inline-block" class="label label-primary">
            @if($data['orders_data'][0]->ordered_source == 1)
            {{ trans('labels.Website') }}
            @else
            {{ trans('labels.Application') }}
            @endif
            </small>
            <small style="display: inline-block">{{ trans('labels.OrderedDate') }}: {{ date('d-m-Y', strtotime($data['orders_data'][0]->date_purchased)) }}</small>
            <a href="{{ URL::to('invoiceprint/'.$data['orders_data'][0]->orders_id)}}" target="_blank"  class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</a>
            @if($data['orders_data'][0]->orders_status_id == 7 )
              @if($data['current_boy'])
              <button type="button" data-toggle="modal" data-target="#mapModal" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-location-arrow"></i> {{ trans('labels.Track Order') }}</button>
              

              <!-- Modal -->
              <div id="trackmodal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-body" id="googleMap" style="height: 400px">
                    </div>
                  </div>

                </div>
              </div>
              
              @endif
            @endif
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <?php 
            $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
          

            ?>



      <div class="row invoice-info">



        <div class="col-sm-4 invoice-col">
          {{ trans('labels.CustomerInfo') }}:
          <address>
            <strong>{{ $data['orders_data'][0]->customers_name }}</strong><br>
            {{ $data['orders_data'][0]->customers_street_address }} <br>
            {{ $data['orders_data'][0]->customers_city }}, {{ $data['orders_data'][0]->customers_state }} {{ $data['orders_data'][0]->customers_postcode }}, {{ $data['orders_data'][0]->customers_country }}<br>
            {{ trans('labels.Phone') }}: +{{auth()->guard('customer')->user()->country_code}} {{ $data['orders_data'][0]->customers_telephone }}<br>
            {{ trans('labels.Email') }}: {{ $data['orders_data'][0]->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{ trans('labels.ShippingInfo') }}
          <address>

            <strong>{{ $data['orders_data'][0]->delivery_name }}</strong><br>
            {{ $data['orders_data'][0]->delivery_street_address }} <br>
            {{ $data['orders_data'][0]->delivery_city }}, {{ $data['orders_data'][0]->delivery_state }} {{ $data['orders_data'][0]->delivery_postcode }}, {{ $data['orders_data'][0]->delivery_country }}<br>

            <strong>{{ trans('labels.Phone') }}: </strong>{{ $data['orders_data'][0]->delivery_phone }}<br>
           <strong> {{ trans('labels.ShippingMethod') }}:</strong> {{ $data['orders_data'][0]->shipping_method }} <br>

         <!--   <strong> {{ trans('labels.ShippingCurrency') }}:</strong> {{ $result['commonContent']['currency']->symbol_left }} <br> -->

           <strong> {{ trans('labels.ShippingCost') }}:</strong> 
           @if(!empty($data['orders_data'][0]->shipping_cost)) 

           @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
            @else --- @endif <br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         {{ trans('labels.BillingInfo') }}
          <address>
            <strong>{{ $data['orders_data'][0]->billing_name }}</strong><br>
            {{ $data['orders_data'][0]->billing_street_address }} <br>  
            {{ $data['orders_data'][0]->billing_city }}, {{ $data['orders_data'][0]->billing_state }} {{ $data['orders_data'][0]->billing_postcode }}, {{ $data['orders_data'][0]->billing_country }}<br>
            <strong>{{ trans('labels.Phone') }}: </strong>{{ $data['orders_data'][0]->billing_phone }}<br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-md-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{ trans('labels.Qty') }}</th>
              <th>{{ trans('labels.Image') }}</th>
              <th>{{ trans('labels.ProductName') }}</th>
              <th>{{ trans('labels.ProductModal') }}</th>
              <th>{{ trans('labels.Options') }}</th>
              <th>{{ trans('labels.Price') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data['orders_data'][0]->data as $products)

            <tr>
                <td>{{  $products->products_quantity }}</td>
                <td >
                <?php 
            $imagepath = DB::table('image_categories')->where('path', '=', $products->image)->where('image_type', 'ACTUAL')->select('path_type')->first(); 

            ?>
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

            </tbody>
          </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-md-7">
          <p class="lead" style="margin-bottom:10px">{{ trans('labels.PaymentMethods') }}:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
           	{{ str_replace('_',' ', $data['orders_data'][0]->payment_method) }}
          </p>
          <br>
          @if($data['orders_data'][0]->payment_method=='banktransfer')
          <p class="lead" style="margin-bottom:10px">Invoice Image:</p><br>
          @if($data['orders_data'][0]->banktransfer_image!='')
          <img src="{{asset($data['orders_data'][0]->banktransfer_image)}}" width="300px"> <br>
          @else
          <p>Invoice image not uploaded yet.</p>
          @endif
          <br>
          @endif

          @if($data['orders_data'][0]->payment_method=='banktransfer')
          <?php  $payments_setting = DB::table('payment_methods_detail')
            ->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
            ->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
            ->select(
                'payment_methods_detail.*',
                'payment_description.name',
                'payment_methods.environment',
                'payment_methods.status',
                'payment_methods.payment_method',
                'payment_description.sub_name_1'
            )
            ->where('language_id', session('language_id'))
            ->where('payment_description.payment_methods_id', 9)
            ->orwhere('language_id', 1)
            ->where('payment_description.payment_methods_id', 9)
            ->get()->keyBy('key');
             ?>
          <div class="table-responsive ">
            <table class="table order-table">
            <tr>
                <th>Invoice Number:</th>
                <td>
                {{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }}<br>

                  </td>
              </tr>
              <tr>
                <th style="width:50%">@lang('website.Bank'):</th>
                <td>
                {{@$payments_setting['bank_name']->value ?: '---' }}<br>

                  </td>
              </tr>
              <tr>
                <th>@lang('website.account_name'):</th>
                <td>
                {{@$payments_setting['account_name']->value ?: '---' }}<br>

                  </td>
              </tr>
              <tr>
                <th>@lang('website.account_number'):</th>
                <td>
                {{@$payments_setting['account_number']->value ?: '---' }}<br>
                  </td>
              </tr>
            
              <tr>
              <th>@lang('website.short_code'):</th>
                <td>
                {{@$payments_setting['short_code']->value ?: '---' }}<br>                  
              </tr>
             
              <tr>
              <th>@lang('website.iban'):</th>
                <td>
                {{@$payments_setting['iban']->value ?: '---' }}<br>                  
              </tr>
             
              <tr>
                <th>@lang('website.swift'):</th>
                <td>
                {{@$payments_setting['swift']->value ?: '---' }}<br>

                  </td>
              </tr>
            </table>
          </div>

          <br>
          <div style="width:100%;padding:15px;background:#fff;text-align:center;">
              <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/banktransfer_fileupload')}}" method="post">
                <input type="hidden" value="{{$data['orders_data'][0]->orders_id}}" name="image_order_id">
              <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
            
              Upload Your Payment Invoice:
              <input type="file" accept="image/*" name="bankimage" id="bankimage" required><br>
              <input type="submit" style="margin-top:30px;" class="btn swipe-to-top btn-secondary" value="Upload Image" name="submit" >
            </form>
          </div>

             
            @endif

          @if($data['orders_data'][0]->payment_method !='Cash on Delivery')
           
            @if($data['orders_data'][0]->payment_method=='PayTm')
            <p class="lead" style="margin-bottom:10px">{{ trans('labels.PaymentStatus') }}:</p>
              <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
                @if($data['orders_data'][0]->payment_status=='1')
                  Online payment success
                  @else
                  Online payment failure
              @endif
              </p>
            @endif
            @if($data['orders_data'][0]->payment_method=='PremierPay')
            <p class="lead" style="margin-bottom:10px">{{ trans('labels.PaymentStatus') }}:</p>
              <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
                @if($data['orders_data'][0]->payment_status=='2')
                  Online payment success
                  @else
                  Online payment failure
                  <br>
                  <div style=""><a href="{{ URL::to('/checkout/payNow/'.$data['orders_data'][0]->order_ref_no)}}" id="ipay88_button" class="btn btn-dark payment_btns" style="">@lang('website.Pay Now')</a></div>
              @endif
              </p>
              <br>
            @endif
            @if($data['orders_data'][0]->payment_method=='iPay88')
            <p class="lead" style="margin-bottom:10px">{{ trans('labels.PaymentStatus') }}:</p>
              <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
                @if($data['orders_data'][0]->payment_status=='2')
                  Online payment success
                  @else
                  Online payment failure
                  <br>
                  <div style=""><a href="{{ URL::to('/checkout/payNow/'.$data['orders_data'][0]->order_ref_no)}}" id="ipay88_button" class="btn btn-dark payment_btns" style="">@lang('website.Pay Now')</a></div>
              @endif
              </p>
              <br>
            @endif
          @endif
          
          <br>
          @if(!empty($data['orders_data'][0]->coupon_code))
              <p class="lead" style="margin-bottom:10px">{{ trans('labels.Coupons') }}:</p>
                <table class="text-muted well well-sm no-shadow stripe-border table table-striped" style="text-align: center; ">
                	<tr>
                        <th style="text-align: center; ">{{ trans('labels.Code') }}</th>
                        <th style="text-align: center; ">{{ trans('labels.Amount') }}</th>
                    </tr>
                	@foreach( json_decode($data['orders_data'][0]->coupon_code) as $couponData)
                    	<tr>
                        	<td>{{ $couponData->code}}</td>
                            <td>{{ $couponData->amount}}

                                @if($couponData->discount_type=='percent_product')
                                    ({{ trans('labels.Percent') }})
                                @elseif($couponData->discount_type=='percent')
                                    ({{ trans('labels.Percent') }})
                                @elseif($couponData->discount_type=='fixed_cart')
                                    ({{ trans('labels.Fixed') }})
                                @elseif($couponData->discount_type=='fixed_product')
                                    ({{ trans('labels.Fixed') }})
                                @endif
                            </td>
                        </tr>
                    @endforeach
				</table>
               <!-- {{ $data['orders_data'][0]->coupon_code }}-->

          @endif
          <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->

		  <p class="lead" style="margin-bottom:10px">{{ trans('labels.Orderinformation') }}:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize; word-break:break-all;">
          @if($data['orders_data'][0]->payment_method != 'Cash on Delivery')
          {{ $data['orders_data'][0]->transaction_id }}
          @else
          ""
          @endif
        
          </p>
        </div>
        <!-- /.col -->
        <div class="col-md-5">
          <!--<p class="lead"></p>-->

          <div class="table-responsive ">
            <table class="table order-table">
              <tr>
                <th style="width:50%">{{ trans('labels.Subtotal') }}:</th>
                <td>
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                  </td>
              </tr>
              <tr>
                <th>{{ trans('labels.Tax') }}:</th>
                <td>
                @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                  </td>
              </tr>
              <tr>
                <th>{{ trans('labels.ShippingCost') }}:</th>
                <td>
                @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
                  </td>
              </tr>
              @if(!empty($data['orders_data'][0]->coupon_code))
              <tr>
              <th>@lang('website.Discount(Promo Code)'):</th>
                <td>
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->coupon_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
              </tr>
              @endif
              @if($data['orders_data'][0]->points_amount!='0')
              <tr>
              <th>@lang('website.Discount(Voucher)'):</th>
                <td>
                @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->points_amount  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>                  
              </tr>
              @endif
              <tr>
                <th>{{ trans('labels.Total') }}:</th>
                <td>
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                  </td>
              </tr>
            </table>
          </div>

        </div>
   

        <div class="col-md-12">
        @if($result['commonContent']['settings']['deliveryboy_rating']=='1')
        <p class="lead"> @if($data['orders_data'][0]->orders_status_id == 2) <a href="{{ URL::to('/rating_delivery/'.$data['orders_data'][0]->orders_id)}}"><i class="fa fa-star common-color"  aria-hidden="true"></i> Rate and Review</a> @endif</p><br>@endif
          <p class="lead">{{ trans('labels.OrderHistory') }}</p>

           
      <div class="wrapper">
        <ul class="StepProgress">

        <?php  
        $pending = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 1)->first();
        $inprocess = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 5)->first();
        $dispatched = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 7)->first();
        $ontheway = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 12)->first();
        $delivered = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 6)->first();
        $completed = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 2)->first();  
        $cancel = DB::table('orders_status_history')->where('orders_id', '=', $data['orders_data'][0]->orders_id)->where('orders_status_id', '=', 3)->first();
       
        ?>
        @if($cancel != '') 
        <li class="StepProgress-item cancel"><strong>Cancelled</strong> <br> {{date('M d, Y , h:i a', strtotime($cancel->date_added))}} <br> <p>{{ $cancel->comments }}</P></li>
        @else

        @if($pending != '') 
        <li class="StepProgress-item is-done"><strong>Pending</strong> <br> {{date('M d, Y , h:i a', strtotime($pending->date_added))}} <br> <p>{{ $pending->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Pending</strong><br><br></li>
        @endif

        @if($inprocess != '') 
        <li class="StepProgress-item is-done"><strong>Inprocess</strong> <br> {{date('M d, Y , h:i a', strtotime($inprocess->date_added))}} <br> <p>{{ $inprocess->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Inprocess</strong><br><br></li>
        @endif

        @if($dispatched != '') 
        <li class="StepProgress-item is-done"><strong>Dispatched</strong> <br> {{date('M d, Y , h:i a', strtotime($dispatched->date_added))}} <br> <p>{{ $dispatched->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Dispatched</strong><br><br></li>
        @endif

        @if($ontheway != '') 
        <li class="StepProgress-item is-done"><strong>On the way</strong> <br> {{date('M d, Y , h:i a', strtotime($ontheway->date_added))}} <br> <p>{{ $ontheway->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>On the way</strong><br><br></li>
        @endif

        @if($delivered != '') 
        <li class="StepProgress-item is-done"><strong>Delivered</strong> <br> {{date('M d, Y , h:i a', strtotime($delivered->date_added))}} <br> <p>{{ $delivered->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Delivered</strong><br><br></li>
        @endif

        @if($completed != '') 
        <li class="StepProgress-item is-done"><strong>Completed</strong> <br> {{date('M d, Y , h:i a', strtotime($completed->date_added))}} <br> <p>{{ $completed->comments }}</P></li>
          @else
          <li class="StepProgress-item"><strong>Completed</strong></li>
        @endif
        @endif
        </ul>
      </div>
<!-- 
      <div class="wrapper">
<ul class="StepProgress">
  <li class="StepProgress-item is-done"><strong>Pending</strong></li>
  <li class="StepProgress-item is-done"><strong>Inprocess</strong>
  </li>
  <li class="StepProgress-item is-done"><strong>Dispatched</strong></li>
  <li class="StepProgress-item"><strong>On the way</strong></li>
  <li class="StepProgress-item"><strong>Delivered</strong></li>
  <li class="StepProgress-item"><strong>Completed</strong></li>
</ul>
</div> -->





        <!--     <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ trans('labels.Date') }}</th>
                  <th>{{ trans('labels.Status') }}</th>
                  <th>{{ trans('labels.Comments') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $data['orders_status_history'] as $orders_status_history)
                    <tr>
                        <td>
							<?php
								$date = new DateTime($orders_status_history->date_added);
								$status_date = $date->format('d-m-Y');
								print $status_date;
							?>
                        </td>
                        <td>
                        	@if($orders_status_history->orders_status_id==1)
                            	<span class="label label-warning">
                            @elseif($orders_status_history->orders_status_id==2)
                                <span class="label label-success">
                            @elseif($orders_status_history->orders_status_id==3)
                                 <span class="label label-danger">
                            @else
                                 <span class="label label-primary">
                            @endif
                            {{ $orders_status_history->orders_status_name }}
                                 </span>
                        </td>
                        <td style="text-transform: initial;">
                          {{ $orders_status_history->comments }}

                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table> -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
    </div>
  </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-modal="true">
       
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
        <div class="modal-body">

            <div class="container">
                <div class="row align-items-center">                   
             
                <div class="form-group">
<input type="text" id="pac-input" name="address_address" class="form-control map-input">
</div>
<div id="address-map-container" style="width:100%;height:400px; ">
<div style="width: 100%; height: 100%" id="map"></div>
</div>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
          </div>
          <div class="modal-footer">
   
   <button type="button" class="btn btn-primary" onclick="setUserLocation()"><i class="fas fa-location-arrow"></i></button>
   <button type="button" class="btn btn-secondary" onclick="saveAddress()">Save</button>
 </div>
    </div>
  </div>
  </div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=<?=$result['commonContent']['settings']['google_map_api']?>&libraries=places&callback=initialize" async defer></script>
    <script>
     
      var markers;
      var myLatlng;
      var map;
      var geocoder;
     function setUserLocation(){
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            myLatlng = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            markers.setPosition(myLatlng);
            map.setCenter(myLatlng);

          }, function() {
          });
        } 
     } 
     function saveAddress(){
      var latlng = markers.getPosition();
      geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
             var street = "";
             var state = "";
             var country = "";
             var city = "";
             var postal_code = "";

                for (var i = 0; i < results[0].address_components.length; i++) {
                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                        switch (results[0].address_components[i].types[b]) {
                            case 'locality':
                                city = results[0].address_components[i].long_name;
                                break;
                            case 'administrative_area_level_1':
                                state = results[0].address_components[i].long_name;
                                break;
                            case 'country':
                                country = results[0].address_components[i].long_name;
                                break;
                            case 'postal_code':
                              postal_code =  results[0].address_components[i].long_name; 
                              break;
                            case 'route':
                              if (street == "") {
                                street = results[0].address_components[i].long_name;
                              }
                            break;

                            case 'street_address':
                              if (street == "") {
                                street += ", " + results[0].address_components[i].long_name;
                              }
                            break;
                        }
                    }
                }
                $("#postcode").val(postal_code);
                $("#street").val(street);
                $("#city").val(city);

                $("#latitude").val(markers.getPosition().lat());
                $("#longitude").val(markers.getPosition().lng());

                // $("#entry_country_id").val(country);
               
                $("#location").val(latlng);

                $("#entry_country_id option").filter(function() {
                  //may want to use $.trim in here
                  return $(this).text() == country;
                }).prop('selected', true);
                if(getZones("no_loader")){
                  $("#entry_zone_id option").filter(function() {
                    //may want to use $.trim in here
                    return $(this).text() == state;
                  }).prop('selected', true);
                }
                $('#mapModal').modal('hide');

            } else {
              console.log('No results found');
            }
          } else {
            console.log('Geocoder failed due to: ' + status);
          }
        });
     }

     function initialize() {
      defaultPOS = {
              lat: <?=$result['commonContent']['setting'][127]->value?>,
              lng: <?=$result['commonContent']['setting'][128]->value?>
            };
      map = new google.maps.Map(document.getElementById('map'), {
          center: defaultPOS,
          zoom: 13,
          mapTypeId: 'roadmap'
        });
      geocoder = new google.maps.Geocoder;
      markers = new google.maps.Marker({
          map: map,
          draggable:true,
          position: defaultPOS
        });

        
        
        var infowindow = new google.maps.InfoWindow;
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

          searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          var bounds = new google.maps.LatLngBounds();

          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            console.log(place.geometry.location);
            // Create a marker for each place.
            markers.setPosition(place.geometry.location);
            markers.setTitle(place.name);
            

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>

@endsection

<style>

.wrapper {
  width: 330px;
  font-size: 14px;
  border: 1px solid #CCC;
  padding: 10px;
}

.StepProgress {
  position: relative;
  padding-left: 45px;
  list-style: none;
}

  
.StepProgress::before {
    display: inline-block;
    content: '';
    position: absolute;
    top: 0;
    left: 15px;
    width: 10px;
    height: 100%;
    border-left: 2px solid #CCC;
  }
  
  .StepProgress-item {
    position: relative;
    counter-increment: list;
  }
    
    .StepProgress-item:not(:last-child) {
      padding-bottom: 20px;
    }
    
    .StepProgress-item::before {
      display: inline-block;
      content: '';
      position: absolute;
      left: -30px;
      height: 100%;
      width: 10px;
    }
    
    .StepProgress-item::after {
      content: '';
      display: inline-block;
      position: absolute;
      top: 0;
      left: -41px;
      width: 24px;
      height: 24px;
      border: 2px solid #CCC;
      border-radius: 50%;
      background-color: #FFF;
    }
    
  
      .StepProgress-item.is-done::before {
        border-left: 2px solid green;
      }
      .StepProgress-item.is-done::after {
        content: "✔";
        font-size: 12px;
        color: #FFF;
        text-align: center;
        border: 2px solid green;
        background-color: green;
      }
      .StepProgress-item.cancel::before {
        border-left: 2px solid red;
      }

      .StepProgress-item.cancel::after {
        content: "X";
        font-size: 12px;
        color: #FFF;
        text-align: center;
        border: 2px solid red;
        background-color: red;
      }
    
    
     
      .StepProgress-item.current::before {
        border-left: 2px solid green;
      }
      
      .StepProgress-item.current::after {
        content: counter(list);
        padding-top: 1px;
        width: 24px;
        height: 24px;
        top: -4px;
        left: -40px;
        font-size: 14px;
        text-align: center;
        color: green;
        border: 2px solid green;
        background-color: white;
      }
    
  
  
      .StepProgress strong {
    display: block;
  }

@media only screen and (max-width: 576px)
{
  .wrapper {
  width: 100%;
}
}

</style>
