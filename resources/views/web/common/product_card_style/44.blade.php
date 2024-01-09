<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}
.product-molla article .content .price span {
  color: #6c757d;
  text-decoration: line-through;
  margin-left: 0px;
  font-size: 0.9rem;
  line-height: 1.5;
}
.btn-44 {
padding: 12px 0px;
width: 100%;
color: #fff;
margin-top: 10px;
font-size: 0.7rem;
border-radius: 5px;
}
.btn-44-danger {
  font-size: 0.7rem;
}
.shop-content .listing .product article .thumb {
width: 32% !important;
display:inline-block
}

.listing .main-44-sty{
  width:100% !important;
  display:inline-block;
}
.shop-content .listing .product article .content {
width: 62% !important;
background-color: transparent !important;
vertical-align:top;
}

.listing .left-44 {
width: 40%;
display: inline-block;
vertical-align: middle;
}

.listing .right-44 {
width: 12%;
display: inline-block;
vertical-align: text-top;
text-align: center;
}

.listing .pricetag-44 {
justify-content: space-between;
display: inline-block !important;
align-items: center;
width: 100%;
height: 50px;
vertical-align: middle;
}

.listing .pro-rating-44 {
display: inline-block !important;
width: 100%;
height: 50px;
vertical-align: middle;
text-align: left;
}

.categories-carousel-js .slick-slide {
outline: none;
padding: 0px !important;
margin: 0px 5px;
}

.product-molla article .badges {
  position: absolute;
  top: 20px;
  left: 0 !important;
}
.content{
  width:100% !important;
}

.height768{
    height: 416px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 416px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 392px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 350px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 350px !important;
}
}

</style>

<div class="product-molla ajax_product_44 product-molla-44 product product9 border-20 box-shadow" style="background-color:{{ $result['commonContent']['settings']['card_background'] }};border-radius: 5px;">
  <article>
  <div class="padd-10 content main-44-sty">
      <h5 class="title"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
  @if($result['commonContent']['settings']['product_column'] == 1)
        <div class="thumb" style="display:inline-block;">
        @else
        <div class="thumb thumb-size thumb-size-34">
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
        // if($after_date>=$current_date){
        //   print '<span class="badge badge-success bage-19-new">';
        //   print __('website.New');
        //   print '</span>';
        // }
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
      </div>
      </div>

    
      <div class="content  padd-10" style="display:inline-block;">
     <span class="tag tags text-center">
     <?php

// $cat_name = array();
// foreach ($products->categories as $key => $category) {
//   $cat_name[] = $category->categories_name;
// ?>
<?php //} ?>

<!-- <div class="text-center product-description-20"><?php //echo implode(', ', $cat_name); ?></div>                             -->
     </span>
    
     <!-- <p class="text-center width-100 product-description-20"><?php
      // $descriptions = strip_tags($products->products_name);
      // echo stripslashes($descriptions);
      ?></p> -->

