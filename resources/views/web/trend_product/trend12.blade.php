
<style>
   
.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}
.demo-7-trent-sec .product-molla-24 {
    margin-bottom: 0;
    margin-top: 0px !important;
}

.product-based-cat-5{
  padding-top:4.2rem;
  padding-bottom:0rem;
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
  
    .title_change_trend4{
      text-align:center !important;
      font-size:44px !important;
      font-weight:700 !important;
      letter-spacing: .1em;
    }
.trend{
  margin-bottom:10px;
}


.new-tile {
    font-weight: 300;
    letter-spacing: .1em;
    color: #777;
    text-transform: uppercase;
    margin-bottom: 2rem;
    text-align:center;
}


.tp1-banner{
  margin-top:20px;
}
.tp1-bqnner-img{
  height:365px !important
}
.tp1-main .row{
  margin-left:0px;
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

.product-based-cat-5 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin-top: 20px;
    padding-top: 0px !important;
}


.trendactive4 {
    border-bottom: 2px solid #333 !important;
}


.product-based-cat-5 .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}

.product-based-cat-5 .container {
    width: 1200px;
    max-width: 100%;
}

.trendpro-carousel-js5 .product-molla-23 {
    margin-bottom: 0;
    margin-top: 20px;
}

.product-based-cat-5 .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
}

.trend-arrow4 .slick-dots {
    position: static !important;
    margin-top: 50px !important;
}
.product-molla-24.product9.product article .content {
    padding-bottom: 35px !important;
}

#gettrend12_section_product .slick-dotted.slick-slider {
    margin-bottom: 00px;
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
    .product-based-cat-5 .container{
      padding-left:5px !important;
      padding-right:5px !important;
    }
  
  }
  </style>




<div id="gettrend12_section_loading" ></div>

  <div id="gettrend12_section_product"></div>

  <script>
    getalltrendproduct12_section();
    function getalltrendproduct12_section() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettrend12_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct12_section")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettrend12_section_loading').html(' ');
              jQuery('#gettrend12_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery5();
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

function gettrendquery5(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.trendpro-carousel-js12');

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
          dots: true,
          arrows: false,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: desktop_count,
          slidesToScroll: 2,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: tab_count,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 992,
            settings: {
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              dots: true,
              slidesToShow:  3,
              slidesToScroll: 1
            }
            }, {
            breakpoint: 600,
            settings: {
              dots: true,
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




  </script>
