<style>
  @media only screen and (max-width: 540px)
{
.demo-19-mobile-display-none
{
  display:none;
}
}
</style>

<input type="hidden" id="mobheadergetvalue" value="29"/>

<header id="headerMobileTwele" class="header-area header-mobile header-mobile-12 d-lg-none d-xl-none">
<!-- <div class="header-mini bg-top-bar-twele">
      <div class="container">
        <div class="row">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                @if(count($languages) > 1)
                  <div class="dropdown-mobile-12 drop-left color-16-top">
                    <a class="dropbtn-mobile-12"> {{	session('language_name')}} <i class="fa fa-angle-down"></i></a>
                    <div class="dropdown-content-mobile-12 dropdown-left">
                      @foreach($languages as $language)
                        <a class="color-16-top" onclick="myFunction1({{$language->languages_id}})"  href="#">{{$language->name}}</i></a>  
                      @endforeach
                    </div>
                  </div>
                @endif

                @if(count($currencies) > 1)
                  <div class="dropdown-mobile-12 drop-left1 color-16-top">
                    <a class="dropbtn-mobile-12"> {{	session('currency_code')}} <i class="fa fa-angle-down"></i></a>
                    <div class="dropdown-content-mobile-12 dropdown-left">
                      @foreach($currencies as $currency)
                        <a class="color-16-top" onclick="myFunction2({{$currency->id}})"  href="#"><span>{{$currency->code}}</span></a>
                      @endforeach
                    </div>
                  </div>
                @endif

                <div class="dropdown-mobile-12 drop-right color-16-top">
                  <a class="dropbtn-mobile-12">LINKS <i class="fa fa-angle-down"></i></a>
                  <div class="dropdown-content-mobile-12 dropdown-right">
                      <a class="color-16-top" ><i class="fa fa-phone"></i>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li></a>
                      <a class="color-16-top" href="{{ URL::to('/wishlist')}}"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;MY WHISTLIST <span class="total_wishlist">( {{$result['commonContent']['total_wishlist']}} )</span></a>
                      <a class="color-16-top" href="{{ URL::to('/page?name=about-us')}}">ABOUT US</a>
                      <a class="color-16-top"  href="{{ URL::to('/contact')}}">CONTACT US</a>

                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                      <?php } else { ?>

                        <?php 
                       // if($result['commonContent']['settings']['view_login_button'] == 1){
                      // $loginID = DB::table('current_theme')->first();
                      // if($loginID->login == 4) {
                    ?>
                        <a class="color-16-top login_modal"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                      <?php //} else if($loginID->login == 5){ ?>
                        <a class="color-16-top login_modal1"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php //} else if($loginID->login == 6){ ?>
                        <a class="color-16-top login_modal2"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php //} else if($loginID->login == 7){ ?>
                        <a class="color-16-top login_modal3"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php //} else if($loginID->login == 8){ ?>
                        <a class="color-16-top login_modal4"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php //} else { ?>
                        <a class="color-16-top" href="{{ URL::to('/login')}}" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php //} }?>

                      <?php } ?>
                  </div>
                </div>


            </nav>
          </div>
      </div>
    </div> -->
    <div class="header-maxi mobile-12 bg-header-29 ">
      <div class="container">

        <div class="row align-items-center">
          <div class="mobile-header-left"> 
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
                  <nav id="navigation-mobiles" class="bg-white">
                      <div class="logout-main bg-white">
                          <div class="welcome">
                            <span style="color:#666"><?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                          </div>
                          <span class="close-bttn close-bttn-11"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#333"/>
