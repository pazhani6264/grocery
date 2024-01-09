<style>
  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}

.p24-slider-cat-tab2 .slick-slide{
  padding:0px 10px !important;
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




<div id="gettabcontent_loading"></div>

  <div id="gettabcontent_product"></div>

  @include('web.product-sections.collections')

  <script>
    getalltabcontent2();


    
    function getalltabcontent2() {
      var type = 'tab'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Tab Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent2")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent_loading').html(' ');
              jQuery('#gettabcontent_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getquerytab2();
              
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


function getquerytab2(){


$(document).ready(function() {

  $cu_id = $('.p24-tab-id-value').val();
  //alert($cu_id);
  
  $('.p24-slider-cat-tab2').hide();
  $('#p24-slider-cat-tab2-'+$cu_id).show();

  $('.p24-tabs-nav-tab2').on('click', function (event) {
    event.preventDefault();
   
    $('.p24-tab-active-tab2').removeClass('p24-tab-active-tab2 active show');
    $(this).addClass('p24-tab-active-tab2 active show');
  
    var id = $(this).attr('id');
  
    $('.p24-slider-cat-tab2').hide();
    $('#p24-slider-cat-tab2-'+id).show();
    callslider_script(id)
});


callslider_script($cu_id)

function callslider_script(id)
{
  
  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-tab2-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
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