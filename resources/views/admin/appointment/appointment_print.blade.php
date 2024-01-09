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

    <!-- /.row -->

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
                @if( app('request')->input('customers_id'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Customers') }}</label>
                        @foreach($result['customers'] as $customers)
                         <p> @if  (app('request')->input('customers_id') == $customers->id) {{$customers->first_name}} {{$customers->last_name}} @endif </p>
                        @endforeach
                  </div>
                </div>
                @endif
                @if( app('request')->input('orders_status_id'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.OrdersStatus') }}</label>
                        @foreach($result['orderstatus'] as $status)
                        <p>  @if  (app('request')->input('orders_status_id') == $status->orders_status_id) {{$status->orders_status_name}} @endif</p>
                        @endforeach
                  </div>
                </div>
                @endif
                @if( app('request')->input('deliveryboys_id'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Choose Devlieryboy') }}</label>
                        @foreach($result['deliveryboys'] as $deliveryboy)
                        <p> @if  (app('request')->input('deliveryboys_id') == $deliveryboy->id) {{$deliveryboy->first_name}} {{$deliveryboy->last_name}} @endif </p>
                        @endforeach
                  </div>
                </div>
                @endif

                
                @if( app('request')->input('orderid'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.OrderID') }}</label>
                        <p> {{app('request')->input('orderid')}} </p>
                  </div>
                </div>
                @endif
      
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



    <div class="row">
      <div class="col-md-12">
        <div class="box">
                
              
          <!-- /.box-header -->
  
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>{{ trans('labels.ID') }}</th>
                      <th>{{ trans('labels.CustomerName') }}</th>
                      <th>{{ trans('labels.Order Source') }}</th>
                      <th>{{ trans('labels.OrderTotal') }}</th>
                      <th>{{ trans('labels.DatePurchased') }}</th>
                      <th>{{ trans('labels.Status') }} </th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(count($result['reports']['orders']) > 0)
                    @foreach ($result['reports']['orders'] as $key=>$orderData)
                    <tr>
                        <td>{{ $orderData->id }}</td>
                        <td>{{ $orderData->first_name }}</td>
                        <td>
                            {{ trans('labels.Website') }}
                        </td>
                        <td>
                            @if( $result['commonContent']['currency']->symbol_left == app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif {{ $orderData->products_price }} @if($result['commonContent']['currency']->symbol_left != app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif</td>
                        <td>{{ date('d/m/Y', strtotime($orderData->app_date)) }}</td>
                        <td>
                            @if($orderData->orders_status_id==1)
                                <span class="label label-warning">
                            @elseif($orderData->orders_status_id==2)
                                <span class="label label-success">
                            @elseif($orderData->orders_status_id==3)
                                <span class="label label-danger">
                            @else
                                <span class="label label-primary">
                            @endif
                            {{ $orderData->orders_status }}
                                </span>
                        </td>
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
</body>