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
  
    .info-bg-6 .panel{
  text-align:left;
}
.info-bg-6 .title{
  font-size:1rem;
  font-weight:600;
  text-transform:uppercase;
  margin-bottom:0;
}
.info-bg-6 .info-color-p-1{
  font-size:0.9rem;
}
.info-bg-6 .info-icon{
  font-size:1.5rem;
}
.info-bg-6 {
    background-color: #222;
}

@media screen and (max-width: 992px){
  .info-bg-6-carousal {
      background: #222;
      margin: 0px 10px;
  }
}

  </style>




<div id="getinfobox_6_loading" ></div>

  <div id="getinfobox_6_product"></div>

  <script>
    getinfobox_6();
    function getinfobox_6() {
      var type = '6'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_6_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_6")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_6_loading').html(' ');
              jQuery('#getinfobox_6_product').html(res);
              getinfobox_6_slick();
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

function getinfobox_6_slick(){
jQuery(document).ready(function () {
  (function (jQuery) {
  var tabCarousel = jQuery('.infobox-carousel-js');

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
          slidesToScroll:  4,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
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





