<style>
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}

.bg-header-bar-35{
  background-color:#00739B;
}

.header-top .header-dropdown>a, .header-top .header-dropdown>span, .header-top .top-menu, .header-top .top-menu a {
    color: #fff;
    text-transform: uppercase;
}
.header-twele .header-mini .navbar .navbar-collapse .nav-item {
    display: flex;
    align-items: center;
    text-transform: uppercase;
}
.demo-24-quick-fill:hover
{
  fill: #fff !important;
}
.cart-left-wishlist {
    top: 0px;
}
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 1rem;
    color: #333;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    line-height: normal;
    padding: 1.2rem 20px 1.2rem 5px;
}
.demo-19-fill-down
  {
    fill: #fff;
  }
  .fill-white-color
  {
    fill: #fff;
  }
  .add-fill-hover:hover
  {
    fill: #fff !important;
  }
.header-twele .header-mini .dropdown .btn.dropdown-toggle::after {
    content: none;
}
.btn-36-wishlist {
    color: #ccc !important;
    font-size: 1rem;
    padding: 10px 0;
}
.header-twele .header-mini .dropdown .btn.dropdown-toggle{
  font-size:0.9rem;
  padding:10px 20px 10px 0px !important;
}
.footer .widget-title {
    color: #333;
    font-weight: 600;
    font-size: 1.15rem;
    letter-spacing: -.01em;
    margin-top: 0;
    margin-bottom: 1.7rem;
    text-transform: uppercase;
}
.header-fixed .header-sticky-inner nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 1rem !important;
    padding-top: 2rem;
    padding-bottom: 2rem;
    padding-right: 10px;
    padding-left: 10px;
    text-transform: uppercase;
}
#navbar_header_9{
  margin-left:40px;
}

.video-banner-bg {
    padding-top: 8.5rem !important;
    padding-bottom: 7.5rem !important;
}
.video-banner-title {
    letter-spacing: -.025em;
    margin-bottom: 1.6rem;
    width: 45%;
    margin: auto;
    text-transform: uppercase;
}

.closed-header-overlap {
position: unset;
top: 0;
right: 0;
left: 0;
z-index: 1;
display: none;
}

.header-12-search .search_outer_con {
top: 37px !important;
left: 0;
}
.header-12-search-fixed .search_outer_con_fixed{
  top: 38px !important;
  left: 0;
}

.search-inputs {
border: .1rem solid #fff;
border-radius: 20px;
padding: 0;
height: 0;
width: 10px;
outline: none;
}

.srach-18-butt{
    position: relative;
    display: inline-block;
    line-height: 1;
    min-width: 2.5rem;
    padding: 0rem 1rem;
    font-weight: 400;
    color: #333;
    text-align: center;
    z-index: 11;
  }
  .srach-18-main-input{
    position: absolute;
    right: 22rem;
    top: 50%;
    margin-top:-23px;
    display: block;
    align-items: stretch;
    overflow: visible;
    width: 100%;
  }

  @media only screen and (min-width: 1250px) and (max-width: 1366px){
    .srach-18-main-input{
    position: absolute;
    right: 18rem;
    top: 50%;
    margin-top:-23px;
    display: block;
    align-items: stretch;
    overflow: visible;
    width: 100%;
  }


  }
  @media only screen and (min-width: 700px) and (max-width: 800px){

  .srach-18-butt {
    position: relative;
    display: inline-block;
    line-height: 1;
    min-width: 2.5rem;
    padding: 0rem 1rem;
    font-weight: 400;
    color: #333;
    text-align: center;
    z-index: 11;
    right: 20px;
  }
  .srach-18-main-input {
      position: absolute;
      right: 19.5rem;
      top: 50%;
      margin-top: -23px;
      display: block;
      align-items: stretch;
      overflow: visible;
      width: 100%;
  }
}

@media only screen and (max-width: 992px)
{
.video-banner-title {
    width: 50%;
}
}

@media only screen and (max-width: 600px)
{
.video-banner-title {
    width: 90%;
}
}


</style>

@if($result['commonContent']['settings']['topoffer'] == 1)

