@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Email') }} <small>{{ trans('labels.emailsetting') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.emailsetting') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.emailsetting') }} </h3>
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
                                                                            
                                           
                                            <!-- <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.mailgun_api_key') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('mail_chimp_api', $result['commonContent']['setting']['mail_chimp_api'], array('class'=>'form-control', 'id'=>'mail_chimp_api')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.mailgun_api_key') }}</span>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.mailgun_domain') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('mail_chimp_list_id',$result['commonContent']['setting']['mail_chimp_list_id'], array('class'=>'form-control', 'id'=>'mail_chimp_list_id')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.mailgun_domain') }}</span>
                                                </div>
                                            </div> -->

                                           <!--  <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.newUser') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="newuser" value="1" class="flat-red" @if($result['commonContent']['setting']['newuser'] == '1') checked @endif > &nbsp;{{ trans('labels.enable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="newuser" value="0" class="flat-red" @if($result['commonContent']['setting']['newuser'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
 -->
                                            <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.MailChimp') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="newsletter" value="1" class="flat-red" @if($result['commonContent']['setting']['newsletter'] == '1') checked @endif > &nbsp;{{ trans('labels.enable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="newsletter" value="0" class="flat-red" @if($result['commonContent']['setting']['newsletter'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div> 

                                        <hr>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('newsletter_title', $result['commonContent']['setting']['newsletter_title'], array('class'=>'form-control', 'id'=>'newsletter_title')) !!}
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::textarea('newsletter_description', $result['commonContent']['setting']['newsletter_description'], array('class'=>'form-control', 'id'=>'newsletter_description')) !!}
                                                </div>
                                            </div>

                                        
                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Newsletter Image') }} (399 * 552)</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <!-- Modal -->
                                                    <div class="modal fade embed-images" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                    <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                                </div>
                                                                
                                                                <div class="modal-body manufacturer-image-embed">
                                                                    @if(isset($allimage))
                                                                    <select class="image-picker show-html " name="newsletter_image" id="select_img">
                                                                        <option value=""></option>
                                                                        @foreach($allimage as $key=>$image)
                                                                          <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                                    <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                    <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="imageselected">
                                                      {!! Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )) !!}
                                                      <br>
                                                      <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5" style="display: none"> </div>
                                                      <div class="closimage">
                                                          <button type="button" class="close pull-left image-close " id="image-Icone"
                                                            style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                    </div>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px; text-align: left">{{ trans('labels.Newsletter Image') }}</span>

                                                    <br>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                                    <br>
                                                    {!! Form::hidden('oldImage',  $result['commonContent']['setting']['newsletter_image'] , array('id'=>'newsletter_image')) !!}
                                                    <img src="{{asset($result['commonContent']['setting']['newsletter_image'])}}" alt="" width="80px">
                                                </div>
                                            </div>
                                       
                                        <hr>
                                        <h4>{{ trans('labels.InqueryEmails') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ContactUsEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('contact_us_email', $result['commonContent']['setting']['contact_us_email'], array('class'=>'form-control', 'id'=>'contact_us_email')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.ContactUsEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.OrderEmail') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OrderEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('order_email', $result['commonContent']['setting']['order_email'], array('class'=>'form-control', 'id'=>'order_email')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.OrderEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr>

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