<?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>

        
     <div class="pricetag-44">
        <div class="price width-100 text-left price-44">                     
          @if(!empty($products->discount_price))
            @if(Session::get('symbol_left'))
              {{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}
            @else
              {{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
            @endif
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
        <div class="price width-100 text-left price-44">                     
          @if(!empty($products->discount_price))
            <span> {{Session::get('symbol_left')}}{{number_format($orignal_price+0 , $decimal_places )}}{{Session::get('symbol_right')}}</span>
          @endif                        
        </div>  
     </div> 

     <div class="pro-rating-44">
                <fieldset class="disabled-ratings-44 star-44">                                           
                  <label class = "full fa @if($products->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                  <label class = "full fa @if($products->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                  <label class = "full fa @if($products->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>
                  <label class = "full fa @if($products->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label> 
                  <label class = "full fa @if($products->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>

                  <!-- <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link mobile-review-center">( {{$products->total_user_rated}} @lang('website.Reviews') )</a> -->

                </fieldset>
              </div>
              <div style="border:0px solid;height:23px">
                <?php
                  if(!empty($products->discount_price)){

                    if(($orignal_price+0)>0){
                      $discounted_price = $orignal_price-$discount_price;
                      $discount_percentage = $discounted_price/$orignal_price*100;
                    }else{
                      $discount_percentage = 0;
                      $discounted_price = 0;
                    }
                  ?>
                <span style="border-radius: 3px;padding: 4px;" class="badge badge-danger" data-toggle="" data-placement="bottom" title="<?php echo (int) $discount_percentage; ?>% @lang('website.off')">Save <?php echo (int) $discount_percentage; ?>%</span>
              <?php } ?>
              </div>

     <div class="btn-hover-33 mobile-display-none">
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
          <div class="left-44">
          @if($products->button_type == 1 || $products->button_type == 3)

              @if($products->products_type==0)
                      @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->stock_status == 1)
                          @if($products->defaultStock<=0)
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Out of Stock')</span></button>
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                        @else
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                        @endif
                      @else
                          <button style="padding:10px 2px !important" type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none">@lang('website.Added')</span></button>
                      @endif
                  @elseif($products->products_type==1)
                      <a style="padding:10px 2px !important" class="btn btn-44 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" ><span class="mob-cart-none"> @lang('website.View Detail')</span>&nbsp;&nbsp;</a>
                  @elseif($products->products_type==2)
                      <a style="padding:10px 2px !important" href="{{$products->products_url}}" target="_blank" class="btn btn-44  swipe-to-top" ><span class="mob-cart-none">Ext Link</span>&nbsp;&nbsp; </a>

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
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Out of Stock')</span></button>
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                        @else
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                        @endif
                      @else
                          <button style="padding:10px 2px !important" type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none">@lang('website.Added')</span></button>
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
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Out of Stock')</span></button>
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                          @else
                              <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @endif
                        @else
                            <button style="padding:10px 2px !important" type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" ><span class="mob-cart-none">@lang('website.Add to Cart')</span>&nbsp;&nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                        @endif
                      @else
                          <button style="padding:10px 2px !important" type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none">@lang('website.Added')</span></button>
                      @endif

                  @endif

                  @elseif($products->button_type == 2)
                  <button type="button"  class="btn btn-blocks  btn-44 swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
    @elseif($products->button_type == 4)
      <a style="padding:10px 2px !important" class="btn btn-44 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" ><span class="mob-cart-none"> @lang('website.View Detail')</span>&nbsp;&nbsp;</a>
    @endif 

            </div>
            <?php } ?>

            <div class="right-44">
            <a onclick="myFunction3({{$products->products_id}})" class="icon common-fill-hover demo-34-fill-color swipe-to-top border-radius-50 cursor-pointer wishlist-43 style-44" data-toggle="" data-placement="bottom" title="Compare"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 43.999 46.058">
          <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
        </svg></a>
                 
            </div>

            <div class="right-44">
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $products->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                    <a id="wish_molla_show_{{$products->products_id}}" class="wish_molla_show icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top is_liked_molla_1" products_id="<?= $products->products_id ?>"><i class="fa fa-heart-o"></i></a>
    
                    <a style="display:none;" id="wish_molla_hide_{{$products->products_id}}" class="wish_molla_hide icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top"  href="{{url('wishlist')}}" data-toggle=""><i class="fa fa-heart "></i></a>
                    <?php } else { ?>
                   <a class="icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top" href="{{url('wishlist')}}"><i class="fa fa-heart"></i></a>
                    <?php } } else { ?>
                <a class="icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top is_liked_molla_1" products_id="<?= $products->products_id ?>"><i class="fa fa-heart-o"></i></a>
                <?php } ?>
                 
            </div>
           


    </div>



    <div class="btn-hover-33 desktop-display-none">
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
          <div class="left-mobile-44">
          @if($products->button_type == 1 || $products->button_type == 3)

              @if($products->products_type==0)
                      @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->stock_status == 1)
                          @if($products->defaultStock<=0)
                            <button type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                        @endif
                      @else
                          <button type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </span></button>
                      @endif
                  @elseif($products->products_type==1)
                      <a class="btn btn-44 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </a>
                  @elseif($products->products_type==2)
                      <a href="{{$products->products_url}}" target="_blank" class="btn btn-44  swipe-to-top" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </a>

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
                            <button type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                        @endif
                      @else
                          <button type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </span></button>
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
                            <button type="button" class="btn btn-blocks  btn-44-danger swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </button>
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks  btn-44 cart swipe-to-top" products_id="{{$products->products_id}}" > <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </button>
                        @endif
                      @else
                          <button type="button" class="btn btn-44 active swipe-to-top" ><span class="mob-cart-none"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg> </span></button>
                      @endif

                  @endif

                  @elseif($products->button_type == 2)
        <a class="btn btn-blocks  btn-44 swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-cart2" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="#fff"/></svg>  </a>
    @elseif($products->button_type == 4)
      <a style="padding:10px 2px !important" class="btn btn-44 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" ><i class="fa fa-eye"></i></a>

    @endif 

            </div>
            <?php } ?>
            <div class="right-mobile-44">
            <a onclick="myFunction3({{$products->products_id}})" class="icon common-fill-hover demo-34-fill-color swipe-to-top border-radius-50 cursor-pointer wishlist-43 style-44" data-toggle="" data-placement="bottom" title="Compare"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 43.999 46.058">
          <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
        </svg></a>
            </div>

            <div class="right-mobile-44">
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $products->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                    <a id="wish_molla_show_{{$products->products_id}}" class="wish_molla_show icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top is_liked_molla_1" products_id="<?= $products->products_id ?>"><i class="fa fa-heart-o"></i></a>
    
                    <a style="display:none;" id="wish_molla_hide_{{$products->products_id}}" class="wish_molla_hide icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top"  href="{{url('wishlist')}}" data-toggle=""><i class="fa fa-heart "></i></a>
                    <?php } else { ?>
                   <a class="icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top" href="{{url('wishlist')}}"><i class="fa fa-heart"></i></a>
                    <?php } } else { ?>
                <a class="icon border-radius-50 common-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top is_liked_molla_1" products_id="<?= $products->products_id ?>"><i class="fa fa-heart-o"></i></a>
                <?php } ?>

            <!-- <a class="icon border-radius-50 common-fill-hover demo-34-fill-color cursor-pointer style-44 wishlist-43 active swipe-to-top is_liked" products_id="<?= $products->products_id ?>"  data-toggle="" data-placement="bottom" title="Wishlist"></a> -->
            </div>


    </div>


  </article>
</div>