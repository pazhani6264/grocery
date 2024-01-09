@include('web.details.partials.modals')
<?php
  $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
        $decimal_places = count($currency) > 0 ? $currency[0] : 2;
?> 
<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>

              @if(!empty($result['category_name']) and !empty($result['sub_category_name']))
                <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a></li>
                <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['sub_category_slug'])}}">{{$result['sub_category_name']}}</a></li>
              @elseif(!empty($result['category_name']) and empty($result['sub_category_name']))
                <li class="breadcrumb-item active"><a href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a></li>
              @endif
              @if($result['detail']['product_data'])
              <li class="breadcrumb-item active">{{$result['detail']['product_data'][0]->products_name}}</li>
              @endif
          </ol>
      </div>
    </nav>
</div> 

<section class="pro-content">
@if($result['detail']['product_data'])
  <div class="container">
    <div class="page-heading-title">
        <h2> {{$result['detail']['product_data'][0]->products_name}} 
        </h2>         
    </div>
</div>

<meta property="og:title" content="{{$result['detail']['product_data'][0]->products_name}}" />
<meta property="og:image" content="{{asset($result['detail']['product_data'][0]->default_images) }}" />



<section class="product-page">
  <div class="container"> 
    <div class="product-main">
      <div class="row">
        <div class="col-12 col-sm-12">

    <div class="row">
      <div class="col-12 col-lg-4  ">
          <div class="slider-wrapper slider-banner pd2">
            
              <div class="slider-for">
              <!--   @if(!empty($result['detail']['product_data'][0]->products_video_link))
                <a class="slider-for__item ex1 fancybox-button iframe">
                  {!! $result['detail']['product_data'][0]->products_video_link !!}                 
                </a>
                @endif -->

                <?php
                  $videos = DB::table('product_video')->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'product_video.image_id')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                  ->select('product_video.*', 'image_categories.path as image')->where('product_id', $result['detail']['product_data'][0]->products_id)->get();
                  if(count($videos) > 0)
                  {
                    foreach($videos as $video)
                    {
                ?>
                 <a class="slider-for__item ex1 fancybox-button iframe">
                 {!! $video->video_link !!}          
                </a>
                <?php }} ?>
                
                <a class="slider-for__item ex1 fancybox-button" href="{{asset($result['detail']['product_data'][0]->default_images) }}" data-fancybox-group="fancybox-button">
                @if($result['detail']['product_data'][0]->default_images_path_type == 'aws')
                    <img src="{{$result['detail']['product_data'][0]->default_images }}" alt="Zoom Image" />
                    @else
                    <img src="{{asset('').$result['detail']['product_data'][0]->default_images }}" alt="Zoom Image" />
                  @endif
                </a>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  @if($images->image_type == 'LARGE')

                  <a class="slider-for__item ex1 fancybox-button" href="{{asset($images->image_path) }}" data-fancybox-group="fancybox-button" >
                  @if($images->image_path_type == 'aws')
                      <img src="{{$images->image_path }}" alt="Zoom Image" />
                    @else
                      <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                    @endif
                  </a>
                  
                  @elseif($images->image_type == 'ACTUAL')
                  <a class="slider-for__item ex1 fancybox-button" href="{{asset($images->image_path) }}" data-fancybox-group="fancybox-button">
                  @if($images->image_path_type == 'aws')
                      <img src="{{$images->image_path }}" alt="Zoom Image" />
                    @else
                      <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                    @endif
                  </a>
                  @endif
                @endforeach
              </div>

              <div class="expand-thumb-outer" style="
    position: relative;
    height: 50px;
