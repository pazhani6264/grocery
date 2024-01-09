@extends('admin.layout')
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
      
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
          <div class="box-body no-padding">
              <form  name='registration' method="get" action="{{url('admin/customers-orders-report')}}">
              <input type="hidden" name="type" value="all">
              <div class="box-body">
              @if(app('request')->input('dateRange'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Date') }}</label>
                    <p>{{app('request')->input('dateRange')}}</p>
                  </div>
                </div>
                @endif
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Date & Time</th>
                      <th>Receipt No</th>
                      <th>Item Name</th>
                      <th>Options</th>
                      <th>{{ trans('labels.OrderTotal') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                   @if(count($result['reports'])>0)
                      @foreach ($result['reports'] as $key =>$orderData)
                      <?php 
                        $symbol_left = DB::table('currencies')->where('symbol_left', '=', $orderData->currency)->first(); 
                      ?>
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$orderData->date_purchased}}</td>
                        <td>{{$result['commonContent']['setting']['invoice_prefix']}}{{$orderData->orders_id}}</td>
                        <td>{{$orderData->products_name}}</td>
                        <td>
                            @foreach($orderData->attribute as $attributes)
                              <b>{{ trans('labels.Name') }}:</b> {{ $attributes->products_options }}<br>
                              <b>{{ trans('labels.Value') }}:</b> <?php echo $attributes->products_options_values ?><br>
                              <b>{{ trans('labels.Price') }}:</b>
                                  <?php  
                                      if($symbol_left != '') { echo $orderData->currency.' '.$attributes->options_values_price * $orderData->currency_value; } else  { $attributes->options_values_price * $orderData->currency_value.' '.$orderData->currency; } ?><br /> 
                            @endforeach
                        </td>
                        <td>@if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{$orderData->final_price}} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif</td>
                      </tr>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="5"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                    </tr>
                    @endif
                  </tbody>
                </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
