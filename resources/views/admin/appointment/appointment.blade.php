@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Appointments </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Appointments</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
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

                            <div class="col-lg-9 form-inline">
                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/appointment/appointment_filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Product"  @if(isset($name)) @if  ($name == "Product") {{ 'selected' }} @endif @endif>Product </option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>Name</option>
                                            <option value="Phone"  @if(isset($name)) @if  ($name == "Phone") {{ 'selected' }} @endif @endif>Phone</option>
                                            <option value="Status"  @if(isset($name)) @if  ($name == "Status") {{ 'selected' }} @endif @endif>Status</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

                                        <select type="text" style="display:none;width:200px;" class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

                                            <option value="1" @if(isset($param2)) @if  ($param2 == "1") {{ 'selected' }} @endif @endif>Booked</option>
                                            <option value="2" @if(isset($param2)) @if  ($param2 == "2") {{ 'selected' }} @endif @endif>Confirmed</option>
                                            <option value="3" @if(isset($param2)) @if  ($param2 == "3") {{ 'selected' }} @endif @endif>Cancelled</option>
                                            <option value="4" @if(isset($param2)) @if  ($param2 == "4") {{ 'selected' }} @endif @endif>Completed</option>
                                            </select>

                                        <div class="form-group" style="margin:0 20px;">
                                           <!--  <p >{{ trans('labels.Choose start and end date') }}</p> -->
                                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                                            </div>

                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if((!empty($param) && !empty($name)) || (!empty($param2) && !empty($name)) || !empty($dateRange))   <a class="btn btn-danger " href="{{url('admin/appointment/appointment')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['appointment'])>0)
                                            @foreach ($result['appointment'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->products_name }}</td>
                                                    <td>{{ $resultdata->name }}</td>
                                                    <td>{{ $resultdata->phone }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($resultdata->app_date))}}</td>
                                                    <td>{{ $resultdata->app_time }}</td>
                                                    <td>{{ $resultdata->createdDate }}</td>
                                                    <td>@if($resultdata->booking_status == 1) Booked @elseif($resultdata->booking_status == 2) Confirmed @elseif($resultdata->booking_status == 3) Cancelled @elseif($resultdata->booking_status == 4) Completed @else @endif</td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="View Order" href="appointment_detail/{{ $resultdata->appID }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id ="{{ $resultdata->appID }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">

                                        {!! $result['appointment']->appends(\Request::except('page'))->render() !!}
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
                            <h4 class="modal-title" id="deleteModalLabel">Delete Appointment</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/appointment/delete_appointment', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>Are You Sure Want to delete this Appointment</p>
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
