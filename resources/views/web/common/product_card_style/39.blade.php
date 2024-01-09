<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.listing .product9.product .product-action {
  left: 0% !important;
  background-color: transparent !important;
box-shadow: none !important;
}  

.quick-icon {
    transform: scaleX(-1);
    display: none;
}

.height768{
    height: 416px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 458px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 458px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 411px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 411px !important;
}
}

</style>

<div class="product-molla ajax_product_39 product-molla-39 product product9 product4 box-shadow border-20" style="background-color:{{ $result['commonContent']['settings']['card_background'] }}">
             <article class="main-39">
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

        $date = date_create($string);
        date_add($date, date_interval_create_from_date_string($result['commonContent']['settings']['new_product_duration'] . " days"));
        $after_date = date_format($date, "Y-m-d");
        if ($after_date >= $current_date) {
          print '<span class="badge badge-success bage-22-new">';
          print __('website.New');
          print '</span>';
        }
        ?>
        <?php
        if (!empty($products->discount_price)) {
          $discount_price = $products->discount_price * session('currency_value');
        }
        $orignal_price = $products->products_price * session('currency_value');

        if (!empty($products->discount_price)) {

          if (($orignal_price + 0) > 0) {
            $discounted_price = $orignal_price - $discount_price;
            $discount_percentage = $discounted_price / $orignal_price * 100;
          } else {
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
          <span class="badge badge-success bage-22-top">Top</span>
          @endif

          @if($products->products_liked > 0)
          <span class="badge badge-success bage-22-sale">Sale</span>
          @endif

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

                      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                        <?php if($products_images->image_path_type == 'aws') { ?>
                          <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }else{?>
                          <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }?>
                      </a>
                      
                      @elseif($products_images->image_type == 'ACTUAL')

                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                          <?php if($products_images->image_path_type == 'aws') { ?>
                            <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }else{?>
                            <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }?>
                        </a>

                      @endif
                </div>
                @else

                    <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                      <?php if($products->image_path_type == 'aws') { ?>
                        <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }else{?>
                        <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }?>
                    </a>
                @endif

                <div class="icon border-radius-50 quick-view-39 cursor-pointer swipe-to-top modal_show2"  products_id="{{$products->products_id}}" data-toggle="" data-placement="bottom" title="Quick View"><i class="fas fa-search-plus quick-icon"></i></div>
                
     


              </div>
               
              <div class="content" style="padding:10px">
               
                <?php

$cat_name = array();
foreach ($products->categories as $key => $category) {
  $cat_name[] = $category->categories_name;
?>
<?php } ?>

<div class="text-left product-description-20">
                <?php 
                $str2=''; 
                foreach ($products->categories as $key => $category) 
                { 
                  $str2 .='<a class="common-hover" href="'.url('shop?category='.$category->categories_slug).'">'.$category->categories_name.'</a>,';  
                } 
                $newccontent = rtrim($str2, ", "); 
                echo $newccontent ?>
              </div>           
                  <h5 class="title titles text-left"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>

<?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>

        
        <div class="price text-left" style="margin-top:10px">                     
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
           
              <div class="product-action footer-39-hover-trans mobileshow-all" style="position:absolute;">
                <div class="btn btn-blocks  swipe-to-top padding-3" >

                <div class="pro-rating mlr-10">
                <fieldset class="disabled-ratings-27 text-left">                                           
                  <label class = "full fa @if($products->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                  <label class = "full fa @if($products->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                  <label class = "full fa @if($products->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>
                  <label class = "full fa @if($products->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label> 
                  <label class = "full fa @if($products->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>

                  <a style="font-size:0.9rem" href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link mobile-review-center">( {{$products->total_user_rated}} @lang('website.Reviews') )</a>

                </fieldset>
              </div><br>
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
              @if($products->button_type == 1 || $products->button_type == 3)

                @if($products->products_type==0)
                      @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->stock_status == 1)
                          @if($products->defaultStock<=0)
                            <button type="button" class="btn btn-blocks  btn-39-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-39 active swipe-to-top" >@lang('website.Added')</button>
                      @endif
                  @elseif($products->products_type==1)
                      <a class="btn btn-39 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; @lang('website.View Detail')</a>
                  @elseif($products->products_type==2)
                      <a href="{{$products->products_url}}" target="_blank" class="btn btn-39  swipe-to-top" >&nbsp;&nbsp; @lang('website.External Link')</a>

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
                            <button type="button" class="btn btn-blocks  btn-39-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-39 active swipe-to-top" >@lang('website.Added')</button>
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
                            <button type="button" class="btn btn-blocks  btn-39-danger swipe-to-top" products_id="{{$products->products_id}}" >@lang('website.Out of Stock')</button>
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks common-fill fill-hover-white btn-39 cart swipe-to-top" products_id="{{$products->products_id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099">
                         <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                       </svg> &nbsp;&nbsp;@lang('website.Add to Cart')</button>
                        @endif
                      @else
                          <button type="button" class="btn btn-39 active swipe-to-top" >@lang('website.Added')</button>
                      @endif

                  @endif

                  @elseif($products->button_type == 2)
              <button type="button"  class="btn btn-blocks  btn-39 swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
    @elseif($products->button_type == 4)
      <a class="btn btn-39 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; @lang('website.View Detail')</a>
    @endif 
<?php } ?>
    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
        {
        $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $products->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
        if($is_liked_products == '')
        { ?>
          <button type="button" id="wish_molla_show_{{$products->products_id}}" class="wish_molla_show btn btn-blocks btn-39-wishlist swipe-to-top is_liked_molla_1" products_id="{{$products->products_id}}" title="" style="padding:10px 0;color:#777;"><i style="margin-right:10px;" class="fa fa-heart-o heart_show"></i><i style="display:none;margin-right:10px;" class="fa fa-heart heart_hide"></i>Add to wishlist</button>

          <a href="{{url('wishlist')}}" ><button type="button" id="wish_molla_hide_{{$products->products_id}}" class="btn btn-blocks btn-39-wishlist swipe-to-top " style="padding:10px 0;color:#777;display:none;"><i style="margin-right:10px;" class="fa fa-heart"></i>Go to wishlist</button></a>
    <?php } else { ?>
        <a href="{{url('wishlist')}}" ><button type="button"  class="btn btn-blocks btn-39-wishlist swipe-to-top" style="padding:10px 0;color:#777;"><i style="margin-right:10px;" class="fa fa-heart"></i>Go to wishlist</button></a>        
    <?php } } else { ?>
        <button type="button" class="btn btn-blocks btn-39-wishlist swipe-to-top is_liked_molla_1" products_id="{{$products->products_id}}" title="" style="padding:10px 0;color:#777;"><i style="margin-right:10px;" class="fa fa-heart-o heart_show"></i><i style="display:none;margin-right:10px;" class="fa fa-heart heart_hide"></i>Add to wishlist</button>
    <?php } ?>

   

   <!--  <button type="button" class="btn btn-blocks btn-39-wishlist swipe-to-top is_liked" products_id="{{$products->products_id}}" title="Wishlist"><i class="fa fa-heart-o"></i> &nbsp;&nbsp; Add to Wishlist</button>
 -->
                 

          </div>
          </div>                 

              </div><!-- End .product-action -->
             </article>
          </div>