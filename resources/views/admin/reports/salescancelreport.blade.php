@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cancel Report (Sales) <small>Cancel Report (Sales)...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Cancel Report (Sales)</li>
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
                  <form method="get" id="form_submit_sales" action="{{url('admin/salescancelreport')}}">
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

                            <div class="col-xs-3">
                            <div class="form-group">
                            <p>Select Type</p>
                              <select type="button" class="btn btn-default select2 form-control" data-toggle="dropdown" name="ptype" id="ptype" style="width:100%;">
                                  <option value="" @if(app('request')->input('ptype') == '') {{ 'selected' }} @endif>All</option>
                                  <option value="3" @if(app('request')->input('ptype') == '3') {{ 'selected' }} @endif>Combo</option>
                                  <option value="4" @if(app('request')->input('ptype') == '4') {{ 'selected' }} @endif>Buy X</option>
                                  <option value="5" @if(app('request')->input('ptype') == '5') {{ 'selected' }} @endif>Get X</option>
                              </select>
                            </div>
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
                            
                            <div class="col-xs-2" style="padding-top: 30px">                  
                  <div class="form-group">               
                              <button class="btn btn-primary" type="submit" style="height:35px;"><span class="glyphicon glyphicon-search"></span></button>

                              
                                @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{url('admin/salesreport')}}" style="height:35px;"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
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


              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12"> 
                    <button type="button" onclick="gettype('All')" class="btn @if(isset($_REQUEST['platform']))  @if($_REQUEST['platform'] == 'All') btn-success @else btn-secondary @endif @else btn-success @endif" >All<span> (<?php echo $result['reports']['allcount']; ?>) </span></button>
                    <button type="button" onclick="gettype('Website')" class="btn @if(isset($_REQUEST['platform']) and ($_REQUEST['platform']) == 'Website') btn-success @else btn-secondary @endif">Website <span> (<?php echo $result['reports']['websitecount']; ?>) </span></button>
                    <button type="button" onclick="gettype('Pos')" class="btn @if(isset($_REQUEST['platform']) and ($_REQUEST['platform']) == 'Pos') btn-success @else btn-secondary @endif">Pos Cashier <span> (<?php echo $result['reports']['poscount']; ?>) </span></button>
                    <button type="button" onclick="gettype('App')" class="btn @if(isset($_REQUEST['platform']) and ($_REQUEST['platform']) == 'App') btn-success @else btn-secondary @endif">APP <span> (<?php echo $result['reports']['appcount']; ?>) </span></button>
                  </div>
                </div>
              </div>

                
                

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 
            <!--   <span><b>Sales Report showing for date : </b> {{ $result['dateFrom'] }} - {{ $result['dateTo'] }}</span> -->
              <span><b>NOTE : </b> Showing sales Report From {{ $result['dateFrom'] }} To {{ $result['dateTo'] }} </span>
              <div class="box-tools pull-right">
                <!-- <h2><small>{{trans('labels.Total Sale Price')}}:</small>@if( $result['commonContent']['currency']->symbol_left == app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif {{$result['price']}} @if($result['commonContent']['currency']->symbol_left != app('request')->input('currency') ) {{ app('request')->input('currency') }} @endif </h2> -->
                <?php $tt =number_format((float)$result['reports']['total_pricenew'], 2, '.', ''); ?>
                <h2><small>{{trans('labels.Total Sale Price')}}:</small><small> @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif <span id="">{{ $tt }}</span>  @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif </h2>
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Date & Time</th>
                      <th>Receipt No.</th>
                      @if(isset($_REQUEST['platform']) and ($_REQUEST['platform']) == 'All') 
                      <th>Ordered Source</th>
                      @endif
                      <th>{{ trans('labels.OrderTotal') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if(count($result['reports']['orders'])>0)
                  <?php $i=0; ?>
                    @foreach ($result['reports']['orders'] as $key=>$orderData)
                    <?php $i++; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$orderData->date_purchased}}</td> 
                        <td><a href="javascript:;" onclick="loadOrderProduct({{$orderData->orders_id}})">{{$result['commonContent']['setting']['invoice_prefix']}}{{$orderData->orders_id}}</a></td>
                        @if(isset($_REQUEST['platform']) and ($_REQUEST['platform']) == 'All') 
                        <td>@if($orderData->ordered_source == 1)
                  {{ trans('labels.Website') }}
                  @elseif($orderData->ordered_source == 2)
                  {{ trans('labels.Application') }}
                  @else
                  Cashier POS
                  @endif</td>
                      @endif
                        <td>@if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{$orderData->order_price}} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif<input type="hidden" id="totalprice-<?php echo $i; ?>" value="{{ $orderData->order_price }}"><input type="hidden" id="countval" value="{{ count($result['reports']['orders']) }}"></td>    
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

              <div class="col-xs-12">
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
    <div class="modal fade" id="myOrderProduct" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Order Product List</h4>
                        </div>
                        <div class="modal-body">
                            <div id="viewOrderProduct"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->


  <!-- Main content -->
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
              <h4><b> Showing Top 5 Best selling Products </b></h4>
              <div class="box-tools pull-right">
               
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Product</th>
                      <th>Count</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @if(count($result['reports']['top_products'])>0)
                  <?php $i=0; ?>
                    @foreach ($result['reports']['top_products'] as $key=>$top)
                    <?php $i++; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$top->products_name}}</td>
                        <td>{{$top->total_sales}}</td>
                    </tr>
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
    
    <!-- /.row -->
  </section>

  <!-- Main content -->
  <section class="content" style="padding-top:0">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
                 

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 
              <h4><b> Showing Top 5 Best selling Categories </b></h4>
              <div class="box-tools pull-right">
               
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Category</th>
                      <th>Count</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @if(count($result['reports']['topcats'])>0)
                  <?php $i=0; ?>
                    @foreach ($result['reports']['topcats'] as $key=>$topcat)
                    <?php $i++; ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$topcat->categories_name}}</td>
                        <td>{{$topcat->total_sales}}</td>
                    </tr>
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
    
    <!-- /.row -->
  </section>
  <!-- /.content -->
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
