@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Stock out <small>Add Stock Out...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/inventory/stockoutview')}}"><i class="fa fa-database"></i> Stock Out </a></li>
            <li class="active">Add Stock Out</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Stock Out </h3>
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

                                        <form enctype="multipart/form-data" class="form-horizontal form-validate"  action="{{url('admin/inventory/stockininsert')}}" method="post" onSubmit="return confirm('Are you sure you wish to out the stock?');">
                                         {!! csrf_field() !!}
                                         <input type="hidden" name="stock_type" value="out">
                                        <div class="row">
                                            <div class="col-xs-12">
                                               
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Bill Date Ref</label>
                                                    <div class="col-sm-10 col-md-8">
                                                <input class="form-control datepicker" readonly type="text" name="flash_start_date" id="flash_start_date" readonly value="{{ date('d/m/Y') }}">
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                Please select bill date.</span>
                                                            <span class="help-block hidden">Please select bill date.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Vendor</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate" name="vendor">
                                                            <option value="">Choose Vendor</option>
                                                           @if(!empty($result['vendor']))
                                                                @foreach($result['vendor'] as $jesvendor)
                                                                    <option value="{{$jesvendor->id}}">{{$jesvendor->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please select vendor name.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Document Ref No<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('ref_no', '', array('class'=>'form-control field-validate', 'id'=>'ref_no')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter document reference number.
                                                        </span>
                                                        <span class="help-block hidden">Please enter document reference number.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group" id="tax-class">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Note<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        {!! Form::text('sock_note', '', array('class'=>'form-control field-validate', 'id'=>'sock_note')) !!}
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter note.
                                                        </span>
                                                        <span class="help-block hidden">Please enter note</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- /.stock table add -->
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                         <tr>
                                                            <th>Select Product / Add New Item</th>
                                                            <th>Product Image</th>
                                                            <th>SKU No</th>
                                                            <th>Avl Stock</th>
                                                            <th>Quantity</th>
                                                            <th>Price / Unit</th>
                                                            <th>Discount </th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control select2 field-validate" name="products_id[]" onchange="getval(this,'1')";>
                                                                    <option value="">{{ trans('labels.Choose Product') }}</option>
                                                                    @foreach ($result['products'] as $pro)
                                                                    <option value="{{$pro->products_id}}">{{$pro->products_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br><br>
                                                                <div id="attribute1" style="display:none">
                                                            </td>
                                                            <td>
                                                                <span id="image_view1"></span>
                                                            </td>
                                                            <td>
                                                                <span id="view_suk1"></span>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="current1" name="current[]" class="form-control number-validate" value="0" readonly style="width: 57px">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="stock_quantity1" onkeyup="getTotal('1')" name="stock_quantity[]" class="form-control number-validate" value="0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="price_unit1" onkeyup="getTotal('1')" name="price_unit[]" class="form-control number-validate" value="0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="discount_unit1" onkeyup="getTotal('1')" value="0" name="discount_unit[]" class="form-control number-validate">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="total_amount1" name="total_amount[]" class="form-control number-validate items" readonly>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                         <tr>
                                                            <td colspan="1">
                                                                 <a href="javascript:;" id="addMoreItem"  type="button" class="btn btn-block btn-primary"> <i class="fa fa-plus 2x"></i> <span>Add more Item</span></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Total<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="total" name="total" class="form-control number-validate" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Discount</label>
                                                    <div class="col-sm-10 col-md-8">
                                                         <input type="text" id="discount" name="discount" class="form-control" onkeyup="getTotalDiscount()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6" id="product-weight-outer">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Tax Included</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control product-tax" name="taxin">
                                                            <option value="no">No</option>
                                                            <option value="yes">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Tax 6%<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="tax_amount"  name="tax_amount" class="form-control number-validate" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Grand Total<span style="color:red;">*</span></label></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" id="grand_total" name="grand_total" class="form-control number-validate" readonly >
                                                    </div>
                                                </div>
                                            </div> 

                                        </div>
                                        

                                       

                                        <hr>
                                        

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right" >
                                                <span>Save</span>
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
    var i = 1;
    //alert(i);
    $("#addMoreItem").click(function(){
         ++i;
    $("#example1").append('<tr><td> <select class="form-control select2 field-validate product-type" name="products_id[]" onchange="getval(this,'+i+')";><option value="">{{ trans('labels.Choose Product') }}</option>@foreach ($result['products'] as $pro)<option value="{{$pro->products_id}}">{{$pro->products_name}}</option>@endforeach</select><br><div id="attribute'+i+'" style="display:none"></td><td><span id="image_view'+i+'"></span></td><td><span id="view_suk'+i+'"></span></td><td><input type="text" id="current'+i+'" name="current[]" class="form-control number-validate" value="0" readonly style="width: 57px"></td><td><input type="text" id="stock_quantity'+i+'" name="stock_quantity[]" class="form-control number-validate" value="0" onkeyup="getTotal('+i+')" ></td><td><input type="text" id="price_unit'+i+'" name="price_unit[]" class="form-control number-validate" value="0" onkeyup="getTotal('+i+')"></td><td><input id="discount_unit'+i+'" type="text" name="discount_unit[]" class="form-control number-validate" value="0" onkeyup="getTotal('+i+')"></td><td><input type="text" id="total_amount'+i+'" name="total_amount[]" class="form-control number-validate items" readonly></td></tr>');
    });

    function getval(sel,id)
    {
    $("#loader").show();
    var product_id = sel.value;
    $.ajax({
        url: '{{ URL::to("admin/inventory/ajax_attr_inven")}}'+'/'+product_id,
        type: "GET",
        success: function (res) {
            //console.log(res);
            $('#attribute'+id).html(res);
            $('#attribute'+id).show();
            var has_val = $('#has-attribute').val();
            if(has_val==0){
                $('#attribute-btn').hide();
                $('#attribute-btn-two').hide();
            }else{
                $('#attribute-btn').show();
                $('#attribute-btn-two').show();
            }
        },
    });

    $.ajax({
        url: '{{ URL::to("admin/inventory/get_product")}}'+'/'+product_id,
        type: "GET",
        success: function (res) {
           var data = JSON.parse(res);
           $("#loader").hide();
           $('#view_suk'+id).html(data.product_sku);
           $('#image_view'+id).html('<img src="'+data.path+'" height="50px" width="50px">');
           $("#current"+id).val(data.stock);
           //alert(data.product_sku);
        },
    });
    }
    function getTotal(id)
    {
        //var grandtotal=0;
        var cquantity = $("#stock_quantity"+id).val();
        var amount = $("#price_unit"+id).val();
        var discount = $("#discount_unit"+id).val();
        var current = $("#current"+id).val();
        if(isNaN(cquantity) || cquantity=='') {
            var quantity = '0';
        }else{
            var quantity = cquantity;
        }
        //alert(quantity);
        //alert(current);
        if(parseInt(current) >= parseInt(quantity)){
        var total = parseInt(amount)*parseInt(quantity);
        var gtotal = parseInt(total)-parseInt(discount);
        //alert(gtotal);
        $("#total_amount"+id).val(gtotal);
        var items = new Array();
        var itemCount = document.getElementsByClassName("items");
        var total = 0;
         var id= '';
         for(var i = 0; i < itemCount.length; i++)
         {
           id = "total_amount"+(i+1);
           total = total +  parseInt(document.getElementById(id).value);
         }
         $("#total").val(total);
         $("#grand_total").val(total);
     }else{
        alert('Invalid stock please enter the available stock count.');
        $("#stock_quantity"+id).val('0');
     }
    }

    $(document).on('change','.product-tax', function(){
        var tax = $(this).val();
        if(tax == 'yes'){
            var total_amount = $("#total").val();
            var taxamount = ((parseInt(total_amount)/100)*6);
            var vtaxamount = taxamount.toFixed(2);
            var main_total = (parseFloat(vtaxamount)+parseFloat(total_amount)).toFixed(2);
            
        }else{
           var vtaxamount='0'; 
           var main_total = $("#total").val();
        }
        $("#tax_amount").val(vtaxamount);
        $("#grand_total").val(main_total);
    });

    function getTotalDiscount()
    {
        var discount = $("#discount").val();
        var total = $("#grand_total").val();

        var final_total = (parseFloat(total)-parseFloat(discount)).toFixed(2);
        $("#grand_total").val(final_total);
    }

    function currentstockGet(productid,attributeid,options_id){
        //alert(i);
        $("#loader").show();
        var options_id = options_id;
        var attributeid = attributeid;
        $('.attributeid_'+options_id+'_'+productid).val(attributeid);

        var text= new Array();
        $("input[name='attributeid"+productid+"[]']").each(function(){
            text.push($(this).val());
        });
        $.ajax({
        url: '{{ URL::to("admin/inventory/getcurrentstockarr")}}'+'/'+productid+'/'+text,
        type: "GET",
        success: function (res) {
            $("#loader").hide();
            //console.log(res);
            var data = JSON.parse(res);
            //alert(data.remainingStock)
            $("#current"+i).val(data.remainingStock);
        },
    });  
        
        //$("#loader").hide();
    } 
   
</script>

@endsection