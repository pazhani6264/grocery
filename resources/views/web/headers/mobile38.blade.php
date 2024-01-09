<style>
  @media only screen and (max-width: 991px)
  {
    .demo-33-mobileheader-section .header-mini {
        padding: 0px;
        background: #fff;
    }



    .dropdown-content-mobile-12 a {
    color: black;
    padding: 6px 16px;
    text-decoration: none;
    display: block;
    font-size: 13px;
    text-transform: initial;
}
.search-button-mobile-12 {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    background-color: #222;
    color: #fff !important;
    outline: none;
    border: none;
    width: 15%;
}
    .demo-33-mobile-img-fluid-molla-main {
    margin: 39px 0 29px 0;
    min-height: 25px;
    border: 0px solid;
    display: inline-block;
    width: 105px;
aspect-ratio: auto 105 / 25;
height: 25px;
}

    .demo-33-mobile-img-fluid-molla {
      max-width: 100%;
    height: auto;
    object-fit: cover;
  
}
.demo-33-mobileheader-section .header-maxi .navigation-mobile-container .navigation-mobile-toggler-12 {
  
    padding: 0 0.75rem 0.55rem 0.75rem;
  
}

.demo-33-mobileheader-section .header-maxi {
    height: 100px; 
    align-items: center;
    display: flex;
}

    .demo-33-mobileheader-section .drop-left {
    padding: 9px 0px;
    font-size: 13px;
    border: none;
    margin-right: 30px;
    }
    .demo-33-mobileheader-section .dropbtn-mobile-12 {
    padding: 0px;
}
    .demo-33-mobileheader-section .drop-left1 {
    padding: 9px 0px;
    font-size: 13px;
    border: none;
    }
    .demo-33-mobileheader-section .drop-right {
    padding: 9px 0px;
    font-size: 13px;
    border: none;
    }
}

@media only screen and (max-width: 600px)
    {
.demo-33-mobileheader-section .header-maxi .navigation-mobile-container .navigation-mobile-toggler-12 {
    padding: 0 0.75rem 0.55rem 0.75rem;
    margin-right: 10px !important;
}
    }

</style>
<input type="hidden" id="mobheadergetvalue" value="38"/>