">

              <a class="fancybox-button fancy-btn-new expand-fancy-thumb " href="{{asset($result['detail']['product_data'][0]->default_images) }}" data-fancybox-group="fancybox-button"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
                    </div>

            
              <div class="slider-nav">

               <!--  @if(!empty($result['detail']['product_data'][0]->products_video_link))
                <div class="slider-nav__item" onclick="pauseVideo()">
                  <img src="{{asset('web/images/miscellaneous/video-thumbnail.jpg')}}" alt="Zoom Image"/>
                </div>
                @endif -->

                <?php
                  $videos = DB::table('product_video')->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'product_video.image_id')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                  ->select('product_video.*', 'image_categories.path as image')->where('product_id', $result['detail']['product_data'][0]->products_id)->get();
                  if(count($videos) > 0)
                  {
                    foreach($videos as $video)
                    {
                ?>
                       <div class="slider-nav__item" style="position:relative;"  onclick="pauseVideo()">
                        <img src="{{asset($video->image)}}" alt="Zoom Image"/>
                        <i style="position:absolute;font-size: 22px;top: 40%;left: 40%;color:red;" class="fa fa-play-circle" aria-hidden="true"></i>
                         
                      </div>     
               
                <?php }} ?>
                
                
                <div class="slider-nav__item" onclick="pauseVideo()">
                @if($result['detail']['product_data'][0]->default_thumb_image_path_type == 'aws')
                <img src="{{$result['detail']['product_data'][0]->default_thumb }}" alt="Zoom Image"/>
                    @else
                    <img src="{{asset('').$result['detail']['product_data'][0]->default_thumb }}" alt="Zoom Image"/>
                  @endif
                </div>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                @if($images->image_type == 'THUMBNAIL')
                <div class="slider-nav__item" onclick="pauseVideo()">
                @if($images->image_path_type == 'aws')
                      <img src="{{$images->image_path }}" alt="Zoom Image" />
                    @else
                      <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                    @endif
                </div>
                @endif
                @endforeach
              </div>
            </div>
      </div>
      <div class="col-12 col-lg-6 d-none">
        <div class="general-product" data-aos="fade-up"
        data-aos-anchor-placement="top-bottom">
          <div class="container">
              <div class="product-m-carousel-js">
                <div class="col-12 col-md-12 col-lg-6">
                  <div class="product">
                    <article>
                    @if($result['detail']['product_data'][0]->default_images_path_type == 'aws')
                    <img src="{{$result['detail']['product_data'][0]->default_images }}" class="img-fluid" alt="blogImage">
                    @else
                    <img src="{{asset('').$result['detail']['product_data'][0]->default_images }}" class="img-fluid" alt="blogImage">
                  @endif
                        <div class="over"></div>
                    </article>
                  </div>
                </div>

                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  @if($images->image_type == 'LARGE')

                  <div class="col-12 col-md-12 col-lg-6">
                    <div class="product">
                      <article>
                      @if($images->image_path_type == 'aws')
                      <img src="{{$images->image_path }}" class="img-fluid" alt="blogImage">
                    @else
                    <img src="{{asset('').$images->image_path }}" class="img-fluid" alt="blogImage">
                    @endif
                        
                          <div class="over"></div>
                      </article>
                    </div>
                  </div>
                  
                  @elseif($images->image_type == 'ACTUAL')
                  <div class="col-12 col-md-12 col-lg-6">
                    <div class="product">
                      <article>
                      @if($images->image_path_type == 'aws')
                      <img src="{{$images->image_path }}" class="img-fluid" alt="blogImage">
                    @else
                    <img src="{{asset('').$images->image_path }}" class="img-fluid" alt="blogImage">
                    @endif
                          <div class="over"></div>
                      </article>
                    </div>
                  </div>
                  @endif
                @endforeach

                
                </div>  
          </div>
        </div>  
      </div>
      <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12 col-md-12">
              <div class="badges">

                <?php 
                $current_date = date("Y-m-d", strtotime("now"));

                $string = substr($result['detail']['product_data'][0]->products_date_added, 0, strpos($result['detail']['product_data'][0]->products_date_added, ' '));
                $date=date_create($string);
                date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

                $after_date = date_format($date,"Y-m-d");

                if($after_date>=$current_date){
                  print '<span class="badge badge-info">';
                  print __('website.New');
                  print '</span>';
                }
              ?>

              <?php
              $discount_percentage = 0;
              if(!empty($result['detail']['product_data'][0]->discount_price)){
                $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
              }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');

              if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
              }else{
                $discount_percentage = 0;
                $discounted_price = 0;
              }
              
              ?>             
              
              <?php }
              
              ?>
              @if($discount_percentage>0)
              <span class="badge badge-danger" id="dis_special"><?php echo (int)$discount_percentage; ?>%</span>
              @endif
              @if($result['detail']['product_data'][0]->is_feature == 1)
              <span class="badge badge-success">@lang('website.Featured')</span>     
              @endif
              
              
            </div>

                <h5 class="pro-title">{{$result['detail']['product_data'][0]->products_name}}</h5>
          
                @if($result['detail']['product_data'][0]->products_type == 3)
                  <?php
                        $comboPro = DB::table('product_combo')
                        ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_combo.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();
                      ?>
                        @foreach($comboPro as $comboProd)
                          <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach
                @endif

                @if($result['detail']['product_data'][0]->products_type == 4)
                <?php
                        $comboPro = DB::table('product_buy_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_buy_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_buy_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_buy_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                        $getX = DB::table('product_get_x')
                        ->leftjoin('products_description','products_description.products_id','=','product_get_x.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_get_x.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_get_x.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();

                      ?>
                      <h5>Buy X :</h5>
                        @foreach($comboPro as $comboProd)
                          <small><b>Product Name :</b> {{$comboProd->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProd->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProd->qty}}</small><br>
                          @if($comboProd->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProd->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProd->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach

                        <br><h5>Get X :</h5>
                        @foreach($getX as $comboProdgetX)
                          <small><b>Product Name :</b> {{$comboProdgetX->products_name}}</small><br>
                          <small><b>Category Name :</b> {{$comboProdgetX->categories_name}}</small><br>
                          <small><b>Qty :</b> {{$comboProdgetX->qty}}</small><br>
                          @if($comboProdgetX->products_type == 1)
                            <?php
                             
                              $productsAttributes = DB::table('products_attributes')
                                  ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                                  ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                                  ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                                  ->where('products_attributes.options_id', $comboProdgetX->attractive_id)
                                  ->where('products_attributes.options_values_id', $comboProdgetX->option_id)
                                  ->get();

                              $options_names = $productsAttributes[0]->options_name;
                              $options_values = $productsAttributes[0]->options_values;
                              
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                        @endforeach
                @endif

          
          <div class="price" style="margin-top:20px">                           
            <?php

            if(!empty($result['detail']['product_data'][0]->discount_price)){
              $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
            }
            if(!empty($result['detail']['product_data'][0]->flash_price)){
              $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
            }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');


             if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
                $discounted_price = $result['detail']['product_data'][0]->discount_price;

             }else{
               $discount_percentage = 0;
               $discounted_price = 0;
             }
            }
            else{
              $discounted_price = $orignal_price;
            }
            ?>
             @if(!empty($result['detail']['product_data'][0]->flash_price))
             <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}}{{$flash_price}}{{Session::get('symbol_right')}}</price>
            <span>{{Session::get('symbol_left')}}{{$orignal_price}}{{Session::get('symbol_right')}} </span> 
            @elseif(!empty($result['detail']['product_data'][0]->discount_price))
            <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price}}{{Session::get('symbol_right')}}</price>
            <span id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 
            @else
            <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}}{{$orignal_price}}{{Session::get('symbol_right')}}</price>
            @endif
                               
            </div>

            <div class="pro-rating">
              <fieldset class="disabled-ratings">                                           
              <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>    
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>                                       
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
              </fieldset>                                          
              <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link">{{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') </a>
            </div>

          <div class="pro-infos">
              <div class="pro-single-info"><b>@lang('website.Product ID') : </b>{{$result['detail']['product_data'][0]->products_id}}</div>
              <div class="pro-single-info"><b>@lang('website.Categroy')  : </b>
                <?php
                $cates = '';  
                ?>
                @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
                    
                  <?php
                    $cates =  "<a class='common-hover' href=".url('shop?category='.$category->categories_slug).">".$category->categories_name."</a>";
                  ?>  
                  
                  <?php 
                echo $cates.',';
                ?>
                 @endforeach

                </div>
              
              {{-- <div class="pro-single-info">
                <b>Tags :</b>
                <ul>
                    <li><a href="#">bracelets</a></li>
                    <li><a href="#">diamond</a></li>
                    <li><a href="#">ring</a></li>
                    
                </ul>
              </div> --}}

             
                <div class="pro-single-info"><b>@lang('website.Available') :</b>
             

                @if($result['detail']['product_data'][0]->products_type == 0)
                  @if($result['commonContent']['settings']['Inventory'])
                  @if($result['detail']['product_data'][0]->stock_status == 1)
                    @if($result['commonContent']['settings']['stock_availability'] == 1)
                      <span class="text-secondary">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
                    @else
                      @if($result['detail']['product_data'][0]->defaultStock <= 0)
                        <span class="text-secondary">@lang('website.Out of Stock')</span>
                      @else
                        <span class="text-secondary">@lang('website.In stock')</span>
                      @endif
                    @endif
                    @else 
                      <span class="text-secondary">@lang('website.In stock')</span>    
                    @endif
                    @else 
                      <span class="text-secondary">@lang('website.In stock')</span>    
                    @endif
                @endif

                @if($result['detail']['product_data'][0]->products_type == 1)
          
                @if($result['commonContent']['settings']['Inventory'])
                @if($result['detail']['product_data'][0]->stock_status == 1)
                  @if($result['commonContent']['settings']['stock_availability'] == 1)
                    <span class="text-secondary" id="variable-count"></span>
                  @else
                    <span class="text-secondary" id="variable-status"></span>  
                  @endif
                  @else
                    <span class="text-secondary" id="variable-status"></span>  
                  @endif
              @endif
              @endif
                @if($result['detail']['product_data'][0]->products_type == 2)
                <span class="text-secondary">@lang('website.External Link')</span>
                @endif
              </div>

              <p>
              @if($result['detail']['product_data'][0]->products_min_order>0)
                  
                    
                  <div class="pro-single-info" id="min_max_setting3"><b>@lang('website.Min Order Limit') : </b>{{$result['detail']['product_data'][0]->products_min_order}}</div>
                    
                 
                @endif
                  
                <div class="pro-single-info"  @if($result['detail']['product_data'][0]->products_max_stock==9999) style="display:none;" @endif id="min_max_setting2"><b>@lang('website.Max Order Limit') : </b> @if($result['detail']['product_data'][0]->products_max_stock == 0)
                  {{$result['detail']['product_data'][0]->products_max_stock}} (unlimited)
                  
                  @else{{$result['detail']['product_data'][0]->products_max_stock}} @endif</div>
                  
                </p>
          </div>

          <form name="attributes" id="add-Product-form" method="post" >
            <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">
            <input type="hidden" name="special_discount" id="special_discount" value="no">
            <input type="hidden" name="special_price" id="special_price" value="">
            <input type="hidden" name="org_price" id="org_price" value="">

            <input type="hidden" value="{{ number_format($result['detail']['product_data'][0]->products_filter_price,$decimal_places) }}" id="total_org_price_new">
            <input type="hidden" name="option_name_new" class="option_name_new" value="">
            <input type="hidden" name="option_id_new" class="option_id_new" value="">
            <input type="hidden" name="attributes_id_new" class="attributes_id_new" value="">
            <input type="hidden" name="function_id_new" class="function_id_new" value="">
            <input type="hidden" name="products_id" class="products_id_new" value="{{$result['detail']['product_data'][0]->products_id}}">
            <input type="hidden" name="products_type" class="products_type" value="{{$result['detail']['product_data'][0]->products_type}}">


            <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

            <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

            <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)){{ $result['detail']['product_data'][0]->products_max_stock }}@else 0 @endif" >
             @if(!empty($result['cart']))
              <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
             @endif


             @if(count($result['detail']['product_data'][0]->attributes)>0)
             <div class="pro-options row">
             <?php
                 $index = 0;
             ?>
               @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
               <?php
                   $functionValue = 'function_'.$key++;
               ?>
               <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
               <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
               <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
               <input id="attributeid_<?=$index?>" type="hidden" value="">
               <input id="attribute_sign_<?=$index?>" type="hidden" value="">
               <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >

               <style>

