
<!-- start-->
<!-- start-->
<!-- start-->

<style>
  .btn-outline-primary-2s:hover{
    color:#fff !important;
    background-color: #fdda05 !important;
  }
    .common-hovers:hover{
    color: #fdda05 !important;
    fill: #fdda05 !important;
  }
  .common-texts{
    color: #fdda05 !important;
    border-color:#fdda05 !important;
  }
  nav[aria-label=breadcrumb] .breadcrumb .active::before {
    content: "" !important;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    margin-top: 2px;
}
@media only screen and (max-width: 768px) {
.cart-page-one .top-table thead {
    display: none;
  }

  .cart-page-one .top-table tbody tr {
    display: flex;
    flex-direction: column;
  }

  .cart-page-one .top-table tbody tr td {
    display: flex;
    flex-direction: column;
    text-align: center;
  }

  .cart-page-one .top-table tbody tr td .item-detail {
    text-align: center;
  }

  .cart-page-one .top-table tbody tr td .item-quantity {
    margin: 0 auto;
  }

  .cart-page-one .top-table tbody tr td .item-control {
    text-align: center !important;
  }

  .cart-page-one .align-right {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .cart-page-one .align-right .row {
    justify-content: center;
  }

  .cart-page-one .align-right .btn {
    margin-bottom: 15px;
  }

  .cart-page-one .align-right2 {
    margin-top: 15px;
  }

  .cart-page-one .bottom-table {
    margin-bottom: 30px;
  }

  .cart-page-one .m-btn {
    margin-bottom: 15px;
  }

  .cart-page-one .click-btn .input-group {
    margin-bottom: 15px;
  }

  .cart-page-one .item .item-thumb {
    width: 100px;
    height: 100px;
  }

  .cart-page-one .item .item-detail {
    width: calc(100% - 115px);
  }

  .cart-page-one .align-right2 .btn:first-child {
    margin-right: 0px;
    margin-left: 0px;
    margin-bottom: 0px;
  }

  .cart-area .bottom-table {
    display: block;
  }
}
</style>
<style> 

.breadcrumb-item{
  font-size:1rem;
  font-weight:300 !important;
}
.mb-4s{
  margin-bottom:3rem;
}
.page-heading-title {
    margin-top: -7px;
    padding-bottom: 0px;
}
.cart-page-one .top-table tbody tr {
    background-color: #fff;
    align-items: center;
    border: 0px solid #dee2e6;
    margin-bottom: 0px;
}
.table tbody + tbody {
    border-bottom: 0.1rem solid #dee2e6;
}
.table tbody + tbody {
    border-top: 0px solid #dee2e6;
}
.cart-page-one .top-table tbody tr td {
    padding: 10px  !important;
}
.table th {
    font-weight: 400;
    font-size: 1rem;
    line-height: 1.5;
    color: #999;
}
 .table th {
    border-top: none;
    border-bottom: 0.1rem solid #ebebeb;
}
tr .img-fluid{
  width:100px;
  height:100px;
}
.cart-page-one .top-table tbody tr td .item-detail h4{
  font-size:1.15rem !important;
  font-weight:400 !important;
}
.cart-page-one .top-table tbody tr td {
    display: flex;
    justify-content: left;
    align-items: center;
    border: none;
}
.item-quantity .input-group-btn button {
    display: block;
    height: 42px;
    padding: 0 10px;
    font-size: 10px;
    border: 0px solid #dee2e6;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #fff;
    opacity: 1;
}
.table .form-control {
  border:0px solid;
}
.item-quantity {
    width: 100px;
    height: 44px;
    border: 1px solid #dee2e6;
}

.cartnew .col-lg-8 {
    flex: 0 0 70%;
    max-width: 70%;
}
.cartnew .col-lg-4 {
    flex: 0 0 30%;
    max-width: 30%;
}
.cartnew  .btn-light {
    color: #212529;
    background-color: #fff;
    border-color: #e9ecef;
}
.cartnew  .btn-light:hover {
background-color: #fafafa;
    border-color: #ebebeb;
}

.btn-light{
  margin-bottom:4rem;
}

.mmbut{
position: absolute;
    top: 0;
    left: 0px;
}

@media screen and (max-width:992px){
  .pro-content {
    padding-top: 0px !important;
}
.cartnew .col-lg-8 {
    flex: 0 0 100%;
    max-width: 100%;
}
.cartnew .col-lg-4 {
    flex: 0 0 100%;
    max-width: 100%;
}

.mobile-display-none{
  display:none !important;
}

.cart-page-one .align-right {
    display: flex;
    justify-content: center;
    align-items: baseline;
    flex-direction: column;
}
.btn-light{
  margin-bottom:4rem;
}
tr .img-fluid {
    width: 150px;
    height: 150px;
    object-fit:contain;
}

.mobarrow{
  position: absolute;
  right:-40%;
}
.table tbody + tbody {
    border: 0.1rem solid #dee2e6;
}


}

@media screen and (min-width:700px) and (max-width:800px){

.cartnew .col-lg-7{
  flex: 0 0 50%;
    max-width: 50%;
}
}
</style>

<section class="pro-content" style="padding-top:0px">
  <div class="container-fuild text-center" style="background-image:url('{{asset('page-header-bg.jpeg')}}');padding:60px 0">
    <div class="page-heading-title">
        <h2 style="text-transform:initial;margin-bottom:10px !important;font-size:40px;font-weight:400">@lang('website.Shopping cart')</h2>    
        <h5 style="font-size:20px;font-weight:400" class="common-text">Shop</h5>       
    </div>
  </div>

  <div class="container-fuild mb-4s">
  <nav aria-label="breadcrumb" style="background:#fff;border-bottom:.1rem solid #ebebeb">
    <?php 
        $headerID = DB::table('current_theme')->first();
        if($headerID->header == 23 || $headerID->header == 44 || $headerID->header == 28 || $headerID->header == 47 || $headerID->header == 32 || $headerID->header == 33 || $headerID->header == 35 || $headerID->header == 36 || $headerID->header == 37 || $headerID->header == 38 || $headerID->header == 39) {
      ?>
      <div class="container-fluid">
      <?php } else { ?>
        <div class="container">
      <?php } ?>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="font-size:1rem;font-weight:300" href="{{ URL::to('/')}}">@lang('website.Home')</a></li><i style="margin: 9px 10px 5px 10px;color:#777;" class="fa fa-angle-right"></i>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Shopping cart')</li>
          </ol>
      </div>
    </nav>
</div>

<section class="cartnew cart-content">

    <?php 
      $headerID = DB::table('current_theme')->first();
      if($headerID->header == 23 || $headerID->header == 44 || $headerID->header == 28 || $headerID->header == 47 || $headerID->header == 32 || $headerID->header == 33 || $headerID->header == 35 || $headerID->header == 36 || $headerID->header == 37 || $headerID->header == 38 || $headerID->header == 39) {
    ?>
     <div class="container-fluid">
    <?php } else { ?>
      <div class="container">
    <?php } ?>

      <div class="row">

      <div class="col-12 col-sm-12 cart-area cart-page-one">
      


        <div class="row">

          <div class="col-12 col-lg-8">
            <form method='POST' id="update_cart_form" action='{{ URL::to('/updateCart')}}' >
           

            @if(session()->has('message'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           </div>
       @endif
       @if($result['commonContent']['settings']['Inventory'])
          @if(session::get('out_of_stock') == 1)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @lang('website.Cart out stock') 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          @endif
        @endif
        @if(session::get('min_order') == 1)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @lang('website.Cart min order') {{ session::get('min_order_value') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        @endif

        @if(session::get('max_order') == 1)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @lang('website.Cart max order')   {{ session::get('max_order_value') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        @endif

        @if(session::get('min_order_price') == 1)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @lang('website.Min order Price')   {{ session::get('min_order_price_value') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        @endif

        @if(session::get('coupon_usage_per_user_limit') == 1)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @lang('website.Coupon Removed')
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        @endif
        
            <table class="table top-table">
              <tr class="d-flex mobile-display-none">
                <th class="col-12 col-lg-6">Product</th>
                <th class="col-12 col-lg-2">Price</th>
                <th class="col-12 col-lg-2">Quantity</th>
                <th class="col-12 col-lg-1">Total</th>
                <th style="color:#fff" class="col-12 col-lg-1">close</th>
              </tr>
              <?php
                $price = 0;
               ?>
              @foreach( $result['cart'] as $products)
              <?php
              $price+= $products->final_price * $products->customers_basket_quantity;
              ?>
              @if($result['commonContent']['settings']['Inventory'])
              <tbody  @if(session::get('out_of_stock') == 1 and session::get('out_of_stock_product') == $products->products_id )style="	box-shadow: 0 20px 50px rgba(0,0,0,.5); border:2px solid #FF9999;"@elseif(session::get('min_order') == 1 and session::get('min_order_product') == $products->products_id)style="	box-shadow: 0 20px 50px rgba(0,0,0,.5); border:2px solid #FF9999;"@elseif(session::get('max_order') == 1 and session::get('max_order_product') == $products->products_id)style="	box-shadow: 0 20px 50px rgba(0,0,0,.5); border:2px solid #FF9999;"@endif>
              @else
              <tbody  @if(session::get('min_order') == 1 and session::get('min_order_product') == $products->products_id)style="	box-shadow: 0 20px 50px rgba(0,0,0,.5); border:2px solid #FF9999;"@elseif(session::get('max_order') == 1 and session::get('max_order_product') == $products->products_id)style="	box-shadow: 0 20px 50px rgba(0,0,0,.5); border:2px solid #FF9999;"@endif>
              @endif
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">

                  <tr class="d-flex">
                 
                    <td class="col-12 col-lg-6" style="text-align:left">
                      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" style="margin-right:20px;" class="cart-thumb">
                      @if($products->image_path_type == 'aws')
                        <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}"/>
                        @else
                        <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}"/>
                        @endif
                        </a>
                 
                        <div class="item-detail" style="text-align:left;">
                       
                            <h4 ><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
                            </h4>
                            <div class="item-attributes">
                            @if(isset($products->attributes))
                              <?php
                                  $uniqueOptions = [];


                                foreach($products->attributes as $attributes){

                                    $options = $attributes->attribute_name;
                                    $values = $attributes->attribute_value;

                                    if (!isset($uniqueOptions[$options])) {
                                      $uniqueOptions[$options] = [];
                                    }

                                    $uniqueOptions[$options][] = $values;

                                }

                                  ?>

                                @foreach($uniqueOptions as $option => $values)
                                <small style="text-align:left"><b>{{ $option }} :</b> ({{ implode(', ', $values) }})</small><br>
                                @endforeach
                              @endif
                            </div>

                            <div class="item-controls">
                                <!-- <a href="{{ url('/editcart/'.$products->customers_basket_id.'/'.$products->products_slug)}}"  class="btn" >
                                  <span class="fas fa-pencil-alt"></span>
                                </a>

                                <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"  class="btn" >
                                  <span class="fas fa-times"></span>
                              </a> -->
                            </div>                          
                          </div>                        

                      </td>
                      <?php
                      if(!empty($products->discount_price)){
                          $discount_price = $products->discount_price * session('currency_value');
                      }
                      if(!empty($products->final_price)){
                        $flash_price = $products->final_price * session('currency_value');
                      }
                      $orignal_price = $products->price * session('currency_value');


                       if(!empty($products->discount_price)){

                        if(($orignal_price+0)>0){
                          $discounted_price = $orignal_price-$discount_price;
                          $discount_percentage = $discounted_price/$orignal_price*100;
                       }else{
                         $discount_percentage = 0;
                         $discounted_price = 0;
                     }
                   }
                   ?>
                  <td class="col-12 col-lg-2"  style="font-size:1.15rem;font-weight:400">
                    @if(!empty($products->final_price))
                    {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}
                    @elseif(!empty($products->discount_price))
                    {{Session::get('symbol_left')}} {{$discount_price+0}} {{Session::get('symbol_right')}}
                    <span> {{Session::get('symbol_left')}} {{$orignal_price+0}} {{Session::get('symbol_right')}}</span>
                    @else
                    {{Session::get('symbol_left')}} {{$orignal_price+0}} {{Session::get('symbol_right')}}
                    @endif

                   </td>
                    <td class="col-12 col-lg-2 Qty">                          
                        <div class="input-group item-quantity">  
                          
                          <?php

                            $inventory_ref_id = '';
                            $products_id = $products->products_id;
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

                    
                            <?php if($products->max_order == 0) { ?>
                              <input style="margin-left:25px;" name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="form-control qty" min="{{$products->min_order}}" max="9999999999">

                              <?php } else if($products->products_type == 3 || $products->products_type == 4) { ?>

                                <input style="margin-left:25px;" name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="form-control qty" min="{{$products->min_order}}" max="{{$totalStock}}">

                              <?php } else { ?>
                            <input style="margin-left:25px;" name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="form-control qty" min="{{$products->min_order}}" max="{{$products->max_order}}">

                            <?php }?>


                            <span class="input-group-btn ">
                                <button type="button" value="quantity" class="quantity-right-plus btn qtypluscart" data-type="plus" data-field="">                                  
                                    <span class="fas fa-plus" style="color:#646464cc"></span>
                                </button>
                                <button type="button" value="quantity" class="quantity-left-minus btn qtyminuscart mmbut" data-type="minus" data-field="">
                                    <span class="fas fa-minus" style="color:#646464cc"></span>
                                </button> 
                            </span> 
                        </div>
                    </td>
                    <td class="item-price col-12 col-lg-1" align="center">

                    <?php 
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->header == 37) {
                    ?>
                      <span style="font-size:1.15rem;font-weight:400" class="cart_price_{{$products->customers_basket_id}} common-texts">
                        {{Session::get('symbol_left')}} {{$products->final_price * $products->customers_basket_quantity * session('currency_value')}} {{Session::get('symbol_right')}}
                        </span>
                    <?php } else { ?>
                      <span style="font-size:1.15rem;font-weight:400" class="cart_price_{{$products->customers_basket_id}}">
                        {{Session::get('symbol_left')}} {{$products->final_price * $products->customers_basket_quantity * session('currency_value')}} {{Session::get('symbol_right')}}
                        </span>
                    <?php } ?>
                    </td>
                    <td class="col-12 col-lg-1 mobarrow">
                  <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"  class="btn" >
                                  <span class="fas fa-times" id="cartDelete"></span>
                              </a> 
                  </td>
                  </tr>

                  <tr class="p24-product-subtitle-mb">
                    <th colspan="2">
                      @if($products->products_type == 3)
                        <div class="item-attributes">
                          <?php
                            $comboPro = DB::table('product_combo')
                            ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                            ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                            ->where('products_description.language_id', Session::get('language_id'))
                            ->where('categories_description.language_id', Session::get('language_id'))
                            ->where('product_combo.pro_id', $products->products_id)
                            ->get();
                          ?>
                            @foreach($comboPro as $comboProd)
                              <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                              <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                              <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                            @endforeach
                        </div>
                      @endif
                      @if($products->products_type == 4)
                        <div class="item-attributes">
                          <?php
                            $comboPro = DB::table('product_buy_x')
                            ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                            ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                            ->where('products_description.language_id', Session::get('language_id'))
                            ->where('categories_description.language_id', Session::get('language_id'))
                            ->where('product_buy_x.pro_id', $products->products_id)
                            ->get();

                            $getX = DB::table('product_get_x')
                            ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                            ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                            ->where('products_description.language_id', Session::get('language_id'))
                            ->where('categories_description.language_id', Session::get('language_id'))
                            ->where('product_get_x.pro_id', $products->products_id)
                            ->get();

                          ?>
                          <h5>Buy X :</h5>
                            @foreach($comboPro as $comboProd)
                              <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                              <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                              <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                            @endforeach

                            <br><h5>Get X :</h5>
                            @foreach($getX as $comboProdgetX)
                              <small><b>Product Name :</b> {{$comboProdgetX->products_name}}</small><br>
                              <small><b>Category Name :</b> {{$comboProdgetX->categories_name}}</small><br>
                              <small><b>Qty :</b> {{$comboProdgetX->qty}}</small><br>
                            @endforeach
                        </div>
                      @endif
                    </th>
                  </tr>

              </tbody>
              @endforeach
            </table>
          </form>
            @if(!empty(session('coupon')))
              <div class="form-group">
                    @foreach(session('coupon') as $coupons_show)

                        <div class="alert alert-success">
                            <a href="{{ URL::to('/removeCoupon/'.$coupons_show->coupans_id)}}" class="close"><span aria-hidden="true">&times;</span></a>
                          @lang('website.Coupon Applied') {{$coupons_show->code}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                        </div>

                    @endforeach
                </div>
            @endif
            @if(!empty(session('transaction_id')) && $result['commonContent']['settings']['voucher_redeem']=='1')
              <div class="form-group">
                <div class="alert alert-success">
                  <a href="{{ URL::to('/removeLoyalty/'.session('transaction_id'))}}" class="close"><span aria-hidden="true">&times;</span></a>
                  @lang('website.Redeem has been applied successfully') {{session('points_discount')}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                </div>
              </div>
            @elseif(!empty(session('transaction_id'))) 
              <div class="form-group">
                <div class="alert alert-success">
                <a href="{{ URL::to('/removeactivateredeem/'.session('transaction_id'))}}" class="close"><span aria-hidden="true">&times;</span></a>
                  @lang('website.Redeem has been applied successfully') {{session('points_discount')}}.@lang('website.If you do note want to apply this coupon just click cross button of this alert.')
                </div>
              </div>
            @endif
            <div class="col-12 col-lg-12 mb-4" style="margin-top:20px">
              <div class="row justify-content-between click-btn">
              @if($result['commonContent']['settings']['Loyalty']=='1')
                <div class="col-12 col-lg-5">
                  <form id="apply_coupon" class="form-validate">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="coupon_code" class="form-control" id="coupon_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="coupon-code" style="height:100%;background:#fafafa;margin-right:10px">

                            <?php 
                              $loginID = DB::table('current_theme')->first();
                              if($loginID->header == 37) {
                            ?>
                              <div class="">
                                <button class="btn btn-outline-primary-2s swipe-to-top common-texts" type="submit" id="coupon-code" style="height:100%;padding: 0.6rem 1rem"><i class="fa fa-arrow-right"></i></button>
                              </div>
                            <?php } else { ?>
                              <div class="">
                                <button class="btn btn-outline-primary-2 swipe-to-top" type="submit" id="coupon-code" style="height:100%;padding: 0.6rem 1rem"><i class="fa fa-arrow-right"></i></button>
                              </div>
                            <?php } ?>
                        </div>
                        <div id="coupon_error" class="help-block" style="display: none;color:red;"></div>
                        <div  id="coupon_require_error" class="help-block" style="display: none;color:red;">@lang('website.Please enter a valid coupon code')</div>
                    </div>
                 </form>
                </div>
                @endif
                <div class="col-12 col-lg-7 align-right">
                  <div class="row">
                    <?php 
                         $loginID = DB::table('current_theme')->first();
                         if($loginID->header == 37) {
                      ?>
                      <button class="btn btn-light common-hovers" id="update_cart">@lang('website.Update Cart') 
                        <svg class="ml-10e" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 42.597 42.619" style="margin-left:10px">
                        <path id="Union_120" data-name="Union 120" d="M12.74,40.977A20.877,20.877,0,0,1,0,22.721H2.871A18.015,18.015,0,0,0,33.908,34.159l1.611-1.69h-6.95V29.606l9.591,0,.926,0a1.434,1.434,0,0,1,1.433,1.433V41.6H37.652V34.4l-1.721,1.792a20.882,20.882,0,0,1-6.736,4.7,20.911,20.911,0,0,1-16.456.089ZM41.749,20.72H38.88A18.017,18.017,0,0,0,7.841,9.282l-1.613,1.69h7.027v2.863H3.065l-.4,0A1.433,1.433,0,0,1,1.231,12.4V1.668H4.1l0,7.376L5.819,7.252a20.912,20.912,0,0,1,6.734-4.7,20.884,20.884,0,0,1,29.2,18.167h0Zm.846-1.8a21.822,21.822,0,0,0-4.01-10.085A21.678,21.678,0,0,1,42.6,18.916ZM23.679,0A21.629,21.629,0,0,1,33.764,4.01,21.826,21.826,0,0,0,23.679,0Z"/></svg>
                      </button>
                  <?php } else { ?>
                    <button class="btn btn-light common-hover" id="update_cart">@lang('website.Update Cart') 
                      <svg class="ml-10e" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 42.597 42.619" style="margin-left:10px">
                        <path id="Union_120" data-name="Union 120" d="M12.74,40.977A20.877,20.877,0,0,1,0,22.721H2.871A18.015,18.015,0,0,0,33.908,34.159l1.611-1.69h-6.95V29.606l9.591,0,.926,0a1.434,1.434,0,0,1,1.433,1.433V41.6H37.652V34.4l-1.721,1.792a20.882,20.882,0,0,1-6.736,4.7,20.911,20.911,0,0,1-16.456.089ZM41.749,20.72H38.88A18.017,18.017,0,0,0,7.841,9.282l-1.613,1.69h7.027v2.863H3.065l-.4,0A1.433,1.433,0,0,1,1.231,12.4V1.668H4.1l0,7.376L5.819,7.252a20.912,20.912,0,0,1,6.734-4.7,20.884,20.884,0,0,1,29.2,18.167h0Zm.846-1.8a21.822,21.822,0,0,0-4.01-10.085A21.678,21.678,0,0,1,42.6,18.916ZM23.679,0A21.629,21.629,0,0,1,33.764,4.01,21.826,21.826,0,0,0,23.679,0Z"/></svg>
                      </button>
                  <?php } ?>
                 
                  </div>
               
                </div>
               
              </div>
            </div>
            
            <?php
            $customer = auth()->guard('customer')->user();
          if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>
          @if($result['commonContent']['settings']['Loyalty']=='1')
            <a href="javascript:;" data-toggle="modal" data-target="#myModalcoupon" class="btn btn-secondary swipe-to-top mar-bottom-mobile mb-4">Available Coupon</a>
             @endif
            <?php } ?>

          </div>

          <style>
            .cart-right-main{
              padding: 2rem 2rem 2.5rem;
              border: 0.1rem dashed #d7d7d7;
              background-color: #f9f9f9;
            }
            .cart-right-title {
    font-weight: 300 !important;
    font-size: 1rem;
    letter-spacing: 0;
    padding-bottom: 1.5rem;
    border-bottom: 0.1rem solid #ccc;
    margin-bottom: 1rem;
}
.cart-right-item{
  display:inline-block;
  width:49%;
  font-size: 1rem;
}
.cart-right-table{
  padding:15px 0px;
  border-bottom: 0.1rem solid #ccc;
}

.ml-10e{
  margin-left:10px;
}
          </style>
          <div class="col-12 col-lg-4">
            <div class="cart-right-main">
                <div style="font-size: 1.15rem;font-weight:500 !important" class="cart-right-title">Cart Total</div>
                <div class="cart-right-table">
                  <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item">@lang('website.SubTotal'):</div>
                  <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item text-right">
                   @php
                     

                     if(!empty(session('coupon_discount'))){
                       $coupon_amount = session('currency_value') * session('coupon_discount');  
                     }else{
                       $coupon_amount = 0;
                     }
 
                     if(!empty(session('points_discount'))){
                         $points_amount = session('currency_value') * session('points_discount');
                     }else{
                         $points_amount =0;
                     }
 
                     @endphp
                    
 
                     {{Session::get('symbol_left')}}{{session('currency_value') * $price+0}}{{Session::get('symbol_right')}}
                  </div>
                  </div>
                  @if($result['commonContent']['settings']['Loyalty']=='1')
                  <div class="cart-right-table">
                    <div class="cart-right-item">@lang('website.Discount(Promo Code)')</div>
                    <div class="cart-right-item text-right">
                    {{Session::get('symbol_left')}}{{number_format((float)$coupon_amount, 2, '.', '')+0}}{{Session::get('symbol_right')}}
                    </div>
                  </div>
                  <div class="cart-right-table">
                    <div class="cart-right-item">@lang('website.Discount(Voucher)')</div>
                    <div class="cart-right-item text-right">{{Session::get('symbol_left')}}{{number_format((float)$points_amount, 2, '.', '')+0}}{{Session::get('symbol_right')}}</div>
                  </div>
                @endif
                <div class="cart-right-table" style="border:none;">
                  <?php 
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->header == 37) {
                  ?>
                    <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item common-texts">@lang('website.Total')</div>
                    <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item text-right common-texts">{{Session::get('symbol_left')}}{{session('currency_value') * $price+0-number_format((float)$coupon_amount, 2, '.', '')-number_format((float)$points_amount, 2, '.', '')}}{{Session::get('symbol_right')}}</div>
                  </div>
                <?php } else { ?>
                    <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item common-text">@lang('website.Total')</div>
                    <div style="font-size: 1.15rem;font-weight:400 !important" class="cart-right-item text-right common-text">{{Session::get('symbol_left')}}{{session('currency_value') * $price+0-number_format((float)$coupon_amount, 2, '.', '')-number_format((float)$points_amount, 2, '.', '')}}{{Session::get('symbol_right')}}</div>
                  </div>
                <?php } ?>


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
                <?php 
                    $loginID = DB::table('current_theme')->first();
                    if($loginID->header == 37) {
                ?>
                  <?php if(auth()->guard('customer')->check()){ $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first(); if($user->email != '') { ?>

              
                  <?php if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>


                  <?php 
                    $user = DB::table('user_to_address')->where('user_id', auth()->guard('customer')->user()->id)->first(); 
                    if($user){
                  ?>
                    <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/checkout')}}" class="btn  btn-outline-primary-2s m-btn col-12 swipe-to-top common-texts">@lang('website.proceedToCheckout')</a>
                  <?php } else { 
                    $ship_flag = DB::table('user_redirect_flag')->where('user_id', auth()->guard('customer')->user()->id)->where('status', 1)->where('flag_name', 'Shipping_flag')->first(); 

                    if($ship_flag == '')
                    {
                      DB::table('user_redirect_flag')->insert([
                        'flag_name' => 'Shipping_flag',
                        'user_id' => auth()->guard('customer')->user()->id,
                        'status' => 1,
                    ]);
                  }
                    ?>
                    <a href="#" style="font-size:1rem;margin-top:10px" onclick="pop()" class="btn  btn-outline-primary-2s m-btn col-12 swipe-to-top common-texts">@lang('website.proceedToCheckout')</a>
                  <?php } ?>

                  <?php }else{  session(['login_flag'=>1]); ?>
                  <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/login_nine')}}" class="btn  btn-outline-primary-2s m-btn col-12 swipe-to-top common-texts">@lang('website.proceedToCheckout')</a>
                  <?php } ?>
                  <?php } else {?>
                    <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/noEmailCheckout')}}" class="btn  btn-outline-primary-2s m-btn col-12 swipe-to-top common-texts">@lang('website.proceedToCheckout')</a>
                    <?php }?>   
                  <?php } else {  session(['login_flag'=>1]); ?>
                  <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/login_nine')}}" class="btn  btn-outline-primary-2s m-btn col-12 swipe-to-top common-texts">@lang('website.proceedToCheckout')</a>
                  <?php } ?>

                  <?php } else { ?>

                    <?php if(auth()->guard('customer')->check()){ $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first(); if($user->email != '') { ?>
                          <?php if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>

                            <?php 
                              $user = DB::table('user_to_address')->where('user_id', auth()->guard('customer')->user()->id)->first(); 
                              if($user){
                            ?>
                              <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/checkout')}}" class="btn  btn-outline-primary-2 m-btn col-12 swipe-to-top">@lang('website.proceedToCheckout')</a>
                            <?php } else { ?>
                              <a href="#" style="font-size:1rem;margin-top:10px;" onclick="pop()" class="btn  btn-outline-primary-2 m-btn col-12 swipe-to-top">@lang('website.proceedToCheckout')</a>
                            <?php } ?>

                            <?php }else{ session(['login_flag'=>1]); ?>
                          <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/login_nine')}}" class="btn  btn-outline-primary-2 m-btn col-12 swipe-to-top">@lang('website.proceedToCheckout')</a>
                          <?php } ?>
                          <?php } else {?>
                            <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/noEmailCheckout')}}" class="btn  btn-outline-primary-2 m-btn col-12 swipe-to-top">@lang('website.proceedToCheckout')</a>
                            <?php }?>   
                          <?php } else {  session(['login_flag'=>1]); ?>
                          <a style="font-size:1rem;margin-top:10px" href="{{ URL::to('/login_nine')}}" class="btn  btn-outline-primary-2 m-btn col-12 swipe-to-top">@lang('website.proceedToCheckout')</a>
                          <?php } ?>
                <?php } ?>
              @endif
              
                </div>
                <?php 
                    $loginID = DB::table('current_theme')->first();
                    if($loginID->header == 37) {
                ?>
                <a style="width:100%;margin-top:20px;font-size:1rem" href="{{ URL::to('/shop')}}" class="btn btn-light common-hovers">@lang('website.Back To Shopping') <svg class="ml-10e" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 42.597 42.619" style="margin-left:10px">
                    <path id="Union_120" data-name="Union 120" d="M12.74,40.977A20.877,20.877,0,0,1,0,22.721H2.871A18.015,18.015,0,0,0,33.908,34.159l1.611-1.69h-6.95V29.606l9.591,0,.926,0a1.434,1.434,0,0,1,1.433,1.433V41.6H37.652V34.4l-1.721,1.792a20.882,20.882,0,0,1-6.736,4.7,20.911,20.911,0,0,1-16.456.089ZM41.749,20.72H38.88A18.017,18.017,0,0,0,7.841,9.282l-1.613,1.69h7.027v2.863H3.065l-.4,0A1.433,1.433,0,0,1,1.231,12.4V1.668H4.1l0,7.376L5.819,7.252a20.912,20.912,0,0,1,6.734-4.7,20.884,20.884,0,0,1,29.2,18.167h0Zm.846-1.8a21.822,21.822,0,0,0-4.01-10.085A21.678,21.678,0,0,1,42.6,18.916ZM23.679,0A21.629,21.629,0,0,1,33.764,4.01,21.826,21.826,0,0,0,23.679,0Z"/>
                  </svg></a>
              <?php } else { ?>
                <a style="width:100%;margin-top:20px;font-size:1rem" href="{{ URL::to('/shop')}}" class="btn btn-light common-hover">@lang('website.Back To Shopping') <svg class="ml-10e" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 42.597 42.619" style="margin-left:10px">
                    <path id="Union_120" data-name="Union 120" d="M12.74,40.977A20.877,20.877,0,0,1,0,22.721H2.871A18.015,18.015,0,0,0,33.908,34.159l1.611-1.69h-6.95V29.606l9.591,0,.926,0a1.434,1.434,0,0,1,1.433,1.433V41.6H37.652V34.4l-1.721,1.792a20.882,20.882,0,0,1-6.736,4.7,20.911,20.911,0,0,1-16.456.089ZM41.749,20.72H38.88A18.017,18.017,0,0,0,7.841,9.282l-1.613,1.69h7.027v2.863H3.065l-.4,0A1.433,1.433,0,0,1,1.231,12.4V1.668H4.1l0,7.376L5.819,7.252a20.912,20.912,0,0,1,6.734-4.7,20.884,20.884,0,0,1,29.2,18.167h0Zm.846-1.8a21.822,21.822,0,0,0-4.01-10.085A21.678,21.678,0,0,1,42.6,18.916ZM23.679,0A21.629,21.629,0,0,1,33.764,4.01,21.826,21.826,0,0,0,23.679,0Z"/>
                  </svg></a>
              <?php } ?>
            </div>



          </div>
        </div>
      </div>
    </div>

    </div>
  </section>
</section>

<?php if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>
<!-- The Modal -->
  <div class="modal fade" id="myModalcoupon">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center common-bg">
          <h4 class="modal-title">Available Coupon</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="popup-main">
                <div class="popup-main-left-coupon">
                    <div class="popup-item">
                        <div class="popup-title">Loyalty Voucher</div>
                    </div>

                     @if(count($redeem)>0)
                    @foreach ($redeem as $key=>$jesredeem)
                     @if($jesredeem->points <= $user_data->loyalty_points)
                   <div class="popup-item">
                        <div class="popup-item-left">
                          @if($jesredeem->image_path_type == 'aws')
                             <img src="{{$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @else
                             <img src="{{asset('').$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @endif

                        </div>
                        <div class="popup-item-right">
                            <div class="popup-title">{{ $jesredeem->redeem_points_title}}</div>
                            @if($jesredeem->no_rm =='0')
                             <p>{{$jesredeem->points}} points</p>
                            @else
                             <p>{{$jesredeem->points}} points per @if($jesredeem->discount_type=='fixed_cart')
                                @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $jesredeem->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                               @else
                                {{$jesredeem->no_rm}}%
                               @endif
                              </p>
                            @endif
                            @if($result['commonContent']['settings']['voucher_redeem']=='0')
                             
                            <?php if(session('defaultstatus') == 1 && session('transaction_id') == $jesredeem->redeem_id) { ?>
                              <button style="cursor: not-allowed;" class="btn btn-secondary btn-sm disabled buttonsize">@lang('website.redeem')</button> 
                           <?php } else { ?>
                            <a href="{{URL::to('redeempoints/'. $jesredeem->redeem_id) }}" class="btn btn-secondary btn-sm buttonsize">@lang('website.redeem')</a>
                            <?php }  ?>
                             @else
                             <a href="{{URL::to('applyredeempoints/'. $jesredeem->id) }}" class="btn btn-secondary btn-sm buttonsize">@lang('website.redeem')</a>
                            @endif
                        </div>
                    </div>
                    @else
                      <div class="popup-item">
                        <div class="popup-item-left">
                        @if($jesredeem->image_path_type == 'aws')
                             <img src="{{$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @else
                             <img src="{{asset('').$jesredeem->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @endif
                            
                        </div>
                        <div class="popup-item-right">
                            <div class="popup-title">{{ $jesredeem->redeem_points_title}}</div>
                            @if($jesredeem->no_rm =='0')
                             <p>{{$jesredeem->points}} points</p>
                            @else
                             <p>{{$jesredeem->points}} points per @if($jesredeem->discount_type=='fixed_cart')
                                @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $jesredeem->no_rm }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif
                               @else
                                {{$jesredeem->no_rm}}%
                               @endif</p>
                            @endif
                             @if($result['commonContent']['settings']['voucher_redeem']=='0')
                              <a href="{{URL::to('redeempoints/'. $jesredeem->redeem_id) }}" class="btn btn-secondary btn-sm buttonsize">@lang('website.redeem')</a>
                             @else
                            <button style="cursor: not-allowed;" class="btn btn-secondary btn-sm disabled buttonsize" type="submit">@lang('website.redeem')</button>
                            @endif
                        </div>
                    </div>
                      @endif
                     @endforeach
                    @endif
                </div>
                <div class="popup-main-left-coupon">
                    <div class="popup-item">
                        <div class="popup-title">Promo Code</div>
                    </div>
                   @if(count($items)>0)
                    @php
                      $total_amount=session('currency_value') * $price;
                      //print_r($total_amount);die();
                    @endphp
                    @foreach ($items as $key=>$jesitems)
                     @if($jesitems->minimum_amount <= $total_amount)
                    <div class="popup-item">
                        <div class="popup-item-left">
                        @if($jesitems->image_path_type == 'aws')
                             <img src="{{$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @else
                             <img src="{{asset('').$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @endif
                           
                        </div>
                        <div class="popup-item-right">
                            <div id="vochcode" class="popup-title">{{ $jesitems->code}}</div>
                             <p>{{$jesitems->description}}</p>
                             <button onclick="getvo_code('{{ $jesitems->code}}')" class="btn btn-secondary btn-sm buttonsize">@lang('website.Apply')</button>
                        </div>
                    </div>
                    @else
                      <div class="popup-item">
                        <div class="popup-item-left">
                        @if($jesitems->image_path_type == 'aws')
                             <img src="{{$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @else
                             <img src="{{asset('').$jesitems->image_path}}" alt="" style="height: 100%;width: 100%;">
                             @endif

                         
                        </div>
                        <div class="popup-item-right">
                            <div id="vochcode" class="popup-title">{{ $jesitems->code}}</div>
                             <p>{{$jesitems->description}}</p>
                            <button style="cursor: not-allowed;" class="btn btn-secondary btn-sm disabled buttonsize" type="submit">@lang('website.Apply')</button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
         
      </div>
    </div>
  </div>
<?php } ?>
  
<style>

#myModalcoupon .modal-content {
  width: 100%;
  padding: 0px;
  margin-top: 50px;
}
#myModalcoupon .modal-body {
  padding: 0px;
}
#myModalcoupon .modal-dialog {
    position: unset !important;
    transform: unset !important;
}
#myModalcoupon .modal-title {
    font-size: 1.6em;
    text-align: center;
    color: #fff;
    width:100%;
}

