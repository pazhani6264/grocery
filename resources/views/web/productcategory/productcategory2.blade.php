
<style>

.ajax_product_45 article .thumb {
    height: 230px; 
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    position: relative;
}
.product-based-cat-2 .pbc-2-link {
    margin-top: 0;
    flex: 0 1 auto;
    margin-top: 15px;
    font-weight: 700 !important;
    text-decoration: underline;
    text-underline-offset: 2px;
    white-space: nowrap;
    color:<?php if($result['commonContent']['settings']['background_color'] == '#222222'){ echo '#fff'; }else{ echo '#000';}; ?>
}

.title_change{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>;
  color:<?php if($result['commonContent']['settings']['background_color'] == '#222222'){ echo '#fff'; }else{ echo '#000';}; ?>

  
}
.pbc-2-title
{
  text-align:<?php echo $result['commonContent']['settings']['title_alignment']; ?> !important;
  font-size:<?php echo $result['commonContent']['settings']['title_font'].'px'; ?> !important;
  font-weight:<?php if($result['commonContent']['settings']['title_style'] == 1){ echo 'Bold'; }else{ echo 'normal';}; ?>;
  color:<?php if($result['commonContent']['settings']['background_color'] == '#222222'){ echo '#fff'; }else{ echo '#000';}; ?>
}

.ajax_product_45 .pbc-2-pr-title a {
  color:<?php if($result['commonContent']['settings']['background_color'] == '#222222'){ echo '#fff'; }else{ echo '#000';}; ?>

}

.product12.product article .content .title a{
  color:<?php if($result['commonContent']['settings']['background_color'] == '#222222'){ echo '#fff'; }else{ echo '#000';}; ?>
}

  </style>




<div id="getcategory2_section_loading" ></div>

  <div id="getcategory2_section_product" style="margin-bottom:60px;"></div>

  <script>
    getallproductBycategory2_section();
    function getallproductBycategory2_section() {
      var type = '2'
      var content ='';

      content +='  <section class="new-products-content pro-content" style="margin-top:30px;"><div class="container" style="background:#fff"><div class="products-area"><div class="row justify-content-center"><div class="col-12 col-lg-12"><div class="pro-heading-title mtb30 p-0"><h2  class="title_change">Category Section</h2><div class="content_loading"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div></div></div></div></section>';
      jQuery('#getcategory2_section_loading').html(content);
      
      jQuery.ajax({
          url: '{{ URL::to("/getallproductBycategory2_section")}}',
          headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          data: 'type='+type,
            success: function (res) { 
              jQuery('#getcategory2_section_loading').html(' ');
              jQuery('#getcategory2_section_product').html(res);
              jQuery('.add-to-cart-d-hide').show();
              jQuery('.added-to-cart-d-hide').hide();
              getquery();
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

function getquery(){
jQuery(document).ready(function () {
  (function (jQuery) {
    var tabCarousel = jQuery('.categories-carousel-js');
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
    tab_count = 5;
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
