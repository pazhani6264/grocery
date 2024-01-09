@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Subscribe <small>Subscribe...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Subscribe</li>
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
                            <h3 class="box-title">Subscribe </h3>
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
                                        <?php $current_theme = DB::table('current_theme')->where('id', '=', '1')->first(); ?>

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

                                            {!! Form::open(array('url' =>'admin/updatesubscribeSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                            <br>
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Select Style</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select id="selectvalue" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="sliderType">
                                                        <option value="1" @if($current_theme->subscribe == 1) selected @endif>Subscribe Style 1</option>
                                                        <option value="2" @if($current_theme->subscribe == 2) selected @endif>Subscribe Style 2</option>
                                                        <option value="3" @if($current_theme->subscribe == 3) selected @endif>Subscribe Style 3</option>
                                                        <option value="4"  @if($current_theme->subscribe == 4) selected @endif>Subscribe Style 4</option>
                                                        <option value="5" @if($current_theme->subscribe == 5) selected @endif>Subscribe Style 5</option>
                                                        <option value="6" @if($current_theme->subscribe == 6) selected @endif>Subscribe Style 6</option>
                                                        <option value="7" @if($current_theme->subscribe == 7) selected @endif>Subscribe Style 7</option>
                                                        <option value="8" @if($current_theme->subscribe == 8) selected @endif>Subscribe Style 8</option>
                                                        <option value="9" @if($current_theme->subscribe == 9)selected @endif>Subscribe Style 9</option>
                                                        <option value="10" @if($current_theme->subscribe == 10) selected @endif>Subscribe Style 10</option>
                                                        <option value="11" @if($current_theme->subscribe == 11) selected @endif>Subscribe Style 11</option>
                                                        <option value="12" @if($current_theme->subscribe == 12) selected @endif>Subscribe Style 12</option>
                                                        <option value="13" @if($current_theme->subscribe == 13) selected @endif>Subscribe Style 13</option>
                                                        <option value="14" @if($current_theme->subscribe == 14) selected @endif>Subscribe Style 14</option>
                                                        <option value="15" @if($current_theme->subscribe == 15) selected @endif>Subscribe Style 15</option>
                                                        <option value="16" @if($current_theme->subscribe == 16) selected @endif>Subscribe Style 16</option>
                                                        <option value="17" @if($current_theme->subscribe == 17) selected @endif>Subscribe Style 17</option>
                                                        <option value="18" @if($current_theme->subscribe == 18) selected @endif>Subscribe Style 18</option>
                                                        <option value="19" @if($current_theme->subscribe == 19) selected @endif>Subscribe Style 19</option>
                                                        <option value="20" @if($current_theme->subscribe == 20) selected @endif>Subscribe Style 20</option>
                                                        <option value="21" @if($current_theme->subscribe == 21) selected @endif>Subscribe Style 21</option>
                                                    </select>
                                                </div>
                                            </div>
                       
                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Background Image <span id="desktopscreenSize">( 1600 * 400 )</span></label>
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
                                                                    <select class="image-picker show-html " name="website_logo" id="select_img">
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
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px; text-align: left">upload background image</span>

                                                    <br>
                                                </div>
                                            </div>                                            


                                            <div class="form-group" id="oldimg">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                                    <br>
                                                   

                                                    {!! Form::hidden('oldImage',  $result['subscribe']->subscribe_image_id , array('id'=>'website_logo')) !!}
                                                    <img src="{{asset($result['subscribe']->image_path)}}" alt="" width="80px">
                                                </div>
                                            </div>

                                           
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                                <div class="col-sm-10 col-md-4">
                                                
                                                    {!! Form::text('title',  $result['subscribe']->subscribe_title, array('class'=>'form-control', 'id'=>'title')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Please enter title</span>
                                                </div>
                                            </div>



                                            
                                          
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::textarea('desc',  $result['subscribe']->subscribe_description, array('class'=>'form-control', 'id'=>'desc')) !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Please Enter description</span>
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

    <script>
 
  var defvalue = $( "#selectvalue" ).val();
    addoption(defvalue);
   
   

    $( "#selectvalue" ).change(function() {
   
        var x =  $( "#selectvalue" ).val();
        addoption(x);

    });


    function addoption(x){

      if(x == 1){
          $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 425 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 2){
          $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1435 * 250 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 3){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 120 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 4){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 330 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 5){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1435 * 364 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 6){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 7){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 578 * 578 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 8){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 9){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1435 * 374 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 10){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 11){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 12){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 13){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1435 * 359 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 14){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1435 * 260 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 15){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 16){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 494 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 17){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 481 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 18){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 19){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 517 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        } else if(x == 20){
          $( "#desktopscreenSize" ).hide();
          $( "#imageIcone" ).hide();
          $( "#oldimg" ).hide();
        } else if(x == 21){
            $( "#desktopscreenSize" ).show();
          $( "#desktopscreenSize" ).html('( 1920 * 255 )');
          $( "#imageIcone" ).show();
          $( "#oldimg" ).show();
        }

    }

   
  </script>
@endsection
