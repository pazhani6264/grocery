<style>
 .categories-carousel-js-new .slick-slide {
    margin: 0px 10px 0 0px !important;
}

.ptb30{
  padding:30px 0px !important
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




<div id="getcollections_loading" ></div>

  <div id="getcollections_product" style="background:#fff"></div>

 

  <script>
    getallcollections();


    
    function getallcollections() {
      var type = 'collections'
      var content ='';
      
      jQuery.ajax({
          url: '{{ URL::to("/getallcollections")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcollections_loading').html(' ');
              jQuery('#getcollections_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();

              getcollectionslider();
              
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

function getcollectionslider(){

      jQuery(document).ready(function () {

        (function (jQuery) {
        var tabCarousel = jQuery('.categories-carousel-js-new');
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
              slidesToShow: item || desktop_count,
              slidesToScroll: item || desktop_count,
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
                  slidesToShow: 3,
                  slidesToScroll: 3,
                }
                },{
                breakpoint: 600,
                settings: {
                  slidesToShow: itemmobile || mobile_count,
                  slidesToScroll: itemmobile || mobile_count,
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