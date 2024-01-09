
<style>
   
.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.product-based-cat-4 .demo-6-trend {
  margin-bottom: 20px;
}

#gettrend4_section_product .common-fill:hover
{
  fill: #fff !important;
}

.btntabtrend {
  color: #333;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:0.9rem;
  text-transform:uppercase;
}

.product-based-cat-4{
  margin-top:5.65rem;
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
      font-size:24px !important;
      font-weight:600 !important
    }
.trend{
  margin-bottom:10px;
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

.product-based-cat-4 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin-top: 20px;
    padding-top: 0px !important;
}


.trendactive4 {
    border-bottom: 2px solid #333 !important;
}

.btntabtrend:hover {
    border-bottom: 2px solid #333 !important;
}

.product-based-cat-4 .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}

.product-based-cat-4 .container {
    width: 1200px;
    max-width: 100%;
}

.trendpro-carousel-js4 .product-molla-23 {
    margin-bottom: 0;
    margin-top: 20px;
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
    .product-based-cat-4 .container{
      padding-left:5px !important;
      padding-right:5px !important;
    }
  
  }
  </style>




<div id="gettrend4_section_loading" ></div>

  <div id="gettrend4_section_product"></div>

  <script>
    getalltrendproduct4_section();
    function getalltrendproduct4_section() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettrend4_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct4_section")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettrend4_section_loading').html(' ');
              jQuery('#gettrend4_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery4();
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

function gettrendquery4(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.trendpro-carousel-js4');

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
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: desktop_count,
          slidesToScroll: desktop_count,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: tab_count,
              slidesToScroll: tab_count
            }
          }, {
            breakpoint: 992,
            settings: {
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              dots: true,
              slidesToShow:  3,
              slidesToScroll: 3
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

$(document).ready(function() {
    

    var $btns = $('.btntabtrend').click(function() {
      if (this.id == 'alltrend') {
        $('#parenttrend > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttrend > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive4');
      $(this).addClass('trendactive4');
    })
  });


}




  </script>
