<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.product_molla_viewall
{
  padding-top: 0 !important
}


.height768{
    height: 500px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 498px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 443px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 309px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 309px !important;
}
}
</style>

<div class="product-molla ajax_product_25 product-molla-25 product product9 product4 box-shadow" style="background-color:#fafafa">
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

        @if($products->button_type == 1 || $products->button_type == 3)
          @if($products->products_type==0)
            @if(!in_array($products->products_id,$result['cartArray']))
              @if($result['commonContent']['settings']['Inventory'])
              @if($products->stock_status == 1)
                @if($products->defaultStock<=0)
                  <span class="badge badge-success  bage-19-out">Out of stock</span>
                @endif
                @endif
              @endif
            @endif
          @endif
          @if($products->products_type==3)
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
                  <span class="badge badge-success  bage-19-out">Out of stock</span>
                @endif
                @endif
              @endif
            @endif
          @endif
          @if($products->products_type==4)
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
                  <span class="badge badge-success  bage-19-out">Out of stock</span>
                @endif
                @endif
              @endif
            @endif
          @endif
        @endif
      
          
     </div>

     <div class="product-action-vertical">

     <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $products->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                      <a id="wish_molla_show_{{$products->products_id}}" class="wish_molla_show wishlist-style-24 btn-expandable  active is_liked_molla_1" products_id="<?= $products->products_id ?>"><spans>add to wishlist</spans><i class="fa fa-heart-o"></i></a>

                      <a style="display:none;" id="wish_molla_hide_{{$products->products_id}}" class="wish_molla_hide wishlist-style-24 btn-expandable  active "  href="{{url('wishlist')}}"><spans>go to wishlist</spans><i class="fa fa-heart"></i></a>
                <?php } else { ?>
                      <a class="wishlist-style-24 btn-expandable  active" href="{{url('wishlist')}}"><spans>go to wishlist</spans><i class="fa fa-heart"></i></a>
                <?php } } else { ?>
                      <a class="wishlist-style-24 btn-expandable  active is_liked_molla_1" products_id="<?= $products->products_id ?>"><spans>add to wishlist</spans><i class="fa fa-heart-o"></i></a>
                <?php } ?>


       <!--  <a class="wishlist-style-24 btn-expandable active  is_liked" products_id="<?= $products->products_id ?>" data-toggle="" data-placement="bottom" title="@lang('website.Wishlist')">
        <spans>add to wishlist</spans>
        <i class="fa fa-heart-o"></i>
      </a> -->

      <div class="icon border-radius-50 wishlist-24  modal_show2 cursor-pointer"  products_id="{{$products->products_id}}" data-toggle="" data-placement="bottom" title="Quick View"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 39.356 27.497">
          <path id="binocular" d="M22.253,20.3a3.69,3.69,0,0,1-5.15,0A8.61,8.61,0,1,1,1.258,14.4l-.022,0A18.577,18.577,0,0,1,2.777,9.381c1.561-3.292,3.9-5.4,6.8-6.137C10.23,1.978,11.551.317,13.39.191c.075-.006.151-.008.226-.008,1.47,0,2.84.993,4.083,2.959,1.085.042,3.026.008,4.24-.023.6-1.06,1.968-3.014,4-3.115.055,0,.11,0,.165,0,1.553,0,3.01,1.1,4.333,3.276A12.234,12.234,0,0,1,34.107,5.82,10.343,10.343,0,0,1,37.382,13.4a8.61,8.61,0,1,1-15.129,6.9ZM24.6,18.888a6.149,6.149,0,1,0,6.15-6.15A6.156,6.156,0,0,0,24.6,18.888Zm-22.138,0a6.149,6.149,0,1,0,6.15-6.15A6.156,6.156,0,0,0,2.459,18.888Zm15.989-1.23a1.23,1.23,0,1,0,1.23-1.23A1.231,1.231,0,0,0,18.448,17.658Zm4.321-2.014a8.615,8.615,0,0,1,12.169-4.278A10.063,10.063,0,0,0,29.55,5.305l-.522-.049-.286-.5c-.935-1.643-1.872-2.54-2.642-2.54h-.045c-1.017.048-2.069,1.667-2.42,2.444l-.283.63-.691.023c-.451.014-4.439.137-5.735-.006l-.559-.063-.279-.486C15.212,3.232,14.334,2.4,13.606,2.4l-.064,0c-.89.061-1.819,1.361-2.166,2.222l-.227.562-.6.112C8.1,5.755,6.165,7.43,4.8,10.28c-.186.389-.349.774-.491,1.147a8.615,8.615,0,0,1,12.275,4.217,3.69,3.69,0,0,1,6.183,0Z" fill="#fff"/>
        </svg></div>
     
       
      
   
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

     <div class="product-action">
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
          <div class="btns btn-blocks  hover-21 swipe-to-top padding-0" >
          @if($products->button_type == 1 || $products->button_type == 3)

                  @if($products->products_type==0)
                      @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->stock_status == 1)
                          @if($products->defaultStock<=0)
                            <button style="display:none" type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><span>@lang('website.Out of Stock')</span></button>
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" >&nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                        @endif
                      @else
                          <button type="button" class="btn btn-24 active swipe-to-top" ><span>@lang('website.Added')</button>
                      @endif
                  @elseif($products->products_type==1)
                      <a class="btn button-two btn-24 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; <span>@lang('website.View Detail')</span></a>
                  @elseif($products->products_type==2)
                      <a href="{{$products->products_url}}" target="_blank" class="btn button-two btn-24  swipe-to-top" >&nbsp;&nbsp; <span>@lang('website.External Link')</span></a>

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
                            <button style="display:none" type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><span>@lang('website.Out of Stock')</span></button>
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" >&nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                        @endif
                      @else
                          <button type="button" class="btn btn-24 active swipe-to-top" ><span>@lang('website.Added')</button>
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
                            <button style="display:none" type="button" class="btn btn-blocks  btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><span>@lang('website.Out of Stock')</span></button>
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                          @else
                              <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" > &nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                          @endif
                        @else
                            <button type="button" class="btn btn-blocks button-two btn-24 cart swipe-to-top" products_id="{{$products->products_id}}" >&nbsp;&nbsp;<span>@lang('website.Add to Cart')</span></button>
                        @endif
                      @else
                          <button type="button" class="btn btn-24 active swipe-to-top" ><span>@lang('website.Added')</button>
                      @endif

                  @endif

                  @elseif($products->button_type == 2)
                  <button type="button"  class="btn button-two btn-24  swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
    @elseif($products->button_type == 4)
      <a class="btn button-two btn-24 swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >&nbsp;&nbsp; <span>@lang('website.View Detail')</span></a>
    @endif 
              </div>
              <?php  } ?>
          </div>
    </div>
    
   <div class="content  padd-10">
     <span class="tag tags text-center">
     <?php

