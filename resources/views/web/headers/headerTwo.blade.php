<style>
  .search-field-module .dropdown-toggle {
padding: 0.8rem 0;
}
</style>
<!-- //header fixed -->
@include('web.headers.fixedHeader') 
<!-- //header style Two -->
<header id="headerTwo" class="header-area header-two header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4">
          
            <div class="navbar-lang">
                
              @if(count($languages) > 1)
              <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    {{-- <img src="{{asset('').session('language_image')}}" width="17px" /> --}}
                    {{	session('language_name')}}
                  </button>
                  <div class="dropdown-menu" >
                    @foreach($languages as $language)
                    <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item" href="#">
                      {{-- <img style="margin-left:10px; margin-right:10px;"src="{{asset('').$language->image_path}}" width="17px" /> --}}
                      {{$language->name}}
                    </a>
                   
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
                    <a onclick="myFunction2({{$currency->id}})" class="dropdown-item" href="#">
                      <span>{{$currency->code}}</span>    
                    </a>
                    @endforeach
                  </div>
                </div>
                @include('web.common.scripts.changeCurrency')
              @endif
              </div>
        </div>
        <div class="col-12 col-md-8">
          <ul class="link-list">
            <li class="">
              <div class="link-item">             
                <span>	<?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}}&nbsp;! <?php }?> </span>
              </div>
            </li>
            <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
              <li class="link-item"> <a href="{{url('profile')}}" >@lang('website.Profile')</a> </li>
              <li class="link-item"> <a href="{{url('wishlist')}}" >@lang('website.Wishlist') (<span class="total_wishlist">{{$result['commonContent']['total_wishlist']}}</span></a>) </li>
              <li class="link-item"> <a href="{{url('compare')}}" >@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
              <li class="link-item"> <a href="{{url('orders')}}" >@lang('website.Orders')</a> </li>
              <li class="link-item"> <a href="{{url('shipping-address')}}" >@lang('website.Shipping Address')</a> </li>
              <li class="link-item"> <a href="{{url('logout')}}">@lang('website.Logout')</a> </li>
              <?php }else{ ?>
                <li class="link-item" style="padding-bottom: 0.6rem;">

                <?php 
                  if($result['commonContent']['settings']['view_login_button'] == 1){
                  $loginID = DB::table('current_theme')->first();
                  if($loginID->login == 4) {
                ?>
                  <a class="login_modal" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else if($loginID->login == 5){ ?>
                  <a class="login_modal1" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')  
                <?php } else if($loginID->login == 6){ ?>
                  <a class="login_modal2" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')   
                <?php } else if($loginID->login == 7){ ?>
                  <a class="login_modal3" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register') 
                <?php } else if($loginID->login == 8){ ?>
                  <a class="login_modal4" style="cursor:pointer"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } else { ?>
                  <a href="{{ URL::to('/login')}}"> <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;@lang('website.Login/Register')
                <?php } }?>
              
                </a></li>
  
              <?php } ?>
          </ul> 
            
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
                    <img class="img-fluid logo_new_style_inner" src="{{$result['commonContent']['settings']['website_logo']}}"   alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @else
                    <img class="img-fluid logo_new_style_inner" src="{{asset('').$result['commonContent']['settings']['website_logo']}}"  alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
                @endif
            </a>
        </div>
        </div>
        <div class="col-12 col-sm-7 col-md-8 col-lg-6">      
          <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">   
            <div class="search-field-module search-field-module-s">   
                <input type="hidden" name="category" class="category-value" value="">
                @include('web.common.HeaderCategories')
              <button class="btn btn-secondary swipe-to-top dropdown-toggle header-selection" type="button" id="headerOneCartButton"  
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                data-toggle="" data-placement="bottom" title="@lang("website.Choose Any Category")"> 
                @lang("website.Choose Any Category")
              </button> 
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">   
                  @php    productCategories(); @endphp                                                                 
              </div>
              <div class="search-field-wrap">
                  <input  type="search" name="search" class="typeheads" placeholder="@lang('website.Search entire store here')..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                  <button class="btn btn-secondary swipe-to-top" data-toggle="" 
                  data-placement="bottom" title="@lang('website.Search Products')">
                  <i class="fa fa-search"></i></button>
                  <div class="search_outer_con">
                    <div id="viewsearchproduct"></div>
                  </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-12 col-sm-5 col-md-4 col-lg-3">
          <ul class="pro-header-right-options">
            <li>
              <a href="{{ URL::to('/wishlist')}}" class="btn" data-toggle="" data-placement="bottom" title="@lang('website.Wishlist')">
                <i class="far fa-heart"></i>
                <span class="badge badge-secondary total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>
              </a>
            </li>

            @if($result['commonContent']['settings']['view_cart_button'] == 1)

        
            <li class="dropdown head-cart-content">
              @include('web.headers.cartButtons.cartButton2')              
            </li>

            @endif
          </ul>
        </div>
      </div>
    </div>
  </div> 
  <div class="header-navbar bg-menu-bar">
    <div class="container">
    
      <nav id="navbar_header_1" class="navbar navbar-expand-lg  bg-nav-bar">
        <a class="navbar-brand home-icon btn-secondary swipe-to-top" href="{{url('/')}}" ><i class="fa fa-home"></i></a>
        
        <div class="navbar-collapse" >
          <ul class="navbar-nav">
            {!! $result['commonContent']["menusRecursive"] !!}
                <li class="nav-item ">
                  <a class="nav-link">
                      <span>@lang('website.hotline')</span>
                      {{$result['commonContent']['setting'][11]->value}}
                  </a>
                </li>
          </ul>
        </div>
      </nav>
   
    </div>
  </div>
</header>
