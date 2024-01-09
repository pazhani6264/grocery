

  <style>
    .title_changes_act{
  text-align:center !important;
  font-size:24px !important;
  font-weight:500 !important;
}
    .categories-content .cat-banner .categories-image .categories-title h3 {
    font-size: 0.8rem;
    margin-bottom: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
.header-twele .header-navbar nav .navbar-collapse ul .nav-item .nav-link {
    padding: 1.1rem 20px 1.1rem 5px !important;
}

.cat-block {
display: flex;
flex-direction: column;
justify-content: flex-end;
align-items: center;
text-align: center;
margin-bottom: 3rem;
}

.cat-block-title {
    color: #333;
    font-weight: 500;
    font-size: 1rem;
    letter-spacing: -.01em;
    margin-top: 2rem;
    margin-bottom: 0;
    text-transform: capitalize;
}

.cat-block:hover figure span:after {
opacity: 1;
}
.cat-block:hover img {
-webkit-transform: translateY(-14px);
transform: translateY(-14px);
}

.cat-block figure span:after {
content: "";
display: block;
position: absolute;
left: 45%;
width: 105%;
margin-left: -45%;
height: .3rem;
border-radius: 50%;
background-color: rgba(0,0,0,.3);
-webkit-transition: all .35s ease;
transition: all .35s ease;
filter: blur(3px);
opacity: 0;
}

.cat-block figure {
display: inline-flex;
align-items: center;
position: relative;
flex-grow: 1;
margin: 0;
}

.cat-block .img-fluid {
max-width: 100%;
height: 100px;
object-fit: contain;
}

.categories-content{
    margin-top:3.5rem !important;
}



@media only screen and (max-width: 420px)
{
  .categories-content .cat-banner .categories-image .categories-title h3 {
    font-size: 0.8rem;
}
}

  </style>
  <style>


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
  </style>




<div id="getcategory4_loading"></div>

  <div id="getcategory4_product"></div>

  <script>
    getallproductBycategory4();
    function getallproductBycategory4() {
      var type = 'category_section'
      var content ='';

      content +='<section class="new-products-content pro-content"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory4_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory4_loading').html(' ');
              jQuery('#getcategory4_product').html(res);
              //getquerycat1();
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

function getquerycat1(){
jQuery(document).ready(function () {

  (function (jQuery) {
    var tabCarousel = jQuery('.cat4-carousel-js');

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
