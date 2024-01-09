@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.AddImages') }} <small>{{ trans('labels.AddProductImages') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/products/display') }}"><i class="fa fa-database"></i>{{ trans('labels.ListingAllProductsImages') }}</a></li>
                <li class="active">{{ trans('labels.AddImages') }}</li>
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
                          <h3 class="box-title">{{ trans('labels.ListingAllProductsImages') }} </h3>
                          <div class="box-tools pull-right">
                              <a type="button" class="btn btn-block btn-primary" href="{{url('/admin/products/images/add/')}}/{{$products_id}}">
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
                            <div id = "imageListId">
                              @if (count($result['products_images']) > 0)
                                  @foreach($result['products_images'] as $products_image)

                                            <div class="col-xs-4 col-md-2 margin-bottomset listitemClass" id="imageNo{{$products_image->id}}" >
                                                <div class="thumbnail">
                                                    <div class="caption">

                                                      <a class="badge bg-light-blue editProductImagesModal" data-toggle="tooltip" data-placement="bottom" title="Edit"  href="{{url('admin/products/images/editproductimage/')}}/{{$products_image->id}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                      <a products_id = '{{ $products_image->products_id }}' data-toggle="tooltip" data-placement="bottom" title="Delete" id = "{{ $products_image->id }}" class="badge bg-red deleteProductImagesModal"><i class="fa fa-trash " aria-hidden="true"></i></a></td>
                                               </div>
                                                    <img width="200px" height="300px"src="{{asset($products_image->path)}}" alt="...">
                                                     {{-- Sort Order : {{ $products_image->sort_order}} --}}
                                                </div>
                                            </div>

                                        @endforeach

                                    @endif

                                </div>
                                    <div class="col-xs-12 text-right">

                                    </div>

                            </div>

                            <div class="box-footer text-center">
                            {!! Form::open(array('url' =>'/admin/products/successMsg', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                <input type="hidden" name="furl" value="{{ Session::get('furl') }}"/>
                                <button style="border:none" type="submit" class="btn btn-default">{{ trans('labels.Save_And_complete') }}</button>
                            {!! Form::close() !!}


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
            <div class="modal fade" id="deleteProductImageModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductImageModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content deleteImageEmbed">

                    </div>
                </div>


            </div>


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
