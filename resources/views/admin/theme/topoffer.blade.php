@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Top Offer') }} <small>{{ trans('labels.Top Offer') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.Top Offer') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.Top Offer') }} </h3>
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

                                            {!! Form::open(array('url' =>'admin/topoffer/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                            {!! Form::hidden('oldImage',  $result['offers']->type_value, array('id'=>'oldImage')) !!}


                                            <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.Top Offer') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="topstatus" value="1" class="flat-red" @if($result['offers']->topoffer_status == '1') checked @endif > &nbsp;{{ trans('labels.enable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="topstatus" value="0" class="flat-red" @if($result['offers']->topoffer_status == '0') checked @endif >  &nbsp;{{ trans('labels.Disable') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Style </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" id="style" name="style">
                                                        <option value="1" @if($result['offers']->style=='1') selected @endif>Style-1</option>
                                                        <option value="2" @if($result['offers']->style=='2') selected @endif>Style-2</option>
                                                        <option value="3" @if($result['offers']->style=='3') selected @endif>Style-3</option>
                                                        <option value="4" @if($result['offers']->style=='4') selected @endif>Style-4</option>
                                                        <option value="5" @if($result['offers']->style=='5') selected @endif>Style-5</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style1" @if($result['offers']->style!='1') style="display: none" @endif >
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <img width="200%" style="border: 1px solid #f5f5f5;" src="{{ asset('admin/top-offer/style1.png') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style2" @if($result['offers']->style!='2') style="display: none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <img width="200%" style="border: 1px solid #f5f5f5;" src="{{ asset('admin/top-offer/style2.png') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style3" @if($result['offers']->style!='3') style="display: none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <img width="200%" style="border: 1px solid #f5f5f5;" src="{{ asset('admin/top-offer/style3.png') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style4" @if($result['offers']->style!='4') style="display: none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <img width="200%" style="border: 1px solid #f5f5f5;" src="{{ asset('admin/top-offer/style4.png') }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group" id="style5" @if($result['offers']->style!='5') style="display: none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Sample Demo </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <img width="200%" style="border: 1px solid #f5f5f5;" src="{{ asset('admin/top-offer/style5.png') }}"/>
                                                </div>
                                            </div>
                               
                               
                                            @foreach($result['offer']['description'] as $description_data)
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Top Offer') }} ({{ $description_data['language_name'] }})</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <textarea id="editor<?=$description_data['languages_id']?>" name="top_offers_text_<?=$description_data['languages_id']?>" class="form-control field-validate" rows="10" cols="80">{{stripslashes($description_data['top_offers_text'])}}</textarea>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Top Offer Text') }} ({{ $description_data['language_name'] }})</span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            @endforeach    


                                            <!-- <div class="form-group" id="showbg">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Background type </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" id="type"  name="type">
                                                        <option value="Image" @if($result['offers']->type=='Image') selected @endif>Image</option>
                                                        <option value="Color" @if($result['offers']->type=='Color') selected @endif>Color</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-group" id="bgimage" @if($result['offers']->style!='3' && $result['offers']->style!='4') style="display: none" @endif >
                                                <div class="form-group" id="imageIcone">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Background Image</label>
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

                                                                        <select class="image-picker show-html " name="bg_image" id="select_img">
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
                                                        {!! Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )) !!}
                                                        <br>
                                                            <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                            <div class="closimage">
                                                                <button type="button" class="close pull-left image-close " id="image-Icone"
                                                                    style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div>
                                                            @if($result['offers']->style == '3' || $result['offers']->style == '4')
                                                                @if(($result['languages'][0]->path!== null))
                                                                    <img width="200px" src="{{asset($result['offers']->path)}}">
                                                                @else
                                                                    <img width="200px" src="{{asset($result['offers']->path) }}">
                                                                @endif
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="bgcolor" @if($result['offers']->style!='1' && $result['offers']->style!='2' && $result['offers']->style!='5') style="display: none" @endif>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Background color</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control" id="bg_color" name="bg_color" type="color" value="{{ $result['offers']->type_value }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Text color</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input class="form-control field-validate" id="text_color" name="text_color" type="color" value="{{ $result['offers']->text_color }}">
                                                </div>
                                            </div>

                                            <div class="box-header">
                            <h3 class="box-title">Header Offers</h3>
                        </div>

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
                                        <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Title </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" class="form-control field-validate" id="head_offer_title" name="head_offer_title" value="{{ $result['commonContent']['setting']['head_offer_title'] }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">URL </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="url" class="form-control field-validate" id="head_offer_url" name="head_offer_url" value="{{ $result['commonContent']['setting']['head_offer_url'] }}">
                                                    
                                                </div>
                                            </div>




                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

                                        <div class="box-header">
                            <h3 class="box-title">Top Bar</h3>
                        </div>

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

                                        <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Title </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" class="form-control field-validate" id="top_bar_title" name="top_bar_title" value="{{ $result['commonContent']['setting']['top_bar_title'] }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">URL </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="url" class="form-control field-validate" id="top_bar_url" name="top_bar_url" value="{{ $result['commonContent']['setting']['top_bar_url'] }}">
                                                    
                                                </div>
                                            </div>


                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                           
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/news/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
	$(function () {

        //for multiple languages
        @foreach($result['languages'] as $languages)
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor{{$languages->languages_id}}',
            
            {
          customConfig : 'config.js',
          filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
          toolbar : 'simple',
          filebrowserUploadMethod: 'form',
        });

        @endforeach

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
    

@endsection
