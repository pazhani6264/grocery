<style>
  .info-box-14-margin
  {
    margin-right: 20px;
  }
  .info-box-14-con-pad
  {
    padding: 0 10px;
  }
  .info-box-14-align
  {
    text-align: left;
  }
  .info-box-14-display
  {
    display: inline-block;
  }
  .info-box-14-section  .slick-dots {
    display: none;
     margin-top: 0px !important; 
   
}
.info-box-14-mobile-img
{
    margin: auto;
    margin-bottom: 5px;
}
.info-box-14-pad-outer
{
  padding: 15px 0;
}
.demo-34-s-slick  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.demo-34-s-slick  .slick-dots li button {
    font-size: 0;
    line-height: 0;
    display: block;
    width: 8px !important;
    height: 8px !important;
    padding: 0px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
    border-radius: 20px;
    margin: 5px 6px;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.demo-34-s-slick .slick-dots li button::after {
    content: unset;
}
.demo-34-s-slick  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}

.info-box-14-section .slick-dotted.slick-slider {
     margin-bottom: 0px; 
}

  .info-box-14-title
  {
    color: #333;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 15px;
    margin-bottom:0;
  }
  .info-box-14-p
  {
    color: #999;
    font-size: 15px;
    line-height: 1.4;
    margin-bottom:0;
  }
 
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
    
    @media only screen and (max-width: 1200px)
{
  .info-box-14-section .slick-dotted.slick-slider {
     margin-bottom: 30px; 
}
  .info-box-14-section .slick-dots {
    display: block;
    
   
}

}

    @media only screen and (max-width: 600px)
{
  .info-box-14-align
  {
    text-align: center;
  }
  .info-box-14-margin
  {
    margin-right: 0px;
  }
  .info-box-14-display
  {
    display: block;
  }
}
  
  </style>




<div id="getinfobox_14_loading" ></div>

  <div id="getinfobox_14_product"></div>

  <script>
    getinfobox_14();
    function getinfobox_14() {
      var type = '14'
      var content ='';

      content +='<section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Shopping Info</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getinfobox_14_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getinfobox_14")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getinfobox_14_loading').html(' ');
              jQuery('#getinfobox_14_product').html(res);
              getinfobox_14_slick();
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

function getinfobox_14_slick(){
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





