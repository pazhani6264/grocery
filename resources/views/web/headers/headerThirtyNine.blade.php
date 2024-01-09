<!-- https://bootsnipp.com/snippets/35p8X -->

<!-- //refence responsive menu style -->
<link rel="stylesheet" type="text/css" href="{{asset('web/css/demo.34.css')}}">
<style>
  .header-twele .header-maxi .search-field-module{
    z-index: 999;
  }
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}
.search-field-module .dropdown-toggle {
padding: 0.8rem 0 !important;
}
.btn-secondary:before {
background-color: transparent !important;
}
.header-twele .header-navbar nav .navbar-collapse ul li .dropdown-menu .dropdown-item {
padding: 5px 33px;
color: #999;
font-size: 0.83rem;
}
</style>



<style>
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    text-transform: uppercase !important;
}
.header-fixed .header-sticky-inner nav .navbar-collapse ul .nav-item .nav-link {
  text-transform: uppercase !important;
}
.header-twele .header-mini .dropdown .btn.dropdown-toggle {
    text-transform: initial;
}
.header-twele .header-maxi .search-field-module .dropdown-menu {
    transform: translate3d(-1px, 42px, 0px) !important;
}
.header-twele .header-maxi .search-field-module .dropdown-menu a {
    transition: unset !important;
}
/* .header-twele .dropdown-menu .dropdown-item:hover {
    padding-left: 14px !important;
    color: #fff !important;
}
.header-twele .dropdown-menu .dropdown-item:hover {
    padding-left: 14px !important;
    color: #fff !important;
} */
  .demo-34-fill-color
  {
    fill: #999;
    color: #999;
  }
  .color-fill
  {
    fill: #7490da;
  }
  .header-twele .header-mini .dropdown .btn.dropdown-toggle::after {
    content: none;
}
  .color-fill-white
  {
    fill: #fff;
  }

  .color-fill-black
  {
    fill: #777;
  }
  
.wrapper {
  width:100%;
  box-shadow: 0 2px 5px rgba(0,0,0,.1);
  background:#fff;
}
.menu-container {
    width:100%;
    margin: 0 auto;
    padding: 20px 0;
}
.menu-molla {
    width: 100%;
    font-size: 13px;
    line-height: 15px;
    position: relative;
    padding: 0 0 0 4px;
    margin: 0;
    background-color: #fff;
    height:440px;
    
    /* overflow: hidden; */
  }
.menu-molla a, .menu-molla a:link, .menu-molla a:visited, .menu-molla a:focus, span {
    /* color: #000; */
    text-decoration: none;
}
.menu-molla a:hover {
    color: #333;
    text-decoration: none;
}
.menu-molla > li {
    display: block;
    text-align: left;
    margin-left: -4px;
    /* border-left: 1px solid rgba(255, 255, 255, 0.11); */
    /* box-shadow: -1px 0 0 rgba(0, 0, 0, 0.1); */
}
.menu-molla > li > a {
  height: 40px;
    padding:10px 20px;
    display: block;
    border-bottom:.1rem solid #eee;
}
.menu-molla > li:hover > a {
    color: #333;
}
.menu-molla > li:hover {
    background-color: #fff;
}
/* Megadrop width dropdown */
 .menu-molla > li > .megadrop {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    list-style: none;
    top: 0px;
    left: 100%;
    width: 900px;
    min-height: 100%;
    text-align: left;
    margin-top:30px;
    padding: 0;
    z-index: 99;
    overflow: hidden;
    background-color:#fff;
    height:440px;
    overflow-y: auto;
    box-shadow: 0 2px 5px rgba(0,0,0,.1);

}

@media only screen and (min-width: 800px) and (max-width: 1024px) {
  .menu-molla > li > .megadrop {
    width: 750px !important;
  }
}

.menu-molla > li:hover .megadrop {
    opacity: 1;
    visibility: visible;
    margin-top: 0px;
    overflow-y: auto;
}
.menu-molla ul li:hover:after {
    color: #333;
}
.menu-molla .col {
    width: 100%;
    float: left;
    color:white;
    margin: 0 0 0 2.2%;
}
.menu-molla .col ul {
    padding: 0;
    margin: 0;
}
.menu-molla .col ul li {
    padding: 0;
    list-style: none;
    font-size: 13px;
}
.menu-molla .col h3 {
    font-size: 14px;
    padding: 10px 0;
    font-weight: bold;
    margin: 5px 0 5px 0;
    color: #000;
    border-bottom:.1rem solid #eee;
}
.menu-molla .col ul li a {
    display: block;
    padding: 5px;
    color: #a9a9a9;
}
/* .menu-molla .col ul li a:hover {
    color: #000;
    text-decoration: none;
} */


   </style>

