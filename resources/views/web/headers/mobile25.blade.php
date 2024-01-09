<input type="hidden" id="mobheadergetvalue" value="25"/>

<header id="headerMobileTwele" class="header-area header-mobile header-mobile-12 d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar-19">
      <div class="container">
        <div class="row">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

              <div class="dropdown-mobile-12 drop-left mobile-none" style="margin-left:10px">
                    <ul class="navbar-nav">
                      <li class="nav-item mr-20">
                        <a class="color-16-top" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                          <i class="fa fa-phone"></i>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li>
                        </a>
                      </li>
                    </ul>
                  </div>
               
               

                <div class="drop-right" style="right: 5px !important;">
                @if($result['commonContent']['setting'][50]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][50]->value}}"><li class="color-16-top"><i class="fa fa-facebook mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][52]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][52]->value}}"><li class="color-16-top"><i class="fa fa-twitter mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][51]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][51]->value}}"><li class="color-16-top"><i class="fa fa-google mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][53]->value!='')
                  <a target="_blank" href="{{$result['commonContent']['setting'][53]->value}}"><li class="color-16-top"><i class="fa fa-linkedin mr-20 font-size-1rem"></i></li></a>
                @endif
                @if($result['commonContent']['setting'][216]->value!='')
                  <a target="_blank" class="c777 common-fill-hover mr-20 " href="{{$result['commonContent']['setting'][216]->value}}">
                  <svg style="margin-top:-2px" class='fontawesomesvg' width="13" height="13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                    <a>
                @endif

                @if($result['commonContent']['setting'][218]->value!='')
                  <a class="color-16-top"  target="_blank" href="{{$result['commonContent']['setting'][218]->value}}"><i class="fa fa-linkedin mr-20 font-size-1rem"></i></a>
                @endif
                
                    <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                      <a class="color-16-top" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> 
                    <?php }else{ ?>
                    
                      <?php 
                      if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                              <a class="color-16-top login_modal" ><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>                  
                            <?php } else if($loginID->login == 5){ ?>
                              <a class="color-16-top login_modal1" ><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>                  
                            <?php } else if($loginID->login == 6){ ?>
                              <a class="color-16-top login_modal2" ><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>                  
                            <?php } else if($loginID->login == 7){ ?>
                              <a class="color-16-top login_modal3" ><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>     
                            <?php } else if($loginID->login == 8){ ?>
                              <a class="color-16-top login_modal4" ><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>                  
                          <?php } else { ?>
                            <a class="color-16-top" href="{{ URL::to('/login')}}"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a>                  
                        <?php } } }?>

                    @if(count($languages) > 1)
                      <div class="dropdown-mobile-12 drop-left color-16-top mobile-none">
                        <a class="dropbtn-mobile-12"> {{	session('language_name')}} <i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-content-mobile-12 dropdown-left">
                          @foreach($languages as $language)
                            <a class="color-16-top" onclick="myFunction1({{$language->languages_id}})"  href="#">{{$language->name}}</i></a>  
                          @endforeach
                        </div>
                      </div>
                    @endif

                    @if(count($currencies) > 1)
                      <div class="dropdown-mobile-12 drop-left1 color-16-top mobile-none">
                        <a style="padding: 8px 0px 10px 8px!important;" class="dropbtn-mobile-12"> {{	session('currency_code')}} <i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-content-mobile-12 dropdown-left" style="left:0px !important">
                          @foreach($currencies as $currency)
                            <a class="color-16-top" onclick="myFunction2({{$currency->id}})"  href="#"><span>{{$currency->code}}</span></a>
                          @endforeach
                        </div>
                      </div>
                    @endif

                </div>


            </nav>
          </div>
      </div>
    </div>
    <div class="header-maxi mobile-12 bg-header-bar ">
      <div class="container">

        <div class="row align-items-center">
          <div class="mobile-header-left-16" style="width:30% !important"> 
              <div class="navigation-mobile-container">
          
                  <nav id="navigation-mobiles">
                      <div class="logout-main">
                          <div class="welcome">
                            <span style="color:#fff"><?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                          </div>
                          <span class="close-bttn"><i class="fa fa-close"></i></span>
                         
                      </div>


                      <div class="header-navbar bg-menu-bar">
                        <div class="container">
                          <form class="form-inline-mobile-12" action="{{ URL::to('/shop')}}" method="get">
                            <div class="serach-mobile-12">
                            <input   type="hidden" class="category_mobile_slug" name="categories_id" value="" /> 
                              <input  class="serach-input-mobile-12 typeheads_mobile" type="search" required name="search" placeholder="@lang('website.Search entire store here')..."  value="{{ app('request')->input('search') }}">
                              <button class="search-button-mobile-12" type="submit">
                              <i class="fa fa-search"></i></button>
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
            <a class="" href="{{ URL::to('/wishlist')}}">
              <div class="pro-header-right-options display-inline cart-left-wishlist" style="margin-right:10px !important">
                <i class="fas fa-heart font-1-5rem"></i>
                <span class="total_wishlist badge badge-secondary badge-wishlist-16-mobile">{{ $result['commonContent']['total_wishlist'] }}</span>
              </div><span class="header-16-wishlist-text">My Wishlist</span>
            </a>
                      
            @if($result['commonContent']['settings']['view_cart_button'] == 1)

            <ul class="pro-header-right-options header-25-mobile-cart-drop" id="resposive-header-cart" style="display:inline-block;vertical-align:bottom">
                @include('web.headers.cartButtons.cartButtonMobile25')
            </ul> 
            @endif
          </div>
          </div>
        </div>
      </div>



      <div class="bg-header-mobile-19 ">
        <div class="container" style="padding-left:5px !important;padding-right:5px !important;">
          <div class="row align-items-center">
            <div class="col-1 pr-0">
                <div class="navigation-mobile-container" style="margin-top:6px;">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler-12">
                      <span class="fas fa-bars"></span>
                  </a>
                </div>
            </div>
            <div class="col-11">
                  <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
                    <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                      <div class="head-19"><i class="fa fa-lightbulb-o"></i> &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                      </div>
                    </a>
                <?php } else {?>
                  <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                      <div class="head-19"><i class="fa fa-lightbulb-o "></i> &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
                    </div>
                  </a>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>
