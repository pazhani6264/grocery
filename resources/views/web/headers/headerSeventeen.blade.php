<style>
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}
.header-twele .header-mini .navbar .navbar-collapse .nav-item {
    display: flex;
    align-items: center;
    text-transform: uppercase;
}
.header-twele .header-maxi .pro-header-right-options li .cart-left {
    float: left;
    position: relative;
    margin-top: 2px;
}
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 1rem;
    color: #333;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    line-height: normal;
    padding: 1.2rem 20px 1.2rem 5px;
}
.header-fixed .header-sticky-inner nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 1rem !important;
    padding-top: 2rem;
    padding-bottom: 2rem;
    padding-right: 10px;
    padding-left: 10px;
    text-transform: uppercase !important;
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
#back-to-top {
    bottom: 120px !important;
    z-index: 999999 !important;
    width: 42px;
    height: 42px;
}
.header-mini .dropdown .btn.dropdown-toggle.color-16-top::after {
    content: none !important;
}
.header-17-rightside{
  margin-left:-6px;
}

.header17 .color-16-top {
    color: #777;
    font-size: 0.9rem;
}

.search-button-main-17 {
    position: absolute;
    top: -7px;
    right: 0;
}
.search-input-17::placeholder{
  font-size:1rem !important;
  font-weight:300 !important;
}
.search-input-17-fixed::placeholder{
  font-size:1rem !important;
  font-weight:300 !important;
}
.search-button-main-17-fixed {
    position: absolute;
    top: -7px;
    right: 0px;
}

.header17 .header-mini .dropdown .btn.dropdown-toggle {
    font-size: 0.9rem;
    font-weight: 300;
    background-color: transparent;
    color: #212529;
    padding-left: 0;
    padding-right: 0;
    transition: 0.4s;
    border: none;
}
.header17  .header-mini .dropdown .btn.dropdown-toggle.color-16-top::after {
  margin-top:-1px;
}

.padding-17-fixed {
    padding-top: 2.4rem !important;
    padding-bottom: 2.4rem !important;
}

@media only screen and (max-width: 1100px) and (min-width: 800px){
  .header-17-rightside{
    margin-left:-18px;
  }
}
</style>


<!-- //header style Twele -->
@include('web.headers.fixedHeader17') 
<header id="headerTwele" class="header-12-search header-area header-twele header17 header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar-11">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12">
          
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0 nav-twele">
            <div class="navbar-lang">
             
              @if(count($currencies) > 1)
                <div class="dropdown" style="margin-right:5px !important">
                  <button class="btn dropdown-toggle color-16-top common-hover fill-color common-fill-hover" type="button" style="padding:10px 20px 10px 0px !important;">
                    {{session('currency_code')}} &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
                    <button class="btn dropdown-toggle color-16-top common-hover fill-color common-fill-hover" type="button"  style="padding:10px 20px 10px 0px !important;">
                      {{	session('language_name')}} &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
              <ul class="navbar-nav" style="padding:10px 5px !important">
              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                <li class="nav-item mr-20">
                      <a class="color-16-top color-fill-phone common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL: {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
                  <li class="nav-item mr-20">
                      <a class="color-16-top" href="{{ URL::to('/wishlist')}}">
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WISHLIST <span class="common-color">(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</span>
                      </a>
                    </li>
                    <!-- <li class="nav-item mr-20"><a class="color-16-top" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20"><a class="color-16-top" href="{{ URL::to('/contact')}}">CONTACT US</a></li> -->
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a class="color-16-top" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                    <li class="nav-item mr-20">
                      <a class="color-16-top color-fill-phone common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CALL: {{$result['commonContent']['setting'][11]->value}}</li>
                      </a>
                    </li>
                    <li class="nav-item mr-20">
                    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a class="color-16-top" href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="color-16-top login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="color-16-top login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="color-16-top login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="color-16-top login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="color-16-top login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a class="color-16-top" href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>
    
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WISHLIST <span class="common-color">(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</span>
                      </a>
                    </li>
                    <li class="nav-item mr-20 color-16-top"><a class="color-16-top" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a></li>
                    <li class="nav-item mr-20 color-16-top"><a class="color-16-top" href="{{ URL::to('/contact')}}">CONTACT US</a></li>
                    <!-- <li class="nav-item"><div class="nav-link">@lang('website.Welcome')!</div></li> -->
                   
                 <?php 
                 if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover login_modal"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li> 
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover login_modal1"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover login_modal2"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li>     
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover login_modal3"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li> 
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover login_modal4"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li>      
                    <?php } else { ?>
                      <li class="nav-item"> <a class="color-16-top color-fill-phone common-fill-hover" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg>&nbsp;@lang('website.Login')</a> </li>     
                    <?php } } }?>

              </ul> 
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>
  
  <div class="header-maxi  bg-header-bar header-maxi-twele">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-2 col-lg-1">
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
        
        <div class="col-12 col-lg-8">
          <div class="header-navbar">
            <div class="container">
            <nav id="navbar_header_9" class="navbar navbar-expand-lg">
          
            <div class="navbar-collapse" >
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
                              $link = ' href="' . url('product-detail')  .'/'. $item->link . '"';
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
                        <li class="nav-item dropdown menu-active-{{ $menuactive }} " style="padding:32px 0px">
                          <a style="white-space:nowrap" class="nav-link header-12-balck fill-color common-fill-hover" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> <?php } ?></a>
                         
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
                                <a class="dropdown-item fill-color common-fill-hover"  <?php echo $sublink; ?>>
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

                        <li class="nav-item dropdown" style="padding:32px 0px">
                          <a style="white-space:nowrap" class="nav-link header-12-balck fill-color common-fill-hover" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                                <a class="dropdown-item fill-color common-fill-hover"  <?php echo $link; ?>>
                                  {{ $item->name }} <?php if ($childs1->isNotEmpty()) { ?> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" /></svg><?php } ?></a>
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

        <div class="col-12 col-lg-3">
              <div class="row">
                <div class="col-md-9">
                  <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="position:relative;">
                      <input type="hidden" class="category-value" name="categories_id" value="" /> 
                      <div class="input-main" >
                          <input autocomplete="off" required name="search" type="text" value="{{ app('request')->input('search') }}" class="search-input-17 typeheads" placeholder="Search Product ..... ">
                          <div class="search_outer_con">
                            <div id="viewsearchproduct"></div>
                          </div>
                      </div>
                      <button id="dropdownCartButton" class="btn search-button-main-17 fill-search" type="submit" style="padding:0px;"> 
                        
                      <svg id="search" xmlns="http://www.w3.org/2000/svg" class="cus-style-search-17" onclick="myFunction()" width="12" height="12" viewBox="0 0 27 27" class="search-icon-16 icon-font-16">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                        
                      </button>
                  </form>
                </div>

                @if($result['commonContent']['settings']['view_cart_button'] == 1)

                <div class="col-md-3 header-17-rightside">
                  <ul class="pro-header-right-options header-17-cart-drop common-hover color-fill-phone common-fill-hover">
                    <li class="dropdown head-cart-content">
                      @include('web.headers.cartButtons.cartButton17')
                    </li>
                  </ul>
                </div>

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

