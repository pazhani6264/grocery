@include('web.headers.fixedHeader') 
@include('web.common.HeaderCategories')
<header id="headerEight" class="header-area header-eight  header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          
          <nav id="navbar_0_8" class="navbar navbar-expand-md navbar-dark navbar-0">
            <div class="navbar-lang">
              @if(count($languages) > 1)
              <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    {{session('language_name')}}
                  </button>
                  <div class="dropdown-menu" >
                    @foreach($languages as $language)
                      <a class="dropdown-item" onclick="myFunction1({{$language->languages_id}})" href="#">
                        {{$language->name}}</a>
                    @endforeach 
                    
                  </div>
                </div> 
                @include('web.common.scripts.changeLanguage')
                @endif 
                @if(count($currencies) > 1) 
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" >
                      {{session('currency_code')}}
                    </button>
                    <div class="dropdown-menu">
                      @foreach($currencies as $currency)
                        <a class="dropdown-item" onclick="myFunction2({{$currency->id}})" class="dropdown-item" href="#">{{$currency->code}}</a>
                      @endforeach
                      
                    </div>
                  </div>
                  @include('web.common.scripts.changeCurrency')
                  @endif 
                </div>               
            
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <div class="nav-avatar nav-link">
                      
                     <!--  <?php
                          if(auth()->guard('customer')->check()){
                            echo '<div class="avatar">';
                            echo substr(auth()->guard('customer')->user()->first_name, 0, 1);
                            echo '</div>';
                          }
                      ?>    -->                   
                      
                      <span>	<?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;!<?php }?> </span>
                    </div>
                  </li>
                  <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                    <li class="nav-item"> <a href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                    <li class="nav-item"> <a href="{{url('wishlist')}}" class="nav-link">@lang('website.Wishlist')(<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</a> </li>
                    <li class="nav-item"> <a href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                    <li class="nav-item"> <a href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                    <li class="nav-item"> <a href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                    <li class="nav-item"> <a href="{{url('logout')}}" class="nav-link padding-r0">@lang('website.Logout')</a> </li>
                    <?php }else{ ?>
                      <li class="nav-item"><div class="nav-link">@lang('website.Welcome') @lang('website.User')!</div></li>
                      <li class="nav-item" style="padding-bottom: 0.6rem;"> 
                    
                      <?php 
                  if($result['commonContent']['settings']['view_login_button'] == 1){
                  $loginID = DB::table('current_theme')->first();
                  if($loginID->login == 4) {
                ?>
                  <a class="login_modal nav-link -before" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else if($loginID->login == 5){ ?>
                  <a class="login_modal1 nav-link -before" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')  
                <?php } else if($loginID->login == 6){ ?>
                  <a class="login_modal2 nav-link -before" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')   
                <?php } else if($loginID->login == 7){ ?>
                  <a class="login_modal3 nav-link -before" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register') 
                <?php } else if($loginID->login == 8){ ?>
                  <a class="login_modal4 nav-link -before" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else { ?>
                  <a class="nav-link -before" href="{{ URL::to('/login')}}"> <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } }?>

                    </a> </li>                      
                    <?php } ?>

                </ul> 
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div>
  <div class="header-maxi bg-header-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-12 col-lg-3">
        <div class="logo_new_style_outer">
          <a href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
            @if($result['commonContent']['settings']['sitename_logo']=='name')
            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
            @endif
        
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
                  <?php 
                  $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                  ?>
                  @if($imagepath->path_type == 'aws')
                    <img class="img-fluid logo_new_style_inner" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @else
                    <img class="img-fluid logo_new_style_inner" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
                @endif
            </a>
        </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4 col-lg-9">
          <ul class="pro-header-right-options">
            <li class="phone-header">
              <a href="tel:{{$result['commonContent']['setting'][11]->value}}">
                  <i class="fas fa-phone"></i>
                  <span class="block">
                    <span class="title">@lang('website.Call Us Now')</span>                    
                    <span class="items" dir="ltr">{{$result['commonContent']['setting'][11]->value}}</span>
                  </span>                   
              </a>
            </li>
            @if($result['commonContent']['settings']['view_cart_button'] == 1)

            <li class="dropdown head-cart-content">
              @include('web.headers.cartButtons.cartButton8') 
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div> 
  <div class="header-navbar bg-menu-bar">
      <div class="container">
        <nav id="navbar_header_9" class="navbar navbar-expand-lg  bg-nav-bar">
    
          <div class="navbar-collapse" >
            <ul class="navbar-nav">
              {!! $result['commonContent']["menusRecursive"] !!}               
              <li class="nav-item">
              
                <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
                <input type="hidden" name="category" class="category-value" value="">
                  <div class="search-field-module">          
                    <div class="search-field-wrap">
                        <input  type="text" name="search" class="typeheads" placeholder="@lang('website.Search entire store here')..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}" style="width:250px;">
                        <button class="btn btn-light swipe-to-top" data-toggle="" 
                        data-placement="bottom" title="@lang('website.Search Products')">
                        <i class="fa fa-search"></i></button>
                        <div class="search_outer_con">
                      <div id="viewsearchproduct"></div>
                    </div>
                    </div>
                  </div>
                </form>
                  </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
</header>