<!DOCTYPE html>
<html>
    <head>
        <title>VARIABLE CATEGORY</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="QRCODE Scanning">
        <meta name="keywords" content="QRCODE Scanning">
        <meta name="author" content="Platinum Code">
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
        @php
           $color_style= DB::table('settings')->where('id',236)->first();
            $inv = DB::table('settings')->where('id',145)->first();
            $color = DB::table('settings')->where('id',237)->first();
        @endphp
         
        <link rel="stylesheet" type="text/css" href="{{asset('web/table').'/'.$color_style->value}}.css">
        <link rel="stylesheet" href="{{asset('web/table/font-awesome/css/all.min.css')}}">
      
       
        <link rel="stylesheet" href="{{asset('web/table/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('web/table/owl.theme.default.min.css')}}">
       
  
 

    </head>
    
    <?php  $color = $color->value; ?>

    <style>

.owl-carousel .owl-dots.disabled {
    display: block;
}

.cart-span {
    position: absolute;
    top: 0px;
    width: 15px;
    height: 15px;
    background: red;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    padding: 2px;
    right: -4px;
    font-size: 9px;
}
      
.quantity {
  display: flex;
    align-items: center;
    justify-content: left;
    padding: 0;
    float: unset;
}
.quantity__input {
    width: 40px;
    height: 30px;
    margin: 0;
    padding: 0;
    text-align: center;
    border-top: none;
    border-bottom: none;
    border-left: none;
    border-right: none;
    background: transparent !important;
    color: #fff;
    font-size: 1rem;
}
.quantity__minus, .quantity__plus {
    display: block;
    width: 30px;
    height: 30px;
    margin: 0;
    text-decoration: none;
    text-align: center;
    line-height: 20px;
    font-size: 2rem;
    border-radius: 50% !important;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.pc-review-order-button {
    border: 0px solid;
    padding: 1rem 2.5rem;
   
    color: #fff;
    
    border-radius: 50px;
    min-width: 100%;
    max-width: 100%;
    cursor: pointer;
}
.pc-in-button-main {
    border: 0px solid;
    max-width: 100%;
    margin: unset;
    text-align: center;
    
}
.pc-category-variable-order-bottom-price {
    text-align: left;
    font-size: 1.3rem;
    color: #fff;
    margin-bottom: 10px;
    font-weight: 500;
    display: inline-block;
}
body
{
  background: #eeeeee;
}
.pc-mobile-tab {
    background: #fff;;
}
.pc-review-order-bottom-main {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pc-category-variable-order-bottom {
    border-top: 1px solid #b3b1b1;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #000;
    border-top-right-radius: 30px;
    border-top-left-radius: 30px;
    padding: 15px;
}

.description-container.expanded {
  max-height: none;
}
      .description-container {
  position: relative;
  
}
.short-des
{
  white-space: normal;
          overflow: hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;

}
      .qr-content-outer
      {
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        background: #eeeeee;
        border-top: solid 1px #eeeeee;
        margin-top: 15px;
        padding: 20px;
        padding-bottom: 150px;
      }
      .qr-header-new
      {
        display:flex;
        align-items: center;
        justify-content: space-between;
      }
      .prd-size .size-list li.active{
    color: #fff !important;
    background-color: <?php echo $color; ?> !important;

}
.qr-header-new-outer
      {
    padding: 15px;
      }

.owl-dots
{
  text-align: center;
}
.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
    background: 0 0;
    color: #ccc;
    border: solid 1px;
    padding: 0!important;
    font: inherit;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 5px;
}

.pc-category-variable-item-main {
    border: 1px solid #b3b1b1;
    border-radius: 5px;
    margin: 3px 2px;
    display: inline-block;
    padding: 5px 15px;
    width: auto;
}
.owl-item_img-outer {
    height: 200px;
    width: 200px;
    margin: auto;
}
.pc-category-variable-main {
    text-align: left !important;
}

* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

*, *::before, *::after {
    box-sizing: border-box;
}

div {
    display: block;
}
html, body {
    font: normal 400 0.875rem/1.86 Jost !important;
    -webkit-font-smoothing: antialiased;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
    color: #111;
    text-align: left;
    overflow-x: hidden !important;
    overflow: auto;
}
.pc-category-variable-item-title {
    border: none;
    border-radius: 20px;
    text-align: left;
    font-size: 0.9rem;
    color: #000;
    background-color: transparent !important;
    margin: 0;
    padding: 0 !important;
}
.pc-category-variable-item-price {
    
    display: none;
}
      .notifications {
        display: none;
        position: fixed;
        bottom: 20px;
        left: 50%;
        width: 190px;
        background-color: black;
        margin-left: -95px;
        color: white;
        padding: 20px;
        text-align: center;
      }
      .pc-category-variable-item {
   margin: 0 !important;
  
}
      .pc-category-variable-item-title {
    
    display: inline-block;
    padding: 2px 25px;
}

    </style>

    
    <body>

        <h1 class="pc-title mobile-none">This Site Only View on Mobile And Tab</h1>
        <div class="pc-mobile-tab">
            <div class="pc-in-main1">
                <div class="qr-header-new-outer">
                    <div class="qr-header-new">
                    <?php
						$qrcount = DB::table('customers_basket')->where('session_id', '=', session('table_qrcode'))->where('hold_status', '=', 0)->sum('customers_basket_quantity');

					?>

                        <div class="">
                          <a href="javascript:history.back()"><svg class="" style="margin-top:4px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g id="evaArrowIosBackOutline0"><g id="evaArrowIosBackOutline1"><path id="evaArrowIosBackOutline2" fill="currentColor" d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64Z"/></g></g></svg></a>
                        </div>
                        <div class="common-text">{{$result['detail']['product_data'][0]->products_name}}</div>
                        <div class="" style="position:relative;"><a href="{{url('/qrcodecart')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301C4.378 9 6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154c.901 1.153.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z"/><path d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4"/><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z"/></g></svg><span class="cart-span common-bg">{{$qrcount}}</span></a>
                      </div>
                        </div>
                    </div>
                </div>
                

        <?php
            $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
                    $decimal_places = count($currency) > 0 ? $currency[0] : 2;
        ?>

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
            //  dd($result['currency_value']);
        ?>

                      <div class="owl-carousel">
                        <div class="item owl-item_img-outer">
                          <img src="{{asset($result['detail']['product_data'][0]->image_path)}}" alt="{{$result['detail']['product_data'][0]->products_name}}">
                        </div>

                        @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                          @if($images->image_type == 'ACTUAL')
                            <div class="item owl-item_img-outer">
                              <img src="{{asset($images->image_path) }}" alt="{{$result['detail']['product_data'][0]->products_name}}">
                            </div>
                          @endif
                        @endforeach
                      </div>


                <div class="qr-content-outer">
                    <div style="font-size:1.4rem" class=""><b>{{$result['detail']['product_data'][0]->products_name}}<b></div>

                  

                    <div class="description-container  short-des cont-collapse">
                      <div class="description" style="display:block;line-height: 15px;color:#777;">
                        <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                      </div>
                    </div>

                    <a href="#" class="read-more common-text">Read more</a>
                    <a href="#" class="read-less common-text" style="display:none;">Read Less</a>

                   


                   

                


                  
                  <div class="" style="line-height: 15px;">
                       <!--  <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                      <div style="font-size:1.2rem;margin-top:10px"><b>{{Session::get('symbol_left')}} {{ $result['detail']['product_data'][0]->products_price }} {{Session::get('symbol_right')}}</b></div> --><br>
                    
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
                          @foreach($comboPro as $comboProd)
                            <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @endforeach
                      @endif

                     

                      @if($result['detail']['product_data'][0]->products_type == 4)
                        <?php
                          $comboProbuyx = DB::table('product_buy_x')
                          ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                          ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                          ->where('products_description.language_id', Session::get('language_id'))
                          ->where('categories_description.language_id', Session::get('language_id'))
                          ->where('product_buy_x.pro_id', $result['detail']['product_data'][0]->products_id)
                          ->get();

                          $comboProgetx = DB::table('product_get_x')
                          ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                          ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                          ->where('products_description.language_id', Session::get('language_id'))
                          ->where('categories_description.language_id', Session::get('language_id'))
                          ->where('product_get_x.pro_id', $result['detail']['product_data'][0]->products_id)
                          ->get();

                        ?>
                        <h5>Buy X </h5>
                          @foreach($comboProbuyx as $comboProdbuyx)
                            <small><b>Product Name :</b> {{$comboProdbuyx->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProdbuyx->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProdbuyx->qty}}</small><br>
                          @endforeach

                        <h5>Get X </h5>
                          @foreach($comboProgetx as $comboProdgetx)
                            <small><b>Product Name :</b> {{$comboProdgetx->products_name}}</small><br>
                            <small><b>Category Name :</b> {{$comboProdgetx->categories_name}}</small><br>
                            <small><b>Qty :</b> {{$comboProdgetx->qty}}</small><br>
                          @endforeach
                      @endif

                    </div>

                   

                    <form name="attributes" id="add-Product-form" method="post" >
                      
                      <input type="hidden" name="special_discount" id="special_discount" value="no">
                      <input type="hidden" name="special_price" id="special_price" value="">
                      <input type="hidden" name="org_price" id="org_price" value="">

                      <input type="hidden" name="option_name_new" class="option_name_new" value="">
                      <input type="hidden" name="option_id_new" class="option_id_new" value="">
                      <input type="hidden" name="attributes_id_new" class="attributes_id_new" value="">
                      <input type="hidden" name="function_id_new" class="function_id_new" value="">
                      <input type="hidden" name="products_id" class="products_id_new" value="{{$result['detail']['product_data'][0]->products_id}}">
                      <input type="hidden" name="products_type" class="products_type" value="{{$result['detail']['product_data'][0]->products_type}}">
                     

                      <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

                      <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)){{ $result['detail']['product_data'][0]->products_max_stock }}@else 0 @endif" >

                    
                 
            @if(count($result['detail']['product_data'][0]->attributes)>0)
           
                    <div class="pro-options row">
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


                     

                     
                      <div class="prd-size swatches">
                        <div class="pc-category-variable-item-title common-bg">{{ $attributes_data['option']['name'] }} @if($attributes_data['option']['options_required'] == 0) * @endif  @if($attributes_data['option']['options_select_type'] == 0) (Pick 1) @endif @if($attributes_data['option']['options_select_type'] == 1) (Pick Multiple) @endif:</div>

                        <input type="hidden" value="@if($attributes_data['option']['options_required'] == 0){{ $attributes_data['option']['id'] }} @endif" class="@if($attributes_data['option']['options_required'] == 0)main-con-check @endif">

                        @if($attributes_data['option']['options_select_type'] == 0)

                          <ul class="size-list js-size-list" data-select-id="SingleOptionSelector-<?=$index?>">
                            @foreach($attributes_data['values'] as $values_data)
                              <li class="pc-category-variable-item-main var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }}  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="radio_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" >

                                <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                
                                <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="@if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) 1 @else 0 @endif @endif" class="@if($attributes_data['option']['options_required'] == 0)checkbox-active-default  checkbox-active-default-{{ $attributes_data['option']['id'] }} checkbox-active-default-check-{{$values_data['id']}} @endif">


                                <label style="display: flex;align-items: center;justify-content: center;">
                                  <input type="radio" class="radio-{{$values_data['id']}}" name="{{ $attributes_data['option']['id'] }}" style="display:none;"  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif value="{{ $values_data['id'] }}" @if($attributes_data['option']['options_required'] == 0) onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @else onclick="updateActiveClassradio(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @endif>

                                  <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div>
                                  <div class="pc-category-variable-item" style="text-align:center !important;width:100%">{{ $values_data['value'] }}</div>
                                </label>
                              </li>
                            @endforeach
                          </ul>

                          @else


                            <ul class="size-list js-size-list">
                              @foreach($attributes_data['values'] as $values_data)
                                <li class="pc-category-variable-item-main var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">
                                <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="check_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

                                <input type="hidden" value="@if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) 1 @else 0 @endif @endif" class="@if($attributes_data['option']['options_required'] == 0)checkbox-active-default  checkbox-active-default-{{ $attributes_data['option']['id'] }} checkbox-active-default-check-{{$values_data['id']}} @endif">

                              
                                  <label style="display: flex;align-items: center;justify-content: center;">
                                    <input type="checkbox" style="display:none;" @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif name="{{ $attributes_data['option']['id'] }}" value="{{ $values_data['id'] }}" onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'checkbox', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')"> 
                                    <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div>
                                    <div class="pc-category-variable-item" style="text-align:center !important;width:100%">{{ $values_data['value'] }}</div>
                                  </label>
                                </li>
                              @endforeach
                            </ul>

                          @endif

                        

                            </div>
                      @endforeach
                  
                    @endif
                    </div>
                    </div>

                <div class="pc-category-variable-order-bottom">
                    <div class="pc-review-order-bottom-main">
                      <input type="hidden" value="{{ number_format($result['detail']['product_data'][0]->products_filter_price,$decimal_places) }}" id="total_org_price">
                     
                        <div class="pc-category-variable-order-bottom-price">{{Session::get('symbol_left')}}  <span  id="total_dis_price" class="total_price">{{ number_format($result['detail']['product_data'][0]->products_filter_price,$decimal_places) }} </span> {{Session::get('symbol_right')}}
                        <div class="">
                            <div class="quantity">

                                <button type="button" class="quantity__minus common-bg quantity-minus1 button_minus_new  qtyminus"><span style="margin-top: -4px;">-</span></button>


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

                                @if($result['detail']['product_data'][0]->products_type == 0)
                                    @if($result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock && $result['detail']['product_data'][0]->products_max_stock !=0)


                                    <input type="text" readonly name="quantity" class="quantity__input qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

                               
                                @else

                                    <input type="text" readonly name="quantity" class="quantity__input qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                                @endif

                                @elseif($result['detail']['product_data'][0]->products_type == 1)

                                    <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="quantity__input qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

                                @elseif($result['detail']['product_data'][0]->products_type == 3 || $result['detail']['product_data'][0]->products_type == 4 )

                                    <input type="text" readonly name="quantity" class="quantity__input qty" value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
              
                                    min="@if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 
                                    
                                    max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $totalStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $totalStock }}@endif"> 

                                    <span class="input-group-btn">

                                @else

                                    <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="quantity__input qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


                                @endif

                                <input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">

                                <button type="button" class="quantity__plus common-bg quantity-plus1 qtyplus button_plus_new"><span style="margin-top:-4px;">+</span></button>

                            </div>
                        </div>
                        </div>

                        </form>

                        <div class="pc-in-button-main">

                        <?php

                          if($result['detail']['product_data'][0]->products_type == 3){
                            $stocks = 0;
                            $stockarray = [];
      
                            $comboPro = DB::table('product_combo')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();
      
                            foreach($comboPro as $key=>$comboProd){
      
                                $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                                $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                                $stocks = $stocksin - $stockOut;
                                $stockarray[$key] = $stocks;
                                //print_r($stockarray);
                            } ?>


                        @if($inv->value == 1)
                          @if(in_array('0',$stockarray))
                            <button type="submit" class="pc-review-order-button modal-toggle">No Stock</button>
                          @else
                            <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                          @endif
                        @else
                          <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                        @endif   


                         <?php } else if($result['detail']['product_data'][0]->products_type == 4){
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

                            $stocksgetx = 0;
                            $stockarraygetx = [];
      
                            $comboProgetx = DB::table('product_get_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();
      
                            foreach($comboProgetx as $key=>$comboProdgetx){
      
                                $stocksingetx = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
                                $stockOutgetx = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
                                $stocksgetx = $stocksingetx - $stockOutgetx;
                                $stockarraygetx[$key] = $stocksgetx;
                                //print_r($stockarray);
                            }
                            
                            
                            ?>


                        @if($inv->value == 1)
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))
                            <button type="submit" class="pc-review-order-button modal-toggle">No Stock</button>
                          @else
                            <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                          @endif
                          @else
                          <button type="submit" class="pc-review-order-button modal-toggle">No Stock</button>
                          @endif
                        @else
                          <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                        @endif  
                         
                         <?php } else { ?>
                          @if($inv->value == 1)
                          <?php
                              $stocks = 0;
                                $currentStocks = DB::table('inventory')->where('products_id', $result['detail']['product_data'][0]->products_id)->get();
                                if (count($currentStocks) > 0) {
                                    foreach ($currentStocks as $currentStock) {
                                        $stocks += $currentStock->stock;
                                    }
                                }
                                if ($stocks !=0) { 
                          ?> 
                              <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                              <?php } else { ?>
                                <button type="submit" class="pc-review-order-button modal-toggle">No Stock</button>
                              <?php } ?>

                              @else
                          <button type="submit" class="pc-review-order-button modal-toggle add-to-Cart-table">Confirm</button>
                        @endif  
                                  
                         <?php  } ?>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="notifications" id="notificationWishlist"></div>

    </body>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script src="{!! asset('web/table/jquery.min.js') !!}"></script>
        <script src="{!! asset('web/table/owl.carousel.min.js') !!}"></script>

    <script>
     

