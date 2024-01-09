<style>
  .tab-carousel-js .slick-slide {
    margin: 0px 10px 0 0px !important;
}
.tab7 .tab-content {
    padding: 20px 0px 60px 0px;
}

.tab7 .product-molla-32 {
    margin-bottom: 0;
    margin-top: 15px;
}

.pro-content .slick-arrow {
    z-index: 2;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent !important;
    /* fill: #999 !important; */
    border: 0px solid #ced4da !important;
    border-radius: 0;
    margin-left: 1px;
    height: 15px;
    width: 25px;
    text-align: center;
    line-height: 38px;
    text-decoration: none;
    outline: none;
    opacity: 1;
    top: 48%;
}



.nav-link19.active {
    color: #333 !important;
    border-bottom: 1px solid !important;
}
.nav-link19 {
    font-size: 1.7rem !important;
    font-weight: 600 !important;
    color: #ccc;
    padding: 0.9rem !important;
    margin-left: 1.5rem;
    text-transform: initial !important;
    letter-spacing: -.01em;
}

.tab7 .slick-dotted.slick-slider {
    margin-bottom: 30px;
    margin-top: 0px;
}

.tab7arrow-color{
  fill: #999 !important;
}

.pro-content .slick-disabled{
  display:block !important;
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
.pro-content {
    padding-top: 0px !important;
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




<div id="gettabcontent7_loading"></div>

  <div id="gettabcontent7_product"></div>

  @include('web.product-sections.collections')

  <script>
    getalltabcontent7();


    
    function getalltabcontent7() {
      var type = 'tab'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Tab Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#gettabcontent7_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getalltabcontent7")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#gettabcontent7_loading').html(' ');
              jQuery('#gettabcontent7_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getquerytab7();
              
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


function getquerytab7(){


$(document).ready(function() {

  $cu_id = $('.p24-tab-id-value').val();
  //alert($cu_id);
  
  $('.p24-slider-cat-tab7').hide();
  $('#p24-slider-cat-tab7-'+$cu_id).show();

  $('.p24-tabs-nav-tab7').on('click', function (event) {
    event.preventDefault();
   
    $('.p24-tab-active-tab7').removeClass('p24-tab-active-tab7 active show');
    $(this).addClass('p24-tab-active-tab7 active show');
  
    var id = $(this).attr('id');
  
    $('.p24-slider-cat-tab7').hide();
    $('#p24-slider-cat-tab7-'+id).show();
    callslider_script(id)
});


callslider_script($cu_id)

function callslider_script(id)
{
  
  (function (jQuery) {
  var tabCarousel = jQuery('#p24-slider-cat-tab7-'+id);

    if (tabCarousel.length) {
      tabCarousel.each(function () {
        var thisCarousel = jQuery(this);
            
        thisCarousel.slick({
          lazyLoad: 'progressive',
          dots: true,
          arrows: true,
          infinite: false,
          // variableWidth: true,
          //rtl:true,
          prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="tab7arrow-color common-fill-hover fill-left-arrow slider-arrow slider-prev" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" class="tab7arrow-color common-fill-hover fill-right-arrow slider-arrow slider-next" width="20" height="20" viewBox="0 0 18 10.64"><path id="arrow" d="M11.115,12.235,18,19.44l7.2-7.2,1.8,1.64-9,9-9-9Z" transform="translate(-9 -12.235)"/></svg>',
          speed: 300,
          slidesToShow:  5,
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