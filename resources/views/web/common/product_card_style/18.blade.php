<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.shop-content .listing .product article .title {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  text-align:left !important;
}

@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 290px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 410px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 360px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 360px !important;
}
}
</style>


<style>
  .product article .desktop-hover .icon {
    margin: 10px !important;
  }
  @media only screen and (max-width: 1024px)
{
  .griding4 .product article .desktop-hover .icon {
    margin: 5px !important;
    width: 35px !important;
    height: 35px !important;
  }
  .form-inline {
    flex-flow: unset;
}
.product article .content .title {
    font-size: 14px;
}
  .product article .content .price {
    font-size: 1rem;
}
.product article .content .price span {
    font-size: 1rem;
}

}
@media only screen and (max-width: 420px)
{
  .product article .content .title {
    font-size: 11px;
}

.product article .content .price {
    font-size: 0.9rem;
}
.product article .content .price span {
    font-size: 0.9rem;
}
.product article .mobile-icons .icon {
    width: 33px;
    height: 33px;
}
}
  </style>

<div class="product product12 product18 ajax_product_18">
  <article style="background-color:{{ $result['commonContent']['settings']['card_background'] }}">
    
    <div class="thumb">
      <div class="badges">
      <?php 
        $current_date = date("Y-m-d", strtotime("now"));

        $created_date = DB::table('products')
        ->select('products.created_at')->where('products_id', $products->products_id)->first();
        
$string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));        $date=date_create($products->created_at);
        date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));
        $after_date = date_format($date,"Y-m-d");
        if($after_date>=$current_date){
          print '<span class="badge badge-info">';
          print __('website.New');
          print '</span>';
        }
        ?> 
          <?php
        if(!empty($products->discount_price)){
          $discount_price = $products->discount_price * session('currency_value');
        }
        $orignal_price = $products->products_price * session('currency_value');

        if(!empty($products->discount_price)){

        if(($orignal_price+0)>0){
          $discounted_price = $orignal_price-$discount_price;
          $discount_percentage = $discounted_price/$orignal_price*100;
        }else{
          $discount_percentage = 0;
          $discounted_price = 0;
        }
        ?>
      
        <span class="badge badge-danger"  data-toggle="tooltip" data-placement="bottom" title="<?php echo (int)$discount_percentage; ?>% @lang('website.off')"><?php echo (int)$discount_percentage; ?>%</span>
        <?php }?>
        
      
      @if($products->is_feature == 1)
        <span class="badge badge-success">@lang('website.Featured')</span>                                            
      @endif  
      </div>
      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
      <div class="product-hover d-none d-lg-flex d-xl-flex">  
        </div></a>

        <div class="icons desktop-hover d-none d-lg-flex d-xl-flex">
            
            <a href="javascript:void(0)" class="icon active swipe-to-top is_liked" products_id="<?=$products->products_id?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@lang('website.Wishlist')">
              <i class="fas fa-heart"></i>
            </a>

            <div class="icon swipe-to-top modal_show" products_id ="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Quick View')">
              <i class="fas fa-eye"></i>
            </div>
            <a onclick="myFunction3({{$products->products_id}})" class="btn-secondary icon swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Compare')">
              <i class="fas fa-align-right" data-fa-transform="rotate-90"></i>
            </a>
          </div>
        <div class="mobile-icons d-lg-none d-xl-none">
            <div class="icons">
              <div class="icon-liked">  

                <a href="javascript:void(0)" class="icon active swipe-to-top is_liked" products_id="<?=$products->products_id?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@lang('website.Wishlist')">
                  <i class="fas fa-heart"></i>
                </a>
                
              </div>

              <div class="icon swipe-to-top modal_show" products_id ="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Quick View')">
                <i class="fas fa-eye"></i>
              </div>
              <a onclick="myFunction3({{$products->products_id}})" class="icon swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Compare')">
                <i class="fas fa-align-right" data-fa-transform="rotate-90"></i>
              </a>


            </div>
          </div>
          <?php if($products->image_path_type == 'aws') { ?>
            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
      <img class="img-fluid lazy_img_load" data-src="{{$products->image_path}}" alt="{{$products->products_name}}"></a>
      <?php }else{?>
        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><img class="img-fluid lazy_img_load" data-src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}"></a>
      <?php }?>
    </div>
    
    <div class="content">
      <span class="tag">
        <?php 
          
          $cat_name = '';
          foreach($products->categories as $key=>$category){
              $cat_name = $category->categories_name;
          }              
                
          echo $cat_name;
        ?>                                  
      </span>
      <h5 class="title"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
     <!--  <p>
          <?php
            $descriptions = strip_tags($products->products_name);
            echo stripslashes($descriptions);
          ?>
      </p> -->
      <?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>
      <div class="price">                     
      @if(!empty($products->discount_price))
            {{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
            <span> {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span>
          @else
          <?php   DB::table('products')->where('products_id', '=', $products->products_id)->update([
        'products_filter_price' => $orignal_price,
    ]); ?>
            {{Session::get('symbol_left')}}&nbsp;{{$orignal_price+0}}&nbsp;{{Session::get('symbol_right')}}
          @endif                        
      </div>  
<!--       <div class="pro-counter">
          <div class="input-group item-quantity">
                
            <input name="products_{{$products->products_id}}" type="text" readonly value="{{$products->products_min_order}}" class="form-control qty1 products_{{$products->products_id}}"  min="@if($products->products_min_order>0 and $products->defaultStock > $products->products_min_order)
             {{$products->products_min_order}} 
             @else {{ $products->products_min_order }}  @endif" 

             max="@if(!empty($products->products_max_stock) and $products->products_max_stock>0 and $products->defaultStock > $products->products_max_stock){{ $products->products_max_stock}}@else{{ $products->defaultStock}}@endif">
            <span class="input-group-btn">
                <button type="button" value="quantity" class="quantity-plus1 btn qtypluscart1" data-type="plus" data-field="">
                    <i class="fas fa-plus"></i>
                </button>
            
                <button type="button" value="quantity" class="quantity-minus1 btn qtyminuscart1" data-type="minus" data-field="">
                    <i class="fas fa-minus"></i>
                </button>
            </span>
          </div>

          @if($products->products_type==0)
            @if($result['commonContent']['settings']['Inventory'])
                @if($products->defaultStock<=0)
                <button type="button" class="btn-secondary bg-red btn icon swipe-to-top" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Out of Stock')"><i class="fas fa-shopping-bag"></i></button>
                @else
                
                <button type="button" id="add-to-cart-d-hide{{$products->products_id}}" class="btn-secondary btn icon swipe-to-top cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Add to Cart')"><i class="fas fa-shopping-bag"></i></button>

                <button type="button" id="added-to-cart-d-hide{{$products->products_id}}" class=" btn-secondary btn icon active swipe-to-top added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Added')"><i class="fas fa-shopping-bag"></i></button>



                @endif
            @else
            <button type="button" id="add-to-cart-d-hide{{$products->products_id}}" class="btn-secondary btn icon swipe-to-top cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Add to Cart')"><i class="fas fa-shopping-bag"></i></button>

            <button type="button" id="added-to-cart-d-hide{{$products->products_id}}" class=" btn-secondary btn icon active swipe-to-top added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Added')"><i class="fas fa-shopping-bag"></i></button>
            @endif
          @else
          <button type="button" class="btn-secondary btn icon swipe-to-top"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.View Detail')"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" style="color:#fff;"><i class="fas fa-shopping-bag"></i></a></button>

           
          @endif  
    
      </div> -->
    
    </div>                 
  
  </article>
</div>
