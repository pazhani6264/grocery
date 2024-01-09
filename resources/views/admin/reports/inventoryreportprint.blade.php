@extends('admin.layout')
<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
          <div class="box-body no-padding">
              <form  name='registration' method="get" action="{{url('admin/customers-orders-report')}}">
              <input type="hidden" name="type" value="all">
              <div class="box-body">
              @if(app('request')->input('dateRange'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Date') }}</label>
                    <p>{{app('request')->input('dateRange')}}</p>
                  </div>
                </div>
                @endif
                @if( app('request')->input('products_id'))
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('labels.Products') }}</label>
                        @foreach($result['products'] as $product)
                        <p> @if( app('request')->input('products_id' ) == $product->products_id) {{ $product->products_name }} @endif </p>
                        @endforeach
                        
                  </div>
                </div>
                @endif

                
      
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
            <div class="box-tools pull-right" style="margin-right:50px">
              <?php $instock = 0; $outstock = 0 ; ?>
                    @foreach ($result['reports'] as  $key=>$report)
                      @if($report->stock_type == 'in')
                        @php $instock = $instock + $report->stock; @endphp
                      @endif
                      @if($report->stock_type == 'out')
                        @php $outstock = $outstock + $report->stock; @endphp
                      @endif 
                    @endforeach

                    <b> Current Stock <?php echo $instock - $outstock; ?></b>
            </div>
            <hr />
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ trans('labels.Date') }}</th>
                  <th>{{ trans('labels.In Stock') }}</th>
                  <th>{{ trans('labels.Out Stock') }}</th>
                  <th>{{ trans('labels.attributes') }}</th>
                  <th>{{ trans('labels.Reference') }}</th>
                </tr>
              </thead>
              <tbody>
                    @foreach ($result['reports'] as  $key=>$report)
                       @php
                      $language_id      =   '1';
                      $attributes = DB::table('orders_products_attributes')->where('orders_id', $report->reference_code)->where('products_id', $report->products_id)->get();
                      $stockout = DB::table('inventory')
                       ->join('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                       ->join('products_attributes', 'products_attributes.products_attributes_id', '=', 'inventory_detail.attribute_id')
                       ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'products_attributes.options_id')
                       ->join('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'products_attributes.options_values_id')
                       ->select('products_options_descriptions.options_name','products_options_values_descriptions.options_values_name')
                       ->where('products_options_descriptions.language_id', '=', $language_id)
                       ->where('products_options_values_descriptions.language_id', '=', $language_id)
                       ->where('inventory.inventory_ref_id', '=', $report->inventory_ref_id)
                       ->get();

                    @endphp
                        <tr>
                            <td>{{ date('m/d/Y', strtotime($report->created_at)) }}</td>
                            @if($report->stock_type == 'in')
                            <td>{{ $report->stock }}</td>
                            @else
                            <td>---</td>                            
                            @endif

                            @if($report->stock_type == 'out')
                            <td>{{ $report->stock }}</td>
                            @else
                            <td>---</td>                            
                            @endif 
                            <td>
                              @if($report->reference_code=='no  refrence')
                                @if(!empty($stockout))
                                   @foreach($stockout as $jesstockout)
                                      {{ $jesstockout->options_name }} : {{ $jesstockout->options_values_name }} <br>
                                    @endforeach
                                @endif
                              @else
                                @if(!empty($attributes))
                                  @foreach($attributes as $jesattributes)
                                    {{ $jesattributes->products_options }} : {{ $jesattributes->products_options_values }} <br>
                                  @endforeach
                                @endif 
                              @endif
                            </td>
                            @if($report->reference_code)
                            <td>{{ $report->reference_code }}</td>
                            @else
                            <td>---</td>                            
                            @endif
                            
                        </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
