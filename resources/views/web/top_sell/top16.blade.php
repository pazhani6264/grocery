<style>
.mb-5 {
    margin-bottom: 5rem!important;
}
.mb-6 {
    margin-bottom: 6rem!important;
}
.slick-disabled
{
   cursor: default !important;
   fill: #777 !important;
}
.home-page-top16 .heading .subtitle {
    font-size: 1.7rem;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -.025em;
    color: #222;
    margin-bottom: 1rem;
}
.home-page-top16 .heading .title {
    font-size: 4.3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
    display:block;
    margin-bottom: 1.5rem !important;
}
.choose-color .heading .content {
    color: #999;
}
.home-page-top16 .heading .content {
    font-size: 1.15rem;
    font-weight: 400;
    line-height: 1.9;
    letter-spacing: -.01em;
}
.choose-color .color-content, .choose-color .desc p {
    margin-left: auto;
    margin-right: auto;
}
.mt-2 {
    margin-top: 2rem!important;
}
.choose-color .desc p {
    max-width: 414px;
    color: #999;
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: -.01em;
}
.price {
    display: inline-block;
    vertical-align: middle;
    margin-right: 2rem;
}
.home-page-top16 .btn-cart.btn-cart-home {
    font-weight: 600;
    letter-spacing: -.025em;
    text-decoration: none!important;
    padding: 0.8rem 4.9rem!important;
    -webkit-box-shadow: 0 15px 30px rgba(23,43,104,.2)!important;
    box-shadow: 0 15px 30px rgba(23,43,104,.2)!important;
}


.top-carousel-js16 .slick-slide img {
    display: block;
    width: 100%;
}


.top16 .slick-list {
    height: 500px !important;
}




.top16 .slick-next {
    right: -60px;
    height: 60px;
    background: hsla(0,0%,100%,.75);
    width: 60px !important;
    border-radius: 50%;
    top: 35%;
    border:1px solid #ebebeb;
  }

.top16 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.top16 .slick-next:hover, .slick-next:focus {
  background:#fff !important;
  color:#333;
}


.top16  .slick-next:before {
    content: '\203A';
    font-size: 4rem;
    top: -9px;
    position: absolute;
    left: 23px;
}


 .top16 .slick-prev {
    left: -60px !important;
    height: 60px;
    background:hsla(0,0%,100%,.75);
    width:60px !important;
    z-index:9;
    border-radius: 50%;
    top: 35%;
    border:1px solid #ebebeb;
  }

.top16 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.top16 .slick-prev:hover, .slick-prev:focus {
  background:#fff !important;
  color:#333 !important;
  box-shadow: 0 5px 20px rgb(34 34 34 / 3%);
}
.top16 .slick-next:hover, .slick-next:focus {
  background:#fff !important;
  color:#333 !important;
  box-shadow: 0 5px 20px rgb(34 34 34 / 3%);
}


.top16  .slick-prev:before {
    content: '\2039';
    font-size: 4rem;
    top: -8px;
    position: absolute;
    left: 18px;
} 

@media screen and (min-width: 992px){
    .choose-color .color-content {
        max-width: 30%;
    }
}
@media screen and (min-width: 576px){
    .choose-color .color-content {
        max-width: 50%;
    }
}
@media screen and (max-width: 576px){

.home-page-top16 .heading .title {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -.025em;
    color: #222;
    display: block;
    margin-bottom: 1.5rem !important;
}
}

  </style>




<div id="gettopselling_loading"></div>

  <div id="gettopselling_product"></div>

  <script>
    getallproductBytopselling16();
    function getallproductBytopselling16() {
      var type = 'topselling'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Top Selling of the Weeks</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettopselling_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBytopselling16")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettopselling_loading').html(' ');
              jQuery('#gettopselling_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettopsell16();
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


function gettopsell16(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.top-carousel-js16');

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
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding:19px;" class="fill-left-arrow fill-color-arrow-special slider-arrow slider-prev slick-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" style="padding:19px;" class="fill-right-arrow fill-color-arrow-special slider-arrow slider-next slick-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          speed: 300,
          slidesToShow: 1,
          slidesToScroll: 1,
          adaptiveHeight: false,
          responsive: [{
            breakpoint: 1025,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 992,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              arrows: false,
              slidesToShow:  1,
              slidesToScroll: 1
            }
            }, {
            breakpoint: 600,
            settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
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
