<style>
  .cwhite{
    fill:#fff;
  }
  .footer-34-sub-section {
    padding: 30px 0;
    border-top: 1px solid;
    border-top-color: #e8e8e1;
    background:#fff;
  }
  .footer-34-page-width
  {
    padding: 0 40px;
  }
  .footer-34-footer-newsletter
  {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;

  }
  .footer-34-subscribe
  {
    margin-bottom: 0;
    padding: 0 20px;
    font-weight: 700;
    font-size: 16px;
  }
  .padlr20
  {
    padding: 0 20px;
  }
  .footer-34-subscribe-p
  {
    margin:0;
    color:#000 !important;
  }
  .footer-34-input {
    border: 1px solid !important;
    border-color: #e8e8e1 !important;
    max-width: 100%;
    padding: 8px 10px;
    font-size:14px;
    border-radius: 0;
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    margin-bottom: 0;
}
.footer-34-input-outer
{
  max-width:400px;
}
.footer-34-btn-outer {
    padding: 11px 25px;
  
    color: #fff;
    font-size: 16px;
    font-weight: 700 !important;
    border-bottom-right-radius: 3px;
    border-top-right-radius: 3px;
}
::-webkit-input-placeholder {
  color:#000 !important;
  font-size:14px;
}

:-moz-placeholder {
  color:#000 !important;
  font-size:14px;
}

::-moz-placeholder {
  color:#000 !important;
  font-size:14px;
}

:-ms-input-placeholder {  
  color:#000 !important;
  font-size:14px;
}

::input-placeholder {  
  color:#000 !important;
  font-size:14px;
}

