<script>

$('.product-img--main')
        // tile mouse actions
        .on('mouseover', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
        })
        .on('mouseout', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale(1)'});
        })
        .on('mousemove', function(e){
          $(this).children('.product-img--main__image').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
        })
        // tiles set up
        .each(function(){
          $(this)
            // add a image container
            .append('<div class="product-img--main__image"></div>')
            // set up a background image for each tile based on data-image attribute
            .children('.product-img--main__image').css({'background-image': 'url('+ $(this).attr('src') +')'});
        });

// Product SLICK
jQuery('.slider-for-detail').slick({
  slidesToShow: 1,
  slidesToScroll:1,
  arrows: false,
  infinite: false,
  draggable: false,
  fade: true,
asNavFor: '.slider-nav-detail',
adaptiveHeight: true
});
jQuery('.slider-nav-detail').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for-detail',
  centerMode: true,
  centerPadding: '0px',
  dots: false,
  arrows: false,
  focusOnSelect: true
});
</script>

<style>

/* .modal-5-pro-title-outer {
padding-bottom: 30px !important;
margin-bottom:30px;
height: 100px;
overflow-y: auto;
overflow-x: hidden;
} */

  .stmodal{
  fill:#777;
}


  .modalwh{
    width:50% !important;
    height:40px !important;
  }
.product-img--main {
   position: relative;
  overflow: hidden;
  /* margin-bottom: 30px; */
  width: 400px;
  height: 400px;
  float: left;
  margin: 10px;
  cursor: all-scroll;
}
.hover-model-add:hover
{
  fill: #fff !important;
  color: #fff !important;
}
.hover-underline:hover
{
   border-bottom:solid 1px;
}
.btn-new-underline-unset.btn-39-wishlist:hover {
    text-decoration: unset !important;
}
.product-img--main__image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    -webkit-transition: -webkit-transform .5s ease-out;
    transition: -webkit-transform .5s ease-out;
    transition: transform .5s ease-out;
    transition: transform .5s ease-out,-webkit-transform .5s ease-out;
    cursor: all-scroll;
}

#myModal_molla .modal-content {
  height: 650px;
  overflow-y: hidden;
  border-radius:.3rem;
}

#myModal_molla .modal-body {
position: relative;
flex: 1 1 auto;
padding: 2rem;
}
.footer-darks .social-icon {
    justify-content: center;
    font-size: 1rem;
    width: 2.5rem;
    height: 2.5rem;
    color: #777 ;
    margin-right: 10px;
    background-color: transparent;
    border: 0.1rem solid #e1e2e6;
    border-radius: 50%;
    text-decoration: none;
    opacity: 1;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}

.demo-image-zoom{
  cursor: all-scroll;
}
.demo-image-zoom:hover
{
    transform: scale(1.5);
}

  .quick-view-height {
    max-height: 150px;
    min-height: 30px;
    overflow-y: auto !important;
    margin-bottom:10px;
  }
  .row-scroll  .modal-body {
      position: relative;
      flex: 1 1 auto;
      padding: 2rem;
    }

    .slider-nav-detail .slick-slide {
outline: none;
padding: 0px !important;
opacity: 0.5;
}
.slider-nav-detail .slick-slide:hover {
outline: none;
padding: 0px !important;
opacity: 1;
}
/* .slider-nav .slick-current {
opacity: 1;
border:1px solid green;
} */
   .row-scroll .slider-wrapper .slider-for-detail {
      margin-bottom: 0px;
      height: 465px !important;
      width: 100%;
    }
   .row-scroll .slider-wrapper .slider-for-detail .slider-for__item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .row-scroll .slick-track {
      position: relative;
      top: 0;
      left: 0;
      display: block;
      margin-left: initial;
      margin-right: auto;
    }
    .cart-button{
      width:49.5%;
    }
    .cart-button-width{
         width:100%;
      }

      .pop-height{
      height:115px !important;
      margin: 10px;
    }

    .row-scroll .slider-wrapper .slider-for-detail .slider-for__item img {
        width: 100%;
        height: 465px !important;
}

