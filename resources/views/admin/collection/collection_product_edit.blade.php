@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.editNewcollection') }} <small>{{ trans('labels.editNewcollection') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/collection/view')}}"><i class="fa fa-database"></i>{{ trans('labels.collection') }}</a></li>
            <li class="active">{{ trans('labels.editNewcollection') }}</li>
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
                        <h3 class="box-title">{{ trans('labels.editNewcollection') }} </h3>
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

                                    {!! Form::open(array('url' =>'admin/collection/update_product', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                    {!! Form::hidden('id', $product->id , array('class'=>'form-control', 'id'=>'id')) !!}
                                        
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.collection') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control field-validate" name="collection_id">
                                                <option value="">select collection</option>
                                                @if(!empty($collection))
                                                @foreach($collection as $jescollection)
                                                  <option  @if($product->collection_id == $jescollection->id) selected @endif value="{{ $jescollection->id }}">{{ $jescollection->name }}</option>
                                                @endforeach
                                                @endif 
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.MainCategories') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control field-validate" name="categories" id="entry_categories_id">
                                            <option value="">select Categories</option>
                                            @if(!empty($category))
                                            @foreach($category as $jescategory)
                                                <option @if($product->category_id == $jescategory->categories_id) selected @endif value="{{ $jescategory->categories_id }}">{{ $jescategory->categories_name }}</option>
                                            @endforeach
                                            @endif    
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                         <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }} </label>
                                          <div class="col-sm-10 col-md-4">
                                            <select class="form-control field-validate zoneContent" name="product_id">
                                            <option value="">select Products</option>
                                            @if(!empty($getproduct))
                                            @foreach($getproduct as $jesproduct)
                                              <option @if($product->product_id == $jesproduct->products_id) selected @endif value="{{ $jesproduct->products_id }}">{{ $jesproduct->products_name }}</option>  
                                            @endforeach
                                            @endif
                                            </select>
                                          <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                          {{ trans('labels.GeneralStatusText') }}</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control" name="status">
                                                       <option value="1" @if($product->status=='1') selected @endif>{{ trans('labels.Active') }}</option>
                                                  <option value="0" @if($product->status=='0') selected @endif>{{ trans('labels.Inactive') }}</option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                      {{ trans('labels.StatusInfo') }}</span>
                                                </div>
                                            </div>

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
