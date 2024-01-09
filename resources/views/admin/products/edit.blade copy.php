@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.EditProduct') }} <small>{{ trans('labels.EditProduct') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/products/display')}}"><i class="fa fa-database"></i> {{ trans('labels.ListingAllProducts') }}</a></li>
            <li class="active">{{ trans('labels.EditProduct') }}</li>
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
                        <h3 class="box-title">{{ trans('labels.EditProduct') }} </h3>
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
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        @if( count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        {!! Form::open(array('url' =>'admin/products/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                        {!! Form::hidden('id', $result['product'][0]->products_id, array('class'=>'form-control', 'id'=>'id')) !!}

                                        {!! Form::hidden('furl', $result['fullURL'] , array('class'=>'form-control', 'id'=>'furl')) !!}

                                        <div class="row">
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">{{ trans('labels.Product Type') }} </label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <select id="combo" class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                                            <option value="">{{ trans('labels.Choose Type') }}</option>
                                                            <option value="0" @if($result['product'][0]->products_type==0) selected @endif>{{ trans('labels.Simple') }}</option>
                                                            <option value="1" @if($result['product'][0]->products_type==1) selected @endif>{{ trans('labels.Variable') }}</option>
                                                            <option value="2" @if($result['product'][0]->products_type==2) selected @endif>{{ trans('labels.External') }}</option>
                                                            <option value="3" @if($result['product'][0]->products_type==3) selected @endif>Combo</option>
                                                            <option value="4" @if($result['product'][0]->products_type==4) selected @endif>Buy X and Get X</option>

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
                                                            <option value="">{{ trans('labels.Choose Manufacturer') }}</option>
                                                            @foreach ($result['manufacturer'] as $manufacturer)
                                                            <option @if($result['product'][0]->manufacturers_id == $manufacturer->id )
                                                                selected
                                                                @endif
                                                                value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ChooseManufacturerText') }}.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="name" style="text-align:left" class="col-sm-12 col-md-12 control-label">Button Type</label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <select class="form-control field-validate prodcust-type" name="button_type">
                                                            <option value="1" @if($result['product'][0]->button_type==1) selected @endif>Buy Online</option>
                                                            <option value="2" @if($result['product'][0]->button_type==2) selected @endif>Appointment</option>
                                                            <option value="3" @if($result['product'][0]->button_type==3) selected @endif>Buy Online with Prescription</option>
                                                            <option value="4" @if($result['product'][0]->button_type==4) selected @endif>No Button</option>
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
                                                            <option value="0" @if($result['product'][0]->product_serve==0) selected @endif >None</option>
                                                            <option value="1" @if($result['product'][0]->product_serve==1) selected @endif >Bar</option>
                                                            <option value="2" @if($result['product'][0]->product_serve==2) selected @endif >Kitchen</option>
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
                                                            <option value="0" @if($result['product'][0]->product_view==0) selected @endif>All</option>
                                                            <option value="1" @if($result['product'][0]->product_view==1) selected @endif>User App</option>
                                                            <option value="2" @if($result['product'][0]->product_view==2) selected @endif>Pos App</option>
                                                            <option value="3" @if($result['product'][0]->product_view==3) selected @endif >Table Order</option>
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
                                                    <label for="name" class="col-sm-2 col-md-2 control-label">{{ trans('labels.Category') }}</label>
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

                                        <div id="comboProductEdit" class="row">
                                            <div style="width:96%;overflow-x:auto;margin:auto">
                                                <h4 id="title"></h4>
                                                <table  style="margin-bottom:0px" class="table table-bordered" id="packageTable">  
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Product Name</th>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Qty</th>
                                                        <th>
                                                            <button type="button" name="addPack" id="addPack" class="btn btn-success">Add More</button>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                        $proID = $result['product'][0]->products_id;
                                                        //print_r($proID);die();
                                                        $proCombo = DB::table('product_combo')->where('pro_id', $proID)->get();
                                                    ?>
                                                    @foreach($proCombo as $comkey=>$combo)
                                                        <tr>  
                                                            <td>
                                                                <select id="EpackService_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="cate[]">
                                                                <?php
                                                                    $category = DB::table('categories')
                                                                    ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                                                                    ->where('language_id','=', 1)
                                                                    ->where('categories_status', '1')
                                                                    ->get();
                                                                ?>
                                                                <option value="">Select</option>
                                                                @if(!$category->isEmpty())
                                                                    @foreach($category as $cate)
                                                                        <option @if($cate->categories_id == $combo->cate_id) selected @endif value="{{ $cate->categories_id }}">{{ $cate->categories_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                            <td>
                                                                <select id="EpackArea_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="product[]">
                                                                <?php
                                                                    
                                                                    $product = DB::table('products')
                                                                    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                                                                    ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                                                                    ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                                                                    ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
                                                                    ->whereIn('products_type',[0,1])
                                                                    ->where('products_description.language_id', '=', 1)
                                                                    ->where('categories_description.language_id', '=', 1)
                                                                    ->where('products.products_type','!=', 2)
                                                                    ->where('categories.categories_id', $combo->cate_id)
                                                                    ->orderBy('products.products_id', 'DESC')->get();

                                                                ?>
                                                                @if(!$product->isEmpty())
                                                                    @foreach($product as $pro)
                                                                        <option @if($pro->products_id == $combo->product_id) selected @endif value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                            @if($combo->attractive_id !=0)
                                                                <td>
                                                                    <select  id="EpackSqft_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                    <?php
                                                                        $attribute = DB::table('products_options')
                                                                        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                                                                        ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')
                                                                        ->where('products_options_descriptions.language_id', 1)
                                                                        ->where('products_options.products_options_id', $combo->attractive_id)
                                                                        ->get();
                                                                    ?>
                                                                    @if(!$attribute->isEmpty())
                                                                        @foreach($attribute as $attr)
                                                                            <option @if($attr->products_options_id == $combo->attractive_id) selected @endif value="{{ $attr->products_options_id }}">{{ $attr->products_options_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                    </select>
                                                                </td>  
                                                            @else
                                                                <td>
                                                                    <select style="display:none" id="EpackSqft_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                        <option value='0'>Select</option>
                                                                    </select>
                                                                </td>
                                                            @endif
                                                            @if($combo->option_id !=0)
                                                                <td>
                                                                    <select  id="EattrbValue_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                    <?php
                                                                        $attributeValue = DB::table('products_options')
                                                                        ->join('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                                                                        ->where('products_options.products_options_id', $combo->attractive_id)
                                                                        // ->where('products_options_values.products_options_values_id', $combo->option_id)  
                                                                        ->get();
                                                                    ?>
                                                                    @if(!$attributeValue->isEmpty())
                                                                        @foreach($attributeValue as $attrValue)
                                                                            <option @if($attrValue->products_options_values_id == $combo->option_id) selected @endif value="{{ $attrValue->products_options_values_id }}">{{ $attrValue->products_options_values_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                    </select>
                                                                </td>  
                                                            @else
                                                                <td>
                                                                    <select style="display:none"  id="EattrbValue_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                        <option value='0'>Select</option>
                                                                    </select>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <input class="form-control mob-td-width1 Epackinputs_{{ $comkey }} Epackvalues2_{{ $comkey }} packmul[0] amountdata" name="qty[]" value="{{ $combo->qty }}"  placeholder="Qty">
                                                            </td>  
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                                            </td>  
                                                        </tr>  

                                                        <script>
                                                            $(document).on('click', '.remove-tr', function(){  
                                                                $(this).parents('tr').remove();
                                                            });  
                                                        </script>

                                                        <script>

                                                            // $("#EpackSqft_{{ $comkey }}").hide();
                                                            // $("#EattrbValue_{{ $comkey }}").hide();
                                                            //$("#packArea_{{ $comkey }}").hide();

                                                            $('#EpackService_{{ $comkey }}').change(function() {
                                                            var catID = $('#EpackService_{{ $comkey }}').val();
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
                                                                            $("#EpackArea_{{ $comkey }}").show();
                                                                            $("#EpackArea_{{ $comkey }}").html();
                                                                            $("#EpackSqft_{{ $comkey }}").hide();
                                                                            $("#EattrbValue_{{ $comkey }}").hide();(showData1);
                                                                        }else{
                                                                            $("#EpackArea_{{ $comkey }}").html("");
                                                                            $("#EpackArea_{{ $comkey }}").hide();
                                                                            $("#EpackSqft_{{ $comkey }}").hide();
                                                                            $("#EattrbValue_{{ $comkey }}").hide();
                                                                        }
                                                                    },
                                                                });
                                                            });

                                                            $('#EpackArea_{{ $comkey }}').change(function() {
                                                                var proID = $('#EpackArea_{{ $comkey }}').val();
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
                                                                            $("#EpackSqft_{{ $comkey }}").show();
                                                                            $("#EpackSqft_{{ $comkey }}").html(showData1);
                                                                        }else{
                                                                            $("#EpackSqft_{{ $comkey }}").hide();
                                                                            $("#EattrbValue_{{ $comkey }}").hide();
                                                                            showData1 +="<option value='0'>Select</option>";
                                                                            $("#EpackSqft_{{ $comkey }}").html(showData1);
                                                                            showData2 +="<option value='0'>Select</option>";
                                                                            $("#EattrbValue_{{ $comkey }}").html(showData2);
                                                                        }
                                                                    },
                                                                });
                                                            });
                                                        </script>
                                                   
                                                        <script>
                                                            $('#EpackSqft_{{ $comkey }}').change(function() {
                                                                var proID = $('#EpackArea_{{ $comkey }}').val();
                                                                var proOPTID = $('#EpackSqft_{{ $comkey }}').val();
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
                                                                            $("#EattrbValue_{{ $comkey }}").show();
                                                                            $("#EattrbValue_{{ $comkey }}").html(showData2);
                                                                        }else{
                                                                            $("#EattrbValue_{{ $comkey }}").html("");
                                                                            $("#EattrbValue_{{ $comkey }}").hide();
                                                                        }
                                                                    },
                                                                });
                                                            });

                                                        </script>

                                                    @endforeach
                                                </table> 
                                            </div>
                                        </div>
                                        <hr>

                                        <div id="buyXProductEdit" class="row">
                                            <div style="width:96%;overflow-x:auto;margin:auto">
                                                <h4 id="title"><b>Buy X</b></h4>
                                                <table  style="margin-bottom:0px" class="table table-bordered" id="buyxTable">  
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Product Name</th>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Qty</th>
                                                        <th>
                                                            <button type="button" name="addPackBuyX" id="addPackBuyX" class="btn btn-success">Add More</button>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                        $proID = $result['product'][0]->products_id;
                                                        //print_r($proID);die();
                                                        $proCombo = DB::table('product_buy_x')->where('pro_id', $proID)->get();
                                                    ?>
                                                    @foreach($proCombo as $comkey=>$combo)
                                                        <tr>  
                                                            <td>
                                                                <select id="BpackService_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="cate[]">
                                                                <?php
                                                                    $category = DB::table('categories')
                                                                    ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                                                                    ->where('language_id','=', 1)
                                                                    ->where('categories_status', '1')
                                                                    ->get();
                                                                ?>
                                                                <option value="">Select</option>
                                                                @if(!$category->isEmpty())
                                                                    @foreach($category as $cate)
                                                                        <option @if($cate->categories_id == $combo->cate_id) selected @endif value="{{ $cate->categories_id }}">{{ $cate->categories_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td> 
                                                        
                                                            <td>
                                                                <select id="BpackArea_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="product[]">
                                                                <?php
                                                                    $product = DB::table('products')
                                                                    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                                                                    ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                                                                    ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                                                                    ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
                                                                    ->whereIn('products_type',[0,1])
                                                                    ->where('products_description.language_id', '=', 1)
                                                                    ->where('categories_description.language_id', '=', 1)
                                                                    ->where('products.products_type','!=', 2)
                                                                    ->where('categories.categories_id', $combo->cate_id)
                                                                    ->orderBy('products.products_id', 'DESC')->get();
                                                                ?>
                                                                @if(!$product->isEmpty())
                                                                    @foreach($product as $pro)
                                                                        <option @if($pro->products_id == $combo->product_id) selected @endif value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td> 
                                                        @if($combo->attractive_id !=0) 
                                                            <td>
                                                                <select  id="BpackSqft_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                <?php
                                                                    $attribute = DB::table('products_options')
                                                                    ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                                                                    ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')
                                                                    ->where('products_options_descriptions.language_id', 1)
                                                                    ->where('products_options.products_options_id', $combo->attractive_id)
                                                                    ->get();
                                                                ?>
                                                                 @if(!$attribute->isEmpty())
                                                                    @foreach($attribute as $attr)
                                                                        <option @if($attr->products_options_id == $combo->attractive_id) selected @endif value="{{ $attr->products_options_id }}">{{ $attr->products_options_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                        @else
                                                            <td>
                                                                <select style="display:none"  id="BpackSqft_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr[]">
                                                                    <option value='0'>Select</option>
                                                                </select>
                                                            </td>
                                                        @endif
                                                        @if($combo->option_id !=0)
                                                            <td>
                                                                <select  id="BattrbValue_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                <?php
                                                                     $attributeValue = DB::table('products_options')
                                                                     ->join('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                                                                     ->where('products_options.products_options_id', $combo->attractive_id)
                                                                     // ->where('products_options_values.products_options_values_id', $combo->option_id)  
                                                                     ->get();
                                                                ?>
                                                                @if(!$attributeValue->isEmpty())
                                                                    @foreach($attributeValue as $attrValue)
                                                                        <option @if($attrValue->products_options_values_id == $combo->option_id) selected @endif value="{{ $attrValue->products_options_values_id }}">{{ $attrValue->products_options_values_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                        @else
                                                            <td>
                                                                <select style="display:none"  id="BattrbValue_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue[]">
                                                                    <option value='0'>Select</option>
                                                                </select>
                                                            </td>
                                                        @endif
                                                            <td>
                                                                <input class="form-control mob-td-width1 Bpackinputs_{{ $comkey }} Bpackvalues2_{{ $comkey }} packmul[0] amountdata" name="qty[]" value="{{ $combo->qty }}"  placeholder="Qty">
                                                            </td>  
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                                            </td>  
                                                        </tr>  

                                                        <script>
                                                            $(document).on('click', '.remove-tr', function(){  
                                                                $(this).parents('tr').remove();
                                                            });  
                                                        </script>

                                                        <script>

                                                        $('#BpackService_{{ $comkey }}').change(function() {
                                                        var catID = $('#BpackService_{{ $comkey }}').val();
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
                                                                        $("#BpackArea_{{ $comkey }}").show();
                                                                        $("#BpackArea_{{ $comkey }}").html();
                                                                        $("#BpackSqft_{{ $comkey }}").hide();
                                                                        $("#BattrbValue_{{ $comkey }}").hide();(showData1);
                                                                    }else{
                                                                        $("#BpackArea_{{ $comkey }}").html("");
                                                                        $("#BpackArea_{{ $comkey }}").hide();
                                                                        $("#BpackSqft_{{ $comkey }}").hide();
                                                                        $("#BattrbValue_{{ $comkey }}").hide();
                                                                    }
                                                                },
                                                            });
                                                        });

                                                        $('#BpackArea_{{ $comkey }}').change(function() {
                                                            var proID = $('#BpackArea_{{ $comkey }}').val();
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
                                                                        $("#BpackSqft_{{ $comkey }}").show();
                                                                        $("#BpackSqft_{{ $comkey }}").html(showData1);
                                                                    }else{
                                                                        $("#BpackSqft_{{ $comkey }}").hide();
                                                                        $("#BattrbValue_{{ $comkey }}").hide();
                                                                        showData1 +="<option value='0'>Select</option>";
                                                                        $("#BpackSqft_{{ $comkey }}").html(showData1);
                                                                        showData2 +="<option value='0'>Select</option>";
                                                                        $("#BattrbValue_{{ $comkey }}").html(showData2);
                                                                    }
                                                                },
                                                            });
                                                        });
                                                        </script>

                                                        <script>
                                                        $('#BpackSqft_{{ $comkey }}').change(function() {
                                                            var proID = $('#BpackArea_{{ $comkey }}').val();
                                                            var proOPTID = $('#BpackSqft_{{ $comkey }}').val();
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
                                                                        $("#BattrbValue_{{ $comkey }}").show();
                                                                        $("#BattrbValue_{{ $comkey }}").html(showData2);
                                                                    }else{
                                                                        $("#BattrbValue_{{ $comkey }}").html("");
                                                                        $("#BattrbValue_{{ $comkey }}").hide();
                                                                    }
                                                                },
                                                            });
                                                        });

                                                        </script>

                                                    @endforeach
                                                </table> 
                                            </div>
                                        </div>
                                        <hr>

                                        <div id="getxProductEdit" class="row">
                                            <div style="width:96%;overflow-x:auto;margin:auto">
                                            <h4><b>Get X</b></h4>
                                                <table  style="margin-bottom:0px" class="table table-bordered" id="getxTable">  
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Product Name</th>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Qty</th>
                                                        <th>
                                                            <button type="button" name="addPackGetX" id="addPackGetX" class="btn btn-success">Add More</button>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                        $proID = $result['product'][0]->products_id;
                                                        //print_r($proID);die();
                                                        $proCombo = DB::table('product_get_x')->where('pro_id', $proID)->get();
                                                    ?>
                                                    @foreach($proCombo as $comkey=>$combo)
                                                        <tr>  
                                                            <td>
                                                                <select id="GpackServicegetx_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="cate_get_x[]">
                                                                <?php
                                                                    $category = DB::table('categories')
                                                                    ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                                                                    ->where('language_id','=', 1)
                                                                    ->where('categories_status', '1')
                                                                    ->get();
                                                                ?>
                                                                <option value="">Select</option>
                                                                @if(!$category->isEmpty())
                                                                    @foreach($category as $cate)
                                                                        <option @if($cate->categories_id == $combo->cate_id) selected @endif value="{{ $cate->categories_id }}">{{ $cate->categories_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                            <td>
                                                                <select id="GpackAreagetx_{{ $comkey }}" class="form-control mob-td-width packmul[0]" name="product_get_x[]">
                                                                <?php
                                                                    $product = DB::table('products')
                                                                    ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                                                                    ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
                                                                    ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
                                                                    ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
                                                                    ->whereIn('products_type',[0,1])
                                                                    ->where('products_description.language_id', '=', 1)
                                                                    ->where('categories_description.language_id', '=', 1)
                                                                    ->where('products.products_type','!=', 2)
                                                                    ->where('categories.categories_id', $combo->cate_id)
                                                                    ->orderBy('products.products_id', 'DESC')->get();
                                                                ?>
                                                                @if(!$product->isEmpty())
                                                                    @foreach($product as $pro)
                                                                        <option @if($pro->products_id == $combo->product_id) selected @endif value="{{ $pro->products_id }}">{{ $pro->products_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                        @if($combo->attractive_id !=0) 
                                                            <td>
                                                                <select  id="GpackSqftgetx_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr_get_x[]">
                                                                <?php
                                                                    $attribute = DB::table('products_options')
                                                                    ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_options.products_options_id')
                                                                    ->select('products_options.products_options_id', 'products_options_descriptions.options_name as products_options_name')
                                                                    ->where('products_options_descriptions.language_id', 1)
                                                                    ->where('products_options.products_options_id', $combo->attractive_id)
                                                                    ->get();
                                                                ?>
                                                                 @if(!$attribute->isEmpty())
                                                                    @foreach($attribute as $attr)
                                                                        <option @if($attr->products_options_id == $combo->attractive_id) selected @endif value="{{ $attr->products_options_id }}">{{ $attr->products_options_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td> 
                                                        @else
                                                            <td>
                                                                <select style="display:none"  id="GpackSqftgetx_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attr_get_x[]">
                                                                    <option value='0'>Select</option>
                                                                </select>
                                                            </td>
                                                        @endif
                                                        @if($combo->option_id !=0) 
                                                            <td>
                                                                <select  id="GattrbValuegetx_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue_get_x[]">
                                                                <?php
                                                                     $attributeValue = DB::table('products_options')
                                                                     ->join('products_options_values', 'products_options_values.products_options_id', '=', 'products_options.products_options_id')
                                                                     ->where('products_options.products_options_id', $combo->attractive_id)
                                                                     // ->where('products_options_values.products_options_values_id', $combo->option_id)  
                                                                     ->get();
                                                                ?>
                                                                @if(!$attributeValue->isEmpty())
                                                                    @foreach($attributeValue as $attrValue)
                                                                        <option @if($attrValue->products_options_values_id == $combo->option_id) selected @endif value="{{ $attrValue->products_options_values_id }}">{{ $attrValue->products_options_values_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>
                                                            </td>  
                                                        @else
                                                            <td>
                                                                <select style="display:none"   id="GattrbValuegetx_{{ $comkey }}" class="form-control desk-td-width mob-td-width packmul[0]" name="attrValue_get_x[]">
                                                                    <option value='0'>Select</option>
                                                                </select>
                                                            </td>
                                                        @endif
                                                            <td>
                                                                <input class="form-control mob-td-width1 Gpackinputsgetx_{{ $comkey }} Gpackvalues2getx_{{ $comkey }} packmul[0] amountdata" name="qty_get_x[]" value="{{ $combo->qty }}"  placeholder="Qty">
                                                            </td>  
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                                            </td>  
                                                        </tr>  

                                                        <script>
                                                            $(document).on('click', '.remove-tr', function(){  
                                                                $(this).parents('tr').remove();
                                                            });  
                                                        </script>

                                                        <script>
                                                            $('#GpackServicegetx_{{ $comkey }}').change(function() {
                                                            var catID = $('#GpackServicegetx_{{ $comkey }}').val();
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
                                                                            $("#GpackAreagetx_{{ $comkey }}").show();
                                                                            $("#GpackAreagetx_{{ $comkey }}").html(showData1);
                                                                        }else{
                                                                            $("#GpackAreagetx_{{ $comkey }}").html("");
                                                                            $("#GpackAreagetx_{{ $comkey }}").hide();
                                                                            showData1 +="<option value='0'></option>";
                                                                            $("#GpackAreagetx_{{ $comkey }}").html(showData1);
                                                                        }
                                                                    },
                                                                });
                                                            });


                                                            $("#GpackAreagetx_{{ $comkey }}").change(function() {
                                                                var proID = $("#GpackAreagetx_{{ $comkey }}").val();
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
                                                                            $("#GpackSqftgetx_{{ $comkey }}").show();
                                                                            $("#GpackSqftgetx_{{ $comkey }}").html(showData1);
                                                                        }else{
                                                                            $("#GpackSqftgetx_{{ $comkey }}").html("");
                                                                            $("#GpackSqftgetx_{{ $comkey }}").hide();
                                                                            $("#GattrbValuegetx_{{ $comkey }}").hide();
                                                                            showData1 +="<option value='0'></option>";
                                                                            $("#GpackSqftgetx_{{ $comkey }}").html(showData1);
                                                                            showData2 +="<option value='0'></option>";
                                                                            $("#GattrbValuegetx_{{ $comkey }}").html(showData2);
                                                                        }
                                                                    },
                                                                });
                                                            });
                                                    
                                                            $('#GpackSqftgetx_{{ $comkey }}').change(function() {
                                                                var proID = $('#GpackAreagetx_{{ $comkey }}').val();
                                                            var proOPTID = $('#GpackSqftgetx_{{ $comkey }}').val();
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
                                                                            $("#GattrbValuegetx_{{ $comkey }}").show();
                                                                            $("#GattrbValuegetx_{{ $comkey }}").html(showData2);
                                                                        }else{
                                                                            $("#GattrbValuegetx_{{ $comkey }}").html("");
                                                                            $("#GpackSqftgetx_{{ $comkey }}").hide();
                                                                            $("#GattrbValuegetx_{{ $comkey }}").hide();
                                                                            showData2 +="<option value='0'></option>";
                                                                            $("#GattrbValuegetx_{{ $comkey }}").html(showData2);
                                                                        }
                                                                    },
                                                                });
                                                            });
                                                        </script>

                                                    @endforeach
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
                                                            <option value="0" @if($result['product'][0]->is_feature==0) selected @endif>{{ trans('labels.No') }}</option>
                                                            <option value="1" @if($result['product'][0]->is_feature==1) selected @endif>{{ trans('labels.Yes') }}</option>
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
                                                            <option value="1" @if($result['product'][0]->products_status==1) selected @endif >{{ trans('labels.Active') }}</option>
                                                            <option value="0" @if($result['product'][0]->products_status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
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
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsPrice') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_price', $result['product'][0]->products_price, array('class'=>'form-control number-validate', 'id'=>'products_price')) !!}
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
                                                            <option selected> {{ trans('labels.SelectTaxClass') }}</option>
                                                            @foreach ($result['taxClass'] as $taxClass)
                                                            <option @if($result['product'][0]->products_tax_class_id == $taxClass->tax_class_id )
                                                                selected
                                                                @endif
                                                                value="{{ $taxClass->tax_class_id }}">{{ $taxClass->tax_class_title }}</option>
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
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Min Order Limit') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_min_order', $result['product'][0]->products_min_order, array('class'=>'form-control field-validate number-validate stock-validate', 'id'=>'products_min_order')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.Min Order Limit Text') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.Min Order Limit Text') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Max Order Limit') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_max_stock', $result['product'][0]->products_max_stock, array('class'=>'form-control field-validate number-validate', 'id'=>'products_max_stock')) !!}
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
                                                        {!! Form::text('products_weight', $result['product'][0]->products_weight, array('class'=>'form-control', 'id'=>'products_weight')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.RequiredTextForWeight') }}
                                                        </span>

                                                    </div>
                                                    <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="products_weight_unit">
                                                            
                                                            <option value="gm" @if($result['product'][0]->products_weight_unit=='gm') selected @endif>Gm</option>
                                                           
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductsModel') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_model', $result['product'][0]->products_model, array('class'=>'form-control', 'id'=>'products_model')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.ProductsModelText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">




                                           <!--  <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.VideoEmbedCodeLink') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::textarea('products_video_link', $result['product'][0]->products_video_link, array('class'=>'form-control', 'id'=>'products_video_link', 'rows'=>4)) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.VideoEmbedCodeLinkText') }}
                                                        </span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.slug') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="hidden" name="old_slug" value="{{$result['product'][0]->products_slug}}">
                                                        <input type="text" name="slug" class="form-control field-validate" value="{{$result['product'][0]->products_slug}}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.slugText') }}</span>
                                                        <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                    </div>
                                                </div>
                                            </div>


                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">SKU</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('products_sku', $result['product'][0]->product_sku, array('class'=>'form-control', 'id'=>'products_sku')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Enter product sku if exist (optional).
                                                        </span>
                                                        <span class="help-block hidden">Enter product sku if exist (optional).</span>
                                                    </div>
                                                </div>
                                            </div> 


                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }} </label>
                                                    <div class="col-sm-10 col-md-4">

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
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
                                                                        <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left">{{ trans('labels.Add Image') }}</a>
                                                                        <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                        <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="imageselected">
                                                            {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                            <br>
                                                            <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                            <div class="closimage">
                                                                <button type="button" class="close pull-left image-close " id="image-close"
                                                                  style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.UploadProductImageText') }}</span>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        {!! Form::hidden('oldImage', $result['product'][0]->products_image , array('id'=>'oldImage', 'class'=>'field-validate ')) !!}
                                                        <img src="{{asset($result['product'][0]->path)}}" alt="" width=" 100px">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @if($result['commonContent']['setting']['Inventory']=='1')
                                        <div class="row">
                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Stock</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="stock_status" id="stock_status">
                                                            <option value="1" @if($result['product'][0]->stock_status == 1)
                                                                selected
                                                                @endif>{{ trans('labels.Yes') }}</option>
                                                            <option value="0" @if($result['product'][0]->stock_status == 0)
                                                                selected
                                                                @endif>{{ trans('labels.No') }}</option>
                                                        </select>
                                                       <!--  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.FlashSaleText') }}</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <div id='quantity_type'>
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Quantity Type</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select class="form-control" name="qut_type" id="qut_type">
                                                            <option value="0" @if($result['product'][0]->quantity_type == 0)
                                                                selected
                                                                @endif>Single</option>
                                                            <option value="1" @if($result['product'][0]->quantity_type == 1)
                                                                selected
                                                                @endif>Multiple</option>
                                                        </select>
                                                    </div>
                                                   </div>
                    
                                                    <div id='quantity_count'>
                                                     <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="qunt_count" id="qunt_count" class="form-control" placeholder="Number Quantity" value="{{$result['product'][0]->quantity_count}}">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        @endif
                                         <div class="row">
                                             <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Cost price<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                       {!! Form::text('cost_price', $result['product'][0]->cost_price, array('class'=>'form-control number-validate', 'id'=>'cost_price')) !!}
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
                                                       {!! Form::text('commission', $result['product'][0]->commission_sales, array('class'=>'form-control number-validate', 'id'=>'commission')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Salesperson commission on percentage
                                                        </span>
                                                        <span class="help-block hidden">Salesperson commission on percentage</span>
                                                    </div>
                                                    <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="commission_type">
                                                            <option value="percentage" @if($result['product'][0]->commission_type == 'percentage')selected @endif>Percentage(%)</option>
                                                            <option value="amount" @if($result['product'][0]->commission_type == 'amount')selected @endif>Amount</option>
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
                                                            <option value="no" @if($result['product'][0]->fresh_price == 'no')selected @endif>{{ trans('labels.No') }}</option>
                                                            <option value="yes" @if($result['product'][0]->fresh_price == 'yes')selected @endif>{{ trans('labels.Yes') }}</option>
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
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSale') }}</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" onChange="showFlash()" name="isFlash" id="isFlash">
                                                            <option value="no" @if($result['flashProduct'][0]->flash_status == 0)
                                                                selected
                                                                @endif>{{ trans('labels.No') }}</option>
                                                            <option value="yes" @if($result['flashProduct'][0]->flash_status == 1)
                                                                selected
                                                                @endif>{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            {{ trans('labels.FlashSaleText') }}</span>
                                                    </div>
                                                </div>

                                                <div class="flash-container" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSalePrice') }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input class="form-control" type="text" name="flash_sale_products_price" id="flash_sale_products_price" value="{{$result['flashProduct'][0]->flash_sale_products_price}}">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashSalePriceText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.FlashSalePriceText') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashSaleDate') }}</label>
                                                        @if($result['flashProduct'][0]->flash_status == 1)
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" value="{{date('d/m/Y', $result['flashProduct'][0]->flash_start_date) }}">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashSaleDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time"
                                                              value="{{date('h:i:s A',  $result['flashProduct'][0]->flash_start_date ) }}">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        @else
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashSaleDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" readonly name="flash_start_time" id="flash_start_time" value="">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        @endif

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FlashExpireDate') }}</label>
                                                        @if($result['flashProduct'][0]->flash_status == 1)
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" name="flash_expires_date" id="flash_expires_date"
                                                              value="{{ date('d/m/Y', $result['flashProduct'][0]->flash_expires_date )}}">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashExpireDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="{{ date('h:i:s A', $result['flashProduct'][0]->flash_expires_date ) }}">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        
                                                        @else
                                                        <div class="col-sm-10 col-md-4">
                                                            <input class="form-control datepicker" readonly type="text" name="flash_expires_date" id="flash_expires_date" value="">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.FlashExpireDateText') }}</span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        <div class="col-sm-10 col-md-4 bootstrap-timepicker">
                                                            <input type="text" class="form-control timepicker" readonly name="flash_end_time" id="flash_end_time" value="">
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                        @endif
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

                                                <div class="form-group  special-link">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Special') }} </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" onChange="showSpecial()" name="isSpecial" id="isSpecial">
                                                            <option @if($result['product'][0]->products_id != $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 0)
                                                                selected
                                                                @endif
                                                                value="no">{{ trans('labels.No') }}</option>
                                                            <option @if($result['product'][0]->products_id == $result['specialProduct'][0]->products_id && $result['specialProduct'][0]->status == 1)
                                                                selected
                                                                @endif
                                                                value="yes">{{ trans('labels.Yes') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"> {{ trans('labels.SpecialProductText') }}</span>
                                                    </div>
                                                </div>

                                                <div class="special-container" style="display: none;">
                                                <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">Special Type<span style="color:red;">*</span></label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <select class="form-control" name="specialtype">
                                                            <option @if($result['product'][0]->special_type == 1)
                                                                selected
                                                                @endif
                                                                value="1">Discount (RM)</option>
                                                            <option @if($result['product'][0]->special_type == 2)
                                                                selected
                                                                @endif
                                                                value="2">Discount (%)</option>

                                                              
                                                            </select>
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Select the special product type.</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.SpecialPrice') }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            <input type="text" name="specials_new_products_price"  
                                                            
                                                            value="<?php if(!empty($result['specialProduct'][0]->special_price)){ echo $result['specialProduct'][0]->special_price; }else { echo 0;}?>"
                                                            
                                                            class="form-control" id="special-price">
                                                           
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.SpecialPriceTxt') }}.</span>
                                                            <span class="help-block hidden">{{ trans('labels.SpecialPriceNote') }}.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ExpiryDate') }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                            @if(!empty($result['specialProduct'][0]->status) and $result['specialProduct'][0]->status == 1)
                                                            {!! Form::text('expires_date', date('d/m/Y', $result['specialProduct'][0]->expires_date), array('class'=>'form-control datepicker', 'id'=>'expiry-date', 'readonly'=>'readonly'))
                                                            !!}
                                                            @else
                                                            {!! Form::text('expires_date', '', array('class'=>'form-control datepicker', 'id'=>'expiry-date', 'readonly'=>'readonly')) !!}
                                                            @endif
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                {{ trans('labels.SpecialExpiryDateTxt') }}
                                                            </span>
                                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                        <div class="col-sm-10 col-md-8">
                                                          <select class="form-control" name="status">
                                                            <option
                                                             @if($result['specialProduct'][0]->status == 1 )
                                                               selected
                                                             @endif
                                                             value="1">{{ trans('labels.Active') }}
                                                             </option>
                                                            <option
                                                             @if($result['specialProduct'][0]->status == 0 )
                                                               selected
                                                             @endif
                                                             value="0">{{ trans('labels.Inactive') }}</option>
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
                                                        @php
                                                        $i = 0;
                                                        @endphp
                                                        @foreach($result['languages'] as $key=>$languages)
                                                        <li class="@if($i==0) active @endif"><a href="#product_<?=$languages->languages_id?>" data-toggle="tab"><?=$languages->name?></a></li>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content">
                                                        @php
                                                        $j = 0;
                                                        @endphp
                                                        @foreach($result['description'] as $key=>$description_data)
                                                        <div style="margin-top: 15px;" class="tab-pane @if($j==0) active @endif" id="product_<?=$description_data['languages_id']?>">
                                                            @php
                                                            $j++;
                                                            @endphp
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ProductName') }} ({{ $description_data['language_name'] }})</label>
                                                                <div class="col-sm-10 col-md-4">
                                                                    <input type="text" name="products_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value='{{$description_data['products_name']}}'>
                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        {{ trans('labels.EnterProductNameIn') }} {{ $description_data['language_name'] }} </span>
                                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>

                                                                </div>
                                                            </div>

                                                            <div class="form-group external_link" style="display: none">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.External URL') }} ({{ $description_data['language_name'] }})</label>
                                                                <div class="col-sm-10 col-md-4">
                                                                    <input type="text" name="products_url_<?=$description_data['languages_id']?>" class="form-control products_url" value='{{$description_data['products_url']}}'>
                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        {{ trans('labels.External URL Text') }} ({{ $description_data['language_name'] }}) </span>
                                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }} ({{ $description_data['language_name'] }})</label>
                                                                <div class="col-sm-10 col-md-8">
                                                                    <textarea id="editor<?=$description_data['languages_id']?>" name="products_description_<?=$description_data['languages_id']?>" class="form-control"
                                                                      rows="5">{{stripslashes($description_data['products_description'])}}</textarea>

                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        {{ trans('labels.EnterProductDetailIn') }} {{ $description_data['language_name'] }}</span> </div>
                                                            </div>

                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right" id="normal-btn">{{ trans('labels.Save_And_Continue') }} <i class="fa fa-angle-right 2x"></i></button>
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

        $('#packtotalid').val(i);
        
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
   
        $("#packageTable").append('<tr><td><select id="packService_'+i+'" class="form-control mob-td-width packmul['+i+']"name="cate[]"><option value="">Select</option><?php if(!$category->isEmpty()) { foreach($category as $cate){ ?><option  value="<?php echo $cate->categories_id; ?>"><?php echo $cate->categories_name; ?></option><?php } } ?></select></td><td><select id="packArea_'+i+'" class="form-control mob-td-width packmul['+i+']" name="product[]"><?php if(!$product->isEmpty()) { foreach($product as $pro){ ?><option  value="<?php echo $pro->products_id; ?>"><?php echo $pro->products_name; ?></option><?php } } ?></select></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><?php if(!$attribute->isEmpty()) { foreach($attribute as $attr){ ?><option  value="<?php echo $attr->products_options_id; ?>"><?php echo $attr->products_options_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><option  value="0"></option></select></div><?php } ?></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><?php if(!$attributeValue->isEmpty()) { foreach($attributeValue as $attrValue){ ?><option  value="<?php echo $attrValue->products_options_values_id; ?>"><?php echo $attrValue->products_options_values_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><option  value="0"></option></select></select></div><?php } ?></td><td><input class="form-control mob-td-width1 packinputs_'+i+' packvalues2_'+i+' packmul['+i+'] amountdata'+i+'" name="qty[]" value="1"  placeholder="Price"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');



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
                        showData2 +="<option value='0'></option>";
                        $("#attrbValue_"+i).html(showData2);
                    }
                },
            });
        });

    });

   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

