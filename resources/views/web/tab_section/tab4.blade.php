<style>
  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}

.tab4 .container{
  max-width:1200px;
  padding-left:0px;
  padding-right:0px;
}

.tab4-sell-arrow .slick-next {
    right: 9.1%;
    height: calc(93%);
    background:hsla(0,0%,100%,.75) !important;
    box-shadow: -10px 0 2px -3px #f1f1f1 !important;
    width:25px !important;
    margin-top: 15px;
  }

  #demo-3-tab-section .tabs-main4 a.nav-link1 {
    font-size: 24px !important;
    font-weight: 600 !important;
    color: #ccc !important;
    padding: 8px !important;
    margin-left: 15px;
    text-transform: initial !important;
    letter-spacing: -.01em;
}
#demo-3-tab-section  .tab-content {
    padding: 5px 0px;
}
#demo-3-tab-section .tabs-main4 a.nav-link1.active {
    color: #333 !important;
    border-bottom: 1px solid !important;
}
.tab4-sell-arrow .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.tab4-sell-arrow .slick-next:hover, .slick-next:focus {
  background:#fff !important;
}


.tab4-sell-arrow  .slick-next:before {
    content: '\203A';
    font-size:3rem;
}


 .tab4-sell-arrow .slick-prev {
    left: 9.2% !important;
    height: calc(93%);
    background:hsla(0,0%,100%,.75) !important;
    box-shadow: 10px 0 2px -3px #f1f1f1 !important;
    width:25px !important;
    left:0;
    z-index:9;
    opacity:1;
    margin-top: 15px;

  }

.tab4-sell-arrow .border-20 {
    border: 0.1rem solid #ebebeb;
    background: #fff;
    margin: 15px 0px !important;
    padding-top: 0px !important;
}
.tab4-sell-arrow .slick-prev:hover, .slick-prev:focus {
  background:#fff !important;
}


.tab4-sell-arrow  .slick-prev:before {
    content: '\2039';
    font-size:3rem;
} 

.tab4-sell-arrow .slick-slide {
    outline: none;
    padding: 10px !important;
}


.pro-content .tabs-main4 .slick-arrow {
  z-index: 2;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 0px solid #ced4da !important;
  border-radius: 0;
  margin-left: 1px;
  width: 38px;
  text-align: center;
  line-height: 38px;
  text-decoration: none;
  outline: none;
  opacity: 1;
  top: 0%;
}

.pro-content .tabs-main4 .slick-arrow::after {
  background-color: #fff;
  opacity: 0;
}

.pro-content .tabs-main4 .nav {
  display: flex;
  justify-content: center;
}
.pro-content .tabs-main4 a.nav-link1.active {
  color: #333 !important;
  border-bottom: 1px solid !important;
}



.pro-content .tabs-main4 a.nav-link1 {
  font-size: 1.7rem !important;
  font-weight: 600 !important;
  color: #ccc !important;
  padding: 0.9rem !important;
  margin-left: 1.5rem;
  text-transform: initial  !important;
  letter-spacing: -.01em;
}


.tabs-main4 article .content {
  padding-bottom: 22px !important;
}


.btn {
    padding: 0.6rem 1rem !important;
}

@media only screen and (max-width: 768px)
{
  .tab4-sell-arrow .slick-next {
    right: 14.5%;
   
}
.tab4-sell-arrow .slick-prev {
    left: 14.5% !important;
    display: block;
}
.pro-content .slick-next {
    display: block !important;
}
.pro-content .slick-prev {
    display: block !important;
}
#demo-3-tab-section .slick-disabled {
    display: none !important;
}

#demo-3-tab-section .slick-next
{
  display: block;
}
 .pm-0
 {
   padding: 12px;
 } 
 .tab-carousel-js .slick-slide {
    margin: 0px 5px !important;
}

.tab4 .container{
  padding-left:10px;
  padding-right:10px;
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
  </style>




<div id="gettabcontent4_loading"></div>

  <div id="gettabcontent4_product"></div>

  @include('web.product-sections.collections')

  <script>
    getalltabcontent4();


    
    function getalltabcontent4() {
      var type = 'tab'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent4_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent4")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent4_loading').html(' ');
              jQuery('#gettabcontent4_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getquerytab4();
              
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

function getquerytab4(){


$(document).ready(function() {

  $cu_id = $('.p24-tab-id-value').val();
  //alert($cu_id);
  
  $('.p24-slider-cat-tab4').hide();
  $('#p24-slider-cat-tab4-'+$cu_id).show();

  $('.p24-tabs-nav-tab4').on('click', function (event) {
    event.preventDefault();
   
    $('.p24-tab-active-tab4').removeClass('p24-tab-active-tab4 active show');
    $(this).addClass('p24-tab-active-tab4 active show');
  
    var id = $(this).attr('id');
  
    $('.p24-slider-cat-tab4').hide();
    $('#p24-slider-cat-tab4-'+id).show();
    callslider_script(id)
});


callslider_script($cu_id)

function callslider_script(id)
{
  
  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-tab4-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: false,
          arrows: true,
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
});


}






  </script>