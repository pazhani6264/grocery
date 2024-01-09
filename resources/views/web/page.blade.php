@extends('web.layout')
@section('content')
<style>
  .aboutus-content-one {
padding-top: 30px;
padding-bottom: 30px;

margin-top: 0px !important;
}
</style>
<section class="aboutus-content aboutus-content-one" style="background:#fff">
  <div class="container">
    <div class="heading">
      <h2>
      <?=$result['pages'][0]->name?>
      </h2>
      <hr style="margin-bottom: 10;">
    </div>
  <?=stripslashes($result['pages'][0]->description)?>     
  </div>

</section>


<script>
  $( '.menu-active-<?=$result['pages'][0]->slug?> > a').addClass('menu-active');
  $( '.menu-actives-<?=$result['pages'][0]->slug?> > a').addClass('menu-actives');
  $( '.menu-activess-<?=$result['pages'][0]->slug?> > a').addClass('menu-activess');
  $( '.menu-active-11-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-11');
  $( '.menu-active-13-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-13');
  $( '.menu-active-15-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-15');
  $( '.menu-active-16-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-16');
  $( '.menu-active-30-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-30');
  $( '.menu-active-40-<?=$result['pages'][0]->slug?> > a').addClass('active-menu-40');


</script>

@endsection
