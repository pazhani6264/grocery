@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Gallery Image</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Gallery Image</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
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

                            <div class="col-lg-6 form-inline">
                            </div>
                            <div class="col-lg-3 pull-right">
                                <!-- <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_outlet_view == 1){ ?>
                                    <a href="{{url('admin/gallery/add_galleryimage')}}/{{ $result['gallery']->id }}" type="button" class="btn btn-block btn-primary">Add Gallery Image</a>
                                <?php } ?> -->
                            </div>
                            <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['galleryimage'])>0)
                                            @foreach ($result['galleryimage'] as $key=>$resultdata)
                                                <tr>
                                                    <td><img src="{{asset($resultdata->path)}}" alt="" width=" 100px"></td>
                                                    @if($resultdata->status == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_galleryimage_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit galleryimage"  href="../edit_galleryimage/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <!-- <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->delete_galleryimage_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete galleryimage" id="deleteOrdersId" orders_id ="{{ $resultdata->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php } ?> -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="11">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">

                                        {!! $result['galleryimage']->appends(\Request::except('page'))->render() !!}
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


            <!-- deleteModal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">Delete Gallery Image</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/gallery/delete_galleryimage', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>Are You Sure You want to delete Gallery Image</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteOrder">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
