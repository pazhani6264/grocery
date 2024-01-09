<style>
  .sticky-header .header-sticky-inner nav .navbar-collapse ul li {
margin-left: 10px;
}
</style>
        <header id="stickyHeader" class="header-fixed header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="bg-header-29">
              <div class="container">
                  <div class="row align-items-center">

                  <div class="col-12 col-sm-3">
                      <nav class="navbar navbar-expand-sm navbar-dark-29 menu-11-padding border-right-29">
                          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                              <span class="navbar-toggler-icon"></span>
                          </button>
                          @include('web.common.HeaderCategoriesFixed')
                          <div class="collapse navbar-collapse" id="navbarCollapse">
                              <div class="navbar-nav width-100">
                                  <div class="nav-item dropdown menu-11 width-100" style="padding:7px">
                                      <a href="#" class="nav-link common-fill menu-hover-11" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800" class="common-color" data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)"/>
    <rect id="Rectangle_5801" class="common-color" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" />
    <rect id="Rectangle_5802" class="common-color" data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" />
  </g>
</svg>  <span class="menu-11-title menu-29-color">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg"  width="8" height="8" viewBox="0 0 18 10.64" style="float:right;margin-top: 5px;">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#fff"/>
</svg></a>


                                      <a id="shopclcikfixed" href="#" class="nav-link common-fill menu-hover-11 " data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800" class="common-color" data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)"/>
    <rect id="Rectangle_5801" class="common-color" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" />
    <rect id="Rectangle_5802" class="common-color" data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" />
  </g>
</svg>  <span class="menu-11-title menu-29-color menu-16-color-black">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg" style="float:right;margin-top: 5px;" width="8" height="8" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"/>
</svg> </a>
                                      <div class="dropdown-menu dropdown-menu-12-fixed">
                                      <div class="wrapper">
                                <ul class="menu-molla">
                                <?php
                                  $items = DB::table('categories')
                                  ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                  ->leftJoin('images','images.id', '=', 'categories.categories_icon')
                                  ->leftJoin('image_categories','image_categories.image_id', '=', 'images.id')
                                  ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id','image_categories.path')
                                  ->where('categories_description.language_id','=', Session::get('language_id'))
                                  ->where('categories.categories_status','=', 1)
                                  ->where('categories.parent_id','=',0)
                                  ->orderBy('categories.categories_id','ASC')
                                  ->groupBy('categories.categories_id')
                                  ->get();
                                  if($items->isNotEmpty()){
                                    foreach($items->slice(0, 10) as $item){
                                ?>

                                  <?php
                                    $subitems = DB::table('categories')
                                    ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                    ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id')
                                    ->where('categories_description.language_id','=', Session::get('language_id'))
                                    ->where('categories.parent_id','!=',0)
                                    ->where('categories.parent_id','=', $item->categories_id)
                                    ->where('categories.categories_status','=', 1)
                                    ->get();
                                    
                                  ?>
                                  <li><a href="#"><img src="{{asset($item->path) }}" style="margin-right:10px"  width="20px" height="20px"/>{{ $item->categories_name}} <?php if($subitems->isNotEmpty()) { ?><i style="float:right" class="fa fa-angle-right"></i><?php } ?></a>
                                  <?php  if($subitems->isNotEmpty()){ ?>
                                    <div class="megadrop">
                                      <div class="row">
                                        <?php foreach($subitems as $subitem) { ?>
                                        <div class="col-md-4">
                                          <div class="col">
                                            <h3>{{ $subitem->categories_name }}</h3>
                                            <?php
                                                $subitems1 = DB::table('categories')
                                                ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                                                ->select('categories.categories_id', 'categories.categories_slug as slug','categories_description.categories_name', 'categories.parent_id')
                                                ->where('categories_description.language_id','=', Session::get('language_id'))
                                                // ->where('categories.categories_id','=', $item->categories_id)
                                                ->where('categories.parent_id','=', $subitem->categories_id)
                                                ->where('categories.categories_status','=', 1)
                                                ->get();
                                                if($subitems1->isNotEmpty()){
                                                  foreach($subitems1 as $subitem1){
                                              ?>
                                                <ul>
                                                  <li><a class="common-hover" href="shop?category='.$subitem1->slug.'">{{ $subitem1->categories_name }}</a></li>
                                                </ul>
                                              <?php } } ?>
                                          </div>
                                        </div>
                                      <?php } ?>
                                    </div>
                                    <?php } ?>
                                  </li>
                                  <?php } } ?>
                                </ul>
                              </div>     
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </nav>
                    </div>
                              
                    <div class="col-12 col-sm-6 border-right-29">
                      <div class="header-navbar">
                         <nav id="navbar_header_9" class="navbar navbar-expand-lg">
                            
                            <div class="navbar-collapse" >
                              <ul class="navbar-nav margin-auto">
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
                                      <a style="white-space:nowrap" class="nav-link  menu-16-color fixed-header-11-nopadding menu-16-color-white" <?php echo $link; ?>>{{ $item->name }}<?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#bbb"/>
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
                                            <a class="dropdown-item"  <?php echo $sublink; ?>>
                                              {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#bbb"/></svg><?php } ?></i></a>
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
                                      <a style="white-space:nowrap" class="nav-link menu-16-color fixed-header-11-nopadding menu-16-color-white" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#bbb"/>
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
                                            <a class="dropdown-item" <?php echo $link; ?>>
                                              {{ $item->name }} <?php if ($childs1->isNotEmpty()) { ?> <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#bbb"/></svg><?php } ?></i></a>
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

                    <div class="col-12 col-sm-3">
                            <?php if(auth()->guard('customer')->check()){ ?>
                              <div class="head-11 "><a class="menu-16-color common-fill  menu-16-color-black" href="{{url('logout')}}" ><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg> &nbsp;&nbsp;&nbsp;@lang('website.Logout')</a></div>
                            <?php }else{ ?>
                              <div class="head-11"><a class="menu-16-color common-fill  menu-16-color-black" href="{{ URL::to('/login')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24.552 26.999">
                      <path id="profile" d="M22.1,27a9.828,9.828,0,0,0-9.732-9.819h-.174A9.828,9.828,0,0,0,2.457,27H0A12.294,12.294,0,0,1,7.467,15.7a8.591,8.591,0,1,1,9.618,0A12.294,12.294,0,0,1,24.552,27ZM6.142,8.582a6.134,6.134,0,1,0,6.134-6.134A6.143,6.143,0,0,0,6.142,8.582Z"/>
                    </svg> &nbsp;&nbsp;&nbsp;Login / Registration</a></div>                     
                            <?php } ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
          </div> 
        </header>

        
        <!-- <script>
$(document).ready(function(){
  $("#shopclcikfixed").click(function(){
    window.location.href="/shop";
  });
});
</script> -->