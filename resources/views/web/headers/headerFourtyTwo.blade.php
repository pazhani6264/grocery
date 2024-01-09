<style>
  .header-twele .header-navbar nav .navbar-collapse ul li:last-child {
position: relative;
left: 0;
margin-right: 0;
}
.button-two:hover span {
    padding-left: 0 !important;
}
.quick-fill:hover
{
  fill: #fff !important;
}
.active-menu-13 {
    border-bottom: 3px solid !important;
}
.pagination {
    background-color: #fff;
    border: 0px solid #ced4da !important;
    border-radius: 0;
    padding: 2px 15px;
    margin-top: 30px;
    width: 100%;
    text-align: right;
    margin-bottom: 40px;
}
.product9.product article .content .tag {
    -webkit-box-align: start;
    display: none;
}
.product4.product article .content {
    padding-bottom: 48px;
    background: #fff;
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
.color-fill-hover:hover
{
fill: #fff !important;
}
.hover-menu-13:before {
    bottom: 0;
    display: block;
    height: 3px;
    width: 0%;
    content: "";
    
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
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 1rem;
    color: #333;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    line-height: normal;
    padding: 1.2rem 20px 1.2rem 5px;
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
.special-carousel-js8 .demo-16-bg-con {
    background-color: #fafafa !important;
}
.special-carousel-js8  .btn-29 {
    padding: 7px;
    width: 100%;
    background-color: #fafafa ;
    color: #333;
    padding: 12px;
}
.special-carousel-js8  .btn-29:hover {
   
    color: #fff;
   
}
.demo-16-bg-con
   {
    background-color: #fff !important;
   }
   .button-two:hover span:after {
opacity: 0 !important;
left: 0;
}
   .btn-29 {
    padding: 7px;
    width: 100%;
    background-color: #fff !important;
    color: #333;
    padding: 12px;
}
.swipe-to-top {
    transition-duration: unset;
}
.button-two {
    background-color: #d35400;
    border: none;
    transition: unset;
}
.container {
    width: 1200px !important;
    max-width: 100% !important;
}
.demo-16-desc2
{
  font-weight: 400;
  margin-bottom: 30px !important;
  font-size: 50px;
}

.demo-16-desc1 {
    margin-bottom: 0px !important;
}

@media only screen and (max-width: 1024px) and (min-width: 800px){

  .search-icon-16{
    color:#000 !important;
  }
}
@media only screen and (max-width: 992px){

.badge-wishlist-16-mobile {
    position: absolute;
    right: auto;
    left: 15px;
    top: -2px;
    height: 15px;
    /* border-radius: 50px; */
    min-width: 15px;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
}

}
@media only screen and (max-width: 374px){

.demo-16-wish-mnone {
 display: none
}

}
</style>


<!-- //header style Twele -->
@include('web.headers.fixedHeader19') 
<header id="headerTwele" class="header-11-search header-area header-twele  header-desktop d-none d-lg-block d-xl-block">
<!-- <div class="header-mini bg-top-bar-19">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <nav id="navbar_0_6" class="navbar navbar-expand-md navbar-dark navbar-0">

            <ul class="navbar-nav">
              <li class="nav-item mr-20">
                <a class="color-16-top" href="tel:{{$result['commonContent']['setting'][11]->value}}">
                  <i class="fa fa-phone"></i>&nbsp;&nbsp;CALL : {{$result['commonContent']['setting'][11]->value}}</li>
                </a>
              </li>
            </ul>

                           
            <div class="navbar-collapse">
            <ul class="navbar-nav">
                <a target="_blank" href="{{$result['commonContent']['setting'][50]->value}}"><li class="color-16-top"><i class="fa fa-facebook mr-20 font-size-1rem"></i></li></a>
                <a target="_blank" href="{{$result['commonContent']['setting'][52]->value}}"><li class="color-16-top"><i class="fa fa-twitter mr-20 font-size-1rem"></i></li></a>
                <a target="_blank" href="{{$result['commonContent']['setting'][51]->value}}"><li class="color-16-top"><i class="fa fa-google mr-20 font-size-1rem"></i></li></a>
                <a target="_blank" href="{{$result['commonContent']['setting'][53]->value}}"><li class="color-16-top"><i class="fa fa-linkedin mr-20 font-size-1rem"></i></li></a>

                <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('profile')}}" class="nav-link">@lang('website.Profile')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('compare')}}" class="nav-link">@lang('website.Compare')&nbsp;(<span id="compare">{{$count}}</span>)</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('orders')}}" class="nav-link">@lang('website.Orders')</a> </li>
                  <li class="nav-item mr-20"> <a class="color-16-top" href="{{url('shipping-address')}}" class="nav-link">@lang('website.Shipping Address')</a> </li>
                  <li class="nav-item"> <a class="color-16-top" href="{{url('logout')}}" class="nav-link">@lang('website.Logout')</a> </li>
                  <?php }else{ ?>
                                        
                 

                    <?php 
                    if($result['commonContent']['settings']['view_login_button'] == 1){
                      $loginID = DB::table('current_theme')->first();
                      if($loginID->login == 4) {
                    ?>
                       <li class="nav-item login_modal" style="margin-left:20px;"> <a class="color-16-top"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li>   
                    <?php } else if($loginID->login == 5){ ?>
                      <li class="nav-item login_modal1" style="margin-left:20px;"> <a class="color-16-top"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li>  
                    <?php } else if($loginID->login == 6){ ?>
                      <li class="nav-item login_modal2" style="margin-left:20px;"> <a class="color-16-top"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li>     
                    <?php } else if($loginID->login == 7){ ?>
                      <li class="nav-item login_modal3" style="margin-left:20px;"> <a class="color-16-top"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li> 
                    <?php } else if($loginID->login == 8){ ?>
                       <li class="nav-item login_modal4" style="margin-left:20px;"> <a class="color-16-top"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li>     
                    <?php } else { ?>
                       <li class="nav-item" style="margin-left:20px;"> <a class="color-16-top" href="{{ URL::to('/login')}}"><i class="fa fa-user-o"></i>&nbsp;@lang('website.Login')</a> </li>     
                    <?php }  } }?>

              </ul> 

              <div class="navbar-lang">
                @if(count($languages) > 1)
                  <div class="dropdown" style="margin-right:0px;margin-left:30px;">
                      <button class="btn dropdown-toggle color-16-top" type="button" >
                        {{	session('language_name')}}
                      </button>
                      <div class="dropdown-menu" >
                        @foreach($languages as $language)
                        <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item" href="#">                      
                          {{$language->name}}
                        </a>                   
                        @endforeach                   
                      </div>
                  </div> 
                
                  @include('web.common.scripts.changeLanguage')
                @endif
                @if(count($currencies) > 1)
                  <div class="dropdown" style="margin-right:0px;margin-left:20px;">
                    <button class="btn dropdown-toggle color-16-top" type="button" style="padding: 8px 0px 10px 8px!important;">
                      {{session('currency_code')}}
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
              </div>  
            </div>   
          </nav>
        </div>
      </div>
    </div> 
  </div> -->


  <div class="header-maxi  bg-header-bar header-maxi-twele" style="height:85px">
    <div class="container">
      <div class="row align-items-center">
  
        <div class="col-12 col-sm-5">
          <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get">
            <div class="search-16-main">
              <button type="submit" class="serach-16-main-left common-fill-hover fill-search" style="padding:0px;background:none;border:none">
                  
                    <svg id="search" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 27 27" class="search-icon-16 icon-font-16">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                  </button>
                <input type="hidden" class="category-value" name="categories_id" value="" /> 
                <div class="serach-16-main-right">
                    <input autocomplete="off" required name="search"  type="text" value="{{ app('request')->input('search') }}" class="cus-input-style-16 typeheads" placeholder="Search Product ...."/>
                      <div class="search_outer_con">
                        <div id="viewsearchproduct"></div>
                      </div>
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
                <div class="col-md-12" style="text-align:right;padding-right:0px">
               
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
                      <g id="wishlist" transform="translate(0 -36.545)" >
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                      <span class="total_wishlist badge badge-secondary badge-wishlist-33">{{ $result['commonContent']['total_wishlist'] }}</span><span class="header-16-wishlist-text">My Wishlist</span>
                    </div>
                  </a>
                
                  @if($result['commonContent']['settings']['view_cart_button'] == 1)

                  <ul class="pro-header-right-options display-inline header-25-cart-drop common-hover common-fill-hover fill-search">
                    <li class="dropdown head-cart-content" style="float:none;">
                      @include('web.headers.cartButtons.cartButton42')
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
  <div class="container">
      <div class="row align-items-center nav-twele-top" style="margin:0">
        <div class="col-12 col-sm-8" style="padding-left:0px">
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
                  <li class="nav-item dropdown menu-active-13-{{ $menuactive }} hover-menu-13">
                    <a class="nav-link common-fill-hover fill-down-color font-500" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg><?php } ?></a>
                   
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
                            {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
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

                  <li class="nav-item dropdown  hover-menu-13">
                    <a style="white-space:nowrap" class="nav-link common-fill-hover fill-down-color font-500" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                          <a class="dropdown-item common-fill-hover fill-down-color"  <?php echo $link; ?>>
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

        <div class="col-12 col-sm-4" style="padding-right:0px">

          <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
           
                <div class="head-19"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 49.479 49.99">
  <path id="bulb" d="M419.721-12930.74v-3.085h3.059v3.085Zm6.119-3.085H413.606v-14.293a16.819,16.819,0,0,1-8.924-17.935,16.742,16.742,0,0,1,12.96-13.479,16.84,16.84,0,0,1,20.431,16.446,16.822,16.822,0,0,1-9.175,14.971v14.289Zm-9.178-3.06h9.178v-3.056h-9.178Zm1.606-39.652a13.655,13.655,0,0,0-10.569,11,13.821,13.821,0,0,0,8.047,15.052l.915.4v7.082h9.178v-7.082l.915-.4a13.767,13.767,0,0,0,8.259-12.6,13.754,13.754,0,0,0-13.785-13.762A14.421,14.421,0,0,0,418.268-12976.537Zm15.993,28.3,2.238-2.088,3.352,3.795-2.235,2.085Zm-31.544,1.538,3.388-3.405,2.163,2.16-3.392,3.405Zm38.415-14.86v-3.059h4.962v3.059Zm-44.517,0v-3.059h4.753v3.059Zm39.073-15.608,3.675-3.489,2.046,2.273-3.675,3.489Zm-33.991-1.326,2.085-2.238,3.392,3.277-2.085,2.238Z" transform="translate(-396.615 12980.73)"/>
</svg>  &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
             
          <?php } else {?>
           
                <div class="head-19"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 49.479 49.99">
  <path id="bulb" d="M419.721-12930.74v-3.085h3.059v3.085Zm6.119-3.085H413.606v-14.293a16.819,16.819,0,0,1-8.924-17.935,16.742,16.742,0,0,1,12.96-13.479,16.84,16.84,0,0,1,20.431,16.446,16.822,16.822,0,0,1-9.175,14.971v14.289Zm-9.178-3.06h9.178v-3.056h-9.178Zm1.606-39.652a13.655,13.655,0,0,0-10.569,11,13.821,13.821,0,0,0,8.047,15.052l.915.4v7.082h9.178v-7.082l.915-.4a13.767,13.767,0,0,0,8.259-12.6,13.754,13.754,0,0,0-13.785-13.762A14.421,14.421,0,0,0,418.268-12976.537Zm15.993,28.3,2.238-2.088,3.352,3.795-2.235,2.085Zm-31.544,1.538,3.388-3.405,2.163,2.16-3.392,3.405Zm38.415-14.86v-3.059h4.962v3.059Zm-44.517,0v-3.059h4.753v3.059Zm39.073-15.608,3.675-3.489,2.046,2.273-3.675,3.489Zm-33.991-1.326,2.085-2.238,3.392,3.277-2.085,2.238Z" transform="translate(-396.615 12980.73)"/>
</svg>  &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
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

