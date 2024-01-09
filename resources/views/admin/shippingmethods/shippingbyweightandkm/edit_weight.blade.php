@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Edit Shipping By Weight <small>Edit Shipping By Weight...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/shippingmethods/shippingbyweightandkm/display')}}"><i class="fa fa-database"></i> {{ trans('labels.shippingbykm') }}</a></li>
                <li class="active">Edit Shipping By Weight</li>
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
                            <h3 class="box-title">Edit Shipping By Weight</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>
                                        @if (count($errors) > 0)
                                            @if($errors->any())
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    {{$errors->first()}}
                                                </div>
                                        @endif
                                    @endif
                                    <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">

                                            {!! Form::open(array('url' =>'admin/shippingmethods/shippingbyweightandkm/update_weight', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                            {!! Form::hidden('weight_id',  $result['weight'][0]->id , array('class'=>'form-control', 'id'=>'weight_id')) !!}
                   


                                              
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.weightfrom') }} (Gm)<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="from_weight" value="{{$result['weight'][0]->from_weight_km}}" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbyweightfrom') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.weightto') }} (Gm)<span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="to_weight" value="{{$result['weight'][0]->to_weight_km}}" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbyweightto') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.weightprice') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="price_weight" value="{{$result['weight'][0]->price_weight_km}}" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbyweightprice') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.deliveryboycommission') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="commission_weight" value="{{$result['weight'][0]->commission_weight_km}}" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbykmdeliveryboycommission') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                          

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="status">
                                                        <option value="1" @if($result['weight'][0]->status==1) selected @endif>{{ trans('labels.Active') }}</option>
                                                        <option value="0" @if($result['weight'][0]->status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                {{ trans('labels.GeneralStatusText') }}</span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/shippingmethods/shippingbyweightandkm/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
