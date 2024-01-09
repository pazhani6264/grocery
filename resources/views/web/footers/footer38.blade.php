<style>
.footer-dark {
background-color: #333;
}
.f12-tikcolor{
  fill:#777;
}
.common-hover-white:hover{
  fill:#fff;
}
  .widget-list li:not(:last-child) {
    margin-bottom: 0.5rem;
    font-size: 1rem;
}
.footer-bottom a{
  color:#777;
}
.footer-dark .social-icon {
    justify-content: center;
    font-size: 1rem;
    width: 3rem;
    height: 3rem;
}
.footer-2 .footer-middle {
    padding-top: 4.5rem;
    padding-bottom: 0.4rem;
    position:relative;
}
.footer-2  span {
    color: #777;
    text-decoration: none;
}

.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }

  .content_loading .dot:nth-child(2) {
      animation-delay: 0.3s;
    }

    .content_loading .dot:nth-child(3) {
      animation-delay: 0.6s;
    }
  
    .info-bg-6 .panel{
  text-align:left;
}
.info-bg-6 .title{
  font-size:0.9rem;
  font-weight:600;
  text-transform:uppercase;
  margin-bottom:0;
  letter-spacing: .1em;
}
.info-bg-6 .info-color-p-1{
  font-size:0.9rem;
}
.info-bg-6 .info-icon{
  font-size:1.5rem;
}
.info-bg-6 {
    background-color: #333;
}
.info-icon {
    color: #fff !important;
    -webkit-text-fill-color: #fff;
    opacity: 1;
}
.footer-middle .container:before {
    content: "";
    position: absolute;
    top: 0;
    left: 9rem;
    right: 9rem;
    height: 0.1rem;
    background-color: #444;
}

@media screen and (max-width: 992px){
  .info-bg-6-carousal {
      background: #222;
      margin: 0px 10px;
  }
}

@media only screen and (max-width: 768px)
{
  .footer-2 .footer-middle {
      padding-top: 5rem;
      padding-bottom: 0.4rem;
  }
}

</style>
@include('web.footers.partials.modals') 
 @php
  $customer = auth()->guard('customer')->user();
@endphp
<footer class="footer footer-molla footer-black footer-2 f12 footer-dark d-none d-lg-block d-xl-block footer-mb-100">

<section class="boxes-contents info-bg-6 text-center">
         <div class="container" style="padding-left:10px;">
         <div class="infobox-carousel-js" style="padding:4rem 0 2rem 0;">
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
          
          foreach($shoppinginfo as $info) { ?>
             <div class="info-box first slick">
            <div class="panel">
            <?php if($info->type==1) { ?>
                
              <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
                <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
                </div>
            <?php }
            if($info->type==2)
            { ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
                <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
                </div>
            <?php }
            if($info->type==3)
            { ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
                <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
                </div>
            <?php }
            if($info->type==4)
            { ?>
                
                <img style="display:inline-block;vertical-align:-webkit-baseline-middle" class="infoimg" src="{{ $info->path }}"/>
                <div class="block" style="display:inline-block;width:78%;vertical-align:-webkit-baseline-middle">
                <h4 class="title text-white" style="text-align:left">{{ $info->shopping_info_name }}</h4>
                <p class="info-color-p-1" style="text-align:left">{{ $info->shopping_info_description }}</p>
                </div>
            <?php } ?>
            </div>
            </div>
         <?php } ?>
         </div>
         </div>
         </section>

  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
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
  <div class="footer-bottom">
    <div class="container" style="padding-top: 1.5rem;padding-bottom: 1.5rem;">
      <p class="footer-copyright">Copyright © @lang('website.Copy Rights') <a  href="https://platinum24.net/" target="_blank">Platinum24, Inc</a> . All Rights Reserved.</p>
      <figure class="footer-payments footerpayemnt-dark">
        <img src="{{asset('web/images/miscellaneous/payments.png')}}" alt="Payment methods" width="272" height="20">
      </figure>
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