body { 
/* 	font-family: 'Ubuntu', sans-serif; */
font-weight: bold;
}
.select2-container {
min-width: 400px;
}

.select2-results__option {
padding-right: 20px;
vertical-align: middle;
}
.select2-results__option:before {
content: "";
display: inline-block;
position: relative;
height: 20px;
width: 20px;
border: 1px solid #495057;
border-radius: 4px;
background-color: #fff;
margin-right: 20px;
vertical-align: middle;
}
span.select2.select2-container.select2-container--default {
width: auto !important;
min-width: 131px;
max-width: 400px; 
}
.detail-8-select-control1.select-control::before {
font-family: "Font Awesome 5 Free";
font-weight: 900;
content: "\F107";
position: absolute;
color: #6c757d;
bottom: 36%;
right: 10px;
z-index: 1;
font-size: 12px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
display: none !important;
}
.select2-results__option[aria-selected=true]:before {
font-family:fontAwesome;
content: "\2713";
color: #fff;
background-color: #f77750;
border: 0;
display: inline-block;
padding-left: 5px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
background-color: #eaeaeb;
color: #272727;
}
.select2-container--default .select2-selection--multiple .select2-selection__clear {
display: none !important;
}
.select2-container--default .select2-selection--multiple {
margin-bottom: 10px;
}
.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
border-radius: 4px;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
border-color: #f77750;
border-width: 1px;
}
.select2-container--default .select2-selection--multiple {
border-width: 1px;
}
.select2-container--open .select2-dropdown--below {

border-radius: 6px;
box-shadow: 0 0 10px rgba(0,0,0,0.5);

}
.select2-selection .select2-selection--multiple:after {
content: 'hhghgh';
}
/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
display: none;
}
.select-icon .placeholder {
/* 	display: none; */
}
.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
display: none !important;
/* content: "" !important; */
}
.select-icon  .select2-search--dropdown {
display: none;
}



