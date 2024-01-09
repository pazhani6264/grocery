<style>
    .header-12-fixed-cart-drop .header-12-fixed-transform{
        transform: translate3d(-266px, 0px, 0px) !important;
    }
    .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu {
        margin-top:45px !important;
    }
</style>

<?php $qunatity=0; ?>
                              @foreach($result['commonContent']['cart'] as $cart_data)
                                <?php $qunatity += $cart_data->customers_basket_quantity; ?>
                              @endforeach

                              <button class="btn btn-light12 dropdown-toggle" type="button" id="dropdownCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                <i class="fas fa-shopping-bag common-hover" style="font-size:1.8rem;color:#000"></i>
                                <span class="badge badge-secondary header-12-cart-count">{{ $qunatity }}</span>
                              </button> 

                              @if(count($result['commonContent']['cart'])>0)
                              
                              <div class="header-12-fixed-transform dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton">
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
                                        @if($cart_data->image_path_type == 'aws')
                                            <img class="img-fluid" src="{{$cart_data->image}}" alt="{{$cart_data->products_name}}"/>
                                        @else
                                            <img class="img-fluid" src="{{asset('').$cart_data->image}}" alt="{{$cart_data->products_name}}"/>
                                        @endif
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
              <a class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/orderviewcart')}}">@lang('website.View Cart')</a>
                                    </li>

                                  </ul>
                                  
                              </div>
                              @else

                              <div class="header-12-fixed-transform dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                                  <ul class="shopping-cart-items">
                                      <li>@lang('website.You have no items in your shopping cart')</li>
                                  </ul>
                              </div>
                              @endif