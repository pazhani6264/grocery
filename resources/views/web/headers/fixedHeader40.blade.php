<style>
  .sticky-header .header-sticky-inner nav .navbar-collapse ul li {
margin-left: 0;
}
</style>
        <header id="stickyHeader" class="header-fixed header-area header-sticky d-lg-none d-xl-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="bg-header-39">
              <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-12 col-sm-3">
                      <nav class="navbar navbar-expand-sm navbar-dark-11 menu-11-padding" style="max-width: 270px;">
                          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                              <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarCollapse">
                              <div class="navbar-nav width-100">
                                  <div class="nav-item dropdown menu-11 width-100 cate-bg-color" style="padding:7px">
                                      <a href="#" class="nav-link menu-hover-11 menu-16-color-white menu-color-22-white" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> <i class="fa fa-bars menu-22-fontsize"></i> </a>
                                      <a id="shopclcikfixed" href="#" class="nav-link menu-hover-11 cate-color-22" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> <i class="fa fa-times menu-22-fontsize"></i> </a>
                                      <div class="dropdown-menu dropdown-menu-12-fixed" style="top:50px !important">
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
                                <li><a href="#"><img src="{{asset('').$item->path }}" style="margin-right:10px"  width="20px" height="20px"/>{{ $item->categories_name}} <?php if($subitems->isNotEmpty()) { ?><i style="float:right" class="fa fa-angle-right"></i><?php } ?></a>
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
                                                <li><a href="shop?category='.$subitem1->slug.'">{{ $subitem1->categories_name }}</a></li>
                                              </ul>
                                            <?php } } ?>
                                        </div>
                                      </div>
                                    <?php } ?>
                                  </div>
                                  <?php } ?>
                                </li>
                                <?php } if(count($items) > 11) {?>
                                  <li><a style="background-color:#fff" href="/shop">View AllCategories</a>
                                <?php } } ?>
                              </ul>  
                            </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </nav>
                    </div>


                    <div class="col-12 col-sm-6">
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
                                          $link = ' href="' . url('product-detail') .'/'.  $item->link . '"';
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
                                      <a style="white-space:nowrap" class="nav-link menu-color-22 menu-color-22-white padding-22" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <i class="fa fa-angle-down"></i> <?php } ?></a>
                                    
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

                              
                                    
                                  <?php }} if(count($items) > 4){?>

                                    <li class="nav-item dropdown  hover-menu-13 hover-menu-13-white">
                                      <a style="white-space:nowrap" class="nav-link  menu-color-22  menu-color-22-white padding-22" href="#">More <i class="fa fa-angle-down"></i></a>
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
                    </div>

                      <div class="col-12 col-sm-3">
                        <!-- <div class="head-11  text-white"><i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;&nbsp;Clearance Up to <b class="common-color menu-color-22-white">30% Off</b>
                        </div> -->
                        <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
              <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><i class="fa fa-lightbulb-o"></i> &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
              </a>
          <?php } else {?>
            <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><i class="fa fa-lightbulb-o"></i> &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
              </div>
            </a>
          <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
          </div> 
        </header>

<!--         
        <script>
$(document).ready(function(){
  $("#shopclcikfixed").click(function(){
    window.location.href="/shop";
  });
});
</script> -->