<style>
  .demo-32-header-container
  {
     padding-right: 10px !important;
     padding-left: 10px !important;
  }
  .demo-32-header-row
  {
     margin-right: -10px !important;
     margin-left: -10px !important;
  }
.top-menu a {
    display: inline-flex;
    align-items: center;
    text-transform: uppercase;
}
  .sticky-header .header-sticky-inner .pro-header-right-options li {
    position: relative;
    display: inline-block;
    list-style: none;
    margin-left: 35px;
    margin-top: 10px;
}
  .header-twele .header-mini .dropdown .btn.dropdown-toggle::after {
    content: none !important;
}
  .demo-32-header-37-section .header-mini .dropdown {
    margin-right: 0px !important; 
}
.demo-32-header-37-section .header-mini .dropdown .btn.dropdown-toggle {
    font-size: 13px;
}
.demo-32-header-37-section  .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 14px;
}
.demo-32-header-37-section .header-top-color-37 {
    font-size: 13px;
}
.demo-32-header-37-section .search-input-17 {
    padding: 10px 50px 10px 10px;
    height: 41px;
    font-size: 15px;
}
.fill-color
{
  fill: #bbb;
}
.color-fill-phone
{
  fill: #777;
}
.fill-search
{
  fill: #aaa;
}
.fill-search:hover
{
  fill: #fff;
}
.cus-style-search-17 {
    font-size: 20px;
    cursor: pointer;
    width: 38px;
    height: 43px;
    padding: 10px 11px !important;
}
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
   text-transform: uppercase !important; 
}
.header-fixed .header-sticky-inner nav .navbar-collapse ul .nav-item .nav-link {
  text-transform: uppercase !important; 
}
.demo-7-col
{
  padding-right: 10px !important;
  padding-left: 10px !important;
}
.demo-7-row
{
  margin-right: -10px !important;
  margin-left: -10px !important;
}
.demo-32-header-37-section .input-main {
    width: 255px;
    float: right;
}
.demo-32-header-37-section .search-button-main-17 {
    position: absolute;
    top: -7px;
    right: 0px;
    padding: 2px !important;
}
.cus-style-search-36 {
    font-size: 20px;
    cursor: pointer;
    color: #000;
    width: 38px;
    height: 50px;
    padding: 10px;
}
.demo-32-header-37-section .cus-style-search-36{
  font-size: 17px;
}

.demo-32-header-37-section .header-maxi .pro-header-right-options li > a, .demo-32-header-37-section .header-maxi .pro-header-right-options li button {
  margin-top: 9px;
}
.demo-32-header-37-section .header-maxi .pro-header-right-options li > a .fas, .demo-32-header-37-section .header-maxi .pro-header-right-options li > a .far, .demo-32-header-37-section .header-maxi .pro-header-right-options li button .fas, .demo-32-header-37-section .header-maxi .pro-header-right-options li button .far {
    font-size: 17px;
}
  .demo-32-header-37-ml
  {
      margin-left: 40px;
  }
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}

.header-37-right-cart{
    margin-left:-15px;
  }
  .common-hover-37:hover{
    color: #fdda05 !important;
  }
  .header-top-color-37:hover{
    color: #fdda05 !important;
  }
  .common-fill-hovers:hover{
    fill: #fdda05 !important;
  }
  @media only screen and (max-width: 1250px) and (min-width: 800px){
    .header-37-right-cart{
      margin-left:-30px;
    }
  }

  .common-yellow-fill:hover{
    fill:#fdda05;
  }
</style>


