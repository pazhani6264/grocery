<style>
  .color-16-top{
    font-size:0.9rem;
  }
  .header-twele .header-mini .dropdown .btn.dropdown-toggle {
    font-size:0.9rem;
  }
  .header-12-search-fixed .col-lg-2 {
      flex: 0 0 12.666667%;
      max-width: 12.666667%;
  }
  .header-12-search-fixed .col-lg-6 {
      flex: 0 0 54%;
      max-width: 54%;
  }
</style>

<input type="hidden" id="fixheadergetvalue" value="12"/>

        <header id="stickyHeader" class="header-12-search-fixed header-fixed header-area header-sticky d-none">
          <div class="header-sticky-inner  bg-sticky-bar">
            <div class="container">
    
                <div class="row align-items-center">
                    <div class="col-12 col-lg-2">
                        <div class="logo">
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
                    </div>
                    <div class="col-12 col-lg-6" style="position: static;">
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
                        $link = ' href="' . url('product-detail/') . $item->link . '"';
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
                  <li class="nav-item dropdown menu-active-{{ $menuactive }} fixed-12-padding-black">
                    <a style="white-space:nowrap;font-weight:500 !important;text-transform:uppercase" class="fixed-12-padding nav-link padding-0-black" <?php echo $link; ?> >{{ $item->name }} <?php  if ($childs->isNotEmpty()){?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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

                  <li class="nav-item dropdown fixed-12-padding-black">
                    <a style="white-space:nowrap;font-weight:500 !important;text-transform:uppercase" class="fixed-12-padding nav-link padding-0-black" href="#">More <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 18 10.64">
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
                          <a class="dropdown-item"  <?php echo $link; ?>>
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
                                  <a class="dropdown-item" dropdown-toggle="" <?php echo $sublink; ?>>{{ $child1->name }}<span style="float:right"></span></a>
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
                    <div class="col-12 col-sm-4">
                      <div class="row">
                        <div class="col-md-9">
                          <form class="form-inline-search" action="{{ URL::to('/shop')}}" method="get" style="margin-left: 15px;position: relative;right: -30px;">
                              <div class="input-main" id="searchbuttonsfixed">
                                <div  class="search-inputs"></div>
                              </div>
                              <input type="hidden" class="category-value" name="categories_id" value="" /> 
                              <div class="input-main" id="searchbuttonfixed" style="display:none">
                                  <input autocomplete="off" required name="search" required value="{{ app('request')->input('search') }}" type="text" class="search-input typeheads_fixed" placeholder="Search Product ..... ">
                                  <div class="search_outer_con_fixed">
                                    <div id="viewsearchproduct_fixed"></div>
                                  </div>
                              </div>
                              <button id="dropdownCartButton" class="btn search-button-main common-fill-hover" type="button" style="right:0px;padding:0.6rem 1rem !important"> 
                              <svg id="search" class="cus-style-search"  onclick="myFunctionfixed()" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 27 27" style="margin-right: 5px;">
  <g id="Layer_1" data-name="Layer 1" transform="translate(0 0)">
    <path id="Path_55427" data-name="Path 55427" d="M.216,25.052l6.72-6.72a11.27,11.27,0,1,1,1.591,1.591l-6.72,6.72A1.127,1.127,0,0,1,.216,25.052Zm15.427-4.833a9.007,9.007,0,1,0-9-9,9.007,9.007,0,0,0,9,9Z" transform="translate(0.07 0.07)" />
  </g>
</svg>
                               
                              </button>
                          </form>
                        </div>
                        @if($result['commonContent']['settings']['view_cart_button'] == 1)

                        <div class="col-md-3">
                          <ul class="pro-header-right-options header-12-fixed-cart-drop common-fill-hover" style="margin-top:5px">
                            <li class="dropdown head-cart-content-fixed">
                              @include('web.headers.cartButtons.cartButtonFixed12')
                            </li>
                          </ul>
                        </div>
                        @endif
                      </div>
                    </div>
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