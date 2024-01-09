<style>
.demo-33-top-4-container
{
   padding-right: 0px !important;
   padding-left: 0px !important;
}
.demo-33-top-4-heading-container
{
  margin: 23px 0 42px 0;
  text-align: center;
}
.demo-33-top-4-title {
    font-size: 40px;
    font-weight: 400;
    color: #222;
    margin-bottom: 4px;
    padding-top: 48px;

}
.demo-33-top-4-p {
    font-weight: 400;
    font-size: 17px;
    color: #999;
    margin: 0;
}
.demo-33-top-4-section .product-molla-43 {
    margin-bottom: 0;
    margin-top: 0px;
}
.demo-33-top-4-section .slick-slide{
  margin: 0 10px !important;
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
.demo-33-top-4-section .demo-33-top-4-container .slick-dots {
    position: static !important;
    margin-top: 45px !important;
}



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


.top-sell-arrow3 .slick-next {
    right: 8px;
    height: calc(100%);
    background:hsla(0,0%,100%,.75);
    box-shadow: -10px 5px 15px rgb(0 0 0 / 10%);
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
    height: calc(100%);
    background:hsla(0,0%,100%,.75);
    box-shadow: 10px 5px 15px rgb(0 0 0 / 10%);
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


.top-sell-arrow3  .slick-prev:before {
    content: '\2039';
    font-size:3rem;
} 

.top-sell-arrow3 .slick-slide {
    outline: none;
    padding: 10px !important;
}

  </style>




<div id="gettopselling_4_loading"></div>

  <div id="gettopselling_4_product"></div>

  <script>
    getallproductBytopselling4();
    function getallproductBytopselling4() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling of the Weeks</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_4_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_4_loading').html(' ');
              jQuery('#gettopselling_4_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquerytop4();
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


function getquerytop4(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.demo-33-top-4-carousel-js');

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
          arrows: true,
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
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  3,
              slidesToScroll: 3
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

$(document).ready(function() {
    

    var $btns = $('.btntabtop').click(function() {
      if (this.id == 'alltop') {
        $('#parenttop > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttop > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive');
      $(this).addClass('trendactive');
    })
  });


}


  </script>
