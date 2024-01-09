<style>
  .fancybox-thumbs__list a {
    background-size: contain !important;
}
 
  .detail7 .slick-slide {
margin: 10px !important;
}


@media (max-width: 768px)
{
.prd-block_actions .btn.btn--add-to-cart, .prd-block_actions .btn--buy-now, .prd-block_actions .btn--add-to-wishlist, .prd-block_actions .btn--add-to-compare, .prd-block_actions .btn--follow {
    height: 62px !important;
}
}
@media (max-width: 480px)
{
.input-group .qty {
    height: 47px !important;
}

.item-quantity .input-group-btn .button_plus_new {
    height: 24px !important;
}
.prd-block_actions .btn.btn--add-to-cart, .prd-block_actions .btn--buy-now, .prd-block_actions .btn--add-to-wishlist, .prd-block_actions .btn--add-to-compare, .prd-block_actions .btn--follow {
    height: 47px !important;
}
}

</style>

@include('web.details.partials.modals') 
<?php
  $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
        $decimal_places = count($currency) > 0 ? $currency[0] : 2;
?>

<div class="page-content" style="background:#fff">
	<div class="holder breadcrumbs-wrap mt-0">
	<div class="container">
		<ul class="breadcrumbs">
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
		</ul>
	</div>
</div>
<meta property="og:title" content="{{$result['detail']['product_data'][0]->products_name}}" />
<meta property="og:image" content="{{asset($result['detail']['product_data'][0]->default_images) }}" />