<header id="headerMobileTwele" class="demo-33-mobileheader-section header-area header-mobile header-mobile-12 d-lg-none d-xl-none">
    <div class="header-mini bg-color-13 bg-header-35-border">
      <div class="demo-33-container">
        <div class="">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

            

                @if(count($currencies) > 1)
                  <div class="dropdown-mobile-12 drop-left1" style="margin-right:20px;">
                    <a class="dropbtn-mobile-12 color-38 common-hover fill-color common-fill-hover"> {{	session('currency_code')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
</svg></a>
                    <div class="dropdown-content-mobile-12 dropdown-left">
                      @foreach($currencies as $currency)
                        <a class="color-38" onclick="myFunction2({{$currency->id}})"  href="#"><span>{{$currency->code}}</span></a>
                      @endforeach
                    </div>
                  </div>
                @endif

                @if(count($languages) > 1)
                  <div class="dropdown-mobile-12 drop-left">
                    <a class="dropbtn-mobile-12 color-38 common-hover fill-color common-fill-hover"> {{	session('language_name')}}  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
</svg></a>
                    <div class="dropdown-content-mobile-12 dropdown-left">
                      @foreach($languages as $language)
                        <a class="color-38" onclick="myFunction1({{$language->languages_id}})"  href="#">{{$language->name}}</i></a>  
                      @endforeach
                    </div>
                  </div>
                @endif

                <div class="dropdown-mobile-12 drop-right">
                  <a class="dropbtn-mobile-12 color-38 common-hover fill-color common-fill-hover">LINKS  &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
</svg></a>
                  <div class="dropdown-content-mobile-12 dropdown-right">
                      <a class="color-38 fill-color-black common-fill-hover"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 25.175 26.863">
  <path id="call" d="M18.267,26.863c-.153,0-.306-.006-.471-.019a12.88,12.88,0,0,1-7.018-2.818A42.043,42.043,0,0,1,2.658,15.36,14.847,14.847,0,0,1,.018,7.872,7,7,0,0,1,.38,5.1,6.652,6.652,0,0,1,1.8,2.744L3.343,1.091a3.342,3.342,0,0,1,4.939,0l1.4,1.495a3.719,3.719,0,0,1,.757,1.209,3.96,3.96,0,0,1,0,2.852,3.719,3.719,0,0,1-.757,1.209l-.8.857a1.976,1.976,0,0,0-.514,1.162,2.015,2.015,0,0,0,.291,1.247,22.553,22.553,0,0,0,6.1,6.505,1.714,1.714,0,0,0,.992.318,1.679,1.679,0,0,0,.177-.009,1.754,1.754,0,0,0,1.089-.548l.8-.856a3.494,3.494,0,0,1,1.134-.808,3.289,3.289,0,0,1,2.672,0,3.494,3.494,0,0,1,1.134.808l1.4,1.493a3.744,3.744,0,0,1,.757,1.21,3.948,3.948,0,0,1,0,2.852,3.731,3.731,0,0,1-.757,1.209L22.6,24.944a6.068,6.068,0,0,1-1.987,1.419,5.752,5.752,0,0,1-2.345.5ZM5.128,1.962a1.766,1.766,0,0,0-.579.413L3,4.029a4.81,4.81,0,0,0-1.022,1.7,5.051,5.051,0,0,0-.261,2A12.967,12.967,0,0,0,4.02,14.27a40.3,40.3,0,0,0,7.779,8.3,11.246,11.246,0,0,0,6.125,2.462c.111.009.225.014.337.014a4.171,4.171,0,0,0,1.539-.294,4.385,4.385,0,0,0,1.6-1.09l1.549-1.653a2,2,0,0,0,0-2.7l-1.4-1.492a1.754,1.754,0,0,0-2.532,0l-.8.855a3.351,3.351,0,0,1-2.47,1.089,3.335,3.335,0,0,1-1.936-.623,24.3,24.3,0,0,1-6.569-7.01,3.945,3.945,0,0,1-.567-2.434,3.857,3.857,0,0,1,1-2.268l.8-.857a2,2,0,0,0,0-2.7l-1.4-1.495a1.763,1.763,0,0,0-.58-.414,1.672,1.672,0,0,0-.682-.145h0A1.675,1.675,0,0,0,5.128,1.962Z" transform="translate(0)"/>
</svg>&nbsp;&nbsp;Call: {{$result['commonContent']['setting'][11]->value}}</li></a>

                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a class="color-38" href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="color-38 login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="color-38 login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="color-38 login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="color-38 login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="color-38 login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a class="color-38" href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>
                        
                      <i class="fa fa-heart-o"></i>&nbsp;&nbsp;My Wishlist&nbsp;<span class="common-color">(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</span></a>
                      <a class="color-38" style="margin-left:20px;" href="{{ URL::to('/page?name=about-us')}}">About us</a>
                      <a class="color-38" style="margin-left:20px;" href="{{ URL::to('/contact')}}">Contact us</a>

                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                      <?php } else { ?>
                       

                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                              <a class="color-38 fill-color-black common-fill-hover login_modal" style="text-transform:initial"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>  
                            <?php } else if($loginID->login == 5){ ?>
                              <a class="color-38 fill-color-black common-fill-hover login_modal" style="text-transform:initial"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                 
                            <?php } else if($loginID->login == 6){ ?>
                              <a class="color-38 fill-color-black common-fill-hover login_modal2" style="text-transform:initial"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>          
                            <?php } else if($loginID->login == 7){ ?>
                              <a class="color-38 fill-color-black common-fill-hover login_modal3" style="text-transform:initial"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a> 
                            <?php } else if($loginID->login == 8){ ?>
                              <a class="color-38 fill-color-black common-fill-hover login_modal4" style="text-transform:initial"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>                   
                          <?php } else { ?>
                            <a class="color-38 fill-color-black common-fill-hover" style="text-transform:initial" href="{{ URL::to('/login')}}" ><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 24.552 26.999" style="margin-right:5px;">
                            <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                            </svg>&nbsp;Login</a>               
                        <?php } } }?>                      
                  </div>
                </div>


            </nav>
          </div>
      </div>
    </div>
    <div class="header-maxi mobile-12 bg-color-13 ">
    <div class="demo-33-container">

        <div class="row align-items-center">
          <div class="col-10 pr-0">
              <div class="navigation-mobile-container">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler-12">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800" class="common-color" data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)" fill="#fff"/>
    <rect id="Rectangle_5801" class="common-color" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" fill="#fff"/>
    <rect id="Rectangle_5802" class="common-color" data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" fill="#fff"/>
  </g>
</svg>
                  </a>
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
                              <button class="search-button-mobile-12 common-bg-hover" type="submit">
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
                       <a href="{{url('logout')}}" class="common-hover main-manu btn">@lang('website.Logout')</a>
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


         
            <a class="demo-33-mobile-img-fluid-molla-main" href="{{ URL::to('/')}}" class="logo">
              @if($result['commonContent']['settings']['sitename_logo']=='name')
              <?=stripslashes($result['commonContent']['settings']['website_name'])?>
              @endif

              @if($result['commonContent']['settings']['sitename_logo']=='logo')
                  <?php 
                  $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                  ?>
                  @if($imagepath->path_type == 'aws')
                    <img class="demo-33-mobile-img-fluid-molla" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @else
                    <img class="demo-33-mobile-img-fluid-molla" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
              @endif
           </a>
          </div>

          @if($result['commonContent']['settings']['view_cart_button'] == 1)

          <div class="col-2 pl-0">              
            <ul class="pro-header-right-options header-38-mobile-cart-drop common-hover color-fill-phone common-fill-hover" id="resposive-header-cart" style="margin-top: -15px;">
              @include('web.headers.cartButtons.cartButtonMobile38')
            </ul> 
          </div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<script>
function openHeader(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>