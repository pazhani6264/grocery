@extends('admin.layout')
@section('content')
<style>
    .section-show{
        display:inline-block;
    }
    .section-hide{
        display:none;
    }
    #deleteProduct{
        display:none;
    }
    #cloneProduct{
        display:none;
    }
    #multistatus{
        display:none;
    }
    #selectItem{
        display:none;
    }
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Products') }} <small>{{ trans('labels.ListingAllProducts') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.Products') }}</li>
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

                            <div CLASS="col-lg-12"> <!-- <h7 style="font-weight: bold; padding:0px 16px; float: left;">{{ trans('labels.FilterByCategory/Products') }}:</h7> -->

                                <br>
                           <div class=" form-inline">

                                <form  name='registration' id="registration1" class="registration1" method="get" style="margin-bottom:20px;">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="input-group-form search-panel ">
                                        <select type="button" id="search_filter" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy">
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="category"  @if(isset($FilterBy)) @if  ($FilterBy == "category") {{ 'selected' }} @endif @endif>Category</option>
                                            <option value="type"  @if(isset($FilterBy)) @if  ($FilterBy == "type") {{ 'selected' }} @endif @endif>Type</option>
                                            <option value="product"  @if(isset($FilterBy)) @if  ($FilterBy == "product") {{ 'selected' }} @endif @endif>Product</option>

                                        </select>

                                        <div id="section1" class="section" style="margin:0 20px;">

                                            <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="categories_id">

                                                <option value="" selected disabled hidden>{{trans('labels.ChooseCategory')}}</option>
                                                @foreach ($results['subCategories'] as  $key=>$subCategories)
                                                    <option value="{{ $subCategories->id }}"
                                                            @if(isset($_REQUEST['categories_id']) and !empty($_REQUEST['categories_id']))
                                                            @if( $subCategories->id == $_REQUEST['categories_id'])
                                                                selected
                                                            @endif
                                                            @endif
                                                    >{{ $subCategories->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control input-group-form " style="margin-left:20px;"name="product" placeholder="Search term..." id="parameter"  @if(isset($product)) value="{{$product}}" @endif />

                                        </div>

                                        <div id="section2" class="section" style="margin:0 20px;">

                                            <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="type">

                                            <option value="" selected disabled hidden>Choose Type</option>
                                                <option value="0" @if(isset($type)) @if  ($type == "0") {{ 'selected' }} @endif @endif>{{ trans('labels.Simple') }}</option>
                                                <option value="1" @if(isset($type)) @if  ($type == "1") {{ 'selected' }} @endif @endif>{{ trans('labels.Variable') }}</option>
                                                <option value="2" @if(isset($type)) @if  ($type == "2") {{ 'selected' }} @endif @endif>{{ trans('labels.External') }}</option>
                                                <option value="3" @if(isset($type)) @if  ($type == "3") {{ 'selected' }} @endif @endif>Combo</option>
                                                <option value="4" @if(isset($type)) @if  ($type == "4") {{ 'selected' }} @endif @endif>Buy X And Get X</option>
                                            </select>

                                        </div>

                                        <div id="section4" class="section" style="margin:0 20px;">

                                            <input type="text" class="form-control input-group-form " style="margin-left:20px;" name="product" placeholder="Search term..." id="parameter"  @if(isset($product)) value="{{$product}}" @endif />

                                        </div>

                                        <div id="section3" class="section">
                                            <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                            @if(isset($product) || isset($type) || isset($product))  <a class="btn btn-danger " href="{{url('admin/products/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                        </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <br><br><br>
                             <div class=" col-xs-3">
                                <a href="{{asset('images/product.xlsx')}}" type="button" class="btn btn-block btn-primary"><i class="fa fa-download"></i> {{ trans('labels.s_e_p') }}</a>
                            </div>
                            <div class=" col-xs-3">
                                <button href="" type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> {{ trans('labels.import_excel') }}</button>
                            </div>
                            <div class=" pull-right">
                                <a href="{{ URL::to('admin/products/add') }}" type="button" class="btn btn-primary">{{ trans('labels.AddNew') }}</a>
                                <a href="{{ URL::to('admin/products/category_list')}}" type="button" class="btn btn-primary">Sorting</a>
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

                            <div class="col-xs-8" style="margin: 0px 0px 20px 0;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div id="selectItem">Selected Items ( <span id="totalCount"></span> )</div>
                                        </div>
                                        <div class="col-md-2">
                                            <button  type="button" class="btn btn-danger" id="deleteProduct">Delete Product</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button  type="button" class="btn btn-warning" id="cloneProduct">Clone Product</button>
                                        </div>
                                        <span id="multistatus">
                                            <div class="col-md-2">
                                                <select class="form-control" id="product_status" name="product_status">
                                                    <option value="1">{{ trans('labels.Active') }}</option>
                                                    <option value="0">{{ trans('labels.Inactive') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button id="multiStatusBut" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                            <div class="row" id="DesignationTable">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" name="Main_Checkbox_Product" class="mb-3" id='checkall'/></th>
                                            <th>@sortablelink('products_id', trans('labels.ID') )</th>
                                            <th>{{ trans('labels.Image') }}</th>
                                            <th>@sortablelink('categories_name', trans('labels.Category') )</th>
                                            <th>@sortablelink('products_name', trans('labels.Name') )</th>
                                            <th>{{ trans('labels.Additional info') }}</th>
                                            <th>@sortablelink('created_at', trans('labels.ModifiedDate') )</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($results['products'])>0)
                                            @php  $resultsProduct = $results['products']->unique('products_id')->keyBy('products_id');  @endphp
                                            @foreach ($resultsProduct as  $key=>$product)
                                                <tr id="{{ $product->products_id }}">
                                                        <td><input type="checkbox" class='product_checkbox' name="product_id[]" value="{{ $product->products_id }}"/></td>
                                                    <td>{{ $product->products_id }}</td>
                                                    <td><img src="{{asset($product->path)}}" alt="" height="50px"></td>
                                                    <td>
                                                        {{ $product->categories_name }}
                                                    </td>
                                                    <td>
                                                        {{ $product->products_name }} @if(!empty($product->products_model)) ( {{ $product->products_model }} ) @endif
                                                    </td>
                                                   <!--  <td>
                                                        {{ $product->first_name }} {{ $product->last_name }}
                                                    </td> -->
                                                    <td>
                                                        <strong>{{ trans('labels.Product Type') }}:</strong>
                                                        @if($product->products_type==0)
                                                            {{ trans('labels.Simple') }}
                                                        @elseif($product->products_type==1)
                                                            {{ trans('labels.Variable') }}
                                                        @elseif($product->products_type==2)
                                                            {{ trans('labels.External') }}
                                                        @elseif($product->products_type==3)
                                                            Combo 
                                                        @elseif($product->products_type==4)
                                                            Buy X And Get X
                                                        @endif
                                                        <br>
                                                        @if(!empty($product->manufacturers_name))
                                                            <strong>{{ trans('labels.Manufacturer') }}:</strong> {{ $product->manufacturers_name }}<br>
                                                        @endif
                                                        <strong>{{ trans('labels.Price') }}: </strong>   
                                                        @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $product->products_price }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                                                        <br>
                                                        <strong>{{ trans('labels.Weight') }}: </strong>  {{ $product->products_weight }}{{ $product->products_weight_unit }}<br>
                                                        <strong>{{ trans('labels.Viewed') }}: </strong>  {{ $product->products_viewed }} <br>

                                                        @if(empty($product->flash_sale_id))
                                                            @if(empty($product->specials_id))
                                                                @if($product->is_feature == 1)

                                                                <strong class="badge bg-light-blue">Featured </strong><br>

                                                                @endif
                                                            @endif

                                                        @endif
                                                       
                                                        @if($product->products_status == 1)
                                                            <strong class="badge bg-light-blue">Active </strong><br>
                                                        @else
                                                            <strong class="badge bg-red">Inactive </strong><br>
                                                        @endif



                                                       
                                                        @if(!empty($product->flash_sale_id))
                                                            <strong class="badge bg-light-blue">Flash Sales @if($product->is_feature == 1) / Featured @endif </strong><br>
                                                            <strong>Flash Price: </strong>  {{ $product->flash_sale_products_price }}<br>

                                                            @if(($product->flash_sale_id) !== null)
                                                                @php  $mytime = Carbon\Carbon::now()  @endphp
                                                                <strong>{{ trans('labels.ExpiryDate') }}: </strong>

                                                                {{-- @if($product->expires_date > $mytime->toDateTimeString()) --}}
                                                                    {{  date('d-m-Y', $product->flash_sale_expires_date) }}
                                                                {{-- @else
                                                                    <strong class="badge bg-red">{{ trans('labels.Expired') }}</strong>
                                                                @endif --}}
                                                                <br>
                                                            @endif
                                                        @endif
                                                       
                                                        @if(!empty($product->specials_id))
                                                            @if($product->is_special == 'yes')
                                                                <strong class="badge bg-light-blue">
                                                                    {{ trans('labels.Special Product') }} 
                                                                </strong><br>
                                                                <strong>{{ trans('labels.SpecialPrice') }}: </strong>  {{ $product->specials_products_price }}<br>

                                                            @if(($product->specials_id) !== null)
                                                                @php  $mytime = Carbon\Carbon::now()  @endphp
                                                                <strong>{{ trans('labels.ExpiryDate') }}: </strong>

                                                                {{-- @if($product->expires_date > $mytime->toDateTimeString()) --}}
                                                                    {{  date('d-m-Y', $product->expires_date) }}
                                                                {{-- @else
                                                                    <strong class="badge bg-red">{{ trans('labels.Expired') }}</strong>
                                                                @endif --}}
                                                                <br>
                                                            @endif
                                                            @endif
                                                            @if($product->is_feature == 1) 
                                                                <strong class="badge bg-light-blue">
                                                                    Featured 
                                                                </strong><br>
                                                            @endif 
                                                            
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $product->productupdate }}
                                                    </td>

                                                    <td>

                                                      {!! Form::open(array('url' =>'/admin/products/edit/'. $product->products_id, 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                                        <input type="hidden" name="furl" value="{{ url()->full() }}"/>
                                                        <button  type="submit"  class="btn btn-primary" style="width: 100%; margin-bottom: 5px;" >{{ trans('labels.EditProduct') }}</button>
                                                    {!! Form::close() !!}


                                                      @if($product->products_type==1)
                                                          <a class="btn btn-info" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/attach/attribute/display')}}/{{ $product->products_id }}">{{ trans('labels.ProductAttributes') }}</a>

                                                          </br>
                                                      @endif
                                                      <a class="btn btn-warning" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/images/display/'. $product->products_id) }}">{{ trans('labels.ProductImages') }}</a>
                                                      </br>
                                                      <a class="btn btn-success" style="width: 100%;  margin-bottom: 5px;" href="{{url('admin/products/videos/display/'. $product->products_id) }}">{{ trans('labels.ProductVideos') }}</a>
                                                      </br>

                                                      <?php
                                                               
                                                        $pro_delete = DB::table('orders_products')->where('products_id', $product->products_id)->get();
                                                                                                                                                if(count($pro_delete) > 0)
                                                                                                                                                                {
                                                                                                                                                                }
                                                                                                                                                    else{
                                                                                                                                                    ?>


                                                      <a class="btn btn-danger" style="width: 100%;  margin-bottom: 5px;" id="deleteProductId" products_id="{{ $product->products_id }}">{{ trans('labels.DeleteProduct') }}</a>

                                                      <?php } ?>
                                                      </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                                <div class="col-xs-12" style="background: #eee;">


                                  @php
                                    if($results['products']->total()>0){
                                      $fromrecord = ($results['products']->currentpage()-1)*$results['products']->perpage()+1;
                                    }else{
                                      $fromrecord = 0;
                                    }
                                    if($results['products']->total() < $results['products']->currentpage()*$results['products']->perpage()){
                                      $torecord = $results['products']->total();
                                    }else{
                                      $torecord = $results['products']->currentpage()*$results['products']->perpage();
                                    }

                                  @endphp
                                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                                    <div>Showing {{$fromrecord}} to {{$torecord}}
                                        of  {{$results['products']->total()}} entries
                                    </div>
                                  </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    {!! $results['products']->appends(Request::except('page'))->links() !!}
                                </div>
                              </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- deleteProductModal -->
            <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteProductModalLabel">{{ trans('labels.DeleteProduct') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/products/delete', 'name'=>'deleteProduct', 'id'=>'deleteProducts', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('products_id',  '', array('class'=>'form-control', 'id'=>'products_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteThisProductDiloge') }}?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteProducts">{{ trans('labels.DeleteProduct') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import product excel</h4>
        </div>
        <div class="modal-body">
          
        {!! Form::open(array('url' =>'admin/products/import', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
          <div class="row">
                <div class="col-xs-6 col-md-3">
                </div>
                 <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="userfile" id="userfile"  placeholder="Upload the File..." required> </div>
                  </div>
                  <div class="col-xs-6 col-md-3">
                </div>
              
          </div>
           <div  style="float: right;">
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        </div>
      </div>
      
    </div>
</div>
            <!-- /.row -->

            <!-- Main row -->

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
        $(".section").removeClass("section-hide");
        $(".section").removeClass("section-show");
       
        if(val == 'type')
        {
           
            $("#section1").addClass("section-hide");
            $("#section2").addClass("section-show");
            $("#section3").addClass("section-show");
            $("#section4").addClass("section-hide");
        }
        else if(val == 'category')
        {
            $("#section1").addClass("section-show");
            $("#section2").addClass("section-hide");
            $("#section3").addClass("section-show");
            $("#section4").addClass("section-hide");
        }
        else if(val == 'product')
        {
            $("#section1").addClass("section-hide");
            $("#section2").addClass("section-hide");
            $("#section3").addClass("section-show");
            $("#section4").addClass("section-show");
        }
        else
        {
            $("#section1").addClass("section-hide");
            $("#section2").addClass("section-hide");
            $("#section3").addClass("section-hide");
            $("#section4").addClass("section-hide");
        }
        

    }
   
</script>



<script>

    $("#checkall").change(function() {
        var checked = $(this).is(":checked");
        if (checked) {
            $(".product_checkbox").each(function() {
                $(this).prop("checked", true);
            });
        } else {
            $(".product_checkbox").each(function() {
                $(this).prop("checked", false);
            });
        }
        var totalCount = $(".product_checkbox:checked").length;
        $("#totalCount").text(totalCount);
    });

    // Changing state of CheckAll checkbox
    $(".product_checkbox").click(function() {
            if ($(".product_checkbox").length == $(".product_checkbox:checked").length) {
            $("#checkall").prop("checked", true);
        } else {
            // $("#checkall").removeAttr("checked");
            $("#checkall").prop("checked", false);
        }
        var totalCount = $(".product_checkbox:checked").length;
        $("#totalCount").text(totalCount);
    });

    $("#DesignationTable").on("click", function() {
        $("#deleteProduct").toggle($(this).find(".product_checkbox:checked").length > 0);
        $("#multistatus").toggle($(this).find(".product_checkbox:checked").length > 0);
        $("#cloneProduct").toggle($(this).find(".product_checkbox:checked").length > 0);
        $("#selectItem").toggle($(this).find(".product_checkbox:checked").length > 0);
    })

    $('input[name="Main_Checkbox_Product"]').on("click", function() {
        $('.product_checkbox').prop('checked', this.checked);
    });
</script>

<script>
    $(document).ready(function(){

        $("#multiStatusBut").click(function(){
			if(confirm("Are you sure ? Do you want to change the status")) {

                var product_status  = $("#product_status" ).val();

				var product_id = [];
				$('.product_checkbox:checked').each(function(i){
					product_id[i] = $(this).val();
				});
				if(product_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/products/status_multiple')}}",
						type: 'POST',
                        data: 'product_id='+product_id+'&product_status='+product_status,
						success: function(){
							for(var i=0; i<product_id.length; i++){
						       $('tr#'+product_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       //$('tr#'+product_id[i]+'').fadeOut('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

		$("#deleteProduct").click(function(){
			if(confirm("Are you sure ? Do you want to delete the product")) {
				var product_id = [];
				$('.product_checkbox:checked').each(function(i){
					product_id[i] = $(this).val();
				});
				if(product_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/products/delete_multiple')}}",
						type: 'POST',
                        data: 'product_id='+product_id,
						success: function(){
							for(var i=0; i<product_id.length; i++){
						       $('tr#'+product_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       $('tr#'+product_id[i]+'').fadeOut('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

        $("#cloneProduct").click(function(){
			if(confirm("Are you sure ? Do you want to clone the product")) {
				var product_id = [];
				$('.product_checkbox:checked').each(function(i){
					product_id[i] = $(this).val();
				});
				if(product_id.length === 0) {
					alert ("please select atleast one");
				}
				else{
					$.ajax({
                        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                        url: "{{ URL::to('admin/products/clone_product')}}",
						type: 'POST',
                        data: 'product_id='+product_id,
						success: function(){
							for(var i=0; i<product_id.length; i++){
						       $('tr#'+product_id[i]+'').css({'background-color': '#f60000','color':'#fff'});
						       $('tr#'+product_id[i]+'').fadeOut('slow');
						    }
                            location.reload();
						}
					})
				}
			}
		});

	});
</script>

@endsection
