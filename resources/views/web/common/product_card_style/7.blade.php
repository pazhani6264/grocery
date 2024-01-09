<style>
article:hover {
  background-color:<?php echo $result['commonContent']['settings']['card_background_hover']; ?> !important;
}

.listing .product7 .thumb{
  width: 35% !important;
  display:inline-block;
}

.listing .product7 .content{
  width: 65% !important;
  display:inline-block;
  text-align:left !important;
}
.listing .product7.product article .content .title {
  text-align:left !important;
}
@media only screen and (min-width: 992px) and (max-width: 1199px)
{
  .height768{
    height: 325px !important;
}
}

@media only screen and (max-width: 768px)
{
  .height768 {
    height: 445px !important;
}
}
@media only screen and (max-width: 420px)
{
  .height768 {
    height: 290px !important;
}

}
@media only screen and (max-width: 367px)
{
  .height768 {
    height: 285px !important;
}
}
</style>

<div class="product product7 ajax_product_7">
  <article style="background-color:{{ $result['commonContent']['settings']['card_background'] }}">
    <div class="productdetail">
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
          
$string = substr($created_date->created_at, 0, strpos($created_date->created_at, ' '));          $date=date_create($string);
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
        
          <span class="badge badge-danger"  data-toggle="" data-placement="bottom" title="<?php echo (int)$discount_percentage; ?>% @lang('website.off')"><?php echo (int)$discount_percentage; ?>%</span>
          <?php }?>
          
        
        @if($products->is_feature == 1)
          <span class="badge badge-success">@lang('website.Featured')</span>                                            
        @endif     
      </div>
      <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
      <?php if($products->image_path_type == 'aws') { ?>
        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><img class="img-fluid lazy_img_load" data-src="{{$products->image_path}}" alt="{{$products->products_name}}"></a>
      <?php }else{?>
        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><img class="img-fluid lazy_img_load" data-src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}"></a>
      <?php }?></a>
      <div class="product-action-vertical">
       
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
 
    </div>

    <div class="content">

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
                <button type="button" class="btn btn-block btn-fs   btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Out of Stock')</button>
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
            @else
                <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
            @endif
          @else
              <button type="button" class="btn btn-block btn-fs  btn-secondary active swipe-to-top" ><i class="fas fa-shopping-bag"></i> @lang('website.Added')</button>
          @endif
      @elseif($products->products_type==1)
          <a class="btn btn-block btn-fs  btn-secondary swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" ><i class="fas fa-shopping-bag"></i> @lang('website.View Detail')</a>
      @elseif($products->products_type==2)
          <a href="{{$products->products_url}}" target="_blank" class="btn btn-fs  btn-block btn-secondary swipe-to-top" ><i class="fas fa-shopping-bag"></i>@lang('website.External Link')</a>

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
                <button type="button" class="btn btn-block btn-fs   btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Out of Stock')</button>
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
            @else
                <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
            @endif
          @else
              <button type="button" class="btn btn-block btn-fs  btn-secondary active swipe-to-top" ><i class="fas fa-shopping-bag"></i> @lang('website.Added')</button>
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
                
                <button type="button" class="btn btn-block btn-fs   btn-danger swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Out of Stock')</button>
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
              @else
                  <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
              @endif
            @else
                <button type="button" class="btn btn-block btn-fs   btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}" ><i class="fas fa-shopping-bag"></i> @lang('website.Add to Cart')</button>
            @endif
          @else
              <button type="button" class="btn btn-block btn-fs  btn-secondary active swipe-to-top" ><i class="fas fa-shopping-bag"></i> @lang('website.Added')</button>
          @endif

      @endif

      @elseif($products->button_type == 2)
      <button type="button"  class="btn btn-block  btn-secondary swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
    @elseif($products->button_type == 4)
      <a class="btn btn-block btn-fs  btn-secondary swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" ><i class="fas fa-shopping-bag"></i> @lang('website.View Detail')</a>
    @endif 
<?php } ?>
      <span class="tag">
        <?php 
    
        $cat_name = '';
        foreach($products->categories as $key=>$category){
            $cat_name = $category->categories_name;
        }              
                
        echo $cat_name;
        ?>                             
      </span>
   
      <h5 class="title text-center"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
     <!--  <p><?php
        $descriptions = strip_tags($products->products_name);
        echo stripslashes($descriptions);
        ?></p> -->

<?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title w-100"><?php echo $desc; ?></p>

      <div class="price">                     
        @if(!empty($products->discount_price))
          {{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
        <span> {{Session::get('symbol_left')}}{{ number_format($orignal_price+0 , $decimal_places ) }}{{Session::get('symbol_right')}}</span>
        @else
        <?php   DB::table('products')->where('products_id', '=', $products->products_id)->update([
        'products_filter_price' => $orignal_price,
    ]); ?>
          {{Session::get('symbol_left')}}&nbsp;{{ number_format($orignal_price+0 , $decimal_places ) }}&nbsp;{{Session::get('symbol_right')}}
        @endif                     
      </div>  
    </div>                 
  </div>
  </article>
</div>
<style>
 
  @media only screen and (max-width: 1024px)
{
  .product article .content .title {
    font-size: 14px;
}
.fa-shopping-bag
{
  margin-right: 3px;
}
.form-inline {
    flex-flow: unset;
}

.product article .content .price {
    font-size: 1rem;
}
.product article .content .price span {
    font-size: 1rem;
}
.btn {
    padding: 0.4rem 0.7rem;
    font-size: 0.75rem;
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
.col-6 .product article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .product article .content .price  span{
    font-size: 0.9rem !important;
}
}
@media only screen and (max-width: 320px)
{
 
.col-6 .product article .content .price {
    font-size: 0.9rem !important;
}
.col-6 .product article .content .price  span{
    font-size: 0.9rem !important;
}

}
  </style>