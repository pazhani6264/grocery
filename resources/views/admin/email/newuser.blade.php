@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.newuser') }} <small>{{ trans('labels.newuser') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.newuser') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.newuser') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Setting') }}Error:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif
                                            
                                            {!! Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                            <br>
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.newuser_subject') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('newuser_subject', $result['commonContent']['setting']['newuser_subject'], array('class'=>'form-control', 'id'=>'newuser_subject')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.newuser_subject') }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                                                            
                                           
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.newuser_template_body') }}</label>
                                                <div class="col-sm-10 col-md-8">
                                                <textarea id="editor" name="newuser_template_body" class="form-control field-validate" rows="10" cols="80">{{stripslashes($result['commonContent']['setting']['newuser_template_body'])}}</textarea>                                      
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.newuser_template_body') }}</span>
                                                </div>
                                            </div>
                                                                           
                                        <hr>
                                        <!-- <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.newuser_template_footer') }}</label>
                                                <div class="col-sm-10 col-md-8">
                                                {!! Form::textarea('newuser_template_footer', $result['commonContent']['setting']['newuser_template_footer'] , array('class'=>'form-control', 'id'=>'editor2')) !!}                                         
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.newuser_template_footer') }}</span>
                                                </div>
                                            </div>

                                        </div>
 -->
                                        

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                            <a href="{{ URL::to('admin/dashboard/this_month')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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

            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    
<script type="text/javascript">
    $(function() {

       
        CKEDITOR.replace('editor',
        {
          customConfig : 'config.js',
          filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
          toolbar : 'simple',
          
          filebrowserUploadMethod: 'form',
        });
        
       /*  CKEDITOR.replace('editor2',
        {
          customConfig : 'config.js',
          filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
          toolbar : 'simple',
          filebrowserUploadMethod: 'form',
        }); */
      

    });
</script>
@endsection
