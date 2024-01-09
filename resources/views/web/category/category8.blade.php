

  <style>

.categories-content7{
  margin-top:5rem;
}
.banner-content-category {
    display: inline-block;
    position: absolute;
    padding-top: 0.4rem;
    left: 4rem;
    top: 50%;
    z-index: 2;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -ms-transform: translateY(-50%);
}

.banners-content #getcategory8_product .container-fluid [class^=col] {
    padding-right: 10px;
    padding-left: 10px;
}
.banners-content #getcategory8_product .container-fluid .row {
  margin-right: -8px !important;
  margin-left: -8px !important;
}
.banners-content #getcategory8_product .container-fluid figure img {
    width: 100%;
    height: 200px;
}
.category{
  font-size:1.15rem;
}
.action{
  font-size:1rem;
}

.categories-content7  .row>div:focus .action, .categories-content7 .row>div:hover .action {
  border-bottom:1px solid;
  display:block;

}


@media screen and (max-width: 768px){

  .banners-content #getcategory8_product .container-fluid {
    padding-left: 10px;
    padding-right: 10px;
  }
  #getcategory8_product figure{
    margin-bottom:15px !important;
  }
}

  </style>




<div id="getcategory8_loading"></div>

  <div id="getcategory8_product"></div>

  <script>
    getallproductBycategory8();
    function getallproductBycategory8() {
      var type = 'category_section'
      var content ='';

      content +='<section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory8_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory8")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory8_loading').html(' ');
              jQuery('#getcategory8_product').html(res);
              getquerycat5();
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

function getquerycat5(){
jQuery(document).ready(function () {

  (function (jQuery) {
    var tabCarousel = jQuery('.cat5-carousel-js');

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
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 768,
			
            settings: {
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
			  
            }
          }]
        });
      });
    }

    ;
  })(jQuery);


  (function (jQuery) {
    var tabCarousel = jQuery('.cat1-carousel-js-mobile');

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
		  rows: 2,
          // variableWidth: true,
          //rtl:true,
          speed: 300,
          slidesToShow: item || {{$result['commonContent']['settings']['home_categories_records']}},
          slidesToScroll: item || {{$result['commonContent']['settings']['home_categories_records']}},
          adaptiveHeight: true,
          responsive: [{
            breakpoint: 1025,
			
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5
            }
          }, {
            breakpoint: 992,
            settings: {
				
              slidesToShow: 4,
              slidesToScroll: 4
            }
          }, {
            breakpoint: 768,
			
            settings: {
              slidesToShow: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}},
              slidesToScroll: itemmobile || {{$result['commonContent']['settings']['home_categories_records_mobile']}}
			  
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
