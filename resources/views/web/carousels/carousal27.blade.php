<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .carousal42-main{
    height:100% !important;
  }


.desktop_slider_view_44 {
  height: 560px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 850px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 850px !important;
  object-fit:cover !important;
}

  .slick-track {
    display: flex !important;
  }
  .demo-16-slider-sec .slick-track {
    position: relative;
    top: 0;
    left: 0;
    display: block;
    margin-left: 0;
    margin-right: 0;
}
  .demo-16-slider-sec 
  .slick-slide {
 padding:0 !important;
}
.slick-list {
  height: 100% !important;
}
.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}
.carousal-42-img-height {
    height: 100% !important;
}
.carousal-10-img {
      width: 100%;
      height: 100% !important;
  }
.c41 .slick-slide {
    outline: none;
    padding: 0 0px !important;
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
    .intro-content {
    position: absolute;
    left: 0;
    top: 35%;
    right:0;
}

.css-1b7c46 {
    animation-duration: 1000ms;
    animation-timing-function: ease;
    animation-delay: 100ms;
    animation-name: animation-6oza6e;
    animation-direction: normal;
    animation-fill-mode: both;
    animation-iteration-count: 1;
}

.intro-subtitle {
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 17px;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
}
.intro-title {
    color: #fff;
    font-weight: 600;
    letter-spacing: 1px;
    line-height: 1.2;
    margin-bottom: 10px;
    font-size: 60px
}
.demo-12-btn-car
{
    min-width: 190px;
    font-size: 14px;
    padding: 9px 15px !important;
}


@media screen and (min-width: 1320px){
  .c41 .container {
      padding-left: 62px;
      padding-right: 62px;
  }
}



@media screen and (max-width: 992px){
  .intro-subtitle {
    margin-bottom: 12px;
    font-size: 14px;
    
}
.intro-title {
  
    font-size: 60px
}
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
  .demo-12-wish-hide
  {
    display: none;
  }

  .intro-subtitle {
    margin-bottom: 10px;
    font-size: 12px;
    
}
.intro-title {
  
    font-size: 30px
}
.demo-12-btn-car
{
    min-width: 90px;
    font-size: 12px;
    padding: 7px 10px !important;
}
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


<section class="categories-content demo-16-slider-sec categories-sec-content text-center @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">

          <div class="carousal42-main">     
            <div class="carousel-carousel-js-6">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                @if($slides_data->con_name == '')
                    @if($slides_data->type == 'category')
                      <a href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                      <a href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a href="{{ $slides_data->url }}" target="_blank">
                    @endif 
                    @endif 

                    <img class="w-100 desktop_slider_view_44"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 mobile_slider_view_44"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 tab_slider_view_44"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">


                
                  
                    @if($slides_data->con_name == '')
                    </a>
                    @endif 

                    <div class="container intro-content text-center">
                      <div class="css-1b7c46">
                      @if($slides_data->con_title != '')
                        <h3 class="intro-subtitle">{{ $slides_data->con_title  }}</h3>
                        @endif 
                      @if($slides_data->con_description != '')
                        <h1 class="intro-title text-white">{{ $slides_data->con_description  }}</h1>
                        @endif 
                    
                    @if($slides_data->con_name != '')
                        @if($slides_data->type == 'category')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=topseller')}}">
                    @elseif($slides_data->type == 'special')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ $slides_data->url }}" target="_blank">
                    @endif 

                        <span style="font-size:1rem;">{{ $slides_data->con_name  }}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;transform: rotate(90deg);">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)" fill="#fff"/></svg></a>
                        @endif 



                      </div>
                    </div>

                </div>
              @endforeach     
            </div>
         
      </div>
</section>