.btn-group .select {
position: relative;
}
/* .btn-group .select input:checked + label {
background-color: #ffc107;
} */
.btn-group .select input:checked + label:hover, .btn-group .select input:checked + label:focus, .btn-group .select input:checked + label:active {
background-color: #ffc107;
}


.btn-group .select input:checked + label .tick-active{
color: #000;
background: none;
position: absolute;
right: 10px;
bottom: 10px;
width: 20px;
border-bottom: 20px solid #ffc107;
border-left: 20px solid transparent;
border-right: 0px solid transparent;
}

.btn-group .select input:checked + label .tick-active:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}


.btn-group .select input {
opacity: 0;
position: absolute;
}
.btn-group .select .button_select {
margin: 0 10px 10px 0;
display: flex;
background-color: transparent;
}
.btn-group .select .button_select:hover, .btn-group .select .button_select:focus, .btn-group .select .button_select:active {
background-color: transparent;
}

.option {
position: relative;
}
.option input {
opacity: 0;
position: absolute;
}
/* .option input:checked + span {
background-color: #ffc107;
} */
.option input:checked + span:hover, .option input:checked + span:focus, .option input:checked + span:active {
background-color: #ffc107;
}
.option .btn-option {
margin: 0 10px 10px 0;
display: flex;
background-color: transparent;
}
.option .btn-option:hover, .option .btn-option:focus, .option .btn-option:active {
background-color: transparent;
}


.option input:checked + span .tick-active{
color: #000;
background: none;
position: absolute;
right: 10px;
bottom: 10px;
width: 20px;
border-bottom: 20px solid #ffc107;
border-left: 20px solid transparent;
border-right: 0px solid transparent;
}

.option input:checked + span .tick-active:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}

.tick-active-new:before {
content: "\2713";
position: absolute;
right: 1px;
top: 4.5px;
color: #000;
font-family: 'Font Awesome 5 Brands';
font-weight: 900;
transform: rotate(5deg);
}
.tick-active-new {
right:0;bottom:0;height: 20px;background: none;position: absolute;width: 20px;border-bottom: 20px solid;border-left: 20px solid transparent;border-right: 0px solid transparent;
}

</style>



<script>

