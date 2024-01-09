@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Vendor <small>Add Vendor...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/inventory/vendor')}}"><i class="fa fa-database"></i>Vendor</a></li>
            <li class="active">Add Vendor</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Vendor </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if(session()->has('message.level'))
                                    <div class="alert alert-{{ session('message.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {!! session('message.content') !!}
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        <form enctype="multipart/form-data" class="form-horizontal form-validate"  action="{{url('admin/inventory/vendorinsert')}}" method="post">
                                         {!! csrf_field() !!}
                                         <input type="hidden" name="stock_type" value="out">
                                        <div class="row">
                                            <div class="col-xs-12">
                                               
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Vendor Name<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('vendor_name', '', array('class'=>'form-control field-validate', 'id'=>'vendor_name')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter vendor name.
                                                        </span>
                                                        <span class="help-block hidden">Please enter vendor name.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Email<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('vendor_email', '', array('class'=>'form-control email-validate', 'id'=>'vendor_email')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter vendor email.
                                                        </span>
                                                        <span class="help-block hidden">Please enter vendor email.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Phone<span style="color:red;">*</span></label>
                                                    <div class="col-sm-3 col-md-3">
                                                        <select class="form-control select2 field-validate" name="ccode" id="ccode">
                                                            @if(!empty($result['countries']))
                                                                    <?php $check_code='60'; ?>
                                                                @foreach($result['countries'] as $jescode)
                                                                 <option value="{{$jescode->country_code}}" @if($jescode->country_code==$check_code) selected @endif>{{$jescode->countries_iso_code_3}}({{$jescode->country_code}})</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-8 col-md-5">
                                                        {!! Form::text('vendor_phone', '', array('class'=>'form-control number-validate', 'id'=>'vendor_phone')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter phone number.
                                                        </span>
                                                        <span class="help-block hidden">Please enter phone number.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group" id="tax-class">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Contact Name<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('contact_name', '', array('class'=>'form-control field-validate', 'id'=>'contact_name')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter the contact Name.
                                                        </span>
                                                        <span class="help-block hidden">Contact Name</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Address</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Street 1<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="street_1" name="street_1" class="form-control field-validate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Street 2<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                         <input type="text" id="street_2" name="street_2" class="form-control field-validate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6" id="product-weight-outer">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Country</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control select2 field-validate" id="entry_country_id" name="country">
                                                            <option value="">Select Country</option>
                                                            @if(!empty($result['countries']))
                                                                @foreach($result['countries'] as $jescode)
                                                                    <option value="{{$jescode->countries_id}}">{{$jescode->countries_name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">State</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control select2 field-validate zoneContent" id="entry_zone_id" name="state">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">City<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="city"  name="city" class="form-control field-validate">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Zip/Postal Code<span style="color:red;">*</span></label></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="zipcode" name="zipcode" class="form-control number-validate">
                                                    </div>
                                                </div>
                                            </div> 

                                        </div>
                                        

                                       

                                        <hr>
                                        

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right" >
                                                <span>Save</span>
                                                <i class="fa fa-angle-right 2x"></i>
                                            </button>
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
<style type="text/css">
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
    </style>
<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
@endsection