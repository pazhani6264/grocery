<style>
 @media screen and (max-width: 992px){
  .demo-28-tab-hide
  {
    display: none;
  }
  .demo-28-mobile-hide
  {
    display: inline-block;
  }

 }

 @media screen and (max-width: 600px){
  .demo-28-tab-hide
  {
    display: inline-block;
  }
  .demo-28-mobile-hide
  {
    display: none;
  }

 }

 @media screen and (max-width: 330px){

  .demo-28-mobile-wish-hide
  {
    display: none;
  }
  .mobile-header-left-16 {
    display: inline-block;
    width: 50% !important;
    padding: 0px;
}

 }
  </style>

<input type="hidden" id="mobheadergetvalue" value="34"/>

<header id="headerMobileTwele" class="header-area header-mobile header-mobile-12 d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar mobile-bg-34">
      <div class="container">
        <div class="row">
            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                  <div class="dropdown-mobile-12 drop-left">
                    <ul class="navbar-nav" style="margin-left:10px">
                      <li class="nav-item mr-20">
                        <a class="color-34-top color-fill-phone common-fill-hover" style="font-size: 0.7rem;" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;Call : {{$result['commonContent']['setting'][11]->value}}</li>
                        </a>
                      </li>
                    </ul>
                  </div>

                <div class="dropdown-mobile-11 drop-right" style="right:-5px !important">

                @if($result['commonContent']['setting'][50]->value!='')
                  <a class="color-34-top" target="_blank" href="{{$result['commonContent']['setting'][50]->value}}"><i class="fa fa-facebook mr--5"></i></a>
                @endif
                @if($result['commonContent']['setting'][52]->value!='')
                  <a class="color-34-top" target="_blank" href="{{$result['commonContent']['setting'][52]->value}}"><i class="fa fa-twitter mr--5"></i></a>
                @endif
                @if($result['commonContent']['setting'][51]->value!='')
                  <a class="color-34-top" target="_blank" href="{{$result['commonContent']['setting'][51]->value}}"><i class="fa fa-google mr--5"></i></a>
                @endif
                @if($result['commonContent']['setting'][53]->value!='')
                  <a class="color-34-top" target="_blank" href="{{$result['commonContent']['setting'][53]->value}}"><i class="fa fa-linkedin mr--5"></i></a>
                @endif
                @if($result['commonContent']['setting'][216]->value!='')
                  <a target="_blank" class="c777 common-fill-hover mr--5" href="{{$result['commonContent']['setting'][216]->value}}">
                  <svg style="margin-top:-2px"  class='fontawesomesvg' width="13" height="13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    <a>
                @endif

                @if($result['commonContent']['setting'][218]->value!='')
                  <a class="color-16-top"  target="_blank" href="{{$result['commonContent']['setting'][218]->value}}"><i class="fa fa-linkedin mr-20 font-size-1rem"></i></a>
                @endif

                  <div class="demo-28-mobile-hide">
                  <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                      <a class="color-16-top" href="{{url('logout')}}" class="nav-link" style="margin-right: 20px;margin-left: 20px;">@lang('website.Logout')</a> 
                    <?php }else{ ?>
               
                          <?php 
                          if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                               <a class="color-16-top common-fill-hover color-fill-phone login_modal" style="margin-right: 20px;margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                                <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                
                            <?php } else if($loginID->login == 5){ ?>
                              <a class="color-16-top common-fill-hover color-fill-phone login_modal1" style="margin-right: 20px;margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                                <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                                 
                            <?php } else if($loginID->login == 6){ ?>
                              <a class="color-16-top common-fill-hover color-fill-phone login_modal2" style="margin-right: 20px;margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                                <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                                 
                            <?php } else if($loginID->login == 7){ ?>
                              <a class="color-16-top common-fill-hover color-fill-phone login_modal3" style="margin-right: 20px;margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                                <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>    
                            <?php } else if($loginID->login == 8){ ?>
                              <a class="color-16-top common-fill-hover color-fill-phone login_modal4" style="margin-right: 20px;margin-left: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                                <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                                  
                          <?php } else { ?>
                            <a class="color-16-top common-fill-hover color-fill-phone" style="margin-right: 20px;margin-left: 20px;" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                
                        <?php } } }?>
                      

                    @if(count($currencies) > 1)
                      <div class="dropdown-mobile-12 drop-left1 color-16-top mobile-none" style="margin-right: 0px;">
                        <a style="padding: 8px 0px 10px 8px!important;" class="dropbtn-mobile-12 common-fill-cover fill-down-color"> {{	session('currency_code')}} <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg></a>
                        <div class="dropdown-content-mobile-12 dropdown-left" style="left:0px !important">
                          @foreach($currencies as $currency)
                            <a class="color-16-top" onclick="myFunction2({{$currency->id}})"  href="#"><span>{{$currency->code}}</span></a>
                          @endforeach
                        </div>
                      </div>
                    @endif

                    @if(count($languages) > 1)
                      <div class="dropdown-mobile-12 drop-left color-16-top mobile-none" style="margin-right: 20px;">
                        <a class="dropbtn-mobile-12 common-fill-cover fill-down-color" style="padding-right:0;"> {{	session('language_name')}} <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg></a>
                        <div class="dropdown-content-mobile-12 dropdown-left">
                          @foreach($languages as $language)
                            <a class="color-16-top" onclick="myFunction1({{$language->languages_id}})"  href="#">{{$language->name}}</i></a>  
                          @endforeach
                        </div>
                      </div>
                    @endif

                    </div>
                    
                    <div class="demo-28-tab-hide">
                    <a class="dropbtn-mobile-11 color-34-top" style="margin-right: 0px;">Links </a>
                    <div class="dropdown-content-mobile-11 dropdown-right">

                    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                        <a  class="color-34-top" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> 
                      <?php }else{ ?>
                        <?php 
                        if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                               <a  class="color-34-top login_modal">Login</a>                               
                            <?php } else if($loginID->login == 5){ ?>
                              <a  class="color-34-top login_modal1">Login</a>                  
                            <?php } else if($loginID->login == 6){ ?>
                              <a  class="color-34-top login_modal2">Login</a>                 
                            <?php } else if($loginID->login == 7){ ?>
                              <a  class="color-34-top login_modal3">Login</a>    
                            <?php } else if($loginID->login == 8){ ?>
                              <a  class="color-34-top login_modal4">Login</a>                   
                          <?php } else { ?>
                            <a  class="color-34-top" href="{{ URL::to('/login')}}">Login</a>                         
                        <?php } } }?>

                      @if(count($languages) > 1)
                        <div class="dropdown-mobile-11-con drop-left color-34-top">
                          <a class="dropbtn-mobile-11-con"> {{	session('language_name')}} <i class="fa fa-angle-down"></i></a>
                          <div class="dropdown-content-mobile-11-con dropdown-left">
                            @foreach($languages as $language)
                              <a class="color-34-top" onclick="myFunction1({{$language->languages_id}})"  href="#">{{$language->name}}</i></a>  
                            @endforeach
                          </div>
                        </div>
                      @endif

                      @if(count($currencies) > 1)
                        <div class="dropdown-mobile-11-cur drop-left1 color-34-top">
                          <a class="dropbtn-mobile-11-cur"> {{	session('currency_code')}} <i class="fa fa-angle-down"></i></a>
                          <div class="dropdown-content-mobile-11-cur dropdown-left">
                            @foreach($currencies as $currency)
                              <a class="color-34-top" onclick="myFunction2({{$currency->id}})"  href="#"><span>{{$currency->code}}</span></a>
                            @endforeach
                          </div>
                        </div>
                      @endif

                  </div>
                  </div>



                </div>

            </nav>
          </div>
      </div>
    </div>
    <div class="header-maxi mobile-12 bg-header-bar " style="margin:0 10px;">
      <div class="container">

        <div class="row align-items-center">
          <div class="mobile-header-left-16" style="width:30% !important"> 
              <div class="navigation-mobile-container">
          
                  <nav id="navigation-mobiles">
                      <div class="logout-main">
                          <div class="welcome">
                            <span style="color:#fff"><?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                          </div>
                          <span class="close-bttn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"/>
