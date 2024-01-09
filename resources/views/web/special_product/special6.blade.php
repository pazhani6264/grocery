
<style>

  #gettrend6_section_product .demo-32-recent-heading{
    text-align:center;
  }
  .header-top-color-37:hover{
    color: #fdda05 !important;
  }

.trend-arrow4 .slick-dots {
    position: absolute !important;
    bottom: -52px;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style: none;
    text-align: center;
}
section.product-based-cat-5.demo-7-trent-sec {
    padding-top: 80px;
    padding-bottom: 100px;
    background: #f9fafc;
}
.trendactive4 {
    border-bottom: 2px solid !important;
}
.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.btnspecial5 {
  color: #ccc;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
}

.btntabtrend {
  color: #333;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
  margin: 5px;
  display:inline-block;
  cursor:pointer;
  font-size:1rem;
  text-transform:uppercase;
  letter-spacing: .1em;
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

.demo-7-trent-sec .slick-slide {
    padding: 0 10px !important;
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


.sp5 .product-molla-20 article .thumb{
  height: 217px;
}

.sp5 .product-molla-20 article .content{
  height: 143px;
}

.sp5 .pbc-2-title {
     font-size: 22px;
     font-weight: 600 !important;
     margin:auto;
   }

   .special5 {
    border-bottom: 1px solid #000;
    color: #000 !important;
}

.sp5  .product-molla-26 {
    margin-bottom: 0;
    margin-top: 5px;
}
.sp5  .tp1-banner {
    margin-top: 0px;
}

.sp5 .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}

.sp5 .tp1-bqnner-img {
    height: 535px !important;
}

.sp5 .pbc-2-header1 {
    padding: 0px 0px 0px 10px;
}
.sp5 .row{
  margin-left:0px;
  margin-right:0px;
}

.sp5  hr {
    border: 0;
    margin: 3.5rem auto 0 auto;
    width: 98%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

@media screen and (min-width: 1200px){
  .col-md-3trend {
      flex: 0 0 25%;
      max-width: 25%;
      padding: 0px 10px;
  }
  .col-md-9trend {
    flex: 0 0 75%;
    max-width: 75%;
  }
}

@media screen and (max-width: 992px){
   
  .mainspecial5{
    margin-top:35px !important;
  }
    .mainspecial5 .pbc-2-outer-pad {
      padding: 0 10px;
    }
    .mainspecial5 .pbc-2-header1 {
      padding: 0px 0px !important;
      width: 100%;
    }
    .sp5 hr {
      border: 0;
      margin: 3.5rem auto 0 auto;
      width: 100%;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .col-md-3trend {
      flex: 0 0 25%;
      max-width: 25%;
      padding-left:15px;
    padding-right:10px;
  }
  .col-md-9trend {
    flex: 0 0 75%;
    max-width: 75%;
    padding-left:0px;
    padding-right:10px;
  }
   
    .sp5 .row {
      margin-left: -15px;
      margin-right: -15px;
    }
}
@media screen and (max-width: 600px){

.col-md-3trend {
      flex: 0 0 100%;
      max-width: 100%;
      padding:0px 15px;
    }
    .col-md-9trend {
      flex: 0 0 100%;
      max-width: 100%;
      margin-top: 15px;
      padding: 0px 5px;
    }
    .sp5 .product article .thumb-size {
      height:240px !important;
    }
  }
  </style>




<div id="gettrend6_section_loading" ></div>

  <div id="gettrend6_section_product"></div>

  <script>
    getallproductByspecial6();
    function getallproductByspecial6() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><div class="demo-32-recent-heading"><h2 class="demo-32-recent-heading-title">Featured Products</h2><p class="demo-32-recent-heading-p">Appreciate the view ahead in a pair of affordable sunglasses.</p></div><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettrend6_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductByspecial6")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettrend6_section_loading').html(' ');
              jQuery('#gettrend6_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getqueryspecial6();
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


function getqueryspecial6(){
/* jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.special-carousel-js6');

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
              slidesToScroll: 1
            }
          }]
        });
      });
    }

    ;
  })(jQuery);
}); */

$(document).ready(function() {
  


  $('.p24-slider-cat-special6').hide();
  $('#p24-slider-cat-special6-0').show();

  $('.p24-tabs-nav-special6').on('click', function (event) {
    event.preventDefault();
    
    $('.p24-tab-active-special6').removeClass('p24-tab-active-special6 trendactive4');
    $(this).addClass('p24-tab-active-special6 trendactive4');
    var id = $(this).attr('id');
    $('.p24-slider-cat-special6').hide();
    $('#p24-slider-cat-special6-'+id).show();
    callslider_script(id)
});
/* 
$('.p24-slider-cat:first').trigger('click'); */

callslider_script(0)



function callslider_script(id)
{



  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-special6-'+id);

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

    

 /*    var $btns = $('.btntabtrend').click(function() {
      if (this.id == 'alltrend') {
        $('#parenttrend > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttrend > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive4');
      $(this).addClass('trendactive4');
    }) */
  });


}




  </script>





