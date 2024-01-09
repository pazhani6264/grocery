<style>
    .header-25-cart-drop .header-25-transform{
        transform: translate3d(0px, 0px, 0px) !important;
        left:initial !important;
        right:0px !important;
    }
    .header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:58px !important;
    }
</style>

<?php 
    $qunatity=0; 
    $total_amount=0.00;
?>
@foreach($result['commonContent']['cart'] as $cart_data)
    <?php 
        $qunatity += $cart_data->customers_basket_quantity; 
        $total_amount += $cart_data->final_price * $cart_data->customers_basket_quantity;
   ?>
@endforeach


<button id="dropdownCartButton" class="btn dropdown-toggle text-center" type="button" id="headerOneCartButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform:none;display:inline-block"> 
    <div class="cart-left">
     <i class="fas fa-shopping-bag common-hover" style="color:#000"></i>
    </div>
    <span class="badge badge-secondary badge-cart-33 ">{{ $qunatity }}</span>

   </button> 

   <div  style="margin-left:15px !important;display:inline-block;text-align:right">
        <span style="font-size:1rem">{{Session::get('symbol_left')}}&nbsp;{{ number_format($total_amount*session('currency_value'),2) }}&nbsp;{{Session::get('symbol_right')}}</span>
    </div>

    
   @if(count($result['commonContent']['cart'])>0)

<div class="header-25-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton_1">
    <ul class="shopping-cart-items">
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
                <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}"><i class="fas fa-trash"></i></a></div>
           </div>
        </li>
        @endforeach
        <li>
            <span class="item-summary">@lang('website.SubTotal')&nbsp;:&nbsp;<span>{{Session::get('symbol_left')}}{{ $total_amount*session('currency_value') }}{{Session::get('symbol_right')}}</span>
            </span>
        </li>
    
        <li>
              <!-- <a class="btn btn-link btn-block" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a> -->
              <a class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>     
       </li>
 </ul>

</div>

@else

<div class="header-25-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <ul class="shopping-cart-items">
        <li>@lang('website.You have no items in your shopping cart')</li>
    </ul>
</div>
@endif

<!--
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->