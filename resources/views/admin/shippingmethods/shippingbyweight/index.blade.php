@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.shippingbyweight') }} <small>{{ trans('labels.Listingshippingbyweight') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/shippingmethods/display')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.ShippingMethods') }}</a></li>
                <li class="active">{{ trans('labels.shippingbyweight') }}</li>
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
                 
                            <div class="box-tools pull-right">
                                <a href="{{url('admin/shippingmethods/shippingbyweight/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body" style="margin-top:35px;">
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
                                            <th>Weight From</th>
                                            <th>Weight To</th>
                                            <th>Weight Price</th>
                                            <th>Delivery Boy Commission</th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($products_shipping)>0)
                                            @foreach ($products_shipping as $key=>$weight)
                                                <tr>
                                                    <td>{{ $weight->products_shipping_rates_id  }}</td>
                                                    <td>{{ $weight->weight_from }} gm</td>
                                                    <td>{{ $weight->weight_to }} gm</td>
                                                    <td>{{ $weight->weight_price }}</td>
                                                    <td>{{ $weight->weight_commission }}</td>
                                                    <td> @if($weight->products_shipping_status == 1)Active @else InActive @endif</td>
                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{url('admin/shippingmethods/shippingbyweight/edit')}}/{{ $weight->products_shipping_rates_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteshippingbyweightId" weight_id ="{{ $weight->products_shipping_rates_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"> {{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        {!! $products_shipping->appends(\Request::except('page'))->render() !!}
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

            <div class="modal fade" id="deleteshippingbyweightModal" tabindex="-1" role="dialog" aria-labelledby="deleteshippingbyweightModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteshippingbyweightModalLabel">{{ trans('labels.Deleteshippingbyweight') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/shippingmethods/shippingbyweight/delete', 'name'=>'deleteshippingbyweight', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('weight_id',  '', array('class'=>'form-control', 'id'=>'weight_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteshippingbyweightText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteshippingbyweight">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
