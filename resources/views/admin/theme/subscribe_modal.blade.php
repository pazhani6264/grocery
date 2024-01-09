@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Subscribe Modal <small>Subscribe Modal...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Subscribe Modal</li>
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
                            <h3 class="box-title">Subscribe Modal </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit News</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/subscribeModal/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}




                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Style </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" onchange="showsubscribemodalImage();" id="style" name="style">
                                                        <option value="1" @if($result['commonContent']['setting']['subscribe_modal']=='1') selected @endif>Style-1</option>
                                                        <option value="2" @if($result['commonContent']['setting']['subscribe_modal']=='2') selected @endif>Style-2</option>
                                                        <option value="3" @if($result['commonContent']['setting']['subscribe_modal']=='3') selected @endif>Style-3</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style1" @if($result['commonContent']['setting']['subscribe_modal']!='1') style="display:none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                <img width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/subscribe_modal1.png')}}" />
                                                
                                                </div>
                                            </div>

                                            <div class="form-group" id="style2" @if($result['commonContent']['setting']['subscribe_modal']!='2') style="display:none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                <img  width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/subscribe_modal2.png')}}" />
                                                
                                                </div>
                                            </div>

                                            <div class="form-group" id="style3" @if($result['commonContent']['setting']['subscribe_modal']!='3') style="display:none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                <img  width="350px;" src="{{asset('https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/subscribe_modal3.png')}}" />
                                                
                                                </div>
                                            </div>

                                     
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/subscribe_modal/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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

    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
	
</script>
    

@endsection
