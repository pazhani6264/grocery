<style>

.pttb-2 {
    padding-top: 3rem;
    padding-bottom: 2rem;
}
    .slick-slide {
        outline: none;
        padding: 0px !important;
    }

.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}


element.style {
    padding: 10px;
}
.slider-7-prev {
    left: -55px;
}
.slider-7-prev, .slider-7-next {
  
    top: 34%;
  
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

    .brand-title{
      font-size:20px;
      text-transform:initial;
      margin-bottom:2rem !important;
    }

    .slick-disabled:hover{
      background:transparent !important;
      color:grey !important;
      border:none !important;
    }

  </style>

<div id="getclientbrand_18_loading"></div>

  <div id="getclientbrand_18_product"></div>

  <script>
    getclientbrand_18();
    function getclientbrand_18() {
      var type = '18'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Brand</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getclientbrand_18_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getclientbrand_18")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getclientbrand_18_loading').html(' ');
              jQuery('#getclientbrand_18_product').html(res);
              getclientbrand18_slick();
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

function getclientbrand18_slick(){
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

          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding: 10px;" class="slider-7-prev fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="24" height="24" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#ccc"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding: 10px;" class=" slider-7-next fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="24" height="24" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)" fill="#ccc"/></svg>',

          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  6,
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
			  dots: false
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
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

 

 
