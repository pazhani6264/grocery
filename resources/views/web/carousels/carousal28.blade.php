<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
.carousal10-main {
    position: relative;
    border: 0px solid;
    height: 100% !important;
}


.desktop_slider_view_44 {
  height: 800px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 800px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 800px !important;
  object-fit:cover !important;
}

.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}

 .intro-content {
    width: 740px;
    max-width: 85%;
    margin-left: auto;
    margin-right: auto;
    position: absolute;
    left: 0;
    right:0;
    top: 35%;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -ms-transform: translateY(0);
    border-color: #fff;
    border-style: solid;
    border-width: 0 0.1rem;
    padding: 4.2rem 2rem;
}
 .intro-subtitle.cross-txt {
    top: 0;
}
 .intro-subtitle {
    font-weight: 400;
    font-size: 0.85rem;
    line-height: 1;
    letter-spacing: .1em;
    text-transform: uppercase;
}
.cross-txt {
    position: absolute;
    left: -1px;
    right: -1px;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    display: flex;
    align-items: center;
}
.cross-txt:before {
    margin-right: 2rem;
}
.cross-txt:after {
    margin-left: 2rem;
}
.cross-txt:after, .cross-txt:before {
    content: "";
    flex: 1 1;
    height: 1px;
    background: #fff;
}
 .intro-title {
    font-weight: 700;
    font-size: 5rem;
    line-height: 1;
    letter-spacing: .01em;
    margin-top: 1rem;
    margin-bottom: 1.3rem;
    text-transform: uppercase;
}
 .intro-text {
    font-weight: 400;
    font-size: 1.4rem;
    line-height: 1.2;
    letter-spacing: .01em;
    text-transform: uppercase;
}
 .intro-content .intro-action.cross-txt {
    bottom: 0;
    -webkit-transform: translateY(50%);
    transform: translateY(50%);
}
.carousal-hover:hover{
  color:#fff !important;
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
@media screen and (min-width: 1200px){
   .intro-title {
      font-size: 5.75rem;
  }
   .intro-text {
    font-size: 1.45rem;
  }
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

<section class="categories-contents categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
            <div class="carousel-carousel-js-10">     
              @foreach($result['slides'] as $key=>$slides_data)
                <div class="slick ">
                  <div class="carousal10-main ">     
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


                    <div class="intro-content text-center">
                      @if($slides_data->con_title != '')
                      <h3 class="intro-subtitle cross-txt common-text">{{$slides_data->con_title}}</h3>
                      @endif 
                      @if($slides_data->con_description != '')
                      <h1 class="intro-title text-white">{{ $slides_data->con_description  }}</h1>
                      @endif 
                      @if($slides_data->con_description2 != '')
                      <div class="intro-text text-white">{{ $slides_data->con_description2  }}</div>
                      @endif 
                      <div class="intro-action cross-txt">


                      @if($slides_data->con_name != '')
                        @if($slides_data->type == 'category')
                      <a class="common-text carousal-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a class="common-text carousal-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a class="common-text carousal-hover" href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a cclass="common-text carousal-hover" href="{{ URL::to('shop?type=topseller')}}">
                    @elseif($slides_data->type == 'special')
                      <a class="common-text carousal-hover" href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                      <a class="common-text carousal-hover" href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a class="common-text carousal-hover" href="{{ $slides_data->url }}" target="_blank">
                    @endif 

                        <a class="common-text carousal-hover" href="/shop">
                          <span>{{ $slides_data->con_name  }}</span>
                        </a>
                        @endif 
                      </div>
                    </div>


                    </div>
                   
                </div>
              @endforeach     
      </div>
</section>
