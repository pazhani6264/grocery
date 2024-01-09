<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.btn {
  padding: 10px !important;
}

.product_molla_viewall
{
  padding-top: 0 !important
}
.height768{
    height: 400px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 370px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 370px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 315px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 315px !important;
}
}

</style>

<div class="product-molla ajax_product_43 product-molla-43 product product9 product4 box-shadow" style="background-color:#fafafa">
  <article>
  @if($result['commonContent']['settings']['product_column'] == 1)
        <div class="thumb">
        @else
        <div class="thumb thumb-size">
      @endif
     <div class="badges">
      <?php 
        $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places');
        $decimal_places = count($currency) > 0 ? $currency[0] : 2;
        $current_date = date("Y-m-d", strtotime("now"));

        $created_date = DB::table('products')
        ->select('products.created_at')->where('products_id', $products->products_id)->first();
        
        $string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));

        $date=date_create($string);
        date_add($date,date_interval_create_from_date_string($result['commonContent']['settings']['new_product_duration']." days"));
        $after_date = date_format($date,"Y-m-d");
        if($after_date>=$current_date){
          print '<span class="badge badge-success bage-19-new">';
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
      
       <!-- <span class="badge badge-danger" data-toggle="" data-placement="bottom" title="<?php //echo (int) $discount_percentage; ?>% @lang('website.off')"><?php //echo (int) $discount_percentage; ?>%</span> -->
       <?php } ?>


        <!-- @if($products->is_feature == 1)
          <span class="badge badge-success">@lang('website.Featured')</span>
        @endif -->

      @if($products->products_ordered > 0)
          <span class="badge badge-success bage-19-top">Top</span>
          @endif

          @if($products->products_liked > 0)
          <span class="badge badge-success bage-19-sale">Sale</span>
          @endif


      
     </div>

     <div class="product-action-vertical">

     <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $products->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                      <a id="wish_molla_show_{{$products->products_id}}" class="wish_molla_show wishlist-style-43 btn-expandable-26  active is_liked_molla_1" products_id="<?= $products->products_id ?>"><spans>add to wishlist</spans><i class="fa fa-heart-o"></i></a>

                      <a style="display:none;" id="wish_molla_hide_{{$products->products_id}}" class="wish_molla_hide wishlist-style-43 btn-expandable-26  active "  href="{{url('wishlist')}}"><spans>go to wishlist</spans><i class="fa fa-heart"></i></a>
                <?php } else { ?>
                      <a class="wishlist-style-43 btn-expandable-26  active" href="{{url('wishlist')}}"><spans>go to wishlist</spans><i class="fa fa-heart"></i></a>
                <?php } } else { ?>
                      <a class="wishlist-style-43 btn-expandable-26  active is_liked_molla_1" products_id="<?= $products->products_id ?>"><spans>add to wishlist</spans><i class="fa fa-heart-o"></i></a>
                <?php } ?>

    <!--  <a class="wishlist-style-43 btn-expandable-26 active is_liked" products_id="<?= $products->products_id ?>" data-toggle="" data-placement="bottom" title="@lang('website.Wishlist')">
        <spans>add to wishlist</spans>
        <i class="fa fa-heart-o"></i>
      </a>     
     -->
     </div>

     <?php 
                    $products_images = DB::table('products_images')
                    ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')
                    ->select('image_categories.path as image_path', 'image_categories.path_type as image_path_type', 'image_categories.image_type')
                    ->where('products_id', '=', $products->products_id)
                    ->where('image_categories.image_type', 'ACTUAL')
                    ->first();
                  ?>

                @if(!empty($products_images))
                <div class="card-style-first">
                  <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                    <?php if($products->image_path_type == 'aws') { ?>
                      <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}">
                    <?php }else{?>
                      <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
                    <?php }?>
                  </a>
                </div>

                <div class="card-style-second">
                  
                      @if($products_images->image_type == 'LARGE')

                      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" style="height:100%">
                        <?php if($products_images->image_path_type == 'aws') { ?>
                          <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }else{?>
                          <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }?>
                      </a>
                      
                      @elseif($products_images->image_type == 'ACTUAL')

                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" style="height:100%">
                          <?php if($products_images->image_path_type == 'aws') { ?>
                            <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }else{?>
                            <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }?>
                        </a>

                      @endif
                </div>
                @else

                    <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" style="height:100%">
                      <?php if($products->image_path_type == 'aws') { ?>
                        <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }else{?>
                        <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }?>
                    </a>
                @endif

     <div class="product-action" >
     <?php
              if($result['commonContent']['setting'][226]->value == 2){
                  $res = $result['commonContent']['setting']['227']->value;
                  $time = explode('-',$res);
                  $startTime = strtotime($time[0]);
                  $endTime = strtotime($time[1]);
                  $currentTime = time();
                      if($currentTime >= $startTime && $currentTime <= $endTime){
                          $ck = 0;
                      } else {
                          $ck = 1;
                      }
              } else {
                  $ck = 0;
              } 
        
              if($ck == 0){
            ?>
          <div class="btns btn-blocks  icons  swipe-to-top padding-0">
          @if($products->button_type == 1 || $products->button_type == 3)

                  @if($products->products_type==0)
                      @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->stock_status == 1)
                          @if($products->defaultStock<=0)
                            <button type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-43 active swipe-to-top" >@lang('website.Added')</button>
                      @endif
                  @elseif($products->products_type==1)
                      <a class="btn btn-43 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; @lang('website.View Detail')</a>
                  @elseif($products->products_type==2)
                      <a href="{{$products->products_url}}" target="_blank" class="btn btn-43  swipe-to-top" >&nbsp;&nbsp; @lang('website.External Link')</a>

                  @elseif($products->products_type==3)
                  <?php 
                        $stocks = 0;
                        $stockarray = [];

                        $comboPro = DB::table('product_combo')->where('pro_id', $products->products_id)->get();

                        foreach($comboPro as $key=>$comboProd){

                            $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                            $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                            $stocks = $stocksin - $stockOut;
                            $stockarray[$key] = $stocks;
                            //print_r($stockarray);

                        }
                      ?>
                    @if(!in_array($products->products_id,$result['cartArray']))
                      @if($result['commonContent']['settings']['Inventory'])
                      @if($products->stock_status == 1)
                        @if(in_array('0',$stockarray))
                            <button type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-43 active swipe-to-top" >@lang('website.Added')</button>
                      @endif

                      @elseif($products->products_type==4)
                  <?php 
                        $stocks = 0;
                        $stockarray = [];

                        $comboPro = DB::table('product_buy_x')->where('pro_id', $products->products_id)->get();

                        foreach($comboPro as $key=>$comboProd){

                            $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                            $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                            $stocks = $stocksin - $stockOut;
                            $stockarray[$key] = $stocks;
                            //print_r($stockarray);

                        }
                        $stocksgetx = 0;
                        $stockarraygetx = [];
        
                        $comboProgetx = DB::table('product_get_x')->where('pro_id', $products->products_id)->get();
        
                        foreach($comboProgetx as $key=>$comboProdgetx){
        
                            $stocksin = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
                            $stockOut = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
                            $stocksgetx = $stocksin - $stockOut;
                            $stockarraygetx[$key] = $stocksgetx;
                            //print_r($stockarraygetx);
                        }
        
                      ?>
        
                    @if(!in_array($products->products_id,$result['cartArray']))
                      @if($result['commonContent']['settings']['Inventory'])
                      @if($products->stock_status == 1)
                        @if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))
                            <button type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-43 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z" fill="#fff"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-43 active swipe-to-top" >@lang('website.Added')</button>
                      @endif

                  @endif

                  @elseif($products->button_type == 2)
                  <button type="button"  class="btn btn-blocks  btn-43  swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
    @elseif($products->button_type == 4)
      <a class="btn btn-43 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; @lang('website.View Detail')</a>
    @endif 
              </div>
              <?php } ?>
          </div>
    </div>
    
   <div class="content  padd-10">

   <div class="pro-rating" style="margin-top:5px">
                <fieldset class="disabled-ratings-19 text-center">                                           
                  <label class = "full fa @if($products->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                  <label class = "full fa @if($products->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                  <label class = "full fa @if($products->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>
                  <label class = "full fa @if($products->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label> 
                  <label class = "full fa @if($products->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                  <!-- <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link mobile-review-center">( {{$products->total_user_rated}} @lang('website.Reviews') )</a> -->

                </fieldset>
              </div>

     <span class="tag tags text-center">
     <?php

$cat_name = array();
foreach ($products->categories as $key => $category) {
  $cat_name[] = $category->categories_name;
?>
<?php } ?>

<!-- <div class="text-center product-description-20"><?php //echo implode(', ', $cat_name); ?></div>                              -->
     </span>
     <h5 style="margin-top:5px" class="title titles text-center"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
     <!-- <p class="text-center width-100 product-description-20"><?php
      // $descriptions = strip_tags($products->products_name);
      // echo stripslashes($descriptions);
      ?></p> -->

<?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>

        
     <div class="pricetag" style="margin-top:5px">
        <div class="price width-100 text-center">                     
          @if(!empty($products->discount_price))
            @if(Session::get('symbol_left'))
              {{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}
            @else
              {{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
            @endif
          <span> {{Session::get('symbol_left')}}{{number_format($orignal_price+0 , $decimal_places )}}{{Session::get('symbol_right')}}</span>
          @else
          <?php   DB::table('products')->where('products_id', '=', $products->products_id)->update([
        'products_filter_price' => $orignal_price,
    ]); ?>
            @if(Session::get('symbol_left'))
              {{Session::get('symbol_left')}}&nbsp;{{number_format($orignal_price+0 , $decimal_places )}}
            @else
              {{number_format($orignal_price+0 , $decimal_places )}}&nbsp;{{Session::get('symbol_right')}}
            @endif
          @endif                        
        </div>  
     </div> 
  </article>
</div>