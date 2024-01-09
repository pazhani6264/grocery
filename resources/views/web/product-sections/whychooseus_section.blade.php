<!-- Banners Content -->
<?php  $current_theme = DB::table('current_theme')->first();
$whychooseus = $current_theme->whychooseus;
 ?> 
 <?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
?>

<section class="banners-content  @if($current_theme->template == 0) common-padding-topbottom-{{$margin_between->value}} @endif"  style="@if($current_theme->template != 0) padding-top:0 !important; @endif">

  <?php  echo $final_theme['whychooseus']; ?>

</section>
