<!-- Bootstrap Carousel Content Full Screen -->
<style>



.desktop_slider_view_44 {
  height: 440px !important;
  object-fit:cover !important;
}
.mobile_slider_view_44{
  height: 486px !important;
  object-fit:cover !important;
}
.tab_slider_view_44{
  height: 640px !important;
  object-fit:cover !important;
}

.b67icon{
margin-left: 5px;
padding: 3px;
border-radius: 50%;
width: 20px;
height: 20px;
}

.carousal-33-banner-img
{
  width: 100%;
}
.intro-subtitle{
  font-size:16px;
}
.demo-28-margin
{
  margin: 0 15px;
}
.intro-title {
    color: #fff;
    font-size: 44px;
    font-weight: 700;
}
.intro-des-2{
  font-size:44px;
}
.demo-28-padding-ban {
    padding: 0 15px 0 10px !important;
} 
.demo-3-banner-20-btn-new {
    padding: 12px 41px;
}
.carousel-6-container-outer
{
  width: 34%;
}
.banner-content33 {
    display: flex;
    flex-direction: column;
    padding-top: 0;
    top: 50%;
    left: 2rem;
    bottom: 3.2rem;
    -webkit-transform: translateY(0);
    transform: translateY(-50%);
    position: absolute;
}
  .banner-content33 .banner-subtitle {
    font-weight: 300;
    font-size: 1rem;
    letter-spacing: -.01em;
    margin-bottom: 0rem;
    text-align:left;
    margin-bottom: 10px;
  }
  .banner-content33 .banner-subtitle a{
    color:#777 !important;
  }
  .banner-content33 .banner-title {
    flex-grow: 0.4;
    font-weight: 700;
    font-size: 1.45rem;
    line-height: 1.25;
    letter-spacing: -.025em;
    margin-bottom: 10px !important;
    text-align: left;

}


.banner-content33 .banner-link {
    align-self: flex-start;
    width: auto;
    font-weight: 400 !important;
    font-size: 1rem;
    line-height: 1.4;
    letter-spacing: -.01em;
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}



  .slick-track {
    display: flex !important;
  }
  
.slick-list {
  height: 100% !important;
}
.tab-carosal-height{
    height:440px;
  }

  .carousal33-main {

  padding:0px;
  margin: 0px 0px;

  }

  .car33{
    position: absolute;
top: 30%;
left: 3rem;
right: 0;
text-align: left;
  }

  .info-bg-13 .info-boxes-contents .info-box{
    display:block;
  }

  .info-bg-13 .info-boxes-contents {
    padding: 2rem 15px 0.5rem 15px;
}

  .info-bg-13 .block{
    text-align:left;
  }

.carousal33-main-banner {
    position: relative;
    border: 0px solid;
    height: 100%;
    margin: 0px 5px;
    }

  .carousal-33-banner-img{
    height:210px !important;
  }
  .mt-10px{
    margin-top:10px !important;
  }


    
@media only screen and (min-width: 700px) and (max-width: 800px){

  .tab-carosal-height{
    height:440px;
  }
  .mt-20px {
    margin-top: 10px;
  }
  .carousal-33-banner-img{
    height:210px !important;
  }
  .categories-content .p-0 {
    padding: 0 10px !important;
}
.car33 {
  position: absolute;
  top: 15% !important;
  left: 3rem;
  right: 0;
  text-align: left;
}
}
@media only screen and (min-width: 800px) and (max-width: 1024px){
  .carousal-33-banner-img{
    height:210px !important;
  }
}

@media only screen and  (max-width: 992px){
.carousel-6-container-outer {
    width: 50%;
}

}


