<style>
  #banner_section_38 {
padding-top: 10px;
padding-bottom: 50px;
}
  .cart-3-main-content{
    display: block;
    min-height: 300px;
    box-shadow: 0 0 #ededed;
    box-shadow: 0 calc(var(51px)*-1) var(#ededed);
}
.cart-3-page-width {
  padding-top: 35px !important;
    padding: 0 40px;
}
.cart-3-section-header {
    margin-bottom: 40px;
    text-align: center;
}
.cart-3-section-header-title {
    margin-bottom: 0;
    font-size:32px;
    font-weight:700;
}

.cart-3-item:last-of-type {
    border-bottom: 0;
}
.cart-3-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid;
    border-bottom-color: #e8e8e1;
}
.cart-3-image {
    flex: 0 0 150px;
    margin-right: 20px;
}
.cart-3-image a {
    position: relative;
    display: block;
    width: 100%;
    height: 100px;
}
.cart-3-image img {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    display: block;
    -o-object-fit: contain;
    object-fit: contain;
}
.cart-3-item-details {
    flex: 1 1 auto;
    display: flex;
    flex-wrap: wrap;
}
.cart-3-item-title {
    flex: 1 1 100%;
}
.cart-3-item-name {
    display: block;
    font-size: 15px;
    margin-bottom: 8px;
}
.cart-3-item-sub {
    flex: 1 1 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.cart-3-item-recommended {
    margin-bottom: 20px;
}
.cart-3-product-price-outer {
    margin-bottom: 30px;
}
.cart-3-product-price-label
{
  font-weight: 700;
  font-size: 15px;
  display: block;
  margin-bottom: 10px;
  cursor: default;
}
.cart-3-product-price-orginal {
    padding-right: 5px;
    display: inline-block;
    text-decoration: line-through;
    font-size:20px;
}
.cart-3-product-price-discount {
    padding-right: 5px;
    display: inline-block;
    font-size:20px;
}
.cart-3-product-price-savings {
    padding-right: 5px;
    display: inline-block;
    color: #e2183d;
    font-size: 14px;
}
.cart-3-qty-wrapper {
    display: inline-block;
    position: relative;
    max-width: 70px;
    min-width: 60px;
    overflow: visible;
    background-color: #fff;
    color: #000;
}
.cart-3-qty-num {
    display: block;
    background: none;
    text-align: center;
    width: 100%;
    padding: 5px 20px;
    margin: 0;
    border: 1px solid;
    border-color: #e8e8e1;
    max-width: 100%;
    border-radius: 0;
}
.cart-3-qty-adjust:hover {
    background-color: #f2f2f2;
    color: #000;
}
.cart-3-qty-adjust {
    cursor: pointer;
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    border: 0 none;
    background: none;
    text-align: center;
    overflow: hidden;
    padding: 0 10px;
    line-height: 1;
    -webkit-user-select: none;
    user-select: none;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transition: background-color .1s ease-out;
    z-index: 1;
    fill: #000;
}
.cart-3-review-bottom {
    font-size: 14px;
    line-height: 2;
}
.cart-3-qty-adjust-minus {
    left: 0;
}
.cart-3-qty-adjust-plus {
    right: 0;
}
.cart-3-qty-adjust .icon {
    display: block;
    font-size: 8px;
    vertical-align: middle;
    width: 10px;
    height: 10px;
    fill: inherit;
}
.cart-3-icon-fallback-text {
    clip: rect(0,0,0,0);
    overflow: hidden;
    position: absolute;
    height: 1px;
    width: 1px;
}
.cart-3-cls-1 {
    fill: none;
    stroke: #000;
    stroke-miterlimit: 10;
    stroke-width: 5px;
}
.cart-3-new-cartbtn {
    width: 100%;
    min-height: 54px;
    border-radius: 3px;
}
.cart-3-item-sub {
    flex: 1 1 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.cart-3-js-qty-wrapper {
    display: inline-block;
    position: relative;
    max-width: 70px;
    min-width: 60px;
    overflow: visible;
    background-color: #fff;
    color: #000;
}
.cart-3-item-price {
    text-align: right!important;
}
.cart-3-price:not(.cart-3-price-strikethrough) {
    font-weight: 700;
    font-size: 16px;
}
.cart-3-remove a {
    display: inline-block;
    margin-top: 10px;
}
.cart-3-price {
    display: block;
}
.cart-3-recommended-title {
    margin-bottom: 20px;
    font-weight: 600 !important;
}

.cart-3-item-row {
    margin-bottom: 20px;
}
.cart-3-item-subtotal {
    font-weight: 700 !important;
    font-size: 16px;
}
.cart-3-checkout-wrapper .btn
{
    line-height: 1.42;
    text-decoration: none;
    text-align: center;
    white-space: normal;
    font-size: 16px;
    font-weight: 700 !important;
    display: inline-block;
    padding: 11px 25px;
}
.cart-3-small
{
  font-size: 12px;
    letter-spacing: 0.5px;
}
.cart-3-checkout-wrapper .additional-checkout-buttons, .cart-3-checkout-wrapper .cart-3-continue {
    margin-top: 12px;
}
.cart-3-checkout, .cart-3-continue {
    width: 100%;
}
.btn--secondary, .rte .btn--secondary {
    border: 1px solid;
    border-color: #000;
    color: #000;
    background-color: #fff;
}
.product-carousel-js-cart .slick-slide {
    padding: 0 !important;
}
.product-carousel-js-cart .product-molla-19 article .thumb {
    height: 110px;
}
.product-carousel-js-cart .ajax_product_45 {
    overflow: unset !important;
    display: flex;
    align-items: stretch;
    height: 275px;
}
.product-carousel-js-cart .slick-list {
  overflow: unset !important;
}
@media only screen and (min-width: 769px)
{
  .cart-3-main-content{
    min-height: 700px;
}
.cart-3-recommended
{
  width: 675px;
}
.cart-3-page-col:last-child:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    background-color: #000;
    opacity: .03;
}
.cart-3-recommended-title {
    font-size : 18px;
}
.cart-3-text-spacing {
    margin-bottom: 25px;
}
.cart-3-page {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    max-width: 1200px;
    margin: 0 auto;
}
.cart-3-page-col:first-child {
    flex: 1 1 65%;
    padding-right: 100px;
}
.cart-3-page-col:last-child {
    flex: 0 1 35%;
    align-self: flex-start;
    position: sticky;
    top: 130px;
    padding: 30px;
}

}
</style>
<main class="cart-3-main-content" id="cart-3-main-content">
  <div id="cart-3-main" class="cart-3-main">
    <div class="cart-3-page-width">
      <header class="cart-3-section-header">
        <h1 class="cart-3-section-header-title">Cart</h1>
          <div class="cart-3-text-spacing"></div>
      </header>
      
      <form method='POST' id="update_cart_form" action='{{ URL::to('/updateCart')}}' >
        <div class="cart-3-page">
          <div class="cart-3-page-col">

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

        
            <?php
              $price = 0;
              ?>
            @foreach( $result['cart'] as $products)
            <?php
            $price+= $products->final_price * $products->customers_basket_quantity;
            ?>
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
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
            
              <div data-products="">       
                <div class="cart-3-item">
                  <div class="cart-3-image">
                    <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-3-image-wrap">
                      <img class="img-fluid" src="{{asset($products->image_path)}}" alt="{{$products->products_name}}"/>
                    </a>
                  </div>


                  <div class="cart-3-item-details">
                    <div class="cart-3-item-title">
                      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-3-item-name"> {{$products->products_name}}
                      </a>
                      <div class="cart-3-item-variants">
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
                    </div>
                    <div class="cart-3-item-sub">
                    <div>

                      <div class="cart-3-js-qty-wrapper">
<!--                         <label class="hidden-label">Quantity</label>
 -->


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
                              <input name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="cart-3-qty-num qty" min="{{$products->min_order}}" max="9999999999">

                              <?php } else if($products->products_type == 3 || $products->products_type == 4) { ?>

<input name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="cart-3-qty-num qty" min="{{$products->min_order}}" max="{{$totalStock}}">

<?php } else { ?>
                            <input name="quantity[]" type="text" readonly value="{{$products->customers_basket_quantity}}" class="cart-3-qty-num qty" min="{{$products->min_order}}" max="{{$products->max_order}}">

                            <?php }?>

                            <span class="">

                            <button type="button" value="quantity" class="cart-3-qty-adjust  quantity-minus1 btn quantity-right-minus qtyminuscart cart-3-qty-adjust-minus" data-type="minus" data-field="" aria-label="Reduce item quantity by one">
                            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-minus" viewBox="0 0 64 64"><path class="cart-3-cls-1" d="M55 32H9"></path></svg>
                              <span class="cart-3-icon-fallback-text" aria-hidden="true">−</span>
                            </button>


                            <button type="button" value="quantity" class="cart-3-qty-adjust quantity-plus1 quantity-right-plus btn qtypluscart cart-3-qty-adjust-plus" data-type="plus" data-field="" aria-label="Increase item quantity by one">
                            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-plus" viewBox="0 0 64 64"><path class="cart-3-cls-1" d="M32 9v46m23-23H9"></path></svg>
                            <span class="cart-3-icon-fallback-text" aria-hidden="true">+</span>
                            </button>

                              </span>
                        
                      </div>

                      


                      <div class="cart-3-remove">
                     
                        <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"  class="cart-3-text-link" >
                          <span id="cartDelete"> Remove</span>
                        </a> 
                  
                       
                      </div>
                    </div>

                    
                    <div class="cart-3-item-price-col">
                      <span class="cart-3-price">

                      @if(!empty($products->final_price))
                    {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}

                    @elseif(!empty($products->discount_price))

                    <span class="cart-3-product-price-orginal">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
                    <span class="cart-3-product-price-discount total_price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}
                    </span>
                    <span class="cart-3-product-price-savings">Save {{Session::get('symbol_left')}}{{$discounted_price}}{{Session::get('symbol_right')}}</span>    


                    @else
                    <span class="cart-3-product-price-discount total_price">
                    {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}
                    </span>
                    @endif

                     


                     
                      </span>       
                    </div>
                  </div>
                  </div>
                </div>
              </div>

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
                            
            @endforeach
            <div class="cart-3-remove" style="text-align: right;">
                      <button class="btn btn-secondary swipe-to-top" style="" id="update_cart">Update Cart</button>
                     
                      </div>

            
            <div class="cart-3-recommended" data-location="page">
              <div class="cart-3-recommended-title">Goes great with</div>
              <div class="general-product">
                <div class="container p-0">
                  <div class="product-carousel-js-cart">      
                    @foreach($result['simliar_products']['product_data'] as $key=>$products)                 
                      <div class="slik">
                        @include('web.common.product')
                      </div>  
                      @endforeach  
                  </div>  
                </div>  
              </div>  
            </div>
          </div>
          <div class="cart-3-page-col">
            <div class="cart-3-item-sub cart-3-item-row cart-3-item-subtotal">
              <div>Subtotal</div>
              <div data-subtotal="">

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
                    
 
                     <span aria-hidden="true">{{Session::get('symbol_left')}}{{session('currency_value') * $price+0}}{{Session::get('symbol_right')}}</span>

                     </div>
             
               
            
            <!-- <div data-discounts="">
            </div> -->
            </div>
            <div class="cart-3-checkout-wrapper cart-3-item-row">
            

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
            <?php $customer = auth()->guard('customer')->user(); if(auth()->guard('customer')->check()){ $user = DB::table('users')->where('id', auth()->guard('customer')->user()->id)->first(); if($user->email != '') { ?>
              <?php if(auth()->guard('customer')->check() && $customer->phone_verified =='1'){ ?>

              <?php 
              $user = DB::table('user_to_address')->where('user_id', auth()->guard('customer')->user()->id)->first(); 
              if($user){
              ?>
                <a href="{{ URL::to('/checkout')}}" class="btn cart-3-checkout btn-secondary m-btn col-12 swipe-to-top">Check out</a>
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
                <a style="color:#fff" onclick="pop()" class="btn cart-3-checkout btn-secondary m-btn col-12 swipe-to-top">Check out</a>
              <?php } ?>

              <?php }else{  session(['login_flag'=>1]); ?>
              <a href="{{ URL::to('/login_nine')}}" class="btn cart-3-checkout btn-secondary m-btn col-12 swipe-to-top">Check out</a>
              <?php } ?>
              <?php } else {?>
                <a href="{{ URL::to('/noEmailCheckout')}}" class="btn cart-3-checkout btn-secondary m-btn col-12 swipe-to-top">Check out</a>
                <?php }?>   
                <?php } else {  session(['login_flag'=>1]); ?>
              <a href="{{ URL::to('/login_nine')}}" class="btn cart-3-checkout btn-secondary m-btn col-12 swipe-to-top">Check out</a>
              <?php } ?>
          @endif
              <a href="{{ URL::to('/shop')}}" class="btn btn--secondary cart-3-continue">
                Continue shopping
              </a>
            </div>
            <div class=" text-center">
              <small class="cart-3-small">Shipping, taxes, and discount codes calculated at checkout.</small>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

@include('web.multibannerstwo.banner38') 

<script>
  //cart item price





  jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.product-carousel-js-cart');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          autoplay: false,
          //rtl:true,
          speed: 300,
          slidesToShow: item || 4,
          slidesToScroll: item || 1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 791,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 650,
            settings: {
              slidesToShow: itemmobile || 1,
              slidesToScroll: itemmobile || 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); // product page3 section

</script>

<script>
  function pop() {
  alert("Please Add Shipping Address");
    window.location.href="/add_shipping";
  }
</script>