<style>

  .p24-slider-cat-tab3 .product-molla-19{
    margin-bottom:20px;
  }
  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}

#gettabcontent3_product .slick-dots
{
  position: relative !important;
}

.slick-slide {
    outline: none;
    padding: 0 10px !important;
}

.blog-slick-dots .slick-dots {
  position: relative !important;
  bottom: 0px;
  display: block;
  width: 100%;
  padding: 0;
  margin: 0;
  list-style: none;
  text-align: center;

  }

  .blog-slick-dots .slick-dots li
{
  position: relative;

  display: inline-block;

  width: 20px;
  height: 20px;
  margin: 0 5px;
  padding: 0;

  cursor: pointer;
}
.blog-slick-dots .slick-dots .slick-active
{
  margin-right:10px !important;
}


.blog-slick-dots .slick-dots li button:hover,
.blog-slick-dots .slick-dots li button:focus
{
  outline: none;
  /* width: 25px !important; */

}
.tblog-slick-dots .slick-dots li button:hover:before,
.blog-slick-dots .slick-dots li button:focus:before
{
  opacity: 1;
}
.blog-slick-dots .slick-dots li button:before
{
  font-family: 'slick';
  font-size: 6px;
  line-height: 20px;

  position: absolute;
  top: 0;
  left: 0;

  width: 20px;
  height: 20px;

  content: '\2022';
  text-align: center;

  opacity: .25;
  color: black;

  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.blog-slick-dots .slick-active button:before
{
  opacity: .75;
  color: black;
  width: 25px !important;

}

@media only screen and (max-width: 768px)
{
 .pm-0
 {
   padding: 12px;
 } 
 .tab-carousel-js .slick-slide {
    margin: 0px 5px !important;
}
.demo-2-tab-section .pbc-2-header1 {
    display: block !important;
    text-align: center;
}
}
@media only screen and (max-width: 420px)
{
  .product article .btn-all {
    height: 300px;
}

}
@media only screen and (max-width: 367px)
{
  .product article .btn-all {
    height: 300px;
}

}

</style>



<style>

.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}

.btntabtrend {
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
  </style>




<div id="gettabcontent3_loading"></div>

  <div id="gettabcontent3_product"></div>

  @include('web.product-sections.collections')

  <script>
   getalltabcontent3();
    function getalltabcontent3() {
      var type = '3'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trendy Products</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent3_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent3")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent3_loading').html(' ');
              jQuery('#gettabcontent3_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettabquery3();
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

function gettabquery3(){
/* jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.tab-carousel-js3');

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
          slidesToScroll: desktop_count,
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

  $('.p24-slider-cat-tab3').hide();
  $('#p24-slider-cat-tab3-0').show();

  $('.p24-tabs-nav-tab3').on('click', function (event) {
    event.preventDefault();
   
    $('.p24-tab-active-tab3').removeClass('p24-tab-active-tab3 trendactive active show');
    $(this).addClass('p24-tab-active-tab3 trendactive active show');
  
    var id = $(this).attr('id');
  
    $('.p24-slider-cat-tab3').hide();
    $('#p24-slider-cat-tab3-'+id).show();
    callslider_script(id)
});


callslider_script(0)

function callslider_script(id)
{
  
  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-tab3-'+id);

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
/* 
    var $btns = $('.btnnewarrival').click(function() {
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
