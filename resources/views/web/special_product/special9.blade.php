
<style>
   
   .choose-style {
    margin-top: 50px;
    background-repeat: no-repeat;
  }
  .choose-style .container-fluid {
    
    padding-top: 50px;
    padding-bottom: 25px;
    width:100%;
}
.choose-style .banner-intro {
    margin-top: auto;
    margin-bottom: 100px;
    padding-left: 0;
}
.choose-style h3.title {
    color: #fff;
    font-weight: 700;
    font-size: 1.75rem;
    letter-spacing: 0;
    margin-bottom: 5px;
    text-transform: none;
    line-height: 1.2em;
}
.choose-style p {
    color: #ebebeb;
    font-weight: 400;
    font-size: 1.15rem;
    letter-spacing: 0;
    margin-top: 18px;
    margin-bottom: 8px;
}
.choose-style h4.content {
    color: #fff;
    font-weight: 400;
    font-size: 1.4rem;
    letter-spacing: 0;
    margin-bottom: 3px;
    line-height: 1.25em;
}
.choose-style .price {
    font-size: 1.4rem;
    letter-spacing: 0;
    margin-top: 23px;
}
.choose-style .btn {
    margin-top: 1rem;
    min-width: unset;
    padding: 0.6rem 1rem;
}
.btn-demoprimary {
    color: #fff;
    font-size: 1rem;
    background-color: transparent;
    border-color: #fff;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: all .3s;
    transition: all .3s;
    padding-top: 5px;
    padding-bottom: 5px;
}
.choose-style .carousel {
    padding: 0;
}
.heading {
    margin-bottom: 16px;
}
.choose-style .heading .title {
    padding-top: 10px;
    text-transform: uppercase;
    margin-bottom: 10px;
}


.choose-style .heading {
    margin-bottom: 26px;
    margin-top: 70px;
}
.home-page .heading .title {
    font-weight: 700;
    font-size: 34px;
    letter-spacing: -.025em;
    margin-top: 60px;
}
.choose-style .heading .content {
    margin-top: 0;
    margin-bottom: 30px;
}
.home-page .heading .content {
    font-size: 1.6rem;
    font-weight: 400;
    letter-spacing: 0;
    margin-top: 20px;
    color: #777;
    line-height: 1.4;
}
.col-lg-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
}
.col-lg-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
}

.choose-style .product-molla-33 {
    margin-bottom: 0;
    margin-top: 0px;
}

.special-carousel-js9 .slick-slide {
    outline: none;
    padding: 0 10px;
}

.choose-style .border-20 {
    border: 0rem solid #ebebeb;
    background: #fff;
    margin-top: 0px;
    padding-top: 0px !important;
    margin-bottom:5px;
}

@media screen and (max-width: 1500px){
  .choose-style .banner-intro {
      padding-left: 30px;
  }
  .choose-style .banner-intro {
    background-position: 50%;
    padding-top: 185px;
    padding-bottom: 50px;
    padding-left: 30px;
    margin-top: 0;
    margin-bottom: 0!important;
}
}

@media screen and (max-width: 1199px){
  .choose-style {
      margin-top: 10px;
  }
  .choose-style .carousel {
    text-align: center;
}
}

@media screen and (max-width: 768px){

.col-lg-5 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
.col-lg-7 {
  -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
}
  </style>






<div id="getspecial_loading8" ></div>

<div id="getspecial_product8"></div>

<script>
  getallproductByspecial9();
  function getallproductByspecial9() {
    var type = 'special';
    var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Special Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getspecial_loading8').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductByspecial9")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getspecial_loading8').html(' ');
              jQuery('#getspecial_product8').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getspecial9();
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

function getspecial9(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.special-carousel-js9');

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
          slidesToShow: 3,
          slidesToScroll: 1,
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
              arrows: false,
              dots: false,
              slidesToShow: 3,
              slidesToScroll: 3
            }
          }, {
            breakpoint: 768,
            settings: {
              arrows: false,
              dots: false,
              slidesToShow:  3,
              slidesToScroll: 3
            }
            }, {
            breakpoint: 600,
            settings: {
              arrows: false,
              dots: false,
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
