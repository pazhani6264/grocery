<!-- //header style Five -->
@include('web.headers.fixedHeader') 
@include('web.common.HeaderCategories')

 <!-- //header style Five -->
 <header id="headerFive" class="header-area header-five header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_5" class="navbar navbar-expand-md navbar-dark navbar-0">
            
            <div class="navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <div class="nav-avatar nav-link">
                   <!--  <?php
                          if(auth()->guard('customer')->check()){
                            echo '<div class="avatar" style="background-color: lightgrey; text-align: center;">';
                            echo substr(auth()->guard('customer')->user()->first_name, 0, 1);
                            echo '</div>';
                          }
                      ?> -->
                      <span>	<?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
                  </div>
                </li>

                <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                  <li class="nav-item"> <a href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <li class="nav-item"> <a href="{{url('wishlist')}}" class="nav-link">@lang('website.Wishlist') (<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>)</a> </li>
                  <li class="nav-item"> <a href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                  <li class="nav-item"> <a href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item"> <a href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a href="{{url('logout')}}" class="nav-link padding-r0">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                    <li class="nav-item"><div class="nav-link">@lang('website.Welcome')!</div></li>
                    <li class="nav-item" style="padding-bottom: 0.6rem;"> 
                  

                    <?php 
                  if($result['commonContent']['settings']['view_login_button'] == 1){
                  $loginID = DB::table('current_theme')->first();
                  if($loginID->login == 4) {
                ?>
                  <a class="login_modal nav-link" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else if($loginID->login == 5){ ?>
                  <a class="login_modal1 nav-link" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')  
                <?php } else if($loginID->login == 6){ ?>
                  <a class="login_modal2 nav-link" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')   
                <?php } else if($loginID->login == 7){ ?>
                  <a class="login_modal3 nav-link" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register') 
                <?php } else if($loginID->login == 8){ ?>
                  <a class="login_modal4 nav-link" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else { ?>
                  <a class="nav-link" href="{{ URL::to('/login')}}"> <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
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
           
          <div class="col-12 col-sm-12 col-lg-4">
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
                    <img class="img-fluid logo_new_style_inner" src="{{$result['commonContent']['settings']['website_logo']}}"  alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @else
                    <img class="img-fluid logo_new_style_inner" src="{{asset('').$result['commonContent']['settings']['website_logo']}}"  alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
                @endif
              </a>
          </div>
          </div>
          <div class="col-12 col-sm-12 col-lg-8 navbar-option">
            @if(count($languages) > 1)
              <div class="country-flag">
                  <h4>@lang('website.Country')&nbsp;:&nbsp;
                    <ul>
                      @foreach($languages as $language)
                        <li><a onclick="myFunction1({{$language->languages_id}})" href="#"> @if($language->image_path_type == 'aws')
                            <img class="img-fluid" src="{{$language->image_path}}">
                            @else
                            <img class="img-fluid" src="{{asset('').$language->image_path}}">
                            @endif</a></li>
                      @endforeach

                    </ul>
                  </h4>  
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
                      <a onclick="myFunction2({{$currency->id}})" class="dropdown-item" href="#">{{$currency->code}}</a>
                    @endforeach
                    
                  </div>
                </div>
                @include('web.common.scripts.changeCurrency')
                @endif 
                <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">
                  <div class="search-field-module">   
                    <div class="search-field-wrap">
                    <input type="hidden" name="category" class="category-value" value="">
                        <input name="search" type="search" class="typeheads" placeholder="@lang('website.Search Products')" data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                        <button class="btn btn-secondary swipe-to-top" data-toggle="" 
                        data-placement="bottom" title="@lang('website.Search Products')">
                        <i class="fa fa-search"></i></button>
                        <div class="search_outer_con">
                          <div id="viewsearchproduct"></div>
                        </div>
                    </div>
                  </div>
                </form>
                <div class="phone-header">
                    <a href="tel:{{$result['commonContent']['setting'][11]->value}}">
                        <i class="fas fa-phone common-hover"></i>
                        <span class="block">
                          <span class="title">@lang('website.Call Us Now')</span>                    
                          <span class="items common-text" dir="ltr">{{$result['commonContent']['setting'][11]->value}}</span>
                        </span>                   
                    </a>
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
              {!! $result['commonContent']["menusRecursive"] !!}
              @if($result['commonContent']['settings']['view_cart_button'] == 1)

              <li class="nav-item">
                <ul class="pro-header-right-options">
                  <li class="dropdown head-cart-content">
                    @include('web.headers.cartButtons.cartButton5')     
                  </li>
                </ul>
              </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
  </div>
</header>
