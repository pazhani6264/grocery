@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> HTML Template 3 <small>All HTML Template 3...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/tax/taxrates/display')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.TaxRates') }}</a></li>
                <li class="active">HTML Template 3</li>
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
                                <div class="col-xs-12">
                                    
                                    <!-- form start -->
                                        <div class="box-body">

                                            {!! Form::open(array('url' =>'admin/theme/htmltemplate3_action', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-2 control-label">{{ trans('labels.Description') }} <span style="color:red;">*</span>
                                                </label>
                                                <div class="col-sm-10 col-md-8">
                                                    {!! Form::textarea('htmltemplate3',  $result['htmltemplate3']->value, array('class'=>'form-control', 'id'=>'editor1'))!!}
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <!-- <a href="{{ URL::to('admin/theme/htmltemplate1')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a> -->
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

    <script>
        $(function() {

          
            CKEDITOR.replace('editor1',
            {
            customConfig : 'config.js',
            // filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            toolbar : 'simple',
            filebrowserUploadMethod: 'form',
            });
        });
    </script>
@endsection
