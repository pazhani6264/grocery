<!-- Bootstrap Carousel Content Full Screen -->
<style>

.carousal9-main {
    height: 100% !important;
}


.desktop_slider_view_44 {
  height: 560px !important;
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

.slick-slide {
    padding:0 !important;
}

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
    text-align: center;
    top: auto;
    bottom: 60px;
    right: 0;
    left: 0;
    width: 300px;
    margin: auto;
}
.categories-content .slick-disabled {
    display: block !important;
}
.demo-3-banner-20-btn-new{
  padding:0.8rem 2rem !important;
}

.demo-3-banner-20-btn-new:hover
{
  background:#000 !important;
  color:#fff;
  border-color:#000 !important;
}    
.intro-subtitle {
    font-size: 16px;
    font-weight: 300;
    color: #fff;
    margin-bottom:5px;
   
}
.intro-title {
    font-size: 70px;
    margin-bottom: 7px;
    color: #fff;
    font-weight: 700;
    line-height: 0.9;
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
    background-color: #9ACE69 !important;
    color: #fff !important;
    outline: none;
    border: none;
    opacity: 1;
}

.slider-arrow-9 .slider-next {
    right: 15% !important;
}
.slider-arrow-9 .slider-prev {
    left: 15% !important;
}
.slider-arrow-9 .slider-prev:hover, .slider-arrow-9 .slider-prev:focus, .slider-arrow-9 .slider-next:hover, .slider-arrow-9 .slider-next:focus {
    background-color: #fff !important;
    color: #333 !important;
    outline: none;
    border: none;
    opacity: 1;
}

.slider-arrow-9 .slider-prev, .slider-arrow-9 .slider-next {
    font-size: 2rem;
    line-height: 0;
    border: 0px solid;
    border-radius: 50px;
    width: 60px;
    height: 60px;
    position: absolute;
    top: 50%;
    display: block;
    padding: 0;
    transform: translate(0, -50%);
    cursor: pointer;
    color: grey;
    outline: none;
    background: #fff;
    opacity: 1 !important;
    z-index: 1;
}
.slider-arrow-9 .slider-prev:before, .slider-arrow-9 .slider-next:before {
    font-family: "Font Awesome 5 Free";
    font-size: 30px;
    line-height: 60px;
    opacity: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.slider-arrow-9 .slider-prev.slick-disabled:before, .slider-arrow-9 .slider-next.slick-disabled:before {
  opacity: 1 !important;
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
    bottom: 220px;
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
    .intro-title {
font-size: 50px !important;
margin-bottom: 7px;
color: #fff;
font-weight: 700;
line-height: 0.9;
}
.carousel-6-container-outer {
position: absolute;
text-align: center;
top: auto;
bottom: 200px;
right: 0;
left: 0;
width: auto !important;
margin: auto;
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
        <div class="container-fluid slider-arrow-9 p-0">
            <div class="carousel-carousel-js-54">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick">
                <div class="carousal9-main">    
                  
              

                        <img class="w-100 desktop_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                        <img class="w-100 tab_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">
                        <img class="w-100 mobile_slider_view_44 carousal-9-img object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                     

                      <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
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


<script>

(function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-54');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: true,
          autoplay: false,
          autoplaySpeed: 300,

          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding:20px" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding:20px" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="18" height="18" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',


          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
              arrows: false,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
              arrows: false,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
  </script>