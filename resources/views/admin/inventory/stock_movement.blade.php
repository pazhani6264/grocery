@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Stock Movement <small>Stock Movement...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Stock Movement</li>
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
                             <div class="col-md-12">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-2">
                                     <a href="{{ URL::to('admin/products/add')}}" type="button" class="btn btn-block btn-primary">Add New SKU</a>
                                </div>
                               <div class="col-md-2">
                                <a href="javascript:;" type="button" data-toggle="modal" data-target="#scanBarcode" class="btn btn-block btn-primary">Scan Barcode</a>
                                </div>
                            </div> 
                        </div><br>

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
                                    <div id="attribute1">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID NO.</th>
                                            <th>CATEGORY</th>
                                            <th>PRODUCT IMAGE</th>
                                            <th>SKU NAME</th>
                                            <th>SKU NO.</th>
                                            <th>SELLING PRICE</th>
                                            <th>STOCK BALANCE</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if($result['stock'])
                                                @foreach ($result['stock'] as $key=> $jrestock)
                                                <?php
                                                if ($jrestock->products_type == '0' || $jrestock->products_type == '1' || $jrestock->products_type == '3') {
                                                     $stocks = DB::table('inventory')->where('products_id', $jrestock->products_id)->where('stock_type', 'in')->sum('stock');
                                                     $stockOut = DB::table('inventory')->where('products_id', $jrestock->products_id)->where('stock_type', 'out')->sum('stock');
                                                    $defaultStock = $stocks - $stockOut;
                                                }else{
                                                    $defaultStock = '0';
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{$jrestock->categories_name}}</td>
                                                    <td>{{$jrestock->products_name}}</td>
                                                    <td><img src="{{$jrestock->path}}" style="width: 50px;height: 50px;"></td>
                                                    <td>{{$jrestock->product_sku}}</td>
                                                    <td>{{$jrestock->products_price}}</td>
                                                    <td>{{$defaultStock}}</td>
                                                    <td><a href="javascript:;" onclick="loadDynamicContentModalStock({{$jrestock->products_id}})"  type="button" class="btn btn-block btn-primary">View</a></td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                     @if($result['stock'] != null)
                                        <div class="col-xs-12 text-right">
                                            {{$result['stock']->links()}}
                                        </div>
                                        @endif
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



            <div class="modal fade" id="myStockDetails" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Product Movement Detail List</h4>
                        </div>
                        <div class="modal-body">
                            <div id="myEventeditBooking"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>


              <div class="modal fade" id="scanBarcode" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Scan Barcode Product</h4>
                        </div>
                        <div class="modal-body">
                            <!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .modal-lg {
            width: 670px;
        }
    </style>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
</head>
<body>
    <div id="scanner-container" style="height:500px"></div>

    <script>
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanner-container"),
                constraints: {
                    width: 640,
                    height: 480,
                    facingMode: "environment"
                }
            },
            decoder: {
                readers: ["ean_reader", "upc_reader", "code_128_reader"]
            }
        }, function(err) {
            if (err) {
                console.error(err);
                return;
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            //alert(result.codeResult.code);
            console.log("Barcode detected and decoded : [" + result.codeResult.code + "]");
            var code_data=result.codeResult.code;
            $.ajax({
                url: '{{ URL::to("admin/inventory/scanview")}}'+'/'+code_data,
                type: "GET",
                success: function (res) {
                    $('#attribute1').html(res);
                    $('#scanBarcode').modal('hide'); 
                },
            });
        });
    </script>
</body>
</html>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
