<style>
  .col-padding{
    padding-left:10px !important;
    padding-right:10px !important;
  }
  #getmultibanner_42_product .banner-31-img{
   /*  height:220px !important; */
  }
  #getmultibanner_42_product .demo-34-banner-container
  {
      padding-left: 0px !important;
      padding-right: 0px !important;
  }
  #getmultibanner_42_product .demo-34-banner-container .slick-dotted.slick-slider {
    margin-bottom: 0px;
}
#getmultibanner_42_product .demo-34-banner-container-outer .container-fluid figure {
   height : 240px;
}
#getmultibanner_42_product .demo-34-banner-container-outer ul.slick-dots {
   display: none;
}
#getmultibanner_42_product .demo-34-banner-container-outer
{
    margin-top : 40px;
    margin-bottom: 20px;
    position: relative;
}

#getmultibanner_42_product .demo-34-banner-container-outer .demo-34-banner-img-outer
  {
    margin :0 10px !important;
    position: relative;
  }
  #getmultibanner_42_product  .demo-34-s-slick  .slick-dots .slick-active button
{
   width: 18px !important;
   -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

#getmultibanner_42_product .demo-34-s-slick  .slick-dots li button {
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
#getmultibanner_42_product .demo-34-s-slick .slick-dots li button::after {
    content: unset;
}
#getmultibanner_42_product .demo-34-s-slick  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}

#getmultibanner_42_product .demo-34-banner-content {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 8.2%;
    margin-top: -4px;
    display: inline-block;
    z-index: 2;
}
#getmultibanner_42_product .demo-34-banner-price
{
    font-size: 34px;
    letter-spacing: 1px;
    line-height: 1.5;
    color: #fff;
    font-weight: 700!important;
}
#getmultibanner_42_product .demo-34-banner-title {
    font-size: 20px;
    margin-bottom: 20px;
    letter-spacing: 1px;
    color: #fff;
    font-weight: 600!important;
    width:65%;
}


#getmultibanner_42_product  .demo-34-lazy-media:hover:before {
    visibility: visible;
    opacity: 1;
}


#getmultibanner_42_product .demo-34-lazy-media:before {
    content: "";
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    background-color: hsla(0,0%,100%,.2);
    -webkit-transition: all .35s ease;
    transition: all .35s ease;
}


#getmultibanner_42_product .demo-34-banner-price-2
{
    font-size: 34px;
    letter-spacing: 1px;
    margin-bottom: 20px;
    color: #fff;
    font-weight: 600!important;
    width:60%;
}
#getmultibanner_42_product .demo-34-banner-title-2 {
    font-size: 20px;
    font-weight: 700!important;
    line-height: 1.5;
    letter-spacing: 1px;
    color: #fff;
   
}

#getmultibanner_42_product .demo-34-banner-btn {
    padding: 12px 0;
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 600 !important;
    letter-spacing: 1px;
    border-bottom: solid 2px;
}

#getmultibanner_42_product .demo-34-banner-btn:hover {
  color: #fff !important;
}
@media only screen and (max-width: 768px) {
  #getmultibanner_42_product .demo-34-banner-container-outer ul.slick-dots {
   display: block;
}
}
@media only screen and (max-width: 600px) {

}
 
  </style>
<!-- //banner 31 -->
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
<div id="getmultibanner_42_loading"></div>

  <div id="getmultibanner_42_product"></div>

  <script>
    getbanner_42();
    function getbanner_42() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Banners</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getmultibanner_42_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getbanner_42")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getmultibanner_42_loading').html(' ');
              jQuery('#getmultibanner_42_product').html(res);
              getmultibanner42_slick_2();
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


function getmultibanner42_slick_2(){
jQuery(document).ready(function () {
    (function (jQuery) {
  var tabCarousel = jQuery('.banner-carousel-js-42');
	
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
          slidesToShow:  3,
          slidesToScroll:  3,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
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