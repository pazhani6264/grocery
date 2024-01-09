@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Sales Person Report <small>Sales Person Report...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Sales Person Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="padding-bottom:0">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box" style="margin-bottom:0">
          <div class="box-header">
                  <form method="get" id="form_submit_sales" action="{{url('admin/sales_person_report')}}">
                        <input type="hidden" name="type"  value="all">
                        <input type="hidden"  value="{{csrf_token()}}">
                        <input type="hidden" name="platform" id="platform"  value="All">
                        <div class="box-body">
                          <div class="col-xs-3">
                            <div class="form-group">
                            <p >{{ trans('labels.Choose start and end date') }}</p>
                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                            </div>
                            </div>

                          
                            <div class="col-xs-2" style="padding-top: 30px">                  
                  <div class="form-group">               
                              <button class="btn btn-primary" type="submit" style="height:35px;"><span class="glyphicon glyphicon-search"></span></button>

                              
                                @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{url('admin/sales_person_report')}}" style="height:35px;"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                            </div>
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
                      <input type="hidden" name="platform" value=" @if(isset($_REQUEST['platform'])) {{$_REQUEST['platform']}} @else All @endif">
                      <input type="hidden" name="orderid" value="{{app('request')->input('orderid')}}">
                      <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</button>
                    </form>
                  </div> -->
                </div>
                 @php
                  $total_com=0;
                    if(count($result['orders'])>0){
                      foreach ($result['orders'] as $key=>$orderData){
                        $commission  = DB::table('salesperson_commission')->where('order_id', '=', $orderData->orders_id)->first();
                         if($commission){
                            $tamount=$commission->amount * $orderData->currency_value;
                         }else{
                            $tamount='0';
                         }
                        $total_com=$total_com+$tamount;
                     }
                    }
                @endphp

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="box-tools pull-right">
                  <h2><small>Total Commission Price:</small><small> @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif <span id="">{{$total_com}}</span>  @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif </h2>
                </div>

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>{{ trans('labels.ID') }}</th>
                      <th>{{ trans('labels.CustomerName') }}</th>
                      <th>{{ trans('labels.Order Source') }}</th>
                      <th>{{ trans('labels.OrderTotal') }}</th>
                      <th>{{ trans('labels.DatePurchased') }}</th>
                      <th>Sales Person Commission</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(count($result['orders'])>0)
                      @foreach ($result['orders'] as $key=>$orderData)
                      @php
                        $symbol_left = DB::table('currencies')->where('symbol_left', '=', $orderData->currency)->first();
                        $commission  = DB::table('salesperson_commission')->where('order_id', '=', $orderData->orders_id)->first();
                      @endphp
        
                    <tr style="color: {{$orderData->order_status_id=='3' ? 'red': ''}} ">
                        <td><a data-toggle="tooltip" data-placement="bottom" title="View Order" href="orders/vieworder/{{ $orderData->orders_id }}" class="badge bg-light-blue">#{{$result['commonContent']['setting']['invoice_prefix']}}{{ $orderData->orders_id}}</a></td>
                        <td>{{ $orderData->customers_name }}</td> 
                        <td>
                          @if($orderData->ordered_source == 1)
                              {{ trans('labels.Website') }}
                          @elseif($orderData->ordered_source == 2)
                              {{ trans('labels.Application') }}
                          @else
                              Cashier POS
                          @endif
                        </td>
                        <td>
                          @if($symbol_left != '')  {{ $orderData->currency }}  {{ $orderData->order_price *  $orderData->currency_value }} @else  {{ $orderData->order_price *  $orderData->currency_value }}  {{ $orderData->currency }} @endif
                        </td>
                        <td>{{ date('d/m/Y', strtotime($orderData->date_purchased)) }}</td> 
                        <td>
                          @if($commission)
                            @if($symbol_left != '')  {{ $orderData->currency }}  {{ $commission->amount *  $orderData->currency_value }} @else  {{ $commission->amount *  $orderData->currency_value }}  {{ $orderData->currency }} @endif
                          @else
                            @if($symbol_left != '')  {{ $orderData->currency }}  {{ 0.00 }} @else  {{ 0.00 }}  {{ $orderData->currency }} @endif
                          @endif

                        </td>
                        <td>
                          <a data-toggle="tooltip" data-placement="bottom" onclick="loadModalSalesPerson({{$orderData->orders_id}})" title="View" href="javascript:;" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                <div class="col-xs-12 text-right">
                    {{$result['orders']->links()}}
                </div>
              </div>

              <div class="col-xs-12">
                <div class="col-xs-12 col-md-6 text-right">
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

  <section class="content" style="padding-top:0;padding-bottom:0;">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box" style="margin-bottom:0;">
          <div class="box-header">
                 

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 
              <h4><b>Each Sales Person Commission</b></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Sales Person</th>
                      <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(count($result['salesman'])>0)
                      @foreach ($result['salesman'] as $key=>$jessale)
                      <?php
                        $searchvalue=$jessale->id;
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($result['dateFrom']));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($result['dateTo']));
                        $data = DB::table('salesperson_commission')
                          ->LeftJoin('orders', 'orders.orders_id', '=', 'salesperson_commission.order_id')
                          ->where('orders.order_status_id', '!=', '3')
                          ->whereBetween('salesperson_commission.created_at', [$dateFrom, $dateTo])
                          ->whereRaw('FIND_IN_SET(?, salesperson_commission.salesperson_id)', [$searchvalue])->get();
                          $total_amount=0;

                        if(count($data)>0){
                          foreach ($data as $jesdata){
                             $total_amount= $total_amount+ $jesdata->single_amount;
                          }
                        }
                      ?>
                      @if($total_amount != '0')
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$jessale->first_name}} {{$jessale->last_name}}</td>
                        <td>
                             @if($result['commonContent']['currency']->symbol_left != '')  {{ $result['commonContent']['currency']->symbol_left }}  {{ $total_amount *  $result['commonContent']['currency']->value }} @else  {{ $total_amount *  $result['commonContent']['currency']->value }}  {{ $result['commonContent']['currency']->symbol_right }} @endif
                        </td>
                    </tr>
                    @endif
                      @endforeach
                    @else
                    <tr>
                      <td colspan="3"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
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
     <div class="modal fade" id="mySalesPersonView" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">View Sales Person</h4>
                        </div>
                        <div class="modal-body">
                             <div id="myEventSalesPerson"></div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.row -->
  </section>
  
</div>

@endsection

<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">

function gettype(type)
{
  $(document).ready(function() {
  $('#platform').val(type);
 
  $('#form_submit_sales').submit();
  
}); 
}




$(function() {
  var count = $("#countval").val(); 
  var sum = 0;
  for (var i = 1; i <= count; i++){
     sum  += parseFloat($('#totalprice-'+i).val());
  }
 
    $('#grandprice').html(sum.toFixed(2));
 
});

function loadOrderProduct(modal){
  
    var options = {
            modal: true,
            height:300,
            width:500
        };
    $('#viewOrderProduct').load('{{ URL::to('admin/salesreportdetail')}}/'+modal, function(data) {
      //alert(data);
       $('#myOrderProduct').modal({show:true});
    });    
}
    
</script>
