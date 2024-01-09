<!-- Banners Content -->
<?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
?>

<section class="banners-content @if($current_theme->template == 0) common-padding-topbottom-{{$margin_between->value}} @endif">

  <?php  echo $final_theme['multibanner_two']; ?>

</section>
