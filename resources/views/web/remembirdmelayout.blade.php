<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
  @include('web.common.remembirdmemeta')
@php
  $customer = auth()->guard('customer')->user();
@endphp

  </head>

  <style>

.header-mobile-12 .header-maxi .navigation-mobile-container #navigation-mobiles .logout-main {
    border-bottom: none !important; 
}

    </style>
    <!-- dir="rtl" -->
    <?php 
    if($result['commonContent']['settings']['background_type']== '2')
    {
      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['background_image'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
    }

      ?>
                 
    <body class="animation-s<?php  echo $final_theme['transitions']; if(!empty(session('direction')) and session('direction')=='rtl') print ' bodyrtl';?> " <?php if($result['commonContent']['settings']['background_type']== '1' ) {?>style="background-color:{{ $result['commonContent']['settings']['background_color']}}" <?php } else { if($imagepath !=''){ if($imagepath->path_type == 'aws') {?> style="background-image:url({{ $result['commonContent']['settings']['background_image']}});background-repeat: no-repeat;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" <?php } else {?> style="background-image:url({{ asset($result['commonContent']['settings']['background_image'])}});background-repeat: no-repeat;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" <?php }}}?> >
      
      <div class="se-pre-con" id="loader" style="display: block">
        <div class="pre-loader">
          <div class="la-line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <p>@lang('website.Loading')..</p>
        </div>
     
      </div>

      @if (count($errors) > 0)
          @if($errors->any())
           <script>swal("Congrates!", "Thanks For Shopping!", "success");</script>
          @endif
      @endif
      
      <!-- Header Sections -->

        <!-- Top Offer -->
        <?php 
        if($result['commonContent']['settings']['topoffer']== '1')
        { ?>
        <div class="header-area">
          <?php  echo $final_theme['top_offer']; ?>
        </div>
       <?php } ?>

        
        <!-- End Top Offer -->
        
        <!-- Header Content -->
        <?php  echo $final_theme['header']; ?>        
        
        <!-- End Header Content -->
        <?php  echo $final_theme['mobile_header']; ?>
      <!-- End of Header Sections -->
      
       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->
         @yield('content')



      <!-- Footer content -->
      <div class="notifications" id="notificationWishlist"></div>
      <input type="hidden" value="1" id="tooltip-flag">
      <?php  echo $final_theme['footer']; ?>

      <!-- End Footer content -->
      <?php  echo $final_theme['mobile_footer']; ?>
      @if(!empty($result['commonContent']['setting'][119]) and $result['commonContent']['setting'][119]->value==1)
      
        @if(empty(Cookie::get('cookies_data')))        

        <div class="alert alert-warning alert-dismissible alert-cookie fade show" role="alert">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-12 col-md-8 col-lg-9">
                      <div class="pro-description">
                          @lang('website.This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies. Review our')
                          <a target="_blank" href="{{ URL::to('/page?name=cookies')}}" class="btn-link">@lang('website.cookies information')</a> 
                          
                          @lang('website.for more details').
                      </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-3 alert_btn_fnd">
                      <button type="button" class="btn btn-secondary swipe-to-top" id="allow-cookies">
                        @lang('website.OK, I agree')
                          </button>
                  </div>
              </div>
          </div>
        </div>
        @endif
      @endif

      <!-- Button trigger modal -->
      {{-- and empty(session('newsletter') --}}
      @if(!empty($result['commonContent']['setting'][118]) and $result['commonContent']['setting'][118]->value==1 and Request::path() == '/' ) 

      @if($result['commonContent']['setting'][203]->value==1)
      
    
      @if(auth()->guard('customer')->check() && $customer->phone_verified =='1')

      <?php    $userhide = DB::table('newsletter_subscribe_customerhide')
                ->where('user_id', '=', auth()->guard('customer')->user()->id)
                ->where('status', '=', 1)->first();
                
                if($userhide != '') { } else {?>

      

       <!-- Newsletter Modal -->
       <div class="modal fade show" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="false">
       
       <div class="modal-dialog modal-dialog-centered modal-lg newsletter" role="document">
         <div class="modal-content">
             <div class="modal-body">

                 <div class="container">
                     <div class="row align-items-center">                   
                  
                     <div class="col-12 col-md-6" >
                        <div class="pro-image">

                        @if($result['commonContent']['setting'][124]->value)
                      <?php 
                      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['setting'][124]->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                      ?>
                      @if($imagepath) 
                      @if($imagepath->path_type == 'aws')
                      <img class="img-fluid lazy_img_load" data-src="{{$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @else
                      <img class="img-fluid lazy_img_load" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @endif
                      @else
                      <img class="img-fluid lazy_img_load" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 

                      @endif
                    @endif
                    
                        </div>

                      


                        
                     </div>
                     <div class="col-12 col-md-6" style="padding-left: 0;">
                      <div class="promo-box">
                          <h2 class="text-01">                            
                            @lang('website.Sign Up for Our Newsletter')
                          </h2>
                          <p class="text-03">                            
                            @lang('website.Be the first to learn about our latest trends and get exclusive offers')
                          </p>
                            <form class="mailchimp-form" action="{{url('subscribeMail')}}" >

                            

                            <div class="form-group">
                              <input type="email" value="" name="email" class="required email form-control" placeholder="@lang('website.Enter Your Email Address')...">
                            </div>
                            <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>
                            <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-secondary swipe-to-top newsletter">@lang('website.Subscribe')</button>
                          </form>
                      </div>
                    
                      <div style="text-align: center;font-size: 1rem;">
											<input required="" style="margin:4px;" class="form-controlt checkbox-validate" onClick="unsubscribehide({{ auth()->guard('customer')->user()->id }})" type="checkbox">
											Do not show this popup again &nbsp;		
										</div>
                   
                   </div>
                   </div>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                     </button>
                    
                 </div>
               
               </div>
         </div>
       </div>
       </div>
                <?php }?>

       @else

        <!-- Newsletter Modal -->
        <div class="modal fade show" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="false">
       
       <div class="modal-dialog modal-dialog-centered modal-lg newsletter" role="document">
         <div class="modal-content">
             <div class="modal-body">

                 <div class="container">
                     <div class="row align-items-center">                   
                  
                     <div class="col-12 col-md-6" >
                        <div class="pro-image">

                        @if($result['commonContent']['setting'][124]->value)
                      <?php 
                      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['setting'][124]->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                      ?>
                      @if($imagepath) 
                      @if($imagepath->path_type == 'aws')
                      <img class="img-fluid lazy_img_load" data-src="{{$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @else
                      <img class="img-fluid lazy_img_load" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @endif
                      @else
                      <img class="img-fluid lazy_img_load" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 

                      @endif
                    @endif
                    
                        </div>

                      


                        
                     </div>
                     <div class="col-12 col-md-6" style="padding-left: 0;">
                      <div class="promo-box">
                          <h2 class="text-01">                            
                            @lang('website.Sign Up for Our Newsletter')
                          </h2>
                          <p class="text-03">                            
                            @lang('website.Be the first to learn about our latest trends and get exclusive offers')
                          </p>
                            <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
                            <div class="form-group">
                              <input type="email" value="" name="email" class="required email form-control" placeholder="@lang('website.Enter Your Email Address')...">
                            </div>
                            <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>
                            <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-secondary swipe-to-top newsletter">@lang('website.Subscribe')</button>
                          </form>
                      </div>
                     
                   <!--  <div style="text-align: center;font-size: 1rem;">
											<input required="" style="margin:4px;" class="form-controlt checkbox-validate" type="checkbox">
											Do not show this popup again &nbsp;		
										</div>
 -->
                   
                   </div>
                   </div>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                     </button>
                    
                 </div>
               
               </div>
         </div>
       </div>
       </div>


       @endif

      @elseif($result['commonContent']['setting'][203]->value==2)
      <style>
        .subscribe-modal-2-outer {
            padding: 60px;
            max-height: 90vh;
            min-width: 200px;
            min-height: 200px;
            max-width: 1200px;
            border-radius: 15px;
            overflow: unset;
            background-color: #fff;
            color: #000;
            -webkit-overflow-scrolling: touch;
            background-image: url("https://cdn.shopify.com/s/files/1/0424/8322/0646/t/49/assets/paper_720x.jpg?v=56776081759779364771649043295");
        }
        .subscribe-modal-2-dialog-width {
            max-width: 645px;

        }
        .subscribe-modal-2-newsletter-popup {
            position: relative;
            margin: 0 auto;
            max-width: 520px;
            text-align: center;
        }
        .subscribe-modal-2-h2
        {
          font-size:27px;
          font-weight:600;
          letter-spacing:0.01em;
          margin-bottom:20px;
        }
        .subscribe-modal-2-p
        {
          margin-bottom:30px !important;
          font-size:18px;
        }
        
        .subscribe-modal-2-outer input:active, .subscribe-modal-2-outer input:focus, .subscribe-modal-2-outer select:active, .subscribe-modal-2-outer select:focus, .subscribe-modal-2-outer textarea:active, .subscribe-modal-2-outer textarea:focus {
            border: 1px solid;
            border-color: #000;
           
        }
        .subscribe-modal-2-email
        {
          margin: 0 auto;
          max-width: 400px;
          display: flex;
        }
        .subscribe-modal-2-input-group-field {
            flex: 1 1 auto;
            margin: 0;
            min-width: 0;
            color: #000;
            background-color: #fff;
            border: 1px solid;
            border-color: #e8e8e1;
            max-width: 100%;
            padding: 8px 10px;
            border-radius: 0;
        }
        .subscribe-modal-2-input-group-btn {
            flex: 0 1 auto;
            margin: 0;
            display: flex;
        }

        .subscribe-modal-2-close-btn {
    display: inline-block;
    margin: 0;
    padding: 0;
    font-weight: 400;
    font-style: normal;
    text-decoration: none;
    border-style: solid;
    line-height: 1.42;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-transform: none;
    letter-spacing: normal;
    box-shadow: 0 2px 5px #00000029, 0 2px 10px #0000001f;
    letter-spacing: .5px;

    border: 0;
          opacity: 1 !important;
    position: absolute;
    right: -10px;
    top: -10px;
    z-index: 2;
    transition: transform .15s ease-out;
    border-radius: 50%;
    color: #fff;
    background: #ff6128;
}
.subscribe-modal-2-close-btn:hover {
    box-shadow: 0 5px 11px #0000002e, 0 4px 15px #00000026;
    transform: scale(1.2);
}

       
.subscribe-modal-2-btn {
  border-radius: 0 3px 3px 0;
    display: inline-block;
    margin: 0;
    padding: 0;
    font-weight: 400;
    font-style: normal;
    text-decoration: none;
    border-style: solid;
    line-height: 1.42;
    vertical-align: middle;
    white-space: nowrap;
    font-size: 16px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-transform: none;
    letter-spacing: normal;
    box-shadow: 0 2px 5px #00000029, 0 2px 10px #0000001f;
    letter-spacing: .5px;
    transition: .2s ease-out;
    color: #fff;
}
.subscribe-modal-2-icon
{
  width: 28px;
    height: 28px;
    display: block;
    
    color: #fff;
    background: #ff6128;
    border-radius: 50%;
    color: #fff;
    background: #ff6128;
    overflow: unset;
   
}
.subscribe-modal-2-cls-1 {
    fill: none;
    stroke: #fff;
    stroke-miterlimit: 10;
    stroke-width: 2px;
}
.subscribe-modal-2-text-desk
{
    display:block;
}
.subscribe-modal-2-text-mobile
{
    display:none;
}
.subscribe-modal-2-outer input:focus-visible {
    outline: unset;
    border-radius: 0px;
    border: 1px solid;
    border-color: #000;
}
@media only screen and (max-width: 768px)
{
    .subscribe-modal-2-text-desk
{
    display:none;
}
.subscribe-modal-2-text-mobile
{
    display:block;
}
.subscribe-modal-2-outer {
            padding: 30px;
            max-height: 80vh;
           
        }
        .subscribe-modal-2-h2
        {
          font-size:20px;
         
        }
        .subscribe-modal-2-p
        {
          margin-bottom:20px !important;
          font-size:14px;
        }
}

          </style>
      <div class="modal fade show" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered subscribe-modal-2-dialog-width newsletter" role="document">
          <div class="modal-content subscribe-modal-2-outer">
            <div class="subscribe-modal-2-newsletter-popup">
              <h2 class="subscribe-modal-2-h2">                            
              Save 5% off your first purchase
              </h2>
              <p class="subscribe-modal-2-p">                            
              Sign up today and we'll send you a 5% discount code towards your first purchase.
              </p>
              <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
              <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>
                <div class="subscribe-modal-2-email">
              
                  <input type="email" value="" name="email" class="required email subscribe-modal-2-input-group-field" required placeholder="@lang('website.Enter Your Email Address')...">
                  <div class="subscribe-modal-2-input-group-btn">
                    <button type="submit" style="padding:0 10px;" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="subscribe-modal-2-btn btn-secondary swipe-to-top newsletter"><span class="subscribe-modal-2-text-desk">Subscribe</span> <i  class="fa fa-arrow-right mr-0 mt-0 subscribe-modal-2-text-mobile"></i></button>
                  </div>
                </div>
                
              </form>
            </div>
            <button type="button" class="subscribe-modal-2-close-btn close"  data-dismiss="modal" aria-label="Close">
              <svg aria-hidden="true" focusable="false" role="presentation" class="subscribe-modal-2-icon subscribe-modal-2-icon-close" viewBox="0 0 64 64"><defs></defs><path class="subscribe-modal-2-cls-1" d="M19 17.61l27.12 27.13m0-27.13L19 44.74"></path></svg>
             
            </button>
           
          </div>  
        </div>
      </div>
  
     

      @elseif($result['commonContent']['setting'][203]->value==3)
      <style>
        .subscribe-modal-3-outer {
            max-height: 90vh;
            min-width: 200px;
            min-height: 200px;
            max-width: 1200px;
            border-radius: 0.3rem;
            overflow: unset;
            background-color: #fff;
            color: #000;
            -webkit-overflow-scrolling: touch;
            background: #fff;
        }
        .subscribe-modal-3-dialog-width {
            max-width: 950px;

        }
        .subscribe-modal-3-newsletter-popup {
            text-align: center;
            overflow:hidden;
        }
        .subscribe-modal-3-h2
        {
          font-size:46px;
          font-weight:700;
          letter-spacing:0.01em;
          margin-bottom:20px;
        }
        .subscribe-modal-3-p
        {
          margin-bottom:30px !important;
          font-size:14px;
          font-weight:400 !important;
          color:#777;
        }
        
        /* .subscribe-modal-3-outer input:active, .subscribe-modal-3-outer input:focus, .subscribe-modal-3-outer select:active, .subscribe-modal-3-outer select:focus, .subscribe-modal-3-outer textarea:active, .subscribe-modal-3-outer textarea:focus {
            border: 1px solid;
            border-color: #000;
           
        } */
        .subscribe-modal-3-email
        {
          margin: 0 auto;
          max-width: 400px;
          display: flex;
        }
        .subscribe-modal-3-input-group-field {
            flex: 1 1 auto;
            margin: 0;
            min-width: 0;
            color: #000;
            background-color: #f5f5f5;
            border: 1px solid #f5f5f5;
            border-color: #f5f5f5;
            max-width: 100%;
            padding: 11px 10px;
            border-radius: 0;
        }
        .sub3-logo {
          margin-bottom: 1rem;
          margin-top: -.8rem;
        }
        .subscribe-modal-3-input-group-field::placeholder {
          font-size:1rem;
        }
        .subscribe-modal-3-input-group-btn {
            flex: 0 1 auto;
            margin: 0;
            display: flex;
        }

        .subscribe-modal-3-close-btn {
    display: inline-block;
    margin: 0;
    padding: 0;
    font-weight: 400;
    font-style: normal;
    text-decoration: none;
    border-style: solid;
    line-height: 1.42;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-transform: none;
    letter-spacing: normal;
    letter-spacing: .5px;
    border: 0;
    opacity: 1 !important;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 2;
    transition: transform .15s ease-out;
    border-radius: 50%;
    color: #000;
    background: #f5f5f5;
}
.subscribe-modal-3-close-btn:hover {
  background: #fff;
}

       
.subscribe-modal-3-btn {
    display: inline-block;
    margin: 0;
    padding: 0;
    font-weight: 400;
    min-width:5rem;
    font-style: normal;
    text-decoration: none;
    border-style: solid;
    line-height: 1.42;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-transform: none;
    letter-spacing: normal;
    letter-spacing: .5px;
    transition: .2s ease-out;
    color: #fff;
    background:#000;
    border-color: #000;
}
.subscribe-modal-3-icon
{
  width: 28px;
    height: 28px;
    display: block;
    opacity:0.6;
    color: #fff;
    background: #fff;
    border-radius: 50%;
    color: #000;
    overflow: unset;
   
}
.subscribe-modal-3-cls-1 {
    fill: none;
    stroke: #000;
    stroke-miterlimit: 10;
    stroke-width: 2px;
}
.subscribe-modal-3-text-desk
{
    display:block;
    font-size:14px;
}
.subscribe-modal-3-text-mobile
{
    display:none;
}
.subscribe-modal-3-outer input:focus-visible {
    outline: unset;
    border-radius: 0px;
}

.col-lg-7m {
    -ms-flex: 0 0 calc(60% - 13px);
    flex-basis: calc(60% - 13px);
    max-width: calc(60% - 13px);
}

.col-lg-5m {
    -ms-flex: 0 0 calc(40% + 8px);
    flex-basis: calc(40% + 8px);
    max-width: calc(40% + 8px);
}
.sub3-let{
  padding: 1rem 2rem;
  margin: 5rem 0 0 0;
}
@media only screen and (max-width: 768px)
{
    .subscribe-modal-3-text-desk
{
    display:none;
}
.subscribe-modal-3-text-mobile
{
    display:block;
}
.subscribe-modal-3-outer {
            padding: 30px;
            max-height: 80vh;
           
        }
        .subscribe-modal-3-h2
        {
          font-size:46px;
         
        }
        .subscribe-modal-3-p
        {
          margin-bottom:20px !important;
          font-size:14px;
        }

        .col-lg-7m {
          -ms-flex: 0 0 calc(60% - 13px);
          flex-basis: calc(100% - 13px);
          max-width: calc(100% - 13px);
        }
        .sub3-let {
    padding: 2rem 2rem;
    margin: 2rem 0 0 0;
}

}

    </style>
      <div class="modal fade show" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered subscribe-modal-3-dialog-width newsletter" role="document">
          <div class="modal-content subscribe-modal-3-outer">
            <div class="subscribe-modal-3-newsletter-popup">
              <div class="row">
                <div class="col-lg-7m">
                  <div class="sub3-let">
                    @if($result['commonContent']['settings']['sitename_logo']=='logo')
                      <?php 
                      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                      ?>
                      @if($imagepath->path_type == 'aws')
                      <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                        <img  style="width:70px;" class="sub3-logo" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                      </a>
                      @else
                      <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                        <img style="width:70px;" class="sub3-logo" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                      </a>
                      @endif
                    @endif
                    <h2 class="subscribe-modal-3-h2">                            
                    GET <span class="common-text">25%</span> OFF
                    </h2>
                    <p class="subscribe-modal-3-p">                            
                      Subscribe to the Molla eCommerce newsletter to receive timely <br> updates from your favorite products.
                    </p>
                    <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
                    <div class="g-recaptcha" style="margin-bottom:5px;" data-sitekey="6LcgaOIlAAAAANQ9-qy97ERNTHeRVjnFgiwRiK90"></div> 
                      <div class="captca" style="margin-bottom:30px;">please verify you are human! </div>
                      <div class="subscribe-modal-3-email">
                        <input type="email" value="" name="email" class="required email subscribe-modal-3-input-group-field" required placeholder="@lang('website.Enter Your Email Address')...">
                        <div class="subscribe-modal-3-input-group-btn">
                          <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="subscribe-modal-3-btn btn-secondary swipe-to-top newsletter"><span class="subscribe-modal-3-text-desk">GO</span> <span  class="mr-0 mt-0 subscribe-modal-3-text-mobile">GO</span></button>
                        </div>
                      </div>
                    </form>
                    <p class="subscribe-modal-3-p">                            
                      <input type="checkbox" style="margin-right:10px;margin-top:2.5rem"/> Do not show this popup again
                    </p>
                  </div>
                </div>
                <div class="col-lg-5m">
                  @if($result['commonContent']['setting'][124]->value)
                    <?php 
                      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['setting'][124]->value)->where('image_type', 'ACTUAL')->select('path_type')->first(); 
                    ?>
                    @if($imagepath) 
                      @if($imagepath->path_type == 'aws')
                        <img class="img-fluid lazy_img_load subscribe-modal-3-text-desk" data-src="{{$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @else
                        <img class="img-fluid lazy_img_load subscribe-modal-3-text-desk" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                      @endif
                    @else
                      <img class="img-fluid lazy_img_load subscribe-modal-3-text-desk" data-src="{{asset('').$result['commonContent']['setting'][124]->value }}" alt="blogImage"> 
                    @endif
                  @endif
                </div>
              </div>
              <button type="button" class="subscribe-modal-3-close-btn close"  data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" focusable="false" role="presentation" class="subscribe-modal-3-icon subscribe-modal-3-icon-close" viewBox="0 0 64 64"><defs></defs><path class="subscribe-modal-3-cls-1" d="M19 17.61l27.12 27.13m0-27.13L19 44.74"></path></svg>
              </button>
            </div>  
          </div>
        </div>
      </div>



      @endif
      @endif
    

     




      <div class="mobile-overlay"></div>
      <!-- Product Modal -->
      @if($result['commonContent']['settings']['back_to_top']=='1')
    
       <a href="web/#" id="back-to-top" class="btn-secondary swipe-to-top" title="@lang('website.back_to_top')"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 30.341 40.707">
  <path id="arrow_top" d="M13.642,40.708V6.493L2.312,18.337,0,16.127,13.642,1.864V1.851h.012L15.424,0,30.341,16.147,27.99,18.319,16.842,6.251V40.708Z" transform="translate(0 -0.001)" fill="#fff"/>
</svg></a> 
       @endif


<style>

  #myModal_molla .modal-content{
    height:620px;
    overflow-y:hidden
  }

