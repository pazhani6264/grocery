<!-- https://bootsnipp.com/snippets/35p8X -->

<!-- //refence responsive menu style -->

<style>
  .header-twele .row{
    margin-left:-10px !important;
    margin-right:-10px !important;
  }
  .product-description-20 a {
    color: #ccc;
    font-size: 13px;
    font-weight: 300 !important;
    line-height: 1.2;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.quick-fill:hover
{
fill: #fff !important;
}
footer.footer.footer-molla.footer-black.padding-top-25.footer-2.f16.footer-16.d-none.d-lg-block.d-xl-block {
    margin-top: 40px;
}
  .header-twele .header-mini .dropdown .btn.dropdown-toggle {
    text-transform: initial;
}
  .header-twele .dropdown-menu .demo-13-cat:hover {
    padding-left: 14px !important;
    background: #fff;
    /* color: #fff !important; */
}
.header-twele .header-maxi .search-field-module .dropdown-menu a {
    padding: 5px 1rem;
    transition: none !important;
}
.demo-13-new-main
{
  display:none !important;
}
.demo-13-btn-hide2:hover .demo-13-new-main
{
  display:block !important;

}
.demo-13-search-cat
{
   transform:unset !important;
}
  .header-fixed .row{
    margin-left:-12px !important;
    margin-right:-12px !important;
  }
.demo-13-color-fill
{
  fill: #666; 
}
.demo-13-color-fill-arrow
{
  fill: #bbb; 
}
.header-twele .header-mini .dropdown .btn.dropdown-toggle.color-16-top::after {
    content: none !important;
}
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
  position: relative;
  left: 0;
  margin-right: 0;
}
.search-field-module .dropdown-toggle {
padding: 1rem 0 !important;
}
.btn-secondary:before {
background-color: transparent !important;
}
.dropdown-menu-11 .dropdown-item {
    padding: 9px 1rem;
    position: relative;
    font-size: 1rem;
}

.header-twele .header-maxi .search-field-module .search-field-wrap input {
    float: left;
    padding: 0px 50px 0 20px;
    height: 48px;
}

.header-twele .header-maxi .search-field-module .search-field-wrap input {
    float: left;
    padding: 0px 50px 0 20px;
    height: 48px;
    font-size: 1rem;
}
</style>


<!-- //header style Twele -->
@include('web.headers.fixedHeader22') 
<header id="headerTwele" class="header-22-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
<div class="header-mini bg-top-bar-22">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0">

          <ul class="navbar-nav">
              <li class="nav-item mr-20">
                <a class="color-16-top common-fill-hover demo-13-color-fill" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;Call: {{$result['commonContent']['setting'][11]->value}}</li>
                </a>
              </li>
            </ul>
                           
            <div class="navbar-collapse">
              
              <div class="navbar-lang">
              
                @if(count($currencies) > 1)
                  <div class="dropdown color-16-top common-fill-hover demo-13-color-fill-arrow" style="margin-right:0px;margin-left:40px;">
                    <button class="btn dropdown-toggle color-16-top" type="button" >
                      {{session('currency_code')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                    </button>
                    <div class="dropdown-menu">
                      @foreach($currencies as $currency)
                      <a onclick="myFunction2({{$currency->id}})" class="dropdown-item color-16-top" href="#">
                        <span>{{$currency->code}}</span>   
                      </a>
                      @endforeach
                    </div>
                  </div>
                  @include('web.common.scripts.changeCurrency')
                @endif

                @if(count($languages) > 1)
                  <div class="dropdown color-16-top common-fill-hover demo-13-color-fill-arrow" style="margin-right:0px;margin-left:20px;">
                      <button class="btn dropdown-toggle color-16-top" type="button" >
                        {{	session('language_name')}}
                        &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> 
                      </button>
                      <div class="dropdown-menu" >
                        @foreach($languages as $language)
                        <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item color-16-top" href="#">                      
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
                      <a class="color-16-top" href="{{ URL::to('/wishlist')}}">
                        <i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WHISTLIST <span class="total_wishlist">( {{$result['commonContent']['total_wishlist']}} )</span>
                      </a>
                    </li> -->
                  <li class="nav-item"  style="margin-right:0px;margin-left:30px;"> <a class="color-16-top" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <!-- <li class="nav-item"> <a class="color-16-top" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li> -->
                  <li class="nav-item"  style="margin-right:0px;margin-left:30px;"> <a class="color-16-top" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item"  style="margin-right:0px;margin-left:30px;"> <a class="color-16-top" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"  style="margin-right:0px;margin-left:30px;"> <a class="color-16-top" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                      <li class="nav-item login_modal" style="margin-left:30px;cursor:pointer"><a class="color-16-top" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1" style="margin-left:30px;cursor:pointer"><a class="color-16-top" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2" style="margin-left:30px;cursor:pointer"><a class="color-16-top" >Sign In / Sign Up</a></li>    
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3" style="margin-left:30px;cursor:pointer"><a class="color-16-top" >Sign In / Sign Up</a></li>
                    <?php } else if($loginID->login == 8){ ?>
                      <li class="nav-item login_modal4" style="margin-left:30px;cursor:pointer"><a class="color-16-top" >Sign In / Sign Up</a></li>     
                    <?php } else { ?>
                      <li class="nav-item" style="margin-left:30px;"> <a class="color-16-top" href="{{ URL::to('/login')}}">Sign In / Sign Up</a> </li>     
                    <?php } } }?>
              </ul> 


            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>


  <div class="header-maxi  bg-header-bar  header-maxi-twele">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-12 col-md-3 col-lg-3">
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

  
          <div class="col-12 col-sm-7 col-md-6 col-lg-6">      
            <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">   
              <div class="search-field-module srach-border-22">   
                  <input type="hidden" name="category" class="category-value" value="">
                  @include('web.common.HeaderCategories')
                <button style="width:200px;padding:0.9rem 20px;font-size:1rem;text-transform:initial;text-align:left" class="btn btn-secondary demo-13-first-toogle swipe-to-top   header-selection cate-button-22" type="button" id="headerOneCartButton"  
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                  data-toggle="tooltip" data-placement="bottom" title="@lang("website.Choose Any Category")"> 
                  @lang("website.Choose Any Category") &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#bbb"/>
