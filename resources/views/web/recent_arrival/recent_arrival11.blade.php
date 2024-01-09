
<style>
.recentarrival-main11 .container {
  width: 1160px;
  max-width: 100%;
}
/* .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1
{
  padding-left:10px;
  padding-right:10px;
} */

.recentarrival-main11 .pbc-2-title {
  font-size: 24px;
  font-weight: 400 !important;
  margin:auto;
}

.btnnewarrival {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
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
  
    .title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>
}
.trend{
  margin-bottom:10px;
}


.top-sell-arrow3 .slick-slide {
    outline: none;
    padding: 10px !important;
}

.ra11 .product-molla-20 article .thumb{
  height: 217px;
}

.ra11 .product-molla-20 article .content{
  height: 143px;
}
  
  .newarrival-slick-dots .slick-dots {
    position: absolute !important;
    bottom: -40px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
    text-align: center;
}



.newarrival-slick-dots  .slick-dots li button {
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
.newarrival-slick-dots .slick-dots li button::after {
    content: unset;
}
.newarrival-slick-dots  .slick-dots li {
    position: relative;
    display: inline-block;
    width: auto;
    height: auto;
    margin: 0 5px;
    padding: 0;
    cursor: pointer;
   
}

.newarrival-carousel-js11 .slick-slide {
    margin: 0px 1px 0 0 !important;
}
.recentarrival-main11{
  margin-top:0px !important;
  padding:3.6rem 0;
}

@media screen and (max-width: 992px){

  .recentarrival-main11 {
      margin-top: 0px !important;
      padding: 3.6rem 0 4.5rem 0;
  }
   .product-based-cat-2 .pbc-2-outer-pad {
    padding: 0 10px;
  }
}


  </style>




<div id="getnewest_loading" ></div>

  <div id="getnewest_product"></div>

  <script>
    getallproductBynewest11();
    function getallproductBynewest11() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">New Arrival</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBynewest11")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getnewest_loading').html(' ');
              jQuery('#getnewest_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerynewarrival11();
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

function getquerynewarrival11(){
/* jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.newarrival-carousel-js11');

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
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  3,
              slidesToScroll: 1
            }
            }, {
            breakpoint: 600,
            settings: {
              slidesToShow: itemmobile || mobile_count,
              slidesToScroll: itemmobile || mobile_count
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); */


$(document).ready(function() {

$('.p24-slider-cat-recent11').hide();
$('#p24-slider-cat-recent11-0').show();

$('.p24-tabs-nav-recent11').on('click', function (event) {
  event.preventDefault();
  
  $('.p24-tab-active-recent11').removeClass('p24-tab-active-recent11 trendactive');
  $(this).addClass('p24-tab-active-recent11 trendactive');
  var id = $(this).attr('id');
  $('.p24-slider-cat-recent11').hide();
  $('#p24-slider-cat-recent11-'+id).show();
  callslider_script(id)
});
/* 
$('.p24-slider-cat:first').trigger('click'); */

callslider_script(0)

function callslider_script(id)
{
(function (jQuery) {
var tabCarousel = jQuery('#p24-slider-cat-recent11-'+id);

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

/*   $('.p24-slider-cat').slick({
slidesToShow: 5,
slidesToScroll: 1,
dots: true,
arrows: true,
infinite: false,
autoplaySpeed: 300,


});
  
*/
    

    /* var $btns = $('.btnnewarrival').click(function() {
      if (this.id == 'allnewarrival') {
        $('#parentnewarrival > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parentnewarrival > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive');
      $(this).addClass('trendactive');
    }) */
  });


}



  </script>