$(document).ready(function(){

  

    $('.owl-carousel').owlCarousel({
      loop:false,
      margin:10,
      dots:true,
      responsiveClass:true,
      responsive:{
        0:{
          items:1,
          nav:false,
          dots: true
        },
        600:{
          items:1,
          nav:false,
          dots: true
        },
        1000:{
          items:1,
          nav:false,
          loop:false,
          dots: true
          
        }
      }
    });
  });

gettotalval();

  // Get the number of lines in the description
  var descriptionLines = $('.description').prop('scrollHeight') / $('.description').height();

  // If description has only one line, hide the "Read more" link
  if (descriptionLines <= 1) {
    $('.read-more').hide();
  }


$(".read-more").click(function(){
  $('.read-less').show();
  $('.read-more').hide();
  $('.cont-collapse').removeClass('short-des');
});

$(".read-less").click(function(){
  $('.read-less').hide();
  $('.read-more').show();
  $('.cont-collapse').addClass('short-des');
});





function updateActiveClassradio(event, id, attrid, type, prefix, prefix_price) {
  var total_price = parseFloat($('#total_dis_price').html());
  var radio_total = 0;
  var check_total = 0;
  if (type === 'radio') 
  {
    $('.new-' + attrid).removeClass('active');
    if ($(event.target).is(':checked')) {
      $('.var-' + id).addClass('active');
     
    }
   

    if($('.radio-' + id).val() == id) {

      
      $('.radio-' + id).prop('checked', true);
            checked = $('.radio-' + id).val();
            $('.radio-' + id).val('');

        } 
        else {

          $('.radio-' + id).prop('checked', false);
            $('.var-' + id).removeClass('active');
            $('.radio-' + id).val(id);
            
        }


   
  } 
 
  gettotalval();
}


