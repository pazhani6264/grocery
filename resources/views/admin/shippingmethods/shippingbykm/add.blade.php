@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.Addshippingbykm') }} <small>{{ trans('labels.Addshippingbykm') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/shippingmethods/shippingbykm/display')}}"><i class="fa fa-database"></i> {{ trans('labels.Listingshippingbykm') }}</a></li>
      <li class="active">{{ trans('labels.Addshippingbykm') }}</li>
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
            <h3 class="box-title">{{ trans('labels.Addshippingbykm') }} </h3>
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

                        <!-- form start -->
                         <div class="box-body">

                            {!! Form::open(array('url' =>'admin/shippingmethods/shippingbykm/insert', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                            
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.kmfrom') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="kmfrom" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbykmfrom') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.kmto') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="kmto" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbykmto') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.kmprice') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="kmprice" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbykmprice') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.deliveryboycommission') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input type="text" name="kmcommission" class="form-control field-validate">
                                  		<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.shippingbykmdeliveryboycommission') }}</span>

                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                              
                 
                               
                               <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                <div class="col-sm-10 col-md-4">
                                  <select class="form-control" name="kmstatus">
                                        <option value="1">{{ trans('labels.Active') }}</option>
                                        <option value="0">{{ trans('labels.Inactive') }}</option>
                                  </select>
                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                {{ trans('labels.GeneralStatusText') }}</span>
                                </div>
                               </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/shippingmethods/shippingbykm/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