<div class="holder product-page">
	<div class="container js-prd-gallery" id="prdGallery">
		<div class="row prd-block prd-block--prv-bottom prd-block--prv-double">
			<div class="col-12-r col-md-8-r col-lg-8-r aside--sticky js-sticky-collision">
				<div class="aside-content">
					<!-- Product Gallery -->
					<div class="mb-2 js-prd-m-holder"></div>
					<div class="prd-block_main-image">
						<div class="prd-block_main-image-holder" id="prdMainImage">
							<div class="product-main-carousel js-product-main-carousel" data-zoom-position="inner">
								<div data-value="Beige"><span class="prd-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($result['detail']['product_data'][0]->default_images) }}" class="lazyload fade-up elzoom" alt="" data-zoom-image="{{asset($result['detail']['product_data'][0]->default_images) }}"/></span></div>
								@foreach( $result['detail']['product_data'][0]->images as $key=>$images )
									@if($images->image_type == 'ACTUAL')
									<div data-value="Beige"><span class="prd-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($images->image_path) }}" class="lazyload fade-up elzoom" alt="" data-zoom-image="{{asset($images->image_path) }}"/></span></div>
									
									@endif
								@endforeach
							</div>
						</div>
						<div class="prd-block_main-image-links">

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
							<a data-fancybox data-width="900" href="{{ $video->video_link }}" class="prd-block_video-link"><i class="icon-video"></i></a>

							
							<?php }} ?>



							
							<a href="{{asset($result['detail']['product_data'][0]->default_images) }}" class="prd-block_zoom-link"><i class="icon-zoom-in"></i></a>
						</div>
					</div>
					<div class="product-previews-wrapper" style="margin-top:50px;">
						<div class="product-previews-carousel js-product-previews-carousel" data-desktop="5" data-tablet="3">
							<a href="#" data-value="Beige"><span class="prd-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($result['detail']['product_data'][0]->default_images) }}" class="lazyload fade-up" alt=""/></span></a>
							@foreach( $result['detail']['product_data'][0]->images as $key=>$images ) 
								@if($images->image_type == 'THUMBNAIL')
									<a href="#" data-value="Beige"><span class="prd-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($images->image_path) }}" class="lazyload fade-up" alt=""/></span></a>
								@endif
							@endforeach
						</div>
					</div>
					<!-- /Product Gallery -->
				</div>
			</div>
			<div class="col-12-r col-md-10-r col-lg-10-r mt-1 mt-md-0">

			<div class="row">
              <div class="col-12 col-md-12">
                <div class="badges">

                  <?php 
                  //dd($result['detail']['product_data'][0]->flash_start_date);
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

              <div class="pro-rating">
            <fieldset class="disabled-ratings">  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>    
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>                                       
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
                                                   
                                                       
               
               
      </fieldset>                                        
              <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="" style="text-decoration:underline;margin-left: 10px;">( {{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') ) </a>
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
            //  dd($result['currency_value']);
            ?>
            @if(!empty($result['detail']['product_data'][0]->flash_price))
            <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}}{{$flash_price}}{{Session::get('symbol_right')}}</price>
            <span>{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 

            @elseif(!empty($result['detail']['product_data'][0]->discount_price))
            <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price}}{{Session::get('symbol_right')}}</price>
            <span id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price,$decimal_places)}}{{Session::get('symbol_right')}} </span> 
            @else
            
            <price class="total_price" id="total_dis_price">{{Session::get('symbol_left')}} {{ number_format($orignal_price,$decimal_places) }} {{Session::get('symbol_right')}}</price>
            @endif
                               
            </div>


            <div class="prd-block_info-box prd-block_info_item">
  
 
  <div class="two-column">
      <p>@lang('website.Product ID'):
    <span class="prd-in-stock" data-stock-status="">{{$result['detail']['product_data'][0]->products_id}}</span></p>
        <p>@lang('website.Categroy'):
    <span class="prd-in-stock" data-stock-status=""> <?php
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
                
          </span></p>
          <p>@lang('website.Available'):
          @if($result['detail']['product_data'][0]->products_type == 0)
            
            @if($result['commonContent']['settings']['Inventory'])
            @if($result['detail']['product_data'][0]->stock_status == 1)
              @if($result['commonContent']['settings']['stock_availability'] == 1)
                  <span class="prd-in-stock">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
              @else
                @if($result['detail']['product_data'][0]->defaultStock < 0)
                  <span class="prd-in-stock" data-stock-status="">@lang('website.Out of Stock')</span>
                @else
                  <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>
                @endif
              @endif
            @else 
              <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>    
            @endif
            @else 
              <span class="prd-in-stock" data-stock-status="">@lang('website.In stock')</span>    
            @endif
          @endif

          @if($result['detail']['product_data'][0]->products_type == 1)
          
            @if($result['commonContent']['settings']['Inventory'])
            @if($result['detail']['product_data'][0]->stock_status == 1)
              @if($result['commonContent']['settings']['stock_availability'] == 1)
                <span class="prd-in-stock" id="variable-count"></span>
              @else
                <span class="prd-in-stock" id="variable-status"></span>  
              @endif
              @else
                <span class="prd-in-stock" id="variable-status"></span>  
              @endif
          @endif
          @endif

              @if($result['detail']['product_data'][0]->products_type == 2)
              <span class="prd-in-stock" data-stock-status="">@lang('website.External Link')</span>
              @endif
    </p>
  
    @if($result['detail']['product_data'][0]->products_min_order>0)
    <p class="prd-taxes">@lang('website.Min Order Limit'):
      <span>{{$result['detail']['product_data'][0]->products_min_order}}</span>
    </p>
    @endif
    @if($result['detail']['product_data'][0]->products_max_stock != 9999)
    <p class="prd-taxes">@lang('website.Max Order Limit'):
      <span>{{$result['detail']['product_data'][0]->products_max_stock}}</span>
    </p>
    @endif
  <!-- 	<p>Collection: <span> <a href="collections.html" data-toggle="tooltip" data-placement="top" data-original-title="View all">Women</a></span></p>
    <p>Sku: <span data-sku="">FOXic-45812</span></p>
    <p>Vendor: <span>Banita</span></p>
    <p>Barcode: <span>314363563</span></p> -->
  </div>
  </div>

  
	<div class="order-0 order-md-100">
	
			<div class="prd-block_options prd-block">
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
          <div class="">
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

