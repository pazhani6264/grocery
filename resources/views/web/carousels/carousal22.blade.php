<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
.carousal22-main {
    position: relative;
    border: 0px solid;
   height:100% !important;
}



.desktop_slider_view_44 {
  height: 700px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 700px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 700px !important;
  object-fit:cover !important;
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
 
.carousel-6-container-outer
{
  position: absolute;
  width: 535px;
  
  top: -550px;
  bottom: 0;
}

.carousel-6-container-outer-1 {
    left: 10%;
    text-align: left;
}
.carousel-6-container-outer-2 {
    right: 10%;
    text-align: right;
}
.carousel-6-container-outer-3 {
  left: 10%;
  text-align: left;
}
.carousel-6-container-outer-4 {
  right: 10%;
  text-align: right;
}
.carousel-6-container-outer-5 {
  left: 10%;
  text-align: left;
}
.carousel-6-container-outer-6 {
  right: 10%;
  text-align: right;
}
.intro-title {
    font-size: 120px;

   font-weight: 700;
    color: #222;
    letter-spacing: 1px;
    margin-bottom: 2px;
    text-transform: uppercase;
}
.intro-subtitle {
    font-size: 18px;
    font-weight: 400;
    color: #777;
    letter-spacing: 1px;
    margin-bottom: 4px;
    text-transform: uppercase;
   
}
.intro-subtitle2 {
  font-size: 18px;
    font-weight: 400;
    color: #777;
    letter-spacing: 1px;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.slick-list {
  height: 100% !important;
}
.demo-8-btn{
  font-size: 14px;
    min-width: 150px;
    padding: 11 30px;
    color: #222;
    border: 0.2rem solid #222;
    margin-top:30px;
}
.demo-8-btn:hover
{
  background: #000;
  color:#fff;
}
@media only screen and (max-width: 1115px){
  .carousel-6-container-outer-1 {
    left: 20%;
}
.carousel-6-container-outer-2 {
    right: 20%;
}
.carousel-6-container-outer-3 {
  left: 20%;
}
.carousel-6-container-outer-4 {
  right: 20%;
}
.carousel-6-container-outer-5 {
  left: 20%;
}
.carousel-6-container-outer-6 {
  right: 20%;
}

}

@media only screen and (max-width: 768px){
  .intro-title {
    font-size: 100px;
}
  .carousel-6-container-outer-1 {
    left: 20%;
}
.carousel-6-container-outer-2 {
    right: 20%;
}
.carousel-6-container-outer-3 {
  left: 20%;
}
.carousel-6-container-outer-4 {
  right: 20%;
}
.carousel-6-container-outer-5 {
  left: 20%;
}
.carousel-6-container-outer-6 {
  right: 20%;
}

}
@media only screen and (max-width: 600px){
  .intro-title {
    font-size: 70px;
}
.carousel-6-container-outer
{
  width: 100%;
  text-align: center !important;
}

.carousel-6-container-outer-1 {
    left: 0%;
}
.carousel-6-container-outer-2 {
    right: 0%;
}
.carousel-6-container-outer-3 {
  left: 0%;
}
.carousel-6-container-outer-4 {
  right: 0%;
}
.carousel-6-container-outer-5 {
  left: 0%;
}
.carousel-6-container-outer-6 {
  right: 0%;
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

<section class="categories-content categories-sec-content text-center @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="row">
        <div class="container-fluid">
          <div class="carousal22-main">     
            <div class="carousel-carousel-js-6">   
            <?php $i=0; ?>     
              @foreach($result['slides'] as $key=>$slides_data)
              <?php $i++; ?>   
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

                 
                      <img class="w-100  desktop_slider_view_44 object-fit-unset"  src="{{asset($slides_data->path)}}"  alt="First slide">
                 
                      <img class="w-100  mobile_slider_view_44"  src="{{asset($slides_data->iconpath)}}"  alt="First slide">

                      <img class="w-100  tab_slider_view_44"  src="{{asset($slides_data->tabpath)}}"  alt="First slide">

                      

                      @if($slides_data->con_name == '')
                  
                    </a>
                    @endif 

                    <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer carousel-6-container-outer-{{$i}}">
                    @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title">{{$slides_data->con_description}}</h1>
                      @endif 
                      @if($slides_data->con_description2 != '')
                      <h3 class="intro-subtitle2">{{$slides_data->con_description2}}</h3>
                      
                      @endif 
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn  demo-8-btn banner-link common-fill-color" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn  demo-8-btn banner-link common-fill-color" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn  demo-8-btn banner-link common-fill-color" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn  demo-8-btn banner-link common-fill-color" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn  demo-8-btn banner-link common-fill-color" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn  demo-8-btn banner-link common-fill-color"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn  demo-8-btn banner-link common-fill-color " href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                  
                      <span class="" >{{$slides_data->con_name}}</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 15px;">
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
