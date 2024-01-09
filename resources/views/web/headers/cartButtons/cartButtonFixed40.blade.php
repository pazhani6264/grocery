<style>
    .header-38-fixed-cart-drop .header-38-fixed-transform{
      transform: translate3d(-220px, 0px, 0px) !important;
    }
    .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:58px !important;
    }
</style>

<?php $qunatity=0; ?>
                              @foreach($result['commonContent']['cart'] as $cart_data)
                                <?php $qunatity += $cart_data->customers_basket_quantity; ?>
                              @endforeach

                              <button class="btn  dropdown-toggle" type="button" id="dropdownCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0px;color:#fff"> 
                              <svg aria-hidden="true" height="27"  width="27" focusable="false" role="presentation" class="icon icon-cart" viewBox="0 0 64 64"><defs></defs><path class="cls-1" d="M14 17.44h46.79l-7.94 25.61H20.96l-9.65-35.1H3" fill="#000"></path><circle cx="27" cy="53" r="2"></circle><circle cx="47" cy="53" r="2"></circle></svg>
                                <span class="badge badge-secondary badge-wishlist-29-black" style="border-radius: 100%;width: 20px;height:20px;min-width:20px;top:5px">{{ $qunatity }}</span>
                              </button> 

                              @if(count($result['commonContent']['cart'])>0)
                              
                              <div class="header-38-fixed-transform dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton">
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
                                            <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}" class="icon" ><i class="fas fa-trash"></i></a></div>
                                      </div>
                                    </li>
                                    @endforeach

                                    <li>
                                        <span class="item-summary">@lang('website.Total')&nbsp;:&nbsp;<span>{{Session::get('symbol_left')}}{{ $total_amount*session('currency_value') }}{{Session::get('symbol_right')}}</span>
                                        </span>
                                    </li>
                                    <li>
                                         <!-- <a class="btn btn-link btn-block" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a> -->
              <a class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>
                                    </li>

                                  </ul>
                                  
                              </div>
                              @else

                              <div class="header-38-fixed-transform dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                                  <ul class="shopping-cart-items">
                                      <li>@lang('website.You have no items in your shopping cart')</li>
                                  </ul>
                              </div>
                              @endif