<!-- 
			<div class="prd-size swatches" style="padding-top:30px;">
					<div class="option-label">{{ $attributes_data['option']['name'] }}:</div>
					<select style="display:none;" name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="form-control hidden single-option-selector-modalQuickView currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}"  id="SingleOptionSelector-<?=$index?>" data-index="option<?=$index?>">
					@if(!empty($result['cart']))
						@php
							$value_ids = array();
							foreach($result['cart'][0]->attributes as $values){
								$value_ids[] = $values->options_values_id;
							}
						@endphp
							@foreach($attributes_data['values'] as $values_data)
							@if(!empty($result['cart']))
							
							<option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}">{{ $values_data['value'] }}</option>
							@endif
							@endforeach
						@else
						
							@foreach($attributes_data['values'] as $values_data)
							<option @if($values_data['is_default']) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}">{{ $values_data['value'] }}</option>
							
							@endforeach
						@endif

						
					</select>
					<ul class="size-list js-size-list" data-select-id="SingleOptionSelector-<?=$index?>">

					@if(!empty($result['cart']))
						@php
							$value_ids = array();
							foreach($result['cart'][0]->attributes as $values){
								$value_ids[] = $values->options_values_id;
							}
						@endphp
							@foreach($attributes_data['values'] as $values_data)
							@if(!empty($result['cart']))
							
							<li class="@if(in_array($values_data['id'],$value_ids)) active  @endif var-<?=$index?>" ><a href="#" data-value="{{ $values_data['id'] }}"><span class="value" >{{ $values_data['value'] }}</span></a></li>

							
							@endif
							@endforeach
						@else
						
							@foreach($attributes_data['values'] as $values_data) 
							<li class="@if($values_data['is_default']) active @endif var-<?=$index?>" ><a href="#" data-value="{{ $values_data['id'] }}"><span class="value">{{ $values_data['value'] }}</span></a></li>

							
							@endforeach
						@endif
				
					</ul>
				</div>
 -->


            
			  @endforeach
          @endif
						</div>
        
  

         @if(!empty($result['detail']['product_data'][0]->flash_start_date))
          <div class="countdown pro-timer" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Countdown Timer')" id="counter_{{$result['detail']['product_data'][0]->products_id}}" >                               
            <span class="days">0<small>@lang('website.Days') </small></span>
            <span class="hours">0<small>@lang('website.Hours')</small></span>
            <span class="mintues">0<small>@lang('website.Minutes')</small></span>
            <span class="seconds">0<small>@lang('website.Seconds')</small></span>
          </div>
          @endif
          <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>

          <div class="prd-block_actions prd-block_actions--wishlist">
				<div class="" style="margin-right: 25px;margin-top: 22px;">
					<div class="">

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


<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="99999999">    <span class="input-group-btn">


                  @endif

                  @else


<input type="text" style="background: #f7f7f8;" readonly name="quantity" class="form-control qty type_one" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">


                  @endif

                  <input type="hidden" id="max_stock_one" value="{{$result['detail']['product_data'][0]->products_max_stock}}">


                  
                      <button type="button" class="quantity-plus1 qtyplus button_plus_new" >
                          <i class="fa fa-plus"></i>
                      </button>
                  
                      <button type="button" class=" quantity-minus1 button_minus_new  qtyminus" >
                          <i class="fa fa-minus"></i>
                      </button>
                  </span>
                </div>
					</div>
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
				<div class="btn-wrap">
					        
         
        @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)
         

        @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
                  @else
                    @if($result['detail']['product_data'][0]->products_type == 0)
                    
                      @if($result['commonContent']['settings']['Inventory'])
                      @if($result['detail']['product_data'][0]->stock_status == 1)
                          @if($result['detail']['product_data'][0]->defaultStock <= 0)
                        
                            <button class="btn btn-lg swipe-to-top  btn-danger btn--add-to-cart" data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>
                          @else
                              <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart btn--add-to-cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                      @else
                      <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif
                      @else
                      <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                      @endif

                      @elseif($result['detail']['product_data'][0]->products_type == 1)
                          @if($result['commonContent']['settings']['Inventory'])
                          @if($result['detail']['product_data'][0]->stock_status == 0)
                          <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                         <!--  <div class="stock-out-cart" hidden style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> -->
                          <button class="btn btn-danger btn--add-to-cart btn btn-lg swipe-to-top  stock-out-cart" data-toggle="modal" data-target="#notifyModal" hidden type="button">@lang('website.notify')</button>
                          @else
                          <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif 
                          @else
                          <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top  add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                          @endif
                    @endif
                  @endif

                  @if($result['detail']['product_data'][0]->products_type == 2)
                    <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top">@lang('website.External Link')</a>
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

                          <button class="btn btn-lg swipe-to-top  btn-danger btn--add-to-cart" data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart btn--add-to-cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart btn--add-to-cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                    @else

                    <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

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

                          <button class="btn btn-lg swipe-to-top  btn-danger btn--add-to-cart" data-toggle="modal" data-target="#notifyModal" type="button">@lang('website.notify')</button>

                        @else

                        <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart btn--add-to-cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                        @endif
                        @else