</svg> 
                </button> 
                <div style="left: 18px !important;margin-top: 50px;" class="dropdown-menu demo-13-search-cat dropdown-menu-right" aria-labelledby="headerOneCartButton">   
                    @php    productCategories(); @endphp                                                                 
                </div>
                <div class="search-field-wrap menu-22-border" style="position:relative;height:48px">
                    <input  autocomplete="off" type="text" name="search" class="typeheads" placeholder="@lang('website.Search entire store here')..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                    <button class="btn btn-secondary swipe-to-top" 
                    style="width:70px">
                    <svg id="search" xmlns="http://www.w3.org/2000/svg" width="16" height="27" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" fill="#fff"/>
  </g>
</svg></button>
                    <div class="search_outer_con">
                      <div id="viewsearchproduct"></div>
                    </div>
                </div>
              </div>
            </form>
          </div>
<input type="hidden" id="flaghide1" value="0">
        

          <div class="col-12 col-sm-3 text-right">

                  <a href="{{ URL::to('/compare')}}">
                    <div class="pro-header-right-options display-inline cart-left-wishlist cart-left-wishlist-11 text-center common-hover common-fill-hover" style="margin-right:20px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 43.999 46.058">
  <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
</svg>
                      <div class="small-font-size heade-22-text">Compare</div>
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
                    <div class="pro-header-right-options display-inline cart-left-wishlist cart-left-wishlist-11 text-center common-hover common-fill-hover" style="margin-right:20px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48.232 41.342">
  <g id="wishlist" transform="translate(0 -36.545)">
    <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
  </g>
</svg>
                      <div class="small-font-size heade-22-text">Wishlist</div>
                      <span class="total_wishlist badge badge-secondary badge-wishlist-33">{{ $result['commonContent']['total_wishlist'] }}</span>
                    </div>
                  </a>
                
                  @if($result['commonContent']['settings']['view_cart_button'] == 1)

                  <ul class="pro-header-right-options display-inline header-22-cart-drop" style="float:right;margin-top:5px;margin-left: 20px;margin-right: 10px;">
                    <li class="dropdown head-cart-content common-hover common-fill-hover">
                      @include('web.headers.cartButtons.cartButton22')
                    </li>
                  </ul>
                  @endif
                </div>

            
    </div>
  </div> 

  </div> 

<div class="bg-header-22">
  <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-3">
          <nav class="navbar navbar-expand-sm navbar-dark-11 menu-11-padding">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
              </button>
              @include('web.common.HeaderCategories11')
              <div class="collapse navbar-collapse menu-11-border" id="navbarCollapse">
                  <div class="navbar-nav width-100">
                      <div class="nav-item dropdown menu-11 width-100 demo-13-btn-hide2 cate-bg-color" style="padding:10px">
                          <a href="#" class="nav-link menu-hover-11 demo-13-btn-hide  cate-color-22" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="12" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800"  data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)" fill="#fff"/>
    <rect id="Rectangle_5801" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" fill="#fff"/>
    <rect id="Rectangle_5802"  data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" fill="#fff"/>
  </g>
