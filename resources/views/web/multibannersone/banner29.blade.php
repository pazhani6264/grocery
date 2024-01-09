<!-- //banner two -->
<div class="banner-two banner-img-molla">

  <div class="container-fluid"> 
    <div class="group-banners">
        <div class="row">

        <div class="col-sm-6 col-lg-4">

            @if(count($result['commonContent']['homeBanners'])>0)
              @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                  @if($homeBanners->type==157)
              <figure class="banner-image banner-column-5 h-100">
                <a href="{{ $homeBanners->banners_url}}">
                <div class="banner-overlay"></div>
                @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid banner20-img lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid banner20-img lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>
              </figure>
              @endif
            @endforeach
            @endif

            </div>

          <div class="col-sm-6 col-lg-8">

          <div class="row">
              <div class="col-12 col-md-6 mb-20">
                @if(count($result['commonContent']['homeBanners'])>0)
                  @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                    @if($homeBanners->type==158)
                      <figure class="banner-image ">
                        <a href="{{ $homeBanners->banners_url}}">
                        <div class="banner-overlay"></div>
                        @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>
                      </figure>
                    @endif
                  @endforeach
                @endif
              </div>
              <div class="col-12 col-md-6 mb-20">
                @if(count($result['commonContent']['homeBanners'])>0)
                   @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                      @if($homeBanners->type==159)
                  <figure class="banner-image ">
                    <a href="{{ $homeBanners->banners_url}}">
                    <div class="banner-overlay"></div>
                    @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>
                  </figure>
                  @endif
                 @endforeach
                @endif
              </div>

              <div class="col-12 col-md-6 mb-20">
                @if(count($result['commonContent']['homeBanners'])>0)
                  @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                    @if($homeBanners->type==160)
                      <figure class="banner-image ">
                        <a href="{{ $homeBanners->banners_url}}">
                        <div class="banner-overlay"></div>
                        @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>
                      </figure>
                    @endif
                  @endforeach
                @endif
              </div>
              <div class="col-12 col-md-6 mb-20">
                @if(count($result['commonContent']['homeBanners'])>0)
                   @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                      @if($homeBanners->type==161)
                  <figure class="banner-image ">
                    <a href="{{ $homeBanners->banners_url}}">
                    <div class="banner-overlay"></div>
                    @if($homeBanners->image_path_type == 'aws')
                          <img class="img-fluid lazy_img_load" data-src="{{$homeBanners->path}}" alt="Banner Image">
                          @else
                          <img class="img-fluid lazy_img_load" data-src="{{asset('').$homeBanners->path}}" alt="Banner Image">
                          @endif</a>
                  </figure>
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
