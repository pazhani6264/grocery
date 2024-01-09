<style>
    .header-33-cart-drop .header-33-transform{
        transform: translate3d(0px, 0px, 0px) !important;
        left:initial !important;
        right:0px !important;
    }
    .header-twele .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:43px !important;
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

                              <button style="display:inline-block" class="btn btn-light12 dropdown-toggle" type="button" id="dropdownCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 52.544 44.098">
  <path id="cart" d="M30.728,37.537a6.563,6.563,0,0,1,4.944-6.36H19.222a6.561,6.561,0,1,1-3.234,0H13.216l-.4-1.441L5.588,3.939H0V0H8.574l.4,1.439,7.224,25.8H39.281L46.6,9.932H15.8V5.994H52.544L41.889,31.177H38.906a6.561,6.561,0,1,1-8.178,6.36Zm3.281,0a3.28,3.28,0,1,0,3.279-3.281A3.284,3.284,0,0,0,34.01,37.537Zm-19.684,0a3.28,3.28,0,1,0,3.279-3.281A3.284,3.284,0,0,0,14.326,37.537Z" />
</svg>
                                <span class="badge12 badge-secondary badge-cart-33 ">{{ $qunatity }}</span>
                              </button> 

                              <div class="cursor-pointer"  style="margin-left:15px !important;display:inline-block;text-align:right">
        <span style="font-size:1rem">{{Session::get('symbol_left')}}&nbsp;{{ number_format($total_amount*session('currency_value'),2) }}&nbsp;{{Session::get('symbol_right')}}</span>
    </div>

                              @if(count($result['commonContent']['cart'])>0)
                              
                              <div class="header-33-transform dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton">
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
            
            <div class="item-detail" style="width:70%;display:inline-block;padding-left:0px;">
            <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}"><h3 style="font-weight:500" class="item-name">{{$cart_data->products_name}}</h3></a>
                <div style="color:#ccc"  class="item-s">{{$cart_data->customers_basket_quantity}} x {{Session::get('symbol_left')}}{{$cart_data->final_price*session('currency_value')}}{{Session::get('symbol_right')}}
            </div>
           </div>
           <div class="item-thumb" style="width:30%;display:inline-block;position:unset">
               <div class="image" style="display:inline-block">
               <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}">
                    <img class="img-fluid" src="{{asset($cart_data->image)}}" alt="{{$cart_data->products_name}}"/>
                </a>
                </div>
                <a style="position: absolute;top: 25%;right: 0px;" href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}"><i style="color:#ccc" class="fa fa-close common-hover"></i></a>

            </div>
        </li>
        @endforeach
        <li>
            <span style="width:40%;display:inline-block;font-size:1rem">@lang('website.SubTotal')</span><span style="width:60%;display:inline-block;font-size:1rem;text-align:right">{{Session::get('symbol_left')}} {{ $total_amount*session('currency_value') }} {{Session::get('symbol_right')}}</span>
        </li>
    
        <li>
               <!-- <a class="btn btn-link btn-block" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a> -->
               <a class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>    
       </li>

                                  </ul>
                                  
                              </div>
                              @else

                              <div class="header-33-transform dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                                  <ul class="shopping-cart-items">
                                      <li>@lang('website.You have no items in your shopping cart')</li>
                                  </ul>
                              </div>
                              @endif