</svg> </a>
                          <a id=""  class="nav-link menu-hover-11 demo-13-btn-hide  cate-color-22 cursor-pointer" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="15" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"/>
</svg>  </a>
                          <div class="dropdown-menu dropdown-menu-11  dropdown-menu-hoactive demo-13-hide"  style="top:55px !important;padding:0px !important">
                              <!-- <a href="#" class="dropdown-item dropdown-item-11">Inbox</a>
                              <a href="#" class="dropdown-item dropdown-item-11">Sent</a>
                              <a href="#" class="dropdown-item dropdown-item-11">Drafts</a> -->
                              @php    productCategories11(); @endphp       
                          </div>
                      </div>
                  </div>
              </div>
          </nav>
        </div>


        <div class="col-12 col-sm-6">
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
                          <a style="white-space:nowrap" class="nav-link menu-color-22 menu-color-22-white common-fill-hover demo-13-color-fill-arrow" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                                <a class="dropdown-item common-fill-hover demo-13-color-fill-arrow"  <?php echo $sublink; ?>>
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

                        <li class="nav-item dropdown hover-menu-13 hover-menu-13-white">
                          <a style="white-space:nowrap" class="nav-link menu-color-22 menu-color-22-white common-fill-hover demo-13-color-fill-arrow" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                                <a class="dropdown-item common-fill-hover demo-13-color-fill-arrow"  <?php echo $link; ?>>
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

        <div class="col-12 col-sm-3 border-left">
            <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
              <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 49.479 49.99">
  <path id="bulb" d="M419.721-12930.74v-3.085h3.059v3.085Zm6.119-3.085H413.606v-14.293a16.819,16.819,0,0,1-8.924-17.935,16.742,16.742,0,0,1,12.96-13.479,16.84,16.84,0,0,1,20.431,16.446,16.822,16.822,0,0,1-9.175,14.971v14.289Zm-9.178-3.06h9.178v-3.056h-9.178Zm1.606-39.652a13.655,13.655,0,0,0-10.569,11,13.821,13.821,0,0,0,8.047,15.052l.915.4v7.082h9.178v-7.082l.915-.4a13.767,13.767,0,0,0,8.259-12.6,13.754,13.754,0,0,0-13.785-13.762A14.421,14.421,0,0,0,418.268-12976.537Zm15.993,28.3,2.238-2.088,3.352,3.795-2.235,2.085Zm-31.544,1.538,3.388-3.405,2.163,2.16-3.392,3.405Zm38.415-14.86v-3.059h4.962v3.059Zm-44.517,0v-3.059h4.753v3.059Zm39.073-15.608,3.675-3.489,2.046,2.273-3.675,3.489Zm-33.991-1.326,2.085-2.238,3.392,3.277-2.085,2.238Z" transform="translate(-396.615 12980.73)" fill="#fff"/>
</svg> &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
              </a>
          <?php } else {?>
            <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 49.479 49.99">
  <path id="bulb" d="M419.721-12930.74v-3.085h3.059v3.085Zm6.119-3.085H413.606v-14.293a16.819,16.819,0,0,1-8.924-17.935,16.742,16.742,0,0,1,12.96-13.479,16.84,16.84,0,0,1,20.431,16.446,16.822,16.822,0,0,1-9.175,14.971v14.289Zm-9.178-3.06h9.178v-3.056h-9.178Zm1.606-39.652a13.655,13.655,0,0,0-10.569,11,13.821,13.821,0,0,0,8.047,15.052l.915.4v7.082h9.178v-7.082l.915-.4a13.767,13.767,0,0,0,8.259-12.6,13.754,13.754,0,0,0-13.785-13.762A14.421,14.421,0,0,0,418.268-12976.537Zm15.993,28.3,2.238-2.088,3.352,3.795-2.235,2.085Zm-31.544,1.538,3.388-3.405,2.163,2.16-3.392,3.405Zm38.415-14.86v-3.059h4.962v3.059Zm-44.517,0v-3.059h4.753v3.059Zm39.073-15.608,3.675-3.489,2.046,2.273-3.675,3.489Zm-33.991-1.326,2.085-2.238,3.392,3.277-2.085,2.238Z" transform="translate(-396.615 12980.73)" fill="#fff"/>
</svg> &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
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
<script>

$(document).ready(function(){
$('.demo-13-btn-hide').click(function() {
  $( ".demo-13-hide" ).toggleClass("demo-13-new-main");
});
});

jQuery(window).scroll(function() {
    
    var topPos = jQuery(this).scrollTop();
    if (topPos > 300) {
    $( ".demo-13-hide" ).removeClass("demo-13-new-main");
    } 
  });
	

 
</script>