<style>
  .header-overlap {
    position: absolute;
    top: 40px !important;
    right: 0;
    left: 0;
    z-index: 1;
  }
  @media only screen and (min-width: 320px) and (max-width: 600px){
    .header-overlap-30 {
      position: absolute;
      top: 40px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
   .close-mobile-overlap-30{
      position: unset;
      top: 0px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
  }

  @media only screen and (min-width: 700px) and (max-width: 800px){
    .header-overlap-30 {
      position: absolute;
      top: 60px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
   .close-mobile-overlap-30{
      position: unset;
      top:20px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
  }

</style>
@else
<style>
  .header-overlap {
    position: absolute;
    top: 0px !important;
    right: 0;
    left: 0;
    z-index: 1;
  }
  @media only screen and (min-width: 320px) and (max-width: 600px){
    .header-overlap-30 {
      position: absolute;
      top: 0px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
   .close-mobile-overlap-30{
      position: absolute;
      top: 0px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
  }
  @media only screen and (min-width: 700px) and (max-width: 800px){
    .header-overlap-30 {
      position: absolute;
      top: 20px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
   .close-mobile-overlap-30{
      position: absolute;
      top: 0px !important;
      right: 0;
      left: 0;
      z-index: 1;
   }
  }
</style>
@endif
<!-- //header style Twele -->
@include('web.headers.fixedHeader30') 

<?php 
  $sss = DB::table('menus')
  ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
  ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id','menus.id')
  ->where('menu_translation.language_id', '=', Session::get('language_id'))
  ->where('menus.status', 1)
  ->where('menus.parent_id', 0)
  ->orderBy('menus.sort_order', 'ASC')
  ->first();
?>
                
  <header id="add30-hover"  class="header-28-search img-header header-area bg-header-bar-35 header-twele  header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini">
    <div class="container-30">
      <div class="row align-items-center">
        <div class="col-12">
          
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0" style="border-bottom:.1rem solid hsla(0,0%,92.2%,.2) !important">
            <div class="navbar-lang">
     
              @if(count($currencies) > 1)
                <div class="dropdown">
                  <button class="btn dropdown-toggle menu-color-38 menu-16-color-black common-fill-hover demo-19-fill-down" type="button">
                    {{session('currency_code')}} &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg>
                  </button>
                  <div class="dropdown-menu">
                    @foreach($currencies as $currency)
                    <a onclick="myFunction2({{$currency->id}})" class="dropdown-item" href="#">
                      <span>{{$currency->code}}</span>   
                    </a>
                    @endforeach
                  </div>
                </div>
                @include('web.common.scripts.changeCurrency')
              @endif

              @if(count($languages) > 1)

                <div class="dropdown">
                    <button class="btn dropdown-toggle menu-color-38 menu-16-color-black common-fill-hover demo-19-fill-down" type="button">
                      {{	session('language_name')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                    </button>
                    <div class="dropdown-menu" >
                      @foreach($languages as $language)
                      <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item" href="#">                      
                        {{$language->name}}
                      </a>                   
                      @endforeach                   
                    </div>
                </div> 
                  
                @include('web.common.scripts.changeLanguage')
                @endif

            </div>                   
            
            <div class="navbar-collapse">
              <ul class="navbar-nav" style="padding:10px 0px">
              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                <li class="nav-item mr-20">
                      <a class="menu-color-38 menu-16-color-black common-fill-hover demo-19-fill-down" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL: {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
                    <li class="nav-item mr-20"> <a class="menu-color-38 menu-16-color-black" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>

                     <li class="nav-item mr-20"><a class="menu-color-38 menu-16-color-black" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20"><a class="menu-color-38 menu-16-color-black" href="{{ URL::to('/contact')}}">CONTACT US</a></li> 
                  <li class="nav-item mr-20"> <a class="menu-color-38 menu-16-color-black" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                    <li class="nav-item mr-20"> <a class="menu-color-38 menu-16-color-black" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item mr-20"> <a class="menu-color-38 menu-16-color-black" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a class="menu-color-38 menu-16-color-black" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                    <li class="nav-item mr-20">
                      <a class="menu-color-38 menu-16-color-black common-fill-hover demo-19-fill-down" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL: {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
                     <li class="nav-item mr-20"><a class="menu-color-38 menu-16-color-black" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20"><a class="menu-color-38 menu-16-color-black" href="{{ URL::to('/contact')}}">CONTACT US</a></li> 
                    <!-- <li class="nav-item"><div class="nav-link">@lang('website.Welcome')!</div></li> -->
                    

                  <?php 
                  if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                      <li class="nav-item login_modal"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>     
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>    
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item login_modal4"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else { ?>
                      <li class="nav-item"> <a class="menu-color-38 menu-16-color-black common-fill-hover" style="fill: #fff;" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>    
                    <?php } } }?>
              </ul> 
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>
  <div class="header-maxi bg-header-bar-15 header-maxi-twele" style="padding:0px !important">
    <div class="container-30">
      <div class="row align-items-center">
        <div class="col-12 col-md-2 col-lg-2">
          <a class="img-fluid-molla-main" href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
            @if($result['commonContent']['settings']['sitename_logo']=='name')
            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
            @endif
        
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
              <?php 
              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

              ?>
              @if($imagepath->path_type == 'aws')
                <img class="img-fluid-molla" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @else
                <img class="img-fluid-molla" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
            @endif
            </a>
        </div>
        
        <div class="col-12 col-sm-7">
          <div class="header-navbar">
            <div class="container">
              <nav id="navbar_header_9" class="navbar navbar-expand-lg">
          
                <div class="navbar-collapse" >
                  <ul class="navbar-nav margin-auto">
                  <?php 
              $items = DB::table('menus')
              ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
              ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id','menus.id')
              ->where('menu_translation.language_id', '=', Session::get('language_id'))
              ->where('menus.status', 1)
              ->where('menus.parent_id', 0)
              ->orderBy('menus.sort_order', 'ASC')
              ->get();
                
                if($items->isNotEmpty()) {
                  foreach ($items->slice(0, 4) as $item) {

                    if ($item->type == 0) {
                       $link = ' target="_blank" href="' . $item->link . '"';
                      $menuactive = '';
                    } elseif ($item->type == 1) {
                        if($item->link == '/'){
                            $link = ' href="' . url(''). $item->link . '"';
                            $menuactive = 'home';
                        }else{
                            $link = ' href="' . url(''). '/' .$item->link . '"';
                            $menuactive = $item->link;
                        }
                    } elseif ($item->type == 2) {
                        $link = ' href="' . url('page?name=') . $item->link . '"';
                        $menuactive = $item->link;
                    } elseif ($item->type == 3) {
                        $link = ' href="' . url('shop?category=') . $item->link . '"';
                        $menuactive = $item->link;
                    } elseif ($item->type == 4) {
                        $link = ' href="' . url('product-detail')  .'/'.  $item->link . '"';
                        $menuactive = $item->link;
                    } elseif ($item->type == 5) {
                        $link = ' href="' . url('') . '/' . $item->link . '"';
                        $menuactive = $item->link;
                    }else{
                        $link = '#';
                        $menuactive = '';
                    }

                    $childs = DB::table('menus')
                    ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
                    ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
                    ->where('menu_translation.language_id', '=', Session::get('language_id'))
                    ->where('menus.status', 1)
                    ->where('menus.parent_id', $item->id)
                    ->orderBy('menus.sort_order', 'ASC')
                    ->get();
                
                ?> 
                  <li class="nav-item dropdown menu-active-30-{{ $menuactive }}" style="padding:15px 0px !important">
                    <a style="white-space:nowrap" class="nav-link font-500 menu-color-38 common-fill-hover demo-19-fill-down menu-color-38-white header-12-balck" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg>  <?php } ?></a>
                   
                    <?php if ($childs->isNotEmpty()) { ?>
                      <div class="dropdown-menu">
                        <?php                       
                          foreach ($childs as $child) {

                            if ($child->type == 0) {
                                $sublink = ' target="_blank" href="' . $child->link . '"';
                            } elseif ($child->type == 1) {
                                $sublink = ' href="' . url($child->link) . '"';
                            } elseif ($child->type == 2) {
                                $sublink = ' href="' . url('page?name=') . $child->link . '"';
                            } elseif ($child->type == 3) {
                                $sublink = ' href="' . url('shop?category=') . $child->link . '"';
                            } elseif ($child->type == 4) {
                                $sublink = ' href="' . url('product-detail')  .'/'.  $child->link . '"';
                            } elseif ($child->type == 5) {
                                $sublink = ' href="' . url('') . $child->link . '"';
                            }

                            $childs1 = DB::table('menus')
                            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
                            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
                            ->where('menu_translation.language_id', '=', Session::get('language_id'))
                            ->where('menus.status', 1)
                            ->where('menus.parent_id', $child->id)
                            ->orderBy('menus.sort_order', 'ASC')
                            ->get();
                        ?> 
                        <div class="dropdown-submenu submenu1">
                          <a class="dropdown-item common-fill-hover demo-19-fill-down" <?php echo $sublink; ?>>
                            {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg><?php } ?></a>
                              <?php 
                                if ($childs1->isNotEmpty()) { 
                              ?>
                              <div class="dropdown-menu">
                              <?php
                                          foreach ($childs1 as $child1) {

                                            if ($child1->type == 0) {
                                                $sublink1 = ' target="_blank" href="' . $child1->link . '"';
                                            } elseif ($child1->type == 1) {
                                                $sublink1 = ' href="' . url($child1->link) . '"';
                                            } elseif ($child1->type == 2) {
                                                $sublink1 = ' href="' . url('page?name=') . $child1->link . '"';
                                            } elseif ($child1->type == 3) {
                                                $sublink1 = ' href="' . url('shop?category=') . $child1->link . '"';
                                            } elseif ($child1->type == 4) {
                                                $sublink1 = ' href="' . url('product-detail') .'/'. $child1->link . '"';
                                            } elseif ($child1->type == 5) {
                                                $sublink1 = ' href="' . url('') . $child1->link . '"';
                                            }
                                      ?>
                                        <div class="dropdown-submenu submenu1">
                                          <a class="dropdown-item" dropdown-toggle="" <?php echo $sublink1; ?>>{{ $child1->name }}<span style="float:right"></span></a>
                                        </div>
                                      <?php } ?>
                              </div>
                            <?php } ?>
                          </div>
                        <?php } ?>
                      </div>
                      <?php } ?>
                  </li>  

             
                  
                <?php }} if(count($items) > 4){?>

                  <li class="nav-item dropdown " style="padding:15px 0px !important">
                    <a style="white-space:nowrap" class="nav-link font-500 menu-color-38 common-fill-hover demo-19-fill-down menu-color-38-white header-12-balck" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> </a>
                      <div class="dropdown-menu">
                      <?php
                          if($items->isNotEmpty()) {
                            foreach ($items as $key=>$item) {
                              if($key > 3){ 
    
                              if ($item->type == 0) {
                                 $link = ' target="_blank" href="' . $item->link . '"';
                      $menuactive = '';
                              } elseif ($item->type == 1) {
                                  if($item->link == '/'){
                                      $link = ' href="' . url(''). $item->link . '"';
                                      $menuactive = 'home';
                                  }else{
                                      $link = ' href="' . url(''). '/' .$item->link . '"';
                                      $menuactive = $item->link;
                                  }
                              } elseif ($item->type == 2) {
                                  $link = ' href="' . url('page?name=') . $item->link . '"';
                                  $menuactive = $item->link;
                              } elseif ($item->type == 3) {
                                  $link = ' href="' . url('shop?category=') . $item->link . '"';
                                  $menuactive = $item->link;
                              } elseif ($item->type == 4) {
                                  $link = ' href="' . url('product-detail')  .'/'.  $item->link . '"';
                                  $menuactive = $item->link;
                              } elseif ($item->type == 5) {
                                  $link = ' href="' . url('') . '/' . $item->link . '"';
                                  $menuactive = $item->link;
                              }else{
                                  $link = '#';
                                  $menuactive = '';
                              }

                              $childs1 = DB::table('menus')
                              ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
                              ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
                              ->where('menu_translation.language_id', '=', Session::get('language_id'))
                              ->where('menus.status', 1)
                              ->where('menus.parent_id', $item->id)
                              ->orderBy('menus.sort_order', 'ASC')
                              ->get();
    
                        ?>
                        <div class="dropdown-submenu submenu1">
                          <a class="dropdown-item common-fill-hover demo-19-fill-down" <?php echo $link; ?>>
                            {{ $item->name }} <?php if ($childs1->isNotEmpty()) { ?> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg><?php } ?></a>
                              <?php 
                               if ($childs1->isNotEmpty()) { 
                              ?>
                              <div class="dropdown-menu more">
                              <?php
                                          foreach ($childs1 as $child1) {

                                            if ($child1->type == 0) {
                                                $sublink1 = ' target="_blank" href="' . $child1->link . '"';
                                            } elseif ($child1->type == 1) {
                                                $sublink1 = ' href="' . url($child1->link) . '"';
                                            } elseif ($child1->type == 2) {
                                                $sublink1 = ' href="' . url('page?name=') . $child1->link . '"';
                                            } elseif ($child1->type == 3) {
                                                $sublink1 = ' href="' . url('shop?category=') . $child1->link . '"';
                                            } elseif ($child1->type == 4) {
                                                $sublink1 = ' href="' . url('product-detail') .'/'. $child1->link . '"';
                                            } elseif ($child1->type == 5) {
                                                $sublink1 = ' href="' . url('') . $child1->link . '"';
                                            }
                                      ?>
                                        <div class="dropdown-submenu submenu1">
                                          <a class="dropdown-item" dropdown-toggle="" <?php echo $sublink1; ?>>{{ $child1->name }}<span style="float:right"></span></a>
                                        </div>
                                      <?php } ?>
                              </div>
                            <?php } ?>
                          </div>
                          <?php } } }?>
                      </div>
              <?php  }?> 
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>

       


            

                  <div class="col-12 col-sm-3" style="text-align:right">

                    <button id="dropdownCartButton" class="btn srach-18-butt common-fill-hover demo-19-fill-down" type="button"> 
                      
                      <svg id="search" class="cus-style-search icon-39-color menu-16-color-black fa-search" onclick="myFunction()" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)"/>
  </g>
</svg>
                    </button>
             
                    <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="display:inline-block;position:relative">
                        <div class="input-main srach-18-main-input" id="searchbuttons">
                            <div  class="search-inputs" style="border:none"></div>
                        </div>
                        <input type="hidden" class="category-value" name="categories_id" value="" /> 
                        <div class="input-main srach-18-main-input" id="searchbutton" style="display:none;">
                            <input autocomplete="off" required style="position:unset" name="search" value="{{ app('request')->input('search') }}"  type="text" class="search-input-18 typeheads" placeholder="Search Product ..... ">
                            <div class="search_outer_con search_outer_con_18" style="text-align:left;left:0px !important">
                                <div id="viewsearchproduct"></div>
                            </div>
                        </div>
                       
                    </form>
                 
                    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>
                      <div class="pro-header-right-options display-inline cart-left-wishlist common-fill-hover demo-19-fill-down icon-39-color" style="margin-right: 30px;margin-left:10px">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48.232 41.342">
                      <g id="wishlist" transform="translate(0 -36.545)">
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                        <span class="total_wishlist badge badge-secondary badge-wishlist-33" style="right: -8px;top: -5px;">{{ $result['commonContent']['total_wishlist'] }}</span>
                      </div>
                    </a>

                    @if($result['commonContent']['settings']['view_cart_button'] == 1)

                    <ul class="pro-header-right-options display-inline  common-fill-hover demo-19-fill-down icon-39-color" style="float:right;margin-top:3px;margin-left:20px !important;position: relative;left: -20px;top: -5px;">
                        <li class="dropdown head-cart-content">
                        @include('web.headers.cartButtons.cartButton30')
                        </li>
                    </ul>
                    @endif
                </div>
                    
        </div>
      </div>
    </div>
  </div> 
      <div class="header-navbar bg-menu-bar">
          <div class="container">
            <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">
        
              <div class="navbar-collapse" >
                <ul class="navbar-nav">
                  <!-- {!! $result['commonContent']["menusRecursive"] !!} -->
                  <!-- <li class="nav-item ">
                    <a class="nav-link">
                        <span>@lang('website.Call Us Now')</span>
                        <phone dir="ltr">{{$result['commonContent']['setting'][11]->value}}</phone>
                    </a>
                  </li>      -->
                </ul>
              </div>
            </nav>
          </div>
      </div>
</header>




<script>


  function myFunction() {
  var x = document.getElementById("searchbutton");
  var y = document.getElementById("searchbuttons");

  var a = document.getElementById("searchbuttonfixed");
  var b = document.getElementById("searchbuttonsfixed");



  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    a.style.display = "block";
    b.style.display = "none";
    $('.fa-search').addClass('active-30-button');
  } else {
    x.style.display = "none";
    y.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
    $('.fa-search').removeClass('active-30-button');
  }
}


</script>