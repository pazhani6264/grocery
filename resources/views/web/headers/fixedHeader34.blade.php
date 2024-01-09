
        <header id="stickyHeader" class="header-fixed header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
          <div class="bg-header-19">
              <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-12 col-sm-8">
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
                                  <li class="nav-item dropdown menu-active-{{ $menuactive }}">
                                    <a style="white-space:nowrap" class="nav-link common-fill-hover fill-down-color font-500 padding-19" <?php echo $link; ?>>{{ $item->name }} <?php  if ($childs->isNotEmpty()){?>  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                                          <a class="dropdown-item common-fill-hover fill-down-color" <?php echo $sublink; ?>>
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

                            
                                  
                                <?php }} if(count($items) > 5){?>

                                  <li class="nav-item dropdown  ">
                                    <a style="white-space:nowrap" class="nav-link font-500 common-fill-hover fill-down-color padding-19 " href="#">More  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                                          <a class="dropdown-item common-fill-hover fill-down-color" <?php echo $link; ?>>
                                            {{ $item->name }} <?php if ($childs1->isNotEmpty()) { ?><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 18 10.64" style="transform: rotate(270deg);">
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

                    <div class="col-12 col-sm-4">
                    <?php if(strlen($result['commonContent']['settings']['head_offer_title']) <= 17) { ?>
                        
                          <div class="head-19 font-weight-600 common-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)"/>
</svg>  &nbsp;{{ $result['commonContent']['settings']['head_offer_title'] }}
                          </div>
                       
                      <?php } else {?>
                       
                            <div class="head-19 font-weight-600 common-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 43.19 67.841">
  <path id="bulb" d="M14.307,67.841V64.436H29.436v3.405Zm-3.6-7.793V55.791H33.07v4.257Zm17.922-9.171a23.812,23.812,0,0,1,2.444-11.569c.5-.912,1.111-1.92,1.758-2.987,2.612-4.306,6.189-10.207,6.066-15.915-.12-5.611-3.8-16.15-16.8-16.15-.088,0-.176,0-.267,0C8.175,4.409,4.384,14.881,4.288,20.4c-.1,5.914,4.066,12.185,6.824,16.334.643.967,1.2,1.8,1.622,2.518a19.593,19.593,0,0,1,2.191,7.4,35.637,35.637,0,0,1,.29,4.093,2.143,2.143,0,0,1-4.287,0c0-1.715-.346-6.735-1.889-9.341-.367-.621-.893-1.413-1.5-2.329A68.079,68.079,0,0,1,2.7,30.921,23.572,23.572,0,0,1,0,20.324,20.876,20.876,0,0,1,5.336,6.869C8.124,3.788,13.241.1,21.79,0c.1,0,.207,0,.309,0,8.337,0,13.3,3.733,16,6.889a21.672,21.672,0,0,1,5.088,13.426c.15,6.942-3.8,13.451-6.679,18.2-.622,1.027-1.211,2-1.668,2.831a19.518,19.518,0,0,0-1.927,9.264,2.134,2.134,0,0,1-2.006,2.257c-.045,0-.091,0-.136,0A2.138,2.138,0,0,1,28.634,50.878ZM19.6,40.078V35.062H13.679V32.508h2.06l.8-3.1,2.512.1.518,3h.722l.849-9.256,2.54-.138L25.6,32.508h4.467v2.555H26.547v2.195L24,37.511l-1.094-5.35-.736,8.033Z" transform="translate(0)"/>
</svg>  &nbsp;{{ stripslashes(substr($result['commonContent']['settings']['head_offer_title'],0,17)).'...' }}
                          </div>
                        
                      <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
  
          </div> 
        </header>

        