.shop-content .slider-wrapper .slider-for-detail .slider-for__item img {
        width: 100%;
        height: 400px !important;
}

    @media only screen and (min-width: 700px) and (max-width: 800px){

      #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }
      .modal-dialog {
max-width: 600px;
margin: 1.75rem auto;
}
.cart-button {
width: 45.5%;
}
      .cart-button-width{
         width:100%;
      }
      .row-scroll
      {
        overflow-y: auto;
        max-height: 87vh !important;
      }
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll  .modal .modal-dialog {
    width: 75%;
}
.row-scroll .slider-wrapper .slider-for-detail {
    margin-bottom: 20px;
    height: 400px;
    width: 100%;
}

.btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: center;

    }
    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px;
}

    }
  @media (min-width: 992px){
    #myModal_molla .modal-lg, #myModal_molla .modal-xl {
      max-width: 1000px;
    }
  }

  @media only screen and (min-width: 300px) and (max-width: 600px){

    /* .slider-wrapper .slider-for {
      margin-bottom: 20px;
      height: 100% !important;
      width: 100%;
    } */

    .modalwh{
    width:100% !important;
    height:40px !important;
  }

  .cart-button {
    width: 100% !important;
}

    #myModal_molla .modal-content {
        height: 96vh !important;
        border-radius:.3rem;
      }

    .pop-height {
height: 100px !important;
}

.cart-button{
      width:67%;
    }
    .btn-39-wishlist{
      padding: 1rem 0rem !important;
      text-align: -webkit-left;

    }

    .modal .modal-dialog .modal-body .pro-description .pro-counter {
margin-bottom: 0px !important;
}

.row-scroll  .modal-content {
      height: 100% !important;
    }
      .row-scroll
      {
        overflow-y: auto;max-height: 100%;margin-top: 50px;min-height: 450px;height: 600px;
      }
      .row-scroll  .modal-open .modal {
    overflow-x: hidden;
    overflow-y: hidden;
    height: 97vh !important;
    margin-top: 10px;
}
.row-scroll .modal .modal-dialog .modal-body .close {
    margin: 20px 0;
    position: fixed;
    top: -2px;
}
.qtynewpad
{
  padding:10px !important;
}
 
      .new-width {
    max-width: 100% !important;
    flex: 0 0 100% !important;
}
.row-scroll .modal .modal-dialog {
    width:95%;

}
.row-scroll .modal-body {
    padding: 5px;
}
.row-scroll .slider-wrapper .slider-for {
    margin-bottom: 20px;
    height: 280px;
    width: 100%;
}

    }


    @media only screen and (max-width: 600px)
{
  .row-scroll .slider-wrapper .slider-for-detail {
    margin-bottom: 0px;
    height: 250px !important;
    width: 100%;
}
.footer-darks {
    margin-bottom: 100px;
}
.product-img--main {
    position: relative;
    overflow: hidden;
    /* margin-bottom: 30px; */
    width: 100%;
    height: 200px;
    float: left;
    margin: 10px;
    cursor: all-scroll;
}

}

   

.row-scroll .btn-secondary:hover{
  color:#fff !important;
}
</style>


