<style>

.header-top-color-37:hover {
color: #fdda05 !important;
}
.demo-32-footer-sub {
    margin-top: 22px;
    padding: 37px 0;
}
.demo-32-col
{
    width: 100%;
    padding-right: 10px;
    padding-left: 10px;
    margin-right: auto;
    margin-left: auto;
}
.demo-32-row
{
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
.demo-32-sub-height
{
  height: 46px !important;
}
.footer31 .cta-horizontal-box .btn {
    font-weight: 600 !important;
    color: #b7853f;
    background-color: #fff;
    font-size: 0.9rem;
    letter-spacing: 2px;
}
.info-box-14-margin
{
  margin-right:0px;
}
.footer31 {
    background-color: #fff;
}
.info-boxes-contents {
    padding: 24px 0;
}
.info-boxes-contents .info-box .panel .block h4 {
    font-size: 16px;
    font-weight: 600 !important;
    white-space: normal;
    overflow: hidden;
    /* text-overflow: ellipsis; */
    /* display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical; */
    margin-bottom: 5px !important;
    letter-spacing: 0.8px;
    color: #333;
    margin-top: 2px;
}
.info-boxes-contents .info-box .panel .block p {
    font-size: 16px;
    margin: 0;
    white-space: normal;
    overflow: hidden;
    /* text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical; */
    font-weight: 400 !important;
}
</style>

@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
<footer class="footer footer-molla footer-area footer-2 footer31 d-none d-lg-block d-xl-block footer-mb-100">


<div class="container-fluid finfo demo-32-col">
<hr>
      <div class="info-boxes-contents">
        <div class="row demo-32-row">
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
            foreach($shoppinginfo as $info)
            {
              if($info->type==1)
              {
          ?>
                <div class="col-12 col-md-6  col-sm-6 col-lg-3">
                  <div class="info-box first">
                    <div class="panel mob-panel">
                    <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                      <div class="block">
                        <h4 class="title">{{ $info->shopping_info_name }}</h4>
                        <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                      </div>
                    </div>
                  </div>
                </div>
          <?php  }
            if($info->type==2)
            { 
          ?>
              <div class="col-12 col-md-6  col-sm-6 col-lg-3">
                <div class="info-box">
                  <div class="panel mob-panel">
                  <span class="icon-box-icon info-box-14-display info-box-14-margin">
                  <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                  </span>
                    <div class="block">
                      <h4 class="title">{{ $info->shopping_info_name }}</h4>
                      <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                  </div>
                </div>
              </div>
          <?php   }
            if($info->type==3)
            {
          ?>
              <div class="col-12 col-md-6  col-sm-6 col-lg-3">
                <div class="info-box">
                  <div class="panel mob-panel">
                  <span class="icon-box-icon info-box-14-display info-box-14-margin">
                  <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>

                  </span>
                    <div class="block">
                      <h4 class="title">{{ $info->shopping_info_name }}</h4>
                      <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                  </div>
                </div>
              </div>
          <?php  }
            if($info->type==4)
            {
          ?>
              <div class="col-12 col-md-6  col-sm-6 col-lg-3">
                <div class="info-box last">
                  <div class="panel mob-panel">
                  <span class="icon-box-icon info-box-14-display info-box-14-margin">
                  <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>

                  </span>
                    <div class="block">
                      <h4 class="title">{{ $info->shopping_info_name }}</h4>
                      <p class="info-color-p-1">{{ $info->shopping_info_description }}</p>
                    </div>
                  </div>
                </div>
              </div>
          <?php   }
            }
          ?>
        </div>
      </div>
     
    </div>

  <div class="cta cta-horizontal bg-31 cta-horizontal-box demo-32-footer-sub">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-12">
          <div class="row align-items-center">
            <div class="col-lg-6 cta-txt text-lg-left text-center">
              <h3 class="cta-title text-white my-2 mt-0">Join Our Newsletter</h3>
              <p class="cta-desc font-size-normal text-comm-color second-primary-color font-weight-normal">Subcribe to get information about products and coupons</p>
            </div>
            <div class="col-lg-6">
              <form action="{{url('subscribeMail')}}"  class="mailchimp-form d-flex justify-content-end justify-content-center">
                <div class="input-group">
                  <input  type="email" name="email" class="form-control demo-32-sub-height mr-0 font-weight-normal border-0" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                  <div class="input-group-append">
                    <button id="mc-embedded-subscribe" class="btn demo-32-sub-height text-uppercase" type="submit">Subscribe</button>
                  </div>
                  <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                    <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

   <!-- <section class="subscribe ">
    <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-10">
            <div class="row align-items-center">
              <div class="col-lg-6 cta-txt text-lg-left text-center">
                <h4 class="cta-title text-white my-2 mt-0">Join Our Newsletter</h4>
                <p class="cta-desc font-size-normal second-primary-color font-weight-normal">Subcribe to get information about products and coupons</p>
              </div>
              <div class="col-lg-6">
                <form  action="{{url('subscribeMail')}}" >
                  <div class="input-group">
                    <input type="email" name="email" placeholder="@lang('website.Your email address here')" aria-label="Email Adress" required="">
                    <div class="input-group-append">
                      <button class="btn btn-subscribe" type="submit">
                        <span>Subscribe</span>
                      </button>
                    </div>
                    <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                    <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

  <div class="footer-middle footer31-top-border" style="background: #f9fafc;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-lg-5">
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
                      <li> <a class="header-top-color-37" href="{{ URL::to('/page?name='.$page->slug)}}"></i>{{$page->name}}</a> </li>
                  @endforeach
              @endif
              <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
            @if(count($zippage)>0)
              @foreach ($zippage as  $key=>$zip)
              <li> <a class="header-top-color-37" href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}">{{$zip->name}}</a> </li>
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
              <li> <a class="header-top-color-37" href="{{url('profile')}}">@lang('website.Profile')</a> </li>
                <li> <a class="header-top-color-37"  href="{{url('compare')}}">@lang('website.Compare')&nbsp;(<span id="compare1">{{$count}}</span>)</a> </li>
                <li> <a class="header-top-color-37"  href="{{url('logout')}}">@lang('website.Logout')</a> </li>
              <?php }else{ ?>
                <?php if($result['commonContent']['settings']['view_login_button'] == 1) { ?>
                  <li> <a class="header-top-color-37"   href="{{ URL::to('/login_nine')}}">Login</a> </li>    
              <?php } } ?>
              <li> <a class="header-top-color-37"  href="{{ URL::to('/')}}"></i>Home</a> </li>
              <li> <a class="header-top-color-37"  href="{{ URL::to('/shop')}}"></i>Shop</a> </li>
              <li> <a class="header-top-color-37"  href="{{ URL::to('/orders')}}"></i>Orders</a> </li>
              <li> <a class="header-top-color-37"  href="{{ URL::to('/viewcart')}}"></i>Shopping Cart</a> </li>
              <li> <a class="header-top-color-37"  href="{{ URL::to('/wishlist')}}"></i>Wishlist</a> </li>
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
          <a class="header-top-color-37" href="{{url('/page?name=term-services')}}">Terms Of Use</a>
        </li>
        <li>
          <a class="header-top-color-37" href="{{url('/page?name=refund-policy')}}">Privacy Policy</a>
        </li>
      </ul>
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
