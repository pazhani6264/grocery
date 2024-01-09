<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
    position:relative;
   
  }

  .carousal6-main {
    position: relative;
    border: 0px solid;
    height: 100% !important;
}


.desktop_slider_view_44 {
  height: 741px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 640px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 900px !important;
  object-fit:cover !important;
}

.page-content-div {
    max-width: calc(100% - 260px) !important;
}
.header.sidebar {
    display: block !important;
}
  .demo-1-slider-sec .slick-slide {
    outline: none;
    padding: 0 0px;
}

  /* .carousal-6-img-height {
     height: 100% !important; 
} */
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

.desktop_slider_view_44 {
  display: block !important;
}
.mobile_slider_view_44 {
  display: none !important;
}
.tab_slider_view_44 {
  display: none !important;
}

.carousel-6-container-outer
{
  position: absolute;
  width: 360px;
  text-align: left;
  top: -380px;
  bottom: 0;
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
.carousal6-main {
    height: 100% !important;
}

.intro-slide, .intro-slider-container {
    /* height: calc(100vh - 70px); */
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
}
.intro-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}
.intro-slide .intro {
    padding: 3rem 3.5rem 3rem;
    border: 0.1rem solid #fff;
}
.intro-slide .action, .intro-slide .content, .intro-slide .title {
    text-align: center;
}
.intro-slide .content, .intro-slide .title {
    margin-bottom: 3rem;
}
.title {
    font-size: 2.4rem;
    letter-spacing: -.03em;
}
.intro .title h3 {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
}
.intro .content h4 {
    font-size: 5.6rem;
    font-weight: 700;
    font-family: Playfair Display;
    letter-spacing: .01em;
    color: #fff;
    text-transform: uppercase;
}
.intro .action a {
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: .1em;
    color: #fff;
    text-transform: uppercase;
    -webkit-transition: all .3s;
    transition: all .3s;
}

@media screen and (max-width: 991px){
  .page-content-div {
      max-width: 100% !important;
      flex: 0 0 100%;
  }
  .demo-1-slider-sec .slick-slide {
    outline: none;
    padding: 0 10px;
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
    .intro-slide .intro {
    border: none;
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
.desktop_slider_view_44 {
      display: none !important;
    }
    .mobile_slider_view_44 {
      display: block !important;
    }
    .tab_slider_view_44 {
      display: none !important;
    }
    .intro .content h4 {
    font-size: 50px;
    font-weight: 700;
    font-family: Playfair Display;
    letter-spacing: .01em;
    color: #fff;
    text-transform: uppercase;
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


<div class="page-content-div ml-auto @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">

<section class="categories-content categories-sec-content text-center demo-1-slider-sec">
    <div class="row">
        <div class="container-fluid">
          <div class="carousal6-main">     
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

                    <img class="w-100 desktop_slider_view_44 carousal-6-img-height  object-fit-unset"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 mobile_slider_view_44"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 tab_slider_view_44"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">

                    @if($slides_data->con_name == '')
                    </a>
                    @endif 

                    <div class="intro-slide">
                      <div class="intro">
                      @if($slides_data->con_title != '')
                        <div class="title">
                       
                          <h3>{{$slides_data->con_title}}</h3>
                         
                        </div>
                        @endif 
                        <div class="content">
                        @if($slides_data->con_description != '')
                          <h4>{{$slides_data->con_description}}</h4>
                          @endif 
                        </div>
                        <div class="action">
                        @if($slides_data->con_name != '')
                          <a class="common-hover" href="'.$slides_data->url .'">

                            @if($slides_data->type == 'category')
                          <a class="common-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                        @elseif($slides_data->type == 'product')
                          <a class="common-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                        @elseif($slides_data->type == 'mostliked')
                          <a class="common-hover" href="{{ URL::to('shop?type=mostliked')}}">
                        @elseif($slides_data->type == 'topseller')
                          <a class="common-hover" href="{{ URL::to('shop?type=topseller')}}">
                        @elseif($slides_data->type == 'special')
                          <a class="common-hover" href="{{ URL::to('shop?type=special')}}">
                        @elseif($slides_data->type == 'link')
                          <a class="common-hover" href="{{ $slides_data->url }}">
                        @elseif($slides_data->type == 'externallink')
                          <a class="common-hover" href="{{ $slides_data->url }}" target="_blank">
                        @endif 
                            
                          {{$slides_data->con_name}}</a> @endif 
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
</div>