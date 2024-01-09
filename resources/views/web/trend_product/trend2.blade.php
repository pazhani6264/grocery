
<style>
   
.pbc-2-title1 {
  font-size: 30px;
  font-weight: 600 !important;
  margin:auto;
}
.tp1-bqnner-img {
    height: 398px !important;
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
    margin: 10px 0px !important;
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
  
    padding-top: 0px !important;
}
.top-sell-arrow3 .slick-prev:hover, .slick-prev:focus {
  background:#fff !important;
}
.product-molla-20 article .content {
    padding-bottom: 12px !important;
}


.top-sell-arrow3  .slick-prev:before {
    content: '\2039';
    font-size:3rem;
} 

.top-sell-arrow3 .trend-carousel-js2 .slick-slide {
    outline: none;
    padding: 0px 10px !important;
}

.tp1-banner{
  margin-top:20px;
}

.tp2-main .row{
  margin-left:0px;
} 

.trendpro-carousel-js1 article .thumb {
  height: 217px;
}

.trendpro-carousel-js1 article .content {
  height: 142px;
}


.slick-track {
  margin-left:0 !important;
}

#trend2-inner-content .tab-content {
  padding: 10px 0px;
}

.bg-light-trend2 {
    background-color: #f4f7ff!important;
    padding: 40px 0;
}

.tp2-main  .pbc-2-header1 {
    margin-bottom: 0px;
}

.tp2-main .btn{
  font-size:1rem !important;
}


@media screen and (min-width: 1200px){
    .col-md-2trend {
        flex: 0 0 20%;
        max-width: 20%;
        padding:0px 10px;
    }
    .col-md-10trend {
      flex: 0 0 80%;
      max-width: 80%;
    }
  }

  @media screen and (max-width: 992px){
    .col-md-2trend {
      display:none;
    }
    .container.tp2-main.general-product.p-0.top-sell-arrow3 {
    text-align: center;
}
    .col-md-10trend {
      flex: 0 0 100%;
      max-width: 100%;
    }
    .product-based-cat-2 .pbc-2-header1 {
        display: inline-block !important;
        text-align:center;
    }
  }
  @media only screen and (max-width: 768px)
  {
.product-based-cat-2 .pbc-2-outer-pad {
    padding: 0 0px;
}
.product-based-cat-2 .pbc-2-title {
    font-size: 18px;
    margin-bottom: 12px;
}
  }
  </style>




<div id="gettrend2_section_loading" ></div>

  <div id="gettrend2_section_product"></div>

  <script>
    getalltrendproduct2_section();
    function getalltrendproduct2_section() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content bg-light-trend2" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettrend1_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct2_section")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettrend2_section_loading').html(' ');
              jQuery('#gettrend2_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery2();
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

function trendtop_slick_reload()
    {
      var type = 'top';
      var content ='';
      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#trend2-inner-content').html(content);
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct2_topseller_content")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#trend2-inner-content').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery2();
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

function trendmost_slick_reload()
    {
      var type = 'mostliked';
      var content ='';
      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#trend2-inner-content').html(content);
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct2_mostliked_content")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#trend2-inner-content').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery2();
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

    function trendspecial_slick_reload()
    {
      var type = 'special';
      var content ='';
      content +='<div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
      jQuery('#trend2-inner-content').html(content);
      jQuery.ajax({
          url: '{{ URL::to("/getalltrendproduct2_special_content")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#trend2-inner-content').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              gettrendquery2();
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


function gettrendquery2(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.trend-carousel-js2');

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
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow:  2,
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

$(document).ready(function() {
    

    var $btns = $('.btntabtrend').click(function() {
      if (this.id == 'alltrend') {
        $('#parenttrend > div > div > div > div').fadeIn(450);
      } else {
        var $el = $('.' + this.id).fadeIn(450);
        $('#parenttrend > div > div > div > div').not($el).hide();
      }
      $btns.removeClass('trendactive');
      $(this).addClass('trendactive');
    })
  });


}




  </script>
