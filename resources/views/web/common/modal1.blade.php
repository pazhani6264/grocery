
<style>
/* 
.modal-5-pro-title-outer {
padding-bottom: 30px !important;
margin-bottom:30px;
height: 100px;
overflow-y: auto;
overflow-x: hidden;
} */
  .quick-view-height {
    max-height: 150px;
    min-height: 30px;
    overflow-y: auto !important;
    margin-bottom:10px;
  }

  .modal-content {
      position: relative;
      flex: 1 1 auto;
      padding: 2rem;
      height:100% !important;
    }

    @media only screen and (min-width: 320px) and (max-width: 600px){

    .modal-content {
position: relative;
flex: 1 1 auto;
padding: 2rem;
height: 100vh !important;
overflow-y: auto;
}
    }
  </style>
  <div class="row ">
  <div class="col-12 col-md-6">
    <div class="row ">
      <div id="quickViewCarousel" class="carousel slide" data-ride="carousel">
          <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">  
                
              @if($result['detail']['product_data'][0]->image_path_type == 'aws')
              <img class="img-fluid" src="{{$result['detail']['product_data'][0]->image_path }}" alt="image">
                        @else
                        <img class="img-fluid" src="{{asset('').$result['detail']['product_data'][0]->image_path }}" alt="image">
                        @endif       
                             
              
              </div>

              @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                @if($images->image_type == 'ACTUAL')

                <div class="carousel-item">  
                @if($images->image_path_type == 'aws')
                <img class="img-fluid" src="{{asset('').$images->image_path }}" alt="image">
                        @else
                        <img class="img-fluid" src="{{asset('').$images->image_path }}" alt="image">
                        @endif                  
                 
                </div>

                @endif
              @endforeach

            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="prev">
                <span class="fas fa-angle-left "></span>
            </a>
            <a class="carousel-control-next btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="next">
                <span class="fas fa-angle-right "></span>
            </a>
          
        </div>
    </div>

  </div>

    <div class="col-12 col-md-6">
   
      <div class="pro-description">
        <div class="badges">
          <?php 
               $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
              $decimal_places = count($currency) > 0 ? $currency[0] : 2;
              $current_date = date("Y-m-d", strtotime("now"));

              $string = substr($result['detail']['product_data'][0]->products_date_added, 0, strpos($result['detail']['product_data'][0]->products_date_added, ' '));
              $date=date_create($string);
              date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

              $after_date = date_format($date,"Y-m-d");

              if($after_date>=$current_date){
                print '<span class="badge badge-info">';
                print __('website.New');
                print '</span>';
              }
            ?>

          @if($result['detail']['product_data'][0]->is_feature == 1)
          <span class="badge badge-success">@lang('website.Featured')</span>     
          @endif
          
          <?php
          $discount_percentage = 0;
          if(!empty($result['detail']['product_data'][0]->discount_price)){
            $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
          }
          $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');

          if(!empty($result['detail']['product_data'][0]->discount_price)){

          if(($orignal_price+0)>0){
            $discounted_price = $orignal_price-$discount_price;
            $discount_percentage = $discounted_price/$orignal_price*100;
          }else{
            $discount_percentage = 0;
            $discounted_price = 0;
          }
          
          ?>             
          
          <?php }
          
          ?>
          @if($discount_percentage>0)
          <span class="badge badge-danger"><?php echo (int)$discount_percentage; ?>%</span>
          @endif
        </div>
          {{-- <h3 class="pro-title">{{$result['detail']['product_data'][0]->products_name}}</h3> --}}
          <h4>{{$result['detail']['product_data'][0]->products_name}}</h4>

          <div class="modal-5-pro-title-outer">
            @if($result['detail']['product_data'][0]->products_type == 3)
                  <?php
                        $comboPro = DB::table('product_combo')
                        ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_combo.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();
                      ?>
                      <div class="row">
                        @foreach($comboPro as $comboProd)
                          <div class="col-md-6">
                            <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                            @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                          </div>
                        @endforeach
                      </div><br>
                @endif

                @if($result['detail']['product_data'][0]->products_type == 4)
                <?php
                        $comboPro = DB::table('product_buy_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_buy_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                        $getX = DB::table('product_get_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_get_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                      ?>
                      <div class="row">
                        <div class="col-md-6">
                          <h5>Buy X :</h5>
                          @foreach($comboPro as $comboProd)
                            <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                            @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                          @endforeach
                        </div>
                        <div class="col-md-6">
                          <h5>Get X :</h5>
                          @foreach($getX as $comboProdgetX)
                            <small><b>Product Name :</b> {{$comboProdgetX->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProdgetX->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProdgetX->qty}}</small><br>
                            @if($comboProdgetX->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProdgetX->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProdgetX->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                          @endforeach
                        </div>
                      </div>
                @endif
        </div>
    
    <div class="pro-price">  

      <?php

      if(!empty($result['detail']['product_data'][0]->discount_price)){
        $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
      }
      if(!empty($result['detail']['product_data'][0]->flash_price)){
        $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
      }
      $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');
      
       if(!empty($result['detail']['product_data'][0]->discount_price)){

        if(($orignal_price+0)>0){
        $discounted_price = $orignal_price-$discount_price;
        $discount_percentage = $discounted_price/$orignal_price*100;
        $discounted_price = $result['detail']['product_data'][0]->discount_price;

       }else{
         $discount_percentage = 0;
         $discounted_price = 0;
       }
      }
      else{
        $discounted_price = $orignal_price;
      }
      ?>
      @if(!empty($result['detail']['product_data'][0]->flash_price))
      <ins class="get_att_amount"> {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}</ins>
      <del>{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</del>

      @elseif(!empty($result['detail']['product_data'][0]->discount_price))
      <ins class="get_att_amount" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}</ins>
      <del id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</del>

      @else
      <ins class="get_att_amount">{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</ins>
      @endif
      </h2>
                         
      </div>

    <div class="pro-infos">
        <div class="pro-single-info"><b>@lang('website.Product ID') :</b>{{$result['detail']['product_data'][0]->products_id}}</div>
       

          <div class="pro-single-info pro-catgory" style="display:-webkit-box !important"><b>@lang('website.Categroy')  :</b>
          @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
          <a style="line-height:24px" href="{{url('shop?category='.$category->categories_slug)}}">{{$category->categories_name}}</a>,&nbsp;&nbsp;
          @endforeach

          </div>   

       

        @if($result['detail']['product_data'][0]->products_type == 0)
          <div class="pro-single-info"><b>@lang('website.Available') :</b>
            @if($result['commonContent']['settings']['stock_availability'] == 1)
                <span class="text-secondary">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
            @else
              @if($result['detail']['product_data'][0]->defaultStock == 0)
                <span class="text-secondary">@lang('website.Out of Stock')</span>
              @else
                <span class="text-secondary">@lang('website.In stock')</span>
              @endif
            @endif
          </div>
        @endif
       

        @if($result['detail']['product_data'][0]->products_min_order>0)
              @if($result['detail']['product_data'][0]->products_type == 0)
            <div class="pro-single-info" id="min_max_setting"><b>@lang('website.Min Order Limit'): </b><a href="#">{{$result['detail']['product_data'][0]->products_min_order}}</a></div>
              @elseif($result['detail']['product_data'][0]->products_type == 1)
                <div class="pro-single-info" id="min_max_setting"></div>
              @endif
          @endif
    </div>

    <div class="popup-detail-info quick-view-height">
      <p>
      <?php 
        $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
        echo stripslashes($descriptions);
      ?>
      </p>
    </div>

    <form name="attributes" id="add-Product-form" method="post" >
      <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">
      <input type="hidden" name="special_discount" id="special_discount" value="no">
            <input type="hidden" name="special_price" id="special_price" value="">
            <input type="hidden" name="org_price" id="org_price" value="">



      <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

      <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

      <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >
       @if(!empty($result['cart']))
        <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
       @endif


    @if(count($result['detail']['product_data'][0]->attributes)>0)
    <?php
        $index = 0;
    ?>
      @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
      <?php
          $functionValue = 'function_'.$key++;
      ?>
      <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
      <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
      <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
      <input id="attributeid_<?=$index?>" type="hidden" value="">
      <input id="attribute_sign_<?=$index?>" type="hidden" value="">
      <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
      <div class="pro-options">
            <div class="box mb-3">
              <label>{{ $attributes_data['option']['name'] }}</label>
              <div class="select-control ">
              <select style="padding:0.375rem 1.375rem;" name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                @if(!empty($result['cart']))
                  @php
                   $value_ids = array();
                    foreach($result['cart'][0]->attributes as $values){
                        $value_ids[] = $values->options_values_id;
                    }
                  @endphp
                    @foreach($attributes_data['values'] as $values_data)
                     @if(!empty($result['cart']))
                     <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                     @endif
                    @endforeach
                  @else
                    @foreach($attributes_data['values'] as $values_data)
                     <option attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>                  
      </div>
      @endforeach
    @endif
  

  
    @if($result['commonContent']['setting'][226]->value == 2)
    <?php
      $res = $result['commonContent']['setting']['227']->value;
      $time = explode('-',$res);
      $startTime = strtotime($time[0]);
      $endTime = strtotime($time[1]);
      $currentTime = time();
    ?>
    @if($currentTime >= $startTime && $currentTime <= $endTime)
      <?php $ck = 0 ?>
    @else
      <?php $ck = 1; ?>
    @endif
  @else
    <?php $ck = 0; ?>
  @endif      

  @if($ck == 0)
    <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>

    @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

        <div class="input-group item-quantity">                    
            {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}

            @if($result['detail']['product_data'][0]->products_type == 3 || $result['detail']['product_data'][0]->products_type == 4)
            @if($result['commonContent']['settings']['Inventory'])
            @if($result['detail']['product_data'][0]->stock_status == 1)
            <?php

              $inventory_ref_id = '';
              $products_id = $result['detail']['product_data'][0]->products_id;
              $productsType = DB::table('products')->join('product_combo','product_combo.product_id','=','products.products_id')->where('product_combo.pro_id', $products_id)->get();

              $resattributes = array();
              foreach($productsType as $proCType){
                if($proCType->attractive_id !=0){
                  $resattributes[] = $proCType->attractive_id;
                }
              }


              // Normal Product stocks

              $norstocks = array();
              foreach($productsType as $proCType){
                if($proCType->products_type == 0) { 

                  $stocksin = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'in')->sum('stock');
                  $stockOut = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'out')->sum('stock');
                  $norstocks[] = $stocksin - $stockOut;

                }
              }
              $workArray = implode(",", $norstocks);
              $array = explode(',', $workArray);
              $NorStock = min($array);

              // Variable Product stocks

              $stocks = array();
              $VarStock = '';
              foreach($productsType as $proCType){
                $attrcount = DB::table('products_attributes')->where('products_id', $proCType->product_id)->get();
                $acount = count($attrcount);

                if ($proCType->products_type == 1 && $acount > 0) {

                  $attributes = array_filter($resattributes);
                  $attributeid = implode(',', $attributes);

                  $postAttributes = count($attributes);

                  $inventories = DB::table('inventory')->where('products_id', $proCType->product_id)->get();
                  $reference_ids = array();
                  
                  $stockIn = 0;
                  foreach ($inventories as $inventory) {

                      $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
                      $totalAttributes = count($totalAttribute);

                      if ($postAttributes > $totalAttributes) {
                          $count = $postAttributes;
                      } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                          $count = $totalAttributes;
                      }


                      $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
                          ->selectRaw('inventory.*')
                          ->whereIn('inventory_detail.attribute_id', [$attributeid])
                          ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
                          ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
                          ->groupBy('inventory_detail.inventory_ref_id')
                          ->get();

                      if (count($individualStock) > 0) {
                          $inventory_ref_id = $individualStock[0]->inventory_ref_id;
                          $stockIn += $individualStock[0]->stock;
                      }
                      
                  }

                  $options_names = array();
                  $options_values = array();
                  foreach ($resattributes as $attribute) {
                      $productsAttributes = DB::table('products_attributes')
                          ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                          ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                          ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                          ->where('products_attributes_id', $attribute)->get();

                      $options_names[] = $productsAttributes[0]->options_name;
                      $options_values[] = $productsAttributes[0]->options_values;
                  }

                  $options_names_count = count($options_names);
                  $options_names = implode("','", $options_names);
                  $options_names = "'" . $options_names . "'";
                  $options_values = "'" . implode("','", $options_values) . "'";
                  

                  //orders products
                  $orders_products = DB::table('orders_products')->where('products_id', $proCType->product_id)->get();
                  $stockOut = 0;
                  foreach ($orders_products as $orders_product) {
                      $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
                      $totalAttributes = count($totalAttribute);

                      if ($postAttributes > $totalAttributes) {
                          $count = $postAttributes;
                      } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
                          $count = $totalAttributes;
                      }

                      $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and `orders_products_attributes`.`orders_products_id`= '" . $orders_product->orders_products_id . "') = " . $count . " and `orders_products`.`orders_products_id` = '" . $orders_product->orders_products_id . "' group by `orders_products_attributes`.`orders_products_id`");

                      if (count($products) > 0) {
                          $stockOut += $products[0]->products_quantity;
                      }
                  }
                  $stocks[] = $stockIn - $stockOut;
                } 
              }

              $VarworkArray = implode(",", $stocks);
              $Vararray = explode(',', $VarworkArray);
              $VarStock = min($Vararray);


              if($NorStock >= $VarStock ){
                $totalStock = $VarStock;
              } else if($NorStock <= $VarStock){
                $totalStock = $NorStock;
              } else {
                $totalStock = 1;
              }
            ?>

          <input style="height:42px !important" type="text" readonly name="quantity" class="form-control qty" 
            value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
            
            min="@if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 
            
            max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $totalStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $totalStock}}@endif">  
            @else
            <input style="height:42px !important" type="text" readonly name="quantity" class="form-control qty" 
            value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
            
            min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">              
          @endif

          @else
            <input style="height:42px !important" type="text" readonly name="quantity" class="form-control qty" 
            value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
            
            min="{{$result['detail']['product_data'][0]->products_min_order}}" max="99999">              
          @endif
          @else
            <input style="height:42px !important" type="text" readonly name="quantity" class="form-control qty" 
            value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
            
            min="@if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 
            
            max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $result['detail']['product_data'][0]->defaultStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $result['detail']['product_data'][0]->defaultStock}}@endif">              
          @endif

            <span class="input-group-btn">
                <button type="button" class="quantity-plus1 btn qtyplus">
                    <i class="fas fa-plus"></i>
                </button>
            
                <button type="button" class="quantity-minus1 btn qtyminus">
                    <i class="fas fa-minus"></i>
                </button>
            </span>


          </div>

        @endif
        @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

          @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
            @else
              @if($result['detail']['product_data'][0]->products_type == 0)

                    @if($result['commonContent']['settings']['Inventory'])
                    @if($result['detail']['product_data'][0]->stock_status == 1)
                      @if($result['detail']['product_data'][0]->defaultStock <= 0)
                      <button class="btn btn-lg swipe-to-top  btn-danger " type="button">@lang('website.Out of Stock')</button>
                      @else
                          <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                  @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                  @endif
                  @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                  @endif
              @else
                    <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                    <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" hidden type="button">@lang('website.Out of Stock')</button>
              @endif
            @endif

            @if($result['detail']['product_data'][0]->products_type == 1)
              @if($result['detail']['product_data'][0]->stock_status == 1)
                <button class="btn btn-lg swipe-to-top  btn-danger " type="button">@lang('website.Out of Stock')</button>
                @else
                <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
              @endif
            @endif

            @if($result['detail']['product_data'][0]->products_type == 2)
            <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn-lg swipe-to-top">@lang('website.External Link')</a>
          @endif

          @if($result['detail']['product_data'][0]->products_type == 3)

          <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_combo')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))
                      <button class="btn btn-lg swipe-to-top  btn-danger " type="button">@lang('website.Out of Stock')</button>
                      @else
                          <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                      @else
                          <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                  @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                  @endif
              @else
                    <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                    <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" hidden type="button">@lang('website.Out of Stock')</button>
              @endif


              @if($result['detail']['product_data'][0]->products_type == 4)

          <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_buy_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))
                      <button class="btn btn-lg swipe-to-top  btn-danger " type="button">@lang('website.Out of Stock')</button>
                      @else
                          <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                      @else
                          <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                  @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                  @endif
              @else
                    <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                    <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" hidden type="button">@lang('website.Out of Stock')</button>
              @endif

          @endif

          @if($result['detail']['product_data'][0]->button_type == 2)
          <button type="button" class="btn btn-secondary btn-lg swipe-to-top modal_show3" products_id="{{$result['detail']['product_data'][0]->products_id}}"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
        @endif
        @if($result['detail']['product_data'][0]->button_type == 4)
          <a class="btn btn-secondary btn-lg swipe-to-top cart-button-width" href="{{ URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}" ><span> @lang('website.View Detail')</span></a>
        @endif
  
    </div>
