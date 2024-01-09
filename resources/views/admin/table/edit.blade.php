@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Table <small>Edit Table...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/table/view')}}"><i class="fa fa-database"></i>Table</a></li>
            <li class="active">Edit Table</li>
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
                        <h3 class="box-title">Edit Table</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <br>
                                    @if (count($errors) > 0)
                                    @if($errors->any())
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{$errors->first()}}
                                    </div>
                                    @endif
                                    @endif
                                    <div class="box-body">

                                    {!! Form::open(array('url' =>'admin/table/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                     {!! Form::hidden('id', $table->id , array('class'=>'form-control', 'id'=>'id')) !!}
                                        
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Outlet <span style="color:red;">*</span></label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control field-validate" name="outlet_id">
                                                <option value="">Select outlet</option>
                                                @if(!empty($outlet))
                                                @foreach($outlet as $jesoutlet)
                                                 @if($table->outlet == $jesoutlet->id)
                                                     @php
                                                     $dd='selected';
                                                     @endphp
                                                 @else
                                                      @php
                                                      $dd='';
                                                      @endphp
                                                 @endif
                                                  <option value="{{ $jesoutlet->id }}" {{$dd}}>{{ $jesoutlet->name }}</option>
                                                @endforeach
                                                @endif 
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Table Name<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="text" name="tname" class="form-control field-validate" value="{{$table->table_no}}">
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Maximum Person Allowed<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="number" name="nperson" class="form-control field-validate" value="{{$table->max_per}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="categories_status">
                                                  <option value="1"@if($table->status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                                  <option value="0" @if($table->status=='0') selected @endif >{{ trans('labels.Inactive') }}</option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>
                                         

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                            <a href="{{ URL::to('admin/table/view')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
{{-- <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
	$(function () {

        //for multiple languages
        @foreach($result['languages'] as $languages)
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor{{$languages->languages_id}}');

        @endforeach

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script> --}}

@endsection
