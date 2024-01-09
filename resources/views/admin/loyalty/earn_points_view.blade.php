@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.loyalty') }} <small>{{ trans('labels.ListingAllearnpoints') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.loyalty') }}</li>
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
                            <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/loyalty/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Title')}}</option>
                                            <!-- <option value="Main"  @if(isset($name)) @if  ($name == "Main") {{ 'selected' }} @endif @endif>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/loyalty/earn_points_view')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            {{-- <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/loyalty/add_earn_points')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNewCategory') }}</a>
                            </div> --}}
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
                                            <th>@sortablelink('id', trans('labels.ID') )</th>
                                            <th>{{ trans('labels.Title') }}</th>
                                            <th>{{ trans('labels.Descriptions') }}</th>
                                            <th>{{ trans('labels.amount') }}</th>
                                            <th>{{ trans('labels.point') }}</th>
                                            <th>{{ trans('labels.Icon') }}</th>
                                            <th>@sortablelink('earn_points_settings.created_at', trans('labels.AddedLastModifiedDate') )</th>
                                            <th>@sortablelink('status', trans('labels.Status'))</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($earn_points)>0)
                                            @php $earn_unique = $earn_points->unique('id'); @endphp
                                            @foreach ($earn_points as $key=>$earn)
                                            <tr>
                                                <td>@if($earn->id == -1) 0 @else {{ $earn->id }} @endif</td>
                                                <td>{{ $earn->name }}</td>
                                                <td>{{ $earn->description }}</td>
                                                <td>{{ $earn->no_rm }}</td>
                                                <td>{{ $earn->points }}</td>
                                                <td><img src="{{asset($earn->imgpath)}}" alt="" width=" 100px"></td>
                                                <td> <strong>{{ trans('labels.AddedDate') }}: </strong> {{ $earn->date_added }}<br>
                                                            <strong>{{ trans('labels.ModifiedDate') }}: </strong>{{ $earn->last_modified }}</td>
                                                <td>@if($earn->earn_points_status==1)
                                                          <span class="label label-success">
                                                            {{ trans('labels.Active') }}
                                                          </span>
                                                          @elseif($earn->earn_points_status==0)
                                                          <span class="label label-danger">
                                                              {{ trans('labels.InActive') }}
                                                          @endif</td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/loyalty/edit_earn_points/'. $earn->id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                           {{--  @if($earn->id >0 )<a id="delete" category_id="{{$earn->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>@endif --}}
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

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')) !!}
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

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