.notifications {
z-index: 99999999 !important;
}
    .lds-dual-ring.hidden { 
display: none;
}
.lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 14% auto;
  border-radius: 50%;
  border: 6px solid #333;
  border-color: #333 transparent #333 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0,0,0,.77); */
    z-index: 999;
    opacity: 1;
    transition: all 0.5s;
}




.lds-dual-ring2.hidden { 
display: none;
}
.lds-dual-ring2 {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring2:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 37% auto;
  border-radius: 50%;
  border: 6px solid #333;
  border-color: #333 transparent #333 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring2 {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@media screen and (max-width: 600px){
  #back-to-top.show {
    opacity: 0;
}

  }

.overlay2 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0,0,0,.77); */
    z-index: 999;
    opacity: 1;
    transition: all 0.5s;
}


@media only screen and (min-width: 800px) and (max-width:1024px){
  .lds-dual-ring2:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 35% auto;
    border-radius: 50%;
    border: 6px solid #333;
    border-color: #333 transparent #333 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

}

@media only screen and (min-width: 320px) and (max-width:600px){

  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 30% auto;
    border-radius: 50%;
    border: 6px solid #333;
    border-color: #333 transparent #333 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  .lds-dual-ring2:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 90% auto;
    border-radius: 50%;
    border: 6px solid #333;
    border-color: #333 transparent #333 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  #myModal_molla .modal-content{
    height:95vh !important;
    overflow-y:hidden;
    
  }
  #myModal_molla .modal-body{
    padding: 0px 0px 100px 0px;
  }
}



