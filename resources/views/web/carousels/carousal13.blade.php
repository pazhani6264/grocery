<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .carousal16-main {
height: 100% !important;
}

.desktop_slider_view_44 {
  height: 560px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 560px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 650px !important;
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
.fill-color-arrow-car
{
  fill: #777;
}
/* .demo-11-carousel-sec .desktop_slider_view {
    height: 100% !important;
}
.demo-11-carousel-sec .carousal-16-img {
  height: 100% !important;
} */
.demo-10-banner-20-btn-new {
    min-width: 190px;
    font-size: 14px;
    padding: 12px 32px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: solid 1px;
    
}
.demo-10-banner-20-btn-new:hover {
    border:1px solid transparent;
    padding: 12px 32px;
    color: #fff !important;
    fill: #fff !important;
}

.carousel-6-container-outer {
    position: absolute;
    width: 50%;
    text-align: left;
    top: -363px;
    bottom: 0;
    left: 2%;
    right: 0;
    
    text-align:left;
}
.intro-subtitle {
  font-size: 16px;
    margin-bottom: 15px;
    font-weight: 300;
    color: #ebebeb;
    letter-spacing: 1px;
    text-transform: uppercase;
   
}
.intro-title {
  font-size: 50px;
    margin-bottom: 17px;
    color: #333;
    font-weight: 300;
    line-height: 1.1;
    
    
}

.demo-11-carousel-sec:hover .slider-arrow-8 .slider-prev{
  display:block !important;
}
.demo-11-carousel-sec:hover .slider-arrow-8 .slider-next{
  display:block !important;
}
.slider-arrow-8 .slider-prev {
    left: 7%;
    display:none !important;
}
.slider-arrow-8 .slider-next {
    right: 7%;
    display:none !important;
}
.intro-des-2
{
  font-size: 30px;
    margin-bottom: 23px;
    color: #fff;
    font-weight: 300;
    line-height: 1.2;
    letter-spacing: 2px;

}
.intro-title span {
    font-weight: 300;
}
.info-bg-6-carousal .panel{
  text-align:left;
}
.info-bg-6-carousal .title{
  font-size:1rem;
  font-weight:600;
  text-transform:uppercase;
  margin-bottom:0;
}
.info-bg-6-carousal .info-color-p-1{
  font-size:0.9rem;
}
.info-bg-6-carousal .info-icon{
  font-size:1.5rem;
}
.info-bg-6-carousal{
  background:#222;
}
@media screen and (max-width: 992px){
  .intro-title {
  font-size: 30px;
  margin-bottom: 10px;
    
}
.carousel-6-container-outer {
  width: 50%;
   top:-225px;
   left:25px;
  
}
}
@media screen and (max-width: 600px){

  .intro-subtitle {
  font-size: 12px;
    margin-bottom: 10px;
   
}
.demo-10-banner-20-btn-new {
    min-width: 90px;
    font-size: 12px;
    padding: 7px 10px;
  
    
}

  .carousel-6-container-outer {
   
   
    left:40px;
    top:-275px;
   
}

.carousel-6-container-outer {
   width: 80%;
  
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



<section class="categories-content demo-11-carousel-sec categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="row">
        <div class="container-fluid">
          <div class="carousal16-main slider-arrow-8">     
            <div class="carousel-carousel-js-16">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                     
                        <img class="w-100 desktop_slider_view_44 carousal-16-img lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" alt="First slide">
                   
                        <img class="w-100 mobile_slider_view_44 carousal-16-img lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" alt="First slide">

                        <img class="w-100 tab_slider_view_44 carousal-16-img lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" alt="First slide">

                    <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                    @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle common-color">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title">{{$slides_data->con_description}}<h1>
                      @endif 
                    
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn  demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn  demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn  demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn  demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn  demo-10-banner-20-btn-new banner-link common-color common-fill common-bg-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                  
                      <span >{{$slides_data->con_name}}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 15px;">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" /></svg>
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
