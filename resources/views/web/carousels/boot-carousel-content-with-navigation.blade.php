
<style>
  .categories-panel ul .nav-item .dropdown-menu .dropdown-item {
    padding: 0.575rem !important;
}
.categories-panel ul .submenu1 li.nav-item.dropdown.parent.dropright {
    padding: 0 !important;
}

.carousel-inner {
position: relative;
width: 100%;
overflow: hidden;
height: 400px;
}

#carouselExampleIndicators3 .w-100 {
height: 400px !important;
object-fit:cover;
}

      .wrapper {
  position: relative;
}
.categories-panel .wrapper .dropdown-submenu {
    position: unset;
}
.categories-panel ul .nav-item .fas {
    position: unset;
    
}
.wrapper li.nav-item.dropdown.parent.dropright
{
  border-bottom: 1px solid #dee2e6;
}
.categories-panel .wrapper ul .nav-item a {
    border-bottom: none;
}

.wrapper li.nav-item.dropdown {
  border-bottom: 1px solid #dee2e6;
}
.wrapper ul {
  
  max-height: calc(100vh - 30vh);
  overflow-x: hidden;
  overflow-y: auto;
  width: 100%;
}
.wrapper ul .nav-item .fas {
    margin-right: 20px;
}
.navbar-expand-lg .navbar-collapse {
    display: block !important;
    flex-basis: auto;
}

.wrapper li {
  position: static;

}

.wrapper li .wrapper li{
  position: static;

}
  
li .wrapper {
    position: absolute;
    z-index: 20;
    display: none;
  }
  
  li:hover > .wrapper {
    display: block;
  }


li {
 
}
  
 li ul {
    margin: 0;
  }
  
  li .wrapper {
    cursor: auto;
}
li .wrapper li {
     
    }

  li.parent {
    cursor: pointer;
  }
  .wrap-left {
    top: 0px;
    left: 272px !important;
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
  .wrap-left {
    top: 2px;
    left: 246px !important;
  }
}

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
  .wrap-left {
    top: 2px;
    left: 241px !important;
  }
}


   </style>



<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }

  .content_loading .dot:nth-child(2) {
      animation-delay: 0.3s;
    }

    .content_loading .dot:nth-child(3) {
      animation-delay: 0.6s;
    }
  </style>

<?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
if($margin_between->value == 20){$bottom = 10;}
elseif($margin_between->value == 30){$bottom = 15;}
elseif($margin_between->value == 40){$bottom = 20;}
elseif($margin_between->value == 50){$bottom = 25;}
elseif($margin_between->value == 60){$bottom = 30;}
?>


<div id="getcarousel_4_loading"></div>

  <div id="getcarousel_4_product" class="@if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif"></div>

  <script>
    getcarousel_4();
    function getcarousel_4() {
      var type = '4'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Slider</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcarousel_4_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getcarousel_4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcarousel_4_loading').html(' ');
              jQuery('#getcarousel_4_product').html(res);
              getnav_cat_4();
              var imgEl = document.getElementsByTagName('img');
              for (var i=0; i<imgEl.length; i++) {
                  if(imgEl[i].getAttribute('data-src')) {
                    imgEl[i].setAttribute('src',imgEl[i].getAttribute('data-src'));
                    imgEl[i].removeAttribute('data-src'); //use only if you need to remove data-src attribute after setting src
                  }
              }
          
        },
        });
} 

function getnav_cat_4()
{
  $(function() {
  // whenever we hover over a menu item that has a submenu
  $('li.parent').on('mouseover', function() {
    var $menuItem = $(this),
        $submenuWrapper = $('> .wrapper', $menuItem);
    
    // grab the menu item's position relative to its positioned parent
    var menuItemPos = $menuItem.position();
    
    // place the submenu in the correct position relevant to the menu item
    $submenuWrapper.css({
      top: menuItemPos.top,
     
    });
  });
});
}
  </script>



