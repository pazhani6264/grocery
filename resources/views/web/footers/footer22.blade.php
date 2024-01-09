<style>
  .footer-16 {
background-color: #222;
}
  .page-content-div {
    max-width: calc(100% - 260px);
}
.fdesk .footer-middle{
  flex-basis: calc((100% + 20px) * .8 + 20px);
    max-width: calc((100% + 20px) * .8 + 20px);
    margin-left: auto;
    margin-right: auto;
}
.footer-16 .widget-title{
  font-size:0.9rem !important;
}
.subscribe-22 .heading h3.heading-title{
  font-size:22px !important;
}
.subscribe-22 form {
    flex-grow: 0;
    flex-shrink: 0;
    flex-basis: calc(51% - 10px) !important;
    max-width: calc(51% - 10px) !important;
    margin-left: auto;
    margin-right: auto;
}
.demo-23-heading-cat
{
  text-transform: none !important;
}
.subscribe-22 input{
  padding:.85rem 0 .85rem 2.2rem;
}
.footer-2 .footer-middle{
  padding-top :4rem;
}
@media screen and (min-width: 1200px){
  .col-xl-8-3col {
    flex: 0 0 37.5%;
    max-width: 37.5%;
}
  .col-xl-8-2col {
      flex: 0 0 20%;
      max-width: 20%;
  }
}


</style>

@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp

<div class="page-content-div ml-auto md-none">
<footer class="footer fdesk footer-molla  footer-2 footer-16 d-none d-lg-block d-xl-block footer-mb-100">


  <div class="footer-middle">
    <div class="container">

    
    <section class="subscribe-22">
      <div class="heading text-center">
        <h3 class="heading-title">Get The Latest Deals</h3>
        <p class="heading-cat demo-23-heading-cat">and receive $20 coupon for first shopping</p>
      </div>

      <form class=" mailchimp-form" action="{{url('subscribeMail')}}" >
        <div class="input-group">
          <input type="email" name="email" placeholder="@lang('website.Your email address here')" aria-label="Email Adress" required="">
          <div class="input-group-append">
            <button class="btn btn-subscribe-22" id="mc-embedded-subscribe" type="submit">
              <span>Subscribe</span>
            </button>
          </div>
          <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
          <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
        </div>
      </form>
    </section>

      <div class="row footer-22-padd">
        <div class="col-xl-8-3col col-md-12">
          <div class="widget widget-about">
          <h4 class="widget-title">About Us</h4>

          <p style="line-height:2">{{$result['commonContent']['setting'][111]->value}}</p>
            <div class="widget-about-info">
              <div class="row">
                <div class="col-sm-6 col-md-12">
                  <span class="widget-about-title">Payment Method</span>
                  <figure class="footer-payments">
                    <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="272" height="20">
                  </figure>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8-2col col-sm-4 col-md-4 p-0 pl-xl-3 pr-xl-3">
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
        <div class="col-xl-8-2col col-sm-4 col-md-4 p-0 pl-xl-3 pr-xl-3">
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
        <div class="col-xl-8-2col col-sm-4 col-md-4 p-0 pl-xl-3 pr-xl-3">
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
