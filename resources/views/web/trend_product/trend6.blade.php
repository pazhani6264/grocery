
<style>
   .product9.product article:hover {
    box-shadow: unset !important;
}
.fill-color-arrow
{
  fill: #999;
}
.trend-arrow6 .ajax_product_26 article:hover {
    background-color: transparent !important; 
}
   .gettrend6{
    background-color: #fafafa !important;
    padding:3.4rem 0rem;
   }
   .gettrend6 .pbc-2-title {
     font-size: 22px;
     font-weight: 600 !important;
     margin:auto;
   }

   .trend-arrow6 .col-md-12{
    padding-left:0px;
    padding-right:0px;
   }

   /* .gettrend6 .slick-disabled {
      display: block !important;
      cursor:auto;
    } */
   
   .btntabtrend {
     color: #ccc;
     padding: 5px 10px 5px 10px;
     text-decoration: none;
     margin: 5px;
     display:inline-block;
     cursor:pointer;
     font-size:1rem;
     text-transform:uppercase;
     font-weight:600;
   }
   
   .product-based-cat-2 .slick-disabled {
    display: block !important;
} 
   .gettrend6 .pbc-2-header1 {
       margin-bottom: 0px !important;
       display: flex;
       align-items: center;
       padding:0px 0px 0px 10px;
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
   
   
.trend-arrow6 .slick-next {
    right: -30px;
    width:25px !important;
  }

.trend-arrow6 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.trend-arrow6 .slick-next:hover, .slick-next:focus {
  background:transparent !important;
}


.trend-arrow6  .slick-next:before {
    content: '\203A';
    font-size:4rem;
}


 .trend-arrow6 .slick-prev {
    left: -30px !important;
    width:25px !important;
    z-index:9;
  }

.trend-arrow6 .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.trend-arrow6 .slick-prev:hover, .slick-prev:focus {
  background:transparent !important;
}


.trend-arrow6  .slick-prev:before {
    content: '\2039';
    font-size:4rem;
} 

.trend-arrow6 .slick-slide {
    outline: none;
    padding: 10px !important;
}
   

.trend-arrow6 .slick-next:before {
    font-family: 'slick';
    line-height: 1;
    opacity: .75;
    color: #999;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.trend-arrow6 .slick-prev:before, .slick-next:before {
    font-family: 'slick';
    line-height: 1;
    opacity: .75;
    color: #999;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}


.trend-arrow6 .product-molla-26 {
    margin-bottom: 0;
    margin-top: 0px;
}

.trendactive6 {
    border-bottom: 1px solid #000;
    color: #000 !important;
}


   .tp1-banner{
     margin-top:20px;
   }
   .tp1-bqnner-img{
     height:365px !important
   }
   .tp1-main .row{
     margin-left:0px;
   } 
   
   .trendpro-carousel-js1 article .thumb {
     height: 217px;
   }
   
   .trendpro-carousel-js1 article .content {
     height: 142px;
   }

   .tp1-main .product-molla-26 .active {
    color: #fff;
  }

  .trend-arrow6 .slick-dots {
    display: none !important;
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
       .trend-arrow6 .slick-dots {
    display: block !important;
}
 
       .col-md-10trend {
         flex: 0 0 100%;
         max-width: 100%;
       }
       .gettrend6 .pbc-2-header1 {
           display: inline-block !important;
           text-align:center;
       }
       .gettrend6 .pbc-2-outer-pad {
           padding: 0 !important;
      }
      .gettrend6 .product9 article .content .price {
         font-size: 1rem !important;
      }
      .gettrend6 .product article .thumb-size {
          height: 240px !important;
      }
      .gettrend6 .pbc-2-header1 {
        width:100%;
      }

     }
     </style>
   
   
   
   
   <div id="gettrend6_section_loading" ></div>
   
     <div id="gettrend6_section_product"></div>
   
     <script>
       getalltrendproduct6_section();
       function getalltrendproduct6_section() {
         var type = '2'
         var content ='';
   
         content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Trending Product</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
         jQuery('#gettrend1_section_loading').html(content);
         
         jQuery.ajax({
             url: '{{ URL::to("/getalltrendproduct6_section")}}',
             headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
             type: "POST",
             data: 'type='+type,
               success: function (res) { 
                 jQuery('#gettrend6_section_loading').html(' ');
                 jQuery('#gettrend6_section_product').html(res);
                 jQuery('.add-to-cart-d-hide').show();
                 jQuery('.added-to-cart-d-hide').hide();
                 gettabquery();
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
   
   function gettabquery(){

   
   $(document).ready(function() {
       

    $('.p24-slider-cat').hide();
  $('#p24-slider-cat-trend6-0').show();

  $('.p24-tabs-nav').on('click', function (event) {
    event.preventDefault();
    
    $('.p24-tab-active').removeClass('p24-tab-active trendactive6');
    $(this).addClass('p24-tab-active trendactive6');
    var id = $(this).attr('id');
    $('.p24-slider-cat').hide();
    $('#p24-slider-cat-trend6-'+id).show();
    callslider_script(id)
});
/* 
$('.p24-slider-cat:first').trigger('click'); */

callslider_script(0)



function callslider_script(id)
{



  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-trend6-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: true,
          infinite: false,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-left-arrow fill-color-arrow common-fill-hover slider-arrow slider-prev" width="18" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
    	  nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="fill-right-arrow fill-color-arrow common-fill-hover slider-arrow slider-next" width="18" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
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

/*   $('.p24-slider-cat').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  dots: true,
  arrows: true,
  infinite: false,
  autoplaySpeed: 300,
  
  
});
    
 */

   
      /*  var $btns = $('.btntabtrend').click(function() {
         if (this.id == 'alltrend') {
           $('#parenttrend > div > div > div > div').fadeIn(450);
         } else {
           var $el = $('.' + this.id).fadeIn(450);
           $('#parenttrend > div > div > div > div').not($el).hide();
         }
         $btns.removeClass('trendactive6');
         $(this).addClass('trendactive6');
       }) */
     });
   
   
   }
   
   
   
   
     </script>
   