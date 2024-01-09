<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }
  .slider-arrow-9 .slider-next {
    right: 7% !important;
}
.slider-arrow-9 .slider-prev {
    left: 7% !important;
}
  .carousel-6-container-outer {
    position: absolute;
    width: 400px;
    text-align: left;
    top: -340px;
    bottom: 0;
    right: 7%;
}
.categories-content .slick-disabled {
    display: block !important;
}
.demo-3-banner-20-btn-new
{
  border-radius: 30px;
}    
.intro-subtitle {
    font-size: 20px;
    font-weight: 300;
    color: #fff;
    margin-bottom:5px;
   
}
.intro-title {
    font-size: 50px;
    margin-bottom: 7px;
    color: #000;
    font-weight: 700;
    line-height: 1.2;
}
.intro-des-2
{
  font-size: 50px;
  margin-bottom: 17px;
}
.intro-title span {
    font-weight: 300;
}
  
.slick-list {
  height: 100% !important;
}
.slider-arrow-9 .slider-prev:hover, .slider-arrow-9 .slider-prev:focus, .slider-arrow-9 .slider-next:hover, .slider-arrow-9 .slider-next:focus {
    /* background-color: #9ACE69 !important; */
    color: #fff !important;
    outline: none;
    border: none;
    opacity: 1;
}
.carousal9-main {
    height: 100% !important;
}


.desktop_slider_view_44 {
  height: 460px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 400px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
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
    .carousel-6-container-outer {
    width: 300px;
    top: -375px;
}
.intro-subtitle {
    font-size: 18px;
}
.intro-title {
    font-size: 42px;
}
.intro-des-2 {
    font-size: 40px;
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
    .intro-subtitle {
    font-size: 14px;
}
.intro-title {
    font-size: 34px;
}
.intro-des-2 {
    font-size: 34px;
}
.carousel-6-container-outer {
    width: 250px;
    top: -285px;
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

<section class="categories-content categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="row">
        <div class="container-fluid slider-arrow-9">
            <div class="carousel-carousel-js-9">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick">
                <div class="carousal9-main">     

                        <img class="w-100 desktop_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    
                        <img class="w-100 mobile_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">

                        <img class="w-100 tab_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">

                        
                     

                      <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle common-color">{{$slides_data->con_title}}</h3>
                      <h1 class="intro-title">{{$slides_data->con_description}}</h1>
                      <h1 class="intro-des-2 common-color">{{$slides_data->con_description2}}</h1>
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-secondary demo-3-banner-20-btn-new " href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-secondary demo-3-banner-20-btn-new " href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-secondary demo-3-banner-20-btn-new " href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-secondary demo-3-banner-20-btn-new " href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-secondary demo-3-banner-20-btn-new " href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-secondary demo-3-banner-20-btn-new "  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-secondary demo-3-banner-20-btn-new  " href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      
                      <span >{{$slides_data->con_name}}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 15px;">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" fill="#fff"/></svg>
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
