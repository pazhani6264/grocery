@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.AddProduct') }} <small>{{ trans('labels.AddProduct') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/products/display')}}"><i class="fa fa-database"></i> {{ trans('labels.ListingAllProducts') }}</a></li>
            <li class="active">{{ trans('labels.AddProduct') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.AddNewProduct') }} </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if(session()->has('message.level'))
                                    <div class="alert alert-{{ session('message.level') }} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {!! session('message.content') !!}
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        {!! Form::open(array('url' =>'admin/products/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        <input type="hidden" name="furl" value="{{ URL::to("/admin/products/display")}}"/>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">{{ trans('labels.Product Type') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <select id="combo" class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                                            <option value="">{{ trans('labels.Choose Type') }}</option>
                                                            <option value="0">{{ trans('labels.Simple') }}</option>
                                                            <option value="1">{{ trans('labels.Variable') }}</option>
                                                            <option value="2">{{ trans('labels.External') }}</option>
                                                            <option value="3">Combo</option>
                                                            <option value="4">Buy X and Get X</option>

                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.Product Type Text') }}.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">{{ trans('labels.Manufacturers') }} </label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <select class="form-control" name="manufacturers_id">
                                                            <option value="">{{ trans('labels.ChooseManufacturers') }}</option>
                                                            @foreach ($result['manufacturer'] as $manufacturer)
                                                            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                                            @endforeach
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ChooseManufacturerText') }}.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">Button Type</label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <select class="form-control field-validate prodcust-type" name="button_type">
                                                            <option value="1">Buy Online</option>
                                                            <option value="2">Appointment</option>
                                                            <option value="3">Buy Online with Prescription</option>
                                                            <option value="4">No Button</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please Choose Button Type.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">Product Serve</label>
                                                    <div class="col-sm-12 col-md-12">
                                                    <select class="form-control field-validate prodcust-type" name="product_serve">
                                                            <option value="0">None</option>
                                                            <option value="1">Bar</option>
                                                            <option value="2">Kitchen</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please Choose Product Serve</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">Product View</label>
                                                    <div class="col-sm-12 col-md-12">
                                                    <select class="form-control field-validate prodcust-type" name="product_view">
                                                            <option value="0">All</option>
                                                            <option value="1">User App</option>
                                                            <option value="2">Pos App</option>
                                                            <option value="3">Table Order</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please Choose Product View</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-2 control-label">{{ trans('labels.Category') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-9">
                                                        <?php print_r($result['categories']); ?>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ChooseCatgoryText') }}.</span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div id="comboProduct" class="row">
                                            <div style="width:96%;overflow-x:auto;margin:auto">
                                            <h4 id="title"></h4>
                                                <table  style="margin-bottom:0px" class="table table-bordered" id="packageTable">  
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Product Name</th>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Qty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr>  
                                                        <td>
                                                            <select id="packService_0" class="form-control mob-td-width packmul[0]" name="cate[]">
                                                            <?php
                                                                $category = DB::table('categories')
                                                                ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                                ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                                                                ->where('language_id','=', 1)
                                                                ->where('categories_status', '1')
                                                                //->where('categories.categories_id','>', 0)
                                                                ->get();
                                                            ?>
                                                            <option  value="">Select</option>
                                                            @if(!$category->isEmpty())
                                                                @foreach($category as $cate)
                                                                    <option  value="{{ $cate->categories_id }}">{{ $cate->categories_name }}</option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </td>  
                                                        <td>
                                                            <select id="packArea_0" class="form-control mob-td-width packmul[0]" name="product[]">
                                                            <?php
                                                                $product = DB::table('products')
                                                                ->leftJoin('products_description','products_description.products_id', '=', 'products.products_id')
                                                                ->select('products.products_id', 'products_description.products_name','products.products_type')
                                                                ->whereIn('products_type',[0,1])
                                                                ->where('language_id','=', 1)
                                                                ->where('products_status', '1')
                                                                ->where('products.products_type','!=', 2)
                                                                ->get();
                                                            ?>
                                                            @if(!$product->isEmpty())
                                                                @foreach($product as $pro)
                                                                    <option  value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </td>  
                                                        <td>
                                                            @if(!$product->isEmpty())
                                                                <?php if($pro->products_type == 1) { ?>
                                                                    <select  id="packSqft_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select  id="packSqft_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                        <option value="0"></option>
                                                                    </select>
                                                                <?php } ?>
                                                            @endif
                                                        </td> 
                                                        <td>
                                                            @if(!$product->isEmpty())
                                                                <?php if($pro->products_type == 1) { ?>
                                                                    <select  id="attrbValue_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select  id="attrbValue_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                        <option value="0"></option>
                                                                    </select>
                                                                <?php } ?>
                                                            @endif
                                                        </td>  
                                                        <td>
                                                            <input class="form-control mob-td-width1 packinputs_0 packvalues2_0 packmul[0] amountdata" name="qty[]" value="1"  placeholder="Qty">
                                                        </td>  
                                                        <td><button type="button" name="addPack" id="addPack" class="btn btn-success">Add More</button></td>  
                                                    </tr>  
                                                </table> 
                                            </div>
                                        </div>
                                        <hr>

                                        <div id="getxProduct" class="row">
                                            <div style="width:96%;overflow-x:auto;margin:auto">
                                            <h4><b>Get X</b></h4>
                                                <table  style="margin-bottom:0px" class="table table-bordered" id="getxTable">  
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Product Name</th>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Qty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr>  
                                                        <td>
                                                            <select id="packServicegetx_0" class="form-control mob-td-width packmul[0]" name="cate_get_x[]">
                                                            <?php
                                                                $category = DB::table('categories')
                                                                ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                                ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                                                                ->where('language_id','=', 1)
                                                                ->where('categories_status', '1')
                                                                //->where('categories.categories_id','>', 0)
                                                                ->get();
                                                            ?>
                                                                                                                                                                                    <option  value="">Select</option>
                                                                                                                                                                                     @if(!$category->isEmpty())
                                                                @foreach($category as $cate)
                                                                    <option  value="{{ $cate->categories_id }}">{{ $cate->categories_name }}</option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </td>  
                                                        <td>
                                                            <select id="packAreagetx_0" class="form-control mob-td-width packmul[0]" name="product_get_x[]">
                                                            <?php
                                                                $product = DB::table('products')
                                                                ->leftJoin('products_description','products_description.products_id', '=', 'products.products_id')
                                                                ->select('products.products_id', 'products_description.products_name','products.products_type')
                                                                ->whereIn('products_type',[0,1])
                                                                ->where('language_id','=', 1)
                                                                ->where('products_status', '1')
                                                                ->where('products.products_type','!=', 2)
                                                                ->get();
                                                            ?>
                                                            @if(!$product->isEmpty())
                                                                @foreach($product as $pro)
                                                                    <option  value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </td>  
                                                        <td>
                                                            @if(!$product->isEmpty())
                                                                <?php if($pro->products_type == 1) { ?>
                                                                    <select  id="packSqftgetx_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attr_get_x[]">
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select  id="packSqftgetx_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attr_get_x[]">
                                                                        <option value="0"></option>
                                                                    </select>
                                                                <?php } ?>
                                                            @endif
                                                        </td> 
                                                        <td>
                                                            @if(!$product->isEmpty())
                                                                <?php if($pro->products_type == 1) { ?>
                                                                    <select  id="attrbValuegetx_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue_get_x[]">
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <select  id="attrbValuegetx_0" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue_get_x[]">
                                                                        <option value="0"></option>
                                                                    </select>
                                                                <?php } ?>
                                                            @endif
                                                        </td>  
                                                        <td>
                                                            <input class="form-control mob-td-width1 packinputsgetx_0 packvalues2getx_0 packmul[0] amountdata" name="qty_get_x[]" value="1"  placeholder="Qty">
                                                        </td>  
                                                        <td><button type="button" name="addPackGetX" id="addPackGetX" class="btn btn-success">Add More</button></td>  
                                                    </tr>  
                                                </table> 
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.IsFeature') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="is_feature">
                                                            <option value="0">{{ trans('labels.No') }}</option>
                                                            <option value="1">{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.IsFeatureProuctsText') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="products_status">
                                                            <option value="1">{{ trans('labels.Active') }}</option>
                                                            <option value="0">{{ trans('labels.Inactive') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.SelectStatus') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_price', '', array('class'=>'form-control number-validate', 'id'=>'products_price')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductPriceText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group" id="tax-class">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.TaxClass') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate" name="tax_class_id">
                                                            <option selected>{{ trans('labels.SelectTaxClass') }}</option>
                                                            @foreach ($result['taxClass'] as $taxClass)
                                                            <option value="{{ $taxClass->tax_class_id }}">{{ $taxClass->tax_class_title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ChooseTaxClassForProductText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.SelectProductTaxClass') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Min Order Limit') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_min_order', '1', array('class'=>'form-control field-validate number-validate stock-validate', 'id'=>'products_min_order')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.Min Order Limit Text') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.Min Order Limit Text') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Max Order Limit') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_max_stock', '9999', array('class'=>'form-control field-validate number-validate', 'id'=>'products_max_stock')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.Max Order Limit Text') }} if 0 means unlimited.
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.Max Order Limit Text') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6" id="product-weight-outer">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsWeight') }}</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::text('products_weight', '0', array('class'=>'form-control', 'id'=>'products_weight')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.RequiredTextForWeight') }}
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="products_weight_unit">
                                                            
                                                            <option value="gm">Gm</option>
                                                           
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsModel') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_model', '', array('class'=>'form-control', 'id'=>'products_model')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductsModelText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }}</h3>
                                                                    </div>
                                                                    <div class="modal-body manufacturer-image-embed">
                                                                        @if(isset($allimage))
                                                                        <select class="image-picker show-html " name="image_id[]" id="select_img" multiple>
                                                                            <option value=""></option>
                                                                            @foreach($allimage as $key=>$image)
                                                                            <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left">{{ trans('labels.Add Image') }}</a>
                                                                        <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                        <button type="button" class="btn btn-primary" id="selectedICONEMulit" data-dismiss="modal">Done</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="imageselected">
                                                          {!! Form::button( trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                          <br>
                                                          <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                                          <div class="closimage">
                                                              <button type="button" class="close pull-left image-close" id="image-close"
                                                                style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                        </div>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UploadProductImageText') }}</span>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">SKU</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_sku', '', array('class'=>'form-control', 'id'=>'products_sku')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Enter product sku if exist (optional).
                                                        </span>
                                                        <span class="help-block hidden">Enter product sku if exist (optional).</span>
                                                    </div>
                                                </div>
                                            </div> 

                                        </div>
                                        <div class="row">
                                            @if($result['commonContent']['setting']['Inventory']=='1')
                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Stock</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="stock_status" id="stock_status">
                                                            <option value="1">{{ trans('labels.Yes') }}</option>
                                                            <option value="0">{{ trans('labels.No') }}</option>
                                                        </select>
                                                       <!--  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.FlashSaleText') }}</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                             @endif
                                            
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <div id='quantity_type'>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Quantity Type</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select class="form-control" name="qut_type" id="qut_type">
                                                            <option value="0">Single</option>
                                                            <option value="1">Multiple</option>
                                                        </select>
                                                    </div>
                                                   </div>
                    
                                                    <div id='quantity_count'>
                                                     <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="qunt_count" id="qunt_count" class="form-control" placeholder="Number Quantity">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Cost price<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                       {!! Form::text('cost_price', '', array('class'=>'form-control number-validate', 'id'=>'cost_price')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductPriceText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.ProductPriceText') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Product commission<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-4">
                                                       {!! Form::text('commission', '0', array('class'=>'form-control number-validate', 'id'=>'commission')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Salesperson commission on product
                                                        </span>
                                                        <span class="help-block hidden">Salesperson commission on product</span>
                                                    </div>
                                                     <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="commission_type">
                                                            <option value="percentage">Percentage(%)</option>
                                                            <option value="amount">Amount</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                 <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Fresh Price<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="fresh_price" id="fresh_price">
                                                            <option value="no">{{ trans('labels.No') }}</option>
                                                            <option value="yes">{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.FlashSaleText') }}</span>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group flash-sale-link">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSale') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" onChange="showFlash();" name="isFlash" id="isFlash">
                                                            <option value="no">{{ trans('labels.No') }}</option>
                                                            <option value="yes">{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.FlashSaleText') }}</span>
                                                    </div>
                                                </div>

                                                <div class="flash-container" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSalePrice') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input class="form-control" type="text" name="flash_sale_products_price" id="flash_sale_products_price" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashSalePriceText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.FlashSalePriceText') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSaleDate') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" readonly value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashSaleDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" name="flash_start_time" readonly id="flash_start_time" value="">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashExpireDate') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" readonly name="flash_expires_date" id="flash_expires_date" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashExpireDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="flash_status">
                                                                <option value="1">{{ trans('labels.Active') }}</option>
                                                                <option value="0">{{ trans('labels.Inactive') }}</option>
                                                            </select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.ActiveFlashSaleProductText') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group special-link">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Special') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" onChange="showSpecial();" name="isSpecial" id="isSpecial">
                                                            <option value="no">{{ trans('labels.No') }}</option>
                                                            <option value="yes">{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.SpecialProductText') }}.</span>
                                                    </div>
                                                </div>

                                              

                                                <div class="special-container" style="display: none;">

                                                <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Special Type<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="specialtype">
                                                            <option value="1">Discount (RM)</option>
                                                            <option value="2">Discount (%)</option>
                                                            </select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Select the special product type.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SpecialPrice') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input class="form-control" type="text" name="specials_new_products_price" id="special-price" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.SpecialPriceTxt') }}.</span>
                                                            <span class="help-block hidden">{{ trans('labels.SpecialPriceNote') }}.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExpiryDate') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input class="form-control datepicker" readonly readonly type="text" name="expires_date" id="expiry-date" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.SpecialExpiryDateTxt') }}
                                                            </span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="status">
                                                                <option value="1">{{ trans('labels.Active') }}</option>
                                                                <option value="0">{{ trans('labels.Inactive') }}</option>
                                                            </select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.ActiveSpecialProductText') }}.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        @foreach($result['languages'] as $key=>$languages)
                                                        <li class="@if($key==0) active @endif"><a href="#product_<?=$languages->languages_id?>" data-toggle="tab"><?=$languages->name?><span style="color:red;">*</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content">
                                                        @foreach($result['languages'] as $key=>$languages)

                                                        <div style="margin-top: 15px;" class="tab-pane @if($key==0) active @endif" id="product_<?=$languages->languages_id?>">
                                                            <div class="">
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductName') }}<span style="color:red;">*</span> ({{ $languages->name }})</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="products_name_<?=$languages->languages_id?>" class="form-control field-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.EnterProductNameIn') }} {{ $languages->name }} </span>
                                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group external_link" style="display: none">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.External URL') }} ({{ $languages->name }})</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="url" name="products_url_<?=$languages->languages_id?>" class="form-control products_url" value="https://grocery.platinum24.net/">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.External URL Text') }} {{ $languages->name }} </span>
                                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }}<span style="color:red;">*</span> ({{ $languages->name }})</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="editor<?=$languages->languages_id?>" name="products_description_<?=$languages->languages_id?>" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.EnterProductDetailIn') }} {{ $languages->name }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <span>{{ trans('labels.Save_And_Continue') }}</span>
                                                <i class="fa fa-angle-right 2x"></i>
                                            </button>
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
<style type="text/css">
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
    </style>
