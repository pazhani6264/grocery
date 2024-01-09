<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }
  .carousal7-main {
    height: 100% !important;
} 


.desktop_slider_view_44 {
  height: 500px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 500px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 700px !important;
  object-fit:cover !important;
}

.demo-9-carousel .slick-slide {
outline: none;
padding: 0px !important;
}
.slick-list {
  height: 100% !important;
}
.fill-color-arrow-car
{
  fill: #fff;
}

.demo-2-banner-20-btn-new {
  margin-top:14px;
    color: #fff;
    padding: 12px 32px;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}


.carousel-6-container-outer {
    position: absolute;
    width: 65%;
    text-align: left;
    top: -400px;
    bottom: 0;
    left: 170px;
    right: 0;
    
    text-align:left;
}
.intro-subtitle {
    font-size: 16px;
    font-weight: 300;
    color: #fff;
    margin-bottom: 4px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.intro-title {
  font-size: 60px;
    margin-bottom: 2px;
    color: #fff;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 2px;
    text-transform: capitalize;
}
.intro-des-2
{
  font-size: 60px;
    margin-bottom: 2px;
    color: #fff;
    font-weight: 200;
    line-height: 1;
    letter-spacing: 2px;
    text-transform: uppercase;
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
.order-2{
    order:1;
  }
  .order-1{
    order:2;
  }
#flex { display: flex; flex-direction: column; }
@media screen and (max-width: 992px){
  .intro-title {
  font-size: 40px;

  
    
}

.carousel-6-container-outer {
position: absolute;
width: 65%;
text-align: left;
top: -550px;
bottom: 0;
left: 170px;
right: 0;
text-align: left;
}

.carousel-6-container-outer {
    left: 40px;
  
}
  .order-2{
    order:2;
  }
  .order-1{
    order:1;
  }
  .info-bg-6-carousal {
      background: #222;
      margin: 0px 10px;
  }
}
@media screen and (max-width: 600px){
  .intro-title {
  font-size: 30px;
    
}

.carousel-6-container-outer {
   width: 90%;
  
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

<div id="flex" class="@if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">

    <section class="boxes-contents info-bg-6-carousal  text-center order-2">
      <div class="container">
        <div class="infobox-carousel-14" style="padding: 15px 0px 0px 0px;">
         <?php
          $shoppinginfo = DB::table('shopping_info')
          ->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id','=','shopping_info.shopping_info_id')
          ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'shopping_info.shopping_info_icon')
          ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'shopping_info.shopping_info_icon')
          ->select('shopping_info.*',
              'shopping_info_description.*',
              'ImageTable.path as path',
              'ImageTable.path_type as image_path_type',
              'IconTable.path as iconpath',
          )
          ->where('shopping_info_description.language_id',Session::get('language_id'))
          ->groupBY('shopping_info.shopping_info_id')
          ->get();
          foreach(($shoppinginfo) as $info){
          ?>
            <div class="info-box first slick">
           <div class="panel">
           <?php
            if($info->type==1){
            ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
               <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
               <h4 class="title text-white" style="text-align:left"> {{ $info->shopping_info_name }}</h4>
               <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
               </div>
               <?php } ?>
               <?php
               if($info->type==2)
            {
              ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
               <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
               <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
               <p class="info-color-p-1" style="text-align:left"> {{ $info->shopping_info_description }}</p>
               </div>
               <?php } ?>
               <?php if($info->type==3)
            {
              ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
               <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
               <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
               <p class="info-color-p-1" style="text-align:left"> {{ $info->shopping_info_description }}</p>
               </div>
               <?php } ?>
               <?php if($info->type==4)
            {
              ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
               <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
               <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
               <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
               </div>
               <?php } ?>
           </div>
           </div>
           <?php } ?>
        </div>
      </div>
    </section>

<section class="categories-content categories-sec-content demo-9-carousel text-center carousal-14 bg-height-14 order-1">
      <div class="carousal-14-mobile">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="carousal7-main slider-arrow-14">     
              <div class="carousel-carousel-js-14">     
                @foreach($result['slides'] as $key=>$slides_data)
                  <div class="slick ">
               
                  
                        <img class="w-100 carousal-14-img desktop_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" alt="First slide">
                        <img class="w-100 carousal-14-img mobile_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" alt="First slide">
                        <img class="w-100 carousal-14-img tab_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" alt="First slide">

                       

                        <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      <h1 class="intro-title">{{$slides_data->con_description}}</h1>
                      <h1 class="intro-des-2">{{$slides_data->con_description2}}</h1>
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-secondary demo-2-banner-20-btn-new"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-secondary demo-2-banner-20-btn-new" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      
                      <span >{{$slides_data->con_name}}</span>
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
        </div>
      </div>
</section>
            </div>

<script>
  var tabCarousel = jQuery('.infobox-carousel-14');

    if (tabCarousel.length) {

      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  4,
          slidesToScroll:  4,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      });
    };
  </script>