</svg></span>
                         
                      </div>


                      <div class="header-navbar bg-menu-bar bg-white">
                        <div class="container">
                          <form class="form-inline-mobile-11" action="{{ URL::to('/shop')}}" method="get">
                            <div class="serach-mobile-12">
                            <input   type="hidden" class="category_mobile_slug" name="categories_id" value="" /> 
                              <input  class="serach-input-mobile-11 typeheads_mobile" type="search" required name="search" placeholder="@lang('website.Search entire store here')..."  value="{{ app('request')->input('search') }}">
                              <button class="search-button-mobile-11" type="submit">
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


                      
                      <div class="tab-11 width-100 height-auto">
                        <button class="tablinks width-50" onclick="openHeader(event, 'menu')" id="defaultOpen">MENU</button>
                        <button class="tablinks width-50" onclick="openHeader(event, 'category')">CATEGORIES</button>
                      </div>

                      <div id="menu" class="tabcontent width-100 color-11-menu" style="display: block;">
                        {!! $result['commonContent']["menusRecursiveMobile11"] !!}

                        <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                       <a href="{{url('profile')}}" class="common-hover main-manu-11 btn">@lang('website.Profile')</a>
                       <!-- <a href="{{url('wishlist')}}" class="main-manu btn btn-primary">@lang('website.Wishlist')<span class="total_wishlist"> ({{$result['commonContent']['total_wishlist']}})</span></a> -->
                       <a href="{{url('compare')}}" class="common-hover main-manu-11 btn">@lang('website.Compare')&nbsp;(<span id="mobilecompare">{{$count}}</span>)</a>
                       <a href="{{url('orders')}}" class="common-hover main-manu-11 btn">@lang('website.Orders')</a>
                       <a href="{{url('shipping-address')}}" class="common-hover main-manu-11 btn">@lang('website.Shipping Address')</a>
                       <a href="{{url('logout')}}" class="common-hover main-manu-11 btn">@lang('website.Logout')</a>
                      <?php }else{ ?>
                        <!-- <div class="nav-link">@lang('website.Welcome')!</div>
                         <a href="{{ URL::to('/login')}}" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a> -->
                       <?php } ?>

                       
                      </div>

                      <div id="category" class="tabcontent width-100 mobile-right-menu">
                        @include('web.common.HeaderCategoriesmobile11')
                        @php    productCategoriesmobile11(); @endphp       
                      </div>

                     
                      

                       <footer id="footerMobile" class="footer-area footer-mobile-menu d-lg-none d-xl-none bg-white footer-11-color">
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

          <div class="mobile-header-right"> 
            
            <a class="demo-19-mobile-display-none" href="{{ URL::to('/compare')}}">
              <div class="pro-header-right-options common-fill-hover demo-22-fill-white display-inline cart-left-wishlist cart-left-wishlist-11 text-center" style="margin-right:20px !important">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 43.999 46.058">
  <path id="compare" d="M35.917,40.161H27.343L22.074,29.623l1.567-3.051,5.521,10.589h6.755V30.434L44,38.515l-8.082,7.543ZM0,40.161v-3H10.48l7.535-14.226L9.924,9.4H0v-3H11.626l8.031,13.437L26.5,6.908h9.413V0L44,8.081l-8.082,7.543V9.907H28.31L12.286,40.161Z" />
</svg>
              </div>
            </a>
          
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>

<a class="demo-19-mobile-display-none" href="{{ URL::to('/wishlist')}}">
  <?php } else {?>
    <?php 
    $loginID = DB::table('current_theme')->first();
    if($loginID->login == 4) {
  ?>
    <a class="demo-19-mobile-display-none login_modal" style="cursor:pointer"> 
  <?php } else if($loginID->login == 5){ ?>
    <a class="demo-19-mobile-display-none login_modal1" style="cursor:pointer">     
  <?php } else if($loginID->login == 6){ ?>
    <a class="demo-19-mobile-display-none login_modal2" style="cursor:pointer">   
  <?php } else if($loginID->login == 7){ ?>
    <a class="demo-19-mobile-display-none login_modal3" style="cursor:pointer"> 
  <?php } else if($loginID->login == 8){ ?>
    <a class="demo-19-mobile-display-none login_modal4" style="cursor:pointer"> 
  <?php } else { ?>
    <a class="demo-19-mobile-display-none" href="{{ URL::to('/wishlist')}}"> 
  <?php } ?>
    <?php }?>
              <div class="pro-header-right-options common-fill-hover demo-22-fill-white display-inline cart-left-wishlist cart-left-wishlist-11 text-center" style="margin-right:35px !important">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48.232 41.342">
                      <g id="wishlist" transform="translate(0 -36.545)">
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                <span class="badge badge-secondary badge-wishlist-29" style="top:-5px">{{ $result['commonContent']['total_wishlist'] }}</span>
              </div>
            </a>
          
            @if($result['commonContent']['settings']['view_cart_button'] == 1)

            <ul class="pro-header-right-options common-fill-hover demo-22-fill-white display-inline cart-left-wishlist cart-left-wishlist-11 text-center ver-lign-mobile header-29-mobile-cart-drop" id="resposive-header-cart" style="display:inline-block;margin-right:0px !important;vertical-align:bottom">
              @include('web.headers.cartButtons.cartButtonMobile29')
            </ul> 
            @endif
          </div>
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