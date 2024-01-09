<input type="hidden" id="mobheadergetvalue" value="1"/>


<header id="headerMobile" class="header-area header-mobile d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar" style="min-height:0;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                @if(count($languages) > 1)
                
                <div class="select-control">
                  <select class="form-control" onchange="myFunction1(this.options[this.selectedIndex].value)" >
                    @foreach($languages as $language)
                    <option value="{{$language->languages_id}}" @if(Session::get('language_id')==$language->languages_id) selected @endif>{{$language->name}}</option>
                    @endforeach
                  </select>
                </div>
                @include('web.common.scripts.changeLanguage')
                @endif
                
                @if(count($currencies) > 1)
                <div class="select-control currency" >
                  <select class="form-control " onchange="myFunction2(this.options[this.selectedIndex].value)">
                    @foreach($currencies as $currency)
                  <option @if(session('currency_title')==$currency->code) selected @endif value="{{$currency->id}}">
                    
                    {{$currency->code}}
                      @if($currency->symbol_left != null)
                      ({{$currency->symbol_left}})</span>
                      @else
                      ({{$currency->symbol_right}})
                      @endif
                      
                    </option>
                    @endforeach
                  </select> 
                </div>
                @include('web.common.scripts.changeCurrency')
                @endif
                    <!-- END  Currency LANGUAGE CODE SECTION -->                
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-maxi bg-header-bar ">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-2 pr-0">
              <div class="navigation-mobile-container">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler">
                      <span class="fas fa-bars"></span>
                  </a>
                  <nav id="navigation-mobile">
                      <div class="logout-main">
                          <div class="welcome">
                            <span>	<?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                          </div>
                          @if(auth()->guard('customer')->check())
                          <div class="logout">
                              <a href="{{url('logout')}}" class="">@lang('website.Logout')</a>
                          </div>
                          @endif
                      </div>

                      {!! $result['commonContent']["menusRecursiveMobiles"] !!}
                     
                      <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                       <a href="{{url('profile')}}" class="main-manu btn btn-primary">@lang('website.Profile')</a>
                       <a href="{{url('wishlist')}}" class="main-manu btn btn-primary">@lang('website.Wishlist') <span class="common-color">(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</span></a>
                       <a href="{{url('compare')}}" class="main-manu btn btn-primary">@lang('website.Compare')&nbsp;(<span id="mobilecompare">{{$count}}</span>)</a>
                       <a href="{{url('orders')}}" class="main-manu btn btn-primary">@lang('website.Orders')</a>
                       <a href="{{url('shipping-address')}}" class="main-manu btn btn-primary">@lang('website.Shipping Address')</a>
                       <a href="{{url('logout')}}" class="main-manu btn btn-primary">@lang('website.Logout')</a>
                      <?php }else{ ?>
                        <div class="nav-link">@lang('website.Welcome')!</div>

                        <?php 
                          if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                               <a style="cursor:pointer" class="main-manu btn btn-primary login_modal" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                            <?php } else if($loginID->login == 5){ ?>
                               <a style="cursor:pointer" class="main-manu btn btn-primary login_modal1" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                            <?php } else if($loginID->login == 6){ ?>
                               <a style="cursor:pointer" class="main-manu btn btn-primary login_modal2" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                            <?php } else if($loginID->login == 7){ ?>
                               <a style="cursor:pointer" class="main-manu btn btn-primary login_modal3" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                            <?php } else if($loginID->login == 8){ ?>
                              <a style="cursor:pointer" class="main-manu btn btn-primary login_modal4" ><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                          <?php } else { ?>
                            <a href="{{ URL::to('/login')}}" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')</a>
                        <?php } } }?>

                  </nav>
              </div>

          </div>



          <div class="col-8">
          <div style="width:100px;margin:auto;">
            <a href="{{ URL::to('/')}}" class="logo">
              @if($result['commonContent']['settings']['sitename_logo']=='name')
              <?=stripslashes($result['commonContent']['settings']['website_name'])?>
              @endif

             @if($result['commonContent']['settings']['sitename_logo']=='logo')
                  <?php 
                  $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                  ?>
                  @if($imagepath->path_type == 'aws')
                    <img class="img-fluid" src="{{$result['commonContent']['settings']['website_logo']}}" style="width:100%;height:100%;object-fit:contain;" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @else
                    <img class="img-fluid" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" style="width:100%;height:100%;object-fit:contain;" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
                @endif
           </a>
          </div>
          </div>

          @if($result['commonContent']['settings']['view_cart_button'] == 1)

          <div class="col-2 pl-0">              
              <ul class="pro-header-right-options cart-sdropdown" id="resposive-header-cart">
                @include('web.headers.cartButtons.cartButton')
              </ul> 
          </div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('web.common.HeaderCategories2')
    <div class="header-navbar bg-menu-bar">
      <div class="container">
        <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
          <div class="search">
            <div class="select-control">
              <select class="form-control category_mobile_slug" name="category">
                <?php productCategories2(); ?>
              </select>
            </div>
            <input  type="search" name="search" class="typeheads_mobile" placeholder="@lang('website.Search entire store here')..."  value="{{ app('request')->input('search') }}">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search"></i></button>
            <div class="search_outer_con_mobile">
              <div id="viewsearchproduct_mobile"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
</header>
