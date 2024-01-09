<!-- Bootstrap Carousel Content Full Screen -->
<style>
  .slick-track {
    display: flex !important;
  }
  .carousal7-main .slick-slide{
    padding: 0 0px !important;
  }
.slick-list {
  height: 100% !important;
}
.csal7-padd{
  padding-right: 5px;
}
.slick-slide {
    position:relative;
  }

  .carousel-6-container-outer {
    position: absolute;
    width: 400px;
    text-align: left;
    top: -311px;
    bottom: 0;
    left: 10%;
}
.intro-subtitle {
    font-size: 20px;
    font-weight: 300;
    color: #fff;
    margin-bottom:5px;
   
}
.carousal7-main {
    position: relative;
    border: 0px solid;
    height: 100% !important;
}


.desktop_slider_view_44 {
  height: 430px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 430px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 630px !important;
  object-fit:cover !important;
}

.demo-2-banner-20-btn-new {
    border: solid 1px #fff;
    color: #fff;
}

.demo-2-banner-20-btn-new:hover
{
  background-color: #fff; 
  border: solid 1px #fff; 
}
.demo-2-side-banner-content-outer
{
  position: relative;
}
.demo-2-side-banner-content {
    position: absolute;
    width: 175px;
    top: 36px;
    z-index: 2;
    left: 30px;
    padding: 7px 0 0 10px;
    text-align: left;
}

.demo-2-side-banner-20-title {
    color: #777;
    font-weight: 300;
    font-size: 16px;
    line-height: 1.2;
    letter-spacing: 0;
    margin-bottom: 10px;
}

.demo-2-side-banner-20-p{
    color: #333;
    font-weight: 500;
    font-size: 20px;
    line-height: 1.3;
    margin-bottom: 15px;
}
.demo-2-side-banner-20-btn-new
{
  font-size: 14px;
  font-weight: 400;
  display: inline-block;
}
.demo-2-side-banner-20-btn-new:hover
{
  text-decoration: underline;
}