::placeholder {
  color:#000 !important;
  font-size:14px;
}
.page-width-34
{
  padding:0 40px;
  
}
.footer-34-blocks {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.footer-34-title {
    margin-bottom: 15px;
    font-weight: 700 !important;
    font-size: 14px;
    color: #fff;
}
.footer-34-menu {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
}
.footer-34-menu li {
    margin: 0;
    color: #fff;
}
.footer-34-menu a {
    display: inline-block;
    padding: 4px 0;
    font-size:13px;
    font-weight: 400 !important;
}
.footer-34-menu-underline a {
    text-decoration: underline;
    text-underline-offset: 2px;
}
.icon-and-text-34 {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}

.site-footer-34 a {
    color: #fff;
    
}
.site-footer-34
{
  font-size:15px;
  background-color: #08409e;
}
.footer-34-block {
    flex: 0 1 25%;
    max-width: 210px;
}
.footer-34-menu .icon {
    margin-right: 10px;
}
.icon-and-text-34 .icon {
    flex: 0 0 auto;
    display: inline-block;
    width: 20px;
    height: 20px;
    vertical-align: middle;
    fill: #fff;
    color:#fff;
}
.footer-34-social {
    margin: 0;
}

.no-bullets-34 {
    list-style: none outside;
    margin-left: 0;
}
.footer-34-social li {
    display: inline-block;
    margin: 0 15px 15px 0;
}
.footer-34-social a {
    display: block;
}
.cls-1-34 {
    fill: none;
    stroke: #fff;
    stroke-width: 2px;
    stroke-miterlimit: 10;
}
.icon-fallback-text-34 {
    clip: rect(0,0,0,0);
    overflow: hidden;
    position: absolute;
    height: 1px;
    width: 1px;
    color:#fff;
}
.small-text-left-34
{
  text-align:center;
}
.footer-34-section {
    border-top-color: #08409e !important;
    padding: 30px 0;
    border-top: 1px solid;
}
.footer-34-base-links {
    font-size: 13px;
}
.footer-34-base-links span {
    display: inline-block;
    padding: 2px 20px 2px 0;
    color: #fff !important;
}
.footer-34-base-links a{
    color: #fff !important;
}
@media only screen and (min-width: 769px)
{
.footer-34-section-menus {
    padding-top: 50px;
    padding-bottom: 30px;
}
}

</style>
@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
<footer class="footer footer-molla footer-area padding-top-65 footer-2 footer33 d-none d-lg-block d-xl-block footer-mb-100">

  <div class="footer-34-sub-section">
    <div class="footer-34-page-width">
      <div class="footer-34-footer-newsletter">
        <div class="footer-34-subscribe">
          <p class="footer-34-subscribe-p">Subscribe today and get 5% off your first purchase</p>
        </div>
        <form action="{{url('subscribeMail')}}"  class="mailchimp-form padlr20 d-flex justify-content-end justify-content-center">
          <div class="input-group footer-34-input-outer">
          <input style="height: calc(3rem + 5px);" type="email" name="email" class="form-control footer-34-input mr-0 font-weight-normal border-0" placeholder="Enter your Email" aria-label="Email Adress" required="">
            <div class="input-group-append">
              <button id="mc-embedded-subscribe" class="btn footer-34-btn-outer btn-secondary" type="submit">Subscribe</button>
            </div>
            <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
              <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer class="site-footer-34">
    <div id="FooterMenus-34" class="footer-section-34 footer-34-section-menus">
      <div class="page-width-34">
        <div class="footer-34-blocks">
          <div class="footer-34-block">
            <div class="footer-34-title">Other Pages
          </div>
          <ul class="footer-34-menu">
            @if(count($result['commonContent']['pages']))
              @foreach($result['commonContent']['pages'] as $page)
                  <li> <a href="{{ URL::to('/page?name='.$page->slug)}}" data-toggle="" data-placement="left" title="{{$page->name}}">{{$page->name}}</a> </li>
              @endforeach
            @endif
            <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
            @if(count($zippage)>0)
              @foreach ($zippage as  $key=>$zip)
              <li> <a href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}">{{$zip->name}}</a> </li>
              @endforeach
            @endif
            <li> <a href="{{ URL::to('/contact')}}"  data-toggle="" data-placement="left" title="@lang('website.Contact Us')">@lang('website.Contact Us')</a> </li>
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
            <li><a href="{{url('profile')}}">My account</a></li>
            <?php }else{ ?>
              <li><a href="{{ URL::to('/login')}}">My account</a></li>
              <?php } ?>
          </ul>
        </div>
        <div class="footer-34-block" data-type="contact">
          <div class="footer-34-mobile-section">
            <div class="footer-34-blocks-mobile">
              <div class="footer-34-block-mobile">
                <div class="footer-34-title">
                  Get in touch
                </div>
                <ul class="footer-34-menu footer-34-menu-underline">
                  <li><a href="tel:{{$result['commonContent']['setting'][11]->value}}">
                    <span class="icon-and-text-34">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-phone" viewBox="0 0 64 64"><defs><style>.cls-1-34{fill:none;stroke:#fff;stroke-width:2px}</style></defs><path class="cls-1-34" d="M18.4 9.65l10.2 10.2-6.32 6.32c2.1 7 6.89 12.46 15.55 15.55l6.32-6.32 10.2 10.2-8.75 8.75C25.71 50.3 13.83 38.21 9.65 18.4z"></path></svg>
                      
                      <span>{{$result['commonContent']['setting'][11]->value}}</span>
                    </span>
                  </a></li>
                  <li><a href="{{ URL::to('/contact')}}">
                    <span class="icon-and-text-34">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-email" viewBox="0 0 64 64"><defs><style>.cls-1-34{fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px}</style></defs><path class="cls-1-34" d="M63 52H1V12h62zM1 12l25.68 24h9.72L63 12M21.82 31.68L1.56 51.16m60.78.78L41.27 31.68"></path></svg>
                      
                      <span>Email us</span>
                    </span>
                  </a></li>
                </ul>
              </div>
              <div class="footer-34-block-mobile">
                <div class="footer-34-title">
                  Follow us
                </div>
                <ul class="no-bullets-34 footer-34-social">
                  <li>
                    @if(!empty($result['commonContent']['setting'][52]->value))
                      <a href="{{$result['commonContent']['setting'][52]->value}}"  class="fab tw fa-twitter" target="_blank"></a>
                    @else
                        <a href="#" class="fab tw fa-twitter" ></a>
                    @endif
                    <span class="icon-fallback-text-34">Instagram</span>
                    </a>
                  </li>
                  <li>
                    @if(!empty($result['commonContent']['setting'][50]->value))
                      <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f" target="_blank"></a>
                    @else
                      <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f"></a>
                    @endif
                    <span class="icon-fallback-text-34">Facebook</span></a>
                  </li>
                  <li>
                    @if(!empty($result['commonContent']['setting'][51]->value))
                      <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab sgo fa-google" target="_blank" ></a>
                    @else
                        <a href="#"><i class="fab sgo fa-google" ></i></a>
                    @endif
                    <span class="icon-fallback-text-34">YouTube</span>
                    </a>
                  </li>
                  <li>
                    @if(!empty($result['commonContent']['setting'][53]->value))
                      <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab sln fa-linkedin-in" target="_blank"></a>
                    @else
                        <a href="#" class="fab sln fa-linkedin-in"></a>
                    @endif
                    <span class="icon-fallback-text-34">LinkedIn</span>
                    </a>
                  </li>
                  <li>
                    @if(!empty($result['commonContent']['setting'][53]->value))
                      <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab sln cwhite common-fill-hover" target="_blank"><svg class='fontawesomesvg' width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a>
                    @else
                        <a href="#" class="fab sln cwhite common-fill-hover"><svg class='fontawesomesvg' width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a>
                    @endif
                    <span class="icon-fallback-text-34">LinkedIn</span>
                    </a>
                  </li>

                  <li>
                    @if(!empty($result['commonContent']['setting'][218]->value))
                      <a href="{{$result['commonContent']['setting'][218]->value}}" class="fab sln fa-instagram" target="_blank"></a>
                    @else
                        <a href="#" class="fab sln fa-instagram"></a>
                    @endif
                    <span class="icon-fallback-text-34">Instagram</span>
                    </a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-34-block" data-type="menu">
          <div class="footer-34-title">Terms and Policies
          </div>
          <ul class="footer-34-menu">
            <li><a href="{{url('/page?name=term-services')}}">Terms of Service</a></li>
            <li><a href="{{url('/page?name=refund-policy')}}">Shipping Policy</a></li>
            <li><a href="{{url('/page?name=refund-policy')}}">Refund Policy</a></li>
            <li><a href="{{url('/page?name=privacy-policy')}}">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footer-34-block" data-type="payment">
          <div class="footer-34-mobile-section">
            <div class="footer-34-blocks-mobile">
              <div class="footer-34-block-mobile">
                <div class="footer-34-title">
                  We accept
                </div>
                <ul class="inline-list-34 payment-icons-34">
                  <li class="icon-payment-34">
                    <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" width="38" height="24" role="img" aria-labelledby="pi-paypal"><title id="pi-paypal">PayPal</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path fill="#003087" d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"></path><path fill="#3086C8" d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"></path><path fill="#012169" d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"></path></svg>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-34-section">
    <div class="page-width-34 small-text-left-34">
      <div class="footer-34-base-links">
        <span>
          © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank">Platinum24, Inc.</a> All Rights Reserved.
        </span>
      </div>
    </div>
  </div>
