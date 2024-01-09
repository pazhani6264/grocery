<style>
  @media only screen and (min-width: 280px) and (max-width: 600px){
    .footer-menu {
        margin-bottom: 1rem;
    }
    .footer-bottom .social-icon {
      justify-content: center;
      font-size: 1rem !important;
      width: 2.5rem;
      height: 3rem;
    }
    .info-bg-16 .info-boxes-contents {
      padding: 2rem 15px 2rem 15px;
      border-top: 0px solid #ebebeb;
    }
  }
  </style>

@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp

<footer class="footer footer-molla footer-2 footer-17 d-lg-none d-xl-none">
  
  <div class="footer-bottom">
    <div class="container">
      
     





      <div class="social-icons social-icons-color tabw-100">
       <!--  <span class="social-label demo-12-social-hide">Social Media</span> -->
       @if($result['commonContent']['setting'][50]->value!='')
                    <a target="_blank" class="social-icon social-facebook" href="{{$result['commonContent']['setting'][50]->value}}">
                      <i class="fa fa-facebook-f"></i>
                    </a>
                  @endif
                  @if($result['commonContent']['setting'][52]->value!='')
                    <a target="_blank" class="social-icon social-twitter" href="{{$result['commonContent']['setting'][52]->value}}">
                      <i class="fa fa-twitter"></i>
                    </a>
                  @endif
                  @if($result['commonContent']['setting'][51]->value!='')
                    <a target="_blank" class="social-icon social-instagram" href="{{$result['commonContent']['setting'][51]->value}}">
                      <i class="fa fa-google"></i>
                    </a>
                  @endif
                  @if($result['commonContent']['setting'][53]->value!='')
                    <a target="_blank" class="social-icon social-youtube" href="{{$result['commonContent']['setting'][53]->value}}">
                      <i class="fa fa-linkedin"></i>
                    </a>
                  @endif
                  @if($result['commonContent']['setting'][216]->value!='')
                    <a target="_blank" class="social-icon social-youtube f12-tikcolor common-fill-hover" href="{{$result['commonContent']['setting'][216]->value}}">
                    <svg class='fontawesomesvg' width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    </a>
                  @endif

                  @if($result['commonContent']['setting'][218]->value!='')
                    <a target="_blank" class="social-icon social-youtube" href="{{$result['commonContent']['setting'][218]->value}}">
                      <i class="fa fa-instagram"></i>
                    </a>
                  @endif
                  
      </div>


      <ul class="footer-menu">
        <li>
          <a href="{{url('/page?name=term-services')}}">Terms Of Use</a>
        </li>
        <li>
          <a href="{{url('/page?name=refund-policy')}}">Privacy Policy</a>
        </li>
      </ul>

      <p class="footer-copyright tabw-100">Copyright © 2021 Platinum Code Sdn Bhd . All Rights Reserved.</p>


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
