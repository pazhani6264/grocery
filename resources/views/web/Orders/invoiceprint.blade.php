{{-- @extends('admin.layout') --}}
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Online Grocery Shop | Platinum 24</title>
{{--{{ $pageTitle }}--}}
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="Themescoder" content="">
  <!-- Bootstrap 3.3.6 -->
  <link href="{!! asset('admin/bootstrap/css/bootstrap.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/bootstrap/css/styles.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/dropzone.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/custom.ilyas.css') !!}" media="all" rel="stylesheet" type="text/css" />
  {{--fancybox--}}

  <link href="{!! asset('admin/css/jquery.fancybox.min.css') !!}" media="all" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/select2/select2.min.css') !!} ">

    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.css') !!} ">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') !!} ">
  <!-- Ionicons -->
  <link href="{!! asset('admin/css/ionicons.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/image-picker.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <!-- daterange picker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/daterangepicker/daterangepicker-bs3.css') !!} ">
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{!! asset('admin/plugins/datepicker/datepicker3.css') !!} ">
  <!-- jvectormap -->
  <link href="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{!! asset('admin/dist/css/AdminLTE.min.css')  !!} " media="all" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="{!! asset('admin/dist/css/skins/_all-skins.min.css') !!} " media="all" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{!! asset('admin/plugins/iCheck/all.css')  !!} " media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
      window.csrf_token = "{{ csrf_token() }}"
    </script>

  <!-- Ionicons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/jquery-2.2.4.min"><\/script>')</script>

  <![endif]-->
</head>
<style>
.dragable-box-cursor img{
  cursor: move;
}

.dragable-box-cursor{
  cursor: move;
}

</style>
<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <div class="col-xs-12">
      <div class="row">
       @if(session()->has('message'))
      	<div class="alert alert-success alert-dismissible">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
           <h4><i class="icon fa fa-check"></i> {{ trans('labels.Successlabel') }}</h4>
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        	<div class="alert alert-warning alert-dismissible">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
               <h4><i class="icon fa fa-warning"></i> {{ trans('labels.WarningLabel') }}</h4>
                {{ session()->get('error') }}
            </div>
        @endif
        
        
       </div>
      </div>
      <?php 
            $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
          

            ?>

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
            <i class="fa fa-globe"></i> {{ trans('labels.OrderID') }}# {{$result['commonContent']['setting'][150]->value}}{{ $data['orders_data'][0]->orders_id }} 
            <small class="pull-right">{{ trans('labels.OrderedDate') }}: {{ date('d-m-Y', strtotime($data['orders_data'][0]->date_purchased)) }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{ trans('labels.CustomerInfo') }}:
          <address>
            <strong>{{ $data['orders_data'][0]->customers_name }}</strong><br>
            {{ $data['orders_data'][0]->customers_street_address }} <br>
            {{ $data['orders_data'][0]->customers_city }}, {{ $data['orders_data'][0]->customers_state }} {{ $data['orders_data'][0]->customers_postcode }}, {{ $data['orders_data'][0]->customers_country }}<br>
            {{ trans('labels.Phone') }}: {{ $data['orders_data'][0]->customers_telephone }}<br>
            {{ trans('labels.Email') }}: {{ $data['orders_data'][0]->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{ trans('labels.ShippingInfo') }}
          <address>
            <strong>{{ $data['orders_data'][0]->delivery_name }}</strong><br>
            {{ trans('labels.Phone') }}: {{ $data['orders_data'][0]->delivery_phone }}<br>
            {{ $data['orders_data'][0]->delivery_street_address }} <br>
            {{ $data['orders_data'][0]->delivery_city }}, {{ $data['orders_data'][0]->delivery_state }} {{ $data['orders_data'][0]->delivery_postcode }}, {{ $data['orders_data'][0]->delivery_country }}<br>
           <strong> {{ trans('labels.ShippingMethod') }}:</strong> {{ $data['orders_data'][0]->shipping_method }} <br>
           <strong> {{ trans('labels.ShippingCost') }}:</strong> @if(!empty($data['orders_data'][0]->shipping_cost)) 
           
           @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>
            @else --- @endif <br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         {{ trans('labels.BillingInfo') }} 
          <address>
            <strong>{{ $data['orders_data'][0]->billing_name }}</strong><br>
            {{ trans('labels.Phone') }}: {{ $data['orders_data'][0]->billing_phone }}<br>
            {{ $data['orders_data'][0]->billing_street_address }} <br>
            {{ $data['orders_data'][0]->billing_city }}, {{ $data['orders_data'][0]->billing_state }} {{ $data['orders_data'][0]->billing_postcode }}, {{ $data['orders_data'][0]->billing_country }}<br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{ trans('labels.Qty') }}</th>
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
                    <b>{{ trans('labels.Price') }}:</b>  @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{ $attributes->options_values_price * $data['orders_data'][0]->currency_value }} @else  {{ $attributes->options_values_price * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif<br>

                @endforeach</td>
                
                <td>@if($symbol_left != '')
                 {{ $data['orders_data'][0]->currency }}  {{$products->final_price  * $data['orders_data'][0]->currency_value }} @else  {{$products->final_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif</td>
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
        <div class="col-xs-7">
          <p class="lead" style="margin-bottom:10px">{{ trans('labels.PaymentMethods') }}:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
           	{{ str_replace('_',' ', $data['orders_data'][0]->payment_method) }}
          </p>
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
          @endif
          
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <!--<p class="lead"></p>-->

          <div class="table-responsive ">
            <table class="table order-table">
              <tr>
                <th style="width:50%">{{ trans('labels.Subtotal') }}:</th>
                <td>
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }} @else  {{$data['subtotal']  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                  </td>
              </tr>
              <tr>
                <th>{{ trans('labels.Tax') }}:</th>
                <td>
                @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->total_tax   * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
                  </td>
              </tr>
              <tr>
                <th>{{ trans('labels.ShippingCost') }}:</th>
                <td>
                @if($symbol_left != '') {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->shipping_cost  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif
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
                @if($symbol_left != '')  {{ $data['orders_data'][0]->currency }}  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }} @else  {{$data['orders_data'][0]->order_price  * $data['orders_data'][0]->currency_value }}  {{ $data['orders_data'][0]->currency }} @endif</td>
                  </td>
              </tr>
            </table>
          </div>
              
        </div>     
        <div class="col-xs-12">
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
      </div>
      <!-- /.row -->

     
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