<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">
    $(function() {

        //for multiple languages
        @foreach($result['languages'] as $languages)
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor{{$languages->languages_id}}',
        {
          customConfig : 'config.js',
          filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
          toolbar : 'simple',
          filebrowserUploadMethod: 'form',
        });

        @endforeach

        //bootstrap WYSIHTML5 - text editor
        //$(".textarea").wysihtml5();

    });
</script>


<script type="text/javascript">
   
    var i = 1;
       
    $("#addPack").click(function(){
   
        ++i;
        
        <?php
            $category = DB::table('categories')
            ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
            ->where('language_id','=', 1)
            ->where('categories_status', '1')
            ->get();
        ?>

        <?php
            $product = DB::table('products')
            ->leftJoin('products_description','products_description.products_id', '=', 'products.products_id')
            ->select('products.products_id', 'products_description.products_name','products.products_type')
            ->whereIn('products_type',[0,1])
            ->where('language_id','=', 1)
            ->where('products_status', '1')
            //->where('categories.categories_id','>', 0)
            ->get();
        ?>

        <?php
            $attribute = DB::table('products_options')
            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
            ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')
            ->where('products_options_descriptions.language_id', 1)
            ->get();
        ?>

        <?php
            $attributeValue = DB::table('products_options')
            ->join('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')->get();
        ?>
   
        $("#packageTable").append('<tr><td><select id="packService_'+i+'" class="form-control mob-td-width packmul['+i+']"name="cate[]"><option value="">Select</option><?php if(!$category->isEmpty()) { foreach($category as $cate){ ?><option  value="<?php echo $cate->categories_id; ?>"><?php echo $cate->categories_name; ?></option><?php } }?></select></td><td><select id="packArea_'+i+'" class="form-control mob-td-width packmul['+i+']" name="product[]"><?php if(!$product->isEmpty()) { foreach($product as $pro){ ?><option  value="<?php echo $pro->products_id; ?>"><?php echo $pro->products_name; ?></option><?php } } ?></select></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><?php if(!$attribute->isEmpty()) { foreach($attribute as $attr){ ?><option  value="<?php echo $attr->products_options_id; ?>"><?php echo $attr->products_options_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><option  value="0"></option></select></div><?php } ?></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><?php if(!$attributeValue->isEmpty()) { foreach($attributeValue as $attrValue){ ?><option  value="<?php echo $attrValue->products_options_values_id; ?>"><?php echo $attrValue->products_options_values_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><option  value="0"></option></select></select></div><?php } ?></td><td><input class="form-control mob-td-width1 packinputs_'+i+' packvalues2_'+i+' packmul['+i+'] amountdata'+i+'" name="qty[]" value="1"  placeholder="Price"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');


        $("#packSqft_"+i).hide();
        $("#attrbValue_"+i).hide();
        $("#packArea_"+i).hide();

        $('#packService_'+i).change(function() {
            var catID = $('#packService_'+i).val();
            $.ajax({
                url: '{{ URL::to("admin/products/ajax_product")}}',
                type: "POST",
                data: '&catID='+catID,
                success: function (data) {
                    var result = data.product;
                    var showData1 = '';
                    if(result.length != ''){
                        var k;
                        showData1 +="<option value=''>Select</option>";
                        for (k = 0; k < result.length; ++k) {
                            showData1 +="<option value='"+result[k].products_id+"'>"+result[k].products_name+"</option>";
                        }
                        $("#packArea_"+i).show();
                        $("#packArea_"+i).html(showData1);
                    }else{
                        $("#packArea_"+i).html("");
                        $("#packArea_"+i).hide();
                        showData1 +="<option value='0'></option>";
                        $("#packArea_"+i).html(showData1);
                    }
                },
            });
        });

        $(document).ready(function() {
            $("#packArea_"+i).change(function() {
                var proID = $("#packArea_"+i).val();
                $.ajax({
                    url: '{{ URL::to("admin/products/ajax_attribute")}}',
                    type: "POST",
                    data: '&proID='+proID,
                    success: function (data) {
                        var result = data.attribute;
                        var showData1 = '';
                        var showData2 = '';
                        if(result.length != ''){
                            var k;
                            showData1 +="<option value=''>Select</option>";
                            for (k = 0; k < result.length; ++k) {
                                showData1 +="<option value='"+result[k].products_options_id+"'>"+result[k].products_options_name+"</option>";
                            }
                            $("#packSqft_"+i).show();
                            $("#packSqft_"+i).html(showData1);
                        }else{
                            $("#packSqft_"+i).html("");
                            $("#packSqft_"+i).hide();
                            $("#attrbValue_"+i).hide();
                            showData1 +="<option value='0'></option>";
                            $("#packSqft_"+i).html(showData1);
                            showData2 +="<option value='0'></option>";
                            $("#attrbValue_"+i).html(showData2);
                        }
                    },
                });
            });
        });

        $(document).ready(function() {
            $('#packSqft_'+i).change(function() {
                var proID = $('#packArea_'+i).val();
                var proOPTID = $('#packSqft_'+i).val();
                $.ajax({
                    url: '{{ URL::to("admin/products/ajax_attribute_value")}}',
                    type: "POST",
                    data: '&proOPTID='+proOPTID+'&proID='+proID,
                    success: function (data) {
                        var result = data.attributeValue;
                        var showData2 = '';
                        if(result.length != ''){
                            var k;
                            showData2 +="<option value=''>Select</option>";
                            for (k = 0; k < result.length; ++k) {
                                showData2 +="<option value='"+result[k].products_options_values_id+"'>"+result[k].products_options_values_name+"</option>";
                            }
                            $("#attrbValue_"+i).show();
                            $("#attrbValue_"+i).html(showData2);
                        }else{
                            $("#attrbValue_"+i).html("");
                            $("#packSqft_"+i).hide();
                            $("#attrbValue_"+i).hide();
                            showData1 +="<option value='0'></option>";
                            $("#attrbValue_"+i).html(showData1);
                        }
                    },
                });
            });
        });

    });

   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

