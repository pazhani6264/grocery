<style>

  .c777{
    fill:#999;
  }

  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}
.pagination {
    
    margin-bottom: 40px;
}
.badge-wishlist-33 {
    position: absolute;
    right: auto;
    left: 15px;
    top: -5px;
    height: 16px;
    /* border-radius: 50px; */
    min-width: 16px;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
}
.header-twele .header-mini .dropdown .btn.dropdown-toggle::after {
    content: none;
}
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    text-transform: uppercase !important;
}
.header-fixed .header-sticky-inner nav .navbar-collapse ul .nav-item .nav-link {
  text-transform: uppercase !important;
}
.header-twele .header-mini .dropdown .btn.dropdown-toggle {
  text-transform: initial !important;
}
.ajax_product_40 article:hover {
    background-color: #fafafa !important;
}
.fill-white-hover:hover
{
  fill: #fff !important;
}
.color-fill-phone
{
  fill: #777;
}
.fill-search
{
  fill: #666;
}
.fill-down-color
{
  fill: #bbb;
}
@media only screen and (max-width: 1024px) and (min-width: 800px){

.search-icon-16{
  color:#000 !important;
}
}

</style>


<!-- //header style Twele -->
@include('web.headers.fixedHeader34') 
<header id="headerTwele" class="header-11-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
<div class="header-mini bg-top-bar-34">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0">
              <li class="nav-item mr-20" style="margin-left:-15px">
                  <a class="color-34-top menu-16-color-black color-fill-phone common-fill-hover" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;Call : {{$result['commonContent']['setting'][11]->value}}</li>
                  </a>
              </li>

            <div class="navbar-collapse">
              <ul class="navbar-nav">

              @if($result['commonContent']['setting'][50]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][50]->value}}"><li class="color-34-top menu-16-color-black"><i class="fa fa-facebook mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][52]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][52]->value}}"><li class="color-34-top menu-16-color-black"><i class="fa fa-twitter mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][51]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][51]->value}}"><li class="color-34-top menu-16-color-black"><i class="fa fa-google mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][53]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][53]->value}}"><li class="color-34-top menu-16-color-black"><i class="fa fa-linkedin mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][216]->value!='')
                  <a target="_blank" class="c777 common-fill-hover mr-20 " href="{{$result['commonContent']['setting'][216]->value}}">
                  <svg style="margin-top:-2px"  class='fontawesomesvg' width="13" height="13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    <a>
                @endif


                @if($result['commonContent']['setting'][218]->value!='')
                    <a target="_blank" class="color-16-top" href="{{$result['commonContent']['setting'][218]->value}}">
                      <li class="color-34-top menu-16-color-black">
                        <i class="fa fa-instagram mr-20 font-size-1rem"></i>
                      </li>
                    </a>
                  @endif


                <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                  <!-- <li class="nav-item mr-20">
                      <a class="color-34-top menu-16-color-black" href="{{ URL::to('/wishlist')}}">
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WHISTLIST <span class="total_wishlist">( {{$result['commonContent']['total_wishlist']}} )</span>
                      </a>
                    </li> -->
                 
                  <li class="nav-item mr-20"> <a class="color-34-top menu-16-color-black" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-34-top menu-16-color-black" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                  <li class="nav-item mr-20"> <a class="color-34-top menu-16-color-black" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-34-top menu-16-color-black" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a class="color-34-top menu-16-color-black" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                                       
                
                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                      <li class="nav-item login_modal" style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li>    
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1" style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li>  
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2" style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li>     
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3" style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li> 
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item login_modal4" style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li>     
                    <?php } else { ?>
                      <li class="nav-item " style="margin-left:20px;"> <a class="color-34-top common-fill-hover color-fill-phone menu-16-color-black" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/></svg>&nbsp;Login</a> </li>      
                    <?php } } }?>
              </ul> 

              <ul class="navbar-nav">
            <div class="navbar-lang">

                @if(count($currencies) > 1)
                  <div class="dropdown" style="margin-left:20px !important;margin-right:0px !important">
                    <div class="dropdown" style="margin-right:0px;margin-left:0px;">
                      <button class="btn dropdown-toggle color-34-top common-fill-hover fill-down-color menu-16-color-black" type="button">
                        {{session('currency_code')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                      </button>
                    <div class="dropdown-menu">
                      @foreach($currencies as $currency)
                      <a onclick="myFunction2({{$currency->id}})" class="dropdown-item color-34-top" href="#">
                        <span>{{$currency->code}}</span>   
                      </a>
                      @endforeach
                    </div>
                  </div>
                  @include('web.common.scripts.changeCurrency')
                @endif
                </div>  

                @if(count($languages) > 1)
                <div class="dropdown" style="margin-right:0px;margin-left:0px;">
                    <button class="btn dropdown-toggle color-34-top common-fill-hover fill-down-color menu-16-color-black" type="button" style="padding:8px 0px 8px 20px !important">
                        {{	session('language_name')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                      </button>
                      <div class="dropdown-menu" >
                        @foreach($languages as $language)
                        <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-34-top" href="#">                      
                          {{$language->name}}
                        </a>                   
                        @endforeach                   
                      </div>
                  </div> 
                
                  @include('web.common.scripts.changeLanguage')
                @endif
                
            </ul>

              
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>


  <div class="header-maxi  bg-header-bar header-maxi-twele" style="height:85px">
    <div class="container-fluid">
      <div class="row align-items-center">
  
        <div class="col-12 col-sm-5">
          <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get">
            <div class="search-16-main">
                <button autocomplete="off" type="submit" class="serach-16-main-left common-fill-hover fill-search" style="padding:0px;background:none;border:none">
                <svg id="search" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 27 27" class="search-icon-16 icon-font-16">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                  
                  </button>
                <input type="hidden" class="category-value" name="categories_id" value=""  /> 
                <div class="serach-16-main-right">
                    <input name="search" type="text" class="cus-input-style-16 typeheads" value="{{ app('request')->input('search') }}" placeholder="Search Product ...." required=""/>
                </div>
                <div class="search_outer_con">
                    <div id="viewsearchproduct"></div>
                  </div>
            </div>
          </form>
        </div>

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

         <div class="col-12 col-sm-5">
              <div class="row">
                <div class="col-md-12" style="text-align:right">
               
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
                    <div class="pro-header-right-options display-inline cart-left-wishlist common-hover common-fill-hover fill-search" style="margin-right:15px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48.232 41.342" style="margin-right:10px;">
                      <g id="wishlist" transform="translate(0 -36.545)">
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                      <span class="total_wishlist badge badge-secondary badge-wishlist-33" style="">{{ $result['commonContent']['total_wishlist'] }}</span><span class="header-16-wishlist-text">My Wishlist</span>
                    </div>
                  </a>
                
                  @if($result['commonContent']['settings']['view_cart_button'] == 1)

                  <ul class="pro-header-right-options display-inline header-34-cart-drop common-hover common-fill-hover fill-search">
                    <li class="dropdown head-cart-content" style="float:none;">
                      @include('web.headers.cartButtons.cartButton34')
                    </li>
                  </ul>
                  @endif
                </div>

            
        </div>
      </div>
    </div>
  </div> 

  </div> 

<div class="bg-header-19">
  <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-sm-8">
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
                  foreach ($items->slice(0, 5) as $item) {

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
                  <li class="nav-item dropdown menu-active-11-{{ $menuactive }} hover-menu-11" style="top:-1px !important;z-index:9">
                    <a class="nav-link font-500 common-fill-hover fill-down-color" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                          <a class="dropdown-item common-fill-hover fill-down-color" <?php echo $sublink; ?>>
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

             
                  
                <?php }} if(count($items) > 5){?>

                  <li class="nav-item dropdown  hover-menu-11" style="top:-1px !important;z-index:9">
                    <a style="white-space:nowrap" class="nav-link font-500 common-fill-hover fill-down-color" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg></a>
                      <div class="dropdown-menu">
                      <?php
                          if($items->isNotEmpty()) {
                            foreach ($items as $key=>$item) {
                              if($key > 4){ 
    
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
                          <a class="dropdown-item common-fill-hover fill-down-color" <?php echo $link; ?>>
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

        <div class="col-12 col-sm-4">
            <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
              
                <div class="head-19 font-weight-600 common-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)"/>
</svg> &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
              
            <?php } else {?>
              
                  <div class="head-19 font-weight-600 common-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)"/>
</svg> &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
                </div>
             
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

