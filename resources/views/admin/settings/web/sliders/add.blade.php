@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.AddSliderImage') }} <small>{{ trans('labels.AddSliderImage') }}...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/sliders')}}"><i class="fa fa-bars"></i> {{ trans('labels.Sliders') }}</a></li>
      <li class="active">{{ trans('labels.AddSliderImage') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <style>
      .selectedthumbnail {
          display: block;
          margin-bottom: 10px;
          padding: 0;
      }
      .thumbnail {
          padding: 0;
      }
      .closimage{
        position: relative
      }
      </style>

    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('labels.AddSliderImage') }}</h3>
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
                         <?php $current_theme = DB::table('current_theme')->where('id', '=', '1')->first(); ?>

                            {!! Form::open(array('url' =>'admin/addNewSlide', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                            	<div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Language') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="languages_id">
                                          @foreach($result['languages'] as $language)
                                              <option value="{{$language->languages_id}}">{{ $language->name }}</option>
                                          @endforeach
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseLanguageText') }}</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Slider Type') }}</label>
                                    <div class="col-sm-10 col-md-4">
                                        <select  id="selectvalue" class="form-control field-validate" name="carousel_id">
                                        @if($current_theme->template == 0)
                                          @if($current_theme->carousel == 1)
                                            <option value="1" selected>Carousel Style 1</option>
                                          @endif
                                          @if($current_theme->carousel == 2)
                                           <option value="2" selected>Carousel Style 2</option>
                                           @endif
                                          @if($current_theme->carousel == 3)
                                           <option value="3" selected>Carousel Style 3</option>
                                           @endif
                                          @if($current_theme->carousel == 4)
                                           <option value="4" selected>Carousel Style 4</option>
                                           @endif
                                          @if($current_theme->carousel == 5)
                                           <option value="5" selected>Carousel Style 5</option>
                                           @endif
                                          @if($current_theme->carousel == 20)
                                           <option value="20" selected>Carousel Style 20</option>
                                           @endif
                                          @if($current_theme->carousel == 24)
                                           <option value="19" selected>Carousel Style 19</option>
                                           @endif
                                          @if($current_theme->carousel == 6)
                                           <option value="6" selected>Carousel Style 6 (Demo-1)</option>
                                           @endif
                                          @if($current_theme->carousel == 7)
                                            <option value="7" selected>Carousel Style 7 (Demo-2)</option>
                                            @endif
                                          @if($current_theme->carousel == 8)
                                            <option value="8" selected>Carousel Style 8 (Demo-3)</option>
                                            @endif
                                          @if($current_theme->carousel == 9)
                                            <option value="9" selected>Carousel Style 9 (Demo-4)</option>
                                            @endif
                                          @if($current_theme->carousel == 10)
                                            <option value="10" selected>Carousel Style 10 (Demo-5)</option>
                                            @endif
                                          @if($current_theme->carousel == 11)
                                            <option value="11" selected>Carousel Style 11 (Demo-6)</option>
                                            @endif
                                          @if($current_theme->carousel == 22)
                                            <option value="22" selected>Carousel Style 22 (Demo-8)</option>
                                            @endif
                                          @if($current_theme->carousel == 12)
                                            <option value="12" selected>Carousel Style 12 (Demo-9)</option>
                                            @endif
                                          @if($current_theme->carousel == 23)
                                            <option value="23" selected>Carousel Style 23 (Demo-10)</option>
                                            @endif
                                          @if($current_theme->carousel == 13)
                                            <option value="13" selected>Carousel Style 13 (Demo-11)</option>
                                            @endif
                                          @if($current_theme->carousel == 25)
                                            <option value="25" selected>Carousel Style 25 (Demo-12)</option>
                                            @endif
                                          @if($current_theme->carousel == 26)
                                            <option value="26" selected>Carousel Style 26 (Demo-13)</option>
                                            @endif
                                          @if($current_theme->carousel == 14)
                                            <option value="14" selected>Carousel Style 14 (Demo-14)</option>
                                            @endif
                                          @if($current_theme->carousel == 30)
                                            <option value="30" selected>Carousel Style 30 (Demo-15)</option>
                                            @endif
                                          @if($current_theme->carousel == 27)
                                            <option value="27" selected>Carousel Style 27 (Demo-16)</option>
                                            @endif
                                          @if($current_theme->carousel == 28)
                                            <option value="28" selected>Carousel Style 28 (Demo-18)</option>
                                            @endif
                                          @if($current_theme->carousel == 34)
                                            <option value="34" selected>Carousel Style 34 (Demo-19)</option>
                                            @endif
                                          @if($current_theme->carousel == 15)
                                            <option value="15" selected>Carousel Style 15 (Demo-21)</option>
                                            @endif
                                          @if($current_theme->carousel == 29)
                                            <option value="29" selected>Carousel Style 29 (Demo-22)</option>
                                            @endif
                                          @if($current_theme->carousel == 31)
                                            <option value="31" selected>Carousel Style 31 (Demo-23)</option>
                                            @endif
                                          @if($current_theme->carousel == 32)
                                            <option value="32" selected>Carousel Style 32 (Demo-24)</option>
                                            @endif
                                          @if($current_theme->carousel == 33)
                                            <option value="33" selected>Carousel Style 33 (Demo-25)</option>
                                            @endif
                                          @if($current_theme->carousel == 16)
                                            <option value="16" selected>Carousel Style 16 (Demo-26)</option>
                                            @endif
                                          @if($current_theme->carousel == 35)
                                            <option value="35" selected>Carousel Style 35 (Demo-27)</option>
                                            @endif
                                          @if($current_theme->carousel == 17)
                                            <option value="17" selected>Carousel Style 17 (Demo-28)</option>
                                            @endif
                                          @if($current_theme->carousel == 36)
                                            <option value="36" selected>Carousel Style 36 (Demo-29)</option>
                                            @endif
                                          @if($current_theme->carousel == 37)
                                            <option value="37" selected>Carousel Style 37 (Demo-30)</option>
                                            @endif
                                          @if($current_theme->carousel == 38)
                                            <option value="38" selected>Carousel Style 38 (Demo-31)</option>
                                            @endif
                                          @if($current_theme->carousel == 19)
                                            <option value="19" selected>Carousel Style 19 (Demo-32,33)</option>
                                            @endif
                                          @if($current_theme->carousel == 18)
                                            <option value="18" selected>Carousel Style 18 (Demo-34)</option>
                                            @endif
                                          @if($current_theme->carousel == 21)
                                            <option value="21" selected>Carousel Style 21 (Demo-35)</option>
                                            @endif
                                            @endif

                                            @if($current_theme->template == 1)
                                            <option value="6" selected>Carousel Style 6 (Demo-1)</option>
                                            @endif
                                            @if($current_theme->template == 2)
                                            <option value="7" selected>Carousel Style 7 (Demo-2)</option>
                                            @endif
                                            @if($current_theme->template == 3)
                                            <option value="8" selected>Carousel Style 8 (Demo-3)</option>
                                            @endif
                                            @if($current_theme->template == 4)
                                            <option value="9" selected>Carousel Style 9 (Demo-4)</option>
                                            @endif
                                            @if($current_theme->template == 5)
                                            <option value="10" selected>Carousel Style 10 (Demo-5)</option>
                                            @endif
                                            @if($current_theme->template == 6)
                                            <option value="11" selected>Carousel Style 11 (Demo-6)</option>
                                            @endif
                                            @if($current_theme->template == 8)
                                            <option value="22" selected>Carousel Style 22 (Demo-8)</option>
                                            @endif
                                            @if($current_theme->template == 9)
                                            <option value="12" selected>Carousel Style 12 (Demo-9)</option>
                                            @endif
                                            @if($current_theme->template == 10)
                                            <option value="23" selected>Carousel Style 23 (Demo-10)</option>
                                            @endif
                                            @if($current_theme->template == 11)
                                            <option value="13" selected>Carousel Style 13 (Demo-11)</option>
                                            @endif
                                            @if($current_theme->template == 12)
                                            <option value="25" selected>Carousel Style 25 (Demo-12)</option>
                                            @endif
                                            @if($current_theme->template == 13)
                                            <option value="26" selected>Carousel Style 26 (Demo-13)</option>
                                            @endif
                                            @if($current_theme->template == 14)
                                            <option value="14" selected>Carousel Style 14 (Demo-14)</option>
                                            @endif
                                            @if($current_theme->template == 15)
                                            <option value="30" selected>Carousel Style 30 (Demo-15)</option>
                                            @endif
                                            @if($current_theme->template == 16)
                                            <option value="27" selected>Carousel Style 27 (Demo-16)</option>
                                            @endif
                                            @if($current_theme->template == 18)
                                            <option value="28" selected>Carousel Style 28 (Demo-18)</option>
                                            @endif
                                            @if($current_theme->template == 19)
                                            <option value="34" selected>Carousel Style 34 (Demo-19)</option>
                                            @endif
                                            @if($current_theme->template == 21)
                                            <option value="15" selected>Carousel Style 15 (Demo-21)</option>
                                            @endif
                                            @if($current_theme->template == 22)
                                            <option value="29" selected>Carousel Style 29 (Demo-22)</option>
                                            @endif
                                            @if($current_theme->template == 23)
                                            <option value="31" selected>Carousel Style 31 (Demo-23)</option>
                                            @endif
                                            @if($current_theme->template == 24)
                                            <option value="32" selected>Carousel Style 32 (Demo-24)</option>
                                            @endif
                                            @if($current_theme->template == 25)
                                            <option value="33" selected>Carousel Style 33 (Demo-25)</option>
                                            @endif
                                            @if($current_theme->template == 26)
                                            <option value="16" selected>Carousel Style 16 (Demo-26)</option>
                                            @endif
                                            @if($current_theme->template == 27)
                                            <option value="35" selected>Carousel Style 35 (Demo-27)</option>
                                            @endif
                                            @if($current_theme->template == 28)
                                            <option value="17" selected>Carousel Style 17 (Demo-28)</option>
                                            @endif
                                            @if($current_theme->template == 29)
                                            <option value="36" selected>Carousel Style 36 (Demo-29)</option>
                                            @endif
                                            @if($current_theme->template == 30)
                                            <option value="37" selected>Carousel Style 37 (Demo-30)</option>
                                            @endif
                                            @if($current_theme->template == 31)
                                            <option value="38" selected>Carousel Style 38 (Demo-31)</option>
                                            @endif
                                            @if($current_theme->template == 32)
                                            <option value="19" selected>Carousel Style 19 (Demo-32)</option>
                                            @endif
                                            @if($current_theme->template == 33)
                                            <option value="19" selected>Carousel Style 19 (Demo-33)</option>
                                            @endif
                                            @if($current_theme->template == 34)
                                            <option value="18" selected>Carousel Style 18 (Demo-34)</option>
                                            @endif
                                            @if($current_theme->template == 35)
                                            <option value="21" selected>Carousel Style 21 (Demo-35)</option>
                                            @endif


                                        </select>
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.SliderTypeText') }}</span>
                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                    </div>
                                </div>
                                <div class="form-group" id="imageselected">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Slider Desktop Image <span id="desktopscreenSize">( 1600 * 400 )</span> <span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html field-validate" name="image_id" id="select_img">
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
                                                               <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                    {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                    <br>
                                                    <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                    <div class="closimage">
                                                        <button type="button" class="close pull-left image-close " id="image-close"
                                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                               <!--  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryImageText') }}</span> -->
                                            </div>
                                        </div>

                                        <div class="form-group" id="imageIcone">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Slider Mobile Image <span id="mobilescreenSize">( 400 * 400 )</span> <span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                              </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-htmls field-validate" name="image_icone" id="select_img">
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
                                                              <button type="button" class="btn btn-primary" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                  {!! Form::button('Add Mobile Image', array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-Icone"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                </div>
                                               <!--  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryIconText') }}</span> -->

                                            </div>
                                        </div>










                                        <div class="form-group" id="imageIconetab">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Slider Tab Image <span id="tabscreenSize">( 400 * 400 )</span> <span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalmanufacturedIConetab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                              </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-htmls" name="image_iconetab" id="select_img">
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
                                                              <button type="button" class="btn btn-primary" id="selectedICONEtab" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imageselected">
                                                  {!! Form::button('Add Tab Image', array('id'=>'newIcontab','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedIConetab" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnailIcontab" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-Iconetab"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                </div>
                                               <!--  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryIconText') }}</span> -->

                                            </div>
                                        </div>

                              @if($current_theme->carousel != 1 && $current_theme->carousel != 2 && $current_theme->carousel != 3 && $current_theme->carousel != 4 && $current_theme->carousel != 5 && $current_theme->carousel != 21)
                                        <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                  <div class="col-sm-10 col-md-4">
                                  {!! Form::text('title', '', array('class'=>'form-control','id'=>'title')) !!}
                                 
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      Please enter title here</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                  <div class="col-sm-10 col-md-4">
                                  {!! Form::text('description', '', array('class'=>'form-control','id'=>'description')) !!}
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      Please enter description here</span>
                                  </div>
                                </div>
                            @endif
                              
                                @if($current_theme->carousel == 6 || $current_theme->carousel == 8 || $current_theme->carousel == 9 || $current_theme->carousel == 10 || $current_theme->carousel == 12 || $current_theme->carousel == 14 || $current_theme->carousel == 15 || $current_theme->carousel == 16 || $current_theme->carousel == 17 || $current_theme->carousel == 18 || $current_theme->carousel == 19 || $current_theme->carousel == 22 || $current_theme->carousel == 23 || $current_theme->carousel == 24 || $current_theme->carousel == 26 || $current_theme->carousel == 29 || $current_theme->carousel == 32 || $current_theme->carousel == 33 || $current_theme->carousel == 37 )
                                  <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label">Description Two</label>
                                    <div class="col-sm-10 col-md-4">
                                    {!! Form::text('description2', '', array('class'=>'form-control','id'=>'description2')) !!}
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        Please enter description here</span>
                                    </div>
                                  </div>
                                @endif

                                @if($current_theme->carousel != 1 && $current_theme->carousel != 2 && $current_theme->carousel != 3 && $current_theme->carousel != 4 && $current_theme->carousel != 5 && $current_theme->carousel != 21)
                                  <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label">Button Name</label>
                                    <div class="col-sm-10 col-md-4">
                                    {!! Form::text('name', '', array('class'=>'form-control','id'=>'name')) !!}
                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        Please enter button name here</span>
                                    </div>
                                  </div>
                                @endif

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SliderNavigation') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="type" id="bannerType">
                                          <option value="category">{{ trans('labels.Category') }}</option>
                                          <option value="product">{{ trans('labels.Product') }}</option>
                                          <option value="topseller">{{ trans('labels.TopSeller') }}</option>
                                          <option value="special">{{ trans('labels.Deals') }}</option>
                                          <option value="mostliked">{{ trans('labels.MostLiked') }}</option>
                                          <option value="link">Link</option>
                                          <option value="externallink">External Link</option>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.SliderNavigationText') }}</span>
                                  </div>
                                </div>

                                <div class="form-group categoryContent">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Categories') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="categories_id" id="categories_id">
                                      @foreach($result['categories'] as $category)
                                		<option value="{{ $category->slug}}">{{ $category->name}}</option>
                                      @endforeach
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.CategoriessliderText') }}</span>
                                  </div>
                                </div>
                                <div class="form-group linkContent">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Link</label>
                                  <div class="col-sm-10 col-md-4">
                                  <input name="linkContent" class="form-control">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>
                                  <div class="form-group external_linkContent">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">External Link</label>
                                  <div class="col-sm-10 col-md-4">
                                  <input name="externl_linkContent" class="form-control">
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.textRequiredFieldMessage') }}</span>
                                  </div>
                                </div>


                                <div class="form-group productContent" style="display: none">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_id" id="products_id">
                                      @foreach($result['products'] as $products_data)
                                		<option value="{{ $products_data->products_slug }}">{{ $products_data->products_name }}</option>
                                      @endforeach
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ProductsSliderText') }}</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExpiryDate') }} <span style="color:red;">*</span></label>
                                  <div class="col-sm-10 col-md-4">
                                    <input readonly class="form-control datepicker field-validate" type="text" name="expires_date" value="">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.ExpiryDateSlider') }}</span>
                                  </div>
                                </div>

                                <div class="form-group" hidden>
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1">{{ trans('labels.Active') }}</option>
                                          <option value="0">{{ trans('labels.InActive') }}</option>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.StatusSliderText') }}</span>
                                  </div>
                                </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/sliders')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
<script>
   $( "#imageIconetab" ).hide();
  $( ".imageIconetab" ).hide();

  var defvalue = $( "#selectvalue" ).val();
    addoption(defvalue);
   
   

    $( "#selectvalue" ).change(function() {
      $( "#imageIconetab" ).hide();
      $( ".imageIconetab" ).hide();
        var x =  $( "#selectvalue" ).val();
        addoption(x);

    });


    function addoption(x){

      if(x == 1){
          $( "#desktopscreenSize" ).html('( 1600 * 420 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
         
         
        } else if(x == 2){
          $( "#desktopscreenSize" ).html('( 1170 * 420 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
        
         
        } else if(x == 3){
          $( "#desktopscreenSize" ).html('( 770 * 400 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
         
         
        } else if(x == 4){
          $( "#desktopscreenSize" ).html('( 770 * 400 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
         
         
        } else if(x == 5){
          $( "#desktopscreenSize" ).html('( 770 * 400 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
         
         
        } else if(x == 6){
          $( "#desktopscreenSize" ).html('( 1920 * 500 )');
          $( "#mobilescreenSize" ).html('( 400 * 460 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 7){
          $( "#desktopscreenSize" ).html('( 770 * 430 )');
          $( "#mobilescreenSize" ).html('( 400 * 430 )');
          $( "#tabscreenSize" ).html('( 768 * 630 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 8){
          $( "#desktopscreenSize" ).html('( 768 * 400 )');
          $( "#mobilescreenSize" ).html('( 400 * 420 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 9){
          $( "#desktopscreenSize" ).html('( 1920 * 460 )');
          $( "#mobilescreenSize" ).html('( 400 * 400 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 10){
          $( "#desktopscreenSize" ).html('( 1920 * 782 )');
          $( "#mobilescreenSize" ).html('( 400 * 782 )');
          $( "#tabscreenSize" ).html('( 768 * 1000 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 11){
          $( "#desktopscreenSize" ).html('( 1920 * 600 )');
          $( "#mobilescreenSize" ).html('( 400 * 360 )');
          $( "#tabscreenSize" ).html('( 768 * 660 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 12){
          $( "#desktopscreenSize" ).html('( 1170 * 500 )');
          $( "#mobilescreenSize" ).html('( 400 * 500 )');
          $( "#tabscreenSize" ).html('( 768 * 700 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 13){
          $( "#desktopscreenSize" ).html('( 1920 * 560 )');
          $( "#mobilescreenSize" ).html('( 400 * 560 )');
          $( "#tabscreenSize" ).html('( 768 * 650 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 14){
          $( "#desktopscreenSize" ).html('( 1180 * 500 )');
          $( "#mobilescreenSize" ).html('( 400 * 500 )');
          $( "#tabscreenSize" ).html('( 768 * 700 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 15){
          $( "#desktopscreenSize" ).html('( 1920 * 600 )');
          $( "#mobilescreenSize" ).html('( 400 * 500 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        } else if(x == 16){
          $( "#desktopscreenSize" ).html('( 832 * 486 )');
          $( "#mobilescreenSize" ).html('( 400 * 600 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
        } else if(x == 17){
          $( "#desktopscreenSize" ).html('( 1440 * 440 )');
          $( "#mobilescreenSize" ).html('( 400 * 486 )');
          $( "#tabscreenSize" ).html('( 768 * 640 )');
          $( "#imageIconetab" ).show();
        } else if(x == 18){
          $( "#desktopscreenSize" ).html('( 926 * 430 )');
          $( "#mobilescreenSize" ).html('( 400 * 440 )');
          $( "#tabscreenSize" ).html('( 926 * 430 )');
          $( "#imageIconetab" ).show();
        }
        else if(x == 19){
          $( "#desktopscreenSize" ).html('( 1903 * 660 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
        }
        else if(x == 20){
          $( "#desktopscreenSize" ).html('( 797 * 235 )');
          $( "#mobilescreenSize" ).html('( 400 * 440 )');
          $( "#tabscreenSize" ).html('( 768 * 400 )');
          $( "#imageIconetab" ).show();
        }
        else if(x == 21){
          $( "#desktopscreenSize" ).html('( 1512 * 302 )');
          $( "#mobilescreenSize" ).html('( 400 * 360 )');
          $( "#tabscreenSize" ).html('( 768 * 400 )');
          $( "#imageIconetab" ).show();
         
        }

        else if(x == 22){
          $( "#desktopscreenSize" ).html('( (1920 * 700) )');
          $( "#mobilescreenSize" ).html('( 400 * 700 )');
          $( "#tabscreenSize" ).html('( 768 * 700 )');
          $( "#imageIconetab" ).show();
         
        }else if(x == 23){
          $( "#desktopscreenSize" ).html('( 1170 * 500 )');
          $( "#mobilescreenSize" ).html('( 400 * 600 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        }

        else if(x == 25){
          $( "#desktopscreenSize" ).html('( 1920 * 840 )');
          $( "#mobilescreenSize" ).html('( 400 * 1000 )');
          $( "#tabscreenSize" ).html('( 768 * 1000 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 26){
          $( "#desktopscreenSize" ).html('( 1920 * 500 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 27){
          $( "#desktopscreenSize" ).html('( 1920 * 560 )');
          $( "#mobilescreenSize" ).html('( 400 * 850 )');
          $( "#tabscreenSize" ).html('( 768 * 850 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 28){
          $( "#desktopscreenSize" ).html('( 1920 * 800 )');
          $( "#mobilescreenSize" ).html('( 400 * 800 )');
          $( "#tabscreenSize" ).html('( 768 * 800 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 29){
          $( "#desktopscreenSize" ).html('( 770 * 400 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 770 * 640 )');
          $( "#imageIconetab" ).show();
        }
       
        else if(x == 30){
          $( "#desktopscreenSize" ).html('( 1920 * 800 )');
          $( "#mobilescreenSize" ).html('( 400 * 1000 )');
          $( "#tabscreenSize" ).html('( 768 * 1000 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 31){
          $( "#desktopscreenSize" ).html('( 1480 * 741 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 900 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 32){
          $( "#desktopscreenSize" ).html('( 1920 * 670 )');
          $( "#mobilescreenSize" ).html('( 400 * 600 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 33){
          $( "#desktopscreenSize" ).html('( 1903 * 600 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 800 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 34){
          $( "#desktopscreenSize" ).html('( 456 * 750 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 456 * 750 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 35){
          $( "#desktopscreenSize" ).html('( 1903 * 1070 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 800 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 36){
          $( "#desktopscreenSize" ).html('( 1440 * 560 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 800 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 37){
          $( "#desktopscreenSize" ).html('( 1903 * 640 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        }
        else if(x == 38){
          $( "#desktopscreenSize" ).html('( 1400 * 650 )');
          $( "#mobilescreenSize" ).html('( 400 * 640 )');
          $( "#tabscreenSize" ).html('( 768 * 600 )');
          $( "#imageIconetab" ).show();
         
        }

    }

   
  </script>
@endsection
