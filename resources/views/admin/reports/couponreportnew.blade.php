@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{ trans('labels.Coupon Report') }} <small>{{ trans('labels.Coupon Report') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.Coupon Report') }}</li>
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
                            {{--<h3 class="box-title">{{ trans('labels.ListingAllCoupons') }} </h3>--}}

                            <div class="col-lg-6 form-inline" id="contact-form">


                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/couponreportfilter')}}">
                                    <input type="hidden"  value="{{csrf_token()}}">
                                    {{--<div class="input-group-btn search-panel ">--}}
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >
                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="Code"  @if(isset($name)) @if  ($name == "Code") {{ 'selected' }} @endif @endif>{{ trans('labels.Code') }}</option>
                                        </select>
                                        {{--</div>--}}

                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" @if(isset($param)) value="{{$param}}" @endif >
                                        {{--<span class="input-group-btn">--}}
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/couponreport')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                        {{--</span>--}}
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
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
                                            <th>@sortablelink('coupans_id', trans('labels.ID') )</th>
                                            <th>@sortablelink('code', trans('labels.Code') )</th>
                                            <th>@sortablelink('discount_type', trans('labels.Coupon_amount_type') )</th>
                                            <th>{{ trans('labels.CouponType') }} </th>
                                            <th>@sortablelink('amount', trans('labels.CouponAmount') )</th>
                                            <th>{{ trans('labels.UsageLimitPerCoupon') }} </th>
                                            <th>@sortablelink('expiry_date', trans('labels.ExpiryDate') )</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($coupons)>0)
                                       
                                            @foreach ($coupons as $key=>$coupan)
                                            @php 
                                            $usecount = DB::table('orders')->where('coupon_code_id', '=', $coupan->coupans_id)->count();
                                            @endphp
                                                <tr>
                                                    <td>{{ $coupan->coupans_id }}</td>
                                                    <td>{{ $coupan->code }}</td>
                                                    <td>{{ str_replace('_', ' ', $coupan->discount_type) }} </td>
                                                     <td>{{ str_replace('_', ' ', $coupan->coupans_type) }} </td>
                                                    <td>
                                                        @if($coupan->discount_type=='fixed_product' or $coupan->discount_type=='fixed_cart')
                                                        @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $coupan->amount }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif    
                                                        
                                                        @else
                                                            {{ $coupan->amount }}%
                                                        @endif
                                                    </td>
                                                    <td>
                                                      @if(!empty($coupan->usage_limit))
                                                      {{ $coupan->usage_limit }} / {{$usecount}}
                                                      @else
                                                      {{ 'Unlimited'}} / {{$usecount}}
                                                      @endif
                                                    </td> 
                                                    <td>{{ date('d/m/Y',strtotime($coupan->expiry_date)) }} </td>

                                                  <td><a data-toggle="tooltip" data-placement="bottom"  href="{{ url('admin/couponreportuser')}}/{{$coupan->coupans_id}}" class="badge bg-light-blue" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        {{--{{ $result['coupons']->links() }}--}}
                                        {{--'vendor.pagination.default'--}}
                                        {!! $coupons->appends(\Request::except('page'))->render() !!}

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
            <!-- deleteCoupanModal -->
            <!--  row -->

            <!-- /.row -->
        </section>
  <!-- /.content -->
</div>
@endsection