$(".js-select2").select2({
closeOnSelect : false,
placeholder : "Placeholder",
// allowHtml: true,
allowClear: true,
tags: true // создает новые опции на лету
});
</script>

   <div class="box mb-3" style="width:100%;">


  <label class="detail-8-att-label">{{ $attributes_data['option']['name'] }} @if($attributes_data['option']['options_required'] == 0) * @endif  @if($attributes_data['option']['options_select_type'] == 0) (Pick 1) @endif @if($attributes_data['option']['options_select_type'] == 1) (Pick Multiple) @endif</label>

  @if($attributes_data['option']['options_select_type'] == 0)

    <ul class="size-list js-size-list" data-select-id="SingleOptionSelector-<?=$index?>">
      @foreach($attributes_data['values'] as $values_data)
        <li class="pc-category-variable-item-main  var-{{$values_data['id']}} common-color new-{{ $attributes_data['option']['id'] }}  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">

          <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="radio_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" >

          <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          
          <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">


          <label>
            <input type="radio" class="radio-{{$values_data['id']}}" name="{{ $attributes_data['option']['id'] }}" style="display:none;"  @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif value="{{ $values_data['id'] }}" @if($attributes_data['option']['options_required'] == 0) onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @else onclick="updateActiveClassradio(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'radio', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')" @endif>

            <!-- <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
            <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
          </label>
          <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
        </li>
      @endforeach
    </ul>

    @else


      <ul class="size-list js-size-list">
        @foreach($attributes_data['values'] as $values_data)
          <li class="pc-category-variable-item-main  common-color var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif" style="display:inline-block;height: 40px !important;border: solid 1px;margin: 0 10px 10px 0;position:relative;">
          <input type="hidden" value="{{ $values_data['price'] }}" prefix="{{ $values_data['price_prefix'] }}" class="check_get var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{ $attributes_data['option']['name'] }}" class="option_name var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{ $attributes_data['option']['id'] }}" class="option_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{ $values_data['products_attributes_id'] }}" class="attributes_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

          <input type="hidden" value="{{$values_data['id']}}" class="function_id var-{{$values_data['id']}} new-{{ $attributes_data['option']['id'] }} @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) active @endif @endif">

        
            <label>
              <input type="checkbox" style="display:none;" @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) checked @endif @endif name="{{ $attributes_data['option']['id'] }}" value="{{ $values_data['id'] }}" onchange="updateActiveClass(event, {{$values_data['id']}}, {{ $attributes_data['option']['id'] }} , 'checkbox', '{{ $values_data['price_prefix'] }}', '{{ $values_data['price'] }}')"> 
             <!--  <div class="pc-category-variable-item-price">{{ $values_data['price_prefix'] }}{{ $values_data['price'] }}</div> -->
              <div class="pc-category-variable-item cursor-pointer" style="text-align:center !important;width:100%;padding: 0.6rem 1.8rem;color: #212529;text-transform: uppercase;">{{ $values_data['value'] }}</div>
              <span class="common-color @if($attributes_data['option']['options_required'] == 0) @if($values_data['is_default']) tick-active-new @endif @endif  tick-common-{{ $attributes_data['option']['id'] }} tick-{{$values_data['id']}}"></span>
            </label>
          </li>
        @endforeach
      </ul>

    @endif


    </div>                 
               
               <!--   <div class="attributes col-12 col-md-4 box">
                     <label class="">{{ $attributes_data['option']['name'] }}</label>
                     <div class="select-control">
                     <select name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                       @if(!empty($result['cart']))
                         @php
                           $value_ids = array();
                           foreach($result['cart'][0]->attributes as $values){
                               $value_ids[] = $values->options_values_id;
                           }
                         @endphp
                           @foreach($attributes_data['values'] as $values_data)
                             @if(!empty($result['cart']))
                             <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                             @endif
                           @endforeach
                         @else
                           @foreach($attributes_data['values'] as $values_data)
                             <option @if($values_data['is_default']) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                           @endforeach
                         @endif
                       </select>
                     </div> 
                   </div>              -->    
               
               @endforeach
             </div>
             @endif
        
             @if(!empty($result['detail']['product_data'][0]->flash_start_date))
             <div class="countdown pro-timer" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Countdown Timer')" id="counter_{{$result['detail']['product_data'][0]->products_id}}" >                               
               <span class="days">0<small>@lang('website.Days') </small></span>
               <span class="hours">0<small>@lang('website.Hours')</small></span>
               <span class="mintues">0<small>@lang('website.Minutes')</small></span>
               <span class="seconds">0<small>@lang('website.Seconds')</small></span>
             </div>
             @endif
        
          
          <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>

          @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

              <div class="input-group item-quantity">                    
                  {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}
                  @if($result['detail']['product_data'][0]->products_type == 0)

                  @if($result['commonContent']['settings']['Inventory'] == 0)
                    @if($result['detail']['product_data'][0]->products_max_stock == 0)
                        <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="9999999">    <span class="input-group-btn">
                      @else
                        <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                      @endif
                    @else
                        
                    @if($result['detail']['product_data'][0]->products_max_stock == 0)
                        <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="9999999">    <span class="input-group-btn">
                      @else
                      <input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                    @endif
                    @endif

@elseif($result['detail']['product_data'][0]->products_type == 1)

<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


@elseif($result['detail']['product_data'][0]->products_type == 3 || $result['detail']['product_data'][0]->products_type == 4)
@if($result['commonContent']['settings']['Inventory'])
@if($result['detail']['product_data'][0]->stock_status == 1)
<?php

  $inventory_ref_id = '';
  $products_id = $result['detail']['product_data'][0]->products_id;
  $productsType = DB::table('products')->join('product_combo','product_combo.product_id','=','products.products_id')->where('product_combo.pro_id', $products_id)->get();

  $resattributes = array();
  foreach($productsType as $proCType){
    if($proCType->attractive_id !=0){
      $resattributes[] = $proCType->attractive_id;
    }
  }


  // Normal Product stocks

  $norstocks = array();
  foreach($productsType as $proCType){
    if($proCType->products_type == 0) { 

      $stocksin = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'in')->sum('stock');
      $stockOut = DB::table('inventory')->where('products_id', $proCType->product_id)->where('stock_type', 'out')->sum('stock');
      $norstocks[] = $stocksin - $stockOut;

    }
  }
  $workArray = implode(",", $norstocks);
  $array = explode(',', $workArray);
  $NorStock = min($array);

  // Variable Product stocks

  $stocks = array();
  $VarStock = '';
  foreach($productsType as $proCType){
    $attrcount = DB::table('products_attributes')->where('products_id', $proCType->product_id)->get();
    $acount = count($attrcount);

    if ($proCType->products_type == 1 && $acount > 0) {

      $attributes = array_filter($resattributes);
      $attributeid = implode(',', $attributes);

      $postAttributes = count($attributes);

      $inventories = DB::table('inventory')->where('products_id', $proCType->product_id)->get();
      $reference_ids = array();
      
      $stockIn = 0;
      foreach ($inventories as $inventory) {

          $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id', '=', $inventory->inventory_ref_id)->get();
          $totalAttributes = count($totalAttribute);

          if ($postAttributes > $totalAttributes) {
              $count = $postAttributes;
          } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
              $count = $totalAttributes;
          }


          $individualStock = DB::table('inventory')->leftjoin('inventory_detail', 'inventory_detail.inventory_ref_id', '=', 'inventory.inventory_ref_id')
              ->selectRaw('inventory.*')
              ->whereIn('inventory_detail.attribute_id', [$attributeid])
              ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in (' . $attributeid . ') and `inventory_ref_id`= "' . $inventory->inventory_ref_id . '")'), '=', $count)
              ->where('inventory.inventory_ref_id', '=', $inventory->inventory_ref_id)
              ->groupBy('inventory_detail.inventory_ref_id')
              ->get();

          if (count($individualStock) > 0) {
              $inventory_ref_id = $individualStock[0]->inventory_ref_id;
              $stockIn += $individualStock[0]->stock;
          }
          
      }

      $options_names = array();
      $options_values = array();
      foreach ($resattributes as $attribute) {
          $productsAttributes = DB::table('products_attributes')
              ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
              ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
              ->select('products_attributes.*', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
              ->where('products_attributes_id', $attribute)->get();

          $options_names[] = $productsAttributes[0]->options_name;
          $options_values[] = $productsAttributes[0]->options_values;
      }

      $options_names_count = count($options_names);
      $options_names = implode("','", $options_names);
      $options_names = "'" . $options_names . "'";
      $options_values = "'" . implode("','", $options_values) . "'";
      

      //orders products
      $orders_products = DB::table('orders_products')->where('products_id', $proCType->product_id)->get();
      $stockOut = 0;
      foreach ($orders_products as $orders_product) {
          $totalAttribute = DB::table('orders_products_attributes')->where('orders_products_id', '=', $orders_product->orders_products_id)->get();
          $totalAttributes = count($totalAttribute);

          if ($postAttributes > $totalAttributes) {
              $count = $postAttributes;
          } elseif ($postAttributes < $totalAttributes or $postAttributes == $totalAttributes) {
              $count = $totalAttributes;
          }

          $products = DB::select("select orders_products.* from `orders_products` left join `orders_products_attributes` on `orders_products_attributes`.`orders_products_id` = `orders_products`.`orders_products_id` where `orders_products`.`products_id`='" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and (select count(*) from `orders_products_attributes` where `orders_products_attributes`.`products_id` = '" . $proCType->product_id . "' and `orders_products_attributes`.`products_options` in (" . $options_names . ") and `orders_products_attributes`.`products_options_values` in (" . $options_values . ") and `orders_products_attributes`.`orders_products_id`= '" . $orders_product->orders_products_id . "') = " . $count . " and `orders_products`.`orders_products_id` = '" . $orders_product->orders_products_id . "' group by `orders_products_attributes`.`orders_products_id`");

          if (count($products) > 0) {
              $stockOut += $products[0]->products_quantity;
          }
      }
      $stocks[] = $stockIn - $stockOut;
    } 
  }

  $VarworkArray = implode(",", $stocks);
  $Vararray = explode(',', $VarworkArray);
  $VarStock = min($Vararray);


  if($NorStock >= $VarStock ){
    $totalStock = $VarStock;
  } else if($NorStock <= $VarStock){
    $totalStock = $NorStock;
  } else {
    $totalStock = 1;
  }
