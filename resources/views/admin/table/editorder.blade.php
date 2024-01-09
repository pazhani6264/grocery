@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.ViewOrder') }} <small> {{ trans('labels.ViewOrder') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/orders/display')}}"><i class="fa fa-dashboard"></i>  {{ trans('labels.ListingAllOrders') }}</a></li>
      <li class="active"> {{ trans('labels.ViewOrder') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px; margin-top:0;">
            <i class="fa fa-globe"></i> {{ trans('labels.OrderID') }}# <?php echo $result['commonContent']['setting']['invoice_prefix']. $data['orders_data'][0]->bookid ?> 
            
            <small style="display: inline-block" class="label label-primary">
            {{ trans('labels.Website') }}
            </small>
            <small style="display: inline-block">{{ trans('labels.OrderedDate') }}: <?php echo date('m/d/Y', strtotime($data['orders_data'][0]->created_at)) ?></small>
           <!-- <a href="<?php echo URL::to('admin/orders/invoiceprint/'.$data['orders_data'][0]->id)?>" target="_blank"  class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</a> -->
            
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
         @php
            $symbol_left = DB::table('currencies')->where('symbol_left', '=', $data['orders_data'][0]->currency)->first(); 
            $payment= DB::table('table_payment')->where('book_id', '=', $data['orders_data'][0]->qrcode)->first();
         @endphp

      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
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
            <?php 
            foreach($data['orders_data'][0]->data as $products){
              ?>
            <tr>
                <td><?php echo  $products->products_quantity; ?></td>
                <td >
                  @if($products->image_path_type == 'aws')
                   <img src="{{$products->image }}" width="60px"> <br>
                   @else
                   <img src="{{ asset('').$products->image }}" width="60px"> <br>
                   @endif
                </td>
                <td  width="30%">
                <?php echo $products->products_name; ?><br>
                </td>
                <td>
                <?php echo $products->products_model ?>
                </td>
                <td>
                <?php foreach($products->attribute as $attributes) { ?>
                	<b>{{ trans('labels.Name') }}:</b> {{ $attributes->products_options }}<br>
                    <b>{{ trans('labels.Value') }}:</b> <?php echo $attributes->products_options_values ?><br>
                    <b>{{ trans('labels.Price') }}:</b> 
                    <?php  
                    if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$attributes->options_values_price * $data['orders_data'][0]->currency_value; } else  { $attributes->options_values_price * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?><br />

               <?php }?></td>

                <td>

                <?php  
                    if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$products->final_price * $data['orders_data'][0]->currency_value; } else  { $products->final_price * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?>
                  
               <br>
                  </td>
             </tr>
             <?php }?>

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
          @if($payment)
           {{ $payment->payment_method}}
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
                  <?php
                if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$data['subtotal'] * $data['orders_data'][0]->currency_value; } else  { $data['subtotal'] * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?>

              <br>

                  </td>
              </tr>
              
              <tr>
                <th>{{ trans('labels.Total') }}:</th>
                <td>
                <?php
                if($symbol_left != '') { echo $data['orders_data'][0]->currency.' '.$data['subtotal'] * $data['orders_data'][0]->currency_value; } else  { $data['subtotal'] * $data['orders_data'][0]->currency_value.' '.$data['orders_data'][0]->currency; } ?>
                <br>

                  </td>
              </tr>
            </table>
          </div>

        </div>
    
         
          
               
           
            
           
             

        </div>
         <!-- this row will not appear when printing -->
            
         


         
                

        
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>


@endsection