.intro-title {
    font-size: 52px;
    margin-bottom: 12px;
    color: #fff;
    font-weight: 700;
    line-height: 1.2;
}
.banner-link
{
  fill: #fff;
}
.intro-title span {
    font-weight: 300;
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
.intro-title {
    font-size: 30px;
}
.carousel-6-container-outer {
    width: 300px;
  
}
.intro-subtitle {
    font-size: 13px;
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

<section class="categories-content categories-sec-content text-center carousal-7-setion @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif" style="background-image: url('intro-bg.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8 mb-20 csal7-padd">
            <div class="carousal7-main">     
              <div class="carousel-carousel-js-6">     
                @foreach($result['slides'] as $key=>$slides_data)
                  <div class="slick ">



                          <img class="w-100 desktop_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
                          <img class="w-100 mobile_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
                          <img class="w-100 tab_slider_view_44 lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">
                       

                          <div class="row">
                    <div class="container" style="position:relative;">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle">{{$slides_data->con_title}}</h3>
                      <h1 class="intro-title">{{$slides_data->con_description}}
                      </h1>
                      @if($slides_data->con_name != '')
                      @if($slides_data->type == 'category')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                      @elseif($slides_data->type == 'product')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                      @elseif($slides_data->type == 'mostliked')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=mostliked')}}">
                      @elseif($slides_data->type == 'topseller')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=topseller')}}">
                      @elseif($slides_data->type == 'special')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover" href="{{ URL::to('shop?type=special')}}">
                      @elseif($slides_data->type == 'link')
                      <a class="btn btn-outline-white demo-2-banner-20-btn-new common-hover banner-link common-fill-hover"  href="{{ $slides_data->url }}">
                      @elseif($slides_data->type == 'externallink')
                        <a class="btn btn-outline-white demo-2-banner-20-btn-new  common-hover banner-link common-fill-hover" href="{{ $slides_data->url }}" target="_blank">
                      @endif 
                      
                      <span >{{$slides_data->con_name}}</span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 33.908 19.619" style="margin-left: 10px;">
                        <path id="arrow_right" d="M28.861,11.627a1.335,1.335,0,0,0-.01,1.88l6.212,6.223L6.928,19.342a1.328,1.328,0,0,0,0,2.657l28.125.388-6.212,6.223a1.345,1.345,0,0,0,.01,1.88,1.323,1.323,0,0,0,1.87-.01L39.14,22h0a1.492,1.492,0,0,0,.276-.419,1.268,1.268,0,0,0,.1-.511,1.332,1.332,0,0,0-.378-.93l-8.42-8.481A1.3,1.3,0,0,0,28.861,11.627Z" transform="translate(-5.61 -11.252)"/>
                      </svg>
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
         
          <div class="col-12 col-lg-4 molla-carousal-7"> 
            <div class="row">
            <div class="col-12 col-lg-4 tab-col-md-6s csal7-padd-banner"> 
              <div class="group-banners left-thumb-height-7">
                @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                          @if($homeBanners->type==180)
                          <div class="demo-2-side-banner-content-outer">
                          <figure class="banner-image imagespace">
                            
                            <div class="banner-overlay"></div>
                          
                                <img class="img-fluid lazy_img_load" data-src="{{asset($homeBanners->path)}}" alt="Banner Image">
                             
                                
                            
                          </figure>
                          <div class="demo-2-side-banner-content">
                          <h3 class="demo-2-side-banner-20-title">{{$homeBanners->title}}</h3>
                          <p class="demo-2-side-banner-20-p">{{$homeBanners->description}}</p>
                          <a class="demo-2-side-banner-20-btn-new common-color" href="'.$homeBanners->banners_url.'">{{$homeBanners->name}}</a>
                          </div>
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
                          <div class="demo-2-side-banner-content-outer">
                          <figure class="banner-image imagespace">
                           
                            <div class="banner-overlay"></div>
                                <img class="img-fluid lazy_img_load" data-src="{{asset($homeBanners->path)}}" alt="Banner Image">
                          
                          </figure>
                          <div class="demo-2-side-banner-content">
                          <h3 class="demo-2-side-banner-20-title">{{$homeBanners->title}}</h3>
                          <p class="demo-2-side-banner-20-p">{{$homeBanners->description}}</p>
                          <a class="demo-2-side-banner-20-btn-new common-color" href="'.$homeBanners->banners_url.'">{{$homeBanners->name}}</a>
                          </div>
                          </div>
                          @endif
                      @endforeach
                  @endif 
                  </div>
              </div>
              </div>
              </div>
          </div>

         <section class="categories-content categories-sec-content" style="margin-top:30px;">
       <div class="row">
       <div class="container">
       <div class="brand-carousel-js">
        <?php 
         $result = DB::table('manufacturers')
         ->LeftJoin('image_categories', 'manufacturers.manufacturer_image', '=', 'image_categories.image_id')
         ->select('image_categories.path_type as image_path_type','image_categories.path','manufacturers.manufacturer_name as url')->where('image_categories.image_type', 'ACTUAL')->orderBy('manufacturers.manufacturers_id', 'ASC')
        ->get(); 
        
        foreach($result as $brand) { ?>
           <div class="slick">
           
               <a href="'.url('/shop?brand='.$brand->url).'">
           
           <div class="brand-main-2">
            <?php 
            if($brand->image_path_type == 'aws')
            {
              ?>
               <img class="brandimg lazy_img_load" data-src="{{ $brand->path }}" alt="brand image"/>
               <?php }
            else
            {
              ?>
               <img class="brandimg lazy_img_load" data-src="{{ asset('').$brand->path }}" alt="brand image"/>
               <?php }
            ?>
            
           </div>
           </a>
           </div>
            
        <?php } ?>
       </div>                 
       </div>                 
       </div>                 
       </section>    

          </div>
        </div>
      </div>
</section>
