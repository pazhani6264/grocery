@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Shipping By Weight And KM <small>Shipping By Weight And KM...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/shippingmethods/display')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.ShippingMethods') }}</a></li>
                <li class="active">Shipping By Weight And KM</li>
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
                            <div class="pull-left">
                                <h4>Shipping By Weight<h4>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{url('admin/shippingmethods/shippingbyweightandkm/add_weight')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
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
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>Weight From (Gm)</th>
                                            <th>Weight To (Gm)</th>
                                            <th>Weight Price</th>
                                            <th>Delivery Boy Commission</th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($products_shipping)>0)
                                            @foreach ($products_shipping as $key=>$weight)
                                                @if($weight->type == 'Weight')
                                                    <tr>
                                                        <td>{{ $key +1 }}</td>
                                                        <td>{{ $weight->from_weight_km }}</td>
                                                        <td>{{ $weight->to_weight_km }}</td>
                                                        <td>{{ $weight->price_weight_km }}</td>
                                                        <td>{{ $weight->commission_weight_km }}</td>
                                                        <td> @if($weight->status == 1)Active @else InActive @endif</td>
                                                        <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{url('admin/shippingmethods/shippingbyweightandkm/edit_weight')}}/{{ $weight->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deletebyWeightId" weight_id ="{{ $weight->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                        </td>
                                                    </tr>
                                                @endif
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

            <div class="modal fade" id="deletebyWeightModal" tabindex="-1" role="dialog" aria-labelledby="deleteshippingbyweightModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteshippingbykmModalLabel">Delete Shipping by Weight</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/shippingmethods/shippingbyweightandkm/delete_weight', 'name'=>'deleteshippingbyweightandkm', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('weight_id',  '', array('class'=>'form-control', 'id'=>'weight_id')) !!}
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Shipping by Weight?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteshippingbyweightandkm">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->



        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h4>Shipping By KM<h4>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{url('admin/shippingmethods/shippingbyweightandkm/add_km')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>KM From</th>
                                            <th>KM To</th>
                                            <th>KM Price</th>
                                            <th>Delivery Boy Commission</th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($products_shipping)>0)
                                            <?php $i=0; ?>
                                            @foreach ($products_shipping as $keyKm=>$km)
                                                @if($km->type == 'KM')
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $km->from_weight_km }}</td>
                                                        <td>{{ $km->to_weight_km }}</td>
                                                        <td>{{ $km->price_weight_km }}</td>
                                                        <td>{{ $km->commission_weight_km }}</td>
                                                        <td> @if($km->status == 1)Active @else InActive @endif</td>
                                                        <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{url('admin/shippingmethods/shippingbyweightandkm/edit_km')}}/{{ $km->id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deletebyKMId" km_id ="{{ $km->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                        </td>
                                                    </tr>
                                                @endif
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

            <div class="modal fade" id="deletebyKMModal" tabindex="-1" role="dialog" aria-labelledby="deleteshippingbykmModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteshippingbykmModalLabel">{{ trans('labels.Deleteshippingbykm') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/shippingmethods/shippingbyweightandkm/delete_km', 'name'=>'deleteshippingbykm', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('km_id',  '', array('class'=>'form-control', 'id'=>'km_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteshippingbykmText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteshippingbykm">{{ trans('labels.Delete') }}</button>
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
