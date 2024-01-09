<style>

.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.btntabtop {
  color: #777;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}
.product-based-cat-2 {
    margin-bottom: 30px;
}

.product-based-cat-2 .pbc-2-header1 {
    margin-bottom: 0px;
    display: flex;
    align-items: center;
    padding:0px 10px;
    padding-top: 43px !important;
}

.top-hr {
  margin-top: 10px;
    margin-bottom: 7px;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.top-hr {
    box-sizing: content-box;
    height: 0;
    overflow: visible;
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


.top-sell-arrow3 .slick-next {
    right: 8px;
    height: calc(93%);
    background:hsla(0,0%,100%,.75);
    box-shadow: -10px 0 2px -3px #f1f1f1 !important;
    width:25px !important;
  }

.top-sell-arrow3 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.top-sell-arrow3 .slick-next:hover, .slick-next:focus {
  background:#fff !important;
}


.top-sell-arrow3  .slick-next:before {
    content: '\203A';
    font-size:3rem;
}


 .top-sell-arrow3 .slick-prev {
    left: 10px !important;
    height: calc(93%);
    background:hsla(0,0%,100%,.75);
    box-shadow: 10px 0 2px -3px #f1f1f1 !important;
    width:25px !important;
    left:0;
    z-index:9;
  }

.top-sell-arrow3 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.top-sell-arrow3 .slick-prev:hover, .slick-prev:focus {
  background:#fff !important;
}
.tp1-main .fa-heart-o {
    color: #333;
}


.top-sell-arrow3  .slick-prev:before {
    content: '\2039';
    font-size:3rem;
} 

.top-sell-arrow3 .slick-slide {
    outline: none;
    padding: 10px !important;
}
@media screen and (max-width: 992px)
{
.product-based-cat-2 .pbc-2-header1 {
    width: 100%;
}
}

  </style>




<div id="gettopselling_loading"></div>

  <div id="gettopselling_product"></div>

  <script>
    getallproductBytopselling3();
    function getallproductBytopselling3() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling of the Weeks</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling3")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_loading').html(' ');
              jQuery('#gettopselling_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytop3();
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


function getquerytop3(){
/* jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.top-carousel-js3');

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
});
 */
$(document).ready(function() {


  $('.p24-slider-cat-top3').hide();
$('#p24-slider-cat-top3-0').show();

$('.p24-tabs-nav-top3').on('click', function (event) {
  event.preventDefault();
  
  $('.p24-tab-active-top3').removeClass('p24-tab-active-top3 trendactive');
  $(this).addClass('p24-tab-active-top3 trendactive');
  var id = $(this).attr('id');
  $('.p24-slider-cat-top3').hide();
  $('#p24-slider-cat-top3-'+id).show();
  callslider_script(id)
});
/* 
$('.p24-slider-cat:first').trigger('click'); */

callslider_script(0)



function callslider_script(id)
{



(function (jQuery) {
var tabCarousel = jQuery('#p24-slider-cat-top3-'+id);

  if (tabCarousel.length) {
    tabCarousel.each(function () {
      var thisCarousel = jQuery(this);
          
      thisCarousel.slick({
        lazyLoad: 'progressive',
          dots: false,
          arrows: true,
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
    

   /*  var $btns = $('.btntabtop').click(function() {
      if (this.id == 'alltop') {
        $('#parenttop > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttop > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive');
      $(this).addClass('trendactive');
    }) */
  });


}


  </script>
