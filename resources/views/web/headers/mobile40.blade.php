
<style>
@media only screen and (max-width: 992px)
{
#headerMobile40 .site-header__logo a {
    width: 140px;
}
#headerMobile40 .badge-cart-33 {
    right: -27px !important;
    top: -40px !important;
}
#headerMobile40 .img-mobile
{
    height: 100%;
    width: 100%;
    object-fit:contain;

}

#headerMobile40 .search_outer_con_mobile_fixed_40 {
    width: 100%;
    margin-top: 5px !important;
}

#headerMobile40  .search_outer_con_mobile_fixed_40 {
    left: 0px !important;
    top: 35px !important;
}
#headerMobile40 .enable_search {
    display: block !important;
}
#headerMobile40  .search_outer_con_mobile_fixed_40 {
    position: absolute;
    z-index: 100;
    background: #fff;
    top: 45px;
    width: 250px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    min-width: 10rem;
    padding: 0.5rem 0.5rem;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    color: #111;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
}
#headerMobile40 .bg-header-bar-mobile-40  {
  background-color: #ededed !important;
}
.site-header__logo {
  margin-left: 10px;
}
#toggle-container {
 background-color: #222;
 border: 0px dashed #999;
 position: fixed;
 bottom: 0;
 width: 100%;
}

#menu-40 {
 color: #999;
 line-height: 30px;
 list-style: none;
 margin: auto;
 padding: 10px;
 text-align: center;
 display: none;
  position: absolute;
  top: 1px;
  width: 100%;
  max-height: 95vh;
  padding: 0 !important;
  overflow-y: auto;
  background-color: #fff;
  color: #000;
  box-shadow: 0 10px 25px #00000026;
  z-index: 100;
  top:62px;
 
    transform: translateY(0%);
  /* transform: translateY(20%); */
}

#toggle40 {
 background-color: rgba(0, 0, 0, 0);
 border: 0px solid rgba(0, 0, 0, 0);
 cursor: pointer;
 height: inherit;
 margin: 20px 10px;
 width: 24px;
}

#toggle40 .one {
 -webkit-backface-visibility: hidden;
 backface-visibility: hidden;
 background-color: #000;
 height: 3px;
 margin:5px auto;
 -webkit-transition: all 0.3s;
 transition: all 0.3s;
 width: 100%;
}
#toggle40 .two {
 -webkit-backface-visibility: hidden;
 backface-visibility: hidden;
 background-color: #000;
 height: 3px;
 margin: 5px 0;
 -webkit-transition: all 0.3s;
 transition: all 0.3s;
 width: 75%;
}
#toggle40 .three {
 -webkit-backface-visibility: hidden;
 backface-visibility: hidden;
 background-color: #000;
 height: 3px;
 margin: 5px auto;
 -webkit-transition: all 0.3s;
 transition: all 0.3s;
 width: 100%;
}

#toggle40.on .one {
 -ms-transform: rotate(45deg) translate(2px, 3px);
 -webkit-transform: rotate(45deg) translate(2px, 3px);
 transform: rotate(45deg) transform-origin: 20% 40%;
}

#toggle40.on .two {
 opacity: 0;
}

#toggle40.on .three {
 -ms-transform: rotate(-45deg) translate(7px, -10px);
 -webkit-transform: rotate(-45deg) translate(7px, -10px);
 transform: rotate(-45deg) translate(7px, -10px);
}
#headerMobile40 .container
{
  position: relative;
}
#headerMobile40 .search-button-40 {
    position: absolute !important;
    right: 5px;
    top: 0;
    bottom: 0;
    height: 100%;
    width: 45px;
    padding: 0;
    border-radius: 50px;
    background: #fff;
    border-color: #fff;
    color: #333;
    font-size: 22px;
}
#headerMobile40 .search-field-module .search-field-wrap40 input {
    float: left;
    padding: 0px 50px 0 32px;
    height: 36px;
    width: 100%;
    border-radius: 0;
    border: none;
    outline: none !important;
    background-color: #fff;
}
#headerMobile40 .search-field-module .search-field-wrap40 {
    float: left;
    width: 100%;
    height: 36px;
}
#headerMobile40 .search-40 {
    border-radius: 50px !important;
    float: left;
    padding: 0px 20px 1px 10px !important;
    height: 37px;
    width: 100%;
    border-radius: 0;
    border: none;
    outline: none !important;
    font-size: 14px;
}
#headerMobile40 .search-field-module {
    position: relative;
    background-color: #fff;
    border: none;
    box-shadow: none;
    width: 100%;
}
#headerMobile40 .form-40 {
  max-width:100%;
  margin: 5px 15px 20px 15px;
}
#headerMobile40 .search_outer_con_mobile {
    width: 100%;
    margin-top:5px;
}



}
</style>
<input type="hidden" id="mobheadergetvalue" value="40"/>