function updateActiveClass(event, id, attrid, type, prefix, prefix_price) {
  var total_price = parseFloat($('#total_dis_price').html());
  var radio_total = 0;
  var check_total = 0;
  if (type === 'radio') 
  {
    $('.new-' + attrid).removeClass('active');
    if ($(event.target).is(':checked')) {
      $('.var-' + id).addClass('active');
    }
  } 
  if (type === 'checkbox') {
    var checkbox = $(event.target);
    var liElement = $('.var-' + id);
   
    liElement.toggleClass('active', checkbox.is(':checked'));
    var checkbox_price = parseFloat(prefix_price);
  }

  var decheck =  $('.checkbox-active-default-check-' + id).val();
    if(decheck == 1)
    {
      $('.checkbox-active-default-check-' + id).val(0);
    }
    else
    {
      $('.checkbox-active-default-check-' + id).val(1);
    }
   
  gettotalval();
}

	// This button will increment the value
  jQuery(document).on('click', '.qtyplus', function(e){
	  
		// Stop acting like a button
		e.preventDefault();
		// Get its current value
    var currentVal = parseInt(jQuery('.qty').val());
		var maximumVal =  jQuery('.qty').attr('max');
		// If is not undefined
		
		if (!isNaN(currentVal)) {
			if(maximumVal!=0){
				
				if(currentVal < maximumVal ){
					// Increment
					
					jQuery('.qty').val(currentVal + 1);
				}
			}

		} else {
      // Otherwise put a 0 there
      		jQuery('.qty').val(0);
		}
    gettotalval();
 
});