</script>


<script>

    $("#packSqft_0").hide();
    $("#attrbValue_0").hide();
    $("#packArea_0").hide();

    $('#packService_0').change(function() {
        var catID = $('#packService_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_product")}}',
			type: "POST",
			data: '&catID='+catID,
			success: function (data) {
                var result = data.product;
                var showData1 = '';
				if(result.length != ''){
					var k;
                    showData1 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData1 +="<option value='"+result[k].products_id+"'>"+result[k].products_name+"</option>";
                    }
                    $("#packArea_0").show();
					$("#packArea_0").html(showData1);
				}else{
					$("#packArea_0").html("");
                    $("#packArea_0").hide();
                    $("#packSqft_0").hide();
                    $("#attrbValue_0").hide();
                    showData1 +="<option value='0'></option>";
                    $("#packArea_0").html(showData1);
				}
			},
		});
    });

    $('#packArea_0').change(function() {
        var proID = $('#packArea_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_attribute")}}',
			type: "POST",
			data: '&proID='+proID,
			success: function (data) {
                var result = data.attribute;
                var showData1 = '';
                var showData2 = '';
				if(result.length != ''){
					var k;
                    showData1 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData1 +="<option value='"+result[k].products_options_id+"'>"+result[k].products_options_name+"</option>";
                    }
                    $("#packSqft_0").show();
					$("#packSqft_0").html(showData1);
				}else{
                    $("#packSqft_0").hide();
                    $("#attrbValue_0").hide();
                    showData1 +="<option value='0'></option>";
                    $("#packSqft_0").html(showData1);
                    showData2 +="<option value='0'></option>";
                    $("#attrbValue_0").html(showData2);
				}
			},
		});
    });

    $('#packSqft_0').change(function() {
        var proID = $('#packArea_0').val();
        var proOPTID = $('#packSqft_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_attribute_value")}}',
			type: "POST",
			data: '&proOPTID='+proOPTID+'&proID='+proID,
			success: function (data) {
                var result = data.attributeValue;
                var showData2 = '';
				if(result.length != ''){
					var k;
                    showData2 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData2 +="<option value='"+result[k].products_options_values_id+"'>"+result[k].products_options_values_name+"</option>";
                    }
                    $("#attrbValue_0").show();
					$("#attrbValue_0").html(showData2);
				}else{
					$("#attrbValue_0").html("");
                    $("#packSqft_0").hide();
                    $("#attrbValue_0").hide();
                    showData2 +="<option value='0'></option>";
                    $("#attrbValue_0").html(showData2);
				}
			},
		});
    });

