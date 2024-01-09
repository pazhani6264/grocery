<input type="hidden" id="fixheadergetvalue" value="36"/>

        <header id="stickyHeader" class="header-12-search-fixed header-fixed header-area header-sticky d-none" style="height:160px;">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="container-fluid">
    
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5" style="position: static;">
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
                        foreach ($items->slice(0, 3) as $item) {

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
                        <li class="nav-item dropdown menu-active-13-{{ $menuactive }} hover-menu-36" style="padding:53px 0px;">
                          <a style="white-space:nowrap" class="nav-link menu-11-color padding-18 font-500" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <i class="fa fa-angle-down"></i> <?php } ?></a>
                        
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
                                <a class="dropdown-item" <?php echo $sublink; ?>>
                                  {{ $child->name }} <i class="<?php if ($childs1->isNotEmpty()) { ?>fa fa-angle-right<?php } ?>" style="float:right;margin-top:4px;"></i></a>
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

                  
                        
                      <?php }} if(count($items) > 3){?>

                        <li class="nav-item dropdown  hover-menu-36" style="padding:53px 0px;">
                          <a style="white-space:nowrap" class="nav-link  menu-11-color padding-18 font-500" href="#">More <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-menu">
                            <?php
                                if($items->isNotEmpty()) {
                                  foreach ($items as $key=>$item) {
                                    if($key > 2){ 
          
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
                                <a class="dropdown-item" <?php echo $link; ?>>
                                  {{ $item->name }} <i class="<?php if ($childs1->isNotEmpty()) { ?> fa fa-angle-right<?php } ?>" style="float:right;margin-top:4px;"></i></a>
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

                    <div class="col-12 col-lg-2">
                        <div class="logo">
                          <a class="img-fluid-molla-main-36" href="{{ URL::to('/')}}" class="logo" data-toggle="" style="width: 100%;" data-placement="bottom" title="@lang('website.logo')">
                            @if($result['commonContent']['settings']['sitename_logo']=='name')
                            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
                            @endif
                        
                            @if($result['commonContent']['settings']['sitename_logo']=='logo')
                              <?php 
                              $imagepath = DB::table('image_categories')->where('path', '=', $result['commonContent']['settings']['website_logo'])->where('image_type', 'ACTUAL')->select('path_type')->first(); 

                              ?>
                              @if($imagepath->path_type == 'aws')
                                <img class="img-fluid-molla-36" src="{{$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                              @else
                                <img class="img-fluid-molla-36" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                              @endif
                            @endif
                            </a>

                          </div>
                    </div>


                  <div class="col-12 col-lg-5" style="text-align:right">

                        <button id="dropdownCartButton" class="btn srach-18-butt" type="button"> 
                        <svg id="search" class="us-style-search-36 common-fill-hover color-fill" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 27 27" onclick="myFunction()">>
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)"/>
  </g>
</svg>
               
                    </button>
             
                    <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="display:inline-block;position:relative">
                        <input type="hidden" class="category-value" name="categories_id" value="" /> 
                        <div class="input-main srach-18-main-input" id="searchbutton">
                            <input autocomplete="off" required name="search" value="{{ app('request')->input('search') }}"  type="text" class="search-input-15 typeheads_fixed" placeholder="Search Product ..... ">
                            <div class="search_outer_con_fixed search_outer_con_18" style="text-align:left">
                                <div id="viewsearchproduct_fixed"></div>
                            </div>
                        </div>
                       
                    </form>
               
                  <a href="{{ URL::to('/wishlist')}}">
                      <div class="pro-header-right-options display-inline cart-left-wishlist cart-left-wishlist-11 text-center margin-left-32 common-fill-hover color-fill" style="margin-right:30px !important;margin-left:10px !important;vertical-align: baseline;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48.232 41.342">
                      <g id="wishlist" transform="translate(0 -36.545)">
                        <path id="Path_55409" data-name="Path 55409" d="M44.814,39.883q-3.419-3.338-9.447-3.338a10.733,10.733,0,0,0-3.4.578,13.76,13.76,0,0,0-3.229,1.561q-1.494.982-2.571,1.844a24.872,24.872,0,0,0-2.045,1.83,24.905,24.905,0,0,0-2.046-1.83q-1.077-.861-2.571-1.844a13.779,13.779,0,0,0-3.23-1.561,10.736,10.736,0,0,0-3.4-.578q-6.029,0-9.447,3.338T0,49.141a11.791,11.791,0,0,0,.633,3.714,16.292,16.292,0,0,0,1.44,3.257A23.82,23.82,0,0,0,3.9,58.736Q4.926,60.014,5.4,60.5a8.916,8.916,0,0,0,.74.7L22.932,77.4a1.689,1.689,0,0,0,2.369,0l16.768-16.15q6.164-6.163,6.164-12.111Q48.232,43.219,44.814,39.883Zm-5.087,18.84L24.116,73.768,8.479,58.7q-5.033-5.032-5.033-9.555a11.735,11.735,0,0,1,.578-3.849A7.518,7.518,0,0,1,5.5,42.641a7.11,7.11,0,0,1,2.194-1.6,9.725,9.725,0,0,1,2.53-.834,15.416,15.416,0,0,1,2.638-.215,7.741,7.741,0,0,1,3.015.686A13.761,13.761,0,0,1,18.854,42.4q1.359,1.037,2.329,1.938A20.908,20.908,0,0,1,22.8,45.992a1.764,1.764,0,0,0,2.638,0,20.851,20.851,0,0,1,1.615-1.655q.969-.9,2.328-1.938a13.757,13.757,0,0,1,2.975-1.722,7.74,7.74,0,0,1,3.015-.686A15.419,15.419,0,0,1,38,40.205a9.714,9.714,0,0,1,2.53.834,7.11,7.11,0,0,1,2.193,1.6,7.518,7.518,0,0,1,1.481,2.651,11.745,11.745,0,0,1,.578,3.849Q44.787,53.663,39.727,58.723Z" transform="translate(0 0)" />
                      </g>
                    </svg>
                        <span class="total_wishlist badge badge-secondary badge-wishlist-33  ">{{ $result['commonContent']['total_wishlist'] }}</span>
                      </div>
                    </a>
                
                    @if($result['commonContent']['settings']['view_cart_button'] == 1)

                  <ul class="pro-header-right-options display-inline header-36-fixed-cart-drop common-hover common-fill-hover color-fill" style="vertical-align: middle;">
                      @include('web.headers.cartButtons.cartButtonFixed36')
                  </ul>
                  @endif
                </div>

            </div>
          </div> 
        </header>

        
<script>
  function myFunctionfixed() {
  var x = document.getElementById("searchbuttonfixed");
  var y = document.getElementById("searchbuttonsfixed");

  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
</script>