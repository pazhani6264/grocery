<?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
if($margin_between->value == 20){$bottom = 10;}
elseif($margin_between->value == 30){$bottom = 15;}
elseif($margin_between->value == 40){$bottom = 20;}
elseif($margin_between->value == 50){$bottom = 25;}
elseif($margin_between->value == 60){$bottom = 30;}
?>

<div class="row @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
  <div class="col-12">
    <div class="slideshow" id="slider_40_fadeout">
      <div class="slider">
        @foreach($result['slides'] as $key=>$slides_data)
        
          <div class="item">
          @if($slides_data->con_name != '')
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
            
            <img class="w-100 desktop_slider_view_40"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
            <img class="w-100 mobile_slider_view_40"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
            <img class="w-100 tab_slider_view_40"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">
            </a>
          </div>
        @endforeach     
      </div>
    </div>
  </div>
</div>

<style>
  #slider_40_fadeout .slick-slide {
    height: 100% !important;
  }
  #slider_40_fadeout .slick-prev, #slider_40_fadeout .slick-next {
    font-size: 0;
    line-height: 0;
    position: absolute;
    top: unset;
    display: block;
    width: 40px;
    height: 40px;
    padding: 0;
    transform: translate(0, -50%);
    cursor: pointer;
    color: transparent;
    border: none;
    outline: none;
    background: transparent;
    bottom: -20px;
    z-index: 100;
  }
  #slider_40_fadeout .slick-prev:before, #slider_40_fadeout .slick-next:before {
    font-family: 'slick';
    font-size: 40px;
    line-height: 1;
    opacity: .75;
    color: white;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  #slider_40_fadeout {
    position: relative;
    z-index: 1;
    /* height: 100% !important; */
    max-width: 100%;
    padding-bottom:0%;
  }


.desktop_slider_view_40 {
  height: 302px !important;
  object-fit:cover !important;
}
.mobile_slider_view_40{
  height: 360px !important;
  object-fit:cover !important;
}
.tab_slider_view_40{
  height: 200px !important;
  object-fit:cover !important;
}

  #slider_40_fadeout .slider-track {
    transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
  }
  #slider_40_fadeout  .item {
    height: 100%;
    position: relative;
    z-index: 1; 
    padding:0;
  }
  #slider_40_fadeout .item img {
    width: 100%;
    /* height: 100% !important; */
    transition: all 0.5s cubic-bezier(0.7, 0, 0.3, 1);
    transform: scale(1.12);
  }
  #slider_40_fadeout .slick-active img {
    transform: scale(1);
  }
  #slider_40_fadeout .slick-arrow:hover {
    transform: scale(1.12);
    bottom: -20px;
  }
  #slider_40_fadeout .slick-arrow:active {
    transform: scale(1);
    bottom: -20px;
  }
  #slider_40_fadeout .slider-next {
    width: 40px;
    height: 40px;
    line-height: 20px;
    margin-top: -3.5px;
    background-color: #fff !important;
    left: auto;
    right: 40px;
    top: unset;
    border-radius: 50%;
    padding: 0;
    z-index: 100;
    bottom: -40px;
    padding: 8px 15px;
  }
  #slider_40_fadeout .slider-prev {
    width: 40px;
    height: 40px;
    line-height: 21px;
    margin-top: -3.5px;
    background-color: #fff !important;
    left: auto;
    right: 90px;
    top: unset;
    border-radius: 50%;
    padding: 0;
    z-index: 100;
    bottom: -40px;
    padding: 8px 13px;
  }
  #slider_40_fadeout .slider-prev:before, #slider_40_fadeout .slider-next:before {
    font-size: 22px;
    color: #000;
  }
  .desktop_slider_view_40 {
    display: block !important;
  }
  .mobile_slider_view_40 {
    display: none !important;
  }
  .tab_slider_view_40 {
    display: none !important;
  }

  @media only screen and (max-width: 992px) {
    #slider_40_fadeout {
      padding-bottom:3%;
    }
    .desktop_slider_view_40 {
      display: none !important;
    }
    .mobile_slider_view_40 {
      display: none !important;
    }
    .tab_slider_view_40 {
      display: block !important;
    }
    #slider_40_fadeout .slick-arrow:hover {
    bottom: -17px;
    }
    #slider_40_fadeout .slider-prev:before, #slider_40_fadeout .slider-next:before {
      font-size: 18px;
    }
      #slider_40_fadeout .slider-next {
      width: 33px;
      height: 33px;
      bottom: -33px;
      right: 20px;
      padding: 2px 13px;
    }
    #slider_40_fadeout .slider-prev {
      width: 33px;
      height: 33px;
      bottom: -33px;
      right: 60px;
      padding: 2px 11px;
    }
  }

  @media only screen and (max-width: 600px) {
    #slider_40_fadeout {
      padding-bottom:53%;
    }
    .desktop_slider_view_40 {
      display: none !important;
    }
    .mobile_slider_view_40 {
      display: none !important;
    }
    .tab_slider_view_40 {
      display: block !important;
    }
    #slider_40_fadeout {
    height: 0;
}
  }

</style>

<script>
  $('.slider').slick({
    draggable: true,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    dots: false,
    fade: true,
    speed: 500,
    infinite: true,
    cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
    prevArrow: '<div class="slider-arrow slider-prev fa fa-angle-left"></div>',
    nextArrow: '<div class="slider-arrow slider-next fa fa-angle-right"></div>',
    touchThreshold: 100
  })
</script>
