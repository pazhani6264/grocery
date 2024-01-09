<!-- Bootstrap Carousel Content Full Screen -->
<style>



.desktop_slider_view {
  height: 430px !important;
  object-fit:cover !important;
}
.mobile_slider_view{
  height: 440px !important;
  object-fit:cover !important;
}
.tab_slider_view{
  height: 440px !important;
  object-fit:cover !important;
}

  .slick-track {
    display: flex !important;
  }
  .demo-34-car-1-img-outer
  {
    position: relative;
  }

  .demo-34-banner-overlay:focus:after, .demo-34-banner-overlay:hover:after {
    visibility: visible;
    opacity: 1;
}

.demo-34-banner-overlay:after {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: hsla(0,0%,100%,.2);
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
}

  .demo-34-car-1-content {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 6.1%;
    margin-top: -4px;
    display: inline-block;
    z-index: 2;
    text-align: left;
}
.demo-34-car-1-price {
    font-size: 18px;
    letter-spacing: 1px;
    line-height: 1.5;
    color: #fff;
    font-weight: 500!important;
    color: #d33e3e!important;
    margin-bottom:10px;
}
.demo-34-car-1-title {
    font-size: 46px;
    line-height: 1;
    letter-spacing: 1px;
    font-weight: 700!important;
    color: #2f4787;

}
.demo-34-banner-btn:hover {
    color: #fff !important;
}
.demo-34-banner-btn {
    padding: 12px 0;
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 600 !important;
    letter-spacing: 1px;
    border-bottom: solid 2px;
}

.demo-34-car-1-btn {
    min-width: 160px;
    padding-top: 12px;
    padding-bottom: 12px;
    font-size: 15px;
    color: #222;
}
.demo-34-car-1-btn:hover {
background-color: #d33e3e !important;
    border-color: #d33e3e !important;
}
.demo-34-car-1-title-2 {
  margin-bottom: 24px;
    font-size: 60px;
    letter-spacing: 1px;
    color: #d33e3e!important;
    font-weight: 700!important;
    /* width: 65%; */
}




  .demo-34-car-content {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 8.2%;
    margin-top: -4px;
    display: inline-block;
    z-index: 2;
    text-align: left;
}
.demo-34-car-price {
    font-size: 34px;
    letter-spacing: 1px;
    line-height: 1.5;
    color: #fff;
    font-weight: 700!important;
}
.demo-34-car-title {
    font-size: 20px;
    margin-bottom: 20px;
    letter-spacing: 1px;
    color: #fff;
    font-weight: 600!important;
    /* width: 65%; */
}

.demo-34-car-price-2 {
    font-size: 20px;
    letter-spacing: 1px;
    line-height: 1.5;
    color: #fff;
    font-weight: 600!important;
}
.demo-34-car-title-2 {
    font-size: 34px;
    margin-bottom: 20px;
    letter-spacing: 1px;
    color: #fff;
    font-weight: 700!important;
    /* width: 65%; */
}
.slick-list {
  height: 100% !important;
}
.csal7-padd{
  padding-right: 5px;
}
.carousal-34-container
{
  padding-left:10px !important;
  padding-right:10px !important;

}
.carousal-34-setion {
    margin-top: 20px;
}
.carousal-34-setion .slick-dots {
    position: absolute !important;
    margin-top: 0 !important;
    bottom: 50px;
    left: 6.1%;
    text-align: left;
}


.carousal-34-setion  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.carousal-34-setion .slick-dots li button {
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
.carousal-34-setion .slick-dots li button::after {
    content: unset;
}
.carousal-34-setion  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}
@media only screen and (min-width: 769px) and (max-width: 1000px){
  .carousal-34-setion .tab-col-md-6s {
    flex: 0 0 50% !important;
    max-width: 50% !important;
}
}
@media only screen and (min-width: 600px) and (max-width: 1000px){
.carousal-34-setion .carousal-34-img-one{
   padding-right: 0 !important;
}
}