<!-- //header style Twele -->
@include('web.headers.fixedHeader39') 
<header id="headerTwele" class="header-11-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
<div class="header-mini bg-top-bar-39">
    <div class="container-fluid demo-34-s-container">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0 nav-border-39">

          <ul class="navbar-nav">
              <li class="nav-item mr-20">
                <a class="demo-34-s-label-color common-hover color-fill common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;Call: {{$result['commonContent']['setting'][11]->value}}</li>
                </a>
              </li>
            </ul>
                           
            <div class="navbar-collapse">
              
              <div class="navbar-lang">
                
                @if(count($currencies) > 1)
                  <div class="dropdown" style="margin-right:0px;margin-left:20px;">
                    <button class="btn common-hover color-fill common-fill-hover dropdown-toggle demo-34-s-label-color" type="button" >
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
                  <div class="dropdown" style="margin-right:0px;margin-left:20px;">
                      <button class="btn common-hover color-fill common-fill-hover dropdown-toggle demo-34-s-label-color" type="button" >
                        {{	session('language_name')}} &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                      </button>
                      <div class="dropdown-menu" >
                        @foreach($languages as $language)
                        <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item demo-34-s-label-color" href="#">                      
                          {{$language->name}}
                        </a>                   
                        @endforeach                   
                      </div>
                  </div> 
                
                  @include('web.common.scripts.changeLanguage')
                @endif
              </div>  
              <ul class="navbar-nav">
                
              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                  <!-- <li class="nav-item mr-20">
                      <a class="demo-34-s-label-color" href="{{ URL::to('/wishlist')}}">
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WHISTLIST <span class="total_wishlist">( {{$result['commonContent']['total_wishlist']}} )</span>
                      </a>
                    </li> -->
                  <li class="nav-item" style="margin-right:0px;margin-left:20px;"> <a class="demo-34-s-label-color common-hover" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <!-- <li class="nav-item"> <a class="demo-34-s-label-color" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li> -->
                  <li class="nav-item" style="margin-right:0px;margin-left:20px;"> <a class="demo-34-s-label-color common-hover" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item" style="margin-right:0px;margin-left:20px;"> <a class="demo-34-s-label-color common-hover" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item" style="margin-right:0px;margin-left:20px;"> <a class="demo-34-s-label-color common-hover" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                                          
                  
                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                      <li class="nav-item login_modal" style="margin-left:20px;cursor:pointer"><a class="demo-34-s-label-color common-hover" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1" style="margin-left:20px;cursor:pointer"><a class="demo-34-s-label-color common-hover" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2" style="margin-left:20px;cursor:pointer"><a class="demo-34-s-label-color common-hover" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3" style="margin-left:20px;cursor:pointer"><a class="demo-34-s-label-color common-hover" >Sign In / Sign Up</a></li>
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item login_modal4" style="margin-left:20px;cursor:pointer"><a class="demo-34-s-label-color common-hover" >Sign In / Sign Up</a></li>     
                    <?php } else { ?>
                      <li class="nav-item" style="margin-left:20px;"> <a class="demo-34-s-label-color common-hover" href="{{ URL::to('/login')}}">Sign In / Sign Up</a> </li>   
                    <?php } } }?>
              </ul> 


            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>


  <div class="header-maxi  bg-header-bar bg-header-bar-39 header-maxi-twele">
    <div class="container-fluid demo-34-s-container">
      <div class="row align-items-center">

        <div class="col-12 col-md-3 col-lg-2">
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

  
          <div class="col-12 col-sm-7 col-md-6 col-lg-7">      
            <form class="form-inline" action="{{ URL::to('/shop')}}" method="get" style="width: 110%;padding-left: 60px;">   
              <div class="search-field-module srach-border-39">   
                  <input type="hidden" name="category" class="category-value" value="">
                  @include('web.common.HeaderCategories')
                <button class="btn btn-secondary swipe-to-top dropdown-toggle header-selection cate-button-22" type="button" id="headerOneCartButton"  
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                  data-toggle="tooltip" data-placement="bottom" title="@lang("website.Choose Any Category")"> 
                  @lang("website.Choose Any Category")
                </button> 
                <div style="transform: translate3d(-1px, 42px, 0px) !important;z-index:1" class="dropdown-menu dropdown-menu-right header-39-cateh" aria-labelledby="headerOneCartButton">   
                    @php    productCategories(); @endphp                                                                 
                </div>
                <div class="search-field-wrap menu-22-border" style="position:relative">
                    <input  type="text" name="search" class="typeheads" placeholder="@lang('website.Search entire store here')..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}" required="">
                    <button type="submit" class="btn btn-secondary  search-button-39 color-fill-black common-fill-hover common-hover" data-toggle="" 
                    data-placement="bottom" title="@lang('website.Search Products')">
                    <svg id="search" xmlns="http://www.w3.org/2000/svg" width="16" height="27" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)"/>
  </g>
