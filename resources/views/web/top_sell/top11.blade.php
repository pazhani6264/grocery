<style>
  .top-selling-2-sec{
    padding:2.5rem 0 2.5rem 0;
  }
  .top-carousel-js11 .slick-slide{
    padding:0 10px !important;
  }
  .categories-carousel-js .slick-slide {
    margin: 0px 0px 0 0 !important;
}
.content_loading {
  display: flex;
  justify-content: center;
  padding: 100px 0;
}
.top-selling-2-sec .product article .thumb {
    height: 218px;
}
  .content_loading .dot {
    width: 1rem;
    height: 1rem;
    margin: 2rem 0.3rem;
    background: #979fd0;
    border-radius: 50%;
    animation: 0.9s bounce infinite alternate;
  }
  .product-based-cat-2 .pbc-2-header {
    margin-bottom: 2rem !important;
    display: flex;
    align-items: center;
}
.product-based-cat-2 .pbc-2-title {
    margin-bottom: 0;
    flex: 1 1 auto;
    font-size: 30px;
    font-weight: 500;
    letter-spacing:-.01em;
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


.btntab2 {
  color: #999;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:0.9rem;
  text-transform:uppercase;
}


.Cate{
  margin-bottom:10px;
}
.spacer {
  clear: both;
  height: 30px;
}

.cateactive11 {
    border: 1px solid #333;
    color: #333 !important;
}

@media screen and (max-width: 992px){
  .top-carousel-js11  .slick-dots {
    position: static !important;
    margin-top: 10px !important;
  }

}
  </style>




<div id="gettopselling_loading"></div>

  <div id="gettopselling_product"></div>

  <script>
    getallproductBytopselling11();
    function getallproductBytopselling11() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling of the Weeks</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling11")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_loading').html(' ');
              jQuery('#gettopselling_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytop11();
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

function getquerytop11(){

$(document).ready(function() {
  


  $('.p24-slider-cat-top11').hide();
  $('#p24-slider-cat-top11-0').show();

  $('.p24-tabs-nav-top11').on('click', function (event) {
    event.preventDefault();
    
    $('.p24-tab-active-top11').removeClass('p24-tab-active-top11 cateactive11');
    $(this).addClass('p24-tab-active-top11 cateactive11');
    var id = $(this).attr('id');
    $('.p24-slider-cat-top11').hide();
    $('#p24-slider-cat-top11-'+id).show();
    callslider_script(id)
});
/* 
$('.p24-slider-cat:first').trigger('click'); */

callslider_script(0)



function callslider_script(id)
{



  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-top11-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
          infinite: false,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-special common-fill-hover slider-arrow slider-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-special common-fill-hover slider-arrow slider-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow:  5,
          slidesToScroll:  1,
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
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


/* 
  var $btns = $('.btntab2').click(function() {
    if (this.id == 'all') {
      $('#parent2 > div > div > div').fadeIn(450);
    } else {
      var $el = $('.' + this.id).fadeIn(450);
      $('#parent2 > div > div > div').not($el).hide();
    }
    $btns.removeClass('cateactive11');
    $(this).addClass('cateactive11');
  })*/
}); 


/* jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.top-carousel-js11');

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
          arrows: true,
          infinite: false,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow-special common-fill-hover slider-arrow slider-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow-special common-fill-hover slider-arrow slider-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
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
 */



}


  </script>
