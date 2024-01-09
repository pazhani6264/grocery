@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp

<footer class="footer footer-molla footer-2 d-lg-none d-xl-none">
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-6 col-md-5l">
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
            <p style="margin-bottom:2.5rem;line-height:2rem">{{$result['commonContent']['setting'][111]->value}}</p>
            <div class="widget-about-info">
              <div class="row">
                <div class="col-sm-6 col-md-4">
                  <span class="widget-about-title">Got Question? Call us 24/7</span>
                  <a  href="tel:{{$result['commonContent']['setting'][11]->value}}">{{$result['commonContent']['setting'][11]->value}}</a>
                </div>
                <div class="col-sm-6 col-md-8">
                  <span class="widget-about-title">Payment Method</span>
                  <figure class="footer-payments">
                    <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="272" height="20">
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
    <div class="container">
      
      <div class="social-icons social-icons-color">
        <span class="social-label">Social Media</span>
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
          <a target="_blank" class="social-icon social-youtube common-hover" href="{{$result['commonContent']['setting'][216]->value}}">
          <svg class='fontawesomesvg' width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
          </a>
        @endif

        @if($result['commonContent']['setting'][218]->value!='')
          <a target="_blank" class="social-icon social-youtube" href="{{$result['commonContent']['setting'][218]->value}}">
            <i class="fa fa-instagram"></i>
          </a>
        @endif

      </div>

      <div>
      <ul class="footer-menu">
        <li>
          <a href="{{url('/page?name=term-services')}}">Terms Of Use</a>
        </li>
        <li>
          <a href="{{url('/page?name=refund-policy')}}">Privacy Policy</a>
        </li>
      </ul>
      </div>

      <p class="footer-copyright">Copyright © 2021 Platinum Code Sdn Bhd . All Rights Reserved.</p>


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
