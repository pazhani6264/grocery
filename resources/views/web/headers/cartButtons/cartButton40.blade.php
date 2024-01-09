<style>
    .header-16-cart-drop .header-16-transform{
        transform: translate3d(0px, 0px, 0px) !important;
        left:initial !important;
        right:0px !important;
       
    }
    .header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items .tbm_li {
    float: none;
    position: unset;
    width: 100%;
    margin-bottom: 30px;
    padding-bottom: 10px;
    margin-left: 0;
    display: flex;
    justify-content: space-between;
    border-bottom: none;
    font-size: 17px;
    font-weight: 700;
}
    .header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-thumb {
    position: unset; 
    left: 0;
    top: 0;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items {
    padding-left: 25px;
    padding-right: 25px;
    padding-top: 15px;
    padding-bottom: 15px;
    max-height: none;
    overflow-y: auto;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items-tbm {
    max-height: 200px;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li {
    float: none;
    position: unset;
    width: 100%;
    margin-bottom: 30px;
   
    padding-bottom: 10px;
    margin-left: 0;
    display: flex;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-detail {
    float: none;
    padding-left: 20px;
    width: 100%;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-thumb .image {
    width: 75px;
    height: 75px;
    border: none;
    border-radius: 0;
    overflow: hidden;
}
    #header40 .header-16-cart-drop .header-16-transform {
        width: 450px;
}
.header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-detail .item-s {
    display: flex;
    align-items: end;
    justify-content: flex-end;
    font-size: 16px;
    color: #000;
    font-weight: 700;
}
    .header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:54px !important;
    }
</style>

<?php 
    $qunatity=0; 
    $total_amount=0.00;
    $newflag = 0;
?>
@foreach($result['commonContent']['cart'] as $cart_data)
    <?php 
        $qunatity += $cart_data->customers_basket_quantity; 
        $total_amount += $cart_data->final_price * $cart_data->customers_basket_quantity;
   ?>
@endforeach


<button id="dropdownCartButton" class="btn dropdown-toggle text-center  cart-click-show header-40-cart-close" type="button" id="headerOneCartButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform:none;display:inline-block"> 
    <div class="cart-left" style="padding-top:2px;">
    <svg aria-hidden="true" height="27"  width="27" focusable="false" role="presentation" class="icon icon-cart" viewBox="0 0 64 64"><defs></defs><path class="cls-1" d="M14 17.44h46.79l-7.94 25.61H20.96l-9.65-35.1H3" fill="#000"></path><circle cx="27" cy="53" r="2"></circle><circle cx="47" cy="53" r="2"></circle></svg>
     @if($qunatity != 0)
     <?php 
    $newflag = 1;
?>
    
    <span class="badge badge-secondary badge-cart-33 ">{{ $qunatity }}</span>
    @endif
    </div>
    <input type="hidden" class="newflag" value="{{ $newflag }}">
    

    <div  style="padding-left:15px !important;display:inline-block;text-align:right">
        <span class="text-40-pr">Cart</span>
    </div>

   </button> 

   

   @if(count($result['commonContent']['cart'])>0)

<div class="header-16-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right cart-11 cart-content" aria-labelledby="dropdownCartButton_1">
    <ul class="shopping-cart-items shopping-cart-items-tbm">
        <?php
            $total_amount=0;
            $qunatity=0;
        ?>
        @foreach($result['commonContent']['cart'] as $cart_data)

        <?php
                     $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
                    $qunatity 	  += $cart_data->customers_basket_quantity; ?>
        <li>
            <div class="item-thumb">
               <div class="image">
               <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}">
                    <img class="img-fluid" src="{{asset($cart_data->image)}}" alt="{{$cart_data->products_name}}"/>
                </a>
                </div>
            </div>
            <div class="item-detail">
                <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}"><h3 class="item-name">{{$cart_data->products_name}}</h3></a>
                <div class="item-s">{{$cart_data->customers_basket_quantity}} x {{Session::get('symbol_left')}}{{$cart_data->final_price*session('currency_value')}}{{Session::get('symbol_right')}}
                <!-- <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}"><i class="fas fa-trash"></i></a> --></div>
           </div>
        </li>
        @endforeach
      
 </ul>

 <ul class="shopping-cart-items" style="border-top: solid 1px #e8e8e1;">
        <li class="tbm_li">
            <div >@lang('website.SubTotal')</div>
            <div>{{Session::get('symbol_left')}}{{ $total_amount*session('currency_value') }}{{Session::get('symbol_right')}}</div>
        </li>
    
        <li>
               <!-- <a class="btn btn-link btn-block" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a> -->
               <a class="btn btn-secondary btn-block swipe-to-top" style="height: 50px;border-radius: 3px;" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>
       </li>
 </ul>

</div>

@else

<div class="cart-content-empty header-16-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
    <ul class="shopping-cart-items">
        <li>@lang('website.You have no items in your shopping cart')</li>
    </ul>
</div>
@endif



<!--
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->