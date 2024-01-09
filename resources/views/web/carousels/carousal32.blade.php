<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }

  .carousal10-main {
    position: relative;
    border: 0px solid;
    height: 100% !important;
}



.desktop_slider_view_44 {
  height: 670px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
}

  
.slick-list {
  height: 100% !important;
}
.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}
/* .carousal-10-img {
      width: 100%;
      height: 100% !important;
  } */
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
    margin-bottom: 6px;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
}
.intro-title {
    color: #fff;
    font-weight: 600;
    letter-spacing: 1px;
    line-height: 1.2;
    margin-bottom: 0px;
    font-size: 45px
}
.intro-title1 {
    color: #fff;
    font-weight: 600;
    letter-spacing: 1px;
    line-height: 1.2;
    margin-bottom: 10px;
    font-size: 100px
}
.demo-12-btn-car
{
    min-width: 170px;
    font-size: 14px;
    padding: 10px 15px !important;
    border-radius:5px;
    border:none;
    margin-top:10px
}

.demo-12-btn-car:hover
{
  background:#fff !important;
  color:#333;
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
.intro-content {
    position: absolute;
    left: 0;
    top: 22%;
    right: 0;
}
.intro-title {
  
    font-size: 45px
}
.intro-title1 {
    font-size: 80px;
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
.intro-title1 {
    font-size: 45px;
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

<section class="categories-contents categories-sec-content text-center c41 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="">
        <div class="">
            <div class="carousel-carousel-js-6">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick" style="position:relative">
                  <div class="carousal10-main ">    
                    
                  @if($slides_data->con_name == '')

                  @if($slides_data->type == 'category')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=topseller')}}">
                    @elseif($slides_data->type == 'special')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a style="padding: 0px !important;min-width: 100%;margin-top: 0px;" class="btn btn-outline-primary-2 scroll-to text-white demo-12-btn-car" href="{{ $slides_data->url }}" target="_blank">
                    @endif 
                    @endif 

                  

                    <img class="w-100 desktop_slider_view_44 carousal-10-img lazy_img_load"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 mobile_slider_view_44 carousal-10-img lazy_img_load"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 tab_slider_view_44 carousal-10-img lazy_img_load"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">


                    @if($slides_data->con_name == '')
                    </a>
                    @endif 

                  
                     
                    </div>
                    <div class="container intro-content text-center">
                      <div class="css-1b7c46">
                      @if($slides_data->con_title != '')
                        <h3 class="intro-subtitle common-text">{{ $slides_data->con_title  }}</h3>
                        @endif 
                      @if($slides_data->con_description != '')
                        <h1 class="intro-title text-white"><i>{{ $slides_data->con_description  }}</i></h1>
                        @endif 
                      @if($slides_data->con_description2 != '')
                        <h1 class="intro-title1 text-white">{{ $slides_data->con_description2  }}</h1>
                      @endif 
                    
                    @if($slides_data->con_name != '')
                        @if($slides_data->type == 'category')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ URL::to('shop?type=topseller')}}">
                    @elseif($slides_data->type == 'special')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a class="btn btn-secondary scroll-to text-dark demo-12-btn-car" href="{{ $slides_data->url }}" target="_blank">
                    @endif 

                        <span style="font-size:1rem;">{{ $slides_data->con_name  }}</span>
                      </a>
                        @endif 



                      </div>
                    </div>
                </div>
              @endforeach     
          </div>
        </div>
      </div>
</section>
