<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .carousal43-main {
    height:100% !important;
  }


.desktop_slider_view_44 {
  height: 600px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 640px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 800px !important;
  object-fit:cover !important;
}

  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}
.carousal-10 .slick-slide{
  padding:0 0px;
}
.carousal-10 .container{
  width:1190px;
  max-width:100%;
}
.carousal-43-img{
  height:100%;
}

.demo-10-banner-20-btn-new {
    margin-top:14px;
    background: #fff;
    border:1px solid #fff;
    padding: 12px 32px;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.demo-10-banner-20-btn-new:hover {
    border:1px solid transparent;
    padding: 12px 32px;
    color: #fff !important;
    fill: #fff !important;
}

.carousel-6-container-outer {
    position: absolute;
    width: 65%;
    text-align: left;
    top: -400px;
    bottom: 0;
    left: 15px;
    right: 0;
    
    text-align:left;
}
.intro-subtitle {
    font-size: 13px;
    font-weight: 300;
    color: #ebebeb;
    margin-bottom: 14px;
    letter-spacing: 1px;
    text-transform:uppercase;
   
}
.intro-title {
  font-size: 60px;
    margin-bottom: 2rem;
    color: #fff;
    font-weight: 600;
    line-height: 1.1;
    text-transform:uppercase;
    
}
.intro-des-2
{
  font-size: 30px;
    margin-bottom: 23px;
    color: #fff;
    font-weight: 300;
    line-height: 1.2;
    letter-spacing: 2px;
    text-transform:uppercase;

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
.carousal-10 .slick-dots{
  bottom:100px;
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
  .intro-title {
  font-size: 40px;
    
}
.carousel-6-container-outer {
    width: 90%;
    top: -500px;
    left: 40px;
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
  .carousel-6-container-outer {
   
   
    left:40px;
    top:-350px;
   
}
  .intro-title {
  font-size: 30px;
    
}
.intro-des-2
{
  font-size: 20px;
   

}
.carousel-6-container-outer {
   width: 90%;
  
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

<section class="categories-contents categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
    <div class="">
        <div class="">
            <div class="carousel-carousel-js-10">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                  <div class="carousal43-main ">     

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

                    
                        <img class="w-100 desktop_slider_view_44"  data-src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                        <img class="w-100 mobile_slider_view_44"  data-src="{{asset($slides_data->iconpath)}}" width="100%"  height="100%" alt="First slide">
                        <img class="w-100 tab_slider_view_44"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">
                     

                    </a>

                    <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                    @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle common-text">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title">{{$slides_data->con_description}}<br>
                      @endif 
                      @if($slides_data->con_description2 != '')
                        <span class="text-primary">{{$slides_data->con_description2}}</span>
                      </h1>
                      @endif 
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ $slides_data->url }}" target="_blank">
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
