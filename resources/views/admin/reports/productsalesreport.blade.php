@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Product Sales Report <small>Product Sales Report...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Product Sales Report</li>
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
                  <form method="get" action="{{url('admin/productsalesreport')}}">
                        <input type="hidden" name="type"  value="all">
                        <input type="hidden"  value="{{csrf_token()}}">
                        <div class="box-body">
                          <div class="col-xs-3">
                            <div class="form-group">
                            <p >{{ trans('labels.Choose start and end date') }}</p>
                                <input class="form-control reservation dateRange" placeholder="{{ trans('labels.Choose start and end date') }}" readonly value="{{app('request')->input('dateRange')}}" name="dateRange" aria-label="Text input with multiple buttons ">
                            </div>
                            </div>

                            <div class="col-xs-3">
                          <div class="form-group">
                          <p >{{trans('labels.ChooseCategory')}}</p>

                          <input type="hidden" id="cat_id" value=" @if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id'])) {{ $_REQUEST['categories_id'] }} @else all @endif">

                            <select id="get_categories_id" type="button" class="btn btn-default select2 dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="categories_id">

                              <option value="all" selected>All</option>
                              @foreach ($result['subCategories'] as  $key=>$subCategories)
                                  <option value="{{ $subCategories->id }}"
                                          @if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id']))
                                            @if( $subCategories->id == $_REQUEST['categories_id'])
                                              selected
                                            @endif
                                          @endif
                                  >{{ $subCategories->name }}</option>
                              @endforeach
                          </select>
                            </div>
                            </div>

                            <div class="col-xs-3">
                          <div class="form-group">
                          <p >Choose Products</p>

                          <input type="hidden" id="products_id" value="@if(isset($_REQUEST['products_id']) and !empty($_REQUEST['products_id'])){{ $_REQUEST['products_id'] }}@endif">

                            <select id="get_products" type="button" class="btn btn-default select2 dropdown-toggle form-control input-group-form get_products" data-toggle="dropdown" name="products_id">

                            <option value="">select Products</option>
                          </select>
                            </div>
                            </div>

                        
                            <div class="col-xs-2" style="padding-top: 30px">                  
                  <div class="form-group">               
                              <button class="btn btn-primary" type="submit" style="height:35px;"><span class="glyphicon glyphicon-search"></span></button>

                              
                                @if(app('request')->input('type') and app('request')->input('type') == 'all')  <a class="btn btn-danger " href="{{url('admin/productsalesreport')}}" style="height:35px;"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                            </div>
                            </div>
                            <div style="width:60%;float:left;" ></div> 
                          </div>
                    </form>     
                  <div class="box-tools pull-right">
                    <form action="{{ URL::to('admin/sales-product-print')}}" target="_blank">
                      <input type="hidden" name="page" value="invioce">
                      <input type="hidden" name="dateRange" value="{{ $result['dateRange'] }} ">
                      <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</button>
                    </form>
                  </div>
                </div>
                @php 
                  $total_amount=0;
                @endphp
              @if(count($result['reports'])>0)  
                @foreach ($result['reports'] as $key =>$orderData)
                  @php 
                    $total_amount=$total_amount+$orderData->final_price;
                  @endphp
                @endforeach
              @endif
          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 
            <!--   <span><b>Sales Report showing for date : </b> {{ $result['dateFrom'] }} - {{ $result['dateTo'] }}</span> -->
              <span><b>NOTE : </b> Showing sales Report From {{ $result['dateFrom'] }} To {{ $result['dateTo'] }} </span>
              <div class="box-tools pull-right">
              
                <h2><small>{{trans('labels.Total Sale Price')}}:</small><small> @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif <span id="">{{$total_amount}}</span>  @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif </h2>
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Date & Time</th>
                      <th>Receipt No</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Options</th>
                      <th>{{ trans('labels.OrderTotal') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(count($result['reports'])>0)
                      @foreach ($result['reports'] as $key =>$orderData)
                      <?php 
                        $symbol_left = DB::table('currencies')->where('symbol_left', '=', $orderData->currency)->first(); 
                      ?>
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$orderData->date_purchased}}</td>
                        <td>{{$result['commonContent']['setting']['invoice_prefix']}}{{$orderData->orders_id}}</td>
                        <td>{{$orderData->products_name}}</td>
                        <td>{{$orderData->products_quantity}}</td>
                        <td>
                            @foreach($orderData->attribute as $attributes)
                              <b>{{ trans('labels.Name') }}:</b> {{ $attributes->products_options }}<br>
                              <b>{{ trans('labels.Value') }}:</b> <?php echo $attributes->products_options_values ?><br>
                              <b>{{ trans('labels.Price') }}:</b>
                                  <?php  
                                      if($symbol_left != '') { echo $orderData->currency.' '.$attributes->options_values_price * $orderData->currency_value; } else  { $attributes->options_values_price * $orderData->currency_value.' '.$orderData->currency; } ?><br /> 
                            @endforeach
                        </td>
                        <td>@if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{$orderData->final_price}} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif</td>
                      </tr>
                      @endforeach
                    @else
                  	<tr>
                    	<td colspan="5"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>

              <div class="col-xs-12" style="background: #eee;">
                <div class="col-xs-12 col-md-6 text-right">
                    
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
    <div class="modal fade" id="myOrderProduct" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Order Product List</h4>
                        </div>
                        <div class="modal-body">
                            <div id="viewOrderProduct"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

@endsection

<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script type="text/javascript">


$(document).ready(function() {
 
  var cat_id = $('#cat_id').val();
  

getcategory(cat_id);






$(document).on('change', '#get_categories_id', function(e){
  var categories_id = $(this).val();

  getcategory(categories_id);

});  


function getcategory(categories_id)
{

  
  var products_id = $('#products_id').val();
 
  
  $.ajax({
    url: "{{ URL::to('admin/getproduct')}}",
    dataType: 'json',
    type: "post",
    // data: '&zone_country_id='+zone_country_id,
        data: {
            "_token": "{{ csrf_token() }}",
            "categories_id" : categories_id,
        },
    success: function(data){
   
    var showData = '';
    if(data.data.length>0){
      var i;
     
      showData += "<option value=''>Select Products</option>";
       
      for (i = 0; i < data.data.length; ++i) {
       
        if(products_id == data.data[i].products_id)
        {
          showData += "<option value='"+data.data[i].products_id+"' selected>"+data.data[i].products_name+"</option>";
        }
        else
        {
        showData += "<option value='"+data.data[i].products_id+"'>"+data.data[i].products_name+"</option>";
        }
      }
           

    }else{
            showData = "<option value=''></option>"
       

    }
    $(".get_products").html(showData);
    }
  });

}
 

});

$(function() {
  var count = $("#countval").val(); 
  var sum = 0;
  for (var i = 1; i <= count; i++){
     sum  += parseFloat($('#totalprice-'+i).val());
  }
 
    $('#grandprice').html(sum.toFixed(2));
 
});

function loadOrderProduct(modal){
    var options = {
            modal: true,
            height:300,
            width:500
        };
    $('#viewOrderProduct').load('{{ URL::to('admin/salesreportdetail')}}/'+modal, function(data) {
      //alert(data);
       $('#myOrderProduct').modal({show:true});
    });    
}
    
</script>