?>


<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 

min="@if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 

max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $totalStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $totalStock}}@endif">      <span class="input-group-btn">
@else

<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


@endif
@else

<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="999999">    <span class="input-group-btn">


@endif
@else

<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


@endif

<input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">  
                  <span class="input-group-btn">
                      <button type="button" class="quantity-plus1 btn qtyplus">
                          <i class="fas fa-plus"></i>
                      </button>
                  
                      <button type="button" class="quantity-minus1 btn qtyminus">
                          <i class="fas fa-minus"></i>
                      </button>
                  </span>
                </div>

                @endif



            @if($result['commonContent']['setting'][226]->value == 2)
              <?php
                $res = $result['commonContent']['setting']['227']->value;
                $time = explode('-',$res);
                $startTime = strtotime($time[0]);
                $endTime = strtotime($time[1]);
                $currentTime = time();
              ?>
              @if($currentTime >= $startTime && $currentTime <= $endTime)
                <?php $ck = 0 ?>
              @else
                <?php $ck = 1; ?>
              @endif
            @else
              <?php $ck = 0; ?>
            @endif      

            @if($ck == 0)
              @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

                @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
                  @else
                    @if($result['detail']['product_data'][0]->products_type == 0)
                      @if($result['commonContent']['settings']['Inventory'])
                      @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if($result['detail']['product_data'][0]->defaultStock <= 0)
                          <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>
                          @else
                              <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                          @else
                              <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                      @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                      @elseif($result['detail']['product_data'][0]->products_type == 1)
                          @if($result['commonContent']['settings']['Inventory'])
                          @if($result['detail']['product_data'][0]->stock_status == 0)
                          <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          <div class="stock-out-cart" hidden style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                          <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" data-toggle="modal" data-target="#notifyModal" hidden type="button">@lang('website.notify')</button>
                          @else
                          <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                          @else
                          <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                    @endif
                  @endif

                  @if($result['detail']['product_data'][0]->products_type == 2)
                    <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn-lg swipe-to-top">@lang('website.External Link')</a>
                  @endif

                  @if($result['detail']['product_data'][0]->products_type == 3)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_combo')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }
                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if(in_array('0',$stockarray))

                          <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                    @else

                    <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                    @endif   
                  @endif   

                  @if($result['detail']['product_data'][0]->products_type == 4)

                    <?php
                      $stocks = 0;
                      $stockarray = [];

                      $comboPro = DB::table('product_buy_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboPro as $key=>$comboProd){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProd->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocks = $stocksin - $stockOut;
                          $stockarray[$key] = $stocks;
                          //print_r($stockarray);

                      }

                    $stocksgetx = 0;
                      $stockarraygetx = [];

                      $comboProgetx = DB::table('product_get_x')->where('pro_id', $result['detail']['product_data'][0]->products_id)->get();

                      foreach($comboProgetx as $key=>$comboProdgetx){

                          $stocksin = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'in')->sum('stock');
                          $stockOut = DB::table('inventory')->where('products_id', $comboProdgetx->product_id)->where('stock_type', 'out')->sum('stock');
                          $stocksgetx = $stocksin - $stockOut;
                          $stockarraygetx[$key] = $stocksgetx;
                          //print_r($stockarraygetx);
                      }
                      

                    ?>

                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if((in_array('0',$stockarray)) || (in_array('0',$stockarraygetx)))

                          <div  style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div>
                            <button class="btn btn-lg swipe-to-top  btn-danger " data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                    @else

                    <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                    @endif   
                  @endif 

                  @endif   

