@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.pos_settings') }} <small>{{ trans('labels.pos_settings') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.pos_settings') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.pos_settings') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Setting') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                            <h4>{{ trans('labels.generalSetting') }} </h4>
                                            <hr>

                                             <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.pos_color') }}</label>

                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control field-validate" id="pos_color" name="pos_color" type="color" value="{{ $result['commonContent']['setting']['pos_color'] }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.app_share_link') }}

                                                </label>
 
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('share_app_url_pos',  $result['commonContent']['setting']['share_app_url_pos'], array('class'=>'form-control', 'id'=>'share_app_url_pos')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.packageNameText_pos') }}</span>
                                                </div>
                                            </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.pos_tips') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="pos_tips" value="1" class="flat-red" @if($result['commonContent']['setting']['pos_tips'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="pos_tips" value="0" class="flat-red" @if($result['commonContent']['setting']['pos_tips'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Salesperson Commission</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="salesperson_commission" value="1" class="flat-red" @if($result['commonContent']['setting']['salesperson_commission'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="salesperson_commission" value="0" class="flat-red" @if($result['commonContent']['setting']['salesperson_commission'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        </div>



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
@endsection
