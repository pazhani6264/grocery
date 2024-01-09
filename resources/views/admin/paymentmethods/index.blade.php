@extends('admin.layout')
@section('content')
<style>
    .alert .default_close {
    color: #000;
    opacity: .2;
    filter: alpha(opacity=20);
}

.alert-dismissable .default_close, .alert-dismissible .default_close {
    position: relative;
    top: -2px;
    right: -21px;
    color: inherit;
}
button.default_close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: 0 0;
    border: 0;
}
.default_close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.PaymentMethods') }} <small>{{ trans('labels.ListingAllPaymentMethods') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.PaymentMethods') }}</li>
            </ol>
        </section>

        <!--  content -->
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
                                    @if ($errors)
                                        @if($errors->any())
                                            <div @if ($errors->first()=='Default can not Deleted!!') class="alert alert-danger alert-dismissible" @else class="alert alert-success alert-dismissible" @endif role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif

                                    <div class="alert alert-success alert-dismissible pay-success-set" role="alert">
                                        <button type="button" class="default_close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                            <span id="pay-success-msg">payment method Updated sucessfully. </span>
                                    </div>

                                  
                                </div>
                            </div>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.ID')}}</th>
                                            <th>{{trans('labels.Active')}}</th>
                                            <th>{{ trans('labels.PaymentMethods')}}</th>
                                            <th>{{trans('labels.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($result['methods'] as $method)
                                            {{-- @if($method->payment_methods_id != 9 and $method->payment_methods_id != 10 and $method->payment_methods_id != 11) --}}
                                            @if($method->payment_methods_id!='15')
                                                <tr>
                                                    <td>
                                                      {{$method->payment_methods_id}}
                                                    </td>
                                                      <td>
                                                        <label>
                                                            <input type="hidden" id="status-{{$method->payment_methods_id}}" value="{{$method->status}}">
                                                            <input type="checkbox" @if($method->status==1) checked @endif name="payment_methods_id" value="{{$method->payment_methods_id}}"  class="default_pay_method" >
                                                        </label>
                                                    </td>
                                                    <td>{{$method->name}}</td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit"  href="{{url('admin/paymentmethods/display')}}/{{$method->payment_methods_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                               @elseif($method->payment_methods_id=='15' && $result['commonContent']['setting']['wallet'] == '1')
                                                <tr>
                                                    <td>
                                                      {{$method->payment_methods_id}}
                                                    </td>
                                                      <td>
                                                        <label>
                                                            <input type="hidden" id="status-{{$method->payment_methods_id}}" value="{{$method->status}}">
                                                            <input type="checkbox" @if($method->status==1) checked @endif name="payment_methods_id" value="{{$method->payment_methods_id}}"  class="default_pay_method" >
                                                        </label>
                                                    </td>
                                                    <td>{{$method->name}}</td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit"  href="{{url('admin/paymentmethods/display')}}/{{$method->payment_methods_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                               @endif 
                                            @endforeach
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
            <!-- deletelanguagesModal -->

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
