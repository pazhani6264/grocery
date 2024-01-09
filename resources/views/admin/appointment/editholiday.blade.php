@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Edit {{ $result['holiday']->name }} Booking Holiday</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/holiday')}}"><i class="fa fa-industry"></i>Booking Holiday</a></li>
                <li class="active">Edit {{ $result['holiday']->name }} Booking Holiday</li>
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
                            <h3 class="box-title">Edit {{ $result['holiday']->name }} Booking Holiday</h3>
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

                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> {{ session('error') }} </strong>
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
                                
                                        <div class="box-body"><br>
                                            {!! Form::open(array('url' =>'admin/appointment/edit_holiday_action', 'method'=>'post', 'class' => 'form-horizontal form-validate ', 'enctype'=>'multipart/form-data')) !!}

                                            <input type="hidden" name="editholiday_id" value="{{ $result['holiday']->id }}"/>
                                            <input type="hidden" name="outlet_id" value="{{ $result['holiday']->outlet_id }}"/>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Date</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control datepicker" type="text" value="{{ date('d/m/Y', strtotime($result['holiday']->date)) }}" name="date" id="dateholiday" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?php if($result['holiday']->status == 1){ echo "selected"; ?> <?php }?>>{{ trans('labels.Active') }}</option>
                                                        <option value="0" <?php if($result['holiday']->status == 0){ echo "selected"; ?> <?php }?>>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                                                <a href="{{ URL::to('admin/appointment/view_slot')}}/{{ $result['holiday']->outlet_id }}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
