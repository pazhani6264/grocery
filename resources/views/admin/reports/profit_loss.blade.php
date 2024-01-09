@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Profit Loss <small>Profit Loss...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Profit Loss</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
                  <form method="get" action="{{url('admin/profit_loss')}}">
                        <input type="hidden" name="type"  value="id">
                        <input type="hidden"  value="{{csrf_token()}}">
                          <div style="width:100%">
                            <div style="width:20%;float:left;" >
                            <p >{{ trans('labels.Choose start and end date') }}</p>
                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group" style="width:100%">
                                  <label for="exampleInputEmail1">{{ trans('labels.currency') }}</label> &nbsp
                                  <select type="button" class="btn btn-default select2 form-control" data-toggle="dropdown" name="currency" id="currency" style="width:100%;">
                                      @foreach($result['currency'] as $currency)
                                        <option value="{{ $currency->symbol_left ? $currency->symbol_left : $currency->symbol_right }}"  @if( app('request')->input('currency')) @if  (app('request')->input('currency') == $currency->symbol_right || app('request')->input('currency') == $currency->symbol_left) {{ 'selected' }} @endif @endif>{{ $currency->symbol_left ? $currency->symbol_left : $currency->symbol_right}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>  -->
                            
                            <div style="width:10%;float:left;justify-content: center;align-items: center;" >                  
                              <button class="btn btn-primary" id="submit" type="submit" style="    position: absolute;top: 47%;left: 22%;padding:9px 12px;"><span class="glyphicon glyphicon-search"></span></button>
                                @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{url('admin/salesreport')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                            </div>
                            <div style="width:60%;float:left;" ></div> 
                          </div>
                    </form>     
                  <!-- <div class="box-tools pull-right">
                    <form action="{{ URL::to('admin/sales-orders-print')}}" target="_blank">
                      <input type="hidden" name="page" value="invioce">
                      <input type="hidden" name="customers_id" value="{{app('request')->input('customers_id')}}">
                      <input type="hidden" name="orders_status_id" value="{{app('request')->input('orders_status_id')}}">
                      <input type="hidden" name="deliveryboys_id" value="{{app('request')->input('deliveryboys_id')}}">
                      <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                      <input type="hidden" name="orderid" value="{{app('request')->input('orderid')}}">
                      <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</button>
                    </form>
                  </div> -->
                </div>

                
                

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 
            <!--   <span><b>Sales Report showing for date : </b> {{ $result['dateFrom'] }} - {{ $result['dateTo'] }}</span> -->
              <span><b>NOTE : </b> Showing sales Report From {{ $result['dateFrom'] }} To {{ $result['dateTo'] }} </span>
              <div class="box-tools pull-right">

                <div class="box-tools pull-right">
                  <form action="{{ URL::to('admin/profitlossprint')}}" target="_blank" >
                    <input type="hidden" name="page" value="invioce">
                    <input type="hidden" name="dateRange" value="{{app('request')->input('dateRange')}}">
                    <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</button>
                  </form>
                </div><br><br>

                <!-- <h2><small>{{trans('labels.Total Sale Price')}}:</small>@if( $result['commonContent']['currency']->symbol_left == app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif {{$result['price']}} @if($result['commonContent']['currency']->symbol_left != app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif </h2> -->
                <?php $tt =number_format((float)$result['price'], 2, '.', ''); ?>
                <h2><small>{{trans('labels.Total Sale Price')}}:</small><small> @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif <span id="grandprice">{{ $tt }}</span>  @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif </h2>
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>{{ trans('labels.Date') }}</th>
                      <th>{{ trans('labels.No of Orders') }}</th>
                      <th>{{ trans('labels.OrderTotal') }}</th>
                      <th>Profit</th>
                      <th>Loss</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(count($result['reports']['orders'])>0)
                  <?php $i=0; ?>
                    @foreach ($result['reports']['orders'] as $key=>$orderData)
                    <?php $i++; 
                      $proloss = App\Http\Controllers\AdminControllers\ReportsController::get_profit_loss($orderData->date_purchased);
                    ?>
                    <tr>
                        <td>{{ $orderData->date_purchased }}</td>
                        <td>{{ $orderData->total_orders }}</td> 
                        <td>{{ $orderData->total_price }} <input type="hidden" id="totalprice-<?php echo $i; ?>" value="{{ $orderData->total_price }}"><input type="hidden" id="countval" value="{{ count($result['reports']['orders']) }}"></td> 
                        <td>{{ $proloss['profit'] }}</td>
                        <td>{{ $proloss['loss'] }}</td>    
                    </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="6"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>

              <div class="col-xs-12" style="background: #eee;">
                <div class="col-xs-12 col-md-6 text-right">
                    {{ $result['reports']['orders']->appends(\Request::except('type'))->render() }}
                </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection

<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
$(function() {
  var count = $("#countval").val(); 
  var sum = 0;
  for (var i = 1; i <= count; i++){
     sum  += parseFloat($('#totalprice-'+i).val());
  }
 
    $('#grandprice').html(sum.toFixed(2));
 
});
    
</script>