<!-- //header style Twele -->
@include('web.headers.fixedHeader37') 
<header id="headerTwele" class="demo-32-header-37-section header-12-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar-twele header-top-bg-37">
    <div class="demo-32-header-container container-fluid">
      <div class="row align-items-center demo-32-header-row">
        <div class="col-12 demo-32-header-container">
          
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0 nav-twele">
            <div class="navbar-lang">
            
              @if(count($currencies) > 1)
                <div class="dropdown">
                  <button class="btn dropdown-toggle header-top-color-37 common-fill-hovers common-hover-37 fill-color common-fill-hover" type="button" >
                    {{session('currency_code')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
</svg> 
                  </button>
                  <div class="dropdown-menu">
                    @foreach($currencies as $currency)
                    <a onclick="myFunction2({{$currency->id}})" class="dropdown-item header-top-color-37" href="#">
                      <span>{{$currency->code}}</span>   
                    </a>
                    @endforeach
                  </div>
                </div>
                @include('web.common.scripts.changeCurrency')
              @endif

              @if(count($languages) > 1)

<div class="dropdown">
    <button class="btn dropdown-toggle header-top-color-37 common-hover-37 fill-color common-fill-hovers common-fill-hover" type="button" style="padding:8px 20px 8px 0px !important">
      {{	session('language_name')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
</svg> 
    </button>
    <div class="dropdown-menu" >
      @foreach($languages as $language)
      <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item header-top-color-37" href="#">                      
        {{$language->name}}
      </a>                   
      @endforeach                   
    </div>
</div> 
  
@include('web.common.scripts.changeLanguage')
@endif
            </div>                   
            
            <div class="navbar-collapse">
              <ul class="navbar-nav">
              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                <li class="nav-item mr-20">
                      <a class="header-top-color-37 color-fill-phone common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>

                  <li class="nav-item mr-20">
                      <a class="header-top-color-37" href="{{ URL::to('/wishlist')}}">
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WISHLIST <span class="common-color" style="letter-spacing:0;">(<span class="total_wishlist"> {{$result['commonContent']['total_wishlist']}}</span>)</span>
                      </a>
                    </li>
                    <!-- <li class="nav-item mr-20"><a class="header-top-color-37" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20"><a class="header-top-color-37" href="{{ URL::to('/contact')}}">CONTACT US</a></li> -->
                  <li class="nav-item mr-20"> <a class="header-top-color-37" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <li class="nav-item mr-20"> <a class="header-top-color-37" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                  <li class="nav-item mr-20"> <a class="header-top-color-37" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item mr-20"> <a class="header-top-color-37" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a class="header-top-color-37" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                    <li class="nav-item mr-20">
                      <a class="header-top-color-37 color-fill-phone common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
                    <li class="nav-item mr-20">

                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a class="header-top-color-37" href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="header-top-color-37 login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="header-top-color-37 login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="header-top-color-37 login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="header-top-color-37 login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="header-top-color-37 login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a class="header-top-color-37" href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>

                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WISHLIST <span class="common-color" style="letter-spacing:0;">(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</span>
                      </a>
                    </li>
                     <li class="nav-item mr-20"><a class="header-top-color-37" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20"><a class="header-top-color-37" href="{{ URL::to('/contact')}}">CONTACT US</a></li> 
                    <!-- <li class="nav-item"><div class="nav-link">@lang('website.Welcome')!</div></li> -->
                                       
                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                       <li class="nav-item login_modal"> <a class="header-top-color-37 color-fill-phone common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1"> <a class="header-top-color-37 color-fill-phone common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>      
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2"> <a class="header-top-color-37 color-fill-phone common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>    
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3"> <a class="header-top-color-37 color-fill-phone common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item login_modal4"> <a class="header-top-color-37 color-fill-phone common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>    
                    <?php } else { ?>
                      <li class="nav-item"> <a class="header-top-color-37 color-fill-phone common-fill-hover" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;@lang('website.Login')</a> </li>    
                    <?php } } }?>
              </ul> 
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>
  <div class="header-maxi  bg-header-bar header-maxi-twele">
    <div class="demo-32-header-container container-fluid">
      <div class="row align-items-center demo-32-header-row">
        <div class="col-12 col-md-1 col-lg-1 demo-32-header-container">
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
        
        <div class="col-12 col-sm-7 demo-32-header-container">
          <div class="header-navbar">
            <div class="demo-32-header-container container">
            <nav id="navbar_header_9" class="navbar navbar-expand-lg">
          
          <div class="navbar-collapse demo-32-header-37-ml" >
            <ul class="navbar-nav">
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
                  <li class="nav-item dropdown  menu-active-13-{{ $menuactive }} hover-menu-37" style="padding:22px 0px">
                    <a style="white-space:nowrap" class="nav-link font-500 fill-color common-fill-hover" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg><?php } ?></a>
                   
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
                          <a class="dropdown-item fill-color common-fill-hover" <?php echo $sublink; ?>>
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

                  <li class="nav-item dropdown  hover-menu-37" style="padding:22px 0px">
                    <a style="white-space:nowrap" class="nav-link  font-500 fill-color common-fill-hover" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg></a>
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
                          <a class="dropdown-item fill-color common-fill-hover"  <?php echo $link; ?>>
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

            <div class="col-12 col-sm-4">
              <div class="row">
                <div class="col-md-10">
                  <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="margin-left: 30px;">
                      <input type="hidden" class="category-value" name="categories_id" value="" /> 
                      <div class="input-main">
                          <input autocomplete="off" required  name="search" type="text" value="{{ app('request')->input('search') }}" class="search-input-17 typeheads" placeholder="Search Product ..... ">
                          <div class="search_outer_con">
                            <div id="viewsearchproduct"></div>
                          </div>
                      </div>
                      <button id="dropdownCartButton" class="btn search-button-main-17 color-fill-phone common-fill-hovers" type="submit"> 
                      <svg id="search" xmlns="http://www.w3.org/2000/svg" class="cus-style-search-36" onclick="myFunction()" width="12" height="12" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>

                        <!-- <i class="fa fa-search cus-style-search-36" onclick="myFunction()"></i> -->
                      </button>
                  </form>
                </div>

                @if($result['commonContent']['settings']['view_cart_button'] == 1)

                <div class="col-md-2">
                  <ul class="pro-header-right-options header-37-cart-drop header-37-right-cart  common-hover color-fill-phone common-fill-hover">
                    <li class="dropdown head-cart-content common-yellow-fill">
                      @include('web.headers.cartButtons.cartButton37')
                    </li>
                  </ul>
                </div>

                @endif
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

