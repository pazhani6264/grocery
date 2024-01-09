<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.height768{
    height: 379px !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 378px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 374px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 293px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 304px !important;
}
}
</style>

<div class="product-molla ajax_product_21 product-molla-20 product product9 product4 border-20" style="background-color:{{ $result['commonContent']['settings']['card_background'] }}">
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

        <a class="icon border-radius-50 wishlist-21 active swipe-to-top is_liked" products_id="<?= $products->products_id ?>" data-toggle="" data-placement="bottom" title="@lang('website.Wishlist')"><i class="fa fa-heart-o"></i></a>
     
      
   
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
                  <a href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}">
                    <?php if($products->image_path_type == 'aws') { ?>
                      <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}">
                    <?php }else{?>
                      <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
                    <?php }?>
                  </a>
                </div>

                <div class="card-style-second">
                  
                      @if($products_images->image_type == 'LARGE')

                      <a href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}">
                        <?php if($products_images->image_path_type == 'aws') { ?>
                          <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }else{?>
                          <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                        <?php }?>
                      </a>
                      
                      @elseif($products_images->image_type == 'ACTUAL')

                        <a href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}">
                          <?php if($products_images->image_path_type == 'aws') { ?>
                            <img class="img-fluid" src="{{$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }else{?>
                            <img class="img-fluid" src="{{asset('').$products_images->image_path}}" alt="{{$products->products_name}}">
                          <?php }?>
                        </a>

                      @endif
                </div>
                @else

                    <a href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}">
                      <?php if($products->image_path_type == 'aws') { ?>
                        <img class="img-fluid" src="{{$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }else{?>
                        <img class="img-fluid" src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}">
                      <?php }?>
                    </a>
                @endif

     <div class="product-action">
        
          <div class="btns btn-blocks bg-dark hover-21 icon swipe-to-top padding-3" >
              <div class="left-20 modal_show2" products_id ="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Quick View')">
                <i class="fas fa-eye"></i>
              </div>
              <div class="right-20">
                  @if($products->products_type==0)
                    @if(!in_array($products->products_id,$result['cartArray']))
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($products->defaultStock<=0)
                             <button type="button" style="font-size:1.2rem" class="btn padding-0 text-white active swipe-to-top hover-20-right padding0px" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Out of Stock')"><i class="fas fa-shopping-bag"></i></button>
                            @else
                            <button type="button" id="add-to-cart-d-hide{{$products->products_id}}" style="font-size:1.2rem" class="btn padding-0 text-white  hover-20-right padding0px swipe-to-top cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Add to Cart')"><i class="fas fa-shopping-bag"></i></button>

                            <button type="button" id="added-to-cart-d-hide{{$products->products_id}}" style="font-size:1.2rem" class="btn padding-0 text-white  hover-20-right padding0px active swipe-to-top added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Added')"><i class="fas fa-shopping-bag"></i></button>

                            @endif
                            @else
                            <button type="button" id="add-to-cart-d-hide{{$products->products_id}}" style="font-size:1.2rem" class="btn padding-0 text-white  hover-20-right padding0px swipe-to-top cart-icon-sb add-to-cart-d-hide add-to-cart-d-hide{{$products->products_id}}" products_id="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Add to Cart')"><i class="fas fa-shopping-bag"></i></button>

                            <button type="button" id="added-to-cart-d-hide{{$products->products_id}}" style="font-size:1.2rem" class="btn padding-0 text-white  hover-20-right padding0px active swipe-to-top added-to-cart-d-hide added-to-cart-d-hide{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Added')"><i class="fas fa-shopping-bag"></i></button>

                          @endif
                      @else
                          <button type="button" style="font-size:1.2rem;padding:0px !important" class="btn padding-0 text-white active swipe-to-top hover-20-right" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Added')"><i class="fas fa-shopping-bag"></i></button>
                      @endif
                    @elseif($products->products_type==1)
                        <a style="font-size:1.2rem;padding:0px !important" class="btn padding-0 text-white swipe-to-top hover-20-right" href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.View Detail')"><i class="fas fa-shopping-bag"></i> </a>
                    @elseif($products->products_type==2)
                        <a style="font-size:1.2rem;padding:0px !important" href="{{$products->products_url}}" target="_blank" class="btn padding-0 text-white swipe-to-top hover-20-right" data-toggle="tooltip" data-placement="bottom" title="@lang('website.External Link')"><i class="fas fa-shopping-bag"></i></a>
                    @endif
              </div>
          </div>
    </div>
    </div>
    
   <div class="content  padd-10">
     <span class="tag text-left">
     <?php

        $cat_name = array();
        foreach ($products->categories as $key => $category) {
          $cat_name[] = $category->categories_name;
        ?>
        <?php } ?>

        <div class="product-description-20"><?php echo implode(', ', $cat_name); ?></div>                 
     </span>
     <h5 class="title"><a href="{{ URL::to('/web-product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
     <!-- <p class="product-description-20"><?php
      // $descriptions = strip_tags($products->products_name);
      // echo stripslashes($descriptions);
      ?></p> -->

      <?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>


     <div class="pricetag">
     <div class="price">                     
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

     <div class="pro-rating">
          <fieldset class="disabled-ratings-19">                                           
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