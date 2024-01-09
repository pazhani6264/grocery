<style>

.banner32 .row{
  margin-left:-10px;
  margin-right:-10px;
}

.banner32 .col-sm-6{
  padding-left:10px;
  padding-right:10px;
}

.banners-content .container-fluid figure{
  width:auto;
}
.banner-32-margin-right {
    margin: 0px 0px 20px 5px;
}
.banners-content .container-fluid [class^=col] {
    padding-right: 10px; 
     padding-left: 10px; 
}
.banner32 .banner-content{
  right:0;
  text-align:center;
  width: 300px;
    margin: auto;
    padding:30px;
    top: 50%;
}

 .banner32 .banner-image:hover .banner-content {
    outline: 2px dashed #fff;
}

.banner-32-margin-right .banner-content .banner-subtitle{
  font-size:30px;
}
.banner-32-margin-right .banner-content h5{
  font-size:15px;
}
.banner-32-margin-right .banner-content .banner-title{
  font-size:40px;
  margin-bottom: 0.5rem !important;
}


.banner-32-margin-left .banner-content .banner-subtitle{
  font-size:30px;
}
.banner-32-margin-left .banner-content h5{
  font-size:15px;
}
.banner-32-margin-left .banner-content .banner-title{
  font-size:40px;
  margin-bottom: 0.5rem !important;
}

.banner32 .banner32-main {
    position: relative;
    border: 0px solid;
    height: 100%;
    margin: 0;
}

.banner32 .slick-slide {
    outline: none;
    padding: 0 10px !important;
}
.padd-right-32{
  margin-bottom:15px;
}
.banner-banner-js-32{
  margin-bottom:20px;
}
.demo-29-margin-right
{
  margin-right:10px;
}
.demo-29-margin-left
{
  margin-left:10px;
}
#banner-32-outer .demo-29-margin-lr
{
  padding:0 10px !important;
}
#banner-32-outer .demo-29-margin-lr-new
{
  padding-left: 5px !important;
  padding-right: 10px !important;
}



.banner-link-anim .banner-link {
    min-width: 6rem;
    padding: 0 0 1.5rem;
}

.banner-link-anim .banner-content-center .banner-link {
    left: 50%;
    -webkit-transform: translateY(-20px) translateX(-50%);
    transform: translateY(-20px) translateX(-50%);
    -ms-transform: translateY(-20px) translateX(-50%);
}
.banner-link-anim .banner-link {
    opacity: 0;
    position: absolute;
    bottom: 0;
    left: 0;
    min-width: 130px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    -webkit-transform: translateY(-20px);
    transform: translateY(-20px);
    -ms-transform: translateY(-20px);
}
.btn.banner-link {
    font-size: 1rem;
    line-height: 1;
    padding: 0.8rem 0rem;
    min-width: 0;
    text-transform: uppercase;
    text-decoration: none!important;
}

.banner-link-anim:hover .banner-content-center .banner-link {
    -webkit-transform: translateY(0) translateX(-50%);
    transform: translateY(0) translateX(-50%);
    -ms-transform: translateY(0) translateX(-50%);
}
.banner-link-anim:hover .banner-link {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -ms-transform: translateY(0);
}

.banner32 .banner-content1{
  right:0;
  text-align:center;
  width: 300px;
    margin: auto;
}

.banner-content1 {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 2rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}
.demo-28-banner-overlay:focus>a:after, .demo-28-banner-overlay:hover>a:after {
    visibility: visible;
    opacity: 1;
}

.demo-28-banner-overlay>a:after {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(51,51,51,.25);
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
}