</script>


<script type="text/javascript">
   
    var i = 1;
       
    $("#addPackBuyX").click(function(){
   
        ++i;

        $('#packtotalid').val(i);
        
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
   
        $("#buyxTable").append('<tr><td><select id="packService_'+i+'" class="form-control mob-td-width packmul['+i+']"name="cate[]"><option value="">Select</option><?php if(!$category->isEmpty()) { foreach($category as $cate){ ?><option  value="<?php echo $cate->categories_id; ?>"><?php echo $cate->categories_name; ?></option><?php } }?></select></td><td><select id="packArea_'+i+'" class="form-control mob-td-width packmul['+i+']" name="product[]"><?php if(!$product->isEmpty()) { foreach($product as $pro){ ?><option  value="<?php echo $pro->products_id; ?>"><?php echo $pro->products_name; ?></option><?php } } ?></select></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><?php if(!$attribute->isEmpty()) { foreach($attribute as $attr){ ?><option  value="<?php echo $attr->products_options_id; ?>"><?php echo $attr->products_options_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="packSqft_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attr[]"><option  value="0"></option></select></div><?php } ?></td><td ><?php if(!$product->isEmpty()) { if($pro->products_type == 1) { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><?php if(!$attributeValue->isEmpty()) { foreach($attributeValue as $attrValue){ ?><option  value="<?php echo $attrValue->products_options_values_id; ?>"><?php echo $attrValue->products_options_values_name; ?></option><?php } } ?></select></div><?php } } else { ?><div><select id="attrbValue_'+i+'" class="form-control desk-td-width mob-td-width packmul['+i+']" name="attrValue[]"><option  value="0"></option></select></select></div><?php } ?></td><td><input class="form-control mob-td-width1 packinputs_'+i+' packvalues2_'+i+' packmul['+i+'] amountdata'+i+'" name="qty[]" value="1"  placeholder="Price"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');



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
                        showData2 +="<option value='0'></option>";
                        $("#attrbValue_"+i).html(showData2);
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

<?php if($result['product'][0]->products_type == 3) { ?>
    $("#comboProductEdit").show();
    $("#buyXProductEdit").hide();
    $("#getxProductEdit").hide();
    $("#title").html('');
<?php } else if($result['product'][0]->products_type == 4) { ?>
    $("#comboProductEdit").hide();
    $("#buyXProductEdit").show();
    $("#getxProductEdit").show();
    $("#title").html('<b>Buy X</b>');
<?php } else { ?>
    $("#comboProductEdit").hide();
    $("#buyXProductEdit").hide();
    $("#getxProductEdit").hide();
    $("#title").html('');
<?php } ?>

$('#combo').change(function() {
  if (this.value == '3' ) {
    $("#comboProductEdit").show();
    $("#buyXProductEdit").hide();
    $("#getxProductEdit").hide();
    $("#title").html('');
  } else if(this.value == '4'){
    $("#comboProductEdit").hide();
    $("#buyXProductEdit").show();
    $("#getxProductEdit").show();
    $("#title").html('<b>Buy X</b>');
  } else {
    $("#comboProductEdit").hide();
    $("#buyXProductEdit").hide();
    $("#getxProductEdit").hide();
    $("#title").html('');
  }
});

   
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
                           $("#packSqftgetx_"+i).html("");
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
                    showData1 +="<option value='0'></option>";
                    $("#packArea_0").html(showData1);
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
                    $("#packSqftgetx_0").hide();
                    $("#attrbValuegetx_0").hide();
                    showData2 +="<option value='0'></option>";
                    $("#attrbValuegetx_0").html(showData2);
				}
			},
		});
    });

</script>

@endsection
