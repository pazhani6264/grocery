<style>
  .tabsec5 .container{
    width: 1190px;
    max-width: 100%;
    padding-left: 10px;
    padding-right: 10px;
  }

  .pro-content .tabs-main a.nav-link1 {
    text-transform: uppercase !important;
}

  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}
.tab-5 .slick-slide {
    outline: none;
    padding: 10px !important;
}

.tab-5 .product-molla-25 {
    margin-bottom: 0;
    margin-top: 0px;
}

.product-molla .padd-10 {
    padding: 12px 1rem !important;
}
.pro-content .tabs-main a.nav-link1 {
    font-size: 1.6rem !important;
}
.pro-content .tabs-main a.nav-link1:hover {
    font-size: 1.6rem !important;
}
@media only screen and (max-width: 768px)
{
 .pm-0
 {
   padding: 12px;
 } 
 .tab-carousel-js .slick-slide {
    margin: 0px 5px !important;
}
.tabsec5{
      padding-top: 0px !important;
    }
    .tabsec5 .tabs-main a.nav-link1 {
      margin-left: 1.5rem;
    }
}
@media only screen and (max-width: 420px)
{
  .product article .btn-all {
    height: 300px;
}

}
@media only screen and (max-width: 367px)
{
  .product article .btn-all {
    height: 300px;
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
  
    .title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}
  </style>




<div id="gettabcontent5_loading"></div>

  <div id="gettabcontent5_product"></div>

  @include('web.product-sections.collections')

  <script>
    getalltabcontent5();


    
    function getalltabcontent5() {
      var type = 'tab'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Tab Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent5_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent5")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent5_loading').html(' ');
              jQuery('#gettabcontent5_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getquerytab5();
              
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


function getquerytab5(){


$(document).ready(function() {

  $cu_id = $('.p24-tab-id-value').val();
  //alert($cu_id);
  
  $('.p24-slider-cat-tab5').hide();
  $('#p24-slider-cat-tab5-'+$cu_id).show();

  $('.p24-tabs-nav-tab5').on('click', function (event) {
    event.preventDefault();
   
    $('.p24-tab-active-tab5').removeClass('p24-tab-active-tab5 active show');
    $(this).addClass('p24-tab-active-tab5 active show');
  
    var id = $(this).attr('id');
  
    $('.p24-slider-cat-tab5').hide();
    $('#p24-slider-cat-tab5-'+id).show();
    callslider_script(id)
});


callslider_script($cu_id)

function callslider_script(id)
{
  
  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-tab5-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  4,
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}
});


}






  </script>