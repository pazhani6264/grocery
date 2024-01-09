@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Stock In <small>Stock In...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">Stock In</li>
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
                                <div class="col-md-4">
                    <form  name='registration' method="get" action="{{url('admin/inventory/stockinview')}}" class="form-validate">
                        <input type="hidden" name="type" value="all">
                                     <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Choose start and end date') }}</label>
                    <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                  </div>
                                </div>

                                <div class="col-md-2" style="padding-top: 25px">                  
                  <div class="form-group">
                    <button class="btn btn-primary" id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{url('admin/inventory/stockinview')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                  </div>
                </div>
                 <div class="col-md-4" style="padding-top: 25px">
                 </div>
                </form> 
                                
                               <div class="col-md-2" style="padding-top: 25px">
                                <a href="{{ URL::to('admin/inventory/stockin')}}" type="button" class="btn btn-block btn-primary">New Stock-In</a>
                                </div>
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
                                            <th>Stock-IN Date</th>
                                            <th>Supplier Invoice No.</th>
                                            <th>Supplier Invoice Amount</th>
                                            <th>Supplier Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                             @if(count($result['stock'])>0)
                                                @foreach ($result['stock'] as $key=> $jrestock)
                                                <?php
                                                $symbol = DB::table('currencies')->where('is_default', '=', '1')->first();
                                                $vendor = DB::table('vendor')->where('id', '=', $jrestock->vendor)->first(); 
                                                if($vendor){
                                                    $vend_name=$vendor->name;
                                                }else{
                                                    $vend_name="";
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{$jrestock->created_at}}</td>
                                                    <td><a href="javascript:;" onclick="loadModalStockIn({{$jrestock->id}},'in')">{{$jrestock->ref_no}}</a></td>
                                                    <td>
                                                        @if($symbol->symbol_left != '')  {{ $symbol->symbol_left }}  {{ number_format($jrestock->grand_total *  $symbol->value,2) }} @else  {{ number_format($jrestock->grand_total *  $symbol->value,2) }}  {{ $symbol->symbol_right }} @endif
                                                    </td>
                                                    <td>{{$vend_name}}</td>
                                                </tr>
                                                @endforeach
                                            @else  
                                            <tr>
                                                <td colspan="4">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                           @endif
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



            <div class="modal fade" id="myStockIN" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Product Stock IN List</h4>
                        </div>
                        <div class="modal-body">
                            <div id="myEventeditStockIN"></div>
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