$cat_name = array();
foreach ($products->categories as $key => $category) {
  $cat_name[] = $category->categories_name;
?>
<?php } ?>

<div class="text-center product-description-20">
                <?php 
                $str2=''; 
                foreach ($products->categories as $key => $category) 
                { 
                  $str2 .='<a class="common-hover" href="'.url('shop?category='.$category->categories_slug).'">'.$category->categories_name.'</a>,';  
                } 
                $newccontent = rtrim($str2, ", "); 
                echo $newccontent ?>
              </div>                                  
     </span>
     <h5 class="title titles text-center"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
     <!-- <p class="text-center width-100 product-description-20"><?php
      // $descriptions = strip_tags($products->products_name);
      // echo stripslashes($descriptions);
      ?></p> -->

<?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>

        
     <div class="pricetag">
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

     <div class="pro-rating mt-10px">
          <fieldset class="disabled-ratings-19 text-center">                                           
            <label class = "full fa @if($products->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
            <label class = "full fa @if($products->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
            <label class = "full fa @if($products->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>
            <label class = "full fa @if($products->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label> 
            <label class = "full fa @if($products->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>

            <a style="font-size:0.8rem" href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link mobile-review-center">( {{$products->total_user_rated}} @lang('website.Reviews') )</a>

          </fieldset>
        </div>
  </article>
</div>