@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Table <small>Listing All The Earn Table......</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Table</li>
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
                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/table/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter"  class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="table"  @if(isset($name)) @if  ($name == "table") {{ 'selected' }} @endif @endif>Table Name</option>
                                            <option value="outlet"  @if(isset($name)) @if  ($name == "outlet") {{ 'selected' }} @endif @endif>Outlet</option>
                                            <option value="Status"  @if(isset($name)) @if  ($name == "Status") {{ 'selected' }} @endif @endif>Status</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

                                        <select type="text" style="display:none;width:200px;" class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

                                            <option value="1" @if(isset($param2)) @if  ($param2 == "1") {{ 'selected' }} @endif @endif>Active</option>
                                            <option value="0" @if(isset($param2)) @if  ($param2 == "0") {{ 'selected' }} @endif @endif>Inactive</option>
                                           

                                            </select>
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/table/view')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                             <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/table/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNewCategory') }}</a>
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
                                            <th>@sortablelink('id', trans('labels.ID') )</th>
                                            <th>Table Name</th>
                                            <th>Maximum Person Allowed</th>
                                            <th>Outlet</th>
                                            <th>@sortablelink('status', trans('labels.Status'))</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($table)>0)
                                            @foreach ($table as $key=>$jestable)
                                            <tr>
                                                <td>{{$jestable->id}}</td>
                                                <td>{{$jestable->table_no}}</td>
                                                <td>{{$jestable->max_per}}</td>
                                                <td>{{$jestable->outletname}}</td>
                                                <td>
                                                    @if($jestable->status==1)
                                                        <span class="label label-success">
                                                        {{ trans('labels.Active') }}
                                                        </span>
                                                    @elseif($jestable->status==0)
                                                        <span class="label label-danger">
                                                        {{ trans('labels.InActive') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/table/edit/'. $jestable->id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    <a id="tableDelete" table_id="{{$jestable->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                             @endforeach
                                             @else
                                            <tr>
                                                <td colspan="6">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                              @endif
                                        </tbody>
                                    </table>
                                     <div class="col-xs-12 text-right">
                                        {{--{{ $result['coupons']->links() }}--}}
                                        {{--'vendor.pagination.default'--}}
                                        {!! $table->appends(\Request::except('page'))->render() !!}

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

            <div class="modal fade" id="deleteTable" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/table/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'table_id')) !!}
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
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">

$( "#registration" ).on('click','#submit',function( event ) {

var param =  $( "#parameter" ).val();
var select = $( "#FilterBy" ).val();

      //if( (select == null) || (param == "")) {
      if(param == "") {
          $( "#contact-form12" ).text( "fill the credentials!" ).css({'color':'red'}).show().fadeOut( 10000 );
          $( "#parameter" ).css({'border-color':'red'});
          $( "select" ).css({'border-color':'red'});
          event.preventDefault();
      }else {
        // $( "#contact-form12" ).text( "fill the credentials!" ).css({'padding-left':'10px','margin-right':'20px','padding-bottom':'2px', 'color':'red'}).show().fadeOut( 10000 );
        //     event.preventDefault();
      }
});

    var val  =$("#search_filter" ).val();

    getselectbox(val);

    $('#search_filter').on('change', function() {
        getselectbox(this.value);
});

    function getselectbox(val)
    {
        if(val == 'Status')
        {
            $("#parameter").hide();
            $("#parameter2").show();
        }
        else
        {
            $("#parameter").show();
            $("#parameter2").hide();
        }
        

    }
   
</script>
@endsection
