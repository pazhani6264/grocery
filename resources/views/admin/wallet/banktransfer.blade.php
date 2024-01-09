@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Wallet <small>Wallet...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Wallet</li>
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

                            <h3 class="box-title">Listing All The Wallet Orders </h3>
                            <br>
                            <br>
                            <br>
                            {{-- <div class="col-lg-6 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/orders/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                            <option value="ID"  @if(isset($name)) @if  ($name == "ID") {{ 'selected' }} @endif @endif>Order ID</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/orders/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
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
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>{{ trans('labels.CustomerName') }}</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Payment method</th>
                                            {{-- <th>Payment ID</th> --}}
                                            <th>Amount</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($wallet)>0)
                                            @foreach ($wallet as $key=>$jeswallet)
                                           
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $jeswallet->first_name }} {{ $jeswallet->last_name }}</td>
                                                    <td>
                                                        @if($jeswallet->wallet_type == 'deposit')
                                                            Deposit
                                                        @else
                                                            Withdrawal
                                                        @endif
                                                    </td>
                                                    <td>{{ $jeswallet->description }}</td>
                                                    <td>{{ $jeswallet->payment_method }}</td>
                                                   {{--  <td>{{ $jeswallet->payment_id }}</td> --}}
                                                    <td> {{ $jeswallet->amount }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="loadDynamicContentImage({{$jeswallet->id}})" title="Close"><img src="{{ asset('').$jeswallet->payment_response }}" width="60px"></a>
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($jeswallet->created_at)) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-success" id="bankApprove" approve_id="{{$jeswallet->id}}">Approve</button>
                                                        <button type="button" id="bankCancel" cancel_id="{{$jeswallet->id}}" class="btn btn-block btn-primary">Cancel</button>
                                                    </td>
                                                </tr>
                                              

                                              
                                            @endforeach
                                             @else
                                            <tr>
                                                <td colspan="6"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
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

            <!-- deleteModal -->
            <div class="modal fade" id="approveBanktransfer" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">Approve Bank Transfer</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/wallet/bankapprove', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        {!! Form::hidden('type',  '', array('class'=>'form-control', 'id'=>'type')) !!}
                        <div class="modal-body">
                            <p>Are you sure you want to approve order?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteOrder">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


            <div class="modal fade" id="myEventeditImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Bank Receipt</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div id="demo-EventEditImage"></div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
