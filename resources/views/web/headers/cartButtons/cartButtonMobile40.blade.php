<style>
  @media only screen and (max-width: 992px)
{
 .tbm_li {
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
 .shopping-cart-items {
    padding-left: 25px;
    padding-right: 25px;
    padding-top: 15px;
    padding-bottom: 15px;
    max-height: none;
    overflow-y: auto;
}
.shopping-cart-items-tbm {
    max-height: 300px;
}
.shopping-cart-items-tbm li  {
  border-bottom: solid 1px #e8e8e1;
}
.shopping-cart-items-tbm li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding: 0;
}
}
</style>
<li class="dropdown resposive-header-cart">

    <?php $qunatity=0; ?>
        @foreach($result['commonContent']['cart'] as $cart_data)
          <?php $qunatity += $cart_data->customers_basket_quantity; ?>
        @endforeach
  
    <button class="btn dropdown-toggle" type="button" id="headerOneCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:5px"> 
    <div class="cart-left">
    <svg aria-hidden="true" height="27" class="tab-mr-10"  width="27" focusable="false" role="presentation" class="icon icon-cart" viewBox="0 0 64 64" style="margin:13px 7px;"><defs></defs><path class="cls-1" d="M14 17.44h46.79l-7.94 25.61H20.96l-9.65-35.1H3" fill="#000"></path><circle cx="27" cy="53" r="2"></circle><circle cx="47" cy="53" r="2"></circle></svg>
      <!-- <i class="fas fa-shopping-cart tab-mr-10" style="color:#000;font-size:20px;margin:13px 7px;"></i> -->
      @if($qunatity != 0)
    <span class="badge badge-secondary badge-cart-33 ">{{ $qunatity }}</span>
    @endif
    </div>
  
    </button> 
    
    @if(count($result['commonContent']['cart'])>0)
   
  
    <div class="header-12-mobile-transform dropdown-menu dropdown-menu-right" style="" aria-labelledby="headerOneCartButton">
        <ul class="shopping-cart-items shopping-cart-items-tbm">
  
          <?php
              $total_amount=0;
              $qunatity=0;
          ?>
          @foreach($result['commonContent']['cart'] as $cart_data)
  
          <?php
          $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
          $qunatity 	  += $cart_data->customers_basket_quantity; ?>
          <li class="cart-drop-item-align">
            <div class="item-thumb">
                                
              <div class="image">
              <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}">
                    <img class="img-fluid" src="{{asset($cart_data->image)}}" alt="{{$cart_data->products_name}}"/>
                </a>
              </div>
            </div>
            <div class="item-detail" style="width:100%;">
             
            <a href="{{ URL::to('/product-detail/'.$cart_data->products_slug)}}"><h3>{{$cart_data->products_name}}</h3></a>
                
                <div class="item-s" style="display: flex;justify-content: flex-end;font-weight: 700;width:100%;">{{$cart_data->customers_basket_quantity}} x {{Session::get('symbol_left')}}{{$cart_data->final_price*session('currency_value')}}{{Session::get('symbol_right')}} 
                  <!-- <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}" class="icon" ><i class="fas fa-trash"></i></a>--></div> 
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
              <a style="right:0px" class="btn btn-secondary btn-block swipe-to-top" href="{{ URL::to('/viewcart')}}">@lang('website.View Cart')</a>
          </li>
        </ul>

    </div>
  
  
          @else
  
          <div class="header-12-mobile-transform dropdown-menu dropdown-menu-right" style="padding:20px;" aria-labelledby="headerOneCartButton">
              <ul class="shopping-cart-items">
                  <li>@lang('website.You have no items in your shopping cart')</li>
              </ul>
          </div>
          @endif
  
  
  {{--  --}}
  
  
<!--
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
-->
  