</script>



<script type="text/javascript">
   
    var i = 1;
       
    $("#addPackGetX").click(function(){
   
        ++i;
        
        <?php
            $category = DB::table('categories')
            ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
            ->where('language_id','=', 1)
            ->where('categories_status', '1')
            ->get();
        ?>

        <?php
            $product = DB::table('products')
            ->leftJoin('products_description','products_description.products_id', '=', 'products.products_id')
            ->select('products.products_id', 'products_description.products_name','products.products_type')
            ->whereIn('products_type',[0,1])
            ->where('language_id','=', 1)
            ->where('products_status', '1')
            //->where('categories.categories_id','>', 0)
            ->get();
        ?>

        <?php
            $attribute = DB::table('products_options')
            ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
            ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')
            ->where('products_options_descriptions.language_id', 1)
            ->get();
        ?>

        <?php
            $attributeValue = DB::table('products_options')
            ->join('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')->get();
        ?>
   
        $("#getxTable").append('<tr><td><select id="packServicegetx_'+i+'" class="form-control mob-td-width packmul['+i+']"name="cate_get_x[]"><option value="">Select</option><?php if(!$category->isEmpty())  { foreach($category as $cate){ ?><option  value="<?php echo $cate->categories_id; ?>"><?php echo $cate->categories_name; ?></option><?php } } ?></select></td><td><select id="packAreagetx_'+i+'" class="form-control mob-td-width packmul['+i+']" name="product_get_x[]"><?php if(!$product->isEmpty()) {  foreach($product as $pro){ ?><option  value="<?php echo $pro->products_id; ?>"><?php echo $pro->products_name; ?></option><?php } } ?></select></td><td><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="packSqftgetx_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr_get_x[]"><?php if(!$attribute->isEmpty()) { foreach($attribute as $attr){ ?><option  value="<?php echo $attr->products_options_id; ?>"><?php echo $attr->products_options_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="packSqftgetx_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr_get_x[]"><option  value="0"></option></select></div><?php } ?></td><td><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="attrbValuegetx_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue_get_x[]"><?php if(!$attributeValue->isEmpty()) {  foreach($attributeValue as $attrValue){ ?><option  value="<?php echo $attrValue->products_options_values_id; ?>"><?php echo $attrValue->products_options_values_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="attrbValuegetx_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue_get_x[]"><option  value="0"></option></select></div><?php } ?></td><td><input class="form-control mob-td-width1 packinputsgetx_'+i+' packvalues2getx_'+i+' packmul['+i+'] amountdata'+i+'" name="qty_get_x[]" value="1"  placeholder="Price"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');


        $("#packSqftgetx_"+i).hide();
        $("#attrbValuegetx_"+i).hide();
        $("#packAreagetx_"+i).hide();

        $('#packServicegetx_'+i).change(function() {
            var catID = $('#packServicegetx_'+i).val();
            $.ajax({
                url: '{{ URL::to("admin/products/ajax_product")}}',
                type: "POST",
                data: '&catID='+catID,
                success: function (data) {
                    var result = data.product;
                    var showData1 = '';
                    if(result.length != ''){
                        var k;
                        showData1 +="<option value=''>Select</option>";
                        for (k = 0; k < result.length; ++k) {
                            showData1 +="<option value='"+result[k].products_id+"'>"+result[k].products_name+"</option>";
                        }
                        $("#packAreagetx_"+i).show();
                        $("#packAreagetx_"+i).html(showData1);
                    }else{
                        $("#packAreagetx_"+i).html("");
                        $("#packAreagetx_"+i).hide();
                        showData1 +="<option value='0'></option>";
                        $("#packAreagetx_"+i).html(showData1);
                    }
                },
            });
        });


        $("#packAreagetx_"+i).change(function() {
            var proID = $("#packAreagetx_"+i).val();
            $.ajax({
                url: '{{ URL::to("admin/products/ajax_attribute")}}',
                type: "POST",
                data: '&proID='+proID,
                success: function (data) {
                    var result = data.attribute;
                    var showData1 = '';
                    var showData2 = '';
                    if(result.length != ''){
                        var k;
                        showData1 +="<option value=''>Select</option>";
                        for (k = 0; k < result.length; ++k) {
                            showData1 +="<option value='"+result[k].products_options_id+"'>"+result[k].products_options_name+"</option>";
                        }
                        $("#packSqftgetx_"+i).show();
                        $("#packSqftgetx_"+i).html(showData1);
                    }else{
                        $("#packSqftgetx_"+i).hide();
                        $("#attrbValuegetx_"+i).hide();
                        showData1 +="<option value='0'></option>";
                        $("#packSqftgetx_"+i).html(showData1);
                        showData2 +="<option value='0'></option>";
                        $("#attrbValuegetx_"+i).html(showData2);
                    }
                },
            });
        });

        $('#packSqftgetx_'+i).change(function() {
            var proID = $('#packAreagetx_'+i).val();
        var proOPTID = $('#packSqftgetx_'+i).val();
            $.ajax({
                url: '{{ URL::to("admin/products/ajax_attribute_value")}}',
                type: "POST",
                data: '&proOPTID='+proOPTID+'&proID='+proID,
                success: function (data) {
                    var result = data.attributeValue;
                    var showData2 = '';
                    if(result.length != ''){
                        var k;
                        showData2 +="<option value=''>Select</option>";
                        for (k = 0; k < result.length; ++k) {
                            showData2 +="<option value='"+result[k].products_options_values_id+"'>"+result[k].products_options_values_name+"</option>";
                        }
                        $("#attrbValuegetx_"+i).show();
                        $("#attrbValuegetx_"+i).html(showData2);
                    }else{
                        $("#attrbValuegetx_"+i).html("");
                        $("#packSqftgetx_"+i).hide();
                        $("#attrbValuegetx_"+i).hide();
                        showData2 +="<option value='0'></option>";
                        $("#attrbValuegetx_"+i).html(showData2);
                    }
                },
            });
        });


    });

   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