<!-- @include('web.common.quick_scripts') -->
<div class="row row-scroll">
  <div class="col-12 col-md-6 new-width">
    <div class="row ">
    
      <div class="slider-wrapper pd2 slider-outer-border">
      
        <div class="slider-for-detail" style="position:relative">
                <a class="slider-for__item  ex1 ">
                  <div  class="product-img--main" data-scale="1.2" src="{{asset($result['detail']['product_data'][0]->default_images) }}" ></div>
                </a>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  @if($images->image_type == 'ACTUAL')

                  <a class="slider-for__item  ex1 ">
                  <div  class="product-img--main" data-scale="1.2" src="{{asset($images->image_path) }}" ></div>
                  </a>
                  
                
                  @endif
                @endforeach
              </div>

              <!-- <a class="fancybox-button fancy-btn-new expand-fancy-thumb " href="{{asset('').$result['detail']['product_data'][0]->default_images }}" data-fancybox-group="fancybox-button"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a> -->

              
            
              <div class="slider-nav-detail">
                
              
                
                <div class="slider-nav__item pop-height" style="padding:0px !important">

                @if($result['detail']['product_data'][0]->default_thumb_image_path_type == 'aws')
                <img style="width:100%;height:100% !important;object-fit:contain;" src="{{$result['detail']['product_data'][0]->default_thumb }}" alt="Zoom Image"/>
                    @else
                    <img style="width:100%;height:100% !important;object-fit:contain;" src="{{asset('').$result['detail']['product_data'][0]->default_thumb }}" alt="Zoom Image"/>
                  @endif
                 
                </div>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  
                  @if($images->image_type == 'THUMBNAIL')
                    <div class="slider-nav__item pop-height">
                    @if($images->image_path_type == 'aws')
                      <img style="width:100%;height:100% !important" src="{{$images->image_path }}" alt="Zoom Image" />
                    @else
                      <img style="width:100%;height:100% !important" src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                    @endif
                      
                    </div>
                  @endif
                @endforeach
                
              </div>
            </div>
        </div>

        @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)
          @if($result['detail']['product_data'][0]->products_type == 0)
            @if($result['commonContent']['settings']['Inventory'])
            @if($result['detail']['product_data'][0]->stock_status == 1)
              @if($result['detail']['product_data'][0]->defaultStock <= 0)
                <span class="badge badge-success bage-22-out" style="margin:25px 10px;font-size:0.9rem;height:30px;position:absolute;top:0">@lang('website.Out of Stock')</span>
              @endif
              @endif
            @endif
          @endif
        @endif

      </div>

    <div class="col-12 col-lg-6" style="height:90vh;overflow-y:auto;">
   

    
      <div class="pro-description">
        <div class="badges">
          <?php 
               $currency = \App\Models\Core\Currency::where('id',session('currency_id'))->pluck('decimal_places'); 
              $decimal_places = count($currency) > 0 ? $currency[0] : 2;
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

          @if($result['detail']['product_data'][0]->is_feature == 1)
          <span class="badge badge-success">@lang('website.Featured')</span>     
          @endif
          
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
          <span class="badge badge-danger"><?php echo (int)$discount_percentage; ?>%</span>
          @endif
        </div>
          {{-- <h3 class="pro-title">{{$result['detail']['product_data'][0]->products_name}}</h3> --}}
          <h4 style="margin: 10px 0px;font-size:24px !important;font-weight:400 !important">{{$result['detail']['product_data'][0]->products_name}}</h4>

          <div class="modal-5-pro-title-outer">
            @if($result['detail']['product_data'][0]->products_type == 3)
                  <?php
                        $comboPro = DB::table('product_combo')
                        ->leftjoin('products','products.products_id','=','product_combo.product_id')
                        ->leftjoin('products_description','products_description.products_id','=','product_combo.product_id')
                        ->leftjoin('categories_description','categories_description.categories_id','=','product_combo.cate_id')
                        ->where('products_description.language_id', Session::get('language_id'))
                        ->where('categories_description.language_id', Session::get('language_id'))
                        ->where('product_combo.pro_id', $result['detail']['product_data'][0]->products_id)
                        ->get();
                      ?>
                       <div class="row">
                        @foreach($comboPro as $comboProd)
                          <div class="col-md-6">
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
                          </div>
                        @endforeach
                      </div><br>
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
                      <div class="row">
                        <div class="col-md-6">
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

                              $options_names[] = $productsAttributes[0]->options_name;
                              $options_values[] = $productsAttributes[0]->options_values;
                            
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                          @endforeach
                        </div>
                        <div class="col-md-6">
                          <h5>Get X :</h5>
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

                              $options_names[] = $productsAttributes[0]->options_name;
                              $options_values[] = $productsAttributes[0]->options_values;
                            ?>
                             <small><b><?php echo $options_names; ?> :</b> <?php echo $options_values; ?></small><br>
                            @endif
                          @endforeach
                        </div>
                      </div>
                @endif
        </div>


          <div class="pro-rating" style="margin: 10px 0px;">
            <fieldset class="disabled-ratings-19">                            
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.bad_1_stars')"></label>
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.average_2_stars')"></label>   
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.good_3_stars')"></label>   
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>  
            <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>   
            <span style="font-size:13px;color:#cccccc">( {{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') )</span>
        </div>
    
    <div class="pro-price">  

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
      <ins class="get_att_amount"> {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}</ins>
      <del>{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</del>

      @elseif(!empty($result['detail']['product_data'][0]->discount_price))
      <ins class="get_att_amount" id="total_dis_price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}</ins>
      <del id="total_org_price">{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</del>

      @else
      <ins class="get_att_amount">{{Session::get('symbol_left')}}{{number_format($orignal_price+0,$decimal_places)}}{{Session::get('symbol_right')}}</ins>
      @endif
      </h2>
                         
      </div>

    <!-- <div class="pro-infos">
        <div class="pro-single-info" style="font-size:14px">@lang('website.Product ID') : {{$result['detail']['product_data'][0]->products_id}}</div>
        
          @if($result['detail']['product_data'][0]->products_type == 0)
          <div class="pro-single-info" style="font-size:14px">@lang('website.Available') :
            @if($result['commonContent']['settings']['stock_availability'] == 1)
                <span class="text-secondary">{{ $result['detail']['product_data'][0]->defaultStock }}</span>
            @else
              @if($result['detail']['product_data'][0]->defaultStock == 0)
                <span class="text-secondary">@lang('website.Out of Stock')</span>
              @else
                <span class="text-secondary">@lang('website.In stock')</span>
              @endif
            @endif
          </div>
        @endif


        @if($result['detail']['product_data'][0]->products_type == 1)
          <div class="pro-single-info" style="font-size:14px">@lang('website.Available') :
            @if($result['commonContent']['settings']['stock_availability'] == 1)
                <span class="text-secondary" id="variable-count"></span>
            @else
            <span class="text-secondary" id="variable-status"></span>
            @endif
          </div>
        @endif


        @if($result['detail']['product_data'][0]->products_min_order>0)
              @if($result['detail']['product_data'][0]->products_type == 0)
            <div class="pro-single-info" style="font-size:14px" id="min_max_setting">@lang('website.Min Order Limit') : <a style="line-height:24px" href="#">{{$result['detail']['product_data'][0]->products_min_order}}</a></div>
              @elseif($result['detail']['product_data'][0]->products_type == 1)
                <div class="pro-single-info" id="min_max_setting"></div>
              @endif
          @endif
    </div> -->

    <div class="popup-detail-info quick-view-height">
      <p style="font-size:14px !important;line-height:2">
      <?php 
        $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
        echo stripslashes($descriptions);
      ?>
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

      <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >
       @if(!empty($result['cart']))
        <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
       @endif


    @if(count($result['detail']['product_data'][0]->attributes)>0)
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

  <div class="box mb-3">


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


      <!-- <div class="pro-options">
            <div class="box mb-3">
              <label style="float:left;width:90px;margin-right: 0px;">{{ $attributes_data['option']['name'] }} : </label>
              <div class="select-control " style="min-width: 150px;">
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
                     <option attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>                  
      </div> -->
      @endforeach
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
    <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>

    @if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

        <div class="input-group item-quantity modalwh">    
        <span style="float:left;width:90px;margin-top: 13px;">Qty :</span>  
        
          <span class="input-group-btn">        
            <button type="button" class="quantity-minus1 btn qtyminus qtynewpad" style="height:100% !important;border-right-width: 0 !important;border:1px solid #ced4da;">
                <i class="fas fa-minus"></i>
              </button>
            </span>
            {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}

            @if($result['detail']['product_data'][0]->products_type == 0)
                   @if($result['detail']['product_data'][0]->stock_status == 1)

                   @if($result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock && $result['detail']['product_data'][0]->products_max_stock !=0)
                  <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                    @else

                    <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}">    <span class="input-group-btn">

                    @endif
                    @else

<input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text"  readonly name="quantity" class="form-control qty detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="99999">    <span class="input-group-btn">

@endif

                  @elseif($result['detail']['product_data'][0]->products_type == 1)
                    @if($result['detail']['product_data'][0]->stock_status == 1)
                      <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
                  @else
                    <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="9999999">    <span class="input-group-btn">

                  @endif


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

                <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])){{$result['cart'][0]->customers_basket_quantity}}@else @if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}@endif @endif" 
              
                min="@if($result['detail']['product_data'][0]->products_min_order>0 and $totalStock > $result['detail']['product_data'][0]->products_min_order){{$result['detail']['product_data'][0]->products_min_order}}@else{{ $result['detail']['product_data'][0]->products_min_order }}  @endif" 
                
                max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $totalStock >$result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $totalStock }}@endif">     <span class="input-group-btn">

              @else

                  <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">
               @endif
               @else

