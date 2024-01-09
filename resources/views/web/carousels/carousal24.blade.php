<!-- Bootstrap Carousel Content Full Screen -->
<style>

.demo-34-s-slick  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.carousal38-main 
{
  position: relative;
  height:100% !important;
}




.desktop_slider_view_44 {
  height: 660px !important;
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
   position: absolute;
    left: 34%;
    right:0;
    top: 50%;
    z-index: 10;
    --webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-top: -0.8rem;
    max-width: 50%;
    width: 90%;
    margin: auto;
    text-align: left !important;
}

.demo-32-carousal-title {
    margin-bottom: 24px;
    font-size: 14px;
    color: #000;
    letter-spacing: 1px;
    font-weight: 400!important;
}

.demo-32-carousal-sub-title-1 {
    font-size: 80px;
    color: #000;
    line-height: 1;
    letter-spacing: 1px;
    font-weight: 600!important;
    margin-bottom: 0!important;
}
.demo-32-carousal-sub-title-2 {
    font-size: 80px;
    line-height: 1;
    letter-spacing: 1px;
    margin-left: 117px;
    margin-bottom: 30px;
}

.demo-32-carousal-btn{
    min-width: 240px;
    margin-left: 117px;
    padding: 15px;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 14px;
    border: solid 1px;
}

.demo-32-carousal-btn:hover
{
  color: #fff !important;
  border: solid 1px transparent;
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
    padding: 0 !important;
}
.carousal-38-setion .slick-dots {
    position: absolute !important;
    margin: 0 !important;
    bottom: 80px;
    left: 46%;
    text-align: center;
    width: 25%;
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


.carousal-38-setion .slick-dotted.slick-slider {
    margin-bottom: 0px; 
}

  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
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
.carousal38-main .intro-content {
    left: 15%;
    max-width: 90%;
    width: 100%;
}
.demo-32-carousal-sub-title-2 {
    margin-left: 0;
}
.demo-32-carousal-btn {
    margin-left: 0;
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
    left: 0;
    -webkit-transform: unset;
    transform: unset;
    margin-top: -0.8rem;
    max-width: 90%;
    width: 100%;
    margin: auto;
}
.demo-32-carousal-sub-title-1 {
    font-size: 40px;
}
.demo-32-carousal-sub-title-2 {
    font-size: 40px;
}
 
}

@media only screen and (max-width: 360px){
 
  .carousal-38-setion .intro-content {
    top: 38%;
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

<section class="categories-content carousal-38-setion categories-sec-content text-center @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
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
                          <h1 class="demo-32-carousal-title">{{$slides_data->con_title}}</h1>
                        @endif
                        @if($slides_data->con_description != '')
                          <h1 class="demo-32-carousal-sub-title-1">{{$slides_data->con_description}}</h1>
                        @endif
                        @if($slides_data->con_description2 != '')
                          <h3 class="demo-32-carousal-sub-title-2 common-color">{{$slides_data->con_description2}}</h3>
                        @endif
                        @if($slides_data->con_name != '')

                        @if($slides_data->type == 'category')
                      <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn  demo-32-carousal-btn common-color banner-link  common-fill common-bg-hover" href="{{ $slides_data->url }}" target="_blank">
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
          dots: true,
          arrows: false,
          infinite: false,
          autoplay: false,
          autoplaySpeed: 2000,

		//   prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    	//   nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',

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
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
              dots: true,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


</script>
