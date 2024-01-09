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
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

   
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>