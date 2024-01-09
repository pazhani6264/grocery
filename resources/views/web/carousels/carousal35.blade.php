
<!-- Bootstrap Carousel Content Full Screen -->
<style>

.modal-backdrop {
position: relative;
top: 0;
left: 0;
z-index: 1040;
width: 100vw;
height: 100vh;
background-color: #000;
opacity:0;
}
.youtube-video .modal-dialog{
top: 36%;

}

 .modal {
position: fixed;
top: 0;
left: 0;
z-index: 1050;
display: none;
width: 100%;
height: 100%;
overflow: hidden;
outline: 0;
background-color: rgb(0,0,0,0.3);
}

.footer-logo {
width: 105px;
aspect-ratio: auto 105 / 25;
height: 25px;
}
.containersss .slick-slide {
    outline: none;
    padding: 0 0px;
}
.containersss .slick-vertical .slick-slide{
  border: 0px solid transparent;
}
.finfo .slick-track, .slick-list {
    height: auto !important;
}
.intro {
  height: 100vh;
  width: 100%;
  background: #999; 
}

.containersss {
  margin-left:auto;
  margin-right:auto;
  width: 100%;
  height: 100vh;
  color: #333;
}

.slick-track,
.slick-list {
  height: 100vh;
}

.slick-dotted.slick-slider {
  margin: 0;
}

.slides {
  width: 100%;
  height: 100vh;
}
  
.slides .slide {
    background: white;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }



  .containersss .slick-dots {
    position: absolute !important;
    bottom: 50% !important;
    left: 95%;
}

.containersss .slick-dots {
    position: absolute !important;
    bottom: 20px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
    text-align: center;
}

.containersss  .slick-dots .slick-active button
{
   height: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
    background:#9ACE69;
}