// This button will decrement the value till 0
jQuery(document).on('click', '.qtyminus', function(e){

    // Stop acting like a button
    e.preventDefault();

    // Get the field name
    //fieldName = jQuery(this).attr('field');
    var maximumVal =  jQuery('.qty').attr('max');
    var minimumVal =  jQuery('.qty').attr('min');

    // Get its current value
    var currentVal = parseInt(jQuery('.qty').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > minimumVal) {
      // Decrement one
      jQuery('.qty').val(currentVal - 1);

    } else {
      // Otherwise put a 0 there
      jQuery('.qty').val(minimumVal);

    }
    
    gettotalval();

});

function gettotalval()
{


  var radioSum = 0;
  var checkSum = 0;
  var total_price = $('#total_org_price').val();
  var qty = $('.quantity__input').val();

  $('.check_get.active').each(function() {
    var value = parseFloat($(this).val());
    var prefix = $(this).attr('prefix');

    if (prefix === '+') {
      checkSum += value;
    } else if (prefix === '-') {
      checkSum -= value;
    }
  });


  $('.radio_get.active').each(function() {
    var value = parseFloat($(this).val());
    var prefix = $(this).attr('prefix');

    if (prefix === '+') {
      radioSum += value;
    } else if (prefix === '-') {
      radioSum -= value;
    }
});


var numericString = total_price.replace(/[^0-9.-]+/g, ''); // Remove non-numeric characters

var newnum = numericString * <?=session('currency_value')?>;


var final_price = (parseFloat(newnum) + parseFloat(checkSum) + parseFloat(radioSum)) * qty;

$('#total_dis_price').html(final_price.toFixed(2));

var activeOptionName = $('.option_name.active').map(function() {
  return $(this).val();
}).get();


var activeOptionID = $('.option_id.active').map(function() {
  return $(this).val();
}).get();

var activeAttributesID = $('.attributes_id.active').map(function() {
  return $(this).val();
}).get();

var activeFunctionID = $('.function_id.active').map(function() {
  return $(this).val();
}).get();



$('.option_name_new').val(activeOptionName);
$('.option_id_new').val(activeOptionID);
$('.attributes_id_new').val(activeAttributesID);
$('.function_id_new').val(activeFunctionID);






/* console.log(checkSum);
console.log(radioSum);
console.log(total_price);
console.log(qty);
console.log(final_price);  */

}


