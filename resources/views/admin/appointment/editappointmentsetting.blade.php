@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Edit Appointment Settings</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/appointment_setting')}}"><i class="fa fa-industry"></i> Appointment Settings</a></li>
                <li class="active">Edit Appointment Settings</li>
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
                            <h3 class="box-title">Edit Appointment Settings </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>

                                        @if (session('update'))
                                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> {{ session('update') }} </strong>
                                            </div>
                                        @endif


                                        @if (count($errors) > 0)
                                            @if($errors->any())
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    {{$errors->first()}}
                                                </div>
                                        @endif
                                    @endif
                                    <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            {!! Form::open(array('url' =>'admin/appointment/editappointmentsetting_action', 'method'=>'post', 'class' => 'form-horizontal form-validate ', 'enctype'=>'multipart/form-data')) !!}

                                            <input type="hidden" name="id" value="{{ $result['appointment_setting']->id }}"/>

                                            <select style="display:none;" class="form-control" id="eoutlet_name" name="outlet_name">
                                                        <option value="">Select</option>
                                                        @foreach($result['outlet'] as $resoutlet)
                                                            <option value="{{ $resoutlet->id }}" <?php if($result['appointment_setting']->outlet_id == $resoutlet->id){ ?> selected <?php } ?>>{{ $resoutlet->name }}</option>
                                                        @endforeach
                                                    </select>

                                          

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Outlet Name</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control"  required disabled>
                                                        <option value="">Select</option>
                                                        @foreach($result['outlet'] as $resoutlet)
                                                            <option value="{{ $resoutlet->id }}" <?php if($result['appointment_setting']->outlet_id == $resoutlet->id){ ?> selected <?php } ?>>{{ $resoutlet->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Multiple Booking</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" id="emultiple_time" name="multiple_time" required>
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if($result['appointment_setting']->multiple_time == 1){ ?> selected <?php } ?>>Yes</option>
                                                        <option value="0" <?php if($result['appointment_setting']->multiple_time == 0){ ?> selected <?php } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @if($result['appointment_setting']->multiple_time == 1)
                                                <div class="form-group" id="ebookingallowed">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">No.Of Multiple Booking Allowed</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" class="form-control" name="no_of_booking" value="{{ $result['appointment_setting']->no_of_booking }}"/>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group" id="mbookingallowed">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">No.Of Multiple Booking Allowed</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" class="form-control" name="no_of_booking" value="{{ $result['appointment_setting']->no_of_booking }}"/>
                                                </div>
                                            </div>

                                            

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Maximum No.of pax</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" class="form-control" value="{{ $result['appointment_setting']->no_of_pax }}" name="no_of_pax" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 col-md-3 control-label" style="">Services</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <label class=" control-label">
                                                        <input type="radio" name="services" value="1" class="flat-red" @if($result['appointment_setting']->services  == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="services" value="0" class="flat-red" @if($result['appointment_setting']->services  == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 col-md-3 control-label" style="">Staffs</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <label class=" control-label">
                                                        <input type="radio" name="staffs" value="1" class="flat-red" @if($result['appointment_setting']->staffs  == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="staffs" value="0" class="flat-red" @if($result['appointment_setting']->staffs  == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?php if($result['appointment_setting']->status == 1){ ?> selected <?php } ?>>{{ trans('labels.Active') }}</option>
                                                        <option value="0" <?php if($result['appointment_setting']->status == 0){ ?> selected <?php } ?>>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" id="outletID" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                                                <a href="{{ URL::to('admin/appointment/appointment_setting')}}"  type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>
                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
                                        </div>
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


            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