@media only screen and (min-width: 320px) and (max-width: 800px){
  .csal7-padd{
    padding-right: 15px;
  }
}
@media only screen and (min-width: 700px) and (max-width: 800px){
  .csal7-padd-banner{
    padding-right: 5px;
  }
}
@media only screen and (max-width: 600px){
.demo-34-car-1-title {
    font-size: 38px;
  

}

.demo-34-car-1-title-2 {

    font-size: 40px;
    
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

<section class="categories-content categories-sec-content text-center carousal-34-setion @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
      <div class="container-fluid carousal-34-container">
        <div class="row">
          <div class="col-12 col-lg-8 mb-20 csal7-padd">
            <div class="carousal7-main">     
              <div class="carousel-carousel-js-34">     
                @foreach($result['slides'] as $key=>$slides_data)
                  <div class="slick demo-34-car-1-img-outer">

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

                       
                          <img class="w-100 carousal-7-img desktop_slider_view object-fit-unset lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                      
                          <img class="w-100 mobile_slider_view carousal-7-img lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" height="100%"  alt="First slide">
                       

                          @if($slides_data->con_name == '')   
                    </a>
                    @endif 

                      <div class="demo-34-car-1-content">
                      @if($slides_data->con_title != '')
                      <div class="demo-34-car-1-price">{{$slides_data->con_title}}</div>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h3 class="demo-34-car-1-title">{{$slides_data->con_description}}</h3>
                      @endif 
                      @if($slides_data->con_description2 != '')
                      <h3 class="demo-34-car-1-title-2">{{$slides_data->con_description2}}</h3>
                      @endif 


                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn-secondary demo-34-car-1-btn btn   banner-link common-fill-color" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn-secondary demo-34-car-1-btn btn  banner-link common-fill-color " href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                  
                      <span >{{$slides_data->con_name}}</span><i class="fas fa-angle-right" style="margin-left:10px;"></i>
                      </a>
                      @endif

               
               
               
              </div>
             

                  </div>
                @endforeach     
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4 molla-carousal-7"> 
            <div class="row">
            <div class="col-12 col-lg-4 tab-col-md-6s carousal-34-img-one csal7-padd-banner"> 
              <div class="group-banners left-thumb-height-7">
                @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                          @if($homeBanners->type==180)
                         

                          <div class="demo-34-banner-img-outer demo-34-lazy-media ">
                          <figure class="banner-image imagespace demo-34-banner-overlay">
                            <a href="{{ $homeBanners->banners_url}}">
                           
                            
                                <img class="img-fluid lazy_img_load" data-src="{{asset($homeBanners->path)}}" alt="Banner Image">
                              
                                
                            </a>
                         

                          <div class="demo-34-car-content">
                <div class="demo-34-car-price">{{$homeBanners->title}}</div>
                <h3 class="demo-34-car-title">{{$homeBanners->description}}</h3>
                <a class="demo-34-banner-btn common-color" href="{{$homeBanners->banners_url}}">{{$homeBanners->name}}<i class="fas fa-angle-right" style="margin-left:10px;"></i></a></div>
                </figure>
                </div>
                
                          @endif
                      @endforeach
                  @endif 
                  </div>
              </div>

              <div class="col-12 col-lg-4 tab-col-md-6s"> 
              <div class="group-banners left-thumb-height-7">
                @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                          @if($homeBanners->type==181)
                        
                          <div class="demo-34-banner-img-outer demo-34-lazy-media">
                          <figure class="banner-image imagespace demo-34-banner-overlay">
                            <a href="{{ $homeBanners->banners_url}}">
                          
                         
                                <img class="img-fluid lazy_img_load" data-src="{{asset($homeBanners->path)}}" alt="Banner Image">
                             
                            </a>
                         
                          <div class="demo-34-car-content">
                <div class="demo-34-car-price-2">{{$homeBanners->title}}</div>
                <h3 class="demo-34-car-title-2">{{$homeBanners->description}}</h3>
                <a class="demo-34-banner-btn common-color" href="{{$homeBanners->banners_url}}">{{$homeBanners->name}}<i class="fas fa-angle-right" style="margin-left:10px;"></i></a>
              </div>
              </figure>

              </div>

                          @endif
                      @endforeach
                  @endif 
                  </div>
              </div>
              </div>
              </div>
          </div>

       

          </div>
        </div>
      </div>
</section>

<script>

  
(function (jQuery) {
  var tabCarousel = jQuery('.carousel-carousel-js-34');

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
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll:1,
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


</script>