<input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="999999">    <span class="input-group-btn">
@endif

              @else

                  <input style="border:1px solid #ced4da;height: 42px !important;background: #fff;border-left-width: 0;border-right-width: 0;" type="text" readonly name="quantity" class="form-control qty type_one detail-8-iput-btn" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->products_max_stock}}">    <span class="input-group-btn">

              @endif

            <!-- <span class="input-group-btn"> -->
                <button type="button" class="quantity-plus1 btn qtyplus qtynewpad" style="border:1px solid #ced4da;height:100% !important;border-left-width: 0;">
                    <i class="fas fa-plus"></i>
                </button>
            <!-- </span> -->
          </div>
          @endif
          </div>
<br>
<div class="cart-button" style="display:inline-block;margin-bottom:10px">

@if($result['detail']['product_data'][0]->button_type == 1 || $result['detail']['product_data'][0]->button_type == 3)

          @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
            @else
              @if($result['detail']['product_data'][0]->products_type == 0)

                    @if($result['commonContent']['settings']['Inventory'])
                    @if($result['detail']['product_data'][0]->stock_status == 1)
                      @if($result['detail']['product_data'][0]->defaultStock <= 0)
                      <!-- <button style="padding: 0.6rem 0rem !important;" class="btn btn-lg swipe-to-top  btn-danger cart-button-width" type="button">@lang('website.Out of Stock')</button> -->
                      <button style="cursor:not-allowed;background-color:#fff;" class="btn btn-secondary common-text btn-lg common-bg-hover hover-model-add common-fill cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>
                      @else
                          <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>
                      @endif
                  @else
                      <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>
                  @endif
                  @else
                      <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>
                  @endif
              @else
                    <!-- <button class="btn btn-secondary btn-lg common-bg-hover hover-model-add common-fill  add-to-Cart stock-cart cart-button-width" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>
                           <div class="stock-out-cart" hidden style="margin-bottom:15px;"><span style="color:red;">OUT OF STOCK  </span></div>
                    <button class="btn btn-danger btn btn-lg common-bg-hover hover-model-add common-fill  stock-out-cart cart-button-width" hidden type="button">@lang('website.Out of Stock')</button> -->
              @endif
            @endif

            @if($result['detail']['product_data'][0]->products_type == 1)
                          @if($result['commonContent']['settings']['Inventory'])
                          @if($result['detail']['product_data'][0]->stock_status == 1)
                          <button class="btn btn-secondary btn-lg common-bg-hover hover-model-add common-fill  add-to-Cart stock-cart cart-button-width"  hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                     <button class="btn btn-danger btn btn-lg common-bg-hover hover-model-add common-fill  stock-out-cart cart-button-width" hidden type="button">@lang('website.Out of Stock')</button>
                          
                          @else
                          <button class="btn btn-secondary btn-lg common-bg-hover hover-model-add common-fill  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                          @endif

                          @else
                          <button class="btn btn-secondary btn-lg common-bg-hover hover-model-add common-fill  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                       <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                     </svg>@lang('website.Add to Cart')</button>
                          @endif
                    @endif
                 

            @if($result['detail']['product_data'][0]->products_type == 2)
            <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary common-bg-hover hover-model-add common-fill btn-lg  cart-button-width">@lang('website.External Link')</a>
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

                          <button class="btn btn-danger hover-model-add btn-lg cart-button-width" type="button">@lang('website.Out of Stock')</button>

                        @else

                        <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                        @endif
                        @else

                        <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                        @endif
                    @else

                    <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                    @endif   
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

                          <button class="btn btn-danger hover-model-add btn-lg cart-button-width" type="button">@lang('website.Out of Stock')</button>

                        @else

                        <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                        @endif
                        @else

                        <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                        @endif
                    @else

                    <button style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill common-text btn-lg  add-to-Cart cart-button-width"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 50.948 44.099" style="margin-right:10px;">
                             <path id="cart_plus" d="M30.728,37.537a6.564,6.564,0,0,1,4.949-6.361H19.219a6.561,6.561,0,1,1-3.226,0H13.216l-.4-1.44L5.589,3.938H0V0H8.575l.4,1.439,7.224,25.8H39.28L46.6,9.93h4.345L41.889,31.176H38.9a6.562,6.562,0,1,1-8.175,6.361Zm3.281,0a3.281,3.281,0,1,0,3.28-3.28A3.284,3.284,0,0,0,34.009,37.537Zm-19.684,0a3.281,3.281,0,1,0,3.281-3.28A3.284,3.284,0,0,0,14.325,37.537Zm12.659-18.3v-6.76H20.19V8.919h6.794V2.125h3.547V8.919H37.29v3.563H30.531v6.76Z"/>
                           </svg>@lang('website.Add to Cart')</button>

                    @endif   

          @endif

