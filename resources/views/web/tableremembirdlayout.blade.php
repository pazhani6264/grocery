<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
@include('web.common.remembirdmemeta')
@php
  $customer = auth()->guard('customer')->user();
@endphp

  </head>
    <!-- dir="rtl" -->
    <?php 
    if($result['commonContent']['settings']['background_type']== '2')
    {
      $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['background_image'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 
    }

      ?>
                 
    <body class="animation-s<?php  echo $final_theme['transitions']; if(!empty(session('direction')) and session('direction')=='rtl') print ' bodyrtl';?> " <?php if($result['commonContent']['settings']['background_type']== '1' ) {?>style="background-color:{{ $result['commonContent']['settings']['background_color']}}" <?php } else { if($imagepath->path_type == 'aws') {?> style="background-image:url({{ $result['commonContent']['settings']['background_image']}});background-repeat: no-repeat;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" <?php } else {?> style="background-image:url({{ asset($result['commonContent']['settings']['background_image'])}});background-repeat: no-repeat;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" <?php }}?> >
      
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

        

        
        <!-- End Top Offer -->
        
        <!-- Header Content -->
        @include('web.headers.weborderHeader')        
        
        <!-- End Header Content -->
        @include('web.headers.webmobile')
      <!-- End of Header Sections -->
      
       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->
         @yield('content')



      <!-- Footer content -->
      <div class="notifications" id="notificationWishlist"></div>
      <input type="hidden" value="1" id="tooltip-flag">

      @include('web.table.partials.modals')
    
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
                            <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
                            <div class="form-group">
                              <input type="email" value="" name="email" class="required email form-control" placeholder="@lang('website.Enter Your Email Address')...">
                            </div>
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



       @endif


      <div class="mobile-overlay"></div>
      <!-- Product Modal -->


     <!--  <a href="web/#" id="back-to-top" class="btn-secondary swipe-to-top" title="@lang('website.back_to_top')">&uarr;</a> -->


<style>

  #myModal_molla .modal-content{
    height:620px;
    overflow-y:hidden
  }

.notifications {
z-index: 9999 !important;
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