<button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart btn--add-to-cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

@endif
                    @else

                    <button class="btn btn-secondary btn--add-to-cart btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                    @endif   
                  @endif  


                   @endif   

          @if($result['detail']['product_data'][0]->button_type == 2)
          <button type="button" class="btn btn-secondary btn-lg swipe-to-top modal_show3" products_id="{{$result['detail']['product_data'][0]->products_id}}"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
          @endif
          @if($result['detail']['product_data'][0]->button_type == 4)
          <input type="hidden"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="1">
          @endif
        

          
				</div>

      @endif
      
				<div class="btn-wishlist-wrap">

     

				@if($result['detail']['product_data'][0]->isLiked==1)
												<a id="wishlist-shop{{$result['detail']['product_data'][0]->products_id}}" products_id="<?=$result['detail']['product_data'][0]->products_id?>" class="wishlist-shop circle-label-compare is_liked mt-0 common-text btn-add-to-wishlist ml-auto" title="Remove From Wishlist"><i class="icon-heart-stroke"></i></a>
                                                @else

												<a products_id="<?=$result['detail']['product_data'][0]->products_id?>" id="wishlist-shop-enable{{$result['detail']['product_data'][0]->products_id}}" class="wishlist-shop-enable circle-label-compare icon active swipe-to-top is_liked mt-0 btn-add-to-wishlist ml-auto" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a>


												<a id="wishlist-shop-hidden{{$result['detail']['product_data'][0]->products_id}}" products_id="<?=$result['detail']['product_data'][0]->products_id?>" class="wishlist-shop-hidden common-text btn-add-to-wishlist ml-auto circle-label-compare is_liked  mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                                @endif
          
				<!-- 	<a href="#" class="btn-add-to-wishlist ml-auto btn-add-to-wishlist--add js-add-wishlist" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a>
					<a href="#" class="btn-add-to-wishlist ml-auto btn-add-to-wishlist--off js-remove-wishlist" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a> -->
				</div>
			</div>

      @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)         

                  
      @if($result['detail']['product_data'][0]->products_type == 0)
                    
                    @if($result['commonContent']['settings']['Inventory'])
                    @if($result['detail']['product_data'][0]->stock_status == 1)
                        @if($result['detail']['product_data'][0]->defaultStock <= 0)
                        <div  style="margin-bottom:15px;margin-top: 15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> 
                          
                        @endif
                  
                    @endif
                    @endif

                  @elseif($result['detail']['product_data'][0]->products_type == 1)
                        @if($result['commonContent']['settings']['Inventory'])
                        @if($result['detail']['product_data'][0]->stock_status == 1)

                        <div class="stock-out-cart" hidden  style="margin-bottom:15px;margin-top: 15px;"><span style="color:red;">OUT OF STOCK  </span> NOTIFY ME WHEN IT BECOMES AVAILABLE</div> 
                       
                        @endif
                        @endif
                  @endif
              

                  @endif
                          
    
          
        </form>

          <div class="pro-sub-buttons">
             
              <!-- AddToAny BEGIN -->
            
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
              
          </div>
          
          </div>
        </div>
        </div>
        </div>
 

      </div>
    </div>
  </div>


  <div class="container" style="margin-top:50px">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Description
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body" style="padding:15px;">
        <?=stripslashes($result['detail']['product_data'][0]->products_description)?>  
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Reviews
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body" style="padding:15px;">
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



			</div>


		</div>
	</div>
</div>


</div>
</div>




<section class="product-content pro-content relative-product">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="pro-heading-title">
                <h2> @lang('website.Related Products')
                </h2>
                <!-- <p> 
                  @lang('website.Related Products Text') -->
                </div>
          </div>
    
        </div>
  </div>
  <div class="general-product detail7">
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


  </section>




<style>
  .product-previews-carousel img {
   
    margin-bottom: 20px;
}

#stickyHeader {
    z-index: 160 !important;
}


.breadcrumbs li:after {
    font-family: 'icon-foxic';
    font-size: 8px;
    line-height: 20px;
    position: relative;
    margin-right: -8px;
    padding-right: 12px;
    padding-left: 8px;
    content: '\e919' !important;
    vertical-align: bottom;
    color: #2e343f;
}

