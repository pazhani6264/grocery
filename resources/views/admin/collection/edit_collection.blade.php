@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.collection') }} <small>{{ trans('labels.edit_new_collection') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/collection/view')}}"><i class="fa fa-database"></i>{{ trans('labels.collection') }}</a></li>
            <li class="active">{{ trans('labels.edit_new_collection') }}</li>
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
                        <h3 class="box-title">{{ trans('labels.edit_new_collection') }} </h3>
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

                                        {!! Form::open(array('url' =>'admin/collection/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('id', $result['editcollection'][0]->id , array('class'=>'form-control', 'id'=>'id')) !!}

                                        {!! Form::hidden('oldImage', $result['editcollection'][0]->image , array('id'=>'oldImage')) !!}
                                        

                                        @foreach($result['description'] as $description_data)
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Title') }}<span style="color:red;">*</span> ({{ $description_data['language_name'] }})</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input name="title_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['name']}}' @if($result['editcollection'][0]->id == '1') readonly=""  @elseif($result['editcollection'][0]->id == '2') readonly="" @elseif($result['editcollection'][0]->id == '3') readonly="" @elseif($result['editcollection'][0]->id == '4') readonly="" @elseif($result['editcollection'][0]->id == '10') readonly="" @endif>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    {{ trans('labels.Title') }} ({{ $description_data['language_name'] }}).</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }}<span style="color:red;">*</span> ({{ $description_data['language_name'] }}) </label>
                                            <div class="col-sm-10 col-md-6">
                                              <textarea id="editor<?=$description_data['languages_id']?>" name="description_<?=$description_data['languages_id']?>" class="form-control field-validate" rows="10" cols="80" @if($result['editcollection'][0]->id == '1') readonly=""  @elseif($result['editcollection'][0]->id == '2') readonly="" @elseif($result['editcollection'][0]->id == '3') readonly="" @elseif($result['editcollection'][0]->id == '4') readonly="" @elseif($result['editcollection'][0]->id == '10') readonly="" @endif>{{$description_data['descriptions']}}</textarea>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.Description') }} ({{ $description_data['language_name'] }})</span>
      
                                              <br>
                                            </div>
                                        </div>

                                        @endforeach

                                        
                                       

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                            <div class="col-sm-10 col-md-4">
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
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
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
                                                              <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UploadSubCategoryImage') }}</span>

                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                              <br>
                                              <img src="{{asset($result['editcollection'][0]->imgpath)}}" alt="" width=" 100px">
                                            </div>
                                        </div>

                                        <?php 
                                        if($result['editcollection'][0]->id == '1')
                                        {
                                            $statushide = 1;
                                        }
                                        elseif($result['editcollection'][0]->id == '2')
                                        {
                                            $statushide = 1;
                                        }
                                        elseif($result['editcollection'][0]->id == '3')
                                        {
                                            $statushide = 1;
                                        }
                                        elseif($result['editcollection'][0]->id == '4')
                                        {
                                            $statushide = 1;
                                        }
                                        else
                                        {
                                            $statushide = 0;
                                        }
                                        ?>


                                        @if($statushide == 1) 

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                              <input type="hidden" name="categories_status" value="1">
                                              <input type="text" class="form-control"  value="Active" readonly="">
                                        
                                          </div>
                                        </div>
                                        
                                        
                                       @else

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control" name="categories_status">
                                             <option value="1" @if($result['editcollection'][0]->status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                             <option value="0" @if($result['editcollection'][0]->status=='0') selected @endif>{{ trans('labels.Inactive') }}</option>
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                        @endif

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                            <a href="{{ URL::to('admin/collection/view')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
