<style>
  .sticky-header .header-sticky-inner nav .navbar-collapse ul li {
margin-left: 15px;
}
</style>
        <header id="stickyHeader" class="header-fixed header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="bg-header-39">
              <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-12 col-sm-3 p-0">
                      <nav class="navbar navbar-expand-sm navbar-dark-11 menu-11-padding" style="max-width: 270px;margin-left:10px;">
                          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                              <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarCollapse">
                              <div class="navbar-nav width-100">
                                  <div class="nav-item dropdown menu-11 width-100 cate-bg-color" style="padding:7px">
                                      <a class="nav-link cursor-pointer menu-hover-11 menu-16-color-white menu-color-22-white" data-toggle="dropdown"><span class="menu-11-title">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="12" viewBox="0 0 36 27">
  <g id="hamburger_menu" transform="translate(0.307 0.307)">
    <rect id="Rectangle_5800"  data-name="Rectangle 5800" width="36" height="3" transform="translate(-0.307 -0.307)" fill="#333"/>
    <rect id="Rectangle_5801" data-name="Rectangle 5801" width="36" height="3" transform="translate(-0.307 11.693)" fill="#333"/>
    <rect id="Rectangle_5802"  data-name="Rectangle 5802" width="36" height="3" transform="translate(-0.307 23.693)" fill="#333"/>
  </g>
</svg>  </a>
                                      <a id="shopclcikfixed" class="nav-link cursor-pointer menu-hover-11 cate-color-22"><span class="menu-11-title">Browse Categories</span> <svg xmlns="http://www.w3.org/2000/svg" class="menu-22-fontsize" width="16" height="15" viewBox="0 0 27.001 27">
  <path id="close" d="M101.218,98.832l10.619-10.619a1.688,1.688,0,1,0-2.387-2.387L98.832,96.445,88.212,85.826a1.688,1.688,0,0,0-2.387,2.387L96.445,98.832,85.826,109.451a1.688,1.688,0,1,0,2.387,2.387l10.619-10.619,10.619,10.619a1.688,1.688,0,0,0,2.387-2.387Z" transform="translate(-85.332 -85.332)" fill="#fff"/>
</svg> </a>
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
                                      <a style="white-space:nowrap" class="nav-link color-fill-white common-fill-hover menu-color-22 menu-color-22-white padding-22" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
                                            <a class="dropdown-item color-fill-black common-fill-hover" <?php echo $sublink; ?>>
                                              {{ $child->name }} <?php if ($childs1->isNotEmpty()) { ?>f<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
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
                                      <a style="white-space:nowrap" class="nav-link color-fill-white common-fill-hover  menu-color-22  menu-color-22-white padding-22" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
  <path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" />
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
                                            <a class="dropdown-item color-fill-black common-fill-hover" <?php echo $link; ?>>
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

                      <div class="col-12 col-sm-3">
                        <!-- <div class="head-11  text-white"><i class="fa fa-lightbulb-o"></i> &nbsp;&nbsp;&nbsp;Clearance Up to <b class="common-color menu-color-22-white">30% Off</b>
                        </div> -->
                        <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
              <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)" fill="#fff"/>
</svg> &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                </div>
              </a>
          <?php } else {?>
            <a href="{{ $result['commonContent']['settings']['head_offer_url'] }}">
                <div class="head-11 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)" fill="#fff"/>
</svg> &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
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