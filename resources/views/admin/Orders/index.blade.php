@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Orders') }} <small>{{ trans('labels.ListingAllOrders') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.Orders') }}</li>
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

                            <h3 class="box-title">{{ trans('labels.ListingAllOrders') }} </h3>
                            <br>
                            <br> 
                            <br>
                            <div class="col-lg-9 form-inline">
                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/orders/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                            <option value="ID"  @if(isset($name)) @if  ($name == "ID") {{ 'selected' }} @endif @endif>Order ID</option>
                                            <option value="Status"  @if(isset($name)) @if  ($name == "Status") {{ 'selected' }} @endif @endif>Status</option>
                                        </select>
                                        <input type="text" style="width:200px;" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

                                       

                                        <select type="text" style="display:none;width:200px;" class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

                                            <option value="All" @if(isset($param2)) @if  ($param2 == "All") {{ 'selected' }} @endif @endif>All</option>
                                            <option value="1" @if(isset($param2)) @if  ($param2 == "1") {{ 'selected' }} @endif @endif>Pending</option>
                                            <option value="2" @if(isset($param2)) @if  ($param2 == "2") {{ 'selected' }} @endif @endif>Completed</option>
                                            <option value="3" @if(isset($param2)) @if  ($param2 == "3") {{ 'selected' }} @endif @endif>Cancel</option>
                                            <option value="5" @if(isset($param2)) @if  ($param2 == "5") {{ 'selected' }} @endif @endif>Inprocess</option>
                                            <option value="7" @if(isset($param2)) @if  ($param2 == "7") {{ 'selected' }} @endif @endif>Dispatched</option>
                                            <option value="6" @if(isset($param2)) @if  ($param2 == "6") {{ 'selected' }} @endif @endif>Delivered</option>
                                            
                                        </select>

                                        <!-- <div class="col-xs-3"> -->
                                            <div class="form-group" style="margin:0 20px;">
                                           <!--  <p >{{ trans('labels.Choose start and end date') }}</p> -->
                                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                                            </div>
                                        <!-- </div> -->

                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if((!empty($param) && !empty($name)) || (!empty($param2) && !empty($name)) || !empty($dateRange))   <a class="btn btn-danger " href="{{url('admin/orders/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
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
                                            <th>Payment Status</th>
                                            <th>{{ trans('labels.Status') }} </th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($listingOrders['orders'])>0)
                                            @foreach ($listingOrders['orders'] as $key=>$orderData)
                                                <tr>
                                                    <td>#{{$result['commonContent']['setting']['invoice_prefix']}}{{ $orderData->orders_id}}</td>
                                                    <td>{{ $orderData->customers_name }}</td>
                                                    <td>
                                                        @if($orderData->ordered_source == 1)
                                                        {{ trans('labels.Website') }}
                                                        @elseif($orderData->ordered_source == 2)
                                                        {{ trans('labels.Application') }}
                                                        @else
                                                        Cashier POS
                                                        @endif</td>
                                                    <td>

                                                    <?php 
            $symbol_left = DB::table('currencies')->where('symbol_left', '=', $orderData->currency)->first(); 
          

            ?>
                                                        
                                                        @if($symbol_left != '')  {{ $orderData->currency }}  {{ $orderData->order_price *  $orderData->currency_value }} @else  {{ $orderData->order_price *  $orderData->currency_value }}  {{ $orderData->currency }} @endif</td>
                                                    <td>{{ date('d/m/Y', strtotime($orderData->date_purchased)) }}</td>
                                                    <td>
                                                        @if($orderData->payment_status==1) 
                                                            <span class="label label-success">Paid</span>
                                                        @elseif($orderData->payment_status==2)
                                                            <span class="label label-warning">Pending</span>
                                                        @elseif($orderData->payment_status==3)
                                                            <span class="label label-danger">Failed</span>
                                                        @elseif($orderData->payment_status==4)
                                                            <span class="label label-primary">Refund</span>
                                                        @endif
                                                    </td>
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
                                                    
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="View Order" href="vieworder/{{ $orderData->orders_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id ="{{ $orderData->orders_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
                                        {{$listingOrders['orders']->links()}}
                                    </div>
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

            <!-- deleteModal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.DeleteOrder') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/orders/deleteOrder', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteOrderText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteOrder">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">

$( "#registration" ).on('click','#submit',function( event ) {

var param =  $( "#parameter" ).val();
var select = $( "#FilterBy" ).val();

      //if( (select == null) || (param == "")) {
      if(param == "") {
          $( "#contact-form12" ).text( "fill the credentials!" ).css({'color':'red'}).show().fadeOut( 10000 );
          $( "#parameter" ).css({'border-color':'red'});
          $( "select" ).css({'border-color':'red'});
          event.preventDefault();
      }else {
        // $( "#contact-form12" ).text( "fill the credentials!" ).css({'padding-left':'10px','margin-right':'20px','padding-bottom':'2px', 'color':'red'}).show().fadeOut( 10000 );
        //     event.preventDefault();
      }
});

    var val  =$("#search_filter" ).val();

    getselectbox(val);

    $('#search_filter').on('change', function() {
        getselectbox(this.value);
});

    function getselectbox(val)
    {
        if(val == 'Status')
        {
            $("#parameter").hide();
            $("#parameter2").show();
        }
        else
        {
            $("#parameter").show();
            $("#parameter2").hide();
        }
        

    }
   
</script>

@endsection
