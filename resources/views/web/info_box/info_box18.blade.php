<style>
  
  .info-boxes-contents .info-box .panel .fas {
    font-size: 35px;
    margin-bottom: 0;
    text-align: center;
    align-self: center;
    margin: 0px 15px 0px 0px;
}
.info-boxes-contents {
    padding: 0.7rem 15px 1.7rem 15px;
}

@media only screen and (max-width: 992px) {
  .banners-content #getinfobox_18_product .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
  }
  .info-boxes-contents {
      padding: 0.7rem 15px 1.7rem 0px;
  }
  .info-boxes-contents .info-box{
    padding-left:10px;
  }
}
  </style>




<div id="getinfobox_18_loading" ></div>

  <div id="getinfobox_18_product"></div>

  <script>
    getinfobox_18();
    function getinfobox_18() {
      var type = '18'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_18_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_18")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_18_loading').html(' ');
              jQuery('#getinfobox_18_product').html(res);
              getinfobox_18_slick();
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

function getinfobox_18_slick(){
jQuery(document).ready(function () {
  (function (jQuery) {
  var tabCarousel = jQuery('.infobox-carousel-js');

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
          slidesToScroll:  4,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
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