#myModal_molla3 .modal-content{
    height:620px;
    overflow-y:hidden
  }


  @media only screen and (min-width: 320px) and (max-width:600px){

    #myModal_molla3 .modal-content{
    height:95vh !important;
    overflow-y:hidden;
    
  }
  #myModal_molla3 .modal-body{
    padding: 0px 0px 100px 0px;
  }

  }


button{
  cursor:pointer;
}
.chip-group{
  display:flex;
  flex-wrap:wrap;
}
.chip.chip-checkbox > .chip-add-icon::after {
  content:"add"
}
.chip.chip-checkbox.active > .chip-add-icon::after {
  content:"done"
}
.chip > * {
  margin-right: 5px;
  margin-left: 5px;
  color: #757373;
  font-size: 0.8rem;
}
.chip input {
  display: none;
}
.chip.chip-checkbox,
.chip.chip-toggle,
.chip.clickable{
  cursor: pointer;
}
.chip.active {
  background-color: #d3d2d2;
  border-color:#c3c2c2;
  box-shadow: 0 1px 1px rgba(0,0,0,0.12)
}
.chip:hover, .chip:focus {
  background-color: #e3e2e2;
}
.chip:active:focus{
  background-color: #d3d2d2;  
}
.chip button{
  border:none;
  margin-top:0;
  margin-bottom:0;
  padding:0;
  background:none;
  display:inline-flex;
}
.chip {
  transition: all 0.3s ease-in-out;
  background-color: #fff;
  border-radius: 30px;
  border: 1px solid #d3d2d2;
  display: inline-flex;
  align-items:center;
  padding: 4px 6px 4px 6px;
  margin-right:6px;
  margin-bottom:6px;
}
.chip i.material-icons {
  font-size: 18px;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}


