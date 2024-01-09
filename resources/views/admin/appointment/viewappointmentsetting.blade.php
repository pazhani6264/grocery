@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Appointments Settings</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Appointments Settings</li>
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

                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/appointment/appointment_setting_filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="outlet_name"  @if(isset($name)) @if  ($name == "outlet_name") {{ 'selected' }} @endif @endif>Outlet Name </option>
                                            <option value="booking"  @if(isset($name)) @if  ($name == "booking") {{ 'selected' }} @endif @endif>Booking</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

                                        <select type="text" style="display:none;width:200px;" class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

<option value="1" @if(isset($param2)) @if  ($param2 == "1") {{ 'selected' }} @endif @endif>Yes</option>
<option value="2" @if(isset($param2)) @if  ($param2 == "2") {{ 'selected' }} @endif @endif>No</option>

</select>


                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if((!empty($param) && !empty($name)) || (!empty($param2) && !empty($name)))  <a class="btn btn-danger " href="{{url('admin/appointment/appointment_setting')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="col-lg-3 pull-right">
                          <!--   <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_appointment_setting_view == 1){ ?>
                                <a href="{{url('admin/appointment/addappointmentsetting')}}" type="button" class="btn btn-block btn-primary">Add Appontments Settings</a>
                            <?php }?> -->
                            </div>
                            <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Outlet Name</th>
                                            <th>Multiple Booking</th>
                                            <th>Multiple Booking Allowed</th>
                                            <th>Max No.of pax</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['appointment_setting'])>0)
                                            @foreach ($result['appointment_setting'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->name }}</td>
                                                    @if($resultdata->multiple_time == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{ $resultdata->no_of_booking }}</td>
                                                    <td>{{ $resultdata->no_of_pax }}</td>
                                                    @if($resultdata->appStatus == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_appointment_setting_view == 1){ ?>
                                                            <a  href="editappointmentsetting/{{ $resultdata->appoID }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->delete_appointment_setting_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete Appointment" id="deleteOrdersId" orders_id ="{{ $resultdata->appoID }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php } ?>
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

                                        {!! $result['appointment_setting']->appends(\Request::except('page'))->render() !!}
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
                        {!! Form::open(array('url' =>'admin/appointment/delete_appointment_setting', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>Are You Sure You want to delete Appointment Settings</p>
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
        if(val == 'booking')
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
