<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .carousal-main{
    height:100% !important;
  }



.desktop_slider_view_44 {
  height: 600px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 360px !important;
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

.slider-arrow-11 .slick-dotted.slick-slider {
    margin-bottom: 20px;
}
.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}

.demo-2-banner-20-btn-new {
    border: solid 2px #fff;
    color: #fff;
    padding: 12px 32px;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.demo-2-banner-20-btn-new:hover {
  background-color: #fff !important;
  border: solid 1px #fff !important;
}

.carousel-6-container-outer {
    position: absolute;
    width: 100%;
    text-align: left;
    top: -260px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    text-align:center;
}
.intro-subtitle {
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.intro-title {
  font-size: 90px;
    margin-bottom: 22px;
    color: #fff;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 20px;
    text-transform: uppercase;
}
.intro-des-2
{
  font-size: 24px;
  margin-bottom: 36px;
  color: #fff;
}
.intro-title span {
    font-weight: 300;
}

@media only screen and (max-width: 992px){
.intro-title {
    font-size: 60px;
    margin-bottom: 14px;
}
.intro-subtitle {
    font-size: 24px;
    margin-bottom:20px;
   
}
}
@media only screen and (max-width: 600px){
.intro-title {
    font-size: 42px;
    margin-bottom:12px;
    letter-spacing:10px;
}
.intro-subtitle {
    font-size: 13px;
   
   
}
.cart-left-wishlist 
{
  display: none !important;
}
.header-16-wishlist-text
{
  display: none !important;
}
.carousel-6-container-outer {
    top: -268px;
}
.demo-2-banner-20-btn-new {
    padding: 9px 15px;
    font-size: 14px;
}
.intro-des-2
{
  font-size: 16px;
  margin-bottom: 16px;
  color: #fff;
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

<section class="categories-content categories-sec-content text-center carousal-10  @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif" style=" @if($current_theme->template != 0) margin-bottom: 20px; @endif">
    <div class="row">
        <div class="container-fluid slider-arrow-11">
            <div class="carousel-carousel-js-11">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                  <div class="carousal-main">     
                      <img class="w-100 desktop_slider_view_44  lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" alt="First slide">
                      <img class="w-100 mobile_slider_view_44  lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" alt="First slide">
                      <img class="w-100 tab_slider_view_44  lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" alt="First slide">

                     
                      <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      <h1 class="intro-title">{{$slides_data->con_description}}</h1>
                      <h1 class="intro-des-2">{{$slides_data->con_description2}}</h1>
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new  common-hover banner-link common-fill-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      
                      <span >{{$slides_data->con_name}}</span>
                      </a>
                      @endif
                    </div>
                    </div>
                    </div>

                  </div>
                </div>
              @endforeach     
            
          </div>
        </div>
      </div>
</section>