.datepicker-inline {
width: 100% !important;
}
.datepicker table {
  width: 100% !important;
}

.datepicker td, .datepicker th {
  height:30px !important;
}


#toast {
    visibility: hidden;
    max-width: 350px;
    height: 40px;
    /*margin-left: -125px;*/
    margin: auto;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;

    position: fixed;
    z-index: 9999999;
    left: 0;right:0;
    bottom: 30px;
    font-size: 17px;
    white-space: nowrap;
}

#toast #desc{

    color: #fff;
   
    padding: 6px;
    
    overflow: hidden;
	white-space: nowrap;
}

#toast.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}


#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 99999;
  cursor: pointer;
}




#myModallogin_molla .modal-content{
    height:550px;
    overflow-y:auto;
    border-radius: 0.3rem;
  }

  #myModallogin_molla1 .modal-content{
    height:550px;
    overflow-y:auto;
    border-radius: 0.3rem;
  }

  #myModallogin_molla2 .modal-content{
    height:550px;
    overflow-y:auto;
    border-radius: 0.3rem;
  }

  #myModallogin_molla3 .modal-content{
    height:550px;
    overflow-y:auto;
    border-radius: 0.3rem;
  }


</style>


      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
      
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-box-height" style="height:300px">
              <div class="modal-body">
              <div id="loadermodal" class="lds-dual-ring hidden overlay"></div>

                  <div class="container" id="products-detail">
                    
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal_molla" tabindex="-1" role="dialog" aria-hidden="true">
      
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-body">
              <div id="loadermodal2" class="lds-dual-ring2 hidden overlay2"></div>

                  <div class="container" id="products-detail2">

                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal_molla3" tabindex="-1" role="dialog" aria-hidden="true">
      
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-body">
              <div id="loadermodal3" class="lds-dual-ring2 hidden overlay2"></div>

                  <div class="container" id="products-detail3">

                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="myModal_tbm" tabindex="-1" role="dialog" aria-hidden="true">
      
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="height: 90vh;">
              <div class="modal-body p-0">
              <div id="loadermodal5" class="lds-dual-ring2 hidden overlay2" style="background: #fff;"></div>

                  <div class="container p-0" id="products-detail5">

                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          </div>
        </div>

    </div>


    <div class="modal fade" id="myModallogin_molla" tabindex="-1" role="dialog" aria-hidden="true">
      
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form-box">
            <div class="modal-body">
            <div id="loadermodallogin"  class="lds-dual-ring2 hidden overlay2"></div>

                <div class="container" id="login-detail">

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="myModallogin_molla1" tabindex="-1" role="dialog" aria-hidden="true">
      
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form-box">
            <div class="modal-body">
            <div id="loadermodallogin"  class="lds-dual-ring2 hidden overlay2"></div>

                <div class="container" id="login-detail1">

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="myModallogin_molla2" tabindex="-1" role="dialog" aria-hidden="true">
      
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form-box">
            <div class="modal-body">
            <div id="loadermodallogin"  class="lds-dual-ring2 hidden overlay2"></div>

                <div class="container" id="login-detail2">

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="myModallogin_molla3" tabindex="-1" role="dialog" aria-hidden="true">
      
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form-box">
            <div class="modal-body">
            <div id="loadermodallogin"  class="lds-dual-ring2 hidden overlay2"></div>

                <div class="container" id="login-detail3">

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
        </div>
      </div>
    </div>


    <div id="overlaylogin">
      <div id="myModallogin_molla4" class="sidenav">
      <?php
        $loginID = DB::table('current_theme')->first();
        if($loginID->login == 8) {
      ?>
        @include('auth.logins.login8')
      <?php }?>
      </div>
    </div>

    <style>
  /* The side navigation menu */
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 9999999; /* Stay on top */
    top: 0;
    right: 0;
    background-color: #fff; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s ease-in-out; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 23px;
    font-family: Gotham;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 5px;
    font-size: 36px;
    margin-left: 50px;
}


