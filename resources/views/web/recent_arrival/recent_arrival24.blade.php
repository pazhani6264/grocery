
<style>
   
   .recentarrival24 .slick-track, .slick-list {
    height: 100%;
}

   .recentarrival24{
    /* background-color: #fafafa!important; */
    padding:70px 0px 20px 0px;
   }


.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.banners-content .recentarrival24 .container-fluid{
  padding-left:5px !important;
  padding-right:5px !important;
}

.product-based-cat-2 .pbc-2-header1 {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    padding:0px 10px;
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
  
    .recentarrival24 .title_change{
  text-align:center !important;
  font-size:50px !important;
  font-weight:600 !important;
  margin-bottom:0.5rem;
  margin-top:5rem;
}


.title-desc {
    color: #777;
    font-weight: 300;
    font-size: 1rem;
    line-height: 1.5;
    letter-spacing: -.01em;
    margin-bottom: 0;
    text-align:center !important;
}

.trend{
  margin-bottom:10px;
}


.recent-arrival24 .slick-next {
    right: -30px;
    width:25px !important;
  }

.recent-arrival24 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.recent-arrival24 .slick-next:hover, .slick-next:focus {
  background:transparent !important;
}


.recent-arrival24  .slick-next:before {
    content: '\203A';
    font-size:5rem;
}


 .recent-arrival24 .slick-prev {
    left: -30px !important;
    width:25px !important;
    z-index:9;
  }

.recent-arrival24 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.recent-arrival24 .slick-prev:hover, .slick-prev:focus {
  background:transparent !important;
}

.recent-arrival24 .slick-prev:before, .recent-arrival24 .slick-next:before {
    font-family: 'slick';
    line-height: 1;
    opacity: .75;
    color: grey;
}

.recent-arrival24  .slick-prev:before {
    content: '\2039';
    font-size:5rem;
} 


.recent-arrival24 #parenttrend .slick-slide {
    outline: none;
    padding:0px 10px !important;
}
.quick-fill:hover
{
  fill: #fff !important;
}
.fill-color-arrow-car
{
  fill: #999;
}
#getnewest_product .tp1-main a:hover {
    color: #fff;
}
.tp1-banner{
  margin-top:20px;
}
.tp1-bqnner-img{
  height:365px !important
}

.trendpro-carousel-js1 article .thumb {
  height: 217px;
}

.trendpro-carousel-js1 article .content {
  height: 142px;
}

#gettrend3_section_product .container {
  width: 1185px;
  max-width: 100%;
}

#gettrend3_section_product .col-md-12{
  padding-left: 0px !important;
  padding-right: 0px !important;
}

.disabled-ratings-19 #review-tabs{
  display:inline;
}

.btn-38{
  padding:6px !important;
}

@media screen and (min-width: 1200px){
    .col-md-2trend {
        flex: 0 0 20%;
        max-width: 20%;
        padding:0px 10px;
    }
    .col-md-10trend {
      flex: 0 0 80%;
      max-width: 80%;
    }
  }

  @media screen and (max-width: 992px){
    .col-md-2trend {
      display:none;
    }
    .col-md-10trend {
      flex: 0 0 100%;
      max-width: 100%;
    }
    .product-based-cat-2 .pbc-2-header1 {
        display: inline-block !important;
        text-align:center;
    }
    .recentarrival24 .col-md-12{
      padding-left:0px;
    }
    .banners-content .recentarrival24 .container-fluid {
    padding-left: 0px !important;
    padding-right: 0px !important;
}
.recentarrival24{
    /* background-color: #fafafa!important; */
    padding:100px 0px 20px 0px;
   }
  }
  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest24();
    function getallproductBynewest24() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest24")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getrecentarrival24();
              getclientbrand_21_slick()
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

function getrecentarrival24(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.trendpro-carousel-js24');

    var mobile_count = '';

	if({{$result['commonContent']['settings']['product_column']}} == 1)
	{
		mobile_count = 1;
	}
	else
	{
		mobile_count = 2;
	}


  var desktop_count = '';
  var tab_count = '';

	if({{$result['commonContent']['settings']['desktop_product_column']}} == 3)
	{
		desktop_count = 3;
    tab_count = 3;
	}
	else if({{$result['commonContent']['settings']['desktop_product_column']}} == 4)
	{
		desktop_count = 4;
    tab_count = 4;
	}else if({{$result['commonContent']['settings']['desktop_product_column']}} == 5)
  {
    desktop_count = 5;
    tab_count = 4;
  }
  

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this),
            item = jQuery(this).data('item'),
            itemmobile = jQuery(this).data('itemmobile');
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: false,
          infinite: false,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-prev" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-car common-fill-hover slider-arrow slider-next" width="16" height="16" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: desktop_count,
          slidesToScroll: 1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: tab_count,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 992,
            settings: {
              arrows: false,
              slidesToShow: 4,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              arrows: false,
              slidesToShow:  3,
              slidesToScroll: 1
            }
            }, {
            breakpoint: 600,
            settings: {
              arrows: false,
              slidesToShow: itemmobile || mobile_count,
              slidesToScroll: itemmobile || mobile_count
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
});

}


function getclientbrand_21_slick(){


jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.brand-carousel-js21');

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
          slidesToShow:  7,
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
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
}); // aboutus section


}




  </script>
