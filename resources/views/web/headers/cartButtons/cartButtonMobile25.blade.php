<style>
    .header-25-mobile-cart-drop .header-25-mobile-transform{
        transform: translate3d(0px, 0px, 0px) !important;
        left:initial !important;
        right:0px !important;
    }
    .header-mobile .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:54px !important;
    }

    @media only screen and (max-width: 800px) and (min-width: 650px){
        .header-25-mobile-cart-drop .header-25-mobile-transform{
            transform: translate3d(0px, 0px, 0px) !important;
            left:initial !important;
            right:0px !important;
        }
        .header-mobile .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
            margin-top:53px !important;
        }
        .ipad-none{
            display:none;
        }
        .mobil-none{
            display:inline-block;
        }
    }

    @media only screen and (max-width: 600px) and (min-width: 320px){
        .mobil-none{
            display:none;
        }
        .ipad-none{
            display:inline-block;
        }
    }
</style>

<li class="dropdown resposive-header-cart" style="margin-left:0px">


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

   <button id="dropdownCartButton" class="btn dropdown-toggle text-center" type="button" id="headerOneCartButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform:none;display:inline-block;float:left;left:5px !important;"> 
    <div class="cart-left">
    <i class="fas fa-shopping-bag text-black font-1-5rem"></i>
    </div>
    <span class="badge badge-secondary badge-top-round">{{ $qunatity }}</span>

   </button> 

   <div class="ipad-none" style="margin-left:20px !important;text-align:right;margin-top:3px">
        <span style="font-size:0.8rem !important">{{Session::get('symbol_left')}}&nbsp;{{ number_format($total_amount*session('currency_value'),2) }}&nbsp;{{Session::get('symbol_right')}}</span>
    </div>

    <div class="mobil-none" style="margin-left:20px !important;text-align:right;margin-top:3px">
        <span style="font-size:0.8rem !important">{{Session::get('symbol_left')}}&nbsp;{{ number_format($total_amount*session('currency_value'),2) }}&nbsp;{{Session::get('symbol_right')}}</span>
    </div>

   @if(count($result['commonContent']['cart'])>0)

<div class="header-25-mobile-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right cart-11" aria-labelledby="dropdownCartButton_1">
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
            <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}"><h3 style="font-weight:500" class="item-name">{{$cart_data->products_name}}</h3></a>
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
              <a style="right:0px" class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>  
       </li>
 </ul>

</div>

@else

<div class="header-25-mobile-transform shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <ul class="shopping-cart-items">
        <li>@lang('website.You have no items in your shopping cart')</li>
    </ul>
</div>
@endif

<!--
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->