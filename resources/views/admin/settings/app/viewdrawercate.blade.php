@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Drawer Category <small>Listing All The Drawer Category......</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Drawer Category</li>
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
                            {{--<h3 class="box-title">{{ trans('labels.ListingAllNews') }} </h3>--}}

                             <div class="col-lg-6 form-inline">

                                <!-- <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/news/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        {{--<span class="input-group-btn">--}}
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/news/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form> -->
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div> 
                             <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/adddrawercate')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div> 
                        </div>
                        <br>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">

                                    @if ($errors != null)
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
                                            <th>ID</th>
                                            <th>Category Type</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($result['category'])>0)
                                                @foreach ($result['category'] as $key => $jescategory)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>
                                                        @if($jescategory->type == 1)
                                                            Paid In
                                                        @elseif($jescategory->type == 2)
                                                            Paid Out
                                                         @endif
                                                    </td>
                                                    <td>{{$jescategory->cate_name}}</td>
                                                    <td>
                                                        @if($jescategory->status == 1)
                                                            <span class="label label-success">{{ trans('labels.Active') }}</span>
                                                        @elseif($jescategory->status == 2)
                                                            <span class="label label-danger">{{ trans('labels.Deactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{url('admin/editdrawercate')}}/{{ $jescategory->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a id="deleteDrawer" drawercate_id="{{$jescategory->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">{{ trans('labels.NoRecordFound') }}.</td>
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

            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteDrawerCate" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteNewsModalLabel">Delete Drawer Category</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/deletedrawercate', 'name'=>'deleteNews', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('drawercate_id',  '', array('class'=>'form-control', 'id'=>'drawercate_id')) !!}
                        <div class="modal-body">
                            <p>Are you sure you want to delete this drawer category?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteNews">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