</footer>
  


  <!-- <div class="footer-middle footer31-top-border">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-lg-5">
          <div class="widget widget-about">
          @if($result['commonContent']['settings']['sitename_logo']=='logo')
              <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
              <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                <img  class="footer-logo" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              </a>
              @else
              <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
                <img  class="footer-logo" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              </a>
              @endif
            @endif
            <p>{{$result['commonContent']['setting'][111]->value}}</p>
            <div class="widget-about-info">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <span class="widget-about-title">Got Question? Call us 24/7</span>
                  <a style="font-size:20px;" href="tel:{{$result['commonContent']['setting'][11]->value}}">{{$result['commonContent']['setting'][11]->value}}</a>
                </div>
                <div class="col-sm-6 col-md-6">
                  <span class="widget-about-title">Payment Method</span>
                  <figure class="footer-payments">
                    <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="200" height="20">
                  </figure>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2">
          <div class="widget">
            <h4 class="widget-title">Information</h4>
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
        <div class="col-sm-4 col-lg-2">
          <div class="widget">
            <h4 class="widget-title">Customer Service</h4>
            <ul class="widget-list">
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
              <li> <a href="{{url('profile')}}">@lang('website.Profile')</a> </li>
                <li> <a href="{{url('compare')}}">@lang('website.Compare')&nbsp;(<span id="compare1">{{$count}}</span>)</a> </li>
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
        <div class="col-sm-4 col-lg-2">
          <div class="widget">
            <h4 class="widget-title">My Account</h4>
            <ul class="widget-list">
              <li> <span><b><strong>Address : </strong></b></span> <br><span style="width: 100%;"> {{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
              <li> <span><b><strong>Phone : </strong></b></span> <br> <span dir="ltr" style="width: 100%;">({{$result['commonContent']['setting'][11]->value}})</span> </li>
              <li> <span><b><strong>Email : </strong></b></span> <br> <span style="width: 100%;"><a class="email-font" href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>
            </ul>
          </div>
        </div>
        

      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container-fluid">
      <p class="footer-copyright">Copyright © @lang('website.Copy Rights') <a href="https://platinum24.net/" target="_blank">Platinum24, Inc</a> . All Rights Reserved.</p>
      <ul class="footer-menu">
        <li>
          <a href="{{url('/page?name=term-services')}}">Terms Of Use</a>
        </li>
        <li>
          <a href="{{url('/page?name=refund-policy')}}">Privacy Policy</a>
        </li>
      </ul>
      <div class="social-icons social-icons-color">
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
  </div> -->

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
