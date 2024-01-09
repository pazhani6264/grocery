<style>
    .slick-slide {
        outline: none;
        padding: 0px !important;
    }
</style>

<!-- //banner one -->
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

<div id="getclientbrand_7_loading"></div>

  <div id="getclientbrand_7_product"></div>

  <script>
    getclientbrand_7();
    function getclientbrand_7() {
      var type = '7'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Brand</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getclientbrand_7_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getclientbrand_7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getclientbrand_7_loading').html(' ');
              jQuery('#getclientbrand_7_product').html(res);
              getclientbrand7_slick();
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

function getclientbrand7_slick(){
jQuery(document).ready(function () {
    (function (jQuery) {
  var tabCarousel = jQuery('.brand-carousel-js-7');

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          //arrows: true,
          infinite: false,

		  prevArrow: '<div class="slider-7-arrow slider-7-prev fa fa-angle-left"></div>',
    	  nextArrow: '<div class="slider-7-arrow slider-7-next fa fa-angle-right"></div>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  6,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
			  dots: false
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
			  dots: false
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); // aboutus section
}

  </script>

 

 