@if($result['detail']['product_data'][0]->button_type == 2)
  <button style="background-color:#fff;" type="button" class="btn btn-secondary common-text btn-lg  cart-button-width common-bg-hover hover-model-add common-fill modal_show3" products_id="{{$result['detail']['product_data'][0]->products_id}}"  products_name="{{$result['detail']['product_data'][0]->products_name}}" >Book Appointment</button>
@endif
@if($result['detail']['product_data'][0]->button_type == 4)
  <a style="background-color:#fff;" class="btn btn-secondary common-bg-hover hover-model-add common-fill btn-lg common-text  cart-button-width" href="{{ URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}" ><span> @lang('website.View Detail')</span></a>
@endif

      </div>
@endif

    <div class="cart-button" style="display:inline-block">

    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1')
                  {
                    $is_liked_products = DB::table('liked_products')->where('liked_products_id', '=', $result['detail']['product_data'][0]->products_id)->where('liked_customers_id', '=', session('customers_id'))->first();
                    if($is_liked_products == '')
                    { ?>
                      

                      <button type="button" id="quick_wish_molla_show_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_show btn btn-blocks btn-new-underline-unset btn-39-wishlist swipe-to-top is_liked_molla_1 cart-button-width" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart-o common-text" style="margin-right:10px"></i><spans class="hover-underline">ADD TO WISHLIST </spans></button>
                      <button type="button" id="quick_wish_molla_hide_{{$result['detail']['product_data'][0]->products_id}}" class="wish_molla_hide btn btn-blocks btn-new-underline-unset btn-39-wishlist swipe-to-top is_liked_molla_1 cart-button-width" style="display:none;" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart common-text" style="margin-right:10px"></i><spans class="hover-underline">GO TO WISHLIST </spans></button>
              <?php } else { ?>
                <button type="button" class="btn btn-blocks btn-new-underline-unset btn-39-wishlist swipe-to-top is_liked_molla_1 cart-button-width" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart common-text" style="margin-right:10px"></i><spans class="hover-underline">GO TO WISHLIST </spans></button>
              <?php } } else { ?>
                    <button type="button" class="btn btn-blocks btn-new-underline-unset btn-39-wishlist swipe-to-top is_liked_molla_1 cart-button-width" products_id="{{$result['detail']['product_data'][0]->products_id}}"><i class="fa fa-heart-o common-text" style="margin-right:10px"></i><spans class="hover-underline">ADD TO WISHLIST </spans></button>
              <?php } ?>


          


  </div>