<header id="headerMobile40" class="header-area header-mobile d-lg-none header-mobile-12 d-xl-none">
  <div class="bg-header-bar-mobile-40 ">
    <div class="container">
      <div class="row main-con-fixed-outer">
        <div class="col-6">
          <h1 class="site-header__logo">
              <span class="visually-hidden">@if($result['commonContent']['settings']['sitename_logo']=='name')
                  <?=stripslashes($result['commonContent']['settings']['website_name'])?>
                  @endif</span>
            
            <a href="/" class="site-header__logo-link logo--has-inverted">
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
            <img class="small--hide img-mobile" src="{{asset($result['commonContent']['settings']['website_logo'])}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>"> 
                  @endif
            
            </a>
              </a>
          </h1>
        </div>
       
        <div class="col-6" style="padding-right: 8px !important;">
        <div class="row" style="justify-content:flex-end;margin:0;">
        <div class="search-mobile-40-click-hide">
        <div class="btn common-hover" data-toggle="" data-placement="bottom" title="" style="font-size: 21px;display: inline-block;padding: 13px 7px;">
                   <svg aria-hidden="true" focusable="false" height="27" width="27" role="presentation" class="icon icon-search" viewBox="0 0 64 64"><defs></defs><path class="cls-1" d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42" fill="#000"></path></svg></div>
        </div>

        @if($result['commonContent']['settings']['view_cart_button'] == 1)

        <div class="cart-40-mobile">

        <div style="display:inline-block">
        <ul class="pro-header-right-options header-12-mobile-cart-drop" id="resposive-header-cart" style="margin:0;">
                  @include('web.headers.cartButtons.cartButtonMobile40')
          </div>
          </div>

          @endif
          <div class="" style="margin-right:0px;">
          <div style="display:inline-block">
            <div id="toggle40-container">
              
              <div id="toggle40">
              <div class="one"></div>
              <div class="two"></div>
              <div class="three"></div>
              </div>

                </div>
          </div>
        </div>
        </div>
        </div>

        <div id="menu-40">

          <div id="mobile-40-multilevel">
     
              <ul class="nav_40" style="padding-top:10px;">

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
                        foreach ($items as $item) {
                          $newlink = '';
                          if ($item->type == 0) {
                             $link = ' target="_blank" href="' . $item->link . '"';
                      $menuactive = '';
                          } elseif ($item->type == 1) {
                              if($item->link == '/'){
                                  $link = ' href="' . url(''). $item->link . '"';
                                  $newlink = '"'.url(''). $item->link.'"';
                                  $menuactive = 'home';
                              }else{
                                  $link = ' href="' . url(''). '/' .$item->link . '"';
                                  $newlink = '"'.url(''). '/' . $item->link.'"';
                                  $menuactive = $item->link;
                              }
                          } elseif ($item->type == 2) {
                              $link = ' href="' . url('page?name=') . $item->link . '"';
                              $newlink = '"'.url('page?name=') . $item->link .'"';
                              $menuactive = $item->link;
                          } elseif ($item->type == 3) {
                              $link = ' href="' . url('shop?category=') . $item->link . '"';
                              $newlink = '"'.url('shop?category=') . $item->link .'"';
                              $menuactive = $item->link;
                          } elseif ($item->type == 4) {
                              $link = ' href="' . url('product-detail')  .'/'.  $item->link . '"';
                              $newlink = '"'.url('product-detail')  .'/'.  $item->link .'"';
                              $menuactive = $item->link;
                          } elseif ($item->type == 5) {
                              $link = ' href="' . url('') . '/' . $item->link . '"';
                              $newlink = '"'.url('') . '/' . $item->link .'"';
                              $menuactive = $item->link;
                          }else{
                              $link = '#';
                              $newlink = '';
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

                      <li class="nav__item_40" <?php if ($childs->isNotEmpty()) { ?>  <?php }   else { ?>onclick="getloadpage_40({{$newlink}})"<?php } ?>>
                        <a class="nav__link_40"  <?php echo $link; ?>>{{ $item->name }}<?php if ($childs->isNotEmpty()) { ?> <i class="fas fa-chevron-right"></i><?php }   else { ?><?php } ?></a>
                        <?php if ($childs->isNotEmpty()) { ?>
                          <ul class="nav__sub_40">
                          <li class="nav__item_40"><a class="nav__link_40 nav__link_40_sub sub__close_40" href="#"><i class="fas fa-chevron-left nav_40_close_pos"></i> <span class="back_40">{{ $item->name }}</span></a></li>
                            <?php                       
                              foreach ($childs as $child) {

                                if ($child->type == 0) {
                                    $sublink = ' target="_blank" href="' . $child->link . '"';
                                    $newsublink = '"' . $child->link . '"';
                                } elseif ($child->type == 1) {
                                    $sublink = ' href="' . url($child->link) . '"';
                                    $newsublink = '"' . url($child->link) . '"';
                                } elseif ($child->type == 2) {
                                    $sublink = ' href="' . url('page?name=') . $child->link . '"';
                                    $newsublink = '"' . url('page?name=') . $child->link . '"';
                                } elseif ($child->type == 3) {
                                    $sublink = ' href="' . url('shop?category=') . $child->link . '"';
                                    $newsublink = ' "' . url('shop?category=') . $child->link . '"';
                                } elseif ($child->type == 4) {
                                    $sublink = ' href="' . url('product-detail')  .'/'.  $child->link . '"';
                                    $newsublink = ' "' . url('product-detail')  .'/'.  $child->link . '"';
                                } elseif ($child->type == 5) {
                                    $sublink = ' href="' . url('') . $child->link . '"';
                                    $newsublink = ' "' . url('') . $child->link . '"';
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
                            <li class="nav__item_40" <?php if ($childs1->isNotEmpty()) { ?>  <?php }   else { ?>onclick="getloadpage_40({{$newsublink}})"<?php } ?>>
                            <a class="nav__link_40"  <?php echo $sublink; ?>>
                              {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?> <i class="fas fa-chevron-right"></i><?php }   else { ?><?php } ?></a>


                              <?php 
                                  if ($childs1->isNotEmpty()) { 
                                ?>
                                <ul class="nav__sub_40">
                                <li class="nav__item_40"><a class="nav__link_40 nav__link_40_sub sub__close_40" href="#"><i class="fas fa-chevron-left nav_40_close_pos"></i> <span class="back_40">{{ $child->name }}</span></a></li>
                                  <?php
                                      foreach ($childs1 as $child1) {

                                      if ($child1->type == 0) {
                                          $sublink1 = ' target="_blank" href="' . $child1->link . '"';
                                          $newsublink1 = ' "' . $child1->link . '"';
                                      } elseif ($child1->type == 1) {
                                          $sublink1 = ' href="' . url($child1->link) . '"';
                                          $newsublink1 = ' "' . url($child1->link) . '"';
                                      } elseif ($child1->type == 2) {
                                          $sublink1 = ' href="' . url('page?name=') . $child1->link . '"';
                                          $newsublink1 = ' "' . url('page?name=') . $child1->link . '"';
                                      } elseif ($child1->type == 3) {
                                          $sublink1 = ' href="' . url('shop?category=') . $child1->link . '"';
                                          $newsublink1 = ' "' . url('shop?category=') . $child1->link . '"';
                                      } elseif ($child1->type == 4) {
                                          $sublink1 = ' href="' . url('product-detail') .'/'. $child1->link . '"';
                                          $newsublink1 = '"' . url('product-detail') .'/'. $child1->link . '"';
                                      } elseif ($child1->type == 5) {
                                          $sublink1 = ' href="' . url('') . $child1->link . '"';
                                          $newsublink1 = '"' . url('') . $child1->link . '"';
                                      }
                                  ?>
                                    <li class="nav__item_40" onclick="getloadpage_40({{$newsublink1}})">
                                      <a class="nav__link_40" <?php echo $sublink1; ?>>{{ $child1->name }}</a>
                                    </li>
                                      <?php } ?>

                                        </ul>
                                    
                                  <?php } ?>
                                   
                                        </li>
                                  <?php } ?>
                                        </ul>
                              <?php } ?>

                              </li>
                            <?php } ?>
                            </li>
                      <?php } ?>



                </ul>

          </div>
          <div id="mobile-footer-toogle-40">

            <div class="footer__block_40" data-type="menu_40"><div class="footer__title">Other Pages
            </div>

            <ul class="footer__menu_40">
            @if(count($result['commonContent']['pages']))
              @foreach($result['commonContent']['pages'] as $page)
                  <li> <a href="{{ URL::to('/page?name='.$page->slug)}}" data-toggle="" data-placement="left" title="{{$page->name}}">{{$page->name}}</a> </li>
              @endforeach
            @endif
            <?php $zippage = DB::table('zippages')->where('status',1)->get();  ?>
            @if(count($zippage)>0)
              @foreach ($zippage as  $key=>$zip)
              <li> <a href="{{ URL::to($zip->link)}}" target="_blank" data-toggle="" data-placement="left" title="{{$zip->name}}">{{$zip->name}}</a> </li>
              @endforeach
            @endif
            
            <li> <a href="{{ URL::to('/contact')}}"  data-toggle="" data-placement="left" title="@lang('website.Contact Us')">@lang('website.Contact Us')</a> </li>
            
              <?php if(auth()->guard('customer')->check() &&  auth()->guard('customer')->user()->phone_verified== '1'){ ?>
              <li><a href="{{url('profile')}}">My account</a></li>
              <?php }else{ ?>
                

                <?php 
                if($result['commonContent']['settings']['view_login_button'] == 1){
                            $loginID = DB::table('current_theme')->first();
                            if($loginID->login == 4) { 
                            ?>
                              <li><a class="login_modal">My account</a></li>
                            <?php } else if($loginID->login == 5){ ?>
                              <li><a class="login_modal1">My account</a></li>
                            <?php } else if($loginID->login == 6){ ?>
                              <li><a class="login_modal2">My account</a></li>
                            <?php } else if($loginID->login == 7){ ?>
                              <li><a class="login_modal3">My account</a></li>
                            <?php } else if($loginID->login == 8){ ?>
                              <li><a class="login_modal4">My account</a></li>
                          <?php } else { ?>
                            <li><a href="{{ URL::to('/login')}}">My account</a></li>            
                        <?php } } }?> 
            </ul>
          </div>
          </div>

          <div class="footer__mobile-section">
  <div class="footer__blocks--mobile">
    <div class="footer__block--mobile">
      <div class="footer__title">
        Get in touch
      </div>

      <ul class="footer__menu footer__menu--underline"><li> <a href="tel:{{$result['commonContent']['setting'][11]->value}}">
            <span class="icon-and-text">
              <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-phone" viewBox="0 0 64 64"><defs><style>.a{fill:none;stroke:#000;stroke-width:5px}</style></defs><path class="a" d="M18.4 9.65l10.2 10.2-6.32 6.32c2.1 7 6.89 12.46 15.55 15.55l6.32-6.32 10.2 10.2-8.75 8.75C25.71 50.3 13.83 38.21 9.65 18.4z"></path></svg>
              <span>{{$result['commonContent']['setting'][11]->value}}</span>
            </span>
          </a></li><li><a href="{{ URL::to('/contact')}}">
            <span class="icon-and-text">
              <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-email" viewBox="0 0 64 64"><defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:5px}</style></defs><path class="cls-1" d="M63 52H1V12h62zM1 12l25.68 24h9.72L63 12M21.82 31.68L1.56 51.16m60.78.78L41.27 31.68"></path></svg>
              <span>Email us</span>
            </span>
          </a></li></ul>
    </div><div class="footer__block--mobile">
        <div class="footer__title">
          Follow us
        </div>
        <ul class="no-bullets footer__social"><li>
        @if(!empty($result['commonContent']['setting'][52]->value))
                      <a href="{{$result['commonContent']['setting'][52]->value}}"  class="fab tw fa-twitter" target="_blank"></a>
                  @else
                      <a href="#" class="fab tw fa-twitter" ></a>
                  @endif
               
                <span class="icon__fallback-text">Instagram</span>
              </a>
            </li><li>
              
              @if(!empty($result['commonContent']['setting'][50]->value))
                      <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f" target="_blank"></a>
                  @else
                  <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fb fa-facebook-f"></a>
                  @endif
               
                <span class="icon__fallback-text">Facebook</span>
              </a>
            </li><li>
            @if(!empty($result['commonContent']['setting'][51]->value))
                      <a href="{{$result['commonContent']['setting'][51]->value}}" class="fab sgo fa-google" target="_blank" ></a>
                  @else
                      <a href="#"><i class="fab sgo fa-google" ></i></a>
                  @endif
               
                <span class="icon__fallback-text">YouTube</span>
              </a>
            </li><li>
            @if(!empty($result['commonContent']['setting'][53]->value))
                          <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab sln fa-linkedin-in" target="_blank"></a>
                      @else
                          <a href="#" class="fab sln fa-linkedin-in"></a>
                      @endif
                
                <span class="icon__fallback-text">LinkedIn</span>
              </a>
            </li></ul>
      </div></div>


<div class="footer__block" data-type="menu"><div class="footer__title">Terms and Policies
</div>

<ul class="footer__menu">
  <li><a href="{{url('/page?name=term-services')}}">Terms of Service</a></li>
  <li><a href="{{url('/page?name=refund-policy')}}">Shipping Policy</a></li>
  <li><a href="{{url('/page?name=refund-policy')}}">Refund Policy</a></li>
  <li><a href="{{url('/page?name=privacy-policy')}}">Privacy Policy</a></li>
</ul>
</div>
</div>


<div class="footer__block" data-type="payment"><div class="footer__mobile-section" style="margin-bottom:58px;">
  <div class="footer__blocks--mobile"><div class="footer__block--mobile">
          <div class="footer__title">
            We accept
          </div>
          <ul class="inline-list payment-icons"><li class="icon--payment">
                <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" width="38" height="24" role="img" aria-labelledby="pi-paypal"><title id="pi-paypal">PayPal</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path fill="#003087" d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"></path><path fill="#3086C8" d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"></path><path fill="#012169" d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"></path></svg>
              </li></ul>
        </div></div>
</div>
</div>
          </div>


          

        
        </div>
        
     
      
      </div>
      <div class="row search-fixed-outer-40">
        <div class="col-12">
        <form class="form-inline form-40" action="{{ URL::to('/shop')}}" method="get"> 
              <div class="search-field-module border-radius-main">     
                <div class="search-field-wrap-40">
                <input   type="hidden" class="category_mobile_slug" name="categories_id" value="" /> 
                  <input  type="text" name="search" required class="search-40 typeheads_mobile" placeholder="Search..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                  <button class="btn common-hover  search-button-40" data-toggle="" 
                  data-placement="bottom" title="">
                   <svg aria-hidden="true" focusable="false" height="27" width="27" role="presentation" class="icon icon-search" viewBox="0 0 64 64"><defs></defs><path class="cls-1" d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42" fill="#000"></path></svg></button>
                  
                  <div class="search_outer_con_mobile">
                    <div id="viewsearchproduct_mobile"></div>
                  </div>
              </div>
              </div>
              <div class="btn common-hover btn-close-search-mobile" data-toggle="" 
                  data-placement="bottom" title="" style="padding: 5px 20px;font-size: 16px;">
                  <i class="fa fa-close"></i></div>
            </form>
        </div>
      </div>
      <div class="row search-fixed-outer-40-n">
        <div class="col-12">
        <form class="form-inline form-40" action="{{ URL::to('/shop')}}" method="get" style="margin:14px 20px;"> 
              <div class="search-field-module border-radius-main">     
                <div class="search-field-wrap-40">
                <input   type="hidden" class="category_mobile_slug" name="categories_id" value="" /> 
                  <input  type="text" name="search" required class="search-40 typeheads_mobile_fixed_40" placeholder="Search..." data-toggle="" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                  <button class="btn common-hover  search-button-40" data-toggle="" 
                  data-placement="bottom" title="">
                   <svg aria-hidden="true" focusable="false" height="27" width="27" role="presentation" class="icon icon-search" viewBox="0 0 64 64"><defs></defs><path class="cls-1" d="M47.16 28.58A18.58 18.58 0 1 1 28.58 10a18.58 18.58 0 0 1 18.58 18.58zM54 54L41.94 42" fill="#000"></path></svg></button>
                  
                  <div class="search_outer_con_mobile_fixed_40">
                    <div id="viewsearchproduct_mobile_fixed_40"></div>
                  </div>
              </div>
              </div>
              <div class="btn common-hover btn-close-search-mobile-40-n" data-toggle="" 
                  data-placement="bottom" title="" style="padding: 5px 20px;font-size: 16px;">
                  <i class="fa fa-close"></i></div>
            </form>
        </div>
      </div>
</div>


</header>

<style>
  
    .footer__social li
  {
   
    margin: 0 15px 15px 0;
  }
  .footer__social a
  {
    font-size:20px;
    
  }
  .footer__mobile-section {
    margin-top: 20px;
    margin-left: -40px;
    margin-left: calc(var(--pageWidthPadding)*-1);
    margin-right: -40px;
    margin-right: calc(var(--pageWidthPadding)*-1);
    padding: 20px 40px 0;
    padding: 20px var(--pageWidthPadding) 0;
    border-top: 1px solid;
    border-top-color: #08409e !important;
    border-top-color: var(--colorFooterBorder);
    padding: 20px 20px 0 20px;
    text-align:left;
}
.footer__blocks--mobile {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.footer__block, .footer__block--mobile {
    max-width: none;
    flex: 1 1 50%;
}
.footer__title {
    margin-bottom: 15px;
    font-weight: 700;
    font-size: var(--typeBaseSize);
}

.footer__menu {
    margin-bottom: 0;
}

.footer__menu {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
}
.no-bullets {
    list-style: none outside;
    margin-left: 0;
}
.footer__social li {
    display: inline-block;
    margin: 0 15px 15px 0;
}
.footer__social .icon {
    width: 21px;
    height: 21px;
}
.icon__fallback-text {
    clip: rect(0,0,0,0);
    overflow: hidden;
    position: absolute;
    height: 1px;
    width: 1px;
}
.footer__menu--underline a {
    text-decoration: underline;
    text-underline-offset: 2px;
}

.footer__menu a {
    display: inline-block;
    padding: 4px 0;
}
.icon-and-text {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}
.footer__menu .icon {
    margin-right: 10px;
}
#headerMobile40 .icon-and-text .icon {
    flex: 0 0 auto;
}
#headerMobile40 .icon {
    display: inline-block;
    width: 20px;
    height: 20px;
    vertical-align: middle;
    fill: currentColor;
}

  .footer__title_40 {
    margin-bottom: 15px;
    font-weight: 700;
    font-size: var(--typeBaseSize);
}
.footer__block_40, .footer__block--mobile_40 {
    max-width: none;
    flex: 1 1 50%;
}
.footer__menu_40 {
    margin: 0 0 20px;
    padding: 0;
    list-style: none;
}
.footer__menu_40 li {
    margin: 0;
    line-height:0;
}
.footer__menu_40 a {
    display: inline-block;
    padding: 4px 0;
}
#mobile-footer-toogle-40
{
  padding: 30px 20px 0 20px;
    border-top: 1px solid;
    border-top-color: #e8e8e1;
    text-align: left;
}
.nav_40 .nav__link_40 {
    position: relative;
    display: flex;
    width: 100%;
    padding: 10px 20px;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    font-weight: 400;
  
}
.nav_40 .nav__link_40_sub {
    position: relative;
    display: flex;
    width: 100%;
    padding: 10px 20px;
    align-items: center;
    justify-content: flex-start;
    font-size: 13px;
    font-weight: 700; 
}
.back_40
{
  text-decoration: underline;
    text-underline-offset: 2px;
    font-size: 13px;
    font-weight: 700; 
}
.nav_40_close_pos
{
  margin-right:15px;
}