</svg></button>
                    <div class="search_outer_con">
                      <div id="viewsearchproduct"></div>
                    </div>
                </div>
              </div>
            </form>
          </div>

        

        <div class="col-12 col-sm-3">
                <div class="col-md-12" style="text-align:right">

                <a href="{{ URL::to('/compare')}}" class="">
                    <div class="pro-header-right-options display-inline cart-left-wishlist cart-left-wishlist-11 text-center icon-39-color common-hover common-fill-hover demo-34-s-label-color color-fill-white" style="margin-right:20px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 43.999 46.058">
  <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
</svg><br>
                      <span>Compare</span>
                    </div>
                  </a>
               
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
                    <div class="pro-header-right-options display-inline cart-left-wishlist cart-left-wishlist-11 text-center icon-39-color common-hover common-fill-hover demo-34-s-label-color color-fill-white" style="margin-right:20px !important">
                  
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48.232 41.342">
  <g id="wishlist" transform="translate(0 -36.545)">
    <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
  </g>
</svg><br>
                      <span>Wishlist</span>
                      <span class="total_wishlist badge badge-secondary badge-wishlist-33">{{ $result['commonContent']['total_wishlist'] }}</span>
                    </div>
                  </a>
                
                  @if($result['commonContent']['settings']['view_cart_button'] == 1)

                  <ul class="pro-header-right-options display-inline header-39-cart-drop common-hover common-fill-hover demo-34-s-label-color color-fill-white" style="float:right;margin-top:5px;margin-left: 15px;position: relative;right: -5px;">
                    <li class="dropdown head-cart-content">
                      @include('web.headers.cartButtons.cartButton39')
                    </li>
                  </ul>

                @endif
                </div>

            
      </div>
    </div>
  </div> 

  </div> 

<div class="bg-header-39">
  <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-sm-3 p-0">
          <nav class="navbar navbar-expand-sm navbar-dark-11 menu-11-padding" style="max-width: 270px;margin-left:10px;">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse menu-11-border" id="navbarCollapse">
                  <div class="navbar-nav width-100">
                      <div class="nav-item dropdown menu-11 width-100 cate-bg-color menu-16-color-white" style="padding:9.5px">
                          <a  class="nav-link menu-hover-11 cursor-pointer menu-16-color-white menu-color-22-white" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> </span> <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="12" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800"  data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)" fill="#333"/>
    <rect id="Rectangle_5801" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" fill="#333"/>
    <rect id="Rectangle_5802"  data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" fill="#333"/>
  </g>
</svg> </a>
                          <a id="shopclcik" class="nav-link cursor-pointer menu-hover-11 cate-color-22"><span style="color:#fff" class="menu-11-title">Browse Categories</span>  <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="15" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"/>