/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
    transition: margin-left .5s;
    padding: 0px;
}


/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}

</style>

<link rel="stylesheet" href="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.css') !!} ">
<script src="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>


<body>

    <?php 
      $outlet = DB::table('appointment_outlet')->where('status', '=', 1)->get(); 

      
      if(auth()->guard('customer')->check()){
        $fname = auth()->guard('customer')->user()->first_name;
        $phone = auth()->guard('customer')->user()->phone;
        $address = auth()->guard('customer')->user()->address;
      } else{
        $fname = '';
        $phone = '';
        $address = '';
      }


    ?>

<div id="toast"><div id="desc">Appointment Booked Successfully</div></div>

<div id="overlay">
  <div id="mySidenav" class="sidenav">
    <a style="text-align:center;position: absolute;left: 0;right: 15%;top: 1.5%;">Book Appointment</a>
    <h5 style="text-align:center" id="productName"></h5>
    <div id="resfinal" style="color:red;text-align:center"></div>

  <a href="javascript:void(0)" class="closebtn" id="closeNav">&times;</a>
    <form method="post">
      <input id="productID" type="hidden" class="form-control" name="products_id" >
      <input id="product_name" type="hidden" class="form-control" name="product_name" >

      
      <div class="modal-body">
        <div class="row">


        <div class="col-sm-12 form-group">
            <label>Outlet Name</label>
            <select name="outlet_id" id="outlet" class="form-control outClass">
                <option value="">Select Outlet</option>
                @foreach($outlet as $jesout)
                  <option value="{{ $jesout->id }}">{{ $jesout->name }}</option>
                @endforeach
            </select>
            <span style="color:red;margin-top:10px" class="err-req0"></span>

          </div>

          <div class="col-sm-12 form-group">
            <label>Full Name</label>
            <input id="appiname" type="text" class="form-control" placeholder="Full Name" name="Full Name" value="{{ $fname }}" required>
            <span style="color:red;margin-top:10px" class="err-req1"></span>

          </div>
          <div class="col-sm-12 form-group">
            <label>Phone Number</label>
            <input id="phone" type="text" class="form-control" placeholder="Phone" name="Phone" value="{{ $phone}}" required>
            <span style="color:red;margin-top:10px" class="err-req2"></span>
          </div>
          <div class="col-sm-12 form-group">
            <label>Address</label>
            <textarea id="address" name="address" class="form-control" rows="5" placeholder="address" required>{{ $address }}</textarea>
            <span style="color:red;margin-top:10px" class="err-req6"></span>
          </div>
          <div class="col-sm-12 form-group">
            <label>Appointment Date</label>
            <div class="input-group">
              <input type="text" name="app_date" id="app_date" onfocus="blur();" class="form-control datepicker" autocomplete="off">
            </div> 
            <span style="color:red;margin-top:10px" class="err-req3"></span>
          </div>
          <div class="col-sm-12 form-group">
            <label>Appointment Time</label>

                <fieldset>   
                <div class="chip-group" tabindex="-1" role="radiogroup">
                   <span id="resultData"></span>
                  </div>
            </fieldset>   
                         
              <span style="color:red;margin-top:10px" class="err-req4"></span>
          </div>

          <!-- <div class="col-sm-12 form-group">
            <label>Option</label>
            <select name="option_id" id="option" class="form-control">
                <option value="">Select Option</option>
            </select>
            <span style="color:red;margin-top:10px" class="err-req7"></span>

          </div> -->

          <div class="col-sm-12 form-group">
            <label>Message</label>
            <textarea id="message" class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            <span style="color:red;margin-top:10px" class="err-req5"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="subsave" type="button" class="btn btn-success">Submit</button>
      </div>
    </form>
