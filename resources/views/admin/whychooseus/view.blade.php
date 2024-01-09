@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> WhyChooseUs</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">WhyChooseUs</li>
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
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/whychooseus/whychooseus_filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>Name</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/whychooseus/whychooseus')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <!-- <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_outlet_view == 1){ ?>
                                    <a href="{{url('admin/whychooseus/add_whychooseus')}}" type="button" class="btn btn-block btn-primary">Add WhyChooseUs</a>
                                <?php } ?> -->
                            </div>
                            <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Title 1</th>
                                            <th>Title 2</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['whychooseus'])>0)
                                            @foreach ($result['whychooseus'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->name }}</td>
                                                    <td>{{ $resultdata->name1 }}</td>
                                                    <td>{{ $resultdata->description }}</td>
                                                    <td><img src="{{asset($resultdata->path)}}" alt="" width=" 100px"></td>
                                                    @if($resultdata->status == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->slot_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Add Title"  href="viewwhychooseusimage/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_whychooseus_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit Whychooseus"  href="edit_whychooseus/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <!-- <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->delete_whychooseus_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete Whychooseus" id="deleteOrdersId" orders_id ="{{ $resultdata->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

                                        {!! $result['whychooseus']->appends(\Request::except('page'))->render() !!}
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
                            <h4 class="modal-title" id="deleteModalLabel">Delete WhyChooseUs</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/whychooseus/delete_whychooseus', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>Are You Sure You want to delete WhyChooseUs</p>
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