@endif
    
  </form>

  
    
    </div>     

  </div>

</div>


<script>
@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
  getQuantity();
  cartPrice();
@endif

//reju check
jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
  function {{ $functionValue }}(){
      var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
      jQuery("#{{ $functionValue }}").val(value_price);
    }
    //change_options
  jQuery(document).on('change', '.{{ $functionValue }}', function(e){

        var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

        var old_sign = jQuery("#{{ $attribute_sign }}").val();

        var value_price = jQuery('option:selected', this).attr('value_price');
        var prefix = jQuery('option:selected', this).attr('prefix');
        var current_price = jQuery('#products_price').val();
        var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

        if(old_sign.trim()=='+'){
          var current_price = current_price - {{ $functionValue }};
        }

        if(old_sign.trim()=='-'){
          var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
        }

        if(prefix.trim() == '+' ){
          var total_price = parseFloat(current_price) + parseFloat(value_price);
        }
        if(prefix.trim() == '-' ){
          total_price = current_price - value_price;
        }

        jQuery("#{{ $functionValue }}").val(value_price);
        jQuery('#products_price').val(total_price);
        var qty = jQuery('.qty').val();
        var products_price = jQuery('#products_price').val();
        var total_price = qty * products_price * <?=session('currency_value')?>;//pro-price
        //jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        //alert(total_price);
        
  });
  @endforeach
  getQuantity();
  //calculateAttributePrice();
  function calculateAttributePrice(){
    var products_price = jQuery('#products_price').val();
    jQuery(".currentstock").each(function() {
      var value_price  = jQuery('option:selected', this).attr('value_price');
      var prefix = jQuery('option:selected', this).attr('prefix');

      if(prefix.trim()=='+'){
        products_price = products_price - value_price;
      }

      if(prefix.trim()=='-'){
        products_price = products_price - value_price;
      }

    });
    jQuery('#products_price').val(products_price);
    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+products_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
  }

  @endif

});
</script>
