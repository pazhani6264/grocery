<?php
$margin_between =  DB::table('settings')->where('name','margin_between')->first();
$current_theme = DB::table('current_theme')->where('id', '=', '1')->first();
$htmldata4 =  DB::table('settings')->where('id',247)->first();
?>


<div class="@if($current_theme->template == 0) common-padding-topbottom-{{$margin_between->value}} @endif" style="@if($current_theme->template != 0) margin-top:60px; @endif">

  <section class="new-products-content" style="padding-top:0px;">
    <div class="container">
      <div class="products-area">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-12">
              <!-- <div class="pro-heading-title mtb30 p-0">
                <h2  class="title_change">HTML Content 1</h2>
              </div> -->
             <?php echo stripslashes($htmldata4->value ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>