.breadcrumb-item + .breadcrumb-item::before {
    display: inline-block;
    padding-right: 0.5rem;
    color: #6c757d;
    content: unset !important;
}


	.pro-content .slick-next::before {
    margin-bottom: 5px;
    font-family: "icon-foxic"; 
    line-height: 36px;
    font-size: 30px;
    opacity: 1;
}
.pro-content .slick-prev::before {
    margin-bottom: 5px;
    font-family: "icon-foxic";
    line-height: 36px;
    font-size: 30px;
    opacity: 1;
}

.btn-add-to-wishlist:hover [class*='fa-heart-o'] {
    transform: scaleX(-1);
}

.btn-add-to-wishlist:hover [class*='fa-heart-o'] {
    transition: .2s;
}


.panel-default>.panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus {
    color: yiq-color(#28B293) !important;
    outline: none;
    box-shadow: none;
    background: #e8e8e8 !important;
}

.panel-default>.panel-heading a {
  display: block;
  padding: 17px 15px;
}
.panel-default
{
  background-color: #fff;
}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: bold;
  font-size: 30px;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #fff;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.panel-default .panel-title {
    font-size: 20px;
    line-height: 24px;
    margin-bottom: 0;
    border-bottom: solid 1px #f0f0f0;
}
.product-page .pro-rating {
    margin-top: 20px;
}
.product-page h5 {
    padding: 0 0 10px 0 !important; 
}
.prd-block_reviews a {
    text-decoration: underline;
}
.pro-title {
    font-size: 23px;
    font-weight: 600;
    line-height: 32px;
    margin-bottom: 0;
    color: #2e343f;
}
.prd-block_info > *:not([class*=' order-']) {
    -ms-flex-order: 100;
    order: 100;
}

.prd-block_info-box {
    font-size: 15px;
    line-height: 20px;
    display: -ms-flexbox;
    display: flex;
    padding: 21px 30px 11px;
    color: #2e343f;
    background-color: #f7f7f8;
}
.prd-block_info_item {
    margin-top: 20px;
}
.prd-block_info-box .two-column {
    column-count: 2;
    column-gap: 20px;
}
.prd-block_info-box .two-column p {
    display: inline-block;
    min-width: 100%;
}
.page-content p:first-child, .modal-content p:first-child {
    margin-top: 0;
}

.prd-block_info-box p {
    margin: 0 0 10px;
}
.prd-block_info-box span {
    font-weight: 600;
}
.prd-block_actions--wishlist.prd-block_actions {
    margin-right: -5px;
    margin-left: -5px;
}

.prd-block_actions:not(.prd-block_info_item) {
    margin-top: 5px;
}
.prd-block_actions {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}

.prd-block_actions .btn-wrap {
    display: -ms-flexbox;
    display: flex;
    margin: 5px -10px 0;
    -ms-flex: 1;
    flex: 1;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: 20px;
}

.prd-block_actions .btn-wrap .btn {
   width: 100%;
}

.btn-wishlist-wrap {
    display: -ms-flexbox;
    display: flex;
    height: 60px;
    margin-top: 10px;
    margin-left: 10px;
}
.item-quantity {
    width: 100px;
    height: 44px;
}
.item-quantity .input-group-btn {
    float: left;
    width: 30px;
}
.item-quantity .input-group-btn .button_plus_new {
    height: 20px;
    font-size: 10px;
    background: #f7f7f8;
}

.item-quantity .input-group-btn button {
    display: block;
    height: 21px;
    padding: 0 10px;
    font-size: 10px;
    border: 1px solid #f7f7f8;
}
.item-quantity .input-group-btn .button_minus_new {
    height: 20px;
    font-size: 10px;
    background: #f7f7f8;
}

.btn-add-to-wishlist {
    font-size: 26px;
    display: -ms-flexbox;
    display: flex;
    width: 50px;
    margin-left: auto;
    padding: 10px;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
}

.prd-block_options .swatches {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}
.prd-block .prd-block_qty .option-label, .prd-block_options .option-label, .prd-total .option-label {
    font-size: 16px;
    font-weight: 600;
    line-height: 22px;
    min-width: 85px;
    padding-right: 10px;
    color: #2e343f;
}
.prd-block_options select.form-control {
    margin-bottom: 0;
}