</div>
</div>


<div id="main"></div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>

/* Set the width of the side navigation to 0 */


$(document).on("keyup", ".chip.chip-checkbox, .chip.toggle, .chip.clickable", function(e){
  if(e.which==13 || e.which == 32)
     this.click();
});
$(document).on("click", ".chip button", function(e){
  e.stopPropagation();
});
$(document).on("click", ".chip.chip-checkbox", function(){
  let $this = $(this);
  let $option = $this.find("input");
  if($option.is(":radio")){
    let $others = $("input[name=" + $option.attr("name") + "]").not($option);
    $others.prop("checked", false);
    $others.change();
  }
  $option.prop("checked", !$this.hasClass("active"));
  $option.change();
});
$(document).on("click", ".chip.toggle", function(){
  $(this).toggleClass("active");
});
$(document).on("change", ".chip.chip-checkbox input", function(){
  let $chip = $(this).parent(".chip");
  $chip.toggleClass("active",this.checked);
  $chip.attr("aria-checked", this.checked ? "true" : "false");
});



</script>

    
<!-- 
<script>
      $('#myModal_molla').on('hidden.bs.modal', function () {
        // var id = jQuery("#detailID").val();
        // if(id === 'detail'){
        //   history.go(0);
        //}
        $.getScript("{{asset('resources/web/common/scripts.js')}}");
      });

</script> -->

      <!-- Include js plugin -->
       @include('web.common.scripts')

    </body>
</html>