.nav_40,
.nav__sub_40 {
	margin-top: 0;
	margin-bottom: 0;
	list-style-type: none;
}

.nav_40 {
	position: relative;
	background-color: #fff;
	overflow: hidden;
  border: solid 1px #f7f7f7;
    border-radius: 10px;
    background: #f7f7f7;
}

#mobile-40-multilevel
{
  padding: 20px;
}

.nav__link_40 {
	color: #000;
	text-decoration: none;
}

.nav__sub_40 {
	position: absolute;
	top: 0;
	right: 0;
	width: 100%;
	height: 100%;
	background-color: #fff;
	opacity: 0;
	visibility: hidden;
	transition: all 0.35s ease-in-out;
	transform: translateX(100%);

}
	
 .is-active_40 {
		opacity: 1;
		visibility: visible;
		transform: translateX(0%);
    z-index: 120;
    border: solid 1px #f7f7f7;
    border-radius: 10px;
    background: #f7f7f7;

	}
  .body-overflow-new 
{
  overflow: hidden;
  height : 100vh;
}
.navbar-fixed-40 {
  top: 0;
  z-index: 100;
  position: fixed;
  width: 100%;
}

</style>

<script>
  $('.btn-close-search-mobile').hide();
  $('.search-mobile-40-click-hide').hide();
  $('.search-fixed-outer-40-n').hide();

  $('.search-mobile-40-click-hide').click(function(){
    $('.main-con-fixed-outer').hide();
    $('.search-fixed-outer-40-n').show();
    $('.btn-close-search-mobile-40-n').show();
  });

  $('.btn-close-search-mobile-40-n').click(function(){
    $('.main-con-fixed-outer').show();
    $('.search-fixed-outer-40-n').hide();
  });

  $(window).scroll(function () {
  console.log($(window).scrollTop())
  if ($(window).scrollTop() > 200) {
    $('#headerMobile40').addClass('navbar-fixed-40');
    $('.search-mobile-40-click-hide').show();
    $('.search-fixed-outer-40').hide();
    
   
  }
  if ($(window).scrollTop() < 201) {
    $('#headerMobile40').removeClass('navbar-fixed-40');
    $('.search-mobile-40-click-hide').hide();
    $('.search-fixed-outer-40').show();
    $('.search-fixed-outer-40-n').hide();
    $('.main-con-fixed-outer').show();
    

  }
});

// Prepend back button to sub menu(s)
function getloadpage_40($link)
{
  window.location.href = $link; 
}

// Close out sub menu
$('.sub__close_40').click(function(e) {
	e.preventDefault();
	$(this).parent().parent().removeClass('is-active_40');
});

// Trigger sub menu
$('.nav__link_40').click(function(e) {
	e.preventDefault();
	$(this).siblings().addClass('is-active_40');
});
 /*  */
  $('#toggle40').click(function(){
  $(this).toggleClass('on');
  
  $('#menu-40').slideToggle();
  if(this.className == 'on')
  {
  $('.cart-40-mobile').hide();
  }
  else
  {
    $('.cart-40-mobile').show(); 
  }
});

$('.btn-close-search-mobile').click(function(){
    $('.btn-close-search-mobile').hide();
  });


</script>


  

