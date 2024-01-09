<?php $qunatity=0; ?>
                @foreach($result['commonContent']['cart'] as $cart_data)
                	<?php $qunatity += $cart_data->customers_basket_quantity; ?>
                @endforeach

                <a class="cart-dropdown-toggle" href="#" role="button" id="ddAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cart-arrow-down" aria-hidden="true"></i>
                    <span class="badge badge-secondary">{{ $qunatity }}</span>

                </a>

                @if(count($result['commonContent']['cart'])>0)
                <div class="cart-dropdown-menu dropdown-menu dropdown-menu-right" aria-labelledby="ddaction">
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
                            	<a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}" class="icon" ><img class="img-fluid" src="{{asset('').'web/images/close.png'}}" alt="icon"></a>
                            	<div class="image">
                                    @if($cart_data->image_path_type == 'aws')
                                        <img class="img-fluid" src="{{$cart_data->image}}" alt="{{$cart_data->products_name}}"/>
                                    @else
                                        <img class="img-fluid" src="{{asset('').$cart_data->image}}" alt="{{$cart_data->products_name}}"/>
                                    @endif
                                </div>
                            </div>
                            <div class="item-detail">
                              <h2 class="item-name">{{$cart_data->products_name}}</h2>
                              <span class="item-quantity">@lang('website.Qty')&nbsp;:&nbsp;{{$cart_data->customers_basket_quantity}}</span>
                              <span class="item-price">{{Session::get('symbol_left')}}{{$cart_data->final_price*$cart_data->customers_basket_quantity*session('currency_value')}}{{Session::get('symbol_right')}}</span>
                           </div>
                        </li>
                        @endforeach
                    <li>
                      <div class="tt-summary">
                      	  <p>@lang('website.items')<span>{{ $qunatity }}</span></p>
                        	<p>@lang('website.SubTotal')<span>{{Session::get('symbol_left')}}{{ $total_amount*session('currency_value') }}{{Session::get('symbol_right')}}</span></p>
                      </div>
                    </li>
                    <li>
                      <div class="buttons">
                          <!-- <a class="btn btn-link btn-block" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a> -->
              <a class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>
                      </div>
                   </li>
                 </ul>

                </div>

				@else

                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <ul class="shopping-cart-items">
                        <li>@lang('website.You have no items in your shopping cart')</li>
                    </ul>
                </div>
                @endif


<!--
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->