@if($result['detail']['product_data'][0]->button_type == 2)
<button type="button" class="btn btn-secondary btn-lg swipe-to-top modal_show3" products_id="{{$result['detail']['product_data'][0]->products_id}}"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
@endif
@if($result['detail']['product_data'][0]->button_type == 4)
<input type="hidden"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="1">

@endif
           
@endif
        
          </div>

          
        </form>

          <div class="pro-sub-buttons">
              <div class="buttons">
                  <button class="btn btn-link is_liked" products_id="<?=$result['detail']['product_data'][0]->products_id?>" style="padding-left: 0;"><i class="fas fa-heart"></i> @lang('website.Add to Wishlist') </button>
                  <button type="button" class="btn btn-link" onclick="myFunction3({{$result['detail']['product_data'][0]->products_id}})"><i class="fas fa-align-right"></i>@lang('website.Add to Compare')</button>
              
              </div>
              <!-- AddToAny BEGIN -->
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_email"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
              
          </div>
        
        </div>
      </div>
        <div class="row">
            <div class="col-12 col-md-12">
              <div class="nav nav-pills" role="tablist">
                <a class="nav-link nav-item  active" href="#description" id="description-tab" data-toggle="pill" role="tab">@lang('website.Descriptions')</a> 
                <a class="nav-link nav-item" href="#review" id="review-tab" data-toggle="pill" role="tab" >@lang('website.Reviews')</a>
              </div> 
              <div class="tab-content pd2">
                <div role="tabpanel" class="tab-pane fade active show" id="description" aria-labelledby="description-tab">
                  <?=stripslashes($result['detail']['product_data'][0]->products_description)?>                        
                </div>  
                
                <div role="tabpanel" class="tab-pane fade " id="review" aria-labelledby="review-tab">
                  <div class="reviews">
                    @if(isset($result['detail']['product_data'][0]->reviewed_customers))
                      <div class="review-bubbles">
                          <h2>
                            @lang('website.Customer Reviews')
                          </h2>                            
                            @foreach($result['detail']['product_data'][0]->reviewed_customers as $key=>$rev)
                            <div class="review-bubble-single">
                                <div class="review-bubble-bg">
                                  <div class="pro-rating">
                                    <fieldset class="disabled-ratings">                                           
                                      <label class = "full fa @if($rev->reviews_rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                                      <label class = "full fa @if($rev->reviews_rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>                                          
                                      <label class = "full fa @if($rev->reviews_rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>                                          
                                      <label class = "full fa @if($rev->reviews_rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>
                                       <label class = "full fa @if($rev->reviews_rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                                    </fieldset>                                          
                                  </div>
                                    <h4>{{$rev->customers_name}}</h4>
                                    <span>{{date("d-M-Y", strtotime($rev->created_at))}}</span>
                                    <p>{{$rev->reviews_text}}</p>
                                </div>
                                
                            </div>
                            @endforeach                            
                      </div>
                      @endif
                      @if(Auth::guard('customer')->check())
                      <div class="write-review">
                        <form id="idForm">
                          {{csrf_field()}}
                          <input value="{{$result['detail']['product_data'][0]->products_id}}" type="hidden" name="products_id">
                        <h2>@lang('website.Write a Review')</h2>
                        <div class="write-review-box">
                            <div class="from-group row mb-3">
                                <div class="col-12"> <label for="inlineFormInputGroup2">@lang('website.Rating')</label></div>
                                <div class="pro-rating col-12">

                                  <fieldset class="ratings">
                                    
                                    <input type="radio" id="star5" name="rating" value="5" class="rating"/>
                                    <label class = "full fa" for="star5" title="@lang('website.awesome_5_stars')"></label>


                                    <input type="radio" id="star4" name="rating" value="4" class="rating"/>
                                    <label class="full fa" for="star4" title="@lang('website.pretty_good_4_stars')"></label>

                                    <input type="radio" id="star3" name="rating" value="3" class="rating"/>
                                    <label class = "full fa" for="star3" title="@lang('website.good_3_stars')"></label>

                                    <input type="radio" id="star2" name="rating" value="2" class="rating"/>
                                    <label class="full fa" for="star2" title="@lang('website.average_2_stars')"></label>

                                    <input type="radio" id="star1" name="rating" value="1" class="rating"/>
                                    <label class = "full fa" for="star1" title="@lang('website.bad_1_stars')"></label> 
                                  
                                </fieldset>                                     
                                    
                                </div>
                            </div>                              
                           
                              <div class="from-group row mb-3">
                                  <div class="col-12"> <label for="inlineFormInputGroup3">@lang('website.Review')</label></div>
                                  <div class="input-group col-12">                                      
                                    <textarea name="reviews_text" id="reviews_text" class="form-control" id="inlineFormInputGroup3" placeholder="@lang('website.Write Your Review')"></textarea>
                                  </div>
                              </div>

                              <div class="alert alert-danger" hidden id="review-error" role="alert">
                               @lang('website.Please enter your review')
                              </div>

                              <div class="from-group">
                                  <button type="submit" id="review_button" disabled class="btn btn-secondary swipe-to-top">@lang('website.Submit')</button>                                    
                              </div>
                        </div>
                        
                      </form>
                      </div>
                      @endif
                  </div>

                    
                </div> 
            </div>
        </div>      
    
      </div>

    </div>

      <div class="col-12 col-lg-2">
        <div class="banner-full bg-banner-content">
            <div class="row">
              @foreach(($result['shoppinginfo']) as $info)
                @if($info->type==1)
                  <div class="col-12 ">
                    <div class="banner-single">
                      <div class="panel">
                        <h3 class="fas fa-truck"></h3>
                        <div class="block">
                          <h4 class="title">{{$info->shopping_info_name}}</h4>
                          <p>{{$info->shopping_info_description}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
              @foreach(($result['shoppinginfo']) as $info)
                @if($info->type==2)
              <div class="col-12 ">
                  <div class="banner-single">
                    <div class="panel">
                      <h3 class="fas fa-money-bill-alt"></h3>
                      <div class="block">
                          <h4 class="title">{{$info->shopping_info_name}}</h4>
                          <p>{{$info->shopping_info_description}}</p>
                      </div>
                  </div>
                  </div>
              </div>
              @endif
              @endforeach
              @foreach(($result['shoppinginfo']) as $info)
                @if($info->type==3)
              <div class="col-12">
                <div class="banner-single">
                  <div class="panel">
                    <h3 class="fas fa-life-ring"></h3>
                    <div class="block">
                    <h4 class="title">{{$info->shopping_info_name}}</h4>
                          <p>{{$info->shopping_info_description}}</p>
                    </div>
                </div>
                </div>
              </div>
              @endif
              @endforeach
              @foreach(($result['shoppinginfo']) as $info)
                @if($info->type==4)
                <div class="col-12">
                  <div class="banner-single last">
                    <div class="panel">
                      <h3 class="fas fa-credit-card"></h3>
                      <div class="block">
                      <h4 class="title">{{$info->shopping_info_name}}</h4>
                          <p>{{$info->shopping_info_description}}</p>
                      </div>
                    </div>
                  </div>
                </div> 
                @endif
              @endforeach
            </div>             
          </div>
    </div>

  </div>
    </div>
  </div>
</div>
</div>
</div>
</section>


<section class="product-content pro-content">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="pro-heading-title">
                <h2> @lang('website.Related Products')
                </h2>
               <!--  <p> 
                  @lang('website.Related Products Text') -->
                </div>
          </div>
    
        </div>
  </div>
  <div class="general-product">
    <div class="container p-0">
        <div class="product-carousel-js">      
              @foreach($result['simliar_products']['product_data'] as $key=>$products)
                @if($result['detail']['product_data'][0]->products_id != $products->products_id)                     
                <div class="slik">
                  @include('web.common.product')
                </div>  
                @endif
                @endforeach  
          </div>  
    </div>
  </div>  
</section>  @else
<div class="col-12">
<div class="container">
<h3>@lang('website.No Record Found!')</h3>
</div>
</div>
@endif
  <script>

jQuery(document).ready(function(e) {
$(".slick-arrow").click(function(){
  $('iframe').each(function(index) {
   $(this).attr('src', $(this).attr('src'));
  
 });
 
});

});

function pauseVideo() {
 
 // changes the iframe src to prevent playback or stop the video playback in our case
 $('iframe').each(function(index) {
   $(this).attr('src', $(this).attr('src'));
   
 });
 
//click function


   }

   function convertTZ(date, tzString) {
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
}


    jQuery(document).ready(function(e) {
    
      @if(!empty($result['detail']['product_data'][0]->flash_start_date))
         @if( date("Y-m-d",$result['detail']['product_data'][0]->server_time) >= date("Y-m-d",$result['detail']['product_data'][0]->flash_start_date))
          var product_div_{{$result['detail']['product_data'][0]->products_id}} = 'product_div_{{$result['detail']['product_data'][0]->products_id}}';
        var  counter_id_{{$result['detail']['product_data'][0]->products_id}} = 'counter_{{$result['detail']['product_data'][0]->products_id}}';
        var inputTime_{{$result['detail']['product_data'][0]->products_id}} = "{{date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)}}";
    
        // Set the date we're counting down to
        var countDownDate_{{$result['detail']['product_data'][0]->products_id}} = new Date(inputTime_{{$result['detail']['product_data'][0]->products_id}}).getTime();
    
        // Update the count down every 1 second
        var x_{{$result['detail']['product_data'][0]->products_id}} = setInterval(function() {
    
          var new_now = convertTZ(new Date(), "Asia/Kuala_Lumpur");
   // Get todays date and time
   var now = new_now.getTime();
    
          // Find the distance between now and the count down date
          var distance_{{$result['detail']['product_data'][0]->products_id}} = countDownDate_{{$result['detail']['product_data'][0]->products_id}} - now;
    
          // Time calculations for days, hours, minutes and seconds
          var days_{{$result['detail']['product_data'][0]->products_id}} = Math.floor(distance_{{$result['detail']['product_data'][0]->products_id}} / (1000 * 60 * 60 * 24));
          var hours_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60 * 60)) / (1000 * 60));
          var seconds_{{$result['detail']['product_data'][0]->products_id}} = Math.floor((distance_{{$result['detail']['product_data'][0]->products_id}} % (1000 * 60)) / 1000);
          var days_text = "@lang('website.Days')";
          // Display the result in the element with id="demo"
          document.getElementById(counter_id_{{$result['detail']['product_data'][0]->products_id}}).innerHTML = "<span class='days'>"+days_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Days')</small></span> <span class='hours'>" + hours_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Hours')</small></span> <span class='mintues'> "
          + minutes_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Minutes')</small></span> <span class='seconds'>" + seconds_{{$result['detail']['product_data'][0]->products_id}} + "<small>@lang('website.Seconds')</small></span> ";
    
          // If the count down is finished, write some text
          if (distance_{{$result['detail']['product_data'][0]->products_id}} < 0) {
          clearInterval(x_{{$result['detail']['product_data'][0]->products_id}});
          //document.getElementById(counter_id_{{$result['detail']['product_data'][0]->products_id}}).innerHTML = "EXPIRED";
          document.getElementById('product_div_{{$result['detail']['product_data'][0]->products_id}}').remove();
          }
        }, 1000);
           @endif
       @endif
    
  
    });
    </script>
