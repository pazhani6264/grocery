@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.Coupons') }} <small>{{ trans('labels.ListingAllCoupons') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.Coupons') }}</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            {{--<h3 class="box-title">{{ trans('labels.ListingAllCoupons') }} </h3>--}}

                            <div class="col-lg-9 form-inline" id="contact-form">


                                <form  name='registration' id="registration1" class="registration1" method="get" action="{{url('admin/coupons/filter')}}">
                                    <input type="hidden"  value="{{csrf_token()}}">
                                    {{--<div class="input-group-btn search-panel ">--}}
                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy"  >
                                            <option value="" selected disabled hidden>Filter By</option>
                                            <option value="Code"  @if(isset($name)) @if  ($name == "Code") {{ 'selected' }} @endif @endif>{{ trans('labels.Code') }}</option>
                                            <option value="type"  @if(isset($name)) @if  ($name == "type") {{ 'selected' }} @endif @endif>Coupon Type</option>
                                        </select>
                                        {{--</div>--}}

                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >

<select type="text" style="display:none;width:200px;" class="form-control input-group-form " name="parameter2" placeholder="{{trans('labels.Search')}}..." id="parameter2"  @if(isset($param2)) value="{{$param2}}" @endif >

    <option value="internal" @if(isset($param2)) @if  ($param2 == "internal") {{ 'selected' }} @endif @endif>Internal</option>
    <option value="external" @if(isset($param2)) @if  ($param2 == "external") {{ 'selected' }} @endif @endif>External</option>
   

    </select>
                                        {{--<span class="input-group-btn">--}}

                                       <!--  <div class="form-group" style="margin:0 20px;">
                                          
                                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                                            </div> -->


                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if((!empty($param) && !empty($name)) || (!empty($param2) && !empty($name)) || !empty($dateRange))  <a class="btn btn-danger " href="{{url('admin/coupons/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                        {{--</span>--}}
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>


                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/coupons/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
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
                                            <th>@sortablelink('description', trans('labels.Description') )</th>
                                            <th>@sortablelink('expiry_date', trans('labels.ExpiryDate') )</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($coupons)>0)
                                            @foreach ($coupons as $key=>$coupan)

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
                                                    <td>{{ $coupan->description }} </td>
                                                    <td>{{ date('d/m/Y',strtotime($coupan->expiry_date)) }} </td>

                                                    <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{ url('admin/coupons/edit')}}/{{$coupan->coupans_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteCoupans_id" coupans_id ="{{ $coupan->coupans_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
            <div class="modal fade" id="deleteCoupanModal" tabindex="-1" role="dialog" aria-labelledby="deleteCoupanModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteCoupanModalLabel">{{ trans('labels.DeleteCoupon') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/coupons/delete', 'name'=>'deleteCoupan', 'id'=>'deleteCoupan', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'coupans_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteCouponText') }}</p>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-danger" id="deleteCoupanBtn">{{ trans('labels.Delete') }} </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">



    var val  =$("#search_filter" ).val();

    getselectbox(val);

    $('#search_filter').on('change', function() {
        getselectbox(this.value);
});

    function getselectbox(val)
    {
        if(val == 'type')
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