</svg></span>
                         
                      </div>


                      <div class="header-navbar bg-menu-bar">
                        <div class="container">
                          <form class="form-inline-mobile-12" action="{{ URL::to('/shop')}}" method="get">
                            <div class="serach-mobile-12">
                            <input   type="hidden" class="category_mobile_slug" name="categories_id" value="" /> 
                              <input  class="serach-input-mobile-12 typeheads_mobile" type="search" required name="search" placeholder="@lang('website.Search entire store here')..."  value="{{ app('request')->input('search') }}">
                              <button class="search-button-mobile-12" type="submit">
                              <svg id="search" xmlns="http://www.w3.org/2000/svg" width="16" height="27" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" fill="#fff"/>
  </g>
</svg></button>
                              <div class="search_outer_con_mobile">
                                  <div id="viewsearchproduct_mobile"></div>
                                </div>
                            </div>
                          </form>
                        </div>
                      </div>


                      {!! $result['commonContent']["menusRecursiveMobile"] !!}
                     
                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                       <a href="{{url('profile')}}" class="common-hover main-manu btn">@lang('website.Profile')</a>
                       <!-- <a href="{{url('wishlist')}}" class="main-manu btn btn-primary">@lang('website.Wishlist')<span class="total_wishlist"> ({{$result['commonContent']['total_wishlist']}})</span></a> -->
                       <a href="{{url('compare')}}" class="common-hover main-manu btn">@lang('website.Compare')&nbsp;(<span id="mobilecompare">{{$count}}</span>)</a>
                       <a href="{{url('orders')}}" class="common-hover main-manu btn">@lang('website.Orders')</a>
                       <a href="{{url('shipping-address')}}" class="common-hover main-manu btn">@lang('website.Shipping Address')</a>
                       <!-- <a href="{{url('logout')}}" class="main-manu btn">@lang('website.Logout')</a> -->
                      <?php }else{ ?>
                        <!-- <div class="nav-link">@lang('website.Welcome')!</div>
                         <a href="{{ URL::to('/login')}}" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a> -->
                       <?php } ?>


                       <footer id="footerMobile" class="footer-area footer-mobile-menu d-lg-none d-xl-none">
                          <div class="container-fluid p-0">
                            <div class="container">
                              <div class="row">
                                <div class="col-12">
                                      <div class="socials mt-40 mb-40">
                                          <ul class="list">
                                          <li>
                                              @if(!empty($result['commonContent']['setting'][50]->value))
                                                <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fa-facebook-f" target="_blank"></a>
                                                @else
                                                  <a href="#" class="fab fa-facebook-f"></a>
                                                @endif
                                            </li>
                                            <li>
                                              @if(!empty($result['commonContent']['setting'][52]->value))
                                                  <a href="{{$result['commonContent']['setting'][52]->value}}" class="fab fa-twitter" target="_blank"></a>
                                              @else
                                                  <a href="#" class="fab fa-twitter"></a>
                                              @endif
                                            </li>
                                            <li>
                                              @if(!empty($result['commonContent']['setting'][51]->value))
                                                  <a href="{{$result['commonContent']['setting'][51]->value}}"  target="_blank"><i class="fab fa-google"></i></a>
                                              @else
                                                  <a href="#"><i class="fab fa-google"></i></a>
                                              @endif
                                            </li>
                                            <li>
                                              @if(!empty($result['commonContent']['setting'][53]->value))
                                                  <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab fa-linkedin-in" target="_blank"></a>
                                              @else
                                                  <a href="#" class="fab fa-linkedin-in"></a>
                                              @endif
                                            </li>
                                          </ul>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
  
                      </footer>


                  </nav>
              </div>

         
            <a class="img-fluid-molla-main" href="{{ URL::to('/')}}" class="logo">
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


          <div class="mobile-header-right-16" style="padding: 0px 5px 0px 0px !important;width:70% !important"> 

            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a class="demo-28-mobile-wish-hide" href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="demo-28-mobile-wish-hide login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="demo-28-mobile-wish-hide login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="demo-28-mobile-wish-hide login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="demo-28-mobile-wish-hide login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="demo-28-mobile-wish-hide login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a class="demo-28-mobile-wish-hide" href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>

              <div class="pro-header-right-options display-inline cart-left-wishlist common-fill-hover fill-search" style="margin-right:10px !important">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48.232 41.342">
                      <g id="wishlist" transform="translate(0 -36.545)">
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                <span class="total_wishlist badge badge-secondary badge-wishlist-16-mobile">{{ $result['commonContent']['total_wishlist'] }}</span>
              </div><span class="header-16-wishlist-text">My Wishlist</span>
            </a>
                  
            @if($result['commonContent']['settings']['view_cart_button'] == 1)

            <ul class="pro-header-right-options header-34-mobile-cart-drop common-hover common-fill-hover fill-search" id="resposive-header-cart" style="display:inline-block;vertical-align:bottom">
                @include('web.headers.cartButtons.cartButtonMobile34')
            </ul> 
            @endif
          </div>
          </div>
        </div>
      </div>




      <div class="bg-header-mobile-19 " style="margin:0 10px;">
        <div class="container"  style="padding-left:5px !important;padding-right:5px !important;">
          <div class="row align-items-center">
            <div class="col-1 pr-0">
                <div class="navigation-mobile-container" style="margin-top:6px;">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler-12">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800" class="common-color" data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)" fill="#333"/>
    <rect id="Rectangle_5801" class="common-color" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" fill="#333"/>
    <rect id="Rectangle_5802" class="common-color" data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" fill="#333"/>
  </g>
</svg>
                  </a>
                </div>
            </div>
            <div class="col-11">
              <div class="head-19 common-fill"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;CLEARANCE UP TO 30% OFF</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>
