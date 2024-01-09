<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
    position:relative;
   
  }
  .carousal-6-img-height {
     height: 100% !important; 
}
.carousal6-main {
    position: relative;
    border: 0px solid;
    height: 100% !important;
}

.desktop_slider_view_44 {
  height: 500px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 460px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
}

  .quickview-icon-19
  {
    cursor: pointer;
  }
  .demo-1-slider-sec .slick-track 
  {
    cursor: grab;
  }
  .common-fill-color
  {
    fill: #333;
  }
  .common-fill-color:hover
  {
    fill: #fff;
  }
  .slick-slide {
    position:relative;
  }
  .carousel-6-container-outer
  {
    position: absolute;
    top:0;
  }
  .intro-subtitle {
    font-size: 16px;
    font-weight: 400;
    color: #999;
   
}
.carousel-6-container-outer
{
  position: absolute;
  width: 360px;
  text-align: left;
  top: -340px;
  bottom: 0;
}

.carousel-6-container-outer-1 {
    left: 1%;
}
.carousel-6-container-outer-2 {
    right: 2%;
}
.carousel-6-container-outer-3 {
  left: 1%;
}
.carousel-6-container-outer-4 {
  right: -1%;
}
.carousel-6-container-outer-5 {
  left: 1%;
}
.carousel-6-container-outer-6 {
  right: -1%;
}
.intro-title {
    font-size: 50px;
    margin-bottom: 25px;
}
.intro-title span {
    font-weight: 300;
}
.slick-list {
  height: 100% !important;
}
@media only screen and (max-width: 1115px){
  .carousel-6-container-outer-1 {
    left: 3%;
}
.carousel-6-container-outer-2 {
    right: 1%;
}
.carousel-6-container-outer-3 {
  left: 3%;
}
.carousel-6-container-outer-4 {
  right: -2%;
}
.carousel-6-container-outer-5 {
  left: 3%;
}
.carousel-6-container-outer-6 {
  right: -2%;
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
@media only screen and (max-width: 768px){
  .carousel-6-container-outer-1 {
    left: 3%;
}
.carousel-6-container-outer-2 {
    right: 2%;
}
.carousel-6-container-outer-3 {
  left: 3%;
}
.carousel-6-container-outer-4 {
  right: -3%;
}
.carousel-6-container-outer-5 {
  left: 3%;
}
.carousel-6-container-outer-6 {
  right: -3%;
}

}
@media only screen and (max-width: 600px){
  .intro-title {
    font-size: 40px;
}
.carousel-6-container-outer
{
  width: 300px;
}
.carousel-6-container-outer-1 {
    left: 6%;
}
.carousel-6-container-outer-2 {
    right: 2%;
}
.carousel-6-container-outer-3 {
  left: 6%;
}
.carousel-6-container-outer-4 {
  right: -8%;
}
.carousel-6-container-outer-5 {
  left: 6%;
}
.carousel-6-container-outer-6 {
  right: -8%;
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

<section class="categories-content categories-sec-content text-center demo-1-slider-sec @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="row">
        <div class="container-fluid">
          <div class="carousal6-main">     
            <div class="carousel-carousel-js-6">  
              <?php $i=0; ?>   
              @foreach($result['slides'] as $key=>$slides_data)
              <?php $i++; ?>   
                <div class="slick ">

                    <img class="w-100 desktop_slider_view_44 lazy_img_load"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 mobile_slider_view_44 lazy_img_load"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 tab_slider_view_44 lazy_img_load"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">

                    <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer carousel-6-container-outer-{{$i}}">
                    @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title">{{$slides_data->con_description}}<br>
                      @endif 
                      @if($slides_data->con_description2 != '')
                        <span class="text-primary common-color">{{$slides_data->con_description2}}</span>
                      </h1>
                      @endif 
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover  common-fill-color" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover  common-fill-color" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover  common-fill-color" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover  common-fill-color" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover common-fill-color" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover  common-fill-color"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-outline-white demo-1-banner-20-btn-new banner-link common-bg-hover common-fill-color " href="{{ $slides_data->url }}" target="_blank">
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