.banner32 .banner-content1 .banner-title{
  font-size:20px;
}
.banner32 .banner-content1 .banner-subtitle{
  font-size:14px;
}
.banner-link-anim:hover .banner-content1 {
    padding-bottom: 3rem;
}
.banner-link-anim .banner-content1 {
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.banner-link-anim .banner-link:hover {
    border-bottom: 1px solid #fff;
}

@media only screen and (max-width: 700px) and (max-width: 800px){

  .padd-right-32 {
      margin-bottom: 20px;
  }
}
@media only screen and (max-width: 992px){
.banners-content .container-fluid {
    padding-left: 6px;
    padding-right: 6px;
}
}
@media only screen and (max-width: 600px){

  .banners-content .banner32 .container-fluid {
      padding-left: 5px;
      padding-right: 5px;
  }
  .padd-right-32 {
    margin-bottom: 0px;
  }
  .banner-32-margin-right {
    margin: 0px 0px 20px 0px;
}
  .banner32 .slick-slide {
    outline: none;
    padding: 0 5px !important;
  }
}


  </style>

<!-- //banner two -->
<div class="banner-two banner-img-molla banner32">

  <div class="container-fluid"> 
    <div class="group-banners">
        <div class="row">
          <div class="col-sm-6 padd-right-32">
            @if(count($result['commonContent']['homeBanners'])>0)
              @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                @if($homeBanners->type==169)
                  <figure class="banner-image   banner-32-margin-right">
                    <a href="{{ $homeBanners->banners_url}}">
                    <div class="banner-overlay"></div>
                      @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid banner-32-img-top lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid banner-32-img-top lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>

                          <div class="banner-content banner-content-center"><h4 class="banner-subtitle text-white">{{ $homeBanners->title }}</h4><h5 class="text-white">{{ $homeBanners->description }}</h5><h3 class="banner-title text-white">{{ $homeBanners->description2 }}</h3></div>
                  </figure>
                @endif
              @endforeach
            @endif
          </div>
         
          <div class="col-sm-6 padd-right-32">
            @if(count($result['commonContent']['homeBanners'])>0)
              @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                @if($homeBanners->type==170)
                  <figure class="banner-image  banner-32-margin-left">
                    <a href="{{ $homeBanners->banners_url}}">
                    <div class="banner-overlay"></div>
                    @if($homeBanners->image_path_type == 'aws')
                      <img class="img-fluid banner-32-img-top lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                      @else
                      <img class="img-fluid banner-32-img-top lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                      @endif</a>

                      <div class="banner-content banner-content-center"><h4 class="banner-subtitle text-white font-weight-normal">{{ $homeBanners->title }}</h4><h3 class="banner-title text-white font-weight-normal">{{ $homeBanners->description }}</h3><h5 class="text-white">{{ $homeBanners->description2 }}</h5></div>

                  </figure>
                @endif
              @endforeach
            @endif
          </div>
                                          
        </div>
        </div>

        <div class="banner-banner-js-32">
          @if(count($result['commonContent']['homeBanners'])>0)
            @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
              @if($homeBanners->type==171)
                <div class="slick ">
                  <div class="banner32-main banner-link-anim">  
                    <figure class="banner-image">
                      <a href="{{ $homeBanners->banners_url}}">
                        <div class="banner-overlay"></div>
                      @if($homeBanners->image_path_type == 'aws')
                            <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                            @else
                            <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                            @endif</a>

                            <div class="banner-content1 banner-content-center"><h3 class="banner-title text-white">{{ $homeBanners->title }}</h3><h4 class="banner-subtitle text-white">{{ $homeBanners->description }}</h4><a class="btn banner-link text-white" href="/shop">{{ $homeBanners->name }}</a></div>

                    </figure>
                  </div>
                </div>
              @endif
            @endforeach
          @endif
          
            @if(count($result['commonContent']['homeBanners'])>0)
              @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                @if($homeBanners->type==172)
                  <div class="slick ">
                      <div class="banner32-main banner-link-anim">  
                        <figure class="banner-image ">
                          <a href="{{ $homeBanners->banners_url}}">
                          <div class="banner-overlay"></div>
                          @if($homeBanners->image_path_type == 'aws')
                                <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                                @else
                                <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                                @endif</a>

                                <div class="banner-content1 banner-content-center"><h3 class="banner-title text-white">{{ $homeBanners->title }}</h3><h4 class="banner-subtitle text-white">{{ $homeBanners->description }}</h4><a class="btn banner-link text-white" href="/shop">{{ $homeBanners->name }}</a></div>

                        </figure>
                      </div>
                    </div>
                @endif
              @endforeach
            @endif
          
            @if(count($result['commonContent']['homeBanners'])>0)
              @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                  @if($homeBanners->type==173)
                    <div class="slick ">
                      <div class="banner32-main banner-link-anim">  
                        <figure class="banner-image ">
                          <a href="{{ $homeBanners->banners_url}}">
                          <div class="banner-overlay"></div>
                          @if($homeBanners->image_path_type == 'aws')
                                <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                                @else
                                <img class="img-fluid banner-32-img-bottom lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                                @endif</a>

                                <div class="banner-content1 banner-content-center"><h3 class="banner-title text-white">{{ $homeBanners->title }}</h3><h4 class="banner-subtitle text-white">{{ $homeBanners->description }}</h4><a class="btn banner-link text-white" href="/shop">{{ $homeBanners->name }}</a></div>

                        </figure>
                      </div>
                    </div>
                @endif
              @endforeach
            @endif
                                          

    </div>
  </div>
</div>  
