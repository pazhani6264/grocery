@extends('web.reaytemplatelayout')
@section('content')


<meta property="og:image" content="{{asset('').$result['commonContent']['settings']['website_logo']}}" />
       <!-- End Header Content -->

       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->

       <!-- Carousel Content -->
       <?php  echo $final_theme['carousel']; ?>
       <!-- Fixed Carousel Content -->

      <!-- Banners Content -->
      <!-- Products content -->

      <?php

      $product_section_orders = json_decode($final_theme['product_section_order'], true);
      foreach ($product_section_orders as $product_section_order){
          if($product_section_order['status'] == 1)
          {
            //echo $product_section_order['file_name'].'<br>';
            $r =   'web.product-sections.' . $product_section_order['file_name'];
      
      ?>
            @include($r)
      
      <?php

          }
       }
      
      ?>

<script>
  $('.menu-active-home > a').addClass('menu-active');
  $('.menu-actives-home > a').addClass('menu-actives');
  $('.menu-active-11-home > a').addClass('active-menu-11');
  $('.menu-active-13-home > a').addClass('active-menu-13');
  $('.menu-active-15-home > a').addClass('active-menu-15');
  $('.menu-active-16-home > a').addClass('active-menu-16');
  $('.menu-active-30-home > a').addClass('active-menu-30');

  $('#add35-hover').addClass('header-overlap-35').addClass('bg-header-bar-35-trans');
  $('#add24-hover').addClass('header-overlap-35').addClass('bg-header-bar-35-trans');
  $('#add30-hover').addClass('header-overlap').addClass('bg-header-bar-35-trans');
  $('#add35-mobile-hover').addClass('header-overlap-35').addClass('bg-header-bar-35-trans');
  $('#add30-mobile-hover').addClass('header-overlap-30').addClass('bg-header-bar-35-trans');
  $('.bg-header-bar-35-trans').css('position','absolute');

  $('.dropdown-menu-hoactive').addClass('dropdown-menu-22');
  
</script>


@include('web.common.scripts.addToCompare')
@include('web.common.scripts.Like')
@endsection
