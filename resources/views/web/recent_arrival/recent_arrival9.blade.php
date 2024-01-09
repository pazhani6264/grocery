
<style>
  
  .demo-33-top-4-container
{
   padding-right: 0px !important;
   padding-left: 0px !important;
}
.demo-33-recent-btn {
    margin-top: 66px;
    margin-bottom: 80px;
    width: 100%;
    text-align: center;
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
.demo-33-banner-46-btn-recent {
    font-size: 14px;
    padding: 10px 0 !important;
    border-bottom: solid 2px !important;
    font-weight: 600 !important;
}
.demo-33-top-4-section .slick-dots {
    position: static !important;
    margin-top: 0px !important;
}

.sp3{
  margin:auto;
  max-width:390px;
}

.sp3-text{
  font-weight:400 !important;
  text-align:center;
  font-size:1.15rem;
  margin-bottom: 0.5rem;
}
.sp3-para{
  font-weight:300 !important;
  text-align:center;
  font-size:1.15rem;
}

.pro-content {
    padding-top: 0px !important;
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
  
    .sp3-title_change1{
      text-align:center !important;
      font-size:30px !important;
      font-weight:600;
      text-transform:initial !important;
      margin-bottom: 1.1rem !important;
    }

    .title_change2{
     float:right;
     display:inline-block;
     font-size:1rem !important;
      font-weight:500;

    }

    .rec-pro{
      padding-top:30px !important;
      padding-bottom:60px !important;
    }

  .rec-pro .border-20 {
    border: 0rem solid #ebebeb;
    background: #fff;
    margin-top: 30px;
    padding-top: 0px !important;
  }

  .rec-pro .products-area .col-lg-3 {
    padding-right: 10px !important;
    padding-left: 10px !important;
}

.rec-pro .product-molla-20 article .thumb {
    height: 278px;
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
}
.rec-pro .content{
  height:115px !important;
}


.sp3 .product-molla-22 article .thumb {
    height: 207px;
}

.rec-pro .pro-heading-title {
    padding-bottom: 30px;
    margin-top: 30px !important;
}

.rec-pro .container {
  width: 1185px;
  max-width: 100%;
  padding-right:5px !important
}

  @media screen and (max-width: 992px){

    .demo-33-recent-btn {
    margin-top: 60px;
    margin-bottom: 50px;
    width: 100%;
    text-align: center;
}

    .rec-pro .container {
    width: 1185px;
    max-width: 100%;
    padding-left: 5px;
    padding-right: 5px;
    }

    .sp3{
      margin:auto;
      max-width:100%;
    }

    .rec-pro .col-6 {
      position: relative;
      width: 100%;
      padding-right: 10px !important;
      padding-left: 10px !important;
    }
    .tp1-banner{
      padding:0px 5px;
    }

  }

  </style>




<div id="getnewest_loading9" ></div>

<div id="getnewest_product9"></div>

<script>

getallproductBynewest9();
  function getallproductBynewest9() {
    var type = 'newest';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">FEATURED PRODUCTS</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getnewest_loading9').html(content);

    jQuery.ajax({
        url: '{{ URL::to("/getallproductBynewest9")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: 'type='+type,
          success: function (res) { 
            jQuery('#getnewest_loading9').html(' ');
            jQuery('#getnewest_product9').html(res);
            getquerynewest9slick();
            jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
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

function getquerynewest9slick(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.demo-33-recent-9-carousel-js');

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
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              dots: true,
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  3,
              slidesToScroll: 1,
              dots: true,
            }
            }, {
            breakpoint: 600,
            settings: {
              slidesToShow: itemmobile || mobile_count,
              slidesToScroll: 1,
              dots: true,
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