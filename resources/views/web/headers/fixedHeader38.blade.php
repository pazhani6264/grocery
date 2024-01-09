<style>
.demo-33-img-fluid-molla-main {
   
    width: 105px;
height: 100%;
}
.demo-33-fixedheader-section .pro-header-right-options li > a .badge, .header-sticky .pro-header-right-options li button .badge {
    
}
.demo-33-fixedheader-section .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    font-size: 14px !important;
    padding: 20px 26px 20px 5px !important;
    text-transform: uppercase;
}
.demo-33-fixedheader-section .search-button-main-17-fixed {
    position: absolute;
    top: -7px;
    right: 0px;
    padding: 2px !important;

}
.demo-33-fixedheader-section .search-input-38-fixed {
    padding: 10px 50px 10px 10px;
    height: 41px;
    font-size: 15px;
}
.demo-33-fixedheader-section .cus-style-search-38:hover {
    font-size: 15px;
}
.demo-33-fixedheader-section .cus-style-search-38 {
    font-size: 15px;
}
.demo-33-fixedheader-section .head-cart-content-fixed {
    position: relative;
    display: inline-block;
    list-style: none;
    margin-left: -2px;
    margin-top: 10px;
}
.demo-33-fixedheader-section .fixed-size {
    font-size: 17px;
}
.demo-33-fixedheader-right-cart-outer {
    width: 55px;
    margin-left: 20px;
}
.demo-33-fixedheader-section .demo-33-header-right {
  position: absolute;
right: 10px;
top: 10px;
}

</style>

<input type="hidden" id="fixheadergetvalue" value="38"/>

  <header id="stickyHeader" class="demo-33-fixedheader-section header-12-search-fixed header-fixed header-area header-sticky d-none">
    <div class="header-sticky-inner  bg-sticky-bar-38">
      <div class="demo-33-container">
        <div class="demo-33-d-flex demo-33-w-100 demo-33-position-relative">
          <div class="demo-33-header-left">
            <a class="demo-33-img-fluid-molla-main" href="{{ URL::to('/')}}" class="logo" data-toggle="" data-placement="bottom" title="@lang('website.logo')">
              @if($result['commonContent']['settings']['sitename_logo']=='name')
              <?=stripslashes($result['commonContent']['settings']['website_name'])?>
              @endif
          
              @if($result['commonContent']['settings']['sitename_logo']=='logo')
              <img class="demo-34-img-fluid-molla" src="{{asset($result['commonContent']['settings']['website_logo'])}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              @endif
              </a>
                  
              <div class="header-navbar">
            
            <nav id="navbar_header_9" class="navbar navbar-expand-lg">
          
          <div class="navbar-collapse">
            <ul class="navbar-nav demo-33-ul-ml">
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
                  foreach ($items->slice(0, 4) as $item) {

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
                  <li class="nav-item dropdown menu-active-13-{{ $menuactive }} hover-menu-13 hover-menu-13-white">
                    <a style="white-space:nowrap" class="nav-link fill-color common-fill-hover font-500 menu-color-38 menu-16-color-white" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg> <?php } ?></a>
                   
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
                          <a class="dropdown-item fill-color-black common-fill-hover" <?php echo $sublink; ?>>
                            {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
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

             
                  
                <?php }} if(count($items) > 4){?>

                  <li class="nav-item dropdown  hover-menu-13 hover-menu-13-white">
                    <a style="white-space:nowrap" class="nav-link font-500 fill-color common-fill-hover menu-color-38 menu-16-color-white" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/>
</svg></a>
                      <div class="dropdown-menu">
                      <?php
                          if($items->isNotEmpty()) {
                            foreach ($items as $key=>$item) {
                              if($key > 3){ 
    
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
                          <a class="dropdown-item fill-color-black common-fill-hover"  <?php echo $link; ?>>
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
                    <div class="demo-33-header-right">
                    <div class="demo-33-header-right-content">
                <div class="demo-33-header-right-search tab-horiz-display-none">
                  <form class="demo-33-header-right-pos-rel form-inline-search" action="{{ URL::to('/shop')}}" method="get" >
                              <div class="input-main">
                                  <input autocomplete="off" required  name="search" type="text" class="search-input-38-fixed typeheads_fixed" value="{{ app('request')->input('search') }}" placeholder="Search Product ..... ">
                                  <div class="search_outer_con_fixed">
                                    <div id="viewsearchproduct_fixed"></div>
                                  </div>
                              </div>
                              <button id="dropdownCartButton" class="btn search-button-main-17-fixed color-fill-phone common-fill-hover" type="submit"> 
                              <svg id="search" xmlns="http://www.w3.org/2000/svg" class="cus-style-search-38" width="12" height="12" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                              </button>
                          </form>
                        </div>
                        <div class="demo-33-header-right-search desktop-horiz-display-none">
                  <form class="demo-33-header-right-pos-rel form-inline-search" action="{{ URL::to('/shop')}}" method="get" >
                            <div class="input-main" id="searchbuttonsfixed">
                                  <div  class="search-input-30"></div>
                              </div>
                              <input type="hidden" class="category-value-tab-fixed" name="categories_id" value="" /> 
                              <div class="input-main" id="searchbuttonfixed" style="display:none;margin-right:20px">
                                  <input name="search" type="text" value="{{ app('request')->input('search') }}" class="search-input-38 typeheads_tab_fixed" placeholder="Search Product ..... " style="position:relative">
                                  <div class="search_outer_con_tab_fixed">
                                    <div id="viewsearchproduct_tab_fixed"></div>
                                  </div>
                              </div>
                              <button id="dropdownCartButton" class="btn search-button-main color-fill-phone common-fill-hover" type="button" style="position:absolute;right:20px;"> 

                              <svg id="search" xmlns="http://www.w3.org/2000/svg" class="cus-style-search icon-39-color" onclick="myFunctionfixed()" width="12" height="12" viewBox="0 0 27 27">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                      
                               
                              </button>
                          </form>
                        </div>

                        @if($result['commonContent']['settings']['view_cart_button'] == 1)

                        <div class="demo-33-fixedheader-right-cart-outer">
                          <ul class="pro-header-right-options header-38-fixed-cart-drop  common-hover color-fill-phone common-fill-hover" style="position: relative;left: -20px;">
                            <li class="dropdown head-cart-content-fixed">
                              @include('web.headers.cartButtons.cartButtonFixed38')    
                            </li>
                          </ul>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
          </div> 
        </header>
        <script>
  function myFunctionfixed() {
  var x = document.getElementById("searchbuttonfixed");
  var y = document.getElementById("searchbuttonsfixed");

  var a = document.getElementById("searchbutton");
  var b = document.getElementById("searchbuttons");

  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    a.style.display = "block";
    b.style.display = "none";
    $('.fa-search').addClass('active-30-button');

  } else {
    x.style.display = "none";
    y.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
    $('.fa-search').removeClass('active-30-button');
  }
}
</script>