.containersss  .slick-dots li button {
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
.containersss .slick-dots li button::after {
    content: unset;
}
.containersss  .slick-dots li {
    position: relative;
    display: flex;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}



  
.slick-dots li {
    display: block;
  }

  
.slick-list {
  height: 100% !important;
}
.carousal-10 .slick-dotted.slick-slider{
  margin-bottom:0px !important;
}
.carousal-10 .slick-slide{
  padding:0 0px;
}
.carousal-10 .container{
  width:1190px;
  max-width:100%;
}
.carousal-43-img{
  height:500px;
}

.demo-10-banner-20-btn-new {
    margin-top:14px;
    background: #333;
    border:1px solid #333;
    padding: 12px 50px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius:50px;
    color: #fff !important;
}
.demo-10-banner-20-btn-new:hover {
    border:1px solid transparent;
    color: #fff !important;
    fill: #fff !important;
}

.carousel-6-container-outer {
    position: absolute;
    text-align: center;
    top: -600px;
    bottom: 0;
    left: 15px;
    right: 0;
    width:50%;
    margin:auto;
    }
.intro-subtitle {
    font-size: 13px;
    font-weight: 300;
    color: #ebebeb;
    margin-bottom: 14px;
    letter-spacing: 1px;
    text-transform:uppercase;
   
}
.intro-title {
  font-size: 100px;
    margin-bottom: 2rem;
    color: #fff;
    font-weight: 600;
    line-height: 1.1;
    text-transform:initial !important;
    
}
.intro-des-2
{
  font-size: 30px;
    margin-bottom: 23px;
    color: #fff;
    font-weight: 300;
    line-height: 1.2;
    letter-spacing: 2px;
    text-transform:uppercase;

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
.carousal-10 .slick-dots{
  bottom:100px;
}



/* footer */

.finfo .info-boxes-contents {
    padding: 2rem 15px 1rem 15px;
}
.finfo .info-boxes-contents .info-box .panel .fas {
    font-size: 35px;
    margin-bottom: 0;
    text-align: center;
    align-self: center;
    margin: 0px 15px 0px 0px;
}

.footer26 .heading-title {
    font-size: 3.6rem !important;
    color:#fff;
}
.heading-cat{
  margin-bottom:2rem;
}

.footer26 .subscribe form {
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: calc(40% - 10px);
    max-width: calc(40% - 10px);
    margin-left: auto;
    margin-right: auto;
}
.footer26 .subscribe input{
  padding:.95rem 0 .95rem 1.2rem;
}
.footer26 .info-boxes-contents .info-box .panel .block h4{
  text-transform:uppercase;
}






@media screen and (max-width: 992px){
  .intro-title {
  font-size: 40px;
    
}
.carousel-6-container-outer {
  width: 90%;
   top:-250px;
  
}
.desktop_slider_view_44 {
      display: none !important;
      object-fit:cover !important;

    }
    .mobile_slider_view_44 {
      display: none !important;
      object-fit:cover !important;

    }
    .tab_slider_view_44 {
      display: block !important;
      object-fit:cover !important;

    }
.footer26 .subscribe form {
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: calc(70% - 10px) !important;
    max-width: calc(70% - 10px) !important;
    margin-left: auto;
    margin-right: auto;
}

.carousal43-main {
  height:100vh;
}

}


@media screen and (max-width: 600px){
  .carousel-6-container-outer {
   
   
    left:0px;
    top:-400px;
   
}
  .intro-title {
  font-size: 30px;
    
}
.intro-des-2
{
  font-size: 20px;
   

}
.carousel-6-container-outer {
   width: 90%;
  
}
.desktop_slider_view_44 {
      display: none !important;
      object-fit:cover !important;

    }
    .mobile_slider_view_44 {
      display: block !important;
      object-fit:cover !important;

    }
    .tab_slider_view_44 {
      display: none !important;
      object-fit:cover !important;

    }
.subscribe input {
    border: 0.1rem solid #fff;
    padding: 0.95rem 0 0.95rem 2.2rem;
    min-width: 0;
    flex: 1 1 auto;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: .01em;
    color: #999;
    background-color: transparent;
    width: 0% !important;
}
.brands .heading h3.heading-title, .instagram .heading h3.heading-title, .subscribe .heading h3.heading-title {
    font-size: 1.6rem;
    text-transform: none;
    line-height: 1em !important;
}
}

@media screen and (max-width: 440px){
  .carousel-6-container-outer {
   
   
    left:0px;
    top:-300px;
   
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


<div class='containersss @if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif'>
  <div class='slides'>
    
      <div class="slide" style=" display:block;">
        @foreach($result['slides'] as $key=>$slides_data)
          <div class="carousal43-main ">     

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



              <img class="w-100 desktop_slider_view_44  lazy_img_load"  src="{{asset($slides_data->path)}}" width="100%" height="100%" alt="First slide">
              <img class="w-100 mobile_slider_view_44  lazy_img_load"  src="{{asset($slides_data->iconpath)}}" width="100%" height="100%" alt="First slide">
              <img class="w-100 tab_slider_view_44  lazy_img_load"  src="{{asset($slides_data->tabpath)}}" width="100%" height="100%" alt="First slide">

              
 

            </a>

            <div class="row">
              <div class="container" style="position:relative;">
                <div class="carousel-6-container-outer">
                  @if($slides_data->con_title != '')
                    <h3 class="intro-subtitle text-white">{{$slides_data->con_title}}</h3>
                    @endif 
                    @if($slides_data->con_description != '')
                    <h1 class="intro-title">{{$slides_data->con_description}}<br>
                    @endif 
                    @if($slides_data->con_description2 != '')
                      <span class="text-primary">{{$slides_data->con_description2}}</span>
                    </h1>
                    @endif 
                    @if($slides_data->con_name != '')
                    @if($slides_data->type == 'category')
                    <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                    @elseif($slides_data->type == 'product')
                      <a class="btn demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                    @elseif($slides_data->type == 'mostliked')
                      <a class="btn demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=mostliked')}}">
                    @elseif($slides_data->type == 'topseller')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=topseller')}}">
                    @elseif($slides_data->type == 'special')
                    <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ URL::to('shop?type=special')}}">
                    @elseif($slides_data->type == 'link')
                    <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover"  href="{{ $slides_data->url }}">
                    @elseif($slides_data->type == 'externallink')
                      <a class="btn  demo-10-banner-20-btn-new banner-link  common-fill common-bg-hover" href="{{ $slides_data->url }}" target="_blank">
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

      <div class="slide" style=" display:block;">
        @include('web.top_sell.top13') 
      </div>

      <div class="slide" style=" display:block;">
        @include('web.banners.banner66') 
      </div>

      <div class="slide" style=" display:block;">
        @include('web.trend_product.trend14') 
      </div>



      <div class="slide" style=" display:block;">
        @include('web.recent_arrival.recent_arrival24') 
      </div>


      <div class="slide" style="background:#222">
        <footer class="footer  footer-black  footer-2 footer26">  
          <section class="subscribe ">
                  <div class="heading text-center">
                    <h3 class="heading-title">Get The Latest Deals</h3>
                    <p class="heading-cat">and receive $20 coupon for first shopping</p>
                  </div>
                  <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
                    <div class="input-group">
                      <input type="email" name="email" placeholder="Enter Your Email Address" aria-label="Email Adress" required="">
                      <div class="input-group-append">
                        <button class="btn btn-subscribe" id="mc-embedded-subscribe"  type="submit">
                          <span>Subscribe</span>
                        </button>
                      </div>
                      <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                      <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                    </div>
                  </form>
                </section>
        </footer>

      </div>


     
      <div class="slide" style="background:#222">
        @include('web.footers.partials.modals') 
        @php
          $customer = auth()->guard('customer')->user();
        @endphp
          <footer class="footer footer-black  footer-2 footer26">  
            <div class="footer-middle">
              <div class="container-fluid">



                <div class="finfo">
                  <div class="info-boxes-contents demo-27-infobox-carousel-js">
                  
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
                  
                   <?php 
                  foreach($shoppinginfo as $info)
                  {
                    ?>
                      <div class="info-box first slick">
                   <div class="panel">

                    <?php
                      if($info->type==1)
                      {
                        ?>
                         
               

              
                          <div class="panel mob-panel common-fill">
                          <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                          <div class="block">
                          <h4 class="title text-white">{{ $info->shopping_info_name }}</h4>
                          <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                          </div>
                          </div>
                        
                          <?php  }
                      if($info->type==2)
                      { 
                        ?>
                       
                        
                          <div class="panel mob-panel common-fill">
                          <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                          <div class="block">
                          <h4 class="title text-white">{{ $info->shopping_info_name }}</h4>
                          <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                          </div>
                          </div>
                        
                          
                          <?php   }
                      if($info->type==3)
                      {
                        ?>
                         
                          <div class="panel mob-panel common-fill">
                          <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                          <div class="block">
                          <h4 class="title text-white">{{ $info->shopping_info_name }}</h4>
                          <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                          </div>
                          </div>
                          
                          
                          <?php  }
                      if($info->type==4)
                      {
                        ?>
                         
                       
                          <div class="panel mob-panel common-color">
                          <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                          <div class="block">
                          <h4 class="title text-white">{{ $info->shopping_info_name }}</h4>
                          <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                          </div>
                          </div>
                          
                       
                          <?php   } ?>

                          </div>
                  </div>

                    <?php 
                  }
                  ?>
                 
                  </div>
                
                  <hr style="border-color:#454647 !important">
                  </div>


                <div class="row" style="padding-top:5rem">
                  <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="widget widget-about">
                    @if($result['commonContent']['settings']['sitename_logo']=='logo')
                        <?php 
                        $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['footer_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                        ?>
                        @if($imagepath->path_type == 'aws')
                        <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                          <img  class="footer-logo" src="{{$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                        </a>
                        @else
                        <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                          <img  class="footer-logo" src="{{asset('').$result['commonContent']['settings']['footer_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                        </a>
                        @endif
                      @endif
                      <p style="line-height:2">{{$result['commonContent']['setting'][111]->value}}</p>
                      <div class="widget-about-info">
                        <div class="row">
                          <div class="col-sm-6 col-md-4">
                            <span class="widget-about-title text-white">Got Question? Call us 24/7</span>
                            <a class="text-white" style="font-size:22px;" href="tel:{{$result['commonContent']['setting'][11]->value}}">{{$result['commonContent']['setting'][11]->value}}</a>
                          </div>
                          <div class="col-sm-6 col-md-8">
                            <span class="widget-about-title text-white">Payment Method</span>
                            <figure class="footer-payments">
                              <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="200" height="20">
                            </figure>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-2">
                    <div class="widget">
                      <h4 class="widget-title text-white" style="text-transform:uppercase">Information</h4>
                      <ul class="widget-list">
                        @if(count($result['commonContent']['pages']))
                            @foreach($result['commonContent']['pages'] as $page)
                                <li> <a href="{{ URL::to('/page?name='.$page->slug)}}"></i>{{$page->name}}</a> </li>
                            @endforeach
                        @endif
                        <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
                      @if(count($zippage)>0)
                        @foreach ($zippage as  $key=>$zip)
                        <li> <a href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}">{{$zip->name}}</a> </li>
                        @endforeach
                      @endif
                          <li> <a href="{{ URL::to('/contact')}}"></i>@lang('website.Contact Us')</a> </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-2">
                    <div class="widget">
                      <h4 class="widget-title text-white" style="text-transform:uppercase">Customer Service</h4>
                      <ul class="widget-list">
                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                          <li> <a href="{{url('profile')}}">@lang('website.Profile')</a> </li>
                          <li> <a href="{{url('logout')}}">@lang('website.Logout')</a> </li>
                        <?php }else{ ?>
                          <?php if($result['commonContent']['settings']['view_login_button'] == 1) { ?>
                            <li> <a  href="{{ URL::to('/login_nine')}}">Login</a> </li>    
                        <?php } } ?>
                        <li> <a href="{{ URL::to('/')}}"></i>Home</a> </li>
                        <li> <a href="{{ URL::to('/shop')}}"></i>Shop</a> </li>
                        <li> <a href="{{ URL::to('/orders')}}"></i>Orders</a> </li>
                        <li> <a href="{{ URL::to('/viewcart')}}"></i>Shopping Cart</a> </li>
                        <li> <a href="{{ URL::to('/wishlist')}}"></i>Wishlist</a> </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-2">
                    <div class="widget">
                      <h4 class="widget-title text-white" style="text-transform:uppercase">My Account</h4>
                      <ul class="widget-list">
                        <li> <span><b><strong>Address : </strong></b></span> <br><span style="width: 100%;"> {{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
                        <li> <span><b><strong>Phone : </strong></b></span> <br> <span class="phone-bg-balck" dir="ltr" style="width: 100%;">({{$result['commonContent']['setting'][11]->value}})</span> </li>
                        <li> <span><b><strong>Email : </strong></b></span> <br> <a class="common-hover email-font" style="color: #999" href="mailto:{{$result['commonContent']['setting'][3]->value}}"><span style="width: 100%;">{{$result['commonContent']['setting'][3]->value}}</span></a>  </li>
                      </ul>
                    </div>
                  </div>
                  

                </div>
              </div>
            </div>
            <div class="footer-bottom">
              <div class="container-fluid">
                <p class="footer-copyright">Copyright © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank">Platinum24, Inc</a> . All Rights Reserved.</p>
                <ul class="footer-menu footer-black">
                  <li>
                    <a href="{{url('/page?name=term-services')}}">Terms Of Use</a>
                  </li>
                  <li>
                    <a href="{{url('/page?name=refund-policy')}}">Privacy Policy</a>
                  </li>
                </ul>
                <div class="social-icons social-icons-color footer-social">
                  <span class="social-label">Social Media</span>
                  <a target="_blank" class="social-icon social-facebook" href="{{$result['commonContent']['setting'][50]->value}}">
                    <i class="fa fa-facebook-f"></i>
                  </a>
                  <a target="_blank" class="social-icon social-twitter" href="{{$result['commonContent']['setting'][52]->value}}">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a target="_blank" class="social-icon social-instagram" href="{{$result['commonContent']['setting'][51]->value}}">
                    <i class="fa fa-google"></i>
                  </a>
                  <a target="_blank" class="social-icon social-youtube" href="{{$result['commonContent']['setting'][53]->value}}">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </div>
              </div>
            </div>

            @if($result['commonContent']['settings']['Loyalty']=='1')
            <button type="button" id="subscribe" class="btn btn-secondary fixedbutton" data-toggle="modal" style="border-top-left-radius: 5px;border-top-right-radius: 5px;" data-target="
            @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
            #loginmyModal
            @else
            #myModalLoyalty
            @endif
            ">@lang('website.Loyalty_Points')
              @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')
              - {{ auth()->guard('customer')->user()->loyalty_points }} </button>
              @endif
            @endif

          </footer>

      </div>

  </div>
</div>






<script>

(function (jQuery) {
  var tabCarousel = jQuery('.demo-27-infobox-carousel-js');

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
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
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
    }

    ;
  })(jQuery);


// debounce from underscore.js
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

// use x and y mousewheel event data to navigate flickity
function slick_handle_wheel_event(e, slick_instance, slick_is_animating) {
  // do not trigger a slide change if another is being animated
  if (!slick_is_animating) {
    // pick the larger of the two delta magnitudes (x or y) to determine nav direction
    var direction =
      Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY;

    console.log("wheel scroll ", e.deltaX, e.deltaY, direction);

    if (direction > 0) {
      // next slide
      slick_instance.slick("slickNext");
    } else {
      // prev slide
      slick_instance.slick("slickPrev");
    }
  }
}

// debounce the wheel event handling since trackpads can have a lot of inertia
var slick_handle_wheel_event_debounced = debounce( 
  slick_handle_wheel_event
  , 100, true
);

// init slider 
const slick_2 = $(".slides");
slick_2.slick({
  dots: true,
  vertical: true,
  verticalSwiping: true,
  arrows: false,
  infinite: false,
  // responsive: [{
  //           breakpoint: 600,
  //           settings: {
  //             dots: false,
  //           }
  //         }]
});
var slick_2_is_animating = false;

slick_2.on("afterChange", function(index) {
  console.log("Slide after change " + index);
  slick_2_is_animating = false;
});

slick_2.on("beforeChange", function(index) {
  console.log("Slide before change " + index);
  slick_2_is_animating = true;
});

slick_2.on("wheel", function(e) {
  slick_handle_wheel_event_debounced(e.originalEvent, slick_2, slick_2_is_animating);  
});


  </script>