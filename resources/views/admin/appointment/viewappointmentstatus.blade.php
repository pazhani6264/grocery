@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Appointment Status</h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Appointment Status</li>
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

                                    <span style="color:green;font-size:20px;" id="appStatus"></span>
                                    <div class="alert alert-success alert-dismissible" id="apperror" role="alert" style="display:none;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Appointment status updated successfully
                                            </div>

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

                            <!-- <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/outlet_filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>Name</option>
                                            <option value="Phone"  @if(isset($name)) @if  ($name == "Phone") {{ 'selected' }} @endif @endif>Phone</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/outlet')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div> -->
                            <div class="col-lg-3 pull-right">
                                <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->add_appstatus_view == 1){ ?>
                                    <a href="{{url('admin/appointment/add_appointment_status')}}" type="button" class="btn btn-block btn-primary">Add Appointment Status</a>
                                <?php } ?>
                            </div>
                            <br><br>
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Status Name</th>
                                            <th>Cancel Status</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['appstatus'])>0)
                                            @foreach ($result['appstatus'] as $key=>$resultdata)
                                                <tr>
                                                    <td>{{ $resultdata->status_name }}</td>
                                                    <td>
                                                        <label class=" control-label">
                                                        <input type="radio" name="cancal{{ $resultdata->id }}" value="1" class="form-check-input app_set_cancel" status_id="{{$resultdata->id}}" @if($resultdata->cancel == '1') checked @endif > &nbsp;{{ trans('labels.Yes') }}
                                                        </label>
                                                        <label class=" control-label">
                                                        <input type="radio" name="cancal{{ $resultdata->id }}" value="0" class="form-check-input app_set_cancel" status_id="{{$resultdata->id}}" @if($resultdata->cancel == '0') checked @endif > &nbsp;{{ trans('labels.No') }}
                                                        </label>
                                                    </td>
                                                    @if($resultdata->status == 1)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td>{{ $resultdata->created_at }}</td>
                                                    <td>
                                                        <?php if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->edit_appstatus_view == 1){ ?>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit Appointment Status"  href="edit_appointment_status/{{ $resultdata->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
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

                                        {!! $result['appstatus']->appends(\Request::except('page'))->render() !!}
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
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">

    

    //set_cancel_status
		jQuery(document).on('click', '.app_set_cancel', function(e){
            $('#apperror').hide();
        var status_id = jQuery(this).attr('status_id');
        var status = $(this).val();
        jQuery.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            url: '{{url('admin/appointment/change_appointment_status_action')}}',
            type: "POST",
            data: '&status_id='+status_id+'&status='+status,

            success: function (res) {
                $('#apperror').show();
            },

        });

});

   
</script>

@endsection