#myModalcoupon .tb
{
  font-weight:600;
}
#myModalcoupon .popup-title {
    border: 0px solid;
    font-size: 1.3em;
    font-weight: 400; 
}
#myModalcoupon .popup-titles {
    width: 100%;
    margin-bottom: 3px;
    font-size: 1.1em;
    font-weight: 600;
    color: #111;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

#myModalcoupon .close {
  font-size: 33px;
    line-height: 45px;
    width: 45px;
    height: 45px;
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 15px;
    color: #000;
    opacity: 1;
}


#myModalcoupon .modal-header {
    color: #fff;
    border-bottom: 1px solid #344d33;
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
    height: 60px;
    width: 100%;
    position:relative;
}

#myModalcoupon .border {
border-right: 1px solid #dadada;
}

#myModalcoupon p.footer-para {
  color: #333;
}

#myModalcoupon .page-content p, .modal-content p {
    margin: 2px 0 0 0;
}
body {font-family: Arial, Helvetica, sans-serif;}

.modalcoupon
	  {
		  padding-top:50px;
	  }




/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
        
        .disabled {
          opacity: 0.6;
        }
        
        .buttonsize{
          padding: 5px;
            font-size: 10px;
        }
                .popup-main{
                    border:0px solid;
                }
                .popup-main-left-coupon{
                    border-right:1px solid #f8f8f8;
                    width:49%;
                    display:inline-block;
                    padding:13px 15px 13px 15px;
                    vertical-align: top;
                    height: 500px;
                    overflow-y: auto;
                    background: #fff;
                }
                .popup-item{
                    border:0px solid;
                    vertical-align: middle;
                    text-align: center;
                    padding: 20px 0px;
                    border-top:1px solid #f8f8f8
                }
                .popup-title{
                    border:0px solid;
                    font-size:1.3em;
                    font-weight:600;
                }
                .title1{
                    font-size:1em;
                }
                .popup-item-left{
                    width: 55px;
                    height: 55px;
                    background-color: transparent;
                    background-size: 46px;
                    display: inline-block;
                    vertical-align: top;
                }
                .popup-item-right{
                    text-align: left;
                    padding-left: 15px;
                    flex: 1 0 0px;
                    display: inline-block;
                    min-width: 0px;
                    width: 70%;
                    vertical-align: top;
                }
                
                .footer-para{
                    font-size: 1.2em;
                    color: rgb(180, 169, 169);           
                    text-align: center;
                    width:100%;
                }
                .modal-footer {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -ms-flex-align: center;
                    align-items: center;
                    -ms-flex-pack: end;
                    justify-content: center;
                    padding: .75rem;
                    border-top: 1px solid #dee2e6;
                    border-bottom-right-radius: calc(.3rem - 1px);
                    border-bottom-left-radius: calc(.3rem - 1px);
                }
                .button-slash{
                    display: inline-block;
                    margin: 0 20px;
                    font-size: 1.4em;
                    color: #ccc;
                    pointer-events: none;
                }
        
                @media (max-width: 767px)
        {
            .mobile-aleft
            {
              text-align:left !important;
            }
            #myModalcoupon .modal-dialog {
              width: 100% !important;
              height: 100vh !important;

            }
           .mobile-mr0
           {
             margin-right: 0 !important;
             width:100% !important;
           }
           .mobile-ub
           {
             margin-top: 10px !important;
             width:100% !important;
           }
           .mobile-rowc
           {
             display: block !important;
             margin-top: 10px !important;
           }
             
        
            #myModalcoupon .modal-content {
              width: 100% !important;
              height: 100vh !important;
            }
            .modalcoupon {
            padding-top: 0px !important;
            }
            .popup-main-left-coupon {
            width: 100%;
            }
            #subscribe
            {
              z-index: 100;
            }
            #myModalLoyalty .modal-header {
            height: auto !important;
            }
            #loginmyModal .modal-sidebars {
            width: 100% !important;
            min-height: auto !important;
        }
        #loginmyModal .modal-page-con {
            width: 100% !important;
           
        }
        
        .loyality-mobile-tab {
            background: #fd5397 !important;
            width: 40% !important;
            position: absolute;
            right: 0;
            z-index: 9999;
            height: auto !important;
        }
        #loginmyModal .tablinks {
            white-space: nowrap;
        }
        .bar-icon-tab
        {
          font-size: 20px;
            color: white;
            text-align: right;
            display: inline-block;
        }
        #loginmyModal .sidebar-points-value-tab {
            font-size: 1.1em;
            padding: 12px 5px 0 0;
        }
        
        
        #loginmyModal .sidebar-points-tab {
            display: inline-block;
            color: #fff;
            margin-right: 20px;
        }
        #loginmyModal .tab-right-headcon
        {
          display: inline-block;
            width: 45%;
            text-align: right;
        }
        .close-tab
        {
          display:none;
        }
        .open-tab
        {
          display:block;
        }
        .help-content {
            height: auto !important;
        }
        
        }
            </style>
<script>
  $(document).ready(function () {
    $('#cartDelete').click(function (e) { 
      {{ Session::forget('coupon_discount') }}
    });
  });
</script>


<script>
  function pop() {
  alert("Please Add Shipping Address");
    window.location.href="/add_shipping";
  }
</script>