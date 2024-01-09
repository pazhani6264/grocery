@extends('admin.layout')
@section('content')

<style type="text/css">
    .select2-container{
        width: 100% !important;
    }
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.EditCoupons') }} <small>{{ trans('labels.EditCoupons') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/coupons/display')}}"><i class="fa fa-dashboard"></i>All Coupons</a></li>
                <li class="active">{{ trans('labels.EditCoupons') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.EditCoupons') }}</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div  @if ($errors->first() == 'Coupon has been updated successfully!') class="alert alert-success alert-dismissible" @else class="alert alert-danger alert-dismissible" @endif role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif

                                     @if(Session::has('failure'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {!! session('failure') !!}
                                            </div>
                                    @endif

                                    @if(Session::has('success'))

                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            {!! session('success') !!}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>

                                        @if(count($result['message'])>0)
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{ $result['message'] }}
                                            </div>
                                    @endif

                                    <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">

                                            {!! Form::open(array('url' =>'admin/coupons/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                            {!! Form::hidden('id',  $result['coupon'][0]->coupans_id)!!}

                                             {!! Form::hidden('oldImage', $result['coupon'][0]->image , array('id'=>'oldImage')) !!}

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Coupon') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('code',  $result['coupon'][0]->code, array('class'=>'form-control field-validate', 'id'=>'code'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.AddCouponsTaxt') }}</span>
                                                    <span class="help-block hidden">{{ trans('labels.AddCouponsTaxt') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CouponDescription') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <textarea id="coeditor" name="description" class="form-control" rows="5">{{$result['coupon'][0]->description}}</textarea>
                                                    {{-- {!! Form::textarea('description',  $result['coupon'][0]->description, array('class'=>'form-control', 'rows'=>'5', 'id'=>'description'))!!} --}}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CouponDescriptionText') }}</span>
                                                </div>
                                            </div>
                                        <!--<div class="box">
                            <div class="box-header">
                            <h3 class="box-title">{{ trans('labels.EditCoupons') }}</h3>
                            </div>
                            </div>-->

                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CouponType') }}  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="coupon_type" class='form-control' id="coupon_type">
                                                        <option value="internal"@if($result['coupon'][0]->coupans_type == 'internal') selected @endif>Internal</option>
                                                        <option value="external"@if($result['coupon'][0]->coupans_type == 'external') selected @endif>External</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Discounttype') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="discount_type" class='form-control' id='discount_type'>
                                                        <option value="fixed_cart" @if($result['coupon'][0]->discount_type == 'fixed_cart') selected @endif>Cart {{$result['commonContent']['currency']->symbol_left}} Discount</option>
                                                        <option value="percent" @if($result['coupon'][0]->discount_type == 'percent') selected @endif>Cart % Discount</option>
                                                        <option value="product"@if($result['coupon'][0]->discount_type == 'product') selected @endif>Product</option>
                                                         {{-- <option value="point" @if($result['coupon'][0]->discount_type == 'point') selected @endif>Point</option> --}}
                                                        <!-- <option value="fixed_product" @if($result['coupon'][0]->discount_type == 'fixed_product') selected @endif>Product Discount</option>
                                                        <option value="percent_product" @if($result['coupon'][0]->discount_type == 'percent_product') selected @endif>Product % Discount</option> -->
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.DiscounttypeText') }}</span>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Payment Type </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="payment_type" class='form-control' id="payment_type">
                                                        <option value="">Select</option>
                                                        @foreach($result['payment'] as $pay)
                                                            <option value="{{ $pay->payment_method }}" @if($result['coupon'][0]->payment_type == $pay->payment_method) selected @endif>{{ $pay->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                             

                                        <div id="business">
                                        <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }}<span style="color:red;">*</span> </label>
                                        <div class="col-sm-10 col-md-4">
                                            <select class="form-control select2 product-type" name="products_id" id="products_id">
                                                <option value="">{{ trans('labels.Choose Product') }}</option>
                                                @foreach ($result['products'] as $pro)
                                                <option  @if( $pro->products_id == $result['coupon'][0]->products_id)
                                                                    selected
                                                                    @endif value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                {{ trans('labels.Product Type Text') }}.
                                            </span>
                                        </div>
                                    </div>
                                    </div>
                                            
                                            <!-- <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CouponAmount') }}
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="number"  min="1" class="form-control field-validate"  value='{{ $result['coupon'][0]->amount }}' onkeyup="sum_point();" name="amount" id="amount">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CouponAmountText') }}</span>
                                                </div>
                                               
                                            </div> -->

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CouponAmount') }}
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="number" step="0.01"  min="0" class="form-control field-validate"  value='{{ $result['coupon'][0]->amount }}' onkeyup="sum_point();" name="amount" id="amount">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CouponAmountText') }}</span>
                                                </div>
                                               
                                            </div>
                                            
                                            @if($result['coupon'][0]->discount_type == 'percent')
                                            <div id="editrpoint">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.cap_amount') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="number"  class="form-control"  value='{{ $result['coupon'][0]->cap_amount }}'  name="cap_amount" id="cap_amount" min="1">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                            @else
                                            <div id="rpoint">
                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.cap_amount') }}<span style="color:red;"></span></label>
                                            <div class="col-sm-10 col-md-4">
                                                <input name="cap_amount" id="cap_amount" class="form-control"  onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )" maxlength="5">
                                            </div>
                                        </div>
                    </div>
                                            @endif
                                            {{-- @if($result['coupon'][0]->discount_type == 'point')
                                            <div id='erpoint'>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.requiredpoint') }}
                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('point',$result['coupon'][0]->points, array('class'=>'form-control field-validate', 'id'=>'point','readonly'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.CouponAmountText') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                            @endif --}}
                                            <div class="form-group" style="display:none;">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.AllowFreeShipping') }}</label>
                                                <div class="col-sm-10 col-md-4" style="padding-top: 7px;">
                                                    <label style="margin-bottom:0">
                                                        {!! Form::checkbox('free_shipping', 1, $result['coupon'][0]->free_shipping, ['class' => 'minimal']) !!}
                                                    </label>
                                                    &nbsp; {{ trans('labels.AllowFreeShippingText') }}

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.CouponExpiryDate') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('expiry_date',  date('d/m/Y', strtotime($result['coupon'][0]->expiry_date)), array('class'=>'form-control field-validate datepicker', 'id'=>'expiry_date', 'readonly'=>'readonly'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CouponExpiryDateText') }}</span>
                                                    <span class="help-block hidden">{{ trans('labels.CouponExpiryDateText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Minimumspend') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('minimum_amount', $result['coupon'][0]->minimum_amount, array('class'=>'form-control', 'placeholder'=>trans('labels.NoMinimum'), 'id'=>'minimum_amount'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.MinimumspendText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.MaximumSpend') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('maximum_amount', $result['coupon'][0]->maximum_amount, array('class'=>'form-control', 'placeholder'=>trans('labels.NoMaximum'), 'id'=>'maximum_amount'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.MaximumSpendText') }}</span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="maximum_amount"  value="0" />

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.IndividualUseOnly') }}</label>
                                                <div class="col-sm-10 col-md-4"  style="padding-top: 7px; line-height: 22px;">
                                                    <label  style="margin-bottom: 0px;">
                                                        {!! Form::checkbox('individual_use', 1, $result['coupon'][0]->individual_use, ['class' => 'minimal']) !!}
                                                    </label>
                                                    &nbsp; {{ trans('labels.IndividualUseOnlyText') }}
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExcludeSaleItems') }}</label>
                                                <div class="col-sm-10 col-md-4"  style="padding-top: 7px; line-height: 22px;">
                                                    <label  style="margin-bottom: 0px;">
                                                        {!! Form::checkbox('exclude_sale_items', 1, $result['coupon'][0]->exclude_sale_items, ['class' => 'minimal']) !!}
                                                    </label>
                                                    &nbsp; {{ trans('labels.ExcludeSaleItemsText') }}
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Products') }}</label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="product_ids[]" multiple class="form-control select2">
                                                        @foreach($result['products'] as $products)
                                                            <option value="{{ $products->products_id }}" @if(in_array($products->products_id, explode(',', $result['coupon'][0]->product_ids))) selected @endif>{{ $products->products_name }} {{ $products->products_model }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CouponProductsUsed') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExcludeProducts') }}</label>
                                                <div class="col-sm-10 col-md-4 couponProdcuts">
                                                    <select name="exclude_product_ids[]" multiple class="form-control select2 ">
                                                        @foreach($result['products'] as $products)
                                                            <option value="{{ $products->products_id }}" @if(in_array($products->products_id, explode(',', $result['coupon'][0]->exclude_product_ids))) selected @endif>{{ $products->products_name }} {{ $products->products_model }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ExcludeProductsText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.IncludeCategories') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="product_categories[]" multiple class="form-control select2">
                                                        @foreach($result['categories'] as $categories)
                                                            <option value="{{ $categories->categories_id }}" @if(in_array($categories->categories_id, explode(',', $result['coupon'][0]->product_categories))) selected @endif>{{ $categories->categories_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.IncludeCategoriesText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExcludeCategories') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="excluded_product_categories[]" multiple class="form-control select2">
                                                        @foreach($result['categories'] as $categories)
                                                            <option value="{{ $categories->categories_id }}" @if(in_array($categories->categories_id, explode(',', $result['coupon'][0]->excluded_product_categories))) selected @endif >{{ $categories->categories_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ExcludeCategoriesText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none;">>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailRestrictions') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="email_restrictions[]" multiple class="form-control select2">
                                                        @foreach($result['emails'] as $emails)
                                                            <option value="{{ $emails->email }}"  @if(in_array($emails->email, explode(',', $result['coupon'][0]->email_restrictions))) selected @endif >{{ $emails->email }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.EmailRestrictionsText') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group" >
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.UsageLimitPerCoupon') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::number('usage_limit', $result['coupon'][0]->usage_limit, array('class'=>'form-control', 'placeholder'=>'Unlimited', 'id'=>'usage_limit'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UsageLimitPerCouponText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.UsageLimitPerUser') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::number('usage_limit_per_user', $result['coupon'][0]->usage_limit_per_user, array('class'=>'form-control', 'placeholder'=>'Unlimited', 'id'=>'usage_limit_per_user'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UsageLimitPerUserText') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.couponsImageText') }}</span>

                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                              <br>
                                              <img src="{{asset($result['coupon'][0]->imgpath)}}" alt="" width=" 100px">
                                            </div>
                                        </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/coupons/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>
                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
                                        </div>
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
@endsection
