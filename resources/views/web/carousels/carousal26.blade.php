<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .carousal16-main {
height: 500px !important;
}



.desktop_slider_view_44 {
  height: 500px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 640px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
}

  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
.carousal16-main .slick-slide{
  padding:0px !important;
}
.slider-arrow-8 .slider-prev {
    left: 50px;
}
.slider-arrow-8 .slider-next {
    right: 50px;
}
.carousal-45-img{
  height:440px
}
.carousal-10 .slick-dots {
    position: absolute !important;
    bottom: 20px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0 0px 0px -190px;
    list-style: none;
    text-align: center;
}

@media only screen and (max-width: 992px){

  .carousal-10 .slick-dots {
      position: absolute !important;
      bottom: 20px;
      display: block;
      width: 100%;
      padding: 0;
      margin: 0 0px 0px 0px;
      list-style: none;
      text-align: center;
  }
}



.demo-45-banner-20-btn-new {
    padding: 11px 50px !important;
    border: solid 1px;
    font-size: 14px;
    border-radius: 2px;
}
.demo-45-banner-20-btn-new:hover {
  fill: #fff !important;
  color: #fff !important;
}

.carousel-6-container-outer {
    position: absolute;
    width: 30%;
    text-align: left;
    top: -350px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
.intro-subtitle {
    font-size: 16px;
    font-weight: 300;
    color: #777;
    margin-bottom: 10px;
    letter-spacing: 1px;
}
.intro-title {
    font-size: 40px;
    margin-bottom: 20px;
    color: #333;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 1px;
}
.intro-des-2
{
  font-size: 50px;
  margin-bottom: 3px;
}
.intro-title span {
    font-weight: 300;
}

@media only screen and (max-width: 992px){
  .carousel-6-container-outer {
    width: 55%;
    margin-left: 23px;
    top: -300px;
}
.intro-title {
    font-size: 50px;
    margin-bottom: 14px;
}
.intro-subtitle {
    font-size: 14px;
    margin-bottom:10px;
   
}
.intro-des-2
{
  font-size: 46px;
}
}
@media only screen and (max-width: 600px){
  .carousel-6-container-outer {
    top: -350px;
    width: 75%;
}
.intro-title {
    font-size: 40px;
    margin-bottom: 10px;
}
.intro-subtitle {
    font-size: 12px;
    margin-bottom:10px;
   
}
.intro-des-2
{
  font-size: 36px;
}
.cart-left-wishlist 
{
  display: none !important;
}
.header-16-wishlist-text
{
  display: none !important;
}



}

.desktop_slider_view_44 {
      display: block !important;
    }
    .mobile_slider_view_44 {
      display: none !important;
    }
    .tab_slider_view_44 {
      display: none !important;
    }
@media screen and (max-width: 992px){

    .desktop_slider_view_44 {
      display: none !important;
    }
    .mobile_slider_view_44 {
      display: none !important;
    }
    .tab_slider_view_44 {
      display: block !important;
    }
}
@media screen and (max-width: 600px){
    .desktop_slider_view_44 {
      display: none !important;
    }
    .mobile_slider_view_44 {
      display: block !important;
    }
    .tab_slider_view_44 {
      display: none !important;
    }
}

</style>


<?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
if($margin_between->value == 20){$bottom = 10;}
elseif($margin_between->value == 30){$bottom = 15;}
elseif($margin_between->value == 40){$bottom = 20;}
elseif($margin_between->value == 50){$bottom = 25;}
elseif($margin_between->value == 60){$bottom = 30;}
?>


<section class="categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="row">
        <div class="container-fluid">
          <div class="carousal16-main slider-arrow-8">     
            <div class="carousel-carousel-js-45">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                @if($slides_data->con_name == '')
                @if($slides_data->type == 'category')
                      <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new common-hover banner-link common-fill-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a style=" padding: 0px !important;border: solid 0px" class="btn btn-outline-white demo-45-banner-20-btn-new  common-hover banner-link common-fill-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      @endif 

                     
                        <img class="w-100 desktop_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" alt="First slide">
                        <img class="w-100 mobile_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" alt="First slide">
                        <img class="w-100 tab_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" alt="First slide">

                    
                        @if($slides_data->con_name == '')
                        </a>
                        @endif 

                    <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                    @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title">{{$slides_data->con_description}}</h1>
                      @endif 
                      @if($slides_data->con_description2 != '')
                      <h1 class="intro-des-2 common-color">{{$slides_data->con_description2}}</h1>
                      @endif 
                    
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover common-color common-fill banner-link common-fill-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-outline-white demo-45-banner-20-btn-new  common-bg-hover common-color common-fill banner-link common-fill-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover common-color common-fill banner-link common-fill-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover common-color common-fill banner-link common-fill-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover common-color common-fill banner-link common-fill-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover common-color common-fill banner-link common-fill-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-outline-white demo-45-banner-20-btn-new common-bg-hover  common-color common-fill banner-link common-fill-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      
                      <span >{{$slides_data->con_name}}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)"/></svg>
                      </a>
                      @endif
                    </div>
                    </div>
                    </div>

                </div>
              @endforeach     
            </div>
          </div>
        </div>
      </div>
</section>


<script>

(function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-45');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: true,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-brand common-fill-hover slider-arrow slider-prev" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-brand common-fill-hover slider-arrow slider-next" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',

          // variableWidth: true,
          //rtl:true,
          speed: 2000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }, 
		  {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, 
		  {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
  </script>