@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.AddVideos') }} <small>{{ trans('labels.AddProductVideos') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/products/display') }}"><i class="fa fa-database"></i>{{ trans('labels.ListingAllProducts') }}</a></li>
                <li class="active">{{ trans('labels.AddVideos') }}</li>
            </ol>
        </section>
        <!-- Main content -->
<link href = 
"https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
            rel = "stylesheet">
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">{{ trans('labels.ListingAllProductsVideos') }} </h3>
                          <div class="box-tools pull-right">
                              <a type="button" class="btn btn-block btn-primary" href="{{url('/admin/products/videos/add/')}}/{{$products_id}}">
                                  {{ trans('labels.AddNew') }}</a>
                          </div>
                      </div>

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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th style="text-align:center">{{ trans('labels.VideoLink') }}</th>
                                            <th style="">Thumbnail</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($result['products_videos']) > 0)
                                            @foreach($result['products_videos'] as $video)
                                                    <tr>
                                                        <td>{{ $video->id }}</td>
                                                        
                                                        <td><div style="text-align:center"><?php echo $video->video_link; ?></div></td>
                                                        <td><div style=""><img src="{{asset($video->path)}}" alt="" width=" 100px"></div></td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit"  href="{{url('admin/products/videos/editproductvideo/')}}/{{$video->id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                          <a id="deleteProductVideo" data-toggle="tooltip" data-placement="bottom" title="Delete" video_id="{{$video->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                 
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

            <!-- deleteProductImageModal -->
            <div class="modal fade" id="deleteProductVideoModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/products/videos/deleteproductvideorecord', 'name'=>'deletevideo', 'id'=>'deletevideo', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'videos_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <style>
        iframe
        {
            width: auto !important;
            height: 200px !important;
        }
        </style>
@endsection