.prd-block .form-control, .prd-block .form-control:focus {
    color: #2e343f;
    border-width: 1px;
    border-style: solid;
    outline: 0 none;
    background-color: #f7f7f8;
    box-shadow: none !important;
}
.prd-block .form-control {
    font-size: 15px;
    font-weight: 300;
    line-height: 21px;
    height: 33px;
    padding: 20px 20px 20px;
    color: #2e343f;
    border-color: transparent;
    border-radius: 0;
    background-color: #f7f7f8;
    box-shadow: none !important;
}
select option:not([disabled]) {
    color: #2e343f;
}

.prd-block .size-list {
    display: -ms-flexbox;
    display: flex;
    margin: -5px 0 0;
    padding: 0;
    list-style: none;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.prd-block .size-list li {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    margin: 5px 7px 0 0;
    vertical-align: bottom;
    -ms-flex-pack: center;
    justify-content: center;
}
.prd-block .size-list li {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    margin: 5px 7px 0 0;
    vertical-align: bottom;
    -ms-flex-pack: center;
    justify-content: center;
}
.prd-block .size-list li.active span.value, .prd-block .size-list li:hover:not(.absent-option) span.value {
    color: #fff;
    background-color: #2e343f;
}
.prd-block .size-list li span.value {
    font-size: 14px;
    font-weight: 500;
    line-height: 33px;
    display: inline-block;
    min-width: 33px;
    height: 33px;
    padding: 0 5px;
    text-align: center;
    color: #2e343f;
    border-radius: 4px;
    background-color: transparent;
}

.fancybox-iframe, .fancybox-video {
    background: transparent;
    border: 0;
    display: block;
    height: 100% !important;
    margin: 0;
    overflow: hidden;
    padding: 0;
    width: 100% !important;
}
.slick-slide {
    padding: 0 !important; 
}
.pro-content .product {
    padding: 10px !important; 
}
.pro-content .product2 {

    padding: 10px !important; 
}
.fa-plus {
    color: black !important;
}
.fa-minus {
    color: black !important;
}

.col-lg-8-r {
    -ms-flex: 0 0 44.444444%;
    flex: 0 0 44.444444%;
    max-width: 44.444444%;
}
.col-md-8-r {
    -ms-flex: 0 0 44.444444%;
    flex: 0 0 44.444444%;
    max-width: 44.444444%;
}

.col-lg-10-r {
    -ms-flex: 0 0 55.555556%;
    flex: 0 0 55.555556%;
    max-width: 55.555556%;
}

.col-md-10-r {
    -ms-flex: 0 0 55.555556%;
    flex: 0 0 55.555556%;
    max-width: 55.555556%;
}

.col-lg-8-r, .col-md-8-r, .col-lg-10-r, .col-md-10-r,.col-12-r {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}



.star-rating input[type='radio'] + label {
    font-size: 30px;
    font-weight: normal;
    line-height: 1.903em;
    position: unset; 
    min-width: 100px;
    margin: 0 0 4px 0;
    padding-left: 30px;
    outline: none !important;
}

.star-rating {
  display:flex;
  flex-direction: row-reverse;
  justify-content:space-around;
  text-align:center;
  width:400px;
  padding-left: 20px;
}

.star-rating input {
  display:none;
}
.fa.fa-facebook-f {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-twitter {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-google {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-linkedin {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-instagram {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-facebook {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-whatsapp {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa.fa-telegram {
    font-family: "Font Awesome 5 Brands" !important;
    font-weight: 400;
}
.fa, .fas {
    font-family: "Font Awesome 5 Free" !important;
    font-weight: 900;
}

.star-rating label {
  color:#ccc;
  cursor:pointer;
}

.star-rating :checked ~ label {
  color:#fd5397;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color:#fd5397;
}

/* explanation */
.input-group .qty {
    height: 60px !important;
}

button:focus {
    outline: none !important;
}

.item-quantity .input-group-btn .button_plus_new
{
	height: 30px;
    font-size: 16px;
    background: #f7f7f8;
}

.item-quantity .input-group-btn .button_minus_new
{
	height: 30px;
    font-size: 16px;
    background: #f7f7f8;
}
@media (max-width: 767px)
{
	.item-quantity .input-group-btn .button_plus_new
{
	height: 23px !important;
	font-size: 10px !important;
}
.input-group .qty {
     height: 48px !important; 
}
.item-quantity .input-group-btn .button_minus_new
{
	height: 24px !important;
    font-size: 10px !important;
   
}
}
@media (max-width: 575px)
{
.product-previews-carousel img {
    height: 45px;
}
.col-12-r {
    flex: 0 0 100%;
    max-width: 100%;
}
.product-previews-carousel img {
    width: 100%;
    padding: 0;
    height: 100%;
    margin-bottom: 20px;
}

}
</style>



	<link href="{{asset('web/remembirdme/css/vendor/vendor.min.css')}}" rel="stylesheet">
	<link href="{{asset('web/remembirdme/css/vendor/jquery.fancybox.min.css')}}" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="{{asset('web/remembirdme/css/style-lingeries.css')}}" rel="stylesheet">
	<!-- Custom font -->
	<link href="{{asset('web/remembirdme/fonts/icomoon/icons.css')}}" rel="stylesheet">

 

<script src="{!! asset('web/remembirdme/js/vendor-special/lazysizes.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor-special/ls.bgset.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor-special/ls.aspectratio.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor-special/jquery.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor-special/isotope.pkgd.min.js') !!}"></script>

<script src="{!! asset('web/remembirdme/js/vendor-special/jquery.ez-plus.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor-special/instafeed.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor/vendor.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/vendor/jquery.fancybox.min.js') !!}"></script>
<script src="{!! asset('web/remembirdme/js/app-html.js') !!}"></script>
<script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('web/js/lazy/jquery.lazy.plugins.min.js') !!}"></script> 

  <script>
   
   $('.btn-close-search-mobile').hide();
   $('.search-mobile-40-click-hide').hide();
   $('.search-fixed-outer-40-n').hide();
 
   $('.search-mobile-40-click-hide').click(function(){
     $('.main-con-fixed-outer').hide();
     $('.search-fixed-outer-40-n').show();
     $('.btn-close-search-mobile-40-n').show();
     alert('ok');
   });
 
   $('.btn-close-search-mobile-40-n').click(function(){
     $('.main-con-fixed-outer').show();
     $('.search-fixed-outer-40-n').hide();
   });
 
   $(window).scroll(function () {
   console.log($(window).scrollTop())
   if ($(window).scrollTop() > 200) {
     $('#headerMobile40').addClass('navbar-fixed-40');
     $('.search-mobile-40-click-hide').show();
     $('.search-fixed-outer-40').hide();
     
    
   }
   if ($(window).scrollTop() < 201) {
     $('#headerMobile40').removeClass('navbar-fixed-40');
     $('.search-mobile-40-click-hide').hide();
     $('.search-fixed-outer-40').show();
     $('.search-fixed-outer-40-n').hide();
     $('.main-con-fixed-outer').show();
     
 
   }
 });
 
 // Prepend back button to sub menu(s)
 function getloadpage_40($link)
 {
   window.location.href = $link; 
 }
 
 // Close out sub menu
 $('.sub__close_40').click(function(e) {
   e.preventDefault();
   $(this).parent().parent().removeClass('is-active_40');
 });
 
 // Trigger sub menu
 $('.nav__link_40').click(function(e) {
   e.preventDefault();
   $(this).siblings().addClass('is-active_40');
 });
  /*  */
   $('#toggle40').click(function(){
   $(this).toggleClass('on');
   
   $('#menu-40').slideToggle();
   if(this.className == 'on')
   {
   $('.cart-40-mobile').hide();
   }
   else
   {
     $('.cart-40-mobile').show(); 
   }
 });
 
 $('.btn-close-search-mobile').click(function(){
     $('.btn-close-search-mobile').hide();
   });
 
 
 </script>
 
   <script>
 
 $('.btn-close-search-40').hide();
 $('.btn-close-search-40').click(function(){
     $('.btn-close-search-40').hide();
     $("#search-width-hide").addClass("search-field-module-width-show");
     $("#search-width-hide").removeClass("search-field-module-width-hide");
   });
 
   $('.cart-click-hide').hide();
   $('.cart-click-show').show();
   
   $(".header-40-cart-close").click(function(){
     $('.cart-click-hide').show();
     $('.cart-click-show').hide();
   });
 
   $(".header-40-close-cart").click(function(){
     $('.cart-click-hide').hide();
     $('.cart-click-show').show();
   });
 
 
 
  
 
 </script>
 
  <script>
  $(function() {
        $('.lazy_img_load').Lazy();
    });
    var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
  </script>
  

  <script>
    

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
	

    
    