@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Vendor <small>Listing All The Vendor...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Vendor</li>
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
                             
                               <div class="col-md-2  pull-right">
                                <a href="{{ URL::to('admin/inventory/addvendor')}}" type="button" class="btn btn-block btn-primary">Add vendor</a>
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
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Contact Name</th>
                                            <th>Address</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @if(count($result['vendor'])>0)
                                                @foreach ($result['vendor'] as $key=> $jesvendor)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$jesvendor->name}}</td>
                                                    <td>{{$jesvendor->email}}</td>
                                                    <td>{{$jesvendor->cc_code}}{{$jesvendor->phone}}</td>
                                                    <td>{{$jesvendor->contact_name}}</td>
                                                    <td>
                                                        {{$jesvendor->street_1}}<br>
                                                        {{$jesvendor->street_2}}<br>
                                                        {{$jesvendor->post_code}},{{$jesvendor->city}}<br>
                                                        {{$jesvendor->zone_name}},{{$jesvendor->countries_name}}<br>
                                                    </td>
                                                    <td>
                                                       <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{ URL::to('admin/inventory/editvendor/'.$jesvendor->id)}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteVendorId" vendor_id="{{ $jesvendor->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> 
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



           <div class="modal fade" id="deleteVendorModal" tabindex="-1" role="dialog" aria-labelledby="deleteVendorModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteNewsModalLabel">Delete Vendor</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/inventory/deleteVendor', 'name'=>'deleteNews', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'id')) !!}
                        <div class="modal-body">
                            <p>Are you sure you want to delete this vendor?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteNews">{{ trans('labels.Delete') }}</button>
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

<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
    //deleteUnitModal
        $(document).on('click', '#deleteVendorId', function(){
        var vendor_id = $(this).attr('vendor_id');
        $('#id').val(vendor_id);
        $("#deleteVendorModal").modal('show');
    });
</script>