@media only screen and  (max-width: 600px){
  .demo-28-padding-ban {
    padding: 0 5px !important;
} 
  .carousel-6-container-outer {
    width: 100%;
}
.intro-des-2 {
    font-size: 35px;
}
  .car33 {
      position: absolute;
      top: 30%;
      left: 1rem;
      right: 0;
      text-align: left;
  }
  .intro-title {
    color: #fff;
    font-size: 35px;
}
.info-boxes-contents .info-box .panel {
    display: block;
    align-items: center;
    width: 100%;
    margin-bottom: 0px;
}
.info-bg-13 .block {
    text-align: center;
    margin-top:10px;
}
.carousal33-main-banner {
    position: relative;
    border: 0px solid;
    height: 100%;
    margin: 0px 10px;
}
.top12 .pbc-2-title {
    text-align: center !important;
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


<section class="categories-content categories-sec-content text-center carousal-10 @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif">
  <div class="">
              <div class="carousel-carousel-js-10 tab-carosal-height demo-28-margin" style="background-image: url('intro-bg.jpg');margin-bottom:0px !important">     
                @foreach($result['slides'] as $key=>$slides_data)
                  <div class="slick ">
                    <div class="carousal33-main">     
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

                       
                      <img class="w-100 desktop_slider_view_44 carousal-33-img lazy_img_load"  data-src="{{asset($slides_data->path)}}" width="100%" alt="First slide">
                  
                      <img class="w-100 mobile_slider_view_44 carousal-33-img lazy_img_load"  data-src="{{asset($slides_data->iconpath)}}" width="100%" alt="First slide">

                        
                      <img class="w-100 tab_slider_view_44 carousal-33-img lazy_img_load"  data-src="{{asset($slides_data->tabpath)}}" width="100%" alt="First slide">
                    


                  

                      </a>


                      <div class="row">
                    <div class="container car33">
                    <div class="carousel-6-container-outer">
                      <h3 class="intro-subtitle common-color">{{$slides_data->con_title}}</h3>
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
      <div class="container-fluid mt-10px demo-28-padding-ban">
          <div class="banner-banner-js-32">  
                @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                          @if($homeBanners->type==185 or $homeBanners->type==186 or $homeBanners->type==187)
                            <div class="slick ">
                                <div class="carousal33-main-banner">     
                                  <a href="{{ $homeBanners->banners_url}}">
                                      <img class="img-fluid carousal-33-banner-img lazy_img_load" data-src="{{asset($homeBanners->path)}}" alt="Banner Image">
                                  </a>

                                  <div class="banner-content33"><h4 class="banner-subtitle ">{{ $homeBanners->title }}</h4><h3 class="banner-title">{{ $homeBanners->description }}<br><span class="text-primary common-color" style="font-weight: 300 !important;">{{ $homeBanners->description2 }}</span></h3><a class="banner-link common-text  banner-link-dark" href="{{ $homeBanners->banners_url }}"><span class="common-text-secondary common-hover-high">{{ $homeBanners->name }}</span><i class="fa fa-angle-right common-bg b67icon"></i></a></div>

                                  
                                </div>

                              

                            </div>
                          @endif
                      @endforeach
                  @endif 
                  </div>
          </div>

         
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
        ?>


<section class="boxes-contents info-bg-13">
        <div class="container-fluid">
        <div class="info-boxes-contents info-boxes-contents-new">
        <div class="row">
        <?php foreach($shoppinginfo as $info)
        {
            if($info->type==1)
            { ?>
                <div class="col-12 col-md-6 col-sm-6 col-lg-3 pl-xl-0 mb-20px">
                <div class="info-box first">
                <div class="panel">
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                <div class="block">
                <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                </div>
                </div>
                </div>
                </div>
           <?php }
            if($info->type==2)
            { ?>
                <div class="col-12 col-md-6  col-sm-6 col-lg-3 pl-xl-0 mb-20px">
                <div class="info-box">
                <div class="panel">
                <span class="icon-box-icon info-box-14-display info-box-14-margin" style="margin-right:10px;margin-left:10px">
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
              </span>
                <div class="block">
                <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                </div>
                </div>
                </div>
                </div>
           <?php  }
            if($info->type==3)
            { ?>
                <div class="col-12 col-md-6  col-sm-6 col-lg-3 pl-xl-0 mb-20px">
                <div class="info-box">
                <div class="panel">
                <span class="icon-box-icon info-box-14-display info-box-14-margin" style="margin-right:10px;margin-left:10px">
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
              </span>
                <div class="block">
                <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                </div>
                </div>
                </div>
                </div>
           <?php  }
            if($info->type==4)
            { ?>
                <div class="col-12 col-md-6  col-sm-6 col-lg-3 pl-xl-0 mb-20px">
                <div class="info-box last">
                <div class="panel">
                <span class="icon-box-icon info-box-14-display info-box-14-margin" style="margin-right:10px;margin-left:10px">
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>

              </span>

                <div class="block">
                <h4 class="title info-color-1">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                </div>
                </div>
                </div>
                </div>
            <?php }
        } ?>
        </div>
        </div>
        </div>
        </section>


        </div>

</section>