<br>
<hr/>

<div class="pro-single-info pro-catgory" style="display:-webkit-box !important;font-size:14px;color:#777777"> @lang('website.Categroy')  : 
          @foreach($result['detail']['product_data'][0]->categories as $key=>$category)
          <a style="line-height:24px;color:#777777" class="hover-underline common-hover" href="{{url('shop?category='.$category->categories_slug)}}">{{$category->categories_name}}</a>,&nbsp;&nbsp;
          @endforeach

          </div> 
          <br>
    
              <div class="footer-darks" style="background:#fff">
                <div class="pro-single-info" style="margin-bottom:30px float:left;margin:0px 20px 0px 0px;font-size:14px">Share : 
                  <div class="social-icons social-icons-color">
                    @if($result['commonContent']['setting'][50]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-facebook common-hover" href="{{$result['commonContent']['setting'][50]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-facebook-f common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][52]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-twitter common-hover" href="{{$result['commonContent']['setting'][52]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-twitter"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][51]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-instagram common-hover" href="{{$result['commonContent']['setting'][51]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-google common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][53]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][53]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-linkedin common-hover"></i>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][216]->value!='')
                      <a style="width:2rem;height:2rem"  target="_blank" class="stmodal social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][216]->value}}">
                      <svg class='fontawesomesvg' width="11" height="11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                      </a>
                    @endif
                    @if($result['commonContent']['setting'][218]->value!='')
                      <a style="width:2rem;height:2rem" target="_blank" class="social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][218]->value}}">
                        <i style="font-size:0.8rem" class="fa fa-instagram common-hover"></i>
                      </a>
                    @endif
                  </div>
                </div>
                <!-- AddToAny BEGIN -->
                <!-- <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="display:contents">
                  <!-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> -->
                  <!--<a class="a2a_button_facebook"></a>
                  <a class="a2a_button_twitter"></a>
                  <a class="a2a_button_email"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script> -->
                <!-- AddToAny END -->
              </div>
  </form>

  
    
    </div>     

  </div>

</div>


<script>
@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
  getQuantity();

  gettotalval();
  cartPrice();
@endif

//reju check
jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
  function {{ $functionValue }}(){
      var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
      jQuery("#{{ $functionValue }}").val(value_price);
    }
    //change_options
  jQuery(document).on('change', '.{{ $functionValue }}', function(e){

        var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

        var old_sign = jQuery("#{{ $attribute_sign }}").val();

        var value_price = jQuery('option:selected', this).attr('value_price');
        var prefix = jQuery('option:selected', this).attr('prefix');
        var current_price = jQuery('#products_price').val();
        var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

        if(old_sign.trim()=='+'){
          var current_price = current_price - {{ $functionValue }};
        }

        if(old_sign.trim()=='-'){
          var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
        }

        if(prefix.trim() == '+' ){
          var total_price = parseFloat(current_price) + parseFloat(value_price);
        }
        if(prefix.trim() == '-' ){
          total_price = current_price - value_price;
        }

        jQuery("#{{ $functionValue }}").val(value_price);
        jQuery('#products_price').val(total_price);
        var qty = jQuery('.qty').val();
        var products_price = jQuery('#products_price').val();
        var total_price = qty * products_price * <?=session('currency_value')?>;//pro-price
        //jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        jQuery('.get_att_amount').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
        //alert(total_price);
        
  });
  @endforeach
  getQuantity();
  //calculateAttributePrice();
  function calculateAttributePrice(){
    var products_price = jQuery('#products_price').val();
    jQuery(".currentstock").each(function() {
      var value_price  = jQuery('option:selected', this).attr('value_price');
      var prefix = jQuery('option:selected', this).attr('prefix');

      if(prefix.trim()=='+'){
        products_price = products_price - value_price;
      }

      if(prefix.trim()=='-'){
        products_price = products_price - value_price;
      }

    });
    jQuery('#products_price').val(products_price);
    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+products_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
  }

  @endif

});
</script>