$(document).ready(function(){
	$('.add-to-Cart-table').on('click', function() {

    var sumArray = [];

    $('.main-con-check ').map(function() {
       var att_id = $(this).val();
     
      
       const activeClassName = 'checkbox-active-default-'+att_id;
      
    // Select elements with the specified class
    const activeInputs = $('.' + activeClassName);
    let sum = 0;
    if (activeInputs.length > 0) {

      var out = activeInputs.map(function() {
  return $(this).val();
}).get();
    
       activeInputs.each(function() {
         sum += parseFloat($(this).val());
       });
       sumArray.push(sum);
    } else {
      sum = 1;
      sumArray.push(sum);
    }



    });

 
    var sumcheck = sumArray.every(function(value) {
  return value !== 0;
});



   

    var products_type = $('.products_type').val();
    var products_id = $('.products_id_new').val();
    var quantity = $('.quantity__input').val();



    if(products_type == 1)
    {

    var option_name = $('.option_name_new').val().split(",");
    var option_id = $('.option_id_new').val().split(",");
    var attributeid = $('.attributes_id_new').val().split(","); 
    var options_values_id = $('.function_id_new').val().split(","); 

    var data = {
      products_id: products_id,
      products_type: products_type,
      attributeid: attributeid,
      option_name: option_name,
      option_id: option_id,
      options_values_id: options_values_id,
      quantity: quantity,
    };

    }

    else
    {

      var data = {
      products_id: products_id,
      products_type: products_type,
      quantity: quantity,
    };

    }

    
  

  
   

   
    if(sumcheck == true)
      {
        jQuery.ajax({
        url: '{{ URL::to("/addtocarttable")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

        type: "POST",
        data: data,

          success: function (res) {
            if(res['status'] == 'exceed')
            {
            notificationWishlist("@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')");
            }
            else {
      
              alert("Product Added Successfully!", "success",{button: window.location.href = 'http://grocery.platinum24.net/qrcodeorder'});
            }

          }
        }); 
      }
      else
      {
        alert('Please select all (*) Options');
      }
	});


  
});

</script>

</html>
