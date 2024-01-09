@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.Setting') }}<small>{{ trans('labels.Setting') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li class="active">{{ trans('labels.Setting') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.Setting') }}</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-success" role="alert">
                                            <span class="icon fa fa-check" aria-hidden="true"></span>
                                            <span class="sr-only">{{ trans('labels.Setting') }}:</span>
                                            {{ $error }}</div>
                                        @endforeach
                                        @endif

                                        @if(Session::has('error'))

                                            <div class="alert alert-danger" role="alert">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <span class="sr-only">@lang('website.Error'):</span>
                                                {{ session()->get('error') }}
                                            </div>

                                        @endif

                                        {!! Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                        <h4>{{ trans('labels.generalSetting') }}</h4>
                                        <hr>
                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.Web/App Environment') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="environmentt" value="Maintenance" class="flat-red" @if($result['commonContent']['setting']['environmentt'] == 'Maintenance') checked @endif > &nbsp;{{ trans('labels.Maintenance') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="environmentt" value="production" class="flat-red" @if($result['commonContent']['setting']['environmentt'] == 'production') checked @endif >  &nbsp;{{ trans('labels.production') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="environmentt" value="local" class="flat-red" @if($result['commonContent']['setting']['environmentt'] == 'local') checked @endif >  &nbsp;{{ trans('labels.local') }}
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.Inventory') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="Inventory" value="1" class="flat-red" @if($result['commonContent']['setting']['Inventory'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="Inventory" value="0" class="flat-red" @if($result['commonContent']['setting']['Inventory'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        @if($result['commonContent']['setting']['Inventory'] == '1')
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Inventory Type</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="inventory_type" value="0" class="flat-red" @if($result['commonContent']['setting']['inventory_type'] == '0') checked @endif > &nbsp;Basic
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="inventory_type" value="1" class="flat-red" @if($result['commonContent']['setting']['inventory_type'] == '1') checked @endif >  &nbsp;Advance
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        @endif
                                         <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.review_approval') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="Review" value="1" class="flat-red" @if($result['commonContent']['setting']['Review'] == '1') checked @endif > &nbsp;{{ trans('labels.Manual') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="Review" value="0" class="flat-red" @if($result['commonContent']['setting']['Review'] == '0') checked @endif >  &nbsp;{{ trans('labels.Automatic') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.loyalty') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="loyalty" value="1" class="flat-red" @if($result['commonContent']['setting']['Loyalty'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="loyalty" value="0" class="flat-red" @if($result['commonContent']['setting']['Loyalty'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                    @if($result['commonContent']['setting']['Loyalty'] == '1')
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.member_type') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="Membertype" value="1" class="flat-red" @if($result['commonContent']['setting']['Membertype'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="Membertype" value="0" class="flat-red" @if($result['commonContent']['setting']['Membertype'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    @endif

                                     <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Wallet</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="wallet" value="1" class="flat-red" @if($result['commonContent']['setting']['wallet'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="wallet" value="0" class="flat-red" @if($result['commonContent']['setting']['wallet'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Appointment</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="appointment" value="1" class="flat-red" @if($result['commonContent']['setting']['appointment'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="appointment" value="0" class="flat-red" @if($result['commonContent']['setting']['appointment'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Table Menu</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="table_menu" value="1" class="flat-red" @if($result['commonContent']['setting']['table_menu'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="table_menu" value="0" class="flat-red" @if($result['commonContent']['setting']['table_menu'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>



                                    <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">Delivery Boy Rating</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="deliveryboy_rating" value="1" class="flat-red" @if($result['commonContent']['setting']['deliveryboy_rating'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="deliveryboy_rating" value="0" class="flat-red" @if($result['commonContent']['setting']['deliveryboy_rating'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>


                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">Collection Products</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="collection_product" value="1" class="flat-red" @if($result['commonContent']['setting']['collection_product'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="collection_product" value="0" class="flat-red" @if($result['commonContent']['setting']['collection_product'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">Back To Top </label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="back_to_top" value="1" class="flat-red" @if($result['commonContent']['setting']['back_to_top'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="back_to_top" value="0" class="flat-red" @if($result['commonContent']['setting']['back_to_top'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                    
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.promo_check') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="Vouchercheck" value="1" class="flat-red" @if($result['commonContent']['setting']['Vouchercheck'] == '1') checked @endif > &nbsp;{{ trans('labels.one_time') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="Vouchercheck" value="0" class="flat-red" @if($result['commonContent']['setting']['Vouchercheck'] == '0') checked @endif >  &nbsp;{{ trans('labels.both_time') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                   
                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.voucher_redeem') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="voucher_redeem" value="1" class="flat-red" @if($result['commonContent']['setting']['voucher_redeem'] == '1') checked @endif > &nbsp;{{ trans('labels.direct') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="voucher_redeem" value="0" class="flat-red" @if($result['commonContent']['setting']['voucher_redeem'] == '0') checked @endif >  &nbsp;{{ trans('labels.activate') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.image_upload') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="image_upload" value="1" class="flat-red" @if($result['commonContent']['setting']['image_upload'] == '1') checked @endif > &nbsp;{{ trans('labels.local') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="image_upload" value="0" class="flat-red" @if($result['commonContent']['setting']['image_upload'] == '0') checked @endif >  &nbsp;{{ trans('labels.aws') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.productcolumn') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="product_column" value="1" class="flat-red" @if($result['commonContent']['setting']['product_column'] == '1') checked @endif > &nbsp; 1
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="product_column" value="2" class="flat-red" @if($result['commonContent']['setting']['product_column'] == '2') checked @endif >  &nbsp; 2
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.desktop_product_column') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="desktop_product_column" value="3" class="flat-red" @if($result['commonContent']['setting']['desktop_product_column'] == '3') checked @endif > &nbsp;3
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="desktop_product_column" value="4" class="flat-red" @if($result['commonContent']['setting']['desktop_product_column'] == '4') checked @endif >  &nbsp;4
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="desktop_product_column" value="5" class="flat-red" @if($result['commonContent']['setting']['desktop_product_column'] == '5') checked @endif >  &nbsp;5
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">Margin Between each section</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="margin_between" value="20" class="flat-red" @if($result['commonContent']['setting']['margin_between'] == '20') checked @endif > &nbsp;20
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="margin_between" value="30" class="flat-red" @if($result['commonContent']['setting']['margin_between'] == '30') checked @endif >  &nbsp;30
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="margin_between" value="40" class="flat-red" @if($result['commonContent']['setting']['margin_between'] == '40') checked @endif >  &nbsp;40
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="margin_between" value="50" class="flat-red" @if($result['commonContent']['setting']['margin_between'] == '50') checked @endif >  &nbsp;50
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="margin_between" value="60" class="flat-red" @if($result['commonContent']['setting']['margin_between'] == '60') checked @endif >  &nbsp;60
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.title_alignment') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="title_alignment" value="left" class="flat-red" @if($result['commonContent']['setting']['title_alignment'] == 'left') checked @endif > &nbsp;Left
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="title_alignment" value="center" class="flat-red" @if($result['commonContent']['setting']['title_alignment'] == 'center') checked @endif >  &nbsp;Center
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="title_alignment" value="right" class="flat-red" @if($result['commonContent']['setting']['title_alignment'] == 'right') checked @endif >  &nbsp;Right
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.title_style') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="title_style" value="1" class="flat-red" @if($result['commonContent']['setting']['title_style'] == '1') checked @endif > &nbsp;Bold
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="title_style" value="2" class="flat-red" @if($result['commonContent']['setting']['title_style'] == '2') checked @endif >  &nbsp;Un Bold
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">View Login Button</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="view_login_button" value="1" class="flat-red" @if($result['commonContent']['setting']['view_login_button'] == '1') checked @endif > &nbsp;Enabled
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="view_login_button" value="2" class="flat-red" @if($result['commonContent']['setting']['view_login_button'] == '2') checked @endif >  &nbsp;Disabled
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">View Cart Button</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="view_cart_button" value="1" class="flat-red" @if($result['commonContent']['setting']['view_cart_button'] == '1') checked @endif > &nbsp;Enabled
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="view_cart_button" value="2" class="flat-red" @if($result['commonContent']['setting']['view_cart_button'] == '2') checked @endif >  &nbsp;Disabled
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.title_font') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('title_font',$result['commonContent']['setting']['title_font'], array('class'=>'form-control', 'id'=>'title_font')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.title_font_text') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.stock_availability') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="stock_availability" value="1" class="flat-red" @if($result['commonContent']['setting']['stock_availability'] == '1') checked @endif > &nbsp;Count
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="stock_availability" value="2" class="flat-red" @if($result['commonContent']['setting']['stock_availability'] == '2') checked @endif >  &nbsp;Status
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Tax Method</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="tax_class" value="1" class="flat-red" @if($result['commonContent']['setting']['tax_class'] == '1') checked @endif > &nbsp;Common Tax
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="tax_class" value="2" class="flat-red" @if($result['commonContent']['setting']['tax_class'] == '2') checked @endif >  &nbsp;Product Based Tax
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="tax_class" value="0" class="flat-red" @if($result['commonContent']['setting']['tax_class'] == '0') checked @endif >  &nbsp;None
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            </div>
                                        </div>





                                       <!--  <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">parallex banner</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="parallex_banner" value="1" class="flat-red" @if($result['commonContent']['setting']['parallex_banner'] == '1') checked @endif > &nbsp; Parallex
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="parallex_banner" value="2" class="flat-red" @if($result['commonContent']['setting']['parallex_banner'] == '2') checked @endif >  &nbsp; Static
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Card Background Color</label>
                                            <div class="col-sm-10 col-md-4">
                                            <input class="form-control" id="card_background" name="card_background" type="color" value="{{ $result['commonContent']['setting']['card_background'] }}">
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Card Hover</label>
                                            <div class="col-sm-10 col-md-4">
                                            <input class="form-control" id="card_background_hover" name="card_background_hover" type="color" value="{{ $result['commonContent']['setting']['card_background_hover'] }}">
                                               
                                            </div>
                                        </div>

                                        

                                           

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Maintenance Text') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('maintenance_text',  stripslashes($result['commonContent']['setting']['maintenance_text']), array('class'=>'form-control', 'id'=>'maintenance_text')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Maintenance Text detail') }}</span>
                                          </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.website Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('external_website_link', $result['commonContent']['setting']['external_website_link'], array('class'=>'form-control', 'id'=>'external_website_link')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Website Link Text') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Android App Link</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('android_app_link', $result['commonContent']['setting']['android_app_link'], array('class'=>'form-control', 'id'=>'android_app_link')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Please enter your Android app link</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Iphone App Link</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('iphone_app_link', $result['commonContent']['setting']['iphone_app_link'], array('class'=>'form-control', 'id'=>'iphone_app_link')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">Please enter your Iphone app link</span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.aws Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('aws_url', $result['commonContent']['setting']['aws_url'], array('class'=>'form-control', 'id'=>'aws_url')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.aws Link Text') }}</span>
                                            </div>
                                        </div>
                                       
                                        @if($result['commonContent']['setting']['facebook_callback_url'] ==1 )
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Android App Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('android_app_link',$result['commonContent']['setting']['android_app_link'], array('class'=>'form-control', 'id'=>'android_app_link')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Android App Link') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Iphone App Link') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('iphone_app_link',$result['commonContent']['setting']['iphone_app_link'], array('class'=>'form-control', 'id'=>'iphone_app_link')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.Iphone App Link') }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.AppName') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('app_name', $result['commonContent']['setting']['app_name'], array('class'=>'form-control', 'id'=>'app_name')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.AppNameText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.NewProductDuration') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('new_product_duration', $result['commonContent']['setting']['new_product_duration'], array('class'=>'form-control', 'id'=>'new_product_duration')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.NewProductDurationText') }}</span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.invoice_prefix') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('invoice_prefix',  stripslashes($result['commonContent']['setting']['invoice_prefix']), array('class'=>'form-control', 'id'=>'invoice_prefix')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">1 Point Number RM</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('one_no_rm',  stripslashes($result['commonContent']['setting']['one_no_rm']), array('class'=>'form-control', 'id'=>'one_no_rm')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Thank you (Description)</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('thank_you',  stripslashes($result['commonContent']['setting']['thank_you']), array('class'=>'form-control', 'id'=>'thank_you')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                          <div data-toggle="modal" data-placement="bottom" data-target="#thankyou"  class="col-sm-10 col-md-4" style="font-size:2rem;cursor:pointer"><i class="fa fa-question-circle"></i></div>
                                        </div>

                                        <div class="modal fade" id="thankyou" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img width="100%" height="100%" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/backendcheckout.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Checkout Page Notes</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::textarea('checkout_shipping_detail',  stripslashes($result['commonContent']['setting']['checkout_shipping_detail']), array('class'=>'form-control', 'id'=>'editor1')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                          <div data-toggle="modal" data-placement="bottom" data-target="#shipping" class="col-sm-10 col-md-4" style="font-size:2rem;cursor:pointer"><i class="fa fa-question-circle"></i></div>
                                        </div>

                                        <div class="modal fade" id="shipping" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img width="100%" height="100%" src="https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/common/images/prototypes/backendthankyou.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                       		<label class="col-sm-2 col-md-3 control-label" style="">Order Open Time</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                    <input type="radio" name="shop_open" value="1" class="" @if($result['commonContent']['setting']['shop_open'] == '1') checked @endif > &nbsp;Always Open
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                    <input type="radio" name="shop_open" value="2" class="" @if($result['commonContent']['setting']['shop_open'] == '2') checked @endif >  &nbsp;Limited By Time
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <?php 
                                        if(!empty($result['commonContent']['setting']['order_open_time'])){
                                            $res = $result['commonContent']['setting']['order_open_time'];
                                            $time = explode('-',$res);
                                            $sTime = $time[0];
                                            $startTime = date('h:i a', strtotime($sTime));
                                            $eTime = $time[1];
                                            $endTime = date('h:i a', strtotime($eTime));
                                        } else {
                                            $startTime = '';
                                            $endTime = '';
                                        }
                                        ?>

                                        <div id="showTime">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Start Hour</label>
                                                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                    <input class="form-control timepicker" type="text" value="{{ $startTime }}" name="start_hour" id="start_hour" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">End Hour</label>
                                                <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                    <input class="form-control timepicker" type="text" value="{{ $endTime }}" name="end_hour" id="end_hour">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>Social Login</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Facebook Login</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="facebook_login" value="1" class="flat-red" @if($result['commonContent']['setting']['facebook_login'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="facebook_login" value="0" class="flat-red" @if($result['commonContent']['setting']['facebook_login'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">Google Login</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="google_login" value="1" class="flat-red" @if($result['commonContent']['setting']['google_login'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="google_login" value="0" class="flat-red" @if($result['commonContent']['setting']['google_login'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>


                                         <hr>
                                        <h4>{{ trans('labels.floating_button') }}</h4>
                                        <hr>
                                        
                                         <div class="form-group">
                                            <label class="col-sm-2 col-md-3 control-label" style="">{{ trans('labels.floating_button') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                <label class=" control-label">
                                                      <input type="radio" name="floating_button" value="1" class="flat-red" @if($result['commonContent']['setting']['floating_button'] == '1') checked @endif > &nbsp;{{ trans('labels.Enabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <label class=" control-label">
                                                      <input type="radio" name="floating_button" value="0" class="flat-red" @if($result['commonContent']['setting']['floating_button'] == '0') checked @endif >  &nbsp;{{ trans('labels.Disabled') }}
                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        
                                        @if($result['commonContent']['setting']['floating_button'] == '1')

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.facebook_chat') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('facebook_chat',  stripslashes($result['commonContent']['setting']['facebook_chat']), array('class'=>'form-control', 'id'=>'facebook_chat')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>


                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.whatsapp_chat') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('whatsapp_chat',  stripslashes($result['commonContent']['setting']['whatsapp_chat']), array('class'=>'form-control', 'id'=>'whatsapp_chat')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>


                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.instagram_chat') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('instagram_chat',  stripslashes($result['commonContent']['setting']['instagram_chat']), array('class'=>'form-control', 'id'=>'instagram_chat')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.telegram_chat') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('telegram_chat',  stripslashes($result['commonContent']['setting']['telegram_chat']), array('class'=>'form-control', 'id'=>'telegram_chat')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">TikTok Chat Id</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('tiktok_id',  stripslashes($result['commonContent']['setting']['tiktok_id']), array('class'=>'form-control', 'id'=>'tiktok_id')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"></span>
                                          </div>
                                        </div>

                                        @endif

                                        <hr>
                                       <!--  <h4>{{ trans('labels.InqueryEmails') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ContactUsEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('contact_us_email', $result['commonContent']['setting']['contact_us_email'], array('class'=>'form-control', 'id'=>'contact_us_email')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.ContactUsEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.OrderEmail') }}</h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.OrderEmail') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('order_email', $result['commonContent']['setting']['order_email'], array('class'=>'form-control', 'id'=>'order_email')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.OrderEmailText') }}</span>
                                            </div>
                                        </div>

                                        <hr> -->
                                        <h4>{{ trans('labels.Orders') }}</h4>
                                        <hr>
                                        

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Min Order Price') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('min_order_price',$result['commonContent']['setting']['min_order_price'], array('class'=>'form-control', 'id'=>'min_order_price')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.Min Order Price Text') }}</span>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>{{ trans('labels.OurInfo') }}</h4>
                                        <hr>
                                       
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.PhoneNumber') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('phone_no', $result['commonContent']['setting']['phone_no'], array('class'=>'form-control', 'id'=>'phone_no')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                    {{ trans('labels.PhoneNumberText') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">LandLine Number</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('landline_no', $result['commonContent']['setting']['landline_no'], array('class'=>'form-control', 'id'=>'landline_no')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">
                                                User will be able to contact to you via this Landline number.</span>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Address') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('address', $result['commonContent']['setting']['address'], array('class'=>'form-control', 'id'=>'address')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.AddressText') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.City') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('city', $result['commonContent']['setting']['city'], array('class'=>'form-control', 'id'=>'city')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.CityText') }}</span>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.State') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('state', $result['commonContent']['setting']['state'], array('class'=>'form-control', 'id'=>'state')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.StateText') }}</span>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Zip') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('zip', $result['commonContent']['setting']['zip'], array('class'=>'form-control', 'id'=>'zip')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.ZipText') }}</span>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Country') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('country', $result['commonContent']['setting']['country'], array('class'=>'form-control', 'id'=>'country')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.CountryContactUs') }}</span>
                                            </div>
                                        </div>
                                       


                                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Latitude') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('latitude', $result['commonContent']['setting']['latitude'], array('class'=>'form-control', 'id'=>'latitude')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.latitudeText') }}</span>
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Longitude') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('longitude', $result['commonContent']['setting']['longitude'], array('class'=>'form-control', 'id'=>'longitude')) !!}<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.LongitudeText') }}</span>
                                            </div>
                                        </div>

                                    </div>



                                    <!-- /.box-body -->
                                    <div class="box-footer text-center">
                                        <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                        <a href="{{ URL::to('admin/dashboard/this_month')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

<script>
    $(function () {

        CKEDITOR.replace('editor1');

      

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

        });
        
        <?php if($result['commonContent']['setting']['shop_open'] == 1) { ?>
            $("#showTime").hide();
        <?php } ?>
        $("input[name$='shop_open']").click(function() {
            var test = $(this).val();
            if(test == '2'){
                $("#showTime").show();
            } else {
                $("#showTime").hide();
            }
        }); 
</script>
@endsection