</script>


<script>

    $("#packSqftgetx_0").hide();
    $("#attrbValuegetx_0").hide();
    $("#packAreagetx_0").hide();

    $('#packServicegetx_0').change(function() {
        var catID = $('#packServicegetx_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_product")}}',
            type: "POST",
            data: '&catID='+catID,
            success: function (data) {
                var result = data.product;
                var showData1 = '';
                if(result.length != ''){
                    var k;
                    showData1 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData1 +="<option value='"+result[k].products_id+"'>"+result[k].products_name+"</option>";
                    }
                    $("#packAreagetx_0").show();
                    $("#packAreagetx_0").html(showData1);
                }else{
                    $("#packAreagetx_0").html("");
                    $("#packAreagetx_0").hide();
                    showData1 +="<option value='0'></option>";
                    $("#packAreagetx_0").html(showData1);
                }
            },
        });
    });

    $('#packAreagetx_0').change(function() {
        var proID = $('#packAreagetx_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_attribute")}}',
			type: "POST",
			data: '&proID='+proID,
			success: function (data) {
                var result = data.attribute;
                var showData1 = '';
                var showData2 = '';
				if(result.length != ''){
					var k;
                    showData1 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData1 +="<option value='"+result[k].products_options_id+"'>"+result[k].products_options_name+"</option>";
                    }
                    $("#packSqftgetx_0").show();
					$("#packSqftgetx_0").html(showData1);
				}else{
                    $("#packSqftgetx_0").hide();
                    $("#attrbValuegetx_0").hide();
                    showData1 +="<option value='0'></option>";
                    $("#packSqftgetx_0").html(showData1);
                    showData2 +="<option value='0'></option>";
                    $("#attrbValuegetx_0").html(showData2);
				}
			},
		});
    });

    $('#packSqftgetx_0').change(function() {
        var proID = $('#packAreagetx_0').val();
        var proOPTID = $('#packSqftgetx_0').val();
        $.ajax({
            url: '{{ URL::to("admin/products/ajax_attribute_value")}}',
			type: "POST",
			data: '&proOPTID='+proOPTID+'&proID='+proID,
			success: function (data) {
                var result = data.attributeValue;
                var showData2 = '';
				if(result.length != ''){
					var k;
                    showData2 +="<option value=''>Select</option>";
                    for (k = 0; k < result.length; ++k) {
                        showData2 +="<option value='"+result[k].products_options_values_id+"'>"+result[k].products_options_values_name+"</option>";
                    }
                    $("#attrbValuegetx_0").show();
					$("#attrbValuegetx_0").html(showData2);
				}else{
					$("#attrbValuegetx_0").html("");
                    $("#attrbValuegetx_0").hide();
                    showData2 +="<option value='0'></option>";
                    $("#attrbValuegetx_0").html(showData2);
				}
			},
		});
    });

</script>

@endsection