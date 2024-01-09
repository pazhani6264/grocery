

<style>
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}

.carousel-inner {
position: relative;
width: 100%;
overflow: hidden;
height: 400px;
}

.desktop_slider_view{
  height: 400px !important;
  object-fit:cover;
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

    @media only screen and (max-width: 409px){
      .carousel-content .carousel-item img {
        height: 400px;
      }
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

<div id="getcarousel_5_loading" style="margin-top:30px;"></div>

  <div id="getcarousel_5_product" class="@if($current_theme->template == 0) common-padding-bottom-{{$bottom}} @endif"></div>

  <script>
    getcarousel_5();
    function getcarousel_5() {
      var type = '5'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Slider</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcarousel_5_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getcarousel_5")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcarousel_5_loading').html(' ');
              jQuery('#getcarousel_5_product').html(res);
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

</script>