</svg>  </a>
                          <div class="dropdown-menu dropdown-menu-39" style="top:100% !important">
                          <div class="wrapper">
                              <ul class="menu-molla">
                              <?php
                                $items = DB::table('categories')
                                ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                ->leftJoin('images','images.id', '=', 'categories.categories_icon')
                                ->leftJoin('image_categories','image_categories.image_id', '=', 'images.id')
                                ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id','image_categories.path')
                                ->where('categories_description.language_id','=', Session::get('language_id'))
                                ->where('categories.categories_status','=', 1)
                                ->where('categories.parent_id','=',0)
                                ->orderBy('categories.categories_id','ASC')
                                ->groupBy('categories.categories_id')
                                ->get();
                                if($items->isNotEmpty()){
                                  foreach($items->slice(0, 10) as $item){
                              ?>

                                <?php
                                  $subitems = DB::table('categories')
                                  ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                  ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id')
                                  ->where('categories_description.language_id','=', Session::get('language_id'))
                                  ->where('categories.parent_id','!=',0)
                                  ->where('categories.parent_id','=', $item->categories_id)
                                  ->where('categories.categories_status','=', 1)
                                  ->get();
                                  
                                ?>
                                <li><a class="common-hover" href="#"><img src="{{asset($item->path) }}" style="margin-right:10px"  width="20px" height="20px"/>{{ $item->categories_name}} <?php if($subitems->isNotEmpty()) { ?><i style="float:right" class="fa fa-angle-right"></i><?php } ?></a>
                                <?php  if($subitems->isNotEmpty()){ ?>
                                  <div class="megadrop">
                                    <div class="row">
                                      <?php foreach($subitems as $subitem) { ?>
                                      <div class="col-md-4">
                                        <div class="col">
                                          <h3>{{ $subitem->categories_name }}</h3>
                                          <?php
                                              $subitems1 = DB::table('categories')
                                              ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                              ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id')
                                              ->where('categories_description.language_id','=', Session::get('language_id'))
                                              // ->where('categories.categories_id','=', $item->categories_id)
                                              ->where('categories.parent_id','=', $subitem->categories_id)
                                              ->where('categories.categories_status','=', 1)
                                              ->get();
                                              if($subitems1->isNotEmpty()){
                                                foreach($subitems1 as $subitem1){
                                            ?>
                                              <ul>
                                                <li><a class="common-hover" href="shop?category='.$subitem1->slug.'">{{ $subitem1->categories_name }}</a></li>
                                              </ul>
                                            <?php } } ?>
                                        </div>
                                      </div>
                                    <?php } ?>
                                  </div>
                                  <?php } ?>
                                </li>
                                <?php } if(count($items) > 11) {?>
                                  <li><a class="common-hover" style="background-color:#fff" href="/shop">View AllCategories</a>
                                <?php } } ?>
                              </ul>  
                            </div> 
                          </div>
                      </div>
                  </div>
              </div>
          </nav>
        </div>


        <div class="col-12 col-sm-6 p-0">
          <div class="header-navbar">
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
                        <li class="nav-item dropdown menu-active-13-{{ $menuactive }} hover-menu-13 hover-menu-13-white">
                          <a style="padding: 1.3rem 20px 1.3rem 5px !important;" class="nav-link color-fill-white common-fill-hover menu-color-22 menu-color-22-white" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
                                <a class="dropdown-item common-hover color-fill-black common-fill-hover" <?php echo $sublink; ?>>
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
                                          <a class="dropdown-item common-hover" dropdown-toggle="" <?php echo $sublink1; ?>>{{ $child1->name }}<span style="float:right"></span></a>
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

                        <li class="nav-item dropdown  hover-menu-13 hover-menu-13-white">
                          <a style="white-space:nowrap padding: 1.3rem 20px 1.3rem 5px !important;" class="nav-link menu-color-22 menu-color-22-white color-fill-white common-fill-hover" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
                                <a class="dropdown-item common-hover color-fill-black common-fill-hover" <?php echo $link; ?>>
                                  {{ $item->name }}<?php if ($childs1->isNotEmpty()) { ?> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
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
                                          <a class="dropdown-item common-hover" dropdown-toggle="" <?php echo $sublink1; ?>>{{ $child1->name }}<span style="float:right"></span></a>
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

        <div class="col-12 col-sm-3">
              <!-- <div class="head-11  text-white"><i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;&nbsp;Clearance Up to <b class="common-color menu-color-22-white">30% Off</b>
            </div> -->

            <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
              <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)" fill="#fff"/>
</svg>  &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
              </a>
          <?php } else {?>
            <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)" fill="#fff"/>
</svg>  &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
              </div>
            </a>
          <?php } ?>
          
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
<!-- 
<script>
$(document).ready(function(){
  $("#shopclcik").click(function(){
    window.location.href="/shop";
  });
});
</script> -->