
<div class="product ajax_product_1">
  <article style="background-color:{{ $result['commonContent']['settings']['card_background'] }}">
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

      if($after_date >= $current_date){
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
      <div class="product-hover d-none d-lg-block d-xl-block">
        </div></a>
      
      <div class="icons d-none desktop-hover display-grid d-lg-block d-xl-block">    

        <a class="icon active swipe-to-top is_liked" products_id="<?=$products->products_id?>" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Wishlist')">
          <i class="fas fa-heart"></i>
        </a>

        <div class="icon swipe-to-top modal_show " products_id ="{{$products->products_id}}" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Quick View')">
        <i class="fas fa-eye"></i>
        </div>

        <a onclick="myFunction3({{$products->products_id}})" class="icon swipe-to-top"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.Compare')"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>

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
                        <button type="button" class="btn btn-block  btn-danger swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
                      @else
                          <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                      @else
                        <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                  @else
                      <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                  @endif
                  
              @else
                  <button type="button" class="btn btn-block  btn-secondary active swipe-to-top">@lang('website.Added')</button>
              @endif
          @elseif($products->products_type==1)
              <a class="btn btn-block  btn-secondary swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >@lang('website.View Detail')</a>
          @elseif($products->products_type==2)
              <a href="{{$products->products_url}}" target="_blank" class="btn btn-block  btn-secondary swipe-to-top">@lang('website.External Link')</a>

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

                    <button type="button" class="btn btn-block  btn-danger swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>

                  @else

                    <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>

                  @endif
                @else
                  <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                @endif
              @else

                <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>

              @endif
            @else
                <button type="button" class="btn btn-block  btn-secondary active swipe-to-top">@lang('website.Added')</button>
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

                    <button type="button" class="btn btn-block  btn-danger swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>

                  @else

                    <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>

                  @endif
                @else
                  <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                @endif
              @else

                <button type="button" class="btn btn-block  btn-secondary cart swipe-to-top" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>

              @endif
            @else
                <button type="button" class="btn btn-block  btn-secondary active swipe-to-top">@lang('website.Added')</button>
            @endif
          @endif

        @elseif($products->button_type == 2)
          <button type="button"  class="btn btn-block  btn-secondary swipe-to-top modal_show3" products_id="{{$products->products_id}}" products_name="{{$products->products_name}}">Book</button>
        @elseif($products->button_type == 4)
          <a class="btn btn-block  btn-secondary swipe-to-top" href="{{ URL::to('/product-detail/'.$products->products_slug)}}" >@lang('website.View Detail')</a>
        @endif 
<?php } ?>
      </div>


      <div class="mobile-icons d-lg-none d-xl-none">
        <div class="icons">
          <div class="icon-liked"> 

            <a class="icon active swipe-to-top is_liked" products_id="<?=$products->products_id?>">
              <i class="fas fa-heart"></i>
            </a>

          </div>

          <div class="icon modal_show " products_id ="{{$products->products_id}}">
            <i class="fas fa-eye"></i>
          </div>
          <a onclick="myFunction3({{$products->products_id}})" class="icon">
            <i class="fas fa-align-right" data-fa-transform="rotate-90"></i>
          </a>
        </div>
      </div>
      <?php if($products->image_path_type == 'aws') { ?>
      
        <a class="img-fluid-new-outer" href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><img class="img-fluid img-fluid-new lazy_img_load" data-src="{{$products->image_path}}" alt="{{$products->products_name}}"></a>
      <?php }else{?>
        
      <a class="img-fluid-new-outer" href="{{ URL::to('/product-detail/'.$products->products_slug)}}"><img class="img-fluid img-fluid-new lazy_img_load" data-src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}"></a>
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
      <h5 class="title text-center"><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h5>
      <div class="expand-detail">
    <!--     <?=stripslashes($products->products_description)?> -->
      </div>
      <?php 
        $stringonly =  strip_tags($products->products_description); 
        $desc =  stripslashes(substr($stringonly, 0, 150) . '...');
      ?>
        <p class="grid-none-des title"><?php echo $desc; ?></p>
      <div class="price">                     
        @if(!empty($products->discount_price))
          {{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
        <span> {{Session::get('symbol_left')}}{{ number_format($orignal_price+0 , $decimal_places ) }}{{Session::get('symbol_right')}}</span>
        @else
          {{Session::get('symbol_left')}}&nbsp;{{ number_format($orignal_price+0 , $decimal_places ) }}&nbsp;{{Session::get('symbol_right')}}
          <?php   DB::table('products')->where('products_id', '=', $products->products_id)->update([
        'products_filter_price' => $orignal_price,
    ]); ?>
        @endif                        
      </div>  
    </div>                 
 

      <div class="mobile-buttons d-lg-none d-xl-none">
        @if($products->products_type==0)
        @if(!in_array($products->products_id,$result['cartArray']))
            @if($products->defaultStock==0)

                <button type="button" class="btn  btn-danger" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
            @elseif($products->products_min_order>1)
            <a class="btn  btn-secondary" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
            @else
                <button type="button" class="btn  btn-secondary cart" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
            @endif
        @else
            <button type="button" class="btn btn-secondary active">@lang('website.Added')</button>
        @endif
    @elseif($products->products_type==1)
        <a class="btn  btn-secondary" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
    @elseif($products->products_type==2)
        <a href="{{$products->products_url}}" target="_blank" class="btn  btn-secondary">@lang('website.External Link')</a>
    @endif
      </div>
  </article>
</div>

