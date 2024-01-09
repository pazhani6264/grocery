<style>
.footer29 .subscribe .btn-subscribe {
    height: 46px !important;
    font-weight: 700 !important;
}
.footer29 .subscribe input {
    height: 46px !important;
}
  @media only screen and (min-width: 700px) and (max-width: 800px){
    .f30 .subscribe form {
flex-grow: 0;
flex-shrink: 0;
flex-basis: calc(70% - 10px);
max-width: calc(70% - 10px);
margin-left: auto;
margin-right: auto;
}
  }
  @media only screen and (max-width: 768px){
  .f30 .footer-middle {
    padding: 6.7rem 0 0rem;
    border-top: 0.1rem solid #444;
}
.heading {
    margin-bottom: 31px;
}
  }

  @media only screen and (min-width: 280px) and (max-width: 600px){
    .footer14 .subscribe .btn-subscribe {
        min-width: 130px;
        padding: 1rem !important;
        color: #9ACE69;
        border: .1rem solid #fff;
        border-left-width: 0;
        -webkit-transition: all .3s;
        transition: all .3s;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: .1em;
        background-color: #fff;
        border-radius: 0px !important;
        margin-top: 0px;
        }
        .input-group-append {
margin-left: -1px;
}
.input-group-prepend, .input-group-append {
display: inline-block;
}
.footer14 .subscribe input{
  width:50%;
}
.f30 .subscribe form {
flex-grow: 0;
flex-shrink: 0;
flex-basis: calc(90% - 10px);
max-width: calc(90% - 10px);
margin-left: auto;
margin-right: auto;
}
  }
</style>



@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
<footer class="footer footer-molla-30 footer-2 footer14 footer29 f30 d-lg-none d-xl-none">

<div class="footer-top" style="background-image: url('images/footer-bg.jpg');">
    <section class="subscribe">
        <div class="heading text-center">
          <h3 class="heading-title text-white">Get The Latest Deals</h3>
          <p class="heading-cat">Sign up & receive 10% off your first order</p>
        </div>
        <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
          <div class="input-group">
            <input type="email" name="email" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
            <div class="input-group-append margin-auto">
              <button class="btn btn-subscribe text-comm-color" id="mc-embedded-subscribe" type="submit">
                <span>Subscribe</span>
              </button>
            </div>
            <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
            <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
          </div>
        </form>
    </section>
  </div>

  <hr>

  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-about">
            <h4 class="widget-title">About P24</h4>
            <p style="line-height:2">{{$result['commonContent']['setting'][111]->value}}</p>
            <div class="widget-about-info">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <div class="social-icons social-icons-color">
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
                    <a target="_blank" class="social-icon social-youtube f12-tikcolor common-hover-white" href="{{$result['commonContent']['setting'][216]->value}}">
                    <svg class='fontawesomesvg' width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    </a>
                  @endif

                  @if($result['commonContent']['setting'][218]->value!='')
                    <a target="_blank" class="social-icon social-youtube" href="{{$result['commonContent']['setting'][218]->value}}">
                      <i class="fa fa-instagram"></i>
                    </a>
                  @endif
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
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
        <div class="col-sm-6 col-lg-3">
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
        <div class="col-sm-6 col-lg-3">
          <div class="widget">
            <h4 class="widget-title">My Account</h4>
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
  <div class="footer-bottom text-center">
    <div class="container">
      <figure class="footer-payments footerpayemnt-14">
        <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="272" height="20">
      </figure>
      <div class="footerpayemnt-14" style="margin-top:50px">
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
