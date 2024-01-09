<!-- Bootstrap Carousel Content Full Screen -->
<style>

.demo-34-s-slick  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.demo-34-s-slick  .slick-dots li button {
    font-size: 0;
    line-height: 0;
    display: block;
    width: 8px !important;
    height: 8px !important;
    padding: 0px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
    border-radius: 20px;
    margin: 5px 6px;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.demo-34-s-slick .slick-dots li button::after {
    content: unset;
}
.demo-34-s-slick  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}
.carousal-38-setion .slick-slide {
    padding: 0 0px !important;
}

.carousal-38-setion .slick-dots {
    position: absolute !important;
    bottom: -25px;
    margin: 0 !important;
    bottom: 80px;
    right: 27.5%;
    text-align: center;
    width: 25%;
}
.carousal-38-setion .slick-dotted.slick-slider {
    margin-bottom: 0px; 
}

  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
  
.carousal-38-setion{
  margin-bottom:30px;
}
.carousal38-main 
{
  position: relative;
  height:100% !important;
}


.desktop_slider_view_44 {
  height: 650px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 640px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 600px !important;
  object-fit:cover !important;
}


.carousal38-main .intro-content {
    left: 50%;
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
    margin-top: -0.8rem;
    max-width: 500px;
    width: 90%;
    margin:auto;
}

.carousal38-main .intro-content {
    position: absolute;
    left: 0;
    right:0;
    top: 50%;
    z-index: 10;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}
.carousal38-main .intro-title {
    margin-bottom: 7px;
    font-size: 80px;
    letter-spacing: 0;
    line-height: 1.2;
}

.carousal38-main .intro-title-subtitle {
    margin-bottom: 22px;
    font-size: 20px;
    letter-spacing: -.01em;
    line-height: 2;
}
.carousal-38-setion .intro-text {
    margin-bottom: 2.2rem;
    font-size: 20px;
    letter-spacing: -.01em;
    line-height: 2rem;
}


.demo-10-banner-20-btn-new {
    margin-top:14px;
    background: #333;
    border:1px solid #333;
    padding: 12px 50px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #fff !important;
}
.demo-10-banner-20-btn-new:hover {
    border:1px solid transparent;
    color: #fff !important;
    fill: #fff !important;
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

@media only screen and (max-width: 991px){
  .desktop_slider_view_44 {
      display: none !important;
    }
    .mobile_slider_view_44 {
      display: none !important;
    }
    .tab_slider_view_44 {
      display: block !important;
    }
.carousal-38-setion .slick-dots {
    position: absolute !important;
    margin: 0 !important;
    bottom: 22px;
    right: 0;
    text-align: center;
    width: 100%;
    left: 0;
}
}

@media only screen and (max-width: 600px){
  .desktop_slider_view_44 {
      display: none !important;
    }
    .mobile_slider_view_44 {
      display: block !important;
    }
    .tab_slider_view_44 {
      display: none !important;
    }
  .carousal-38-setion .intro-content {
  left: 50%;
  -webkit-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
  margin-top: -0.8rem;
  max-width: 100%;
  width: 100%;
  margin: auto;
  }
  .carousal-38-setion .intro-title {
    margin-bottom: 0.7rem;
    font-size: 60px;
    letter-spacing: 0;
    line-height: 1.2;
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


<section class="categories-content carousal-38-setion categories-sec-content text-center @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif"  style="background-image: url('demo-31-bg.jpg');@if($current_theme->template == 0) padding:0 10px; @endif">
    <div class="row">
        <div class="container-fluid">
            <div class="demo-34-s-slick carousel-carousel-js-38">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                  <div class="carousal38-main ">  
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

                    <img class="w-100 desktop_slider_view_44" src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 tab_slider_view_44" src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">
                    <img class="w-100 mobile_slider_view_44" src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">

                    @if($slides_data->con_name == '')   
                    </a>
                    @endif 

                    <div class="intro-content text-center">
                      <div class="css-1b7c46">
                        @if($slides_data->con_title != '')
                          <h1 class="intro-title text-white">{{$slides_data->con_title}}</h1>
                        @endif
                        @if($slides_data->con_description != '')
                          <h1 class="intro-title-subtitle text-white">{{$slides_data->con_description}}</h1>
                        @endif
                        @if($slides_data->con_description2 != '')
                          <h3 class="intro-text text-white font-weight-normal">{{$slides_data->con_description2}}</h3>
                        @endif
                        @if($slides_data->con_name != '')

                        @if($slides_data->type == 'category')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                  


                          <span>{{$slides_data->con_name}}</span></a>
                        @endif
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
  var tabCarousel = jQuery('.carousel-carousel-js-38');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 1000,
          slidesToShow:  1,
          slidesToScroll:  1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false,
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: false,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


</script>
